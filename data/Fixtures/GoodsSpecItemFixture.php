<?php
declare(strict_types=1);

namespace Ydb\Data\Fixtures;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Entity\Manual\GoodsSpecItem;

class GoodsSpecItemFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $goodsSpecItem = new GoodsSpecItem();
        $manager->persist($goodsSpecItem);

        $goodsSpecItem = new GoodsSpecItem();
        $manager->persist($goodsSpecItem);

        $goodsSpecItem = new GoodsSpecItem();
        $manager->persist($goodsSpecItem);

        $manager->flush();
    }
}