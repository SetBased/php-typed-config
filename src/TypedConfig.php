<?php
declare(strict_types=1);

namespace SetBased\Config;

use Noodlehaus\Config;
use SetBased\Helper\Cast;
use SetBased\Helper\InvalidCastException;

/**
 * A strong typed configuration reader and writer.
 */
class TypedConfig
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * The configuration reader and writer.
   *
   * @var Config
   */
  private $config;

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * TypedConfig constructor.
   *
   * @param Config $config The configuration reader and writer.
   */
  public function __construct(Config $config)
  {
    $this->config = $config;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Creates an exception with appropriate message.
   *
   * @param string $key   The key (in dot notation).
   * @param string $type  The expected type.
   * @param mixed  $value The found value.
   *
   * @return TypedConfigException
   */
  private static function createException(string $key, string $type, $value): TypedConfigException
  {
    return new TypedConfigException($key, $type, $value);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns the underlying configuration reader and writer.
   *
   * @return Config
   */
  public function getConfig(): Config
  {
    return $this->config;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns the value of a mandatory nested configuration setting.
   *
   * @param string     $key     The key of the configuration setting. The key might be nested using dot notation.
   * @param array|null $default The default value.
   *
   * @return array
   *
   * @throws TypedConfigException
   */
  public function getManArray(string $key, ?array $default = null): array
  {
    $value = $this->config->get($key, $default);
    if (is_array($value))
    {
      return $value;
    }

    throw self::createException($key, 'array', $value);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns the value of a mandatory boolean configuration setting.
   *
   * @param string    $key     The key of the configuration setting. The key might be nested using dot notation.
   * @param bool|null $default The default value.
   *
   * @return bool
   *
   * @throws TypedConfigException
   */
  public function getManBool(string $key, ?bool $default = null): bool
  {
    $value = $this->config->get($key, $default);
    try
    {
      return Cast::toManBool($value);
    }
    catch (InvalidCastException $exception)
    {
      throw self::createException($key, 'boolean', $value);
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns the value of a mandatory finite float configuration setting.
   *
   * @param string     $key     The key of the configuration setting. The key might be nested using dot notation.
   * @param float|null $default The default value.
   *
   * @return float
   *
   * @throws TypedConfigException
   */
  public function getManFiniteFloat(string $key, ?float $default = null): float
  {
    $value = $this->config->get($key, $default);
    try
    {
      return Cast::toManFiniteFloat($value);
    }
    catch (InvalidCastException $exception)
    {
      throw self::createException($key, 'finite float', $value);
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns the value of a mandatory float configuration setting.
   *
   * @param string     $key     The key of the configuration setting. The key might be nested using dot notation.
   * @param float|null $default The default value.
   *
   * @return float
   *
   * @throws TypedConfigException
   */
  public function getManFloat(string $key, ?float $default = null): float
  {
    $value = $this->config->get($key, $default);
    try
    {
      return Cast::toManFloat($value);
    }
    catch (InvalidCastException $exception)
    {
      throw self::createException($key, 'float', $value);
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns the value of a mandatory integer configuration setting.
   *
   * @param string   $key     The key of the configuration setting. The key might be nested using dot notation.
   * @param int|null $default The default value.
   *
   * @return int
   *
   * @throws TypedConfigException
   */
  public function getManInt(string $key, ?int $default = null): int
  {
    $value = $this->config->get($key, $default);
    try
    {
      return Cast::toManInt($value);
    }
    catch (InvalidCastException $exception)
    {
      throw self::createException($key, 'integer', $value);
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns the value of a mandatory string configuration setting.
   *
   * @param string      $key     The key of the configuration setting. The key might be nested using dot notation.
   * @param string|null $default The default value.
   *
   * @return string
   *
   * @throws TypedConfigException
   */
  public function getManString(string $key, ?string $default = null): string
  {
    $value = $this->config->get($key, $default);
    try
    {
      return Cast::toManString($value);
    }
    catch (InvalidCastException $exception)
    {
      throw self::createException($key, 'string', $value);
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns the value of an optional nested configuration setting.
   *
   * @param string     $key     The key of the configuration setting. The key might be nested using dot notation.
   * @param array|null $default The default value.
   *
   * @return array|null
   *
   * @throws TypedConfigException
   */
  public function getOptArray(string $key, ?array $default = null): ?array
  {
    $value = $this->config->get($key, $default);
    if ($value===null || is_array($value))
    {
      return $value;
    }

    throw self::createException($key, 'array', $value);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns the value of an optional boolean configuration setting.
   *
   * @param string    $key     The key of the configuration setting. The key might be nested using dot notation.
   * @param bool|null $default The default value.
   *
   * @return bool|null
   *
   * @throws TypedConfigException
   */
  public function getOptBool(string $key, ?bool $default = null): ?bool
  {
    $value = $this->config->get($key, $default);
    try
    {
      return Cast::toOptBool($value);
    }
    catch (InvalidCastException $exception)
    {
      throw self::createException($key, 'boolean', $value);
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns the value of an optional finite float configuration setting.
   *
   * @param string     $key     The key of the configuration setting. The key might be nested using dot notation.
   * @param float|null $default The default value.
   *
   * @return float|null
   *
   * @throws TypedConfigException
   */
  public function getOptFiniteFloat(string $key, ?float $default = null): ?float
  {
    $value = $this->config->get($key, $default);
    try
    {
      return Cast::toOptFiniteFloat($value);
    }
    catch (InvalidCastException $exception)
    {
      throw self::createException($key, 'finite float', $value);
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns the value of an optional float configuration setting.
   *
   * @param string     $key     The key of the configuration setting. The key might be nested using dot notation.
   * @param float|null $default The default value.
   *
   * @return float|null
   *
   * @throws TypedConfigException
   */
  public function getOptFloat(string $key, ?float $default = null): ?float
  {
    $value = $this->config->get($key, $default);
    try
    {
      return Cast::toOptFloat($value);
    }
    catch (InvalidCastException $exception)
    {
      throw self::createException($key, 'float', $value);
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns the value of an optional integer configuration setting.
   *
   * @param string   $key     The key of the configuration setting. The key might be nested using dot notation.
   * @param int|null $default The default value.
   *
   * @return int|null
   *
   * @throws TypedConfigException
   */
  public function getOptInt(string $key, ?int $default = null): ?int
  {
    $value = $this->config->get($key, $default);
    try
    {
      return Cast::toOptInt($value);
    }
    catch (InvalidCastException $exception)
    {
      throw self::createException($key, 'integer', $value);
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns the value of an optional string configuration setting.
   *
   * @param string      $key     The key of the configuration setting. The key might be nested using dot notation.
   * @param string|null $default The default value.
   *
   * @return string|null
   *
   * @throws TypedConfigException
   */
  public function getOptString(string $key, ?string $default = null): ?string
  {
    $value = $this->config->get($key, $default);
    try
    {
      return Cast::toOptString($value);
    }
    catch (InvalidCastException $exception)
    {
      throw self::createException($key, 'string', $value);
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------
