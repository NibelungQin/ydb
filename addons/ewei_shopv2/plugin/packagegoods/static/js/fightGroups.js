// eval(function(p,a,c,k,e,d){e=function(c){return c.toString(36)};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('m([\'g\',\'a\'],4(g,a,o){3 8={l:{}};8.p=4(){$(4(){$("k.h i.j").n(4(7,u){3 2=$("#2"+7+"").w("x");f=q.z(4(){d(2>0){2=2-1;3 c=6.5(2%9);3 e=6.5((2/9)%9);3 b=6.5(2/s);d(2<=0){t(f)}$("#2"+7+"").y(b+":"+e+":"+c)}},r)})})};v 8});',36,36,'||residualtime|var|function|floor|Math|index|modal|60|tpl|hour|second|if|minite|InterValObj|core|lynn_fightgroups_span|strong|fl|span|params|define|each|op|init|window|1000|3600|clearInterval|element|return|attr|title|html|setInterval'.split('|'),0,{}))


define(['core', 'tpl'],
    function(core, tpl, op) {
        var modal = {
            params: {}
        };
        modal.init = function() {
            $(function() {
                $("span.lynn_fightgroups_span strong.fl").each(function(index, element) {
                    var residualtime = $("#residualtime" + index + "").attr("title");
                    InterValObj = window.setInterval(function() {
                            if (residualtime > 0) {
                                residualtime = residualtime - 1;
                                var second = Math.floor(residualtime % 60);
                                var minite = Math.floor((residualtime / 60) % 60);
                                var hour = Math.floor(residualtime / 3600);
                                if (residualtime <= 0) {
                                    clearInterval(InterValObj)
                                }
                                $("#residualtime" + index + "").html(hour + ":" + minite + ":" + second)
                            }
                        },
                        1000)
                })
            })
        };
        return modal
    });