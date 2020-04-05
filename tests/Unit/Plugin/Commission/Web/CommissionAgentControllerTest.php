<?php


namespace Ydb\Test\Unit\Plugin\Commission\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class CommissionAgentControllerTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'commission.agent';
        $this->route();
    }
}