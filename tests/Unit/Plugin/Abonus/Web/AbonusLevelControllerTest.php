<?php


namespace Ydb\Test\Unit\Plugin\Abonus\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class AbonusLevelControllerTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'abonus.level';
        $this->route();
    }
}