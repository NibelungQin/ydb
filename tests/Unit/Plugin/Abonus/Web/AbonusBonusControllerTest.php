<?php


namespace Ydb\Test\Unit\Plugin\Abonus\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class AbonusBonusControllerTest extends BasePluginWebUnitTest
{
    public function testStatus0(): void
    {
        $_GET['r'] = 'abonus.bonus.status0';
        $this->route();
    }

    public function testBuild(): void
    {
        $_GET['r'] = 'abonus.bonus.build';
        $this->route();
    }
}