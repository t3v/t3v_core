[T3v Core]
==========

**The [TYPO3voila] Core extension.**

Installation
------------

1. Add `t3v_core` to the [Composer] configuration (`composer.json`):

    ```json
    {
      "repositories": [
        { "type": "git", "url": "git@t3v[at]bitbucket.org:t3v/t3v_core.git" }
      ],

      "require": {
        "t3v/t3v_core": "~1.3.0"
      }
    }
    ```

2. Run `composer install` or `composer update` to install all dependencies with Composer

3. Include the TypoScript for `t3v_core` in the main TypoScript template

Bug Reports
-----------

Bitbucket Issues are used for managing bug reports and feature requests. If you run into issues, please search the issues
and submit new problems [here].

Versioning
----------

This library aims to adhere to [Semantic Versioning 2.0.0]. Violations of this scheme should be reported as bugs.
Specifically, if a minor or patch version is released that breaks backward compatibility, that version should be
immediately yanked and / or a new version should be immediately released that restores compatibility.

[Composer]: https://getcomposer.org "Dependency Manager for PHP"
[here]: https://bitbucket.org/t3v/t3v_core/issues "Bitbucket Issue Tracker"
[Semantic Versioning 2.0.0]: http://semver.org "Semantic Versioning 2.0.0"
[T3v Core]: https://bitbucket.org/t3v/t3v_core "The TYPO3voila Core extension."
[TYPO3voila]: https://bitbucket.org/t3v "“UH LÁLÁ, TYPO3!”"