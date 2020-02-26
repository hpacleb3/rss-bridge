<?php
class NexonBridge extends BridgeAbstract {
	const NAME        = 'Elsword Patch Nexon Bridge';
	const URI         = 'http://elsword.nexon.com/news/update/list.aspx';
	const DESCRIPTION = 'Returns Latest KR Elsword Patch news';
	const MAINTAINER  = 'me trying to do this';
	const CACHE_TIMEOUT = 60;
  
 	public function collectData() {
			$html = getSimpleHTMLDOMCached($this->getURI(),60)
			or returnServerError('Could not request Elsword Nexon Patch Notes.');
		foreach($html->find('h3.subject a') as $element){
			$uri = $element->href;
			$item['uri'] = $uri;
			$articleHTML = getSimpleHTMLDOMCached($item['uri'],10);
			$getDate = $articleHTML->find('div.bv_date span.date')->plaintext;
			date_default_timezone_set('Asia/Seoul');
			$test  = str_replace(" 오후 "," ", $getDate);
			$this['timestamp'] = strtotime($test);
			$title = $element->plaintext;
			$item['content'] = $title;
			$item['title'] = $uri;
			$this->items[] = $item;
			
		}
	}
  
}
