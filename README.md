[T3v Core]
==========

**The [TYPO3voila] Core extension.**

Installation
------------

1. Add `t3v_core` to the [Composer] configuration (`composer.json`):

    ```json
    {
      "repositories": [
        { "type": "vcs", "url": "https://github.com/t3v/t3v_core" }
      ],

      "require": {
        "t3v/t3v_core": "~1.5.1"
      }
    }
    ```

2. Run `composer install` or `composer update` to install all dependencies with Composer

3. Include the TypoScript for `t3v_core` in the main TypoScript template

Bug Reports
-----------

GitHub Issues are used for managing bug reports and feature requests. If you run into issues, please search the issues
and submit new problems [here].

Versioning
----------

This library aims to adhere to [Semantic Versioning 2.0.0]. Violations of this scheme should be reported as bugs.
Specifically, if a minor or patch version is released that breaks backward compatibility, that version should be
immediately yanked and / or a new version should be immediately released that restores compatibility.

License
-------

T3v Core is released under the [MIT License (MIT)], see [LICENSE].

[Composer]: https://getcomposer.org "Dependency Manager for PHP"
[here]: https://github.com/t3v/t3v_core/issues "GitHub Issue Tracker"
[LICENSE]: https://raw.githubusercontent.com/t3v/t3v_core/master/LICENSE "License"
[MIT License (MIT)]: http://opensource.org/licenses/MIT "The MIT License (MIT)"
[Semantic Versioning 2.0.0]: http://semver.org "Semantic Versioning 2.0.0"
[T3v Core]: https://github.com/t3v/t3v_core "The TYPO3voila Core extension."
[TYPO3voila]: https://github.com/t3v "“UH LÁLÁ, TYPO3!”"