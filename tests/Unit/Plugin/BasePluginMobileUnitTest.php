<?php


namespace Ydb\Test\Unit\Plugin;

use Ydb\Test\Unit\Core\Mobile\BaseShopMobileUnitTest;

abstract class BasePluginMobileUnitTest extends BaseShopMobileUnitTest
{
    use TraitPluginUnitTest;

    public function route(\Closure $setup = null): void
    {
        parent::route(function () use ($setup) {
            $this->loadPluginFixture($setup);
        });
    }
}
