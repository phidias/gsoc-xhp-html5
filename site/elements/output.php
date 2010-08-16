<?php
//VISUAL: yes
//CHROME: no
//OPERA: yes
//XHP: no
echo
<form onsubmit="return false">
 <input name="a" type="number" step="any"/> +
 <input name="b" type="number" step="any"/> =
 <output onforminput="value = a.valueAsNumber + b.valueAsNumber"></output>
</form>;