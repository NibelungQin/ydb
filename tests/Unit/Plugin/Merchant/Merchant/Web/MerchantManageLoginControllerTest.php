<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Merchant\Web;


use Ydb\Test\Unit\Plugin\Merchant\Merchant\BaseMerchantWebUnitTest;

class MerchantLoginControllerTest extends BaseMerchantWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'login';
        $_GET['i'] = '3';
        $this->route();
    }

    public function testLoginRequest(): void
    {
        $_GET['r'] = 'login';
        $_GET['i'] = '3';
        $_POST['username'] = 'test1';
        $_POST['pwd'] = '123456';
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['HTTP_X_REQUESTED_WITH'] = 'xmlhttprequest';
        $this->route();
    }
}