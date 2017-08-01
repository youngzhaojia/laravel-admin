var Bask = {};

Bask.Const = {};
Bask.Const.ERR_OK = 0;
Bask.Const.ERR_GENERAL = 1;

Bask.MessageHtml = '<div class="alert alert-$type" style="margin-top: 10px;">' +
    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
    '<span aria-hidden="true">&times;</span></button>$msg</div>';

Bask.msg = function (resp, selector) {
    var type = resp.code;
    if (type == Bask.Const.ERR_OK) {
        type = 'success';
    } else {
        type = 'danger';
    }
    var msg = typeof resp.message == 'undefined' ? '' : resp.message;
    if (resp.errors.length != 0) {
        msg = '<ul>';
        for (var i in resp.errors) {
            msg += '<li>';
            msg += resp.errors[i];
            msg += '</li>';
        }
        msg += '</ul>';
    }
    var html = this.MessageHtml.replace('$type', type).replace('$msg', msg);
    selector = (typeof selector) == 'undefined' ? '#msg' : selector;
    $(selector).html(html);
};

Bask.successMsg = function (msg, selector) {
    var resp = {
        code: 0,
        message: msg,
        errors: []
    };
    Bask.msg(resp, selector);
};

Bask.errorMsg = function (msg, selector) {
    var resp = {
        code: 1,
        message: msg,
        errors: []
    };
    Bask.msg(resp, selector);
};

Bask.confirm = function (callback, options) {
    options = $.extend({
        text: "确定删除？删除后将无法恢复！",
        confirmButton: '确定',
        cancelButton: '取消'
    }, options || {});
    options.confirm = callback;
    $.confirm(options);
};

Bask.MessageBox = {};
Bask.MessageBox.echo = function (json, $handler) {
    var type = json.code;
    switch (type) {
        case 0:
            type = 'success';
            break;
        case 1:
            type = 'danger';
            break;
        default:
            type = 'danger';
    }
    var msg = typeof json.message == 'undefined' ? '' : json.message;
    if (json.errors.length != 0) {
        msg = '<ul>';
        for (var i in json.errors) {
            msg += '<li>';
            msg += json.errors[i];
            msg += '</li>';
        }
        msg += '</ul>';
    }
    var tmpl = '<div class="alert alert-$type">' +
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
        '<span aria-hidden="true">&times;</span></button>$msg</div>';
    var html = tmpl.replace('$type', type).replace('$msg', msg);
    if ($handler == undefined) $handler = $('#msg');
    $handler.html(html);
};

Bask.List = {};
Bask.List.loadFirstPage = function ($paginator, options) {
    options.pg.page = 1;
    Bask.List.load($paginator, options);
};
Bask.List.load = function ($paginator, options) {
    var defaultOptions = {
        "pg": {},
        "url": null,
        "ajaxForm": null,
        "dataType": "json",
        "method": "POST",
        "data": {},
        "tplId": 'tpl-list',
        "targetId": 'list',
        "loading_placeholder_html": null,
        extCall: function () {
        }
    };
    options = $.extend(defaultOptions, options);
    if (options.loading_placeholder_html != undefined) $('#' + options.targetId).html(options.loading_placeholder_html);
    function loadedCallback(resp) {
        if (resp.code != Bask.Const.ERR_OK) {
            Bask.MessageBox.echo(resp);
        } else {
            console.info(resp);
            options.pg = resp.data.pg;
            var content = template(options.tplId, resp.data);
            $('#' + options.targetId).html(content);

            pagination($paginator, options);
            options.extCall();
        }
    }

    function pagination($paginator, options) {
        function renderPageBar($paginator, pg) {
            $paginator.children('ul').addClass('pull-right');
            $paginator.append('<ul id="page-info-bar">共 ' + pg.page_count + ' 页/每页 ' + pg.page_size + ' 条/共 ' + pg.item_count + ' 条</ul>');
        }

        $paginator.pagination({
            items: options.pg.item_count,
            itemsOnPage: options.pg.page_size,
            currentPage: options.pg.page,
            hrefTextPrefix: '#page/',
            prevText: '上一页',
            nextText: '下一页',
            onInit: function () {
                renderPageBar($paginator, options.pg);
            },
            onPageClick: function (p, e) {
                options.pg.page = p;
                Bask.List.load($paginator, options);
            }
        });
    };

    // form 方式请求
    if (options.ajaxForm != null) {
        options.ajaxForm.find('.page').val(options.pg.page);
        options.ajaxForm.find('.page-size').val(options.pg.page_size);

        options.ajaxForm.ajaxSubmit({
            dataType: 'json',
            success: function (resp) {
                loadedCallback(resp);
            },
            error: function (resp) {
            }
        });

    } else if (options.url != null) {
        $.ajax({
            url: options.url,
            dataType: options.dataType,
            method: options.method,
            data: options.data,
            success: function (resp) {
                loadedCallback(resp);
            },
            error: function (resp) {
            }
        });
    }
};

/**
 * jQuery Pro
 */

jQuery.extend({
    redirect: function (url, time) {
        if (time == undefined) {
            window.location.href = url;
        } else {
            setTimeout(function () {
                window.location.href = url;
            }, time);
        }
    },
    reload: function (time) {
        if (time == undefined) {
            time = 800;
        }
        setTimeout(function () {
            window.location.reload();
        }, time);
    }
});