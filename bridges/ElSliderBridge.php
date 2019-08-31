<?php
class ElSliderBridge extends BridgeAbstract {
	const NAME        = 'Elsword Slider Bridge';
	const URI         = 'http://launcher.elswordonline.com/en/';
	const DESCRIPTION = 'Returns Latest NA Elsword Sliders';
	const MAINTAINER  = 'me trying to do this';
	const CACHE_TIMEOUT = 60;
  
 	public function collectData() {
			$html = getSimpleHTMLDOMCached(self::URI,60)
			or returnServerError('Could not request Elsword Slider Data.');
		foreach($html->find('li.tabCot a') as $element){
			$item = array();
			$uri = $element->href;
			$item['uri'] = $uri;
			
			$this->items[] = $item;
			
		}
		
	}
  
