<ul>
  @if (!empty ($results) )
    @foreach( $results as $lender )
      <li>
        <div class="row">
          <div class="col-md-4 rates">
            <span class="rates-check m-r-lg">
              <input name="ratescheck" type="checkbox" value=""/>
            </span>{{ $lender['apr'] }}<span>%APR</span></div>
          <div class="col-md-3">
            <div class="clearfix">{{ str_replace('Yr', 'Year', $lender['consumerProductName']) }}</div>
            <div class="clearfix">{{ $lender['noteRate'] }} % Rate - {{ Helpers::money($lender['monthlyPayment']['totalMonthlyPayment']) }}/mo</div>
            <div class="clearfix">{{ Helpers::money($lender['settlementDetails']['cashToClose']) }} closing cost</div>
          </div>
          <div class="col-md-5 text-right">
            <a href="#contactForm" data-toggle="modal" class="show-lender">
              <div class="container-btn-show-lender">
                <div class="btn-show-lender-text">Show Lender</div>
                <div class="btn-show-lender-img">
                  <div class="btn-curve"></div>K
                </div>
              </div>
            </a>
            <div class="request-quote-container">
              <span class="lender-img-container text-center">
                {{ HTML::image('assets/images/lender/' . $lender['customerId'] .'.png', '', ['class' => 'img-responsive m-r-lg']) }}
                @if ($lender['customerId'] === '05harb01')
                  <div class="sponsored">Sponsored Lender</div>
                @endif
              </span>
              <a href="#thankyouForm" data-toggle="modal">
                <span class="btn-request-quote">Request Quote</span>
              </a>
            </div>
          </div>
        </div>
      </li>
    @endforeach
    <li>
      <div class="text-right">
        <div class="request-quote-container">
          <a href="#thankyouForm" data-toggle="modal">
            <span class="btn-request-quote">Request Multiple Quotes</span>
          </a>
        </div>
      </div>
    </li>
  @endif
</ul>