<?php

namespace TinectCompressor\Components;

require_once __DIR__ . '/../vendor/autoload.php';

use MatthiasMullie\Minify as MullieMinify;
use Shopware\Components\Theme\LessCompiler;

class CSSCompressor implements LessCompiler
{
    private $parentlessCompiler;
    private $compress = false;

    public function __construct(LessCompiler $parentlessCompiler)
    {
        $this->parentlessCompiler = $parentlessCompiler;
    }

    /**
     * Resets all configurations.
     */
    public function reset()
    {
        $this->parentlessCompiler->reset();
    }

    /**
     * Allows to set different configurations for the less compiler,
     * like the compress mode or css source maps.
     *
     * @param array $configuration
     */
    public function setConfiguration(array $configuration)
    {
        $this->compress = (bool) $configuration['compress'];
        $this->parentlessCompiler->setConfiguration($configuration);
    }

    /**
     * Allows to define import directories for the less compiler.
     *
     * @param array $directories
     */
    public function setImportDirectories(array $directories)
    {
        $this->parentlessCompiler->setImportDirectories($directories);
    }

    /**
     * Allows to set variables which can be used
     * in the compiled less files.
     *
     * @param array $variables
     */
    public function setVariables(array $variables)
    {
        $this->parentlessCompiler->setVariables($variables);
    }

    /**
     * @param string $file file which should be compiled
     * @param string $url  Url which is used for css urls
     */
    public function compile($file, $url)
    {
        $this->parentlessCompiler->compile($file, $url);
    }

    /**
     * Returns all compiled less content.
     *
     * @return string
     */
    public function get()
    {
        $cssResult = $this->parentlessCompiler->get();

        if ($this->compress) {
            $minifier = new MullieMinify\CSS();
            $minifier->add($cssResult);
            $cssResult = $minifier->minify();
        }

        return $cssResult;
    }

}
