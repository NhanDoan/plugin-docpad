@section('content')
  <h2>Get Today's Best VA Loan Rates</h2>
  <div class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sem mauris, eleifend in consectetur id, ornare <br/>vitae turpis. Pellentesque viverra gravida velit, eu vulputate risus scelerisque id.      </div>
  <div class="content">
      <div class="row m-t-lg">
          <div class="col-md-3">
              <!-- include sidebar -->
              @include('site.partials._sidebar', array('params' => $params))
              <!-- include sidebar image -->
              @include('site.partials._sidebar-image')
          </div>
          <div class="col-md-9">
              <section class="list-form m-t-lg clearfix">
                @include('site.partials._lender-list', array('results' => $results, 'state' => $params['state']))
              </section>
              <div class="clearfix news">
                <div class="row">
                  <div class="col-md-6 m-t-lg">
                    <section class="rss">
                      <div class="rss-header">
                        VA Loan Captain News
                        <div class="pull-right">&nbsp;</div>
                      </div>
                      <div class="rss-body valoan-news">
                      </div>
                    </section>
                  </div>
                  <div class="col-md-6 m-t-lg">
                    <section class="rss">
                      <div class="rss-header">
                        Veteran News
                        <div class="pull-right">&nbsp;</div>
                      </div>
                      <div class="rss-body veteran-news">
                      </div>
                    </section>
                  </div>
                </div>
              </div>
          </div>
      </div>
  </div>
@stop

@section('modal')
  <!-- include signup form modal -->
  @include('site.partials._signup-form')
  <!-- include request quote model -->
  @include('site.partials._thank-form')
@stop
