<?php
declare(strict_types=1);

namespace Ydb\Test\Unit\PaymentNotification;

use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Data\Fixtures\Engine\CorePaylogFixture;
use Ydb\Data\Fixtures\Legacy\OrderFixture;
use Ydb\Data\Fixtures\Legacy\PaymentFixture;
use Ydb\Data\Fixtures\Legacy\SysSetFixture;
use Ydb\Test\Unit\BaseUnitTest;
use Ydb\Test\Util\MockPhpStream;

class WechatTest extends BaseUnitTest
{
    public function testNotification(): void
    {
        global $container;

        $_GET['uniacid'] = 3;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = 3;
        require_once __DIR__ . '/../../../addons/ewei_shopv2/defines.php';

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);
        $syssetFixture = new SyssetFixture();
        //$syssetFixture->setSets(SysSetFixture::SETS);
        $syssetFixture->setSets(['pay' => SysSetFixture::SETS['pay']]);
        $syssetFixture->setPlugins(SysSetFixture::PLUGINS);
        $syssetFixture->setSec(SysSetFixture::SEC);
        $syssetFixture->load($objectManager);

        $paymentFixture = new PaymentFixture();
        $paymentFixture->load($objectManager);

        $orderFixture = new OrderFixture();
        $orderFixture->load($objectManager);

        $corePaylogFixture = new CorePaylogFixture();
        $corePaylogFixture->load($objectManager);

        stream_wrapper_unregister('php');
        stream_wrapper_register('php', MockPhpStream::class);
        file_put_contents('php://input',
            '<xml>
                <appid><![CDATA[wxca6b753bc095e372]]></appid>
                <attach><![CDATA[3:0]]></attach>
                <bank_type><![CDATA[CFT]]></bank_type>
                <cash_fee>1</cash_fee>
                <device_info><![CDATA[ewei_shopv2]]></device_info>
                <fee_type><![CDATA[CNY]]></fee_type>
                <is_subscribe><![CDATA[Y]]></is_subscribe>
                <mch_id>1534608831</mch_id>
                <nonce_str><![CDATA[I0hHK1iCBIZC0hH5hCEK0B7h7cj5ucSc]]></nonce_str>
                <openid><![CDATA[oMW005lDg8xacovx279GSHDCMetM]]></openid>
                <out_trade_no><![CDATA[SH20191115000819744664]]></out_trade_no>
                <result_code><![CDATA[SUCCESS]]></result_code>
                <return_code><![CDATA[SUCCESS]]></return_code>
                <sign><![CDATA[69B6DED4F57E24C65E9F63D86E2DF639]]></sign>
                <time_end>20191115000827</time_end>
                <total_fee>1</total_fee>
                <trade_type><![CDATA[JSAPI]]></trade_type>
                <transaction_id>4200000441201911154568190154</transaction_id>
            </xml>
        ');

        include __DIR__ . '/../../../addons/ewei_shopv2/payment/wechat/notify.php';

        stream_wrapper_restore('php');

        $output = $this->getActualOutput();
        $this->assertNotNull($output);
    }
}