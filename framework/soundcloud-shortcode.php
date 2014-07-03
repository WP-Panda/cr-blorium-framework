<?php
/*
Plugin Name: SoundCloud Shortcode
Plugin URI: http://wordpress.org/extend/plugins/soundcloud-shortcode/
Description: Converts SoundCloud WordPress shortcodes to a SoundCloud widget. Example: [soundcloud]http://soundcloud.com/forss/flickermood[/soundcloud]
Version: 3.0.2
Author: SoundCloud Inc.
Author URI: http://soundcloud.com
License: GPLv2

Original version: Johannes Wagener <johannes@soundcloud.com>
Options support: Tiffany Conroy <tiffany@soundcloud.com>
HTML5 & oEmbed support: Tim Bormans <tim@soundcloud.com>
*/


/* Register oEmbed provider
   -------------------------------------------------------------------------- */

wp_oembed_add_provider('#https?://(?:api\.)?soundcloud\.com/.*#i', 'http://soundcloud.com/oembed', true);


/* Register SoundCloud shortcode
   -------------------------------------------------------------------------- */

add_shortcode("soundcloud", "soundcloud_shortcode");


/**
 * SoundCloud shortcode handler
 * @param  {string|array}  $atts     The attributes passed to the shortcode like [soundcloud attr1="value" /].
 *                                   Is an empty string when no arguments are given.
 * @param  {string}        $content  The content between non-self closing [soundcloud]…[/soundcloud] tags.
 * @return {string}                  Widget embed code HTML
 */
function soundcloud_shortcode($atts, $content = null) {

  // Custom shortcode options
  $shortcode_options = array_merge(array('url' => trim($content)), is_array($atts) ? $atts : array());
  // Turn shortcode option "param" (param=value&param2=value) into array
  $shortcode_params = array();
  if (isset($shortcode_options['params'])) {
    parse_str(html_entity_decode($shortcode_options['params']), $shortcode_params);
  }
  $shortcode_options['params'] = $shortcode_params;

  $player_type = soundcloud_get_option('player_type', 'visual');
  $isIframe    = $player_type !== 'flash';
  $isVisual    = !$player_type || $player_type === 'visual';


  // User preference options
  $plugin_options = array_filter(array(
    'iframe' => $isIframe,
    'width'  => soundcloud_get_option('player_width'),
    'height' => soundcloud_url_has_tracklist($shortcode_options['url']) ? soundcloud_get_option('player_height_multi') : soundcloud_get_option('player_height'),
    'params' => array_filter(array(
      'auto_play'     => soundcloud_get_option('auto_play'),
      'show_comments' => soundcloud_get_option('show_comments'),
      'color'         => soundcloud_get_option('color'),
      'visual'        => ($isVisual ? 'true' : 'false')
    )),
  ));
  // Needs to be an array
  if (!isset($plugin_options['params'])) { $plugin_options['params'] = array(); }

  // plugin options < shortcode options
  $options = array_merge(
    $plugin_options,
    $shortcode_options
  );

  // plugin params < shortcode params
  $options['params'] = array_merge(
    $plugin_options['params'],
    $shortcode_options['params']
  );

  // The "url" option is required
  if (!isset($options['url'])) {
    return '';
  } else {
    $options['url'] = trim($options['url']);
  }

  // Both "width" and "height" need to be integers
  if (isset($options['width']) && !preg_match('/^\d+$/', $options['width'])) {
    // set to 0 so oEmbed will use the default 100% and WordPress themes will leave it alone
    $options['width'] = 0;
  }
  if (isset($options['height']) && !preg_match('/^\d+$/', $options['height'])) { unset($options['height']); }

  // The "iframe" option must be true to load the iframe widget
  $iframe = soundcloud_booleanize($options['iframe']);

  // Remove visual parameter from Flash widget or when it's false because that's the default
  if ($options['params']['visual'] && (!$iframe || !soundcloud_booleanize($options['params']['visual']))) {
    unset($options['params']['visual']);
  }

  // Merge in "url" value
  $options['params'] = array_merge(array(
    'url' => $options['url']
  ), $options['params']);

  // Return html embed code
  if ($iframe) {
    return soundcloud_iframe_widget($options);
  } else {
    return soundcloud_flash_widget($options);
  }

}

/**
 * Plugin options getter
 * @param  {string|array}  $option   Option name
 * @param  {mixed}         $default  Default value
 * @return {mixed}                   Option value
 */
function soundcloud_get_option($option, $default = false) {
  $value = get_option('soundcloud_' . $option);
  return $value === '' ? $default : $value;
}

/**
 * Booleanize a value
 * @param  {boolean|string}  $value
 * @return {boolean}
 */
function soundcloud_booleanize($value) {
  return is_bool($value) ? $value : $value === 'true' ? true : false;
}

/**
 * Decide if a url has a tracklist
 * @param  {string}   $url
 * @return {boolean}
 */
function soundcloud_url_has_tracklist($url) {
  return preg_match('/^(.+?)\/(sets|groups|playlists)\/(.+?)$/', $url);
}

/**
 * Parameterize url
 * @param  {array}  $match  Matched regex
 * @return {string}          Parameterized url
 */
function soundcloud_oembed_params_callback($match) {
  global $soundcloud_oembed_params;
   //global $smof_data;
  // Convert URL to array
  $url = parse_url(urldecode($match[1]));
  // Convert URL query to array
  parse_str($url['query'], $query_array);
  // Build new query string
  $query = http_build_query(array_merge($query_array, $soundcloud_oembed_params));

  return 'src="' . $url['scheme'] . '://' . $url['host'] . $url['path'] . '?' . $query;
}

/**
 * Iframe widget embed code
 * @param  {array}   $options  Parameters
 * @return {string}            Iframe embed code
 */
function soundcloud_iframe_widget($options) {
  global $smof_data;
  // Build URL
  $url = 'https://w.soundcloud.com/player?' . http_build_query($options['params']);
  $url = str_replace('&', '&amp;', $url);
  // Set default width if not defined
  $width = isset($options['width']) && $options['width'] !== 0 ? $options['width'] : $smof_data['content_width'];
  // Set default height if not defined

  $height = isset($options['height']) && $options['height'] !== 0
              ? $options['height']
              : (soundcloud_url_has_tracklist($options['url']) || (isset($options['params']['visual']) && soundcloud_booleanize($options['params']['visual'])) ? '450' : '166');

  return sprintf('<iframe width="%s" height="%s" src="%s"></iframe>', $width, $height, $url);
}

/**
 * Legacy Flash widget embed code
 * @param  {array}   $options  Parameters
 * @return {string}            Flash embed code
 */
function soundcloud_flash_widget($options) {
  global $smof_data;
  // Build URL
  $url = 'https://player.soundcloud.com/player.swf?' . http_build_query($options['params']);
   $url = str_replace('&', '&amp;', $url);

  // Set default width if not defined
  $width = isset($options['width']) && $options['width'] !== 0 ? $options['width'] : $smof_data['content_width'];
  // Set default height if not defined
  $height = isset($options['height']) && $options['height'] !== 0 ? $options['height'] : (soundcloud_url_has_tracklist($options['url']) ? '255' : '81');

  return preg_replace('/\s\s+/', "", sprintf('<object width="%s" height="%s">
                                <param name="movie" value="%s"></param>
                                <param name="allowscriptaccess" value="always"></param>
                                <embed width="%s" height="%s" src="%s" allowscriptaccess="always" type="application/x-shockwave-flash"></embed>
                              </object>', $width, $height, $url, $width, $height, $url));
}