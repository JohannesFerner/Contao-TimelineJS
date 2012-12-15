<?php

/**
 * Back end modules
 */
array_insert($GLOBALS['BE_MOD']['content'], 50, array
(
	'timelines' => array
	(
		'tables'     => array('tl_timeline','tl_timeline_datasource'),
		'icon'       => 'system/modules/timelineJS/assets/timeline.png',
	)
));

/*
 * FE-Modules
 */

$GLOBALS['FE_MOD']['Timelines'] = array (
    'timeline' => 'TimelineModule'
);

/**
 * Hinzufügen der Data-Provider
 */
$GLOBALS['TL_HOOKS']['simpleAjax'][] = array('TimelineAjax','getJSON');
//$GLOBALS['TL_TIMELINE_DATAPROVIDER']['twitter'] = 'TwitterProvider';
$GLOBALS['TL_TIMELINE_DATAPROVIDER']['newsArchive'] = 'NewsArchiveProvider';
$GLOBALS['TL_TIMELINE_DATAPROVIDER']['datapoint'] = 'DatapointProvider';