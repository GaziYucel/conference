<?php

/**
 * @file plugins/generic/conference/classes/PluginSchema.php
 *
 * Copyright (c) 2017-2025 Simon Fraser University
 * Copyright (c) 2017-2025 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class PluginSchema
 *
 * @ingroup plugins_generic_conference
 *
 * @brief Plugin schema
 */

namespace APP\plugins\generic\conference\classes;

class PluginSchema
{
    /** @var string[] additional fields issue */
    public const issueFields = [
        'conferenceDateBegin',
        'conferenceDateEnd',
        'conferencePlaceStreet',
        'conferencePlaceCity',
        'conferencePlaceCountry',
        'conferenceOnline'
    ];

    public function addToIssueSchema(string $hookName, array $args): bool
    {
        $schema = &$args[0];

        foreach (PluginSchema::issueFields as $field) {
            $schema->properties->$field = (object)[
                'type' => 'string',
                'apiSummary' => true,
                'validation' => ['nullable']
            ];
        }

        return false;
    }
}
