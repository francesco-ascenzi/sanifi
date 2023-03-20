<?php 

require_once "lib/sanify.php";

$text = "Ciao mondo<script>";

echo Sanify::Text($text);

?>