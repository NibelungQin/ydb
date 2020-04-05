<?php
declare(strict_types=1);

namespace Ydb\Data\Fixtures;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Entity\Manual\OrderSingleRefund;

class OrderSingleRefundFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $orderSingleRefund = new OrderSingleRefund();
        $manager->persist($orderSingleRefund);

        $orderSingleRefund = new OrderSingleRefund();
        $manager->persist($orderSingleRefund);

        $orderSingleRefund = new OrderSingleRefund();
        $manager->persist($orderSingleRefund);

        $manager->flush();
    }
}