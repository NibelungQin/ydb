// eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('14([\'7\',\'V\'],6(7,V){m 3={0:{}};3.19=6(0){3.0.4=0.4;3.0.5=0.5;3.0.l=0.l;$(\'.v-1a-x\').x({18:7.k(\'T/x\'),17:7.k(\'T/x/15\')});$(\'#t\').11(6(){m t=$(9).Q("13:Z").a();b(t==2){$(\'.r-S\').16();$(\'.Y-g\').c(\'换货\')}I{$(\'.r-S\').o();$(\'.Y-g\').c(\'退款\')}});$(\'.i-L\').A(6(){b($(9).d(\'8\')){e}b(!$(\'#K\').1i()){j.w.o(\'请输入数字金额!\');e}m q=[];$(\'#q\').Q(\'1j\').1k(6(){q.1h($(9).10(\'1g\'))});$(9).d(\'8\',1).c(\'正在处理...\');7.E(\'h/v/L\',{\'4\':3.0.4,\'5\':3.0.5,\'t\':$(\'#t\').a(),\'U\':$(\'#U\').a(),\'R\':$(\'#R\').a(),\'q\':q,\'K\':$(\'#K\').a()},6(s){b(s.B==1){F.C=7.k(\'h/D/G\',{4:3.0.4,5:3.0.5});e}$(\'.i-L\').p(\'8\').c(\'确定\');j.w.o(s.P.O)},f,f)});$(\'.i-y\').A(6(){b($(9).d(\'8\')){e}$(9).d(\'8\',1).d(\'M\',$(9).c()).c(\'正在处理..\');7.E(\'h/v/y\',{4:3.0.4,5:3.0.5},6(s){b(s.B==1){F.C=7.k(\'h/D/G\',{4:3.0.4,5:3.0.5});e}$(\'.i-y\').p(\'8\').c($(\'.i-y\').d(\'M\')).p(\'M\')},f,f)});$("1c[u=z]").a($(\'#1d\').a()).11(6(){m 12=$(9);m W=12.Q("13:Z");m u=W.10("u");$(":1e[u=H]").a(u)});$(\'#X\').A(6(){b($(9).d(\'8\')){e}b($(\'#N\').1b()){j.w.o(\'请填写快递单号\');e}$(9).c(\'正在处理...\').d(\'8\',1);7.E(\'h/v/z\',{4:3.0.4,5:3.0.5,l:3.0.l,z:$(\'#z\').a(),H:$(\'#H\').a(),N:$(\'#N\').a()},6(n){b(n.B==1){F.C=7.k(\'h/D/G\',{4:3.0.4,5:3.0.5})}I{$(\'#X\').c(\'确认\').p(\'8\');j.w.o(n.P.O)}},f,f)});$(\'.i-J\').A(6(){b($(9).d(\'8\')){e}j.1f(\'确认您已经收到换货物品?\',\'\',6(){$(9).d(\'8\',1).c(\'正在处理...\');7.E(\'h/v/J\',{l:3.0.l,4:3.0.4,5:3.0.5},6(n){b(n.B==1){F.C=7.k(\'h/D/G\',{4:3.0.4,5:3.0.5})}I{$(\'.i-J\').c(\'确认收到换货物品\').p(\'8\');j.w.o(n.P.O)}},f,f)})})};e 3});',62,83,'params|||modal|orderid|teamid|function|core|stop|this|val|if|html|attr|return|true||groups|btn|FoxUI|getUrl|refundid|var|postjson|show|removeAttr|images||ret|rtype|name|refund|toast|uploader|cancel|express|click|status|href|orders|json|location|detail|expresscom|else|receive|price|submit|buttontext|expresssn|message|result|find|content|group|util|reason|tpl|sel|express_submit|re|selected|data|change|obj|option|define|remove|hide|removeUrl|uploadUrl|init|container|isEmpty|select|express_old|input|confirm|filename|push|isNumber|li|each'.split('|'),0,{}))



define(['core', 'tpl'],
    function(core, tpl) {
        var modal = {
            params: {}
        };
        modal.init = function(params) {
            modal.params.orderid = params.orderid;
            modal.params.teamid = params.teamid;
            modal.params.refundid = params.refundid;
            $('.refund-container-uploader').uploader({
                uploadUrl: core.getUrl('util/uploader'),
                removeUrl: core.getUrl('util/uploader/remove')
            });
            $('#rtype').change(function() {
                var rtype = $(this).find("option:selected").val();
                if (rtype == 2) {
                    $('.r-group').hide();
                    $('.re-g').html('换货')
                } else {
                    $('.r-group').show();
                    $('.re-g').html('退款')
                }
            });
            $('.btn-submit').click(function() {
                if ($(this).attr('stop')) {
                    return
                }
                if (!$('#price').isNumber()) {
                    FoxUI.toast.show('请输入数字金额!');
                    return
                }
                var images = [];
                $('#images').find('li').each(function() {
                    images.push($(this).data('filename'))
                });
                $(this).attr('stop', 1).html('正在处理...');
                core.json('packagegoods/refund/submit', {
                        'orderid': modal.params.orderid,
                        'teamid': modal.params.teamid,
                        'rtype': $('#rtype').val(),
                        'reason': $('#reason').val(),
                        'content': $('#content').val(),
                        'images': images,
                        'price': $('#price').val()
                    },
                    function(ret) {
                        if (ret.status == 1) {
                            location.href = core.getUrl('packagegoods/orders/detail', {
                                orderid: modal.params.orderid,
                                teamid: modal.params.teamid
                            });
                            return
                        }
                        $('.btn-submit').removeAttr('stop').html('确定');
                        FoxUI.toast.show(ret.result.message)
                    },
                    true, true)
            });
            $('.btn-cancel').click(function() {
                if ($(this).attr('stop')) {
                    return
                }
                $(this).attr('stop', 1).attr('buttontext', $(this).html()).html('正在处理..');
                core.json('packagegoods/refund/cancel', {
                        orderid: modal.params.orderid,
                        teamid: modal.params.teamid
                    },
                    function(ret) {
                        if (ret.status == 1) {
                            location.href = core.getUrl('packagegoods/orders/detail', {
                                orderid: modal.params.orderid,
                                teamid: modal.params.teamid
                            });
                            return
                        }
                        $('.btn-cancel').removeAttr('stop').html($('.btn-cancel').attr('buttontext')).removeAttr('buttontext')
                    },
                    true, true)
            });
            $("select[name=express]").val($('#express_old').val()).change(function() {
                var obj = $(this);
                var sel = obj.find("option:selected");
                var name = sel.data("name");
                $(":input[name=expresscom]").val(name)
            });
            $('#express_submit').click(function() {
                if ($(this).attr('stop')) {
                    return
                }
                if ($('#expresssn').isEmpty()) {
                    FoxUI.toast.show('请填写快递单号');
                    return
                }
                $(this).html('正在处理...').attr('stop', 1);
                core.json('packagegoods/refund/express', {
                        orderid: modal.params.orderid,
                        teamid: modal.params.teamid,
                        refundid: modal.params.refundid,
                        express: $('#express').val(),
                        expresscom: $('#expresscom').val(),
                        expresssn: $('#expresssn').val()
                    },
                    function(postjson) {
                        if (postjson.status == 1) {
                            location.href = core.getUrl('packagegoods/orders/detail', {
                                orderid: modal.params.orderid,
                                teamid: modal.params.teamid
                            })
                        } else {
                            $('#express_submit').html('确认').removeAttr('stop');
                            FoxUI.toast.show(postjson.result.message)
                        }
                    },
                    true, true)
            });
            $('.btn-receive').click(function() {
                if ($(this).attr('stop')) {
                    return
                }
                FoxUI.confirm('确认您已经收到换货物品?', '',
                    function() {
                        $(this).attr('stop', 1).html('正在处理...');
                        core.json('packagegoods/refund/receive', {
                                refundid: modal.params.refundid,
                                orderid: modal.params.orderid,
                                teamid: modal.params.teamid
                            },
                            function(postjson) {
                                if (postjson.status == 1) {
                                    location.href = core.getUrl('packagegoods/orders/detail', {
                                        orderid: modal.params.orderid,
                                        teamid: modal.params.teamid
                                    })
                                } else {
                                    $('.btn-receive').html('确认收到换货物品').removeAttr('stop');
                                    FoxUI.toast.show(postjson.result.message)
                                }
                            },
                            true, true)
                    })
            })
        };
        return modal
    });