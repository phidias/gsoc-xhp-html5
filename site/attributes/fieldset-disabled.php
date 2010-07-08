<?php
//VISUAL: yes
//CHROME: no
//OPERA: yes
//XHP: todo
echo
<fieldset name="clubfields" disabled="true">
 <legend> <label>
  <input type="checkbox" name="club" onchange="form.clubfields.disabled = !checked"/>
  Use Club Card
 </label></legend>
 <p><label>Name on card: <input name="clubname" required="true"/></label></p>
 <p><label>Card number: <input name="clubnum" required="true" pattern="[-0-9]+"/></label></p>
 <p><label>Expiry date: <input name="clubexp" type="month"/></label></p>
</fieldset>;