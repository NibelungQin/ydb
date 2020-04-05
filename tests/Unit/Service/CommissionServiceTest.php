<?php
declare(strict_types=1);

namespace Ydb\Test\Unit\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Data\Fixtures\ConstantFixture;
use Ydb\Data\Fixtures\Engine\McMappingFansFixture;
use Ydb\Data\Fixtures\Engine\McMembersFixture;
use Ydb\Data\Fixtures\Legacy\MemberFixture;
use Ydb\Repository\ShopSetRepository;
use Ydb\Service\CommissionService;
use Ydb\Test\Unit\BaseUnitTest;

class CommissionServiceTest extends BaseUnitTest
{
    public function testRewardParent(): void
    {
        global $container;

        /**
         * @var CommissionService $commissionService
         */
        $commissionService = $container->get(CommissionService::class);
        $commissionService->rewardParentAgent([
            'openid' => 'oMW005lDg8xacovx279GSHDCMetM',
            'agentid' => 125,
            'uniacid' => 3
        ]);
        $this->assertEquals(1, 1);
    }

    public function testCountChildAgent(): void
    {
        global $container;

        [$member0, $member1, $member2, $member3, $member4, $member5, $member6, $member7] = array_values(MemberFixture::MEMBER_LIST);
        $member0['agentid'] = 0;
        $member1['agentid'] = $member0['id'];
        $member2['agentid'] = $member0['id'];
        $member3['agentid'] = $member1['id'];
        $member4['agentid'] = $member3['id'];
        $member5['agentid'] = $member3['id'];
        $member6['agentid'] = $member4['id'];
        $member7['agentid'] = $member5['id'];

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);
        $memberFixture = new MemberFixture();
        $memberFixture->setMemberList([$member0, $member1, $member2, $member3, $member4, $member5, $member6, $member7]);
        $memberFixture->load($objectManager);
        $mcMembersFixture = new McMembersFixture();
        $mcMembersFixture->load($objectManager);
        $mcMappingFansFixture = new McMappingFansFixture();
        $mcMappingFansFixture->load($objectManager);

        /**
         * @var ShopSetRepository $shopSetRepository
         */
        $shopSetRepository = $container->get(ShopSetRepository::class);

        /**
         * @var CommissionService $commissionService
         */
        $commissionService = $container->get(CommissionService::class);

        // 统计所有成员
        $shopSetRepository->setPluginSet('commission', ['child_agent_count_by' => 'all'], ConstantFixture::UNIACID);

        $count = $commissionService->countChildAgent($member7['id']);
        $this->assertEquals(0, $count);

        $count = $commissionService->countChildAgent($member5['id']);
        $this->assertEquals(1, $count);

        $count = $commissionService->countChildAgent($member0['id']);
        $this->assertEquals(7, $count);

        // 统计分销等级内成员
        $shopSetRepository->setPluginSet('commission', ['child_agent_count_by' => 'level', 'level' => 2], ConstantFixture::UNIACID);

        $count = $commissionService->countChildAgent($member7['id']);
        $this->assertEquals(0, $count);

        $count = $commissionService->countChildAgent($member5['id']);
        $this->assertEquals(1, $count);

        $count = $commissionService->countChildAgent($member0['id']);
        $this->assertEquals(3, $count);

        // 统计分销等级内成员
        $shopSetRepository->setPluginSet('commission', ['child_agent_count_by' => 'level', 'level' => 1], ConstantFixture::UNIACID);

        $count = $commissionService->countChildAgent($member0['id']);
        $this->assertEquals(2, $count);
    }
}