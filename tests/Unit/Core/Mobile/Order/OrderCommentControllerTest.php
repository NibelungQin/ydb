<?php


namespace Ydb\Test\Unit\Core\Mobile\Order;


use Ydb\Data\Fixtures\Legacy\OrderFixture;
use Ydb\Test\Unit\Core\Mobile\BaseShopMobileUnitTest;

class OrderCommentControllerTest extends BaseShopMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'order.comment';
        $_GET['id'] = OrderFixture::ORDER_LIST[356]['id'];
        $this->route();
    }

    public function testSubmit(): void
    {
        $_GET['r'] = 'order.comment.submit';
        $_POST['orderid'] = OrderFixture::ORDER_LIST[356]['id'];
        $_POST['comments'] = [
            [
                'goodsid' => '74',
                'level' => '3',
                'content' => '测试评论',
                'images' => ['/path/to/images']
            ]
        ];
        $this->route();
    }
}