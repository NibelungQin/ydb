<?php
declare(strict_types=1);

namespace Ydb\Test\Unit\Model\UserMember;

use Ydb\Data\Fixtures\Legacy\MemberFixture;

class UserModelTest extends BaseUserMemberModelTest
{
    /**
     * 测试会员的公众号关注状态
     */
    public function testUserFollowStatus(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        [$member0, $member1, $member2, $member3, $member4, $member5, $member6, $member7] = array_values(MemberFixture::MEMBER_LIST);

        $member = $member0;
        $openid = $member['openid'];

        $_GET['uniacid'] = $member0['uniacid'];;
        require __DIR__ . '/../../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = $member0['uniacid'];
        require_once __DIR__ . '/../../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../../addons/ewei_shopv2/core/inc/functions.php';

        $followed = m('user')->followed($openid);
        if (!$followed) {
            if (empty($member['uid'])) {  // 未关注

            } else {   // 取消关注

            }
        } else {      // 已关注

        }
        $this->assertNotNull($member);
        $this->assertIsBool($followed);
    }
}