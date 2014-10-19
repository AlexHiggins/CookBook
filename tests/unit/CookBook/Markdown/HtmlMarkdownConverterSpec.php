<?php namespace tests\unit\CookBook\Markdown;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Michelf\MarkdownExtra;

class HtmlMarkdownConverterSpec extends ObjectBehavior {

	public function let()
	{
		$this->beConstructedWith(new MarkdownExtra);
	}

	function it_is_initializable()
	{
		$this->shouldHaveType('CookBook\Markdown\HtmlMarkdownConverter');
	}

	public function it_converts_markdown_to_html()
	{
		$this->convertMarkdownToHtml('### Header 3')->shouldReturn("<h3>Header 3</h3>\n");
		$this->convertMarkdownToHtml('## Header 2')->shouldReturn("<h2>Header 2</h2>\n");
		$this->convertMarkdownToHtml('Use two asterisks for **strong emphasis**.')->shouldReturn(
			"<p>Use two asterisks for <strong>strong emphasis</strong>.</p>\n"
		);
		$this->convertMarkdownToHtml('This is an [example link](http://example.com/ "With a Title").')->shouldReturn(
			'<p>This is an <a href="http://example.com/" title="With a Title">example link</a>.</p>'."\n"
		);
		$this->convertMarkdownToHtml("`Robots`")->shouldReturn("<p><code>Robots</code></p>\n");
		$this->convertMarkdownToHtml("I strongly recommend against using any `<blink>` tags.")->shouldReturn(
			"<p>I strongly recommend against using any <code>&lt;blink&gt;</code> tags.</p>\n"
		);
	}
}
