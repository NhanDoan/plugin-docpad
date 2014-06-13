@extends('layouts.master')

@section('content')
	<section class="list-form">
    <ul>
      <li>
        <div class="row">
          <div class="col-md-4 rates">
            <span class="rates-check m-r-lg">
              <input name="ratescheck" type="checkbox" value=""/>
            </span>3.725<span>%APR</span></div>
          <div class="col-md-3">
            <div class="clearfix">30 year fixed</div>
            <div class="clearfix">3.325 % Rate - $2,372/mo</div>
            <div class="clearfix">$4,000 closing cost</div>
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
                {{ HTML::image('assets/images/lender/bnc-bank-logo.png', '', ['class' => 'img-responsive m-r-lg']) }}
              </span>
              <a href="#thankyouForm" data-toggle="modal">
                <span class="btn-request-quote">Request Quote</span>
              </a>
            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="row">
          <div class="col-md-4 rates">
            <span class="rates-check m-r-lg">
              <input name="ratescheck" type="checkbox" value=""/>
            </span>3.728<span>%APR</span></div>
          <div class="col-md-3">
            <div class="clearfix">30 year fixed</div>
            <div class="clearfix">3.325 % Rate - $2,527/mo</div>
            <div class="clearfix">$5,000 closing cost</div>
          </div>
          <div class="col-md-5 text-right">
            <a href="#contactForm" data-toggle="modal" class="show-lender">
              <div class="container-btn-show-lender">
                <div class="btn-show-lender-text">Show Lender</div>
                <div class="btn-show-lender-img">
                  <div class="btn-curve"></div>E
                </div>
              </div>
            </a>
            <div class="request-quote-container">
              <span class="lender-img-container text-center">
                {{ HTML::image('assets/images/lender/state-bank-logo.png', '', ['class' => 'img-responsive m-r-lg']) }}
              </span>
              <a href="#thankyouForm" data-toggle="modal">
                <span class="btn-request-quote">Request Quote</span>
              </a>
            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="row">
          <div class="col-md-4 rates">
            <span class="rates-check m-r-lg">
              <input name="ratescheck" type="checkbox" value=""/>
            </span>3.732<span>%APR</span></div>
          <div class="col-md-3">
            <div class="clearfix">30 year fixed</div>
            <div class="clearfix">3.732 % Rate - $2,602/mo</div>
            <div class="clearfix">$5,000 closing cost</div>
          </div>
          <div class="col-md-5 text-right">
            <a href="#contactForm" data-toggle="modal" class="show-lender">
              <div class="container-btn-show-lender">
                <div class="btn-show-lender-text">Show Lender</div>
                <div class="btn-show-lender-img">
                  <div class="btn-curve"></div>C
                </div>
              </div>
            </a>
            <div class="request-quote-container">
              <span class="lender-img-container text-center">
                {{ HTML::image('assets/images/lender/national-bank-logo.png', '', ['class' => 'img-responsive m-r-lg']) }}
              </span>
              <a href="#thankyouForm" data-toggle="modal">
                <span class="btn-request-quote">Request Quote</span>
              </a>
            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="row">
          <div class="col-md-4 rates">
            <span class="rates-check m-r-lg">
              <input name="ratescheck" type="checkbox" value=""/>
            </span>3.732<span>%APR</span></div>
          <div class="col-md-3">
            <div class="clearfix">30 year fixed</div>
            <div class="clearfix">3.732 % Rate - $2,614/mo</div>
            <div class="clearfix">$5,000 closing cost</div>
          </div>
          <div class="col-md-5 text-right">
            <a href="#contactForm" data-toggle="modal" class="show-lender">
              <div class="container-btn-show-lender">
                <div class="btn-show-lender-text">Show Lender</div>
                <div class="btn-show-lender-img">
                  <div class="btn-curve"></div>L
                </div>
              </div>
            </a>
            <div class="request-quote-container">
              <span class="lender-img-container text-center">
                {{ HTML::image('assets/images/lender/nas-bank-logo.png', '', ['class' => 'img-responsive m-r-lg']) }}
              </span>
              <a href="#thankyouForm" data-toggle="modal">
                <span class="btn-request-quote">Request Quote</span>
              </a>
            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="row">
          <div class="col-md-4 rates">
            <span class="rates-check m-r-lg">
              <input name="ratescheck" type="checkbox" value=""/>
            </span>3.732<span>%APR</span></div>
          <div class="col-md-3">
            <div class="clearfix">30 year fixed</div>
            <div class="clearfix">3.732 % Rate - $2,702/mo</div>
            <div class="clearfix">$5,000 closing cost</div>
          </div>
          <div class="col-md-5 text-right">
            <a href="#contactForm" data-toggle="modal" class="show-lender">
              <div class="container-btn-show-lender">
                <div class="btn-show-lender-text">Show Lender</div>
                <div class="btn-show-lender-img">
                  <div class="btn-curve"></div>S
                </div>
              </div>
            </a>
            <div class="request-quote-container">
              <span class="lender-img-container text-center">
                {{ HTML::image('assets/images/lender/first-choice-logo.png', '', ['class' => 'img-responsive m-r-lg']) }}
              </span>
              <a href="#thankyouForm" data-toggle="modal">
                <span class="btn-request-quote">Request Quote</span>
              </a>
            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="row">
          <div class="col-md-4 rates">
            <span class="rates-check m-r-lg">
              <input name="ratescheck" type="checkbox" value=""/>
            </span>3.736<span>%APR</span></div>
          <div class="col-md-3">
            <div class="clearfix">30 year fixed</div>
            <div class="clearfix">3.732 % Rate - $2,702/mo</div>
            <div class="clearfix">$5,000 closing cost</div>
          </div>
          <div class="col-md-5 text-right">
            <a href="#contactForm" data-toggle="modal" class="show-lender">
              <div class="container-btn-show-lender">
                <div class="btn-show-lender-text">Show Lender</div>
                <div class="btn-show-lender-img">
                  <div class="btn-curve"></div>S
                </div>
              </div>
            </a>
            <div class="request-quote-container">
              <span class="lender-img-container text-center">
                {{ HTML::image('assets/images/lender/first-choice-logo.png', '', ['class' => 'img-responsive m-r-lg']) }}
              </span>
              <a href="#thankyouForm" data-toggle="modal">
                <span class="btn-request-quote">Request Quote</span>
              </a>
            </div>
          </div>
        </div>
      </li>
      <li>
        <div class="text-right">
          <div class="request-quote-container">
            <a href="#thankyouForm" data-toggle="modal">
              <span class="btn-request-quote">Request Multiple Quotes</span>
            </a>
          </div>
        </div>
      </li>
    </ul>
  </section>
@stop


@section('news')
	@include('site.partials._sidebar-image')
	@include('site.partials._news')
@stop

<!-- include signup form modal -->
@include('site.partials._signup-form')
<!-- include request quote model -->
@include('site.partials._thank-form')
