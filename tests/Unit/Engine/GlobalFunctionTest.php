<?php


namespace Ydb\Test\Unit\Engine;


use Ydb\Test\Unit\BaseUnitTest;

class GlobalFunctionTest extends BaseUnitTest
{
    public function testToMedia(): void
    {
        $url = tomedia(IA_ROOT . '/addons/ewei_shopv2/icon-custom.jpg');
        $this->assertNotNull($url);
    }
}