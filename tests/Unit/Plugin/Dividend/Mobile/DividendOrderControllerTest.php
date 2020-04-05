<?php


namespace Ydb\Test\Unit\Plugin\Dividend\Mobile;


use Ydb\Test\Unit\Plugin\BasePluginMobileUnitTest;

class DividendOrderControllerTest extends BasePluginMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'dividend.order';
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
        $_GET['r'] = 'dividend.order.get_list';
        $_GET['status'] = '';
        $_GET['page'] = '1';
        $this->route(function () {
            $this->members[125]['isheads'] = '1';
            $this->members[125]['headsstatus'] = '1';
            $this->members[125]['isagent'] = '1';
            $this->members[125]['status'] = '1';
            $this->pluginSets['dividend']['open'] = '1';
        });
    }

    public function testGetListStatus0(): void
    {
        $_GET['r'] = 'dividend.order.get_list';
        $_GET['status'] = '0';
        $_GET['page'] = '1';
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
        $_GET['r'] = 'dividend.order.get_list';
        $_GET['status'] = '1';
        $_GET['page'] = '1';
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
        $_GET['r'] = 'dividend.order.get_list';
        $_GET['status'] = '3';
        $_GET['page'] = '1';
        $this->route(function () {
            $this->members[125]['isheads'] = '1';
            $this->members[125]['headsstatus'] = '1';
            $this->members[125]['isagent'] = '1';
            $this->members[125]['status'] = '1';
            $this->pluginSets['dividend']['open'] = '1';
        });
    }
}