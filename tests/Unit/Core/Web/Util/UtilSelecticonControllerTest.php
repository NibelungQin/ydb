<?php

namespace Ydb\Test\Unit\Core\Web\Util;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class UtilSelecticonControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'util.selecticon';
        $this->route();
    }
}
