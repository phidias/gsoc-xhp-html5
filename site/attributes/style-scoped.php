<?php
//VISUAL: no
//CHROME: no
//OPERA: no
//XHP: no
echo
<div>
	<style scoped="true">{'
		p {
			background-color: red;
			color: white;
		}
	'}</style>
	<p>Example scoped paragraph (should be red with white text)</p>
</div>;
echo 
<div>
	<p>Example paragraph out of style's scope. Should be white background and black text</p>
</div>;