var Sidebar = {
	init: function() {
		Sidebar.purposeChange();
		Sidebar.getRates();
    Sidebar.getZipCode();
    Sidebar.getDownPayment();
	},
  calDownPayment : function (loanAmount, percent) {
      return loanAmount*(percent/100);
  },
	purposeChange: function() {
		$('input[name="mortgageType"]').change(function() {

			if ($(this).val() == 'purchase') {
				$('#refinance').hide();
				$('.purchase').show();
			} else {
				$('#refinance').show();
				$('.purchase').hide();
			}
		});
	},
  
  getZipCode:function (argument) {
    // using for action click text zip code
    $('.form-header').on('click', 'span', function() {
        var _value = $(this).html();
        $(this).remove();
        $('input.zipCode').removeClass('hidden').val(_value);
        $('input.zipCode').focus();

    });

    $('.form-header').on('blur', 'input.zipCode', function () {
      var _valInput = ($(this).val()),
        _this = $(this);
      $.ajax({
        url:  '/checkzip/' + _valInput,
        type: 'get',
        cache: false,
        dataType: 'json',
        beforeSend: function() {
        },
        success: function(data) {
          if (data.message === "" ) {
            
            _this.parent().append($('<span />').html(_valInput));
            _this.addClass('hidden');
            } else {

              _this.addClass('error-zipCode');
            }
          },
        error: function(xhr, textStatus, thrownError) {
          alert('Something went to wrong.Please Try again later...');
        }
      });
    });
  },

  getDownPayment: function (argument) {
    // calculation value Down Payment
    $('select[name="loanAmount"]').change(function () {
        var _valueLoanAmount = $(this).val(),
            _valDownPayment = $('select[name="downPayment"]').val(),

            _downPaymentAmount = Sidebar.calDownPayment(_valueLoanAmount, _valDownPayment);
        $('input[name="downPaymentAmount"]').val('$' + _downPaymentAmount);
    });

    $('select[name="downPayment"]').change(function () {
        var _valDownPayment = $(this).val(),
            _valueLoanAmount = $('select[name="loanAmount"]').val();
        
            _downPaymentAmount = Sidebar.calDownPayment(_valueLoanAmount, _valDownPayment);
        $('input[name="downPaymentAmount"]').val('$' + _downPaymentAmount);
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
			$('.request-quote-container').show();
			$('.rates-check').addClass('display-block');
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