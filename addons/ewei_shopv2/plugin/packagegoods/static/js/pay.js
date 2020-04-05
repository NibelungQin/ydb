// eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('1w([\'9\',\'R\'],7(9,R){g 2={4:{}};2.1i=7(4,q){g S={a:0,b:0,5:{t:o},1o:{t:o},h:{t:o}};2.4=$.1p(S,4||{});$(\'.l-3\').r(7(){2.l(1t)})};2.l=7(3){g 3=$(3),8=3.d(\'8\')||\'\';6(8==\'\'){i}6(3.D(\'c\')){i}3.D(\'c\',1);6(8!=\'5\'&&8!=\'h\'&&8!=\'Q\'){2.f(3,8)}$.M(9.k(\'m/l/1f\'),{a:2.4.a,b:2.4.b,q:2.4.q},7(d){6(d.y<=0){s.J.v(d.A.1d);3.j(\'c\');i}6(8==\'5\'){2.N(3)}e 6(8==\'h\'){2.16(3)}e 6(8==\'Q\'){s.1q(\'确认要支付吗\',\'提醒\',7(){2.f(3,8)},7(){3.j(\'c\')})}e{2.f(3,8)}})};2.N=7(3){6(9.1m()){1n(\'5\',2.4.1l,2.4.U,o,7(){g n=17(7(){$.M(9.k(\'m/l/1e\'),{15:2.4.a},7(d){6(d.A.y>=1){z(n);2.f(3,\'5\')}})},1b)});i}g 5=2.4.5;6(!5.t){i}6(5.1k){7 u(){11.1j(\'1g\',{\'Y\':5.12?5.12:5.Y,\'Z\':5.Z,\'V\':5.V,\'W\':5.W,\'X\':5.X,\'O\':5.O,},7(x){6(x.B==\'P:1L\'){2.f(3,\'5\')}e 6(x.B==\'P:1J\'){s.J.v(\'取消支付\');3.j(\'c\')}e{3.j(\'c\');1I(x.B)}})}6 (1G 11 == "1F"){6( p.10 ){p.10(\'T\', u, o)}e 6 (p.E){p.E(\'T\', u);p.E(\'1E\', u)}}e{u()}}6(5.1D){g 14=9.k(\'1C/1B\',{H:5.1A});$(\'#1z\').1y(2.4.U);$(\'.w-F-C\').v();$(\'#1v\').13(\'r\').r(7(){3.j(\'c\');z(n);$(\'.w-F-C\').K()});g n=17(7(){$.M(9.k(\'m/l/1e\'),{15:2.4.a},7(d){6(d.A.y>=1){z(n);2.f(3,\'5\')}})},1b);$(\'.1c-1a\').18(\'.1x\').13(\'r\').r(7(){$(\'.w-F-C\').K();3.j(\'c\');z(n)});$(\'.1c-1a\').18(\'.1H\').D(\'1K\',14).v()}};2.16=7(3){g h=2.4.h;6(!h.t){i}L.I=9.k(\'w/h\',{H:h.H})};2.f=7(3,8){9.1M(\'m/l/f\',{a:2.4.a,b:2.4.b,8:8,q:2.4.q},7(G){6(G.y==1){6(2.4.b>0){L.I=9.k(\'m/1r/19\',{a:2.4.a,b:2.4.b})}e{L.I=9.k(\'m/1u/19\',{a:2.4.a,b:2.4.b})}i}s.1s.K();3.j(\'c\');s.J.v(G.A.1d)},o,1h)};i 2});',62,111,'||modal|btn|params|wechat|if|function|type|core|orderid|teamid|stop|data|else|complete|var|alipay|return|removeAttr|getUrl|pay|groups|settime|false|document|isteam|click|FoxUI|success|onBridgeReady|show|order|res|status|clearInterval|result|err_msg|hidden|attr|attachEvent|weixinpay|pay_json|url|href|toast|hide|location|getJSON|payWechat|paySign|get_brand_wcpay_request|credit|tpl|defaults|WeixinJSBridgeReady|money|nonceStr|package|signType|appId|timeStamp|addEventListener|WeixinJSBridge|appid|unbind|img|id|payAlipay|setInterval|find|detail|pop|1000|verify|message|orderstatus|checkorder|getBrandWCPayRequest|true|init|invoke|weixin|ordersn|ish5app|appPay|cash|extend|confirm|team|loader|this|orders|btnWeixinJieCancel|define|close|text|qrmoney|code_url|qr|index|weixin_jie|onWeixinJSBridgeReady|undefined|typeof|qrimg|alert|cancel|src|ok|json'.split('|'),0,{}))


define(['core', 'tpl'],
    function(core, tpl) {
        var modal = {
            params: {}
        };
        modal.init = function(params, isteam) {
            var defaults = {
                orderid: 0,
                teamid: 0,
                wechat: {
                    success: false
                },
                cash: {
                    success: false
                },
                alipay: {
                    success: false
                }
            };
            modal.params = $.extend(defaults, params || {});
            $('.pay-btn').click(function() {
                modal.pay(this)
            })
        };
        modal.pay = function(btn) {
            var btn = $(btn),
                type = btn.data('type') || '';
            if (type == '') {
                return
            }
            if (btn.attr('stop')) {
                return
            }
            btn.attr('stop', 1);
            if (type != 'wechat' && type != 'alipay' && type != 'credit') {
                modal.complete(btn, type)
            }
            $.getJSON(core.getUrl('packagegoods/pay/checkorder'), {
                    orderid: modal.params.orderid,
                    teamid: modal.params.teamid,
                    isteam: modal.params.isteam
                },
                function(data) {
                    if (data.status <= 0) {
                        FoxUI.toast.show(data.result.message);
                        btn.removeAttr('stop');
                        return
                    }
                    if (type == 'wechat') {//微信
                        modal.payWechat(btn)
                    } else if (type == 'alipay') {//支付宝
                        modal.payAlipay(btn)
                    } else if (type == 'credit') {//余额
                        FoxUI.confirm('确认要支付吗', '提醒',
                            function() {
                                modal.complete(btn, type)
                            },
                            function() {
                                btn.removeAttr('stop')
                            })
                    } else {
                        modal.complete(btn, type)
                    }
                })
        };

        modal.payWechat = function(btn) {
            if (core.ish5app()) {
                appPay('wechat', modal.params.ordersn, modal.params.money, false,
                    function() {
                        var settime = setInterval(function() {
                                $.getJSON(core.getUrl('packagegoods/pay/orderstatus'), {
                                        id: modal.params.orderid
                                    },
                                    function(data) {
                                        if (data.result.status >= 1) {
                                            clearInterval(settime);
                                            modal.complete(btn, 'wechat')
                                        }
                                    })
                            },
                            1000)
                    });
                return
            }
            var wechat = modal.params.wechat;
            if (!wechat.success) {
                return
            }
            if (wechat.weixin) {
                function onBridgeReady() {
                    WeixinJSBridge.invoke('getBrandWCPayRequest', {
                            'appId': wechat.appid ? wechat.appid: wechat.appId,
                            'timeStamp': wechat.timeStamp,
                            'nonceStr': wechat.nonceStr,
                            'package': wechat.package,
                            'signType': wechat.signType,
                            'paySign': wechat.paySign,
                        },
                        function(res) {
                            if (res.err_msg == 'get_brand_wcpay_request:ok') {
                                modal.complete(btn, 'wechat')
                            } else if (res.err_msg == 'get_brand_wcpay_request:cancel') {
                                FoxUI.toast.show('取消支付');
                                btn.removeAttr('stop')
                            } else {
                                btn.removeAttr('stop');
                                alert(res.err_msg)
                            }
                        })
                }
                if  (typeof WeixinJSBridge  ==  "undefined") {
                    if ( document.addEventListener ) {
                        document.addEventListener('WeixinJSBridgeReady',  onBridgeReady,  false)
                    } else
                    if  (document.attachEvent) {
                        document.attachEvent('WeixinJSBridgeReady',  onBridgeReady);
                        document.attachEvent('onWeixinJSBridgeReady',  onBridgeReady)
                    }
                } else {
                    onBridgeReady()
                }
            }
            if (wechat.weixin_jie) {
                var img = core.getUrl('index/qr', {
                    url: wechat.code_url
                });
                $('#qrmoney').text(modal.params.money);
                $('.order-weixinpay-hidden').show();
                $('#btnWeixinJieCancel').unbind('click').click(function() {
                    btn.removeAttr('stop');
                    clearInterval(settime);
                    $('.order-weixinpay-hidden').hide()
                });
                var settime = setInterval(function() {
                        $.getJSON(core.getUrl('packagegoods/pay/orderstatus'), {
                                id: modal.params.orderid
                            },
                            function(data) {
                                if (data.result.status >= 1) {
                                    clearInterval(settime);
                                    modal.complete(btn, 'wechat')
                                }
                            })
                    },
                    1000);
                $('.verify-pop').find('.close').unbind('click').click(function() {
                    $('.order-weixinpay-hidden').hide();
                    btn.removeAttr('stop');
                    clearInterval(settime)
                });
                $('.verify-pop').find('.qrimg').attr('src', img).show()
            }
        };
        modal.payAlipay = function(btn) {
            var alipay = modal.params.alipay;
            if (!alipay.success) {
                return
            }
            location.href = core.getUrl('order/alipay', { //ewei_shopv2\core\mobile\order\index\alipay
                url: alipay.url
            })
        };
        modal.complete = function(btn, type) {
            core.json('packagegoods/pay/complete', {
                    orderid: modal.params.orderid,
                    teamid: modal.params.teamid,
                    type: type,
                    isteam: modal.params.isteam
                },
                function(pay_json) {
                    if (pay_json.status == 1) {
                        if (modal.params.teamid > 0) {
                            location.href = core.getUrl('packagegoods/team/detail', {
                                orderid: modal.params.orderid,
                                teamid: modal.params.teamid
                            })
                        } else {
                            location.href = core.getUrl('packagegoods/orders/detail', {
                                orderid: modal.params.orderid,
                                teamid: modal.params.teamid
                            })
                        }
                        return
                    }
                    FoxUI.loader.hide();
                    btn.removeAttr('stop');
                    FoxUI.toast.show(pay_json.result.message)
                },
                false, true)
        };
        return modal
    });




