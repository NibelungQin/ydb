<?php
declare(strict_types=1);

namespace Ydb\Test\Unit\Model;

use Ydb\Test\Unit\BaseUnitTest;

class SystemModelTest extends BaseUnitTest
{
    public function testGetMenu(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        $_GET['uniacid'] = 1;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = 1;
        require_once __DIR__ . '/../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../addons/ewei_shopv2/core/inc/functions.php';
        $result = m('system')->getMenu(true);
        $this->assertIsArray($result);
    }
}