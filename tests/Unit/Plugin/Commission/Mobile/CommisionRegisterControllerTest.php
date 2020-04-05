<?php


namespace Ydb\Test\Unit\Plugin\Commission\Mobile;


use Ydb\Test\Unit\Plugin\BasePluginMobileUnitTest;

class CommisionRegisterControllerTest extends BasePluginMobileUnitTest
{
    public function testMain(): void
    {


        $_GET['i'] = '3';
        $_GET['c'] = 'entry';
        $_GET['m'] ='ewei_shopv2';
        $_GET['do'] = 'mobile';
        $_GET['r'] = 'commission.register';
        $this->route();
    }
}