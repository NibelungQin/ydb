<?php
declare(strict_types=1);

namespace Ydb\Repository;


use Psr\Log\LoggerInterface;
use Ydb\Entity\Manual\Member;

class MemberRepository
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function save(array $member): void
    {
        $this->logger->debug('member: ' . json_encode($member));
        if (is_array($member['member_flag'])) {
            $member['member_flag'] = json_encode($member['member_flag']);
        }
        pdo_update('ewei_shop_member', $member, ['id' => $member['id']]);
    }

    public function getMemberByOpenID($openid): array
    {
        $result = pdo_fetch('SELECT * FROM ' . Member::TABLE_NAME . " WHERE openid = '$openid' ");
        return $this->transform($result);
    }

    public function getMemberById(int $id): array
    {
        $result = pdo_fetch('SELECT * FROM ' . Member::TABLE_NAME . " WHERE id = $id");
        return $this->transform($result);
    }

    private function transform($result): array
    {
        if (empty($result)) {
            return [];
        }
        if (empty($result['member_flag'])) {
            $result['member_flag'] = [];
        } else {
            $result['member_flag'] = json_decode($result['member_flag'], true);
        }
        $result['id'] = empty($result['id']) ? 0 : (int)$result['id'];
        $result['uniacid'] = empty($result['uniacid']) ? 0 : (int)$result['uniacid'];
        $result['agentid'] = empty($result['agentid']) ? 0 : (int)$result['agentid'];
        return $result;
    }

    /**
     * 获取直接下级会员列表
     * @param array $member 需要统计的会员
     * @return array 直接下级会员列表
     */
    public function getDirectChildAgent(array $member): array
    {
        $result = pdo_fetchAll('select * from ' . Member::TABLE_NAME
            . ' where agentid=:agentid and uniacid=:uniacid',
            array(':agentid' => $member['id'], ':uniacid' => $member['uniacid']));
        if (!$result) {
            return [];
        }
        return array_map(function ($item) {
            return $this->transform($item);
        }, $result);
    }

}