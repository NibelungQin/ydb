<?php
            
namespace Ydb\Test\Unit\Core\Web\Util;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class UtilTaskControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'util.task';
        $this->route();
    }
}
