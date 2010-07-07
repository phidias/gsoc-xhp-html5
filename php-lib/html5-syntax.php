<?php
/*
  +----------------------------------------------------------------------+
  | XHP                                                                  |
  +----------------------------------------------------------------------+
  | Copyright (c) 2009 - 2010 Facebook, Inc. (http://www.facebook.com)   |
  +----------------------------------------------------------------------+
  | This source file is subject to version 3.01 of the PHP license,      |
  | that is bundled with this package in the file LICENSE.PHP, and is    |
  | available through the world-wide-web at the following url:           |
  | http://www.php.net/license/3_01.txt                                  |
  | If you did not receive a copy of the PHP license and are unable to   |
  | obtain it through the world-wide-web, please send a note to          |
  | license@php.net so we can mail you a copy immediately.               |
  +----------------------------------------------------------------------+
*/

/**
 * This is the base library of HTML elements for use in XHP. This includes all
 * non-deprecated tags and attributes. Elements in this file should stay as
 * close to spec as possible. Facebook-specific extensions should go into their
 * own elements.
 */
abstract class :xhp:html-element extends :x:primitive {

  // TODO: Break these out into abstract elements so that elements that need
  // them can steal the definition. Right now this is an overloaded list of
  // attributes.
  attribute
    // HTML attributes
    string accesskey, string class, enum { "", "true", "false" } contenteditable,
    string contextmenu, string dir, enum { "true", "false" } draggable, 
    bool hidden, string id, string lang, enum { "", "true", "false" } spellcheck,
    string style, string tabindex, string title,


    // Javascript events
    string onabort, string onblur, string onchange, string onclick,
    string ondblclick, string onerror, string onfocus, string onkeydown,
    string onkeypress, string onkeyup, string onload, string onmousedown,
    string onmousemove, string onmouseout, string onmouseover, string onmouseup,
    string onreset, string onresize, string onselect, string onsubmit,
    string onunload,
    
    //HTML5 events
    string oncanplay, string oncanplaythrough, string oncontextmenu, string ondrag,
    string ondragend, string ondragenter, string ondragleave, string ondragover,
    string ondragstart, string ondrop, string ondurationchange, string onemptied,
    string onended, string onformchange, string onforminput, string oninput,
    string oninvalid, string onloadeddata, string onloadedmetadata, string onloadstart,
    string onmousewheel, string onplay, string onplaying, string onprogress,
    string onratechange, string onreadystatechange, string onscroll, string onseeked,
	string onseeking, string onshow, string onstalled, string onsuspend, 
	string ontimeupdate, string onvolumechange, string onwaiting,

    // IE only
    string onmouseenter, string onmouseleave,

    // Joe Hewitt!!
    // TODO:
    string selected, string otherButtonLabel, string otherButtonHref,
    string otherButtonClass, string type, string replaceCaret,
    string replaceChildren;


  protected
    $tagName;

  public function requireUniqueId() {
    // TODO: Implement something on AsyncRequest that returns the number of
    //       requests sent so far so we can remove the microtime(true) thing.
    if (!($id = $this->getAttribute('id'))) {
      $this->setAttribute('id', $id = substr(md5(mt_rand(0, 100000)), 0, 10));
    }
    return $id;
  }

  protected final function renderBaseAttrs() {
    $buf = '<'.$this->tagName;
    foreach ($this->getAttributes() as $key => $val) {
      if ($val !== null && $val !== false) {
        $buf .= ' ' . htmlspecialchars($key) . '="' . htmlspecialchars($val, true) . '"';
      }
    }
    return $buf;
  }

  public function addClass($class) {
    $class = trim($class);

    $currentClasses = $this->getAttribute('class');
    $has = strpos(' '.$currentClasses.' ', ' '.$class.' ') !== false;
    if ($has) {
      return $this;
    }

    $this->setAttribute('class', trim($currentClasses.' '.$class));
    return $this;
  }

  protected function stringify() {
    $buf = $this->renderBaseAttrs() . '>';
    foreach ($this->getChildren() as $child) {
      $buf .= :x:base::renderChild($child);
    }
    $buf .= '</'.$this->tagName.'>';
    return $buf;
  }
}

/**
 * Subclasses of :xhp:html-singleton may not contain children. When rendered they
 * will be in singleton (<img />, <br />) form.
 */
abstract class :xhp:html-singleton extends :xhp:html-element {
  children empty;

  protected function stringify() {
    return $this->renderBaseAttrs() . ' />';
  }
}

/**
 * Subclasses of :xhp:pseudo-singleton may contain exactly zero or one
 * children. When rendered they will be in full open\close form, no matter how
 * many children there are.
 */
abstract class :xhp:pseudo-singleton extends :xhp:html-element {
  children (pcdata)*;

  protected function escape($txt) {
    return htmlspecialchars($txt);
  }

  protected function stringify() {
    $buf = $this->renderBaseAttrs() . '>';
    if ($children = $this->getChildren()) {
      $buf .= :x:base::renderChild($children[0]);
    }
    return $buf . '</'.$this->tagName.'>';
  }
}

abstract class :xhp:media-element extends :xhp:html-element {
  attribute
    bool autoplay, bool controls, bool loop, 
    enum { "none", "metadata", "auto" } preload,
    string src;
  category %flow, %phrase;
  children (:source*, (pcdata|%flow)*);
}

/**
 * Below is a big wall of element definitions. These are the basic building
 * blocks of XHP pages.
 */
class :a extends :xhp:html-element {
  attribute
    string href, string media, string name, string ping, string rel,
    string target;
  category %flow, %phrase, %interactive;
  // transparent
  // may not contain %interactive
  children (pcdata | %flow)*;
  protected $tagName = 'a';
}

class :abbr extends :xhp:html-element {
  category %flow, %phrase;
  children (pcdata | %phrase)*;
  protected $tagName = 'abbr';
}

class :address extends :xhp:html-element {
  category %flow;
  // may not contain h1-h6
  children (pcdata | %flow)*;
  protected $tagName = 'address';
}

class :area extends :xhp:html-singleton {
  attribute 
    string alt, string coords, string href, string media, string ping,
    string rel, string target;
  protected $tagName = 'area';
}

class :article extends :xhp:html-element {
  category %flow;
  children (pcdata | %flow)*;
  protected $tagName = 'article';
}

class :aside extends :xhp:html-element {
  category %flow;
  protected $tagName = 'aside';
}

class :audio extends :xhp:media-element {
  protected $tagName = 'audio';
}

class :b extends :xhp:html-element {
  category %flow, %phrase;
  children (pcdata | %phrase)*;
  protected $tagName = 'b';
}

class :base extends :xhp:html-singleton {
  attribute string href, string target;
  // also a member of "metadata", but is not listed here. see comments in :head
  // for more information
  protected $tagName = 'base';
}

class :blockquote extends :xhp:html-element {
  attribute string cite;
  category %flow;
  children (pcdata | %flow)*;
  protected $tagName = 'blockquote';
}

class :body extends :xhp:html-element {
  children (pcdata | %flow)*;
  protected $tagName = 'body';
}

class :br extends :xhp:html-singleton {
  category %flow, %phrase;
  protected $tagName = 'br';
}

class :button extends :xhp:html-element {
  attribute
    bool autofocus, bool disabled, string form,
    string name, enum { "submit", "button", "reset" } type, string value;
  category %flow, %phrase, %interactive;
  // may not contain interactive
  children (pcdata | %phrase)*;
  protected $tagName = 'button';
}

class :canvas extends :xhp:html-element {
  attribute int width, int height;
  category %flow, %phrase, %embed;
  protected $tagName = 'canvas';
}

class :caption extends :xhp:html-element {
  // may not contain table
  children (pcdata | %flow)*;
  protected $tagName = 'caption';
}

class :cite extends :xhp:html-element {
  category %flow, %phrase;
  children (pcdata | %phrase)*;
  protected $tagName = 'cite';
}

class :code extends :xhp:html-element {
  category %flow, %phrase;
  children (pcdata | %phrase)*;
  protected $tagName = 'code';
}

class :col extends :xhp:html-singleton {
  attribute
    int span;
  protected $tagName = 'col';
}

class :colgroup extends :xhp:html-element {
  attribute
    int span;
  children (:col)*;
  protected $tagName = 'colgroup';
}

class :command extends :xhp:html-singleton {
  attribute
    bool checked, bool disabled, string icon,
    string label, string radiogroup, string title,
    enum { "command", "checkbox", "radio" } type;
  category %flow, %phrase;
  protected $tagName = 'command';
}

class :datalist extends :xhp:html-element {
  category %flow, %phrase;
  children (:option+ | (pcdata | %phrase | %flow)*);
  protected $tagName = 'datalist';
}

class :dd extends :xhp:html-element {
  children (pcdata | %flow)*;
  protected $tagName = 'dd';
}

class :del extends :xhp:html-element {
  attribute string cite, string datetime;
  category %flow, %phrase;
  // transparent
  children (pcdata | %flow)*;
  protected $tagName = 'del';
}

class :details extends :xhp:html-element {
  attribute bool open;
  category %flow;
  children (:summary?, (pcdata | %flow)*);
  protected $tagName = 'details';
}

class :div extends :xhp:html-element {
  category %flow;
  children (pcdata | %flow)*;
  protected $tagName = 'div';
}

class :dfn extends :xhp:html-element {
  category %flow, %phrase;
  children (pcdata | %phrase)*;
  protected $tagName = 'dfn';
}

class :dl extends :xhp:html-element {
  category %flow;
  children (:dt+, :dd+)*;
  protected $tagName = 'dl';
}

class :dt extends :xhp:html-element {
  children (pcdata | %phrase)*;
  protected $tagName = 'dt';
}

class :em extends :xhp:html-element {
  category %flow, %phrase;
  children (pcdata | %phrase)*;
  protected $tagName = 'em';
}

/* has dynamic attributes */
/*class :embed extends :xhp:html-element {
  attribute int height, string src, string type, int width;
  protected $tagName = 'embed';
}*/

class :fieldset extends :xhp:html-element {
  attribute bool disabled, string form, string name;
  category %flow, %phrase;
  children (:legend?, (pcdata | %flow)*);
  protected $tagName = 'fieldset';
}

class :figcaption extends :xhp:html-element {
  children (pcdata | %flow)*;
  protected $tagName = 'figcaption';
}

class :figure extends :xhp:html-element {
  category %flow;
  children ((:figcaption, %flow*) | (%flow*, :figcaption?) );
  protected $tagName = 'figure';
}

class :footer extends :xhp:html-element {
  category %flow;
  children (%flow)*;
  protected $tagName = 'footer';
}

class :form extends :xhp:html-element {
  attribute
    string action, string accept, string accept-charset, string enctype,
    enum { "get", "post" } method, string name, bool novalidate, string target, bool ajaxify;
  category %flow;
  // may not contain form
  children (pcdata | %flow)*;
  protected $tagName = 'form';
}

class :h1 extends :xhp:html-element {
  category %flow, %heading;
  children (pcdata | %phrase)*;
  protected $tagName = 'h1';
}

class :h2 extends :xhp:html-element {
  category %flow, %heading;
  children (pcdata | %phrase)*;
  protected $tagName = 'h2';
}

class :h3 extends :xhp:html-element {
  category %flow, %heading;
  children (pcdata | %phrase)*;
  protected $tagName = 'h3';
}

class :h4 extends :xhp:html-element {
  category %flow, %heading;
  children (pcdata | %phrase)*;
  protected $tagName = 'h4';
}

class :h5 extends :xhp:html-element {
  category %flow, %heading;
  children (pcdata | %phrase)*;
  protected $tagName = 'h5';
}

class :h6 extends :xhp:html-element {
  category %flow, %heading;
  children (pcdata | %phrase)*;
  protected $tagName = 'h6';
}

class :head extends :xhp:html-element {
  children (%metadata*, :title, %metadata*, :base?, %metadata*);
  // Note: html/xhtml spec says that there should be exactly 1 <title />, and at
  // most 1 <base />. These elements can occur in any order, and can be
  // surrounded by any number of other elements (in %metadata). The problem
  // here is that XHP's validation does not backtrack, so there's no way to
  // accurately implement the spec. This is the closest we can get. The only
  // difference between this and the spec is that in XHP the <title /> must
  // appear before the <base />.
  protected $tagName = 'head';
}

class :header extends :xhp:html-element {
  category %flow;
  children (%flow)*;
  protected $tagName = 'header';
}

class :hgroup extends :xhp:html-element {
  category %flow;
  children (%heading)+;
  protected $tagName = 'hgroup';
}

class :hr extends :xhp:html-singleton {
  category %flow;
  protected $tagName = 'hr';
}

class :html extends :xhp:html-element {
  attribute string manifest, string xmlns;
  children (:head, :body);
  protected $tagName = 'html';
}

class :i extends :xhp:html-element {
  category %flow, %phrase;
  children (pcdata | %phrase)*;
  protected $tagName = 'i';
}

class :iframe extends :xhp:pseudo-singleton {
  attribute
    string height, string name, string sandbox, bool seamless, 
    string srcdoc, string src, string width;
  category %flow, %phrase, %interactive;
  children empty;
  protected $tagName = 'iframe';
}

class :img extends :xhp:html-singleton {
  attribute
    // Lite
    string staticsrc,
    // HTML
    string alt, string src, string height, bool ismap,
    string usemap, string width;
  category %flow, %phrase;
  protected $tagName = 'img';
}

class :input extends :xhp:html-singleton {
  attribute
    string accept, string alt, enum { "on", "off" } autocomplete, bool autofocus, 
    bool checked, bool disabled, string form, string formaction, string formenctype,
    enum { "get", "post", "put", "delete" } formmethod, bool formnovalidate, string formtarget,
    string list, string max, int maxlength, string min,
    bool multiple, string name, string pattern, string placeholder, bool readonly, bool required, 
    int size, string src, string step,
    enum {
      "button", "checkbox", "color", "date", "datetime", "datetime-local", "email", "file", 
      "hidden", "image", "month", "number", "password", "radio", "range", "reset", "search", 
      "submit", "tel", "text", "time", "url", "week"
    } type,
    string value;
  category %flow, %phrase, %interactive;
  protected $tagName = 'input';
}

class :ins extends :xhp:html-element {
  attribute string cite, string datetime;
  category %flow, %phrase;
  // transparent
  children (pcdata | %flow)*;
  protected $tagName = 'ins';
}

class :kbd extends :xhp:html-element {
  category %flow, %phrase;
  children (pcdata | %phrase)*;
  protected $tagName = 'kbd';
}

class :keygen extends :xhp:html-singleton {
  attribute
    bool autofocus, string challenge, bool disabled,
    string form, enum { "rsa" } keytype, string name;
  category %flow, %phrase;
  protected $tagName = 'keygen';
}

class :label extends :xhp:html-element {
  attribute string for;
  category %flow, %phrase, %interactive;
  // may not contain label
  children (pcdata | %phrase)*;
  protected $tagName = 'label';
}

class :legend extends :xhp:html-element {
  children (pcdata | %phrase)*;
  protected $tagName = 'legend';
}

class :li extends :xhp:html-element {
  attribute int value;
  children (pcdata | %flow)*;
  protected $tagName = 'li';
}

class :link extends :xhp:html-singleton {
  attribute
    string href, string hreflang, string media, string rel, string sizes,
    string type;
  category %metadata;
  protected $tagName = 'link';
}

class :map extends :xhp:html-element {
  attribute string name;
  category %flow, %phrase;
  // transparent
  children ((pcdata | %flow)+ | :area+);
  protected $tagName = 'map';
}

class :mark extends :xhp:html-element {
  category %flow, %phrase;
  protected $tagName = 'mark';
}

class :menu extends :xhp:html-singleton {
  attribute enum {"context", "toolbar"} type, string label;
  category %flow;
  children (:li+ | (pcdata | %flow)*);
  protected $tagName = 'menu';
}

class :meta extends :xhp:html-singleton {
  attribute
    string charset, string content @required,
    enum {
      "content-type", "content-style-type", "expires", "refresh", "set-cookie"
    } http-equiv,
    string http-equiv, string name;
  category %metadata;
  protected $tagName = 'meta';
}

class :meter extends :xhp:html-element {
  attribute 
    string form, string high, string low, string max, 
    string min, string optimum, string value;
  category %flow, %phrase;
  children (pcdata | %flow)*;
  protected $tagName = 'meter';
}

class :nav extends :xhp:html-element {
  category %flow, %sectioning;
  children (%flow)*;
}

class :noscript extends :xhp:html-element {
  // transparent
  category %flow, %phrase;
  protected $tagName = 'noscript';
}

class :object extends :xhp:html-element {
  attribute
    string data, int height, string name, string type,
    string usemap, int width;
  category %flow, %phrase;
  // transparent, after the params
  children (:param*, (pcdata | %flow)*);
  protected $tagName = 'object';
}

class :ol extends :xhp:html-element {
  attribute
    bool reversed, int start;
  category %flow;
  children (:li)*;
  protected $tagName = 'ol';
}

class :optgroup extends :xhp:html-element {
  attribute string label, bool disabled;
  children (:option)*;
  protected $tagName = 'optgroup';
}

class :option extends :xhp:pseudo-singleton {
  attribute bool disabled, string label, bool selected, string value;
  protected $tagName = 'option';
}

class :output extends :xhp:html-element {
  attribute string for, string form, string name;
  category %flow, %phrase;
  children (pcdata | %phrase)*;
  protected $tagName = 'output';
}

class :p extends :xhp:html-element {
  category %flow;
  children (pcdata | %phrase)*;
  protected $tagName = 'p';
}

class :param extends :xhp:pseudo-singleton {
  attribute
    string name, string value;
  protected $tagName = 'param';
}

class :pre extends :xhp:html-element {
  category %flow;
  children (pcdata | %phrase)*;
  protected $tagName = 'pre';
}

class :progress extends :xhp:html-element {
  attribute string form, string max, string value;
  category %flow, %phrase;
  children (pcdata | %flow)*;
  protected $tagName = 'progress';
}

class :q extends :xhp:html-element {
  attribute string cite;
  category %flow, %phrase;
  children (pcdata | %phrase)*;
  protected $tagName = 'q';
}

class :rp extends :xhp:html-element {
  children (pcdata)*;
  protected $tagName = 'rp';
}

class :rt extends :xhp:html-element {
  children (pcdata)*;
  protected $tagName = 'rt';
}

class :ruby extends :xhp:html-element {
  category %flow, %phrase;
  children ( (pcdata | %flow)*, (:rt | (:rp, :rt, :rp)) )+;
  protected $tagName = 'ruby';
}

class :samp extends :xhp:html-element {
  category %flow, %phrase;
  children (pcdata | %phrase)*;
  protected $tagName = 'samp';
}

class :script extends :xhp:pseudo-singleton {
  attribute bool async, string charset, bool defer, string src, string type;
  category %flow, %phrase, %metadata;
  protected $tagName = 'script';
}

class :section extends :xhp:html-element {
  category %flow;
  protected $tagName = 'section';
}

class :select extends :xhp:html-element {
  attribute 
    bool autofocus, bool disabled, string form, bool multiple, 
    string name, int size;
  category %flow, %phrase, %interactive;
  children (:option | :optgroup)*;
  protected $tagName = 'select';
}

class :small extends :xhp:html-element {
  category %flow, %phrase;
  children (pcdata | %phrase)*;
  protected $tagName = 'small';
}

class :source extends :xhp:html-singleton {
  attribute string src, string type, string media;
  protected $tagName = "source";
}

class :span extends :xhp:html-element {
  category %flow, %phrase;
  children (pcdata | %phrase)*;
  protected $tagName = 'span';
}

class :strong extends :xhp:html-element {
  category %flow, %phrase;
  children (pcdata | %phrase)*;
  protected $tagName = 'strong';
}

class :style extends :xhp:pseudo-singleton {
  attribute
    enum {
      "screen", "tty", "tv", "projection", "handheld", "print", "braille",
      "aural", "all"
    } media, bool scoped, string type;
  category %metadata;
  protected $tagName = 'style';
}

class :sub extends :xhp:html-element {
  category %flow, %phrase;
  children (pcdata | %phrase);
  protected $tagName = 'sub';
}

class :summary extends :xhp:html-element {
  children (pcdata | %phrase)*;
  protected $tagName = 'summary';
}

class :sup extends :xhp:html-element {
  category %flow, %phrase;
  children (pcdata | %phrase);
  protected $tagName = 'sup';
}

class :table extends :xhp:html-element {
  attribute
    string summary;
  category %flow;
  children (
    :caption?, :colgroup*,
    :thead?,
    (
      (:tfoot, (:tbody+ | :tr*)) |
      ((:tbody+ | :tr*), :tfoot?)
    )
  );
  protected $tagName = 'table';
}

class :tbody extends :xhp:html-element {
  children (:tr)*;
  protected $tagName = 'tbody';
}


class :td extends :xhp:html-element {
  attribute
    int colspan, string headers, int rowspan;
  children (pcdata | %flow)*;
  protected $tagName = 'td';
}

class :textarea extends :xhp:pseudo-singleton {
  attribute 
    bool autofocus, int cols, bool disabled, 
    string form, string name, string placeholder, bool readonly, 
    bool required, int rows;
  category %flow, %phrase, %interactive;
  protected $tagName = 'textarea';
}

class :tfoot extends :xhp:html-element {
  children (:tr)*;
  protected $tagName = 'tfoot';
}

class :th extends :xhp:html-element {
  attribute
    int colspan, int rowspan,
    enum { "col", "colgroup", "row", "rowgroup" } scope;
  children (pcdata | %flow)*;
  protected $tagName = 'th';
}

class :thead extends :xhp:html-element {
  children (:tr)*;
  protected $tagName = 'thead';
}

class :time extends :xhp:html-element {
  attribute string datetime, bool pubdate;
  category %flow, %phrase;
  children (pcdata | %flow)*;
  protected $tagName = 'time';
}

class :title extends :xhp:pseudo-singleton {
  // also a member of "metadata", but is not listed here. see comments in :head
  // for more information.
  protected $tagName = 'title';
}

class :tr extends :xhp:html-element {
  children (:th | :td)*;
  protected $tagName = 'tr';
}

class :ul extends :xhp:html-element {
  category %flow;
  children (:li)*;
  protected $tagName = 'ul';
}

class :var extends :xhp:html-element {
  category %flow, %phrase;
  children (pcdata | %phrase)*;
  protected $tagName = 'var';
}

class :video extends :xhp:media-element {
  attribute
    int height, string poster, int width;
  protected $tagName = 'video';
}

/**
 * Render an <html /> element with a DOCTYPE, great for dumping a page to a
 * browser. Choose from a wide variety of flavors like XHTML 1.0 Strict, HTML
 * 4.01 Transitional, and new and improved HTML 5!
 *
 * Note: Some flavors may not be available in your area.
 */
class :x:doctype extends :x:primitive {
  children (:html);

  protected function stringify() {
    $children = $this->getChildren();
    return '<!DOCTYPE html>' . (:x:base::renderChild($children[0]));
  }
}
