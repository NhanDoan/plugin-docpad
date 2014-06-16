<aside id="formNav">
  <div class="form-header">Mortgage Rates for<span>10014</span></div>
  <div class="form-body">
    <div id="purchase">
      <div class="form-group">
        <div class="clearfix"><strong>Loan Purpose</strong></div>
        <div class="clearfix">
          {{ Form::radio('mortgageType', '1', true, ['id' => 'rdo-purchase']) }}
          {{ Form::label('rdo-purchase', 'Purchase', ['class' => 'reset-label']) }}
          <span></span>
          {{ Form::radio('mortgageType', '3', false, ['id' => 'rdo-refinance']) }}
          {{ Form::label('rdo-refinance', 'Refinance', ['class' => 'reset-label']) }}
          <span></span>
        </div>
      </div>

      <div class="form-group clearfix", id="refinance">
        <div class="clearfix"><strong>Type</strong></div>
        <div class="pull-left form-radio">
          {{ Form::radio('cash', '0', true, ['id' => 'cash-out']) }}
        </div>
        <div class="pull-left form-title">
          {{ Form::label('cash-out', 'Cash Out', ['class' => 'reset-label']) }}
          <div class="clearfix">
            {{ Form::text('additionalCashOutAmount', null, ['placeholder' => '$0', 'class' => 'form-88']) }}
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
          ], null, ['class' => 'form-94']) 
        }}
      </div>
      <div class="form-group">
        <div class="clearfix"><strong>Loan Amount</strong></div>
        {{ Form::select('loanAmount', [
            '20000' => '$20,000',
            '30000' => '$30,000',
            '40000' => '$40,000',
            '50000' => '$50,000',
            '60000' => '$60,000',
            '70000' => '$70,000',
            '80000' => '$80,000'
          ], null, ['class' => 'form-94'])
        }}
        
      </div>
      <div class="form-group purchase">
        <div class="clearfix"><strong>Down Payment</strong></div>
        <div class="clearfix">
          {{ Form::select('downPayment', [
            '0' => '0%',
            '5' => '5%',
            '10' => '10%',
            '15' => '15%',
            '20' => '20%'
            ], null, ['class' => 'form-45'])
          }}
          {{ Form::text('downPaymentAmount', null, ['placeholder' => '$', 'class' => 'form-45']) }}
        </div>
      </div>
      <div class="form-group purchase">
        <div class="clearfix"><strong>Loan Term</strong></div>
        {{ Form::select('loanProduct', [
            '1' => '15 Year Fixed',
            '2' => '30 Year Fixed',
            '3' => '3/1 ARM',
            '4' => '5/1 ARM'
            ], 2, ['class' => 'form-94'])
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
          ], 5, ['class' => 'form-94'])
        }}

      </div>
      <div class="form-group">
        <div class="clearfix"><strong>Status</strong></div>
        {{ Form::select('status', [
            '1' => 'Veteran',
            '2' => 'Active Duty',
            '3' => 'Reservist'
          ], null, ['class' => 'form-94'])
        }}
      </div>
      <div class="form-group clearfix">
        <div class="pull-left form-checkbox">
          {{ Form::checkbox('receive', null, false, ['id' => 'receive']) }}
        </div>
        <div class="pull-left form-text">
          {{ Form::label('receive', "I’m receiving disability compensation from the VA", ['class' => 'reset-label']) }}
        </div>
      </div>
      <div class="form-group clearfix">
        <div class="pull-left form-checkbox">
          {{ Form::checkbox('connect', null, false, ['id' => 'connect']) }}
        </div>
        <div class="pull-left form-text">
          {{ Form::label('connect', 'Connect me with a realtor in my area that specializes in VA Loan home pruchases', ['class' => 'reset-label']) }}
          
        </div>
      </div>
      <div class="form-group text-center clearfix">
        <a href="#">
          <div class="btn-get-rates">Get Rates</div>
        </a>
      </div>
    </div>

  </div>
</aside>