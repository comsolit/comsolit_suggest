.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

EXT: comsolit_suggest
==================

:Classification:
		comsolit_suggest

:Language:
		en

:Copyright:
		comsolit AG, info@comsolit.com

:License:
		This document is published under the Open Content License
		available from http://www.opencontent.org/opl.shtml


The content of this document is related to TYPO3 - a GNU/GPL CMS/Framework available from www.typo3.org

Search Word Suggestion / Autocompletion
=================

This Plugin extends the TYPO3 searchform with an autocomplete and suggest feature of words 
indexed from Ext:indexed_search based on a ajax request and typeahead lib, simple add
just *class="typeahead"* to your searchbox input field

Features
--------
* autocomplete and suggest with single words of the search index database table
* the extension includes a searchbox for easy integration in your page
* simple adding autocomplete/suggest to an input field with class="typeahead"
* jQuery on/off mode
* Styling autocomplete/suggest pulldown via CSS and HTML template file 
* add autocomplete/suggest to the standard indexed_search form template
* configuration of minLenght and Limitation of suggested words

Integration Example 1
---------------------
* just add class="typeahead" to your searchbox
For example: The Template from "indexed_search" need the class on the input "sword"

.. code-block:: html

	<input type="text" name="tx_indexedsearch[sword]" value="###SWORD_VALUE###" 
class="typeahead" id="tx-indexedsearch-searchbox-sword" />


Integration Example 2
---------------------
* Use a TypoScript Object for example "lib.searchbox" in your template

.. code-block:: html

	<f:cObject typoscriptObjectPath="lib.searchbox" />


* assign the plugin to this object: lib.searchbox < plugin.tx_comsolit_suggest
The Template form the extension is used

Change Styling for your Page
----------------------------
* make a copy of the searchbox Template 
"comsolit_suggest/Resources/Private/Templates/Suggest.html" in your theme files
* make a of "comsolit_suggest/Resources/Public/Css/suggest.css" to your theme files 
* configure that TYPO3 uses your copies

.. code-block:: typoscript

	plugin.tx_comsolitsuggest.view {
		templateRootPaths >
	    templateRootPaths {
		0 = EXT:comsolit_suggest/Resources/Private/Templates/
			1 = fileadmin/theme/comsolit_suggest/Templates/
		}
	}

.. code-block:: typoscript

	page.includeCSS.suggest = fileadmin/theme/comsolit_suggest/suggest.css
	
	

* change HTML in "Suggest.html"*
* change CSS in "suggest.css"*