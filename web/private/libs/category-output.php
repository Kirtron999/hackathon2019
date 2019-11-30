<?php



foreach ($categories as $category){
	echo "$category";
	foreach ($category["children"] as $child){
		echo "\t $child";
	}
}

?>