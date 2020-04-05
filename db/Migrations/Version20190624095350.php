<?php

declare(strict_types=1);

namespace Ydb\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * 添加主键约束，从而支持 doctrine/orm
 */
final class Version20190624095350 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '添加主键约束，从而支持 doctrine/orm';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql("alter table ims_ewei_shop_bargain_account add primary key (id)");
        $this->addSql("alter table ims_ewei_shop_commission_relation add primary key (id)");
        $this->addSql("alter table ims_ewei_shop_member_tmp add primary key (uniacid)");
        $this->addSql("alter table ims_ewei_shop_merch_bill_select add primary key (bill_id)");
    }

    public function down(Schema $schema) : void
    {
        $this->addSql("alter table ims_ewei_shop_bargain_account drop primary key");
        $this->addSql("alter table ims_ewei_shop_commission_relation drop primary key");
        $this->addSql("alter table ims_ewei_shop_member_tmp drop primary key");
        $this->addSql("alter table ims_ewei_shop_merch_bill_select drop primary key");
    }
}
