<?php


namespace Ydb\Test\Unit\Model;


use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Data\Fixtures\ConstantFixture;
use Ydb\Data\Fixtures\Engine\UniSettingsFixture;
use Ydb\Data\Fixtures\Legacy\GoodsFixture;
use Ydb\Data\Fixtures\Legacy\GoodsOptionFixture;
use Ydb\Data\Fixtures\Legacy\OrderFixture;
use Ydb\Data\Fixtures\Legacy\OrderGoodsFixture;
use Ydb\Data\Fixtures\Legacy\SysSetFixture;
use Ydb\Test\Unit\BaseUnitTest;

class FinanceModelTest extends BaseUnitTest
{
    public function testIsWexinPay(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        $_GET['__weixin_orderquery_resp__'] = array(
            'code' => '200',
            'status' => 'OK',
            'responseline' => 'HTTP/1.1 200 OK',
            'headers' =>
                array(
                    'Server' => 'nginx',
                    'Date' => 'Wed, 25 Dec 2019 06:13:52 GMT',
                    'Content-Type' => 'text/plain',
                    'Content-Length' => '1043',
                    'Connection' => 'close',
                ),
            'content' => '
                        <xml><return_code><![CDATA[SUCCESS]]></return_code>
                        <return_msg><![CDATA[OK]]></return_msg>
                        <appid><![CDATA[wxca6b753bc095e372]]></appid>
                        <mch_id><![CDATA[1534608831]]></mch_id>
                        <device_info><![CDATA[ewei_shopv2]]></device_info>
                        <nonce_str><![CDATA[5at7tScsbObojBsw]]></nonce_str>
                        <sign><![CDATA[65C1BE0D4024EFE38CCC8198C404B0DD]]></sign>
                        <result_code><![CDATA[SUCCESS]]></result_code>
                        <openid><![CDATA[oMW005lDg8xacovx279GSHDCMetM]]></openid>
                        <is_subscribe><![CDATA[Y]]></is_subscribe>
                        <trade_type><![CDATA[JSAPI]]></trade_type>
                        <bank_type><![CDATA[ICBC_CREDIT]]></bank_type>
                        <total_fee>1</total_fee>
                        <fee_type><![CDATA[CNY]]></fee_type>
                        <transaction_id><![CDATA[4200000478201912254663157927]]></transaction_id>
                        <out_trade_no><![CDATA[SH20191225141337555424]]></out_trade_no>
                        <attach><![CDATA[3:0]]></attach>
                        <time_end><![CDATA[20191225141345]]></time_end>
                        <trade_state><![CDATA[SUCCESS]]></trade_state>
                        <cash_fee>1</cash_fee>
                        <trade_state_desc><![CDATA[支付成功]]></trade_state_desc>
                        <cash_fee_type><![CDATA[CNY]]></cash_fee_type>
                        </xml>',
            'meta' => '
                        HTTP/1.1 200 OK
                        Server: nginx
                        Date: Wed, 25 Dec 2019 06:13:52 GMT
                        Content-Type: text/plain
                        Content-Length: 1043
                        Connection: close
                        
                        <xml><return_code><![CDATA[SUCCESS]]></return_code>
                        <return_msg><![CDATA[OK]]></return_msg>
                        <appid><![CDATA[wxca6b753bc095e372]]></appid>
                        <mch_id><![CDATA[1534608831]]></mch_id>
                        <device_info><![CDATA[ewei_shopv2]]></device_info>
                        <nonce_str><![CDATA[5at7tScsbObojBsw]]></nonce_str>
                        <sign><![CDATA[65C1BE0D4024EFE38CCC8198C404B0DD]]></sign>
                        <result_code><![CDATA[SUCCESS]]></result_code>
                        <openid><![CDATA[oMW005lDg8xacovx279GSHDCMetM]]></openid>
                        <is_subscribe><![CDATA[Y]]></is_subscribe>
                        <trade_type><![CDATA[JSAPI]]></trade_type>
                        <bank_type><![CDATA[ICBC_CREDIT]]></bank_type>
                        <total_fee>1</total_fee>
                        <fee_type><![CDATA[CNY]]></fee_type>
                        <transaction_id><![CDATA[4200000478201912254663157927]]></transaction_id>
                        <out_trade_no><![CDATA[SH20191225141337555424]]></out_trade_no>
                        <attach><![CDATA[3:0]]></attach>
                        <time_end><![CDATA[20191225141345]]></time_end>
                        <trade_state><![CDATA[SUCCESS]]></trade_state>
                        <cash_fee>1</cash_fee>
                        <trade_state_desc><![CDATA[支付成功]]></trade_state_desc>
                        <cash_fee_type><![CDATA[CNY]]></cash_fee_type>
                        </xml>',
        );
        $_GET['uniacid'] = ConstantFixture::UNIACID;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = ConstantFixture::UNIACID;
        require_once __DIR__ . '/../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../addons/ewei_shopv2/core/inc/functions.php';

        /**
         * @var ObjectManager $objectManager
         */
        $objectManager = $container->get(ObjectManager::class);

        $uniSettingFixture = new UniSettingsFixture();
        $uniSettingFixture->load($objectManager);
        $sysSetFixture = new SyssetFixture();
        $sysSetFixture->load($objectManager);
        $orderFixture = new OrderFixture();
        $orderFixture->load($objectManager);
        $orderGoodsFixture = new OrderGoodsFixture();
        $orderGoodsFixture->load($objectManager);
        $goodsFixture = new GoodsFixture();
        $goodsFixture->load($objectManager);
        $goodsOptionFixture = new GoodsOptionFixture();
        $goodsOptionFixture->load($objectManager);

        $result = m('finance')->isWeixinPay(OrderFixture::ORDER_LIST[346]['ordersn'],
            OrderFixture::ORDER_LIST[346]['price'], false);
        $this->assertIsBool($result);
    }
}