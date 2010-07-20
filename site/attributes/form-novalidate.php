<?php
//VISUAL: yes
//CHROME: yes
//OPERA: yes
//FIREFOX: no
//XHP: yes
echo <script src="/xhp-html5/html5-init.js"/>;
echo <p>Even though the form elements are marked as required, it should ignore it (no validation)</p>;
echo <p>This form should submit (novalidate = true)</p>;
echo 
<form action="demo/form.php" novalidate="true">
	<input type="text" name="input1" required="true"/>
	<textarea name="input2" required="true"/>
	<input type="submit"/>
</form>;
echo <p>This form should not submit (novalidate = false)</p>;
echo 
<form action="demo/form.php">
	<input type="text" name="input1" required="true"/>
	<textarea name="input2" required="true"/>
	<input type="submit"/>
</form>;