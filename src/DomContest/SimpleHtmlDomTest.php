<?php
namespace DomContest;

global $rootDir;
include_once($rootDir . '/simplehtmldom/simple_html_dom.php');

class SimpleHtmlDomTest extends ProtoCase
{
    public function __construct()
    {
        $this->parserName = 'Simple HTML DOM';
    }

    public function testSelectorCSS()
    {
        $parser = new \simple_html_dom();
        $parser->load($this->getMarinaHTML());
        $scriptElements = $parser->find('script');
        $this->assertTrue(count($scriptElements) > 40, 'CSS selectors works');
    }

    public function testSelectorCSSLong()
    {
        $parser = new \simple_html_dom();
        $parser->load($this->getMarinaHTML());
        $element = $parser->find($this->getLargeSelector(), 0);
        $this->assertTrue($element->attr['class'] == 'homepage_featured_marinas', 'long CSS selectors works');
    }

    public function getFromLargeDOM($html)
    {
        $parser = new \simple_html_dom();
        $parser->load($html);
        $elements = $parser->find('.node_0');
        return array($elements, $parser);
    }
}
