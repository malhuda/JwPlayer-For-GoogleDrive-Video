<?php
	error_reporting(E_ERROR | E_PARSE);
	require_once 'curl.class.php';
	require_once 'input.php';	// input.php
	function curl1($url){
		if (strpos($url,'drive.google') == true) {
			if (preg_match('@https?://(?:[\w\-]+\.)*(?:drive|docs)\.google\.com/(?:(?:folderview|open|uc)\?(?:[\w\-\%]+=[\w\-\%]*&)*id=|(?:folder|file|document|presentation)/d/|spreadsheet/ccc\?(?:[\w\-\%]+=[\w\-\%]*&)*key=)([\w\-]{28,})@i', $url, $match)) {
				$id = $match[1];
				$u = 'https://drive.google.com/file/d/'.$id.'/view?pli=1';
			}
		}else{
			$u = $url;
		}
		$curl = new NEWCURL;
		$curl->get('https://www.proxfree.com/','',2);
		$curl->httpheader = array(
			'Referer:https://de.proxfree.com/permalink.php?url=eKcKvRAsZMJp3EkmD1K78%2Bqx%2FrqnRtIHySNzmMxUbxvJ%2FxfYKDbfQTtfxlzFz63ZA2PxrVLbAzRji7PR98co4KUo8OToTy25nhXHdedVcXsUt3WZdBKH09owwj58mvXq&bit=1',
			'Upgrade-Insecure-Requests:1',
			'Content-Type:application/x-www-form-urlencoded',
			'Cache-Control:max-age=0',
			'Connection:keep-alive',
			'Accept-Language:en-US,en;q=0.8,vi;q=0.6,und;q=0.4',
		);
		$y=( $curl->post('https://de.proxfree.com/request.php?do=go&bit=1',"pfipDropdown=default&get=$u",4) );
		return ($curl->get($y[0]["Location"],'',2));
	}
	// Google Drive 網址陣列化
	function Drive($link) {
		$url = urldecode($link);
		$get = curl1($url);
		$data = explode(',["fmt_stream_map","', $get);
		$data = explode('"]', $data[1]);
		$data = str_replace(array('\u003d', '\u0026'), array('=', '&'), $data[0]);
		$data = explode(',', $data);
		asort($data);
		foreach($data as $list) {
			$data2 = explode('|', $list);
			if($data2[0] == 37) {$q1080p = preg_replace("/\/[^\/]+\.google\.com/","/redirector.googlevideo.com",$data2[1]);}	// 1080P
			if($data2[0] == 22) {$q720p	= preg_replace("/\/[^\/]+\.google\.com/","/redirector.googlevideo.com",$data2[1]);}		// 720P
			if($data2[0] == 59) {$q480p	= preg_replace("/\/[^\/]+\.google\.com/","/redirector.googlevideo.com",$data2[1]);}		// 480P
			if($data2[0] == 18) {$q360p	= preg_replace("/\/[^\/]+\.google\.com/","/redirector.googlevideo.com",$data2[1]);}		// 360P
		}
		$js[0][0] = "$q1080p";
		$js[0][1] = "$q720p";
		$js[0][2] = "$q480p";
		$js[0][3] = "$q360p";
		$js[1][0] = "1080P";
		$js[1][1] = "720P";
		$js[1][2] = "480P";
		$js[1][3] = "360P";
		return $js;		// 輸出陣列
	}
	$jw = Drive($jwfile);	// 輸入 $jwfile 給函數 Drive 輸出陣列 $jw
?>