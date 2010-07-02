--TEST--
test the article element (source etc)
--FILE--
<?php
include("../php-lib/init-tests.php");
echo <article><p>hi sweetie!</p></article> . "\n";
echo <article><hgroup><h1>sweetie!</h1></hgroup></article> . "\n";
--EXPECTF--
<article><p>hi sweetie!</p></article>
<article><hgroup><h1>sweetie!</h1></hgroup></article>
