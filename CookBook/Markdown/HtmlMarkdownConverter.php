<?php namespace CookBook\Markdown;

use Michelf\MarkdownExtra;

class HtmlMarkdownConverter {

	/**
	 * @var MarkdownExtra
	 */
	protected $markdown;

	/**
	 * @param MarkdownExtra $markdown
	 */
	public function __construct(MarkdownExtra $markdown)
	{
		$this->markdownParser = $markdown;
		$this->markdownParser->no_markup = true;
	}

	/**
	 * @param $markdown
	 * @return string
	 */
	public function convertMarkdownToHtml($markdown)
	{
		return $this->markdownParser->transform($markdown);
	}

}
