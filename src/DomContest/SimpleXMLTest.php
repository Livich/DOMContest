<?php
namespace DomContest;

use DOMDocument;

class SimpleXMLTest extends ProtoCase{
    public function __construct() {
	$this->parserName = 'SimpleXML';
    }

    public function testSelectorCSS() {
        $se = $this->getSimpleXML($this->getMarinaHTML());
        $scriptElements = $se->xpath('//script');
        $this->assertTrue(count($scriptElements) > 40, 'XPath selectors works');
    }

    public function testSelectorCSSLong() {
        $se = $this->getSimpleXML($this->getMarinaHTML());
        $element = $se->xpath($this->getLargeSelector(ProtoCase::SELECTOR_TYPE_XPATH));
        $this->assertTrue($element[0]->attributes()['class'] == 'homepage_featured_marinas', 'long XPath selectors works');
    }

    private function getLargeDOM($html) {
        $se = $this->getSimpleXML($html);
        $elements = $se->xpath('//*[contains(@class, \'node_0\')]');
	return $elements;
    }

    public function getSimpleXML($html) {
        libxml_use_internal_errors(true);
        $doc = new DOMDocument();
        $doc->strictErrorChecking = false;
        $doc->loadHTML($html);
        libxml_use_internal_errors(false);
        return simplexml_import_dom($doc);
    }
}
