<?php


namespace Ydb\Test\Unit\Plugin\App\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class AppStartAdvControllerTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'app.startadv';
        $this->route();
    }
}