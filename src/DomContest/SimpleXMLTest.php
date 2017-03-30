<?php
namespace DomContest;

use DOMDocument;

class SimpleXMLTest extends ProtoCase{
    public function testLoadMarina() {
        $this->assertTrue(strlen($this->getMarinaHTML()) > 1024, "https://www.marinareservation.com/ is available");
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

    /**
     * @group profiledTests
     * @group lightTests
     */
    public function test1000(){
        $this->scaledSelector(1000);
    }

    /**
     * @group profiledTests
     * @group lightTests
     */
    public function test10000(){
        $this->scaledSelector(10000);
    }

    /**
     * @group profiledTests
     * @group heavyTests
     * @large
     */
    public function test20000(){
        $this->scaledSelector(20000);
    }

    /**
     * @group profiledTests
     * @group heavyTests
     * @large
     */
    public function test40000(){
        $this->scaledSelector(40000);
    }


    private function scaledSelector($scale) {
        $profile = $this->profileStart();


        $html = str_replace('<li>Access all your bookings</li>', $this->getLargeHTML($scale), $this->getMarinaHTML());
        $se = $this->getSimpleXML($html);
        $elements = $se->xpath('//*[contains(@class, \'node_0\')]');
        $this->assertTrue(count($elements) > 0, 'can parse large DOM');

        print('SimpleXML at '.$scale.' node test: ');
        $this->profileStop($profile);
    }

    private function getSimpleXML($html) {
        libxml_use_internal_errors(true);
        $doc = new DOMDocument();
        $doc->strictErrorChecking = false;
        $doc->loadHTML($html);
        libxml_use_internal_errors(false);
        return simplexml_import_dom($doc);
    }
}
