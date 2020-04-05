define(['core', 'tpl'], function(core, tpl) {
    var modal = {
        cityexpress: false
    };
    modal.init = function(params) {
        modal.cityexpress = params.cityexpress;
        FoxUI.loader.show('mini');
        if (modal.cityexpress.lng == null || modal.cityexpress.lat == null || modal.cityexpress.lng == "" || modal.cityexpress.lat == "") {
            modal.cityexpress.lng = 0;
            modal.cityexpress.lat = 0
        }
        if (modal.cityexpress.name == "") {
            modal.cityexpress.name = "未填写"
        }
        if (modal.cityexpress.address == "") {
            modal.cityexpress.address = "未填写"
        }
        var height = $(document.body).height() - $('.fui-header').height() - $('.fui-footer .fui-list:first-child').height() - 20;
        $('#js-map').height(height + 'px');
        var map = new AMap.Map("js-map", {
            resizeEnable: true,
            center: [modal.cityexpress.lng, modal.cityexpress.lat],
            zoom: 15
        });
        marker = new AMap.Marker({
            icon: "http://webapi.amap.com/theme/v1.3/markers/n/mark_b.png",
            position: [modal.cityexpress.lng, modal.cityexpress.lat]
        });
        marker.setMap(map);
        AMap.event.addListener(marker, 'click', function() {
            infoWindow.open(map, marker.getPosition())
        });
        var info = '<div class="info"><div class="info-top" style="cursor: pointer"><img src="https://webapi.amap.com/images/close2.gif"></div><div class="info-middle" style="background-color: white;"><div class="info-title"> ' + modal.cityexpress.name + '</div><div class="info-window"><div class="address">' + modal.cityexpress.address + '</div><div class="navi" ><a class="tag">到这里去</a><div class="js-navi-to navi-to" style="cursor: pointer"></div></div></div></div><div class="info-bottom" style="position: relative; top: 0px; margin: 0px auto;"><img src="https://webapi.amap.com/images/sharp.png"></div></div>';
        var infoWindow = new AMap.InfoWindow({
            isCustom: true,
            content: info,
            offset: new AMap.Pixel(16, -50)
        });
        AMap.event.addListener(infoWindow, 'open', function() {
            $(document).on('click', '.info-top', function() {
                map.clearInfoWindow()
            });
            $(document).on('click', '.js-navi-to', function() {
                window.location.href = 'http://uri.amap.com/navigation?to=' + modal.cityexpress.lng + ',' + modal.cityexpress.lat + ',' + modal.cityexpress.name + '&midwaypoint&mode=car&policy=1&src=mypage&coordinate=gaode&callnative=0'
            })
        });
        infoWindow.open(map, map.getCenter());
        var lnglat = '';
        if (modal.cityexpress.lng != "" && modal.cityexpress.lat != "") {
            lnglat = [modal.cityexpress.lng, modal.cityexpress.lat]
        }
        var editor = {};
        editor._circle = (function() {
            var circle = new AMap.Circle({
                center: lnglat,
                radius: modal.cityexpress.range,
                strokeColor: "#4e73f1",
                strokeOpacity: 1,
                strokeWeight: 3,
                fillColor: "#4e73f1",
                fillOpacity: 0.35,
            });
            circle.setMap(map);
            return circle
        })();
        map.setFitView();
        editor._circleEditor = new AMap.CircleEditor(map, editor._circle);
        $('.fui-footer').css('visibility', 'visible');
        FoxUI.loader.hide()
    };
    return modal
});