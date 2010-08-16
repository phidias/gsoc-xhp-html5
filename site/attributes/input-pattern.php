<?php
//CHROME: yes
//FIREFOX: no
//OPERA: yes
//XHP: yes
echo <html5init/>;
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
echo 
<ul>
	<li>Part Number: A part number is a digit followed by three uppercase letters.</li>
	<li>Full Name: A full name is two words (no leading or following spaces)</li>
</ul>;