<?php
            
namespace Ydb\Test\Unit\Core\Web\Util;


use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Data\Fixtures\Engine\CoreCacheFixture;
use Ydb\Data\Fixtures\Engine\CoreSettingsFixture;
use Ydb\Data\Fixtures\Engine\ModulesFixture;
use Ydb\Data\Fixtures\Engine\UsersFixture;
use Ydb\Test\Unit\BaseUnitTest;
use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class UtilSelecticon3ControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'util.selecticon3';
        $this->route();
    }
}
