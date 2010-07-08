<?php
//VISUAL: no
//CHROME: no
//OPERA: yes
//XHP: todo
echo <p>Start typing the name of a popular browser. A drop-down box should appear</p>;
echo
<section>
	<input list="browsers" />
	<datalist id="browsers">
	 <option value="Safari"/>
	 <option value="Internet Explorer"/>
	 <option value="Opera"/>
	 <option value="Firefox"/>
	</datalist>
</section>;