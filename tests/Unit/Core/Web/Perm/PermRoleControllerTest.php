<?php

namespace Ydb\Test\Unit\Core\Web\Perm;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class PermRoleControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'perm.role';
        $this->route();
    }
}
