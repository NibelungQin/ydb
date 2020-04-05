<?php

namespace Ydb\Test\Unit\Plugin\Diypage\Mobile;


use RuntimeException;
use Ydb\Test\Unit\Plugin\BasePluginMobileUnitTest;

class DiypageIndexControllerTest extends BasePluginMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = '';
        $this->route(function(){
            $this->pluginSets['diypage']['page']['home']=19;
        });
    }

    public function testMember(): void
    {
        $_GET['r'] = 'member';
        $this->route();
    }

    public function testIndexMain(): void
    {
        $_GET['r'] = 'diypage.index';
        $_GET['id'] = 18;
        $this->route();
    }
}