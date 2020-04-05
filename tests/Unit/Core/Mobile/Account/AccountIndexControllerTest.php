<?php


namespace Ydb\Test\Unit\Core\Mobile\Account;


use Ydb\Data\Fixtures\ConstantFixture;
use Ydb\Test\Unit\Core\Mobile\BaseShopMobileUnitTest;

class AccountIndexControllerTest extends BaseShopMobileUnitTest
{
    public function testRegister(): void
    {
        $_SERVER['HTTP_USER_AGENT'] = 'Html5Plus';
        $_GET['r'] = 'account.register';
        $this->route();
    }

    public function testRegisterPost(): void
    {
        $_SERVER['HTTP_USER_AGENT'] = 'Html5Plus';
        $_GET['r'] = 'account.register';
        $_POST['mobile'] = '15201010003';
        $_POST['verifycode'] = '12345';
        $_POST['pwd'] = '123456';
        $key = '__ewei_shopv2_member_verifycodesession_' . ConstantFixture::UNIACID . '_' . $_POST['mobile'];
        $_SESSION[$key] = $_POST['verifycode'];
        $_SESSION['verifycodesendtime'] = time();
        $this->post();
        $this->route();
    }
}