<?php


namespace Ydb\Test\Unit\Plugin\Abonus\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class AbonusIndexControllerTest extends BasePluginWebUnitTest
{
    public function testNotice(): void
    {
        $_GET['r'] = 'abonus.notice';
        $this->route();
    }

    public function testSet(): void
    {
        $_GET['r'] = 'abonus.set';
        $this->route();
    }
}