<?php namespace CookBook\Presenters;

use Illuminate\Support\Facades\App;

class RecipePresenter extends Presenter {

	/**
	 * @return string
	 */
	public function recipeTitle()
	{
		return str_limit($this->title, 80);
	}

	/**
	 * @return mixed
	 */
	public function code()
	{
		$code = $this->entity->code;
		$code = $this->convertMarkdown($code);
		$code = $this->convertNewlines($code);

		return $code;
	}

	/**
	 * @return string
	 */
	public function viewCount()
	{
		return $this->views.' '.str_plural('view', $this->views);
	}

	/**
	 * @param $content
	 * @return mixed
	 */
	protected function convertNewlines($content)
	{
		return str_replace("\n", '<br/>', $content);
	}

	/**
	 * @param $content
	 * @return mixed
	 */
	protected function convertMarkdown($content)
	{
		return App::make('CookBook\Markdown\HtmlMarkdownConverter')->convertMarkdownToHtml($content);
	}
}
