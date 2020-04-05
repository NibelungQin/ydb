<?php

namespace Ydb\Test\Unit\Core\Web\Store;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class StoreSetControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'store.set';
        $this->route();
    }
}
