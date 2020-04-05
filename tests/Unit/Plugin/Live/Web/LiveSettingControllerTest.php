<?php


namespace Ydb\Test\Unit\Plugin\Live\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class LiveSettingControllerTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'live.setting';
        $this->route();
    }

    public function testPost(): void
    {
        $_GET['r'] = 'live.setting';
        $_POST['tab'] = '';
        $_POST['data'] = [
            'ismember' => '0',
            'share_title' => '',
            'share_icon' => '',
            'share_desc' => '',
            'share_url' => ''
        ];
        $this->post();
        $this->route();
    }
}