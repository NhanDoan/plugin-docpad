@section('sidebar')
  <!-- include sidebar -->
  @include('site.partials._sidebar', array('params' => $params))
@stop


@section('content')
	<section class="list-form m-t-lg m-b-lg clearfix">
    @include('site.partials._lender-list', array('results' => $results))
  </section>
@stop


@section('veteranNews')
	@include('site.partials._news', array('veteranNews' => $veteranNews))
@stop

@section('modal')
  <!-- include signup form modal -->
  @include('site.partials._signup-form')
  <!-- include request quote model -->
  @include('site.partials._thank-form')
@stop
