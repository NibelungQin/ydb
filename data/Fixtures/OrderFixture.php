<?php
declare(strict_types=1);

namespace Ydb\Data\Fixtures;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Entity\Manual\Order;

class OrderFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $order = new Order();
        $manager->persist($order);

        $order = new Order();
        $manager->persist($order);

        $order = new Order();
        $manager->persist($order);

        $manager->flush();
    }
}