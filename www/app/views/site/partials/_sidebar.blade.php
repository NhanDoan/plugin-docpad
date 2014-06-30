{{--*/
  $isRefinance = (isset($params['payment'])) ? ($params['payment'] == 'refinance' ? true : false) : false;
  $loanAmount = array();
  for( $i = 100000; $i < 430000; $i += 25000)
    $loanAmount[$i] = Helpers::money($i); 
/*--}}
{{ Form::open(array('route' => 'getRates')) }}

  <aside id="formNav" class="m-b-lg clearfix custom-width-left">
    <div class="form-header">Mortgage Rates for<span>{{ $params['zipCode'] }}</span>
        {{
            Form::text('zipCode', $params['zipCode'], array('class' => 'zipCode hidden', 'required' , 'maxlength' => '5'))
        }}
    </div>
    <div class="form-body">
      <div id="purchase">
        <div class="form-group">
          <div class="clearfix"><strong>Loan Purpose</strong></div>
          <div class="clearfix">
            <span>
              {{ Form::radio('payment', 'purchase', !$isRefinance, ['id' => 'rdo-purchase']) }}
              {{ Form::label('rdo-purchase', 'Purchase', ['class' => 'reset-label']) }}
            </span>
            <span>
              {{ Form::radio('payment', 'refinance', $isRefinance, ['id' => 'rdo-refinance']) }}
              {{ Form::label('rdo-refinance', 'Refinance', ['class' => 'reset-label']) }}
            </span>
          </div>
        </div>

        <div class="form-group clearfix" id="refinance">
          <div class="clearfix"><strong>Type</strong></div>
          <div class="pull-left form-radio">
            {{ Form::radio('cash', '0', true, ['id' => 'cash-out']) }}
          </div>
          <div class="pull-left form-title">
            {{ Form::label('cash-out', 'Cash Out', ['class' => 'reset-label']) }}
            <div class="clearfix">
              {{ Form::text('additionalCashOutAmount', null, ['placeholder' => '$0', 'class' => 'form-100']) }}
            </div>
          </div>
          <div class="pull-left form-radio m-t">
            {{ Form::radio('cash', '1', false, ['id' => 'reduction']) }}
          </div>
          <div class="pull-left form-title m-t">
            {{ Form::label('reduction', 'Interest Rate Reduction Refinance Loan (IRRRL)', ['class' => 'reset-label']) }}
            <div class="clearfix">
              {{ HTML::link('#', "What's this?") }}
            </div>
          </div>
        </div>

        <div class="form-group purchase">
          <div class="clearfix"><strong>Home Type</strong></div>
          {{ Form::select('propertyType', [
              '1' => 'Single Family',
              '2' => 'Multi-unit',
              '3' => 'Condo'
            ], (isset($params['propertyType'])) ? $params['propertyType'] : 1, ['class' => 'form-100']) 
          }}
        </div>
        <div class="form-group">
          <div class="clearfix"><strong>Loan Amount</strong></div>
          {{ Form::select('loanAmount', $loanAmount, 
            (isset($params['loanAmount'])) ? $params['loanAmount'] : 200000, ['class' => 'form-100'])
          }}
        </div>
        <div class="form-group purchase">
          <div class="clearfix"><strong>Down Payment</strong></div>
          <div class="clearfix">
            <div class="col-form-left">
              {{ Form::select('downPayment', [
                '0' => '0%',
                '5' => '5%',
                '10' => '10%',
                '15' => '15%',
                '20' => '20%'
                ], isset($params['downPayment']) ? $params['downPayment'] : 0, ['class' => 'form-100'])
              }}
            </div>
            <div class="col-form-right">
              {{ Form::text('downPaymentAmount', null, ['placeholder' => '$', 'class' => 'form-100','readonly']) }}
            </div>
          </div>
        </div>
        <div class="form-group purchase">
          <div class="clearfix"><strong>Loan Term</strong></div>
          {{ Form::select('loanProduct', [
            '1' => '15 Year Fixed',
            '2' => '30 Year Fixed',
            '3' => '3/1 ARM',
            '4' => '5/1 ARM'
            ], (isset($params['loanProduct'])) ? $params['loanProduct'] : 2, ['class' => 'form-100'])
          }}
        </div>
        <div class="form-group">
          <div class="clearfix"><strong>Credit Score</strong></div>
          {{ Form::select('creditRating', [
              '5' => '740 -850 (excellent)',
              '6' => '720 - 739 (very good)',
              '2' => '700 - 719 (good)',
              '7' => '680 - 699 (good)',
              '3' => '660 - 679 (fair)',
              '8' => '640 - 659 (fair)',
              '4' => '620 - 639 (low)'
            ], (isset($params['creditRating'])) ? $params['creditRating'] : 5, ['class' => 'form-100'])
          }}
        </div>
        <div class="form-group">
          <div class="clearfix"><strong>Status</strong></div>
          {{ Form::select('veteranType', [
              '0' => 'Veteran',
              '1' => 'Active Duty',
              '2' => 'Reservist'
            ], (isset($params['veteranType'])) ? $params['veteranType'] : 0, ['class' => 'form-100'])
          }}
        </div>
        <div class="form-group clearfix">
          <div class="pull-left form-checkbox">
            {{ Form::checkbox('receivingDisability', null, false, ['id' => 'receivingDisability']) }}
          </div>
          <div class="pull-left form-text">
            {{ Form::label('receivingDisability', "I’m receiving disability compensation from the VA", ['class' => 'reset-label']) }}
          </div>
        </div>
        <div class="form-group clearfix">
          <div class="pull-left form-checkbox">
            {{ Form::checkbox('connectwitharealtor', null, false, ['id' => 'connectwitharealtor']) }}
          </div>
          <div class="pull-left form-text">
            {{ Form::label('connectwitharealtor', 'Connect me with a realtor in my area that specializes in VA Loan home pruchases', ['class' => 'reset-label']) }}
            
          </div>
        </div>
        <div class="form-group clearfix">
          <a href="#">
            <div class="btn-get-rates">Get Rates</div>
          </a>
        </div>
      </div>

    </div>
  </aside>
{{ Form::close() }}