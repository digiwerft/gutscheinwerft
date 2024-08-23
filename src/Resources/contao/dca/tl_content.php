<?php

$strTable = 'tl_content';

$GLOBALS['TL_DCA'][$strTable]['fields']['gwShopCategories'] = array(
    'label'                   => &$GLOBALS['TL_LANG'][$strTable]['gwShopCategories'],
    'exclude'                 => true,
    'inputType'               => 'checkboxWizard',
    'eval' => array(
        'mandatory' => false,
        'tl_class' => 'clr',
        'includeBlankOption' => true,
        'multiple' => true
    ),
    'sql'                     => "mediumtext NULL"
);

$GLOBALS['TL_DCA'][$strTable]['fields']['gwDevShop'] = [
    'label' => &$GLOBALS['TL_LANG'][$strTable]['gwDevShop'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'clr w50'],
    'sql' => "char(1) NOT NULL default ''"
];