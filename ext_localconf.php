<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Comsolit.' . $_EXTKEY,
	'Suggest',
	array(
		'Query' => 'suggest',
		
	),
	// non-cacheable actions
	array(
		'Query' => '',
		
	)
);
