<?php
class NNexonBridge extends BridgeAbstract {
	const NAME        = 'Elsword Patch 2 Nexon Bridge';
	const URI         = 'http://elsword.nexon.com/news/notice/list.aspx?emNoticeCode=Inspection';
	const DESCRIPTION = 'Returns Latest KR Elsword Patch news';
	const MAINTAINER  = 'me trying to do this';
	const CACHE_TIMEOUT = 300;
  
 	public function collectData() {
			$html = getSimpleHTMLDOMCached(self::URI,300)
				or returnServerError('Could not request Elsword Nexon Patch Notes.');
		$i = 1;
		foreach($html->find('h3.subject a') as $element){
			$uri = $element->href;
			$item['uri'] = $uri;
			$title = $element->plaintext;
			$item['content'] = $title;
			$item['title'] = $uri;
			DEBUG::log($uri);
			$articleHTML = getSimpleHTMLDOMCached($uri)
				or returnServerError('Could not request ' . $uri);
			$getDate = $articleHTML->find('span.date',0)->plaintext;
			DEBUG::log($getDate);
			$getDate = (string)$getDate;
			$getDate = str_replace(' 오후 ',' Asia/Seoul ', $getDate);
			$lastDate = strtotime($getDate);
			$item['timestamp'] = $lastDate; // Error: Cannot use object of type NexonBridge as array in /app/bridges/NexonBridge.php
			$this->items[] = $item;
			if ($i++ == 5) break;
			
		}
	}
  
}
