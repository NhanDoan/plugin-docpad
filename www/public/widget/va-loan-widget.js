(function() {
    var jQuery;
    var serverAddress;
    var timeoutId, options, container = [], type;

    if (!window.VaLoanWidget) window.VaLoanWidget = {};
    VaLoanWidget.Widget = function(opts) {
        options = opts;
        type = options.type ? options.type : 'large';
        
        if (type === 'all') {
            container.push('#vaLoanWidgetSmall');
            container.push('#vaLoanWidget');
        } else if (type === 'small')
            container.push('#vaLoanWidgetSmall');
        else
            container.push('#vaLoanWidget');

        serverAddress = options.serverAddress ? options.serverAddress : 'https://stripes.valoancaptain.com';
        init();
    };

    function init() {
        if (window.jQuery === undefined || window.jQuery.fn.jquery !== '1.9.1') {
            //console.log('we need to load jQuery');
            var script_tag = document.createElement('script');
            script_tag.setAttribute("type", "text/javascript");
            script_tag.setAttribute("src", "https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js");
            (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag);
            if (script_tag.attachEvent) {
                //console.log('oh cool, this is IE');
                script_tag.onreadystatechange = function() { // for IE
                    if (this.readyState == 'complete' || this.readyState == 'loaded') {
                        this.onreadystatechange = null;
                        scriptLoadHandler();
                    }
                };
            } else {
                script_tag.onload = scriptLoadHandler;
            }
        } else {
            jQuery = window.jQuery;
            //console.log('jQuery already exists on page');
            main();
        }
    }

    function scriptLoadHandler() {
        jQuery = window.jQuery.noConflict();
        //console.log('jQuery is now loaded');
        main();
    }

    function validateZipCode() {
        var btnGetRates = jQuery('.btn-get-rates'),
            container, containerId, txtZipCode,
            valZipCode  = '';
        
        btnGetRates.bind(
            'click',
            function(e) {
                container   = jQuery(this).closest('.cleanslate');
                containerId = jQuery('#' + container.attr('id'));
                txtZipCode  = containerId.find('input[name="zipCode"]');
                valZipCode  = txtZipCode.val();

                if (valZipCode.length < 5 || isNaN(valZipCode)) {
                    txtZipCode.addClass('error');
                    return false;
                } else {
                   txtZipCode.removeClass('error');
                }
            }
        );
    }

    function main() {
        jQuery(document).ready(function() {
            jQuery('head').append('<link href="' + serverAddress + '/widget/vendor/cleanslate.css" rel="stylesheet" type="text/css">');
            jQuery('head').append('<link href="' + serverAddress + '/widget/va-loan-widget.css" rel="stylesheet" type="text/css">');

            jQuery.each(container, function(index, val) {
                if (jQuery(val).size() === 0) {
                    jQuery('body').append('<div id="' + val.substring(1, val.length) + '"></div>');
                }
                jQuery(val).addClass('cleanslate');
            });
            
            render();
            validateZipCode();
        });
    }

    function render() {
        
        // build the widget
        var markupSmall = [],
            markupLarge = [];
        
            markupSmall = [
                '<div class="va-loan-box">',
                '<div class="va-loan-header">',
                '<h4>VA Loan Center</h4>',
                '<div class="desc">Get Real Time Pricing on VA Loans</div>',
                '</div>',
                '<form method="GET" action="' + serverAddress + '">',
                '<div class="va-loan-body">',
                '<div class="form-group">',
                '<span>',
                '<input checked="checked" id="rdo-purchase" name="payment" type="radio" value="purchase" />&nbsp;',
                '<label for="rdo-purchase" class="reset-label">Purchase</label>',
                '</span>',
                '<span>',
                '<input id="rdo-refinance" name="payment" type="radio" value="refinance">&nbsp;',
                '<label for="rdo-refinance" class="reset-label">Refinance</label>',
                '</span>',
                '</div>',
                '<div class="form-group">',
                '<input name="zipCode" maxlength="5" placeholder="Enter zip code, e.g. 10036" type="text" />',
                '</div>',
                '<div class="form-group">',
                '<button class="btn-get-rates">Get Rates Now</button>',
                '</div>',
                '</div>',
                '</form>',
                '<div class="va-loan-footer">',
                '<div class="pull-left">',
                'Powered by',
                '<span class="logo"></span>',
                '</div>',
                '</div>',

                '</div>'
            ];

        markupLarge = [
                '<h3>VA Loan Center</h3>',
                '<div class="va-loan-box">',
                '<form method="GET" action="' + serverAddress + '">',
                '<div class="va-loan-header">',
                '<div class="pull-left">',
                '<h2>VA Loan Center</h2>',
                '<div class="desc">Get Real Time Pricing on VA Loans</div>',
                '</div>',
                '<div class="pull-right">',
                '<div class="icon-home"></div>',
                '</div>',
                '<div class="line"></div>',
                '<div class="form-container">',
                'I\'m looking to',
                '<span>',
                '<select name="payment">',
                '<option value="purchase">Purchase</option>',
                '<option value="refinance">Refinance</option>',
                '</select>',
                '</span>',
                '<span>in</span>',
                '<span>',
                '<input name="zipCode" type="text" maxlength="5" placeholder="Enter zip code, e.g. 10036" />',
                '</span>',
                '</div>',
                '</div>',
                '<div class="va-loan-footer">',
                '<div class="pull-left">',
                'Powered by',
                '<span class="logo"></span>',
                '</div>',
                '<div class="pull-right">',
                '<button class="btn-get-rates">Get Rates Now</button>',
                '</div>',
                '</div>',
                '</form>',
                '</div>'
            ];

        if (type === 'small')
            jQuery(container[0]).append(markupSmall.join(''));
        else if (type === 'large')
            jQuery(container[0]).append(markupLarge.join(''));
        else {
            jQuery(container[0]).append(markupSmall.join(''));
            jQuery(container[1]).append(markupLarge.join(''));
        }
    }

})();