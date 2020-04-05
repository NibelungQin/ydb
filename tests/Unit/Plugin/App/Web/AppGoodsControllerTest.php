<?php


namespace Ydb\Test\Unit\Plugin\App\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class AppGoodsControllerTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'app.goods';
        $this->route();
    }

    public function testGetCode(): void
    {
        $this->expectExceptionMessage('{"status":0,"result":[]}');

        $_GET['r'] = 'app.goods.get_code';
        $_GET['id'] = '74';
        $this->route();
    }
}