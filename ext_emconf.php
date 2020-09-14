<?php
/** @var string $_EXTKEY */

$EM_CONF[$_EXTKEY] = [
    'title' => 'T3v Core',
    'description' => 'The core extension of TYPO3Voila.',
    'author' => 'Maik Kempe',
    'author_email' => 'mkempe@bitaculous.com',
    'author_company' => 'Bitaculous - It\'s all about the bits, baby!',
    'category' => 'be',
    'state' => 'alpha',
    'version' => '9.0.0',
    'createDirs' => '',
    'uploadfolder' => false,
    'clearCacheOnLoad' => false,
    'constraints' => [
        'depends' => [
            'typo3' => '9.5.0-10.4.99'
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
