<?php


namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Entity\Manual\MerchUser;

class MerchUserFixture implements FixtureInterface
{
    public const MERCH_USER_LIST = [
        1 =>
            [
                'id' => '1',
                'uniacid' => '3',
                'regid' => '0',
                'openid' => '',
                'groupid' => '1',
                'merchno' => '',
                'merchname' => '测试商户1',
                'salecate' => '商超',
                'desc' => '',
                'realname' => '联系人1',
                'mobile' => '15201010001',
                'status' => '1',
                'accounttime' => '1595606400',
                'diyformdata' => null,
                'diyformfields' => null,
                'applytime' => '0',
                'accounttotal' => '1',
                'remark' => '',
                'jointime' => '1561541842',
                'accountid' => '1',
                'sets' => 'a:1:{s:7:"diypage";a:2:{s:4:"page";a:1:{s:4:"home";s:1:"3";}s:4:"menu";a:2:{s:4:"shop";s:1:"2";s:8:"shop_wap";s:0:"";}}}',
                'logo' => '',
                'payopenid' => 'oMW005sEfHZ3wg9spRvfgFIyMoaY',
                'payrate' => '0.00',
                'isrecommand' => '1',
                'cateid' => '1',
                'address' => '浙江省杭州市萧山区浙江民营企业发展大厦B座',
                'tel' => '15201010001',
                'lat' => '30.640081424264423',
                'lng' => '121.13427131727765',
                'pluginset' => 'a:5:{s:10:"creditshop";a:1:{s:5:"close";s:1:"0";}s:5:"quick";a:1:{s:5:"close";s:1:"0";}s:6:"taobao";a:1:{s:5:"close";s:1:"0";}s:8:"exhelper";a:1:{s:5:"close";s:1:"0";}s:7:"diypage";a:1:{s:5:"close";s:1:"0";}}',
                'uname' => '',
                'upass' => '',
                'maxgoods' => '100',
                'iscredit' => '1',
                'creditrate' => '0',
                'iscreditmoney' => '1',
                'parent_openid' => '',
            ],
        2 =>
            [
                'id' => '2',
                'uniacid' => '3',
                'regid' => '0',
                'openid' => '',
                'groupid' => '1',
                'merchno' => '',
                'merchname' => '测试商户2',
                'salecate' => '服装',
                'desc' => '',
                'realname' => '联系人2',
                'mobile' => '15201010002',
                'status' => '1',
                'accounttime' => '1596729600',
                'diyformdata' => null,
                'diyformfields' => null,
                'applytime' => '0',
                'accounttotal' => '1',
                'remark' => '',
                'jointime' => '1562585403',
                'accountid' => '2',
                'sets' => 'a:2:{s:4:"shop";a:3:{s:5:"cubes";a:0:{}s:15:"indexrecommands";N;s:9:"indexsort";a:7:{s:3:"adv";a:2:{s:4:"text";s:9:"幻灯片";s:7:"visible";i:1;}s:6:"search";a:2:{s:4:"text";s:9:"搜索栏";s:7:"visible";i:1;}s:3:"nav";a:2:{s:4:"text";s:9:"导航栏";s:7:"visible";i:1;}s:6:"notice";a:2:{s:4:"text";s:9:"公告栏";s:7:"visible";i:1;}s:4:"cube";a:2:{s:4:"text";s:9:"魔方栏";s:7:"visible";i:1;}s:6:"banner";a:2:{s:4:"text";s:9:"广告栏";s:7:"visible";i:1;}s:5:"goods";a:2:{s:4:"text";s:9:"推荐栏";s:7:"visible";i:1;}}}s:4:"sale";a:4:{s:10:"enoughfree";i:1;s:11:"enoughorder";d:0;s:11:"enoughareas";s:0:"";s:16:"enoughareas_code";s:0:"";}}',
                'logo' => 'images/3/2019/07/EzxwvsJhHP1SnwanXZ5ce4cjeKAJ4a.jpg',
                'payopenid' => 'oMW005kQHCBGSWrPuj9Ugp6Y3-4s',
                'payrate' => '10.00',
                'isrecommand' => '0',
                'cateid' => '1',
                'address' => '',
                'tel' => '',
                'lat' => '',
                'lng' => '',
                'pluginset' => 'a:5:{s:10:"creditshop";a:1:{s:5:"close";s:1:"0";}s:5:"quick";a:1:{s:5:"close";s:1:"0";}s:6:"taobao";a:1:{s:5:"close";s:1:"0";}s:8:"exhelper";a:1:{s:5:"close";s:1:"0";}s:7:"diypage";a:1:{s:5:"close";s:1:"0";}}',
                'uname' => '',
                'upass' => '',
                'maxgoods' => '100',
                'iscredit' => '1',
                'creditrate' => '0',
                'iscreditmoney' => '1',
                'parent_openid' => '',
            ],
        3 =>
            [
                'id' => '3',
                'uniacid' => '3',
                'regid' => '1',
                'openid' => 'wap_user_3_15267178963',
                'groupid' => '1',
                'merchno' => '',
                'merchname' => '测试商户3',
                'salecate' => '化妆品',
                'desc' => '',
                'realname' => '联系人3',
                'mobile' => '15201010003',
                'status' => '1',
                'accounttime' => '1602259200',
                'diyformdata' => '',
                'diyformfields' => '',
                'applytime' => '1562585655',
                'accounttotal' => '1',
                'remark' => '',
                'jointime' => '1562836639',
                'accountid' => '3',
                'sets' => null,
                'logo' => '',
                'payopenid' => '',
                'payrate' => '0.00',
                'isrecommand' => '1',
                'cateid' => '1',
                'address' => '',
                'tel' => '',
                'lat' => '30.237146077055396',
                'lng' => '120.26265020412737',
                'pluginset' => 'a:5:{s:10:"creditshop";a:1:{s:5:"close";s:1:"0";}s:5:"quick";a:1:{s:5:"close";s:1:"0";}s:6:"taobao";a:1:{s:5:"close";s:1:"0";}s:8:"exhelper";a:1:{s:5:"close";s:1:"0";}s:7:"diypage";a:1:{s:5:"close";s:1:"0";}}',
                'uname' => 'test2',
                'upass' => '8n//aR66ICxY4DlwpN8',
                'maxgoods' => '100',
                'iscredit' => '1',
                'creditrate' => '0',
                'iscreditmoney' => '1',
                'parent_openid' => '',
            ],
    ];


    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE ' . MerchUser::TABLE_NAME);
        array_map(static function ($merchUser) {
            $values = sprintf("'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',
                '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',
                '%s','%s','%s','%s', '%s'",
                $merchUser['id'], $merchUser['uniacid'], $merchUser['regid'], $merchUser['openid'],
                $merchUser['groupid'], $merchUser['merchno'], $merchUser['merchname'], $merchUser['salecate'],
                $merchUser['desc'], $merchUser['realname'], $merchUser['mobile'], $merchUser['status'],
                $merchUser['accounttime'], $merchUser['diyformdata'], $merchUser['diyformfields'],
                $merchUser['applytime'], $merchUser['accounttotal'], $merchUser['remark'],
                $merchUser['jointime'], $merchUser['accountid'], $merchUser['sets'], $merchUser['logo'],
                $merchUser['payopenid'], $merchUser['payrate'], $merchUser['isrecommand'],
                $merchUser['cateid'], $merchUser['address'], $merchUser['tel'], $merchUser['lat'],
                $merchUser['lng'], $merchUser['pluginset'], $merchUser['uname'], $merchUser['upass'],
                $merchUser['maxgoods'], $merchUser['iscredit'], $merchUser['creditrate'], $merchUser['iscreditmoney'],
                $merchUser['parent_openid']
            );
            pdo_run('INSERT INTO ' . MerchUser::TABLE_NAME . " VALUE ($values)");
        }, self::MERCH_USER_LIST);
    }
}