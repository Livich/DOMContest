<?php
namespace DomContest;

use QueryPath;

class QueryPathTest extends ProtoCase
{
    public function __construct()
    {
        $this->parserName = 'QueryPath';
    }

    public function testSelectorCSS()
    {
        $qp = html5qp($this->getMarinaHTML());
        $this->assertTrue($qp->find('script')->count() > 40, 'XPath selectors works');
    }

    public function testSelectorCSSLong()
    {
        $qp = html5qp($this->getMarinaHTML());
        $element = $qp->find($this->getLargeSelector());
        $this->assertTrue($element->attr('class') == 'homepage_featured_marinas', 'long XPath selectors works');
    }

    public function getFromLargeDOM($html)
    {
        $qp = html5qp($html);
        $elements = $qp->find('.node_0');
        return array($elements->toArray(), $qp);
    }
}
