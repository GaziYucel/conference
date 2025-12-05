{**
 * @file plugins/generic/conference/templates/metadataForm.tpl
 *
 * Copyright (c) 2014-2025 Simon Fraser University
 * Copyright (c) 2003-2025 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @brief Metadata form
 *}

<div id="conferenceDate">
	{fbvFormSection title="plugins.generic.conference.metadata.conferenceDate.title"}
		{fbvElement type="text" id="conferenceDateBegin" value=$conferenceDateBegin required=false label="plugins.generic.conference.metadata.conferenceDateBegin" class="datepicker" size=$fbvStyles.size.SMALL inline=true }
		{fbvElement type="text" id="conferenceDateEnd" value=$conferenceDateEnd required=false label="plugins.generic.conference.metadata.conferenceDateEnd" class="datepicker" size=$fbvStyles.size.SMALL inline=true}
	{/fbvFormSection}
</div>

<div id="conferencePlace">
	{fbvFormSection title="plugins.generic.conference.metadata.conferencePlace.title"}
		{fbvElement type="text" id="conferencePlaceStreet" value=$conferencePlaceStreet required=false label="plugins.generic.conference.metadata.conferencePlaceStreet"  size=$fbvStyles.size.SMALL inline=true}
		{fbvElement type="text" id="conferencePlaceCity" value=$conferencePlaceCity required=false label="plugins.generic.conference.metadata.conferencePlaceCity"  size=$fbvStyles.size.SMALL inline=true}
		{fbvElement type="text" id="conferencePlaceCountry" value=$conferencePlaceCountry required=false label="plugins.generic.conference.metadata.conferencePlaceCountry"  size=$fbvStyles.size.SMALL inline=true}
	{/fbvFormSection}
</div>

<div id="conferenceOnlineStatus">
	{fbvFormSection for="conferenceOnlineStatus" size=$fbvStyles.size.MEDIUM list=true}
		{fbvElement type="checkbox" id="conferenceOnline" label="plugins.generic.conference.metadata.conferenceOnline.checkBox" checked=$conferenceOnline}
	{/fbvFormSection}
</div>
