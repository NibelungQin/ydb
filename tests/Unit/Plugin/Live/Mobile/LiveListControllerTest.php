<?php


namespace Ydb\Test\Unit\Plugin\Live\Mobile;


use Ydb\Test\Unit\Plugin\BasePluginMobileUnitTest;

class LiveListControllerTest extends BasePluginMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'live.list';
        $this->route();
    }

    public function testGetListAll(): void
    {
        $_GET['r'] = 'live.list.get_list';
        $_GET['page'] = '1';
        $_GET['cate'] = '0';
        $_GET['keywords'] = '';
        $this->route();
    }

    public function testGetListCate(): void
    {
        $_GET['r'] = 'live.list.get_list';
        $_GET['page'] = '1';
        $_GET['cate'] = '1';
        $_GET['keywords'] = '';
        $this->route();
    }
}