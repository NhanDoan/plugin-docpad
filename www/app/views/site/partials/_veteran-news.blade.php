@foreach( $veteranNews as $news )
  <div class="rss-container-content">
    <div class="title">
      {{ HTML::link('http://www.stripes.com/' . $news->guid, $news->title, array('target' => '_blank')) }}
    </div>
    <div class="desc">{{ Helpers::strLimit($news->lead) }}&nbsp;
      {{ HTML::link('http://www.stripes.com/' . $news->guid, 'Read more', array('target' => '_blank')) }}
    </div>
    <div class="by">
      {{ date('g:i A, F d, Y', strtotime($news->pubDate)) }}
    </div>
  </div>
  <hr/>
@endforeach
<div class="rss-container-content">
  <div class="link-more">
    {{ HTML::link('http://www.stripes.com/news/veterans', 'More in Veteran News >', array('target' => '_blank')) }}
  </div>
</div>
          
          