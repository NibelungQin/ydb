<?php


namespace Ydb\Test\Unit\Core\Web\Store;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class StoreIndexControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'store';
        $this->route();
    }

    public function testAdd(): void
    {
        $_GET['r'] = 'store.add';
        $this->route();
    }

    public function testEdit(): void
    {
        $_GET['r'] = 'store.edit';
        $_GET['id'] = '3';
        $_POST['id'] = '3';
        $_POST['storename'] = '一道电商';
        $_POST['logo'] = 'images/3/2019/07/pf8dOApiVAPfaXO6242BFdP6ndpao8.jpg';
        $_POST['province'] = '浙江省';
        $_POST['city'] = '杭州市';
        $_POST['area'] = '萧山区';
        $_POST['street'] = '城厢街道';
        $_POST['chose_province_code'] = '330000';
        $_POST['chose_city_code'] = '330100';
        $_POST['chose_area_code'] = '330109';
        $_POST['tel'] = '13164991551';
        $_POST['saletime'] = '';
        $_POST['map'] = [
            'lng' => '120.2634617152941',
            'lat' => '30.23777055532508'
        ];
        $_POST['address'] = '民营企业大厦B幢17楼';
        $_POST['type'] = '3';
        $_POST['realname'] = '';
        $_POST['mobile'] = '';
        $_POST['desc'] = '';
        $_POST['status'] = '1';
        $_POST['order_printer_text'] = '';
        $_POST['order_template'] = '选择您需要的订单打印模板';
        $this->post();
        $this->route();
    }

    public function testDisplayOrder(): void
    {
        $_GET['r'] = 'store.displayorder';
        $_GET['id'] = '3';
        $_POST['value'] = '100';
        $this->post();
        $this->route();
    }

    public function testStatus(): void
    {
        $_GET['r'] = 'store.status';
        $_GET['status'] = '0';
        $_GET['id'] = '3';
        $this->route();
    }

    public function testDelete(): void
    {
        $_GET['r'] = 'store.delete';
        $_GET['id'] = '3';
        $this->route();
    }

    public function testQuery(): void
    {
        $_GET['r'] = 'store.query';
        $_GET['keyword'] = '一道';
        $this->route();
    }
}