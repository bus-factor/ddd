# DDD

Domain-Driven Design related Classes and Utilities.

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/fadd1213ef8e402cb963d8be8f45dcda)](https://app.codacy.com/app/bus-factor/ddd?utm_source=github.com&utm_medium=referral&utm_content=bus-factor/ddd&utm_campaign=Badge_Grade_Dashboard)
[![Latest Stable Version](https://img.shields.io/packagist/v/bus-factor/ddd.svg?style=flat-square)](https://packagist.org/packages/bus-factor/ddd)
[![Total Downloads](https://poser.pugx.org/bus-factor/ddd/downloads.png)](https://packagist.org/packages/bus-factor/ddd)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.2-8892BF.svg?style=flat-square)](https://php.net/)
[![Build Status](https://travis-ci.com/bus-factor/ddd.svg?token=6CVThNyY94qpVvuMgX3F&branch=master)](https://travis-ci.com/bus-factor/ddd.svg?token=6CVThNyY94qpVvuMgX3F&branch=master)
[![Coverage Status](https://coveralls.io/repos/github/bus-factor/ddd/badge.svg?branch=master)](https://coveralls.io/github/bus-factor/ddd?branch=master)

## Model

### Value Objects

The following value object classes are available:

* ```EmailAddress```
* ```Enum```
* ```IpAddress```
* ```IpV4Address```
* ```IpV6Address```
* ```MacAddress```
* ```SingleValueObject``` (Single-value object base class)
* ```Url```

## Sample usage

```php
/**
 * @method static Currency EUR()
 * @method static Currency USD()
 */
class Currency extends \D3\ValueObject\Enum {
    public const EUR = 'EUR';
    public const USD = 'USD';
}

class Decimal implements \D3\ComparableInterface {
    use \D3\ComparableTrait;

    // ...
    public function compareTo(\D3\ComparableInterface $subject) : int {
    } 
    // ...
}

class Money implements \D3\ComparableInterface {
    use \D3\ComparableTrait;

    /** @var Decimal $amount*/
    private $amount;
    /** @var Currency $currency */
    private $currency;

    /**
     * @param Decimal $amount
     * @param Currency $currency
     */
    public function __construct(Decimal $amount, Currency $currency) {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * @param \D3\ComparableInterface $subject
     * @return int
     */
    public function compareTo(\D3\ComparableInterface $subject) : int {
        $comparable = $subject instanceof static::class
            && $this->currency === $subject->currency;

        if (!$comparable) {
            throw new LogicException('Incompatible currencies');
        }

        return $this->amount->compareTo($subject->amount);
    }
}

$money = new Money(new Decimal(/* ... */), Currency::EUR());
$otherMoney = new Money(new Decimal(/* ... */), Currency::EUR());
```
