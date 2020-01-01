/*
@license
dhtmlxScheduler v.4.3.1 

This software is covered by DHTMLX Commercial License. Usage without proper license is prohibited.

(c) Dinamenta, UAB.
*/
(function(){

	function backup(obj){
		var t = function(){};
		t.prototype = obj;
		return t;
	}

	var old = scheduler._load;
	scheduler._load=function(url,from){
		url=url||this._load_url;
		if (typeof url == "object"){
			var t = backup(this._loaded);
			for (var i=0; i < url.length; i++) {
				this._loaded=new t();
				old.call(this,url[i],from);
			}
		} else 
			old.apply(this,arguments);
	};
	
})();