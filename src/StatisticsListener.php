<?php

use PHPUnit\Framework\TestCase;

class StatisticsListener extends PHPUnit_Framework_BaseTestListener
{
    const VALUE_TYPE_TIME = 0;
    const VALUE_TYPE_MEMORY = 1;
    const VALUE_FORMAT_MARKDOWN = 'md';
    const VALUE_FORMAT_PLOT = 'pl';
    
    private $profiles = array();

    public function __destruct() {
        print("TIME".
            PHP_EOL.
            $this->getValueGroups(StatisticsListener::VALUE_FORMAT_MARKDOWN, StatisticsListener::VALUE_TYPE_TIME).
            PHP_EOL);

        print("MEMORY".
            PHP_EOL.
            $this->getValueGroups(StatisticsListener::VALUE_FORMAT_MARKDOWN, StatisticsListener::VALUE_TYPE_MEMORY).
            PHP_EOL);
    }

    public function endTest(PHPUnit_Framework_Test $test, $time)
    {
        $r = $test->getResult();
        if (is_array($r)) {
            $this->profiles[$r['scale']][$r['name']] = array($r['time'], $r['memory']);
        }
    }

    private function getValueGroups($valueFormat = StatisticsListener::VALUE_FORMAT_MARKDOWN, $valueType = StatisticsListener::VALUE_TYPE_TIME)
    {
        if ($valueFormat == StatisticsListener::VALUE_FORMAT_PLOT) {
            $groups = array();
            foreach ($this->profiles as $scale => $parserItem) {
                if (!isset($groups[$scale])) {
                    $groups[$scale] = array();
                }
                foreach ($parserItem as $parserName => $parserProfile) {
                    if (!isset($groups[$scale][$parserName])) {
                        $groups[$scale][$parserName] = array();
                    }
                    $groups[$scale][$parserName] = round($parserProfile[$valueType], 5);
                }
                $groups[$scale] = implode(',', $groups[$scale]);
            }
            return implode('|', $groups);
        } elseif ($valueFormat == StatisticsListener::VALUE_FORMAT_MARKDOWN) {
            $lines = array();
            $header = '';
            foreach ($this->profiles as $scale => $parserItem) {
                $lines[$scale] = '';
                $header = '|Scale|';
                foreach ($parserItem as $parserName => $parserProfile) {
                    $header .= $parserName.'|';
                    $lines[$scale] .= round($parserProfile[$valueType], 5).'|';
                }
                $lines[$scale] = '|' . $scale . ' nodes|'. $lines[$scale];
            }
            $header.=PHP_EOL;
            foreach(explode('|', $header) as $heading){
                if(strlen(chop($heading))<=0) continue;
                $header.='|'.str_repeat('-',strlen($heading));
            }
            array_unshift($lines, $header.'|');
            return implode(PHP_EOL, $lines);
        }
    }
}