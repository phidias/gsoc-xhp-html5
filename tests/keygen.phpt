--TEST--
test the attributes of the keygen element
--FILE--
<?php
include("../php-lib/init.php");
echo <form action="processkey.cgi" method="post" enctype="multipart/form-data">
 <p><keygen name="key" keytype="rsa" disabled="true" /></p>
 <p><input type="submit" value="Submit key..." /></p>
</form>;
--EXPECT--
<form action="processkey.cgi" method="post" enctype="multipart/form-data"><p><keygen name="key" keytype="rsa" disabled="1" /></p><p><input type="submit" value="Submit key..." /></p></form>
