define([], function() {
    var model = {};
    model.type = 0;
    model.tpl = {
        entity: false,
        company: false,
        title: false,
        number: false
    };
    model.open = function(invoice_info, callback, type) {
        model.type = type || 0;
        model.render(invoice_info, callback)
    };
    model.default = function(invoice_info) {
        (invoice_info === undefined) && (invoice_info = model.tpl);
        (invoice_info.entity === undefined) && (invoice_info.entity = model.tpl.entity);
        (invoice_info.company === undefined) && (invoice_info.company = model.tpl.company);
        (invoice_info.title === undefined) && (invoice_info.title = model.tpl.title);
        (invoice_info.number === undefined) && (invoice_info.number = model.tpl.number);
        return invoice_info
    };
    model.render = function(invoice_info, callback) {
        invoice_info = model.default(invoice_info);
        var html = '<div class="invoice-picker"' + 'style="bottom: 0;position: absolute;padding-top: 20px;color: #333;width: 100%;background: #fff;font-family: \'微软雅黑\', \'Microsoft Yahei\';height: 410px"><style>.invoice-picker div{margin-left: 4%;line-height: 2.4rem;width: 92%;}.invoice-picker div:not(.title){border-bottom: 1px solid #efefef;} .invoice-picker .title{line-height: 1rem;margin-top: 10px}.invoice-picker label.active{background: #ff5555;color: #fff;border: 1px solid #ff5555;}</style>' + '<div class="title">发票材质</div>' + '<div style="padding-bottom: 10px">' + '<label style="display:inline-block;line-height: 30px;border-radius: 20px;border: #e3e3e3 1px solid;width: 100px;text-align: center;margin-right: 10px" id="entity0">' + '<input type="radio" name="invoice_entity" value="0" style="display: none">电子发票</label>' + '<label style="display:inline-block;line-height: 30px;border-radius: 20px;border: #e3e3e3 1px solid;width: 100px;text-align: center;margin-right: 10px" id="entity1">' + '<input type="radio" name="invoice_entity" value="1" style="display: none">纸质发票</label>' + '</div>' + '<div class="title">发票类型</div>' + '<div style="padding-bottom: 10px">' + '<label style="display:inline-block;line-height: 30px;border-radius: 20px;border: #e3e3e3 1px solid;width: 100px;text-align: center;margin-right: 10px"><input type="radio" name="invoice_company" value="0" style="display: none">个人</label>' + '<label style="display:inline-block;line-height: 30px;border-radius: 20px;border: #e3e3e3 1px solid;width: 100px;text-align: center;margin-right: 10px"><input type="radio" name="invoice_company" value="1" style="display: none">单位</label>' + '</div>' + '<div><span style="width: 30%">发票抬头</span>' + '<input type="text" style="height: 1.8rem;border: 0;width: 65%;margin-left: 5%;font-size: 0.8rem; font-family: \'微软雅黑\';" name="invoice_title"></div>' + '<div id="invoice_number" style="display: none"><span style="width: 30%">纳税人识别号</span>' + '<input type="text" style="height: 1.8rem;border: 0;width: 65%;margin-left: 5%;font-size: 0.8rem; font-family: \'微软雅黑\';" name="invoice_number"></div>' + '<a href="javascript:;" class="btn btn-danger" ' + 'style="position: absolute;bottom: 20px;width: 94%;border-radius: 100px;" id="confirm-invoice">确定</a>' + '</div>';
        model.container = new FoxUIModal({
            content: html,
            extraClass: "picker-modal",
            maskClick: model.close
        });
        if (model.type == 2) {} else if (model.type == 1) {
            $('#entity1').hide()
        } else {
            $('#entity0').hide()
        }
        model.active(invoice_info, 1);
        model.listen(callback)
    };
    model.close = function() {
        $('.invoice-picker').fadeOut(100).remove();
        model.container.close();
        $('#invoice_number').hide();
        $('.fui-modal').remove()
    };
    model.active = function(that, name) {
        if (name === 1) {
            if (that.entity || model.type === 0) {
                $('input[name=invoice_entity][value="1"]').attr('checked', 'true').parent().addClass('active')
            } else {
                $('input[name=invoice_entity][value="0"]').attr('checked', 'true').parent().addClass('active')
            } if (that.company) {
                $('input[name=invoice_company][value="1"]').attr('checked', 'true').parent().addClass('active')
            } else {
                $('input[name=invoice_company][value="0"]').attr('checked', 'true').parent().addClass('active')
            } if (that.title) {
                $('input[name=invoice_title]').val(that.title)
            }
            if (that.number) {
                $('input[name=invoice_number]').val(that.number);
                $('#invoice_number').show()
            }
        } else {
            $('input[name=' + name + ']').parent().removeClass('active');
            that.parent().addClass('active');
            if (name === 'invoice_company' && that.val() === '1') {
                $('#invoice_number').show()
            } else if (name === 'invoice_company') {
                $('#invoice_number').hide()
            }
        }
    };
    model.listen = function(callback) {
        $(document).on('change', 'input[name=invoice_entity]', function() {
            var that = $(this);
            model.active(that, 'invoice_entity')
        });
        $(document).on('change', 'input[name=invoice_company]', function() {
            var that = $(this);
            model.active(that, 'invoice_company')
        });
        $(document).on('click', '#confirm-invoice', function() {
            var invoice_info = {};
            invoice_info.entity = $('input[name=invoice_entity]:checked').val() == '1' ? true : false;
            invoice_info.company = $('input[name=invoice_company]:checked').val() == '1' ? true : false;
            invoice_info.title = $('input[name=invoice_title]').val().trim() || false;
            invoice_info.number = $('input[name=invoice_number]').val().trim() || false;
            if (!invoice_info.company) {
                invoice_info.number = false
            }
            if (!invoice_info.title) {
                FoxUI.toast.show('请填写发票抬头');
                return
            }
            if (invoice_info.title.indexOf(' ') > 0 || invoice_info.number && invoice_info.number.indexOf(' ') > 0) {
                FoxUI.toast.show('发票信息不能包含空格');
                return
            }
            if (invoice_info.company && !invoice_info.number) {
                FoxUI.toast.show('请填写纳税人识别号');
                return
            }
            model.close();
            callback(invoice_info)
        });
        model.listen = function() {
            return false
        }
    };
    return model
});