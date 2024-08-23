<?php

/**
 * Backend Modules
 */

use Digiwerft\Gutscheinwerft\Controller\ContentElements\GutscheinwerftElement;

$GLOBALS['BE_MOD']['system']['gutscheinwerft_settings'] = [
    'tables' => ['tl_gutscheinwerft_settings']
];

/**
 * Content Elements
 */
$GLOBALS['TL_CTE']['includes'][GutscheinwerftElement::TYPE] = GutscheinwerftElement::class;