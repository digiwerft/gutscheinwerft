<?php

namespace Digiwerft\Gutscheinwerft\DataContainer;

use Contao\Config;
use Digiwerft\Gutscheinwerft\Controller\ApiController\GutscheinwerftApi;
use Digiwerft\Gutscheinwerft\Controller\ContentElements\GutscheinwerftElement;
use Contao\StringUtil;

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

    public function getProducts($dc)
    {
        $api = new GutscheinwerftApi(Config::get('gutscheinwerft_user'), Config::get('gutscheinwerft_pass'), false);
        $products = $api->listProducts();
        $arrProducts = [];
        if (!$products) {
            return false;
        } else {
            foreach ($products as $product) {
                if ($product->category) {
                    $arrProducts[StringUtil::standardize($product->category) . "/" . StringUtil::standardize($product->name)] = $product->name;
                }
            }
        }
        return $arrProducts;
    }

    public function loadDataContainer($dc)
    {
        if (Config::get('gutscheinwerft_user') && Config::get('gutscheinwerft_pass')) {
            $GLOBALS['TL_DCA']['tl_content']['palettes'][GutscheinwerftElement::TYPE] = GutscheinwerftElement::PALETTE_CATEGORIES_PRODUCTS;
        } else {
            $GLOBALS['TL_DCA']['tl_content']['palettes'][GutscheinwerftElement::TYPE] = GutscheinwerftElement::PALETTE_DEFAULT;
        }
    }
}