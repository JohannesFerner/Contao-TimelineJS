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
class NewsArchiveProvider extends AbstractDataProvider {
    public function getParentViewLabel($arrRow){
        $archive = \NewsArchiveModel::findById($arrRow['newsArchive']);
        return '<div class="tl_content_left">' . $archive->title . '</div>';
    }

    public function getTypeString() {
        return 'NewsArchive';
    }
    
    protected function getThumbnail($news,$param,$timeline)
    {
        /*
         * Ordentliche Logik für die Thumbnails
         */
        // TimeLineThumbnail:
        if($timeline->overwriteIcon == 1)
        {
            $thumbnail = \Timeline\TimelineAjax::getAssetFromFileID($timeline->iconSRC);
        }
        // NewsArchiveThumbnail:
        if($param['overwriteIcon'] == 1)
        {
            $thumbnail = \Timeline\TimelineAjax::getAssetFromFileID($param['iconSRC']);
        }
        if($thumbnail['media']['thumbnail'] != null)
        {
        return $thumbnail['media'];
        }
        return null;
    }
    
    public function getTimelineEntries($param)
    {
        // Nur Featured News?
        if($param['onlyFeaturesNews'] == true)
        {
            $news = \NewsModel::findPublishedByPid($param['newsArchive'],true);
        }
        else
        {
            $news = \NewsModel::findPublishedByPid($param['newsArchive']);
        }
        
        // NewsArchiveThumbnail:
       
        
        if($news == null) return;
        
        $dates = array();
        $this->loadLanguageFile('tl_timeline_datasource');
        
        while($news->next())
        {
            $thumbnail = \Timeline\NewsArchiveProvider::getThumbnail($news->current(),$param,$this);
            $readmore = '</br></br><a class="timeline readmore" href="'. \Environment::get('url') . \Environment::get('path') .'/{{news_url::'.$news->current()->id.'}}">'.$GLOBALS['TL_LANG']['tl_timeline_datasource']['readMore'].'</a>';
            
            $date = array(
            'startDate' => date('Y,m,d',$news->current()->date),
            'endDate' => date('Y,m,d',$news->current()->date),
            'text'      => $this->restoreBasicEntities($this->replaceInsertTags($news->current()->teaser . $readmore)),
            'headline'  => $this->restoreBasicEntities($news->current()->headline),
            );
            
            if($news->current()->addImage == 1)
            {
                $date['asset'] = \Timeline\TimelineAjax::getAssetFromFileID($news->current()->singleSRC);
                if($news->current()->caption != null){                
                    $date['asset']['caption'] = $this->restoreBasicEntities($news->current()->caption);
                }
            }
            if($thumbnail != null)
            $date['asset']['thumbnail'] = $thumbnail;
            
            $dates[] = $date;
        }
        return $dates;
    }
}

?>
