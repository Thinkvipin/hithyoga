/**handles:wplink**/
/*! This file is auto-generated */
!function(c,h,u){var r,e,t,n,i,l=/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,63}$/i,o=/^(https?|ftp):\/\/[A-Z0-9.-]+\.[A-Z]{2,63}[^ "]*$/i,p={},a={},s="ontouchend"in document;function d(){return r?r.$('a[data-wplink-edit="true"]'):null}window.wpLink={timeToTriggerRiver:150,minRiverAJAXDuration:200,riverBottomThreshold:5,keySensitivity:100,lastSearch:"",textarea:"",modalOpen:!1,init:function(){p.wrap=c("#wp-link-wrap"),p.dialog=c("#wp-link"),p.backdrop=c("#wp-link-backdrop"),p.submit=c("#wp-link-submit"),p.close=c("#wp-link-close"),p.text=c("#wp-link-text"),p.url=c("#wp-link-url"),p.nonce=c("#_ajax_linking_nonce"),p.openInNewTab=c("#wp-link-target"),p.search=c("#wp-link-search"),a.search=new t(c("#search-results")),a.recent=new t(c("#most-recent-results")),a.elements=p.dialog.find(".query-results"),p.queryNotice=c("#query-notice-message"),p.queryNoticeTextDefault=p.queryNotice.find(".query-notice-default"),p.queryNoticeTextHint=p.queryNotice.find(".query-notice-hint"),p.dialog.keydown(wpLink.keydown),p.dialog.keyup(wpLink.keyup),p.submit.click(function(e){e.preventDefault(),wpLink.update()}),p.close.add(p.backdrop).add("#wp-link-cancel button").click(function(e){e.preventDefault(),wpLink.close()}),a.elements.on("river-select",wpLink.updateFields),p.search.on("focus.wplink",function(){p.queryNoticeTextDefault.hide(),p.queryNoticeTextHint.removeClass("screen-reader-text").show()}).on("blur.wplink",function(){p.queryNoticeTextDefault.show(),p.queryNoticeTextHint.addClass("screen-reader-text").hide()}),p.search.on("keyup input",function(){window.clearTimeout(e),e=window.setTimeout(function(){wpLink.searchInternalLinks()},500)}),p.url.on("paste",function(){setTimeout(wpLink.correctURL,0)}),p.url.on("blur",wpLink.correctURL)},correctURL:function(){var e=c.trim(p.url.val());e&&i!==e&&!/^(?:[a-z]+:|#|\?|\.|\/)/.test(e)&&(p.url.val("http://"+e),i=e)},open:function(e,t,n){var i,a=c(document.body);a.addClass("modal-open"),wpLink.modalOpen=!0,wpLink.range=null,e&&(window.wpActiveEditor=e),window.wpActiveEditor&&(this.textarea=c("#"+window.wpActiveEditor).get(0),void 0!==window.tinymce&&(a.append(p.backdrop,p.wrap),i=window.tinymce.get(window.wpActiveEditor),r=i&&!i.isHidden()?i:null),!wpLink.isMCE()&&document.selection&&(this.textarea.focus(),this.range=document.selection.createRange()),p.wrap.show(),p.backdrop.show(),wpLink.refresh(t,n),c(document).trigger("wplink-open",p.wrap))},isMCE:function(){return r&&!r.isHidden()},refresh:function(e,t){a.search.refresh(),a.recent.refresh(),wpLink.isMCE()?wpLink.mceRefresh(e,t):(p.wrap.hasClass("has-text-field")||p.wrap.addClass("has-text-field"),document.selection?document.selection.createRange().text:void 0!==this.textarea.selectionStart&&this.textarea.selectionStart!==this.textarea.selectionEnd&&(t=this.textarea.value.substring(this.textarea.selectionStart,this.textarea.selectionEnd)||t||""),p.text.val(t),wpLink.setDefaultValues()),s?p.url.focus().blur():window.setTimeout(function(){p.url[0].select(),p.url.focus()}),a.recent.ul.children().length||a.recent.ajax(),i=p.url.val().replace(/^http:\/\//,"")},hasSelectedText:function(e){var t,n,i,a=r.selection.getContent();if(/</.test(a)&&(!/^<a [^>]+>[^<]+<\/a>$/.test(a)||-1===a.indexOf("href=")))return!1;if(e.length){if(!(n=e[0].childNodes)||!n.length)return!1;for(i=n.length-1;0<=i;i--)if(3!=(t=n[i]).nodeType&&!window.tinymce.dom.BookmarkManager.isBookmarkNode(t))return!1}return!0},mceRefresh:function(e,t){var n,i,a=d(),s=this.hasSelectedText(a);a.length?(n=a.text(),i=a.attr("href"),c.trim(n)||(n=t||""),e&&(o.test(e)||l.test(e))&&(i=e),"_wp_link_placeholder"!==i?(p.url.val(i),p.openInNewTab.prop("checked","_blank"===a.attr("target")),p.submit.val(h.update)):this.setDefaultValues(n),e&&e!==i?p.search.val(e):p.search.val(""),window.setTimeout(function(){wpLink.searchInternalLinks()})):(n=r.selection.getContent({format:"text"})||t||"",this.setDefaultValues(n)),s?(p.text.val(n),p.wrap.addClass("has-text-field")):(p.text.val(""),p.wrap.removeClass("has-text-field"))},close:function(e){c(document.body).removeClass("modal-open"),wpLink.modalOpen=!1,"noReset"!==e&&(wpLink.isMCE()?(r.plugins.wplink&&r.plugins.wplink.close(),r.focus()):(wpLink.textarea.focus(),wpLink.range&&(wpLink.range.moveToBookmark(wpLink.range.getBookmark()),wpLink.range.select()))),p.backdrop.hide(),p.wrap.hide(),i=!1,c(document).trigger("wplink-close",p.wrap)},getAttrs:function(){return wpLink.correctURL(),{href:c.trim(p.url.val()),target:p.openInNewTab.prop("checked")?"_blank":null}},buildHtml:function(e){var t='<a href="'+e.href+'"';return e.target&&(t+=' rel="noopener" target="'+e.target+'"'),t+">"},update:function(){wpLink.isMCE()?wpLink.mceUpdate():wpLink.htmlUpdate()},htmlUpdate:function(){var e,t,n,i,a,s,r,l=wpLink.textarea;if(l){e=wpLink.getAttrs(),t=p.text.val();var o=document.createElement("a");o.href=e.href,"javascript:"!==o.protocol&&"data:"!==o.protocol||(e.href=""),e.href&&(n=wpLink.buildHtml(e),document.selection&&wpLink.range?(l.focus(),wpLink.range.text=n+(t||wpLink.range.text)+"</a>",wpLink.range.moveToBookmark(wpLink.range.getBookmark()),wpLink.range.select(),wpLink.range=null):void 0!==l.selectionStart&&(i=l.selectionStart,a=l.selectionEnd,s=i+(n=n+(r=t||l.value.substring(i,a))+"</a>").length,i!==a||r||(s-=4),l.value=l.value.substring(0,i)+n+l.value.substring(a,l.value.length),l.selectionStart=l.selectionEnd=s),wpLink.close(),l.focus(),c(l).trigger("change"),u.a11y.speak(h.linkInserted))}},mceUpdate:function(){var e,t,n,i=wpLink.getAttrs(),a=document.createElement("a");if(a.href=i.href,"javascript:"!==a.protocol&&"data:"!==a.protocol||(i.href=""),!i.href)return r.execCommand("unlink"),void wpLink.close();e=d(),r.undoManager.transact(function(){e.length||(r.execCommand("mceInsertLink",!1,{href:"_wp_link_placeholder","data-wp-temp-link":1}),e=r.$('a[data-wp-temp-link="1"]').removeAttr("data-wp-temp-link"),n=c.trim(e.text())),e.length?(p.wrap.hasClass("has-text-field")&&((t=p.text.val())?e.text(t):n||e.text(i.href)),i["data-wplink-edit"]=null,i["data-mce-href"]=i.href,e.attr(i)):r.execCommand("unlink")}),wpLink.close("noReset"),r.focus(),e.length&&(r.selection.select(e[0]),r.plugins.wplink&&r.plugins.wplink.checkLink(e[0])),r.nodeChanged(),u.a11y.speak(h.linkInserted)},updateFields:function(e,t){p.url.val(t.children(".item-permalink").val()),p.wrap.hasClass("has-text-field")&&!p.text.val()&&p.text.val(t.children(".item-title").text())},getUrlFromSelection:function(e){return e||(this.isMCE()?e=r.selection.getContent({format:"text"}):document.selection&&wpLink.range?e=wpLink.range.text:void 0!==this.textarea.selectionStart&&(e=this.textarea.value.substring(this.textarea.selectionStart,this.textarea.selectionEnd))),(e=c.trim(e))&&l.test(e)?"mailto:"+e:e&&o.test(e)?e.replace(/&amp;|&#0?38;/gi,"&"):""},setDefaultValues:function(e){p.url.val(this.getUrlFromSelection(e)),p.search.val(""),wpLink.searchInternalLinks(),p.submit.val(h.save)},searchInternalLinks:function(){var e,t=p.search.val()||"",n=parseInt(h.minInputLength,10)||3;if(t.length>=n){if(a.recent.hide(),a.search.show(),wpLink.lastSearch==t)return;wpLink.lastSearch=t,e=p.search.parent().find(".spinner").addClass("is-active"),a.search.change(t),a.search.ajax(function(){e.removeClass("is-active")})}else a.search.hide(),a.recent.show()},next:function(){a.search.next(),a.recent.next()},prev:function(){a.search.prev(),a.recent.prev()},keydown:function(e){var t,n;27===e.keyCode?(wpLink.close(),e.stopImmediatePropagation()):9===e.keyCode&&("wp-link-submit"!==(n=e.target.id)||e.shiftKey?"wp-link-close"===n&&e.shiftKey&&(p.submit.focus(),e.preventDefault()):(p.close.focus(),e.preventDefault())),e.shiftKey||38!==e.keyCode&&40!==e.keyCode||document.activeElement&&("link-title-field"===document.activeElement.id||"url-field"===document.activeElement.id)||(t=38===e.keyCode?"prev":"next",clearInterval(wpLink.keyInterval),wpLink[t](),wpLink.keyInterval=setInterval(wpLink[t],wpLink.keySensitivity),e.preventDefault())},keyup:function(e){38!==e.keyCode&&40!==e.keyCode||(clearInterval(wpLink.keyInterval),e.preventDefault())},delayedCallback:function(e,t){var n,i,a,s;return t?(setTimeout(function(){if(i)return e.apply(s,a);n=!0},t),function(){if(n)return e.apply(this,arguments);a=arguments,s=this,i=!0}):e}},t=function(e,t){var n=this;this.element=e,this.ul=e.children("ul"),this.contentHeight=e.children("#link-selector-height"),this.waiting=e.find(".river-waiting"),this.change(t),this.refresh(),c("#wp-link .query-results, #wp-link #link-selector").scroll(function(){n.maybeLoad()}),e.on("click","li",function(e){n.select(c(this),e)})},c.extend(t.prototype,{refresh:function(){this.deselect(),this.visible=this.element.is(":visible")},show:function(){this.visible||(this.deselect(),this.element.show(),this.visible=!0)},hide:function(){this.element.hide(),this.visible=!1},select:function(e,t){var n,i,a,s;e.hasClass("unselectable")||e==this.selected||(this.deselect(),this.selected=e.addClass("selected"),n=e.outerHeight(),i=this.element.height(),a=e.position().top,s=this.element.scrollTop(),a<0?this.element.scrollTop(s+a):i<a+n&&this.element.scrollTop(s+a-i+n),this.element.trigger("river-select",[e,t,this]))},deselect:function(){this.selected&&this.selected.removeClass("selected"),this.selected=!1},prev:function(){var e;this.visible&&this.selected&&(e=this.selected.prev("li")).length&&this.select(e)},next:function(){if(this.visible){var e=this.selected?this.selected.next("li"):c("li:not(.unselectable):first",this.element);e.length&&this.select(e)}},ajax:function(n){var i=this,e=1==this.query.page?0:wpLink.minRiverAJAXDuration,t=wpLink.delayedCallback(function(e,t){i.process(e,t),n&&n(e,t)},e);this.query.ajax(t)},change:function(e){this.query&&this._search==e||(this._search=e,this.query=new n(e),this.element.scrollTop(0))},process:function(e,t){var n="",i=!0,a="",s=1==t.page;e?c.each(e,function(){a=i?"alternate":"",a+=this.title?"":" no-title",n+=a?'<li class="'+a+'">':"<li>",n+='<input type="hidden" class="item-permalink" value="'+this.permalink+'" />',n+='<span class="item-title">',n+=this.title?this.title:h.noTitle,n+='</span><span class="item-info">'+this.info+"</span></li>",i=!i}):s&&(n+='<li class="unselectable no-matches-found"><span class="item-title"><em>'+h.noMatchesFound+"</em></span></li>"),this.ul[s?"html":"append"](n)},maybeLoad:function(){var n=this,i=this.element,e=i.scrollTop()+i.height();!this.query.ready()||e<this.contentHeight.height()-wpLink.riverBottomThreshold||setTimeout(function(){var e=i.scrollTop(),t=e+i.height();!n.query.ready()||t<n.contentHeight.height()-wpLink.riverBottomThreshold||(n.waiting.addClass("is-active"),i.scrollTop(e+n.waiting.outerHeight()),n.ajax(function(){n.waiting.removeClass("is-active")}))},wpLink.timeToTriggerRiver)}}),n=function(e){this.page=1,this.allLoaded=!1,this.querying=!1,this.search=e},c.extend(n.prototype,{ready:function(){return!(this.querying||this.allLoaded)},ajax:function(t){var n=this,i={action:"wp-link-ajax",page:this.page,_ajax_linking_nonce:p.nonce.val()};this.search&&(i.search=this.search),this.querying=!0,c.post(window.ajaxurl,i,function(e){n.page++,n.querying=!1,n.allLoaded=!e,t(e,i)},"json")}}),c(document).ready(wpLink.init)}(jQuery,window.wpLinkL10n,window.wp);