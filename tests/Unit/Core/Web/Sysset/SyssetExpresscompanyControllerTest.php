<?php

namespace Ydb\Test\Unit\Core\Web\Sysset;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class SyssetExpresscompanyControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'sysset.expresscompany';
        $this->route();
    }

    public function testAdd(): void
    {
        $_GET['r'] = 'sysset.expresscompany.add';
        $this->route();
    }

    public function testEdit(): void
    {
        $_GET['r'] = 'sysset.expresscompany.edit';
        $_GET['id'] = '94';
        $this->route();
    }

    public function testEditPost(): void
    {
        $_GET['r'] = 'sysset.expresscompany.edit';
        $_GET['id'] = '94';
        $_GET['me'] = '顺丰';
        $_GET['express'] = 'shunfeng';
        $_GET['kuaidiniao'] = 'SF';
        $_GET['id'] = '94';
        $this->post();
        $this->route();
    }

    public function testDelete(): void
    {
        $_GET['r'] = 'sysset.expresscompany.delete';
        $_GET['id'] = '94';
        $this->route();
    }
}
