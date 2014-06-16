<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{

		if (App::environment('dev'))
			$this->layout = 'layouts-dev.master';
		else
			$this->layout = 'layouts.master';

		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
