<?php

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2012 Leo Feyer
 * 
 * @package TimelineJS
 * @link    http://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'Timeline',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'Timeline\AbstractDataProvider' => 'system/modules/timelineJS/AbstractDataProvider.php',
	// Providers
	'Timeline\DatapointProvider'   => 'system/modules/timelineJS/providers/DatapointProvider.php',
	'Timeline\NewsArchiveProvider' => 'system/modules/timelineJS/providers/NewsArchiveProvider.php',
	'Timeline\TwitterProvider'     => 'system/modules/timelineJS/providers/TwitterProvider.php',
	'Timeline\TimelineAjax'        => 'system/modules/timelineJS/TimelineAjax.php',
	'Timeline\TimelineModule'      => 'system/modules/timelineJS/TimelineModule.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_timeline' => 'system/modules/timelineJS/templates',
));
