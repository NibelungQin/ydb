<?php


namespace Ydb\Test\Unit\Engine\Web\Module;


use Ydb\Test\Unit\Engine\Web\BaseEngineWebUnitTest;

class ModuleGroupControllerTest extends BaseEngineWebUnitTest
{
    public function testDisplay(): void
    {
        $_GET['c'] = 'module';
        $_GET['a'] = 'group';
        $this->route();
    }

    public function testPost(): void
    {
        $_GET['c'] = 'module';
        $_GET['a'] = 'group';
        $_GET['do'] = 'post';
        $_GET['id'] = '1';
        $this->route();
    }
}