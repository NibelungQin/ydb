<?php
declare(strict_types=1);

namespace Ydb\Data\Fixtures;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Entity\Manual\OrderPrint;

class OrderPrintFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $orderPrint = new OrderPrint();
        $manager->persist($orderPrint);

        $orderPrint = new OrderPrint();
        $manager->persist($orderPrint);

        $orderPrint = new OrderPrint();
        $manager->persist($orderPrint);

        $manager->flush();
    }
}