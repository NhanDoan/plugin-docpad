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
              var payment = sideBar.find('input[name="payment"]');
             
              // bind change event for purpose     
              payment.bind(
                'change',
                function() {
                  displayPurchase(sideBar, $(this).val());
                }
              );
            },

            displayPurchase = function(sideBar, purpose) {
              var refinancePanel  = sideBar.find('#refinance'),
                  purchasePanel   = sideBar.find('.purchase');

              if (purpose == 'refinance' ) {
                refinancePanel.show();
                purchasePanel.hide();
              } else {
                refinancePanel.hide();
                purchasePanel.show();
              }
            },

            getZipCode = function(sideBar) {

              var spanZipCode = sideBar.find('.form-header span'),
                  txtZipCode  = sideBar.find('input.zipCode');

              // using for action click text zip code
              spanZipCode.bind(
                'click',
                function() {
                  var th    = $(this),
                      value = th.html();

                  th.addClass('hidden');
                  txtZipCode
                    .removeClass('hidden')
                    .val(value)
                    .focus();
                }
              );

              txtZipCode.bind(
                'blur',
                function() {
                  var th      = $(this),
                      zipcode = th.val();
                  th.parent().find('span').html(zipcode).removeClass('hidden');
                  th.addClass('hidden');
                }
              );
            },

            checkZipCode = function(form) {
              var zipCode = form.find('input[name="zipCode"]'),
                  valZipCode = zipCode.val();

              if (valZipCode.length < 5 || isNaN(valZipCode)) {
                zipCode
                  .removeClass('hidden')
                  .addClass('error-zipCode')
                  .val(valZipCode);
                form.find('.form-header span')
                  .addClass('hidden');
                return false;
              } else {
                zipCode
                  .addClass('hidden')
                  .removeClass('error-zipCode');
                form.find('.form-header span')
                  .removeClass('hidden')
                  .html(valZipCode);
                return true;
              }
            },
            cashChange = function (sideBar) {
              var radioCash = sideBar.find('input[name="cash"]');

              radioCash.bind('change', function () {
                  getCashOut(sideBar, $(this).val());
              });
            },

            getCashOut = function (sideBar, valCash) {
              var cashInput = sideBar.find('input[name="additionalCashOutAmount"]'),
                  valCashInput = cashInput.val();
              if (valCash == "0") {
                cashInput.attr('disabled', false);
                cashInput.on('keyup', function (argument) {
                  var sanitized = $(this).val().replace(/[^0-9.]/g, ''),
                      _sanitized = sanitized.replace(/\.(?=.*\.)/, ''),
                      value = _sanitized.replace(/^0+/,"");
                  $(this).val(value);
                })
                .on('change', function() {
                  $(this).currency();
                });
              } else {
                cashInput.attr('disabled', true);
              }
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
              sideBar.find('input[name="downPaymentAmount"]').val(val).currency();
            },
            getRates = function(content) {
              var btnGetRates     = content.find('.btn-get-rates'),
                  lenderList      = content.find('.list-form'),
                  form            = btnGetRates.closest('form'),
                  newsList        = content.find('.news'),
                  indicatorClass  = 'indicator',
                  hiddenIndClass  = 'indicator-hidden',
                  zipCode         = form.find('input[name="zipCode"]').val(),
                  isError         = false;

              btnGetRates.bind(
                'click',
                function() {
                  var _checkZipCode = checkZipCode(form);

                  if (_checkZipCode && !btnGetRates.hasClass(indicatorClass)) {
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
                }
              );
            },

            resetForm = function () {
              $('#contactForm').on('show.bs.modal', function() {
                $('#infoContactForm').bootstrapValidator('resetForm', true);
              });
            },
            contact = function(content) {
              resetForm();

              var contacForm  = $('body').find('#contactForm'),
                  btnSubmit   = contacForm.find('.btn-get-rates');
               $('#infoContactForm').bootstrapValidator({
                  message: 'This value is not valid',
                  feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                  },
                  live: 'enabled',
                  excluded: [':disabled', ':hidden'],
                  // submitButtons: '.btn-get-rates',
                  trigger: 'change blur',
                  fields: {
                    firstname: {
                      validators: {
                        notEmpty: {
                          message: 'The firstname is required and cannot be empty'
                        },
                        stringLength: {
                          min: 5,
                          max: 30,
                          message: 'The firstname must be more than 6 and less than 30 characters long'
                        },
                        regexp: {
                          regexp: /^[a-zA-Z0-9_]+$/,
                          message: 'The firstname can only consist of alphabetical, number and underscore'
                        }
                      }
                    },
                    lastname: {
                      validators: {
                        notEmpty: {
                            message: 'The lastname is required'
                        }
                      }
                    },
                    email: {
                      validators: {
                        notEmpty: {
                          message: 'The email address is required and can\'t be empty'
                        },
                        emailAddress: {
                          message: 'The input is not a valid email address'
                        }
                      }
                    },
                    phone: {
                      validators: {
                        notEmpty: {
                          message: 'The phone is request and cannot empty'
                        },
                        country: 'US',
                        regexp: {
                          regexp: /([0-9\s\-]{7,})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$/,
                          message: 'Pls enter input correct'
                        }
                      }
                    },
                    agree_auto: {
                      validators: {
                        notEmpty: {
                          message: 'You must be agree to the Auto Dialer Disclosure'
                        }
                      }
                    },
                    address: {
                      validators: {
                        notEmpty: {
                          message: 'The address is required and can\'t be empty'
                        }
                      }
                    },
                    city: {
                      validators: {
                        notEmpty: {
                          message: 'The city is required and can\'t be empty'
                        }
                      }
                    },
                    agree_terms: {
                      validators: {
                        notEmpty: {
                          message: 'You must be agree with the Terms of Service'
                        }
                      }
                    },
                  },
              });
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
            },
            getNews = function(action, section) {
              var indicatorClass  = 'indicator',
                  rssHeader = section.prev().find('.pull-right');

              $.ajax({
                type: 'GET',
                url: action,
                beforeSend: function() {
                  rssHeader.addClass(indicatorClass);
                },
                success: function(data) {
                  section.empty().html(data);
                  rssHeader.removeClass(indicatorClass);
                },
                error: function() {
                }
              });
            };

        // define public functions
        sefl.init = function(options) {
            var sideBar = $('#formNav'),
                content = $('#content');
            getCashOut(sideBar, 0);
            cashChange(sideBar);
            purposeChange(sideBar);
            getRates(content);
            requestLender();
            getZipCode(sideBar);
            contact(content);
            getDownPayment(sideBar);
            displayPurchase(sideBar, urlParam('payment'));
            requestQuoteFormHidden(content);
            getNews(options.baseUrl + '/getValoanNews', $('.valoan-news'));
            getNews(options.baseUrl + '/getVeteranNews', $('.veteran-news'));

        };
    };


})(window.VALOAN = window.VALOAN || {}, jQuery);