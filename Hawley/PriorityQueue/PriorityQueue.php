<?php

namespace Hawley\PriorityQueue;

class PriorityQueue extends \SplPriorityQueue {
    private $comparator = null;
    
    public function setComparator($function) {
        if(!is_callable($function)) {
            throw new \InvalidArgumentException("Argument must be a function");
        }
        $this->comparator = array($function);
        $this->heapify();
    }
    
    public function removeComparator() {
        $this->comparator = null;
        $this->heapify();
    }
    
    protected function heapify() {
        $pq = clone $this;
        foreach($this as $item) {
            $this->extract();
        }
        $pq->setExtractFlags(PriorityQueue::EXTR_BOTH);
        foreach($pq as $item) {
            $this->insert($item['data'], $item['priority']);
        }
    }
    
    public function compare($priority1, $priority2) {
        if(is_null($this->comparator)) {
            return parent::compare($priority1, $priority2);
        } else {
            return $this->comparator[0]($priority1, $priority2);
        }        
    }
}

