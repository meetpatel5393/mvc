var  Base = function(){

};
Base.prototype = {
	url : null,
	params : {},
	method : 'post',

	setUrl : function(url){
		this.url = url;
		return this;
	},
	getUrl : function(){
		return this.url;
	},
	setMethod : function(method){
		this.method = method;
		return this;
	},
	getMethod : function(){
		return this.method;
	},
	resetParams : function(){
		this.params = {};
		return this;
	},
	setParams : function(params){
		this.params = params;
		return this;
	},
	getParams : function(key){
		if(typeof key === 'undefined'){
			return this.params;
		}
		if(typeof this.params[key] == 'undefined'){
			return null;
		}
		return this.params[key];
	},
	addParam : function(key,value){
		this.params[key] = value;
		return this;
	},
	removeParam : function(key){
		if(typeof this.params[key] != 'undefined') {

			delete this.params[key];
		}
		return this;
	},
	load : function(){
		self = this;
		var request = $.ajax({
		  method: this.getMethod(),
		  url: this.getUrl(),
		  data: this.getParams(),
		  success: function(response){
		  	self.manageHtml(response);
		  }
		});
	},
	manageHtml : function(response){
		if(typeof response.element == 'undefined'){
			return false;
		}
		if(typeof response.element == 'object'){
			$.each(response.element, function(i, element){
		  		$(element.selector).html(element.html);
		  	})
		} else {
			$(response.element.selector).html(response.element.html);
		}
	},
	setForm : function(){
		formId = '#'+$('form').attr('id');
		this.setParams($(formId).serializeArray());
		this.setUrl($(formId).attr('action'));
		this.setMethod($(formId).attr('method'));
		return this;
	},
	upload : function(id){
		var fd = new FormData();
  		var files = $('#file')[0].files;
  		fd.append('file',files[0]);
  		fd.append('btnAction',id);

  		formId = '#'+$('form').attr('id');
		this.setParams(fd);
		this.setMethod($(formId).attr('method'));

		var request = $.ajax({
		  method: this.getMethod(),
		  url: this.getUrl(),
		  data: this.getParams(),
		  contentType: false,
          processData: false,
		  success: function(response){
		  	$.each(response.element, function(i, element){
		  		$(element.selector).html(element.html);
		  	});
		  }
		});		
	},
	update : function(id){
		formId = '#'+$('form').attr('id');
		this.setParams($(formId).serializeArray());
		this.setUrl($(formId).attr('action'));
		this.setMethod($(formId).attr('method'));
		param1 = {
			name : 'btnAction',
			value : id
		};
		this.addParam(this.getParams().length,param1);
		return this;
	},
	remove : function(obj){
		$(obj).parent().parent().remove();
	},
	addOption : function(){
		newTr = $('#newOption').children().children().clone();
		$('#existingOption').prepend(newTr);
	},
	setCmsPage : function(){
		formId = '#'+$('form').attr('id');
		cmsContent = CKEDITOR.instances['cms[content]'].getData();
		
		this.setParams($(formId).serializeArray());
		this.setUrl($(formId).attr('action'));
		this.setMethod($(formId).attr('method'));
		
		$.each(this.params, function(i,val){
			if (val['name'] == 'cms[content]') {
				val['value'] = cmsContent;
			}
		});
		return this;
	}
}