<div class="clearfix news">
  <div class="row">
    <div class="col-md-6 m-t-lg">
      <section class="rss">
        <div class="rss-header">VA Loan Captain News</div>
        <div class="rss-body">
          <div class="rss-container-content">
            <div class="title"><a href="javascript: void(0)">The VA Loan Approval Countdown</a></div>
            <div class="desc">How long does it take to obtain a VA loan approval? That's probably one of the first questions...<a href="#">Read more</a></div>
            <div class="by">by Grant Moon, April 30, 2014</div>
          </div>
          <hr/>
          <div class="rss-container-content">
            <div class="title"><a href="javascript: void(0)">The VA 3 Day Rescission Period</a></div>
            <div class="desc">The VA loan used to buy and finance a property is the best program around for those who qualify and need or want a no money...<a href="#">Read more</a></div>
            <div class="by">by Grant Moon, April 30, 2014</div>
          </div>
          <hr/>
          <div class="rss-container-content">
            <div class="title"><a href="javascript: void(0)">The Online VA Loan Application</a></div>
            <div class="desc">Once you've decided who your VA lender will be, if you haven't already it's time to complete a VA loan application...<a href="javascript: void(0)">Read more</a></div>
            <div class="by">by Grant Moon, April 30, 2014</div>
          </div>
          <hr/>
          <div class="rss-container-content">
            <div class="link-more"><a href="javascript: void(0)">More in VA Loan Captain ></a></div>
          </div>
        </div>
      </section>
    </div>
    <div class="col-md-6 m-t-lg">
      <section class="rss">
        <div class="rss-header">Veteran News</div>
        <div class="rss-body">
          @foreach( $valoanNews as $news )
            <div class="rss-container-content">
              <div class="title">
                {{ HTML::link('"javascript: void(0)"', $news->title) }}
              </div>
              <div class="desc">{{ Helpers::str_limit($news->lead, 125) }}&nbsp;
                {{ HTML::link('"javascript:void(0)"', 'Read more') }}
              </div>
              <div class="by">{{ date('g:i A, F d, Y', strtotime($news->pubDate)) }}</div>
            </div>
            <hr/>
          @endforeach
          
          <div class="rss-container-content">
            <div class="link-more">
              {{ HTML::link('"javascript: void(0)"', 'More in Veteran News >') }}
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>