--TEST--
test the new global attributes
--FILE--
<?php
include("../php-lib/init.php");
echo <figure><h1>Heading 1</h1><h2>Heading 2</h2></figure> . "\n";
echo <figure><figcaption>Caption on the top</figcaption><img src="logo.png"></img></figure> . "\n";
echo <figure><img src="logo.png"></img><figcaption>Caption on the bottom</figcaption></figure> . "\n";
echo <figure><img src="logo.png"></img><figcaption>Caption in the middle</figcaption><img src="logo2.png" /></figure> . "\n";
--EXPECTF--
<figure><h1>Heading 1</h1><h2>Heading 2</h2></figure>
<figure><figcaption>Caption on the top</figcaption><img src="logo.png" /></figure>
<figure><img src="logo.png" /><figcaption>Caption on the bottom</figcaption></figure>
%sFatal error:%s
