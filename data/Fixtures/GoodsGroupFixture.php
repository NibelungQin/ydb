<?php
declare(strict_types=1);

namespace Ydb\Data\Fixtures;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Entity\Manual\GoodsGroup;

class GoodsGroupFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $goodsGroup = new GoodsGroup();
        $manager->persist($goodsGroup);

        $goodsGroup = new GoodsGroup();
        $manager->persist($goodsGroup);

        $goodsGroup = new GoodsGroup();
        $manager->persist($goodsGroup);

        $manager->flush();
    }
}