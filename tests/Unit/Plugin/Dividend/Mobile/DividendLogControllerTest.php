<?php

namespace Ydb\Test\Unit\Plugin\Dividend\Mobile;

use Ydb\Test\Unit\Plugin\BasePluginMobileUnitTest;

class DividendLogControllerTest extends BasePluginMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'dividend.log';
        $this->route(function () {
            $this->members[125]['isheads'] = '1';
            $this->members[125]['headsstatus'] = '1';
            $this->members[125]['isagent'] = '1';
            $this->members[125]['status'] = '1';
            $this->pluginSets['dividend']['open'] = '1';
        });
    }

    public function testGetListAll(): void
    {
        $_GET['r'] = 'dividend.log.get_list';
        $_GET['page'] = '1';
        $_GET['status'] = '';
        $this->route(function () {
            $this->members[125]['isheads'] = '1';
            $this->members[125]['headsstatus'] = '1';
            $this->members[125]['isagent'] = '1';
            $this->members[125]['status'] = '1';
            $this->pluginSets['dividend']['open'] = '1';
        });
    }

    public function testGetListStatus1(): void
    {
        $_GET['r'] = 'dividend.log.get_list';
        $_GET['page'] = '1';
        $_GET['status'] = '1';
        $this->route(function () {
            $this->members[125]['isheads'] = '1';
            $this->members[125]['headsstatus'] = '1';
            $this->members[125]['isagent'] = '1';
            $this->members[125]['status'] = '1';
            $this->pluginSets['dividend']['open'] = '1';
        });
    }

    public function testGetListStatus2(): void
    {
        $_GET['r'] = 'dividend.log.get_list';
        $_GET['page'] = '1';
        $_GET['status'] = '2';
        $this->route(function () {
            $this->members[125]['isheads'] = '1';
            $this->members[125]['headsstatus'] = '1';
            $this->members[125]['isagent'] = '1';
            $this->members[125]['status'] = '1';
            $this->pluginSets['dividend']['open'] = '1';
        });
    }

    public function testGetListStatus3(): void
    {
        $_GET['r'] = 'dividend.log.get_list';
        $_GET['page'] = '1';
        $_GET['status'] = '3';
        $this->route(function () {
            $this->members[125]['isheads'] = '1';
            $this->members[125]['headsstatus'] = '1';
            $this->members[125]['isagent'] = '1';
            $this->members[125]['status'] = '1';
            $this->pluginSets['dividend']['open'] = '1';
        });
    }

    public function testGetListStatus_1(): void
    {
        $_GET['r'] = 'dividend.log.get_list';
        $_GET['page'] = '1';
        $_GET['status'] = '-1';
        $this->route(function () {
            $this->members[125]['isheads'] = '1';
            $this->members[125]['headsstatus'] = '1';
            $this->members[125]['isagent'] = '1';
            $this->members[125]['status'] = '1';
            $this->pluginSets['dividend']['open'] = '1';
        });
    }
}