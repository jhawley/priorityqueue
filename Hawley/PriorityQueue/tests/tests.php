<?php
require_once(dirname(__FILE__) . '/simpletest/autorun.php');
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/autoload.php');

use Hawley\PriorityQueue\PriorityQueue;

class TestOfPriorityQueue extends UnitTestCase {    
    function testDefaultFunctionality() {
        $p = new PriorityQueue();
        $p->insert('A',3);
        $p->insert('B',6);
        $p->insert('C',1);
        $p->insert('D',2);
        $p->setExtractFlags(PriorityQueue::EXTR_BOTH);
        $current = $p->current();
        $this->assertEqual($current['priority'], 6);
        $p->next();
        $current = $p->current();
        $this->assertEqual($current['priority'], 3);
    }
    
    function testDefaultFunctionality2() {
        $p = new PriorityQueue();
        $p->insert('A',3);
        $p->insert('B',6);
        $p->insert('C',1);
        $p->insert('D',2);
        $p->setExtractFlags(PriorityQueue::EXTR_BOTH);
        $current = $p->current();
        $this->assertEqual($current['priority'], 6);
        $p->next();
        $current = $p->current();
        $this->assertEqual($current['priority'], 3);
    }
    
    function testComparatorFirst() {
        $p = new PriorityQueue();
        $p->setComparator(function($v1, $v2) {
            if($v1 === $v2) { return 0; }
            return ($v1 > $v2 ? -1 : 1);
        });
        $p->insert('A',3);
        $p->insert('B',6);
        $p->insert('C',1);
        $p->insert('D',2);
        $p->setExtractFlags(PriorityQueue::EXTR_BOTH);
        $current = $p->current();
        $this->assertEqual($current['priority'], 1);
        $p->next();
        $current = $p->current();
        $this->assertEqual($current['priority'], 2);
    }
    
    function testHeapify1() {
        $p = new PriorityQueue();
        $p->insert('A',3);
        $p->insert('B',6);
        $p->insert('C',1);
        $p->insert('D',2);
        $p->setExtractFlags(PriorityQueue::EXTR_BOTH);
        $current = $p->current();
        $this->assertEqual($current['priority'], 6);
        $p->next();
        $current = $p->current();
        $this->assertEqual($current['priority'], 3);
        $p->next();
        $p->setComparator(function($v1, $v2) {
            if($v1 === $v2) { return 0; }
            return ($v1 > $v2 ? -1 : 1);
        });
        $current = $p->current();
        $this->assertEqual($current['priority'], 1);
        $p->next();
        $current = $p->current();
        $this->assertEqual($current['priority'], 2);
    }
    
    function testHeapify2() {
        $p = new PriorityQueue();
        $p->setComparator(function($v1, $v2) {
            if($v1 === $v2) { return 0; }
            return ($v1 > $v2 ? -1 : 1);
        });
        $p->insert('A',3);
        $p->insert('B',6);
        $p->insert('C',1);
        $p->insert('D',2);
        $p->setExtractFlags(PriorityQueue::EXTR_BOTH);
        $current = $p->current();
        $this->assertEqual($current['priority'], 1);
        $p->next();
        $current = $p->current();
        $this->assertEqual($current['priority'], 2);
        $p->next();
        $p->removeComparator();
        $current = $p->current();
        $this->assertEqual($current['priority'], 6);
        $p->next();
        $current = $p->current();
        $this->assertEqual($current['priority'], 3);
    }
    
    function testException() {
        $p = new PriorityQueue();
        $this->expectException();
        $p->setComparator(1);
    }
}