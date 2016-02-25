<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="row">
<?php
foreach($feeds as $key=>$obj){
	echo "<div class=\"col-sm-".$ratio."\">";
	echo "<div class=\"feed_title\"><a href=\"".$obj->link."\">".$obj->title."</a></div>";
	foreach($obj->items as $k=>$item){
		echo "<div class=\"feed_item\"><a href=\"".$item->link."\">".$item->title."</a></div>"; 
		echo "<div class=\"item_date\">(Pub. ".$item->published.")</div>";
	}
	echo "</div>";
	}
	
?>
</div>
