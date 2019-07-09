CHANGELOG
=========

Notable changes will be documented in this file. The project adheres to [Semantic Versioning].

8.4.3
-----

* Updated dependencies
* Updated Travis CI configuration
* Cleaned up

8.4.2
-----

* Updated Travis CI configuration and dependencies

8.4.1
-----

* Updated Travis CI configuration and dependencies
* Cleaned up

8.4.0
-----

* Updated Composer configuration
* Updated Travis CI and AppVeyor configuration
* Updated dependencies
* Cleaned up

8.3.0
-----

* Updated Travis CI and AppVeyor configuration
* Updated dependencies
* Cleaned up

8.2.0
-----

* Improved `StringUtility`
* Added `Danielstjules/Stringy` as dependency
* Updated translations

8.1.0
-----

* Added additional translations
* Added `LanguageUidTrait`

8.0.0
-----

* Updated translations (breaking change)
* Updated dependencies
* Updated Travis CI and AppVeyor configuration
* Cleaned up

7.3.0
-----

* Improved `MailService`

7.2.0
-----

* Improved `PageService`
* Updated AppVeyor configuration
* Cleaned up

7.1.2
-----

* Updated dependencies
* Cleaned up

7.1.1
-----

* Fixed `DefaultViewHelper`
* Fixed `QueryResultService`

7.1.0
-----

* Improved `Utility` classes
* Improved tests
* Bugfixing
* Updated AppVeyor configuration

7.0.3
-----

* Bugfixing

7.0.2
-----

* Bugfixing

7.0.1
-----

* Cleaned up

7.0.0
-----

* Improved `FileService` (breaking change)
* Refactoring and Type Hinting and improved tests
* Cleaned up

6.3.1
-----

* Updated TypoScript (Tests)
* Fixed `LocalizationTrait`

6.3.0
-----

* Added `FileReferenceTrait`
* Improved `LocalizationTrait`
* Improved `AbstractEntity`
* Updated TypoScript structure

6.2.1
-----

* Updated AppVeyor configuration
* Cleaned up

6.2.0
-----

* Improved `LocalizationTrait`
* Added `GeneralUtility`
* Improved `StringUtility`
* Improved `AbstractCommandController`
* Updated tests
* Cleaned up

6.1.0
-----

* Added `IconUtility`
* Extended `ExtensionUtility`

6.0.0
-----

* Added `ExtensionUtility`
* Updated `StringUtility` and `UrlUtility`
* TCA Migrations
* Cleaned up
* Updated Tests
* Updated Travis CI and AppVeyor configuration
* Updated dependencies
* Dropped support for TYPO3 7.x

5.2.0
-----

* Updated translations (breaking change)
* Updated Travis CI and AppVeyor configuration
* Updated dependencies

5.1.0
-----

* Improved `FileService`
* Added TCEFORM translations
* Updated Composer configuration and scripts
* Updated Travis CI and AppVeyor configuration
* Updated dependencies

5.0.0
-----

* Added translations for tabs
* Renamed `LocalisationTrait` to `LocalisationTrait` (breaking change)

4.1.0
-----

* Added `LocalisationTrait`

4.0.0
-----

* Removed `FlashMessageService` (breaking change)
* Improved `MailService`, added `replyTo` parameter (breaking change)
* Improved `RendererUtility`
* Updated TypoScript
* Fixed functional tests
* Updated AppVeyor configuration

3.0.0
-----

* Added `SlugViewHelper`
* Added `Cocur/Slugify` as dependency
* Refactored TypoScript
* Updated constants and configuration
* Updated AppVeyor configuration
* Updated dependencies
* Dropped support for PHP 5.x

2.6.0
-----

* Fixed imports
* Improved compatibility for TYPO3 8.7 (`RendererUtility)`
* Updated Travis CI and AppVeyor configuration

2.5.0
-----

* Updated `AbstractRepository`
* Improved compatibility for TYPO3 8.7
* Improved code
* Updated database fixtures
* Updated AppVeyor configuration

2.4.0
-----

* Cleaned up `LanguageService`
* Formatted code and cleanup
* Updated Composer configuration
* Updated AppVeyor configuration

2.3.1
-----

* Improved `FileService`
* Reformatted code and cleanup

2.3.0
-----

* Improved `FileService`
* Updated dependencies
* Updated Travis CI and AppVeyor configuration
* Cleaned up

2.2.0
-----

* Cleaned up `AbstractConditionViewHelper`
* Improved `MailService`
* Improved Utility classes

2.1.0
-----

* Updated extension icon
* Defined namespace in `ext_localconf` and `ext_tables`
* Added `AbstractConditionViewHelper`
* Updated code comments
* Cleaned up

2.0.3
-----

* Fixed `AbstractValidator`
* Improved `LanguageService`
* Updated scripts
* Cleaned up

2.0.2
-----

* Minor changes
* Cleaned up

2.0.1
-----

* Improved Travis CI / AppVeyor configuration

2.0.0
-----

* Improved `AbstractRepository`
* Improved `FileService`
* Compatibility for TYPO3 8.7
* Added configuration for AppVeyor
* Use `nimut/testing-framework` as testing framework
* Cleaned up

1.9.1
-----

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
* Added `Kevinlebrun/Colors` as Composer dependency
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

* Inject `LanguageService` by default into `AbstractRepository`
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

* First release
* Added `BodyTagHelper` and `PageService`
* Added `AbstractService` and `FlashMessageService`
* Added `AbstractController`
* Added common files

[Semantic Versioning]: http://semver.org "Semantic Versioning"
