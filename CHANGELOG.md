# Changelog

## [v0.2.0](https://github.com/runapi-ai/seedance-php/releases/tag/v0.2.0) - 2026-09-30

### Changed
- Send request parameters to the service without local validation. Model ids and parameter values the service supports work without an SDK upgrade; static types and enum constants remain for completion.
  Migration: Invalid parameters now throw `ValidationException` built from the service's 400 response, including its status and message, instead of a `ValidationException` thrown locally before the request.


## [v0.1.6](https://github.com/runapi-ai/seedance-php/releases/tag/v0.1.6) - 2026-08-12

### Added
- Add Seedance 2.5 request fields and model validation to the PHP package.


## [v0.1.5](https://github.com/runapi-ai/seedance-php/releases/tag/v0.1.5) - 2026-07-31

### Removed
- Remove seedance-v1-lite from the supported Seedance model list.
  Migration: Use seedance-v1-pro or another supported Seedance model.


## [v0.1.4](https://github.com/runapi-ai/seedance-php/releases/tag/v0.1.4) - 2026-07-29

### Removed
- Remove seedance-v1-lite from the supported Seedance model list.
  Migration: Use seedance-v1-pro or another supported Seedance model.


## [v0.1.3](https://github.com/runapi-ai/seedance-php/releases/tag/v0.1.3) - 2026-07-21

### Added
- Add optional `seed` support for Seedance 1.5 Pro and V1 Pro Fast requests with integer range validation.


## [v0.1.2](https://github.com/runapi-ai/seedance-php/releases/tag/v0.1.2) - 2026-07-08

### Changed
- Add Seedance 2.0 4K resolution support in the PHP package.

## [v0.1.1](https://github.com/runapi-ai/seedance-php/releases/tag/v0.1.1) - 2026-07-08

### Changed
- Release v0.1.1.

## [v0.1.0](https://github.com/runapi-ai/seedance-php/releases/tag/v0.1.0) - 2026-06-25

### Added
- Publish the first RunAPI PHP Composer package release for `runapi-ai/seedance`.
- Include typed PHP client resources, package README, Apache-2.0 license, and Composer CI.
