<?php
namespace SME\ContentDetectors\Detectors\Misc;

use SME\ContentDetectors\Detectors\Detector;
use SME\ContentDetectors\Detectors\DetectorInterface;

/**
 * Class Swearword
 *
 * Detector implementation for Copyrights
 *
 * @package SME\ContentDetectors\Detectors\Misc
 * @author vanja K. <vanja@storagemadeeasy.com>
 */
class Swearword extends Detector implements DetectorInterface
{
    /**
     * uniq code of detector
     * @var string
     */
    
    protected $code  = 'swearword';
    
    protected $swearWordsRegex = null;
    
    const SWEAR_WORD_FILE_PATH = __DIR__ . '/../../data/swearwords.dat';
     
    /**
     * Returns the regular expression used to initially detect the content
     *
     * @return string
     */
    public function getRegularExpression()
    {
         
        return '/\b('.$this->getSwearWordsRegex().')\b/uim';
    }

    /**
     * Returns the regular expression to check all swear words
     *
     * @return string
     */
    private function getSwearWordsRegex()
    {
        if ($this->swearWordsRegex === null) {
            if (file_exists(self::SWEAR_WORD_FILE_PATH) && (filesize(self::SWEAR_WORD_FILE_PATH) > 0)) {
                $words = file_get_contents(self::SWEAR_WORD_FILE_PATH);
                $words = explode("\n", $words);

                if (! empty($words)) {
                    foreach ($words as $word) {
                        $word = trim($word);

                        if ($word != "") {
                            $this->swearWordsRegex .= '|(' . preg_quote($word, '/') . ')';
                        }
                    }
                }
            }
            
            $this->swearWordsRegex = ($this->swearWordsRegex === null) ? '' : ltrim($this->swearWordsRegex, '|');
        }
        
        return $this->swearWordsRegex;
    }

}