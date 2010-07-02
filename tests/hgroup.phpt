--TEST--
test the new global attributes
--FILE--
<?php
include("../php-lib/init-tests.php");
echo <hgroup><h1>Heading 1</h1><h2>Heading 2</h2></hgroup> . "\n";
--EXPECT--
<hgroup><h1>Heading 1</h1><h2>Heading 2</h2></hgroup>
