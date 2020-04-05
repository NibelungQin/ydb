<?php
declare(strict_types=1);

namespace Ydb\Data\Fixtures;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Entity\Manual\GoodsLabelstyle;

class GoodsLabelStyleFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $goodsLabelStyle = new GoodsLabelStyle();
        $goodsLabelStyle->setUniacid(1);
        $goodsLabelStyle->setStyle(1);
        $manager->persist($goodsLabelStyle);

        $goodsLabelStyle = new GoodsLabelStyle();
        $goodsLabelStyle->setUniacid(1);
        $goodsLabelStyle->setStyle(1);
        $manager->persist($goodsLabelStyle);

        $goodsLabelStyle = new GoodsLabelStyle();
        $goodsLabelStyle->setUniacid(1);
        $goodsLabelStyle->setStyle(1);
        $manager->persist($goodsLabelStyle);

        $manager->flush();
    }
}