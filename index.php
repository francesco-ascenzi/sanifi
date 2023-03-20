<?php 

require_once "lib/sanify.php";

$text = "74839281-2839-2812-8493-182930493829";

$res = Sanify::Uuid($text);

echo print_r($res);

// $time = $res["time"] - microtime(true);

// echo $time;



/* 

Sanify email time - 0.003 ms 



*/