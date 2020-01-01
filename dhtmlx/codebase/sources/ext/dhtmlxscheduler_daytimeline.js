/*
@license
dhtmlxScheduler v.4.3.1 

This software is covered by DHTMLX Commercial License. Usage without proper license is prohibited.

(c) Dinamenta, UAB.
*/
(function(){

	var old_timeline = scheduler.createTimelineView;

	scheduler.createTimelineView = function (config) {
		if(config.render != 'days'){
			old_timeline.apply(this, arguments);
			return;
		}

		var name = config.name;

		var property = config.y_property = "timeline-week" + name;
		config.y_unit = [];
		config.render = "bar";
		config.days = config.days || 7;

		old_timeline.call(this, config);

		scheduler.templates[name + "_scalex_class"] = function(){};
		scheduler.templates[name + "_scaley_class"] = function(){};
		scheduler.templates[name+"_scale_label"] = function(section_id, section_label, section_options){
			return scheduler.templates.day_date(section_label);
		};

		scheduler.date[name + "_start"] = function (date) {
			date = scheduler.date.week_start(date);
			date = scheduler.date.add(date, config.x_step*config.x_start, config.x_unit);
			return date;
		};
		scheduler.date["add_" + name] = function (date, inc) {
			return scheduler.date.add(date, inc*config.days, "day");
		};

		function initSections(){
			var date = new Date(scheduler.getState().date);
			var ds = scheduler.date[name + "_start"](date);

			ds = scheduler.date.date_part(ds);

			var list = [];
			var obj = scheduler.matrix[name];
			obj.y_unit = list;
			obj.order = {};

			for (var i = 0; i < config.days; i++) {
				list.push({ key: +ds, label: ds });

				obj.order[obj.y_unit[i].key] = i;
				ds = scheduler.date.add(ds, 1, "day");
			}
		}
		var renderMatrix = scheduler._renderMatrix;
		scheduler._renderMatrix = function(mode, refresh){
			if(mode){
				initSections();
			}
			renderMatrix.apply(this, arguments);
		};

		//copy all properties(not only hasOwnProperty)
		function copy_values(ev) {
			var res = {};
			for (var i in ev)
				res[i] = ev[i];
			return res;
		}
		//ignore fake section id in week view
		var oldCollision = scheduler.checkCollision;
		scheduler.checkCollision = function (ev) {
			if (ev[property]) {
				var ev = copy_values(ev);
				delete ev[property];
			}
			return oldCollision.apply(scheduler, [ev]);
		};


		scheduler.attachEvent("onBeforeDrag", function (id, drag_mode, e) {
			var trg = e.target || e.srcElement;
			var className = (trg.className || "");
			if (drag_mode == 'resize') {
				if (className.indexOf("dhx_event_resize_end") < 0) {
					scheduler._w_line_drag_from_start = true;
				} else {
					scheduler._w_line_drag_from_start = false;
				}
			}else if(drag_mode == 'move'){
				if (className.indexOf("no_drag_move") >= 0) {
					return false;
				}
			}

			return true;
		});
		var old_mouse = scheduler["mouse_" + name];
		scheduler["mouse_" + name] = function (pos) {
			var move_delta;
				if(this._drag_event)
				move_delta = this._drag_event._move_delta;

			if(move_delta === undefined && scheduler._drag_mode == "move"){
				var obj = scheduler.matrix[this._mode];
				var pos_copy = {y : pos.y};
				scheduler._resolve_timeline_section(obj, pos_copy);
				var x = pos.x - obj.dx;

				var end_date = new Date(pos_copy.section);
				set_time_part(scheduler._timeline_drag_date(obj, x), end_date);
				var drag_event = scheduler._drag_event;

				var ev = this.getEvent(this._drag_id);
				drag_event._move_delta = (ev.start_date-end_date)/60000;
				if (this.config.preserve_length && pos._ignores){
					drag_event._move_delta = this._get_real_event_length(ev.start_date,end_date, obj);
					drag_event._event_length = this._get_real_event_length(ev.start_date,ev.end_date, obj);
				}
			}

			var pos = old_mouse.apply(scheduler, arguments);
			if (scheduler._drag_mode && scheduler._drag_mode != "move") {

				var dat = null;
				if (scheduler._drag_event && scheduler._drag_event['timeline-week' + name]) {
					dat = new Date(scheduler._drag_event['timeline-week' + name]);
				} else {
					dat = new Date(pos.section);
				}

				pos.y += Math.round((dat - scheduler.date.date_part(new Date(scheduler._min_date))) / (1000 * 60 * this.config.time_step));

				if (scheduler._drag_mode == "resize") {

					pos.resize_from_start = scheduler._w_line_drag_from_start;

				}
			} else {
				if (scheduler._drag_event) {
					var days_y = Math.floor(Math.abs(pos.y / (24 * 60 / scheduler.config.time_step)));
					days_y *= pos.y > 0 ? 1 : -1;
					pos.y = pos.y % (24 * 60 / scheduler.config.time_step);
					var st_date = scheduler.date.date_part(new Date(scheduler._min_date));
					if (st_date.valueOf() != new Date(pos.section).valueOf()) {
						pos.x = Math.floor((pos.section - st_date) / (24 * 60 * 60000));
						pos.x += days_y;
					}
				}
			}
			return pos;
		};

		scheduler.attachEvent("onEventCreated", function (id, e) {
			if (scheduler._events[id]) {
				delete scheduler._events[id][property];//section of week-timeline is generated during rendering. storing it with data-items causes side-effects in collision ext
			}
			return true;
		});
		scheduler.attachEvent("onBeforeEventChanged", function (ev, e, flag, ev_old) {
			if (scheduler._events[ev.id]) {
				delete scheduler._events[ev.id][property];//section of week-timeline is generated during rendering. storing it with data-items causes side-effects in collision ext
			}
			return true;
		});

		var oldRender = scheduler.render_view_data;
		scheduler.render_view_data = function (evs, hold) {
			if (this._mode == name) {
				if (evs) {
					evs = week_line_dates(evs);
				}
			}
			return oldRender.apply(scheduler, [evs, hold]);
		};
		var old_get_evs = scheduler.get_visible_events;
		scheduler.get_visible_events = function () {
			if (this._mode == name) {
				scheduler._max_date = scheduler.date.date_part(scheduler.date.add(scheduler._min_date, config.days, "day"));
				var evs = old_get_evs.apply(scheduler, arguments);
				return week_line_dates(evs);
			}
			return old_get_evs.apply(scheduler, arguments);
		};

		var old_add_event_now = scheduler.addEventNow;
		scheduler.addEventNow = function (event) {
			if (scheduler.getState().mode == name) {
				if (event[property]) {
					var dat = new Date(event[property]);
					set_date_part(dat, event.start_date);
					set_date_part(dat, event.end_date);

				} else {
					var date = new Date(event.start_date);
					event[property] = +scheduler.date.date_part(date);
				}
			}


			return old_add_event_now.apply(scheduler, arguments);
		};

		function set_date_part(source, target) {
			target.setFullYear(source.getFullYear());
			target.setMonth(source.getMonth());
			target.setDate(source.getDate());
		}

		function week_line_dates(evs) {
			var res = [];
			for (var i =0; i < evs.length; i++) {
				var ev = copy_timeline_event(evs[i]);
				if(!scheduler.isOneDayEvent(ev)){

					var to = new Date(Math.min(+ev.end_date, +scheduler._max_date)),
						from = new Date(Math.max(+ev.start_date, +scheduler._min_date));

					var multiday_chunks = [];
					while(+from < +to){
						var chunk = copy_timeline_event(ev);
						chunk.start_date = from;
						chunk.end_date = new Date(Math.min(+get_next_day(chunk.start_date), +to));
						from = get_next_day(from);
						week_line_ev_date(chunk);
						res.push(chunk);
						multiday_chunks.push(chunk);
					}

					set_resize_options(multiday_chunks, ev);
				}else{
					week_line_ev_date(ev);
					res.push(ev);
				}


			}
			return res;
		}

		function set_resize_options(chunks, original){
			var first = false;
			var last = false;
			for(var i = 0, len = chunks.length; i < len; i++){
				var chunk = chunks[i];
				first = +chunk._w_start_date == +original.start_date;
				last =  +chunk._w_end_date == +original.end_date;

				chunk._no_resize_start = chunk._no_resize_end = true;

				if(first){
					chunk._no_resize_start = false;
				}
				if(last)
					chunk._no_resize_end = false;
			}
		}

		function copy_timeline_event(ev){
			var par = scheduler.getEvent(ev.event_pid);
			if (par && par.isPrototypeOf(ev)) {
				ev = scheduler._copy_event(ev);
				delete ev.event_length;
				delete ev.event_pid;
				delete ev.rec_pattern;
				delete ev.rec_type;
			} else {
				ev = scheduler._lame_clone(ev);
			}
			return ev;
		}
		function week_line_ev_date(ev) {
			if (ev._w_start_date && ev._w_end_date) {
				return;
			}
			var date = scheduler.date,
				start = ev._w_start_date = new Date(ev.start_date),
				end = ev._w_end_date = new Date(ev.end_date);
			ev[property] = +date.date_part(ev.start_date);

			if (!ev._count)
				ev._count = 1;
			if (!ev._sorder)
				ev._sorder = 0;

			var duration = end - start;
			ev.start_date = new Date(scheduler._min_date);
			set_time_part(start, ev.start_date);
			ev.end_date = new Date(+ev.start_date + duration);
			//set_time_part(end, ev.end_date);
		}

		function set_time_part(source, target) {
			target.setMinutes(source.getMinutes());
			target.setHours(source.getHours());
		}
		function get_next_day(date){
			var next_day = scheduler.date.add(date, 1, "day");
			next_day = scheduler.date.date_part(next_day);
			return next_day;
		}

		var old_render_marked_timespan = scheduler._render_marked_timespan;
		scheduler._render_marked_timespan = function() {
			if (scheduler._mode == name) {
				return;
			}
			return old_render_marked_timespan.apply(this, arguments);
		};
	};

})();