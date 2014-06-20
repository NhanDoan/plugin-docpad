var Sidebar = {
	init: function() {
		Sidebar.purposeChange();
		Sidebar.getRates();
	},

	purposeChange: function() {
		$('input[name="mortgageType"]').change(function() {

			if ($(this).val() == 1) {
				$('#refinance').hide();
				$('.purchase').show();
			} else {
				$('#refinance').show();
				$('.purchase').hide();
			}
		});
	},

	getRates: function() {
		$('#formNav').on('click', '.btn-get-rates', function() {
			var form = $(this).closest('form');

			$.ajax({
				type: 'POST',
				url: form.attr('action'),
				data: form.serialize(),
				beforeSend: function() {
					$.blockUI({ css: {
            border: 'none',
            padding: '15px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: 0.5,
            color: '#fff'
        } });
				},
				
				success: function(data) {
					$.unblockUI();
					$('.list-form').empty().html(data);
					$('.news').removeClass('hide-important');
					Lender.btnRequest();
				},
				error: function() {

				}
			});
			
		});
	}
};

var Contact = {
	btnSubmit: function() {
		$('#contactForm').on('click', '.btn-get-rates', function() {

			$('.show-lender, .news').addClass('hide-important');
			$('.request-quote-container, .rates-check').show();
			$('#contactForm').modal('hide');
		});
	}
};

var Lender = {
	btnRequest: function() {
		$('.request-quote-container').on('click', '.btn-request-quote', function() {
			$('.show-lender').removeClass('hide-important');
			$('.request-quote-container, .rates-check').addClass('hide-important');
		});
	}
};

$(function() {
	$('#thankyouForm').on('hidden.bs.modal', function (e) {
		$('.show-lender, .news').addClass('hide-important');
		$('.request-quote-container, .rates-check').removeClass('hide-important');
	});

	Sidebar.init();
	Contact.btnSubmit();
	Lender.btnRequest();
});