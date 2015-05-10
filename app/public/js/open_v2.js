window.V = window.V || {};
V.util = V.util || {};
if (window.QZFL && QZFL.config && QZFL.config.FSHelperPage) {
    if (/\.pengyou\.com$/.test(location.hostname)) {
        QZFL.config.FSHelperPage = QZFL.config.FSHelperPage.replace(/^http\:\/\/(?:[^\.]+\.)?qzs\.qq\.com/, 'http://qzs.pengyou.com');
    } else if (/\.qq\.com$/.test(location.hostname)) {
        QZFL.config.FSHelperPage = QZFL.config.FSHelperPage.replace(/^http\:\/\/qzs\.qq\.com/, 'http://' + (function() {
            var _isp = QZFL.cookie.get('ptisp');
            if (({
                ctc: 1,
                cnc: 1,
                edu: 1,
                cm: 1,
                cn: 1,
                os: 1
            })[_isp]) {
                return _isp + '.';
            }
            return '';
        })() + 'qzs.qq.com');
    }
}
V.util.combine = function() {
    var objs = Array.prototype.slice.call(arguments, 0);
    var res = {};
    for (var i = 0, obj; obj = objs[i]; i++) {
        for (var k in obj) {
            res[k] = obj[k];
        }
    }
    return res;
};
V.util.clickStat = function(tag, domain, path) {
    if (!tag) {
        return;
    }
    domain = domain || window.location.hostname;
    path = path || window.location.pathname;
    var url = ['http://pinghot.qq.com/pingd?dm=', domain, '.hot&url=', path, '&hottag=', tag, '&hotx=9999&hoty=9999&sds=', Math.random()].join('');
    QZFL.pingSender(url);
};
V.util.getUin = function() {
    var uin = QZFL.cookie.get('uin');
    if (!uin) {
        return 0;
    }
    uin = /^o(\d+)$/.exec(uin);
    if (uin && (uin = new Number(uin[1]) + 0) > 10000) {
        return uin;
    }
    return 0;
};
V.util.appendUrlParam = function(url, param, forHash) {
    if (!url) {
        return '';
    }
    if (!param) {
        return url;
    }
    var p = [];
    for (var k in param) {
        p.push(encodeURIComponent(k) + '=' + encodeURIComponent(param[k]));
    }
    p = p.join('&');
    var hash = url.split('#');
    url = hash[0].split('?');
    hash = hash[1] ? ('#' + hash[1]) : '';
    param = url[1] ? ('?' + url[1]) : '';
    url = url[0];
    var v = forHash ? hash: param;
    v = v ? v.lastIndexOf('&') == v.length - 1 ? (v + p) : (v + '&' + p) : ('?' + p);
    if (forHash) {
        hash = v;
    } else {
        param = v;
    }
    return url + param + hash;
};
V.util.getToken = function() {
    var str = QZFL.cookie.get('skey') || '';
    var hash = 5381;
    for (var i = 0, len = str.length; i < len; ++i) {
        hash += (hash << 5) + str.charCodeAt(i);
    }
    return hash & 0x7fffffff;
};
V.util.loadJson = function(opt) {
    opt = V.util.combine({
        timeout: 5000,
        charset: 'utf-8',
        cbFn: '_Callback',
        valueStatKey: 'ret',
        getRetCodeValueStat: V.util._getRetCodeValueStat,
        successReportRate: 1,
        errorReportRate: 1
    },
    opt);
    if (!opt.url) {
        return;
    }
    opt.param = V.util.combine(QZFL.pluginsDefine && QZFL.pluginsDefine.getACSRFToken ? {
        uin: V.util.getUin()
    }: {
        uin: V.util.getUin(),
        g_tk: V.util.getToken()
    },
    opt.param);
    opt.random && (opt.param._r = Math.random());
    var startTime;
    var j = new QZFL.JSONGetter(opt.url, '_vasJsonInstance_' + (QZFL.JSONGetter.counter + 1), opt.param, opt.charset);
    if (opt.valueStatId) {
        j.onSuccess = function(ret) {
            var duration = new Date() - startTime;
            var valueStat = opt.getRetCodeValueStat(ret[opt.valueStatKey]);
            if (valueStat) {
                TCISD.valueStat(opt.valueStatId, valueStat[0], valueStat[1] + '', {
                    duration: duration,
                    reportRate: opt.successReportRate
                });
            }
            opt.onSuccess && opt.onSuccess(ret);
        };
        j.onError = function() {
            var duration = new Date() - startTime;
            TCISD.valueStat(opt.valueStatId, 2, '1', {
                duration: duration,
                reportRate: opt.errorReportRate
            });
            opt.onError && opt.onError();
        };
        j.onTimeout = function() {
            opt.onTimeout ? opt.onTimeout() : opt.onError && opt.onError();
        };
    } else {
        j.onSuccess = opt.onSuccess || QZFL.emptyFn;
        j.onError = opt.onError || QZFL.emptyFn;
        j.onTimeout = opt.onTimeout || opt.onError || QZFL.emptyFn;
    }
    j.timeout = opt.timeout;
    if (opt.valueStatId) {
        startTime = new Date();
    }
    j.send(opt.cbFn);
};
V.util.postForm = function(opt) {
    opt = V.util.combine({
        charset: 'utf-8',
        valueStatKey: 'ret',
        getRetCodeValueStat: V.util._getRetCodeValueStat,
        successReportRate: 1,
        errorReportRate: 1
    },
    opt);
    if (!opt.url) {
        return;
    }
    opt.query = V.util.combine(QZFL.pluginsDefine && QZFL.pluginsDefine.getACSRFToken ? {
        uin: V.util.getUin()
    }: {
        uin: V.util.getUin(),
        g_tk: V.util.getToken()
    },
    opt.query);
    opt.param = V.util.combine({
        uin: V.util.getUin(),
        g_tk: V.util.getToken()
    },
    opt.param);
    var url = V.util.appendUrlParam(opt.url, opt.query);
    var startTime;
    var f = new QZFL.FormSender(url, 'POST', opt.param, opt.charset);
    if (opt.valueStatId) {
        f.onSuccess = function(ret) {
            var duration = new Date() - startTime;
            var valueStat = opt.getRetCodeValueStat(ret[opt.valueStatKey]);
            if (valueStat) {
                TCISD.valueStat(opt.valueStatId, valueStat[0], valueStat[1] + '', {
                    duration: duration,
                    reportRate: opt.successReportRate
                });
            }
            opt.onSuccess && opt.onSuccess(ret);
        };
        f.onError = function() {
            var duration = new Date() - startTime;
            TCISD.valueStat(opt.valueStatId, 2, '1', {
                duration: duration,
                reportRate: opt.errorReportRate
            });
            opt.onError && opt.onError();
        };
    } else {
        f.onSuccess = opt.onSuccess || QZFL.emptyFn;
        f.onError = opt.onError || QZFL.emptyFn;
    }
    if (opt.valueStatId) {
        startTime = new Date();
    }
    f.send();
};
V.util.xhr = function(opt) {
    opt = V.util.combine({
        method: 'POST',
        param: {},
        sync: 0,
        noCache: 0,
        charset: 'utf-8',
        valueStatKey: 'ret',
        getRetCodeValueStat: V.util._getRetCodeValueStat,
        successReportRate: 1,
        errorReportRate: 1
    },
    opt);
    if (!opt.url) {
        return;
    }
    opt.query = V.util.combine({
        uin: V.util.getUin(),
        g_tk: V.util.getToken()
    },
    opt.query);
    opt.param = V.util.combine({
        uin: V.util.getUin(),
        g_tk: V.util.getToken()
    },
    opt.param);
    var url = V.util.appendUrlParam(opt.url, opt.query);
    var startTime;
    var xhr = new QZFL.XHR(url, '_vasXhrInstance_' + (QZFL.XHR.counter + 1), opt.method, opt.param, !opt.sync, opt.noCache);
    xhr.charset = opt.charset;
    xhr.onError = opt.valueStatId ? (function() {
        var duration = new Date() - startTime;
        TCISD.valueStat(opt.valueStatId, 2, '1', {
            duration: duration,
            reportRate: opt.errorReportRate
        });
        opt.onError && opt.onError();
    }) : (opt.onError || QZFL.emptyFn);
    xhr.onSuccess = opt.onSuccess ? (function(ret) {
        if (ret.text) {
            try {
                ret = (window.JSON && JSON.parse) ? JSON.parse(ret.text) : eval("(" + ret.text + ")");
            } catch(_) {
                xhr.onError();
            }
            if (opt.valueStatId) {
                var duration = new Date() - startTime;
                var valueStat = opt.getRetCodeValueStat(ret[opt.valueStatKey]);
                if (valueStat) {
                    TCISD.valueStat(opt.valueStatId, valueStat[0], valueStat[1] + '', {
                        duration: duration,
                        reportRate: opt.successReportRate
                    });
                }
            }
            opt.onSuccess(ret);
        } else {
            opt.onSuccess({});
        }
    }) : QZFL.emptyFn;
    if (opt.valueStatId) {
        startTime = new Date();
    }
    xhr.send();
};
V.util._getRetCodeValueStat = function(ret) {
    return ret == 0 ? [1, 0] : [2, ret];
};
V.util.tmpl = function(str, param) {
    if (!str) {
        return '';
    }
    param = param || {};
    var obj = QZFL.dom.get(str);
    obj && (str = obj.innerHTML);
    var fn = ['var __=[];'];
    var re = /([\s\S]*?)(?:(?:<%([^=][\s\S]*?)%>)|(?:<%=([\s\S]+?)%>)|$)/g;
    re.lastIndex = 0;
    var m = re.exec(str || '');
    while (m && (m[1] || m[2] || m[3])) {
        m[1] && fn.push('__.push(\'', QZFL.string.escString(m[1]), '\');');
        m[2] && fn.push(m[2]);
        m[3] && fn.push('__.push(', m[3], ');');
        m = re.exec(str);
    }
    fn.push('return __.join(\'\');');
    var args = [],
    argv = [];
    for (var key in param) {
        args.push(key);
        argv.push(param[key]);
    }
    fn = new Function(args.join(','), fn.join(''));
    return fn.apply(null, argv);
};
V.util.performanceTimeStat = function(flag1, flag2, flag3, delay) {
    setTimeout(function() {
        var performance = window.performance || window.webkitPerformance || window.msPerformance;
        if (!performance || !window.TCISD) {
            return;
        }
        var list = [performance.timing.navigationStart, performance.timing.unloadEventStart, performance.timing.unloadEventEnd, performance.timing.redirectStart, performance.timing.redirectEnd, performance.timing.fetchStart, performance.timing.domainLookupStart, performance.timing.domainLookupEnd, performance.timing.connectStart, performance.timing.connectEnd, performance.timing.requestStart, performance.timing.responseStart, performance.timing.responseEnd, performance.timing.domLoading, performance.timing.domInteractive, performance.timing.domContentLoadedEventStart, performance.timing.domContentLoadedEventEnd, performance.timing.domComplete, performance.timing.loadEventStart, performance.timing.loadEventEnd];
        var o = new TCISD.TimeStat(null, [flag1, flag2, flag3].join('_')),
        length = list.length;
        o.zero = new Date(list[0]);
        for (var i = 1; i < length; i++) {
            o.mark(i, new Date(list[i] || list[0]));
        }
        o.report();
    },
    delay || 0);
};
V.util.timeStat = function(flag1, flag2, flag3, timeStamps, delay) {
    setTimeout(function() {
        var o = new TCISD.TimeStat(null, [flag1, flag2, flag3].join('_'));
        o.zero = timeStamps[0];
        o.timeStamps = timeStamps;
        o.report();
    },
    delay || 0);
};
V.util.getUrlParam = function(name) {
    var re = new RegExp('(?:\\?|#|&)' + name + '=([^&]*)(?:$|&|#)', 'i');
    var m = re.exec(window.location.href);
    return m ? m[1] : '';
};
V.util.formatDate = function formatDate(time, fmt, forEng) {
    time = new Date(time);
    var ss = function(s, n, m, o) {
        s = (s + '').split('');
        m && (n = Math.min(n, m));
        o = o || 0;
        var l = s.length;
        if (o & 1) {
            for (var i = l; i < n; i++) { (o & 4) ? s.push(0) : s.unshift(0);
            }
        }
        if (n < l && (o & 2)) {
            if (o & 4) {
                s = s.slice(0, n);
            } else {
                s = s.slice(l - n, l);
            }
        }
        s = s.join(''); (o & 8) && (s = s.replace(/^0*(.+?)0*$/, '$1'));
        return s;
    };
    return fmt.replace(/(y|M|d|h|H|m|s|f|F|t)+/g, 
    function(match) {
        var c = match.charAt(0),
        l = match.length;
        switch (c) {
        case 'y':
            return ss(time.getFullYear(), l, 4, 2);
        case 'M':
            if (l <= 2) {
                return ss(time.getMonth() + 1, l, 2, 1);
            }
            return (forEng ? (l == 3 ? ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'] : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']) : ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'])[time.getMonth()];
        case 'd':
            if (l <= 2) {
                return ss(time.getDate(), l, 2, 1);
            }
            return (forEng ? (l == 3 ? ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] : ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thurday ', 'Friday', 'Saturday']) : ['星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六'])[time.getDay()];
        case 'h':
            return ss((time.getHours() % 12) || 12, l, 2, 1);
        case 'H':
            return ss(time.getHours(), l, 2, 1);
        case 'm':
            return ss(time.getMinutes(), l, 2, 1);
        case 's':
            return ss(time.getSeconds(), l, 2, 1);
        case 'f':
            return ss(time.getMilliseconds(), l, 0, 7);
        case 'F':
            return ss(time.getMilliseconds(), l, 0, 14);
        case 't':
            return ss(time.getHours() >= 12 ? (forEng ? 'PM': '下午') : (forEng ? 'AM': '上午'), l, 2, 6);
        default:
            return match;
        }
    });
};
V.util.toStr = function(obj) {
    return Object.prototype.toString.call(obj);
};
V.util.getPortrait = function(uins, cb, cbErr) {
    uins += '';
    V.util.loadJson({
        url: 'http://r.qzone.qq.com/fcg-bin/cgi_get_score.fcg',
        param: {
            mask: 4,
            uins: V.util.toStr(uins) == '[object Array]' ? uins.join(',') : uins
        },
        onSuccess: function(ret) {
            var _uins = V.util.toStr(uins) == '[object Array]' ? uins: uins.split(',');
            var _args = {};
            for (var i = 0, one; one = _uins[i]; i++) {
                _args[one] = (ret[one] && ret[one][6]) || one;
            }
            cb(_args);
        },
        onError: cbErr,
        cbFn: 'portraitCallBack',
        charset: 'gbk'
    });
};
window.V = window.V || {};
V.widget = V.widget || {};
V.widget.placeHolder = {
    bind: function(ipt, val, force) {
        if (ipt && typeof ipt === 'object' && ipt.tagName && ((ipt.tagName.toLowerCase() === 'input' && (!ipt.type || ipt.type.toLowerCase() === 'text')) || ipt.tagName.toLowerCase() === 'textarea')) {
            var _self = V.widget.placeHolder;
            val = val || ipt.getAttribute('_val');
            if (!val) {
                return;
            }
            if (('placeholder' in ipt) && !force) {
                ipt.placeholder = val;
                ipt.style.color = '#000';
                return;
            }
            if (val) {
                ipt._val = val;
                if (ipt.value) {
                    ipt._holder = 0;
                } else {
                    ipt._holder = 1;
                    ipt.value = ipt._val;
                    ipt.style.color = '#999';
                }
                _self._on(ipt, 'focus', 
                function() {
                    if (ipt._holder) {
                        ipt._holder = 0;
                        ipt.value = '';
                        ipt.style.color = '#000';
                    }
                });
                _self._on(ipt, 'blur', 
                function() {
                    if (!ipt._holder && !ipt.value) {
                        ipt._holder = 1;
                        ipt.value = ipt._val;
                        ipt.style.color = '#999';
                    }
                });
            }
        }
    },
    get: function(ipt) {
        if (!ipt._holder) {
            return ipt.value;
        }
        return '';
    },
    set: function(ipt, content) {
        ipt.value = content || '';
        V.widget.placeHolder.show(ipt);
    },
    update: function(ipt) {
        if (ipt._holder) {
            ipt.value = '';
        }
    },
    show: function(ipt) {
        if (!ipt.value && ipt._val) {
            ipt._holder = 1;
            ipt.value = ipt._val;
            ipt.style.color = '#999';
        } else {
            ipt._holder = 0;
            ipt.style.color = '#000';
        }
    },
    _on: function(el, evt, fn) {
        var cfn = function(e) {
            return fn.call(el, window.event || e);
        };
        if (el.addEventListener) {
            el.addEventListener(evt, cfn, false);
        } else if (el.attachEvent) {
            el.attachEvent('on' + evt, cfn);
        } else {
            el['on' + evt] = cfn;
        }
    }
};
V.dialog = V.dialog || (function() {
    function show(title, content, width, height, opt) {
        opt = opt || {};
        var useTween = opt.useTween,
        noBorder = opt.noBorder,
        callback = opt.callback;
        var _dialog = QZFL.dialog.create(title, content, width, height, useTween, noBorder);
        var _maskID = QZFL.maskLayout.create();
        _dialog.onUnload = function() {
            if (typeof callback == 'function') {
                callback();
            }
            QZFL.maskLayout.remove(_maskID);
        };
        return _dialog;
    };
    return {
        show: show
    };
})();
V.login = V.login || (function() {
    var _RET_HASH = {
        'SUCCESS': 0,
        'FAIL': 1,
        'CANCEL': 2
    };
    var _dialog = null;
    var _targetWindow = null;
    var _sUrl = '';
    var _appCallback = null;
    function _callback(ret) {
        if (_appCallback) {
            _appCallback(ret);
            if (ret === _RET_HASH['SUCCESS']) {
                _appCallback = null;
                hide();
            }
        } else {
            if (ret === _RET_HASH['SUCCESS']) {
                if ("function" == typeof window.__logCallBackFn) {
                    window.__logCallBackFn();
                } else {
                    _targetWindow.location.href = "http://open.qq.com/rlogin";
                }
            } else if (ret === _RET_HASH['FAIL']) {
                hide();
                alert('登录失败');
            }
        }
    };
    function _dialogCallback() {
        if (_appCallback) {
            _appCallback(_RET_HASH['CANCEL']);
        }
    };
    function show(opt) {
        opt = opt || {};
        var _html = '<iframe scrolling="no" style="width: 370px; height: 278px;" frameborder="0" allowtransparency="yes" src="http://qzs.qq.com/qzone/vas/login/jump.html"></iframe>';
        _targetWindow = opt.targetWindow || window;
        _sUrl = opt.sUrl || location.href;
        _appCallback = typeof opt.callback == 'function' ? opt.callback: null;
        _dialog = V.dialog.show('登录', _html, 372, 280, {
            callback: QZFL.event.bind(this, _dialogCallback)
        });
    };
    function hide() {
        _dialog.unload();
    };
    function exit(target) {
        QZFL.object.each(['zzpaneluin', 'zzpanelkey'], 
        function(value) {
            QZFL.cookie.set(value, '');
        });
        QZFL.imports('http://imgcache.qq.com/ptlogin/ac/v9/js/ptloginout.js', 
        function() {
            window.pt_logout && pt_logout.logout(function(ret) {
                target ? window.location.href = target: window.location.reload();
            });
        });
    };
    function resize(w, h) {
        if (_dialog) {
            _dialog.setSize(w, h);
        }
    };
    function getUin() {
        var uin = QZFL.cookie.get('uin') || QZFL.cookie.get('zzpaneluin');
        if (uin.length > 4) {
            return + uin.replace(/o(\d+)/g, '$1');
        }
        return 0;
    };
    function getUinsInfo(uins, callback) {
        var _url = 'http://r.qzone.qq.com/fcg-bin/cgi_get_score.fcg?mask=4&uins=';
        var g = new QZFL.JSONGetter(_url + uins.join(','), Math.random().toString(), null);
        g.onSuccess = function(o) {
            callback(o);
        };
        g.onError = function() {
            return;
        };
        g.send('portraitCallBack');
    };
    function call(opt) {
        var callback;
        opt = opt || {};
        if (getUin()) {
            opt.callback && opt.callback();
            return;
        }
        if (opt.callback) {
            callback = opt.callback;
            opt.callback = function(ret) {
                if (ret == _RET_HASH['SUCCESS']) {
                    callback();
                    opt.onLoginSuccess && opt.onLoginSuccess();
                } else if (ret == _RET_HASH['CANCEL']) {
                    opt.onLoginCancel && opt.onLoginCancel();
                } else {
                    opt.onLoginFail && opt.onLoginFail();
                }
            };
        }
        show(opt);
    };
    return {
        _callback: _callback,
        RET_HASH: _RET_HASH,
        show: show,
        hide: hide,
        exit: exit,
        resize: resize,
        getUin: getUin,
        getUinsInfo: getUinsInfo,
        call: call
    };
})(); (function initPortrait() {
    var uin = V.util.getUin(),
    nick = null,
    loginInfo = QZFL.dom.get("loginInfo");
    if (uin >= 1000 && loginInfo) {
        V.util.getPortrait(uin, 
        function(args) {
            nick = args[uin];
            loginInfo.innerHTML = '欢迎你，<a id="lnk_nick" href="http://open.qq.com/reg" target="_blank" class="hit" title="' + QZFL.string.escHTML(QZFL.string.trim(nick) ? nick: uin) + '">' + QZFL.string.cut(QZFL.string.escHTML(QZFL.string.trim(nick) ? nick: uin), 10, '...') + '</a>' + '<a href="javascript:void(0);" class="hit" onclick="V.login.exit();return false">退出</a>|<a href="http://op.open.qq.com/">管理中心</a>';
        });
    } else if (loginInfo) {
        loginInfo.innerHTML = '<a href="javascript:void(0);" onclick="V.login.show();return false">登录</a>';
    }
    QZFL.event.on(QZFL.dom.get('j_support'), 'mouseover', 
    function() {
        QZFL.dom.get('j_support_layer').style.display = "";
    });
    $e('#j_support_layer').onHover(function() {
        QZFL.dom.get('j_support_layer').style.display = "";
    },
    function() {
        QZFL.dom.get('j_support_layer').style.display = "none";
    });
    V.widget.placeHolder.bind(QZFL.dom.get('ipt_search'));
    QZFL.event.on(QZFL.dom.get('frm_search'), 'submit', 
    function(e) {
        _doSubmit();
        QZFL.event.preventDefault(e);
    });
    QZFL.event.on(QZFL.dom.get('btn_search'), 'click', 
    function(e) {
        _doSubmit();
        QZFL.event.preventDefault(e);
    });
    function _doSubmit() {
        var key = encodeURIComponent(QZFL.string.trim($('ipt_search').value));
        if (key) {
            window.open("http://open.qq.com/search?is_search=1&key=" + key, "_blank");
        }
    }
})();
OPEN_TIPS = {
    show: function(opts, win) {
        var win = win || window,
        _doc = win.document,
        t = _doc.getElementById('tips_layer'),
        _this = this;
        win._tip_timer && clearTimeout(win._tip_timer);
        if (!t) {
            var el = _doc.createElement('div');
            el.className = "gb_layer_box";
            el.id = "tips_layer";
            el.style.position = "absolute";
            el.style.left = "0px";
            el.style.top = "0px";
            el.innerHTML = ['<div class="gb_layer_box_inner"><div class="gb_layer_box_cont"><div class="gb_layer_box_hd"><strong id="j_tip_title"></strong></div><div class="gb_layer_box_bd">', '<div id="j_tip_content"></div></div></div><b class="ico arrow_top"></b></div>'].join('');
            el.onmouseout = function() {
                _this.hide(win);
            }
            el.onmouseover = function() {
                win._tip_timer && clearTimeout(win._tip_timer);
            }
            _doc.body.appendChild(el);
            t = _doc.getElementById('tips_layer');
        }
        _doc.getElementById('j_tip_title').innerHTML = opts.title ? opts.title: '';
        if ("string" == typeof opts.title && opts.title.length > 0) {
            _doc.getElementById('j_tip_title').parentNode.style.display = "";
        } else {
            _doc.getElementById('j_tip_title').parentNode.style.display = "none";
        }
        _doc.getElementById('j_tip_content').innerHTML = opts.content;
        if ("number" == typeof opts.arrow) {
            t.getElementsByTagName('b')[0].style.cssText = "left:" + opts.arrow + "px;";
        } else {
            t.getElementsByTagName('b')[0].style.cssText = "";
        }
        t.style.left = opts.left + 'px';
        t.style.top = opts.top + 'px';
        t.style.width = opts.width + 'px';
        t.style.height = opts.height ? opts.height + 'px': "auto";
        t.style.zIndex = opts.zIndex || 1000;
        t.style.display = "";
    },
    hide: function(win) {
        var win = win || window,
        _doc = win.document;
        if (!_doc.getElementById('tips_layer')) return;
        win._tip_timer = setTimeout(function() {
            _doc.getElementById('tips_layer').style.display = "none";
        },
        150);
    },
    bind: function() {
        var _this = this;
        $e('[_open_tip]').each(function() {
            this.onmouseover = function() {
                var w = this.offsetWidth,
                h = this.offsetHeight,
                attr = this.getAttribute("_open_tip").split("|");
                if (attr.length == 1) {
                    return;
                }
                _this.show({
                    left: this.getBoundingClientRect().left + QZFL.dom.getScrollLeft() - 18,
                    top: this.getBoundingClientRect().top + QZFL.dom.getScrollTop() + h + 12,
                    width: attr[0],
                    height: attr[1],
                    content: attr[2].replace(/#lt#/g, "<").replace(/#gt#/g, ">").replace(/#quot#/g, '"'),
                    title: attr[3] || null
                });
            };
            this.onmouseout = function() {
                _this.hide();
            }
        });
    }
}
OPEN_TIPS.bind();
