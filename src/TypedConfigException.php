<?php
declare(strict_types=1);

namespace SetBased\Config;

use SetBased\Helper\Cast;

/**
 * Strong typed configuration exception.
 */
class TypedConfigException extends \RuntimeException
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Object constructor.
   *
   * @param string $key   The key (in dot notation).
   * @param string $type  The expected type.
   * @param mixed  $value The found value.
   */
  public function __construct(string $key, string $type, $value)
  {
    parent::__construct(self::message($key, $type, $value));
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Generates the error message.
   *
   * @param string $key   The key (in dot notation).
   * @param string $type  The expected type.
   * @param mixed  $value The found value.
   *
   * @return string The error message.
   */
  private static function message(string $key, string $type, $value): string
  {
    if ($value===null)
    {
      return sprintf("Empty mandatory %s value found for key '%s'", $type, $key);
    }

    $a = (in_array($type, ['array', 'integer'])) ? 'an' : 'a';

    if (Cast::isManString($value))
    {
      return sprintf("Value '%s' for key '%s' is not %s %s", Cast::toManString($value), $key, $a, $type);
    }

    return sprintf("Value of type %s for key '%s' is not %s %s", gettype($value), $key, $a, $type);
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------
