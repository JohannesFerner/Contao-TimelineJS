<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Timeline;
/**
 * Description of AbstractDataProvider
 *
 * @author Johannes
 */
abstract class AbstractDataProvider extends \Controller {
    abstract function getTypeString();
    abstract function getParentViewLabel($arrRow);
    abstract function getTimelineEntries($param);
}

