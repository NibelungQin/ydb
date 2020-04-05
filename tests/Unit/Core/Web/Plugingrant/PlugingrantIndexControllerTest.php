<?php

namespace Ydb\Test\Unit\Core\Web\Plugingrant;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class PlugingrantIndexControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'plugingrant';
        $this->route();
    }
}
