<?php


namespace Ydb\Test\Unit\Plugin\Live\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class LiveRoomControllerTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'live.room';
        $this->route();
    }

    public function testAdd(): void
    {
        $_GET['r'] = 'live.room.add';
        $this->route();
    }

    public function testAddPost(): void
    {
        $_GET['r'] = 'live.room.add';
        $_POST['tab'] = '';
        $_POST['displayorder'] = '0';
        $_POST['title'] = '测试直播';
        $_POST['category'] = '1';
        $_POST['livetime'] = '2020-02-03 20:30:00';
        $_POST['livetype'] = '1';
        $_POST['screen'] = '0';
        $_POST['liveidentity'] = 'yizhibo';
        $_POST['url'] = 'https://www.yizhibo.com/l/ZQD8guXtodmSuFtV.html?p_from=Phome_Feature4';
        $_POST['video'] = '';
        $_POST['covertype'] = '0';
        $_POST['thumb'] = 'https://alcdn.img.xiaoka.tv/20200203/7ad/85c/35616279/7ad85cf14b73701d9c270853710a33f7.jpg';
        $_POST['cover'] = '';
        $_POST['recommend'] = '1';
        $_POST['hot'] = '1';
        $_POST['status'] = '1';
        $_POST['nestable'] = [
            'interaction',
            'goods',
            'introduce'
        ];
        $_POST['dtab'] = [
            'tabtitle' => '直播间',
            'goodstitle' => '商品',
            'goodstitleshow' => '0',
            'introducetitle' => '介绍',
            'introducetitleshow' => '0',

            'customname1' => '自定义',
            'customtype1' => '0',
            'customurl1' => '',
            'customintroduce1' => '',
            'customname2' => '自定义',
            'customtype2' => '0',
            'customurl2' => '',
            'customintroduce2' => '',
            'customname3' => '自定义',
            'customtype3' => '0',
            'customurl3' => '',
            'customintroduce3' => '',
            'customname4' => '自定义',
            'customtype4' => '0',
            'customurl4' => '',
            'customintroduce4' => ''
        ];
        $_POST['introduce'] = '';
        $_POST['goodsarr'] = '{}';
        $_POST['goodsgroup'] = '0';
        $_POST['iscoupon'] = '0';
        $_POST['couponid_text'] = '';
        $_POST['jurisdiction_url'] = '';
        $_POST['invitation_id'] = '';
        $_POST['notice'] = '';
        $_POST['notice_url'] = '';
        $_POST['followqrcode'] = '';
        $_POST['share_title'] = '';
        $_POST['share_icon'] = '';
        $_POST['share_desc'] = '';
        $this->post();
        $this->route();
    }

    public function testDelete(): void
    {
        $_GET['r'] = 'live.room.deleted';
        $_POST['id'] = '1';
        $this->post();
        $this->route();
    }

    public function testPropertyStatus(): void
    {
        $_GET['r'] = 'live.room.property';
        $_GET['type'] = 'status';
        $_GET['value'] = '0';
        $_GET['id'] = '1';
        $this->route();
    }

    public function testPropertyRecommend(): void
    {
        $_GET['r'] = 'live.room.property';
        $_GET['type'] = 'recommend';
        $_GET['value'] = '0';
        $_GET['id'] = '1';
        $this->route();
    }

    public function testPropertyHot(): void
    {
        $_GET['r'] = 'live.room.property';
        $_GET['type'] = 'hot';
        $_GET['value'] = '0';
        $_GET['id'] = '1';
        $this->route();
    }

    public function testPropertyDisplayOrder(): void
    {
        $_GET['r'] = 'live.room.property';
        $_GET['id'] = '1';
        $_POST['value'] = '1';
        $this->post();
        $this->route();
    }

    public function testStatistics(): void
    {
        $_GET['r'] = 'live.room.statistics';
        $_GET['roomid'] = '1';
        $this->route();
    }

    public function testConsole(): void
    {
        $_GET['r'] = 'live.room.console';
        $_GET['id'] = '1';
        $this->route();
    }
}