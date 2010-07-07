<?php
//VISUAL: yes
//CHROME: yes
//OPERA: yes
echo <p>Even though the form elements are marked as required, it should ignore it (no validation)</p>;
echo 
<form action="demo/form.php" novalidate="true">
	<input type="text" name="input1" required="true"/>
	<textarea name="input2" required="true"/>
	<input type="submit"/>
</form>;