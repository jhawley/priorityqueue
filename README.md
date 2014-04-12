# Purpose
To provide a flexible priority queue with injectable comparator

# Example
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

# Limitations
This implementation will heapify when the comparator is changed or removed, but the implementation is probably suboptimal (priority queue is cloned, comparator is changed, priority queue is emptied, and all items are re-inserted from the cloned priority queue).

# Installation
This requires a version of PHP that supports lambda expressions.  To add / run tests, install simpletest in Hawley/PriorityQueue/tests/simpletest.

# License
Public domain without warranties