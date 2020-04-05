<?php
declare(strict_types=1);

namespace Ydb\Data\Fixtures;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Entity\Manual\OrderPeerpay;

class OrderPeerpayFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $orderPeerPay = new OrderPeerpay();
        $manager->persist($orderPeerPay);

        $orderPeerPay = new OrderPeerpay();
        $manager->persist($orderPeerPay);

        $orderPeerPay = new OrderPeerpay();
        $manager->persist($orderPeerPay);

        $manager->flush();
    }
}