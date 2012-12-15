<?php

namespace Timeline;

/**
 * FrontendModule for the TimelineJS
 * generates JSON [AJAX] & delivers FE-Module [HTML]
 *
 * @author Johannes
 */
class TimelineModule extends \Contao\Module {

    protected $strTemplate = 'mod_timeline';

    public function generate() {
        if (TL_MODE == 'BE') {
            $objTemplate = new \BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### Timeline ###';
            $objTemplate->title = $this->title;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->title;
            $objTemplate->href = 'contao/main.php?do=timelines&table=tl_timeline_datasource&id=1' . $this->id;

            return $objTemplate->parse();
        }
        return parent::generate();
    }

    protected function compile() {

        $this->import('Database');
        $row = $this->Database->prepare('Select * FROM tl_timeline WHERE id=?')
                ->execute($this->timelineID);
        $data = $row->fetchAllAssoc();

        \FilesModel::findByPk(3);

        $width = deserialize($this->timelineWidth);
        $height = deserialize($this->timelineHeight);
        if ($width['unit'] == 'px')
            $width['unit'] = '';
        if ($height['unit'] == 'px')
            $height['unit'] = '';
        $this->Template->width = $width;
        $this->Template->height = $height;

        $this->Template->JsonURL = \Environment::get('url') . \Environment::get('path') . '/SimpleAjax.php?module=timelineJS&id=' . $this->timelineID;

        $this->Template->TimelineData = $data;
    }

}

