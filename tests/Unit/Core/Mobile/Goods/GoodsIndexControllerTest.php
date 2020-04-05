<?php


namespace Ydb\Test\Unit\Core\Mobile\Goods;


use Ydb\Test\Unit\Core\Mobile\BaseShopMobileUnitTest;

class GoodsIndexControllerTest extends BaseShopMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'goods';
        $this->route();
    }

    public function testGetList(): void
    {
        $_GET['r'] = 'goods.get_list';
        $_GET['keywords'] = '';
        $_GET['isrecommand'] = '';
        $_GET['ishot'] = '';
        $_GET['isnew'] = '';
        $_GET['isdiscount'] = '';
        $_GET['issendfree'] = '';
        $_GET['istime'] = '';
        $_GET['cate'] = '';
        $_GET['order'] = '';
        $_GET['by'] = '';
        $_GET['merchid'] = '';
        $_GET['page'] = '1';
        $_GET['frommyshop'] = '0';
        $this->route();
    }
}