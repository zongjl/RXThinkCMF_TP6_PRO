!function(t){var e={};function n(a){if(e[a])return e[a].exports;var i=e[a]={i:a,l:!1,exports:{}};return t[a].call(i.exports,i,i.exports,n),i.l=!0,i.exports}n.m=t,n.c=e,n.d=function(t,e,a){n.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:a})},n.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},n.t=function(t,e){if(1&e&&(t=n(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var a=Object.create(null);if(n.r(a),Object.defineProperty(a,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var i in t)n.d(a,i,function(e){return t[e]}.bind(null,i));return a},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="",n(n.s=6)}({6:function(t,e){layui.define(["form","layer","table","common","treeTable"],(function(t){var e,n,a,i,r,o=layui.form,c=layui.table,l=layui.layer,u=layui.common,d=layui.treeTable,f=layui.$,s=0,h=0,b={tableIns:function(t,o,d=null,b="",p=!1){n=o,a=d,b&&""!=b||(b=cUrl+"/index");var m=f("#param").val();if(m&&(m=JSON.parse(m),f.isArray(m)))for(var y in m)b.indexOf("?")>=0?b+="&"+m[y]:b+="?"+m[y];return e=c.render({elem:"#"+n,url:b,method:"post",cellMinWidth:150,page:{layout:["refresh","prev","page","next","skip","count","limit"],curr:1,groups:10,first:"首页",last:"尾页"},height:"full-100",limit:20,limits:[20,30,40,50,60,70,80,90,100,150,200,1e3],even:!0,cols:[t],loading:!0,done:function(t,e,n){if(r){var a=f(".layui-table-body").find("table").find("tbody");a.children("tr").on("dblclick",(function(){var e=a.find(".layui-table-hover").data("index"),n=t.data[e];u.edit(i,n.id,s,h)}))}}}),c.on("toolbar("+n+")",(function(t){var e=c.checkStatus(t.config.id);switch(t.event){case"getCheckData":var n=e.data;l.alert(JSON.stringify(n));break;case"getCheckLength":n=e.data;l.msg("选中了："+n.length+" 个");break;case"isAll":l.msg(e.isAll?"全选":"未全选")}})),c.on("tool("+n+")",(function(t){var e=t.data,n=t.event;"edit"===n?u.edit(i,e.id,s,h):"detail"===n?u.detail(i,e.id,s,h):"del"===n?u.drop(e.id,(function(e,n){n&&t.del()})):"cache"===n?u.cache(e.id):"copy"===n?u.copy(i,e.id,s,h):a&&a(n,e)})),c.on("checkbox("+n+")",(function(t){console.log(t.checked),console.log(t.data),console.log(t.type)})),c.on("edit("+n+")",(function(t){var e=t.value,n=t.data,a=t.field,i={};i.id=n.id,i[a]=e;var r=JSON.stringify(i),o=JSON.parse(r),c=cUrl+"/update";u.ajaxPost(c,o,(function(t,e){}),"更新中...")})),c.on("row("+n+")",(function(t){t.tr.addClass("layui-table-click").siblings().removeClass("layui-table-click");t.data})),p&&c.on("sort("+n+")",(function(t){c.reload(n,{initSort:t,where:{field:t.field,order:t.type}})})),this},treetable:function(t=[],e,a=!0,r=0,o="",c=null,b=""){n=e,b||(b=cUrl+"/index");var p=d.render({elem:"#"+e,url:b,method:"POST",height:"full-50",cellMinWidth:80,tree:{iconIndex:1,idName:"id",pidName:o||"pid",isPidData:!0},cols:[t],done:function(t,e,n){l.closeAll("loading")},style:"margin-top:0;"});d.on("tool("+e+")",(function(t){var e=t.data,n=t.event,a=e.id;"addz"===n?u.edit(i,0,s,h,["pid="+a]):"edit"===n?u.edit(i,a,s,h):"del"===n?u.drop(a,(function(e,n){n&&t.del()})):c&&c(n,a,0)})),f("#collapse").on("click",(function(){return p.foldAll(),!1})),f("#expand").on("click",(function(){return p.expandAll(),!1})),f("#refresh").on("click",(function(){return p.refresh(),!1})),f("#search").click((function(){var t=f("#keywords").val();return t?p.filterData(t):p.clearFilter(),!1}))},setWin:function(t,e=0,n=0){return i=t,s=e,h=n,this},setDbclick:function(t){return r=t||!0,this},searchForm:function(t,e){o.on("submit("+t+")",(function(t){return u.searchForm(c,t,e),!1}))},getCheckData:function(t){return t||(t=n),c.checkStatus(t).data},initDate:function(t,e=null){u.initDate(t,(function(t,n){e&&e(t,n)}))},showWin:function(t,e,n=0,a=0,i=[],r=2,o=[],c=null){u.showWin(t,e,n,a,i,r,o,(function(t,e){c&&c(t,e)}))},ajaxPost:function(t,e,n=null,a="处理中..."){u.ajaxPost(t,e,n,a)},formSwitch:function(t,e="",n=null){u.formSwitch(t,e,(function(t,e){n&&n(t,e)}))},uploadFile:function(t,e=null,n="",a="xls|xlsx",i=10240,r={}){u.uploadFile(t,(function(t,n){e&&e(t,n)}),n,a,i,r)}};u.verify(),o.on("submit(submitForm)",(function(t){var e=[],n=[],a=t.field;return f.each(a,(function(t,a){if(/\[|\]|【|】/g.test(t)){var i=t.match(/\[(.+?)\]/g);a=t.match("\\[(.+?)\\]")[1];var r=t.replace(i,"");f.inArray(r,e)<0&&e.push(r),n[r]||(n[r]=[]),n[r].push(a)}})),f.each(e,(function(t,e){var i=[];f.each(n[e],(function(t,n){i.push(n),delete a[e+"["+n+"]"]})),a[e]=i.join(",")})),u.submitForm(a),!1})),o.on("submit(searchForm)",(function(t){return u.searchForm(c,t),!1})),f(".btnOption").click((function(){var t=f(this).attr("data-param");t&&(t=JSON.parse(t));var a=b.getCheckData(n),r=f(this).attr("lay-event");switch(r){case"add":u.edit(i,0,s,h,t);break;case"batchDrop":(o={title:"批量删除"}).url=cUrl+"/batchDrop",o.data=a,o.confirm=!0,u.batchFunc(o,(function(){e.reload()}));break;case"batchCache":(o={title:"批量重置缓存"}).url=cUrl+"/batchCache",o.data=a,o.confirm=!0,u.batchFunc(o,(function(){e.reload()}));break;case"batchEnable":(o={title:"批量启用状态"}).url=cUrl+"/batchStatus",o.param=t,o.data=a,o.form="submitForm",o.confirm=!0,o.show_tips="处理中...",u.batchFunc(o,(function(){e.reload()}));break;case"batchDisable":var o;(o={title:"批量禁用状态"}).url=cUrl+"/batchStatus",o.param=t,o.data=a,o.confirm=!0,u.batchFunc(o,(function(){e.reload()}));break;case"export":l.msg("导出"),location.href=cUrl+"/btn"+r.substring(0,1).toUpperCase()+r.substring(1);break;case"import":u.uploadFile("import",(function(t,e){}))}})),window.formClose=function(){var t=parent.layer.getFrameIndex(window.name);parent.layer.close(t)},t("function",b)}))}});