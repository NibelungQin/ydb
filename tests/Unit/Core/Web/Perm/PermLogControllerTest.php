<?php

namespace Ydb\Test\Unit\Core\Web\Perm;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class PermLogControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'perm.log';
        $this->route();
    }
}
