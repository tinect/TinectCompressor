<?php

namespace TinectCompressor\Components;

include __DIR__ . '/JSqueeze.php';

use Patchwork\JSqueeze;
use Shopware\Components\Theme\Compressor\CompressorInterface;

class JSCompressor implements CompressorInterface
{
    private $parentCompressor;

    public function __construct(CompressorInterface $parentCompressor)
    {
        $this->parentCompressor = $parentCompressor;
    }

    /**
     * Compress the passed content and returns
     * the compressed content.
     *
     * @param string $content
     *
     * @throws \Exception
     *
     * @return string
     */
    public function compress($content)
    {
        /*
         * Let's use the parentCompressor, too
         */
        $content = $this->parentCompressor->compress($content);

        $JSqueeze = new JSqueeze();
        $content = $JSqueeze->squeeze($content, true, false, true);

        return $content;
    }
}
