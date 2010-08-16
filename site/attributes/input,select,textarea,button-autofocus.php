<?php
//VISUAL: yes
//CHROME: yes
//OPERA: yes
//FIREFOX: no
//XHP: yes
echo <html5init/>;
echo <p>Refresh the page to randomly focus one of the following inputs</p>;
$r = rand(1,4);
echo <p>Focus now should be on input: <strong>{$r}</strong></p>;
echo
<dl>
	<dt>input 1</dt>
	<dd><input type="text" autofocus={$r == 1 ? "true" : "false"}/></dd>

	<dt>input 2</dt>
	<dd>
	<select autofocus={$r == 2 ? "true" : "false"}>
		<option>option 1</option>
		<option>option 2</option>
	</select>
	</dd>

	<dt>input 3</dt>
	<dd><textarea autofocus={$r == 3 ? "true" : "false"}/></dd>

	<dt>input 4</dt>
	<dd><button type="button" autofocus={$r == 4 ? "true" : "false"}>Click me!</button></dd>
</dl>;