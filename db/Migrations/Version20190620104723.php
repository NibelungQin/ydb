<?php

declare(strict_types=1);

namespace Ydb\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * 添加多商户缺失字段
 */
final class Version20190620104723 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '添加多商户缺失字段';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql("alter table ims_ewei_shop_merch_user add column `parent_openid` varchar(255) NOT NULL DEFAULT '';");
    }

    public function down(Schema $schema) : void
    {
        $this->addSql("alter table ims_ewei_shop_merch_user drop column `parent_openid`");
    }
}
