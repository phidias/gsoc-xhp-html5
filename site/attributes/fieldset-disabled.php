<?php
//VISUAL: yes
//CHROME: no
//OPERA: yes
//FIREFOX: no
//XHP: yes (90%)
echo <script src="/xhp-html5/html5-init.js"/>;
echo
<fieldset name="clubfields" disabled="true">
 <legend><label>
  <input type="checkbox" name="club" onchange="form.clubfields.disabled = !checked"/>
  Use Club Card
 </label></legend>
 <p><label>Name on card: <input name="clubname" required="true"/></label></p>
 <p><label>Card number: <input name="clubnum" required="true" pattern="[-0-9]+"/></label></p>
 <p><label>Expiry date: <input name="clubexp" type="month"/></label></p>
 <p><label>Textarea <textarea name="tarea"></textarea></label></p>
 <p><label>Select <select name="sel"><option>Option1</option><option>Option2</option></select></label></p>
</fieldset>;
echo
<p><label>Outside fieldset <input type="text"/></label></p>;