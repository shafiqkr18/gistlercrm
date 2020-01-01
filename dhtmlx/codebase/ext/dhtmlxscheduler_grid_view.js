/*
@license
dhtmlxScheduler v.4.3.1 

This software is covered by DHTMLX Commercial License. Usage without proper license is prohibited.

(c) Dinamenta, UAB.
*/
!function(){scheduler._grid={sort_rules:{"int":function(e,t,a){return 1*a(e)<1*a(t)?1:-1},str:function(e,t,a){return a(e)<a(t)?1:-1},date:function(e,t,a){return new Date(a(e))<new Date(a(t))?1:-1}},_getObjName:function(e){return"grid_"+e},_getViewName:function(e){return e.replace(/^grid_/,"")}}}(),scheduler.createGridView=function(e){function t(e){return!(void 0!==e&&(1*e!=e||0>e))}var a=e.name||"grid",i=scheduler._grid._getObjName(a);scheduler.config[a+"_start"]=e.from||new Date(0),scheduler.config[a+"_end"]=e.to||new Date(9999,1,1),
scheduler[i]=e,scheduler[i].defPadding=8,scheduler[i].columns=scheduler[i].fields,scheduler[i].unit=e.unit||"month",scheduler[i].step=e.step||1,delete scheduler[i].fields;for(var n=scheduler[i].columns,r=0;r<n.length;r++)t(n[r].width)&&(n[r].initialWidth=n[r].width),t(n[r].paddingLeft)||delete n[r].paddingLeft,t(n[r].paddingRight)||delete n[r].paddingRight;scheduler[i].select=void 0===e.select?!0:e.select,void 0===scheduler.locale.labels[a+"_tab"]&&(scheduler.locale.labels[a+"_tab"]=scheduler[i].label||scheduler.locale.labels.grid_tab),
scheduler[i]._selected_divs=[],scheduler.date[a+"_start"]=function(t){return scheduler.date[e.unit+"_start"]?scheduler.date[e.unit+"_start"](t):t},scheduler.date["add_"+a]=function(e,t){return scheduler.date.add(e,t*scheduler[i].step,scheduler[i].unit)},scheduler.templates[a+"_date"]=function(e,t){return scheduler.templates.day_date(e)+" - "+scheduler.templates.day_date(t)},scheduler.templates[a+"_full_date"]=function(e,t,i){return scheduler.isOneDayEvent(i)?this[a+"_single_date"](e):scheduler.templates.day_date(e)+" &ndash; "+scheduler.templates.day_date(t);

},scheduler.templates[a+"_single_date"]=function(e){return scheduler.templates.day_date(e)+" "+this.event_date(e)},scheduler.templates[a+"_field"]=function(e,t){return t[e]},scheduler.attachEvent("onTemplatesReady",function(){scheduler.attachEvent("onDblClick",function(e,t){return this._mode==a?(scheduler._click.buttons.details(e),!1):!0}),scheduler.attachEvent("onClick",function(e,t){return this._mode==a&&scheduler[i].select?(scheduler._grid.unselectEvent("",a),scheduler._grid.selectEvent(e,a,t),
!1):!0});var e=scheduler.render_data;scheduler.render_data=function(t){return this._mode!=a?e.apply(this,arguments):void scheduler._grid._fill_grid_tab(i)};var t=scheduler.render_view_data;scheduler.render_view_data=function(){var e=scheduler._els.dhx_cal_data[0].lastChild;return this._mode==a&&e&&(scheduler._grid._gridScrollTop=e.scrollTop),t.apply(this,arguments)}}),scheduler[a+"_view"]=function(e){if(scheduler._grid._sort_marker=null,delete scheduler._gridView,scheduler._grid._gridScrollTop=0,
scheduler._rendered=[],scheduler[i]._selected_divs=[],e){var t=null,n=null,r=scheduler[i];r.paging?(t=scheduler.date[a+"_start"](new Date(scheduler._date)),n=scheduler.date["add_"+a](t,1)):(t=scheduler.config[a+"_start"],n=scheduler.config[a+"_end"]),scheduler._min_date=t,scheduler._max_date=n,scheduler._grid.set_full_view(i);var l="";+t>+new Date(0)&&+n<+new Date(9999,1,1)&&(l=scheduler.templates[a+"_date"](t,n)),scheduler._els.dhx_cal_date[0].innerHTML=l,scheduler._gridView=i}}},scheduler.dblclick_dhx_grid_area=function(){
!this.config.readonly&&this.config.dblclick_create&&this.addEventNow()},scheduler._click.dhx_cal_header&&(scheduler._old_header_click=scheduler._click.dhx_cal_header),scheduler._click.dhx_cal_header=function(e){if(scheduler._gridView){var t=e||window.event,a=scheduler._grid.get_sort_params(t,scheduler._gridView);scheduler._grid.draw_sort_marker(t.originalTarget||t.srcElement,a.dir),scheduler.clear_view(),scheduler._grid._fill_grid_tab(scheduler._gridView,a)}else if(scheduler._old_header_click)return scheduler._old_header_click.apply(this,arguments);

},scheduler._grid.selectEvent=function(e,t,a){if(scheduler.callEvent("onBeforeRowSelect",[e,a])){var i=scheduler._grid._getObjName(t);scheduler.for_rendered(e,function(e){e.className+=" dhx_grid_event_selected",scheduler[i]._selected_divs.push(e)}),scheduler._select_id=e}},scheduler._grid._unselectDiv=function(e){e.className=e.className.replace(/ dhx_grid_event_selected/,"")},scheduler._grid.unselectEvent=function(e,t){var a=scheduler._grid._getObjName(t);if(a&&scheduler[a]._selected_divs)if(e){for(var i=0;i<scheduler[a]._selected_divs.length;i++)if(scheduler[a]._selected_divs[i].getAttribute("event_id")==e){
scheduler._grid._unselectDiv(scheduler[a]._selected_divs[i]),scheduler[a]._selected_divs.slice(i,1);break}}else{for(var i=0;i<scheduler[a]._selected_divs.length;i++)scheduler._grid._unselectDiv(scheduler[a]._selected_divs[i]);scheduler[a]._selected_divs=[]}},scheduler._grid.get_sort_params=function(e,t){var a=e.originalTarget||e.srcElement,i="desc";"dhx_grid_view_sort"==a.className&&(a=a.parentNode),a.className&&-1!=a.className.indexOf("dhx_grid_sort_asc")||(i="asc");for(var n=0,r=0;r<a.parentNode.childNodes.length;r++)if(a.parentNode.childNodes[r]==a){
n=r;break}var l=null;if(scheduler[t].columns[n].template){var d=scheduler[t].columns[n].template;l=function(e){return d(e.start_date,e.end_date,e)}}else{var o=scheduler[t].columns[n].id;"date"==o&&(o="start_date"),l=function(e){return e[o]}}var s=scheduler[t].columns[n].sort;return"function"!=typeof s&&(s=scheduler._grid.sort_rules[s]||scheduler._grid.sort_rules.str),{dir:i,value:l,rule:s}},scheduler._grid.draw_sort_marker=function(e,t){"dhx_grid_view_sort"==e.className&&(e=e.parentNode),scheduler._grid._sort_marker&&(scheduler._grid._sort_marker.className=scheduler._grid._sort_marker.className.replace(/( )?dhx_grid_sort_(asc|desc)/,""),
scheduler._grid._sort_marker.removeChild(scheduler._grid._sort_marker.lastChild)),e.className+=" dhx_grid_sort_"+t,scheduler._grid._sort_marker=e;var a="<div class='dhx_grid_view_sort' style='left:"+(+e.style.width.replace("px","")-15+e.offsetLeft)+"px'>&nbsp;</div>";e.innerHTML+=a},scheduler._grid.sort_grid=function(e){var e=e||{dir:"desc",value:function(e){return e.start_date},rule:scheduler._grid.sort_rules.date},t=scheduler.get_visible_events();return t.sort("desc"==e.dir?function(t,a){return e.rule(t,a,e.value);

}:function(t,a){return-e.rule(t,a,e.value)}),t},scheduler._grid.set_full_view=function(e){if(e){var t=(scheduler.locale.labels,scheduler._grid._print_grid_header(e));scheduler._els.dhx_cal_header[0].innerHTML=t,scheduler._table_view=!0,scheduler.set_sizes()}},scheduler._grid._calcPadding=function(e,t){var a=(void 0!==e.paddingLeft?1*e.paddingLeft:scheduler[t].defPadding)+(void 0!==e.paddingRight?1*e.paddingRight:scheduler[t].defPadding);return a},scheduler._grid._getStyles=function(e,t){for(var a=[],i="",n=0;t[n];n++)switch(i=t[n]+":",
t[n]){case"text-align":e.align&&a.push(i+e.align);break;case"vertical-align":e.valign&&a.push(i+e.valign);break;case"padding-left":void 0!==e.paddingLeft&&a.push(i+(e.paddingLeft||"0")+"px");break;case"padding-right":void 0!==e.paddingRight&&a.push(i+(e.paddingRight||"0")+"px")}return a},scheduler._grid._fill_grid_tab=function(e,t){for(var a=(scheduler._date,scheduler._grid.sort_grid(t)),i=scheduler[e].columns,n="<div>",r=-2,l=0;l<i.length;l++){var d=scheduler._grid._calcPadding(i[l],e);r+=i[l].width+d,
l<i.length-1&&(n+="<div class='dhx_grid_v_border' style='left:"+r+"px'></div>")}n+="</div>",n+="<div class='dhx_grid_area'><table>";for(var l=0;l<a.length;l++)n+=scheduler._grid._print_event_row(a[l],e);n+="</table></div>",scheduler._els.dhx_cal_data[0].innerHTML=n,scheduler._els.dhx_cal_data[0].lastChild.scrollTop=scheduler._grid._gridScrollTop||0;var o=scheduler._els.dhx_cal_data[0].getElementsByTagName("tr");scheduler._rendered=[];for(var l=0;l<o.length;l++)scheduler._rendered[l]=o[l]},scheduler._grid._print_event_row=function(e,t){
var a=[];e.color&&a.push("background:"+e.color),e.textColor&&a.push("color:"+e.textColor),e._text_style&&a.push(e._text_style),scheduler[t].rowHeight&&a.push("height:"+scheduler[t].rowHeight+"px");var i="";a.length&&(i="style='"+a.join(";")+"'");for(var n=scheduler[t].columns,r=scheduler.templates.event_class(e.start_date,e.end_date,e),l="<tr class='dhx_grid_event"+(r?" "+r:"")+"' event_id='"+e.id+"' "+i+">",d=scheduler._grid._getViewName(t),o=["text-align","vertical-align","padding-left","padding-right"],s=0;s<n.length;s++){
var _;_=n[s].template?n[s].template(e.start_date,e.end_date,e):"date"==n[s].id?scheduler.templates[d+"_full_date"](e.start_date,e.end_date,e):"start_date"==n[s].id||"end_date"==n[s].id?scheduler.templates[d+"_single_date"](e[n[s].id]):scheduler.templates[d+"_field"](n[s].id,e);var c=scheduler._grid._getStyles(n[s],o),u=n[s].css?' class="'+n[s].css+'"':"";l+="<td style='width:"+n[s].width+"px;"+c.join(";")+"' "+u+">"+_+"</td>"}return l+="<td class='dhx_grid_dummy'></td></tr>"},scheduler._grid._print_grid_header=function(e){
for(var t="<div class='dhx_grid_line'>",a=scheduler[e].columns,i=[],n=a.length,r=scheduler._obj.clientWidth-2*a.length-20,l=0;l<a.length;l++){var d=1*a[l].initialWidth;isNaN(d)||""===a[l].initialWidth||null===a[l].initialWidth||"boolean"==typeof a[l].initialWidth?i[l]=null:(n--,r-=d,i[l]=d)}for(var o=Math.floor(r/n),s=["text-align","padding-left","padding-right"],_=0;_<a.length;_++){var c=i[_]?i[_]:o;a[_].width=c-scheduler._grid._calcPadding(a[_],e);var u=scheduler._grid._getStyles(a[_],s);t+="<div style='width:"+(a[_].width-1)+"px;"+u.join(";")+"'>"+(void 0===a[_].label?a[_].id:a[_].label)+"</div>";

}return t+="</div>"};
//# sourceMappingURL=../sources/ext/dhtmlxscheduler_grid_view.js.map