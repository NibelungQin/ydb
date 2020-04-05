<?php


namespace Ydb\Test\Unit\Engine\Web\Statistics;


use Ydb\Test\Unit\Engine\Web\BaseEngineWebUnitTest;

class StatisticsAccountControllerTest extends BaseEngineWebUnitTest
{
    public function testDisplay(): void
    {
        $_GET['c'] = 'statistics';
        $_GET['a'] = 'account';
        $this->route();
    }

    public function testAppDisplay(): void
    {
        $_GET['c'] = 'statistics';
        $_GET['a'] = 'account';
        $_GET['do'] = 'app_display';
        $this->route();
    }
}