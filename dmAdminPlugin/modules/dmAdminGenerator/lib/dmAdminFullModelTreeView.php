<?php

class dmAdminFullModelTreeView extends dmAdminModelTreeView
{
//  public function __construct() {
//    die($this->getDmModule()->getModel());
//    $this->setModel($this->getDmModule()->getModel());
//  }
  
  protected function renderOpenLi(myDoctrineRecord $model)
  {
//    if($page[1] === 'show' && false)  // disabled rel=auto to allow drag'n'drop for auto-generated pages
//    {
//      $type = 'auto';
//    }
//    else
//    {
      $type = $this->lastLevel === false ? 'root' : 'manual';
//    }
    
    return '<li id="dmp'.$model->id.'" rel="'.$type.'">';
  }
  
}
