--TEST--
test the children of the ruby element rp and rt
--FILE--
<?php
include("../php-lib/init-tests.php");
echo <ruby>
 漢 <rp>(</rp><rt>かん</rt><rp>)</rp>
 字 <rp>(</rp><rt>じ</rt><rp>)</rp>
</ruby> . "\n";
echo <ruby> 漢 <rp>(</rp><rt>かん</rt><rp>)</rp></ruby> . "\n";
echo <ruby> 漢 <rt>かん</rt></ruby>;
--EXPECT--
<ruby> 漢 <rp>(</rp><rt>かん</rt><rp>)</rp>
 字 <rp>(</rp><rt>じ</rt><rp>)</rp></ruby>
<ruby> 漢 <rp>(</rp><rt>かん</rt><rp>)</rp></ruby>
<ruby> 漢 <rt>かん</rt></ruby>
