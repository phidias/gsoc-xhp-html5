<?php
//VISUAL: yes
//CHROME: yes
//OPERA: yes
//FIREFOX: no
//XHP: yes
echo <html5init/>;
echo
<form action="demo/form.php">
	<dl>
		<dt>Horizontal range [default] (min=0, max=50, value=10)</dt>
		<dd><input type="range" name="range_A" min="0" max="50" value="10" /></dd>
	
		<dt>Vertical range (determined by the height/width ratio)</dt>
		<dd><input type="range" name="range_B" min="0" max="50" value="10" style="height:100px;width:30px"/></dd>
	
		<dt>Horizontal range with step (min=0, max=50, value=10 step=5)</dt>
		<dd><input type="range" name="range_C" min="0" max="50" value="10" step="5"/></dd>
		
		<dt>Vertical range with float values</dt>
		<dd><input type="range" name="range_B" min="0" max="100" value="10.5" step="0.02" style="height:100px;width:30px"/></dd>
	</dl>
	<input type="submit"/>
</form>;
