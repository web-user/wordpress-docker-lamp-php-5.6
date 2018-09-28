<?php
function enqueue_scripts() 
{
	wp_enqueue_script( 'initjs', get_stylesheet_directory_uri() . '/init.js' );
	wp_enqueue_script( 'jquerymobile', 'http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js', array( 'initjs' ) );
	wp_enqueue_script( 'customjs', get_stylesheet_directory_uri() . '/custom.js' );
}
add_action('wp_enqueue_scripts', 'enqueue_scripts');

/* Custom Shortcodes - AdwordsYoutube */
function customShortcode_adwordsYoutube( $atts )
{
    $a = shortcode_atts( array(
        'videoid' => '',
		'conversionid' => '',
		'conversionlabel' => ''
    ), $atts );

	?>
	<style>
		.cs-adwordsyoutube-wrapper 
		{
		  	display: inline-block;
			
  			width: 100%;
			
		  	position: relative;
		}
		.cs-adwordsyoutube-wrapper:after
		{
	  		content: '';
			
	  		display: block;
			
	  		padding-top: 56.25%;
		}
		.cs-adwordsyoutube
		{
		  position: absolute;
		  top: 0;
		  bottom: 0;
		  left: 0;
		  right: 0;
		}
		.cs-adwordsyoutube iframe
		{
/*			margin-top: -50px;*/
			padding-bottom: 30px;
			padding-left: 15px;
			padding-right: 15px;
		}
	</style>
	<div class="cs-adwordsyoutube-wrapper">
		<div class="cs-adwordsyoutube">
			<!-- Google Code for Video Conversion Page
			In your html page, add the snippet and call
			goog_report_conversion when someone clicks on the
			chosen link or button. -->
			<script type="text/javascript">
			/* <![CDATA[ */
			goog_snippet_vars = function() {
			var w = window;
			w.google_conversion_id = "<?php echo $a[ 'conversionid' ]; ?>";
			w.google_conversion_label = "<?php echo $a[ 'conversionlabel' ]; ?>";
			w.google_remarketing_only = false;
			}
			// DO NOT CHANGE THE CODE BELOW.
			goog_report_conversion = function(url) 
			{
				goog_snippet_vars();
				window.google_conversion_format = "3";
				var opt = new Object();
				opt.onload_callback = function() 
				{
					if (typeof(url) != 'undefined') 
					{
						window.location = url;
					}
				}
				var conv_handler = window['google_trackConversion'];
				if (typeof(conv_handler) == 'function') {
				conv_handler(opt);
				}
			}
			/* ]]> */
			</script>
			<script type="text/javascript"
			src="//www.googleadservices.com/pagead/conversion_async.js">
			</script>
			<!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
			<div id="player"></div>

			<script>
			  // 2. This code loads the IFrame Player API code asynchronously.
			  var tag = document.createElement('script');

			  tag.src = "https://www.youtube.com/iframe_api";
			  var firstScriptTag = document.getElementsByTagName('script')[0];
			  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

			  // 3. This function creates an <iframe> (and YouTube player)
			  //    after the API code downloads.
			  var player;
			  function onYouTubeIframeAPIReady() {
				player = new YT.Player('player', {
				  height: '100%',
				  width: '100%',
				  videoId: '<?php echo $a['videoid']; ?>',
				  events: {
					'onReady': onPlayerReady,
					'onStateChange': onPlayerStateChange
				  }
				});
			  }

			  // 4. The API will call this function when the video player is ready.
			  function onPlayerReady(event) {}

			  // 5. The API calls this function when the player's state changes.
			  //    The function indicates that when playing a video (state=1),
			  //    the player should play for six seconds and then stop.
			  var done = false;
			  function onPlayerStateChange(event) {
				if (event.data == YT.PlayerState.PLAYING && !done) {
					var url      = window.location.href;
				  goog_report_conversion();
				  done = true;
				}
			  }
			  function stopVideo() {
				player.stopVideo();
			  }
			</script>
		</div>
		</div>
	<?php
}
add_shortcode( 'adwordsyoutube', 'customShortcode_adwordsYoutube' );

function form_submit_button( $button, $form ) {
    return "<button class='gform_button button' id='gform_submit_button_{$form['id']}'><span>" . __('Send', 'Contact form submit name') . "</span></button>";
}
add_filter( 'gform_submit_button', 'form_submit_button', 10, 2 );