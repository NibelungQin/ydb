// eval(function(p,a,c,k,e,d){e=function(c){return c.toString(36)};if(!''.replace(/^/,String)){while(c--){d[c.toString(a)]=k[c]||c.toString(a)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('4 2={6:{}};2.k=3(o){9.6.7=o.7}2.d=3(c,e){4 5=c.j(\'/\');i 9.6.7+"&m="+5[0]+"&n="+5[1]+"&"+e}2.b=3(8){4 a=9.d(\'t/q\',\'8=\'+8);$(\'#f-l-b\').f().p(\'r\').s(0).h(\'g\',a)}',30,30,'||Exhelper|function|var|ops|options|baseurl|id|this|url|preview|segs|getUrl|params|modal|src|setAttribute|return|split|init|module|method|op||find|perview|iframe|get|express'.split('|'),0,{}))



var Exhelper = {
    options: {}
};
Exhelper.init = function(o) {
    this.options.baseurl = o.baseurl
}
Exhelper.getUrl = function(segs, params) {
    var ops = segs.split('/');
    return this.options.baseurl + "&method=" + ops[0] + "&op=" + ops[1] + "&" + params
}
Exhelper.preview = function(id) {
    var url = this.getUrl('express/perview', 'id=' + id);
    $('#modal-module-preview').modal().find('iframe').get(0).setAttribute('src', url)
}