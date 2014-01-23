<?php
function postToTwitter($txt = ''){
	
	if(strlen(TWITTER_USERNAME)>2){
			
			$TWITTER = new Twitter(TWITTER_USERNAME, TWITTER_PASSWORD);
			
			if(mbm_strlen($txt)>160){
				
				$txt1 = mbm_substr($txt,159);
				$TWITTER->updateStatus($txt1, null, 'xml') ;
				
				$txt2 = str_replace($txt1,"",$txt);
				
				if(strlen($txt2)>2){
					$TWITTER->updateStatus($txt2, null, 'xml') ;
				}
				
			}else{
				$TWITTER->updateStatus($txt, null, 'xml') ;
			}
			
		}
	
}
?>