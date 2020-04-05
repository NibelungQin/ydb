<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class MerchantIndexControllerTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'merch';
        $this->route();
    }
}