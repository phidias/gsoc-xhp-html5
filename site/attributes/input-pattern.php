<?php
//CHROME: yes
//FIREFOX: no
//OPERA: yes
//XHP: yes
echo <script src="/xhp-html5/html5-init.js"/>;
echo 
<form action="demo/form.php">
	<label> Part number:
	 <input pattern="[0-9][A-Z]{3}" name="part"
	        title="A part number is a digit followed by three uppercase letters."/>
	</label>
	<label> Full name:
	 <input pattern="\w+\s+\w+" name="fname"
	        title="A full name is two words (no leading or following spaces)"/>
	</label>
	<input type="submit"/>
</form>;