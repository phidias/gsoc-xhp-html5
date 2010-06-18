--TEST--
test the new global attributes
--FILE--
<?php
include("../php-lib/init.php");
echo <b contenteditable="" draggable="true">hi!</b> . "\n";
echo <b contenteditable="true" hidden="false" spellcheck="">hi!</b> . "\n";
echo <b contenteditable="false" hidden="sadf">hi!</b> . "\n";
try {
  echo <b contenteditable="error">hi!</b>;
} catch (Exception $e) {
  echo "pass";
}
--EXPECTF--
<b contenteditable="" draggable="true">hi!</b>
<b contenteditable="true" spellcheck="">hi!</b>
<b contenteditable="false" hidden="1">hi!</b>

Notice:%s
pass
