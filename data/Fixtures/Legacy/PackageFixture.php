<?php
declare(strict_types=1);

namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Entity\Manual\Package;

class PackageFixture implements FixtureInterface
{
    public const PACKAGE_LIST = [
        [
            'id' => '1',
            'uniacid' => '3',
            'title' => '优惠套餐',
            'price' => '188.00',
            'freight' => '0.00',
            'thumb' => 'images/3/2019/11/U4wAAW8aNmTafJyjFaM32m3y8yw4yI.jpg',
            'starttime' => '1582455900',
            'endtime' => '1905764700',
            'goodsid' => '74,69,70',
            'cash' => '0',
            'share_title' => '',
            'share_icon' => '',
            'share_desc' => '',
            'status' => '1',
            'deleted' => '0',
            'displayorder' => '0',
            'dispatchtype' => '0',
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        pdo_run('TRUNCATE TABLE ' . Package::TABLE_NAME);
        array_map(static function($package) {
            $values = sprintf("'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',
                '%s','%s','%s'",
                $package['id'], $package['uniacid'], $package['title'], $package['price'], $package['freight'],
                $package['thumb'], $package['starttime'], $package['endtime'], $package['goodsid'],
                $package['cash'], $package['share_title'], $package['share_icon'], $package['share_desc'],
                $package['status'], $package['deleted'], $package['displayorder'], $package['dispatchtype']
            );
            pdo_run('INSERT INTO ' . Package::TABLE_NAME . " VALUE ($values)");
        }, self::PACKAGE_LIST);
    }
}