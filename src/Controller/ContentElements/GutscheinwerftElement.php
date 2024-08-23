<?php

namespace Digiwerft\Gutscheinwerft\Controller\ContentElements;

use Contao\BackendTemplate;
use Contao\ContentElement;
use Contao\StringUtil;
use Contao\System;

class GutscheinwerftElement extends ContentElement
{
    public const TYPE = 'gutscheinwerft';
    public const PALETTE_DEFAULT = '{type_legend},type;{gutscheinwerft_legend},gwDevShop;{protected_legend:hide},protected;{invisible_legend:hide},invisible,start,stop';
    public const PALETTE_CATEGORIES = '{type_legend},type;{gutscheinwerft_legend},gwShopCategories,gwDevShop;{protected_legend:hide},protected;{invisible_legend:hide},invisible,start,stop';

    protected $strTemplate = 'ce_' . self::TYPE;

    protected function compile()
    {
        if ($this->isBackendRequest()) {
            $this->strTemplate = 'be_wildcard';
            $this->Template = new BackendTemplate($this->strTemplate);
            $this->Template->wildcard = '### Gutscheinwerft ###';
        }
        $this->shopCategories = StringUtil::deserialize($this->shopCategories);
    }

    protected function isBackendRequest()
    {
        $request = System::getContainer()->get('request_stack')->getCurrentRequest();
        return $request && System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest($request);
    }
}