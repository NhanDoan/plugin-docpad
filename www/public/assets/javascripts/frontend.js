var sidebar = {
	purposeChange: function() {
		$('input[name=mortgageType').change(function() {

			if ($(this).val() == 1) {
				$('#refinance').hide();
				$('.purchase').show();
			} else {
				$('#refinance').show();
				$('.purchase').hide();
			}
		});
	}
};

var contact = {
	btnSubmit: function() {
		$('#contactForm').on('click', '.btn-get-rates', function() {
			$('.show-lender, .news').addClass('hide-important');
			$('.request-quote-container, .rates-check').show();
			$('#contactForm').modal('hide');
		});
	}
};

var lender = {
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

	sidebar.purposeChange();
	contact.btnSubmit();
	lender.btnRequest();
});