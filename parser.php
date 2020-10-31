<?php
	include('../lib/simple_html_dom.php');
	
	$html = file_get_html("https://olimp-cars.ru/auto");

	$xml .=sprintf("<?xml version='1.0'?><cars>");
	foreach ($html->find('.item') as $key => $value) {
		$name = trim($html->find('.item_name',$key)->plaintext);
		$prise = intval(preg_replace("/[^,.0-9]/", '', $html->find('.item_new_price ',$key)->plaintext)) ;
		$oldPrise = intval(preg_replace("/[^,.0-9]/", '', $html->find('.item_old_price ',$key)->plaintext)) ;
		$img = $html->find('.item_image img',$key)->src;
		$xml .=sprintf('<car><name>%s</name>',$name);
		$xml .=sprintf('<price>%s</price>',$prise);
		$xml .=sprintf('<old_price>%s</old_price>',$oldPrise);
		$xml .=sprintf('<picture>%s</picture></car>',$img);
	}

	$file = 'test.xml';
	$xml .=sprintf("</cars>");
	file_put_contents($file, $xml);
