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
			$title = $element->plaintext;
			$item['content'] = $title;
			$item['title'] = $uri;
			$articleHTML = getSimpleHTMLDOMCached($uri)
				or returnServerError('Could not request ' . $uri);
			$getDate = $articleHTML->find('span.date',0)->innertext;
			$getDate = (string)$getDate
			$getDate = str_replace(' 오후 ',' Asia/Seoul ', $getDate);
			Debug::log($getDate);
			$this['timestamp'] = strtotime($getDate); // Error: Cannot use object of type NexonBridge as array in /app/bridges/NexonBridge.php
			Debug::log($this['timestamp']);
			$this->items[] = $item;
			
		}
	}
  
}
