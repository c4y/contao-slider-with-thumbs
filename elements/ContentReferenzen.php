<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package   fliesenwalters
 * @author    Oliver Lohoff, Contao4you.de
 * @license   LGPL
 * @copyright 2014 Oliver Lohoff
 */


/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace fliesenwalters;


/**
 * Class ContentReferenzen
 *
 * @package   fliesenwalters
 * @author    Oliver Lohoff, Contao4you.de
 * @license   LGPL
 * @copyright 2014 Oliver Lohoff
 */
class ContentReferenzen extends \ContentElement
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'ce_referenzen';


    /**
     * Return if the file does not exist
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE')
        {
            $objTemplate = new \BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### Referenzen ###';
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

            return $objTemplate->parse();
        }
        return parent::generate();
    }


    /**
     * Generate the content element
     */
    protected function compile()
    {
        $referenzen = new \Referenzen($this->id, $this->perPage, $this->referenzengallerysize, $this->referenzenthumbsize);

        $this->Template->slider = $referenzen->getSliderImages();
        $this->Template->thumbs = $referenzen->getThumbs();
        $this->Template->pagination = $referenzen->getPagination();
    }


}
