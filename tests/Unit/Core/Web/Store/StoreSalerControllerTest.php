<?php

namespace Ydb\Test\Unit\Core\Web\Store;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class StoreSalerControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'store.saler';
        $this->route();
    }

    public function testAdd(): void
    {
        $_GET['r'] = 'store.saler.add';
        $this->route();
    }

    public function testEdit(): void
    {
        $_GET['r'] = 'store.saler.edit';
        $_GET['id'] = '7';
        $_POST['id'] = '7';
        $_POST['openid_text'] = 'liner';
        $_POST['openid'] = 'oMW005r75BsJIO7Zojrtk_5kOF_0';
        $_POST['salername'] = 'liner';
        $_POST['mobile'] = '15201010001';
        $_POST['storeid_text'] = '一道电商';
        $_POST['storeid'] = '3';
        $_POST['status'] = '1';
        $this->post();
        $this->route();
    }

    public function testStatus(): void
    {
        $_GET['r'] = 'store.saler.status';
        $_GET['status'] = '0';
        $_GET['id'] = '7';
        $this->route();
    }

    public function testDelete(): void
    {
        $_GET['r'] = 'store.saler.delete';
        $_GET['id'] = '7';
        $this->route();
    }
}
