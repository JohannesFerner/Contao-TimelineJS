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
    
   
    protected function compile() {

        $this->import('Database');
        $row = $this->Database->prepare('Select * FROM tl_timeline WHERE id=?')
           ->execute($this->timelineID);
        $data = $row->fetchAllAssoc();
        
        
        $width = deserialize($this->timelineWidth);
        $height = deserialize($this->timelineHeight);
        if($width['unit'] == 'px')
            $width['unit'] = '';
        if($height['unit'] == 'px')
            $height['unit'] = '';
        $this->Template->width = $width;
        $this->Template->height = $height;
        
        $this->Template->JsonURL = \Environment::get('url') . \Environment::get('path').'/simpleajax.php?module=timelineJS&id=' . $this->timelineID;
        
        $this->Template->TimelineData = $data;
        

    }
    
}

