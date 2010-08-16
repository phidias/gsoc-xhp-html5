<?php
//VISUAL: yes
//CHROME: no
//OPERA: no
//XHP: yes
echo <html5init/>;
echo 
<section>
 <p>Loading: <progress id="p" max="100" style="width:200px;height:20px"></progress></p>
 <p>Task Progress</p>
 <p>Progress: <progress value="2" max="10" style="width:100px; height: 8px"><span>20</span>%</progress></p>
 <p>Progress: <progress id="p3" value="0" max="20" style="width:100px; height: 8px"></progress></p>
 <button onclick="document.getElementById('p3').decProgress(2);">Decrease Progress</button>
 <button onclick="document.getElementById('p3').incProgress(2);">Increase Progress</button>
</section>;