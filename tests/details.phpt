--TEST--
test the details element (with(out) summary)
--FILE--
<?php
include("../php-lib/init-tests.php");
echo <details><summary>Summary</summary> and some text</details> . "\n";
echo <details>no summary but some text</details> . "\n";
--EXPECT--
<details><summary>Summary</summary> and some text</details>
<details>no summary but some text</details>
