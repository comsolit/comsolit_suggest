<?php

defined('TYPO3_MODE') || die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Comsolit.comsolit_suggest',
    'Suggest',
    [
        \Comsolit\ComsolitSuggest\Controller\QueryController::class => 'suggest',
    ]
);
