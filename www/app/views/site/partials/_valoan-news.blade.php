@if (!empty($valoanNews) && is_array($valoanNews))
	@foreach( $valoanNews as $news)
	  <div class="rss-container-content">
	    <div class="title">
	    	{{ HTML::link( $news->guid, $news->post_title, array('target' => '_blank')) }}
	    </div>
	    <div class="desc">
	    	{{ Helpers::strLimit($news->post_content ) }}&nbsp;{{ HTML::link( $news->guid, 'Read more', array('target' => '_blank')) }}
	    </div>
	    <div class="by">
	    	by {{ $news->display_name , ', ', date('F d, Y', strtotime($news->post_modified)) }}
	    </div>
	  </div>
	  <hr/>
	@endforeach
	<div class="rss-container-content">
	  <div class="link-more">
	    {{ HTML::link('https://www.valoancaptain.com/blog', 'More in VA Loan Captain >', array('target' => '_blank')) }}
	  </div>
	</div>
@else
	<div class="desc">
		{{ $valoanNews }}
	</div>
@endif
          