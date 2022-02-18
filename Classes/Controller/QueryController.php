<?php

namespace Comsolit\ComsolitSuggest\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

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
class QueryController extends ActionController
{

    /**
     * @return false|string
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
     */
    public function suggestAction()
    {
        if ($this->request->hasArgument('search')) {
            $search = $this->request->getArgument('search');

            $language = GeneralUtility::makeInstance(Context::class)->getAspect('language')->getId();

            $q = $this->getDatabaseConnection()->createQueryBuilder();

            $q->selectLiteral('SQL_NO_CACHE DISTINCT baseword')
                ->from('index_words', 'w')
                ->leftJoin('w', 'index_rel', 'r', 'w.wid = r.wid')
                ->leftJoin('r', 'index_phash', 'p', 'r.phash = p.phash')
                ->where(
                    $q->expr()->andX(
                        $q->expr()->like('w.baseword', $q->createNamedParameter("%" . $q->escapeLikeWildcards($search) . "%", \PDO::PARAM_STR)),
                        $q->expr()->eq('p.sys_language_uid', $q->createNamedParameter($language, \PDO::PARAM_INT))
                    )
                )
                ->setMaxResults(10);

            $suggestions = $q->execute()->fetchAll();

            return $this->buildJsonResponseFromQuery($suggestions);
        }
    }

    /**
     * @return \TYPO3\CMS\Core\Database\Connection
     */
    protected function getDatabaseConnection()
    {
        return GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('index_words');
    }

    /**
     * @param $suggestions
     * @return false|string
     */
    private function buildJsonResponseFromQuery($suggestions)
    {
        return json_encode($this->createValueMapFromStringArray($suggestions));
    }

    /**
     * @param $array
     * @return array
     */
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