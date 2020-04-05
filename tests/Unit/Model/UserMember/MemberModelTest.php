<?php
declare(strict_types=1);

namespace Ydb\Test\Unit\Model\UserMember;


use Ydb\Data\Fixtures\ConstantFixture;
use Ydb\Data\Fixtures\Engine\McMembersFixture;
use Ydb\Data\Fixtures\Legacy\MemberFixture;
use Ydb\Entity\Manual\Engine\McCreditsRecord;
use Ydb\Entity\Manual\Engine\McMembers;
use Ydb\Entity\Manual\Member;
use Ydb\Entity\Manual\MemberCreditRecord;

/**
 * Class MemberModelTest
 * @package Ydb\Test\Unit\Model
 *
 * 会员模块的测试用例
 *
 * 测试策略：
 * 1. 往数据库中添加 3 条会员记录，涉及 Member, McMember, McMappingFans 三张表
 * 2. 设置全局变量，引入依赖文件
 * 3. 调用模块中的方法操作数据
 * 4. 访问数据库中的记录，验证操作结果
 *
 * DRY (Don't Repeat Yourself)：重复的数据用一个变量表示，方便修改，减少出错
 */
class MemberModelTest extends BaseUserMemberModelTest
{
    protected function tearDown(): void
    {
        parent::tearDown();
        pdo_run('TRUNCATE TABLE ' . MemberCreditRecord::TABLE_NAME);
        pdo_run('TRUNCATE TABLE ' . McCreditsRecord::TABLE_NAME);
    }

    /**
     * 测试获取积分
     */
    public function testGetCredit(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        [$member0, $member1, $member2, $member3, $member4, $member5, $member6, $member7] = array_values(MemberFixture::MEMBER_LIST);


        $_GET['uniacid'] = ConstantFixture::UNIACID;
        require __DIR__ . '/../../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = $member7['uniacid'];
        require_once __DIR__ . '/../../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../../addons/ewei_shopv2/core/inc/functions.php';

        $openid = $member0['openid'];
        $result = m('member')->getCredit($openid, 'credit1');
        $this->assertEquals(McMembersFixture::MC_MEMBER_LIST[$member0['uid']]['credit1'], $result);

        $openid = $member1['openid'];
        $result = m('member')->getCredit($openid, 'credit1');
        $this->assertEquals(McMembersFixture::MC_MEMBER_LIST[$member1['uid']]['credit1'], $result);

        $openid = $member2['openid'];
        $result = m('member')->getCredit($openid, 'credit1');
        $this->assertEquals($member2['credit1'], $result);
    }

    /**
     * 测试增加会员积分
     */
    public function testAddCredit(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        [$member0, $member1, $member2, $member3, $member4, $member5, $member6, $member7] = array_values(MemberFixture::MEMBER_LIST);


        $_GET['uniacid'] = $member0['uniacid'];
        require __DIR__ . '/../../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = $member0['uniacid'];
        require_once __DIR__ . '/../../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../../addons/ewei_shopv2/core/inc/functions.php';

        $member = $member0;
        $openid = $member['openid'];
        $credittype = 'credit1';   // credit1 表示积分

        $rewardCredit = 100;
        $remark = '扫码关注积分+' . $rewardCredit;
        m('member')->setCredit($openid, $credittype, $rewardCredit, array(0, $remark));
        $result = m('member')->getCredit($openid, $credittype);
        $this->assertEquals((int)McMembersFixture::MC_MEMBER_LIST[$member['uid']][$credittype] + $rewardCredit, $result);
        $this->assertCredit($member);
        $this->assertCreditLog(1, [
            'openid' => $openid,
            'remark' => $remark,
            'credittype' => $credittype,
            'num' => $rewardCredit
        ]);

        $deductCredit = -100;
        $remark = '商城抽奖扣除' . $deductCredit;
        m('member')->setCredit($openid, $credittype, $deductCredit, array(0, $remark));
        $result = m('member')->getCredit($openid, $credittype);
        $this->assertEquals((int)McMembersFixture::MC_MEMBER_LIST[$member['uid']][$credittype] + $rewardCredit + $deductCredit, $result);
        $this->assertCredit($member);
        $this->assertCreditLog(2, [
            'openid' => $openid,
            'remark' => $remark,
            'credittype' => $credittype,
            'num' => $deductCredit
        ]);
    }

    private function assertCredit(array $member): void
    {
        $mcMemberCredit = pdo_fetchcolumn(
            'SELECT credit1 FROM ' . McMembers::TABLE_NAME . ' WHERE `uid` = :uid and uniacid=:uniacid limit 1',
            [':uid' => $member['uid'], ':uniacid' => $member['uniacid']]
        );

        $memberCredit = pdo_fetchcolumn(
            'SELECT credit1 FROM ' . Member::TABLE_NAME . ' WHERE openid=:openid and uniacid=:uniacid limit 1',
            [':uniacid' => $member['uniacid'], ':openid' => $member['openid']]
        );

        $this->assertEquals($mcMemberCredit, $memberCredit);
    }

    private function assertCreditLog(int $logId, array $expectedLog): void
    {
        $actualLog = pdo_fetch(
            'SELECT * FROM ' . MemberCreditRecord::TABLE_NAME . " WHERE id=$logId"
        );
        $this->assertEquals($expectedLog['openid'], $actualLog['openid']);
        $this->assertEquals($expectedLog['remark'], $actualLog['remark']);
        $this->assertEquals($expectedLog['credittype'], $actualLog['credittype']);
        $this->assertEquals($expectedLog['num'], $actualLog['num']);

        $actualLog = pdo_fetch(
            'SELECT * FROM ' . McCreditsRecord::TABLE_NAME . " WHERE id=$logId"
        );
        $this->assertEquals($expectedLog['remark'], $actualLog['remark']);
        $this->assertEquals($expectedLog['credittype'], $actualLog['credittype']);
        $this->assertEquals($expectedLog['num'], $actualLog['num']);
    }

    public function testGetMember(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        [$member0, $member1, $member2, $member3, $member4, $member5, $member6, $member7] = array_values(MemberFixture::MEMBER_LIST);


        $_GET['uniacid'] = $member0['uniacid'];
        require __DIR__ . '/../../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = $member0['uniacid'];
        require_once __DIR__ . '/../../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../../addons/ewei_shopv2/core/inc/functions.php';

        $member = m('member')->getMember($member0['openid'], true);
        $this->assertNotNull($member);
        $this->assertIsArray($member);
        $this->assertEquals($member0['id'], $member['id']);
    }

    public function testCheckMember(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        [$member0, $member1, $member2, $member3, $member4, $member5, $member6, $member7] = array_values(MemberFixture::MEMBER_LIST);


        $_GET['uniacid'] = $member0['uniacid'];
        require __DIR__ . '/../../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = $member0['uniacid'];
        $_W['openid'] = $member0['openid'];
        $_SESSION['userinfo'] = base64_encode(iserializer(['subscribe' => true, 'nickname' => '你好']));
        require_once __DIR__ . '/../../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../../addons/ewei_shopv2/core/inc/functions.php';

        $result = m('member')->checkMember();
        $this->assertIsArray($result);
        $this->assertEquals(var_export(['id' => (string)$member0['id'], 'openid' => $member0['openid']],true),
            var_export($result, true));
    }
}