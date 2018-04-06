<?php
namespace SME\FileFabric\ContentDetectors\Detectors;

class UKPhoneNumber implements DetectorInterface
{

    /**
     * Returns true
     *
     * @param $content
     * @return bool
     */
    public function matches($content)
    {
        return false;
    }

}