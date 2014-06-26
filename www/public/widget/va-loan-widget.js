(function() {
    var jQuery;
    var serverAddress;
    var timeoutId, options, container;

    if (!window.VaLoanWidget) window.VaLoanWidget = {};
    VaLoanWidget.Widget = function(opts) {
        options = opts;
        container = options.container ? options.container : '#vaLoanWidget';
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

    function main() {
        jQuery(document).ready(function() {
            jQuery('head').append('<link href="' + serverAddress + '/widget/vendor/cleanslate.css" rel="stylesheet" type="text/css">');
            jQuery('head').append('<link href="' + serverAddress + '/widget/va-loan-widget.css" rel="stylesheet" type="text/css">');

            if (jQuery(container).size() === 0) {
                jQuery('body').append('<div id="vaLoanWidget"></div>');
            }
            jQuery(container).addClass('cleanslate');

            render();
        });
    }

    function render() {
        // build the widget
        var markup = [
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
            '<input name="zipCode" placeholder="Enter zip code, e.g. 10036" />',
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
        jQuery(container).append(markup.join(''));

    }

})();