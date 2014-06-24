<div id="contactForm" aria-hidden="true" aria-labelledby="myModalLabel" data-backdrop="true" role="dialog" tabindex="-1" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button aria-hidden="true" data-dismiss="modal" type="button" class="close"></button>
        <h3>One more step!</h3>
        <h6>Please confirm your information so that we may accurately match your record.</h6>
      </div>
      <div class="modal-body">
        <div class="row m-t-lg">
          <div class="col-md-6">
            <div class="clearfix">
              <label for="firstname">First name</label>
            </div>
            <div class="clearfix">
              {{ Form::text('firstname', null, ['id' => 'firstname']) }}
            </div>
          </div>
          <div class="col-md-6">
            <div class="clearfix">
              <label for="lastname">Last name</label>
            </div>
            <div class="clearfix">
              {{ Form::text('lastname', null, ['id' => 'lastname']) }}
            </div>
          </div>
        </div>
        <div class="row m-t-lg">
          <div class="col-md-6">
            <div class="clearfix">
              <label for="email">Email</label>
            </div>
            <div class="clearfix">
              {{ Form::email('email', null, ['id' => 'email']) }}
            </div>
          </div>
          <div class="col-md-6">
            <div class="clearfix">
              <label for="phone">Phone</label>
            </div>
            <div class="clearfix">
              {{ Form::text('phone', null, ['id' => 'phone']) }}
            </div>
            <div class="clearfix m-t-sm">
              {{ Form::checkbox('agree-auto', null, false, ['id' => 'agree-auto']) }}
              <span class="m-l-xs">{{ Form::label('agree-auto', 'I agree to the', ['class' => 'reset-label']) }} {{ HTML::link('#', 'Auto Dialer Disclosure') }}</span>
            </div>
          </div>
        </div>
        <hr>
        <div class="row m-t-lg">
          <div class="col-md-12">
            <div class="clearfix">
              <label for="address">Address</label>
            </div>
            <div class="clearfix">
              {{ Form::text('address', null, ['id' => 'address']) }}
            </div>
          </div>
        </div>
        <div class="row m-t-lg">
          <div class="col-md-6">
            <div class="clearfix">
              <label for="city">City</label>
            </div>
            <div class="clearfix">
              {{ Form::text('city', null, ['id' => 'city']) }}
            </div>
          </div>
          <div class="col-md-3">
            <div class="clearfix">
              <label for="state">State</label>
            </div>
            <div class="clearfix">
              <div class="styled-select">
                {{ Form::select('state', ['NY', 'CA'], null, ['id' => 'state']) }}
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="clearfix">
              <label for="zipcode">Zip code</label>
            </div>
            <div class="clearfix">
              {{ Form::text('zipcode', null, ['placeholder' => '10014', 'id' => 'zipcode']) }}
            </div>
          </div>
        </div>
        <div class="row m-t-lg">
          <div class="col-md-12">
            {{ Form::checkbox('agree-terms', null, false, ['id' => 'agree-terms']) }}
            <span class="m-l-xs">{{ Form::label('agree-terms', 'I agree with the', ['class' => 'reset-label']) }} {{ HTML::link('https://militarytimes.valoancaptain.com/LoginAndPricing.aspx', 'Terms of Service', ['target' => '_blank']) }}</span>
          </div>
        </div>
        <div class="row m-t-lg">
          <div class="col-md-12">
            <a href="javascript: void(0)">
              <span class="btn-get-rates m-r-lg">Submit</span>
            </a>
            <a data-dismiss="modal" href="javascript: void(0)"><span>Cancel</span></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>