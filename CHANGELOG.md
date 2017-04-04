Changelog
=========

Notable changes will be documented in this file. The project adheres to [Semantic Versioning].

Unreleased
----------

* Updated Composer dependencies
* Updated scripts

1.9.0
-----

* Improved `FileService` and `StringUtility`
* Improved `AbstractRepository`
  * `findByPid` returns now a query result instead of only the first object
* Improved `ArrayViewHelper`
* Added `crdate` property to `AbstractEntity`
* Use `call_user_func` in `ext_localconf.php` and `ext_tables.php`
* Configured Travis CI
* Added unit and functional tests
* Updated Composer configuration / dependencies
* Updated comments
* Updated claim
* Cleaned up

1.8.0
-----

* Set `LayoutRootPath` and `PartialRootPath` in `RendererUtility`
* Colorized logging in `AbstractCommandController`
* Added `kevinlebrun/colors.php` as Composer dependency
* Added `AbstractCommandController`
* Updated Composer dependencies

1.7.3
-----

* Improved `PageService` and `PageViewHelper`
* Cleaned up

1.7.2
-----

* Added `PageViewHelper`
* Updated `PageService` and `LanguageUidViewHelper`
* Updated Composer configuration
* Updated `ext_emconf.php`
* Cleaned up

1.7.1
-----

* Added `filterByLanguagePresets` (`QueryResultService`)
* Improved `filterBySysLanguage` (`QueryResultService`)

1.7.0
-----

* Added `AbstractEntity`
* Added `QueryResultService`

1.6.0
-----

* Released under the MIT License
* Switched to GitHub
* Minor changes / cleanup

1.5.1
-----

* Improved `FileService`
  * Lowercase and normalize file name when saving a file
* Improved `ArrayViewHelper`
* Improved `AbstractRepository`

1.5.0
-----

* Renamed `getRawAttribute` to `getRawModelByUid`
* Added `getRawAttribute` function to `AbstractRepository`
* Improved constraints in `AbstractRepository`
* Added `UrlUtility`

1.4.0
-----

* Improved `MailService`
* Implemented `StringUtility`
* Implemented `findByUid` method in `AbstractRepository`
* Minor changes

1.3.0
-----

* Inject `LanguageService` into `AbstractRepository`
* Improved `LanguageService`
* Added `ArrayViewHelper`
* Added `LocalizationUtility` (Draft)
* Added `LanguageUidViewHelper`
* Moved `LanguageViewHelper` under `Page` namespace

1.2.1
-----

* Improved `FileService` and `MailService`
* Minor changes

1.2.0
-----

* Added `RendererUtility`
* Added `MailService`
* Added `FileService`
* Added `DefaultViewHelper` and `LanguageViewHelper`
* Added `findByPids` function to `AbstractRepository`
* Improved `AbstractRepository`
* Added `getSubpages` and `getSubpagesUids` function to `PageService`
* Improved `PageService`
* Added `AbstractTagBasedViewHelper`
* Added `AbstractViewHelper`
* Cleaned up

1.1.0
-----

* Added `AbstractRepository`
* Clean up code and structure

1.0.0
-----

* Added `BodyTagHelper` and `PageService`
* Added `AbstractService` and `FlashMessageService`
* Added `AbstractController`
* First implementation
* Added common files

[Semantic Versioning]: http://semver.org "Semantic Versioning"