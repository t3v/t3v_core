<?php
$EM_CONF[$_EXTKEY] = [
  'title' => 'T3v Core',
  'description' => 'The TYPO3voila Core extension.',
  'author' => 'Maik Kempe',
  'author_email' => 'mkempe@bitaculous.com',
  'author_company' => 'Bitaculous - It\'s all about the bits, baby!',
  'category' => 'be',
  'state' => 'stable',
  'version' => '1.7.0',
  'shy' => false,
  'createDirs' => '',
  'uploadfolder' => false,
  'modify_tables' => '',
  'clearCacheOnLoad' => true,
  'constraints' => [
    'depends' => [
      'typo3' => '7.6.0-8.1.99'
    ],
    'conflicts' => [],
    'suggests' => []
  ]
];