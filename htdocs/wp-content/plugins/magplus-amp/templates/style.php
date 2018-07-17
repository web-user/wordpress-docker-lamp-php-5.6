<?php
// Get content width
$content_max_width       = absint( $this->get( 'content_max_width' ) );

// Get template colors
$theme_color             = $this->get_customizer_setting( 'theme_color' );
$text_color              = $this->get_customizer_setting( 'text_color' );
$muted_text_color        = $this->get_customizer_setting( 'muted_text_color' );
$border_color            = $this->get_customizer_setting( 'border_color' );
$link_color              = $this->get_customizer_setting( 'link_color' );
$header_background_color = $this->get_customizer_setting( 'header_background_color' );
$header_color            = $this->get_customizer_setting( 'header_color' );
$logo_url = magplus_get_opt('amp-logo');

$font_Roboto = "'Roboto', sans-serif;";

?>
/* Generic WP styling */

.alignright {
	float: right;
}

a {
	text-decoration:none;
}

.alignleft {
	float: left;
}

.aligncenter {
	display: block;
	margin-left: auto;
	margin-right: auto;
}

.amp-wp-enforced-sizes {
	/** Our sizes fallback is 100vw, and we have a padding on the container; the max-width here prevents the element from overflowing. **/
	max-width: 100%;
	margin: 0 auto;
}

.amp-wp-unknown-size img {
	/** Worst case scenario when we can't figure out dimensions for an image. **/
	/** Force the image into a box of fixed dimensions and use object-fit to scale. **/
	object-fit: contain;
}

/* Template Styles */

.amp-wp-content,
.amp-wp-title-bar div {
	<?php if ( $content_max_width > 0 ) : ?>
	margin: 0 auto;
	max-width: <?php echo sprintf( '%dpx', $content_max_width ); ?>;
	<?php endif; ?>
}

html {
	background: #fff;
}

body {
	background: <?php echo sanitize_hex_color( $theme_color ); ?>;
	color: <?php echo sanitize_hex_color( $text_color ); ?>;
	font-family: <?php echo $font_Roboto; ?>
	font-weight: 400;
	line-height: 1.5em;
}

p,
ol,
ul,
figure {
	margin: 0 0 1em;
	padding: 0;
}

a,
a:visited {
	color: <?php echo sanitize_hex_color( $link_color ); ?>;
}

a:hover,
a:active,
a:focus {
	color: <?php echo sanitize_hex_color( $text_color ); ?>;
}

/* Quotes */

blockquote {
	color: <?php echo sanitize_hex_color( $text_color ); ?>;
	background: rgba(127,127,127,.125);
	border-left: 2px solid <?php echo sanitize_hex_color( $link_color ); ?>;
	margin: 8px 0 24px 0;
	padding: 16px;
}

blockquote p:last-child {
	margin-bottom: 0;
}

.amp-wp-single-title {
	font-family:<?php echo $font_Roboto; ?>
	text-align:center;
	color:<?php echo magplus_get_opt('amp-title-color'); ?> !important;
	line-height:1.1em;
	margin-bottom:10px !important;
	font-size:32px;
}

.text-center {
	text-align:center;
}

/* Header */

.amp-wp-header {
	-webkit-box-shadow: 0px 1px 2px 0px #eaeaea;
  -moz-box-shadow: 0px 1px 2px 0px #eaeaea;
  background:#fff;
  border-bottom:1px solid #eaeaea;
  box-shadow: 0px 1px 2px 0px #eaeaea;
  z-index:9999;
  position:fixed;
  text-align:center;
  top:0;
  width:100%;
}

.amp-wp-header div {
	color: <?php echo sanitize_hex_color( $header_color ); ?>;
	font-size: 1em;
	font-weight: 400;
	margin: 0 auto;
	max-width: calc(840px - 32px);
	padding: .875em 16px;
	position: relative;
}

.amp-wp-header a {
  color: #111;
  text-decoration: none;
}

.amp-wp-header.has-logo a {
	background-image:url(<?php echo $logo_url['url']; ?>);
  display:inline-block;
  width:85px;
  text-indent:-99999px;
  height:auto;
  background-size:contain;
  background-repeat:no-repeat;
}

h1,h2,h3,h4,h5,h6 {
	font-family:<?php echo $font_Roboto; ?>
	color:#111;
	text-transform:none;
	line-height:1.1em;
}

/* Site Icon */

.amp-wp-header .amp-wp-site-icon {
	/** site icon is 32px **/
	background-color: <?php echo sanitize_hex_color( $header_color ); ?>;
	border: 1px solid <?php echo sanitize_hex_color( $header_color ); ?>;
	border-radius: 50%;
	position: absolute;
	right: 18px;
	top: 10px;
}

/* Article */

.amp-wp-article {
	color: <?php echo magplus_get_opt('amp-content-color'); ?>;
	font-weight: 400;
	margin: 1.5em auto;
	padding-top:52px;.amp-wp-header a
	max-width: 840px;
	overflow-wrap: break-word;
	word-wrap: break-word;
}

/* Article Header */

.amp-wp-article-header {
	align-items: center;
	align-content: stretch;
	display: flex;
	flex-wrap: wrap;
	justify-content: space-between;
	margin: 1.5em 16px 1.5em;
}

.amp-wp-title {
	color: <?php echo sanitize_hex_color( $text_color ); ?>;
	display: block;
	flex: 1 0 100%;
	font-weight: 900;
	margin: 0 0 .625em;
	width: 100%;
}

/* Article Meta */

.amp-wp-meta {
	color: <?php echo sanitize_hex_color( $muted_text_color ); ?>;
	display: inline-block;
	flex: 2 1 50%;
	font-size: .875em;
	line-height: 1.5em;
	margin: 0;
	padding: 0;
}

.amp-wp-article-header .amp-wp-meta:last-of-type {
	text-align: right;
}

.amp-wp-article-header .amp-wp-meta:first-of-type {
	text-align: left;
}

.tt-blog-nav-label {
	font-size:11px;
	color:#b5b5b5;
}

.amp-wp-byline amp-img,
.amp-wp-byline .amp-wp-author {
	display: inline-block;
	vertical-align: middle;
}

.amp-wp-meta {
	color:<?php echo magplus_get_opt('amp-author-color'); ?> !important;
}

.amp-wp-article-featured-image {
	padding-top:20px !important;
	margin-top:20px !important;
	border-top:1px solid #eee;
}

.amp-wp-meta time {
	color:<?php echo magplus_get_opt('amp-date-color'); ?> !important;
}

.amp-wp-byline amp-img {
	border: 1px solid <?php echo sanitize_hex_color( $link_color ); ?>;
	border-radius: 50%;
	position: relative;
	margin-right: 6px;
}

.amp-wp-posted-on {
	text-align: right;
}

/* Featured image */

.amp-wp-article-featured-image {
	margin: 0 0 1em;
}
.amp-wp-article-featured-image amp-img {
	margin: 0 auto;
}
.amp-wp-article-featured-image.wp-caption .wp-caption-text {
	margin: 0 18px;
}

/* Article Content */

.amp-wp-article-content {
	margin: 0 16px;
}

.amp-wp-article-content ul,
.amp-wp-article-content ol {
	margin-left: 1em;
}

.amp-wp-article-content amp-img {
	margin: 0 auto;
}

.amp-wp-article-content amp-img.alignright {
	margin: 0 0 1em 16px;
}

.amp-wp-article-content amp-img.alignleft {
	margin: 0 16px 1em 0;
}

/* Captions */

.wp-caption {
	padding: 0;
}

.wp-caption.alignleft {
	margin-right: 16px;
}

.wp-caption.alignright {
	margin-left: 16px;
}

.wp-caption .wp-caption-text {
	border-bottom: 1px solid #eee;
	color: <?php echo sanitize_hex_color( $muted_text_color ); ?>;
	font-size: .875em;
	line-height: 1.5em;
	margin: 0;
	padding: .66em 10px .75em;
}

/* AMP Media */

amp-carousel {
	background: <?php echo sanitize_hex_color( $border_color ); ?>;
	margin: 0 -16px 1.5em;
}
amp-iframe,
amp-youtube,
amp-instagram,
amp-vine {
	background: <?php echo sanitize_hex_color( $border_color ); ?>;
	margin: 0 -16px 1.5em;
}

.amp-wp-article-content amp-carousel amp-img {
	border: none;
}

amp-carousel > amp-img > img {
	object-fit: contain;
}

.amp-wp-iframe-placeholder {
	background: <?php echo sanitize_hex_color( $border_color ); ?> url( <?php echo esc_url( $this->get( 'placeholder_image_url' ) ); ?> ) no-repeat center 40%;
	background-size: 48px 48px;
	min-height: 48px;
}

/* Article Footer Meta */

.amp-wp-article-footer .amp-wp-meta {
	display: block;
}

.post-pagination {
	padding-top:15px;
	border-top:1px solid #eee;
	margin:0 16px;
}

.post-pagination h5,
.post-pagination a {
	margin:0 !important;
	text-decoration:none;
}

.post-pagination a:hover h5 {
	color:#666;
}

.amp-wp-tax-category,
.amp-wp-tax-tag {
	color: #111 !important;
	font-size: .875em;
	line-height: 1.5em;
	margin: 1.5em 16px;
}

.amp-wp-tax-tag a {
	color:<?php echo magplus_get_opt('amp-tags-color'); ?>
	text-decoration:none;
}

.amp-wp-comments-link {
	color: <?php echo sanitize_hex_color( $muted_text_color ); ?>;
	font-size: .875em;
	line-height: 1.5em;
	text-align: center;
	margin: 2.25em 0 1.5em;
}

.amp-wp-comments-link a {
	border-style: solid;
	border-color: <?php echo sanitize_hex_color( $border_color ); ?>;
	border-width: 1px 1px 2px;
	border-radius: 4px;
	background-color: transparent;
	color: <?php echo sanitize_hex_color( $link_color ); ?>;
	cursor: pointer;
	display: block;
	font-size: 14px;
	font-weight: 600;
	line-height: 18px;
	margin: 0 auto;
	max-width: 200px;
	padding: 11px 16px;
	text-decoration: none;
	width: 50%;
	-webkit-transition: background-color 0.2s ease;
			transition: background-color 0.2s ease;
}

/* AMP Footer */

.amp-wp-footer {
	background:#000;
	margin-top:30px;
}

.amp-wp-footer div {
	margin: 0 auto;
	max-width: calc(840px - 32px);
	padding:10px;
	font-size:12px;
	color:#444;
	line-height:1.5;
	text-align:center;
	position: relative;
}

.amp-wp-footer h2 {
	font-size: 1em;
	line-height: 1.375em;
	margin: 0 0 .5em;
}

.amp-wp-footer p {
	color: <?php echo sanitize_hex_color( $muted_text_color ); ?>;
	font-size: .8em;
	line-height: 1.5em;
	margin: 0 85px 0 0;
}

.amp-wp-footer a {
	text-decoration: none;
}

.back-to-top {
	bottom: 1.275em;
	font-size: .8em;
	font-weight: 600;
	line-height: 2em;
	position: absolute;
	right: 16px;
}


/*magplus comment*/
.tt-comment {
  list-style: none;
  margin-bottom: -15px;
}

.tt-comment-container {
  margin-bottom: 25px;
}

.tt-comment-avatar {
  float: left;
  width: 40px;
  height: 40px;
  -moz-border-radius: 100%;
  border-radius: 100%;
  overflow: hidden;
}

.tt-comment-avatar img {
  -moz-border-radius: 100%;
  border-radius: 100%;
}

.tt-comment-info {
  padding-left: 50px;
  padding-top: 10px;
}

.tt-comment-label {
  font-family: 'Roboto';
  font-size: 14px;
  line-height: 18px;
  font-weight: 400;
  color: #b5b5b5;
  margin-bottom: 5px;
}

.tt-comment-label span:after {
  content: '•';
  display: inline-block;
  padding-left: 4px;
  padding-right: 1px;
}

.tt-comment-label span:last-child:after {
  display: none;
}

.tt-comment-label a {
  font-weight: 700;
  color: #111;
  text-decoration:none;
}

.tt-comment-label a:hover {
  color: #51c8fa;
}

.tt-comment-info .simple-text {
  margin-bottom: 5px;
}

.tt-comment-reply,
.comment-reply-link,
.comment-edit-link {
  font-size: 13px;
  line-height: 17px;
  font-weight: 500;
  color: #111;
}

.tt-comment-reply .fa,
.comment-reply-link .fa {
  color: #ccc;
  margin-right: 6px;
  -webkit-transition: all 300ms ease-in-out;
  -moz-transition: all 300ms ease-in-out;
  transition: all 300ms ease-in-out;
}

.tt-comment-reply:hover,
.tt-comment-reply:hover .fa,
.comment-reply-link:hover,
.comment-reply-link:hover .fa,
.comment-edit-link:hover {
  color: #51c8fa;
}

.tt-comment .children {
  list-style: none;
  padding-left: 35px;
}

.tt-comment .children .tt-comment-avatar {
  width: 30px;
  height: 30px;
}

.tt-comment-container p {
  margin-bottom: 0px;
  font-size:13px;
  line-height:1.6em;
  color:#666;
}

.tt-comment .children .tt-comment-info {
  padding-left: 40px;
  padding-top: 2px;
}

@media (max-width:767px) {
  .tt-comment-container {
    text-align: center;
  }
  .tt-comment-avatar {
    display: inline-block;
    float: none;
    margin-bottom: 10px;
  }
  .tt-comment-info {
    padding-left: 0;
  }
  .tt-comment .children {
    padding-left: 0;
  }
  .tt-comment .children .tt-comment-info {
    padding-left: 0;
  }
}

.tt-comment li.pingback {
  padding-bottom: 12px;
  margin-bottom: 12px;
  border-bottom: 1px solid #e1e1e1;
}

.tt-comment li.pingback a {
  color: #51c8fa;
}


.tt-comment li.pingback:last-child {
  margin-bottom: 25px !important;
}


.comment-form .tt-comment-form-ava {
  float: left;
  display: block;
  width: 40px;
  border-radius: 50%;
}

.tt-comment-form-content,
.tt-comment-form {
  padding-left: 55px;
  padding-top: 6px;
}

p.logged-in-as {
  margin-bottom: 10px !important;
  font-size:12px;
  color:#b5b5b5;
}

.tt-comment-form {
  padding-left: 0;
}

.tt-comment-form .c-area {
  margin-bottom: 10px;
  border:1px solid #eee;
  width:100%;
  padding:12px 15px;
  box-sizing:border-box;
  -webkit-box-sizing:border-box;
  color:#b5b5b5;
  font-family:<?php echo $font_Roboto; ?>
}

.tt-comment-form .c-input {
  margin-bottom: 19px;
}

.tt-comment-form .c-btn {
  margin-top: -17px;
}

@media (max-width:767px) {
  .tt-comment-form-ava {
    float: none;
    margin: 0 auto 10px auto;
  }
  .tt-comment-form-content {
    padding-left: 0;
  }
}

.tt-title-block-2 {
	text-align:center;
}

.coment-item {
	margin:0 16px;
	border-top:1px solid #eee;
	margin-top:20px;
}

#reply-title {
	font-size:18px;
	margin-bottom:0;
}

.tt-comment-form input[type="submit"] {
	border:0 none;
	background:#666;
	color:#fff;
	padding:10px;
}