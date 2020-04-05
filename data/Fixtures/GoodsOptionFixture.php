<?php
declare(strict_types=1);

namespace Ydb\Data\Fixtures;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Entity\Manual\GoodsOption;

class GoodsOptionFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $goodsOption = new GoodsOption();
        $goodsOption->setDay(1);
        $goodsOption->setAllfullbackprice("1.23");
        $goodsOption->setFullbackprice("2.34");
        $goodsOption->setIsfullback(1);
        $goodsOption->setIslive(1);
        $manager->persist($goodsOption);

        $goodsOption = new GoodsOption();
        $goodsOption->setDay(1);
        $goodsOption->setAllfullbackprice("1.23");
        $goodsOption->setFullbackprice("2.34");
        $goodsOption->setIsfullback(1);
        $goodsOption->setIslive(1);
        $manager->persist($goodsOption);

        $goodsOption = new GoodsOption();
        $goodsOption->setDay(1);
        $goodsOption->setAllfullbackprice("1.23");
        $goodsOption->setFullbackprice("2.34");
        $goodsOption->setIsfullback(1);
        $goodsOption->setIslive(1);
        $manager->persist($goodsOption);

        $manager->flush();
    }
}