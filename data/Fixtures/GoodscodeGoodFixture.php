<?php
declare(strict_types=1);

namespace Ydb\Data\Fixtures;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ydb\Entity\Manual\GoodscodeGood;

class GoodscodeGoodFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $goodscodeGood = new GoodscodeGood();
        $goodscodeGood->setUniacid(1);
        $goodscodeGood->setGoodsid(1);
        $goodscodeGood->setTitle("test");
        $goodscodeGood->setThumb("path/to/thumb");
        $goodscodeGood->setQrcode("qrcode");
        $goodscodeGood->setStatus(1);
        $goodscodeGood->setDisplayorder(1);
        $manager->persist($goodscodeGood);

        $goodscodeGood = new GoodscodeGood();
        $goodscodeGood->setUniacid(1);
        $goodscodeGood->setGoodsid(1);
        $goodscodeGood->setTitle("test");
        $goodscodeGood->setThumb("path/to/thumb");
        $goodscodeGood->setQrcode("qrcode");
        $goodscodeGood->setStatus(1);
        $goodscodeGood->setDisplayorder(1);
        $manager->persist($goodscodeGood);

        $goodscodeGood = new GoodscodeGood();
        $goodscodeGood->setUniacid(1);
        $goodscodeGood->setGoodsid(1);
        $goodscodeGood->setTitle("test");
        $goodscodeGood->setThumb("path/to/thumb");
        $goodscodeGood->setQrcode("qrcode");
        $goodscodeGood->setStatus(1);
        $goodscodeGood->setDisplayorder(1);
        $manager->persist($goodscodeGood);

        $manager->flush();
    }
}