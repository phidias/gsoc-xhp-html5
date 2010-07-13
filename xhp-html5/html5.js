if (typeof xhp_html5 == "undefined") {

xhp_html5 = true;

xhp_Input = function(id, options) {
	
	var input = document.getElementById(id);
	
	if (options.placeholder) {
	
		var default_color = input.style.color;
		var color = 'gray';
		
		if (input.value === '' || input.value == options.placeholder) {
		    input.value = options.placeholder;
		    input.style.color = color;
		}
		
		var onfocus = function() {
			if (input.value == options.placeholder && input.style.color == color) {
				input.value = '';
				input.style.color = default_color;
			}
		};
		
		var onblur = function() {
			if (input.value == '') {
				input.value = options.placeholder;
				input.style.color=color;
			}
		};
		
		$(input).focus(onfocus);
		$(input).blur(onblur);
		
		input.form && $(input.form).submit(function() {
			if (input.value == options.placeholder && input.style.color == color) {
				input.value = '';
			}
			input.form.submit();
		});
		
	}
};

xhp_Fieldset = function(id,options) {
	
	if (options.disabled == '1') {
		//disable the input elements that are not inside the legend
		$("#"+id).children(":not(legend)").find("*").attr("disabled","disabled");
	}
};

xhp_A = function(id,options) {
	var clicked = false;
	if (options.ping) {
		$("#"+id).click(function() {
			urls = options.ping.split(" ");
			jQuery.each(urls,function(index,value) {
				$.ajax({async:false,url:value});
			});
			return true;
		});
	}
};

}