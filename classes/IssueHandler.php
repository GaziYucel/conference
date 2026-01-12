<?php

/**
 * @file plugins/generic/conference/classes/IssueHandler.php
 *
 * Copyright (c) 2003-2025 Simon Fraser University
 * Copyright (c) 2003-2025 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file LICENSE.
 *
 * @class IssueHandler
 *
 * @ingroup plugins_generic_conference
 *
 * @brief Issue object handler.
 */

namespace APP\plugins\generic\conference\classes;

use APP\plugins\generic\conference\ConferencePlugin;

class IssueHandler
{
    public ConferencePlugin $plugin;

    public function __construct(ConferencePlugin $plugin)
    {
        $this->plugin = $plugin;
    }

    /**
     * Handle additional fields.
     */
    public function handleAdditionalFieldNames($hookName, $params): bool
    {
        $fields =& $params[1];
        foreach (PluginSchema::issueFields as $field) {
            $fields[] = $field;
        }
        return false;
    }

    /**
     * Insert metadataEditForm.
     */
    public function metadataFieldEdit($hookName, $params): bool
    {
        $smarty =& $params[1];
        $output =& $params[2];

        $issue = $smarty->getTemplateVars('issue');
        if ($issue) {
            foreach (PluginSchema::issueFields as $field) {
                $smarty->assign($field, $issue->getData($field));
            }
        }
        $output .= $smarty->fetch($this->plugin->getTemplateResource('metadataForm.tpl'));
        return false;
    }

    /**
     * Save fields to the database.
     */
    public function formExecute($hookName, $params): bool
    {
        $issue =& $params[0]->issue;
        if ($issue) {
            $requestVars = $this->plugin->getRequest()->getUserVars();
            foreach (PluginSchema::issueFields as $field) {
                if (array_key_exists($field, $requestVars)) {
                    $issue->setData($field, $requestVars[$field]);
                } else {
                    $issue->setData($field, '');
                }
            }
        }
        return false;
    }
}
