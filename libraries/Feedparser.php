<?php
/*
 ======================================================================
 feedparser version 0.1
 
 @author alfredo cosco
 @email alfredo.cosco@gmail.com
 
 Sources:	
 http://lastrss.webdot.cz/
 http://www.tiny-threads.com/blog/2011/08/02/php-reading-rss-atom-feeds/
 
 ----------------------------------------------------------------------
 LICENSE

 This program is free software; you can redistribute it and/or
 modify it under the terms of the GNU General Public License (GPL)
 as published by the Free Software Foundation; either version 2
 of the License, or (at your option) any later version.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 GNU General Public License for more details.

 To read the license please visit http://www.gnu.org/copyleft/gpl.html
 ======================================================================
*/
class feedparser {
	// -------------------------------------------------------------------
	// Public properties
	// -------------------------------------------------------------------
	var $default_cp = 'UTF-8';
	var $CDATA = 'nochange';
	var $cp = '';
	var $items_limit = 0;
	var $stripHTML = False;
	var $date_format = '';

	// -------------------------------------------------------------------
	// Parse RSS file and returns an object.
	// -------------------------------------------------------------------
	public function Get ($rss_url,$limit=10) {
		
		// If CACHE ENABLED
		if ($this->cache_dir != '') {
			$cache_file = $this->cache_dir . '/rsscache_' . md5($rss_url);
			$timedif = @(time() - filemtime($cache_file));
			if ($timedif < $this->cache_time) {
				// cached file is fresh enough, return cached array
				$result = unserialize(join('', file($cache_file)));
				// set 'cached' to 1 only if cached file is correct
				if ($result) $result->cached = 1;
			} else {
				// cached file is too old, create new
				$result = $this->getFeed($rss_url,$limit);
				
				$serialized = serialize($result);
				if ($f = @fopen($cache_file, 'w')) {
					fwrite ($f, $serialized, strlen($serialized));
					fclose($f);
				}
				if ($result) $result->cached = 0;
			}
		}
		// If CACHE DISABLED >> load and parse the file directly
		else {
			$result = $this->getFeed($rss_url,$limit);
			
			if ($result) $result->cached = 0;
			
		}
		return $result;
	}
	
	function getFeed($feed_url,$limit) {

	    if ($f = @fopen($feed_url, 'r')) {
			$content = '';
			while (!feof($f)) {
				$content .= fgets($f, 4096);
			}
		}
		fclose($f);
	
	    //put the feed into a php readable format
	    if(strpos($http_response_header[0],"200") AND strlen($content)>0){
		    $x = new SimpleXmlElement($content);
		    
		    //discern between atom and rss feeds
		    if($x->entry){ //atom
		        $ret->title=$x->title.'';
		        $ret->description=$x->subtitle.'';
		        $ret->copyright=$x->rights.'';
		        $ret->logo=$x->logo.'';
		        $ret->link=$x->link[1]->attributes()->href.'';
		        //insert the entries for the feed into the returnable object
		        $c=0;
		        foreach($x->entry as $entry) {
		            $ret->items[$c]->title=$entry->title.'';
		            $ret->items[$c]->link=$entry->link.'';
		            $ret->items[$c]->author=$entry->author->name.'';
		            
					
					if ($this->date_format != '' && ($timestamp = strtotime($entry->published)) !==-1) {
							// convert published to specified date format
							$ret->items[$c]->published = date($this->date_format, $timestamp).'';
						}
					else $ret->items[$c]->published ='';				
		            $ret->items[$c]->contents=$entry->content.'';
		            $c++;
		            if($c==$limit) break;
		        }
		    }
		    else{ //rss
		    
		        //determining feed values depending on what exists
		        if($x->title) $ret->title=$x->title.'';
		        else $ret->title=$x->channel->title.'';
		        if($x->description) $ret->description=$x->description.'';
		        else $ret->description=$x->channel->description.'';
		        if($x->copyright) $ret->copyright=$x->copyright.'';
		        else $ret->copyright=$x->channel->copyright.'';
		        if($x->image->url) $ret->logo=$x->image->url.'';
		        else $ret->logo=$x->channel->image->url.'';
		        if($x->link) $ret->link=$x->link.'';
		        else $ret->link=$x->channel->link.'';
		        
		        //insert the entries for the feed into the returnable object
		        $c=0;
		        foreach($x->channel->item as $entry) {
		            $ret->items[$c]->title=$entry->title.'';
		            $ret->items[$c]->link=$entry->link.'';
		            $ret->items[$c]->author=$entry->author.'';
		            if ($this->date_format != '' && ($timestamp = strtotime($entry->pubDate)) !==-1) {
							// convert pubDate to specified date format
							$ret->items[$c]->published = date($this->date_format, $timestamp);
						}
					else $ret->items[$c]->published ='';
		            $ret->items[$c]->contents=$entry->description.'';
		            $c++;
					if($c==$limit) break;
					}
				}
		}
	    else {$ret->title="The link is not valid: ".$feed_url.'';}
	    
	    return $ret;
	}
}

?>
