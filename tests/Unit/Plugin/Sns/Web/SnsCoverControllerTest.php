<?php


namespace Ydb\Test\Unit\Plugin\Sns\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class SnsCoverControllerTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'sns.cover';
        $this->route();
    }

    public function testMainPost(): void
    {
        $_GET['r'] = 'sns.cover';
        $_POST['cover'] = [
            'keyword' => '123',
            'title' => '健康生活',
            'thumb' => 'images/3/2020/03/eOdq47WssSqz1kXHtDSJ7WzSI4HL3Q.jpg',
            'desc' => '爱生活爱健康',
            'status' => '1',
        ];
        $this->post();
        $this->route();
    }
}