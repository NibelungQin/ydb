 
### 订单

#### ewei_shop_order 订单

- 建表

    ```mysql
    CREATE TABLE `ims_ewei_shop_order` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `uniacid` int(11) DEFAULT '0',
      `openid` varchar(50) DEFAULT '',
      `agentid` int(11) DEFAULT '0',
      `ordersn` varchar(30) DEFAULT '' comment '订单编号',
      `price` decimal(10,2) DEFAULT '0.00' comment '实付款',
      `goodsprice` decimal(10,2) DEFAULT '0.00' comment '商品小计',
      `discountprice` decimal(10,2) DEFAULT '0.00' comment '会员折扣',
      `status` tinyint(3) DEFAULT '0' comment '订单状态 -1-已关闭 0-买家下单(待付款) 1-买家付款(代发货) 2-商家发货(待收货) 3-订单完成(已完成)',
      `paytype` tinyint(1) DEFAULT '0' comment '付款方式 0-未支付 1-余额支付 11-后台付款 2-在线支付 21-微信支付 22-支付宝支付 23-银联支付 3-货到付款',
      `transid` varchar(30) DEFAULT '0',
      `remark` varchar(1000) DEFAULT '' comment '买家备注',
      `addressid` int(11) DEFAULT '0' comment '收货地址id',
      `dispatchprice` decimal(10,2) DEFAULT '0.00' comment '套餐包含的快递费',
      `dispatchid` int(10) DEFAULT '0' comment '快递id',
      `createtime` int(10) DEFAULT NULL comment '买家下单时间',
      `dispatchtype` tinyint(3) DEFAULT '0',
      `carrier` text comment '线下核销自提买家联系方式，包含姓名和手机号，序列化存储',
      `refundid` int(11) DEFAULT '0',
      `iscomment` tinyint(3) DEFAULT '0',
      `creditadd` tinyint(3) DEFAULT '0',
      `deleted` tinyint(3) DEFAULT '0',
      `userdeleted` tinyint(3) DEFAULT '0',
      `finishtime` int(11) DEFAULT '0' '订单完成时间',
      `paytime` int(11) DEFAULT '0',
      `expresscom` varchar(30) NOT NULL DEFAULT '' comment '快递公司',
      `expresssn` varchar(50) NOT NULL DEFAULT '' comment '快递单号',
      `express` varchar(255) DEFAULT '',
      `sendtime` int(11) DEFAULT '0' comment '发货时间',
      `fetchtime` int(11) DEFAULT '0',
      `cash` tinyint(3) DEFAULT '0',
      `canceltime` int(11) DEFAULT NULL,
      `cancelpaytime` int(11) DEFAULT '0',
      `refundtime` int(11) DEFAULT '0',
      `isverify` tinyint(3) DEFAULT '0' comment '核销 0-否 1-是',
      `verified` tinyint(3) DEFAULT '0',
      `verifyopenid` varchar(255) DEFAULT '' comment '核销人openid',
      `verifycode` varchar(255) DEFAULT '' comment '消费码 自提码',
      `verifytime` int(11) DEFAULT '0' comment '核销时间',
      `verifystoreid` int(11) DEFAULT '0' comment '核销门店id',
      `deductprice` decimal(10,2) DEFAULT '0.00' comment '积分抵扣',
      `deductcredit` int(10) DEFAULT '0',
      `deductcredit2` decimal(10,2) DEFAULT '0.00' comment '余额抵扣',
      `deductenough` decimal(10,2) DEFAULT '0.00' comment '商城满额立减',
      `virtual` int(11) DEFAULT '0',
      `virtual_info` text,
      `virtual_str` text,
      `address` text comment '收货地址及收货人序列化',
      `sysdeleted` tinyint(3) DEFAULT '0',
      `ordersn2` int(11) DEFAULT '0',
      `changeprice` decimal(10,2) DEFAULT '0.00'  comment '卖家改价',
      `changedispatchprice` decimal(10,2) DEFAULT '0.00' comment '卖家改运费',
      `oldprice` decimal(10,2) DEFAULT '0.00',
      `olddispatchprice` decimal(10,2) DEFAULT '0.00' comment '非套餐运费',
      `isvirtual` tinyint(3) DEFAULT '0' comment '虚拟商品 0-否 1-是',
      `couponid` int(11) DEFAULT '0',
      `couponprice` decimal(10,2) DEFAULT '0.00' comment '优惠券优惠',
      `diyformdata` text,
      `diyformfields` text,
      `diyformid` int(11) DEFAULT '0',
      `storeid` int(11) DEFAULT '0',
      `printstate` tinyint(1) DEFAULT '0',
      `printstate2` tinyint(1) DEFAULT '0',
      `address_send` text,
      `refundstate` tinyint(3) DEFAULT '0',
      `closereason` text,
      `remarksaler` text comment '卖家备注',
      `remarkclose` text,
      `remarksend` text,
      `ismr` int(1) NOT NULL DEFAULT '0',
      `isdiscountprice` decimal(10,2) DEFAULT '0.00' comment '促销优惠',
      `isvirtualsend` tinyint(1) DEFAULT '0' comment '0-虚拟物品 1-虚拟卡密',
      `virtualsend_info` text,
      `verifyinfo` text comment '核销信息序列化',
      `verifytype` tinyint(1) DEFAULT '0' comment '核销方式 0-整单核销 1-按次核销 2-按消费码核销',
      `verifycodes` text,
      `invoicename` varchar(255) DEFAULT '',
      `merchid` int(11) DEFAULT '0',
      `ismerch` tinyint(1) DEFAULT '0',
      `parentid` int(11) DEFAULT '0',
      `isparent` tinyint(1) DEFAULT '0',
      `grprice` decimal(10,2) DEFAULT '0.00',
      `merchshow` tinyint(1) DEFAULT '0',
      `merchdeductenough` decimal(10,2) DEFAULT '0.00' comment '商户满额立减',
      `couponmerchid` int(11) DEFAULT '0',
      `isglobonus` tinyint(3) DEFAULT '0',
      `merchapply` tinyint(1) DEFAULT '0',
      `isabonus` tinyint(3) DEFAULT '0',
      `isborrow` tinyint(3) DEFAULT '0',
      `borrowopenid` varchar(100) DEFAULT '',
      `merchisdiscountprice` decimal(10,2) DEFAULT '0.00',
      `apppay` tinyint(3) NOT NULL DEFAULT '0',
      `coupongoodprice` decimal(10,2) DEFAULT '1.00',
      `buyagainprice` decimal(10,2) DEFAULT '0.00' comment '重复购买优惠',
      `authorid` int(11) DEFAULT '0',
      `isauthor` tinyint(1) DEFAULT '0',
      `ispackage` tinyint(3) DEFAULT '0' comment '套餐 0-否 1-是',
      `packageid` int(11) DEFAULT '0',
      `taskdiscountprice` decimal(10,2) NOT NULL DEFAULT '0.00' comment '任务活动优惠',
      `seckilldiscountprice` decimal(10,2) DEFAULT '0.00' comment '秒杀优惠',
      `verifyendtime` int(11) NOT NULL DEFAULT '0',
      `willcancelmessage` tinyint(1) DEFAULT '0',
      `sendtype` tinyint(3) NOT NULL DEFAULT '0' comment '发货 0-待发货 1-',
      `lotterydiscountprice` decimal(10,2) NOT NULL DEFAULT '0.00' comment '游戏活动优惠',
      `contype` tinyint(1) DEFAULT '0',
      `wxid` int(11) DEFAULT '0',
      `wxcardid` varchar(50) DEFAULT '',
      `wxcode` varchar(50) DEFAULT '',
      `dispatchkey` varchar(30) NOT NULL DEFAULT '',
      `quickid` int(11) NOT NULL DEFAULT '0',
      `istrade` tinyint(3) NOT NULL DEFAULT '0',
      `isnewstore` tinyint(3) NOT NULL DEFAULT '0',
      `liveid` int(11) DEFAULT NULL,
      `ordersn_trade` varchar(32) DEFAULT NULL,
      `tradestatus` tinyint(1) DEFAULT '0',
      `tradepaytype` tinyint(1) DEFAULT NULL,
      `tradepaytime` int(11) DEFAULT '0',
      `dowpayment` decimal(10,2) NOT NULL DEFAULT '0.00',
      `betweenprice` decimal(10,2) NOT NULL DEFAULT '0.00',
      `isshare` int(11) NOT NULL DEFAULT '0',
      `officcode` varchar(50) NOT NULL DEFAULT '',
      `wxapp_prepay_id` varchar(100) DEFAULT NULL,
      `cashtime` int(11) DEFAULT '0',
      `random_code` varchar(4) DEFAULT NULL,
      `print_template` text,
      `city_express_state` tinyint(1) DEFAULT NULL comment '同城快递 0-否 1-是',
      `ces` int(1) DEFAULT NULL,
      `is_cashier` tinyint(3) DEFAULT NULL,
      `commissionmoney` decimal(10,2) DEFAULT '0.00',
      `iscycelbuy` tinyint(3) DEFAULT '0',
      `cycelbuy_predict_time` int(11) DEFAULT NULL,
      `cycelbuy_periodic` varchar(255) DEFAULT NULL,
      `invoice_img` varchar(255) DEFAULT '',
      `iswxappcreate` tinyint(1) DEFAULT '0',
      PRIMARY KEY (`id`),
      KEY `idx_uniacid` (`uniacid`),
      KEY `idx_openid` (`openid`),
      KEY `idx_shareid` (`agentid`),
      KEY `idx_status` (`status`),
      KEY `idx_createtime` (`createtime`),
      KEY `idx_refundid` (`refundid`),
      KEY `idx_paytime` (`paytime`),
      KEY `idx_finishtime` (`finishtime`),
      KEY `idx_merchid` (`merchid`)
    ) ENGINE=MyISAM AUTO_INCREMENT=236 DEFAULT CHARSET=utf8;
    ```
    
#### ewei_shop_order_refund 维权

- 建表

    ```mysql
    CREATE TABLE `ims_ewei_shop_order_refund` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `uniacid` int(11) DEFAULT '0',
      `orderid` int(11) DEFAULT '0',
      `refundno` varchar(255) DEFAULT '',
      `price` varchar(255) DEFAULT '',
      `reason` varchar(255) DEFAULT '',
      `images` text,
      `content` text,
      `createtime` int(11) DEFAULT '0',
      `status` tinyint(3) DEFAULT '0' comment '维权状态 0- 1-已维权',
      `reply` text,
      `refundtype` tinyint(3) DEFAULT '0',
      `orderprice` decimal(10,2) DEFAULT '0.00',
      `applyprice` decimal(10,2) DEFAULT '0.00',
      `imgs` text,
      `rtype` tinyint(3) DEFAULT '0',
      `refundaddress` text,
      `message` text,
      `express` varchar(100) DEFAULT '',
      `expresscom` varchar(100) DEFAULT '',
      `expresssn` varchar(100) DEFAULT '',
      `operatetime` int(11) DEFAULT '0',
      `sendtime` int(11) DEFAULT '0',
      `returntime` int(11) DEFAULT '0',
      `refundtime` int(11) DEFAULT '0',
      `rexpress` varchar(100) DEFAULT '',
      `rexpresscom` varchar(100) DEFAULT '',
      `rexpresssn` varchar(100) DEFAULT '',
      `refundaddressid` int(11) DEFAULT '0',
      `endtime` int(11) DEFAULT '0',
      `realprice` decimal(10,2) DEFAULT '0.00',
      `merchid` int(11) DEFAULT '0',
      PRIMARY KEY (`id`),
      KEY `idx_createtime` (`createtime`),
      KEY `idx_uniacid` (`uniacid`)
    ) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
    ```
    
#### ewei_shop_order_goods 订单商品

- 建表

    ```mysql
    CREATE TABLE `ims_ewei_shop_order_goods` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `uniacid` int(11) DEFAULT '0',
      `orderid` int(11) DEFAULT '0',
      `goodsid` int(11) DEFAULT '0',
      `price` decimal(10,2) DEFAULT '0.00',
      `total` int(11) DEFAULT '1',
      `optionid` int(10) DEFAULT '0',
      `createtime` int(11) DEFAULT '0',
      `optionname` text,
      `commission1` text,
      `applytime1` int(11) DEFAULT '0',
      `checktime1` int(10) DEFAULT '0',
      `paytime1` int(11) DEFAULT '0',
      `invalidtime1` int(11) DEFAULT '0',
      `deletetime1` int(11) DEFAULT '0',
      `status1` tinyint(3) DEFAULT '0',
      `content1` text,
      `commission2` text,
      `applytime2` int(11) DEFAULT '0',
      `checktime2` int(10) DEFAULT '0',
      `paytime2` int(11) DEFAULT '0',
      `invalidtime2` int(11) DEFAULT '0',
      `deletetime2` int(11) DEFAULT '0',
      `status2` tinyint(3) DEFAULT '0',
      `content2` text,
      `commission3` text,
      `applytime3` int(11) DEFAULT '0',
      `checktime3` int(10) DEFAULT '0',
      `paytime3` int(11) DEFAULT '0',
      `invalidtime3` int(11) DEFAULT '0',
      `deletetime3` int(11) DEFAULT '0',
      `status3` tinyint(3) DEFAULT '0',
      `content3` text,
      `realprice` decimal(10,2) DEFAULT '0.00',
      `goodssn` varchar(255) DEFAULT '',
      `productsn` varchar(255) DEFAULT '',
      `nocommission` tinyint(3) DEFAULT '0',
      `changeprice` decimal(10,2) DEFAULT '0.00',
      `oldprice` decimal(10,2) DEFAULT '0.00',
      `commissions` text,
      `diyformid` int(11) DEFAULT '0',
      `diyformdataid` int(11) DEFAULT '0',
      `diyformdata` text,
      `diyformfields` text,
      `openid` varchar(255) DEFAULT '',
      `printstate` int(11) NOT NULL DEFAULT '0',
      `printstate2` int(11) NOT NULL DEFAULT '0',
      `rstate` tinyint(3) DEFAULT '0',
      `refundtime` int(11) DEFAULT '0',
      `merchid` int(11) DEFAULT '0',
      `parentorderid` int(11) DEFAULT '0',
      `merchsale` tinyint(3) NOT NULL DEFAULT '0',
      `isdiscountprice` decimal(10,2) NOT NULL DEFAULT '0.00',
      `canbuyagain` tinyint(1) DEFAULT '0',
      `seckill` tinyint(3) DEFAULT '0',
      `seckill_taskid` int(11) DEFAULT '0',
      `seckill_roomid` int(11) DEFAULT '0',
      `seckill_timeid` int(11) DEFAULT '0',
      `is_make` tinyint(1) DEFAULT '0',
      `sendtype` tinyint(3) NOT NULL DEFAULT '0',
      `expresscom` varchar(30) NOT NULL,
      `expresssn` varchar(50) NOT NULL,
      `express` varchar(255) NOT NULL,
      `sendtime` int(11) NOT NULL,
      `finishtime` int(11) NOT NULL,
      `remarksend` text NOT NULL,
      `prohibitrefund` tinyint(3) NOT NULL DEFAULT '0',
      `storeid` varchar(255) NOT NULL,
      `trade_time` int(11) NOT NULL DEFAULT '0',
      `optime` varchar(30) NOT NULL,
      `tdate_time` int(11) NOT NULL DEFAULT '0',
      `dowpayment` decimal(10,2) NOT NULL DEFAULT '0.00',
      `peopleid` int(11) NOT NULL DEFAULT '0',
      `esheetprintnum` int(11) NOT NULL DEFAULT '0',
      `ordercode` varchar(30) NOT NULL,
      PRIMARY KEY (`id`),
      KEY `idx_uniacid` (`uniacid`),
      KEY `idx_orderid` (`orderid`),
      KEY `idx_goodsid` (`goodsid`),
      KEY `idx_createtime` (`createtime`),
      KEY `idx_applytime1` (`applytime1`),
      KEY `idx_checktime1` (`checktime1`),
      KEY `idx_status1` (`status1`),
      KEY `idx_applytime2` (`applytime2`),
      KEY `idx_checktime2` (`checktime2`),
      KEY `idx_status2` (`status2`),
      KEY `idx_applytime3` (`applytime3`),
      KEY `idx_invalidtime1` (`invalidtime1`),
      KEY `idx_checktime3` (`checktime3`),
      KEY `idx_invalidtime2` (`invalidtime2`),
      KEY `idx_invalidtime3` (`invalidtime3`),
      KEY `idx_status3` (`status3`),
      KEY `idx_paytime1` (`paytime1`),
      KEY `idx_paytime2` (`paytime2`),
      KEY `idx_paytime3` (`paytime3`)
    ) ENGINE=MyISAM AUTO_INCREMENT=243 DEFAULT CHARSET=utf8;
    ```