<?php
class NNNexonBridge extends BridgeAbstract {
	const NAME        = 'Elsword Patch Nexon Bridge';
	const URI         = 'https://elsword.nexon.com/News/Notice/List?n4ArticleCategorySN=3';
	const DESCRIPTION = 'Returns Latest KR Elsword Patch news';
	const MAINTAINER  = 'me trying to do this';
	const CACHE_TIMEOUT = 60;
  
 	public function collectData() {
			$html = getSimpleHTMLDOMCached(self::URI,60)
				or returnServerError('Could not request Elsword Nexon Patch Notes.');
		$i = 1;
		foreach($html->find('ul.board_list li') as $element){
			$uri= $element->find(' a', 0)->href;
			$subject = $element->find('span.subject', 0)->plaintext;
			$item['uri'] = $uri;
			$item['content'] = $subject;
			$item['title'] = $uri;
			$articleHTML = getSimpleHTMLDOMCached($uri)
				or returnServerError('Could not request ' . $uri);
			$getDate = $articleHTML->find('li.i_date', 0);
			$readDate = $getDate->find('span.data', 0)->plaintext;
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
