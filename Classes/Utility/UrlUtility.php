<?php
namespace T3v\T3vCore\Utility;

/**
 * The URL utility class.
 *
 * @package T3v\T3vCore\Utility
 */
class UrlUtility {
  /**
   * Encodes URL.
   *
   * @param string $url The URL
   * @return string The encoded URL
   */
  public static function encodeUrl(string $url): string {
    return urlencode($url);
  }

  /**
   * Decodes URL.
   *
   * @param string $url The URL
   * @return string The decoded URL
   */
  public static function decodeUrl(string $url): string {
    return urldecode($url);
  }
}