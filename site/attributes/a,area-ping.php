<?php
//CHROME: no
//OPERA: no
//VISUAL: no
//XHP: yes
echo <html5init/>;
echo <iframe src="demo/ping1.php?show=true"/>;
echo <iframe src="demo/ping2.php?show=true"/>;

echo <a href="" ping="demo/ping1.php demo/ping2.php">link to this page (pings 2 other pages)</a>;

echo
<img src="images/planets.gif" width="145" height="126" alt="Planets" usemap="#planetmap" />;

echo
<map name="planetmap">
  <area shape="rect" coords="0,0,82,126" alt="Sun" href="" ping="demo/ping1.php demo/ping2.php"/>
  <area shape="circle" coords="90,58,3" alt="Mercury" href="" ping="demo/ping1.php demo/ping2.php"/>
  <area shape="circle" coords="124,58,8" alt="Venus" href="" ping="demo/ping1.php demo/ping2.php"/>
</map>;