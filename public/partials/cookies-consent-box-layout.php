<?php
/**
 * Sticky buttons
 *
 * @package Total WordPress Theme
 * @subpackage Partials
 * @version 4.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cookie_text = trim(strval($options_list['wzb_text_cookies']));
$cookie_info_text = $options_list['wzb_more_info_cookies'];
$cookie_info_link = get_permalink(intval($options_list['wzb_more_info_url_cookies']));

?>

<div id="cookies-consent-box" class="cookies-box">
  
  <div class="cookies-box-wrapper">
      <?php _e($cookie_text, 'cookie-consent');  ?>
      <a class="cookies-box-more-info-link" tabindex="0" target="_blank" href="<?php  echo $cookie_info_link;  ?>"><?php  echo __($cookie_info_text, 'cookie-expanish'); ?></a>
  </div>

  <button id="accept-cookie" class="theme-button" tabindex="0" onclick="catapultAcceptCookies();"><?php echo __('Accept', 'cookie-expanish');  ?></button>

</div>