
.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

Styling
=======

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

