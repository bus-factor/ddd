# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

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

