<?php
$this->loadDataContainer('tl_module');
/**
 * Table tl_timeline
 */
$GLOBALS['TL_DCA']['tl_timeline_datasource'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
                'ptable'                      => 'tl_timeline',
		'switchToEdit'                => true,
		'enableVersioning'            => true,
            	'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary',
				'pid' => 'index'
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 4,
			'flag'                    => 1,
                        'fields'                  => array('type DESC'),
			'panelLayout'             => 'filter;limit',
                        'headerFields'            => array('id','title','headline'),
                        'child_record_callback'   => array('tl_timeline_datasources', 'listDataSources'),
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_timeline_datasource']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif',
				'attributes'          => 'class="contextmenu"'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_timeline_datasource']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_timeline_datasource']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'      => array('type','overwriteIcon','dp_asset'),
		'default'           => '{type_legend},type,',
                'newsArchive'       => '[type_legend},type;{newsArchive_legend},newsArchive,onlyFeaturesNews,{icon_legend},overwriteIcon;',
                'twitter'           => '{type_legend},type;{twitter_legend},twitterUrl',
                'datapoint'         => '{type_legend},type;{datapoint_legend},dp_startDate,dp_endDate,dp_headline,dp_text,dp_asset,{icon_legend},overwriteIcon;'
	),

	// Subpalettes
	'subpalettes' => array
	(
                'overwriteIcon'     => 'iconSRC',
                'dp_asset'          => 'dp_media,dp_caption,dp_credit'
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
                'pid' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'type' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timeline_datasource']['type'],
			'filter'                  => true,
                        'default'                 => 'newsArchive',
			'inputType'               => 'select',
                        'options_callback'        => array('tl_timeline_datasources', 'getProviderList'),
                        'eval'                    => array('helpwizard'=>true, 'chosen'=>true, 'submitOnChange'=>true),
                        'reference'               => &$GLOBALS['TL_LANG']['tl_timeline_datasource']['type'],
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
                'newsArchive' => array
                (
                        'label'                   => &$GLOBALS['TL_LANG']['tl_timeline_datasource']['newsArchive'],
                        'inputType'               => 'radio',
                        'options_callback'        => array('tl_module_news', 'getNewsArchives'),
                        'eval'                    => array('mandatory'=>true),
                        'sql'                     => "varchar(255) NOT NULL default ''"
                ),
                'onlyFeaturesNews' => array 
                (
                        'label'                 => &$GLOBALS['TL_LANG']['tl_timeline_datasource']['onlyFeaturesNews'],
                        'inputType'             => 'checkbox',
                        'sql'                   => "int(10) unsigned NOT NULL default '0'"
                ),
		'twitterUrl' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timeline_datasource']['twitterUrl'],
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'url', 'mandatory'=>true, 'decodeEntities'=>true, 'maxlength'=>255, 'tl_class'=>'w50 long'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
                'overwriteIcon' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timeline_datasource']['overwriteIcon'],
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'iconSRC' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timeline_datasource']['iconSRC'],
			'inputType'               => 'fileTree',
			'eval'                    => array('fieldType'=>'radio', 'mandatory'=>true, 'filesOnly'=>true, 'tl_class'=>'clr'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
                'dp_startDate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timeline_datasource']['dp_startDate'],
			'default'                 => time(),
			'sorting'                 => true,
			'flag'                    => 8,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'date', 'mandatory'=>true, 'doNotCopy'=>true, 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
                'dp_endDate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timeline_datasource']['dp_endDate'],
			'default'                 => time(),
			'sorting'                 => true,
			'flag'                    => 8,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'date', 'mandatory'=>true, 'doNotCopy'=>true, 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
                'dp_text' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timeline_datasource']['dp_text'],
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('rte'=>'tinyMCE', 'tl_class'=>'clr'),
			'sql'                     => "text NULL"
		),
                'dp_headline' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timeline_datasource']['dp_headline'],
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
                'dp_asset' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timeline_datasource']['dp_asset'],
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
                'dp_media' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timeline_datasource']['dp_media'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
                'dp_caption' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timeline_datasource']['dp_caption'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
                'dp_credit' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_timeline_datasource']['dp_credit'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
	)
);


class tl_timeline_datasources extends Backend
{
        public function getProviderList()
        {
            $keys = array();
            foreach ($GLOBALS['TL_TIMELINE_DATAPROVIDER'] as $key => $value ) {
                $keys[] = $key;
            }
            return $keys;
        }
	/**
	 * List all the Datasources
	 * @param array
	 * @return string
	 */
	public function listDataSources($arrRow)
	{
            if($this->checkIfProviderExists($GLOBALS['TL_TIMELINE_DATAPROVIDER'][$arrRow['type']]))
            {
                $prov = $GLOBALS['TL_TIMELINE_DATAPROVIDER'][$arrRow['type']];
                $this->import($prov,null,true);
                return $this->$prov->getParentViewLabel($arrRow);

            }
            return "Provider nicht installiert.";
	}
        protected function checkIfProviderExists($str)
        {
            //TODO: Check ausprogrammieren
            return true;
        }
}
