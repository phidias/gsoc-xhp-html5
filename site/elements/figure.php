<?php
//VISUAL: yes
//CHROME: no
//XHP: yes
echo <p>paragraph 1</p>;
echo 
	<figure>
		<img src="images/image1.jpg" width="130"/>
		<figcaption>This is the caption of the image (bottom)</figcaption>
	</figure>;
echo <p>paragraph 2</p>;
echo 
	<figure>
		<figcaption>This is the caption of the image (top)</figcaption>
		<img src="images/image1.jpg" width="130"/>
	</figure>;
echo <p>paragraph 3</p>;
echo 
	<figure>
 		<p>'Twas brillig, and the slithy toves<br/>
		 Did gyre and gimble in the wabe;<br/>
		 All mimsy were the borogoves,<br/>
		 And the mome raths outgrabe.</p>
		 <figcaption><cite>Jabberwocky</cite> (first verse). Lewis Carroll, 1832-98</figcaption>
	</figure>;
echo <p>paragraph 4</p>;
