<?php 

// Don't load directly
if ( !defined('ABSPATH') ) { die('-1'); }

// Global Variables 
  $brad_includes = array(
      "load_gmap" => false ,
	  "load_isotope" => false ,
	  "load_caroufred" => false ,
	  "load_infiniteScroll" => false ,
	  "load_bxslider" => false ,
	  "load_mediaelement" => false,
	  "global_mapData" => array()
	  );



    $fa_icons = $uploaded_icons = array();
    $fa_pattern = '/\.(fa-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
    $fa_path =  get_template_directory().'/css/icons.css';
	$fa_content = '';
    if( file_exists( $fa_path ) ) {
		$fa_content = file_get_contents($fa_path);
    }
   
   preg_match_all($fa_pattern, $fa_content , $fa_matches, PREG_SET_ORDER);
   foreach($fa_matches as $k => $fa_match){
	   $fa_icons[$k] = $fa_match[1];
   }
   
   
    if(!empty($brad_data['custom_iconfont']['css-file']) && !empty($brad_data['custom_iconfont']['prefix']) && !empty($brad_data['custom_iconfont']['name'])){

	    $pattern = '/\.('.$brad_data['custom_iconfont']['prefix'].'-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
		
        $path =   $brad_data['custom_iconfont']['css-file'];
	    $content = '';
		
        if( file_exists( $path ) ) {
		   $content = file_get_contents($path);
        }

	    preg_match_all($pattern, $content , $matches, PREG_SET_ORDER);
        foreach($matches as $k => $match){
	        $uploaded_icons[$k] = $match[1];
        }

   } 
   
// SS-air and socials icons 
    $ss_social = array();
    $ss_social[0] = 'ss-facebook';
	$ss_social[1] = 'ss-twitter';
	$ss_social[2] = 'ss-linkedin';
	$ss_social[3] = 'ss-googleplus';
	$ss_social[4] = 'ss-appdotnet';
	$ss_social[5] = 'ss-zerply';
	$ss_social[6] = 'ss-reddit';
	$ss_social[7] = 'ss-steam';
	$ss_social[8] = 'ss-tumblr';
	$ss_social[9] = 'ss-wordpress';
	$ss_social[10] = 'ss-blogger';
	$ss_social[11] = 'ss-posterous';
	$ss_social[12] = 'ss-quora';
	$ss_social[13] = 'ss-youtube';
	$ss_social[14] = 'ss-vimeo';
	$ss_social[15] = 'ss-vine';
	$ss_social[16] = 'ss-letterboxd';
	$ss_social[17] = 'ss-flickr';
	$ss_social[18] = 'ss-instagram';
	$ss_social[19] = 'ss-500px';
	$ss_social[20] = 'ss-etsy';
	$ss_social[21] = 'ss-pinterest';
	$ss_social[22] = 'ss-svpply';
	$ss_social[23] = 'ss-readmill';
	$ss_social[24] = 'ss-dropbox';
	$ss_social[25] = 'ss-pinboard';
	$ss_social[26] = 'ss-delicious';
	$ss_social[27] = 'ss-dribbble';
	$ss_social[28] = 'ss-behance';
	$ss_social[29] = 'ss-github';
	$ss_social[30] = 'ss-octocat';
	$ss_social[31] = 'ss-stackoverflow';
	$ss_social[32] = 'ss-paypal';
	$ss_social[33] = 'ss-kickstarter';
	$ss_social[34] = 'ss-foursquare';
	$ss_social[35] = 'ss-yelp';
	$ss_social[36] = 'ss-skype';
	$ss_social[37] = 'ss-rdio';
	$ss_social[38] = 'ss-spotify';
	$ss_social[39] = 'ss-lastfm';
	$ss_social[40] = 'ss-soundcloud';
	$ss_social[41] = 'ss-link';
	$ss_social[42] = 'ss-phone';
	$ss_social[43] = 'ss-mail';
	$ss_social[44] = 'ss-like';
	$ss_social[45] = 'ss-rss';
	$ss_social[46] = 'ss-share';
	$ss_social[47] = 'ss-apple';
	$ss_social[48] = 'ss-microsoft';
	$ss_social[49] = 'ss-windows';
	$ss_social[50] = 'ss-android';
	$ss_social[51] = 'ss-blackberry';
	$ss_social[52] = 'ss-fivehundredpx';
	
	$ss_air = array();
    $ss_air[0] = 'ss-cursor';
	$ss_air[1] = 'ss-crosshair';
	$ss_air[2] = 'ss-search';
	$ss_air[3] = 'ss-zoomin';
	$ss_air[4] = 'ss-zoomout';
	$ss_air[5] = 'ss-view';
	$ss_air[6] = 'ss-viewdisabled';
	$ss_air[7] = 'ss-binoculars';
	$ss_air[8] = 'ss-attach';
	$ss_air[9] = 'ss-link';
	$ss_air[10] = 'ss-move';
	$ss_air[11] = 'ss-write';
	$ss_air[12] = 'ss-writingdisabled';
	$ss_air[13] = 'ss-compose';
	$ss_air[14] = 'ss-lock';
	$ss_air[15] = 'ss-unlock';
	$ss_air[16] = 'ss-key';
	$ss_air[17] = 'ss-backspace';
	$ss_air[18] = 'ss-ban';
	$ss_air[19] = 'ss-trash';
	$ss_air[20] = 'ss-target';
	$ss_air[21] = 'ss-skull';
	$ss_air[22] = 'ss-tag';
	$ss_air[23] = 'ss-bookmark';
	$ss_air[24] = 'ss-flag';
	$ss_air[25] = 'ss-like';
	$ss_air[26] = 'ss-dislike';
	$ss_air[27] = 'ss-heart';
	$ss_air[28] = 'ss-unheart';
	$ss_air[29] = 'ss-star';
	$ss_air[30] = 'ss-unstar';
	$ss_air[31] = 'ss-sample';
	$ss_air[32] = 'ss-crop';
	$ss_air[33] = 'ss-cut';
	$ss_air[34] = 'ss-clipboard';
	$ss_air[35] = 'ss-ruler';
	$ss_air[36] = 'ss-gridlines';
	$ss_air[37] = 'ss-pencilbrushpen';
	$ss_air[38] = 'ss-paintroller';
	$ss_air[39] = 'ss-paint';
	$ss_air[40] = 'ss-paintdisabled';
	$ss_air[41] = 'ss-paintedit';
	$ss_air[42] = 'ss-pixels';
	$ss_air[43] = 'ss-phone';
	$ss_air[44] = 'ss-phonedisabled';
	$ss_air[45] = 'ss-addressbook';
	$ss_air[46] = 'ss-voicemail';
	$ss_air[47] = 'ss-mailbox';
	$ss_air[48] = 'ss-send';
	$ss_air[49] = 'ss-paperairplane';
	$ss_air[50] = 'ss-mail';
	$ss_air[51] = 'ss-inbox';
	$ss_air[52] = 'ss-inboxes';
	$ss_air[53] = 'ss-outbox';
	$ss_air[54] = 'ss-chat';
	$ss_air[55] = 'ss-textchat';
	$ss_air[56] = 'ss-ellipsischat';
	$ss_air[57] = 'ss-ellipsis';
	$ss_air[58] = 'ss-smile';
	$ss_air[59] = 'ss-frown';
	$ss_air[60] = 'ss-surprise';
	$ss_air[61] = 'ss-user';
	$ss_air[62] = 'ss-femaleuser';
	$ss_air[63] = 'ss-users';
	$ss_air[64] = 'ss-robot';
	$ss_air[65] = 'ss-ghost';
	$ss_air[66] = 'ss-contacts';
	$ss_air[67] = 'ss-pointup';
	$ss_air[68] = 'ss-pointright';
	$ss_air[69] = 'ss-pointdown';
	$ss_air[70] = 'ss-pointleft';
	$ss_air[71] = 'ss-cart';
	$ss_air[72] = 'ss-shoppingbag';
	$ss_air[73] = 'ss-store';
	$ss_air[74] = 'ss-creditcard';
	$ss_air[75] = 'ss-banknote';
	$ss_air[76] = 'ss-calculator';
	$ss_air[77] = 'ss-calculate';
	$ss_air[78] = 'ss-bank';
	$ss_air[79] = 'ss-presentation';
	$ss_air[80] = 'ss-barchart';
	$ss_air[81] = 'ss-piechart';
	$ss_air[82] = 'ss-activity';
	$ss_air[83] = 'ss-box';
	$ss_air[84] = 'ss-home';
	$ss_air[85] = 'ss-fence';
	$ss_air[86] = 'ss-buildings';
	$ss_air[87] = 'ss-lodging';
	$ss_air[88] = 'ss-globe';
	$ss_air[89] = 'ss-navigate';
	$ss_air[90] = 'ss-compass';
	$ss_air[91] = 'ss-signpost';
	$ss_air[92] = 'ss-map';
	$ss_air[93] = 'ss-location';
	$ss_air[94] = 'ss-pin';
	$ss_air[95] = 'ss-pushpin';
	$ss_air[96] = 'ss-code';
	$ss_air[97] = 'ss-puzzle';
	$ss_air[98] = 'ss-floppydisk';
	$ss_air[99] = 'ss-window';
	$ss_air[100] = 'ss-music';
	$ss_air[101] = 'ss-mic';
	$ss_air[102] = 'ss-headphones';
	$ss_air[103] = 'ss-mutevolume';
	$ss_air[104] = 'ss-volume';
	$ss_air[105] = 'ss-lowvolume';
	$ss_air[106] = 'ss-highvolume';
	$ss_air[107] = 'ss-radio';
	$ss_air[108] = 'ss-airplay';
	$ss_air[109] = 'ss-disc';
	$ss_air[110] = 'ss-camera';
	$ss_air[111] = 'ss-picture';
	$ss_air[112] = 'ss-pictures';
	$ss_air[113] = 'ss-video';
	$ss_air[114] = 'ss-film';
	$ss_air[115] = 'ss-clapboard';
	$ss_air[116] = 'ss-tv';
	$ss_air[117] = 'ss-flatscreen';
	$ss_air[118] = 'ss-play';
	$ss_air[119] = 'ss-pause';
	$ss_air[120] = 'ss-stop';
	$ss_air[121] = 'ss-record';
	$ss_air[122] = 'ss-rewind';
	$ss_air[123] = 'ss-fastforward';
	$ss_air[124] = 'ss-skipforward';
	$ss_air[125] = 'ss-skipback';
	$ss_air[126] = 'ss-eject';
	$ss_air[127] = 'ss-filecabinet';
	$ss_air[128] = 'ss-books';
	$ss_air[129] = 'ss-notebook';
	$ss_air[130] = 'ss-newspaper';
	$ss_air[131] = 'ss-grid';
	$ss_air[132] = 'ss-rows';
	$ss_air[133] = 'ss-columns';
	$ss_air[134] = 'ss-thumbnails';
	$ss_air[135] = 'ss-menu';
	$ss_air[136] = 'ss-filter';
	$ss_air[137] = 'ss-desktop';
	$ss_air[138] = 'ss-laptop';
	$ss_air[139] = 'ss-tablet';
	$ss_air[140] = 'ss-cell';
	$ss_air[141] = 'ss-battery';
	$ss_air[142] = 'ss-highbattery';
	$ss_air[143] = 'ss-mediumbattery';
	$ss_air[144] = 'ss-lowbattery';
	$ss_air[145] = 'ss-emptybattery';
	$ss_air[146] = 'ss-batterydisabled';
	$ss_air[147] = 'ss-lightbulb';
	$ss_air[148] = 'ss-flashlight';
	$ss_air[149] = 'ss-flashlighton';
	$ss_air[150] = 'ss-picnictable';
	$ss_air[151] = 'ss-birdhouse';
	$ss_air[152] = 'ss-lamp';
	$ss_air[153] = 'ss-onedie';
	$ss_air[154] = 'ss-twodie';
	$ss_air[155] = 'ss-threedie';
	$ss_air[156] = 'ss-fourdie';
	$ss_air[157] = 'ss-fivedie';
	$ss_air[158] = 'ss-sixdie';
	$ss_air[159] = 'ss-downloadcloud';
	$ss_air[160] = 'ss-download';
	$ss_air[161] = 'ss-uploadcloud';
	$ss_air[162] = 'ss-upload';
	$ss_air[163] = 'ss-transfer';
	$ss_air[164] = 'ss-replay';
	$ss_air[165] = 'ss-refresh';
	$ss_air[166] = 'ss-sync';
	$ss_air[167] = 'ss-loading';
	$ss_air[168] = 'ss-wifi';
	$ss_air[169] = 'ss-file';
	$ss_air[170] = 'ss-files';
	$ss_air[171] = 'ss-searchfile';
	$ss_air[172] = 'ss-folder';
	$ss_air[173] = 'ss-downloadfolder';
	$ss_air[174] = 'ss-uploadfolder';
	$ss_air[175] = 'ss-quote';
	$ss_air[176] = 'ss-anchor';
	$ss_air[177] = 'ss-print';
	$ss_air[178] = 'ss-fax';
	$ss_air[179] = 'ss-shredder';
	$ss_air[180] = 'ss-typewriter';
	$ss_air[181] = 'ss-list';
	$ss_air[182] = 'ss-action';
	$ss_air[183] = 'ss-redirect';
	$ss_air[184] = 'ss-additem';
	$ss_air[185] = 'ss-checkitem';
	$ss_air[186] = 'ss-expand';
	$ss_air[187] = 'ss-contract';
	$ss_air[188] = 'ss-scaleup';
	$ss_air[189] = 'ss-scaledown';
	$ss_air[190] = 'ss-lifepreserver';
	$ss_air[191] = 'ss-help';
	$ss_air[192] = 'ss-info';
	$ss_air[193] = 'ss-alert';
	$ss_air[194] = 'ss-caution';
	$ss_air[195] = 'ss-plus';
	$ss_air[196] = 'ss-hyphen';
	$ss_air[197] = 'ss-check';
	$ss_air[198] = 'ss-delete';
	$ss_air[199] = 'ss-fish';
	$ss_air[200] = 'ss-bird';
	$ss_air[201] = 'ss-bone';
	$ss_air[202] = 'ss-tooth';
	$ss_air[203] = 'ss-poo';
	$ss_air[204] = 'ss-tree';
	$ss_air[205] = 'ss-settings';
	$ss_air[206] = 'ss-dashboard';
	$ss_air[207] = 'ss-dial';
	$ss_air[208] = 'ss-notifications';
	$ss_air[209] = 'ss-notificationsdisabled';
	$ss_air[210] = 'ss-toggles';
	$ss_air[211] = 'ss-flash';
	$ss_air[212] = 'ss-flashoff';
	$ss_air[213] = 'ss-magnet';
	$ss_air[214] = 'ss-toolbox';
	$ss_air[215] = 'ss-wrench';
	$ss_air[216] = 'ss-clock';
	$ss_air[217] = 'ss-stopwatch';
	$ss_air[218] = 'ss-alarmclock';
	$ss_air[219] = 'ss-counterclockwise';
	$ss_air[220] = 'ss-calendar';
	$ss_air[221] = 'ss-keyboard';
	$ss_air[222] = 'ss-keyboardup';
	$ss_air[223] = 'ss-keyboarddown';
	$ss_air[224] = 'ss-chickenleg';
	$ss_air[225] = 'ss-burger';
	$ss_air[226] = 'ss-mug';
	$ss_air[227] = 'ss-coffee';
	$ss_air[228] = 'ss-tea';
	$ss_air[229] = 'ss-wineglass';
	$ss_air[230] = 'ss-paperbag';
	$ss_air[231] = 'ss-utensils';
	$ss_air[232] = 'ss-droplet';
	$ss_air[233] = 'ss-sun';
	$ss_air[234] = 'ss-cloud';
	$ss_air[235] = 'ss-partlycloudy';
	$ss_air[236] = 'ss-umbrella';
	$ss_air[237] = 'ss-crescentmoon';
	$ss_air[238] = 'ss-plug';
	$ss_air[239] = 'ss-outlet';
	$ss_air[240] = 'ss-car';
	$ss_air[241] = 'ss-taxi';
	$ss_air[242] = 'ss-train';
	$ss_air[243] = 'ss-bus';
	$ss_air[244] = 'ss-truck';
	$ss_air[245] = 'ss-plane';
	$ss_air[246] = 'ss-bike';
	$ss_air[247] = 'ss-rocket';
	$ss_air[248] = 'ss-briefcase';
	$ss_air[249] = 'ss-theatre';
	$ss_air[250] = 'ss-flask';
	$ss_air[251] = 'ss-up';
	$ss_air[252] = 'ss-upright';
	$ss_air[253] = 'ss-right';
	$ss_air[254] = 'ss-downright';
	$ss_air[255] = 'ss-down';
	$ss_air[256] = 'ss-downleft';
	$ss_air[257] = 'ss-left';
	$ss_air[258] = 'ss-upleft';
	$ss_air[259] = 'ss-navigateup';
	$ss_air[260] = 'ss-navigateright';
	$ss_air[261] = 'ss-navigatedown';
	$ss_air[262] = 'ss-navigateleft';
	$ss_air[263] = 'ss-share';
	
	


// Brad icon sorting
function brad_icon( $icon , $class = '' , $id = '' , $wrapper = true , $data = '' ){
	global $ss_air , $ss_social , $fa_icons , $brad_data , $uploaded_icons ;
	$return_icon = '';
	if( $icon == ''){
		return '' ;
	}
	if( $id != ''){
		$id = 'id="'.$id.'"';
	}
	
	if( $wrapper == true ) :
	   $return_icon = '<span '.$id.' class="brad-icon '.$class.'" '.$data.'>';
	endif;
	$icon = explode ("|", $icon);
	if( empty($icon[1])){
		$icon_type = ''; 
	}
	else{
	   $icon_type = $icon[1];
	}
    $icon_value = $icon[0];
    if($icon_type == 'ss-air'){
	    $return_icon .= '<i class="ss-air '.$ss_air[$icon_value].'"></i>';
    }
	else if($icon_type == 'br-icon'){
	    $return_icon .= '<i class="br '.$ss_air[$icon_value].'"></i>';
    }
	else if($icon_type == 'uploaded' && array_key_exists($icon_value , $uploaded_icons)){
	       $return_icon .= '<i class="'.$brad_data['custom_iconfont']['prefix'].' '.$uploaded_icons[$icon_value].'"></i>';
     }	
    else if($icon_type == 'ss-social'){
	    $return_icon .= '<i class="ss-social-regular '.$ss_social[$icon_value].'"></i>';
    }
    else if( array_key_exists($icon_value,$fa_icons) ){	
	$return_icon .= '<i class="'.$fa_icons[$icon_value].'"></i>';
	}
	if( $wrapper == true ) :
         $return_icon .= '</span>';
    endif;
	return $return_icon;
}




// Get Realted Posts	
function brad_get_related_posts($post_id) {
	global $brad_data;
	$query = new WP_Query();
    $args = '';
	$args = wp_parse_args($args, array(
		'showposts' => $brad_data['blog_relatedpostsnumber'],
		'post__not_in' => array($post_id),
		'ignore_sticky_posts' => 0,
        'category__in' => wp_get_post_categories($post_id)
	));
	$query = new WP_Query($args);
  	return $query;
}

//Get class Name According to Columns
function brad_get_class_name($columns){
	switch ( $columns ){
		case '4':
		   $class = 'span3';
		break;
		
		case '3':
		   $class = 'span4';
		break;
		
		default :
		   $class = 'span6';
		break;
	}
   return $class;
}


//Get image Size according to columns
function brad_get_img_size($columns , $fullwidth = 'no'){
	$img_size = 'thumb-large';
	switch($columns){
		case '4':
		case '5':
		case '6':
		if( $fullwidth == 'yes'){
			$img_size = 'thumb-normal-fullwidth';
		}
		else{
			$img_size = 'thumb-normal';
		}
		break;
		
		case '3':
		if( $fullwidth == 'yes'){
			$img_size = 'thumb-medium-fullwidth';
		}
		else{
			$img_size = 'thumb-medium';
		}
		break;
		
		default:
		if( $fullwidth == 'yes'){
			$img_size = 'thumb-large-fullwidth';
		}
		else{
			$img_size = 'thumb-large';
		}
		break;
	}
	
	return $img_size;
}



//Shortcode fixers

function brad_shortcode_wpautop($content) {
  $content = do_shortcode( $content );
  $array = array (
			'<p>[' => '[', 
			']</p>' => ']', 
			']<br />' => ']'
		);
  $content = strtr($content, $array);
  return $content;
}

//Get realted Projects
function brad_get_related_projects($post_id) {
    $query = new WP_Query();
    $args = '';
    $item_cats = get_the_terms($post_id , 'portfolio_category');
    if($item_cats):
    foreach($item_cats as $item_cat) {
        $item_array[] = $item_cat->term_id;
    }
    endif;
	if( @ !is_array($item_array)){
		$item_array = array();
	}
    $args = wp_parse_args($args, array(
        'showposts' => -1,
        'post__not_in' => array($post_id),
        'ignore_sticky_posts' => 0,
        'post_type' => 'portfolio',
        'tax_query' => array(
            array(
                'taxonomy' => 'portfolio_category',
                'field' => 'id',
                'terms' => $item_array
            )
        )
    ));
    
    $query = new WP_Query($args);
    return $query;
}


//Get Tweets

 if (!function_exists('brad_get_tweets')) {
  
  function brad_get_tweets($count, $twitterID) {
	
	  $content = "";
	  
	  if ($twitterID == "") {
		  return __("Please provide your Twitter username", "brad");
	  }
	  
	  if (function_exists('getTweets')) {
					  
		  $options = array('trim_user'=>true, 'exclude_replies'=>false, 'include_rts'=>false);
					  
		  $tweets = getTweets($twitterID, $count, $options);
		  
		  $content .= '<div class="recent-tweets" id="recent_tweets_'.rand().'"><ul>';
		  

		  
		  if(is_array($tweets)){
					  
			  foreach($tweets as $tweet){
									  
				  $content .= '<li>';
			  
				  if(is_array($tweet) && $tweet['text']){
					  
					  $content .= '<span>';
					  
					  $the_tweet = $tweet['text'];
				
					  if(is_array($tweet['entities']['user_mentions'])){
						  foreach($tweet['entities']['user_mentions'] as $key => $user_mention){
							  $the_tweet = preg_replace(
								  '/@'.$user_mention['screen_name'].'/i',
								  '<a href="http://www.twitter.com/'.$user_mention['screen_name'].'" target="_blank">@'.$user_mention['screen_name'].'</a>',
								  $the_tweet);
						  }
					  }
			  
					  // ii. Hashtags must link to a twitter.com search with the hashtag as the query.
					  if(is_array($tweet['entities']['hashtags'])){
						  foreach($tweet['entities']['hashtags'] as $key => $hashtag){
							  $the_tweet = preg_replace(
								  '/#'.$hashtag['text'].'/i',
								  '<a href="https://twitter.com/search?q=%23'.$hashtag['text'].'&amp;src=hash" target="_blank">#'.$hashtag['text'].'</a>',
								  $the_tweet);
						  }
					  }
			  
					  // iii. Links in Tweet text must be displayed using the display_url
					  //      field in the URL entities API response, and link to the original t.co url field.
					  if(is_array($tweet['entities']['urls'])){
						  foreach($tweet['entities']['urls'] as $key => $link){
							  $the_tweet = preg_replace(
								  '`'.$link['url'].'`',
								  '<a href="'.$link['url'].'" target="_blank">'.$link['url'].'</a>',
								  $the_tweet);
						  }
					  }
					  
					  // Custom code to link to media
					  if(isset($tweet['entities']['media']) && is_array($tweet['entities']['media'])){
						  foreach($tweet['entities']['media'] as $key => $media){
							  $the_tweet = preg_replace(
								  '`'.$media['url'].'`',
								  '<a href="'.$media['url'].'" target="_blank">'.$media['url'].'</a>',
								  $the_tweet);
						  }
					  }
					  
					  $content .= $the_tweet;
					  
					  $content .= '</span>';
			  
					  $date = strtotime($tweet['created_at']); // retrives the tweets date and time in Unix Epoch terms
					  $blogtime = current_time('U'); // retrives the current browser client date and time in Unix Epoch terms
					  $dago = human_time_diff($date, $blogtime) . ' ' . sprintf(__('ago', 'brad')); // calculates and outputs the time past in human readable format
					  $content .= '<br /><a class="timestamp" href="https://twitter.com/'.$twitterID.'/status/'.$tweet['id_str'].'" target="_blank">'.$dago.'</a>'. "\n";
				  } else {
					  $content .= '<br /><a href="http://twitter.com/'.$twitterID.'" target="_blank">@'.$twitterID.'</a>';
				  }
				  $content .= '</li>';
			  }
		  }
		  
		  $content .= '</ul></div>';
		  return $content;
	  } else {
		  return 'Please install the oAuth Twitter Feed Plugin';
	  }	
  }
}


//brad_shortcode_pagination
function brad_pagination($pages = '', $range = 2 , $echo = true , $el_class = '' ){
	 global $brad_data , $paged ;
	 $html = '';  
     $showitems = ($range * 2)+1;  
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {   //Edit here for sections
         $html .= "<div class='page-nav clearfix {$el_class}'>";
         //if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'><span class='arrows'>&laquo;</span> First</a>";
         if($paged > 1) {
			  $html .= "<a  href='".get_pagenum_link($paged - 1)."' class='prev'><i class='fa-angle-left'></i>".__('Prev', 'brad')."</a>";
		 }

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                $html .= ($paged == $i)? "<span class='active'>".$i."</span>":"<a href='".get_pagenum_link($i)."' >".$i."</a>";
             }
         }

         if ($paged < $pages) {
			  $html .= "<a href='".get_pagenum_link($paged + 1)."' class='next'>".__('Next', 'brad')."<i class='fa-angle-right'></i></a>"; 
		 }
         //if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last <span class='arrows'>&raquo;</span></a>";
         $html .= "</div>\n";
     }
	 if( $echo == false ){
	    return $html ;
	 }
	 echo $html;
}

	
 // New Excerpt length	
   function brad_new_excerpt_length($length) {
		global $brad_data;
	    return $brad_data['text_excerptlength'];
	}
   add_filter('excerpt_length', 'brad_new_excerpt_length');
	
	
	
  // Word Limiter
	function brad_limit_words($string, $word_limit) {
		$words = explode(' ', $string);
		return implode(' ', array_slice($words, 0, $word_limit));
	}

 
 // Breadcrumbs
   function brad_breadcrumb() {
       global $brad_data , $post ;
       $showOnHome = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
       $delimiter = '<span class="separator">/</span>'; // delimiter between crumbs
       $home = get_bloginfo('name'); // text for the 'Home' link
       $blog = '<span class="current">'.$brad_data['text_blogtitle'].'</span>';
       $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
       $before = '<span class="current">'; // tag before the current crumb
       $after = '</span>'; // tag after the current crumb
       $homeLink = home_url();
       //If homepage or Front Page
       if (is_home() || is_front_page()) {
       if ($showOnHome == 1) echo '<div id="breadcrumbs"><span class="breadcrumb-title">'.__('You Are Here:','brad').'</span><span><a href="' . $homeLink . '">' . $home . '</a></span> ' . $delimiter . ' ' . $blog . '</div>';
        } 
        else {
        echo '<div id="breadcrumbs"><span class="breadcrumb-title">'.__('You Are Here:','brad').'</span><span><a href="' . $homeLink . '">' . $home . '</a></span> ' . $delimiter . ' ';
	   //Category Display
       if ( is_category() ) {
       $thisCat = get_category(get_query_var('cat'), false);
       if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
       echo $before . __('Archive by category','brad').' "' . single_cat_title('', false) . '"' . $after;
       } 
	   //Search Results
	   elseif ( is_search() ) {
       echo $before . __('Search results for','brad').' "' . get_search_query() . '"' . $after;
       } 
	   //Archives By Day
	   elseif ( is_day() ) {
       echo '<span><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></span>' . $delimiter . ' ';
       echo '<span><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a></span>' . $delimiter . ' ';
       echo $before . get_the_time('d') . $after;
        }
		//Archieves By Month
		elseif ( is_month() ) {
        echo '<span><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> </span>' . $delimiter . ' ';
        echo $before . get_the_time('F') . $after;
        } 
		//Archives By Year
		elseif ( is_year() ) {
        echo $before . get_the_time('Y') . $after;
        } 
		//Single Page 
		elseif ( is_single() && !is_attachment() ) {
        if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<span><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></span>';
         if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
         } 
		 else {
         $cat = get_the_category(); $cat = $cat[0];
         $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
         if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
         echo '<span>'.$cats.'</span>';
         if ($showCurrent == 1) echo $before . get_the_title() . $after;
         }
        } 
		//If not a single page But Post Display
		elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
        $post_type = get_post_type_object(get_post_type());
        echo $before . $post_type->labels->singular_name . $after;
        } 
		
		//If Attachement
		elseif ( is_attachment() ) {
          $parent = get_post($post->post_parent);
		    if( !empty( $parent)){
                $cat = get_the_category($parent->ID); 
				if(!empty($cat)){
					$cat = $cat[0];
                    echo '<span>'.get_category_parents($cat, TRUE, ' ' . $delimiter . ' ').'</span>';
				}
                echo '<span><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></span>';
		    }
           if ($showCurrent == 1) {
			    echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
		   }
        } 
		
		//Current Post
		elseif ( is_page() ) {
		 $parents = array();
            $parent_id = $post->post_parent;
            while ( $parent_id ) :
                $page = get_page( $parent_id );
                $parents[]  = $before .'<a href="' . get_permalink( $page->ID ) . '" title="' . get_the_title( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>' . $after . $delimiter;
                $parent_id  = $page->post_parent;
            endwhile;
            $parents = array_reverse( $parents );
            echo join( '', $parents );
            echo $before . get_the_title() . $after;

        } 

		//Tag Archives
		elseif ( is_tag() ) {
        echo $before . __('Posts tagged' , 'brad').' "' . single_tag_title('', false) . '"' . $after;
        //Author Page
		} elseif ( is_author() ) {
        global $author;
        $userdata = get_userdata($author);
        echo $before . __('Articles posted by','brad') . $userdata->display_name . $after;
        } 
		//404 Page
		elseif ( is_404() ) {
        echo $before . __('Error 404','brad') . $after;
		}
        // Query By page
		if ( get_query_var('paged') ) {
        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
        echo __('Page','brad') . ' ' . get_query_var('paged');
        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
         }
         //End
         echo '</div>';
		 }
	}


/**
 * Ajax send mail function.
 */
function brad_send_mail() {
	global $brad_data;
	$send = false;
	$error = 0;
	$success = 0;
	$fields = empty( $_POST['fields'] ) ? array() : $_POST['fields'];
	$fields_titles = array(
		'name'		=> __( 'Name: ', 'brad-framework' ),
		'email'		=> __( 'Email: ', 'brad-framework' ),
		'telephone'	=> __( 'Telephone: ', 'brad-framework' ),
		'country'	=> __( 'Country: ',  'brad-framework' ),
		'city'		=> __( 'City: ', 'brad-framework' ),
		'company'	=> __( 'Company: ', 'brad-framework' ),
		'message'	=> __( 'Message: ', 'brad-framework' ),
		'website'	=> __( 'Website: ', 'brad-framework' ),
	);

	$fields = apply_filters( 'brad_sanitize_form_fields', $fields, $fields_titles );

	if ( ! check_ajax_referer( 'brad_contact_form', 'nonce', false ) ) {
		$error = 1;
	}
	elseif ( !empty($fields) ) {

		// target email
		if( $fields['contact_form_email_nonce'] == 'alternate'){
			$myemail = $brad_data['contact_form_email_alternate'];
		}
		else {
			$myemail = $brad_data['contact_form_email'];
		}
		
		if( empty($myemail)){
			$myemail = get_option( 'admin_email' );
		}
		$em = apply_filters( 'brad_send_mail_to', $myemail );
		$name = get_option( 'blogname' );
		$email = $em;

		if ( !empty( $fields['email'] ) && is_email( $fields['email'] ) ) {
			$email = $fields['email'];
		}

		if ( !empty( $fields['name'] ) ) {
			$name = $fields['name'];
		}

		// set headers
		$headers = array(
			'From: ' . esc_attr( strip_tags( $name ) ) . ' <' . esc_html( $email ) . '>',
			'Reply-To: ' . esc_html( $email ),
		);
		$headers = apply_filters( 'brad_send_mail_headers', $headers );

		// construct mail message
		$msg_mail = '';
		foreach ( $fields as $field=>$value ) {
			if ( !isset($fields_titles[ $field ]) ) {
				continue;
			}

			$msg_mail .= $fields_titles[ $field ] . $value . "\n";
		}
		$msg_mail = apply_filters( 'brad_send_mail_msg', $msg_mail, $fields );
		$subject = apply_filters( 'brad_send_mail_subject', '[Feedback from: ' . esc_attr( get_option( 'blogname' ) ) . ']' );

		// send email
		$send = wp_mail(
			$em,
			$subject,
			$msg_mail,
			$headers
		);

		// message
		if ( $send ) {
		  $success = 1;
		} else {
			$error = 1 ;
		}
	 }
		$nonce = wp_create_nonce( 'brad_contact_form' );
	    $response = json_encode(
		 array(
			'success'		=> $success,
			'error'         => $error,
			'nonce'         => $nonce
		 )
	);

	// response output
	header( "Content-Type: application/json" );
	echo $response;

	// IMPORTANT: don't forget to "exit"
	exit;
}
add_action( 'wp_ajax_nopriv_brad_send_mail', 'brad_send_mail' );
add_action( 'wp_ajax_brad_send_mail', 'brad_send_mail' );

/**
 * Sanitize email fields.
 *
 * @param $fields array
 * @param $fields_titles array
 *
 * @return array
 */
function brad_sanitize_email_fields( $fields = array(), $fields_titles = array() ) {
	if ( empty( $fields ) || empty( $fields_titles ) ) {
		return array();
	}

	foreach ( $fields as $field=>$value ) {
		if ( !isset($fields_titles[ $field ]) ) {
			unset( $fields[ $field ] );
		}

		switch ( $field ) {

			case 'email' :
				$fields[ $field ] = sanitize_email( $value );
				break;

			case 'message' :
				$fields[ $field ] = esc_html( $value );
				break;

			default:
				$fields[ $field ] = sanitize_text_field( $value );
		}
	}

	return $fields;
}
add_filter( 'brad_sanitize_form_fields', 'brad_sanitize_email_fields', 15, 2 );
	




//Hex to Rgb
function brad_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return $rgb;
}


/**
* ShortcodeHelper class 
*/

if ( !class_exists( 'brad_shortcodeHelper' ) ) {
	
	class brad_shortcodeHelper
	{
        static $tree = array();
        static $shortcode_index = 0 ;
		static $temp_index = -1;
		static $section_count = 0;
		static $vc_shortcodes = array('vc_row','vc_column','vc_row_inner','vc_column_inner','vc_box','vc_testimonials','vc_feature_boxes','vc_feature_box','vc_clients','vc_counters','vc_counter','vc_teaser_boxes','vc_teaser_box','vc_person','vc_section','vc_double_section','vc_section_container','vc_double_section_container','vc_column_text','vc_text_separator','vc_separator','vc_gap','vc_heading','vc_contact_form','vc_portfolio','vc_portfolio_carousel','vc_posts_carousel','vc_content_carousel','vc_blog_list','vc_blog','vc_message','vc_tabs','vc_tour','vc_tab','vc_accordion','vc_accordion_tab','vc_toggle','vc_facebook','vc_tweetmeme','vc_googleplus','vc_pinterest','vc_single_image','vc_gallery','vc_button','vc_cta_button','vc_gmaps','vc_raw_html','vc_raw_js','vc_progress_bar','vc_pie','rev_slider_vc','layerslider_vc');
		
        /**
		 *Converts a shortcode into an array
		 **/
        static function shortcode2array($content, $depth = 1000)
        {	
		global $shortcode_tags;

        	$pattern = self::get_vc_shortcodes_regex();
        	$depth --;
			self::$temp_index++;
			
        	preg_match_all( "/$pattern/s", $content , $matches);
        	
        	$return = array();
        	foreach($matches[3] as $key => $match)
        	{
				$return[$key]['index'] = self::$temp_index ;
        		$return[$key]['shortcode'] 	= $matches[2][$key];        		
        		if(preg_match("/$pattern/s", $matches[5][$key]) && $depth)
        		{
        			$return[$key]['content'] 	= self::shortcode2array($matches[5][$key], $depth);
        		}
        		else
        		{
        			$return[$key]['content'] 	= $matches[5][$key];
					self::$temp_index++;
        		}
				
        	}
        	return $return;
        }
		
	   static function get_vc_shortcodes_regex(){

		   $tagnames = array_values(self::$vc_shortcodes);
	       $tagregexp = join( '|', array_map('preg_quote', $tagnames) );

	       return
		      '\\['                              // Opening bracket
		    . '(\\[?)'                           // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
		    . "($tagregexp)"                     // 2: Shortcode name
		    . '(?![\\w-])'                       // Not followed by word character or hyphen
		    . '('                                // 3: Unroll the loop: Inside the opening shortcode tag
		    .     '[^\\]\\/]*'                   // Not a closing bracket or forward slash
		    .     '(?:'
		    .         '\\/(?!\\])'               // A forward slash not followed by a closing bracket
		    .         '[^\\]\\/]*'               // Not a closing bracket or forward slash
		    .     ')*?'
		    . ')'
		    . '(?:'
		    .     '(\\/)'                        // 4: Self closing tag ...
		    .     '\\]'                          // ... and closing bracket
		    . '|'
		    .     '\\]'                          // Closing bracket
		    .     '(?:'
		    .         '('                        // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
		    .             '[^\\[]*+'             // Not an opening bracket
		    .             '(?:'
		    .                 '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
		    .                 '[^\\[]*+'         // Not an opening bracket
		    .             ')*+'
		    .         ')'
		    .         '\\[\\/\\2\\]'             // Closing shortcode tag
		    .     ')?'
		    . ')'
		    . '(\\]?)';                          // 6: Optional second closing brocket for escaping shortcodes: [[tag]]

		   
	   }
	
	   static function build_shortcode_tree($content)
        {
			if(!empty(self::$tree)) return false ;   
			
			$tree = self::shortcode2array($content);
			if( is_array($tree)){
				self::$tree = $tree;
			}
			unset($tree);
            return true;
        }
        	
	 static function find_tree_item($index, $sibling = false, $tree = false)
        {
            if(empty(self::$tree)) return false;
            if($tree === false) $tree = self::$tree;
			$return = array();
			if( is_array($tree) && !empty($tree)){
            foreach($tree as $key => $t)
            {
               if(!$return)
               {
	               if($t['index'] == $index)
	               {
	                    if($sibling !== false)
	                    {
	                        $return = isset($tree[$key + $sibling]) ? $tree[$key + $sibling] : false;
	                    }
	                    else
	                    {
	                        $return = $tree[$key];
	                    }
	                    
	                    return $return;
	               }
	               else if(!empty($tree[$key]['content']))
	               {
	                    $return = self::find_tree_item($index, $sibling, $tree[$key]['content']); 
	               }
               }
            }
			}
            return $return;
        }
        
	}    
}

function parse_shortcode_content( $content ) { 
 
    /* Parse nested shortcodes and add formatting. */ 
    $content = trim( wpautop( do_shortcode( $content ) ) ); 
 
    /* Remove '</p>' from the start of the string. */ 
    if ( substr( $content, 0, 4 ) == '</p>' ) 
        $content = substr( $content, 4 ); 
 
    /* Remove '<p>' from the end of the string. */ 
    if ( substr( $content, -3, 3 ) == '<p>' ) 
        $content = substr( $content, 0, -3 ); 
 
    /* Remove any instances of '<p></p>'. */ 
    $content = str_replace( array( '<p></p>' ), '', $content ); 
 
    return $content; 
} 

// portfolio loop style1 ,2 ,3

function brad_portfolio_loop_style1( &$portfolios , $args){
	global $post , $wpdb;
	$output = $lb_icon = $li_icon = $info = $video = '';
	
	$item_classes = '';
	$item_cats    = get_the_terms($post->ID, 'portfolio_category');
	if($item_cats):
	    foreach($item_cats as $item_cat) { $item_classes .= $item_cat->slug . ' '; }
    endif;

   //get the additional images for portfolio
   /*
    $img_list = get_post_meta( $post->ID , 'brad_image_list', false );
    if ( !is_array( $img_list ) ) { $img_list = ( array ) $img_list; }
	if ( !empty( $img_list ) ) {
		$img_list = implode( ',', $img_list );
		$images = $wpdb->get_col( "
			    	SELECT ID FROM $wpdb->posts
			    	WHERE post_type = 'attachment'
			    	AND ID IN ( $img_list )
			    	ORDER BY menu_order ASC
			    	" );
	 }
	 else{
	     $images = false;
	 }
	 */

   //if portfolio has featured image or additional images
   if( has_post_thumbnail() ):		
   
   //If lightbox icon is enabled
   if( $args['disable_lb_icon'] != 'yes'){
	   if( get_post_meta( $post->ID , 'brad_video_embed', true ) != ''){
		   $lb_id = rand();
		   $video = '<div id="lightbox_video_'.$lb_id.'" class="lightbox-video"><p>'.get_post_meta( $post->ID , 'brad_video_embed', true ).'</p></div>';
		   $lb_icon = '<a  href="#lightbox_video_'.$lb_id.'" title="'. get_the_title() .'" class="icon" rel="prettyPhoto[portfolio'. rand() .']"><i class="fa-search"></i></a>';
	   }
	   else{
           $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), '');	
	       $lb_icon = '<a href="'.$full_image[0].'" title="'. get_the_title() .'" class="icon" rel="prettyPhoto[portfolio'. rand() .']"><i class="fa-search"></i></a>'; 
	   }
	}
	
     //If link icon is enabled
     if( $args['disable_li_icon'] != 'yes'){
       $li_icon = '<a href="'.get_permalink($post->ID).'" title="'. get_the_title() .'" class="icon"><i class="fa-add"></i></a>'; 
	}
	
	 //set the info
	 $info = '<div class="info">';
	 $info .= '<h5>';
     if( $args['disable_li_title'] == 'yes'){
         $info .= get_the_title();
	  }
     else {
	    $info .= '<a href="'.get_permalink($post->ID).'" title="'.get_the_title().'">'.get_the_title().'</a>';
	  }
	 
	 $info .= '</h5>';
	 
	 if( $args['show_categories'] == 'yes'){
		 $info .=  '<h6>'.get_the_term_list($post->ID, 'portfolio_category' , '', ' , ','').'</h6>';
	 }
	  $info .= '</div>';
	
	
	//Attachement Image ( Featured Image )
	$attachment_image = wpb_getImageBySize( array( "attach_id" => get_post_thumbnail_id(), "thumb_size" => $args['img_size']) );
    
	//Output Buffer
	$output .=  '<div class="portfolio-item '.$item_classes.' '.$args['class'].' "><div class="inner-content">';
	
	//If the portfolio style set to style3
	if( $args['portfolio_style'] == 'style3'){
		$output .= '<div class="image hoverlay"><a href="'.get_permalink().'">'.$attachment_image['thumbnail'].'</a>';
		if( $args['overlay_style'] == 'style2' ){
	       $output .= '<div class="overlay"><div class="overlay-content">'.$li_icon.$lb_icon.$info.'</div></div>';
		}
		else{
			if( $li_icon != '' || $lb_icon != '' ){
			    $output .= '<div class="overlay"><div class="overlay-content">'.$li_icon.$lb_icon.'</div></div>';
			}
			$output .= $info;
		}
		$output .= '</div>';
	}
	
	//otherwise if portfolio styles are style1 or style2
	else {
		$output .= '<div class="image hoverlay"><a href="'.get_permalink().'">'.$attachment_image['thumbnail'].'</a>';
		if( $li_icon != '' || $lb_icon != '' ){
			$output .= '<div class="overlay"><div class="overlay-content">'.$li_icon.$lb_icon.'</div></div>';
		}
	   $output .= '</div>'.$info;
	}
	//Finish the Video
    $output .=  $video.'</div></div>';	
    endif;	
    return $output;
	
}


// Custom display comments 
function brad_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
<?php $add_below = ''; ?>

<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
  <div class="comment-body"> <?php echo get_avatar($comment, 60); ?>
    <h4><?php echo str_replace('</a>', '&nbsp;'. __('Says :','brad'). ' </a>',get_comment_author_link()); ?></h4>
    <div class="comment-meta"><?php printf(__('%1$s at %2$s', 'brad'), get_comment_date(),  get_comment_time()) ?></a></div>
    <p>
      <?php if ($comment->comment_approved == '0') : ?>
      <em><?php echo __('Your comment is awaiting moderation.', 'brad') ?></em><br />
      <?php endif; ?>
      <?php comment_text() ?>
    </p>
    <div class="reply">
      <?php edit_comment_link(__('Edit', 'brad'),'  ','') ?>
      <?php comment_reply_link(array_merge( $args, array('reply_text' => __('Reply', 'brad'), 'add_below' => 'comment', 'depth' => $depth, 'max_depth' => $args['max_depth'])))?>
    </div>
  </div>
  <?php }