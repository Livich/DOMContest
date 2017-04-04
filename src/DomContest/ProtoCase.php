<?php
namespace DomContest;

use PHPUnit_Framework_TestCase;
use stringEncode\Exception;


class ProtoCase extends PHPUnit_Framework_TestCase
{
    const SELECTOR_TYPE_CSS = 'css';
    const SELECTOR_TYPE_XPATH = 'xp';

    private $marinaHTML;
    public $parserName = 'undefined';
    public $profiles = array();

    protected function profileStart()
    {
        gc_disable();
        return array(
            microtime(true),
            memory_get_usage()
        );
    }

    protected function profileStop($profile)
    {
        if (!is_array($profile)) {
            return;
        }
        $result = array(
            microtime(true) - $profile[0],
            (memory_get_usage() - $profile[1]) / 1000000
        );
        gc_enable();

        return $result;
    }

    public function getMarinaHTML($force = false)
    {
        if (empty($this->marinaHTML) || $force) {
            $this->marinaHTML = file_get_contents('https://www.marinareservation.com/');
        }
        return $this->marinaHTML;
    }

    public function getLargeHTML($count = 1000)
    {
        $result = '';
        for ($i = 0; $i < $count; $i++) {
            $result .= '<p class="node_' . $i . '"><i>Surrogate DOM element ' . $i . '&mdash;漢語</i></p>' . PHP_EOL;
        }
        return $result;
    }

    public function getLargeSelector($type = ProtoCase::SELECTOR_TYPE_CSS)
    {
        switch ($type) {
            case ProtoCase::SELECTOR_TYPE_CSS:
                return 'div.col:nth-child(14) > a:nth-child(1) > div[class=place_forecast] > img:nth-child(1)';
                break;
            case ProtoCase::SELECTOR_TYPE_XPATH:
                return '//*[@id="body_height"]/section[4]/div/div/div[7]/a/div/img';
                break;
        }
        return null;
    }

    public function getFromLargeDOM($html)
    {
        throw new Exception("Not implemented yet");
    }

    private function profiledTest($scale)
    {
        $html = str_replace('<li>Access all your bookings</li>', $this->getLargeHTML($scale), $this->getMarinaHTML());
        $profile = $this->profileStart();
        $elements = $this->getFromLargeDOM($html);
        $result = $this->profileStop($profile);
        $elements = $elements[0]; // free memory
        $this->assertTrue(count($elements) > 0, $this->parserName . ' can parse large DOM');
        return array('scale' => $scale, 'name' => $this->parserName, 'time' => $result[0], 'memory' => $result[1]);
    }

    public function testLoadMarina()
    {
        $this->assertTrue(strlen($this->getMarinaHTML()) > 1024, "https://www.marinareservation.com/ is available");
    }

    /**
     * @large
     */
    public function test500()
    {
        return $this->profiledTest(500);

    }

    /**
     * @large
     */
    public function test1000()
    {
        return $this->profiledTest(1000);
    }

    /**
     * @group heavyTests
     * @large
     */
    public function test1500()
    {
        return $this->profiledTest(1500);
    }

    /**
     * @group heavyTests
     * @large
     */
    public function test2000()
    {
        return $this->profiledTest(2000);
    }
}