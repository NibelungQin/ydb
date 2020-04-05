<?php


namespace Ydb\Test\Unit\Plugin\Live\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class LiveCoverControllerTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'live.cover';
        $this->route();
    }
}