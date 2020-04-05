<?php
declare(strict_types=1);

namespace Ydb\Data\Fixtures;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Entity\Manual\OrderPeerpayPayinfo;

class OrderPeerpayPayinfoFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $orderPeerpayPayinfo = new OrderPeerpayPayinfo();
        $manager->persist($orderPeerpayPayinfo);

        $orderPeerpayPayinfo = new OrderPeerpayPayinfo();
        $manager->persist($orderPeerpayPayinfo);

        $orderPeerpayPayinfo = new OrderPeerpayPayinfo();
        $manager->persist($orderPeerpayPayinfo);

        $manager->flush();
    }
}