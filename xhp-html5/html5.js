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