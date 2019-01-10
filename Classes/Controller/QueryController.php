<?php

namespace Comsolit\ComsolitSuggest\Controller;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Andres Lobacovs <info@comsolit.com>, comsolit AG
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * QueryController
 */
class QueryController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * action suggest
     *
     * @return void
     */
    public function suggestAction()
    {

        if ($this->request->hasArgument('search')) {

            $search = $GLOBALS['TYPO3_DB']->quoteStr($this->request->getArgument('search'), 'index_words');

            $suggestions = [];
            $language = $GLOBALS['TSFE']->sys_language_uid;
            $field = 'SQL_NO_CACHE DISTINCT baseword';
            $from = 'index_words LEFT JOIN index_rel ON index_words.wid = index_rel.wid 
						LEFT JOIN index_phash ON index_rel.phash = index_phash.phash';
            $where = 'baseword LIKE ' . "'" . $search . '%' . "'" . ' AND index_phash.sys_language_uid =' . $language;
            $groub_by = '';
            $order_by = '';
            $limit = '10';
            $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($field, $from, $where, $groub_by, $order_by, $limit);
            while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
                $suggestions[] = $row;
            }

            return $this->buildJsonRepsonseFromQuery($suggestions);
        }
    }

    private function buildJsonRepsonseFromQuery($suggestions)
    {
        return json_encode($this->createValueMapFromStringArray($suggestions));
    }

    private function createValueMapFromStringArray($array)
    {
        $options = [];
        foreach ($array as $value) {
            if (!is_int($value)) {
                $options[]['value'] = $value['baseword'];
            }
        }
        return $options;
    }

}