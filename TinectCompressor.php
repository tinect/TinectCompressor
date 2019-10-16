<?php

namespace TinectCompressor;

use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\ActivateContext;
use Shopware\Components\Plugin\Context\InstallContext;
use Shopware\Components\Plugin\Context\UpdateContext;

class TinectCompressor extends Plugin
{
    public function activate(ActivateContext $context)
    {
        $context->scheduleClearCache(InstallContext::CACHE_LIST_DEFAULT);
    }

    public function update(UpdateContext $context)
    {
        $context->scheduleClearCache(InstallContext::CACHE_LIST_DEFAULT);
    }
}
