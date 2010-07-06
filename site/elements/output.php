<?php
//VISUAL: yes
//CHROME: no
//OPERA: yes
echo
<form onsubmit="return false">
 <input name="a" type="number" step="any"/> +
 <input name="b" type="number" step="any"/> =
 <output onforminput="value = a.valueAsNumber + b.valueAsNumber"></output>
</form>;