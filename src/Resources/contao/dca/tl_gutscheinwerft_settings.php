<?php

use Contao\DC_File;

$strTable = 'tl_gutscheinwerft_settings';

$GLOBALS['TL_DCA'][$strTable] = array(

    'config' => array(
        'dataContainer'    => DC_File::class,
    ),

    'palettes' => array(
        'default' => '{gw_settings_legend},gutscheinwerft_user,gutscheinwerft_pass,gutscheinwerft_dev;'
    ),

    'fields' => array(
        'gutscheinwerft_user' => array(
            'label'         => &$GLOBALS['TL_LANG'][$strTable]['gutscheinwerft_user'],
            'exclude'       => true,
            'inputType'     => 'text',
        ),
        'gutscheinwerft_pass' => array(
            'label'         => &$GLOBALS['TL_LANG'][$strTable]['gutscheinwerft_pass'],
            'exclude'       => true,
            'inputType'     => 'password',
        ),
        'gutscheinwerft_dev' => array(
            'label'         => &$GLOBALS['TL_LANG'][$strTable]['gutscheinwerft_dev'],
            'exclude'       => true,
            'inputType'     => 'checkbox',
        ),
    )
);