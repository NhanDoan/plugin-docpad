<div id="contactForm" aria-hidden="true" aria-labelledby="myModalLabel" data-backdrop="true" role="dialog" tabindex="-1" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button aria-hidden="true" data-dismiss="modal" type="button" class="close"></button>
        <h3>One more step!</h3>
        <h6>Please confirm your information so that we may accurately match your record.</h6>
      </div>
      <div class="modal-body">
        {{ Form::open(array('id'=> 'infoContactForm', 'class'=> 'form-horizontal')) }}
          <div class="row m-t-lg">
            <div class="col-md-6 form-group">
              <div class="clearfix">
                <label for="firstname">First name</label>
              </div>
              <div class="clearfix">
                {{ Form::text('firstname', null, ['id' => 'firstname']) }}
              </div>
            </div>
            <div class="col-md-6 form-group">
              <div class="clearfix">
                <label for="lastname">Last name</label>
              </div>
              <div class="clearfix">
                {{ Form::text('lastname', null, ['id' => 'lastname']) }}
              </div>
            </div>
          </div>
          <div class="row m-t-lg">
            <div class="col-md-6 form-group">
              <div class="clearfix">
                <label for="email">Email</label>
              </div>
              <div class="clearfix">
                {{ Form::email('email', null, ['id' => 'email']) }}
              </div>
            </div>
            <div class="col-md-6 form-group">
              <div class="clearfix">
                <label for="phone">Phone</label>
              </div>
              <div class="clearfix">
                {{ Form::text('phone', null, ['id' => 'phone']) }}
              </div>
              
            </div>
            <div class="col-md-6 pull-right form-group">
              <div class="clearfix m-t-sm">
                {{ Form::checkbox('agree_auto', null, false, ['id' => 'agree-auto']) }}
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
                {{ Form::text('address', null, ['id' => 'address']) }}
              </div>
            </div>
          </div>
          <div class="row m-t-lg">
            <div class="col-md-6 form-group">
              <div class="clearfix">
                <label for="city">City</label>
              </div>
              <div class="clearfix">
                {{ Form::text('city', null, ['id' => 'city']) }}
              </div>
            </div>
            <div class="col-md-3 form-group">
              <div class="clearfix">
                <label for="state">State</label>
              </div>
              <div class="clearfix">
                <div class="styled-select">
                  {{ Form::selectState('state', null, ['id' => 'state']) }}
                </div>
              </div>
            </div>
            <div class="col-md-3 form-group">
              <div class="clearfix">
                <label for="zipcode">Zip code</label>
              </div>
              <div class="clearfix">
                {{ Form::text('zipcode', null, ['placeholder' => '10014', 'id' => 'zipcode', 'maxLength'=> '5']) }}
              </div>
            </div>
          </div>
          <div class="row m-t-lg">
            <div class="col-md-12 form-group">
              {{ Form::checkbox('agree_terms', null, false, ['id' => 'agree_terms']) }}
              <span class="m-l-xs">{{ Form::label('agree_terms', 'I agree with the', ['class' => 'reset-label']) }} {{ HTML::link('https://militarytimes.valoancaptain.com/LoginAndPricing.aspx', 'Terms of Service', ['target' => '_blank']) }}</span>
            </div>
          </div>
          <div class="row m-t-lg">
            <div class="col-md-12 ">
              {{ Form::submit('Submit', ['class' => 'btn-get-rates contact-submit']) }}
              {{ Form::button('Cancel', ['class' => 'btn-sm  btn-cancel','data-dismiss'=>'modal']) }}
            </div>
          </div>
        {{Form::close()}}
      </div>
    </div>
  </div>
</div>