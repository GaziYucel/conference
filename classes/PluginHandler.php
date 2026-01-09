<?php

/**
 * @file plugins/generic/conference/classes/PluginHandler.php
 *
 * Copyright (c) 2003-2025 Simon Fraser University
 * Copyright (c) 2003-2025 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file LICENSE.
 *
 * @class PluginHandler
 *
 * @ingroup plugins_generic_conference
 *
 * @brief Handles request for Conference plugin.
 */

namespace APP\plugins\generic\conference\classes;

use APP\handler\Handler;
use APP\plugins\generic\conference\ConferencePlugin;
use PKP\security\Role;

class PluginHandler extends Handler
{
    public ConferencePlugin $plugin;

    function __construct(ConferencePlugin $plugin)
    {
        parent::__construct();
        $this->plugin = $plugin;
    }

    public function addRoles(): void
    {
        $this->addRoleAssignment(
            [
                Role::ROLE_ID_MANAGER,
                Role::ROLE_ID_SUB_EDITOR,
                Role::ROLE_ID_ASSISTANT,
                Role::ROLE_ID_AUTHOR
            ],
            []
        );
    }
}
