<?php

abstract class dmModelTreeView extends dmConfigurable
{
  protected
  $options,
  $helper,
  $culture,
  $tree,
  $html,
  $level,
  $lastLevel;

  public function __construct(dmHelper $helper, $culture, array $options)
  {
    $this->helper   = $helper;
    $this->culture  = $culture;

    $this->initialize($options);

    $this->tree     = $this->getRecordTree();

  }

  protected function initialize(array $options)
  {
    if (!(dmDb::table($options['model']) instanceof dmDoctrineTable && dmDb::table($options['model'])->isNestedSet())) {
      unset ($options['model']);
    }
    $this->configure($options);
  }

  abstract protected function renderModelLink(myDoctrineRecord $model);

  protected function getRecordTree()
  {
    //die(var_dump($this->options));

    $modelTableTree = dmDb::table($this->options['model'])->getTree();

    $modelTableTree->setBaseQuery($this->getRecordTreeQuery());

    $tree = $modelTableTree->fetchTree();
    //$tree = $modelTableTree->fetchTree(array(), Doctrine_Core::HYDRATE_NONE);

    $modelTableTree->resetBaseQuery();

    return $tree;
  }

  protected function getRecordTreeQuery()
  {
    $select = 'model.*';
    $query = dmDb::table($this->options['model'])->createQuery('model');
    if (dmDb::table($this->options['model'])->hasI18n()) {
      $query->withI18n($this->culture, null, 'model');
      $select .= ', modelTranslation.*';
    }
    return $query->select($select);
  }

  public function render($options = array())
  {
    $this->options = array_merge(dmString::toArray($options, true), $this->options);

    $this->html = $this->helper->open('ul', $this->options);

    $this->lastLevel = false;
    //die(var_dump(get_class($this->tree)));
    foreach($this->tree as $node)
    {
      //die(var_dump(get_class($node)));
      $this->level = $node->level;
      $this->html .= $this->renderNode($node);
      $this->lastLevel = $this->level;
    }

    $this->html .= str_repeat('</li></ul>', $this->lastLevel+1);

    return $this->html;
  }

  protected function renderNode(myDoctrineRecord $model)
  {
    /*
     * First time, don't insert nothing
     */
    if ($this->lastLevel === false)
    {
      $html = '';
    }
    elseif ($this->level === $this->lastLevel)
    {
      $html = '</li>';
    }
    elseif ($this->level > $this->lastLevel)
    {
      $html = '<ul>';
    }
    else // $this->level < $this->lastLevel
    {
      $html = str_repeat('</li></ul>', $this->lastLevel - $this->level).'</li>';
    }

    $html .= $this->renderOpenLi($model);

    $html .= $this->renderModelLink($model);

    return $html;
  }

  protected function renderOpenLi(myDoctrineRecord $model)
  {
    return '<li id="dmm'.$model->id.'" rel="manual">';
  }

}