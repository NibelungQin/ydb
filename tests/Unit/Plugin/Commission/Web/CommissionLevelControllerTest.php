<?php


namespace Ydb\Test\Unit\Plugin\Commission\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class CommissionLevelControllerTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'commission.level';
        $this->route();
    }
}