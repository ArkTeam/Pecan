OP_COMMON = {
    url: {
        default_img: ""
    },
    dialog_msg: function(msg) {
        parent.QZFL.dialog.create('提示', '<p style="padding:40px 20px 0; line-height:1.8em;">' + msg + '</p>', {
            width: 300,
            height: 120,
            showMask: true
        });
    },
    OP_TIPS: {
        icon_16: {
            title: "应用小图标",
            info: [{
                desc: "16×16应用图标会出现在平台应用列表。以空间为例。平台应用中心的各类应用排行榜：",
                img: ""
            }]
        },
        icon_100: {
            title: "应用大图标",
            left: -50,
            info: [{
                desc: "100×100应用图标会出现在平台推广类Feeds中，以空间平台为例：",
                img: ""
            },
            {
                img: ""
            }]
        }
    },
    util: {
        reg_exps: {
            email: /^[0-9A-Za-z\-\_\.]+\@[0-9A-Za-z\-\_]+(\.[0-9A-Za-z\-\_]+)+$/,
            url: /^http(s)*:\/\/[\w-]+(\.[\w-]+)+(:\d+)?(\/[\w.%-]+)*\/?$/i,
            url_parm_hash: /^http(s)*:\/\/[\w-]+(\.[\w-]+)+(:\d+)?(\/[?#\/\-_.!~*'()\w%&=]*$)?/i,
            phone: /^([0-9]+\-)*[0-9]+$/,
            mobile_phone: /^1\d{10}$/,
            uin: /^[1-9][0-9]{4,9}$/,
            common: /^[0-9a-zA-Z\u4E00-\u9FA5\uF900-\uFA2D]+$/,
            company_idcard: /^[0-9]{10,20}$/,
            person_idcard: /^[0-9xX]{18}$/,
            passport: /^[0-9a-zA-Z]+$/,
            lazy: /^[^<>'"]+$/,
            human_name: /^[a-zA-Z\u4E00-\u9FA5\uF900-\uFA2D][a-zA-Z\u4E00-\u9FA5\uF900-\uFA2D\s]*$/,
            human_name_cn_no_nec: /^([\u4E00-\u9FA5]{2,5}|.{0,0})$/,
            sensetive: /^[^'"<>]+$/,
            num: /(^[1-9][0-9]*$)|(^0$)/,
            num_positive: /^[1-9][0-9]*$/
        },
        showMask: function(zIndex, win) {
            var ind = arguments.callee.ind || 1000,
            zIndex = zIndex || 100,
            style,
            width,
            height;
            win = win || top;
            arguments.callee.ind = ++ind;
            width = Math.max(win.QZFL.dom.getClientWidth(), win.QZFL.dom.getScrollWidth());
            height = Math.max(win.QZFL.dom.getClientHeight(), win.QZFL.dom.getScrollHeight());
            style = 'position:absolute;left:0;top:0;background-color:#000;width:' + width + 'px;height:' + height + 'px;z-index:' + zIndex + ';visibility:hidden;';
            var el = win.QZFL.dom.createElementIn("div", win.document.body, false, {
                id: "op_mask_" + ind,
                style: style,
                "class": "op_mask"
            });
            win.$e(el).setStyle({
                "opacity": 0.4,
                "visibility": "visible"
            });
            return ind;
        },
        hideMask: function(ind, win) {
            win = win || top;
            win.document.body.removeChild(win.document.getElementById("op_mask_" + ind));
        },
        validate_tip: function(el, type, msg) {
            var $tip = $e('.j_open_validate_tip', el.parentNode.parentNode);
            if ("error" == type) {
                $tip.addClass("form_panel_msg_advise").setHtml('<b class="form_tips nopass"><i class="ico ico_tips"></i>' + (msg ? msg: '') + '</b>').setStyle("display", "block");
            } else if ("succ" == type) {
                $tip.removeClass("form_panel_msg_advise").setHtml('<b class="form_tips pass"><i class="ico ico_tips"></i>' + (msg ? msg: '') + '</b>').setStyle("display", "block");
            } else {
                $tip.removeClass("form_panel_msg_advise").setHtml('<i class="ico ico_tips"></i>' + (msg ? msg: '')).setStyle("display", "block");
            }
        },
        water_mark: {
            show: function(el, msg) {
                if (!QZFL.string.trim(el.value)) {
                    el.value = msg || el.getAttribute("water_mark");
                    el.style.color = "#999";
                    el._ever_focused = false;
                } else {
                    el._ever_focused = true;
                }
            },
            hide: function(el) {
                el.value = "";
                el.style.color = "#000";
            }
        },
        set_value: function(el, val) {
            el.value = val;
            el.style.color = "#000";
            el._ever_focused = true;
        },
        form_validate: function(fn_suc) {
            var _this = this;
            var _validate = function(onblur) {
                var input = this,
                val = this.value;
                val = val.replace(/\s+$/, "");
                if (! (_this.reg_exps[this.getAttribute("validate")] && _this.reg_exps[this.getAttribute("validate")].test(val))) {
                    if (0 == QZFL.string.trim(val).length) {
                        if (onblur) {
                            _this.water_mark.show(this);
                        } else {
                            _this.validate_tip(this, "error", "该项不能为空");
                        }
                    } else {
                        _this.validate_tip(this, "error", this.getAttribute("validate_tip"));
                    }
                    return false;
                } else {
                    if ("function" == typeof fn_suc) {
                        if (false === fn_suc(_this, input, onblur)) {
                            return false;
                        }
                    } else {
                        _this.validate_tip(this, "succ");
                    }
                    return true;
                }
            };
            QZFL.each(document.forms, 
            function(f) {
                f._validate = function() {
                    var ret = true;
                    $e('[validate]', this).each(function() {
                        if (!this._ever_focused) {
                            this.value = "";
                        }
                        if (!this.disabled && !_validate.call(this)) {
                            ret = false;
                        }
                    });
                    return ret;
                }
                f = null;
            });
            $e('[validate]').each(function() {
                this.onfocus = function() { ! this._ever_focused && _this.water_mark.hide(this);
                    this._ever_focused = true;
                    _this.validate_tip(this, "hide");
                }
                this.onblur = function() {
                    _validate.call(this, true);
                }
            });
        },
        getStrLen: function(str) {
            return Math.ceil(str.replace(/[^\x00-\xff]/g, 'TS').length / 2);
        }
    },
    upload: {
        _uploadIframe: null,
        _dialog: null,
        apc_upload_id:null,
        post_url:null,
        dimension:"",
        isprocessing:false,
        showUpload: function(post_url, suc_fn, desc, type_param, no_size,dimension, opt) {
            if (this._dialog) {
                return;
            }
            //document.domain='mofing.com';
            OP_COMMON.upload.dimension=dimension;
            OP_COMMON.upload.post_url=post_url;
            if(post_url.indexOf("?")!=-1){
            	post_url=post_url+"&act=frame";
            }else{
            	post_url=post_url+"?act=frame";
            }
            var name = "文件";
            if (this._uploadIframe == null) {
                var iframe = $('#__FormTargetFrame');
                if (iframe.length==0) {
                    iframe = document.createElement('iframe');
                    iframe.border = iframe.width = iframe.height = 0;
                    iframe.id = '__FormTargetFrame';
                    iframe.name = '__FormTargetFrame';
                    document.body.appendChild(iframe);
                    if (window.frames) {
                        window.frames['__FormTargetFrame'].name = '__FormTargetFrame';
                    }
                }
                this._uploadIframe = iframe;
            }
            this._uploadIframe.callback = function(ret) {
                var _d = null;
            	OP_COMMON.upload.isprocessing=false;
                QZFL.widget.msgbox.hide();
                $( "#upload_file_process" ).hide();
                if (0 == ret.error || true == ret.result) {
                    OP_COMMON.upload.closeUpload();
                    QZFL.widget.msgbox.show(ret.message || "上传成功",4, 2000);
                    suc_fn && suc_fn(ret);
                } else {
                    var op_mask_ind = OP_COMMON.util.showMask(6500);
                    var crop=[];
                    var buttonConfigs=[{
                        type: QZFL.dialog.BUTTON_TYPE.Normal,
                        text: '重新上传',
                        tips: '重新上传',
                        clickFn: function() {
                            _d.unload();
                            _d = null;
                        }
                    },
                    {
                        type: QZFL.dialog.BUTTON_TYPE.Cancel,
                        text: '取消',
                        tips: '取消',
                        clickFn: function() {
                            OP_COMMON.upload.closeUpload();
                            _d = null;
                        }
                    }];
                    //固定尺寸的图片，才允许切割
                    if(ret.error==7 && OP_COMMON.upload.dimension != ""){
                    	QZFL.css.insertCSSLink("./css/jquery.Jcrop.css");
                    	ret.message+="或者裁剪图片";
	                    crop={
	                       	 type: QZFL.dialog.BUTTON_TYPE.Cancel,
	                         text: '裁剪图片',
	                         tips: '裁剪图片',
	                         clickFn: function() {
	                             _d.cropImage(ret.filePath);
	                         }
	                    };
	                    buttonConfigs.unshift(crop);
                    }
                    _d = parent.QZFL.dialog.create("提示", '<p style="padding:30px 25px 0; line-height:22px; color:#f30;">上传失败：' + ret.message + '</p>', {
                        showMask: false,
                        'width': 320,
                        'height': 100,
                        buttonConfig:buttonConfigs
                    });
                    _d.cropImage=function(url){
                    	//打开裁剪窗口
                    	 OP_COMMON.upload.cropImage(url);
                    	_d = null;
                    };
                    _d.onUnload = function() {
                        OP_COMMON.util.hideMask(op_mask_ind);
                    };
                }
            };
            var timestamp=new Date().getTime();
            OP_COMMON.upload.apc_upload_id=V.util.getToken()+"_"+timestamp;
            var html = ['<div style="text-align:left; padding-top:37px;">',
                        '<form method="post" action="' + post_url + '" enctype="multipart/form-data" target="__FormTargetFrame" id="formUpload">',
                        (no_size ? '': '<input type="hidden" name="imagesize" value="' + type_param+ '"/>'),  
                        '<input type="hidden" name="dimension" value="',  dimension, '" />', 
                        '<input type="hidden" name="g_tk" value="', V.util.getToken(), '" />', 
                        ' <input type="hidden" name="PHP_SESSION_UPLOAD_PROGRESS" id="progress_key"  value="'+OP_COMMON.upload.apc_upload_id+'"/>',
                        '<input type="hidden" name="token" value="', V.util.getToken(), '" />',
                        '<input type="hidden" name="appid" value="', parseInt(V.util.getUrlParam("appid")), '" />',
                        (opt && opt.customContent) || '', 
                        '<div id="divUploadForm" style="height:100px;">',
                        '<div style="padding:0px 35px;">',
                        '<div id="upload_file_process"><div class="progress-label">Loading...</div></div>', '<p style="color:#000;">' + desc + '</p>', 
                        '<input name="file" type="file" style="width:300px;padding:4px 0;margin-top:18px;background-color:#fff;" id="formUploadFile"/>', 
                        '</div>', '</div>', '<div class="layer_opensns_confirm_bt">', 
                        '<button type="submit" onclick="return (window.frames[0].OP_COMMON || OP_COMMON).upload.startProgress();" >确定</button>', 
                        '<button type="button" onclick="(window.frames[0].OP_COMMON || OP_COMMON).upload.closeUpload(); ">取消</button>',
                        '</div>', '</form>', '</div>'].join('');
            var win = QZFL.userAgent.ie == 6 ? window: parent;
            var dialog = win.QZFL.dialog.create('上传' + name, html, 400, 174);
            var maskID = win.QZFL.maskLayout.create();
            dialog.onUnload = QZFL.object.bind(this, 
            function() {
                win.QZFL.maskLayout.remove(maskID);
                this._dialog = null;
            });
            this._dialog = dialog;
        },
        closeUpload: function() {
            this._dialog && this._dialog.unload();
        },
        cropImage:function(url_obj){
        	$.getScript("./js/jquery.Jcrop.js",function(){
        		url="./"+url_obj;
        		var i_width, i_height;
        		$("<img/>") // 在内存中创建一个img标记
			    .attr("src", url)
			    .load(function() {
			    	i_width = this.width;
			        i_height = this.height;
					var w2=500;
					var h2=500;
					
					if(OP_COMMON.upload.dimension=="" || i_width<s_width || i_height<s_height){
						QZFL.widget.msgbox.show("图片太小或者尺寸不规则，无法裁剪!",3, 2000);
						//alert("");
						return false;
					}
					var size_arr = OP_COMMON.upload.dimension.split("_");
					var s_width=size_arr[0];
					var s_height=size_arr[1];
					
					if(i_width>i_height){
						 h2=w2*i_height/i_width;
					}else{
						w2=h2/i_height*i_width;
					}
	        		var html='<div class="crop_main" id="id_crop_main" style="padding-left: 20px;"><img id="image_crop_panel" src="'+url+'" style="width:'+w2+'px;height:'+h2+'px"/><span id="crop_preview_box" class="crop_preview"><img id="crop_preview" src="'+url+'" /></span></div>';
	        		var win = QZFL.userAgent.ie == 6 ? window: parent;
	        		var cropdialog = win.QZFL.dialog.create('裁剪图片' , html,  {
	                    showMask: false,
	                    'width': w2+200,
	                    'height':h2+20,
	                    buttonConfig: [{
	                        type: QZFL.dialog.BUTTON_TYPE.Normal,
	                        text: '保存图片',
	                        tips: '保存图片',
	                        clickFn: function() {
	                            //提交裁剪
	                        	 QZFL.widget.msgbox.show("正在努力裁剪中...", 6, 10*1024*1024);
	                        	$("#crop_form").submit();	
	                        	setTimeout(function(){cropdialog.unload();},500);
	                        }
	                    }, {
	                        type: QZFL.dialog.BUTTON_TYPE.Cancel,
	                        text: '取消',
	                        tips: '取消',
	                        clickFn: function() {
	                            OP_COMMON.upload.closeUpload();
	                            _d = null;
	                        }
	                    }]});
	        		//增加表单
	        		$("#id_crop_main").append('<div style="display:none;"><form action="cropimage.html" method="post" target="__FormTargetFrame" id="crop_form">'+
	        				'<input type="hidden" name="filepath" value="'+url_obj+'"/>'+
	        				'<input type="hidden" name="s_width" value="'+w2+'"/>'+
	        				'<input type="hidden" name="s_height" value="'+h2+'"/>'+
	        				'<input type="hidden" id="x" name="x" value="0"/><input type="hidden" id="y" name="y"  value="0"/>'+
	        				'<input type="hidden" id="w" name="w"  value="'+s_width+'"/><input type="hidden" id="h" name="h"  value="'+s_height+'"/> <input type="sumbit" value="确认剪裁" id="crop_submit" /></form></div>');
	        		 $("#image_crop_panel").Jcrop({
	        			onChange:OP_COMMON.upload.showPreview,
	        			onSelect:OP_COMMON.upload.showPreview,
	        			aspectRatio:1,
	        			allowSelect:!1,
	        			setSelect: [0,s_width,s_height,0]
	        		});	
			    }) ;
    		});
        },
         showPreview:function(coords){
			if(parseInt(coords.w) > 0){
				$("#id_crop_main #x").val(coords.x);
				$("#id_crop_main #y").val(coords.y);
				$("#id_crop_main #w").val(coords.w);
				$("#id_crop_main #h").val(coords.h);
				//计算预览区域图片缩放的比例，通过计算显示区域的宽度(与高度)与剪裁的宽度(与高度)之比得到
				var rx = $("#crop_preview_box").width() / coords.w; 
				var ry = $("#crop_preview_box").height() / coords.h;
				//通过比例值控制图片的样式与显示
				$("#crop_preview").css({
					width:Math.round(rx * $("#image_crop_panel").width()) + "px",	//预览图片宽度为计算比例值与原图片宽度的乘积
					height:Math.round(rx * $("#image_crop_panel").height()) + "px",	//预览图片高度为计算比例值与原图片高度的乘积
					marginLeft:"-" + Math.round(rx * coords.x) + "px",
					marginTop:"-" + Math.round(ry * coords.y) + "px"
				});
			}
		},
        startProgress:function(){
        	//检查是否选择了文件
        	var ff = $("form#formUpload #formUploadFile").val();
        	if(!ff){
        		QZFL.widget.msgbox.show("请选择文件!",3, 2000);
        		return false;
        	}
        	if(OP_COMMON.upload.isprocessing){
        		return false;
        	}
        	OP_COMMON.upload.isprocessing=true;
        	//如果支持html5，则显示进度条，否则直接进入表单
        	var isallow=OP_COMMON.uploadprogress.allowbrowser();
        	 if(isallow){
        		 OP_COMMON.uploadprogress.xmlHttp=OP_COMMON.uploadprogress.createXHR();
        		 $( "#upload_file_process" ).show();
        		 setTimeout(function(){
        			 OP_COMMON.uploadprogress.progress();
        		 }, 1000);
        		 $( "#upload_file_process" ).progressbar({
        			 value: false,
        			 change: function() {
        				 $(".progress-label" ).text( $(this).progressbar( "value" ) + "%" );
        			 }
        		 });
        		 $(".progress-label" ).show();
        		 return false;
        	 }else{
        		 //打开loading
        		 QZFL.widget.msgbox.show("正在努力上传...", 6, 10*1024*1024);
        		 return true;
        	 }
        }
    },
    init: function(data) {
        if (data.tips) {
            QZFL.each(data.tips, 
            function() {
                var t = this;
                QZFL.dom.createElementIn("div", $('j_top_caution'), false, {
                    "class": 0 == t.type ? "fn_hint": "fn_hint fn_hint_success",
                    "innerHTML": '<i class="' + (0 == t.type ? 'ico ico_hint_advise': 'ico ico_hint_success') + '"></i> <p>' + t.content + '</p>'
                });
            });
        }
    },
    uploadprogress:{
        xmlHttp:null,
        allowbrowser:function(){
        	var bro={
	        	"msie":10,
	        	"safari":5.02,
	        	"mozilla":4,
	        	"webkit":6
        	};
        	var version=parseFloat($.browser.version);
        	if ($.browser.safari) {
        		 return version>=bro.safari;
        	}else if($.browser.msie){
        		return version>=bro.msie;
        	}else if($.browser.mozilla){
        		return version>=bro.mozilla;
        	}else if($.browser.webkit){
        		return version>=bro.webkit;
        	}
        	return false;
        },
        Try : {
        		  these: function() {
        		    var returnValue;
        		    for (var i = 0; i < arguments.length; i++) {
        		      var lambda = arguments[i];
        		      try {
        		        returnValue = lambda();
        		        break;
        		      } catch (e) {}
        		    }
        		    return returnValue;
        		  }
        		},
    	createXHR:function(){
    		return OP_COMMON.uploadprogress.Try.these(
    				function() {return new XMLHttpRequest();}
    		) || false;
    	},
    	progress:function(id){
    		var xmlHttp=OP_COMMON.uploadprogress.xmlHttp;
    		var fd = new FormData();
    		//formUpload
    		fd.append("file", document.getElementById('formUploadFile').files[0]);
    		fd.append("g_tk", document.getElementsByName('g_tk')[0].value);
    		fd.append("token", document.getElementsByName('token')[0].value);
    		fd.append("imagesize", document.getElementsByName('imagesize')[0].value);
    		fd.append("dimension", document.getElementsByName('dimension')[0].value);
    		xmlHttp.upload.addEventListener("progress", OP_COMMON.uploadprogress.listeners.uploadProgress, false);
    		xmlHttp.addEventListener("load", OP_COMMON.uploadprogress.listeners.uploadComplete, false);
    		xmlHttp.addEventListener("error", OP_COMMON.uploadprogress.listeners.uploadFailed, false);
    		xmlHttp.addEventListener("abort", OP_COMMON.uploadprogress.listeners.uploadCanceled, false);
    		xmlHttp.open("POST",OP_COMMON.upload.post_url);
    		xmlHttp.send(fd);   
    	},
    	listeners:{
    		uploadProgress:function(evt){
    			  if (evt.lengthComputable) {
    		          var percentComplete = Math.round(evt.loaded * 100 / evt.total);
    		          $( "#upload_file_process" ).progressbar("value",percentComplete);
    		      }
    		},
    		uploadComplete:function(evt){
    			//直接调用表单回调函数
    			//json转换
    			var result= jQuery.parseJSON(evt.target.responseText);
    			OP_COMMON.upload._uploadIframe.callback(result);
    			 //alert(evt.target.responseText);
    		},
    		uploadFailed:function(evt){
    			//alert("There was an error attempting to upload the file.");
    		},
    		uploadCanceled:function(evt){
    			//alert("The upload has been canceled by the user or the browser dropped the connection.");
    		}
    	}
    },
    bind_events: function() {
        QZFL.event.delegate(document.body, '[_op_tip]', 'mouseover', 
        function() {
            var opts = OP_COMMON.OP_TIPS[this.getAttribute("_op_tip")];
            parent.openTips.show(this, opts, window);
        });
        QZFL.event.delegate(document.body, '[_op_tip]', 'mouseout', 
        function() {
            parent.openTips.hide(window);
        });
    }
};
