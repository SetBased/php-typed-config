<?php
declare(strict_types=1);

namespace SetBased\Config\Test;

use Noodlehaus\Config;
use PHPUnit\Framework\TestCase;
use SetBased\Config\TypedConfig;
use SetBased\Config\TypedConfigException;

/**
 * Test cases for class TypesConfig.
 */
class TypedConfigTest extends TestCase
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * The underling configuration reader.
   *
   * @var Config
   */
  private Config $config;

  /**
   * The configuration reader for testing.
   *
   * @var TypedConfig
   */
  private TypedConfig $typeConfig;

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Data provider for invalid mandatory arrays.
   *
   * @return array
   */
  public function invalidManArrayCases(): array
  {
    $cases = $this->invalidOptArrayCases();

    $cases[] = ['null.array', null];

    return $cases;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Data provider for invalid mandatory booleans.
   *
   * @return array
   */
  public function invalidManBoolCases(): array
  {
    $cases = $this->invalidOptBoolCases();

    $cases[] = ['null.bool', null];

    return $cases;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Data provider for invalid mandatory finite floats.
   *
   * @return array
   */
  public function invalidManFloatCases(): array
  {
    $cases = $this->invalidOptCases();

    $cases[] = ['null.finite-float', null];

    return $cases;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Data provider for invalid mandatory floats including NaN, -INF, and INF.
   *
   * @return array
   */
  public function invalidManFloatInclusiveCases(): array
  {
    $cases = $this->invalidOptFloatInclusiveCases();

    $cases[] = ['null.float-inclusive', null];

    return $cases;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Data provider for invalid mandatory integers.
   *
   * @return array
   */
  public function invalidManIntCases(): array
  {
    $cases = $this->invalidOptIntCases();

    $cases[] = ['null.integer', null];

    return $cases;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Data provider for invalid optional integers.
   *
   * @return array
   */
  public function invalidManStringCases(): array
  {
    $cases = $this->invalidOptStringCases();

    $cases[] = ['null.string', null];

    return $cases;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Data provider for invalid optional arrays.
   *
   * @return array
   */
  public function invalidOptArrayCases(): array
  {
    return [['invalid.array', null]];
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Data provider for invalid optional booleans.
   *
   * @return array
   */
  public function invalidOptBoolCases(): array
  {
    return [['invalid.bool', null]];
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Data provider for invalid optional finite floats.
   *
   * @return array
   */
  public function invalidOptCases(): array
  {
    return [['invalid.finite-float', null]];
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Data provider for invalid optional floats including NaN, -INF, and INF.
   *
   * @return array
   */
  public function invalidOptFloatInclusiveCases(): array
  {
    return [['invalid.float-inclusive', null]];
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Data provider for invalid optional integers.
   *
   * @return array
   */
  public function invalidOptIntCases(): array
  {
    return [['invalid.integer', null]];
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Data provider for invalid optional integers.
   *
   * @return array
   */
  public function invalidOptStringCases(): array
  {
    return [['invalid.string', null]];
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Creates the configuration reader for testing.
   */
  public function setUp(): void
  {
    $this->config = new Config(__DIR__.'/test.ini');
    $this->config->set('invalid.string', fopen('php://stdout', 'w'));
    $this->typeConfig = new TypedConfig($this->config);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case for method getConfig().
   */
  public function testGetConfig(): void
  {
    self::assertSame($this->config, $this->typeConfig->getConfig());
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case for invalid mandatory array.
   *
   * @param string     $key     The key.
   * @param array|null $default The default value.
   *
   * @dataProvider invalidManArrayCases
   */
  public function testInvalidArrayBool(string $key, ?array $default): void
  {
    $this->expectException(TypedConfigException::class);
    $this->typeConfig->getManArray($key, $default);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case for invalid mandatory boolean.
   *
   * @param string    $key     The key.
   * @param bool|null $default The default value.
   *
   * @dataProvider invalidManBoolCases
   */
  public function testInvalidManBool(string $key, ?bool $default): void
  {
    $this->expectException(TypedConfigException::class);
    $this->typeConfig->getManBool($key, $default);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case for invalid mandatory finite float.
   *
   * @param string   $key     The key.
   * @param int|null $default The default value.
   *
   * @dataProvider invalidManFloatCases
   */
  public function testInvalidManFloat(string $key, ?int $default): void
  {
    $this->expectException(TypedConfigException::class);
    $this->typeConfig->getManFloat($key, $default);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case for invalid mandatory float including NaN, -INF, and INF.
   *
   * @param string   $key     The key.
   * @param int|null $default The default value.
   *
   * @dataProvider invalidManFloatInclusiveCases
   */
  public function testInvalidManFloatInclusive(string $key, ?int $default): void
  {
    $this->expectException(TypedConfigException::class);
    $this->typeConfig->getManFloatInclusive($key, $default);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case for invalid mandatory integer.
   *
   * @param string   $key     The key.
   * @param int|null $default The default value.
   *
   * @dataProvider invalidManIntCases
   */
  public function testInvalidManInt(string $key, ?int $default): void
  {
    $this->expectException(TypedConfigException::class);
    $this->typeConfig->getManInt($key, $default);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case for invalid mandatory string.
   *
   * @param string   $key     The key.
   * @param int|null $default The default value.
   *
   * @dataProvider invalidManStringCases
   */
  public function testInvalidManString(string $key, ?int $default): void
  {
    $this->expectException(TypedConfigException::class);
    $this->typeConfig->getManString($key, $default);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case for invalid optional array.
   *
   * @param string     $key     The key.
   * @param array|null $default The default value.
   *
   * @dataProvider invalidOptArrayCases
   */
  public function testInvalidOptArray(string $key, ?array $default): void
  {
    $this->expectException(TypedConfigException::class);
    $this->typeConfig->getOptArray($key, $default);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case for invalid optional boolean.
   *
   * @param string    $key     The key.
   * @param bool|null $default The default value.
   *
   * @dataProvider invalidOptBoolCases
   */
  public function testInvalidOptBool(string $key, ?bool $default): void
  {
    $this->expectException(TypedConfigException::class);
    $this->typeConfig->getOptBool($key, $default);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case for invalid optional finite float.
   *
   * @param string   $key     The key.
   * @param int|null $default The default value.
   *
   * @dataProvider invalidOptCases
   */
  public function testInvalidOptFloat(string $key, ?int $default): void
  {
    $this->expectException(TypedConfigException::class);
    $this->typeConfig->getOptFloat($key, $default);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case for invalid optional float including NaN, -INF, and INF.
   *
   * @param string   $key     The key.
   * @param int|null $default The default value.
   *
   * @dataProvider invalidOptFloatInclusiveCases
   */
  public function testInvalidOptFloatInclusive(string $key, ?int $default): void
  {
    $this->expectException(TypedConfigException::class);
    $this->typeConfig->getOptFloatInclusive($key, $default);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case for invalid optional integer.
   *
   * @param string   $key     The key.
   * @param int|null $default The default value.
   *
   * @dataProvider invalidOptIntCases
   */
  public function testInvalidOptInt(string $key, ?int $default): void
  {
    $this->expectException(TypedConfigException::class);
    $this->typeConfig->getOptInt($key, $default);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case for invalid optional string.
   *
   * @param string   $key     The key.
   * @param int|null $default The default value.
   *
   * @dataProvider invalidOptStringCases
   */
  public function testInvalidOptString(string $key, ?int $default): void
  {
    $this->expectException(TypedConfigException::class);
    $this->typeConfig->getOptString($key, $default);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case for mandatory integer.
   *
   * @param string   $key      The key.
   * @param int|null $default  The default value.
   * @param int|null $expected The expected value.
   *
   * @dataProvider validManIntCases
   */
  public function testValidInt(string $key, ?int $default, ?int $expected): void
  {
    $value = $this->typeConfig->getManInt($key, $default);
    self::assertSame($value, $expected);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case for mandatory array.
   *
   * @param string     $key      The key.
   * @param array|null $default  The default value.
   * @param array|null $expected The expected value.
   *
   * @dataProvider validManArrayCases
   */
  public function testValidManArray(string $key, ?array $default, ?array $expected): void
  {
    $value = $this->typeConfig->getManArray($key, $default);
    self::assertSame($value, $expected);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case for mandatory boolean.
   *
   * @param string    $key      The key.
   * @param bool|null $default  The default value.
   * @param bool|null $expected The expected value.
   *
   * @dataProvider validManBoolCases
   */
  public function testValidManBool(string $key, ?bool $default, ?bool $expected): void
  {
    $value = $this->typeConfig->getManBool($key, $default);
    self::assertSame($value, $expected);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case for mandatory finite float.
   *
   * @param string     $key      The key.
   * @param float|null $default  The default value.
   * @param float|null $expected The expected value.
   *
   * @dataProvider validManFloatCases
   */
  public function testValidManFloat(string $key, ?float $default, ?float $expected): void
  {
    $value = $this->typeConfig->getManFloat($key, $default);
    self::assertSame($value, $expected);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case for mandatory float including NaN, -INF, and INF.
   *
   * @param string     $key      The key.
   * @param float|null $default  The default value.
   * @param float|null $expected The expected value.
   *
   * @dataProvider validManFloatInclusiveCases
   */
  public function testValidManFloatInclusive(string $key, ?float $default, ?float $expected): void
  {
    $value = $this->typeConfig->getManFloatInclusive($key, $default);
    self::assertSame($value, $expected);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case for optional array.
   *
   * @param string     $key      The key.
   * @param array|null $default  The default value.
   * @param array|null $expected The expected value.
   *
   * @dataProvider validOptArrayCases
   */
  public function testValidOptArray(string $key, ?array $default, ?array $expected): void
  {
    $value = $this->typeConfig->getOptArray($key, $default);
    self::assertSame($value, $expected);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case for optional boolean.
   *
   * @param string    $key      The key.
   * @param bool|null $default  The default value.
   * @param bool|null $expected The expected value.
   *
   * @dataProvider validOptBoolCases
   */
  public function testValidOptBool(string $key, ?bool $default, ?bool $expected): void
  {
    $value = $this->typeConfig->getOptBool($key, $default);
    self::assertSame($value, $expected);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case for optional finite float.
   *
   * @param string     $key      The key.
   * @param float|null $default  The default value.
   * @param float|null $expected The expected value.
   *
   * @dataProvider validOptFloatCases
   */
  public function testValidOptFloat(string $key, ?float $default, ?float $expected): void
  {
    $value = $this->typeConfig->getOptFloat($key, $default);
    self::assertSame($value, $expected);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case for optional float including NaN, -INF, and INF.
   *
   * @param string     $key      The key.
   * @param float|null $default  The default value.
   * @param float|null $expected The expected value.
   *
   * @dataProvider validOptFloatInclusiveCases
   */
  public function testValidOptFloatInclusive(string $key, ?float $default, ?float $expected): void
  {
    $value = $this->typeConfig->getOptFloatInclusive($key, $default);
    self::assertSame($value, $expected);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case for optional integer.
   *
   * @param string   $key      The key.
   * @param int|null $default  The default value.
   * @param int|null $expected The expected value.
   *
   * @dataProvider validOptIntCases
   */
  public function testValidOptInt(string $key, ?int $default, ?int $expected): void
  {
    $value = $this->typeConfig->getOptInt($key, $default);
    self::assertSame($value, $expected);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case for optional string.
   *
   * @param string      $key      The key.
   * @param string|null $default  The default value.
   * @param string|null $expected The expected value.
   *
   * @dataProvider validOptStringCases
   */
  public function testValidOptString(string $key, ?string $default, ?string $expected): void
  {
    $value = $this->typeConfig->getOptString($key, $default);
    self::assertSame($value, $expected);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test case for mandatory string.
   *
   * @param string      $key      The key.
   * @param string|null $default  The default value.
   * @param string|null $expected The expected value.
   *
   * @dataProvider validManStringCases
   */
  public function testValidString(string $key, ?string $default, ?string $expected): void
  {
    $value = $this->typeConfig->getManString($key, $default);
    self::assertSame($value, $expected);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Data provider for valid mandatory arrays.
   *
   * @return array
   */
  public function validManArrayCases(): array
  {
    return [['valid-array', null, ['one' => '1', 'two' => '2', 'three' => '3']],
            ['null.array', [], []]];
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Data provider for valid mandatory booleans.
   *
   * @return array
   */
  public function validManBoolCases(): array
  {
    return [['valid.bool', null, true],
            ['null.bool', true, true]];
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Data provider for valid mandatory finite floats.
   *
   * @return array
   */
  public function validManFloatCases(): array
  {
    return [['valid.finite-float', null, 3.14],
            ['null.float-inclusive', 2.7, 2.7]];
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Data provider for valid mandatory floats including NaN, -INF, and INF.
   *
   * @return array
   */
  public function validManFloatInclusiveCases(): array
  {
    $cases = $this->validManFloatCases();

    $cases[] = ['valid.float-inclusive', null, INF];

    return $cases;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Data provider for valid mandatory integers.
   *
   * @return array
   */
  public function validManIntCases(): array
  {
    return [['valid.integer', null, 123],
            ['null.integer', 456, 456]];
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Data provider for valid mandatory string.
   *
   * @return array
   */
  public function validManStringCases(): array
  {
    return [['valid.string', null, 'Hello, world!'],
            ['null.string', 'default', 'default']];
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Data provider for valid optional arrays.
   *
   * @return array
   */
  public function validOptArrayCases(): array
  {
    $cases = $this->validManArrayCases();

    $cases[] = ['null.array', null, null];

    return $cases;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Data provider for valid optional booleans.
   *
   * @return array
   */
  public function validOptBoolCases(): array
  {
    $cases = $this->validManBoolCases();

    $cases[] = ['null.bool', null, null];

    return $cases;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Data provider for valid optional finite floats.
   *
   * @return array
   */
  public function validOptFloatCases(): array
  {
    $cases = $this->validManFloatCases();

    $cases[] = ['null.finite-float', null, null];

    return $cases;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Data provider for valid optional floats including NaN, -INF, and INF.
   *
   * @return array
   */
  public function validOptFloatInclusiveCases(): array
  {
    $cases = $this->validManFloatInclusiveCases();

    $cases[] = ['null.float-inclusive', null, null];

    return $cases;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Data provider for valid optional integers.
   *
   * @return array
   */
  public function validOptIntCases(): array
  {
    $cases = $this->validManIntCases();

    $cases[] = ['null.integer', null, null];

    return $cases;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Data provider for valid optional string.
   *
   * @return array
   */
  public function validOptStringCases(): array
  {
    $cases = $this->validManStringCases();

    $cases[] = ['null.string', null, null];

    return $cases;
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------
