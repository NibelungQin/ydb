<?php
declare(strict_types=1);

namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Entity\Manual\PackageGoodsOption;

class PackageGoodsOptionFixture implements FixtureInterface
{
    public const PACKAGE_GOODS_OPTION_LIST = [
        0 =>
            [
                'id' => '35',
                'uniacid' => '3',
                'goodsid' => '74',
                'optionid' => '96',
                'pid' => '1',
                'title' => '500ml+干性皮肤+玫瑰金',
                'packageprice' => '0.01',
                'marketprice' => '0.01',
                'commission1' => '0.00',
                'commission2' => '0.00',
                'commission3' => '0.00',
            ],
        1 =>
            [
                'id' => '36',
                'uniacid' => '3',
                'goodsid' => '69',
                'optionid' => '101',
                'pid' => '1',
                'title' => '大+小',
                'packageprice' => '12.00',
                'marketprice' => '12.00',
                'commission1' => '2.00',
                'commission2' => '1.00',
                'commission3' => '0.00',
            ]
    ];

    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE ' . PackageGoodsOption::TABLE_NAME);
        array_map(static function($packageGoodsOption) {
            $values = sprintf("'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s'",
                $packageGoodsOption['id'], $packageGoodsOption['uniacid'], $packageGoodsOption['goodsid'],
                $packageGoodsOption['optionid'], $packageGoodsOption['pid'], $packageGoodsOption['title'],
                $packageGoodsOption['packageprice'], $packageGoodsOption['marketprice'],
                $packageGoodsOption['commission1'], $packageGoodsOption['commission2'],
                $packageGoodsOption['commission3']
            );
            pdo_run('INSERT INTO ' . PackageGoodsOption::TABLE_NAME . " VALUE ($values)");
        }, self::PACKAGE_GOODS_OPTION_LIST);
    }
}