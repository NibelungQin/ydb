// eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('v([\'c\',\'i\'],4(c,i){k 2={5:1,6:\'\'};2.d=4(){$(\'.8-3\').9({y:4(){2.b()}});e(2.5==1){2.b()}w.m({h:$(\'#m\'),u:{6:4(){2.a(0)},r:4(){2.a(1)},s:4(){2.a(\'-1\')}}})};2.a=4(6){$(\'.8-3\').9(\'d\');$(\'.3-f\').g(),$(\'.3-j\').o(),$(\'#h\').x(\'\');2.5=1,2.6=6,2.b()};2.j=4(){2.5++};2.b=4(){c.E(\'F/G/D\',{5:2.5,6:2.6},4(n){k 7=n.7;e(7.C<=0){$(\'.3-f\').o();$(\'.8-3\').9(\'l\')}A{$(\'.3-f\').g();$(\'.8-3\').9(\'d\');e(7.p.q<=0||7.p.q<7.B){$(\'.8-3\').9(\'l\')}}$(\'.3-j\').g();2.5++;c.i(\'#h\',\'z\',7,2.5>1)})};t 2});',43,43,'||modal|content|function|page|success|result|fui|infinite|changeTab|getList|core|init|if|empty|hide|container|tpl|loading|var|stop|tab|ret|show|list|length|success0|success1|return|handlers|define|FoxUI|html|onLoading|tpl_groups_team_list|else|pagesize|total|get_list|json|groups|team'.split('|'),0,{}))


define(['core', 'tpl'],
    function(core, tpl) {
        var modal = {
            page: 1,
            success: ''
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
                    success: function() {
                        modal.changeTab(0)
                    },
                    success0: function() {
                        modal.changeTab(1)
                    },
                    success1: function() {
                        modal.changeTab('-1')
                    }
                }
            })
        };
        modal.changeTab = function(success) {
            $('.fui-content').infinite('init');
            $('.content-empty').hide(),
                $('.content-loading').show(),
                $('#container').html('');
            modal.page = 1,
                modal.success = success,
                modal.getList()
        };
        modal.loading = function() {
            modal.page++
        };
        modal.getList = function() {
            core.json('packagegoods/team/get_list', {
                    page: modal.page,
                    success: modal.success
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
                    core.tpl('#container', 'tpl_groups_team_list', result, modal.page > 1)
                })
        };
        return modal
    });