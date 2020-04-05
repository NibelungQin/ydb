<?php
            
namespace Ydb\Test\Unit\Core\Web\Store;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class StoreStatisticControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'store.statistic';
        $this->route();
    }
}
