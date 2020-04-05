<?php
declare(strict_types=1);

namespace Ydb\Test\Unit\Model;

use Ydb\Test\Unit\BaseUnitTest;

class PluginModelTest extends BaseUnitTest
{
    /**
     * 获取可用应用数量
     */
    public function testGetPluginCount(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        $_GET['uniacid'] = 1;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = 1;
        require_once __DIR__ . '/../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../addons/ewei_shopv2/core/inc/functions.php';
        $redis = redis();
        $redis->flushAll();
        $result = m('plugin')->getCount();
        $this->assertIsInt($result);
    }
}