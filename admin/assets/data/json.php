<?php
$data = array();



$json['topic'] = array();

$i = 0;
$max = 10;
while ($i<$max){
	$items = new stdClass();
	$items->head = "ทดสอบ";
	$items->text = "ทดสอบ";
	$items->content = "ทดสอบ";
	$items->timestamp = "28 เมษายน 62";
	array_push($json['topic'],$items);
	$i++;
}
echo json_encode($json);
?>