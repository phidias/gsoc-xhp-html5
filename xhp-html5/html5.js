if (typeof xhp_html5 == "undefined") {

	xhp_html5 = true;
	
	xhp_a = function(id,options) {
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
	
	xhp_area = xhp_a;
	
	xhp_fieldset = function(id,options) {
		if (options.disabled) {
			//disable the input elements that are not inside the legend
			$("#"+id).children(":not(legend)").find("*").attr("disabled","disabled");
		}
	};
	
	xhp_form = function(id,options) {
		
		var form = document.getElementById(id);
		
		if (options.novalidate) {
			form.xhp_novalidate = options.novalidate;
		}
		
	}
	
	xhp_input = function(id, options) {
		
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
		
		if (options.autofocus) {
			input.focus();
		}
		
		if (options.required && input.form) {
			$(input.form).submit(function(event) {
				if (input.form.xhp_novalidate)
					return true;
				
				if (input.value == '') {
					input.focus();
					return false;
				} else {
					return true;
				}
			});
		}
		
	};

	xhp_button = xhp_input;

	xhp_select = xhp_input;
	
	xhp_textarea = xhp_input;
}