<?php
declare(strict_types=1);

namespace Ydb\Service;


use Psr\Log\LoggerInterface;
use Ydb\Repository\FanRepository;
use Ydb\Repository\MemberRepository;
use Ydb\Repository\ShopSetRepository;

class CommissionService implements WechatPlatformSubscribeListener
{
    /**
     * @var ShopSetRepository
     */
    private $shopSetRepository;

    /**
     * @var MemberRepository
     */
    private $memberRepository;

    /**
     * @var FanRepository
     */
    private $fanRepository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        ShopSetRepository $shopSetRepository,
        MemberRepository $memberRepository,
        FanRepository $fanRepository,
        LoggerInterface $logger
    ) {
        $this->shopSetRepository = $shopSetRepository;
        $this->memberRepository = $memberRepository;
        $this->fanRepository = $fanRepository;
        $this->logger = $logger;
    }

    /**
     * 关注公众号
     * @param array $message
     */
    public function onSubscribe(array $message): void
    {
        $this->logger->debug('onSubscribe: ' . json_encode($message));
        // 查找会员信息
        $member = $this->memberRepository->getMemberByOpenID($message['fromusername']);
        $fan = $this->fanRepository->getFanByOpenId($message['fromusername']);
        // 判断会员是否首次关注且未使用首次关注奖励
        $this->logger->debug("fan['unfollowtime']: " . $fan['unfollowtime']);
        $this->logger->debug(("member['member_flag']['subscribe_reward']: " . $member['member_flag']['subscribe_reward']));
        if (empty($fan['unfollowtime']) && empty($member['member_flag']['subscribe_reward'])) {
            // 判断会员是否有上级
            $this->logger->debug("member['agentid]: " . $member['agentid']);
            if ($member['agentid']) {
                // 增加积分奖励
                $this->rewardParentAgent($member);
                $member['member_flag']['subscribe_reward'] = true;
                $this->memberRepository->save($member);
            }
        }
    }

    /**
     * 取关公众号
     * @param array $message
     */
    public function onUnsubscribe(array $message): void
    {
        $this->logger->debug('onUnsubscribe: ' . json_encode($message));
    }

    /**
     * 奖励直接上级
     * @param array $member
     */
    public function rewardParentAgent(array $member): void
    {
        // 获取奖励模式
        $commissionSet = $this->shopSetRepository->getPluginSet('commission', $member['uniacid']);
        // 发放奖励
        $parentAgent = $this->memberRepository->getMemberById($member['agentid']);
        // 奖励积分
        if ($commissionSet['reccredit'] > 0) {
            m('member')->setCredit($parentAgent['openid'], 'credit1', $commissionSet['reccredit'],
                [0, '团队成员关注公众号积分+' . $commissionSet['reccredit']]);
            // 发送通知
            m('message')->sendCustomNotice($parentAgent['openid'],
                '您的团队成员' . $member['nickname'] . '关注了公众号，为您获得了' . $commissionSet['reccredit'] . '积分');
        }

        // 奖励现金
        if ($commissionSet['recmoney'] > 0) {

        }
    }

    /**
     * 获取分销商的下级数量
     * @param int $memberId 会员id
     * @return int 分销商的下级数量
     */
    public function countChildAgent(int $memberId): int
    {
        $member = $this->memberRepository->getMemberById($memberId);
        $commissionSet = $this->shopSetRepository->getPluginSet('commission', $member['uniacid']);
        if ($commissionSet['child_agent_count_by'] === 'all') {
            return $this->doCountChildAgent($member, -1);
        }
        // $commissionSet['member_count_by'] === 'level'
        return $this->doCountChildAgent($member, (int)($commissionSet['level'] ?? 0));
    }

    /**
     * 按级数统计分销商团队成员，可以统计无限级
     * @param array $member 分销商
     * @param int $maxLevel 成员统计级数，小于0 表示统计所有成员，大于0 统计相应级数成员
     * @return int
     */
    public function doCountChildAgent(array $member, int $maxLevel): int
    {
        if ($maxLevel === 0) {
            return 0;
        }
        $directChildAgentList = $this->memberRepository->getDirectChildAgent($member);
        $count = array_reduce($directChildAgentList, function ($carry, $childAgent) use($maxLevel) {
            return $carry + 1 + $this->doCountChildAgent($childAgent, $maxLevel-1);
        }, 0);
        return $count;
    }
}