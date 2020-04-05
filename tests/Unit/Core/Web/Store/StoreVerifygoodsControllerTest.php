<?php

namespace Ydb\Test\Unit\Core\Web\Store;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class StoreVerifygoodsControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'store.verifygoods';
        $this->route();
    }

    public function testDetail(): void
    {
        $_GET['r'] = 'store.verifygoods.detail';
        $_GET['id'] = '26';
        $this->route();
    }

    public function testDetailPost(): void
    {
        $_GET['r'] = 'store.verifygoods.detail';
        $_GET['id'] = '26';
        $_POST['id'] = '26';
        $_POST['limittype'] = '0';
        $_POST['limitdays'] = '30';
        $_POST['limitdate'] = '2019-08-06 14:54:00';
        $_POST['limitnum'] = '3';
        $_POST['invalid'] = '0';
        $this->post();
        $this->route();
    }

    public function testInvalid(): void
    {
        $_GET['r'] = 'store.verifygoods.invalid';
        $_GET['id'] = '26';
        $_GET['type'] = '1';
        $this->route();
    }

    public function testVerifyGoodsLog(): void
    {
        $_GET['r'] = 'store.verifygoods.verifygoodslog';
        $_GET['id'] = '26';
        $this->route();
    }

    public function testVerifyGoodsDelete(): void
    {
        $_GET['r'] = 'store.verifygoods.verifygoodslogdelete';
        $_GET['id'] = '10';
        $this->route();
    }
}
