<?php
defined('TYPO3_MODE') or die('Access denied.');

// === TCA Configuration ===

// Add `backend_layout` and `backend_layout_next_level` field to the root line.
$GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields'] .= ',backend_layout,backend_layout_next_level';