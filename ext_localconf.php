<?php
defined('TYPO3_MODE') or die();

// === Frontend ===

// Adds the `backend_layout` and `backend_layout_next_level` field to the root line.
if (empty($GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields'])) {
  $GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields'] .= 'backend_layout,backend_layout_next_level';
} else {
  $GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields'] .= ',backend_layout,backend_layout_next_level';
}
