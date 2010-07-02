--TEST--
test the datalist element
--FILE--
<?php
include("../php-lib/init-tests.php");
echo <datalist id="browsers"></datalist> . "\n";
echo <datalist id="browsers">
	<option label="Safari" value="safari" />
	<option label="Internet Explorer" value="ie" />
</datalist> . "\n";
echo <datalist>I dont know what this is <i>about</i></datalist>;
echo <datalist>I dont know what this is <option value="key" /></datalist>;
--EXPECTF--
<datalist id="browsers"></datalist>
<datalist id="browsers"><option label="Safari" value="safari"></option><option label="Internet Explorer" value="ie"></option></datalist>
<datalist>I dont know what this is <i>about</i></datalist>
Fatal error%s

