<?php
defined('TYPO3_MODE') or die();

// === Variables ===

$extensionKey = 't3v_core';

// === TypoScript ===

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($extensionKey, 'Configuration/TypoScript', 'T3v Core');