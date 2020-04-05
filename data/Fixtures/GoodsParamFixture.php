<?php
declare(strict_types=1);

namespace Ydb\Data\Fixtures;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Entity\Manual\GoodsParam;

class GoodsParamFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $goodsParam = new GoodsParam();
        $manager->persist($goodsParam);

        $goodsParam = new GoodsParam();
        $manager->persist($goodsParam);

        $goodsParam = new GoodsParam();
        $manager->persist($goodsParam);

        $manager->flush();
    }
}