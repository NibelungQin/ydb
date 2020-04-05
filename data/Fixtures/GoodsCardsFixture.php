<?php
declare(strict_types=1);

namespace Ydb\Data\Fixtures;


use Doctrine\Common\DataFixtures\FixtureInterface;;

use Doctrine\Persistence\ObjectManager;
use Ydb\Entity\Manual\GoodsCards;

class GoodsCardsFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $goodsCards = new GoodsCards();
        $manager->persist($goodsCards);

        $goodsCards = new GoodsCards();
        $manager->persist($goodsCards);

        $goodsCards = new GoodsCards();
        $manager->persist($goodsCards);

        $manager->flush();
    }
}