<?php
class NexonBridge extends BridgeAbstract {
	const NAME        = 'Elsword Patch Nexon Bridge';
	const URI         = 'http://elsword.nexon.com/news/notice/list.aspx?emNoticeCode=Inspection';
	const DESCRIPTION = 'Returns Latest KR Elsword Patch news';
	const MAINTAINER  = 'me trying to do this';
	const CACHE_TIMEOUT = 60;
  
 	public function collectData() {
			$html = getSimpleHTMLDOM(self::URI)
			or returnServerError('Could not request Elsword Nexon Patch Notes.');
		foreach($html->find('div.b_subject') as $element){
			$item = array();
			$title = $element->find('.subject', 0)->plaintext;
			$titles = $element->find('.subject', 0);
			$uri = $titles.attr("href");
			$item['title'] = $title;
			$item['uri'] = $uri;
			
			$this->items[] = $item;
			
		}
		

	}
  
}
