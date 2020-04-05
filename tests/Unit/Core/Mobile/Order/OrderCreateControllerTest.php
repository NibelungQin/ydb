<?php


namespace Ydb\Test\Unit\Core\Mobile\Order;


use Ydb\Test\Unit\Core\Mobile\BaseShopMobileUnitTest;

class OrderCreateControllerTest extends BaseShopMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'order.create';
        $_GET['id'] = '74';
        $_GET['optionid'] = '96';
        $_GET['total'] = '1';
        $_GET['giftid'] = '';
        $_GET['liveid'] = '0';
        $this->route();
    }

    public function testCalculate(): void
    {
        $_GET['r'] = 'order.create.caculate';
        $_POST['totalprice'] = '0.01';
        $_POST['addressid'] = '44';
        $_POST['dflag'] = '0';
        $_POST['goods'] = [
            [
                'goodsid' => '74',
                'total' => '1',
                'optionid' => '96',
                'marketprice' => '0.01',
                'merchid' => '0',
                'cates' => '32',
                'discounttype' => '0',
                'isdiscountprice' => '0',
                'discountprice' => '0',
                'isdiscountunitprice' => '0',
                'discountunitprice' => '0',
                'type' => '1',
                'intervalfloor' => '',
                'intervalprice1' => '',
                'intervalnum1' => '',
                'intervalprice2' => '',
                'intervalnum2' => '',
                'intervalprice3' => '',
                'intervalnum3' => '',
                'wholesaleprice' => '',
                'goodsalltotal' => '',
                'isnodiscount' => '0',
                'deduct' => '0.00',
                'deduct2' => '0.00',
                'ggprice' => '0.01',
                'manydeduct' => '0',
            ]
        ];
        $_POST['packageid'] = '0';
        $_POST['liveid'] = '0';
        $_POST['card_id'] = '0';
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['HTTP_X_REQUESTED_WITH'] = 'xmlhttprequest';
        $this->route();
    }

    public function testSubmit(): void
    {
        $_GET['r'] = 'order.create.submit';
        $_POST['orderid'] = '0';
        $_POST['id'] = '74';
        $_POST['goods'] = [
            [
                'goodsid' => '74',
                'total' => '1',
                'optionid' => '96',
                'marketprice' => '0.01',
                'merchid' => '0',
                'cates' => '32',
                'discounttype' => '0',
                'isdiscountprice' => '0',
                'discountprice' => '0',
                'isdiscountunitprice' => '0',
                'discountunitprice' => '0',
                'type' => '1',
                'intervalfloor' => '',
                'intervalprice1' => '',
                'intervalnum1' => '',
                'intervalprice2' => '',
                'intervalnum2' => '',
                'intervalprice3' => '',
                'intervalnum3' => '',
                'wholesaleprice' => '',
                'goodsalltotal' => '',
                'isnodiscount' => '0',
                'deduct' => '0.00',
                'deduct2' => '0.00',
                'ggprice' => '0.01',
                'manydeduct' => '0',
            ]
        ];
        $_POST['card_id'] = '0';
        $_POST['giftid'] = 'NaN';
        $_POST['gdid'] = '0';
        $_POST['liveid'] = '0';
        $_POST['diydata'] = '';
        $_POST['dispatchtype'] = '0';
        $_POST['fromcart'] = '0';
        $_POST['carrierid'] = '0';
        $_POST['addressid'] = '44';
        $_POST['carriers'] = '';
        $_POST['remark'] = '';
        $_POST['deduct'] = '0';
        $_POST['deduct2'] = '0';
        $_POST['contype'] = '0';
        $_POST['couponid'] = '0';
        $_POST['wxid'] = '0';
        $_POST['wxcardid'] = '0';
        $_POST['wxcode'] = '';
        $_POST['submit'] = 'true';
        $_POST['real_price'] = '0.01';
        $_POST['packageid'] = '0';
        $_POST['fromquick'] = '0';
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['HTTP_X_REQUESTED_WITH'] = 'xmlhttprequest';
        $this->route();
    }
}