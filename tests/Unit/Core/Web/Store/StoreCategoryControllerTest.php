<?php

namespace Ydb\Test\Unit\Core\Web\Store;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class StoreCategoryControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'store.category';
        $this->route();
    }
}
