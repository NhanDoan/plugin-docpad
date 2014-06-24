{{--*/ $layout = (App::environment('dev')) ? 'layouts-dev.master' : 'layouts.master' /*--}}

@extends($layout)

@section('content')
	<h2>Page Not Found</h2>

  <div class="desc">Sorry, we couldn't find the page you are looking for. Please inform the administrator if you believe this is an error.</div>
@stop

