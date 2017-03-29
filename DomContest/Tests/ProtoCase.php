<?php
/**
 * Created by PhpStorm.
 * User: sergiy
 * Date: 24.03.17
 * Time: 18:26
 */

namespace DomContest\Tests;

use PHPUnit_Framework_TestCase;


class ProtoCase extends PHPUnit_Framework_TestCase
{
    const SELECTOR_TYPE_CSS = 'css';
    const SELECTOR_TYPE_XPATH = 'xp';
    private $marinaHTML;

    protected function profileStart() {
        return array(
            microtime(true),
            memory_get_usage()
        );
    }

    protected function profileStop($profile, $print = true) {
        if (!is_array($profile)) {
            return;
        }
        $result = array(
            microtime(true) - $profile[0],
            (memory_get_usage() - $profile[1])/1000000
        );
        if ($print) {
            vprintf('T: %fsec., M: %fMB'.PHP_EOL, $result);
        }

        return $result;
    }

    public function getMarinaHTML($force = false){
        if (empty($this->marinaHTML) || $force) {
            $this->marinaHTML = file_get_contents('https://www.marinareservation.com/');
        }
        return $this->marinaHTML;
    }

    public function getLargeHTML($count = 1000){
        $result = '';
        for($i=0;$i<$count;$i++){
            $result.='<p class="node_'.$i.'"><i>Surrogate DOM element '.$i.'&mdash;漢語</i></p>'.PHP_EOL;
        }
        return $result;
    }

    public function getLargeSelector($type = ProtoCase::SELECTOR_TYPE_CSS){
        switch($type) {
            case ProtoCase::SELECTOR_TYPE_CSS:
                return 'div.col:nth-child(14) > a:nth-child(1) > div[class=place_forecast] > img:nth-child(1)';
                break;
            case ProtoCase::SELECTOR_TYPE_XPATH:
                return '//*[@id="body_height"]/section[4]/div/div/div[7]/a/div/img';
                break;
        }
        return null;
    }
}