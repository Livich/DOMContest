<?php
namespace DomContest;

global $rootDir;
include_once($rootDir.'/simplehtmldom/simple_html_dom.php');

class SimpleHtmlDomTest extends ProtoCase{
    public function testLoadMarina() {
        $this->assertTrue(strlen($this->getMarinaHTML()) > 1024, "https://www.marinareservation.com/ is available");
    }

    public function testSelectorCSS() {
        $parser = new \simple_html_dom();
        $parser->load($this->getMarinaHTML());
        $scriptElements = $parser->find('script');
        $this->assertTrue(count($scriptElements) > 40, 'CSS selectors works');
    }

    public function testSelectorCSSLong() {
        $parser = new \simple_html_dom();
        $parser->load($this->getMarinaHTML());
        $element = $parser->find($this->getLargeSelector(), 0);
        $this->assertTrue($element->attr['class'] == 'homepage_featured_marinas', 'long CSS selectors works');
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

        $parser = new \simple_html_dom();
        $html = str_replace('<li>Access all your bookings</li>', $this->getLargeHTML($scale), $this->getMarinaHTML());
        $parser->load($html);
        $elements = $parser->find('.node_0');
        $this->assertTrue(count($elements) > 0, 'can parse large DOM');

        print('SimpleHTMLDOM at '.$scale.' node test: ');
        $this->profileStop($profile);
    }
}
