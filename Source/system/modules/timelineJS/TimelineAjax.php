<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Timeline;
/**
 * Description of TimelineAjax
 *
 * @author Johannes
 */
class TimelineAjax extends \Controller {
    
    public function getAssetFromFileID($id,$lang='de')
    {
        $image = \FilesModel::findById($id);
        $arrMeta = (array) deserialize($image->meta);
        $asset=array(
            'media'     => \Environment::get('url') . \Environment::get('path').'/'.$image->path,
            );
        if($arrMeta != null)
            {
            $asset['credit']    = $this->restoreBasicEntities($arrMeta[$lang]['caption']);
            $asset['caption']   = $this->restoreBasicEntities($arrMeta[$lang]['title']);
            
            //var_dump($arrMeta);
        }    
        return $asset;
    }
    
    public function getJSON()
    {
        if($this->Input->get('module') == 'timelineJS')
        {
            $id = $this->Input->get('id');

            $this->import('Database');
            $row = $this->Database->prepare('Select * FROM tl_timeline WHERE id=?')
               ->execute($id);
            $data = $row->fetchAllAssoc();


            $json['timeline'] = array(
                'headline'  => $this->restoreBasicEntities($data['0']['headline']),
                'type'      => 'default',
                'text'      => $this->restoreBasicEntities($data['0']['text']),
                'startDate' => "2012,01,01",
            );

            // Add Image to First Slide
            if($data['0']['addImage'] == 1)
            {
                $json['timeline']['asset'] = \Timeline\TimelineAjax::getAssetFromFileID($data['0']['singleSRC']);
            }

            /*
             * Get the Dates
             */
            $json['timeline']['date'] = array();

            // Hole alle Datenquellen
            $row2 = $this->Database->prepare('Select * FROM tl_timeline_datasource WHERE pid=?')
               ->execute($id);
            $sources = $row2->fetchAllAssoc();

            //Durchlaufen der Datenquellen, import der Klasse, holen der Entries
            foreach ($sources as $value) {
                $prov = $GLOBALS['TL_TIMELINE_DATAPROVIDER'][$value['type']];
                $this->import($prov,null,true);

                $dates = $this->$prov->getTimelineEntries($value);
                if(is_array($dates)) // nur wenn Datenpunkte zurückgekommen sind.
                $json['timeline']['date'] = array_merge($json['timeline']['date'],$dates);
            }


            /*
             * Ausgabe des JSON-Files
             */
            header('Content-Type: application/json');
            echo json_encode($json,JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);

           exit;
        }
    }
    
}

?>
