
.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

Integration
===========

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