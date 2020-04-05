<?php


namespace Ydb\Data\Fixtures\Engine;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AccountWechatsFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        pdo_run('TRUNCATE TABLE `ims_account_wechats`');
        pdo_run("
                INSERT INTO `ims_account_wechats`(`acid`, `uniacid`, `token`, `encodingaeskey`, `level`, `name`,
                                                  `account`, `original`, `signature`, `country`, `province`, `city`,
                                                  `username`, `password`, `lastupdate`, `key`, `secret`, `styleid`,
                                                  `subscribeurl`, `auth_refresh_token`)
                VALUES (3, 3, 'jZyombMrYu88GlUx8a8yRmYpO1eX8bA2', 'mrrnc79719c1315F9xKnp9Cg951iMPXXM7p9lnpKN1N', 4,
                        '一道电商服务', '731539803@qq.com', 'gh_5a2c328b8246', '', '', '', '', '', '', 0,
                        'wxca6b753bc095e372', 'f5bdcd15c8dc991b47c9605024e8797d', 0, '', '');
        ");
    }
}