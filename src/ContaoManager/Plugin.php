<?php

declare(strict_types=1);

namespace Digiwerft\Gutscheinwerft\ContaoManager;

use Digiwerft\Gutscheinwerft\GutscheinwerftBundle;
use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(GutscheinwerftBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}