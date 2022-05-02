# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [v5.5.0] 2022-05-02
### Added
- PHP 7.3 support

## [v5.4.0] 2022-05-02
### Removed
- PHP 7.3 support
### Fixed
- Updates composer.json restrictions to enable PHP 8.1 support

## [v5.3.0] 2021-10-31
### Added
- Adds protected ```Collection::isValidOffsetFormat()``` method to support constraints regarding array key formats
### Fixed
- Removes ```Enum::parse()``` return type and changes PHPDoc-only return typing to ```static``` for improved type inference

## [v5.2.0] 2021-03-13
### Modified
- Updates PHP version requirements in ```composer.json```

## [v5.1.0] 2020-12-27
### Added
- Adds ```JsonPointer``` value object
- Adds ```SingleValueObjectInterface::getArrayValue()``` method

## [v5.0.0] 2020-12-27
### Modified
- Root namespace is now "BusFactor\Ddd" (was "Ddd")

## [v4.0.0] 2020-12-27
### Added
- Unit tests
### Modified
- Root namespace is now "Ddd" (was "D3")
### Fixed
- Documentation issue
- Collection exception message
- SingleValueObject::getFloatValue return type

## [v3.0.1] 2020-11-24
### Fixed
- Broken CI tests

## [v3.0.0] 2020-11-21
### Added
- Refactors namespaces
- Adds collection classes
- Renames ValueObject to SingleValueObject
- Adds type specific value getters to SingleValueObject
- Removes Entity/Aggregate/Event related code
### Fixed
- Makes Enum constructor protected

## [v2.0.0] 2019-11-30
### Added
- Moves UUID generation to UUID class

## [v1.0.0] 2019-11-24
### Added
- Repository support for custom UUID classes

## [v0.5.0] 2019-11-23
### Added
- Aggregate classes

## [v0.4.0] 2019-11-23
### Added
- ```Event::jsonSerialize```

## [v0.3.0] 2019-09-17
### Added
- ```Event```

## [v0.2.0] 2019-09-15
### Added
- Value objects (```EmailAddress```, ```IpAddress```, ```IpV4Address```, ```IpV6Address```, ```MacAddress```, ```Uuid```)
- ```ValueObject```, ```ValueObjectInterface```
- ```Entity```, ```EntityInterface```, 
- ```Repository```, ```RepositoryInterface```

## [v0.1.0] 2019-09-14
### Added
- Enumeration class
