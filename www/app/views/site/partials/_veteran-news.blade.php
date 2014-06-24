@foreach( $veteranNews as $news )
  <div class="rss-container-content">
    <div class="title">
        <a href="javascript:void(0)">{{ $news->title}}</a>
    </div>
    <div class="desc">{{ Helpers::strLimit($news->lead) }}&nbsp;
        <a href="javascript:void(0)">Read more</a>
    </div>
    <div class="by">
      {{ date('g:i A, F d, Y', strtotime($news->pubDate)) }}
    </div>
  </div>
  <hr/>
@endforeach
<div class="rss-container-content">
  <div class="link-more">
    <a href="javascript:void(0)">More in Veteran News ></a>
  </div>
</div>
          
          