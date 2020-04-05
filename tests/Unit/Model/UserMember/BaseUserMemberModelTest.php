<?php
declare(strict_types=1);

namespace Ydb\Test\Unit\Model\UserMember;


use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Data\Fixtures\Engine\McMappingFansFixture;
use Ydb\Data\Fixtures\Engine\McMembersFixture;
use Ydb\Data\Fixtures\Legacy\MemberFixture;
use Ydb\Entity\Manual\Engine\McMappingFans;
use Ydb\Entity\Manual\Engine\McMembers;
use Ydb\Entity\Manual\Member;
use Ydb\Test\Unit\BaseUnitTest;

abstract class BaseUserMemberModelTest extends BaseUnitTest
{
    protected function setUp(): void
    {
        parent::setUp();

        global $container;

        [$member0, $member1, $member2, $member3, $member4, $member5, $member6, $member7] = array_values(MemberFixture::MEMBER_LIST);

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
    }
}