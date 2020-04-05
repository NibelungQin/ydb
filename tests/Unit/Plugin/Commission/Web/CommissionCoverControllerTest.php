<?php


namespace Ydb\Test\Unit\Plugin\Commission\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class CommissionCoverControllerTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'commission.cover';
        $this->route();
    }
}