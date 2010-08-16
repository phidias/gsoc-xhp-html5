<?php
//CHROME: yes
//FIREFOX: no
//XHP: yes
echo <html5init/>;
echo
<form action="demo/form.php">
<dl>
	<dt>url</dt>
	<dd><input type="url" name="url_invalid" value="invalid url" /><input type="url" name="url_valid" value="http://html5.com" /></dd>
	<dt>number</dt>
    <dd><input type="number" value="abc" /><input type="number" value="2321" /></dd>
	<dt>email</dt>
    <dd><input type="email" value="some@emailcom" /><input type="email" value="some@email.com" /></dd>
    <dt>datetime</dt>
    <dd><input type="datetime" value="1986-12-25 15:00:00"/><input type="datetime" value="1985-05-24T12:00:00+04:00"/><input type="datetime" value="1985-05-24T12:00:00Z"/><input type="datetime" value="1985-05-24T12:00-02:00"/></dd>
    <dt>date</dt>
    <dd><input type="date" value="1985/05/2a"/><input type="date" value="1985-05-24"/></dd>
    <dt>month</dt>
    <dd><input type="month" value="1995-0a" /><input type="month" value="1995-02" /></dd>
    <dt>week</dt>
    <dd><input type="week" value="1995-0a" /><input type="week" value="1995-W12" /></dd>
    <dt>time</dt>
    <dd><input type="time" value="25:00" /><input type="time" value="18:00" /></dd>
    <dt>datetime-local</dt>
    <dd><input type="datetime-local" value="1985-05-24 12:00:00" /><input type="datetime-local" value="1985-05-24T12:00:00" /></dd>
    
    <dd><input type="submit"/></dd>
</dl>
</form>;