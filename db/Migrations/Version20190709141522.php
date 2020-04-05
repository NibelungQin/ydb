<?php

declare(strict_types=1);

namespace Ydb\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * 绩效奖励需要的数据表
 */
final class Version20190709141522 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '绩效奖励需要的数据表';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
            CREATE TABLE `ims_ewei_shop_achievement_bill` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `uniacid` int(11) DEFAULT '0',
                `billno` varchar(100) DEFAULT '',
                `paytype` int(11) DEFAULT '0',
                `year` int(11) DEFAULT '0',
                `month` int(11) DEFAULT '0',
                `week` int(11) DEFAULT '0',
                `ordercount` int(11) DEFAULT '0',
                `ordermoney` decimal(10,2) DEFAULT '0.00',
                `bonusmoney` decimal(10,2) DEFAULT '0.00',
                `bonusmoney_send` decimal(10,2) DEFAULT '0.00',
                `bonusmoney_pay` decimal(10,2) DEFAULT '0.00',
                `paytime` int(11) DEFAULT '0',
                `partnercount` int(11) DEFAULT '0',
                `createtime` int(11) DEFAULT '0',
                `status` tinyint(3) DEFAULT '0',
                `starttime` int(11) DEFAULT '0',
                `endtime` int(11) DEFAULT '0',
                `confirmtime` int(11) DEFAULT '0',
                `bonusordermoney` decimal(10,2) DEFAULT '0.00',
                `bonusrate` decimal(10,2) DEFAULT '0.00',
                PRIMARY KEY (`id`),
                KEY `idx_uniacid` (`uniacid`),
                KEY `idx_paytype` (`paytype`),
                KEY `idx_createtime` (`createtime`),
                KEY `idx_paytime` (`paytime`),
                KEY `idx_status` (`status`),
                KEY `idx_month` (`month`),
                KEY `idx_week` (`week`),
                KEY `idx_year` (`year`)
            ) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
        ");

        $this->addSql("
            CREATE TABLE `ims_ewei_shop_achievement_billo` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `uniacid` int(11) DEFAULT '0',
                `billid` int(11) DEFAULT '0',
                `orderid` int(11) DEFAULT '0',
                `ordermoney` decimal(10,2) DEFAULT '0.00',
                PRIMARY KEY (`id`),
                KEY `idx_billid` (`billid`),
                KEY `idx_uniacid` (`uniacid`)
            ) ENGINE=MyISAM AUTO_INCREMENT=114 DEFAULT CHARSET=utf8;
        ");

        $this->addSql("
            CREATE TABLE `ims_ewei_shop_achievement_billp` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `uniacid` int(11) DEFAULT '0',
                `billid` int(11) DEFAULT '0',
                `openid` varchar(255) DEFAULT '',
                `payno` varchar(255) DEFAULT '',
                `paytype` tinyint(3) DEFAULT '0',
                `bonus` decimal(10,2) DEFAULT '0.00',
                `money` decimal(10,2) DEFAULT '0.00',
                `realmoney` decimal(10,2) DEFAULT '0.00',
                `paymoney` decimal(10,2) DEFAULT '0.00',
                `charge` decimal(10,2) DEFAULT '0.00',
                `chargemoney` decimal(10,2) DEFAULT '0.00',
                `status` tinyint(3) DEFAULT '0',
                `reason` varchar(255) DEFAULT '',
                `paytime` int(11) DEFAULT '0',
                `achievement_score` decimal(10,2) unsigned DEFAULT NULL COMMENT '绩效分值',
                PRIMARY KEY (`id`),
                KEY `idx_billid` (`billid`),
                KEY `idx_uniacid` (`uniacid`)
            ) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;
        ");

        $this->addSql("DROP TABLE IF EXISTS `ims_ewei_shop_packagegoods_achievement_log`");
        $this->addSql("
            CREATE TABLE `ims_ewei_shop_packagegoods_achievement_log` (
                `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '升级大礼包店铺奖励佣金ID',
                `uniacid` int(11) DEFAULT '0',
                `orderid` int(11) DEFAULT '0' COMMENT '订单ID',
                `openid` varchar(50) DEFAULT '' COMMENT '购买人openid',
                `bonusmoney_id` int(11) DEFAULT '0' COMMENT '店铺分佣会员ID',
                `bonusmoney` decimal(10,2) DEFAULT '0.00' COMMENT '店铺分佣佣金',
                `createtime` int(11) DEFAULT '0' COMMENT '生成时间',
                `status` tinyint(10) DEFAULT '0' COMMENT '发放状态：0未发放1已发放',
                `orderno` varchar(45) DEFAULT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=157 DEFAULT CHARSET=utf8;
        ");


    }

    public function down(Schema $schema): void
    {
        $this->addSql("DROP TABLE IF EXISTS `ims_ewei_shop_achievement_bill`");
        $this->addSql("DROP TABLE IF EXISTS `ims_ewei_shop_achievement_billo`");
        $this->addSql("DROP TABLE IF EXISTS `ims_ewei_shop_achievement_billp`");
        $this->addSql("DROP TABLE IF EXISTS `ims_ewei_shop_packagegoods_achievement_log`");
    }
}
