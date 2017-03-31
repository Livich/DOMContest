<?php
namespace DomContest;

use PHPHtmlParser\Dom;

class PhpHtmlParserTest extends ProtoCase{
    public function __construct() {
	$this->parserName = 'PHP HTML Parser';
    }

    public function testLoadMarina() {
        $this->assertTrue(strlen($this->getMarinaHTML()) > 1024, "https://www.marinareservation.com/ is available");
    }

    public function testSelectorCSS() {
        $dom = new Dom;
        $dom->loadStr($this->getMarinaHTML(), array('removeScripts'=>false));
        $scriptElements = $dom->find('script');
        $this->assertTrue(count($scriptElements) > 40, 'CSS selectors works');
    }

    public function testSelectorCSSLong() {
        $dom = new Dom;
        $dom->loadStr($this->getMarinaHTML(), array());
        $element = $dom->find($this->getLargeSelector(), 0);
        $this->assertNotNull($element, 'long CSS selector works');
        if(!is_null($element)) {
            $this->assertTrue($element->attr('class') == 'homepage_featured_marinas', 'long CSS selectors works correctly');
        }
    }

    public function getFromLargeDOM($html) {
        $dom = new Dom;
        $dom->loadStr($html, array());
        $elements = $dom->find('.node_0');
	return $elements;
    }
}
