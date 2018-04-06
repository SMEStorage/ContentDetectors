<?php
namespace SME\FileFabric\ContentDetectors\Detectors;

interface DetectorInterface
{
    /**
     * Returns true
     *
     * @param $content
     * @return bool
     */
    public function matches($content);

}