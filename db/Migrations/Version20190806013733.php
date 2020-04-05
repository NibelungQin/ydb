<?php

declare(strict_types=1);

namespace Ydb\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190806013733 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '物流公司初始化数据';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("delete from `ims_ewei_shop_express`");
        $this->addSql("alter table ims_ewei_shop_express add column `kuaidiniao` varchar(50) NOT NULL DEFAULT '' COMMENT '快递鸟对应编号'");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`,`kuaidiniao`) VALUES ('顺丰', 'shunfeng', 1, 0, '','SF')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`,`kuaidiniao`) VALUES ('百世快递', 'huitongkuaidi', 1, 0, '','HTKY')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`,`kuaidiniao`) VALUES ('中通快递', 'zhongtong', 1, 0, '','ZTO')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`,`kuaidiniao`) VALUES ('申通快递', 'shentong', 1, 0, '','STO')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`,`kuaidiniao`) VALUES ('圆通速递', 'yuantong', 1, 0, '','YTO')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`,`kuaidiniao`) VALUES ('韵达速递', 'yunda', 1, 0, '','YD')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`,`kuaidiniao`) VALUES ('邮政快递包裹', 'youzhengguonei', 1, 0, '','YZPY')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`,`kuaidiniao`) VALUES ('EMS', 'ems', 1, 0, '','EMS')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`,`kuaidiniao`) VALUES ('天天快递', 'tiantian', 1, 0, '','HHTT')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`,`kuaidiniao`) VALUES ('京东快递', 'jd', 1, 0, '','JD')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`,`kuaidiniao`) VALUES ('优速快递', 'youshuwuliu', 1, 0, '','UC')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`,`kuaidiniao`) VALUES ('德邦快递', 'debangkuaidi', 1, 0, '','DBL')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`,`kuaidiniao`) VALUES ('宅急送', 'zhaijisong', 1, 0, '','ZJS')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`,`kuaidiniao`) VALUES ('TNT快递', 'tnt', 1, 0, '','TNT')");
        $this->addSql("INSERT INTO `ims_ewei_shop_express`(`name`, `express`, `status`, `displayorder`, `code`,`kuaidiniao`) VALUES ('UPS', 'ups', 1, 0, '','UPS')");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("alter table ims_ewei_shop_express drop column `kuaidiniao`");
        $this->addSql("delete from `ims_ewei_shop_express`");
    }
}
