<?php
namespace DomContest;

use PHPHtmlParser\Dom;

class PhpHtmlParserTest extends ProtoCase{
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

    /**
     * @group profiledTests
     * @group lightTests
     */
    public function test1000(){
        $this->scaledSelector(1000);
    }

    /**
     * @group profiledTests
     * @group heavyTests
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

        $dom = new Dom;
        $html = str_replace('<li>Access all your bookings</li>', $this->getLargeHTML($scale), $this->getMarinaHTML());
        $dom->loadStr($html, array());
        $elements = $dom->find('.node_0');
        $this->assertTrue(count($elements) > 0, 'can parse large DOM');

        print('PHP HTML Parser at '.$scale.' node test: ');
        $this->profileStop($profile);
    }
}
