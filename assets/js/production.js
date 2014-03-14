/*
* jQuery Form Plugin; v20131121
* http://jquery.malsup.com/form/
* Copyright (c) 2013 M. Alsup; Dual licensed: MIT/GPL
* https://github.com/malsup/form#copyright-and-license
*/
;(function(e){"function"==typeof define&&define.amd?define(["jquery"],e):e("undefined"!=typeof jQuery?jQuery:window.Zepto)})(function(e){"use strict";function t(t){var r=t.data;t.isDefaultPrevented()||(t.preventDefault(),e(t.target).ajaxSubmit(r))}function r(t){var r=t.target,a=e(r);if(!a.is("[type=submit],[type=image]")){var n=a.closest("[type=submit]");if(0===n.length)return;r=n[0]}var i=this;if(i.clk=r,"image"==r.type)if(void 0!==t.offsetX)i.clk_x=t.offsetX,i.clk_y=t.offsetY;else if("function"==typeof e.fn.offset){var o=a.offset();i.clk_x=t.pageX-o.left,i.clk_y=t.pageY-o.top}else i.clk_x=t.pageX-r.offsetLeft,i.clk_y=t.pageY-r.offsetTop;setTimeout(function(){i.clk=i.clk_x=i.clk_y=null},100)}function a(){if(e.fn.ajaxSubmit.debug){var t="[jquery.form] "+Array.prototype.join.call(arguments,"");window.console&&window.console.log?window.console.log(t):window.opera&&window.opera.postError&&window.opera.postError(t)}}var n={};n.fileapi=void 0!==e("<input type='file'/>").get(0).files,n.formdata=void 0!==window.FormData;var i=!!e.fn.prop;e.fn.attr2=function(){if(!i)return this.attr.apply(this,arguments);var e=this.prop.apply(this,arguments);return e&&e.jquery||"string"==typeof e?e:this.attr.apply(this,arguments)},e.fn.ajaxSubmit=function(t){function r(r){var a,n,i=e.param(r,t.traditional).split("&"),o=i.length,s=[];for(a=0;o>a;a++)i[a]=i[a].replace(/\+/g," "),n=i[a].split("="),s.push([decodeURIComponent(n[0]),decodeURIComponent(n[1])]);return s}function o(a){for(var n=new FormData,i=0;a.length>i;i++)n.append(a[i].name,a[i].value);if(t.extraData){var o=r(t.extraData);for(i=0;o.length>i;i++)o[i]&&n.append(o[i][0],o[i][1])}t.data=null;var s=e.extend(!0,{},e.ajaxSettings,t,{contentType:!1,processData:!1,cache:!1,type:u||"POST"});t.uploadProgress&&(s.xhr=function(){var r=e.ajaxSettings.xhr();return r.upload&&r.upload.addEventListener("progress",function(e){var r=0,a=e.loaded||e.position,n=e.total;e.lengthComputable&&(r=Math.ceil(100*(a/n))),t.uploadProgress(e,a,n,r)},!1),r}),s.data=null;var c=s.beforeSend;return s.beforeSend=function(e,r){r.data=t.formData?t.formData:n,c&&c.call(this,e,r)},e.ajax(s)}function s(r){function n(e){var t=null;try{e.contentWindow&&(t=e.contentWindow.document)}catch(r){a("cannot get iframe.contentWindow document: "+r)}if(t)return t;try{t=e.contentDocument?e.contentDocument:e.document}catch(r){a("cannot get iframe.contentDocument: "+r),t=e.document}return t}function o(){function t(){try{var e=n(g).readyState;a("state = "+e),e&&"uninitialized"==e.toLowerCase()&&setTimeout(t,50)}catch(r){a("Server abort: ",r," (",r.name,")"),s(k),j&&clearTimeout(j),j=void 0}}var r=f.attr2("target"),i=f.attr2("action");w.setAttribute("target",p),(!u||/post/i.test(u))&&w.setAttribute("method","POST"),i!=m.url&&w.setAttribute("action",m.url),m.skipEncodingOverride||u&&!/post/i.test(u)||f.attr({encoding:"multipart/form-data",enctype:"multipart/form-data"}),m.timeout&&(j=setTimeout(function(){T=!0,s(D)},m.timeout));var o=[];try{if(m.extraData)for(var c in m.extraData)m.extraData.hasOwnProperty(c)&&(e.isPlainObject(m.extraData[c])&&m.extraData[c].hasOwnProperty("name")&&m.extraData[c].hasOwnProperty("value")?o.push(e('<input type="hidden" name="'+m.extraData[c].name+'">').val(m.extraData[c].value).appendTo(w)[0]):o.push(e('<input type="hidden" name="'+c+'">').val(m.extraData[c]).appendTo(w)[0]));m.iframeTarget||v.appendTo("body"),g.attachEvent?g.attachEvent("onload",s):g.addEventListener("load",s,!1),setTimeout(t,15);try{w.submit()}catch(l){var d=document.createElement("form").submit;d.apply(w)}}finally{w.setAttribute("action",i),r?w.setAttribute("target",r):f.removeAttr("target"),e(o).remove()}}function s(t){if(!x.aborted&&!F){if(M=n(g),M||(a("cannot access response document"),t=k),t===D&&x)return x.abort("timeout"),S.reject(x,"timeout"),void 0;if(t==k&&x)return x.abort("server abort"),S.reject(x,"error","server abort"),void 0;if(M&&M.location.href!=m.iframeSrc||T){g.detachEvent?g.detachEvent("onload",s):g.removeEventListener("load",s,!1);var r,i="success";try{if(T)throw"timeout";var o="xml"==m.dataType||M.XMLDocument||e.isXMLDoc(M);if(a("isXml="+o),!o&&window.opera&&(null===M.body||!M.body.innerHTML)&&--O)return a("requeing onLoad callback, DOM not available"),setTimeout(s,250),void 0;var u=M.body?M.body:M.documentElement;x.responseText=u?u.innerHTML:null,x.responseXML=M.XMLDocument?M.XMLDocument:M,o&&(m.dataType="xml"),x.getResponseHeader=function(e){var t={"content-type":m.dataType};return t[e.toLowerCase()]},u&&(x.status=Number(u.getAttribute("status"))||x.status,x.statusText=u.getAttribute("statusText")||x.statusText);var c=(m.dataType||"").toLowerCase(),l=/(json|script|text)/.test(c);if(l||m.textarea){var f=M.getElementsByTagName("textarea")[0];if(f)x.responseText=f.value,x.status=Number(f.getAttribute("status"))||x.status,x.statusText=f.getAttribute("statusText")||x.statusText;else if(l){var p=M.getElementsByTagName("pre")[0],h=M.getElementsByTagName("body")[0];p?x.responseText=p.textContent?p.textContent:p.innerText:h&&(x.responseText=h.textContent?h.textContent:h.innerText)}}else"xml"==c&&!x.responseXML&&x.responseText&&(x.responseXML=X(x.responseText));try{E=_(x,c,m)}catch(b){i="parsererror",x.error=r=b||i}}catch(b){a("error caught: ",b),i="error",x.error=r=b||i}x.aborted&&(a("upload aborted"),i=null),x.status&&(i=x.status>=200&&300>x.status||304===x.status?"success":"error"),"success"===i?(m.success&&m.success.call(m.context,E,"success",x),S.resolve(x.responseText,"success",x),d&&e.event.trigger("ajaxSuccess",[x,m])):i&&(void 0===r&&(r=x.statusText),m.error&&m.error.call(m.context,x,i,r),S.reject(x,"error",r),d&&e.event.trigger("ajaxError",[x,m,r])),d&&e.event.trigger("ajaxComplete",[x,m]),d&&!--e.active&&e.event.trigger("ajaxStop"),m.complete&&m.complete.call(m.context,x,i),F=!0,m.timeout&&clearTimeout(j),setTimeout(function(){m.iframeTarget?v.attr("src",m.iframeSrc):v.remove(),x.responseXML=null},100)}}}var c,l,m,d,p,v,g,x,b,y,T,j,w=f[0],S=e.Deferred();if(S.abort=function(e){x.abort(e)},r)for(l=0;h.length>l;l++)c=e(h[l]),i?c.prop("disabled",!1):c.removeAttr("disabled");if(m=e.extend(!0,{},e.ajaxSettings,t),m.context=m.context||m,p="jqFormIO"+(new Date).getTime(),m.iframeTarget?(v=e(m.iframeTarget),y=v.attr2("name"),y?p=y:v.attr2("name",p)):(v=e('<iframe name="'+p+'" src="'+m.iframeSrc+'" />'),v.css({position:"absolute",top:"-1000px",left:"-1000px"})),g=v[0],x={aborted:0,responseText:null,responseXML:null,status:0,statusText:"n/a",getAllResponseHeaders:function(){},getResponseHeader:function(){},setRequestHeader:function(){},abort:function(t){var r="timeout"===t?"timeout":"aborted";a("aborting upload... "+r),this.aborted=1;try{g.contentWindow.document.execCommand&&g.contentWindow.document.execCommand("Stop")}catch(n){}v.attr("src",m.iframeSrc),x.error=r,m.error&&m.error.call(m.context,x,r,t),d&&e.event.trigger("ajaxError",[x,m,r]),m.complete&&m.complete.call(m.context,x,r)}},d=m.global,d&&0===e.active++&&e.event.trigger("ajaxStart"),d&&e.event.trigger("ajaxSend",[x,m]),m.beforeSend&&m.beforeSend.call(m.context,x,m)===!1)return m.global&&e.active--,S.reject(),S;if(x.aborted)return S.reject(),S;b=w.clk,b&&(y=b.name,y&&!b.disabled&&(m.extraData=m.extraData||{},m.extraData[y]=b.value,"image"==b.type&&(m.extraData[y+".x"]=w.clk_x,m.extraData[y+".y"]=w.clk_y)));var D=1,k=2,A=e("meta[name=csrf-token]").attr("content"),L=e("meta[name=csrf-param]").attr("content");L&&A&&(m.extraData=m.extraData||{},m.extraData[L]=A),m.forceSync?o():setTimeout(o,10);var E,M,F,O=50,X=e.parseXML||function(e,t){return window.ActiveXObject?(t=new ActiveXObject("Microsoft.XMLDOM"),t.async="false",t.loadXML(e)):t=(new DOMParser).parseFromString(e,"text/xml"),t&&t.documentElement&&"parsererror"!=t.documentElement.nodeName?t:null},C=e.parseJSON||function(e){return window.eval("("+e+")")},_=function(t,r,a){var n=t.getResponseHeader("content-type")||"",i="xml"===r||!r&&n.indexOf("xml")>=0,o=i?t.responseXML:t.responseText;return i&&"parsererror"===o.documentElement.nodeName&&e.error&&e.error("parsererror"),a&&a.dataFilter&&(o=a.dataFilter(o,r)),"string"==typeof o&&("json"===r||!r&&n.indexOf("json")>=0?o=C(o):("script"===r||!r&&n.indexOf("javascript")>=0)&&e.globalEval(o)),o};return S}if(!this.length)return a("ajaxSubmit: skipping submit process - no element selected"),this;var u,c,l,f=this;"function"==typeof t?t={success:t}:void 0===t&&(t={}),u=t.type||this.attr2("method"),c=t.url||this.attr2("action"),l="string"==typeof c?e.trim(c):"",l=l||window.location.href||"",l&&(l=(l.match(/^([^#]+)/)||[])[1]),t=e.extend(!0,{url:l,success:e.ajaxSettings.success,type:u||e.ajaxSettings.type,iframeSrc:/^https/i.test(window.location.href||"")?"javascript:false":"about:blank"},t);var m={};if(this.trigger("form-pre-serialize",[this,t,m]),m.veto)return a("ajaxSubmit: submit vetoed via form-pre-serialize trigger"),this;if(t.beforeSerialize&&t.beforeSerialize(this,t)===!1)return a("ajaxSubmit: submit aborted via beforeSerialize callback"),this;var d=t.traditional;void 0===d&&(d=e.ajaxSettings.traditional);var p,h=[],v=this.formToArray(t.semantic,h);if(t.data&&(t.extraData=t.data,p=e.param(t.data,d)),t.beforeSubmit&&t.beforeSubmit(v,this,t)===!1)return a("ajaxSubmit: submit aborted via beforeSubmit callback"),this;if(this.trigger("form-submit-validate",[v,this,t,m]),m.veto)return a("ajaxSubmit: submit vetoed via form-submit-validate trigger"),this;var g=e.param(v,d);p&&(g=g?g+"&"+p:p),"GET"==t.type.toUpperCase()?(t.url+=(t.url.indexOf("?")>=0?"&":"?")+g,t.data=null):t.data=g;var x=[];if(t.resetForm&&x.push(function(){f.resetForm()}),t.clearForm&&x.push(function(){f.clearForm(t.includeHidden)}),!t.dataType&&t.target){var b=t.success||function(){};x.push(function(r){var a=t.replaceTarget?"replaceWith":"html";e(t.target)[a](r).each(b,arguments)})}else t.success&&x.push(t.success);if(t.success=function(e,r,a){for(var n=t.context||this,i=0,o=x.length;o>i;i++)x[i].apply(n,[e,r,a||f,f])},t.error){var y=t.error;t.error=function(e,r,a){var n=t.context||this;y.apply(n,[e,r,a,f])}}if(t.complete){var T=t.complete;t.complete=function(e,r){var a=t.context||this;T.apply(a,[e,r,f])}}var j=e("input[type=file]:enabled",this).filter(function(){return""!==e(this).val()}),w=j.length>0,S="multipart/form-data",D=f.attr("enctype")==S||f.attr("encoding")==S,k=n.fileapi&&n.formdata;a("fileAPI :"+k);var A,L=(w||D)&&!k;t.iframe!==!1&&(t.iframe||L)?t.closeKeepAlive?e.get(t.closeKeepAlive,function(){A=s(v)}):A=s(v):A=(w||D)&&k?o(v):e.ajax(t),f.removeData("jqxhr").data("jqxhr",A);for(var E=0;h.length>E;E++)h[E]=null;return this.trigger("form-submit-notify",[this,t]),this},e.fn.ajaxForm=function(n){if(n=n||{},n.delegation=n.delegation&&e.isFunction(e.fn.on),!n.delegation&&0===this.length){var i={s:this.selector,c:this.context};return!e.isReady&&i.s?(a("DOM not ready, queuing ajaxForm"),e(function(){e(i.s,i.c).ajaxForm(n)}),this):(a("terminating; zero elements found by selector"+(e.isReady?"":" (DOM not ready)")),this)}return n.delegation?(e(document).off("submit.form-plugin",this.selector,t).off("click.form-plugin",this.selector,r).on("submit.form-plugin",this.selector,n,t).on("click.form-plugin",this.selector,n,r),this):this.ajaxFormUnbind().bind("submit.form-plugin",n,t).bind("click.form-plugin",n,r)},e.fn.ajaxFormUnbind=function(){return this.unbind("submit.form-plugin click.form-plugin")},e.fn.formToArray=function(t,r){var a=[];if(0===this.length)return a;var i=this[0],o=t?i.getElementsByTagName("*"):i.elements;if(!o)return a;var s,u,c,l,f,m,d;for(s=0,m=o.length;m>s;s++)if(f=o[s],c=f.name,c&&!f.disabled)if(t&&i.clk&&"image"==f.type)i.clk==f&&(a.push({name:c,value:e(f).val(),type:f.type}),a.push({name:c+".x",value:i.clk_x},{name:c+".y",value:i.clk_y}));else if(l=e.fieldValue(f,!0),l&&l.constructor==Array)for(r&&r.push(f),u=0,d=l.length;d>u;u++)a.push({name:c,value:l[u]});else if(n.fileapi&&"file"==f.type){r&&r.push(f);var p=f.files;if(p.length)for(u=0;p.length>u;u++)a.push({name:c,value:p[u],type:f.type});else a.push({name:c,value:"",type:f.type})}else null!==l&&l!==void 0&&(r&&r.push(f),a.push({name:c,value:l,type:f.type,required:f.required}));if(!t&&i.clk){var h=e(i.clk),v=h[0];c=v.name,c&&!v.disabled&&"image"==v.type&&(a.push({name:c,value:h.val()}),a.push({name:c+".x",value:i.clk_x},{name:c+".y",value:i.clk_y}))}return a},e.fn.formSerialize=function(t){return e.param(this.formToArray(t))},e.fn.fieldSerialize=function(t){var r=[];return this.each(function(){var a=this.name;if(a){var n=e.fieldValue(this,t);if(n&&n.constructor==Array)for(var i=0,o=n.length;o>i;i++)r.push({name:a,value:n[i]});else null!==n&&n!==void 0&&r.push({name:this.name,value:n})}}),e.param(r)},e.fn.fieldValue=function(t){for(var r=[],a=0,n=this.length;n>a;a++){var i=this[a],o=e.fieldValue(i,t);null===o||void 0===o||o.constructor==Array&&!o.length||(o.constructor==Array?e.merge(r,o):r.push(o))}return r},e.fieldValue=function(t,r){var a=t.name,n=t.type,i=t.tagName.toLowerCase();if(void 0===r&&(r=!0),r&&(!a||t.disabled||"reset"==n||"button"==n||("checkbox"==n||"radio"==n)&&!t.checked||("submit"==n||"image"==n)&&t.form&&t.form.clk!=t||"select"==i&&-1==t.selectedIndex))return null;if("select"==i){var o=t.selectedIndex;if(0>o)return null;for(var s=[],u=t.options,c="select-one"==n,l=c?o+1:u.length,f=c?o:0;l>f;f++){var m=u[f];if(m.selected){var d=m.value;if(d||(d=m.attributes&&m.attributes.value&&!m.attributes.value.specified?m.text:m.value),c)return d;s.push(d)}}return s}return e(t).val()},e.fn.clearForm=function(t){return this.each(function(){e("input,select,textarea",this).clearFields(t)})},e.fn.clearFields=e.fn.clearInputs=function(t){var r=/^(?:color|date|datetime|email|month|number|password|range|search|tel|text|time|url|week)$/i;return this.each(function(){var a=this.type,n=this.tagName.toLowerCase();r.test(a)||"textarea"==n?this.value="":"checkbox"==a||"radio"==a?this.checked=!1:"select"==n?this.selectedIndex=-1:"file"==a?/MSIE/.test(navigator.userAgent)?e(this).replaceWith(e(this).clone(!0)):e(this).val(""):t&&(t===!0&&/hidden/.test(a)||"string"==typeof t&&e(this).is(t))&&(this.value="")})},e.fn.resetForm=function(){return this.each(function(){("function"==typeof this.reset||"object"==typeof this.reset&&!this.reset.nodeType)&&this.reset()})},e.fn.enable=function(e){return void 0===e&&(e=!0),this.each(function(){this.disabled=!e})},e.fn.selected=function(t){return void 0===t&&(t=!0),this.each(function(){var r=this.type;if("checkbox"==r||"radio"==r)this.checked=t;else if("option"==this.tagName.toLowerCase()){var a=e(this).parent("select");t&&a[0]&&"select-one"==a[0].type&&a.find("option").selected(!1),this.selected=t}})},e.fn.ajaxSubmit.debug=!1});
!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):a(jQuery)}(function(a){function b(a){if(a.minTime&&(a.minTime=r(a.minTime)),a.maxTime&&(a.maxTime=r(a.maxTime)),a.durationTime&&"function"!=typeof a.durationTime&&(a.durationTime=r(a.durationTime)),a.disableTimeRanges.length>0){for(var b in a.disableTimeRanges)a.disableTimeRanges[b]=[r(a.disableTimeRanges[b][0]),r(a.disableTimeRanges[b][1])];a.disableTimeRanges=a.disableTimeRanges.sort(function(a,b){return a[0]-b[0]});for(var b=a.disableTimeRanges.length-1;b>0;b--)a.disableTimeRanges[b][0]<=a.disableTimeRanges[b-1][1]&&(a.disableTimeRanges[b-1]=[Math.min(a.disableTimeRanges[b][0],a.disableTimeRanges[b-1][0]),Math.max(a.disableTimeRanges[b][1],a.disableTimeRanges[b-1][1])],a.disableTimeRanges.splice(b,1))}return a}function c(b){var c=b.data("timepicker-settings"),e=b.data("timepicker-list");if(e&&e.length&&(e.remove(),b.data("timepicker-list",!1)),c.useSelect){e=a("<select />",{"class":"ui-timepicker-select"});var f=e}else{e=a("<ul />",{"class":"ui-timepicker-list"});var f=a("<div />",{"class":"ui-timepicker-wrapper",tabindex:-1});f.css({display:"none",position:"absolute"}).append(e)}if(c.noneOption){var h=c.useSelect?"Time...":"None",j="string"==typeof c.noneOption?c.noneOption:h;c.useSelect?e.append(a('<option value="">'+j+"</option>")):e.append(a("<li>"+j+"</li>"))}c.className&&f.addClass(c.className),null===c.minTime&&null===c.durationTime||!c.showDuration||f.addClass("ui-timepicker-with-duration");var k=c.minTime;"function"==typeof c.durationTime?k=r(c.durationTime()):null!==c.durationTime&&(k=c.durationTime);var m=null!==c.minTime?c.minTime:0,n=null!==c.maxTime?c.maxTime:m+u-1;m>=n&&(n+=u),n===u-1&&-1!==c.timeFormat.indexOf("H")&&(n=u);for(var s=c.disableTimeRanges,t=0,v=s.length,w=m;n>=w;w+=60*c.step){var y=w,z=q(y,c.timeFormat);if(c.useSelect){var A=a("<option />",{value:z});A.text(z)}else{var A=a("<li />");A.data("time",86400>=y?y:y%86400),A.text(z)}if((null!==c.minTime||null!==c.durationTime)&&c.showDuration){var B=p(w-k);if(c.useSelect)A.text(A.text()+" ("+B+")");else{var C=a("<span />",{"class":"ui-timepicker-duration"});C.text(" ("+B+")"),A.append(C)}}v>t&&(y>=s[t][1]&&(t+=1),s[t]&&y>=s[t][0]&&y<s[t][1]&&(c.useSelect?A.prop("disabled",!0):A.addClass("ui-timepicker-disabled"))),e.append(A)}if(f.data("timepicker-input",b),b.data("timepicker-list",f),c.useSelect)e.val(d(b.val(),c)),e.on("focus",function(){a(this).data("timepicker-input").trigger("showTimepicker")}),e.on("blur",function(){a(this).data("timepicker-input").trigger("hideTimepicker")}),e.on("change",function(){l(b,a(this).val(),"select")}),b.hide().after(e);else{var D=c.appendTo;"string"==typeof D?D=a(D):"function"==typeof D&&(D=D(b)),D.append(f),i(b,e),e.on("click","li",function(){b.off("focus.timepicker"),b.on("focus.timepicker-ie-hack",function(){b.off("focus.timepicker-ie-hack"),b.on("focus.timepicker",x.show)}),g(b)||b[0].focus(),e.find("li").removeClass("ui-timepicker-selected"),a(this).addClass("ui-timepicker-selected"),o(b)&&(b.trigger("hideTimepicker"),f.hide())})}}function d(b,c){if(a.isNumeric(b)||(b=r(b)),null===b)return null;var d=60*c.step;return q(Math.round(b/d)*d,c.timeFormat)}function e(){return new Date(1970,1,1,0,0,0)}function f(b){var c=a(b.target),d=c.closest(".ui-timepicker-input");0===d.length&&0===c.closest(".ui-timepicker-wrapper").length&&(x.hide(),a(document).unbind(".ui-timepicker"))}function g(a){var b=a.data("timepicker-settings");return(window.navigator.msMaxTouchPoints||"ontouchstart"in document)&&b.disableTouchKeyboard}function h(b,c,d){if(!d&&0!==d)return!1;var e=b.data("timepicker-settings"),f=!1,g=30*e.step;return c.find("li").each(function(b,c){var e=a(c),h=e.data("time")-d;return Math.abs(h)<g||h==g?(f=e,!1):void 0}),f}function i(a,b){b.find("li").removeClass("ui-timepicker-selected");var c=r(k(a));if(null!==c){var d=h(a,b,c);if(d){var e=d.offset().top-b.offset().top;(e+d.outerHeight()>b.outerHeight()||0>e)&&b.scrollTop(b.scrollTop()+d.position().top-d.outerHeight()),d.addClass("ui-timepicker-selected")}}}function j(){if(""!==this.value){var b=a(this),c=b.data("timepicker-list");if(!c||!c.is(":visible")){var d=r(this.value);if(null===d)return b.trigger("timeFormatError"),void 0;var e=b.data("timepicker-settings"),f=!1;if(null!==e.minTime&&d<e.minTime?f=!0:null!==e.maxTime&&d>e.maxTime&&(f=!0),a.each(e.disableTimeRanges,function(){return d>=this[0]&&d<this[1]?(f=!0,!1):void 0}),e.forceRoundTime){var g=d%(60*e.step);g>=30*e.step?d+=60*e.step-g:d-=g}var h=q(d,e.timeFormat);f?l(b,h,"error")&&b.trigger("timeRangeError"):l(b,h)}}}function k(a){return a.is("input")?a.val():a.data("ui-timepicker-value")}function l(a,b,c){if(a.is("input")){a.val(b);var e=a.data("timepicker-settings");e.useSelect&&a.data("timepicker-list").val(d(b,e))}return a.data("ui-timepicker-value")!=b?(a.data("ui-timepicker-value",b),"select"==c?a.trigger("selectTime").trigger("changeTime").trigger("change"):"error"!=c&&a.trigger("changeTime"),!0):(a.trigger("selectTime"),!1)}function m(b){var c=a(this),d=c.data("timepicker-list");if(!d||!d.is(":visible")){if(40!=b.keyCode)return!0;g(c)||c.focus()}switch(b.keyCode){case 13:return o(c)&&x.hide.apply(this),b.preventDefault(),!1;case 38:var e=d.find(".ui-timepicker-selected");return e.length?e.is(":first-child")||(e.removeClass("ui-timepicker-selected"),e.prev().addClass("ui-timepicker-selected"),e.prev().position().top<e.outerHeight()&&d.scrollTop(d.scrollTop()-e.outerHeight())):(d.find("li").each(function(b,c){return a(c).position().top>0?(e=a(c),!1):void 0}),e.addClass("ui-timepicker-selected")),!1;case 40:return e=d.find(".ui-timepicker-selected"),0===e.length?(d.find("li").each(function(b,c){return a(c).position().top>0?(e=a(c),!1):void 0}),e.addClass("ui-timepicker-selected")):e.is(":last-child")||(e.removeClass("ui-timepicker-selected"),e.next().addClass("ui-timepicker-selected"),e.next().position().top+2*e.outerHeight()>d.outerHeight()&&d.scrollTop(d.scrollTop()+e.outerHeight())),!1;case 27:d.find("li").removeClass("ui-timepicker-selected"),x.hide();break;case 9:x.hide();break;default:return!0}}function n(b){var c=a(this),d=c.data("timepicker-list");if(!d||!d.is(":visible"))return!0;if(!c.data("timepicker-settings").typeaheadHighlight)return d.find("li").removeClass("ui-timepicker-selected"),!0;switch(b.keyCode){case 96:case 97:case 98:case 99:case 100:case 101:case 102:case 103:case 104:case 105:case 48:case 49:case 50:case 51:case 52:case 53:case 54:case 55:case 56:case 57:case 65:case 77:case 80:case 186:case 8:case 46:i(c,d);break;default:return}}function o(a){var b=a.data("timepicker-settings"),c=a.data("timepicker-list"),d=null,e=c.find(".ui-timepicker-selected");if(e.hasClass("ui-timepicker-disabled"))return!1;if(e.length?d=e.data("time"):k(a)&&(d=r(k(a)),i(a,c)),null!==d){var f=q(d,b.timeFormat);l(a,f,"select")}return!0}function p(a){var b,c=Math.round(a/60);if(Math.abs(c)<60)b=[c,w.mins];else if(60==c)b=["1",w.hr];else{var d=(c/60).toFixed(1);"."!=w.decimal&&(d=d.replace(".",w.decimal)),b=[d,w.hrs]}return b.join(" ")}function q(a,b){if(null!==a){var c=new Date(t.valueOf()+1e3*a);if(!isNaN(c.getTime())){for(var d,e,f="",g=0;g<b.length;g++)switch(e=b.charAt(g)){case"a":f+=c.getHours()>11?"pm":"am";break;case"A":f+=c.getHours()>11?"PM":"AM";break;case"g":d=c.getHours()%12,f+=0===d?"12":d;break;case"G":f+=c.getHours();break;case"h":d=c.getHours()%12,0!==d&&10>d&&(d="0"+d),f+=0===d?"12":d;break;case"H":d=c.getHours(),a===u&&(d=24),f+=d>9?d:"0"+d;break;case"i":var h=c.getMinutes();f+=h>9?h:"0"+h;break;case"s":a=c.getSeconds(),f+=a>9?a:"0"+a;break;default:f+=e}return f}}}function r(a){if(""===a)return null;if(!a||a+0==a)return a;"object"==typeof a&&(a=a.getHours()+":"+s(a.getMinutes())+":"+s(a.getSeconds())),a=a.toLowerCase(),new Date(0);var b;if(-1===a.indexOf(":")?(b=a.match(/^([0-9]):?([0-5][0-9])?:?([0-5][0-9])?\s*([pa]?)m?$/),b||(b=a.match(/^([0-2][0-9]):?([0-5][0-9])?:?([0-5][0-9])?\s*([pa]?)m?$/))):b=a.match(/^(\d{1,2})(?::([0-5][0-9]))?(?::([0-5][0-9]))?\s*([pa]?)m?$/),!b)return null;var c,d=parseInt(1*b[1],10);c=b[4]?12==d?"p"==b[4]?12:0:d+("p"==b[4]?12:0):d;var e=1*b[2]||0,f=1*b[3]||0;return 3600*c+60*e+f}function s(a){return("0"+a).slice(-2)}var t=e(),u=86400,v={className:null,minTime:null,maxTime:null,durationTime:null,step:30,showDuration:!1,timeFormat:"g:ia",scrollDefaultNow:!1,scrollDefaultTime:!1,selectOnBlur:!1,disableTouchKeyboard:!1,forceRoundTime:!1,appendTo:"body",disableTimeRanges:[],closeOnWindowScroll:!1,typeaheadHighlight:!0,noneOption:!1},w={decimal:".",mins:"mins",hr:"hr",hrs:"hrs"},x={init:function(d){return this.each(function(){var e=a(this),f=[];for(key in v)e.data(key)&&(f[key]=e.data(key));var g=a.extend({},v,f,d);g.lang&&(w=a.extend(w,g.lang)),g=b(g),e.data("timepicker-settings",g),e.addClass("ui-timepicker-input"),g.useSelect?c(e):(e.prop("autocomplete","off"),e.on("click.timepicker focus.timepicker",x.show),e.on("change.timepicker",j),e.on("keydown.timepicker",m),e.on("keyup.timepicker",n),j.call(e.get(0)))})},show:function(b){b&&b.preventDefault();var d=a(this),e=d.data("timepicker-settings");if(e.useSelect)return d.data("timepicker-list").focus(),void 0;g(d)&&d.blur();var i=d.data("timepicker-list");if(!d.prop("readonly")&&(i&&0!==i.length&&"function"!=typeof e.durationTime||(c(d),i=d.data("timepicker-list")),!i.is(":visible"))){x.hide(),i.show(),d.offset().top+d.outerHeight(!0)+i.outerHeight()>a(window).height()+a(window).scrollTop()?i.offset({left:d.offset().left+parseInt(i.css("marginLeft").replace("px",""),10),top:d.offset().top-i.outerHeight()+parseInt(i.css("marginTop").replace("px",""),10)}):i.offset({left:d.offset().left+parseInt(i.css("marginLeft").replace("px",""),10),top:d.offset().top+d.outerHeight()+parseInt(i.css("marginTop").replace("px",""),10)});var j=i.find(".ui-timepicker-selected");if(j.length||(k(d)?j=h(d,i,r(k(d))):e.scrollDefaultNow?j=h(d,i,r(new Date)):e.scrollDefaultTime!==!1&&(j=h(d,i,r(e.scrollDefaultTime)))),j&&j.length){var l=i.scrollTop()+j.position().top-j.outerHeight();i.scrollTop(l)}else i.scrollTop(0);return a(document).on("touchstart.ui-timepicker mousedown.ui-timepicker",f),e.closeOnWindowScroll&&a(document).on("scroll.ui-timepicker",f),d.trigger("showTimepicker"),this}},hide:function(){var b=a(this),c=b.data("timepicker-settings");return c&&c.useSelect&&b.blur(),a(".ui-timepicker-wrapper:visible").each(function(){var b=a(this),c=b.data("timepicker-input"),d=c.data("timepicker-settings");d&&d.selectOnBlur&&o(c),b.hide(),c.trigger("hideTimepicker")}),this},option:function(d,e){var f=this,g=f.data("timepicker-settings"),h=f.data("timepicker-list");if("object"==typeof d)g=a.extend(g,d);else if("string"==typeof d&&"undefined"!=typeof e)g[d]=e;else if("string"==typeof d)return g[d];return g=b(g),f.data("timepicker-settings",g),h&&(h.remove(),f.data("timepicker-list",!1)),g.useSelect&&c(f),this},getSecondsFromMidnight:function(){return r(k(this))},getTime:function(a){var b=this,c=k(b);return c?(a||(a=new Date),a.setHours(0,0,0,0),new Date(a.valueOf()+1e3*r(c))):null},setTime:function(a){var b=this,c=q(r(a),b.data("timepicker-settings").timeFormat);return l(b,c),b.data("timepicker-list")&&i(b,b.data("timepicker-list")),this},remove:function(){var a=this;if(a.hasClass("ui-timepicker-input"))return a.removeAttr("autocomplete","off"),a.removeClass("ui-timepicker-input"),a.removeData("timepicker-settings"),a.off(".timepicker"),a.data("timepicker-list")&&a.data("timepicker-list").remove(),a.removeData("timepicker-list"),this}};a.fn.timepicker=function(b){return this.length?x[b]?x[b].apply(this,Array.prototype.slice.call(arguments,1)):"object"!=typeof b&&b?(a.error("Method "+b+" does not exist on jQuery.timepicker"),void 0):x.init.apply(this,arguments):this}});
$('#active').change(function(){
	if ($('#active').val() == 'no'){
		$('.current-activities').hide();
	} else {
		$('.current-activities').show();		
	}
});
(function( $ ) {
    $.widget( "custom.combobox", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox" )
          .insertAfter( this.element );
 
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            tooltipClass: "ui-state-highlight"
          });
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
      _createShowAllButton: function() {
        var input = this.input,
          wasOpen = false;
 
        $( "<a>" )
          .attr( "tabIndex", -1 )
          .attr( "title", "Show All Items" )
          .tooltip()
          .appendTo( this.wrapper )
          .button({
            icons: {
              primary: "ui-icon-triangle-1-s"
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "custom-combobox-toggle ui-corner-right" )
          .mousedown(function() {
            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
          })
          .click(function() {
            input.focus();
 
            // Close if already visible
            if ( wasOpen ) {
              return;
            }
 
            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
          });
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
        }) );
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title", value + " didn't match any item" )
          .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.data( "ui-autocomplete" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
  })( jQuery );
$(function() {
	$('.timepicker').timepicker();
	$('#js-JoinTeam').ajaxForm({
		target: '#js-TeamMessages'
	});
    $( ".datepicker" ).datepicker();
    $( "#sportsbox" ).combobox();
    $( "#teamssbox" ).combobox();
    $( "#toggle" ).click(function() {
      $( "#sportsbox" ).toggle();
      $( "#teamsbox" ).toggle();
    });
    $('.js-positionSelect').change(function(){
    	val = $(this).val();
    	$( ".js-stats" ).load( "sports/getStatsForPosition/" + val );   
    });
    $( ".js-wallPostAdd" ).submit(function( event ) {
    	event.preventDefault();
    	data = $('.js-wallPostAdd').serialize();
    	$.ajax({
    		url: "/teams/addWallPost",
    		type:'POST',
    		data:data})
    		.done(function( data ) {
    			$('.js-wallPostAdd, textarea').val('');
    			$('.js-teamWall').html(data);
    		}) 
    		.fail(function() {
    			alert( "error" );
    		});    	
    });
    $( ".js-eventWallPostAdd" ).submit(function( event ) {
    	event.preventDefault();
    	data = $('.js-eventWallPostAdd').serialize();
    	$.ajax({
    		url: "/event/addWallPost",
    		type:'POST',
    		data:data})
    		.done(function( data ) {
    			$('.js-eventWallPostAdd, textarea').val('');
    			$('.js-eventWall').html(data);
    		}) 
    		.fail(function() {
    			alert( "error" );
    		});    	
    });
    $( ".js-InviteFriend" ).submit(function( event ) {
    	event.preventDefault();
    	data = $('.js-InviteFriend').serialize();
    	$.ajax({
    		url: "/signin/invite",
    		type:'POST',
    		data:data})
    		.done(function( data ) {
    			$('#inviteFriendDialog, input').val('');
    			$('#inviteFriendDialog').dialog('close');
    		}) 
    		.fail(function() {
    			alert( "error" );
    		});    	
    });
    
    $('.js-emailFriend').bind('click',function(){
    	event.preventDefault();
    	$('#inviteFriendDialog').dialog({
  	      modal: true
  	    });
    });
});
function getMembers(team){
	$.ajax({
		url: "/teams/getTeamMembers/" + team ,
		type:'POST'})
		.done(function( data ) {
			$(".js-Members").html(data);
		}) 
		.fail(function() {
			alert( "error" );
	});    		
}
function acceptMember(team,member){
	event.preventDefault();
	$.ajax({
		url: "/teams/acceptMember/" + team + "/" + member,
		type:'POST'})
		.done(function( data ) {
			$(".js-MemberRequests").html(data);
			getMembers();
		}) 
		.fail(function() {
			alert( "error" );
	});    	
}
function declineMember(team,member){
	event.preventDefault();
	$.ajax({
		url: "/teams/declineMember/" + team + "/" + member,
		type:'POST'})
		.done(function( data ) {
			$(".js-MemberRequests").html(data);
		}) 
		.fail(function() {
			alert( "error" );
	});    	
}
function deletePost(team,id){
	if (confirm("Are you sure?")){
		event.preventDefault();
		$.ajax({
			url: "/teams/deleteWallPost/" + team + "/" + id,
			type:'POST'})
			.done(function( data ) {
				$(".js-teamWall").html(data);
			}) 
			.fail(function() {
				alert( "error" );
		});
	}
}
function deleteEventPost(eventId,id){
	if (confirm("Are you sure?")){
		event.preventDefault();
		$.ajax({
			url: "/event/deleteWallPost/" + eventId + "/" + id,
			type:'POST'})
			.done(function( data ) {
				$(".js-eventWall").html(data);
			}) 
			.fail(function() {
				alert( "error" );
		});
	}
}
function deleteEvent(team,event){
	if (confirm("Are you sure?")){
		$.ajax({
			url: "/teams/deleteEvent/" + event + '/'+ team,
			type:'POST'})
			.done(function( data ) {
				$('.js-Events').html(data);
			}) 
			.fail(function() {
				alert( "error" );
		});    					
	}
}
function markNotificationRead(notification){
	event.preventDefault();
	$.ajax({
		url: "/athlete/markNotificationRead/" + notification,
		type:'POST'})
		.done(function( data ) {
			$(".js-Notifications").html(data);
		}) 
		.fail(function() {
			alert( "error" );
	});    			
}
function attendEvent(eventId,user){
	event.preventDefault();
	$.ajax({
		url: "/event/attendEvent/" + eventId + '/' + user,
		type:'POST'})
		.done(function( data ) {
			$(".js-attending").html(data);
		}) 
		.fail(function() {
			alert( "error" );
	});    				
}
function removeAttendee(eventId,user){
	event.preventDefault();
	$.ajax({
		url: "/event/removeAttendee/" + eventId + '/' + user,
		type:'POST'})
		.done(function( data ) {
			$(".js-attending").html(data);
		}) 
		.fail(function() {
			alert( "error" );
	});    					
}
function getTeamWall($team){
	event.preventDefault();
	$.ajax({
		url: "/teams/getWall/" + team ,
		type:'POST'})
		.done(function( data ) {
			$(".js-teamWall").html(data);
		}) 
		.fail(function() {
			alert( "error" );
	});    		
}
function showInviteForm(){
	$('#inviteDialog').dialog({
	      modal: true
	    });
}
function sendInvites(eventId){
	event.preventDefault();
	data = $('#js-Invitations').serialize();
	$.ajax({
		url: "/event/sendInvites/" + eventId,
		data:data,		
		type:'POST'
		})
		.done(function( data ) {
			$('#inviteDialog').dialog("close");
			$("#inviteDialog").html(data);
		}) 
		.fail(function() {
			alert( "error" );
	});    		
	console.log('Here with ' + data);
}
