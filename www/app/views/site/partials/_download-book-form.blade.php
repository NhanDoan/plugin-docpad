<div id="downloadBookForm" aria-hidden="true" aria-labelledby="myModalLabel" data-backdrop="true" role="dialog" tabindex="-1" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button aria-hidden="true" data-dismiss="modal" type="button" class="close"></button>
        <h5>Download a FREE copy of</h3>
        <h3>The Ultimate Guide to VA Loans</h3>
        <div class="value">a value of $16.95</div>
      </div>
      <div class="modal-body">
        {{ Form::open(array('id'=> 'infoDownloadBookForm', 'class'=> 'form-horizontal')) }}
          <div id="step1">
            <div class="row m-t-lg">
              <div class="col-md-6 form-group">
                <div class="clearfix">
                  <label for="firstname">First name</label>
                </div>
                <div class="clearfix">
                  {{ Form::text('FirstName', null, ['id' => 'firstname']) }}
                </div>
              </div>
              <div class="col-md-6 form-group">
                <div class="clearfix">
                  <label for="lastname">Last name</label>
                </div>
                <div class="clearfix">
                  {{ Form::text('LastName', null, ['id' => 'lastname']) }}
                </div>
              </div>
            </div>
            <div class="row m-t-lg">
              <div class="col-md-6 form-group">
                <div class="clearfix">
                  <label for="email">Email</label>
                </div>
                <div class="clearfix">
                  {{ Form::email('EmailAddress', null, ['id' => 'email']) }}
                </div>
              </div>
              <div class="col-md-6 form-group">
                <div class="clearfix">
                  <label for="phone">Phone</label>
                </div>
                <div class="clearfix">
                  {{ Form::text('PrimaryPhoneNumber', null, ['id' => 'phone']) }}
                </div>
              </div>
              <div class="col-md-6 pull-right form-group">
                <div class="clearfix m-t-sm">
                  {{ Form::checkbox('TCPAConsent', null, false, ['id' => 'agree-auto']) }}
                  <span class="m-l-xs">{{ Form::label('agree-auto', 'I agree to the', ['class' => 'reset-label']) }} {{ HTML::link('#', 'Auto Dialer Disclosure') }}</span>
                </div>
              </div>
            </div>
            <hr>
            <div class="row m-t-lg">
              <div class="col-md-12 form-group">
                <div class="clearfix">
                  <label for="address">Address</label>
                </div>
                <div class="clearfix">
                  {{ Form::text('Address', null, ['id' => 'address']) }}
                </div>
              </div>
            </div>
            <div class="row m-t-lg">
              <div class="col-md-6 form-group">
                <div class="clearfix">
                  <label for="city">City</label>
                </div>
                <div class="clearfix">
                  {{ Form::text('City', null, ['id' => 'city']) }}
                </div>
              </div>
              <div class="col-md-3 form-group">
                <div class="clearfix">
                  <label for="state">State</label>
                </div>
                <div class="clearfix">
                  <div class="styled-select">
                    {{ Form::selectState('State', null, ['id' => 'state']) }}
                  </div>
                </div>
              </div>
              <div class="col-md-3 form-group">
                <div class="clearfix">
                  <label for="zipcode">Zip code</label>
                </div>
                <div class="clearfix">
                  {{ Form::text('Zip', null, ['placeholder' => '10014', 'id' => 'zipcode', 'maxLength'=> '5']) }}
                </div>
              </div>
            </div>
            <div class="row m-t-lg">
              <div class="col-md-12 text-right">
                {{ Form::button('Next', ['class' => 'btn-normal btn-next']) }}
              </div>
            </div>
          </div>
          <div id="step2" class="hidden">
            <div class="row m-t-lg">
              <div class="col-md-6 form-group">
                <div class="clearfix m-b-xs"><strong>Interested in</strong></div>
                <div class="clearfix">
                  <span class="m-r-lg">
                    {{ Form::radio('LoanPurpose', '303814', true, ['id' => 'book-purchase']) }}
                    {{ Form::label('book-purchase', 'Purchase', ['class' => 'reset-label']) }}
                  </span>
                  <span>
                    {{ Form::radio('LoanPurpose', '303815', false, ['id' => 'book-refinance']) }}
                    {{ Form::label('book-refinance', 'Refinance', ['class' => 'reset-label']) }}
                  </span>
                </div>
              </div>
              <div class="col-md-6 form-group estimate-content">
                <div class="clearfix">
                  <strong>If purchase, buying time frame?</strong>
                </div>
                <div class="clearfix">
                  {{ Form::select('EstimateTimeFrame', [
                      '303851' => 'Within a Month',
                      '303852' => '2-3 Months',
                      '303853' => 'Within 6 Months',
                      '303854' => '6 to 12 Months',
                      '303855' => 'over 12 Months',
                      '303856' => 'Within the Next Year',
                    ])
                  }}
                </div>
              </div>
            </div>
            <hr>
            <div class="row m-t-lg">
              <div class="col-md-6 form-group ">
                <div class="clearfix">
                  <label for="estimate-loan"><strong>Estimate Loan Amount</strong></label>
                </div>
                <div class="clearfix">
                  {{ Form::text('LoanAmount', null, ['placeholder' => '$', 'id' => 'estimate-loan']) }}
                </div>
              </div>
              <div class="col-md-6 form-group">
                <div class="clearfix">
                  <label for="credit-score">Credit Score</label>
                </div>
                <div class="clearfix">
                  {{ Form::select('credit-score', [
                      '303846' => 'Excellent',
                      '303847' => 'Very Good',
                      '303848' => 'Good',
                      '303849' => 'Fair',
                      '303850' => 'Foor',
                    ])
                  }}
                </div>
              </div>
            </div>
            <hr>
            <div class="row m-t-lg">
              <div class="col-md-6 form-group">
                <div class="clearfix">
                  <label for="ebook-format"><strong>Prefered eBook Format</strong></label>
                </div>
                <div class="clearfix">
                  {{ Form::select('BookFormat', [
                      '303857' => 'PDF',
                      '303858' => 'Epub(For Ipads)',
                      '303859' => 'Kindle',
                    ])
                  }}
                </div>
              </div>
            </div>
            <div class="row m-t-lg">
              <div class="col-md-12 form-group">
                {{ Form::checkbox('TermsofService', null, false, ['id' => 'agree-terms']) }}
                <span class="m-l-xs">{{ Form::label('agree-terms', 'I agree with the', ['class' => 'reset-label']) }} {{ HTML::link('#', 'Terms of Service') }}</span>
              </div>
            </div>
            <div class="row m-t-lg">
              <div class="col-md-6 text-left">
                {{ Form::button('Prev', ['class' => 'btn-cancel btn-prev']) }}
              </div>
              <div class="col-md-6 text-right">
                {{ Form::submit('Download Now', ['class' => 'btn-normal']) }}
              </div>
            </div>
          </div>
          <div class="row m-t-lg">
            <div class="col-md-12 text-center">
              <ol class="indicators">
                <li class="active"></li>
                <li class=""></li>
              </ol>
            </div>
          </div>
        {{Form::close()}}
      </div>
    </div>
  </div>
</div>