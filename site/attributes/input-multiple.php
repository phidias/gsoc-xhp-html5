<?php
//VISUAL: yes
//CHROME: no
//OPERA: yes
//XHP: yes
echo <script src="/xhp-html5/html5-init.js"/>;
echo <p>Start typing the name of a popular browser. A drop-down box should appear. Type in as many </p>;
echo
<section>
	<datalist id="browsers">
	 <option value="Safari"/>
	 <option value="Internet Explorer"/>
	 <option value="Opera"/>
	 <option value="Firefox"/>
	</datalist>
	<input list="browsers" multiple="true" />
</section>;