<?php
declare(strict_types=1);

namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Entity\Manual\OrderRefund;

class OrderRefundFixture implements FixtureInterface
{
    public const ORDER_REFUND_LIST = [
        10 =>
            [
                'id' => 10,
                'uniacid' => 3,
                'orderid' => '351',
                'refundno' => 'SR20200113012033162395',
                'price' => '',
                'reason' => '不想要了',
                'images' => null,
                'content' => '测试退款',
                'createtime' => '1578849633',
                'status' => '0',
                'reply' => null,
                'refundtype' => '0',
                'orderprice' => '0.01',
                'applyprice' => '0.01',
                'imgs' => 'a:1:{i:0;s:51:"images/3/2020/01/nOxlazzEYnFYFSQYjLoLNSjq3Nz5fs.png";}',
                'rtype' => '1',
                'refundaddress' => null,
                'message' => null,
                'express' => '',
                'expresscom' => '',
                'expresssn' => '',
                'operatetime' => '0',
                'sendtime' => '0',
                'returntime' => '0',
                'refundtime' => '0',
                'rexpress' => '',
                'rexpresscom' => '',
                'rexpresssn' => '',
                'refundaddressid' => '0',
                'endtime' => '0',
                'realprice' => '0.00',
                'merchid' => '0',
            ],
        11 =>
            [
                'id' => 11,
                'uniacid' => 3,
                'orderid' => '365',
                'refundno' => 'SR20200113162506241672',
                'price' => '',
                'reason' => '不想要了',
                'images' => null,
                'content' => '测试退款',
                'createtime' => '1578903906',
                'status' => '3',
                'reply' => '',
                'refundtype' => '0',
                'orderprice' => '0.01',
                'applyprice' => '0.01',
                'imgs' => 'a:1:{i:0;s:51:"images/3/2020/01/o4WgQbCSA86As1g4WSz1YYcG845GST.png";}',
                'rtype' => '1',
                'refundaddress' => 'a:12:{s:2:"id";s:1:"2";s:5:"title";s:18:"杭州退货地址";s:4:"name";s:6:"小新";s:3:"tel";s:0:"";s:6:"mobile";s:10:"1368678667";s:8:"province";s:9:"浙江省";s:4:"city";s:9:"杭州市";s:4:"area";s:9:"萧山区";s:7:"address";s:27:"宁围街道民和路500号";s:7:"zipcode";s:0:"";s:7:"content";N;s:7:"merchid";s:1:"0";}',
                'message' => '',
                'express' => '',
                'expresscom' => '',
                'expresssn' => '',
                'operatetime' => '1578903948',
                'sendtime' => '0',
                'returntime' => '0',
                'refundtime' => '0',
                'rexpress' => '',
                'rexpresscom' => '',
                'rexpresssn' => '',
                'refundaddressid' => '0',
                'endtime' => '0',
                'realprice' => '0.00',
                'merchid' => '0',
            ],
        13 =>
            [
                'id' => 13,
                'uniacid' => 3,
                'orderid' => '367',
                'refundno' => 'SR20200113180529881746',
                'price' => '',
                'reason' => '不想要了',
                'images' => null,
                'content' => '换大码',
                'createtime' => '1578909929',
                'status' => '5',
                'reply' => '',
                'refundtype' => '0',
                'orderprice' => '0.01',
                'applyprice' => '0.01',
                'imgs' => 'a:1:{i:0;s:51:"images/3/2020/01/ki04KXgdJKIMccKHmimwr4ocgIWOXJ.png";}',
                'rtype' => '2',
                'refundaddress' => 'a:12:{s:2:"id";s:1:"2";s:5:"title";s:18:"杭州退货地址";s:4:"name";s:6:"小新";s:3:"tel";s:0:"";s:6:"mobile";s:10:"1368678667";s:8:"province";s:9:"浙江省";s:4:"city";s:9:"杭州市";s:4:"area";s:9:"萧山区";s:7:"address";s:27:"宁围街道民和路500号";s:7:"zipcode";s:0:"";s:7:"content";N;s:7:"merchid";s:1:"0";}',
                'message' => '',
                'express' => '',
                'expresscom' => '',
                'expresssn' => '1111',
                'operatetime' => '1578909955',
                'sendtime' => '1578909973',
                'returntime' => '1578909994',
                'refundtime' => '0',
                'rexpress' => '',
                'rexpresscom' => '',
                'rexpresssn' => '1112',
                'refundaddressid' => '0',
                'endtime' => '0',
                'realprice' => '0.00',
                'merchid' => '0',
            ],
        14 =>
            [
                'id' => 14,
                'uniacid' => 3,
                'orderid' => '374',
                'refundno' => 'SR20200225171052640066',
                'price' => '',
                'reason' => '不想要了',
                'images' => null,
                'content' => '',
                'createtime' => '1582621852',
                'status' => '0',
                'reply' => null,
                'refundtype' => '0',
                'orderprice' => '19.90',
                'applyprice' => '19.90',
                'imgs' => 'N;',
                'rtype' => '0',
                'refundaddress' => null,
                'message' => null,
                'express' => '',
                'expresscom' => '',
                'expresssn' => '',
                'operatetime' => '0',
                'sendtime' => '0',
                'returntime' => '0',
                'refundtime' => '0',
                'rexpress' => '',
                'rexpresscom' => '',
                'rexpresssn' => '',
                'refundaddressid' => '0',
                'endtime' => '0',
                'realprice' => '0.00',
                'merchid' => '2',
            ]
    ];

    public function load(ObjectManager $manager): void
    {
        pdo_run('TRUNCATE TABLE ' . OrderRefund::TABLE_NAME);
        array_map(static function ($orderRefund) {
            $values = sprintf("'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',
                '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s'",
                $orderRefund['id'], $orderRefund['uniacid'], $orderRefund['orderid'], $orderRefund['refundno'],
                $orderRefund['price'], $orderRefund['reason'], $orderRefund['images'], $orderRefund['content'],
                $orderRefund['createtime'], $orderRefund['status'], $orderRefund['reply'], $orderRefund['refundtype'],
                $orderRefund['orderprice'], $orderRefund['applyprice'], $orderRefund['imgs'], $orderRefund['rtype'],
                $orderRefund['refundaddress'], $orderRefund['message'], $orderRefund['express'],
                $orderRefund['expresscom'], $orderRefund['expresssn'], $orderRefund['operatetime'],
                $orderRefund['sendtime'], $orderRefund['returntime'], $orderRefund['refundtime'],
                $orderRefund['rexpress'], $orderRefund['rexpresscom'], $orderRefund['rexpresssn'],
                $orderRefund['refundaddressid'], $orderRefund['endtime'], $orderRefund['realprice'],
                $orderRefund['merchid']
            );
            pdo_run('INSERT INTO ' . OrderRefund::TABLE_NAME . " VALUE ($values)");
        }, array_values(self::ORDER_REFUND_LIST));
    }
}