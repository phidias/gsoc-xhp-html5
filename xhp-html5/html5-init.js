/*  
    LazyJS. Lazy-load your javascripts.
    Version 1.0 11/04/2010
    
    Copyright (c) 2010 Alex Michael
    
    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:
    
    The above copyright notice and this permission notice shall be included in
    all copies or substantial portions of the Software.
    
    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
    THE SOFTWARE.
    
*/

var LazyJS = new function()
{

    /* Global _STATE_ array. Holds current state data and registered scripts. */
    var _STATE_      = {queue: [], dir: ""};
    var _BUCKET_     = 0;
    var _LOAD_INDEX_ = 0;
        
    /*------- INTERNALS --------*/
    
    /* Deques the head of the script queue, and executes the function object. Accordingly, it waits for the script to finish downloading
     * or it continues with the next one in the queue.
     * 
     * @no params
     */
    var next = function()
    {        
        var bucket_queue = _STATE_.queue[_LOAD_INDEX_];
        if (bucket_queue.scripts.length < 1 )
        {
            _STATE_.queue.splice(_LOAD_INDEX_,_LOAD_INDEX_);
            bucket_queue = _STATE_.queue[++_LOAD_INDEX_];
            if (!bucket_queue)
            {
                _LOAD_INDEX_ = 0; _BUCKET_ = 0;
            }
            else 
            {
                window.setTimeout(next, bucket_queue.delay);
            }
            return;
        }
        
        var script = bucket_queue.scripts.shift()();
        if (script && script.__isExternal === true)
        {
            document.body.appendChild(script.node);
            waitFor(script);
        }
        else
        {
            next();
        }
    };
        
    
     
    /* Wait for the script to be fully downloaded. Essential in cases where scripts have dependencies on each other or a method needs to be
    * called after the script has been loaded (i.e an init method).
    *
    * @DOMScriptElement script -- The script we need to wait for.
    * @Fuction loadCallback -- A function to be called once the script has finished downloading.
    */
    var waitFor = function(script)
    {
        var node = script.node;
        function _onload(script)
        {
             script.loadCallback(); 
             if (script.inSequence){next();}
        }   
        
        if (node.readyState)
        { 
             node.onreadystatechange = function(){
                 if (node.readyState === "loaded" || node.readyState === "complete"){ _onload(script);}
             }; 
        } 
        else
        {   
             node.onload = function(){_onload(script);};
        }
        
        if (!script.inSequence){next();}
    };
    
    /* Internal method for creating a script DOM node.
     *
     * @String script -- The filename of the script to be registered.
     */
    var createNode = function(script)
    {
        var scriptElement = document.createElement('script');
        scriptElement.type = 'text/javascript';
        var protocols = ["http://", "https://", "ftp://"];
        var p_l = protocols.length;
        scriptElement.src = _STATE_.dir + script;

        for (var i = 0; i < p_l; ++i)
        {
            if (script.indexOf(protocols[i]) > -1)
            {
                scriptElement.src = script; 
            }
        }
         
        return scriptElement;         
    };
    
    /* Internal method for registering a script in the queue.
     *
     * @String scriptName -- The filename of the script to be registered.
     * @Boolean loadCallback -- A function to be called once the script has finished downloading.
     * @Boolean inSequence -- A flag indicating whether this script has any dependend scripts and thus should be waitedFor.
     */
    var _register = function(scriptName, loadCallback, inSequence)
    {
        var scriptFn = function() {return {node        : createNode(scriptName), 
                                           inSequence  : inSequence,
                                           __isExternal: true,
                                           loadCallback: loadCallback};};
        __register(scriptFn);
    };
    
    /* It all comes down to this....
     *
     * @String scriptFunction -- The script to be registered.
     */
    var __register = function(scriptFn)
    {
        if (!_STATE_.queue[_BUCKET_])
        {
            _STATE_.queue[_BUCKET_] = {scripts: [], delay: 0};
        }
        _STATE_.queue[_BUCKET_].scripts.push(scriptFn);
    };
    
    /*------- PUBLIC API -------*/
    
    /* Append (all external scripts) and execute (all inline scripts) that have been registered for this site. This method is better called
     * at the END of your document just before the closing body tag (</body>) for two reasons:
     * (1) The document will be fully loaded so you avoid any non-loaded element lookups.
     * (2) The document will be loaded without waiting for any scripts to load first, so there is an obvious performance gain.
     *
     * The scripts will be loaded according to any delay parameters set.
     *
     * @no params
     */
    this.load = function()
    {
        var bucket = _STATE_.queue[_LOAD_INDEX_];
        if (bucket)
        {
            window.setTimeout(next, bucket.delay);     
        }
    };
    
    /* Register an inline script for execution. An inline script is a script embedded in the HTML document like so:
     *
     * <script type='text/javascript'>
     *      ... blah ...
     * </script>
     *
     * All you need to do is wrap your inline code in a function and pass it in as an argument to this method. It
     * would be easier if you use a variable to reference your function wrapper and pass that as a parameter.
     *
     * @Function inlineScript -- The inline script to be registered (wrapped in a function).
     */
    this.inline = function(inlineScript)
    {
        if (inlineScript && typeof inlineScript === "function") 
        {
            __register(inlineScript); 
            return this;
        }    
    };
    
    
    /* Register an external script to be included in the site.
     *
     * @String externalScriptName -- The filename of the script to be registered, ignoring the '.js' extension. 
     * @Boolean inSequence -- A flag indicating whether this script has any dependend scripts and thus should be waitedFor.
     * @Function loadCallback -- The function to be called once the script has finished loading. [optional]
     */
    this.external = function(externalScriptName, inSequence, loadCallback)
    {
        if (externalScriptName &&
           (externalScriptName.constructor.toString().match(/string/i) ||
            typeof externalScriptName === "string" )) 
        {
            _register(externalScriptName, (loadCallback || function(){}), (inSequence || false));
            return this;
        }
    };
    
    /* Register many external scripts to be included in the site.
     *
     * @Array(of Strings) scriptsToRegister -- The filename of the script to be registered.
     */
    this.externals = function(scriptsToRegister)
    {
        if (!scriptsToRegister){return;}
        
        var sequence = (scriptsToRegister.sequence || []), parallel = (scriptsToRegister.parallel || []);
        var s_l = sequence.length, p_l = parallel.length;
        var all = sequence.concat(parallel), all_l = all.length;

        if (all_l === 0 || scriptsToRegister.constructor.toString().match(/array/i)) 
        {
            all = scriptsToRegister; all_l = all.length;
        }
        var stub = function(){};
        for (var i = 0; i < all_l; ++i)
        {   
            _register(all[i], stub, (i < s_l));
        }
        
        return this;
    };
    
    /* Set a delay for loading the scripts. This is useful when separating the js load to what's "essential" and what's "extra". The "extras" 
     * can be loaded with a delay afterwards. 
     * 
     * @Integer millis -- The delay in milliseconds.
     */
    this.after = function(millis)
    {
        var bucket = _STATE_.queue[_BUCKET_];
        if (bucket)
        {
            _STATE_.queue[_BUCKET_].delay = millis;
            ++_BUCKET_;
            return this;
        }
    };
    
    /* Set the directory where the JS scripts reside. The trailing slash needs to be included in the string passed as directory. 
     *
     * @String dir -- The directory e.g /resource/js/
     */
    this.directory = function(dir)
    {
        _STATE_.dir = dir;
        return this;
    };
};


LazyJS.directory("/xhp-html5/");
LazyJS.externals( {sequence : ["jquery.js","jquery.lazy.js","html5.js"]} );
LazyJS.inline( function() {
/*	$.lazy({
	    src: '/xhp-html5/jquery.autocomplete.min.js',
	    name: 'autocomplete',
	    dependencies : {
			css: ["/xhp-html5/jquery.autocomplete.css"]
		},
		cache: true
	});*/
	$.lazy({
	    src: '/xhp-html5/colorpicker/js/colorpicker.js',
	    name: 'ColorPicker',
	    dependencies : {
			css: ["/xhp-html5/colorpicker/css/colorpicker.css"]
		},
//		cache: true
	});
	$.lazy({
		src: '/xhp-html5/jquery-ui/js/jquery-ui-1.8.2.custom.min.js',
		name: 'autocomplete',
		dependencies : {
			css : ["/xhp-html5/jquery-ui/css/smoothness/jquery-ui-1.8.2.custom.css"]
		},
//		cache: true
	});
	$.lazy({
		src: '/xhp-html5/jquery-ui/js/jquery-ui-1.8.2.custom.min.js',
		name: 'datepicker',
		dependencies : {
			css : ["/xhp-html5/jquery-ui/css/smoothness/jquery-ui-1.8.2.custom.css",
			       "/xhp-html5/jquery-ui/css/smoothness/html5.css"]
		},
//		cache: true
	});
	$.lazy({
		src: '/xhp-html5/jquery-ui/js/ui.spinner.js',
		name: 'spinner',
		dependencies: {
			css: ['/xhp-html5/jquery-ui/css/ui.spinner.css']
		},
//		cache: true
	});
	$.lazy({
		src: '/xhp-html5/timepicker/jquery-ui-timepicker-addon-0.5.js',
		name: 'datetimepicker',
		dependencies : {
			js : ['/xhp-html5/jquery-ui/js/jquery-ui-1.8.2.custom.min.js'],
			css : ['/xhp-html5/timepicker/jquery-ui-timepicker.css',
			       "/xhp-html5/jquery-ui/css/smoothness/jquery-ui-1.8.2.custom.css",
			       "/xhp-html5/jquery-ui/css/smoothness/html5.css"]
		},
//		cache: true
	});
	$.lazy({
		src: '/xhp-html5/timepicker/jquery-ui-timepicker-addon-0.5.js',
		name: 'timepicker',
		dependencies : {
			js : ['/xhp-html5/jquery-ui/js/jquery-ui-1.8.2.custom.min.js'],
			css : ['/xhp-html5/timepicker/jquery-ui-timepicker.css',
			       "/xhp-html5/jquery-ui/css/smoothness/jquery-ui-1.8.2.custom.css",
			       "/xhp-html5/jquery-ui/css/smoothness/html5.css"]
		},
//		cache: true
	});
});

var old = window.onload ? window.onload : function() {};
window.onload = function () { old(); LazyJS.load() };