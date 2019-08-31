<?php
class ElBridge extends BridgeAbstract {
	const NAME        = 'Elsword Slider Bridge';
	const URI         = 'http://launcher.elswordonline.com/en/';
	const DESCRIPTION = 'Returns Latest Slider Elsword news';
	const MAINTAINER  = 'me trying to do this';
	const CACHE_TIMEOUT = 60;
  
 	public function collectData() {
			$html = getSimpleHTMLDOMCached(self::URI,60)
			or returnServerError('Could not request Elsword Nexon Patch Notes.');
		foreach($html->find('li.tabCot a') as $element){
			$item = array();
			$uri = $element->href;
			$title = $element->plaintext;
			$item['title'] = $title;
			$item['uri'] = $uri;
			
			$this->items[] = $item;
			
		}
		
	}
  
}
