<?php


/**
 * Back end modules
 */
$GLOBALS['BE_MOD']['content']['timelines'] = array
(
	'tables'	=> array('tl_timeline','tl_timeline_datasource'),
	'icon'		=> 'system/modules/timelineJS/assets/timeline.png',
);


/*
 * FE-Modules
 */
$GLOBALS['FE_MOD']['Timelines']['timeline'] = 'TimelineModule';


/**
 * Hooks
 */
$GLOBALS['TL_HOOKS']['simpleAjax'][] = array('TimelineAjax','getJSON');


/**
 * Hinzufügen der Data-Provider
 */
//$GLOBALS['TL_TIMELINE_DATAPROVIDER']['twitter'] = 'TwitterProvider';
$GLOBALS['TL_TIMELINE_DATAPROVIDER']['newsArchive'] = 'NewsArchiveProvider';
$GLOBALS['TL_TIMELINE_DATAPROVIDER']['datapoint'] = 'DatapointProvider';