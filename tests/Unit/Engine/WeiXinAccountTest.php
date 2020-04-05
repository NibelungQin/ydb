<?php


namespace Ydb\Test\Unit\Engine;


use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Data\Fixtures\ConstantFixture;
use Ydb\Data\Fixtures\Engine\AccountWechatsFixture;
use Ydb\Test\Unit\BaseUnitTest;

class WeiXinAccountTest extends BaseUnitTest
{
    public function testFetchAccountInfo(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        $_GET['uniacid'] = ConstantFixture::UNIACID;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = ConstantFixture::UNIACID;

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);
        $accountWechatsFixture = new AccountWechatsFixture();
        $accountWechatsFixture->load($objectManager);

        load()->classs('weixin.account');

        $expected = [
            'acid' => '3',
            'uniacid' => '3',
            'token' => 'jZyombMrYu88GlUx8a8yRmYpO1eX8bA2',
            'encodingaeskey' => 'mrrnc79719c1315F9xKnp9Cg951iMPXXM7p9lnpKN1N',
            'level' => '4',
            'name' => '一道电商服务',
            'account' => '731539803@qq.com',
            'original' => 'gh_5a2c328b8246',
            'signature' => '',
            'country' => '',
            'province' => '',
            'city' => '',
            'username' => '',
            'password' => '',
            'lastupdate' => '0',
            'key' => 'wxca6b753bc095e372',
            'secret' => 'f5bdcd15c8dc991b47c9605024e8797d',
            'styleid' => '0',
            'subscribeurl' => '',
            'auth_refresh_token' => '',
            'encrypt_key' => 'wxca6b753bc095e372',
        ];
        $weiXinAccount = new \WeiXinAccount();
        $weiXinAccount->uniaccount = [
            'acid' => '3',
            'uniacid' => '3',
            'hash' => 'nqE3UzII',
            'type' => '1',
            'isconnect' => '1',
            'isdeleted' => '0',
            'endtime' => '0',
            'groupid' => '0',
            'name' => '一道电商服务',
            'description' => '',
            'default_acid' => '3',
            'rank' => null,
            'title_initial' => 'Y',
        ];
        $accountInfo = $weiXinAccount->fetchAccountInfo();
        $this->assertIsArray($accountInfo);
        $this->assertEquals(var_export($expected, true), var_export($accountInfo, true));
    }
}