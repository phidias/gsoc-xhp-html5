<?php
//VISUAL: yes
//CHROME: range and search widgets. validation for all the rest
//OPERA: all widgets except search and color
//XHP: widgets yes, validation no
echo <script src="/xhp-html5/html5-init.js"/>;
echo <div><strong>Types of input</strong></div>;
echo
<dl>
	<dt>range</dt>
	<dd><input type="range" min="0" max="50" value="0" /></dd>
	<dt>placeholder</dt>
    <dd><input type="text" placeholder="Search inside" /></dd>
    <dt>search</dt>
    <dd><input type="search"value="keyword" /></dd>
</dl>;
echo <div><strong>Input Validation:</strong></div>;
echo <style>{' :invalid { background-color: red; } '}</style>;
echo 
<dl>
	<dt>color</dt>
    <dd><input type="color" value="bear" /><input type="color" value="white" /></dd>
    
    <dt>number</dt>
    <dd><input type="number" value="abc" /><input type="number" value="2321" /></dd>

    <dt>email</dt>
    <dd><input type="email" value="some@emailcom" /><input type="email" value="some@email.com" /></dd>

    <dt>tel</dt>
    <dd><input type="tel" value="1234#$@#" /><input type="tel" value="123454343" /></dd>
    
    <dt>url</dt>
    <dd><input type="url"value="invalid url" /><input type="url"value="http:\/\/html5.com" /></dd>
    
    <dt>datetime</dt>
    <dd><input type="datetime" value="1986-12-25 15:00:00"/><input type="datetime" value="1985-05-24T12:00:00-04:00"/></dd>
    
    <dt>date</dt>
    <dd><input type="date" value="1985-05-2a"/><input type="date" value="1985-05-24"/></dd>
    
    <dt>month</dt>
    <dd><input type="month" value="1995-0a" /><input type="month" value="1995-02" /></dd>
    
    <dt>week</dt>
    <dd><input type="week" value="1995-0a" /><input type="week" value="1995-W12" /></dd>
    
    <dt>time</dt>
    <dd><input type="time" value="25:00" /><input type="time" value="18:00" /></dd>
    
    <dt>datetime-local</dt>
    <dd><input type="datetime-local" value="1985-05-24 12:00:00" /><input type="datetime-local" value="1985-05-24T12:00:00" /></dd>
</dl>;