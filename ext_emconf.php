<?php

$EM_CONF[$_EXTKEY] = array(
	'title' => 'comsolit Suggest',
	'description' => 'This Plugin extends the TYPO3 searchform with an autocomplete and suggest feature of words indexed from Ext:indexed_search based on a ajax request and typeahead lib, simple add
just class="typeahead" to your searchbox input field',
	'category' => 'plugin',
	'author' => 'Andres Lobacovs, comsolit AG',
	'author_email' => 'info@comsolit.com',
	'author_company' => 'comsolit AG',
	'state' => 'stable',
	'internal' => '',
	'uploadfolder' => '0',
	'createDirs' => '',
	'clearCacheOnLoad' => 0,
	'version' => '3.0.0',
	'constraints' => array(
		'depends' => array(
			'typo3' => '9.5.0-9.5.99',
			'indexed_search' => '9.5.0-9.5.99',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
);
