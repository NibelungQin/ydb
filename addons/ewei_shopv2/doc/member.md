### 会员

#### ewei_shop_member 会员

- 建表

    ```mysql
    CREATE TABLE `ims_ewei_shop_member` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `uniacid` int(11) DEFAULT '0',
      `uid` int(11) DEFAULT '0',
      `groupid` int(11) DEFAULT '0' comment '标签组id ","拼接',
      `level` int(11) DEFAULT '0' comment '会员等级id',
      `agentid` int(11) DEFAULT '0' comment '上级分销商id',
      `openid` varchar(50) DEFAULT '' comment 'openid 里面带有 sns_xx 来源',
      `realname` varchar(20) DEFAULT '' comment '真实姓名',
      `mobile` varchar(11) DEFAULT '' comment '手机号',
      `pwd` varchar(32) DEFAULT '' comment '密码',
      `weixin` varchar(100) DEFAULT '' comment '微信号',
      `content` text comment '备注',
      `createtime` int(10) DEFAULT '0',
      `agenttime` int(10) DEFAULT '0' comment '成为分销商时间',
      `status` tinyint(1) DEFAULT '0' comment '审核通过 0-否 1-是',
      `isagent` tinyint(1) DEFAULT '0' comment '分销商权限 0-否 1-是',
      `clickcount` int(11) DEFAULT '0',
      `agentlevel` int(11) DEFAULT '0'  comment '分销商等级id',
      `noticeset` text,
      `nickname` varchar(255) DEFAULT '' comment '昵称',
      `credit1` decimal(10,2) DEFAULT '0.00' comment '积分',
      `credit2` decimal(10,2) DEFAULT '0.00' comment '余额',
      `birthyear` varchar(255) DEFAULT '' comment '出生日期 年',
      `birthmonth` varchar(255) DEFAULT '' comment '出生日期 月',
      `birthday` varchar(255) DEFAULT '' comment '出生日期 日',
      `gender` tinyint(3) DEFAULT '0' comment '性别',
      `avatar` varchar(255) DEFAULT '' comment '头像',
      `province` varchar(255) DEFAULT '',
      `city` varchar(255) DEFAULT '',
      `area` varchar(255) DEFAULT '',
      `childtime` int(11) DEFAULT '0',
      `inviter` int(11) DEFAULT '0',
      `agentnotupgrade` int(11) DEFAULT '0' comment '强制不自动升级 0-允许自动升级 1-强制不自动升级',
      `agentselectgoods` tinyint(3) DEFAULT '0' comment '自选商品 0-系统设置 1-强制禁止 2-强制开启',
      `agentblack` int(11) DEFAULT '0',
      `fixagentid` tinyint(3) DEFAULT '0' comment '是否固定上级分销商 0-否 1-是',
      `diymemberid` int(11) DEFAULT '0',
      `diymemberfields` text,
      `diymemberdata` text comment '自定义表单会员信息',
      `diymemberdataid` int(11) DEFAULT '0',
      `diycommissionid` int(11) DEFAULT '0',
      `diycommissionfields` text,
      `diycommissiondata` text,
      `diycommissiondataid` int(11) DEFAULT '0',
      `isblack` int(11) DEFAULT '0' comment '是否在黑名单中 0-否 1-是',
      `username` varchar(255) DEFAULT '',
      `commission_total` decimal(10,2) DEFAULT '0.00' comment '累计佣金',
      `endtime2` int(11) DEFAULT '0',
      `ispartner` tinyint(3) DEFAULT '0',
      `partnertime` int(11) DEFAULT '0',
      `partnerstatus` tinyint(3) DEFAULT '0',
      `partnerblack` tinyint(3) DEFAULT '0',
      `partnerlevel` int(11) DEFAULT '0',
      `partnernotupgrade` tinyint(3) DEFAULT '0',
      `diyglobonusid` int(11) DEFAULT '0',
      `diyglobonusdata` text,
      `diyglobonusfields` text,
      `isaagent` tinyint(3) DEFAULT '0',
      `aagentlevel` int(11) DEFAULT '0',
      `aagenttime` int(11) DEFAULT '0',
      `aagentstatus` tinyint(3) DEFAULT '0',
      `aagentblack` tinyint(3) DEFAULT '0',
      `aagentnotupgrade` tinyint(3) DEFAULT '0',
      `aagenttype` tinyint(3) DEFAULT '0',
      `aagentprovinces` text,
      `aagentcitys` text,
      `aagentareas` text,
      `diyaagentid` int(11) DEFAULT '0',
      `diyaagentdata` text,
      `diyaagentfields` text,
      `salt` varchar(32) DEFAULT NULL,
      `mobileverify` tinyint(3) DEFAULT '0' comment '绑定手机号 0-未绑定 1-已绑定',
      `mobileuser` tinyint(3) DEFAULT '0',
      `carrier_mobile` varchar(11) DEFAULT '0',
      `isauthor` tinyint(1) DEFAULT '0',
      `authortime` int(11) DEFAULT '0',
      `authorstatus` tinyint(1) DEFAULT '0',
      `authorblack` tinyint(1) DEFAULT '0',
      `authorlevel` int(11) DEFAULT '0',
      `authornotupgrade` tinyint(1) DEFAULT '0',
      `diyauthorid` int(11) DEFAULT '0',
      `diyauthordata` text,
      `diyauthorfields` text,
      `authorid` int(11) DEFAULT '0',
      `comefrom` varchar(20) DEFAULT NULL,
      `openid_qq` varchar(50) DEFAULT NULL,
      `openid_wx` varchar(50) DEFAULT NULL,
      `diymaxcredit` tinyint(3) DEFAULT '0' comment '积分上限 0-读取系统设置 1-自定义',
      `maxcredit` int(11) DEFAULT '0' comment '会员积分上限，0为不限制(后台手动充值不限制，已持有积分不限制，保存后生效)',
      `datavalue` varchar(50) NOT NULL DEFAULT '',
      `openid_wa` varchar(50) DEFAULT NULL,
      `nickname_wechat` varchar(255) DEFAULT '',
      `avatar_wechat` varchar(255) DEFAULT '',
      `updateaddress` tinyint(1) NOT NULL DEFAULT '0',
      `membercardid` varchar(255) DEFAULT '',
      `membercardcode` varchar(255) DEFAULT '',
      `membershipnumber` varchar(255) DEFAULT '',
      `membercardactive` tinyint(1) DEFAULT '0',
      `commission` decimal(10,2) DEFAULT '0.00',
      `commission_pay` decimal(10,2) DEFAULT '0.00' comment '已打款佣金',
      `idnumber` varchar(255) DEFAULT NULL comment '身份证号',
      `wxcardupdatetime` int(11) DEFAULT '0',
      `hasnewcoupon` tinyint(1) DEFAULT '0',
      PRIMARY KEY (`id`),
      KEY `idx_uniacid` (`uniacid`),
      KEY `idx_shareid` (`agentid`),
      KEY `idx_openid` (`openid`),
      KEY `idx_status` (`status`),
      KEY `idx_agenttime` (`agenttime`),
      KEY `idx_isagent` (`isagent`),
      KEY `idx_uid` (`uid`),
      KEY `idx_groupid` (`groupid`),
      KEY `idx_level` (`level`)
    ) ENGINE=MyISAM AUTO_INCREMENT=2389 DEFAULT CHARSET=utf8;
    ```

#### ewei_shop_member_level 会员等级

- 建表

    ```mysql
    CREATE TABLE `ims_ewei_shop_member_level` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `uniacid` int(11) NOT NULL,
      `level` int(11) DEFAULT '0' comment '等级 数字越大等级越高',
      `levelname` varchar(50) DEFAULT '' comment '等级名称',
      `ordermoney` decimal(10,2) DEFAULT '0.00' comment '升级条件 完成订单金额满XX元',
      `ordercount` int(10) DEFAULT '0' comment '升级条件 完成订单数量满XX个',
      `discount` decimal(10,2) DEFAULT '0.00' comment '会员折扣',
      `enabled` tinyint(3) DEFAULT '0' comment '是否启用 0-禁止 1-启用',
      `enabledadd` tinyint(1) DEFAULT '0',
      `buygoods` tinyint(1) NOT NULL DEFAULT '0',
      `goodsids` text NOT NULL,
      PRIMARY KEY (`id`),
      KEY `idx_uniacid` (`uniacid`)
    ) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
    ```
   
#### ewei_shop_member_group 会员标签组

- 建表

    ```mysql
    CREATE TABLE `ims_ewei_shop_member_group` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `uniacid` int(11) DEFAULT '0',
      `groupname` varchar(255) DEFAULT '',
      `description` varchar(255) DEFAULT '',
      PRIMARY KEY (`id`)
    ) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
    ```