<?php
defined('TYPO3_MODE') or die();

// === Variables ===

$namespace          = 't3v';
$extensionKey       = $_EXTKEY;
$extensionSignature = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($namespace . '.' . $extensionKey);

// === Front-end Configuration ===

// Add `backend_layout` and `backend_layout_next_level` field to the root line.
$GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields'] .= ',backend_layout,backend_layout_next_level';