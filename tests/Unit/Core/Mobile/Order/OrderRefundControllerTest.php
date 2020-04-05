<?php


namespace Ydb\Test\Unit\Core\Mobile\Order;


use Ydb\Data\Fixtures\Legacy\OrderFixture;
use Ydb\Data\Fixtures\Legacy\OrderRefundFixture;
use Ydb\Test\Unit\Core\Mobile\BaseShopMobileUnitTest;

class OrderRefundControllerTest extends BaseShopMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'order.refund';
        $_GET['id'] = OrderFixture::ORDER_LIST[359]['id'];
        $this->route(function () {
            $this->shopSets['trade']['refunddays'] = '7';   // 设置订单完成后7天可退款
        });
    }

    public function testSubmit(): void
    {
        $_GET['r'] = 'order.refund.submit';
        $_POST['id'] = OrderFixture::ORDER_LIST[356]['id'];
        $_POST['type'] = 'wechat';
        $_POST['price'] = '0.01';
        $_POST['rtype'] = '0';
        $this->post();
        $this->route(function () {
            $this->shopSets['trade']['refunddays'] = '7';   // 设置订单完成后7天可退款
            $this->orders[356]['finishtime'] = time();
        });
    }

    public function testCancel(): void
    {
        $_GET['r'] = 'order.refund.cancel';
        $_POST['id'] = OrderFixture::ORDER_LIST[351]['id'];
        $this->post();
        $this->route(function () {
            $this->shopSets['trade']['refunddays'] = '7';   // 设置订单完成后7天可退款
        });
    }

    public function testExpress(): void
    {
        $_GET['r'] = 'order.refund.express';
        $_POST['id'] = OrderFixture::ORDER_LIST[365]['id'];
        $_POST['express'] = '';
        $_POST['expresscom'] = '';
        $_POST['expresssn'] = '1111';
        $this->post();
        $this->route(function () {
            $this->shopSets['trade']['refunddays'] = '7';   // 设置订单完成后7天可退款
        });
    }

    public function testReceive(): void
    {
        $_GET['r'] = 'order.refund.receive';
        $_POST['id'] = OrderFixture::ORDER_LIST[367]['id'];
        $_POST['refundid'] = OrderRefundFixture::ORDER_REFUND_LIST[13]['id'];
        $this->post();
        $this->route(function () {
            $this->shopSets['trade']['refunddays'] = '7';   // 设置订单完成后7天可退款
        });
    }

    public function testRefundExpress(): void
    {
        $_GET['r'] = 'order.refund.refundexpress';
        $_GET['id'] = OrderFixture::ORDER_LIST[367]['id'];
        $_GET['express'] = '';
        $_GET['expresscom'] = '';
        $_GET['expresssn'] = '1112';
        $this->route(function () {
            $this->shopSets['trade']['refunddays'] = '7';   // 设置订单完成后7天可退款
        });
    }
}