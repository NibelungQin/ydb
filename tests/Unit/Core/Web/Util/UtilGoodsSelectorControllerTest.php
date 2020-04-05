<?php
            
namespace Ydb\Test\Unit\Core\Web\Util;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class UtilGoodsSelectorControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'util.goods_selector';
        $_POST['page'] = '1';
        $_POST['keywords'] = '红';
        $_POST['condition'] = '';
        $_POST['platform'] = 'wxapp';
        $this->post();
        $this->route();
    }

    public function testJs(): void
    {
        $_GET['r'] = 'util.goods_selector.js';
        $this->route();
    }

    public function testGetCate(): void
    {
        $_GET['r'] = 'util.goods_selector.getcate';
        $this->route();
    }
}
