<?php
declare(strict_types=1);

namespace Ydb\Data\Fixtures\Legacy;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Entity\Manual\GoodsSpecItem;

class GoodsSpecItemFixture implements FixtureInterface
{
    public const GOODS_SPEC_ITEM_LIST = array(
        0 =>
            array(
                'id' => '54',
                'uniacid' => '3',
                'specid' => '17',
                'title' => '干性皮肤',
                'thumb' => '',
                'show' => '1',
                'displayorder' => '2',
                'valueId' => '',
                'virtual' => '0',
                'cycelbuy_periodic' => '',
            ),
        1 =>
            array(
                'id' => '52',
                'uniacid' => '3',
                'specid' => '17',
                'title' => '油性皮肤',
                'thumb' => '',
                'show' => '1',
                'displayorder' => '0',
                'valueId' => '',
                'virtual' => '0',
                'cycelbuy_periodic' => '',
            ),
        2 =>
            array(
                'id' => '53',
                'uniacid' => '3',
                'specid' => '17',
                'title' => '混合型皮肤',
                'thumb' => '',
                'show' => '1',
                'displayorder' => '1',
                'valueId' => '',
                'virtual' => '0',
                'cycelbuy_periodic' => '',
            ),
        3 =>
            array(
                'id' => '51',
                'uniacid' => '3',
                'specid' => '16',
                'title' => '500ml',
                'thumb' => '',
                'show' => '1',
                'displayorder' => '1',
                'valueId' => '',
                'virtual' => '0',
                'cycelbuy_periodic' => '',
            ),
        4 =>
            array(
                'id' => '50',
                'uniacid' => '3',
                'specid' => '16',
                'title' => '200ml',
                'thumb' => '',
                'show' => '1',
                'displayorder' => '0',
                'valueId' => '',
                'virtual' => '0',
                'cycelbuy_periodic' => '',
            ),
        5 =>
            array(
                'id' => '48',
                'uniacid' => '3',
                'specid' => '15',
                'title' => '炫彩黑',
                'thumb' => '',
                'show' => '1',
                'displayorder' => '2',
                'valueId' => '',
                'virtual' => '0',
                'cycelbuy_periodic' => '',
            ),
        6 =>
            array(
                'id' => '49',
                'uniacid' => '3',
                'specid' => '15',
                'title' => '玫瑰金',
                'thumb' => '',
                'show' => '1',
                'displayorder' => '3',
                'valueId' => '',
                'virtual' => '0',
                'cycelbuy_periodic' => '',
            ),
        7 =>
            array(
                'id' => '46',
                'uniacid' => '3',
                'specid' => '15',
                'title' => '浅蓝',
                'thumb' => '',
                'show' => '1',
                'displayorder' => '0',
                'valueId' => '',
                'virtual' => '0',
                'cycelbuy_periodic' => '',
            ),
        8 =>
            array(
                'id' => '47',
                'uniacid' => '3',
                'specid' => '15',
                'title' => '芭比红',
                'thumb' => '',
                'show' => '1',
                'displayorder' => '1',
                'valueId' => '',
                'virtual' => '0',
                'cycelbuy_periodic' => '',
            ),
        9 =>
            array(
                'id' => '59',
                'uniacid' => '3',
                'specid' => '19',
                'title' => '大',
                'thumb' => '',
                'show' => '1',
                'displayorder' => '0',
                'valueId' => '',
                'virtual' => '0',
                'cycelbuy_periodic' => '',
            ),
        10 =>
            array(
                'id' => '60',
                'uniacid' => '3',
                'specid' => '20',
                'title' => '小',
                'thumb' => '',
                'show' => '1',
                'displayorder' => '0',
                'valueId' => '',
                'virtual' => '0',
                'cycelbuy_periodic' => '',
            )
    );

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE ' . GoodsSpecItem::TABLE_NAME);
        array_map(static function ($goodsSpecItem) {
            $values = sprintf("'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s'",
                $goodsSpecItem['id'], $goodsSpecItem['uniacid'], $goodsSpecItem['specid'],
                $goodsSpecItem['title'], $goodsSpecItem['thumb'], $goodsSpecItem['show'],
                $goodsSpecItem['displayorder'], $goodsSpecItem['valueId'], $goodsSpecItem['virtual'],
                $goodsSpecItem['cycelbuy_periodic']
            );
            pdo_run('INSERT INTO ' . GoodsSpecItem::TABLE_NAME . " VALUE ($values)");
        }, self::GOODS_SPEC_ITEM_LIST);
    }
}