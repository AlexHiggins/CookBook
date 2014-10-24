<?php namespace CookBook\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;

class BaseController extends Controller {

	/**
	 * @param       $path
	 * @param array $data
	 * @return mixed
	 */
	protected function view($path, $data = [])
	{
		return View::make($path, $data);
	}

	/**
	 * @param     $url
	 * @param int $statusCode
	 * @return mixed
	 */
	protected function redirectTo($url, $statusCode = 302)
	{
		return Redirect::to($url, $statusCode);
	}

	/**
	 * @param       $action
	 * @param array $data
	 * @return mixed
	 */
	protected function redirectAction($action, $data = [])
	{
		return Redirect::action($action, $data);
	}

	/**
	 * @param       $route
	 * @param array $data
	 * @return mixed
	 */
	protected function redirectRoute($route, $data = [])
	{
		return Redirect::route($route, $data);
	}

	/**
	 * @param string $default
	 * @return mixed
	 */
	protected function redirectIntended($default = '/')
	{
		return Redirect::intended($default);
	}

	/**
	 * @param array $data
	 * @return mixed
	 */
	protected function redirectBack($data = [])
	{
		return Redirect::back()->withInput()->with($data);
	}

}
