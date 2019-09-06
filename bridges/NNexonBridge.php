<?php
class NNexonBridge extends BridgeAbstract {
	const NAME        = 'Elsword Patch 2 Nexon Bridge';
	const URI         = 'http://elsword.nexon.com/news/notice/list.aspx?emNoticeCode=Inspection';
	const DESCRIPTION = 'Returns Latest KR Elsword Patch news';
	const MAINTAINER  = 'me trying to do this';
	const CACHE_TIMEOUT = 60;
  
 	public function collectData() {
			$html = getSimpleHTMLDOM(self::URI)
			or returnServerError('Could not request Elsword Nexon Patch Notes.');
		foreach($html->find('h3.subject a') as $element){
			$item = array();
			$uri = $element->href;
			$title = $element->plaintext;
			$item['content'] = $title;
			$item['title'] = $uri;
			$item['uri'] = $uri;
			
			$this->items[] = $item;
			
		}
		

	}
  
}
