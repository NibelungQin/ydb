// eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('1j([\'l\',\'R\',\'./J.1i\'],4(l,R,J){5 6={d:{}};6.N=4(d){6.d.7=d.7;6.d.w=d.w;J.N({1g:n});$(\'.D-v\').i(4(){h($(3).e(\'z\')){p}I.1k(\'确定您要取消申请?\',\'\',4(){$(3).e(\'z\',1).e(\'y\',$(3).9()).9(\'正在处理..\');l.U(\'H/1l/v\',{\'7\':6.d.7},4(A){h(A.11==1){c.1q=l.1p(\'H/1o/1e\',{7:6.d.7,w:6.d.w});p}E{I.1r.j(A.X.14)}$(\'.D-v\').P(\'z\').9($(\'.D-v\').e(\'y\')).P(\'y\')},n,n)})});$(\'.Z-f\').W(\'i\').i(4(){5 7=$(3).8(\'7\');6.f(7)});$(\'.1c-1b\').i(4(){5 8=$(3).e(\'8\');5 u="18"+8;5 q=$(3).e(\'q\');h(q==\'1\'){$("."+u).1d()}E{$("."+u).19()}$(3).e(\'q\',q==\'1\'?\'0\':\'1\')});h($(\'#L\').1m>0){5 k=[];5 S=G 1M.1O();S.1J(4(r){5 1P=3;h(3.1I()==1G){5 s=r.Q.s,t=r.Q.t;$(\'.T-1L\').O(4(){5 c=$(3).o(\'.c\');5 F=$(3).8(\'t\'),x=$(3).8(\'s\');h(F>0&&x>0){5 g=l.1N(t,s,F,x);$(3).8(\'g\',g);c.9(\'距离您: \'+g.1x(2)+"1w").j()}E{$(3).8(\'g\',1t);c.9(\'无法获得距离\').j()}k.1u($(3))});k.1y(4(a,b){p a.8(\'g\')-b.8(\'g\')});$.O(k,4(){$(\'.T-m\').M(3)});$(\'#L\').j();$(\'#B\').M($(k[0]).9());5 c=$(\'#B\').o(\'.c\').9();$(\'#B\').o(\'.c\').9(c+"<10 1K=\'13-12 13-12-1A\'>最近</10> ");$(k[0]).1B()}},{1C:n})}};6.f=4(7){m=G 1D({1z:$(".Z-f-1v").9(),1F:"1E-6",1H:4(){m.K()}});m.j();$(\'.f-V\').o(\'.K\').W(\'i\').i(4(){m.K()});l.U(\'H/f/1s\',{u:7},4(C){h(C.11==0){I.17(\'生成出错，请刷新重试!\');p}5 Y=+G 16();$(\'.f-V\').o(\'.15\').e(\'1a\',C.X.1n+"?1f="+Y).j()},1h,n)};p 6});',62,114,'|||this|function|var|modal|orderid|data|html|||location|params|attr|verify|distance|if|click|show|arr|core|container|true|find|return|hide||lat|lng|id|cancel|teamid|store_lat|buttontext|stop|postjson|nearStoreHtml|ret|btn|else|store_lng|new|groups|FoxUI|op|close|nearStore|append|init|each|removeAttr|point|tpl|geolocation|store|json|pop|unbind|result|time|order|span|status|label|fui|message|qrimg|Date|alert|diyinfo_|slideUp|src|diyinfo|look|slideDown|detail|timestamp|fromDetail|false|js|define|confirm|refund|length|url|orders|getUrl|href|toast|qrcode|999999999999999999|push|hidden|km|toFixed|sort|content|danger|remove|enableHighAccuracy|FoxUIModal|popup|extraClass|BMAP_STATUS_SUCCESS|maskClick|getStatus|getCurrentPosition|class|item|BMap|getDistanceByLnglat|Geolocation|_this'.split('|'),0,{}))



define(['core', 'tpl', './op.js'],
    function(core, tpl, op) {
        var modal = {
            params: {}
        };
        modal.init = function(params) {
            modal.params.orderid = params.orderid;
            modal.params.teamid = params.teamid;
            op.init({
                fromDetail: true
            });
            $('.btn-cancel').click(function() {
                if ($(this).attr('stop')) {
                    return
                }
                FoxUI.confirm('确定您要取消申请?', '',
                    function() {
                        $(this).attr('stop', 1).attr('buttontext', $(this).html()).html('正在处理..');
                        core.json('packagegoods/refund/cancel', {
                                'orderid': modal.params.orderid
                            },
                            function(postjson) {
                                if (postjson.status == 1) {
                                    location.href = core.getUrl('packagegoods/orders/detail', {
                                        orderid: modal.params.orderid,
                                        teamid: modal.params.teamid
                                    });
                                    return
                                } else {
                                    FoxUI.toast.show(postjson.result.message)
                                }
                                $('.btn-cancel').removeAttr('stop').html($('.btn-cancel').attr('buttontext')).removeAttr('buttontext')
                            },
                            true, true)
                    })
            });
            $('.order-verify').unbind('click').click(function() {
                var orderid = $(this).data('orderid');
                modal.verify(orderid)
            });
            $('.look-diyinfo').click(function() {
                var data = $(this).attr('data');
                var id = "diyinfo_" + data;
                var hide = $(this).attr('hide');
                if (hide == '1') {
                    $("." + id).slideDown()
                } else {
                    $("." + id).slideUp()
                }
                $(this).attr('hide', hide == '1' ? '0': '1')
            });
            if ($('#nearStore').length > 0) {
                var arr = [];
                var geolocation = new BMap.Geolocation();
                geolocation.getCurrentPosition(function(r) {
                        var _this = this;
                        if (this.getStatus() == BMAP_STATUS_SUCCESS) {
                            var lat = r.point.lat,
                                lng = r.point.lng;
                            $('.store-item').each(function() {
                                var location = $(this).find('.location');
                                var store_lng = $(this).data('lng'),
                                    store_lat = $(this).data('lat');
                                if (store_lng > 0 && store_lat > 0) {
                                    var distance = core.getDistanceByLnglat(lng, lat, store_lng, store_lat);
                                    $(this).data('distance', distance);
                                    location.html('距离您: ' + distance.toFixed(2) + "km").show()
                                } else {
                                    $(this).data('distance', 999999999999999999);
                                    location.html('无法获得距离').show()
                                }
                                arr.push($(this))
                            });
                            arr.sort(function(a, b) {
                                return a.data('distance') - b.data('distance')
                            });
                            $.each(arr,
                                function() {
                                    $('.store-container').append(this)
                                });
                            $('#nearStore').show();
                            $('#nearStoreHtml').append($(arr[0]).html());
                            var location = $('#nearStoreHtml').find('.location').html();
                            $('#nearStoreHtml').find('.location').html(location + "<span class='fui-label fui-label-danger'>最近</span> ");
                            $(arr[0]).remove()
                        }
                    },
                    {
                        enableHighAccuracy: true
                    })
            }
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