<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Timeline;
/**
 * Description of TwitterProvider
 *
 * @author Johannes
 */
class DatapointProvider extends AbstractDataProvider {
    
    public function getParentViewLabel($arrRow) {
        return '<div class="tl_content_left">ID ' . $arrRow['id'] . ' - ' .$arrRow['dp_headline'] . '</div>';
    }

    public function getTimelineEntries($param) {
        
        // Get Data
        $date = array();
        $date[0]['startDate'] = date('Y,m,d',$param['dp_startDate']);
        $date[0]['endDate'] = date('Y,m,d',$param['dp_endDate']);
        $date[0]['text'] = $this->restoreBasicEntities($param['dp_text']);
        $date[0]['headline'] =  $this->restoreBasicEntities($param['dp_headline']);
        
        // Get Asset
        if($param['dp_asset'])
        {
            $date[0]['asset']['media'] = $this->restoreBasicEntities($param['dp_media']);
            $date[0]['asset']['caption'] = $this->restoreBasicEntities($param['dp_caption']);
            $date[0]['asset']['credit'] = $this->restoreBasicEntities($param['dp_credit']);
        }
        // Get Icon
        $image = \FilesModel::findById($param['iconSRC']);
        $asset=array(
            'media'     => \Environment::get('url') . \Environment::get('path').'/'.$image->path,
            );
        if($param['overwriteIcon'])
        {
            $image = \FilesModel::findById($param['iconSRC']);
            $date[0]['asset']['thumbnail'] = \Environment::get('url') . \Environment::get('path').'/' . $this->getImage($image->path, 32, 32, 'center_center');
        }

        return $date;
    }

    public function getTypeString() {
        return 'Datapoint';
    }
}
?>
