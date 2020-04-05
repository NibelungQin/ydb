<?php
$schemas = <<<EOF
CREATE TABLE IF NOT EXISTS `ims_account`
(
    `acid`      int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `uniacid`   int(10) unsigned    NOT NULL,
    `hash`      varchar(8)          NOT NULL,
    `type`      tinyint(3) unsigned NOT NULL,
    `isconnect` tinyint(4)          NOT NULL,
    `isdeleted` tinyint(3) unsigned NOT NULL,
    `endtime`   int(10) unsigned    NOT NULL,
    PRIMARY KEY (`acid`),
    KEY `idx_uniacid` (`uniacid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_account_phoneapp`
(
    `acid`    int(11) NOT NULL,
    `uniacid` int(11)      DEFAULT NULL,
    `name`    varchar(255) DEFAULT NULL,
    PRIMARY KEY (`acid`),
    KEY `uniacid` (`uniacid`) USING BTREE
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  ROW_FORMAT = DYNAMIC;

CREATE TABLE IF NOT EXISTS `ims_account_webapp`
(
    `acid`    int(11) NOT NULL,
    `uniacid` int(11)      DEFAULT NULL,
    `name`    varchar(255) DEFAULT NULL,
    PRIMARY KEY (`acid`),
    KEY `uniacid` (`uniacid`) USING BTREE
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  ROW_FORMAT = DYNAMIC;

CREATE TABLE IF NOT EXISTS `ims_account_wechats`
(
    `acid`               int(10) unsigned    NOT NULL,
    `uniacid`            int(10) unsigned    NOT NULL,
    `token`              varchar(32)         NOT NULL,
    `encodingaeskey`     varchar(255)        NOT NULL,
    `level`              tinyint(4) unsigned NOT NULL,
    `name`               varchar(30)         NOT NULL,
    `account`            varchar(30)         NOT NULL,
    `original`           varchar(50)         NOT NULL,
    `signature`          varchar(100)        NOT NULL,
    `country`            varchar(10)         NOT NULL,
    `province`           varchar(3)          NOT NULL,
    `city`               varchar(15)         NOT NULL,
    `username`           varchar(30)         NOT NULL,
    `password`           varchar(32)         NOT NULL,
    `lastupdate`         int(10) unsigned    NOT NULL,
    `key`                varchar(50)         NOT NULL,
    `secret`             varchar(50)         NOT NULL,
    `styleid`            int(10) unsigned    NOT NULL,
    `subscribeurl`       varchar(120)        NOT NULL,
    `auth_refresh_token` varchar(255)        NOT NULL,
    PRIMARY KEY (`acid`),
    KEY `idx_key` (`key`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_account_wxapp`
(
    `acid`           int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid`        int(10)          NOT NULL,
    `token`          varchar(32)      NOT NULL,
    `encodingaeskey` varchar(43)      NOT NULL,
    `level`          tinyint(4)       NOT NULL,
    `account`        varchar(30)      NOT NULL,
    `original`       varchar(50)      NOT NULL,
    `key`            varchar(50)      NOT NULL,
    `secret`         varchar(50)      NOT NULL,
    `name`           varchar(30)      NOT NULL,
    `appdomain`      varchar(255)     NOT NULL,
    PRIMARY KEY (`acid`),
    KEY `uniacid` (`uniacid`) USING BTREE
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  ROW_FORMAT = DYNAMIC;

CREATE TABLE IF NOT EXISTS `ims_activity_clerk_menu`
(
    `id`           int(11)     NOT NULL AUTO_INCREMENT,
    `uniacid`      int(11)     NOT NULL,
    `displayorder` int(4)      NOT NULL,
    `pid`          int(6)      NOT NULL,
    `group_name`   varchar(20) NOT NULL,
    `title`        varchar(20) NOT NULL,
    `icon`         varchar(50) NOT NULL,
    `url`          varchar(60) NOT NULL,
    `type`         varchar(20) NOT NULL,
    `permission`   varchar(50) NOT NULL,
    `system`       int(2)      NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_activity_clerks`
(
    `id`       int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid`  int(10) unsigned NOT NULL,
    `uid`      int(10) unsigned NOT NULL,
    `storeid`  int(10) unsigned NOT NULL,
    `name`     varchar(50)      NOT NULL,
    `password` varchar(50)      NOT NULL,
    `mobile`   varchar(20)      NOT NULL,
    `openid`   varchar(50)      NOT NULL,
    `nickname` varchar(30)      NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`) USING BTREE,
    KEY `password` (`password`) USING BTREE,
    KEY `openid` (`openid`) USING BTREE
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_activity_coupon`
(
    `couponid`    int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `uniacid`     int(10) unsigned    NOT NULL,
    `type`        tinyint(4)          NOT NULL,
    `title`       varchar(30)         NOT NULL,
    `couponsn`    varchar(50)         NOT NULL,
    `description` text,
    `discount`    decimal(10, 2)      NOT NULL,
    `condition`   decimal(10, 2)      NOT NULL,
    `starttime`   int(10) unsigned    NOT NULL,
    `endtime`     int(10) unsigned    NOT NULL,
    `limit`       int(11)             NOT NULL,
    `dosage`      int(11) unsigned    NOT NULL,
    `amount`      int(11) unsigned    NOT NULL,
    `thumb`       varchar(500)        NOT NULL,
    `credit`      int(10) unsigned    NOT NULL,
    `use_module`  tinyint(3) unsigned NOT NULL,
    `credittype`  varchar(20)         NOT NULL,
    PRIMARY KEY (`couponid`),
    KEY `uniacid` (`uniacid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_activity_coupon_allocation`
(
    `id`       int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid`  int(10) unsigned NOT NULL,
    `couponid` int(10) unsigned NOT NULL,
    `groupid`  int(10) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`, `couponid`, `groupid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_activity_coupon_modules`
(
    `id`       int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid`  int(10) unsigned NOT NULL,
    `couponid` int(10) unsigned NOT NULL,
    `module`   varchar(30)      NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`),
    KEY `couponid` (`couponid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_activity_coupon_record`
(
    `recid`       int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `uniacid`     int(10) unsigned    NOT NULL,
    `uid`         int(10) unsigned    NOT NULL,
    `code`        varchar(50)         NOT NULL,
    `grantmodule` varchar(50)         NOT NULL,
    `granttime`   int(10) unsigned    NOT NULL,
    `usemodule`   varchar(50)         NOT NULL,
    `usetime`     int(10) unsigned    NOT NULL,
    `status`      tinyint(4)          NOT NULL,
    `operator`    varchar(30)         NOT NULL,
    `clerk_id`    int(10) unsigned    NOT NULL,
    `store_id`    int(10) unsigned    NOT NULL,
    `clerk_type`  tinyint(3) unsigned NOT NULL,
    `remark`      varchar(300)        NOT NULL,
    `couponid`    int(10) unsigned    NOT NULL,
    PRIMARY KEY (`recid`),
    KEY `couponid` (`uid`, `grantmodule`, `usemodule`, `status`),
    KEY `uniacid` (`uniacid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_activity_exchange`
(
    `id`          int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `uniacid`     int(11)             NOT NULL,
    `title`       varchar(100)        NOT NULL,
    `description` text                NOT NULL,
    `thumb`       varchar(500)        NOT NULL,
    `type`        tinyint(1) unsigned NOT NULL,
    `extra`       varchar(3000)       NOT NULL,
    `credit`      int(10) unsigned    NOT NULL,
    `credittype`  varchar(10)         NOT NULL,
    `pretotal`    int(11)             NOT NULL,
    `num`         int(11)             NOT NULL,
    `total`       int(10) unsigned    NOT NULL,
    `status`      tinyint(3) unsigned NOT NULL,
    `starttime`   int(10) unsigned    NOT NULL,
    `endtime`     int(10)             NOT NULL,
    PRIMARY KEY (`id`),
    KEY `extra` (`extra`(333)) USING BTREE
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_activity_exchange_trades`
(
    `tid`        int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid`    int(10) unsigned NOT NULL,
    `uid`        int(10) unsigned NOT NULL,
    `exid`       int(10) unsigned NOT NULL,
    `type`       int(10) unsigned NOT NULL,
    `createtime` int(10) unsigned NOT NULL,
    PRIMARY KEY (`tid`),
    KEY `uniacid` (`uniacid`, `uid`, `exid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_activity_exchange_trades_shipping`
(
    `tid`        int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid`    int(10) unsigned NOT NULL,
    `exid`       int(10) unsigned NOT NULL,
    `uid`        int(10) unsigned NOT NULL,
    `status`     tinyint(4)       NOT NULL,
    `createtime` int(10) unsigned NOT NULL,
    `province`   varchar(30)      NOT NULL,
    `city`       varchar(30)      NOT NULL,
    `district`   varchar(30)      NOT NULL,
    `address`    varchar(255)     NOT NULL,
    `zipcode`    varchar(6)       NOT NULL,
    `mobile`     varchar(30)      NOT NULL,
    `name`       varchar(30)      NOT NULL,
    PRIMARY KEY (`tid`),
    KEY `uniacid` (`uniacid`),
    KEY `uid` (`uid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_activity_modules`
(
    `mid`       int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid`   int(10) unsigned NOT NULL,
    `exid`      int(10) unsigned NOT NULL,
    `module`    varchar(50)      NOT NULL,
    `uid`       int(10) unsigned NOT NULL,
    `available` int(10) unsigned NOT NULL,
    PRIMARY KEY (`mid`),
    KEY `uniacid` (`uniacid`),
    KEY `module` (`module`),
    KEY `uid` (`uid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_activity_modules_record`
(
    `id`         int(10) unsigned NOT NULL AUTO_INCREMENT,
    `mid`        int(10) unsigned NOT NULL,
    `num`        tinyint(3)       NOT NULL,
    `createtime` int(10) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `mid` (`mid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_activity_stores`
(
    `id`            int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `uniacid`       int(10) unsigned    NOT NULL,
    `business_name` varchar(50)         NOT NULL,
    `branch_name`   varchar(50)         NOT NULL,
    `category`      varchar(255)        NOT NULL,
    `province`      varchar(15)         NOT NULL,
    `city`          varchar(15)         NOT NULL,
    `district`      varchar(15)         NOT NULL,
    `address`       varchar(50)         NOT NULL,
    `longitude`     varchar(15)         NOT NULL,
    `latitude`      varchar(15)         NOT NULL,
    `telephone`     varchar(20)         NOT NULL,
    `photo_list`    varchar(10000)      NOT NULL,
    `avg_price`     int(10) unsigned    NOT NULL,
    `recommend`     varchar(255)        NOT NULL,
    `special`       varchar(255)        NOT NULL,
    `introduction`  varchar(255)        NOT NULL,
    `open_time`     varchar(50)         NOT NULL,
    `location_id`   int(10) unsigned    NOT NULL,
    `status`        tinyint(3) unsigned NOT NULL,
    `source`        tinyint(3) unsigned NOT NULL,
    `message`       varchar(500)        NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`),
    KEY `location_id` (`location_id`) USING BTREE
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_article_category`
(
    `id`           int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `title`        varchar(30)         NOT NULL,
    `displayorder` tinyint(3) unsigned NOT NULL,
    `type`         varchar(15)         NOT NULL,
    PRIMARY KEY (`id`),
    KEY `type` (`type`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_article_news`
(
    `id`           int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `cateid`       int(10) unsigned    NOT NULL,
    `title`        varchar(100)        NOT NULL,
    `content`      mediumtext          NOT NULL,
    `thumb`        varchar(255)        NOT NULL,
    `source`       varchar(255)        NOT NULL,
    `author`       varchar(50)         NOT NULL,
    `displayorder` tinyint(3) unsigned NOT NULL,
    `is_display`   tinyint(3) unsigned NOT NULL,
    `is_show_home` tinyint(3) unsigned NOT NULL,
    `createtime`   int(10) unsigned    NOT NULL,
    `click`        int(10) unsigned    NOT NULL,
    PRIMARY KEY (`id`),
    KEY `title` (`title`),
    KEY `cateid` (`cateid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_article_notice`
(
    `id`           int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `cateid`       int(10) unsigned    NOT NULL,
    `title`        varchar(100)        NOT NULL,
    `content`      mediumtext          NOT NULL,
    `displayorder` tinyint(3) unsigned NOT NULL,
    `is_display`   tinyint(3) unsigned NOT NULL,
    `is_show_home` tinyint(3) unsigned NOT NULL,
    `createtime`   int(10) unsigned    NOT NULL,
    `click`        int(10) unsigned    NOT NULL,
    `style`        varchar(200)        NOT NULL,
    `group`        varchar(255)        NOT NULL,
    PRIMARY KEY (`id`),
    KEY `title` (`title`),
    KEY `cateid` (`cateid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_article_unread_notice`
(
    `id`        int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `notice_id` int(10) unsigned    NOT NULL,
    `uid`       int(10) unsigned    NOT NULL,
    `is_new`    tinyint(3) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uid` (`uid`),
    KEY `notice_id` (`notice_id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_attachment_group`
(
    `id`      int(11)     NOT NULL AUTO_INCREMENT,
    `name`    varchar(25) NOT NULL,
    `uniacid` int(11)    DEFAULT NULL,
    `uid`     int(11)    DEFAULT NULL,
    `type`    tinyint(1) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  ROW_FORMAT = DYNAMIC;

CREATE TABLE IF NOT EXISTS `ims_basic_reply`
(
    `id`      int(10) unsigned NOT NULL AUTO_INCREMENT,
    `rid`     int(10) unsigned NOT NULL,
    `content` varchar(1000)    NOT NULL,
    PRIMARY KEY (`id`),
    KEY `rid` (`rid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_business`
(
    `id`         int(10) unsigned NOT NULL AUTO_INCREMENT,
    `weid`       int(10) unsigned NOT NULL,
    `title`      varchar(50)      NOT NULL,
    `thumb`      varchar(255)     NOT NULL,
    `content`    varchar(1000)    NOT NULL,
    `phone`      varchar(15)      NOT NULL,
    `qq`         varchar(15)      NOT NULL,
    `province`   varchar(50)      NOT NULL,
    `city`       varchar(50)      NOT NULL,
    `dist`       varchar(50)      NOT NULL,
    `address`    varchar(500)     NOT NULL,
    `lng`        varchar(10)      NOT NULL,
    `lat`        varchar(10)      NOT NULL,
    `industry1`  varchar(10)      NOT NULL,
    `industry2`  varchar(10)      NOT NULL,
    `createtime` int(10)          NOT NULL,
    PRIMARY KEY (`id`),
    KEY `idx_lat_lng` (`lng`, `lat`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_core_attachment`
(
    `id`                int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `uniacid`           int(10) unsigned    NOT NULL,
    `uid`               int(10) unsigned    NOT NULL,
    `filename`          varchar(255)        NOT NULL,
    `attachment`        varchar(255)        NOT NULL,
    `type`              tinyint(3) unsigned NOT NULL,
    `createtime`        int(10) unsigned    NOT NULL,
    `module_upload_dir` varchar(100)        NOT NULL,
    `group_id`          int(11) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_core_cache`
(
    `key`   varchar(50) NOT NULL,
    `value` longtext    NOT NULL,
    PRIMARY KEY (`key`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_core_cron`
(
    `id`          int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `cloudid`     int(10) unsigned    NOT NULL,
    `module`      varchar(50)         NOT NULL,
    `uniacid`     int(10) unsigned    NOT NULL,
    `type`        tinyint(3) unsigned NOT NULL,
    `name`        varchar(50)         NOT NULL,
    `filename`    varchar(50)         NOT NULL,
    `lastruntime` int(10) unsigned    NOT NULL,
    `nextruntime` int(10) unsigned    NOT NULL,
    `weekday`     tinyint(3)          NOT NULL,
    `day`         tinyint(3)          NOT NULL,
    `hour`        tinyint(3)          NOT NULL,
    `minute`      varchar(255)        NOT NULL,
    `extra`       varchar(5000)       NOT NULL,
    `status`      tinyint(3) unsigned NOT NULL,
    `createtime`  int(10) unsigned    NOT NULL,
    PRIMARY KEY (`id`),
    KEY `createtime` (`createtime`),
    KEY `nextruntime` (`nextruntime`),
    KEY `uniacid` (`uniacid`),
    KEY `cloudid` (`cloudid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_core_cron_record`
(
    `id`         int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid`    int(10) unsigned NOT NULL,
    `module`     varchar(50)      NOT NULL,
    `type`       varchar(50)      NOT NULL,
    `tid`        int(10) unsigned NOT NULL,
    `note`       varchar(500)     NOT NULL,
    `tag`        varchar(5000)    NOT NULL,
    `createtime` int(10) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`),
    KEY `tid` (`tid`),
    KEY `module` (`module`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_core_menu`
(
    `id`              int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `pid`             int(10) unsigned    NOT NULL,
    `title`           varchar(20)         NOT NULL,
    `name`            varchar(20)         NOT NULL,
    `url`             varchar(255)        NOT NULL,
    `append_title`    varchar(30)         NOT NULL,
    `append_url`      varchar(255)        NOT NULL,
    `displayorder`    tinyint(3) unsigned NOT NULL,
    `type`            varchar(15)         NOT NULL,
    `is_display`      tinyint(3) unsigned NOT NULL,
    `is_system`       tinyint(3) unsigned NOT NULL,
    `permission_name` varchar(50)         NOT NULL,
    `group_name`      varchar(30)         NOT NULL,
    `icon`            varchar(20)         NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_core_paylog`
(
    `plid`         bigint(11) unsigned     NOT NULL AUTO_INCREMENT,
    `type`         varchar(20)             NOT NULL,
    `uniacid`      int(11)                 NOT NULL,
    `acid`         int(10)                 NOT NULL,
    `openid`       varchar(40)             NOT NULL,
    `uniontid`     varchar(64)             NOT NULL,
    `tid`          varchar(128)            NOT NULL,
    `fee`          decimal(10, 2)          NOT NULL,
    `status`       tinyint(4)              NOT NULL,
    `module`       varchar(50)             NOT NULL,
    `tag`          varchar(2000)           NOT NULL,
    `is_usecard`   tinyint(3) unsigned     NOT NULL,
    `card_type`    tinyint(3) unsigned     NOT NULL,
    `card_id`      varchar(50)             NOT NULL,
    `card_fee`     decimal(10, 2) unsigned NOT NULL,
    `encrypt_code` varchar(100)            NOT NULL,
    PRIMARY KEY (`plid`),
    KEY `idx_openid` (`openid`),
    KEY `idx_tid` (`tid`),
    KEY `idx_uniacid` (`uniacid`),
    KEY `uniontid` (`uniontid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_core_performance`
(
    `id`         int(10) unsigned NOT NULL AUTO_INCREMENT,
    `type`       tinyint(1)       NOT NULL,
    `runtime`    varchar(10)      NOT NULL,
    `runurl`     varchar(512)     NOT NULL,
    `runsql`     varchar(512)     NOT NULL,
    `createtime` int(10)          NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_core_queue`
(
    `qid`      bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid`  int(10) unsigned    NOT NULL,
    `acid`     int(10) unsigned    NOT NULL,
    `message`  varchar(2000)       NOT NULL,
    `params`   varchar(1000)       NOT NULL,
    `keyword`  varchar(1000)       NOT NULL,
    `response` varchar(2000)       NOT NULL,
    `module`   varchar(50)         NOT NULL,
    `type`     tinyint(3) unsigned NOT NULL,
    `dateline` int(10) unsigned    NOT NULL,
    PRIMARY KEY (`qid`),
    KEY `uniacid` (`uniacid`, `acid`),
    KEY `module` (`module`),
    KEY `dateline` (`dateline`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_core_refundlog`
(
    `id`              int(11)        NOT NULL AUTO_INCREMENT,
    `uniacid`         int(11)        NOT NULL,
    `refund_uniontid` varchar(64)    NOT NULL,
    `reason`          varchar(80)    NOT NULL,
    `uniontid`        varchar(64)    NOT NULL,
    `fee`             decimal(10, 2) NOT NULL,
    `status`          int(2)         NOT NULL,
    PRIMARY KEY (`id`),
    KEY `refund_uniontid` (`refund_uniontid`) USING BTREE,
    KEY `uniontid` (`uniontid`) USING BTREE
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  ROW_FORMAT = DYNAMIC;

CREATE TABLE IF NOT EXISTS `ims_core_resource`
(
    `mid`      int(11)          NOT NULL AUTO_INCREMENT,
    `uniacid`  int(10) unsigned NOT NULL,
    `media_id` varchar(100)     NOT NULL,
    `trunk`    int(10) unsigned NOT NULL,
    `type`     varchar(10)      NOT NULL,
    `dateline` int(10) unsigned NOT NULL,
    PRIMARY KEY (`mid`),
    KEY `acid` (`uniacid`),
    KEY `type` (`type`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_core_sendsms_log`
(
    `id`         int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid`    int(10) unsigned NOT NULL,
    `mobile`     varchar(11)      NOT NULL,
    `content`    varchar(255)     NOT NULL,
    `result`     varchar(255)     NOT NULL,
    `createtime` int(11) unsigned NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_core_sessions`
(
    `sid`        char(32)         NOT NULL,
    `uniacid`    int(10) unsigned NOT NULL,
    `openid`     varchar(50)      NOT NULL,
    `data`       varchar(5000)    NOT NULL,
    `expiretime` int(10) unsigned NOT NULL,
    PRIMARY KEY (`sid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_core_settings`
(
    `key`   varchar(200) NOT NULL,
    `value` text         NOT NULL,
    PRIMARY KEY (`key`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_coupon`
(
    `id`                      int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `uniacid`                 int(10) unsigned    NOT NULL,
    `acid`                    int(10) unsigned    NOT NULL,
    `card_id`                 varchar(50)         NOT NULL,
    `type`                    varchar(15)         NOT NULL,
    `logo_url`                varchar(150)        NOT NULL,
    `code_type`               tinyint(3) unsigned NOT NULL,
    `brand_name`              varchar(15)         NOT NULL,
    `title`                   varchar(15)         NOT NULL,
    `sub_title`               varchar(20)         NOT NULL,
    `color`                   varchar(15)         NOT NULL,
    `notice`                  varchar(15)         NOT NULL,
    `description`             varchar(1000)       NOT NULL,
    `date_info`               varchar(200)        NOT NULL,
    `quantity`                int(10) unsigned    NOT NULL,
    `use_custom_code`         tinyint(3)          NOT NULL,
    `bind_openid`             tinyint(3) unsigned NOT NULL,
    `can_share`               tinyint(3) unsigned NOT NULL,
    `can_give_friend`         tinyint(3) unsigned NOT NULL,
    `get_limit`               tinyint(3) unsigned NOT NULL,
    `service_phone`           varchar(20)         NOT NULL,
    `extra`                   varchar(1000)       NOT NULL,
    `status`                  tinyint(3) unsigned NOT NULL,
    `is_display`              tinyint(3) unsigned NOT NULL,
    `is_selfconsume`          tinyint(3) unsigned NOT NULL,
    `promotion_url_name`      varchar(10)         NOT NULL,
    `promotion_url`           varchar(100)        NOT NULL,
    `promotion_url_sub_title` varchar(10)         NOT NULL,
    `source`                  tinyint(3) unsigned NOT NULL,
    `dosage`                  int(10) unsigned DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`, `acid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_coupon_activity`
(
    `id`          int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid`     int(10)          NOT NULL,
    `msg_id`      int(10)          NOT NULL,
    `status`      int(10)          NOT NULL,
    `title`       varchar(255)     NOT NULL,
    `type`        int(3)           NOT NULL,
    `thumb`       varchar(255)     NOT NULL,
    `coupons`     varchar(255)     NOT NULL,
    `description` varchar(255)     NOT NULL,
    `members`     varchar(255)     NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  ROW_FORMAT = DYNAMIC;

CREATE TABLE IF NOT EXISTS `ims_coupon_groups`
(
    `id`       int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid`  int(10)          NOT NULL,
    `couponid` varchar(255)     NOT NULL,
    `groupid`  int(10)          NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  ROW_FORMAT = DYNAMIC;

CREATE TABLE IF NOT EXISTS `ims_coupon_location`
(
    `id`            int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `uniacid`       int(10) unsigned    NOT NULL,
    `acid`          int(10) unsigned    NOT NULL,
    `sid`           int(10) unsigned    NOT NULL,
    `location_id`   int(10) unsigned    NOT NULL,
    `business_name` varchar(50)         NOT NULL,
    `branch_name`   varchar(50)         NOT NULL,
    `category`      varchar(255)        NOT NULL,
    `province`      varchar(15)         NOT NULL,
    `city`          varchar(15)         NOT NULL,
    `district`      varchar(15)         NOT NULL,
    `address`       varchar(50)         NOT NULL,
    `longitude`     varchar(15)         NOT NULL,
    `latitude`      varchar(15)         NOT NULL,
    `telephone`     varchar(20)         NOT NULL,
    `photo_list`    varchar(10000)      NOT NULL,
    `avg_price`     int(10) unsigned    NOT NULL,
    `open_time`     varchar(50)         NOT NULL,
    `recommend`     varchar(255)        NOT NULL,
    `special`       varchar(255)        NOT NULL,
    `introduction`  varchar(255)        NOT NULL,
    `offset_type`   tinyint(3) unsigned NOT NULL,
    `status`        tinyint(3) unsigned NOT NULL,
    `message`       varchar(255)        NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`, `acid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_coupon_modules`
(
    `id`       int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid`  int(10) unsigned NOT NULL,
    `acid`     int(10) unsigned NOT NULL,
    `couponid` int(10) unsigned NOT NULL,
    `module`   varchar(30)      NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`, `acid`),
    KEY `couponid` (`couponid`) USING BTREE
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_coupon_record`
(
    `id`            int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `uniacid`       int(10) unsigned    NOT NULL,
    `acid`          int(10) unsigned    NOT NULL,
    `card_id`       varchar(50)         NOT NULL,
    `openid`        varchar(50)         NOT NULL,
    `friend_openid` varchar(50)         NOT NULL,
    `givebyfriend`  tinyint(3) unsigned NOT NULL,
    `code`          varchar(50)         NOT NULL,
    `hash`          varchar(32)         NOT NULL,
    `addtime`       int(10) unsigned    NOT NULL,
    `usetime`       int(10) unsigned    NOT NULL,
    `status`        tinyint(3)          NOT NULL,
    `clerk_name`    varchar(15)         NOT NULL,
    `clerk_id`      int(10) unsigned    NOT NULL,
    `store_id`      int(10) unsigned    NOT NULL,
    `clerk_type`    tinyint(3) unsigned NOT NULL,
    `couponid`      int(10) unsigned    NOT NULL,
    `uid`           int(10) unsigned    NOT NULL,
    `grantmodule`   varchar(255)        NOT NULL,
    `remark`        varchar(255)        NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`, `acid`),
    KEY `card_id` (`card_id`),
    KEY `hash` (`hash`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_coupon_setting`
(
    `id`        int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid`   int(10) unsigned NOT NULL,
    `acid`      int(10)          NOT NULL,
    `logourl`   varchar(150)     NOT NULL,
    `whitelist` varchar(1000)    NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`, `acid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_coupon_store`
(
    `id`       int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid`  int(10)          NOT NULL,
    `couponid` varchar(255)     NOT NULL,
    `storeid`  int(10) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `couponid` (`couponid`) USING BTREE
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  ROW_FORMAT = DYNAMIC;

CREATE TABLE IF NOT EXISTS `ims_cover_reply`
(
    `id`          int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid`     int(10) unsigned NOT NULL,
    `multiid`     int(10) unsigned NOT NULL,
    `rid`         int(10) unsigned NOT NULL,
    `module`      varchar(30)      NOT NULL,
    `do`          varchar(30)      NOT NULL,
    `title`       varchar(255)     NOT NULL,
    `description` varchar(255)     NOT NULL,
    `thumb`       varchar(255)     NOT NULL,
    `url`         varchar(255)     NOT NULL,
    PRIMARY KEY (`id`),
    KEY `rid` (`rid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_custom_reply`
(
    `id`     int(10) unsigned NOT NULL AUTO_INCREMENT,
    `rid`    int(10) unsigned NOT NULL,
    `start1` int(10)          NOT NULL,
    `end1`   int(10)          NOT NULL,
    `start2` int(10)          NOT NULL,
    `end2`   int(10)          NOT NULL,
    PRIMARY KEY (`id`),
    KEY `rid` (`rid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_images_reply`
(
    `id`          int(10) unsigned NOT NULL AUTO_INCREMENT,
    `rid`         int(10) unsigned NOT NULL,
    `title`       varchar(50)      NOT NULL,
    `description` varchar(255)     NOT NULL,
    `mediaid`     varchar(255)     NOT NULL,
    `createtime`  int(10)          NOT NULL,
    PRIMARY KEY (`id`),
    KEY `rid` (`rid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_mc_card`
(
    `id`                       int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `uniacid`                  int(10) unsigned    NOT NULL,
    `title`                    varchar(100)        NOT NULL,
    `color`                    varchar(255)        NOT NULL,
    `background`               varchar(255)        NOT NULL,
    `logo`                     varchar(255)        NOT NULL,
    `format_type`              tinyint(3) unsigned NOT NULL,
    `format`                   varchar(50)         NOT NULL,
    `description`              varchar(512)        NOT NULL,
    `fields`                   varchar(1000)       NOT NULL,
    `snpos`                    int(11)             NOT NULL,
    `status`                   tinyint(1)          NOT NULL,
    `business`                 text                NOT NULL,
    `discount_type`            tinyint(3) unsigned NOT NULL,
    `discount`                 varchar(3000)       NOT NULL,
    `grant`                    varchar(3000)       NOT NULL,
    `grant_rate`               varchar(20)         NOT NULL,
    `offset_rate`              int(10) unsigned    NOT NULL,
    `offset_max`               int(10)             NOT NULL,
    `nums_status`              tinyint(3) unsigned NOT NULL,
    `nums_text`                varchar(15)         NOT NULL,
    `nums`                     varchar(1000)       NOT NULL,
    `times_status`             tinyint(3) unsigned NOT NULL,
    `times_text`               varchar(15)         NOT NULL,
    `times`                    varchar(1000)       NOT NULL,
    `params`                   longtext            NOT NULL,
    `html`                     longtext            NOT NULL,
    `recommend_status`         tinyint(3) unsigned NOT NULL,
    `sign_status`              tinyint(3) unsigned NOT NULL,
    `brand_name`               varchar(128)        NOT NULL DEFAULT '' COMMENT '商户名字,',
    `notice`                   varchar(48)         NOT NULL DEFAULT '' COMMENT '卡券使用提醒',
    `quantity`                 int(10)             NOT NULL DEFAULT '0' COMMENT '会员卡库存',
    `max_increase_bonus`       int(10)             NOT NULL DEFAULT '0' COMMENT '用户单次可获取的积分上限',
    `least_money_to_use_bonus` int(10)             NOT NULL DEFAULT '0' COMMENT '抵扣条件',
    `source`                   int(1)              NOT NULL DEFAULT '1' COMMENT '1.系统会员卡，2微信会员卡',
    `card_id`                  varchar(250)        NOT NULL DEFAULT '',
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_mc_card_care`
(
    `id`           int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `uniacid`      int(10) unsigned    NOT NULL,
    `title`        varchar(30)         NOT NULL,
    `type`         tinyint(3) unsigned NOT NULL,
    `groupid`      int(10) unsigned    NOT NULL,
    `credit1`      int(10) unsigned    NOT NULL,
    `credit2`      int(10) unsigned    NOT NULL,
    `couponid`     int(10) unsigned    NOT NULL,
    `granttime`    int(10) unsigned    NOT NULL,
    `days`         int(10) unsigned    NOT NULL,
    `time`         tinyint(3) unsigned NOT NULL,
    `show_in_card` tinyint(3) unsigned NOT NULL,
    `content`      varchar(1000)       NOT NULL,
    `sms_notice`   tinyint(3) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_mc_card_credit_set`
(
    `id`      int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid` int(10) unsigned NOT NULL,
    `sign`    varchar(1000)    NOT NULL,
    `share`   varchar(500)     NOT NULL,
    `content` text             NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_mc_card_members`
(
    `id`         int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid`    int(10) unsigned NOT NULL,
    `uid`        int(10) DEFAULT NULL,
    `openid`     varchar(50)      NOT NULL,
    `cid`        int(10)          NOT NULL,
    `cardsn`     varchar(20)      NOT NULL,
    `status`     tinyint(1)       NOT NULL,
    `createtime` int(10) unsigned NOT NULL,
    `nums`       int(10) unsigned NOT NULL,
    `endtime`    int(10) unsigned NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_mc_card_notices`
(
    `id`      int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `uniacid` int(10) unsigned    NOT NULL,
    `uid`     int(10) unsigned    NOT NULL,
    `type`    tinyint(3) unsigned NOT NULL,
    `title`   varchar(30)         NOT NULL,
    `thumb`   varchar(100)        NOT NULL,
    `groupid` int(10) unsigned    NOT NULL,
    `content` text                NOT NULL,
    `addtime` int(10) unsigned    NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`),
    KEY `uid` (`uid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_mc_card_notices_unread`
(
    `id`        int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `uniacid`   int(10) unsigned    NOT NULL,
    `notice_id` int(10) unsigned    NOT NULL,
    `uid`       int(10) unsigned    NOT NULL,
    `is_new`    tinyint(3) unsigned NOT NULL,
    `type`      tinyint(3) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`),
    KEY `uid` (`uid`),
    KEY `notice_id` (`notice_id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_mc_card_recommend`
(
    `id`           int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `uniacid`      int(10) unsigned    NOT NULL,
    `title`        varchar(30)         NOT NULL,
    `thumb`        varchar(100)        NOT NULL,
    `url`          varchar(100)        NOT NULL,
    `displayorder` tinyint(3) unsigned NOT NULL,
    `addtime`      int(10) unsigned    NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_mc_card_record`
(
    `id`      int(10) unsigned        NOT NULL AUTO_INCREMENT,
    `uniacid` int(10) unsigned        NOT NULL,
    `uid`     int(10) unsigned        NOT NULL,
    `type`    varchar(15)             NOT NULL,
    `model`   tinyint(3) unsigned     NOT NULL,
    `fee`     decimal(10, 2) unsigned NOT NULL,
    `tag`     varchar(10)             NOT NULL,
    `note`    varchar(255)            NOT NULL,
    `remark`  varchar(200)            NOT NULL,
    `addtime` int(10) unsigned        NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`),
    KEY `uid` (`uid`),
    KEY `addtime` (`addtime`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_mc_card_sign_record`
(
    `id`       int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `uniacid`  int(10) unsigned    NOT NULL,
    `uid`      int(10) unsigned    NOT NULL,
    `credit`   int(10) unsigned    NOT NULL,
    `is_grant` tinyint(3) unsigned NOT NULL,
    `addtime`  int(10) unsigned    NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`),
    KEY `uid` (`uid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_mc_cash_record`
(
    `id`          int(10) unsigned        NOT NULL AUTO_INCREMENT,
    `uniacid`     int(10) unsigned        NOT NULL,
    `uid`         int(10) unsigned        NOT NULL,
    `clerk_id`    int(10) unsigned        NOT NULL,
    `store_id`    int(10) unsigned        NOT NULL,
    `clerk_type`  tinyint(3) unsigned     NOT NULL,
    `fee`         decimal(10, 2) unsigned NOT NULL,
    `final_fee`   decimal(10, 2) unsigned NOT NULL,
    `credit1`     int(10) unsigned        NOT NULL,
    `credit1_fee` decimal(10, 2) unsigned NOT NULL,
    `credit2`     decimal(10, 2) unsigned NOT NULL,
    `cash`        decimal(10, 2) unsigned NOT NULL,
    `return_cash` decimal(10, 2) unsigned NOT NULL,
    `final_cash`  decimal(10, 2) unsigned NOT NULL,
    `remark`      varchar(255)            NOT NULL,
    `createtime`  int(10) unsigned        NOT NULL,
    `trade_type`  varchar(20)             NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`),
    KEY `uid` (`uid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_mc_chats_record`
(
    `id`         int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `uniacid`    int(10) unsigned    NOT NULL,
    `acid`       int(10) unsigned    NOT NULL,
    `flag`       tinyint(3) unsigned NOT NULL,
    `openid`     varchar(32)         NOT NULL,
    `msgtype`    varchar(15)         NOT NULL,
    `content`    varchar(10000)      NOT NULL,
    `createtime` int(10) unsigned    NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`, `acid`),
    KEY `openid` (`openid`),
    KEY `createtime` (`createtime`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_mc_credits_recharge`
(
    `id`         int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `uniacid`    int(10) unsigned    NOT NULL,
    `uid`        int(10) unsigned    NOT NULL,
    `openid`     varchar(50)         NOT NULL,
    `tid`        varchar(64)         NOT NULL,
    `transid`    varchar(30)         NOT NULL,
    `fee`        varchar(10)         NOT NULL,
    `type`       varchar(15)         NOT NULL,
    `tag`        varchar(10)         NOT NULL,
    `status`     tinyint(1)          NOT NULL,
    `createtime` int(10) unsigned    NOT NULL,
    `backtype`   tinyint(3) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `idx_uniacid_uid` (`uniacid`, `uid`),
    KEY `idx_tid` (`tid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_mc_credits_record`
(
    `id`         int(11)             NOT NULL AUTO_INCREMENT,
    `uid`        int(10) unsigned    NOT NULL,
    `uniacid`    int(11)             NOT NULL,
    `credittype` varchar(10)         NOT NULL,
    `num`        decimal(10, 2)      NOT NULL,
    `operator`   int(10) unsigned    NOT NULL,
    `module`     varchar(30)         NOT NULL,
    `clerk_id`   int(10) unsigned    NOT NULL,
    `store_id`   int(10) unsigned    NOT NULL,
    `clerk_type` tinyint(3) unsigned NOT NULL,
    `createtime` int(10) unsigned    NOT NULL,
    `remark`     varchar(200)        NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`),
    KEY `uid` (`uid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_mc_fans_groups`
(
    `id`      int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid` int(10) unsigned NOT NULL,
    `acid`    int(10) unsigned NOT NULL,
    `groups`  varchar(10000)   NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_mc_fans_tag_mapping`
(
    `id`    int(11) unsigned    NOT NULL AUTO_INCREMENT,
    `fanid` int(11) unsigned    NOT NULL,
    `tagid` tinyint(3) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `mapping` (`fanid`, `tagid`) USING BTREE,
    KEY `fanid_index` (`fanid`) USING BTREE,
    KEY `tagid_index` (`tagid`) USING BTREE
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  ROW_FORMAT = FIXED;

CREATE TABLE IF NOT EXISTS `ims_mc_groups`
(
    `groupid`   int(11)          NOT NULL AUTO_INCREMENT,
    `uniacid`   int(11)          NOT NULL,
    `title`     varchar(20)      NOT NULL,
    `credit`    int(10) unsigned NOT NULL,
    `isdefault` tinyint(4)       NOT NULL,
    PRIMARY KEY (`groupid`),
    KEY `uniacid` (`uniacid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_mc_handsel`
(
    `id`           int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid`      int(10)          NOT NULL,
    `touid`        int(10) unsigned NOT NULL,
    `fromuid`      varchar(32)      NOT NULL,
    `module`       varchar(30)      NOT NULL,
    `sign`         varchar(100)     NOT NULL,
    `action`       varchar(20)      NOT NULL,
    `credit_value` int(10) unsigned NOT NULL,
    `createtime`   int(10) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uid` (`touid`),
    KEY `uniacid` (`uniacid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

-- 公众号粉丝表，已关注的会员为粉丝
CREATE TABLE IF NOT EXISTS `ims_mc_mapping_fans`
(
    `fanid`        int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `acid`         int(10) unsigned    NOT NULL,
    `uniacid`      int(10) unsigned    NOT NULL,
    `uid`          int(10) unsigned    NOT NULL,
    `openid`       varchar(50)         NOT NULL,
    `nickname`     varchar(50)         NOT NULL,
    `groupid`      varchar(30)         NOT NULL,
    `salt`         char(8)             NOT NULL,
    `follow`       tinyint(1) unsigned NOT NULL,
    `followtime`   int(10) unsigned    NOT NULL,
    `unfollowtime` int(10) unsigned    NOT NULL,
    `tag`          varchar(1000)       NOT NULL,
    `updatetime`   int(10) unsigned DEFAULT NULL,
    `unionid`      varchar(64)         NOT NULL,
    PRIMARY KEY (`fanid`),
    UNIQUE KEY `openid_2` (`openid`) USING BTREE,
    KEY `acid` (`acid`),
    KEY `uniacid` (`uniacid`),
    KEY `updatetime` (`updatetime`),
    KEY `nickname` (`nickname`),
    KEY `uid` (`uid`),
    KEY `openid` (`openid`) USING BTREE
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_mc_mapping_ucenter`
(
    `id`        int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid`   int(10) unsigned NOT NULL,
    `uid`       int(10) unsigned NOT NULL,
    `centeruid` int(10) unsigned NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_mc_mass_record`
(
    `id`            int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `uniacid`       int(10) unsigned    NOT NULL,
    `acid`          int(10) unsigned    NOT NULL,
    `groupname`     varchar(50)         NOT NULL,
    `fansnum`       int(10) unsigned    NOT NULL,
    `msgtype`       varchar(10)         NOT NULL,
    `content`       varchar(10000)      NOT NULL,
    `group`         int(10)             NOT NULL,
    `attach_id`     int(10) unsigned    NOT NULL,
    `media_id`      varchar(100)        NOT NULL,
    `type`          tinyint(3) unsigned NOT NULL,
    `status`        tinyint(3) unsigned NOT NULL,
    `cron_id`       int(10) unsigned    NOT NULL,
    `sendtime`      int(10) unsigned    NOT NULL,
    `finalsendtime` int(10) unsigned    NOT NULL,
    `createtime`    int(10) unsigned    NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`, `acid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_mc_member_address`
(
    `id`        int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `uniacid`   int(10) unsigned    NOT NULL,
    `uid`       int(50) unsigned    NOT NULL,
    `username`  varchar(20)         NOT NULL,
    `mobile`    varchar(11)         NOT NULL,
    `zipcode`   varchar(6)          NOT NULL,
    `province`  varchar(32)         NOT NULL,
    `city`      varchar(32)         NOT NULL,
    `district`  varchar(32)         NOT NULL,
    `address`   varchar(512)        NOT NULL,
    `isdefault` tinyint(1) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `idx_uinacid` (`uniacid`),
    KEY `idx_uid` (`uid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_mc_member_fields`
(
    `id`           int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid`      int(10)          NOT NULL,
    `fieldid`      int(10)          NOT NULL,
    `title`        varchar(255)     NOT NULL,
    `available`    tinyint(1)       NOT NULL,
    `displayorder` smallint(6)      NOT NULL,
    PRIMARY KEY (`id`),
    KEY `idx_uniacid` (`uniacid`),
    KEY `idx_fieldid` (`fieldid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_mc_member_property`
(
    `id`       int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid`  int(11)          NOT NULL,
    `property` varchar(200)     NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  ROW_FORMAT = DYNAMIC;

-- 会员表
CREATE TABLE IF NOT EXISTS `ims_mc_members`
(
    `uid`             int(10) unsigned        NOT NULL AUTO_INCREMENT,
    `uniacid`         int(10) unsigned        NOT NULL,
    `mobile`          varchar(11)             NOT NULL,
    `email`           varchar(50)             NOT NULL,
    `password`        varchar(32)             NOT NULL,
    `salt`            varchar(8)              NOT NULL,
    `groupid`         int(11)                 NOT NULL,
    `credit1`         decimal(10, 2) unsigned NOT NULL,
    `credit2`         decimal(10, 2) unsigned NOT NULL,
    `credit3`         decimal(10, 2) unsigned NOT NULL,
    `credit4`         decimal(10, 2) unsigned NOT NULL,
    `credit5`         decimal(10, 2) unsigned NOT NULL,
    `credit6`         decimal(10, 2)          NOT NULL,
    `createtime`      int(10) unsigned        NOT NULL,
    `realname`        varchar(10)             NOT NULL,
    `nickname`        varchar(20)             NOT NULL,
    `avatar`          varchar(255)            NOT NULL,
    `qq`              varchar(15)             NOT NULL,
    `vip`             tinyint(3) unsigned     NOT NULL,
    `gender`          tinyint(1)              NOT NULL,
    `birthyear`       smallint(6) unsigned    NOT NULL,
    `birthmonth`      tinyint(3) unsigned     NOT NULL,
    `birthday`        tinyint(3) unsigned     NOT NULL,
    `constellation`   varchar(10)             NOT NULL,
    `zodiac`          varchar(5)              NOT NULL,
    `telephone`       varchar(15)             NOT NULL,
    `idcard`          varchar(30)             NOT NULL,
    `studentid`       varchar(50)             NOT NULL,
    `grade`           varchar(10)             NOT NULL,
    `address`         varchar(255)            NOT NULL,
    `zipcode`         varchar(10)             NOT NULL,
    `nationality`     varchar(30)             NOT NULL,
    `resideprovince`  varchar(30)             NOT NULL,
    `residecity`      varchar(30)             NOT NULL,
    `residedist`      varchar(30)             NOT NULL,
    `graduateschool`  varchar(50)             NOT NULL,
    `company`         varchar(50)             NOT NULL,
    `education`       varchar(10)             NOT NULL,
    `occupation`      varchar(30)             NOT NULL,
    `position`        varchar(30)             NOT NULL,
    `revenue`         varchar(10)             NOT NULL,
    `affectivestatus` varchar(30)             NOT NULL,
    `lookingfor`      varchar(255)            NOT NULL,
    `bloodtype`       varchar(5)              NOT NULL,
    `height`          varchar(5)              NOT NULL,
    `weight`          varchar(5)              NOT NULL,
    `alipay`          varchar(30)             NOT NULL,
    `msn`             varchar(30)             NOT NULL,
    `taobao`          varchar(30)             NOT NULL,
    `site`            varchar(30)             NOT NULL,
    `bio`             text                    NOT NULL,
    `interest`        text                    NOT NULL,
    `pay_password`    varchar(30)             NOT NULL,
    PRIMARY KEY (`uid`),
    KEY `groupid` (`groupid`),
    KEY `uniacid` (`uniacid`),
    KEY `email` (`email`) USING BTREE,
    KEY `mobile` (`mobile`) USING BTREE
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_mc_oauth_fans`
(
    `id`           int(10) unsigned NOT NULL AUTO_INCREMENT,
    `oauth_openid` varchar(50)      NOT NULL,
    `acid`         int(10) unsigned NOT NULL,
    `uid`          int(10) unsigned NOT NULL,
    `openid`       varchar(50)      NOT NULL,
    PRIMARY KEY (`id`),
    KEY `idx_oauthopenid_acid` (`oauth_openid`, `acid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_menu_event`
(
    `id`         int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid`    int(10) unsigned NOT NULL,
    `keyword`    varchar(30)      NOT NULL,
    `type`       varchar(30)      NOT NULL,
    `picmd5`     varchar(32)      NOT NULL,
    `openid`     varchar(128)     NOT NULL,
    `createtime` int(10) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`),
    KEY `picmd5` (`picmd5`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_message_notice_log`
(
    `id`          int(11)      NOT NULL AUTO_INCREMENT,
    `message`     varchar(255) NOT NULL,
    `is_read`     tinyint(3)   NOT NULL,
    `uid`         int(11)      NOT NULL,
    `sign`        varchar(22)  NOT NULL,
    `type`        tinyint(3)   NOT NULL,
    `status`      tinyint(3) DEFAULT NULL,
    `create_time` int(11)      NOT NULL,
    `end_time`    int(11)      NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  ROW_FORMAT = DYNAMIC;

CREATE TABLE IF NOT EXISTS `ims_mobilenumber`
(
    `id`       int(11)             NOT NULL AUTO_INCREMENT,
    `rid`      int(10)             NOT NULL,
    `enabled`  tinyint(1) unsigned NOT NULL,
    `dateline` int(11) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_modules`
(
    `mid`              int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `name`             varchar(100)        NOT NULL,
    `type`             varchar(20)         NOT NULL,
    `title`            varchar(100)        NOT NULL,
    `version`          varchar(15)         NOT NULL,
    `ability`          varchar(500)        NOT NULL,
    `description`      varchar(1000)       NOT NULL,
    `author`           varchar(50)         NOT NULL,
    `url`              varchar(255)        NOT NULL,
    `settings`         tinyint(1)          NOT NULL,
    `subscribes`       varchar(500)        NOT NULL,
    `handles`          varchar(500)        NOT NULL,
    `isrulefields`     tinyint(1)          NOT NULL,
    `issystem`         tinyint(1) unsigned NOT NULL,
    `target`           int(10) unsigned    NOT NULL,
    `iscard`           tinyint(3) unsigned NOT NULL,
    `permissions`      varchar(5000)       NOT NULL,
    `title_initial`    varchar(1)          NOT NULL,
    `wxapp_support`    tinyint(1)          NOT NULL,
    `app_support`      tinyint(1)          NOT NULL,
    `welcome_support`  int(2)              NOT NULL,
    `oauth_type`       tinyint(1)          NOT NULL,
    `webapp_support`   tinyint(1)          NOT NULL,
    `phoneapp_support` tinyint(1)          NOT NULL,
    PRIMARY KEY (`mid`),
    KEY `idx_name` (`name`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_modules_bindings`
(
    `eid`          int(11)               NOT NULL AUTO_INCREMENT,
    `module`       varchar(30)           NOT NULL,
    `entry`        varchar(10)           NOT NULL,
    `call`         varchar(50)           NOT NULL,
    `title`        varchar(50)           NOT NULL,
    `do`           varchar(30)           NOT NULL,
    `state`        varchar(200)          NOT NULL,
    `direct`       int(11)               NOT NULL,
    `url`          varchar(100)          NOT NULL,
    `icon`         varchar(50)           NOT NULL,
    `displayorder` tinyint(255) unsigned NOT NULL,
    PRIMARY KEY (`eid`),
    KEY `idx_module` (`module`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_modules_plugin`
(
    `id`          int(11) NOT NULL AUTO_INCREMENT,
    `name`        varchar(100) DEFAULT NULL,
    `main_module` varchar(100) DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `name` (`name`) USING BTREE,
    KEY `main_module` (`main_module`) USING BTREE
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  ROW_FORMAT = DYNAMIC;

CREATE TABLE IF NOT EXISTS `ims_modules_rank`
(
    `id`          int(10) unsigned NOT NULL AUTO_INCREMENT,
    `module_name` varchar(100)     NOT NULL,
    `uid`         int(10)          NOT NULL,
    `rank`        int(10)          NOT NULL,
    PRIMARY KEY (`id`),
    KEY `module_name` (`module_name`) USING BTREE,
    KEY `uid` (`uid`) USING BTREE
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  ROW_FORMAT = DYNAMIC;

CREATE TABLE IF NOT EXISTS `ims_modules_recycle`
(
    `id`         int(10)      NOT NULL AUTO_INCREMENT,
    `modulename` varchar(255) NOT NULL,
    PRIMARY KEY (`id`),
    KEY `modulename` (`modulename`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_music_reply`
(
    `id`          int(10) unsigned NOT NULL AUTO_INCREMENT,
    `rid`         int(10) unsigned NOT NULL,
    `title`       varchar(50)      NOT NULL,
    `description` varchar(255)     NOT NULL,
    `url`         varchar(300)     NOT NULL,
    `hqurl`       varchar(300)     NOT NULL,
    PRIMARY KEY (`id`),
    KEY `rid` (`rid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_news_reply`
(
    `id`           int(10) unsigned NOT NULL AUTO_INCREMENT,
    `rid`          int(10) unsigned NOT NULL,
    `parent_id`    int(10)          NOT NULL,
    `title`        varchar(50)      NOT NULL,
    `author`       varchar(64)      NOT NULL,
    `description`  varchar(255)     NOT NULL,
    `thumb`        varchar(500)     NOT NULL,
    `content`      mediumtext       NOT NULL,
    `url`          varchar(255)     NOT NULL,
    `displayorder` int(10)          NOT NULL,
    `incontent`    tinyint(1)       NOT NULL,
    `createtime`   int(10)          NOT NULL,
    `media_id`     varchar(50)      NOT NULL,
    PRIMARY KEY (`id`),
    KEY `rid` (`rid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_paycenter_order`
(
    `id`             int(10) unsigned        NOT NULL AUTO_INCREMENT,
    `uniacid`        int(10) unsigned        NOT NULL,
    `uid`            int(10) unsigned        NOT NULL,
    `pid`            int(10) unsigned        NOT NULL,
    `clerk_id`       int(10) unsigned        NOT NULL,
    `store_id`       int(10) unsigned        NOT NULL,
    `clerk_type`     tinyint(3) unsigned     NOT NULL,
    `uniontid`       varchar(40)             NOT NULL,
    `transaction_id` varchar(40)             NOT NULL,
    `type`           varchar(10)             NOT NULL,
    `trade_type`     varchar(10)             NOT NULL,
    `body`           varchar(255)            NOT NULL,
    `fee`            varchar(15)             NOT NULL,
    `final_fee`      decimal(10, 2) unsigned NOT NULL,
    `credit1`        int(10) unsigned        NOT NULL,
    `credit1_fee`    decimal(10, 2) unsigned NOT NULL,
    `credit2`        decimal(10, 2) unsigned NOT NULL,
    `cash`           decimal(10, 2) unsigned NOT NULL,
    `remark`         varchar(255)            NOT NULL,
    `auth_code`      varchar(30)             NOT NULL,
    `openid`         varchar(50)             NOT NULL,
    `nickname`       varchar(50)             NOT NULL,
    `follow`         tinyint(3) unsigned     NOT NULL,
    `status`         tinyint(3) unsigned     NOT NULL,
    `credit_status`  tinyint(3) unsigned     NOT NULL,
    `paytime`        int(10) unsigned        NOT NULL,
    `createtime`     int(10) unsigned        NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_phoneapp_versions`
(
    `id`          int(10)      NOT NULL AUTO_INCREMENT,
    `uniacid`     int(10)      NOT NULL,
    `version`     varchar(20) DEFAULT NULL,
    `description` varchar(255) NOT NULL,
    `modules`     text,
    `createtime`  int(10)      NOT NULL,
    PRIMARY KEY (`id`),
    KEY `version` (`version`) USING BTREE,
    KEY `uniacid` (`uniacid`) USING BTREE
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  ROW_FORMAT = DYNAMIC;

CREATE TABLE IF NOT EXISTS `ims_profile_fields`
(
    `id`             int(10) unsigned NOT NULL AUTO_INCREMENT,
    `field`          varchar(255)     NOT NULL,
    `available`      tinyint(1)       NOT NULL,
    `title`          varchar(255)     NOT NULL,
    `description`    varchar(255)     NOT NULL,
    `displayorder`   smallint(6)      NOT NULL,
    `required`       tinyint(1)       NOT NULL,
    `unchangeable`   tinyint(1)       NOT NULL,
    `showinregister` tinyint(1)       NOT NULL,
    `field_length`   int(10)          NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_qrcode`
(
    `id`         int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `uniacid`    int(10) unsigned    NOT NULL,
    `acid`       int(10) unsigned    NOT NULL,
    `type`       varchar(10)         NOT NULL,
    `extra`      int(10) unsigned    NOT NULL,
    `qrcid`      bigint(20)          NOT NULL,
    `scene_str`  varchar(64)         NOT NULL,
    `name`       varchar(50)         NOT NULL,
    `keyword`    varchar(100)        NOT NULL,
    `model`      tinyint(1) unsigned NOT NULL,
    `ticket`     varchar(250)        NOT NULL,
    `url`        varchar(256)        NOT NULL,
    `expire`     int(10) unsigned    NOT NULL,
    `subnum`     int(10) unsigned    NOT NULL,
    `createtime` int(10) unsigned    NOT NULL,
    `status`     tinyint(1) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `idx_qrcid` (`qrcid`),
    KEY `uniacid` (`uniacid`),
    KEY `ticket` (`ticket`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_qrcode_stat`
(
    `id`         int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `uniacid`    int(10) unsigned    NOT NULL,
    `acid`       int(10) unsigned    NOT NULL,
    `qid`        int(10) unsigned    NOT NULL,
    `openid`     varchar(50)         NOT NULL,
    `type`       tinyint(1) unsigned NOT NULL,
    `qrcid`      bigint(20) unsigned NOT NULL,
    `scene_str`  varchar(64)         NOT NULL,
    `name`       varchar(50)         NOT NULL,
    `createtime` int(10) unsigned    NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_rule`
(
    `id`           int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `uniacid`      int(10) unsigned    NOT NULL,
    `name`         varchar(50)         NOT NULL,
    `module`       varchar(50)         NOT NULL,
    `displayorder` int(10) unsigned    NOT NULL,
    `status`       tinyint(1) unsigned NOT NULL,
    `containtype`  varchar(100)        NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_rule_keyword`
(
    `id`           int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `rid`          int(10) unsigned    NOT NULL,
    `uniacid`      int(10) unsigned    NOT NULL,
    `module`       varchar(50)         NOT NULL,
    `content`      varchar(255)        NOT NULL,
    `type`         tinyint(1) unsigned NOT NULL,
    `displayorder` tinyint(3) unsigned NOT NULL,
    `status`       tinyint(1) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `idx_content` (`content`),
    KEY `idx_rid` (`rid`),
    KEY `idx_uniacid_type_content` (`uniacid`, `type`, `content`),
    KEY `rid` (`rid`) USING BTREE
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_site_article`
(
    `id`           int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `uniacid`      int(10) unsigned    NOT NULL,
    `rid`          int(10) unsigned    NOT NULL,
    `kid`          int(10) unsigned    NOT NULL,
    `iscommend`    tinyint(1)          NOT NULL,
    `ishot`        tinyint(1) unsigned NOT NULL,
    `pcate`        int(10) unsigned    NOT NULL,
    `ccate`        int(10) unsigned    NOT NULL,
    `template`     varchar(300)        NOT NULL,
    `title`        varchar(100)        NOT NULL,
    `description`  varchar(100)        NOT NULL,
    `content`      mediumtext          NOT NULL,
    `thumb`        varchar(255)        NOT NULL,
    `incontent`    tinyint(1)          NOT NULL,
    `source`       varchar(255)        NOT NULL,
    `author`       varchar(50)         NOT NULL,
    `displayorder` int(10) unsigned    NOT NULL,
    `linkurl`      varchar(500)        NOT NULL,
    `createtime`   int(10) unsigned    NOT NULL,
    `edittime`     int(10)             NOT NULL,
    `click`        int(10) unsigned    NOT NULL,
    `type`         varchar(10)         NOT NULL,
    `credit`       varchar(255)        NOT NULL,
    PRIMARY KEY (`id`),
    KEY `idx_iscommend` (`iscommend`),
    KEY `idx_ishot` (`ishot`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_site_category`
(
    `id`           int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `uniacid`      int(10) unsigned    NOT NULL,
    `nid`          int(10) unsigned    NOT NULL,
    `name`         varchar(50)         NOT NULL,
    `parentid`     int(10) unsigned    NOT NULL,
    `displayorder` tinyint(3) unsigned NOT NULL,
    `enabled`      tinyint(1) unsigned NOT NULL,
    `icon`         varchar(100)        NOT NULL,
    `description`  varchar(100)        NOT NULL,
    `styleid`      int(10) unsigned    NOT NULL,
    `linkurl`      varchar(500)        NOT NULL,
    `ishomepage`   tinyint(1)          NOT NULL,
    `icontype`     tinyint(1) unsigned NOT NULL,
    `css`          varchar(500)        NOT NULL,
    `multiid`      int(11)             NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_site_multi`
(
    `id`        int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `uniacid`   int(10) unsigned    NOT NULL,
    `title`     varchar(30)         NOT NULL,
    `styleid`   int(10) unsigned    NOT NULL,
    `site_info` text                NOT NULL,
    `status`    tinyint(3) unsigned NOT NULL,
    `bindhost`  varchar(255)        NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`),
    KEY `bindhost` (`bindhost`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_site_nav`
(
    `id`           int(10) unsigned     NOT NULL AUTO_INCREMENT,
    `uniacid`      int(10) unsigned     NOT NULL,
    `multiid`      int(10) unsigned     NOT NULL,
    `section`      tinyint(4)           NOT NULL,
    `module`       varchar(50)          NOT NULL,
    `displayorder` smallint(5) unsigned NOT NULL,
    `name`         varchar(50)          NOT NULL,
    `description`  varchar(1000)        NOT NULL,
    `position`     tinyint(4)           NOT NULL,
    `url`          varchar(255)         NOT NULL,
    `icon`         varchar(500)         NOT NULL,
    `css`          varchar(1000)        NOT NULL,
    `status`       tinyint(1) unsigned  NOT NULL,
    `categoryid`   int(10) unsigned     NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`),
    KEY `multiid` (`multiid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_site_page`
(
    `id`          int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `uniacid`     int(10) unsigned    NOT NULL,
    `multiid`     int(10) unsigned    NOT NULL,
    `title`       varchar(50)         NOT NULL,
    `description` varchar(255)        NOT NULL,
    `params`      longtext            NOT NULL,
    `html`        longtext            NOT NULL,
    `multipage`   longtext            NOT NULL,
    `type`        tinyint(1) unsigned NOT NULL,
    `status`      tinyint(1) unsigned NOT NULL,
    `createtime`  int(10) unsigned    NOT NULL,
    `goodnum`     int(10) unsigned    NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`),
    KEY `multiid` (`multiid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_site_slide`
(
    `id`           int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid`      int(10) unsigned NOT NULL,
    `multiid`      int(10) unsigned NOT NULL,
    `title`        varchar(255)     NOT NULL,
    `url`          varchar(255)     NOT NULL,
    `thumb`        varchar(255)     NOT NULL,
    `displayorder` tinyint(4)       NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`),
    KEY `multiid` (`multiid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_site_store_create_account`
(
    `id`      int(10)    NOT NULL AUTO_INCREMENT,
    `uid`     int(10)    NOT NULL,
    `uniacid` int(10)    NOT NULL,
    `type`    tinyint(4) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  ROW_FORMAT = FIXED;

CREATE TABLE IF NOT EXISTS `ims_site_store_goods`
(
    `id`            int(10) unsigned NOT NULL AUTO_INCREMENT,
    `type`          tinyint(1)       NOT NULL,
    `title`         varchar(100)     NOT NULL,
    `module`        varchar(50)      NOT NULL,
    `account_num`   int(10)          NOT NULL,
    `wxapp_num`     int(10)          NOT NULL,
    `price`         decimal(10, 2)   NOT NULL,
    `unit`          varchar(15)      NOT NULL,
    `slide`         varchar(1000)    NOT NULL,
    `category_id`   int(10)          NOT NULL,
    `title_initial` varchar(1)       NOT NULL,
    `status`        tinyint(1)       NOT NULL,
    `createtime`    int(10)          NOT NULL,
    `synopsis`      varchar(255)     NOT NULL,
    `description`   text             NOT NULL,
    `module_group`  int(10)          NOT NULL,
    `api_num`       int(10)          NOT NULL,
    PRIMARY KEY (`id`),
    KEY `module` (`module`) USING BTREE,
    KEY `category_id` (`category_id`) USING BTREE,
    KEY `price` (`price`) USING BTREE
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  ROW_FORMAT = DYNAMIC;

CREATE TABLE IF NOT EXISTS `ims_site_store_order`
(
    `id`          int(10) unsigned NOT NULL AUTO_INCREMENT,
    `orderid`     varchar(28)      NOT NULL,
    `goodsid`     int(10)          NOT NULL,
    `duration`    int(10)          NOT NULL,
    `buyer`       varchar(50)      NOT NULL,
    `buyerid`     int(10)          NOT NULL,
    `amount`      decimal(10, 2)   NOT NULL,
    `type`        tinyint(1)       NOT NULL,
    `changeprice` tinyint(1)       NOT NULL,
    `createtime`  int(10)          NOT NULL,
    `uniacid`     int(10)          NOT NULL,
    `endtime`     int(15)          NOT NULL,
    `wxapp`       int(15)          NOT NULL,
    PRIMARY KEY (`id`),
    KEY `goodid` (`goodsid`) USING BTREE,
    KEY `buyerid` (`buyerid`) USING BTREE
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  ROW_FORMAT = DYNAMIC;

CREATE TABLE IF NOT EXISTS `ims_site_styles`
(
    `id`         int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid`    int(10) unsigned NOT NULL,
    `templateid` int(10) unsigned NOT NULL,
    `name`       varchar(50)      NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_site_styles_vars`
(
    `id`          int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid`     int(10) unsigned NOT NULL,
    `templateid`  int(10) unsigned NOT NULL,
    `styleid`     int(10) unsigned NOT NULL,
    `variable`    varchar(50)      NOT NULL,
    `content`     text             NOT NULL,
    `description` varchar(50)      NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_site_templates`
(
    `id`          int(10) unsigned NOT NULL AUTO_INCREMENT,
    `name`        varchar(30)      NOT NULL,
    `title`       varchar(30)      NOT NULL,
    `version`     varchar(64)      NOT NULL,
    `description` varchar(500)     NOT NULL,
    `author`      varchar(50)      NOT NULL,
    `url`         varchar(255)     NOT NULL,
    `type`        varchar(20)      NOT NULL,
    `sections`    int(10) unsigned NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_stat_fans`
(
    `id`       int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid`  int(10) unsigned NOT NULL,
    `new`      int(10) unsigned NOT NULL,
    `cancel`   int(10) unsigned NOT NULL,
    `cumulate` int(10)          NOT NULL,
    `date`     varchar(8)       NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`, `date`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_stat_keyword`
(
    `id`         int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid`    int(10) unsigned NOT NULL,
    `rid`        varchar(10)      NOT NULL,
    `kid`        int(10) unsigned NOT NULL,
    `hit`        int(10) unsigned NOT NULL,
    `lastupdate` int(10) unsigned NOT NULL,
    `createtime` int(10) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `idx_createtime` (`createtime`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_stat_msg_history`
(
    `id`         int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid`    int(10) unsigned NOT NULL,
    `rid`        int(10) unsigned NOT NULL,
    `kid`        int(10) unsigned NOT NULL,
    `from_user`  varchar(50)      NOT NULL,
    `module`     varchar(50)      NOT NULL,
    `message`    varchar(1000)    NOT NULL,
    `type`       varchar(10)      NOT NULL,
    `createtime` int(10) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `idx_createtime` (`createtime`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_stat_rule`
(
    `id`         int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid`    int(10) unsigned NOT NULL,
    `rid`        int(10) unsigned NOT NULL,
    `hit`        int(10) unsigned NOT NULL,
    `lastupdate` int(10) unsigned NOT NULL,
    `createtime` int(10) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `idx_createtime` (`createtime`),
    KEY `rid` (`rid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_stat_visit`
(
    `id`      int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid` int(10)          NOT NULL,
    `module`  varchar(100)     NOT NULL,
    `count`   int(10) unsigned NOT NULL,
    `date`    int(10) unsigned NOT NULL,
    `type`    varchar(10)      NOT NULL,
    PRIMARY KEY (`id`),
    KEY `date` (`date`) USING BTREE,
    KEY `module` (`module`) USING BTREE,
    KEY `uniacid` (`uniacid`) USING BTREE
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  ROW_FORMAT = DYNAMIC;

CREATE TABLE IF NOT EXISTS `ims_uni_account`
(
    `uniacid`       int(10) unsigned NOT NULL AUTO_INCREMENT,
    `groupid`       int(10)          NOT NULL,
    `name`          varchar(100)     NOT NULL,
    `description`   varchar(255)     NOT NULL,
    `default_acid`  int(10) unsigned NOT NULL,
    `rank`          int(10) DEFAULT NULL,
    `title_initial` varchar(1)       NOT NULL,
    PRIMARY KEY (`uniacid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_uni_account_group`
(
    `id`      int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid` int(10) unsigned NOT NULL,
    `groupid` int(10)          NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_uni_account_menus`
(
    `id`                   int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `uniacid`              int(10) unsigned    NOT NULL,
    `menuid`               int(10) unsigned    NOT NULL,
    `type`                 tinyint(3) unsigned NOT NULL,
    `title`                varchar(30)         NOT NULL,
    `sex`                  tinyint(3) unsigned NOT NULL,
    `group_id`             int(10)             NOT NULL,
    `client_platform_type` tinyint(3) unsigned NOT NULL,
    `area`                 varchar(50)         NOT NULL,
    `data`                 text                NOT NULL,
    `status`               tinyint(3) unsigned NOT NULL,
    `createtime`           int(10) unsigned    NOT NULL,
    `isdeleted`            tinyint(3) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`),
    KEY `menuid` (`menuid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_uni_account_modules`
(
    `id`           int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `uniacid`      int(10) unsigned    NOT NULL,
    `module`       varchar(50)         NOT NULL,
    `enabled`      tinyint(1) unsigned NOT NULL,
    `settings`     text                NOT NULL,
    `shortcut`     tinyint(1) unsigned NOT NULL,
    `displayorder` int(10) unsigned    NOT NULL,
    PRIMARY KEY (`id`),
    KEY `idx_module` (`module`),
    KEY `idx_uniacid` (`uniacid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_uni_account_users`
(
    `id`      int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `uniacid` int(10) unsigned    NOT NULL,
    `uid`     int(10) unsigned    NOT NULL,
    `role`    varchar(255)        NOT NULL,
    `rank`    tinyint(3) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `idx_memberid` (`uid`),
    KEY `uniacid` (`uniacid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_uni_group`
(
    `id`        int(10) unsigned NOT NULL AUTO_INCREMENT,
    `owner_uid` int(10)          NOT NULL,
    `name`      varchar(50)      NOT NULL,
    `modules`   text             NOT NULL,
    `templates` varchar(5000)    NOT NULL,
    `uniacid`   int(10) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_uni_settings`
(
    `uniacid`         int(10) unsigned    NOT NULL,
    `passport`        varchar(200)        NOT NULL,
    `oauth`           varchar(100)        NOT NULL,
    `jsauth_acid`     int(10) unsigned    NOT NULL,
    `uc`              varchar(500)        NOT NULL,
    `notify`          varchar(2000)       NOT NULL,
    `creditnames`     varchar(500)        NOT NULL,
    `creditbehaviors` varchar(500)        NOT NULL,
    `welcome`         varchar(60)         NOT NULL,
    `default`         varchar(60)         NOT NULL,
    `default_message` varchar(2000)       NOT NULL,
    `payment`         text                NOT NULL,
    `stat`            varchar(300)        NOT NULL,
    `default_site`    int(10) unsigned DEFAULT NULL,
    `sync`            tinyint(3) unsigned NOT NULL,
    `recharge`        varchar(500)        NOT NULL,
    `tplnotice`       varchar(1000)       NOT NULL,
    `grouplevel`      tinyint(3) unsigned NOT NULL,
    `mcplugin`        varchar(500)        NOT NULL,
    `exchange_enable` tinyint(3) unsigned NOT NULL,
    `coupon_type`     tinyint(3) unsigned NOT NULL,
    `menuset`         text                NOT NULL,
    `statistics`      varchar(100)        NOT NULL,
    `bind_domain`     varchar(200)        NOT NULL,
    PRIMARY KEY (`uniacid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_uni_verifycode`
(
    `id`         int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `uniacid`    int(10) unsigned    NOT NULL,
    `receiver`   varchar(50)         NOT NULL,
    `verifycode` varchar(6)          NOT NULL,
    `total`      tinyint(3) unsigned NOT NULL,
    `createtime` int(10) unsigned    NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_userapi_cache`
(
    `id`         int(10) unsigned NOT NULL AUTO_INCREMENT,
    `key`        varchar(32)      NOT NULL,
    `content`    text             NOT NULL,
    `lastupdate` int(10) unsigned NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_userapi_reply`
(
    `id`           int(10) unsigned NOT NULL AUTO_INCREMENT,
    `rid`          int(10) unsigned NOT NULL,
    `description`  varchar(300)     NOT NULL,
    `apiurl`       varchar(300)     NOT NULL,
    `token`        varchar(32)      NOT NULL,
    `default_text` varchar(100)     NOT NULL,
    `cachetime`    int(10) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `rid` (`rid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_users`
(
    `uid`             int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `owner_uid`       int(10)             NOT NULL,
    `groupid`         int(10) unsigned    NOT NULL,
    `founder_groupid` tinyint(4)          NOT NULL,
    `username`        varchar(30)         NOT NULL,
    `password`        varchar(200)        NOT NULL,
    `salt`            varchar(10)         NOT NULL,
    `type`            tinyint(3) unsigned NOT NULL,
    `status`          tinyint(4)          NOT NULL,
    `joindate`        int(10) unsigned    NOT NULL,
    `joinip`          varchar(15)         NOT NULL,
    `lastvisit`       int(10) unsigned    NOT NULL,
    `lastip`          varchar(15)         NOT NULL,
    `remark`          varchar(500)        NOT NULL,
    `starttime`       int(10) unsigned    NOT NULL,
    `endtime`         int(10) unsigned    NOT NULL,
    `register_type`   tinyint(3)          NOT NULL,
    `openid`          varchar(50)         NOT NULL,
    PRIMARY KEY (`uid`),
    UNIQUE KEY `username` (`username`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_users_bind`
(
    `id`             int(11)      NOT NULL AUTO_INCREMENT,
    `uid`            int(11)      NOT NULL,
    `bind_sign`      varchar(50)  NOT NULL,
    `third_type`     tinyint(4)   NOT NULL,
    `third_nickname` varchar(255) NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uid` (`uid`) USING BTREE,
    KEY `bind_sign` (`bind_sign`) USING BTREE
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  ROW_FORMAT = DYNAMIC;

CREATE TABLE IF NOT EXISTS `ims_users_failed_login`
(
    `id`         int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `ip`         varchar(15)         NOT NULL,
    `username`   varchar(32)         NOT NULL,
    `count`      tinyint(1) unsigned NOT NULL,
    `lastupdate` int(10) unsigned    NOT NULL,
    PRIMARY KEY (`id`),
    KEY `ip_username` (`ip`, `username`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_users_founder_group`
(
    `id`            int(10) unsigned NOT NULL AUTO_INCREMENT,
    `name`          varchar(50)      NOT NULL,
    `package`       varchar(5000)    NOT NULL,
    `maxaccount`    int(10) unsigned NOT NULL,
    `maxsubaccount` int(10) unsigned NOT NULL,
    `timelimit`     int(10) unsigned NOT NULL,
    `maxwxapp`      int(10) unsigned NOT NULL,
    `maxwebapp`     int(10)          NOT NULL,
    `maxphoneapp`   int(10)          NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  ROW_FORMAT = DYNAMIC;

CREATE TABLE IF NOT EXISTS `ims_users_group`
(
    `id`            int(10) unsigned NOT NULL AUTO_INCREMENT,
    `owner_uid`     int(10)          NOT NULL,
    `name`          varchar(50)      NOT NULL,
    `package`       varchar(5000)    NOT NULL,
    `maxaccount`    int(10) unsigned NOT NULL,
    `maxsubaccount` int(10) unsigned NOT NULL,
    `timelimit`     int(10) unsigned NOT NULL,
    `maxwxapp`      int(10) unsigned NOT NULL,
    `maxwebapp`     int(10)          NOT NULL,
    `maxphoneapp`   int(10)          NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_users_invitation`
(
    `id`         int(10) unsigned NOT NULL AUTO_INCREMENT,
    `code`       varchar(64)      NOT NULL,
    `fromuid`    int(10) unsigned NOT NULL,
    `inviteuid`  int(10) unsigned NOT NULL,
    `createtime` int(10) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `idx_code` (`code`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_users_permission`
(
    `id`         int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid`    int(10) unsigned NOT NULL,
    `uid`        int(10) unsigned NOT NULL,
    `type`       varchar(100)     NOT NULL,
    `permission` varchar(10000)   NOT NULL,
    `url`        varchar(255)     NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_users_profile`
(
    `id`                    int(10) unsigned     NOT NULL AUTO_INCREMENT,
    `uid`                   int(10) unsigned     NOT NULL,
    `createtime`            int(10) unsigned     NOT NULL,
    `edittime`              int(10)              NOT NULL,
    `realname`              varchar(10)          NOT NULL,
    `nickname`              varchar(20)          NOT NULL,
    `avatar`                varchar(255)         NOT NULL,
    `qq`                    varchar(15)          NOT NULL,
    `mobile`                varchar(11)          NOT NULL,
    `fakeid`                varchar(30)          NOT NULL,
    `vip`                   tinyint(3) unsigned  NOT NULL,
    `gender`                tinyint(1)           NOT NULL,
    `birthyear`             smallint(6) unsigned NOT NULL,
    `birthmonth`            tinyint(3) unsigned  NOT NULL,
    `birthday`              tinyint(3) unsigned  NOT NULL,
    `constellation`         varchar(10)          NOT NULL,
    `zodiac`                varchar(5)           NOT NULL,
    `telephone`             varchar(15)          NOT NULL,
    `idcard`                varchar(30)          NOT NULL,
    `studentid`             varchar(50)          NOT NULL,
    `grade`                 varchar(10)          NOT NULL,
    `address`               varchar(255)         NOT NULL,
    `zipcode`               varchar(10)          NOT NULL,
    `nationality`           varchar(30)          NOT NULL,
    `resideprovince`        varchar(30)          NOT NULL,
    `residecity`            varchar(30)          NOT NULL,
    `residedist`            varchar(30)          NOT NULL,
    `graduateschool`        varchar(50)          NOT NULL,
    `company`               varchar(50)          NOT NULL,
    `education`             varchar(10)          NOT NULL,
    `occupation`            varchar(30)          NOT NULL,
    `position`              varchar(30)          NOT NULL,
    `revenue`               varchar(10)          NOT NULL,
    `affectivestatus`       varchar(30)          NOT NULL,
    `lookingfor`            varchar(255)         NOT NULL,
    `bloodtype`             varchar(5)           NOT NULL,
    `height`                varchar(5)           NOT NULL,
    `weight`                varchar(5)           NOT NULL,
    `alipay`                varchar(30)          NOT NULL,
    `msn`                   varchar(30)          NOT NULL,
    `email`                 varchar(50)          NOT NULL,
    `taobao`                varchar(30)          NOT NULL,
    `site`                  varchar(30)          NOT NULL,
    `bio`                   text                 NOT NULL,
    `interest`              text                 NOT NULL,
    `workerid`              varchar(64)          NOT NULL,
    `is_send_mobile_status` tinyint(3)           NOT NULL,
    `send_expire_status`    tinyint(3)           NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_video_reply`
(
    `id`          int(10) unsigned NOT NULL AUTO_INCREMENT,
    `rid`         int(10) unsigned NOT NULL,
    `title`       varchar(50)      NOT NULL,
    `description` varchar(255)     NOT NULL,
    `mediaid`     varchar(255)     NOT NULL,
    `createtime`  int(10)          NOT NULL,
    PRIMARY KEY (`id`),
    KEY `rid` (`rid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_voice_reply`
(
    `id`         int(10) unsigned NOT NULL AUTO_INCREMENT,
    `rid`        int(10) unsigned NOT NULL,
    `title`      varchar(50)      NOT NULL,
    `mediaid`    varchar(255)     NOT NULL,
    `createtime` int(10)          NOT NULL,
    PRIMARY KEY (`id`),
    KEY `rid` (`rid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_wechat_attachment`
(
    `id`                int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid`           int(10) unsigned NOT NULL,
    `acid`              int(10) unsigned NOT NULL,
    `uid`               int(10) unsigned NOT NULL,
    `filename`          varchar(255)     NOT NULL,
    `attachment`        varchar(255)     NOT NULL,
    `media_id`          varchar(255)     NOT NULL,
    `width`             int(10) unsigned NOT NULL,
    `height`            int(10) unsigned NOT NULL,
    `type`              varchar(15)      NOT NULL,
    `model`             varchar(25)      NOT NULL,
    `tag`               varchar(5000)    NOT NULL,
    `createtime`        int(10) unsigned NOT NULL,
    `module_upload_dir` varchar(100)     NOT NULL,
    `group_id`          int(11) DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`),
    KEY `media_id` (`media_id`),
    KEY `acid` (`acid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_wechat_news`
(
    `id`                 int(10) unsigned    NOT NULL AUTO_INCREMENT,
    `uniacid`            int(10) unsigned DEFAULT NULL,
    `attach_id`          int(10) unsigned    NOT NULL,
    `thumb_media_id`     varchar(60)         NOT NULL,
    `thumb_url`          varchar(255)        NOT NULL,
    `title`              varchar(50)         NOT NULL,
    `author`             varchar(30)         NOT NULL,
    `digest`             varchar(255)        NOT NULL,
    `content`            text                NOT NULL,
    `content_source_url` varchar(200)        NOT NULL,
    `show_cover_pic`     tinyint(3) unsigned NOT NULL,
    `url`                varchar(200)        NOT NULL,
    `displayorder`       int(2)              NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`),
    KEY `attach_id` (`attach_id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `ims_wxapp_general_analysis`
(
    `id`                int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid`           int(10)          NOT NULL,
    `session_cnt`       int(10)          NOT NULL,
    `visit_pv`          int(10)          NOT NULL,
    `visit_uv`          int(10)          NOT NULL,
    `visit_uv_new`      int(10)          NOT NULL,
    `type`              tinyint(2)       NOT NULL,
    `stay_time_uv`      varchar(10)      NOT NULL,
    `stay_time_session` varchar(10)      NOT NULL,
    `visit_depth`       varchar(10)      NOT NULL,
    `ref_date`          varchar(8)       NOT NULL,
    PRIMARY KEY (`id`),
    KEY `uniacid` (`uniacid`) USING BTREE,
    KEY `ref_date` (`ref_date`) USING BTREE
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  ROW_FORMAT = DYNAMIC;

CREATE TABLE IF NOT EXISTS `ims_wxapp_versions`
(
    `id`              int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uniacid`         int(10) unsigned NOT NULL,
    `multiid`         int(10) unsigned NOT NULL,
    `version`         varchar(10)      NOT NULL,
    `description`     varchar(255)     NOT NULL,
    `modules`         varchar(1000)    NOT NULL,
    `design_method`   tinyint(1)       NOT NULL,
    `template`        int(10)          NOT NULL,
    `quickmenu`       varchar(2500)    NOT NULL,
    `createtime`      int(10)          NOT NULL,
    `type`            int(2)           NOT NULL,
    `entry_id`        int(11)          NOT NULL,
    `appjson`         text             NOT NULL,
    `default_appjson` text             NOT NULL,
    `use_default`     tinyint(1)       NOT NULL,
    PRIMARY KEY (`id`),
    KEY `version` (`version`) USING BTREE,
    KEY `uniacid` (`uniacid`) USING BTREE
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  ROW_FORMAT = DYNAMIC;

CREATE TABLE IF NOT EXISTS `ims_wxcard_reply`
(
    `id`         int(10) unsigned NOT NULL AUTO_INCREMENT,
    `rid`        int(10) unsigned NOT NULL,
    `title`      varchar(30)      NOT NULL,
    `card_id`    varchar(50)      NOT NULL,
    `cid`        int(10) unsigned NOT NULL,
    `brand_name` varchar(30)      NOT NULL,
    `logo_url`   varchar(255)     NOT NULL,
    `success`    varchar(255)     NOT NULL,
    `error`      varchar(255)     NOT NULL,
    PRIMARY KEY (`id`),
    KEY `rid` (`rid`)
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8;
EOF;


$datas = array();
//1.4新增加表
$datas[] ="CREATE TABLE IF NOT EXISTS `ims_core_sessions` (`sid` char(32) NOT NULL,`uniacid` int(10) unsigned NOT NULL,`openid` varchar(50) NOT NULL,`data` varchar(5000) NOT NULL, `expiretime` int(10) unsigned NOT NULL, PRIMARY KEY (`sid`)) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

//公众号相关
$datas[] = "INSERT INTO `ims_account` (`acid`, `uniacid`, `hash`, `type`, `isconnect`) VALUES(1, 1, 'uRr8qvQV', 1, 0);";
$datas[] = <<<EOF
INSERT INTO `ims_account_wechats` (`acid`, `uniacid`, `token`, `encodingaeskey`, `level`, `name`, `account`, `original`,
                                   `signature`, `country`, `province`, `city`, `username`, `password`, `lastupdate`,
                                   `key`, `secret`, `styleid`, `subscribeurl`)
                                   VALUES (1, 1, 'omJNpZEhZeHj1ZxFECKkP48B5VFbk1HP', '', 1, '一道科技', '', '', '', '', '', '', '', '', 0, '', '', 1, '');
EOF;
$datas[] = "INSERT INTO `ims_uni_account` (`uniacid`, `groupid`, `name`, `description`, `default_acid`, `title_initial`) VALUES(1, -1, '一道宝', '一道宝系统', '1', 'W');";

$datas[] = "INSERT INTO `ims_uni_group` (`id`, `name`, `modules`, `templates`) VALUES(1, '体验套餐服务', 'N;', 'N;');";
$datas[] = <<<EOF
INSERT INTO `ims_uni_settings` (`uniacid`, `passport`, `oauth`, `uc`, `notify`, `creditnames`, `creditbehaviors`, `welcome`, `default`, `default_message`, `payment`, `stat`, `default_site`) VALUES
(1, 'a:3:{s:8:"focusreg";i:0;s:4:"item";s:5:"email";s:4:"type";s:8:"password";}', 'a:2:{s:6:"status";s:1:"0";s:7:"account";s:1:"0";}', 'a:1:{s:6:"status";i:0;}', 'a:1:{s:3:"sms";a:2:{s:7:"balance";i:0;s:9:"signature";s:0:"";}}', 'a:5:{s:7:"credit1";a:2:{s:5:"title";s:6:"积分";s:7:"enabled";i:1;}s:7:"credit2";a:2:{s:5:"title";s:6:"余额";s:7:"enabled";i:1;}s:7:"credit3";a:2:{s:5:"title";s:0:"";s:7:"enabled";i:0;}s:7:"credit4";a:2:{s:5:"title";s:0:"";s:7:"enabled";i:0;}s:7:"credit5";a:2:{s:5:"title";s:0:"";s:7:"enabled";i:0;}}', 'a:2:{s:8:"activity";s:7:"credit1";s:8:"currency";s:7:"credit2";}', '', '', '', 'a:4:{s:6:"credit";a:1:{s:6:"switch";b:0;}s:6:"alipay";a:4:{s:6:"switch";b:0;s:7:"account";s:0:"";s:7:"partner";s:0:"";s:6:"secret";s:0:"";}s:6:"wechat";a:5:{s:6:"switch";b:0;s:7:"account";b:0;s:7:"signkey";s:0:"";s:7:"partner";s:0:"";s:3:"key";s:0:"";}s:8:"delivery";a:1:{s:6:"switch";b:0;}}', '', 1);
EOF;


//微站相关
$datas[] = <<<EOF
INSERT INTO `ims_site_multi` (`id`, `uniacid`, `title`, `styleid`, `site_info`, `status`) VALUES
(1, 1, '一道宝', 1, '', 1);
EOF;
$datas[] = "INSERT INTO `ims_site_styles` (`id`, `uniacid`, `templateid`, `name`) VALUES(1, 1, 1, '微站默认模板_gC5C');";
$datas[] = "INSERT INTO `ims_site_templates` (`id`, `name`, `title`, `description`, `author`, `url`, `type`) VALUES(1, 'default', '微站默认模板', '由一道宝提供默认微站模板套系', '一道宝社区', 'http://www.yidaoit.cn', 1);";

$datas[] = <<<EOF
INSERT INTO `ims_core_settings` (`key`, `value`) VALUES
('copyright', 'a:1:{s:6:"slides";a:3:{i:0;s:58:"https://img.alicdn.com/tps/TB1pfG4IFXXXXc6XXXXXXXXXXXX.jpg";i:1;s:58:"https://img.alicdn.com/tps/TB1sXGYIFXXXXc5XpXXXXXXXXXX.jpg";i:2;s:58:"https://img.alicdn.com/tps/TB1h9xxIFXXXXbKXXXXXXXXXXXX.jpg";}}');
EOF;

//系统初始化数据
$datas[] = <<<EOF
INSERT INTO `ims_core_settings` (`key`, `value`) VALUES('authmode', 'i:1;'),('close', 'a:2:{s:6:"status";s:1:"0";s:6:"reason";s:0:"";}');
EOF;
$datas[] = <<<EOF
INSERT INTO `ims_core_settings` (`key`, `value`) VALUES ('register', 'a:4:{s:4:"open";i:1;s:6:"verify";i:0;s:4:"code";i:1;s:7:"groupid";i:1;}');
EOF;
$datas[] = "INSERT INTO `ims_mc_groups` (`groupid`, `uniacid`, `title`, `isdefault`) VALUES(1, 1, '默认会员组', 1);";

$datas[] = <<<EOF
INSERT INTO `ims_modules` (`mid`, `name`, `type`, `title`, `version`, `ability`, `description`, `author`, `url`, `settings`, `subscribes`, `handles`, `isrulefields`, `issystem`, `target`, `wxapp_support`, `app_support`) VALUES
(1, 'basic', 'system', '基本文字回复', '1.0', '和您进行简单对话', '一问一答得简单对话. 当访客的对话语句中包含指定关键字, 或对话语句完全等于特定关键字, 或符合某些特定的格式时. 系统自动应答设定好的回复内容.', 'WEB7 Club', 'http://www.yidaoit.cn/', 0, '', '', 1, 1, 0, 1, 2),
(2, 'news', 'system', '基本混合图文回复', '1.0', '为你提供生动的图文资讯', '一问一答得简单对话, 但是回复内容包括图片文字等更生动的媒体内容. 当访客的对话语句中包含指定关键字, 或对话语句完全等于特定关键字, 或符合某些特定的格式时. 系统自动应答设定好的图文回复内容.', 'We7 CC', 'http://www.yidaoit.cn/', 0, '', '', 1, 1, 0, 1, 2),
(3, 'music', 'system', '基本音乐回复', '1.0', '提供语音、音乐等音频类回复', '在回复规则中可选择具有语音、音乐等音频类的回复内容，并根据用户所设置的特定关键字精准的返回给粉丝，实现一问一答得简单对话。', 'We7 CC', 'http://www.yidaoit.cn/', 0, '', '', 1, 1, 0, 1, 2),
(4, 'userapi', 'system', '自定义接口回复', '1.1', '更方便的第三方接口设置', '自定义接口又称第三方接口，可以让开发者更方便的接入一道宝系统，高效的与微信公众平台进行对接整合。', 'We7 CC', 'http://www.yidaoit.cn/', 0, '', '', 1, 1, 0, 1, 2),
(5, 'recharge', 'system', '会员中心充值模块', '1.0', '提供会员充值功能', '', 'We7 CC', 'http://www.yidaoit.cn/', 0, '', '', 0, 1, 0, 1, 2),
(6, 'custom', 'system', '多客服转接', '1.0.0', '用来接入腾讯的多客服系统', '', 'We7 CC', 'http://www.yidaoit.cn', 0, 'a:0:{}', 'a:6:{i:0;s:5:"image";i:1;s:5:"voice";i:2;s:5:"video";i:3;s:8:"location";i:4;s:4:"link";i:5;s:4:"text";}', 1, 1, 0, 1, 2),
(7, 'images', 'system', '基本图片回复', '1.0', '提供图片回复', '在回复规则中可选择具有图片的回复内容，并根据用户所设置的特定关键字精准的返回给粉丝图片。', 'We7 CC', 'http://www.yidaoit.cn/', 0, '', '', 1, 1, 0, 1, 2),
(8, 'video', 'system', '基本视频回复', '1.0', '提供图片回复', '在回复规则中可选择具有视频的回复内容，并根据用户所设置的特定关键字精准的返回给粉丝视频。', 'We7 CC', 'http://www.yidaoit.cn/', 0, '', '', 1, 1, 0, 1, 2),
(9, 'voice', 'system', '基本语音回复', '1.0', '提供语音回复', '在回复规则中可选择具有语音的回复内容，并根据用户所设置的特定关键字精准的返回给粉丝语音。', 'We7 CC', 'http://www.yidaoit.cn/', 0, '', '', 1, 1, 0, 1, 2),
(10, 'chats', 'system', '发送客服消息', '1.0', '公众号可以在粉丝最后发送消息的48小时内无限制发送消息', '', 'We7 CC', 'http://www.yidaoit.cn/', '0', '', '', '0', '1', '0', 1, 2),
(11, 'wxcard', 'system', '微信卡券回复', '1.0', '微信卡券回复', '微信卡券回复', 'We7 CC', 'http://www.yidaoit.cn/', '0', '', '', '1', '1', '0', 1, 2);
EOF;

$datas[] = <<<EOF
INSERT INTO `ims_cover_reply` (`id`, `uniacid`, `multiid`, `rid`, `module`, `do`, `title`, `description`, `thumb`, `url`) VALUES
(1, 1, 0, 7, 'mc', '', '进入个人中心', '', '', './index.php?c=mc&a=home&i=1'),
(2, 1, 1, 8, 'site', '', '进入首页', '', '', './index.php?c=home&i=1&t=1');
EOF;

$datas[] = "INSERT INTO `ims_rule` (`id`, `uniacid`, `name`, `module`, `displayorder`, `status`) VALUES
(1, 0, '城市天气', 'userapi', 255, 1),
(2, 0, '百度百科', 'userapi', 255, 1),
(3, 0, '即时翻译', 'userapi', 255, 1),
(4, 0, '今日老黄历', 'userapi', 255, 1),
(5, 0, '看新闻', 'userapi', 255, 1),
(6, 0, '快递查询', 'userapi', 255, 1),
(7, 1, '个人中心入口设置', 'cover', 0, 1),
(8, 1, '一道宝系统入口设置', 'cover', 0, 1);";

$datas[] = "INSERT INTO `ims_rule_keyword` (`id`, `rid`, `uniacid`, `module`, `content`, `type`, `displayorder`, `status`) VALUES
(1, 1, 0, 'userapi', '^.+天气$', 3, 255, 1),
(2, 2, 0, 'userapi', '^百科.+$', 3, 255, 1),
(3, 2, 0, 'userapi', '^定义.+$', 3, 255, 1),
(4, 3, 0, 'userapi', '^@.+$', 3, 255, 1),
(5, 4, 0, 'userapi', '日历', 1, 255, 1),
(6, 4, 0, 'userapi', '万年历', 1, 255, 1),
(7, 4, 0, 'userapi', '黄历', 1, 255, 1),
(8, 4, 0, 'userapi', '几号', 1, 255, 1),
(9, 5, 0, 'userapi', '新闻', 1, 255, 1),
(10, 6, 0, 'userapi', '^(申通|圆通|中通|汇通|韵达|顺丰|EMS) *[a-z0-9]{1,}$', 3, 255, 1),
(11, 7, 1, 'cover', '个人中心', 1, 0, 1),
(12, 8, 1, 'cover', '首页', 1, 0, 1);";

//系统服务回复
$datas[] = <<<EOF
INSERT INTO `ims_userapi_reply` (`id`, `rid`, `description`, `apiurl`, `token`, `default_text`, `cachetime`) VALUES
(1, 1, '"城市名+天气", 如: "北京天气"', 'weather.php', '', '', 0),
(2, 2, '"百科+查询内容" 或 "定义+查询内容", 如: "百科姚明", "定义自行车"', 'baike.php', '', '', 0),
(3, 3, '"@查询内容(中文或英文)"', 'translate.php', '', '', 0),
(4, 4, '"日历", "万年历", "黄历"或"几号"', 'calendar.php', '', '', 0),
(5, 5, '"新闻"', 'news.php', '', '', 0),
(6, 6, '"快递+单号", 如: "申通1200041125"', 'express.php', '', '', 0);
EOF;


$datas[] = <<<EOF
INSERT INTO `ims_profile_fields` (`id`, `field`, `available`, `title`, `description`, `displayorder`, `required`, `unchangeable`, `showinregister`) VALUES
(1, 'realname', 1, '真实姓名', '', 0, 1, 1, 1),
(2, 'nickname', 1, '昵称', '', 1, 1, 0, 1),
(3, 'avatar', 1, '头像', '', 1, 0, 0, 0),
(4, 'qq', 1, 'QQ号', '', 0, 0, 0, 1),
(5, 'mobile', 1, '手机号码', '', 0, 0, 0, 0),
(6, 'vip', 1, 'VIP级别', '', 0, 0, 0, 0),
(7, 'gender', 1, '性别', '', 0, 0, 0, 0),
(8, 'birthyear', 1, '出生生日', '', 0, 0, 0, 0),
(9, 'constellation', 1, '星座', '', 0, 0, 0, 0),
(10, 'zodiac', 1, '生肖', '', 0, 0, 0, 0),
(11, 'telephone', 1, '固定电话', '', 0, 0, 0, 0),
(12, 'idcard', 1, '证件号码', '', 0, 0, 0, 0),
(13, 'studentid', 1, '学号', '', 0, 0, 0, 0),
(14, 'grade', 1, '班级', '', 0, 0, 0, 0),
(15, 'address', 1, '邮寄地址', '', 0, 0, 0, 0),
(16, 'zipcode', 1, '邮编', '', 0, 0, 0, 0),
(17, 'nationality', 1, '国籍', '', 0, 0, 0, 0),
(18, 'resideprovince', 1, '居住地址', '', 0, 0, 0, 0),
(19, 'graduateschool', 1, '毕业学校', '', 0, 0, 0, 0),
(20, 'company', 1, '公司', '', 0, 0, 0, 0),
(21, 'education', 1, '学历', '', 0, 0, 0, 0),
(22, 'occupation', 1, '职业', '', 0, 0, 0, 0),
(23, 'position', 1, '职位', '', 0, 0, 0, 0),
(24, 'revenue', 1, '年收入', '', 0, 0, 0, 0),
(25, 'affectivestatus', 1, '情感状态', '', 0, 0, 0, 0),
(26, 'lookingfor', 1, ' 交友目的', '', 0, 0, 0, 0),
(27, 'bloodtype', 1, '血型', '', 0, 0, 0, 0),
(28, 'height', 1, '身高', '', 0, 0, 0, 0),
(29, 'weight', 1, '体重', '', 0, 0, 0, 0),
(30, 'alipay', 1, '支付宝帐号', '', 0, 0, 0, 0),
(31, 'msn', 1, 'MSN', '', 0, 0, 0, 0),
(32, 'email', 1, '电子邮箱', '', 0, 0, 0, 0),
(33, 'taobao', 1, '阿里旺旺', '', 0, 0, 0, 0),
(34, 'site', 1, '主页', '', 0, 0, 0, 0),
(35, 'bio', 1, '自我介绍', '', 0, 0, 0, 0),
(36, 'interest', 1, '兴趣爱好', '', 0, 0, 0, 0);
EOF;

$dat = array();
$dat['schemas'] = explode(";", $schemas);
$dat['datas'] = $datas;
return $dat;