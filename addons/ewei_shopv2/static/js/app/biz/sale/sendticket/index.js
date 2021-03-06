define(['core', 'tpl'], function(core, tpl) {
    var modal = {};
    setTimeout(function() {
        FoxUI.mask.show();
        $('.eject-outer').css('display', 'block')
    }, 200);
    modal.init = function(params) {
        if (params != null && params != undefined && params != "") {
            if (params.orderid != null && params.orderid != undefined && params.orderid != "") {
                var orderid = params.orderid ? params.orderid : ''
            }
        }
        $(".eject3").click(function() {
            $('.fui-mask').hide();
            $('.eject-outer').fadeOut()
        });
        $(".eject4").click(function() {
            $('.fui-mask').hide();
            $('.eject-outer').fadeOut()
        });
        $(".close_get").click(function() {
            $('.fui-mask').fadeOut();
            $('#layer').fadeOut()
        });
        var url = core.getUrl('sale/sendticket/share/getStatus', {}, false);
        $('.pop2').click(function() {
            $.ajax({
                url: url,
                data: {
                    'money': $(".text-danger").html().substr(1),
                    'orderid': orderid
                },
                type: 'get',
                contentType: 'application/json',
                success: function(result) {
                    var obj = JSON.parse(result);
                    if (obj.status == 'success') {
                        FoxUI.mask.hide();
                        $('#layer').fadeOut();
                        var skipurl = core.getUrl('sale/sendticket/share/unclaimed', {
                            sid: obj.did,
                            orderid: obj.orderid
                        }, true);
                        window.location.href = skipurl
                    } else if (obj.status == 'error') {
                        alert(obj.msg)
                    }
                },
            })
        })
    };
    return modal
});