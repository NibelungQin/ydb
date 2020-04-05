<?php
declare(strict_types=1);

namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Entity\Manual\Live;

class LiveFixture implements FixtureInterface
{
    public const LIVE_LIST = [
        0 =>
            [
                'id' => '1',
                'uniacid' => '3',
                'merchid' => '0',
                'title' => '测试直播',
                'livetype' => '1',
                'liveidentity' => 'yizhibo',
                'screen' => '0',
                'goodsid' => '',
                'category' => '1',
                'url' => 'https://www.yizhibo.com/l/ZQD8guXtodmSuFtV.html?p_from=Phome_Feature4',
                'thumb' => 'https://alcdn.img.xiaoka.tv/20200203/7ad/85c/35616279/7ad85cf14b73701d9c270853710a33f7.jpg',
                'hot' => '1',
                'recommend' => '1',
                'living' => '1',
                'status' => '1',
                'displayorder' => '0',
                'livetime' => '1580733000',
                'lastlivetime' => '0',
                'createtime' => '1580734953',
                'introduce' => '',
                'packetmoney' => '0.00',
                'packettotal' => '0',
                'packetprice' => '0.00',
                'packetdes' => '',
                'couponid' => '0',
                'share_title' => '',
                'share_icon' => '',
                'share_desc' => '',
                'share_url' => '',
                'subscribe' => '0',
                'subscribenotice' => '0',
                'visit' => '5',
                'video' => '',
                'covertype' => '0',
                'cover' => '',
                'iscoupon' => '0',
                'nestable' => 'a:3:{i:0;s:11:"interaction";i:1;s:5:"goods";i:2;s:9:"introduce";}',
                'tabs' => 'a:3:{s:11:"interaction";a:2:{s:4:"name";s:9:"直播间";s:6:"isshow";i:1;}s:5:"goods";a:2:{s:4:"name";s:6:"商品";s:6:"isshow";i:0;}s:9:"introduce";a:2:{s:4:"name";s:6:"介绍";s:6:"isshow";i:0;}}',
                'invitation_id' => '0',
                'showlevels' => '',
                'showgroups' => '',
                'showcommission' => '',
                'jurisdiction_url' => '',
                'jurisdictionurl_show' => '0',
                'notice' => '',
                'notice_url' => '',
                'followqrcode' => '',
                'coupon_num' => '0',
            ],
    ];

    public function load(ObjectManager $manager): void
    {
        pdo_run('TRUNCATE TABLE ' . Live::TABLE_NAME);
        array_map(static function ($live) {
            $values = sprintf("'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',
                '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',
                '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s'",
                $live['id'], $live['uniacid'], $live['merchid'], $live['title'], $live['livetype'],
                $live['liveidentity'], $live['screen'], $live['goodsid'], $live['category'], $live['url'],
                $live['thumb'], $live['hot'], $live['recommend'], $live['living'], $live['status'],
                $live['displayorder'], $live['livetime'], $live['lastlivetime'], $live['createtime'],
                $live['introduce'], $live['packetmoney'], $live['packettotal'], $live['packetprice'],
                $live['packetdes'], $live['couponid'], $live['share_title'], $live['share_icon'],
                $live['share_desc'], $live['share_url'], $live['subscribe'], $live['subscribenotice'],
                $live['visit'], $live['video'], $live['covertype'], $live['cover'], $live['iscoupon'],
                $live['nestable'], $live['tabs'], $live['invitation_id'], $live['showlevels'], $live['showgroups'],
                $live['showcommission'], $live['jurisdiction_url'], $live['jurisdictionurl_show'], $live['notice'],
                $live['notice_url'], $live['followqrcode'], $live['coupon_num']
            );
            pdo_run('INSERT INTO ' . Live::TABLE_NAME . " VALUE ($values)");
        }, self::LIVE_LIST);
    }
}