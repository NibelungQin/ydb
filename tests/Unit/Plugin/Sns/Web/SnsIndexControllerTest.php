<?php


namespace Ydb\Test\Unit\Plugin\Sns\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class SnsIndexControllerTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'sns';
        $this->route();
    }

    public function testData(): void
    {
        $_GET['r'] = 'sns.index.data';
        $this->route();
    }

    public function testNotice(): void
    {
        $_GET['r'] = 'sns.notice';
        $this->route();
    }

    public function testSet(): void
    {
        $_GET['r'] = 'sns.set';
        $this->route(function () {
            $this->pluginSets['sns']['managers'] = 'oMW005lDg8xacovx279GSHDCMetM,oMW005kQHCBGSWrPuj9Ugp6Y3-4s';
        });
    }

    public function testSetPost(): void
    {
        $_GET['r'] = 'sns.set';
        $_POST['managers_text'] = 'madhatter;  叶子;';
        $_POST['managers'] = ['oMW005lDg8xacovx279GSHDCMetM', 'oMW005kQHCBGSWrPuj9Ugp6Y3-4s'];
        $_POST['data'] = [
            'imagesnum' => '0',
            'banner' => '../addons/ewei_shopv2/plugin/sns/static/images/banner.png',
            'avatar' => '../addons/ewei_shopv2/plugin/sns/static/images/head.jpg',
            'leveltype' => '0',
            'followtip' => '',
            'crediturl' => '',
            'followurl' => '',
            'share_title' => '',
            'share_icon' => '',
            'share_desc' => '',
            'style' => 'default'
        ];
        $this->post();
        $this->route();
    }

}