<?php


namespace Ydb\Test\Unit\Core\Mobile\Order;


use RuntimeException;
use Ydb\Test\Unit\Core\Mobile\BaseShopMobileUnitTest;

class OrderPayControllerTest extends BaseShopMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'order.pay';
        $_GET['id'] = '346';
        $this->route();

    }

    public function testCompleteNoPayType(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(json_encode('未找到支付方式'));

        $_GET['r'] = 'order.pay.complete';
        $_POST['id'] = '346';
        $this->post();
        $this->route();
    }

    /**
     * 同步之前**已收到**微信支付回调
     */
    public function testPayWithWechatAfterCallback(): void
    {
        $_GET['r'] = 'order.pay.complete';
        $_POST['id'] = '346';
        $_POST['type'] = 'wechat';
        $this->post();
        $this->route(function () {
            $this->orders[346]['status'] = 1;
        });
    }

    /**
     * 同步之前**未收到**微信支付回调
     */
    public function testPayWithWechatBeforeCallback(): void
    {
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

        $_GET['r'] = 'order.pay.complete';
        $_POST['id'] = '346';
        $_POST['type'] = 'wechat';
        $this->post();
        $this->route();
    }

    public function testSuccess(): void
    {
        $_GET['r'] = 'order.pay.success';
        $_GET['id'] = '364';
        $_SESSION['ewei_shop__order_pay_complete'] = 1;
        $this->route();
    }
}