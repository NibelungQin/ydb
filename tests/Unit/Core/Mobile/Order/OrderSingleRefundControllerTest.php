<?php


namespace Ydb\Test\Unit\Core\Mobile\Order;


use Ydb\Data\Fixtures\Legacy\OrderGoodsFixture;
use Ydb\Data\Fixtures\Legacy\OrderSingleRefundFixture;
use Ydb\Test\Unit\Core\Mobile\BaseShopMobileUnitTest;

class OrderSingleRefundControllerTest extends BaseShopMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'order.single_refund';
        $_GET['id'] = OrderGoodsFixture::ORDER_GOODS_LIST[335]['id'];
        $this->route(function () {
            $this->shopSets['trade']['refunddays'] = '7';   // 设置订单完成后7天可退款
        });
    }

    public function testSubmit(): void
    {
        $_GET['r'] = 'order.single_refund.submit';
        $_POST['id'] = OrderGoodsFixture::ORDER_GOODS_LIST[375]['id'];
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
        $_GET['r'] = 'order.single_refund.cancel';
        $_POST['id'] = OrderGoodsFixture::ORDER_GOODS_LIST[383]['id'];
        $this->post();
        $this->route(function () {
            $this->shopSets['trade']['refunddays'] = '7';   // 设置订单完成后7天可退款
        });
    }

    public function testExpress(): void
    {
        $_GET['r'] = 'order.single_refund.express';
        $_POST['id'] = OrderGoodsFixture::ORDER_GOODS_LIST[384]['id'];
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
        $_GET['r'] = 'order.single_refund.receive';
        $_POST['id'] = OrderGoodsFixture::ORDER_GOODS_LIST[385]['id'];
        $_POST['single_refundid'] = OrderSingleRefundFixture::ORDER_SINGLE_REFUND_LIST[6]['id'];
        $this->post();
        $this->route(function () {
            $this->shopSets['trade']['refunddays'] = '7';   // 设置订单完成后7天可退款
        });
    }

    public function testRefundExpress(): void
    {
        $_GET['routes'] = 'order.single_refund.refundexpress';
        $_GET['id'] = OrderGoodsFixture::ORDER_GOODS_LIST[385]['id'];
        $_GET['express'] = '';
        $_GET['expresscom'] = '';
        $_GET['expresssn'] = '1113';
        $this->route(function () {
            $this->shopSets['trade']['refunddays'] = '7';   // 设置订单完成后7天可退款
        });
    }
}