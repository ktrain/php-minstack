<?php

require_once('MinStack.php');
require_once('MinStackNative.php');
require_once('MinStackManual.php');

function output($value, $label=null)
{
    if ($label) {
        echo "$label: [$value]\n";
        return;
    }

    echo "$value\n";
}

/**
 * Add $n/2 elements to the stack,
 * then randomly push and pop $n elements.
 * After every push() or pop(), call min() and top().
 *
 * @param MinStack $s, int n
 * @return MinStack $s
 */
function stress(MinStack $s, $n)
{
    foreach (range(0, $n / 2) as $i) {
        $s->push(rand());
        $s->min();
        $s->top();
    }
    foreach (range(0, $n) as $i) {
        if (rand() & 1) {
            $s->push(rand());
        } else {
            $s->pop();
        }
        $s->min();
        $s->top();
    }

    return $s;
}

$n = 2000000;
$s = new MinStackNative();

$start = round(microtime(true) * 1000);
stress($s, $n);
$finish = round(microtime(true) * 1000);
$time = $finish - $start;

output("$time ms", "native time for $n iterations");


$s = new MinStackManual();

$start = round(microtime(true) * 1000);
stress($s, $n);
$finish = round(microtime(true) * 1000);
$time = $finish - $start;

output("$time ms", "track time for $n iterations");
