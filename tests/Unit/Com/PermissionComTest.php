<?php
declare(strict_types=1);

use Ydb\Test\Unit\BaseUnitTest;

class PermissionComTest extends BaseUnitTest
{
    public function testAllPermissions(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        $_GET['uniacid'] = 1;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = 1;
        require_once __DIR__ . '/../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../addons/ewei_shopv2/core/inc/functions.php';

        require_once __DIR__ . '/../../../addons/ewei_shopv2/core/inc/com_model.php';
        require_once __DIR__ . '/../../../addons/ewei_shopv2/core/com/perm.php';

        $permissionModel = new Perm_EweiShopV2ComModel();
        $this->assertIsArray($permissionModel->allPerms());
    }
}