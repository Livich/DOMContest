<?php
namespace DomContest;

use DiDom\Document;

class DidomTest extends ProtoCase
{
    public function __construct()
    {
        $this->parserName = 'DiDOM';
    }

    public function testSelectorCSS()
    {
        $document = new Document();
        $document->loadHtml($this->getMarinaHTML());
        $scriptElements = $document->find('script');
        $this->assertTrue(count($scriptElements) > 40, 'CSS selectors works');
    }

    public function testSelectorCSSLong()
    {
        $document = new Document();
        $document->loadHtml($this->getMarinaHTML());
        $elements = $document->find($this->getLargeSelector());
        $this->assertTrue($elements[0]->attr('class') == 'homepage_featured_marinas', 'long CSS selectors works');
    }

    public function getFromLargeDOM($html)
    {
        $document = new Document();
        $document->loadHtml($html);
        $elements = $document->find('.node_0');
        return array($elements, $document);
    }
}
