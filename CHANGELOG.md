Changelog
=========

Notable changes will be documented in this file. The project adheres to [Semantic Versioning].

Unreleased
----------

* Implemented custom `findByUid` finder in `AbstractRepository`

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