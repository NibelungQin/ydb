<?php


namespace Ydb\Test\Unit\Engine\Web\Mc;


use Ydb\Test\Unit\Engine\Web\BaseEngineWebUnitTest;

class McMemberControllerTest extends BaseEngineWebUnitTest
{
    public function testDisplay(): void
    {
        $_GET['c'] = 'mc';
        $_GET['a'] = 'member';
        $this->route();
    }
}