// eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('13([\'9\',\'N\'],f(9,N){6 8={c:{11:0,10:[],Z:0,p:0,S:0,F:0,X:0}};8.W=f(c){8.c=$.V(8.c,c||{});6 2=i;3(t(d.x)!==\'n\'){2=d.x}A 3(t(d.B)!==\'n\'){2=d.B;2.7=2.U.T(/ /P,\'\')+\' \'+2.7}3(2){8.c.F=2.m;$(\'#b .Q-7\').r();$(\'#b .R-7\').12();$(\'#b .Y\').w(2.m);$(\'#b .h\').4(2.h);$(\'#b .o\').4(2.o);$(\'#b .7\').4(2.7);$(\'#b a\').E(\'14\',9.1d(\'1j/7/1i\'));$(\'#b a\').C(f(){d.1h=2.m})}6 e=i;3(t(d.O)!==\'n\'){e=d.O;8.c.1g=e.m;$(\'#v .y\').4(e.y);$(\'#v .h\').4(e.h);$(\'#1f\').4(e.o);$(\'#v .7\').4(e.7)}$(\'#k\').C(f(){3(1e.L){$("#z").w(1)}A{$("#z").w(0)}8.J()});$("1c").15(f(){6 p=$("#1b").E("M-1a");3($("G[H=o]").19()==i&&p){D.I.r(\'联系电话格式有误\');j i}3($("G[H=h]")==n&&p){D.I.r(\'联系人信息有误\');j i}})};8.J=f(){6 q=9.l($(\'.q\').4());6 u=9.l($(".u").4());6 g=0;3($(\'.g\').K>0){g=9.l($(".g").4())}6 5=q-g;5=5+u;6 s=0;3($("#k").K>0){3($("#k").18(\'L\')){s=9.l($("#k").M(\'17\'))}}5=5-s;3(5<=0){5=0}$(\'.5\').4(9.16(5));j 5};j 8});',62,82,'||loadAddress|if|html|totalprice|var|address|modal|core||addressInfo|params|window|loadStore|function|discountprice|realname|false|return|deductcredit|getNumber|id|undefined|mobile|isverify|goodsprice|show|deductprice|typeof|dispatchprice|carrierInfo|val|selectedAddressData|storename|isdeduct|else|editAddressData|click|FoxUI|attr|addressid|input|name|toast|totalPrice|length|checked|data|tpl|selectedStoreData|ig|has|no|isvirtual|replace|areas|extend|init|couponid|aid|iscarry|goods|orderid|hide|define|href|submit|number_format|money|prop|isMobile|type|memberInfo|form|getUrl|this|carrierInfo_mobile|storeid|orderSelectedAddressID|selector|member'.split('|'),0,{}))




define(['core', 'tpl'],
    function(core, tpl) {
        var modal = {
            params: {
                orderid: 0,
                goods: [],
                iscarry: 0,
                isverify: 0,
                isvirtual: 0,
                addressid: 0,
                couponid: 0
            }
        };
        modal.init = function(params) {
            modal.params = $.extend(modal.params, params || {});
            var loadAddress = false;
            if (typeof(window.selectedAddressData) !== 'undefined') {
                loadAddress = window.selectedAddressData
            } else if (typeof(window.editAddressData) !== 'undefined') {
                loadAddress = window.editAddressData;
                loadAddress.address = loadAddress.areas.replace(/ /ig, '') + ' ' + loadAddress.address
            }
            if (loadAddress) {
                modal.params.addressid = loadAddress.id;
                $('#addressInfo .has-address').show();
                $('#addressInfo .no-address').hide();
                $('#addressInfo .aid').val(loadAddress.id);
                $('#addressInfo .realname').html(loadAddress.realname);
                $('#addressInfo .mobile').html(loadAddress.mobile);
                $('#addressInfo .address').html(loadAddress.address);
                $('#addressInfo a').attr('href', core.getUrl('member/address/selector'));
                $('#addressInfo a').click(function() {
                    window.orderSelectedAddressID = loadAddress.id
                })
            }
            var loadStore = false;
            if (typeof(window.selectedStoreData) !== 'undefined') {
                loadStore = window.selectedStoreData;
                modal.params.storeid = loadStore.id;
                $('#carrierInfo .storename').html(loadStore.storename);
                $('#carrierInfo .realname').html(loadStore.realname);
                $('#carrierInfo_mobile').html(loadStore.mobile);
                $('#carrierInfo .address').html(loadStore.address)
            }
            $('#deductcredit').click(function() {
                if (this.checked) {
                    $("#isdeduct").val(1)
                } else {
                    $("#isdeduct").val(0)
                }
                modal.totalPrice()
            });
            $("form").submit(function() {
                var isverify = $("#memberInfo").attr("data-type");
                if ($("input[name=mobile]").isMobile() == false && isverify) {
                    FoxUI.toast.show('联系电话格式有误');
                    return false
                }
                if ($("input[name=realname]") == undefined && isverify) {
                    FoxUI.toast.show('联系人信息有误');
                    return false
                }
            })
        };
        modal.totalPrice = function() {
            var goodsprice = core.getNumber($('.goodsprice').html());
            var dispatchprice = core.getNumber($(".dispatchprice").html());
            var discountprice = 0;
            if ($('.discountprice').length > 0) {
                discountprice = core.getNumber($(".discountprice").html())
            }
            var totalprice = goodsprice - discountprice;
            totalprice = totalprice + dispatchprice;
            var deductprice = 0;
            if ($("#deductcredit").length > 0) {
                if ($("#deductcredit").prop('checked')) {
                    deductprice = core.getNumber($("#deductcredit").data('money'))
                }
            }
            totalprice = totalprice - deductprice;
            if (totalprice <= 0) {
                totalprice = 0
            }
            $('.totalprice').html(core.number_format(totalprice));
            return totalprice
        };
        return modal
    });