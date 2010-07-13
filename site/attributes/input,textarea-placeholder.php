<?php
//VISUAL: yes
//CHROME: yes
//OPERA: no
//XHP: yes
echo <script src="/xhp-html5/html5-init.js"/>;

echo
<dl>
	<dt>placeholder</dt>
    <dd><input type="text" placeholder="Search inside" /></dd>
    <dt>placeholder</dt>
    <dd><input type="text" placeholder="Search inside" value="predefined value" /></dd>
    <dt>placeholder</dt>
    <dd><input type="text" placeholder="Search inside" value="predefined value" style="color:green"/></dd>
    <dt>placeholder on textarea</dt>
    <dd><textarea placeholder="Type your text here"/></dd> 
</dl>;

echo 
<div>
	<p>submitting placeholder</p>
    <form action="demo/form.php" method="get">
    	<input type="text" placeholder="Search inside" name="input1" value="predefined value" style="color:green"/>
    	<textarea name="input2" placeholder="Type your text here"/>
    	<input type="submit" value="Submit"/>
    </form>
</div>;