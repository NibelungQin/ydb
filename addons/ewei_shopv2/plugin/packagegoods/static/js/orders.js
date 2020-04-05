// eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('E([\'g\',\'h\'],6(g,h){u 5={8:1,9:\'\'};5.e=6(){$(\'.d-7\').c({D:6(){5.f()}});m(5.8==1){5.f()}w.v({l:$(\'#v\'),C:{9:6(){5.b(0)},F:6(){5.b(1)},G:6(){5.b(2)},I:6(){5.b(3)},B:6(){5.b(4)}}})};5.b=6(9){$(\'.d-7\').c(\'e\');$(\'.7-k\').i(),$(\'.7-j\').p(),$(\'#l\').x(\'\');5.8=1,5.9=9,5.f()};5.j=6(){5.8++};5.f=6(){g.y(\'r/z/H\',{8:5.8,9:5.9},6(s){u a=s.a;m(a.K<=0){$(\'.7-k\').p();$(\'.d-7\').c(\'o\')}S{$(\'.7-k\').i();$(\'.d-7\').c(\'e\');m(a.t.q<=0||a.t.q<a.P){$(\'.d-7\').c(\'o\')}}$(\'.7-j\').i();5.8++;g.h(\'#l\',\'U\',a,5.8>1);w.V.e();O([\'../N/T/A/r/Q/n/R.n\'],6(5){5.e({M:L})})})};J 5});',58,58,'|||||modal|function|content|page|status|result|changeTab|infinite|fui|init|getList|core|tpl|hide|loading|empty|container|if|js|stop|show|length|groups|ret|list|var|tab|FoxUI|html|json|orders|plugin|status3|handlers|onLoading|define|status0|status1|get_list|status2|return|total|false|fromDetail|addons|require|pagesize|static|op|else|ewei_shopv2|tpl_groups_order_list|according'.split('|'),0,{}))



define(['core', 'tpl'],
    function(core, tpl) {
        var modal = {
            page: 1,
            status: ''
        };
        modal.init = function() {
            $('.fui-content').infinite({
                onLoading: function() {
                    modal.getList()
                }
            });
            if (modal.page == 1) {
                modal.getList()
            }
            FoxUI.tab({
                container: $('#tab'),
                handlers: {
                    status: function() {
                        modal.changeTab(0)
                    },
                    status0: function() {
                        modal.changeTab(1)
                    },
                    status1: function() {
                        modal.changeTab(2)
                    },
                    status2: function() {
                        modal.changeTab(3)
                    },
                    status3: function() {
                        modal.changeTab(4)
                    }
                }
            })
        };
        modal.changeTab = function(status) {
            $('.fui-content').infinite('init');
            $('.content-empty').hide(),
                $('.content-loading').show(),
                $('#container').html('');
            modal.page = 1,
                modal.status = status,
                modal.getList()
        };
        modal.loading = function() {
            modal.page++
        };
        modal.getList = function() {
            core.json('packagegoods/orders/get_list', {
                    page: modal.page,
                    status: modal.status
                },
                function(ret) {
                    var result = ret.result;
                    if (result.total <= 0) {
                        $('.content-empty').show();
                        $('.fui-content').infinite('stop')
                    } else {
                        $('.content-empty').hide();
                        $('.fui-content').infinite('init');
                        if (result.list.length <= 0 || result.list.length < result.pagesize) {
                            $('.fui-content').infinite('stop')
                        }
                    }
                    $('.content-loading').hide();
                    modal.page++;
                    core.tpl('#container', 'tpl_groups_order_list', result, modal.page > 1);
                    FoxUI.according.init();
                    require(['../addons/ewei_shopv2/plugin/packagegoods/static/js/op.js'],
                        function(modal) {
                            modal.init({
                                fromDetail: false
                            })
                        })
                })
        };
        return modal
    });