<?php 

require_once "lib/sanify.php";

$email = "greta<script>@msail.col";
$number = 0;
$string = "Ciaomondo";
$text = "Ciao mondo";
$uuid = "4563782-2812-1289-912091282102102";


echo Sanify::Email($email);

echo Sanify::Number($number);

echo Sanify::String($string, "");

echo Sanify::Text($text);

echo Sanify::Uuid($uuid);

?>