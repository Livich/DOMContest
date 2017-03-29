<?php
namespace DomContest\Tests;

use DiDom\Document;
use DiDom\Query;

class DidomTest extends ProtoCase{
    public function testLoadMarina() {
        $this->assertTrue(strlen($this->getMarinaHTML()) > 1024, "https://www.marinareservation.com/ is available");
    }

    public function testSelectorCSS() {
        $document = new Document();
        $document->loadHtml($this->getMarinaHTML());
        $scriptElements = $document->find('script');
        $this->assertTrue(count($scriptElements) > 40, 'CSS selectors works');
    }

    public function testSelectorCSSLong() {
        $document = new Document();
        $document->loadHtml($this->getMarinaHTML());
        $elements = $document->find($this->getLargeSelector());
        $this->assertTrue($elements[0]->attr('class') == 'homepage_featured_marinas', 'long CSS selectors works');
    }

    /**
     * @group profiledTests
     */
    public function test1000(){
        $this->scaledSelector(1000);
    }

    /**
     * @group profiledTests
     */
    public function test10000(){
        $this->scaledSelector(10000);
    }

    /**
     * @group profiledTests
     */
    public function test20000(){
        $this->scaledSelector(20000);
    }

    /**
     * @group profiledTests
     */
    public function test40000(){
        $this->scaledSelector(40000);
    }


    private function scaledSelector($scale) {
        $profile = $this->profileStart();

        $document = new Document();
        $html = str_replace('<li>Access all your bookings</li>', $this->getLargeHTML($scale), $this->getMarinaHTML());
        $document->loadHtml($html);
        $elements = $document->find('.node_0');
        $this->assertTrue(count($elements) > 0, 'can parse large DOM');

        print('DiDOM at '.$scale.' node test: ');
        $this->profileStop($profile);
    }
}
