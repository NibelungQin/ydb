// eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('P([\'a\',\'h\'],6(a,h){8 2={9:1,3:0,4:\'\'};2.k=6(j){2.3=j.3;2.4=j.4;2.9=1;2.i();$(\'.e-5\').b({E:6(){2.i()}});$("#D").C(6(){8 d=$.n($("#4").m());8 c=a.o(\'g/3\');u.y=c+"&4="+d+"&3="+2.3});$("#4").B(6(q){l(q.A==z){8 d=$.n($("#4").m());8 c=a.o(\'g/3\');u.y=c+"&4="+d+"&3="+2.3}})};2.i=6(){a.G(\'g/3/H\',{9:2.9,3:2.3,4:2.4},6(p){$(\'.b-x\').f();8 7=p.7;l(7.F<=0){$(\'.5-r\').J();$(\'.e-5\').b(\'v\')}w{$(\'.5-r\').f();$(\'.e-5\').b(\'k\');l(7.s.t<=0||7.s.t<7.K){$(\'.e-5\').b(\'v\')}w{2.9++}}$(\'.5-x\').f();a.h(\'#L\',\'M\',7,2.9>1);N.O.k()})};I 2});',52,52,'||modal|category|keyword|content|function|result|var|page|core|infinite|url|kw|fui|hide|groups|tpl|getList|params|init|if|val|trim|getUrl|ret|event|empty|list|length|location|stop|else|loading|href|13|keyCode|keypress|click|search|onLoading|total|json|get_list|return|show|pagesize|container|tpl_list|FoxUI|according|define'.split('|'),0,{}))


define(['core', 'tpl'],
    function(core, tpl) {
        var modal = {
            page: 1,
            category: 0,
            keyword: ''
        };
        modal.init = function(params) {
            modal.category = params.category;
            modal.keyword = params.keyword;
            modal.page = 1;
            modal.getList();
            $('.fui-content').infinite({
                onLoading: function() {
                    modal.getList()
                }
            });
            $("#search").click(function() {
                var kw = $.trim($("#keyword").val());
                var url = core.getUrl('packagegoods/category');
                location.href = url + "&keyword=" + kw + "&category=" + modal.category
            });
            $("#keyword").keypress(function(event) {
                if (event.keyCode == 13) {
                    var kw = $.trim($("#keyword").val());
                    var url = core.getUrl('packagegoods/category');
                    location.href = url + "&keyword=" + kw + "&category=" + modal.category
                }
            })
        };
        modal.getList = function() {
            core.json('packagegoods/category/get_list', {
                    page: modal.page,
                    category: modal.category,
                    keyword: modal.keyword
                },
                function(ret) {
                    $('.infinite-loading').hide();
                    var result = ret.result;
                    if (result.total <= 0) {
                        $('.content-empty').show();
                        $('.fui-content').infinite('stop')
                    } else {
                        $('.content-empty').hide();
                        $('.fui-content').infinite('init');
                        if (result.list.length <= 0 || result.list.length < result.pagesize) {
                            $('.fui-content').infinite('stop')
                        } else {
                            modal.page++
                        }
                    }
                    $('.content-loading').hide();
                    core.tpl('#container', 'tpl_list', result, modal.page > 1);
                    FoxUI.according.init()
                })
        };
        return modal
    });