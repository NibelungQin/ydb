<?php


namespace Ydb\Test\Unit\Plugin\Sns\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class SnsMemberControllerTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'sns.member';
        $this->route();
    }

    public function testDelete(): void
    {
        $_GET['r'] = 'sns.member.delete';
        $_GET['id'] = '3';
        $this->route();
    }

    public function testSetBlack(): void
    {
        $_GET['r'] = 'sns.member.setblack';
        $_GET['id'] = '3';
        $this->route();
    }
}