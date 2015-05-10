window.QZFL = window.QZFL || {};
QZFL.pingSender = function(url, t, opts) {
	var _s = QZFL.pingSender, iid, img;
	if (!url) {
		return;
	}
	opts = opts || {};
	iid = "sndImg_" + _s._sndCount++;
	img = _s._sndPool[iid] = new Image();
	img.iid = iid;
	img.onload = img.onerror = img.ontimeout = (function(t) {
		return function(evt) {
			evt = evt || window.event || {
				type : 'timeout'
			};
			void (typeof (opts[evt.type]) == 'function' ? setTimeout((function(
					et, ti) {
				return function() {
					opts[et]({
						'type' : et,
						'duration' : ((new Date()).getTime() - ti)
					});
				};
			})(evt.type, t._s_), 0) : 0);
			QZFL.pingSender._clearFn(evt, t);
		};
	})(img);
	(typeof (opts.timeout) == 'function')
			&& setTimeout(function() {
				img.ontimeout && img.ontimeout({
					type : 'timeout'
				});
			}, (typeof (opts.timeoutValue) == 'number' ? Math.max(100,
					opts.timeoutValue) : 5000));
	void ((typeof (t) == 'number') ? setTimeout(function() {
		img._s_ = (new Date()).getTime();
		img.src = url;
	}, (t = Math.max(0, t))) : (img.src = url));
};
QZFL.pingSender._sndPool = {};
QZFL.pingSender._sndCount = 0;
QZFL.pingSender._clearFn = function(evt, ref) {
	var _s = QZFL.pingSender;
	if (ref) {
		_s._sndPool[ref.iid] = ref.onload = ref.onerror = ref.ontimeout = ref._s_ = null;
		delete _s._sndPool[ref.iid];
		_s._sndCount--;
		ref = null;
	}
};
if (typeof (window.TCISD) == "undefined") {
	window.TCISD = {};
}
TCISD.pv = function(sDomain, path, opts) {
	setTimeout(function() {
		TCISD.pv.send(sDomain, path, opts);
	}, 0);
};
(function() {
	var items = [], timer = null, unloadHandler, noDelay = false;
	var pvSender = {
		send : function(domain, url, rDomain, rUrl, flashVersion, timeout) {
			items.push({
				dm : domain,
				url : url,
				rdm : rDomain || "",
				rurl : rUrl || "",
				flashVersion : flashVersion
			});
			if (!timer) {
				timer = setTimeout(function() {
					pvSender.doSend(timeout);
				}, timeout);
			}
			if (!unloadHandler) {
				unloadHandler = pvSender.onUnload;
				if (window.attachEvent) {
					window.attachEvent("onbeforeunload", unloadHandler);
					window.attachEvent("onunload", unloadHandler);
				} else if (window.addEventListener) {
					window.addEventListener("beforeunload", unloadHandler,
							false);
					window.addEventListener("unload", unloadHandler, false);
				}
			}
		},
		onUnload : function() {
			noDelay = true;
			pvSender.doSend();
			setTimeout(function() {
			}, 1000);
		},
		doSend : function(timeout) {
			timer = null;
			if (items.length) {
				var url;
				for ( var i = 0; i < items.length; i++) {
					url = pvSender.getUrl(items.slice(0, items.length - i));
					if (url.length < 2000) {
						break;
					}
				}
				items = items.slice(Math.max(items.length - i, 1));
				QZFL.pingSender(url);
				if (i > 0) {
					noDelay ? pvSender.doSend() : (timer = setTimeout(
							pvSender.doSend,
							(typeof timeout == 'undefined' ? 5000 : timeout)));
				}
			}
		},
		getUrl : function(list) {
			var item = list[0];
			var data = {
				dm : escape(item.dm),
				url : escape(item.url),
				rdm : escape(item.rdm),
				rurl : escape(item.rurl),
				flash : item.flashVersion,
				pgv_pvid : pvSender.getId(),
				sds : Math.random()
			};
			var ext = [];
			for ( var i = 1; i < list.length; i++) {
				var p = list[i];
				ext.push([ escape(p.dm), escape(p.url), escape(p.rdm),
						escape(p.rurl) ].join(":"));
			}
			if (ext.length) {
				data.ex_dm = ext.join(";")
			}
			var param = [];
			for ( var p in data) {
				param.push(p + "=" + data[p]);
			}
			var url = [
					TCISD.pv.config.webServerInterfaceURL,
					"?cc=-&ct=-&java=1&lang=-&pf=-&scl=-&scr=-&tt=-&tz=-8&vs=3.3&",
					param.join("&") ].join("");
			return url;
		},
		getId : function() {
			var t, d, h, f;
			t = document.cookie.match(TCISD.pv._cookieP);
			if (t && t.length && t.length > 1) {
				d = t[1];
			} else {
				d = (Math.round(Math.random() * 2147483647) * (new Date()
						.getUTCMilliseconds())) % 10000000000;
				document.cookie = "pgv_pvid="
						+ d
						+ "; path=/; domain=qq.com; expires=Sun, 18 Jan 2038 00:00:00 GMT;";
			}
			h = document.cookie.match(TCISD.pv._cookieSSID);
			if (!h) {
				f = (Math.round(Math.random() * 2147483647) * (new Date()
						.getUTCMilliseconds())) % 10000000000;
				document.cookie = "pgv_info=ssid=s" + f
						+ "; path=/; domain=qq.com;";
			}
			return d;
		}
	};
	TCISD.pv.send = function(sDomain, path, opts) {
		sDomain = sDomain || location.hostname || "-";
		path = path || location.pathname;
		opts = opts || {};
		opts.referURL = opts.referURL || document.referrer;
		var t, d, r;
		t = opts.referURL.split(TCISD.pv._urlSpliter);
		t = t[0];
		t = t.split("/");
		d = t[2] || "-";
		r = "/" + t.slice(3).join("/");
		opts.referDomain = opts.referDomain || d;
		opts.referPath = opts.referPath || r;
		opts.timeout = typeof opts.timeout == 'undefined' ? 5000 : opts.timeout;
		pvSender.send(sDomain, path, opts.referDomain, opts.referPath,
				(opts.flashVersion || ""), opts.timeout);
	};
})();
TCISD.pv._urlSpliter = /[\?\#]/;
TCISD.pv._cookieP = /(?:^|;+|\s+)pgv_pvid=([^;]*)/i;
TCISD.pv._cookieSSID = /(?:^|;+|\s+)pgv_info=([^;]*)/i;
TCISD.pv.config = {
	webServerInterfaceURL : "/qq_pingd"
};
window.TCISD = window.TCISD || {};
TCISD.createTimeStat = function(statName, flagArr, standardData) {
	var _s = TCISD.TimeStat, t, instance;
	flagArr = flagArr || _s.config.defaultFlagArray;
	t = flagArr.join("_");
	statName = statName || t;
	if (instance = _s._instances[statName]) {
		return instance;
	} else {
		return (new _s(statName, t, standardData));
	}
};
TCISD.markTime = function(timeStampSeq, statName, flagArr, timeObj) {
	var ins = TCISD.createTimeStat(statName, flagArr);
	ins.mark(timeStampSeq, timeObj);
	return ins;
};
TCISD.TimeStat = function(statName, flags, standardData) {
	var _s = TCISD.TimeStat;
	this.sName = statName;
	this.flagStr = flags;
	this.timeStamps = [ null ];
	this.zero = _s.config.zero;
	if (standardData) {
		this.standard = standardData;
	}
	_s._instances[statName] = this;
	_s._count++;
};
TCISD.TimeStat.prototype.getData = function(seq) {
	var r = {}, t, d;
	if (seq && (t = this.timeStamps[seq])) {
		d = new Date();
		d.setTime(this.zero.getTime());
		r.zero = d;
		d = new Date();
		d.setTime(t.getTime());
		r.time = d;
		r.duration = t - this.zero;
		if (this.standard && (d = this.standard.timeStamps[seq])) {
			r.delayRate = (r.duration - d) / d;
		}
	} else {
		r.timeStamps = TCISD.TimeStat._cloneData(this.timeStamps);
	}
	return r;
};
TCISD.TimeStat._cloneData = function(obj) {
	if ((typeof obj) == 'object') {
		var res = obj.sort ? [] : {};
		for ( var i in obj) {
			res[i] = TCISD.TimeStat._cloneData(obj[i]);
		}
		return res;
	} else if ((typeof obj) == 'function') {
		return Object;
	}
	return obj;
};
TCISD.TimeStat.prototype.mark = function(seq, timeObj) {
	seq = seq || this.timeStamps.length;
	this.timeStamps[Math.min(Math.abs(seq), 99)] = timeObj || (new Date());
	return this;
};
TCISD.TimeStat.prototype.merge = function(baseTimeStat) {
	var x, y;
	if (baseTimeStat && (typeof (baseTimeStat.timeStamps) == "object")
			&& baseTimeStat.timeStamps.length) {
		this.timeStamps = baseTimeStat.timeStamps.concat(this.timeStamps
				.slice(1));
	} else {
		return this;
	}
	if (baseTimeStat.standard && (x = baseTimeStat.standard.timeStamps)) {
		if (!this.standard) {
			this.standard = {};
		}
		if (!(y = this.standard.timeStamps)) {
			y = this.standard.timeStamps = {};
		}
		for ( var key in x) {
			if (!y[key]) {
				y[key] = x[key];
			}
		}
	}
	return this;
};
TCISD.TimeStat.prototype.setZero = function(od) {
	if (typeof (od) != "object" || typeof (od.getTime) != "function") {
		od = new Date();
	}
	this.zero = od;
	return this;
};
TCISD.TimeStat.prototype.report = function(baseURL) {
	var _s = TCISD.TimeStat, url = [], t, z;
	if ((t = this.timeStamps).length < 1) {
		return this;
	}
	url.push((baseURL && baseURL.split("?")[0])
			|| _s.config.webServerInterfaceURL);
	url.push("?");
	z = this.zero;
	for ( var i = 1, len = t.length; i < len; ++i) {
		if (t[i]) {
			url.push(i, "=", t[i].getTime ? (t[i] - z) : t[i], "&");
		}
	}
	t = this.flagStr.split("_");
	for ( var i = 0, len = _s.config.maxFlagArrayLength; i < len; ++i) {
		if (t[i]) {
			url.push("flag", i + 1, "=", t[i], "&");
		}
	}
	if (_s.pluginList && _s.pluginList.length) {
		for ( var i = 0, len = _s.pluginList.length; i < len; ++i) {
			(typeof (_s.pluginList[i]) == 'function') && _s.pluginList[i](url);
		}
	}
	url.push("sds=", Math.random());
	QZFL.pingSender && QZFL.pingSender(url.join(""));
	return this;
};
TCISD.TimeStat._instances = {};
TCISD.TimeStat._count = 0;
TCISD.TimeStat.config = {
	webServerInterfaceURL : "cgi_bin_r_cgi",
	defaultFlagArray : [ 175, 115, 1 ],
	maxFlagArrayLength : 6,
	zero : window._s_ || (new Date())
};
window.TCISD = window.TCISD || {};
TCISD.valueStat = function(statId, resultType, returnValue, opts) {
	setTimeout(function() {
		TCISD.valueStat.send(statId, resultType, returnValue, opts);
	}, 0);
};
TCISD.valueStat.send = function(statId, resultType, returnValue, opts) {
	var _s = TCISD.valueStat, _c = _s.config, t = _c.defaultParams, p, url = [];
	statId = statId || t.statId;
	resultType = resultType || t.resultType;
	returnValue = returnValue || t.returnValue;
	opts = opts || t;
	if (typeof (opts.reportRate) != "number") {
		opts.reportRate = 1;
	}
	opts.reportRate = Math.round(Math.max(opts.reportRate, 1));
	if (!opts.fixReportRateOnly && !TCISD.valueStat.config.reportAll
			&& (opts.reportRate > 1 && (Math.random() * opts.reportRate) > 1)) {
		return;
	}
	url.push((opts.reportURL || _c.webServerInterfaceURL), "?");
	url.push("flag1=", statId, "&", "flag2=", resultType, "&", "flag3=",
			returnValue, "&", "1=", (TCISD.valueStat.config.reportAll ? 1
					: opts.reportRate), "&", "2=", opts.duration, "&");
	if (typeof opts.extendField != 'undefined') {
		url.push("4=", opts.extendField, "&");
	}
	if (_s.pluginList && _s.pluginList.length) {
		for ( var i = 0, len = _s.pluginList.length; i < len; ++i) {
			(typeof (_s.pluginList[i]) == 'function') && _s.pluginList[i](url);
		}
	}
	url.push("sds=", Math.random());
	QZFL.pingSender(url.join(""));
};
TCISD.valueStat.config = {
	webServerInterfaceURL : "/cgi_bin_v_cgi",
	defaultParams : {
		statId : 1,
		resultType : 1,
		returnValue : 11,
		reportRate : 1,
		duration : 1000
	},
	reportAll : false
};
if (typeof (window.TCISD) == "undefined") {
	window.TCISD = {};
};
TCISD.hotClick = function(tag, domain, url, opt) {
	TCISD.hotClick.send(tag, domain, url, opt);
};
TCISD.hotClick.send = function(tag, domain, url, opt) {
	opt = opt || {};
	var _s = TCISD.hotClick, x = opt.x || 9999, y = opt.y || 9999, doc = opt.doc
			|| document, w = doc.parentWindow || doc.defaultView, p = w._hotClick_params
			|| {};
	url = url || p.url || w.location.pathname || "-";
	domain = domain || p.domain || w.location.hostname || "-";
	if (!opt.abs) {
		if (!_s.isReport()) {
			return;
		}
	}
	url = [ _s.config.webServerInterfaceURL, "?dm=", domain + ".hot", "&url=",
			escape(url), "&tt=-", "&hottag=", tag, "&hotx=", x, "&hoty=", y,
			"&rand=", Math.random() ];
	QZFL.pingSender(url.join(""));
};
TCISD.hotClick._arrSend = function(arr, doc) {
	for ( var i = 0, len = arr.length; i < len; i++) {
		TCISD.hotClick.send(arr[i].tag, arr[i].domain, arr[i].url, {
			doc : doc
		});
	}
};
TCISD.hotClick.click = function(event, doc) {
	var _s = TCISD.hotClick, tags = _s
			.getTags(QZFL.event.getTarget(event), doc);
	_s._arrSend(tags, doc);
};
TCISD.hotClick.getTags = function(dom, doc) {
	var _s = TCISD.hotClick, tags = [], w = doc.parentWindow || doc.defaultView, rules = w._hotClick_params.rules, t;
	for ( var i = 0, len = rules.length; i < len; i++) {
		if (t = rules[i](dom)) {
			tags.push(t);
		}
	}
	return tags;
};
TCISD.hotClick.defaultRule = function(dom) {
	var tag, domain, t;
	tag = dom.getAttribute("hottag");
	if (tag && tag.indexOf("|") > -1) {
		t = tag.split("|");
		tag = t[0];
		domain = t[1];
	}
	if (tag) {
		return {
			tag : tag,
			domain : domain
		};
	}
	return null;
};
TCISD.hotClick.config = TCISD.hotClick.config || {
	webServerInterfaceURL : "/qq_pingd",
	reportRate : 1,
	domain : null,
	url : null
};
TCISD.hotClick._reportRate = typeof TCISD.hotClick._reportRate == 'undefined' ? -1
		: TCISD.hotClick._reportRate;
TCISD.hotClick.isReport = function() {
	var _s = TCISD.hotClick, rate;
	if (_s._reportRate != -1) {
		return _s._reportRate;
	}
	rate = Math.round(_s.config.reportRate);
	if (rate > 1 && (Math.random() * rate) > 1) {
		return (_s._reportRate = 0);
	}
	return (_s._reportRate = 1);
};
TCISD.hotClick.setConfig = function(opt) {
	opt = opt || {};
	var _sc = TCISD.hotClick.config, doc = opt.doc || document, w = doc.parentWindow
			|| doc.defaultView;
	if (opt.domain) {
		w._hotClick_params.domain = opt.domain;
	}
	if (opt.url) {
		w._hotClick_params.url = opt.url;
	}
	if (opt.reportRate) {
		w._hotClick_params.reportRate = opt.reportRate;
	}
};
TCISD.hotAddRule = function(handler, opt) {
	opt = opt || {};
	var _s = TCISD.hotClick, doc = opt.doc || document, w = doc.parentWindow
			|| doc.defaultView;
	if (!w._hotClick_params) {
		return;
	}
	w._hotClick_params.rules.push(handler);
	return w._hotClick_params.rules;
};
TCISD.hotClickWatch = function(opt) {
	opt = opt || {};
	var _s = TCISD.hotClick, w, l, doc;
	doc = opt.doc = opt.doc || document;
	w = doc.parentWindow || doc.defaultView;
	if (l = doc._hotClick_init) {
		return;
	}
	l = true;
	if (!w._hotClick_params) {
		w._hotClick_params = {};
		w._hotClick_params.rules = [ _s.defaultRule ];
	}
	_s.setConfig(opt);
	w.QZFL.event.addEvent(doc, "click", _s.click, [ doc ]);
};
if (typeof (window.TCISD) == 'undefined') {
	window.TCISD = {};
}
TCISD.stringStat = function(dataId, hashValue, opts) {
	setTimeout(function() {
		TCISD.stringStat.send(dataId, hashValue, opts);
	}, 0);
};
TCISD.stringStat.send = function(dataId, hashValue, opts) {
	var _s = TCISD.stringStat, _c = _s.config, t = _c.defaultParams, url = [], isPost = false, htmlParam, sd;
	dataId = dataId || t.dataId;
	opts = opts || t;
	isPost = (opts.method && opts.method == 'post') ? true : false;
	if (typeof (hashValue) != "object") {
		return;
	}
	for ( var i in hashValue) {
		if (hashValue[i].length && hashValue[i].length > 1024) {
			hashValue[i] = hashValue[i].substring(0, 1024);
		}
	}
	if (typeof (opts.reportRate) != 'number') {
		opts.reportRate = 1;
	}
	opts.reportRate = Math.round(Math.max(opts.reportRate, 1));
	if (opts.reportRate > 1 && (Math.random() * opts.reportRate) > 1) {
		return;
	}
	if (isPost && QZFL.FormSender) {
		hashValue.dataId = dataId;
		hashValue.sds = Math.random();
		var sd = new QZFL.FormSender(_c.webServerInterfaceURL, 'post',
				hashValue, 'UTF-8');
		sd.send();
	} else {
		htmlParam = TCISD.stringStat.genHttpParamString(hashValue);
		url.push(_c.webServerInterfaceURL, '?');
		url.push('dataId=', dataId);
		url.push('&', htmlParam, '&');
		url.push('ted=', Math.random());
		QZFL.pingSender(url.join(''));
	}
};
TCISD.stringStat.config = {
	webServerInterfaceURL : '/cgi_bin_s_fcg',
	defaultParams : {
		dataId : 1,
		reportRate : 1,
		method : 'get'
	}
};
TCISD.stringStat.genHttpParamString = function(o) {
	var res = [];
	for ( var k in o) {
		res.push(k + '=' + window.encodeURIComponent(o[k]));
	}
	return res.join('&');
};/* |xGv00|ec38ec7d24af9a7a199e3d9ea89ec4a7 */
window.V = window.V || {};
V.util = V.util || {};
if (window.QZFL && QZFL.config && QZFL.config.FSHelperPage) {
	if (/\.pengyou\.com$/.test(location.hostname)) {
		QZFL.config.FSHelperPage = QZFL.config.FSHelperPage.replace(
				/^http\:\/\/(?:[^\.]+\.)?qzs\.qq\.com/,
				'http://qzs.pengyou.com');
	} else if (/\.qq\.com$/.test(location.hostname)) {
		QZFL.config.FSHelperPage = QZFL.config.FSHelperPage.replace(
				/^http\:\/\/qzs\.qq\.com/, 'http://' + (function() {
					var _isp = QZFL.cookie.get('ptisp');
					if (({
						ctc : 1,
						cnc : 1,
						edu : 1,
						cm : 1,
						cn : 1,
						os : 1
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
	for ( var i = 0, obj; obj = objs[i]; i++) {
		for ( var k in obj) {
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
	var url = [ '/qq_pingd?dm=', domain, '.hot&url=', path,
			'&hottag=', tag, '&hotx=9999&hoty=9999&sds=', Math.random() ]
			.join('');
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
	for ( var k in param) {
		p.push(encodeURIComponent(k) + '=' + encodeURIComponent(param[k]));
	}
	p = p.join('&');
	var hash = url.split('#');
	url = hash[0].split('?');
	hash = hash[1] ? ('#' + hash[1]) : '';
	param = url[1] ? ('?' + url[1]) : '';
	url = url[0];
	var v = forHash ? hash : param;
	v = v ? v.lastIndexOf('&') == v.length - 1 ? (v + p) : (v + '&' + p)
			: ('?' + p);
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
	for ( var i = 0, len = str.length; i < len; ++i) {
		hash += (hash << 5) + str.charCodeAt(i);
	}
	return hash & 0x7fffffff;
};
V.util.loadJson = function(opt) {
	opt = V.util.combine({
		timeout : 5000,
		charset : 'utf-8',
		cbFn : '_Callback',
		valueStatKey : 'ret',
		getRetCodeValueStat : V.util._getRetCodeValueStat,
		successReportRate : 1,
		errorReportRate : 1
	}, opt);
	if (!opt.url) {
		return;
	}
	opt.param = V.util.combine(QZFL.pluginsDefine
			&& QZFL.pluginsDefine.getACSRFToken ? {
		uin : V.util.getUin()
	} : {
		uin : V.util.getUin(),
		g_tk : V.util.getToken()
	}, opt.param);
	opt.random && (opt.param._r = Math.random());
	var startTime;
	var j = new QZFL.JSONGetter(opt.url, '_vasJsonInstance_'
			+ (QZFL.JSONGetter.counter + 1), opt.param, opt.charset);
	if (opt.valueStatId) {
		j.onSuccess = function(ret) {
			var duration = new Date() - startTime;
			var valueStat = opt.getRetCodeValueStat(ret[opt.valueStatKey]);
			if (valueStat) {
				TCISD.valueStat(opt.valueStatId, valueStat[0], valueStat[1]
						+ '', {
					duration : duration,
					reportRate : opt.successReportRate
				});
			}
			opt.onSuccess && opt.onSuccess(ret);
		};
		j.onError = function() {
			var duration = new Date() - startTime;
			TCISD.valueStat(opt.valueStatId, 2, '1', {
				duration : duration,
				reportRate : opt.errorReportRate
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
		charset : 'utf-8',
		valueStatKey : 'ret',
		getRetCodeValueStat : V.util._getRetCodeValueStat,
		successReportRate : 1,
		errorReportRate : 1
	}, opt);
	if (!opt.url) {
		return;
	}
	opt.query = V.util.combine(QZFL.pluginsDefine
			&& QZFL.pluginsDefine.getACSRFToken ? {
		uin : V.util.getUin()
	} : {
		uin : V.util.getUin(),
		g_tk : V.util.getToken()
	}, opt.query);
	opt.param = V.util.combine({
		uin : V.util.getUin(),
		g_tk : V.util.getToken()
	}, opt.param);
	var url = V.util.appendUrlParam(opt.url, opt.query);
	var startTime;
	var f = new QZFL.FormSender(url, 'POST', opt.param, opt.charset);
	if (opt.valueStatId) {
		f.onSuccess = function(ret) {
			var duration = new Date() - startTime;
			var valueStat = opt.getRetCodeValueStat(ret[opt.valueStatKey]);
			if (valueStat) {
				TCISD.valueStat(opt.valueStatId, valueStat[0], valueStat[1]
						+ '', {
					duration : duration,
					reportRate : opt.successReportRate
				});
			}
			opt.onSuccess && opt.onSuccess(ret);
		};
		f.onError = function() {
			var duration = new Date() - startTime;
			TCISD.valueStat(opt.valueStatId, 2, '1', {
				duration : duration,
				reportRate : opt.errorReportRate
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
		method : 'POST',
		param : {},
		sync : 0,
		noCache : 0,
		charset : 'utf-8',
		valueStatKey : 'ret',
		getRetCodeValueStat : V.util._getRetCodeValueStat,
		successReportRate : 1,
		errorReportRate : 1
	}, opt);
	if (!opt.url) {
		return;
	}
	opt.query = V.util.combine({
		uin : V.util.getUin(),
		g_tk : V.util.getToken()
	}, opt.query);
	opt.param = V.util.combine({
		uin : V.util.getUin(),
		g_tk : V.util.getToken()
	}, opt.param);
	var url = V.util.appendUrlParam(opt.url, opt.query);
	var startTime;
	var xhr = new QZFL.XHR(url, '_vasXhrInstance_' + (QZFL.XHR.counter + 1),
			opt.method, opt.param, !opt.sync, opt.noCache);
	xhr.charset = opt.charset;
	xhr.onError = opt.valueStatId ? (function() {
		var duration = new Date() - startTime;
		TCISD.valueStat(opt.valueStatId, 2, '1', {
			duration : duration,
			reportRate : opt.errorReportRate
		});
		opt.onError && opt.onError();
	}) : (opt.onError || QZFL.emptyFn);
	xhr.onSuccess = opt.onSuccess ? (function(ret) {
		if (ret.text) {
			try {
				ret = (window.JSON && JSON.parse) ? JSON.parse(ret.text)
						: eval("(" + ret.text + ")");
			} catch (_) {
				xhr.onError();
			}
			if (opt.valueStatId) {
				var duration = new Date() - startTime;
				var valueStat = opt.getRetCodeValueStat(ret[opt.valueStatKey]);
				if (valueStat) {
					TCISD.valueStat(opt.valueStatId, valueStat[0], valueStat[1]
							+ '', {
						duration : duration,
						reportRate : opt.successReportRate
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
	return ret == 0 ? [ 1, 0 ] : [ 2, ret ];
};
V.util.tmpl = function(str, param) {
	if (!str) {
		return '';
	}
	param = param || {};
	var obj = QZFL.dom.get(str);
	obj && (str = obj.innerHTML);
	var fn = [ 'var __=[];' ];
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
	var args = [], argv = [];
	for ( var key in param) {
		args.push(key);
		argv.push(param[key]);
	}
	fn = new Function(args.join(','), fn.join(''));
	return fn.apply(null, argv);
};
V.util.performanceTimeStat = function(flag1, flag2, flag3, delay) {
	setTimeout(
			function() {
				var performance = window.performance
						|| window.webkitPerformance || window.msPerformance;
				if (!performance || !window.TCISD) {
					return;
				}
				var list = [ performance.timing.navigationStart,
						performance.timing.unloadEventStart,
						performance.timing.unloadEventEnd,
						performance.timing.redirectStart,
						performance.timing.redirectEnd,
						performance.timing.fetchStart,
						performance.timing.domainLookupStart,
						performance.timing.domainLookupEnd,
						performance.timing.connectStart,
						performance.timing.connectEnd,
						performance.timing.requestStart,
						performance.timing.responseStart,
						performance.timing.responseEnd,
						performance.timing.domLoading,
						performance.timing.domInteractive,
						performance.timing.domContentLoadedEventStart,
						performance.timing.domContentLoadedEventEnd,
						performance.timing.domComplete,
						performance.timing.loadEventStart,
						performance.timing.loadEventEnd ];
				var o = new TCISD.TimeStat(null, [ flag1, flag2, flag3 ]
						.join('_')), length = list.length;
				o.zero = new Date(list[0]);
				for ( var i = 1; i < length; i++) {
					o.mark(i, new Date(list[i] || list[0]));
				}
				o.report();
			}, delay || 0);
};
V.util.timeStat = function(flag1, flag2, flag3, timeStamps, delay) {
	setTimeout(function() {
		var o = new TCISD.TimeStat(null, [ flag1, flag2, flag3 ].join('_'));
		o.zero = timeStamps[0];
		o.timeStamps = timeStamps;
		o.report();
	}, delay || 0);
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
			for ( var i = l; i < n; i++) {
				(o & 4) ? s.push(0) : s.unshift(0);
			}
		}
		if (n < l && (o & 2)) {
			if (o & 4) {
				s = s.slice(0, n);
			} else {
				s = s.slice(l - n, l);
			}
		}
		s = s.join('');
		(o & 8) && (s = s.replace(/^0*(.+?)0*$/, '$1'));
		return s;
	};
	return fmt.replace(/(y|M|d|h|H|m|s|f|F|t)+/g, function(match) {
		var c = match.charAt(0), l = match.length;
		switch (c) {
		case 'y':
			return ss(time.getFullYear(), l, 4, 2);
		case 'M':
			if (l <= 2) {
				return ss(time.getMonth() + 1, l, 2, 1);
			}
			return (forEng ? (l == 3 ? [ 'Jan', 'Feb', 'Mar', 'Apr', 'May',
					'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' ] : [
					'January', 'February', 'March', 'April', 'May', 'June',
					'July', 'August', 'September', 'October', 'November',
					'December' ]) : [ '一月', '二月', '三月', '四月', '五月', '六月', '七月',
					'八月', '九月', '十月', '十一月', '十二月' ])[time.getMonth()];
		case 'd':
			if (l <= 2) {
				return ss(time.getDate(), l, 2, 1);
			}
			return (forEng ? (l == 3 ? [ 'Sun', 'Mon', 'Tue', 'Wed', 'Thu',
					'Fri', 'Sat' ] : [ 'Sunday', 'Monday', 'Tuesday',
					'Wednesday', 'Thurday ', 'Friday', 'Saturday' ]) : [ '星期日',
					'星期一', '星期二', '星期三', '星期四', '星期五', '星期六' ])[time.getDay()];
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
			return ss(time.getHours() >= 12 ? (forEng ? 'PM' : '下午')
					: (forEng ? 'AM' : '上午'), l, 2, 6);
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
		url : '/cgi_get_score.json',
		param : {
			mask : 4,
			uins : V.util.toStr(uins) == '[object Array]' ? uins.join(',')
					: uins
		},
		onSuccess : function(ret) {
			var _uins = V.util.toStr(uins) == '[object Array]' ? uins : uins
					.split(',');
			var _args = {};
			for ( var i = 0, one; one = _uins[i]; i++) {
				_args[one] = (ret[one] && ret[one][6]) || one;
			}
			cb(_args);
		},
		onError : cbErr,
		cbFn : 'portraitCallBack',
		charset : 'gbk'
	});
};
OPCONST = {
	CODING : 1,
	VERIFYING : 4,
	VERIFY_S : 5,
	VERIFY_F : 6,
	PRE_ONLINE : 8,
	ONLINE : 12,
	SIGNED : 20,
	RECOMMEND : 30,
	HOSTING : 0,
	MULTI_REGION : 1
};
PF_STATE = {
	NOT_ONLINE : 1,
	ONLINE : 2,
	P_ONLINE : 8
};
FLOW_STATE = {
	DEV : -1,
	VERIFY_ING : 1,
	VERIFY_S : 2,
	VERIFY_F : 30,
	ONLINE : 10
};/* |xGv00|4709c98c709533d17d841128977599a3 */
function initOpenReport() {
	var screenWidth = typeof screen != "undefined" && screen.width;
	var screenHeight = typeof screen != "undefined" && screen.height;
	if (screenHeight && screenWidth) {
		window.TCISD
				&& TCISD.valueStat(350395, 1, screenWidth + "0" + screenHeight);
	}
	QZFL.event.delegate(document.body, "[_hot_tag]", "click", function(e) {
		var _t = this.getAttribute("_hot_tag");
		_t
				&& window.TCISD
				&& TCISD.hotClick(_t, location.host, location.pathname
						+ location.search, null);
	});
}
var initTopTips = function() {
	var Carousels = {
		list : [],
		length : 0,
		count : 0,
		currentEl : null,
		intervalId : 0,
		timeoutId : 0,
		init : function(list) {
			Carousels.list = list;
			Carousels.length = list.length;
			Carousels.count = 0;
			Carousels.currentEl = list[0];
			if (Carousels.length > 1) {
				Carousels.goCarousels();
			}
			;
			$e("#top_tips_cont").onHover(Carousels.cancel, Carousels.begin);
		},
		begin : function() {
			Carousels.timeoutId = setTimeout(function() {
				Carousels.go();
				Carousels.goCarousels();
			}, 2000)
		},
		cancel : function() {
			clearTimeout(Carousels.timeoutId);
			clearInterval(Carousels.intervalId);
		},
		goCarousels : function() {
			Carousels.intervalId = setInterval(function() {
				Carousels.go();
			}, 5000);
		},
		go : function() {
			Carousels.currentEl.style.display = "none";
			Carousels.count = (Carousels.count + 1 == Carousels.length) ? 0
					: Carousels.count + 1;
			Carousels.currentEl = Carousels.list[Carousels.count];
			Carousels.currentEl.style.display = "";
		}
	};
	var topTipsEls = $e(".j_top_tips_el").elements, path;
	if (!topTipsEls.length) {
		return;
	}
	Carousels.init(topTipsEls);
	path = location.pathname + "?mod=" + V.util.getUrlParam("mod") + "&act="
			+ V.util.getUrlParam("act");
	window.TCISD && TCISD.hotClick("XHT.PV", "op.open.qq.com", path);
}
function initFlowTips() {
	var openTips = {
		config : {},
		_prd : function(type, opts) {
			var attr = {};
			if (1 == type) {
				attr.cont = [
						'<div class="gb_layer_box_inner" style="width:auto;">',
						'<div class="gb_layer_box_cont">',
						'<div class="gb_layer_box_hd" style="display:'
								+ ('string' == typeof opts.title ? '' : 'none')
								+ '">',
						'<strong id="j_tip_title">'
								+ (opts.title ? opts.title : '') + '</strong>',
						'</div>',
						'<div class="gb_layer_box_bd">',
						'<div id="j_tip_content" style="word-wrap:word-break;word-break:break-all;">'
								+ opts.content + '</div>',
						'</div>',
						'</div>',
						'<b class="ico arrow_top"'
								+ ('number' == typeof opts.arrow ? (' style="left:'
										+ opts.arrow + 'px;"')
										: '') + '></b>', '</div>' ].join('');
			}
			if (2 == type) {
				attr.className = "qz_bubble qz_bubble_blue";
				attr.cont = [
						'<div class="bubble_i">',
						'<p style="word-wrap:word-break;word-break:break-all;">'
								+ opts.content + '</p>', '</div>',
						'<b class="bubble_trig ui_trigbox ui_trigbox_l"> ',
						'<b class="ui_trig"></b> ',
						'<b class="ui_trig ui_trig_up"></b> ', '</b>' ]
						.join('');
			}
			if (3 == type) {
				attr.cont = opts.content;
			}
			return attr;
		},
		_doShow : function(opts, win) {
			var _this = this;
			var win = win || window, _doc = win.document, t = _doc
					.getElementById('tips_layer');
			win._tip_timer && clearTimeout(win._tip_timer);
			opts = QZFL.extend(true, opts, _this._prd((opts.type || 1), opts));
			if (!t) {
				var el = _doc.createElement('div');
				el.id = "tips_layer";
				el.onmouseout = function() {
					openTips.hide(win);
				}
				el.onmouseover = function() {
					win._tip_timer && clearTimeout(win._tip_timer);
				}
				_doc.body.appendChild(el);
				t = _doc.getElementById('tips_layer');
			}
			t.innerHTML = opts.cont;
			t.className = opts.className ? opts.className : "gb_layer_box";
			t.style.cssText = 'position:absolute; left:' + opts.left
					+ 'px; top:' + opts.top + 'px; width:'
					+ (opts.width ? opts.width + 'px' : 'auto') + '; height:'
					+ (opts.height ? opts.height + 'px' : 'auto')
					+ '; z-index:' + (opts.zIndex || 1000);
			t.style.display = "";
		},
		hide : function(win) {
			var win = win || window, _doc = win.document;
			if (!_doc.getElementById('tips_layer')) {
				return;
			}
			win._tip_timer = setTimeout(function() {
				_doc.getElementById('tips_layer').style.display = "none";
			}, 150);
		},
		show : function(elem, opts, win) {
			var _t, win = win || window, isTop = false, opts, _tmpO;
			if (!elem) {
				return;
			}
			_t = elem.getAttribute("_op_tip");
			opts = opts || openTips.config[_t];
			if (!opts
					|| ("function" == typeof opts._fnBeforeShow && false === opts._fnBeforeShow
							.call(elem))) {
				return;
			}
			try {
				if (win == window) {
					isTop = true;
				}
			} catch (e) {
			}
			if (1 == opts.type) {
				openTips._doShow(QZFL.extend({
					left : elem.getBoundingClientRect().left + elem.offsetWidth
							/ 2 - 26 + (opts.offsetLeft ? opts.offsetLeft : 0),
					top : elem.getBoundingClientRect().top
							+ (isTop && QZFL.dom.getScrollTop())
							+ elem.offsetHeight + 12,
					arrow : opts.offsetLeft ? -opts.offsetLeft + 17 : "default"
				}, opts), win);
				if ("function" == typeof opts.cbFn) {
					opts.cbFn();
				}
				return;
			}
			if (2 == opts.type) {
				parent.openTips._doShow(QZFL.extend({
					left : elem.getBoundingClientRect().left + elem.offsetWidth
							+ 10,
					top : elem.getBoundingClientRect().top
							+ (isTop && QZFL.dom.getScrollTop())
							+ elem.offsetHeight / 2 - 17
				}, opts), win);
				if ("function" == typeof opts.cbFn) {
					opts.cbFn();
				}
				return;
			}
			_tmpO = QZFL.extend({}, opts);
			parent.openTips
					._doShow(
							QZFL
									.extend(
											_tmpO,
											{
												type : 3,
												className : "qz_bubble qz_bubble_gray bubble_query",
												width : opts.width,
												left : elem
														.getBoundingClientRect().left
														+ elem.offsetWidth
														/ 2
														- 27
														+ (opts.left ? opts.left
																: 0),
												top : elem
														.getBoundingClientRect().top
														+ (isTop && QZFL.dom
																.getScrollTop())
														+ elem.offsetHeight
														+ 12,
												content : V.util
														.tmpl(
																[
																		'<div class="bubble_i">',
																		'<div class="mod_bubble_query">',
																		'<div class="bubble_query_hd">',
																		'<h3 id="op_big_tip_title"><%= opts.title %></h3>',
																		'</div>',
																		'<div class="bubble_query_bd" id="op_big_tip_content">',
																		'<%for( var i = 0 , len = opts.info.length; i<len; i++ ){%>',
																		'<%= opts.info[i].desc ? "<p>"+ opts.info[i].desc +"</p>" : "" %>',
																		'<%= opts.info[i].img ? "<div class=\\"img_box\\"><img src=\\""+ opts.info[i].img +"\\"></div>" : "" %>',
																		'<%}%>',
																		'</div>',
																		'</div>',
																		'</div>',
																		'<b class="bubble_trig ui_trigbox ui_trigbox_t"<% if( opts.left ){ %> style="left:<%= -opts.left + 20  %>px;"<% } %>>',
																		'<b class="ui_trig"></b> <b class="ui_trig ui_trig_up"></b>',
																		'</b>' ]
																		.join(""),
																{
																	opts : opts
																})
											}), win);
			if ("function" == typeof opts.cbFn) {
				opts.cbFn.call(elem, elem);
			}
		},
		bind : function() {
			var _timer = null;
			QZFL.event.delegate(document.body, '[_op_tip],#tips_layer',
					'mouseover', function() {
						if (!this.getAttribute("_op_tip")
								&& "tips_layer" != this.id) {
							return;
						}
						clearTimeout(_timer);
						openTips.show(this);
					});
			QZFL.event.delegate(document.body, '[_op_tip],#tips_layer',
					'mouseout', function() {
						if (!this.getAttribute("_op_tip")
								&& "tips_layer" != this.id) {
							return;
						}
						_timer = setTimeout(function() {
							openTips.hide(window);
						}, 200);
					});
		}
	};
	openTips.bind();
	window.openTips = openTips;
}
function initHeader() {
	var uin = V.util.getUin(), nick = null;
	V.util.getPortrait(uin, function(args) {
		window._nickName = nick = args[uin];
		_cb_port();
	}, function() {
		_cb_port();
	});
	function _cb_port() {
		var mcHeader = QZFL.dom.get("header_manage_center");
		if (mcHeader) {
			$e(".j_nick").setHtml(
					QZFL.string
							.cut(QZFL.string.escHTML(nick || uin), 10, "..."));
			$e(".layer_drop_down,.link_drop_down").onHover(function() {
				$e(".layer_drop_down").show();
			}, function() {
				$e(".layer_drop_down").hide();
			});
		}
	}
	var __logoutTimer = null;
	$e(".j_login,.j_logout").onHover(function() {
		clearTimeout(__logoutTimer);
		$e(".j_logout").show();
	}, function() {
		__logoutTimer = setTimeout(function() {
			$e(".j_logout").hide();
		}, 150);
	});
	var frmSearch = QZFL.dom.get('frm_search');
	var iptSearch = QZFL.dom.get('ipt_search');
	V.widget.placeHolder.bind(iptSearch);
	QZFL.event.on(QZFL.dom.get('btn_search'), 'click', function() {
		if (V.widget.placeHolder.get(iptSearch)) {
			_doSubmit();
		}
	});
	QZFL.event.on(frmSearch, 'submit', function() {
		if (!V.widget.placeHolder.get(iptSearch)) {
			_doSubmit();
		}
	});
	function _doSubmit() {
		var key = encodeURIComponent(QZFL.string.trim(iptSearch.value));
		if (key) {
			window.open("/search?is_search=1&key=" + key,
					"_blank");
		}
		window.TCISD
				&& TCISD.hotClick('OPEN.SEARCH', "open.qq.com", null, null);
	}
}
V.dialog = V.dialog
		|| (function() {
			function show(title, content, width, height, opt) {
				opt = opt || {};
				var useTween = opt.useTween, noBorder = opt.noBorder, callback = opt.callback;
				var _dialog = QZFL.dialog.create(title, content, width, height,
						useTween, noBorder);
				var _maskID = QZFL.maskLayout.create();
				_dialog.onUnload = function() {
					if (typeof callback == 'function') {
						callback();
					}
					QZFL.maskLayout.remove(_maskID);
				};
				return _dialog;
			}
			;
			return {
				show : show
			};
		})();
V.login = V.login
		|| (function() {
			var _RET_HASH = {
				'SUCCESS' : 0,
				'FAIL' : 1,
				'CANCEL' : 2
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
							_targetWindow.location.href = "/login";
						}
					} else if (ret === _RET_HASH['FAIL']) {
						hide();
						alert('登录失败');
					}
				}
			}
			;
			function _dialogCallback() {
				if (_appCallback) {
					_appCallback(_RET_HASH['CANCEL']);
				}
			}
			;
			function show(opt) {
				opt = opt || {};
				var _html = '<iframe scrolling="no" style="width: 370px; height: 278px;" frameborder="0" allowtransparency="yes" src="http://qzs.qq.com/qzone/vas/login/jump.html"></iframe>';
				_targetWindow = opt.targetWindow || window;
				_sUrl = opt.sUrl || location.href;
				_appCallback = typeof opt.callback == 'function' ? opt.callback
						: null;
				_dialog = V.dialog.show('登录', _html, 372, 280, {
					callback : QZFL.event.bind(this, _dialogCallback)
				});
			}
			;
			function hide() {
				_dialog.unload();
			}
			;
			function exit(target) {
				QZFL.object.each([ 'zzpaneluin', 'zzpanelkey' ],
						function(value) {
							QZFL.cookie.set(value, '');
						});
				QZFL
						.imports(
								'/js/developer/ptloginout.js',
								function() {
									window.pt_logout
											&& pt_logout
													.logout(function(ret) {
														target ? window.location.href = target
																: window.location
																		.reload();
													});
								});
			}
			;
			function resize(w, h) {
				if (_dialog) {
					_dialog.setSize(w, h);
				}
			}
			;
			function getUin() {
				var uin = QZFL.cookie.get('uin')
						|| QZFL.cookie.get('zzpaneluin');
				if (uin.length > 4) {
					return +uin.replace(/o(\d+)/g, '$1');
				}
				return 0;
			}
			;
			function getUinsInfo(uins, callback) {
				var _url = '/cgi_get_score.json?mask=4&uins=';
				var g = new QZFL.JSONGetter(_url + uins.join(','), Math
						.random().toString(), null);
				g.onSuccess = function(o) {
					callback(o);
				};
				g.onError = function() {
					return;
				};
				g.send('portraitCallBack');
			}
			;
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
			}
			;
			return {
				_callback : _callback,
				RET_HASH : _RET_HASH,
				show : show,
				hide : hide,
				exit : exit,
				resize : resize,
				getUin : getUin,
				getUinsInfo : getUinsInfo,
				call : call
			};
		})();
(function _initOpenBase() {
	var m = [ "initHeader", "initTopTips", "initFlowTips", "initOpenReport" ];
	for ( var p in m) {
		try {
			window[m[p]]();
		} catch (e) {
		}
	}
})();/* |xGv00|95efeaff340081a3e29eb6e27a632ec8 */