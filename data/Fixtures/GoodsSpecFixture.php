<?php
declare(strict_types=1);

namespace Ydb\Data\Fixtures;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Entity\Manual\GoodsSpec;

class GoodsSpecFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $goodsSpec = new GoodsSpec();
        $manager->persist($goodsSpec);

        $goodsSpec = new GoodsSpec();
        $manager->persist($goodsSpec);

        $goodsSpec = new GoodsSpec();
        $manager->persist($goodsSpec);

        $manager->flush();
    }
}