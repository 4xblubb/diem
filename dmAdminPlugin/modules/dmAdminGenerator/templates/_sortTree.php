<?php

//use_stylesheet('admin.sort');
use_javascript('lib.jstree');
use_javascript('admin.modelTree');

//$submit =
//_tag('div.text_align_right',
//  _tag('span.info', __('Drag & drop elements, then')).
//  $form->renderSubmitTag(__('Save modifications'))
//);

//echo $form->renderGlobalErrors();

echo _open('div.dm_sort.dm_box.big');

  //echo _tag('h1.title', __('Sort %1%', array('%1%' => $form->getModule()->getPlural())));

  echo _open('div.dm_box_inner');

    echo _tag('div#dm_full_model_tree.clearfix.dm', array('json' => array(
      'move_url' => _link('dmAdminGenerator/move?dm_module='.$dm_module)->getHref()
    )), $tree->render());

//    echo $form->renderFormTag($sf_request->getUri());
//
//    echo _tag('div.fleft', _link('@'.$form->getModule()->getUnderscore())->text('&laquo; '.__('Back to list')));
//
//    echo $submit;
//
//    echo _open('ol.objects');
//
//    foreach($form->getRecords() as $record)
//    {
//      $fieldName = $record->get('id');
//
//      echo _tag('li.object', $form[$fieldName]->renderLabel().$form[$fieldName]->render());
//    }
//
//    echo _close('ol');
//
//    echo $submit;
//
//    echo '</form>';

  echo _close('div');

echo _close('div');