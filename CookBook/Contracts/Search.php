<?php namespace CookBook\Contracts;

interface Search {

	/**
	 * @param     $term
	 * @param int $howMany
	 * @return mixed
	 */
	public function searchByTermPaginated($term, $howMany = 12);

}