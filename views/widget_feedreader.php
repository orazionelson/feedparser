<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="feed_items">
	<ul>
<?php

foreach($myfeeds as $key=>$obj){
	echo "<li><div class=\"item_date\">".$obj['date']."</div><div class=\"item_author\">";
		$total = count($obj['authors']);
		$i=0;
		foreach($obj['authors'] as $author){
			$i++;
			echo $author->name;
			if($author->email) echo " (".$author->email.")";
			if ($i != $total) echo', ';
			}
	echo "</div>";
	
	echo "<div class=\"item_title\"><a href=\"".$obj['permalink']."\">".$obj['title']."</a></div>";
	echo "</li>";
	
	}
	
?>
	</ul>
</div>
