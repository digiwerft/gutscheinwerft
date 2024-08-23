<?php

namespace Digiwerft\Gutscheinwerft\DataContainer;

use Contao\Config;
use Digiwerft\Gutscheinwerft\Controller\ApiController\GutscheinwerftApi;
use Digiwerft\Gutscheinwerft\Controller\ContentElements\GutscheinwerftElement;

class GutscheinwerftCallback
{
    public function getCategories($dc)
    {
        $api = new GutscheinwerftApi(Config::get('gutscheinwerft_user'), Config::get('gutscheinwerft_pass'), false);
        $categories = $api->listCategories();
        $arrCategories = [];
        if (!$categories) {
            return false;
        } else {
            foreach ($categories as $category) {
                $arrCategories[$category->identifier] = $category->name;
            }
        }
        return $arrCategories;
    }

    public function loadDataContainer($dc)
    {
        if (Config::get('gutscheinwerft_user') && Config::get('gutscheinwerft_pass')) {
            $GLOBALS['TL_DCA']['tl_content']['palettes'][GutscheinwerftElement::TYPE] = GutscheinwerftElement::PALETTE_CATEGORIES;
        } else {
            $GLOBALS['TL_DCA']['tl_content']['palettes'][GutscheinwerftElement::TYPE] = GutscheinwerftElement::PALETTE_DEFAULT;
        }
    }
}