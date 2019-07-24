<?php
class nexonbridge extends BridgeAbstract {
	const NAME        = 'Elsword Patch Nexon Bridge';
	const URI         = 'http://elsword.nexon.com/news/notice/list.aspx?emNoticeCode=Inspection';
	const DESCRIPTION = 'Returns Latest KR Elsword Patch news';
	const MAINTAINER  = 'me trying to do this';
  
 	public function collectData() {
			$html = getSimpleHTMLDOM(self::URI)
			or returnServerError('Could not request Footito.');

	}
  
}
