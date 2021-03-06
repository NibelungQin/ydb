ewei_shop_package 套餐活动
ewei_shop_package_goods 套餐商品组合

### 商品

#### ewei_shop_goods 商品

- 建表

    ```mysql
    CREATE TABLE `ims_ewei_shop_goods` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `uniacid` int(11) DEFAULT '0',
      `pcate` int(11) DEFAULT '0',
      `ccate` int(11) DEFAULT '0',
      `type` tinyint(1) DEFAULT '1' comment '商品类型 1-实体商品 2-虚拟商品 3-虚拟物品(卡密) 4-批发商品 5-记次/时商品 10-话费流量充值 20-充值卡',
      `status` tinyint(1) DEFAULT '1' comment '上架 0-否 1-上架 2-赠品上架',
      `displayorder` int(11) DEFAULT '0' comment '排序，数字越大越靠前',
      `title` varchar(100) DEFAULT '' comment '商品名称',
      `thumb` varchar(255) DEFAULT '' comment '缩略图',
      `unit` varchar(5) DEFAULT '' comment '单位',
      `description` varchar(1000) DEFAULT NULL comment '分享描述',
      `content` text comment '详情',
      `goodssn` varchar(50) DEFAULT '' comment '编码',
      `productsn` varchar(50) DEFAULT '' comment '条码',
      `productprice` decimal(10,2) DEFAULT '0.00' comment '原价',
      `marketprice` decimal(10,2) DEFAULT '0.00' comment '商品价格',
      `costprice` decimal(10,2) DEFAULT '0.00' comment '成本价',
      `originalprice` decimal(10,2) DEFAULT '0.00', -- 
      `total` int(10) DEFAULT '0' comment '库存',
      `totalcnf` int(11) DEFAULT '0' comment '库存设置 0-拍下减库存 1-付款减库存 2-永不减库存',
      `sales` int(11) DEFAULT '0' comment '已出售数量（销量）',
      `salesreal` int(11) DEFAULT '0',
      `spec` varchar(5000) DEFAULT '',
      `createtime` int(11) DEFAULT '0' comment '注册时间',
      `weight` decimal(10,2) DEFAULT '0.00' comment '重量',
      `credit` varchar(255) DEFAULT NULL comment '积分赠送 不带%按件赠送固定积分 带%表示按购买金额比例赠送',
      `maxbuy` int(11) DEFAULT '0' comment '单次最多购买',
      `usermaxbuy` int(11) DEFAULT '0' comment '最多购买',
      `hasoption` int(11) DEFAULT '0' comment '启用商品规格 0-不启用 1-启用',
      `dispatch` int(11) DEFAULT '0',
      `thumb_url` text,
      `isnew` tinyint(1) DEFAULT '0' comment '新品',
      `ishot` tinyint(1) DEFAULT '0' comment '热卖',
      `isdiscount` tinyint(1) DEFAULT '0' comment '促销方式 促销 0-关闭 1-打开',
      `isrecommand` tinyint(1) DEFAULT '0' comment '推荐 0-否 1-是',
      `issendfree` tinyint(1) DEFAULT '0' comment '包邮',
      `istime` tinyint(1) DEFAULT '0' comment '促销方式 限时卖 0-关闭 1-打开',
      `iscomment` tinyint(1) DEFAULT '0',
      `timestart` int(11) DEFAULT '0' comment '限时卖 开始时间',
      `timeend` int(11) DEFAULT '0' comment '限时卖 结束时间',
      `viewcount` int(11) DEFAULT '0',
      `deleted` tinyint(3) DEFAULT '0',
      `hascommission` tinyint(3) DEFAULT '0' comment '启用独立佣金比例 0-关闭 1-开启',
      `commission1_rate` decimal(10,2) DEFAULT '0.00' comment '独立佣金比例 统一分销佣金 一级佣金比例',
      `commission1_pay` decimal(10,2) DEFAULT '0.00' comment '独立佣金比例 统一分销佣金 一级佣金定额',
      `commission2_rate` decimal(10,2) DEFAULT '0.00' comment '独立佣金比例 统一分销佣金 二级佣金比例',
      `commission2_pay` decimal(10,2) DEFAULT '0.00' comment '独立佣金比例 统一分销佣金 二级佣金定额',
      `commission3_rate` decimal(10,2) DEFAULT '0.00' comment '独立佣金比例 统一分销佣金 三级佣金比例',
      `commission3_pay` decimal(10,2) DEFAULT '0.00' comment '独立佣金比例 统一分销佣金 三级佣金定额',
      `score` decimal(10,2) DEFAULT '0.00',
      `taobaoid` varchar(255) DEFAULT '',
      `taotaoid` varchar(255) DEFAULT '',
      `taobaourl` varchar(255) DEFAULT '',
      `updatetime` int(11) DEFAULT '0',
      `share_title` varchar(255) DEFAULT '' comment '分享标题',
      `share_icon` varchar(255) DEFAULT '' comment '分享图标',
      `cash` tinyint(3) DEFAULT '0' comment '货到付款 0-不支持 2-支持',
      `commission_thumb` varchar(255) DEFAULT '' comment '分销分享海报',
      `isnodiscount` tinyint(3) DEFAULT '0' comment '不参与会员折扣 0-否 1-是',
      `showlevels` text comment '会员等级浏览权限 array 序列化',
      `buylevels` text comment '会员等级购买权限 array 序列化',
      `showgroups` text comment '会员组浏览权限 array 序列化',
      `buygroups` text comment '会员组购买权限 array 序列化',
      `isverify` tinyint(3) DEFAULT '0' comment '线下核销 2-支持 [0,1]-不支持',
      `storeids` text comment '核销门店id',
      `noticeopenid` varchar(255) DEFAULT '' comment '商家通知列表，字符串","拼接',
      `tcate` int(11) DEFAULT '0',
      `noticetype` text comment '通知方式 1-付款通知 2-买家收货通知 字符串","拼接',
      `needfollow` tinyint(3) DEFAULT '0' comment '购买强制关注 0-不需关注 1-必须关注',
      `followtip` varchar(255) DEFAULT '' comment '购买需关注时的提示',
      `followurl` varchar(255) DEFAULT '' comment '购买需关注时的跳转链接',
      `deduct` decimal(10,2) DEFAULT '0.00' comment '积分抵扣 最多抵扣deduct元',
      `virtual` int(11) DEFAULT '0',
      `ccates` text,
      `discounts` text comment '会员折扣 json格式 type: 0-统一设置折扣 1-详细设置折扣',
      `nocommission` tinyint(3) DEFAULT '0' comment '0-不参与分销 1-参与分销',
      `hidecommission` tinyint(3) DEFAULT '0',
      `pcates` text,
      `tcates` text,
      `cates` text comment '商品分类',
      `artid` int(11) DEFAULT '0',
      `detail_logo` varchar(255) DEFAULT '' comment '店铺LOGO',
      `detail_shopname` varchar(255) DEFAULT '' comment '店铺名称',
      `detail_btntext1` varchar(255) DEFAULT '' comment '全部商品 按钮名称',
      `detail_btnurl1` varchar(255) DEFAULT '' comment '全部商品 按钮链接',
      `detail_btntext2` varchar(255) DEFAULT '' comment '进店逛逛 按钮名称',
      `detail_btnurl2` varchar(255) DEFAULT '' comment '进店逛逛 按钮链接',
      `detail_totaltitle` varchar(255) DEFAULT '' comment '店铺描述',
      `saleupdate42392` tinyint(3) DEFAULT '0',
      `deduct2` decimal(10,2) DEFAULT '0.00' comment '余额抵扣 最多抵扣deduct2元 0支持全额抵扣 -1不支持抵扣',
      `ednum` int(11) DEFAULT '0' comment '单品满件包邮',
      `edmoney` decimal(10,2) DEFAULT '0.00' comment '单品满额包邮',
      `edareas` text comment '不参与单品包邮地区',
      `diyformtype` tinyint(1) DEFAULT '0',
      `diyformid` int(11) DEFAULT '0',
      `diymode` tinyint(1) DEFAULT '0',
      `dispatchtype` tinyint(1) DEFAULT '0' comment '运费设置 0-运费模板 1-统一邮费',
      `dispatchid` int(11) DEFAULT '0' comment '运费模板id',
      `dispatchprice` decimal(10,2) DEFAULT '0.00' comment '统一邮费价格',
      `manydeduct` tinyint(1) DEFAULT '0' comment '允许多件累计抵扣 0-不允许 1-允许',
      `shorttitle` varchar(255) DEFAULT '' comment '商品短标题',
      `isdiscount_title` varchar(255) DEFAULT '' comment '促销标题',
      `isdiscount_time` int(11) DEFAULT '0' comment '促销结束时间',
      `isdiscount_discounts` text,
      `commission` text comment '独立佣金比例 详细设置分销佣金 json格式',
      `saleupdate37975` tinyint(3) DEFAULT '0',
      `shopid` int(11) DEFAULT '0',
      `allcates` text,
      `minbuy` int(11) DEFAULT '0' comment '单次最低购买',
      `invoice` tinyint(3) DEFAULT '0' comment '发票 0-不支持 1-支持',
      `repair` tinyint(3) DEFAULT '0' comment '标签 保修',
      `seven` tinyint(3) DEFAULT '0' comment '标签 7天无理由退换',
      `money` varchar(255) DEFAULT '' comment '余额返现 不带%按件返固定金额 带%按购买金额比例返',
      `minprice` decimal(10,2) DEFAULT '0.00',
      `maxprice` decimal(10,2) DEFAULT '0.00',
      `province` varchar(255) DEFAULT '' comment '商品所在地省',
      `city` varchar(255) DEFAULT '' comment '商品所在地市',
      `buyshow` tinyint(1) DEFAULT '0' comment '详情 购买后可见 开启后购买过的商品才会显示 0-关闭 1-开启',
      `buycontent` text,
      `saleupdate51117` tinyint(3) DEFAULT '0',
      `virtualsend` tinyint(1) DEFAULT '0' comment '自动发货（虚拟商品特有） 0-否 1-是',
      `virtualsendcontent` text comment '自动发货内容',
      `verifytype` tinyint(1) DEFAULT '0' comment '核销类型 0-按订单核销 1-按次核销 2-按消费码核销',
      `diyfields` text,
      `diysaveid` int(11) DEFAULT '0',
      `diysave` tinyint(1) DEFAULT '0',
      `quality` tinyint(3) DEFAULT '0' comment '标签 正品保证',
      `groupstype` tinyint(1) NOT NULL DEFAULT '0' comment '是否支持拼团 0-否 1-是',
      `showtotal` tinyint(1) NOT NULL DEFAULT '0' comment '显示库存 0-不显示 1-显示',
      `subtitle` varchar(255) DEFAULT '' comment '副标题',
      `minpriceupdated` tinyint(1) DEFAULT '0',
      `sharebtn` tinyint(1) NOT NULL DEFAULT '0' comment '分享按钮 0-弹出关注提示层 1-跳转至商品海报',
      `catesinit3` text,
      `showtotaladd` tinyint(1) DEFAULT '0',
      `merchid` int(11) DEFAULT '0',
      `checked` tinyint(3) DEFAULT '0',
      `thumb_first` tinyint(3) DEFAULT '0',
      `merchsale` tinyint(1) DEFAULT '0' comment '多商户促销时 0-当前设置的促销价格 1-商户设置的促销价格',
      `keywords` varchar(255) DEFAULT '' comment '关键字',
      `catch_id` varchar(255) DEFAULT '',
      `catch_url` varchar(255) DEFAULT '',
      `catch_source` varchar(255) DEFAULT '',
      `saleupdate40170` tinyint(3) DEFAULT '0',
      `saleupdate35843` tinyint(3) DEFAULT '0',
      `labelname` text comment '标签 自定义标签',
      `autoreceive` int(11) DEFAULT '0' comment '发货后多少天自动收货 0读取系统设置 -1为不自动收货',
      `cannotrefund` tinyint(3) DEFAULT '0' comment '是否支持退换货 0-支持 1-不支持',
      `saleupdate33219` tinyint(3) DEFAULT '0',
      `bargain` int(11) DEFAULT '0',
      `buyagain` decimal(10,2) DEFAULT '0.00' comment '重复购买此商品,享受的折扣',
      `buyagain_islong` tinyint(1) DEFAULT '0' comment '购买一次后,以后都使用这个折扣 0-否 1-是',
      `buyagain_condition` tinyint(1) DEFAULT '0' comment '重复购买使用条件 0-订单付款后 1-订单完成后',
      `buyagain_sale` tinyint(1) DEFAULT '0' comment '重复购买时,是否与其他优惠共享 0-否 1-是',
      `buyagain_commission` text,
      `saleupdate32484` tinyint(3) DEFAULT '0',
      `saleupdate36586` tinyint(3) DEFAULT '0',
      `diypage` int(11) DEFAULT NULL,
      `cashier` tinyint(1) DEFAULT '0',  -- 支持收银台 0-不支持 1-支持
      `saleupdate53481` tinyint(3) DEFAULT '0',
      `saleupdate30424` tinyint(3) DEFAULT '0',
      `isendtime` tinyint(3) NOT NULL DEFAULT '0' comment '线下核销 兑换限时 0-指定时间兑换 1-限时兑换',
      `usetime` int(11) NOT NULL DEFAULT '0' comment '线下核销 制定时间兑换 商品购买X天后自动使用，自动使用后无法退款，设置为0则没有限制。',
      `endtime` int(11) NOT NULL DEFAULT '0' comment '线下核销 限时兑换 有效期截至日期',
      `merchdisplayorder` int(11) NOT NULL DEFAULT '0',
      `exchange_stock` int(11) DEFAULT '0',
      `exchange_postage` decimal(10,2) NOT NULL DEFAULT '0.00',
      `ispresell` tinyint(3) NOT NULL DEFAULT '0' comment '预售 0-否 1-是',
      `presellprice` decimal(10,2) NOT NULL DEFAULT '0.00' comment '预售价格',
      `presellover` tinyint(3) NOT NULL DEFAULT '0' comment '开启预售结束 0-关闭 1-开启',
      `presellovertime` int(11) NOT NULL comment '预售结束时间 （N天后转为正常销售）',
      `presellstart` tinyint(3) NOT NULL DEFAULT '0' comment '开启预售开始时间 0-关闭 1-开启',
      `preselltimestart` int(11) NOT NULL DEFAULT '0' comment '预售开始时间',
      `presellend` tinyint(3) NOT NULL DEFAULT '0' comment '开启预售结束时间 0-关闭 1-开启',
      `preselltimeend` int(11) NOT NULL DEFAULT '0' comment '预售结束时间',
      `presellsendtype` tinyint(3) NOT NULL DEFAULT '0' comment '预售发货时间 0-固定时间 1-购买时间（购买后presellsendtime天发货）',
      `presellsendstatrttime` int(11) NOT NULL DEFAULT '0' comment '预售固定发货时间开始时间',
      `presellsendtime` int(11) NOT NULL DEFAULT '0' comment '预售购买后发货时间 （购买后N天发货）',
      `edareas_code` text NOT NULL comment '不参与单品包邮地区代码',
      `unite_total` tinyint(3) NOT NULL DEFAULT '0',
      `buyagain_price` decimal(10,2) DEFAULT '0.00',
      `threen` varchar(255) DEFAULT '',
      `intervalfloor` tinyint(1) DEFAULT '0' comment '批发商品的批发价格区间数量',
      `intervalprice` varchar(512) DEFAULT '' comment '批发商品的批发价格，array序列化后的字符串',
      `isfullback` tinyint(3) NOT NULL DEFAULT '0',
      `isstatustime` tinyint(3) NOT NULL DEFAULT '0' comment '是否选择上架时间 0-否 1-是',
      `statustimestart` int(10) NOT NULL DEFAULT '0' comment '上架开始时间',
      `statustimeend` int(10) NOT NULL DEFAULT '0' comment '上架结束时间',
      `nosearch` tinyint(1) NOT NULL DEFAULT '0' comment '是否显示搜索结果 0-显示 1-隐藏',
      `showsales` tinyint(3) NOT NULL DEFAULT '1' comment '显示销量 0-否 1-是',
      `islive` int(11) NOT NULL DEFAULT '0',
      `liveprice` decimal(10,2) NOT NULL DEFAULT '0.00',
      `opencard` tinyint(1) DEFAULT '0',
      `cardid` varchar(255) DEFAULT '',
      `verifygoodsnum` int(11) DEFAULT '1',
      `verifygoodsdays` int(11) DEFAULT '1',
      `verifygoodslimittype` tinyint(1) DEFAULT '0',
      `verifygoodslimitdate` int(11) DEFAULT '0',
      `minliveprice` decimal(10,2) NOT NULL DEFAULT '0.00',
      `maxliveprice` decimal(10,2) NOT NULL DEFAULT '0.00',
      `dowpayment` decimal(10,2) NOT NULL DEFAULT '0.00',
      `tempid` int(11) NOT NULL DEFAULT '0',
      `isstoreprice` tinyint(11) NOT NULL DEFAULT '0',
      `beforehours` int(11) NOT NULL DEFAULT '0',
      `saleupdate` tinyint(3) DEFAULT '0',
      `newgoods` tinyint(3) NOT NULL DEFAULT '0',
      `video` varchar(521) NOT NULL DEFAULT '' comment '详情页首图视频',
      `officthumb` varchar(512) DEFAULT NULL comment '文案营销长缩略图',
      `verifygoodstype` tinyint(1) NOT NULL DEFAULT '0',
      `isforceverifystore` tinyint(1) NOT NULL DEFAULT '0' comment '会员在下单核销商品时，是否强制用户选择核销门店 0-否 1-是',
      PRIMARY KEY (`id`),
      KEY `idx_uniacid` (`uniacid`),
      KEY `idx_pcate` (`pcate`),
      KEY `idx_ccate` (`ccate`),
      KEY `idx_isnew` (`isnew`),
      KEY `idx_ishot` (`ishot`),
      KEY `idx_isdiscount` (`isdiscount`),
      KEY `idx_isrecommand` (`isrecommand`),
      KEY `idx_iscomment` (`iscomment`),
      KEY `idx_issendfree` (`issendfree`),
      KEY `idx_istime` (`istime`),
      KEY `idx_deleted` (`deleted`),
      KEY `idx_tcate` (`tcate`),
      KEY `idx_scate` (`tcate`),
      KEY `idx_merchid` (`merchid`),
      KEY `idx_checked` (`checked`),
      FULLTEXT KEY `idx_buylevels` (`buylevels`),
      FULLTEXT KEY `idx_showgroups` (`showgroups`),
      FULLTEXT KEY `idx_buygroups` (`buygroups`)
    ) ENGINE=MyISAM AUTO_INCREMENT=228 DEFAULT CHARSET=utf8;
    ```
    
#### ewei_shop_goods_spec 商品规格

- 建表

    ```mysql
    ```
    
#### ewei_shop_goods_spec 商品规格项

- 建表

    ```mysql
    ```
    
#### ewei_shop_goods_option 商品规格项组合

- 建表

    ```mysql
    ```
    
#### ewei_shop_goods_param 商品参数
