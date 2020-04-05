<?php


namespace Ydb\Test\Unit\Engine\Web\Mc;


use Ydb\Test\Unit\Engine\Web\BaseEngineWebUnitTest;

class McFansControllerTest extends BaseEngineWebUnitTest
{
    public function testDisplay(): void
    {
        $_GET['c'] = 'mc';
        $_GET['a'] = 'fans';
        $this->route();
    }
}