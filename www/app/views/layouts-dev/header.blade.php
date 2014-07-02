<header class="navbar navbar-inverse bs-docs-nav header">
  <div class="navbar-header">
    <div id="logo">
      <h1>{{ HTML::link('http://www.stripes.com', 'Stars and Strips', array('target' => '_blank')) }}</h1>
    </div>
    <button data-toggle="collapse" data-target=".bs-navbar-collapse" type="button" class="navbar-toggle">
    	<span class="sr-only">Toggle navigation</span>
    	<span class="icon-bar"></span>
    	<span class="icon-bar"></span>
    	<span class="icon-bar"></span>
    </button>
  </div>
  <div class="navigation">
    <div class="pull-left container-title">
      <div class="title">
        <span>VA </span>
        Loan Center
      </div>
      <div class="container-powered">
        <div class="powered">Powered by</div>
        <div class="captain-logo"></div>
      </div>
    </div>
    <div class="pull-right nav-container">
      <nav id="primaryNav" class="navbar-collapse collapse bs-navbar-collapse">

        <ul class="nav">
          <li>{{ HTML::link(Request::root(), 'Home') }}</li>
          <li>{{ HTML::link( Request::root() . '#downloadBookForm', 'Free VA Loan Book', ['data-toggle' => 'modal']) }}</li>
          <li>{{ HTML::link(URL::route('learn'), 'Learning Center') }}</li>
        </ul>
      </nav>
    </div>
  </div>
  </header>