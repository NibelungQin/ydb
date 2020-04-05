<?php


namespace Ydb\Test\Unit\Engine\Web\Platform;


use Ydb\Test\Unit\Engine\Web\BaseEngineWebUnitTest;

class PlatformReplyControllerTest extends BaseEngineWebUnitTest
{
    public function testDisplay(): void
    {
        $_GET['c'] = 'platform';
        $_GET['a'] = 'reply';
        $this->route();
    }

    public function testPostKeyword(): void
    {
        $_GET['c'] = 'platform';
        $_GET['a'] = 'reply';
        $_GET['do'] = 'post';
        $_GET['m'] = 'keyword';
        $this->route();
    }

    public function testPostApply(): void
    {
        $_GET['c'] = 'platform';
        $_GET['a'] = 'reply';
        $_GET['do'] = 'post';
        $_GET['m'] = 'apply';
        $this->route();
    }
}