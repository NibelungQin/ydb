// eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('J([\'f\',\'A\'],4(f,A,K){7 e={F:{}};e.D=4(){7 n=$(\'.3-I\');7 o=n.d(\'o\'),6=n.d(\'6\');5(o==2){5($(\'.3-9:i\').h>0){$(\'.j-3\').a(\'b\').p(\'确认使用(\'+$(\'.3-9:i\').h+")")}g{$(\'.j-3\').a(\'b\').p(\'全部使用\')}}n.a(\'.3-k\').L(4(){7 k=$(z);7 m=k.d(\'m\');k.a(\'.3-9\').P(\'r\').r(4(){f.C(\'v/3/E\',{u:6,m:m},4(q){O(4(){5($(\'.3-9:i\').h<=0){$(\'.j-3\').a(\'b\').p(\'全部使用\')}g{$(\'.j-3\').a(\'b\').p(\'确认使用(\'+$(\'.3-9:i\').h+")")}},0)},B,B)})});$(".M-G").H({N:"最少核销{Y}次",12:"最多核销{11}次"});$(\'.j-3\').r(4(){e.3($(z))})};e.3=4(s){7 c="",l=s.d(\'o\'),6=s.d(\'6\');7 8=10($(\'.13\').14());5(l==0){c="确认核销吗?"}g 5(l==1){5(8<=0){w.x.y(\'最少核销一次\');t}c="确认核销 <b 15=\'Q-Z\'>"+8+"</b> 次吗?"}g 5(l==2){5($(\'.3-9:i\').h<=0){c="确认核销所有消费码吗?"}g{c="确认核销选择的消费码吗?"}}w.T(c,4(){f.C(\'v/3/S\',{u:6,8:8},4(q){5(q.R==0){w.x.y(q.V.X);t}W.17=f.U(\'v/3/16\',{u:6,8:8})})})};t e});',62,70,'|||verify|function|if|orderid|var|times|checkbox|find|span|tip|data|modal|core|else|length|checked|order|cell|type|verifycode|verify_container|verifytype|html|ret|click|btn|return|id|groups|FoxUI|toast|show|this|tpl|true|json|init|select|params|number|numbers|container|define|op|each|fui|minToast|setTimeout|unbind|text|status|complete|confirm|getUrl|result|location|message|min|danger|parseInt|max|maxToast|shownum|val|class|success|href'.split('|'),0,{}))



define(['core', 'tpl'],
    function(core, tpl, op) {
        var modal = {
            params: {}
        };
        modal.init = function() {
            var verify_container = $('.verify-container');
            var verifytype = verify_container.data('verifytype'),
                orderid = verify_container.data('orderid');
            if (verifytype == 2) {
                if ($('.verify-checkbox:checked').length > 0) {
                    $('.order-verify').find('span').html('确认使用(' + $('.verify-checkbox:checked').length + ")")
                } else {
                    $('.order-verify').find('span').html('全部使用')
                }
            }
            verify_container.find('.verify-cell').each(function() {
                var cell = $(this);
                var verifycode = cell.data('verifycode');
                cell.find('.verify-checkbox').unbind('click').click(function() {
                    core.json('packagegoods/verify/select', {
                            id: orderid,
                            verifycode: verifycode
                        },
                        function(ret) {
                            setTimeout(function() {
                                    if ($('.verify-checkbox:checked').length <= 0) {
                                        $('.order-verify').find('span').html('全部使用')
                                    } else {
                                        $('.order-verify').find('span').html('确认使用(' + $('.verify-checkbox:checked').length + ")")
                                    }
                                },
                                0)
                        },
                        true, true)
                })
            });
            $(".fui-number").numbers({
                minToast: "最少核销{min}次",
                maxToast: "最多核销{max}次"
            });
            $('.order-verify').click(function() {
                modal.verify($(this))
            })
        };
        modal.verify = function(btn) {
            var tip = "",
                type = btn.data('verifytype'),
                orderid = btn.data('orderid');
            var times = parseInt($('.shownum').val());
            if (type == 0) {
                tip = "确认核销吗?"
            } else if (type == 1) {
                if (times <= 0) {
                    FoxUI.toast.show('最少核销一次');
                    return
                }
                tip = "确认核销 <span class='text-danger'>" + times + "</span> 次吗?"
            } else if (type == 2) {
                if ($('.verify-checkbox:checked').length <= 0) {
                    tip = "确认核销所有消费码吗?"
                } else {
                    tip = "确认核销选择的消费码吗?"
                }
            }
            FoxUI.confirm(tip,
                function() {
                    core.json('packagegoods/verify/complete', {
                            id: orderid,
                            times: times
                        },
                        function(ret) {
                            if (ret.status == 0) {
                                FoxUI.toast.show(ret.result.message);
                                return
                            }
                            location.href = core.getUrl('packagegoods/verify/success', {
                                id: orderid,
                                times: times
                            })
                        })
                })
        };
        return modal
    });