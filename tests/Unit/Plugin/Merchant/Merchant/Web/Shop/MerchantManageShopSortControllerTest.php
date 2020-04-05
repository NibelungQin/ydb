<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Merchant\Web\Shop;


use Ydb\Test\Unit\Plugin\Merchant\Merchant\BaseMerchantWebUnitTest;

class MerchantManageShopSortControllerTest extends BaseMerchantWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'shop.sort';
        $this->route();
    }

    public function testPost(): void
    {
        $_GET['r'] = 'shop.sort';
        $_POST['visible'] = [
            'adv' => '1',
            'search' => '1',
            'nav' => '1',
            'notice' => '1',
            'cube' => '1',
            'banner' => '1',
            'goods' => '1'
        ];
        $_POST['token'] = '';
        $_POST['datas'] = '[{"id":"adv"},{"id":"search"},{"id":"nav"},{"id":"notice"},{"id":"cube"},{"id":"banner"},{"id":"goods"}]';
        $this->post();
        $this->route();
    }
}