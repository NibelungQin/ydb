<?php


namespace Ydb\Test\Unit\Plugin\Sns\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class SnsBoardControllerTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'sns.board';
        $this->route();
    }

    public function testAdd(): void
    {
        $_GET['r'] = 'sns.board.add';
        $this->route();
    }

    public function testEdit(): void
    {
        $_GET['r'] = 'sns.board.edit';
        $_GET['id'] = '1';
        $this->route();
    }

    public function testEditPost(): void
    {
        $_GET['r'] = 'sns.board.edit';
        $_GET['id'] = '1';
        $_POST['id'] = '1';
        $_POST['tab'] = '#tab_basic';
        $_POST['displayorder'] = '0';
        $_POST['cid'] = '1';
        $_POST['title'] = '饮食养生';
        $_POST['logo'] = 'images/3/2020/03/Npxrw76wyaQ6Q7Tlc5x7QaRxYzcCcD.jpg';
        $_POST['desc'] = '药补不如食补人们的日常生活离不开每日三餐，如何合理地调配饮食，使之更有利于人体健康、滋补养生，是每个人都应该学会关注的健康常识！';
        $_POST['banner'] = 'images/3/2020/03/Ro1HLuUbl1U5ZUozBOod5Ubx6qOZzN.jpg';
        $_POST['noimage'] = '0';
        $_POST['needcheck'] = '1';
        $_POST['needcheckmanager'] = '1';
        $_POST['needcheckreply'] = '1';
        $_POST['needcheckreplymanager'] = '1';
        $_POST['keyword'] = '饮食养生';
        $_POST['isrecommand'] = '1';
        $_POST['openid_text'] = ' 你好';
        $_POST['openid'] = ['sns_wa_o2nA_5enrJMB4keX28rNEEEh0fzA'];
        $_POST['status'] = '1';
        $_POST['postcredit'] = '0';
        $_POST['replycredit'] = '0';
        $_POST['bestboardcredit'] = '0';
        $_POST['bestcredit'] = '0';
        $_POST['topboardcredit'] = '0';
        $_POST['topcredit'] = '0';
        $_POST['needpostfollow'] = '0';
        $_POST['share_title'] = '';
        $_POST['share_icon'] = '';
        $_POST['share_desc'] = '';
        $_POST['notagent'] = '0';
        $_POST['notagentpost'] = '0';
        $_POST['notpartner'] = '0';
        $_POST['notglobonuspost'] = '0';
        $this->post();
        $this->route();
    }

    public function testDelete(): void
    {
        $_GET['r'] = 'sns.board.delete';
        $_GET['id'] = '1';
        $this->route();
    }

    public function testDisplayOrder(): void
    {
        $_GET['r'] = 'sns.board.displayorder';
        $_GET['id'] = '1';
        $_POST['value'] = '100';
        $this->post();
        $this->route();
    }

    public function testStatus(): void
    {
        $_GET['r'] = 'sns.board.status';
        $_GET['status'] = '0';
        $_GET['id'] = '1';
        $this->route();
    }
}