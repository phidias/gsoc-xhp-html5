<?php
//VISUAL: yes
//CHROME: no
//OPERA: no
//XHP: yes (not perfect)
echo <p>The list order should be descending</p>;
echo
<ol reversed="true">
	<li>item a</li>
	<li>item b</li>
	<li>item c</li>
</ol>;
echo
<ol reversed="true" start="10">
	<li>item a</li>
	<li>item b</li>
	<li></li>
</ol>;