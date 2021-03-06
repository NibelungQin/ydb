define(['core', 'tpl', 'biz/member/cart', 'biz/plugin/diyform'], function(core, tpl, cart, diyform) {
    var modal = {
        goodsid: 0,
        goods: [],
        option: false,
        specs: [],
        options: [],
        params: {
            titles: '',
            optionthumb: '',
            split: ';',
            option: false,
            total: 1,
            optionid: 0,
            onSelected: false,
            onConfirm: false,
            autoClose: true
        },
        ttime: '',
    };
    modal.open = function(params) {
        modal.params = $.extend(modal.params, params || {});
        if (modal.goodsid != params.goodsid || params.refresh) {
            modal.specs = [];
            modal.options = [];
            modal.option = false;
            modal.params.optionid = 0;
            modal.goodsid = params.goodsid;
            var obj = {
                id: params.goodsid
            };
            if (params.liveid) {
                obj.liveid = params.liveid
            }
            core.json('cycelbuy/goods/picker', obj, function(ret) {
                if (ret.status == 0) {
                    FoxUI.toast.show('未找到商品!');
                    return
                }
                modal.followtip = '';
                modal.followurl = '';
                if (ret.status == 2) {
                    modal.followtip = ret.result.followtip;
                    modal.followurl = ret.result.followurl;
                    modal.show();
                    return
                }
                if (ret.status == 4) {
                    modal.followtip = 0;
                    modal.needlogin = 1;
                    modal.endtime = ret.result.endtime || 0;
                    modal.imgcode = ret.result.imgcode || 0;
                    modal.show();
                    return
                }
                if (ret.status == 3) {
                    modal.followtip = 0;
                    modal.needlogin = 0;
                    modal.mustbind = 1;
                    modal.endtime = ret.result.endtime || 0;
                    modal.imgcode = ret.result.imgcode || 0;
                    modal.show();
                    return
                }
                if (ret.status == 5) {
                    FoxUI.toast.show(ret.result.message);
                    modal.goodsid = '';
                    return
                }
                var width = window.screen.width * window.devicePixelRatio;
                var height = window.screen.height * window.devicePixelRatio;
                ret.result.width = width;
                ret.result.height = height;
                modal.containerHTML = tpl('option-picker', ret.result);
                modal.goods = ret.result.goods;
                modal.specs = ret.result.specs;
                modal.options = ret.result.options;
                modal.seckillinfo = ret.result.seckillinfo;
                if (modal.goods.unit == '') {
                    modal.goods.unit = '件'
                }
                modal.needlogin = 0;
                modal.followtip = 0;
                modal.mustbind = 0;
                modal.show()
            }, true, false)
        } else {
            modal.show()
        }
    };
    modal.close = function() {
        modal.container.close()
    };
    modal.init = function() {
        modal.nowDate();
        modal.getDateList();
        $('.other-time').click(function() {
            $(".cyclenotime").css('display', 'none');
            $(".cyceltime").css('display', 'block');
            $(".cancelbtn").css('display', ' table-cell');
            $(".option-picker.cycelbuy-time-picker").addClass("date-picker");
            $(".option-picker-inner.notime").css('display', ' none')
        });
        $('.closebtn', modal.container.container).unbind('click').click(function() {
            modal.close()
        });
        $('.cancelbtn', modal.container.container).unbind('click').click(function() {
            $(".cyceltime").css('display', 'none');
            $(".cyclenotime").css('display', 'block');
            $(".cancelbtn").css('display', ' none');
            $(".option-picker-inner.notime").css('display', ' block');
            $(".option-picker.cycelbuy-time-picker").removeClass("date-picker")
        });
        $('.fui-mask').unbind('click').click(function() {
            modal.close()
        });
        if (modal.seckillinfo == false) {
            $('.fui-number', modal.container.container).numbers({
                value: modal.params.total,
                max: modal.goods.maxbuy,
                min: modal.goods.minbuy,
                minToast: "{min}" + modal.goods.unit + "起售",
                maxToast: "最多购买{max}" + modal.goods.unit,
                callback: function(num) {
                    modal.params.total = num
                }
            })
        } else {
            modal.params.total = 1
        }
        $(".spec-item", modal.container.container).unbind('click').click(function() {
            modal.chooseSpec(this)
        });
        $('.cartbtn', modal.container.container).unbind('click').click(function() {
            modal.addToCart()
        });
        $('.buybtn', modal.container.container).unbind('click').click(function() {
            if ($(this).hasClass('disabled')) {
                return
            }
            if (!modal.check()) {
                return
            }
            if ($('.diyform-container').length > 0) {
                var diyformdata = diyform.getData('.diyform-container');
                if (!diyformdata) {
                    return
                } else {
                    core.json('cycelbuy/order/create/diyform', {
                        id: modal.goods.id,
                        diyformdata: diyformdata
                    }, function(ret) {
                        location.href = core.getUrl('cycelbuy/order/create', {
                            id: modal.goods.id,
                            optionid: modal.params.optionid,
                            total: modal.params.total,
                            gdid: ret.result.goods_data_id
                        })
                    }, true, true)
                }
            } else {
                location.href = core.getUrl('cycelbuy/order/create', {
                    id: modal.goods.id,
                    optionid: modal.params.optionid,
                    total: modal.params.total
                })
            } if (modal.params.autoClose) {
                modal.close()
            }
        });
        $('.confirmbtn', modal.container.container).unbind('click').click(function() {
            if ($(this).hasClass('disabled')) {
                return
            }
            if (!modal.check()) {
                return
            }
            location.href = core.getUrl('cycelbuy/order/create', {
                id: modal.goods.id,
                optionid: modal.params.optionid,
                total: modal.params.total,
                predicttime: $('.spec-item-time').attr('data-date'),
            });
            if (modal.params.autoClose) {
                modal.close()
            }
        });
        var height = $(document.body).height() * 0.6;
        var optionsHeight = height - $('.option-picker-cell').outerHeight() - $('.option-picker .fui-navbar').outerHeight();
        modal.container.container.find('.option-picker').css('height', height);
        modal.container.container.find('.option-picker .option-picker-options').css('height', optionsHeight);
        var clientHeight = document.documentElement.clientHeight || document.body.clientHeight;
        $(window).on('resize', function() {
            var nowClientHeight = document.documentElement.clientHeight || document.body.clientHeight;
            if (clientHeight > nowClientHeight) {
                $('.fui-navbar').css({
                    display: 'none'
                });
                $('.option-picker').css({
                    height: 'auto'
                });
                var height = $(document.body).height() * 0.6;
                var optionsHeight = height - $('.option-picker-cell').outerHeight();
                modal.container.container.find('.option-picker').css('height', height);
                modal.container.container.find('.option-picker .option-picker-options').css('height', optionsHeight);
                $('.option-picker').addClass('android')
            } else {
                $('.fui-navbar').css({
                    display: 'block'
                });
                var height = $(document.body).height() * 0.6;
                var optionsHeight = height - $('.option-picker-cell').outerHeight() - $('.option-picker .fui-navbar').outerHeight();
                modal.container.container.find('.option-picker').css('height', height);
                modal.container.container.find('.option-picker .option-picker-options').css('height', optionsHeight);
                $('.option-picker').addClass('android')
            }
        })
    };
    modal.nowDate = function() {
        var dates = new Date();
        dates.getFullYear();
        dates.getMonth();
        dates.getDate();
        dates.getDay();
        if (dates.getDay() == 0) {
            var nowday = '周日'
        } else if (dates.getDay() == 1) {
            var nowday = '周一'
        } else if (dates.getDay() == 2) {
            var nowday = '周二'
        } else if (dates.getDay() == 3) {
            var nowday = '周三'
        } else if (dates.getDay() == 4) {
            var nowday = '周四'
        } else if (dates.getDay() == 5) {
            var nowday = '周五'
        } else if (dates.getDay() == 6) {
            var nowday = '周六'
        }
        var nowMonth = parseInt(dates.getMonth() + 1) < 10 ? '0' + parseInt(dates.getMonth() + 1) : parseInt(dates.getMonth() + 1);
        var nowDate = parseInt(dates.getDate()) < 10 ? '0' + parseInt(dates.getDate()) : parseInt(dates.getDate());
        var ahead_goods = $('.ahead_goods').html();
        var now = dates.getFullYear() + '年' + nowMonth + '月' + (parseInt(nowDate) + parseInt(ahead_goods)) + '日 ' + nowday;
        $('.spec-item-time').html(now);
        $('.spec-item-time').attr('data-date', dates.getFullYear() + '-' + nowMonth + '-' + (parseInt(nowDate) + parseInt(ahead_goods)));
        modal.tmonth = dates.getMonth();
        modal.tdate = dates.getDate();
        modal.ttime = dates
    }
    modal.show = function() {
        if (modal.followtip) {
            FoxUI.confirm(modal.followtip, function() {
                if (modal.followurl != '' && modal.followurl != null) {
                    location.href = modal.followurl
                }
            });
            return
        }
        if (modal.needlogin) {
            var backurl = core.getUrl('cycelbuy/goods/detail', {
                id: modal.goodsid
            });
            backurl = backurl.replace("./index.php?", "");
            require(['biz/member/account'], function(account) {
                account.initQuick({
                    action: 'login',
                    backurl: btoa(backurl),
                    endtime: modal.endtime,
                    imgcode: modal.imgcode,
                    success: function() {
                        var args = modal.params;
                        args.refresh = true;
                        modal.open(args)
                    }
                })
            });
            return
        }
        if (modal.mustbind) {
            require(['biz/member/account'], function(account) {
                account.initQuick({
                    action: 'bind',
                    backurl: btoa(location.href),
                    endtime: modal.endtime,
                    imgcode: modal.imgcode,
                    success: function() {
                        var args = modal.params;
                        args.refresh = true;
                        modal.open(args)
                    }
                })
            });
            return
        }
        modal.container = new FoxUIModal({
            content: modal.containerHTML,
            extraClass: "picker-modal"
        });
        modal.init();
        if (modal.seckillinfo && modal.seckillinfo.status == 0) {
            $('.fui-mask').hide(), $('.picker-modal').hide();
            if ((typeof(modal.options.length) === 'undefined' || modal.options.length <= 0) && $('.diyform-container').length <= 0) {
                if (modal.params.action == 'buy') {
                    location.href = core.getUrl('cycelbuy/order/create', {
                        id: modal.goods.id,
                        total: 1,
                        optionid: 0
                    });
                    return
                } else {
                    modal.addToCart();
                    return
                }
            }
        }
        $('.fui-mask').show(), $('.picker-modal').show();
        if (modal.params.showConfirm) {
            $('.confirmbtn', modal.container.container).show()
        } else {
            $('.buybtn', modal.container.container).show();
            if (modal.goods.canAddCart) {
                $('.cartbtn', modal.container.container).show()
            }
        } if (modal.params.optionid != '0') {
            modal.initOption()
        }
        modal.container.show();
        if (modal.specs.length == 1) {
            $.each(modal.options, function() {
                var thisspecs = this.specs;
                if (this.stock == 0) {
                    $(".spec-item" + thisspecs + "").removeClass("spec-item").removeClass("btn-danger").addClass("disabled").off("click")
                }
            })
        }
    };
    modal.initOption = function() {
        $(".spec-item").removeClass('btn-danger');
        var optionid = modal.params.optionid;
        var specs = false;
        $.each(modal.options, function() {
            if (this.id == optionid) {
                specs = this.specs.split('_');
                return false
            }
        });
        if (specs) {
            var item = false;
            var selectitems = [];
            $(".spec-item").each(function() {
                var item = $(this),
                    itemid = item.data('id');
                $.each(specs, function() {
                    if (this == itemid) {
                        selectitems.push(item);
                        item.addClass('btn-danger')
                    }
                })
            });
            if (selectitems.length > 0) {
                var lastitem = selectitems[selectitems.length - 1];
                modal.chooseSpec(lastitem, false)
            }
        }
    };
    modal.chooseSpec = function(obj, callback) {
        var $this = $(obj);
        $this.closest('.spec').find('.spec-item').removeClass('btn-danger'), $this.addClass('btn-danger');
        var thumb = $this.data('thumb') || '';
        if (thumb) {
            $('.thumb', modal.container.container).attr('src', thumb)
        }
        modal.params.optionthumb = thumb;
        var selected = $(".spec-item.btn-danger", modal.container.container);
        var itemids = [];
        if (selected.length <= modal.specs.length) {
            $.each(modal.options, function() {
                if ((modal.specs.length - selected.length) == 1) {
                    var specid = [];
                    var specOpion = this.specs;
                    $.each(selected, function() {
                        if (specOpion.indexOf(this.getAttribute("data-id")) >= 0) {
                            specid.push(this.getAttribute("data-id"))
                        }
                    });
                    if (specid.length == selected.length) {
                        for (var i = 0; i < specid.length; i++) {
                            specOpion = specOpion.replace(specid[i], "")
                        }
                        specOpion = specOpion.split("_");
                        var option = [];
                        $.each(specOpion, function(i, v) {
                            var data = $.trim(v);
                            if ('' != data) {
                                option.push(data)
                            }
                        });
                        if (this.stock <= 0 && this.stock != -1) {
                            $(".spec-item" + option[0] + "").removeClass("spec-item").removeClass("btn-danger").addClass("disabled").off("click")
                        } else {
                            $(".spec-item" + option[0] + "").removeClass("disabled").addClass("spec-item").off("click").on("click", function() {
                                modal.chooseSpec(this)
                            })
                        }
                    }
                } else if (modal.specs.length == selected.length) {
                    var specid = [];
                    var specOpion = this.specs;
                    $.each(selected, function() {
                        if (specOpion.indexOf(this.getAttribute("data-id")) >= 0 && specOpion.indexOf($this.data("id")) >= 0) {
                            specid.push(this.getAttribute("data-id"))
                        }
                    });
                    var option = [];
                    if (specid.length == (modal.specs.length - 1)) {
                        for (var i = 0; i < specid.length; i++) {
                            specOpion = specOpion.replace(specid[i], "")
                        }
                        specOpion = specOpion.split("_");
                        $.each(specOpion, function(i, v) {
                            var data = $.trim(v);
                            if ('' != data) {
                                option.push(data)
                            }
                        });
                        if (this.stock <= 0 && this.stock != -1) {
                            $(".spec-item" + option[0] + "").removeClass("spec-item").removeClass("btn-danger").addClass("disabled").off("click")
                        } else {
                            $(".spec-item" + option[0] + "").removeClass("disabled").addClass("spec-item").off("click").on("click", function() {
                                modal.chooseSpec(this)
                            })
                        }
                    }
                }
            })
        }
        if (selected.length == modal.specs.length) {
            selected.each(function() {
                itemids.push($(this).data('id'))
            });
            $.each(modal.options, function() {
                var specs = this.specs.split('_').sort().join('_');
                if (specs == itemids.sort().join('_')) {
                    var stock = this.stock == '-1' ? '无限' : this.stock;
                    $('.total', modal.container.container).html(stock);
                    if (this.stock != '-1' && this.stock <= 0) {
                        $('.confirmbtn', modal.container).show().addClass('disabled').html('库存不足');
                        $('.cartbtn,.buybtn', modal.container).hide()
                    } else {
                        if (modal.params.showConfirm) {
                            $('.confirmbtn', modal.container).removeClass('disabled').html('确定');
                            $('.cartbtn,.buybtn', modal.container).hide()
                        } else {
                            $('.cartbtn,.buybtn', modal.container).show(), $('.confirmbtn').hide()
                        }
                    }
                    var timestamp = Date.parse(new Date()) / 1000;
                    if (modal.goods.ispresell > 0 && (modal.goods.preselltimeend == 0 || modal.goods.preselltimeend > timestamp)) {
                        $('.price', modal.container.container).html(this.presellprice)
                    } else {
                        $('.price', modal.container.container).html(this.marketprice)
                    }
                    modal.option = this;
                    modal.params.optionid = this.id
                }
            })
        }
        var titles = [];
        selected.each(function() {
            titles.push($.trim($(this).html()))
        });
        modal.params.titles = titles.join(modal.params.split);
        $('.info-titles', modal.container.container).html('已选 ' + modal.params.titles);
        if (callback) {
            if (modal.params.onSelected) {
                modal.params.onSelected(modal.params.total, modal.params.optionid, modal.params.titles)
            }
        }
    };
    modal.check = function() {
        var spec = $(".spec", modal.container.container);
        var selected = true;
        spec.each(function() {
            if ($(this).find('.spec-item.btn-danger').length <= 0) {
                FoxUI.toast.show('请选择' + $(this).find('.title').html());
                selected = false;
                return false
            }
        });
        if (selected) {
            if (modal.option.stock != -1 && modal.option.stock <= 0) {
                FoxUI.toast.show('库存不足');
                return false
            }
            var num = parseInt($('.num', modal.container.container).val());
            if (num <= 0) {
                num = 1
            }
            if (num > modal.option.stock) {
                num = modal.option.stock
            }
            $(".num", modal.container.container).val(num);
            if (modal.goods.maxbuy > 0 && num > modal.goods.maxbuy) {
                FoxUI.toast.show('最多购买 ' + modal.goods.maxbuy + ' ' + modal.goods.unit);
                return false
            }
            if (modal.goods.minbuy > 0 && num < modal.goods.minbuy) {
                FoxUI.toast.show(modal.goods.minbuy + modal.goods.unit + '起售');
                return false
            }
            return true
        }
        return false
    };
    modal.changeCartcount = function(count) {
        if ($("#menucart").length > 0) {
            var badge = $("#menucart").find(".badge");
            if (badge.length < 1) {
                $("#menucart").append('<span class="badge">' + count + '</div>')
            } else {
                badge.text(count)
            }
        }
    };
    modal.getDateList = function(callback) {
        var ahead_goods = $('.ahead_goods').html();
        $.ajax({
            url: core.getUrl('cycelbuy/trade/picker/date_list'),
            type: 'get',
            data: {
                ttime: modal.ttime,
                tmonth: modal.tmonth,
                tdate: modal.tdate,
                istimes: 1
            },
            success: function(data) {
                $('#datepicker').html(data);
                $('#date' + modal.tdate).removeClass('active').addClass('active');
                $('.date-alert').addClass('show');
                $('#month-left').click(function() {
                    modal.tmonth--;
                    modal.getDateList()
                });
                $('#month-right').click(function() {
                    modal.tmonth++;
                    modal.getDateList()
                });
                $('.day').unbind('click').click(function() {
                    if ($(this).attr('data-status') == '1') {
                        return
                    }
                    var cycelday = $('.spec-item .btn-danger').attr('data-day');
                    modal.tdate = $(this).attr('data-id');
                    var datestr = $(this).attr('data-date');
                    $('#date').html(datestr);
                    $('#datepicker').html();
                    $('.day_item').removeClass('active');
                    if ($('#date_' + modal.tdate).length > 0) {
                        $('#date_' + modal.tdate).removeClass('active').addClass('active')
                    } else {
                        $(this).addClass('active');
                        $('.spec-item-time').html($(this).attr('data-date')).addClass('btn-danger').attr('data-date', $(this).attr('data-id'));
                        $(this).prevAll().removeClass('active');
                        $(this).nextAll().removeClass('active')
                    }
                })
            }
        })
    };
    modal.getTime = function() {
        $.ajax({
            url: core.getUrl('cycelbuy/trade/picker/time'),
            type: 'get',
            data: {
                goodsid: modal.goodsid,
                storeid: modal.storeid,
                ttime: modal.ttime,
                tmonth: modal.tmonth,
                tdate: modal.tdate
            },
            success: function(data) {
                $('#optimelist').html(data);
                $('.time_item').not("#other_time").unbind('click').click(function() {
                    $('.time_item').removeClass('active');
                    $(this).removeClass('active').addClass('active');
                    modal.optime = $(this).attr('data-id');
                    modal.getPeople()
                });
                $('.chose-time').unbind('click').click(function() {
                    modal.getTimeList()
                });
                $('#peoplepicker').html('<div class="fui-cell-info" style="height: 3rem; font-size: 0.7rem;"><p style="margin: 1rem 0;">请选择时间</p></div>')
            }
        })
    };
    modal.getTimeList = function() {
        $.ajax({
            url: core.getUrl('cycelbuy/trade/picker/time_list'),
            type: 'get',
            data: {
                goodsid: modal.goodsid,
                storeid: modal.storeid,
                ttime: modal.ttime,
                tmonth: modal.tmonth,
                tdate: modal.tdate
            },
            success: function(data) {
                $('#timepicker').html(data);
                $('#optime' + modal.optime.replace(/:/, "_")).removeClass('active').addClass('active');
                $('.time-alert').addClass('show');
                $('.optime').unbind('click').click(function() {
                    $('.time_item').removeClass('active');
                    modal.optime = $(this).attr('data-id');
                    if ($('#op_time' + modal.optime.replace(/:/, "_")).length > 0) {
                        $('#op_time' + modal.optime.replace(/:/, "_")).removeClass('active').addClass('active')
                    } else {
                        $('#other_time').addClass('active')
                    }
                    $('#time').html(modal.optime);
                    $('#timepicker').html();
                    modal.getPeople();
                    $('.time-alert').removeClass('show')
                })
            }
        })
    };
    return modal
});