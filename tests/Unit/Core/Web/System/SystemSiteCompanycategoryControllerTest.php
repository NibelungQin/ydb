<?php
            
namespace Ydb\Test\Unit\Core\Web\System;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class SystemSiteCompanycategoryControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'system.site.companycategory';
        $this->route();
    }
}
