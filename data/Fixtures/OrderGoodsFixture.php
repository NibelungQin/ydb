<?php
declare(strict_types=1);

namespace Ydb\Data\Fixtures;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Entity\Manual\OrderGoods;

class OrderGoodsFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $orderGoods = new OrderGoods();
        $orderGoods->setExpresscom("test");
        $orderGoods->setExpresssn("test");
        $orderGoods->setExpress("test");
        $orderGoods->setSendtime(time());
        $orderGoods->setFinishtime(time());
        $orderGoods->setRemarksend("test");
        $orderGoods->setStoreid("test");
        $orderGoods->setOptime("test");
        $orderGoods->setOrdercode("test");
        $manager->persist($orderGoods);

        $orderGoods = new OrderGoods();
        $orderGoods->setExpresscom("test");
        $orderGoods->setExpresssn("test");
        $orderGoods->setExpress("test");
        $orderGoods->setSendtime(time());
        $orderGoods->setFinishtime(time());
        $orderGoods->setRemarksend("test");
        $orderGoods->setStoreid("test");
        $orderGoods->setOptime("test");
        $orderGoods->setOrdercode("test");
        $manager->persist($orderGoods);

        $orderGoods = new OrderGoods();
        $orderGoods->setExpresscom("test");
        $orderGoods->setExpresssn("test");
        $orderGoods->setExpress("test");
        $orderGoods->setSendtime(time());
        $orderGoods->setFinishtime(time());
        $orderGoods->setRemarksend("test");
        $orderGoods->setStoreid("test");
        $orderGoods->setOptime("test");
        $orderGoods->setOrdercode("test");
        $manager->persist($orderGoods);

        $manager->flush();
    }
}