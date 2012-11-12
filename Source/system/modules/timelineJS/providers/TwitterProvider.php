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

class TwitterProvider extends AbstractDataProvider {
    public function getParentViewLabel($arrRow){
        return '<div class="tl_content_left"><img src="http://cmsesmc.org/wp-content/plugins/wordpress-seo/images/twitter-icon.png"/><span style="color:#b3b3b3;padding-left:3px">[' . $arrRow['twitterUrl']. ']</span></div>';
    }

    public function getTypeString() {
        return 'twitter';
    }

    public function getTimelineEntries($param) {
        $date = array(
            'startDate' => "2012,01,27",
            'endDate' => "2012,01,27",
            'text'      => $data['0']['text'],
            'headline'  => 'test',
            );
        $date['asset'] = \Timeline\TimelineAjax::getAssetFromFileID($data['0']['singleSRC']);
        $dates[] = $date;
        
        
                
//        $row = $this->Database->prepare('Select * FROM tl_timeline_datasource WHERE pid=?')
//           ->execute($id);
//        $sources = $row->fetchAllAssoc();
//        
//        var_dump($sources);
//        
//        foreach ($sources as $key => $value) {
//            
//        }
        
        
        return $dates;
    }
}

?>
