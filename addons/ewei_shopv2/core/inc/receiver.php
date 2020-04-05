<?php

use Psr\Log\LoggerInterface;
use Ydb\Service\CommissionService;

if (!defined('IN_IA')) {
    exit('Access Denied');
}

/**
 * Class Receiver
 *
 * 商城模块内部事件订阅分派类
 */
class Receiver extends WeModuleReceiver
{
    private const CALLABLE_PATTERN = '!^([^\:]+)\:([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)$!';

    /**
     * 事件订阅注册表
     */
    private $eventSubscribeTable = [
        'subscribe' => [        // 粉丝关注事件
            'subscribe' => [    // 关注事件
                CommissionService::class . ':onSubscribe'
            ],
            ],
        'unsubscribe' => [      // 粉丝取关事件
            'unsubscribe' => [  // 取关事件
                CommissionService::class . ':onUnsubscribe'
            ],
        ]
    ];

    public function receive()
    {
        global $_W;
        global $container;

        $this->message['uniacid'] = $_W['uniacid'];
        $type = $this->message['type'];
        $event = $this->message['event'];
        if ($event === 'subscribe' && $type === 'subscribe') {
            $this->saleVirtual();
        }
        /**
         * @var LoggerInterface $logger
         */
        $logger = $container->get(LoggerInterface::class);
        $logger->debug('receive event: ' . json_encode($this->message));
        if (!empty($this->eventSubscribeTable[$event]) && !empty($this->eventSubscribeTable[$event][$type])) {
            foreach ($this->eventSubscribeTable[$event][$type] as $listener) {
                preg_match(self::CALLABLE_PATTERN, $listener, $matches);
                [, $class, $method] = $matches;
                $callable = [$container->get($class), $method];
                $callable($this->message);
            }
        }
    }

    /**
     * 营销模块的自动回复处理逻辑
     * @param null $obj
     * @return bool
     */
    public function saleVirtual($obj = null)
    {
        global $_W;

        if (empty($obj)) {
            $obj = $this;
        }

        $sale = m('common')->getSysset('sale');
        $data = $sale['virtual'];

        if (empty($data['status'])) {
            return false;
        }

        load()->model('account');
        $account = account_fetch($_W['uniacid']);
        $open_redis = function_exists('redis') && !is_error(redis());

        if ($open_redis) {
            $redis_key1 = 'ewei_' . $_W['uniacid'] . '_member_salevirtual_isagent';
            $redis_key2 = 'ewei_' . $_W['uniacid'] . '_member_salevirtual';
            $redis = redis();

            if (!is_error($redis)) {
                if ($redis->get($redis_key1) != false) {
                    $totalagent = $redis->get($redis_key1);
                    $totalmember = $redis->get($redis_key2);
                } else {
                    $totalagent = pdo_fetchcolumn('select count(*) from' . tablename('ewei_shop_member') . ' where uniacid =' . $_W['uniacid'] . ' and isagent =1');
                    $totalmember = pdo_fetchcolumn('select count(*) from' . tablename('ewei_shop_member') . ' where uniacid =' . $_W['uniacid']);
                    $redis->set($redis_key1, $totalagent, array(0 => 'nx', 'ex' => '3600'));
                    $redis->set($redis_key2, $totalmember, array(0 => 'nx', 'ex' => '3600'));
                }
            }
        } else {
            $totalagent = pdo_fetchcolumn('select count(*) from' . tablename('ewei_shop_member') . ' where uniacid =' . $_W['uniacid'] . ' and isagent =1');
            $totalmember = pdo_fetchcolumn('select count(*) from' . tablename('ewei_shop_member') . ' where uniacid =' . $_W['uniacid']);
        }

        $acc = WeAccount::create();
        $member = abs((int)$data['virtual_people']) + (int)$totalmember;
        $commission = abs((int)$data['virtual_commission']) + (int)$totalagent;
        $user = m('member')->checkMemberFromPlatform($obj->message['from'], $acc);

        if ($_SESSION['eweishop']['poster_member']) {
            $user['isnew'] = true;
            $_SESSION['eweishop']['poster_member'] = null;
        }

        if ($user['isnew']) {
            $message = str_replace('[会员数]', $member, $data['virtual_text']);
            $message = str_replace('[排名]', $member + 1, $message);
        } else {
            $message = str_replace('[会员数]', $member, $data['virtual_text2']);
        }

        $message = str_replace('[分销商数]', $commission, $message);
        $message = str_replace('[昵称]', $user['nickname'], $message);
        $message = htmlspecialchars_decode($message, ENT_QUOTES);
        $message = str_replace('"', '\\"', $message);
        return $this->sendText($acc, $obj->message['from'], $message);
    }

    public function sendText($acc, $openid, $content)
    {
        $send['touser'] = trim($openid);
        $send['msgtype'] = 'text';
        $send['text'] = array('content' => urlencode($content));
        $data = $acc->sendCustomNotice($send);
        return $data;
    }
}
