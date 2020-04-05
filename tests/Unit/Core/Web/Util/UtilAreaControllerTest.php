<?php

namespace Ydb\Test\Unit\Core\Web\Util;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class UtilAreaControllerTest extends BaseShopWebUnitTest
{
    public function testAjax(): void
    {
        $_GET['r'] = 'util.area.ajax';
        $this->route();
    }
}
