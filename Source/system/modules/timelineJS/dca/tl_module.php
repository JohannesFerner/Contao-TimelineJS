<?php

/**
 * Table tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['timeline'] = '{title_legend},name,headline,type;{config_legend},timelineID,timelineWidth,timelineHeight;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';

$GLOBALS['TL_DCA']['tl_module']['fields']['timelineID'] = array(
    'label'      => $GLOBALS['TL_LANG']['tl_module']['tl_timeline'],
    'inputType'  => 'select',
    'foreignKey' => 'tl_timeline.title',
    'eval'       => array('mandatory' => true),
    'sql'        => "int(10) unsigned NOT NULL default '0'"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['timelineWidth'] = array(
    'label'         => $GLOBALS['TL_LANG']['tl_module']['tl_timeline']['width'],
    'default'       => '960',
    'inputType'     => 'inputUnit',
    'options'       => array('px','%'),
    'eval'          => array('rgxp' => 'digit'),
    'sql'           => "varchar(255) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['timelineHeight'] = array(
    'label'         => $GLOBALS['TL_LANG']['tl_module']['tl_timeline']['height'],
    'inputType'     => 'inputUnit',
    'default'       => '600',
    'options'       => array('px','%'),
    'eval'          => array('rgxp' => 'digit'),
    'sql'           => "varchar(255) NOT NULL default ''"
);


