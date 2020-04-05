<?php
            
namespace Ydb\Test\Unit\Core\Web\Store;


use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Data\Fixtures\Engine\CoreCacheFixture;
use Ydb\Data\Fixtures\Engine\CoreSettingsFixture;
use Ydb\Data\Fixtures\Engine\ModulesFixture;
use Ydb\Data\Fixtures\Engine\UsersFixture;
use Ydb\Test\Unit\BaseUnitTest;
use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class StoreVerifyControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'store.verify';
        $this->route();
    }

    public function testLog(): void
    {
        $_GET['r'] = 'store.verify.log';
        $this->route();
    }
}
