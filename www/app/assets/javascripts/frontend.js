(function(VALOAN, $) {
    'use strict;';
    VALOAN.Home = function() {
        var sefl = this,
            
            // define private functions
            urlParam = function(name) {

              var href = window.location.href,
                  results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(href);
              
              return (results === null) ? null : (results[1] || 0);
            },
            calDownPayment = function(loanAmount, percent) {

              return loanAmount*(percent/100);
            },
            purposeChange = function(sideBar) {
              var mortgageType = sideBar.find('input[name="mortgageType"]');
             
              // bind change event for purpose     
              mortgageType.bind(
                'change',
                function() {
                  displayPurchase(sideBar, $(this).val());
                }
              );
            },
            displayPurchase = function(sideBar, purpose) {
              var refinancePanel  = sideBar.find('#refinance'),
                  purchasePanel   = sideBar.find('.purchase');

              if (purpose == 'refinance') {
                refinancePanel.show();
                purchasePanel.hide();
              } else {
                refinancePanel.hide();
                purchasePanel.show();
              }
            },
            getZipCode = function(sideBar, baseUrl) {

              var spanZipCode = sideBar.find('.form-header span'),
                  txtZipCode  = sideBar.find('input.zipCode');

              // using for action click text zip code
              spanZipCode.bind(
                'click',
                function() {
                  var th    = $(this),
                      value = th.html();

                  th.remove();
                  txtZipCode
                    .focus()
                    .removeClass('hidden error-zipCode')
                    .val(value);
                }
              );

              txtZipCode.bind(
                'blur',
                function() {
                  var th      = $(this),
                      zipcode = th.val();

                  $.ajax({
                    url:  baseUrl + '/checkzip/' + zipcode,
                    type: 'get',
                    cache: false,
                    dataType: 'json',
                    beforeSend: function() {
                    },
                    success: function(data) {

                      if (data.message === "" ) {
                        
                        th.parent().append($('<span />').html(zipcode));
                        th.addClass('hidden');
                      } else
                        th.addClass('error-zipCode');
                    },
                    error: function(xhr, textStatus, thrownError) {
                        th.addClass('error-zipCode');
                    }
                  });
                }
              );
            },
            getDownPayment = function(sideBar) {
              var loanAmount  = sideBar.find('select[name="loanAmount"]'),
                  downPayment = sideBar.find('select[name="downPayment"]');

              // calculation value Down Payment
              loanAmount.bind(
                'change',
                function () {
                  var valueLoanAmount   = $(this).val(),
                      valDownPayment    = downPayment.val(),
                      downPaymentAmount = calDownPayment(valueLoanAmount, valDownPayment);

                  setDownPayment(sideBar, downPaymentAmount);
                }
              );

              downPayment.bind(
                'change',
                function () {
                  var valDownPayment    = $(this).val(),
                      valueLoanAmount   = loanAmount.val(),
                      downPaymentAmount = calDownPayment(valueLoanAmount, valDownPayment);

                  setDownPayment(sideBar, downPaymentAmount);
                });
            },
            setDownPayment = function(sideBar, val) {
              sideBar.find('input[name="downPaymentAmount"]').val('$' + val);
            },
            getRates = function(content) {
              var btnGetRates     = content.find('.btn-get-rates'),
                  lenderList      = content.find('.list-form'),
                  form            = btnGetRates.closest('form'),
                  newsList        = content.find('.news'),
                  indicatorClass  = 'indicator',
                  hiddenIndClass  = 'indicator-hidden';

              btnGetRates.bind(
                'click',
                function() {
                  $.ajax({
                    type: 'POST',
                    url: form.attr('action'),
                    data: form.serialize(),
                    beforeSend: function() {
                      btnGetRates.addClass(indicatorClass);
                      lenderList.addClass(hiddenIndClass);
                    },
                    
                    success: function(data) {
                      
                      btnGetRates.removeClass(indicatorClass);
                      lenderList.removeClass(hiddenIndClass).empty().html(data);
                      newsList.removeClass('hide');
                      requestLender();
                    },
                    error: function() {

                    }
                  });
                }
              );
            },
            contact = function(content) {
              var contacForm  = $('body').find('#contactForm'),
                  btnSubmit   = contacForm.find('.btn-get-rates');

              btnSubmit.bind(
                'click',
                function() {
                  content.find('.show-lender, .news').addClass('hide');
                  content.find('.request-quote-container').show();
                  content.find('.rates-check').addClass('display-block');
                  contacForm.modal('hide');
                }
              );
            },
            requestLender = function() {
              var lenderList = $('.list-form'),
                  btnRequest = lenderList.find('.btn-request-quote');

              btnRequest.bind(
                'click',
                function() {
                  lenderList.find('.show-lender').removeClass('hide');
                  lenderList.find('.request-quote-container, .rates-check').addClass('hide');
                }
              );
              
            },
            requestQuoteFormHidden = function(content) {
              var requestQuoteForm = $('body').find('#thankyouForm');

              requestQuoteForm.bind(
                'hidden.bs.modal',
                function (e) {
                 content.find('.show-lender, .news').addClass('hide');
                 content.find('.request-quote-container, .rates-check').removeClass('hide');
               }
              );
            };

        // define public functions
        sefl.init = function(options) {
            var sideBar = $('#formNav'),
                content = $('#content');

            purposeChange(sideBar);
            getRates(content);
            requestLender();
            getZipCode(sideBar, options.baseUrl);
            contact(content);
            getDownPayment(sideBar);
            displayPurchase(sideBar, urlParam('mortgageType'));
            requestQuoteFormHidden(content);
        };
    };


})(window.VALOAN = window.VALOAN || {}, jQuery);