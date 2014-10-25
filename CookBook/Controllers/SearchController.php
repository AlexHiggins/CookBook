<?php namespace CookBook\Controllers;

use CookBook\Contracts\Search;
use Illuminate\Support\Facades\Input;

class SearchController extends BaseController {

	/**
	 * @var Search
	 */
	protected $search;

	/**
	 * @param Search $search
	 */
	public function __construct(Search $search)
	{
		$this->search = $search;
	}

	/**
	 * @return mixed
	 */
	public function index()
	{
		$query = e(Input::get('q'));
		$title = "Search Results For \"{$query}\"";

		if (!empty($query))
		{
			$recipes = $this->search->searchByTermPaginated($query);
		}

		return $this->view('search.index', compact('recipes', 'title' , 'query'));
	}

}
