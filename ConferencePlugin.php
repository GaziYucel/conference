<?php

/**
 * @file plugins/generic/conference/ConferencePlugin.php
 *
 * Copyright (c) 2017-2025 Simon Fraser University
 * Copyright (c) 2017-2025 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class ConferencePlugin
 *
 * @ingroup plugins_generic_conference
 *
 * @brief Conference plugin class.
 */

namespace APP\plugins\generic\conference;

use APP\plugins\generic\conference\classes\IssueHandler;
use APP\plugins\generic\conference\classes\PluginHandler;
use APP\plugins\generic\conference\classes\PluginSchema;
use PKP\facades\Locale;
use PKP\plugins\GenericPlugin;
use PKP\plugins\Hook;

class ConferencePlugin extends GenericPlugin
{
    public function register($category, $path, $mainContextId = null): bool
    {
        if (parent::register($category, $path, $mainContextId)) {
            if ($this->getEnabled($mainContextId)) {
                $issueHandler = new IssueHandler($this);
                Hook::add('Templates::Editor::Issues::IssueData::AdditionalMetadata', $issueHandler->metadataFieldEdit(...));
                Hook::add('issueform::execute', $issueHandler->formExecute(...));
                Hook::add('issuedao::getAdditionalFieldNames', $issueHandler->handleAdditionalFieldNames(...));

                $pluginHandler = new PluginHandler($this);
                Hook::add('LoadComponentHandler', $pluginHandler->addRoles(...));

                Hook::add('TemplateResource::getFilename', $this->_overridePluginTemplates(...));

                Locale::registerPath($this->getPluginPath() . '/customLocale/', PHP_INT_MAX);
            }

            $pluginSchema = new PluginSchema();
            Hook::add('Schema::get::issue', $pluginSchema->addToIssueSchema(...));

            return true;
        }
        return false;
    }

    /** @copydoc Plugin::getDisplayName */
    public function getDisplayName(): string
    {
        return __('plugins.generic.conference.displayName');
    }

    /** @copydoc Plugin::getDescription */
    public function getDescription(): string
    {
        return __('plugins.generic.conference.description');
    }
}

// For backwards compatibility -- expect this to be removed approx. OJS/OMP/OPS 3.6
if (!PKP_STRICT_MODE) {
    class_alias('\APP\plugins\generic\conference\ConferencePlugin', '\ConferencePlugin');
}
