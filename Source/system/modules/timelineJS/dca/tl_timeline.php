<?php

/**
 * Table tl_timeline
 */
$GLOBALS['TL_DCA']['tl_timeline'] = array
(
	// Config
	'config' => array
	(
		'dataContainer'				=> 'Table',
		'ctable'					=> array('tl_timeline_datasource'),
		'switchToEdit'				=> true,
		'enableVersioning'			=> true,
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary',
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'					=> 1,
			'fields'				=> array('title'),
			'flag'					=> 1,
			'panelLayout'			=> 'filter;search,limit',
		),
		'label' => array
		(
			'fields'				=> array('title'),
			'format'				=> '<strong>%s</strong>'
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'				=> &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'				=> 'act=select',
				'class'				=> 'header_edit_all',
				'attributes'		=> 'onclick="Backend.getScrollOffset()" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'				=> &$GLOBALS['TL_LANG']['tl_timeline']['edit'],
				'href'				=> 'table=tl_timeline_datasource',
				'icon'				=> 'edit.gif',
				'attributes'		=> 'class="contextmenu"'
			),
			'editheader' => array
			(
				'label'				=> &$GLOBALS['TL_LANG']['tl_timeline']['editheader'],
				'href'				=> 'act=edit',
				'icon'				=> 'header.gif',
				'attributes'		=> 'class="edit-header"'
			),
			'copy' => array
			(
				'label'				=> &$GLOBALS['TL_LANG']['tl_timeline']['copy'],
				'href'				=> 'act=copy',
				'icon'				=> 'copy.gif',
			),
			'delete' => array
			(
				'label'				=> &$GLOBALS['TL_LANG']['tl_timeline']['delete'],
				'href'				=> 'act=delete',
				'icon'				=> 'delete.gif',
				'attributes'		=> 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
			),
			'show' => array
			(
				'label'				=> &$GLOBALS['TL_LANG']['tl_timeline']['show'],
				'href'				=> 'act=show',
				'icon'				=> 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'				=> array('protected','addImage','overwriteIcon'),
		'default'					=> '
			{title_legend},title,language;
			{slide1_legend},headline,text;
			{image_legend},addImage;
			{icon_legend},overwriteIcon;
			{protected_legend:hide},protected;'
	),

	// Subpalettes
	'subpalettes' => array
	(
		'protected'					=> 'groups',
		'addImage'					=> 'singleSRC,credit,caption',
		'overwriteIcon'				=> 'iconSRC',
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'					=> "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array
		(
			'sql'					=> "int(10) unsigned NOT NULL default '0'"
		),
		'title' => array
		(
			'label'					=> &$GLOBALS['TL_LANG']['tl_timeline']['title'],
			'search'				=> true,
			'inputType'				=> 'text',
			'eval'					=> array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'					=> "varchar(255) NOT NULL default ''"
		),
		'headline' => array
		(
			'label'					=> &$GLOBALS['TL_LANG']['tl_timeline']['headline'],
			'search'				=> true,
			'inputType'				=> 'text',
			'eval'					=> array('mandatory'=>true, 'maxlength'=>255,'decodeEntities'=>true, 'tl_class'=>'w50'),
			'sql'					=> "varchar(255) NOT NULL default ''"
		),
		'language' => array
		(
			'label'					=> &$GLOBALS['TL_LANG']['tl_timeline']['language']['field'],
			'filter'				=> true,
			'search'				=> true,
			'inputType'				=> 'select',
			'options'				=> System::getLanguages(),
			'eval'					=> array('mandatory'=>true, 'maxlength'=>255, 'decodeEntities'=>true, 'tl_class'=>'w50', 'chosen'=>true),
			'sql'					=> "varchar(255) NOT NULL default ''"
		),
		'text' => array
		(
			'label'					=> &$GLOBALS['TL_LANG']['tl_timeline']['text'],
			'search'				=> true,
			'inputType'				=> 'textarea',
			'eval'					=> array('mandatory'=>true, 'rte'=>'tinyMCE', 'helpwizard'=>true, 'decodeEntities'=>true, 'tl_class'=>'clr'),
			'explanation'			=> 'insertTags',
			'sql'					=> "mediumtext NULL"
		),
		'addImage' => array
		(
			'label'					=> &$GLOBALS['TL_LANG']['tl_timeline']['addImage'],
			'inputType'				=> 'checkbox',
			'eval'					=> array('submitOnChange'=>true),
			'sql'					=> "char(1) NOT NULL default ''"
		),
		'singleSRC' => array
		(
			'label'					=> &$GLOBALS['TL_LANG']['tl_timeline']['singleSRC'],
			'inputType'				=> 'fileTree',
			'eval'					=> array('fieldType'=>'radio', 'mandatory'=>true, 'files'=>true, 'tl_class'=>'clr'),
			'sql'					=> "varchar(255) NOT NULL default ''"
		),
		'credit' => array
		(
			'label'					=> &$GLOBALS['TL_LANG']['tl_timeline']['credit'],
			'search'				=> true,
			'inputType'				=> 'text',
			'eval'					=> array('maxlength'=>255, 'tl_class'=>'w50', 'decodeEntities'=> true),
			'sql'					=> "varchar(255) NOT NULL default ''"
		),
		'caption' => array
		(
			'label'					=> &$GLOBALS['TL_LANG']['tl_timeline']['caption'],
			'search'				=> true,
			'inputType'				=> 'text',
			'eval'					=> array('maxlength'=>255, 'tl_class'=>'w50', 'decodeEntities'=>true),
			'sql'					=> "varchar(255) NOT NULL default ''"
		),
		'overwriteIcon' => array
		(
			'label'					=> &$GLOBALS['TL_LANG']['tl_timeline']['overwriteIcon'],
			'inputType'				=> 'checkbox',
			'eval'					=> array('submitOnChange'=>true),
			'sql'					=> "char(1) NOT NULL default ''"
		),
		'iconSRC' => array
		(
			'label'					=> &$GLOBALS['TL_LANG']['tl_timeline']['iconSRC'],
			'inputType'				=> 'fileTree',
			'eval'					=> array('fieldType'=>'radio', 'mandatory'=>true, 'files'=>true, 'tl_class'=>'clr'),
			'sql'					=> "varchar(255) NOT NULL default ''"
		),
	),
);

?>