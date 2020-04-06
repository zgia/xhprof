--TEST--
XHProf: Test Sampling Interval
Author: longxinhui
--INI--
xhprof.sampling_interval = 400000
--FILE--
<?php

include_once dirname(__FILE__).'/common.php';

function foo() {
   // sleep 0.8 seconds
   usleep(800000);
}

function bar() {
   foo();
}

function goo() {
    bar();
}

// call goo() once
xhprof_sample_enable();
goo();
$output = xhprof_sample_disable();
$interval = array_keys($output);
if (sprintf("%.6f", $interval[1] - $interval[0]) == '0.400000') {
    echo 'Test passed';
}

echo "\n";

?>
--EXPECTF--
Test passed
