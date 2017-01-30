<?php
defined('TYPO3_MODE') or die('Access denied.');

call_user_func(function ($extkey) {
  // === TypoScript ===

  \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'T3v Core');
}, $_EXTKEY);