<?php

declare(strict_types=1);

namespace Ydb\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * 添加订单佣金计算缺失字段
 */
final class Version20190701072256 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '添加订单佣金计算缺失字段';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql("alter table ims_ewei_shop_goods add column `area` varchar(255) NOT NULL DEFAULT '' COMMENT '区/县'");
        $this->addSql("alter table ims_ewei_shop_order_goods add column `costprice` decimal(10, 2)  DEFAULT NULL comment '成本价'");
    }

    public function down(Schema $schema) : void
    {
        $this->addSql("alter table ims_ewei_shop_goods drop column `area`");
        $this->addSql("alter table ims_ewei_shop_order_goods drop column `costprice`");
    }
}
