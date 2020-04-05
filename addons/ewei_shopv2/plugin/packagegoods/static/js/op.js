// eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('S([\'9\',\'G\'],2(9,G){f 4={};4.U=2(c){8(V c===R){c=7}4.c=c;$(\'.d-t Q\').l(\'H\').H(2(){f 3=$(k).i(\'3\');f u=$(k).u();8(u==\'\'){g}b.w(\'确认要取消订单吗?\',\'提示\',2(){4.t(3,u,7)})});$(\'.d-r\').l(\'a\').a(2(){f 3=$(k).i(\'3\');b.w(\'确认要删除订单吗?\',\'提示\',2(){4.r(3)})});$(\'.d-n\').l(\'a\').a(2(){f 3=$(k).i(\'3\');b.w(\'确认已收到货了吗?\',\'提示\',2(){4.n(3)})});$(\'.d-e\').l(\'a\').a(2(){f 3=$(k).i(\'3\');4.e(3)})};4.t=2(5,x){9.o(\'h/j/t\',{5:5,x:x},2(6){8(6.s==1){8(4.c){v.B=9.C(\'h/j\')}D{$(".d-E[i-3=\'"+5+"\']").K()}g}b.z.m(6.p)},7,7)};4.r=2(5){9.o(\'h/j/r\',{5:5},2(6){8(6.s==1){8(4.c){v.B=9.C(\'h/j\')}D{$(".d-E[i-3=\'"+5+"\']").K()}g}b.z.m(6.p)},7,7)};4.n=2(5){9.o(\'h/j/n\',{5:5},2(6){8(6.s==1){v.Z();g}b.z.m(6.p)},7,7)};4.e=2(3){q=I 16({15:$(".d-e-X").W(),N:"M-4",T:2(){q.A()}});q.m();$(\'.e-J\').F(\'.A\').l(\'a\').a(2(){q.A()});9.o(\'h/e/14\',{5:3},2(y){8(y.s==0){b.12(\'生成出错，请刷新重试!\');g}f L=+I P();$(\'.e-J\').F(\'.11\').17(\'Y\',y.p.13+"?10="+L).m()},O,7)};g 4});',62,70,'||function|orderid|modal|id|pay_json|true|if|core|click|FoxUI|fromDetail|order|verify|var|return|groups|data|orders|this|unbind|show|finish|json|result|container|delete|status|cancel|val|location|confirm|remark|ret|toast|close|href|getUrl|else|item|find|tpl|change|new|pop|remove|time|popup|extraClass|false|Date|select|undefined|define|maskClick|init|typeof|html|hidden|src|reload|timestamp|qrimg|alert|url|qrcode|content|FoxUIModal|attr'.split('|'),0,{}))



define(['core', 'tpl'],
    function(core, tpl) {
        var modal = {};
        modal.init = function(fromDetail) {
            if (typeof fromDetail === undefined) {
                fromDetail = true
            }
            modal.fromDetail = fromDetail;
            $('.order-cancel select').unbind('change').change(function() {
                var orderid = $(this).data('orderid');
                var val = $(this).val();
                if (val == '') {
                    return
                }
                FoxUI.confirm('确认要取消订单吗?', '提示',
                    function() {
                        modal.cancel(orderid, val, true)
                    })
            });
            $('.order-delete').unbind('click').click(function() {
                var orderid = $(this).data('orderid');
                FoxUI.confirm('确认要删除订单吗?', '提示',
                    function() {
                        modal.delete(orderid)
                    })
            });
            $('.order-finish').unbind('click').click(function() {
                var orderid = $(this).data('orderid');
                FoxUI.confirm('确认已收到货了吗?', '提示',
                    function() {
                        modal.finish(orderid)
                    })
            });
            $('.order-verify').unbind('click').click(function() {
                var orderid = $(this).data('orderid');
                modal.verify(orderid)
            })
        };
        modal.cancel = function(id, remark) {
            core.json('packagegoods/orders/cancel', {
                    id: id,
                    remark: remark
                },
                function(pay_json) {
                    if (pay_json.status == 1) {
                        if (modal.fromDetail) {
                            location.href = core.getUrl('packagegoods/orders')
                        } else {
                            $(".order-item[data-orderid='" + id + "']").remove()
                        }
                        return
                    }
                    FoxUI.toast.show(pay_json.result)
                },
                true, true)
        };
        modal.delete = function(id) {
            core.json('packagegoods/orders/delete', {
                    id: id
                },
                function(pay_json) {
                    if (pay_json.status == 1) {
                        if (modal.fromDetail) {
                            location.href = core.getUrl('packagegoods/orders')
                        } else {
                            $(".order-item[data-orderid='" + id + "']").remove()
                        }
                        return
                    }
                    FoxUI.toast.show(pay_json.result)
                },
                true, true)
        };
        modal.finish = function(id) {
            core.json('packagegoods/orders/finish', {
                    id: id
                },
                function(pay_json) {
                    if (pay_json.status == 1) {
                        location.reload();
                        return
                    }
                    FoxUI.toast.show(pay_json.result)
                },
                true, true)
        };
        modal.verify = function(orderid) {
            container = new FoxUIModal({
                content: $(".order-verify-hidden").html(),
                extraClass: "popup-modal",
                maskClick: function() {
                    container.close()
                }
            });
            container.show();
            $('.verify-pop').find('.close').unbind('click').click(function() {
                container.close()
            });
            core.json('packagegoods/verify/qrcode', {
                    id: orderid
                },
                function(ret) {
                    if (ret.status == 0) {
                        FoxUI.alert('生成出错，请刷新重试!');
                        return
                    }
                    var time = +new Date();
                    $('.verify-pop').find('.qrimg').attr('src', ret.result.url + "?timestamp=" + time).show()
                },
                false, true)
        };
        return modal
    });