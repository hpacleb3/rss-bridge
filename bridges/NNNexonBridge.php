<?php
class NNNexonBridge extends BridgeAbstract {
	const NAME        = 'Elsword Patch Nexon Bridge';
	const URI         = 'https://elsword.nexon.com/News/Notice/List';
	const DESCRIPTION = 'Returns Latest KR Elsword Patch news';
	const MAINTAINER  = 'me trying to do this';
	const CACHE_TIMEOUT = 60;
  
 	public function collectData() {
			$html = getSimpleHTMLDOMCached(self::URI,60)
				or returnServerError('Could not request Elsword Nexon Patch Notes.');
		$i = 1;
		foreach($html->find('ul.board_list li') as $element){
			
			$link= $element->find(' a')->href;
			$subject = $element->find('span.subject')->plaintext;
			$item['uri'] = $uri;
			$title = $subject;
			$item['content'] = $title;
			$item['title'] = $uri;
			DEBUG::log($uri);
			$articleHTML = getSimpleHTMLDOMCached($uri)
				or returnServerError('Could not request ' . $uri);
			$getDate = $articleHTML->find('i_date');
			$readDate = $getDate->find('span.data')->plaintext;
			DEBUG::log($getDate);
			$readDate = (string)$readDate;
			$readDate = str_replace('.','-',$readDate);
			$readDate = $readDate . ' Asia/Seoul';
			$lastDate = strtotime($readDate);
			$item['timestamp'] = $lastDate; // Error: Cannot use object of type NexonBridge as array in /app/bridges/NexonBridge.php
			$this->items[] = $item;
			if ($i++ == 5) break;
		}
	}
  
}
