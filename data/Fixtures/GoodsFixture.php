<?php
declare(strict_types=1);

namespace Ydb\Data\Fixtures;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Entity\Manual\Goods;

class GoodsFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $goods = new Goods();
        $goods->setTitle("test");
        $goods->setPresellovertime(time());
        $goods->setEdareasCode("10000");
        $manager->persist($goods);

        $goods = new Goods();
        $goods->setTitle("test");
        $goods->setPresellovertime(time());
        $goods->setEdareasCode("10000");
        $manager->persist($goods);

        $goods = new Goods();
        $goods->setTitle("test");
        $goods->setPresellovertime(time());
        $goods->setEdareasCode("10000");
        $manager->persist($goods);

        $manager->flush();
    }
}