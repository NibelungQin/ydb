<?php


namespace Ydb\Test\Unit\Plugin\Diypage\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;
use RuntimeException;

class DiypageTempIndexControllerTest extends BasePluginWebUnitTest
{

    public function testTemp(): void
    {
        $_GET['r'] = 'diypage.temp';
        $_GET['cate'] = 2;
        $_GET['type'] = 5;
        $_GET['keyword'] = 'diytemplate_test_temp';
        $this->route(function(){
            $this->diypage_templates[0]['cate'] = 2;
            $this->diypage_templates[0]['type'] = 5;
            $this->diypage_templates[0]['name'] = 'diytemplate_test_temp';
        });
    }

    public function testTempDelete(): void
    {
        $_GET['r'] = 'diypage.temp.delete';
        $_GET['id'] = 1;
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(json_encode(0));
        $this->post();
        $this->route();
    }

    public function testTempDeleteEmptyUniacid(): void
    {
        $_GET['r'] = 'diypage.temp.delete';
        $_GET['id'] = 1;
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(json_encode(0));
        $this->post();
        $this->route(function(){
            $this->diypage_templates[0]['uniacid'] = '';
        });
    }

}