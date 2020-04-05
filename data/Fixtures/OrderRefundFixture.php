<?php
declare(strict_types=1);

namespace Ydb\Data\Fixtures;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Entity\Manual\OrderRefund;

class OrderRefundFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $orderRefund = new OrderRefund();
        $manager->persist($orderRefund);

        $orderRefund = new OrderRefund();
        $manager->persist($orderRefund);

        $orderRefund = new OrderRefund();
        $manager->persist($orderRefund);

        $manager->flush();
    }
}