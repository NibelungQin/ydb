<?php


namespace Ydb\Test\Unit\Plugin\Diypage\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class DiypagePageIndexControllerTest extends BasePluginWebUnitTest
{

    public function testPageCreate(): void
    {
        $_GET['r'] = 'diypage.page.create';
        $this->route();
    }

    public function testPagePreview(): void
    {
        $_GET['r'] = 'diypage.page.preview';
        $_GET['id'] = 1;
        $this->route();
    }
}