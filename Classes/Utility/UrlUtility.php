<?php
namespace T3v\T3vCore\Utility;

use \T3v\T3vCore\Utility\AbstractHelper;

/**
 * Url Utility Class
 *
 * @package T3v\T3vCore\Utility
 */
class UrlUtility extends AbstractUtility {
  /**
   * Encodes an URL.
   *
   * @param string $url The URL
   * @return string The encoded URL
   */
  public static function encodeUrl($url) {
    $url = (string) $url;

    $url = urlencode($url);

    return $url;
  }

  /**
   * Decodes an URL.
   *
   * @param string $url The URL
   * @return string The decoded URL
   */
  public static function decodeUrl($url) {
    $url = (string) $url;

    $url = urldecode($url);

    return $url;
  }
}