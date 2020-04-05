<?php
declare(strict_types=1);

namespace Ydb\Test\Unit\Model;


use Ydb\Entity\Manual\Engine\Account;
use Ydb\Entity\Manual\Engine\AccountWechats;
use Ydb\Entity\Manual\Engine\UniAccount;
use Ydb\Test\Unit\BaseUnitTest;

class MessageModelTest extends BaseUnitTest
{
    /**
     * 测试返送自定义通知
     */
    public function testSendCustomNotice(): void
    {
        pdo_run(
            'INSERT INTO ' . Account::TABLE_NAME . " VALUE (
                    '3', '3', 'nqE3UzII', '1', '1', '0', '0'
                );"
        );
        pdo_run(
            'INSERT INTO ' . AccountWechats::TABLE_NAME . " VALUE (
                    '3', '3', 'jZyombMrYu88GlUx8a8yRmYpO1eX8bA2', 'mrrnc79719c1315F9xKnp9Cg951iMPXXM7p9lnpKN1N', '4',
                    '一道电商服务', '731539803@qq.com', 'gh_5a2c328b8246', '', '', '', '', '', '', '0',
                    'wxca6b753bc095e372', 'f5bdcd15c8dc991b47c9605024e8797d', '0', '', ''
                );"
        );
        pdo_run(
            'INSERT INTO ' . UniAccount::TABLE_NAME . " VALUE (
                    '3', '0', '一道电商服务', '', '3', NULL, 'Y'
                );"
        );

        global $container;
        global $_W;
        global $_GPC;

        $_GET['uniacid'] = 3;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = 3;
        require_once __DIR__ . '/../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../addons/ewei_shopv2/core/inc/functions.php';

        $openid = 'oMW005lDg8xacovx279GSHDCMetM';
        $nickname = 'yidao';
        $credit = 100;

        $result = m('message')->sendCustomNotice($openid,
            '您的团队成员' . $nickname . '关注了公众号，为您获得了' . $credit . '积分');

        $this->assertNotNull($result);
    }

}