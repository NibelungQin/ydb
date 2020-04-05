<?php


namespace Ydb\Test\Unit\Plugin;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

abstract class BasePluginWebUnitTest extends BaseShopWebUnitTest
{
    use TraitPluginUnitTest;

    public function route(\Closure $setup = null): void
    {
        parent::route(function () use ($setup) {
            $this->loadPluginFixture($setup);
        });
    }
}