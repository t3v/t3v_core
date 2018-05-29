<?php
$EM_CONF[$_EXTKEY] = [
  'title' => 'T3v Core',
  'description' => 'The core extension of TYPO3Voila.',
  'author' => 'Maik Kempe',
  'author_email' => 'mkempe@bitaculous.com',
  'author_company' => 'Bitaculous - It\'s all about the bits, baby!',
  'category' => 'be',
  'state' => 'stable',
  'version' => '7.0.0',
  'createDirs' => '',
  'uploadfolder' => false,
  'clearCacheOnLoad' => false,
  'constraints' => [
    'depends' => [
      'typo3' => '8.7.0-9.5.99'
    ],
    'conflicts' => [],
    'suggests' => []
  ],
  'autoload' => [
    'psr-4' => [
      'T3v\\T3vCore\\' => 'Classes'
    ]
  ],
  'autoload-dev' => [
    'psr-4' => [
      'T3v\\T3vCore\\Tests\\' => 'Tests'
    ]
  ]
];