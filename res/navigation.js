var pn = 0;
var ps = 30;
var lp = 0;
(function ($) {
	$.fn.extend({
		validate: function(options) {
			settings = $.extend({
	            title: 'Required fields:',
	        }, options);
			var isvalid = true;
			var errmsg = "";
			$('.required').each(function() {
				if($(this).val() == '') {
					isvalid = false;
					var msg = $(this).attr('id');
					$(this).parent().addClass("is-invalid");
				} else {
					$(this).parent().removeClass('is-invalid');
				}
			});
			$('.type-email').each(function() {
				if ($(this).val() == '' && !$(this).hasClass('required')) return;
				if (!CheckEmail($(this).val())) {
					isvalid = false;
					$(this).parent().addClass("is-invalid");
				} else
					$(this).parent().removeClass('is-invalid');
			});
			$('.type-date').each(function() {
				if ($(this).val() == '' && $(this).hasClass('required')) return;
				if (!parseDate($(this).val())) {
					isvalid = false;
					$(this).parent().addClass("is-invalid");
				} else
					$(this).parent().removeClass('is-invalid');
			});
			return isvalid;

			function CheckEmail(em) {
				var isemail = true
				var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
				if(!expr.test(em)) {
					isemail = false
				}
				return isemail;
			}
			function parseDate(dt) {
				if (dt == '') return true;
				var isDate = true
				var expr = /^(\d{2})\.(\d{2})\.(\d{4})$/;
				if(!expr.test(dt)) {
					isDate = false
				}
				return isDate;
			}
		}
	});
	$.fn.extend({
		resetError: function(options) {
			settings = $.extend({
	            format: ''
	        }, options);
			$('.required').each(function() {
				$(this).parent().removeClass('is-invalid');
			});
			$('.type-email').each(function() {
				$(this).parent().removeClass('is-invalid');
			});
			$('.type-date').each(function() {
				$(this).parent().removeClass('is-invalid');
			});
		}
	});
	$.fn.extend({
		nbutton: function(options) {
			var defaults = {
	            after: function() {}
	        }
	        options = $.extend(defaults,options);
	        $('#first-link').click( function() {
				MovePage('first');
			});
			$('#prev-link').click( function() {
				MovePage('prev');
			});
			$('#next-link').click( function() {
				MovePage('next');
			});
			$('#last-link').click( function() {
				MovePage('last');
			});
			function MovePage(d) {
				var rsize = $('.listview .list-item').length;
				var callFunc = true;
				switch(d) {
					case 'first':
						pn = 0;
						break;
					case 'prev':
						if(pn != 0) pn--;
						break;
					case 'next':
						if(rsize < ps)
							callFunc = false;
						if (pn+1 > lp) 
							callFunc = false;
						if (pn+1 < lp)
							pn++;
						break;
					case 'last':
						pn = lp - 1 ;
						break;
				}
				if(typeof options.after == "function") {
					if (callFunc) options.after($(this));
				}
			}
		}
	});
	$.fn.extend({
		updatenav: function() {
			if($('.listview .list-item') != null) {
				var trec = $('#totrec').val();
				lp = Math.ceil(parseInt(trec)/ps);
			}
			$('#npctr').html((pn+1) + '/' + lp);
		}
	});
	$.fn.extend({
		disable: function() {
			$(this).attr("disabled", "disabled");
		}
	});
	$.fn.extend({
		enable: function() {
			$(this).removeAttr("disabled");
		}
	});
})(jQuery);
