<?php


namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Entity\Manual\SnsBoard;

class SnsBoardFixture implements FixtureInterface
{
    public const BOARD_LIST = [
        1 =>
            [
                'id' => 1,
                'uniacid' => 3,
                'cid' => '1',
                'title' => '饮食养生',
                'logo' => 'images/3/2020/03/Npxrw76wyaQ6Q7Tlc5x7QaRxYzcCcD.jpg',
                'desc' => '药补不如食补人们的日常生活离不开每日三餐，如何合理地调配饮食，使之更有利于人体健康、滋补养生，是每个人都应该学会关注的健康常识！',
                'displayorder' => '0',
                'enabled' => '0',
                'showgroups' => '',
                'showlevels' => '',
                'postgroups' => '',
                'postlevels' => '',
                'showagentlevels' => '',
                'postagentlevels' => '',
                'postcredit' => '0',
                'replycredit' => '0',
                'bestcredit' => '0',
                'bestboardcredit' => '0',
                'notagent' => '0',
                'notagentpost' => '0',
                'topcredit' => '0',
                'topboardcredit' => '0',
                'status' => '1',
                'noimage' => '0',
                'novoice' => '0',
                'needfollow' => '0',
                'needpostfollow' => '0',
                'share_title' => '',
                'share_icon' => '',
                'share_desc' => '',
                'keyword' => '饮食养生',
                'isrecommand' => '1',
                'banner' => 'images/3/2020/03/Ro1HLuUbl1U5ZUozBOod5Ubx6qOZzN.jpg',
                'needcheck' => '1',
                'needcheckmanager' => '1',
                'needcheckreply' => '1',
                'needcheckreplymanager' => '1',
                'showsnslevels' => '',
                'postsnslevels' => '',
                'showpartnerlevels' => '',
                'postpartnerlevels' => '',
                'notpartner' => '0',
                'notpartnerpost' => '0',
            ],
    ];

    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE ' . SnsBoard::TABLE_NAME);
        array_map(static function($board) {
            $values = sprintf("'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',
                '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',
                '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s'",
                $board['id'], $board['uniacid'], $board['cid'], $board['title'], $board['logo'],
                $board['desc'], $board['displayorder'], $board['enabled'], $board['showgroups'],
                $board['showlevels'], $board['postgroups'], $board['postlevels'], $board['showagentlevels'],
                $board['postagentlevels'], $board['postcredit'], $board['replycredit'], $board['bestcredit'],
                $board['bestboardcredit'], $board['notagent'], $board['notagentpost'], $board['topcredit'],
                $board['topboardcredit'], $board['status'], $board['noimage'], $board['novoice'],
                $board['needfollow'], $board['needpostfollow'], $board['share_title'],
                $board['share_icon'], $board['share_desc'], $board['keyword'], $board['isrecommand'],
                $board['banner'], $board['needcheck'], $board['needcheckmanager'], $board['needcheckreply'],
                $board['needcheckreplymanager'], $board['showsnslevels'], $board['postsnslevels'],
                $board['showpartnerlevels'], $board['postpartnerlevels'], $board['notpartner'],
                $board['notpartnerpost']
            );
            pdo_run('INSERT INTO ' . SnsBoard::TABLE_NAME . " VALUE ($values)");
        }, array_values(self::BOARD_LIST));
    }
}