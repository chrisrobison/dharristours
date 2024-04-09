<?php

$json = '{"x": 1, "y": [ "a", "b", "c"], "z": { "a": 1, "b":2 }}';

$x = json_decode($json);

print_r($x);
