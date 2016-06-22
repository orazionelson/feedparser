# [feedreader](https://github.com/orazionelson/feedreader)

feedreader 0.0.3 is a widget for [No-CMS](https://github.com/goFrendiAsgard/No-CMS), a CodeIgniter Based CMS Framework.

feedreader shows a widget with an rss/atom feed items.

Starting from 0.0.2 version this module bundles [Simplepie 1.4](https://github.com/simplepie/simplepie) compiled in one file.

## Install
1) Copy or clone the <b>feedreader/</b> folder in No-CMS <b>modules/</b> directory.<br>
3) Go to <b>CMS Management->Modules</b> and Activate the module.<br>
Hint: be sure that your module directory is writable so the module can create the <code>cache/</code> directory. 
Otherwise create the dir by hands and make it writable from the server, usually:
<pre>chown -R www-data:www-data cache/</pre> 
4) Add the key: <pre>{{ widget_name:feedreader }}</pre> in your theme layout or in your view.<br>

5) Set in your CSS the widget styles by the classes: 
<ul>
<li>.feed_items</li>
<li>.item_date</li>
<li>.item_author</li>
<li>.item_title</li>
</ul>

6) Set your feeds in module management.

That's all<br>
Alfredo Cosco

----------------------------------------------------------------------

## Changelog
0.0.3 Corrected some bugs in <code>chache/</code> folder manage
0.0.2 Simplepie bundles

----------------------------------------------------------------------
## LICENSE

 This program is free software; you can redistribute it and/or
 modify it under the terms of the GNU General Public License (GPL)
 as published by the Free Software Foundation; either version 2
 of the License, or (at your option) any later version.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 GNU General Public License for more details.

 To read the license please visit [GNU GPL](http://www.gnu.org/copyleft/gpl.html)
======================================================================
