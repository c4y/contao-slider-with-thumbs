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
 * Namespace
 */
namespace fliesenwalters;


/**
 * Class referenzen
 *
 * @copyright  2014 Oliver Lohoff
 * @author     Oliver Lohoff, Contao4you.de
 * @package    fliesenwalter
 */
class Referenzen extends \Controller
{


	protected $arrReferenzen = array();


    /**
     * Construct
     * @param $perPage
     * @param $id
     */
    public function __construct($id = null, $perPage = null, $referenzengallerysize = null, $referenzenthumbsize = null)
    {
        $this->loadLanguageFile("default");

        $this->perPage = $perPage;
        $this->id = (isset($id)) ? $id : $_GET["id"];
        $this->objGallery = \Database::getInstance()->query("SELECT * FROM tl_referenzen ORDER BY sorting ASC");

        // UUID getrennt speichern, um die Pfade auf einmal abfragen zu können
        // speichere alle Infos zu den Referenzen
        while($this->objGallery->next())
        {
            $arrFilesUUID[] = $this->objGallery->singleSRC;
            $this->arrReferenzen[] = $this->objGallery->row();
        }

        // hole Pfad-Infos zu den Bildern
        $objFiles = \FilesModel::findMultipleByUuids($arrFilesUUID);
        $i=0;
        while($objFiles->next())
        {
            $this->arrReferenzen[$i]["path"] = $objFiles->path;
            $i++;
        }

        // per AJAX liegen die Infos nicht vor
        if (!isset($referenzengallerysize) || !isset($referenzenthumbsize) || !isset($perPage))
        {
            $objCTE = \Database::getInstance()->prepare("SELECT * FROM tl_content WHERE id=?")->execute((int)$this->id);
            $referenzengallerysize = $objCTE->referenzengallerysize;
            $referenzenthumbsize = $objCTE->referenzenthumbsize;
            $this->perPage = $objCTE->perPage;
        }

        $this->gallerysize = deserialize($referenzengallerysize);
        $this->thumbsize = deserialize($referenzenthumbsize);

        $this->generateThumbs();
    }


    /**
     * Generate Thumbs and Pagination
     */
    protected function generateThumbs()
    {
        // Galerie-Bilder werden immer alle dargestellt, unabhängig der Paginierung
        $objGallery = \Database::getInstance()->query("SELECT * FROM tl_referenzen ORDER BY sorting ASC");
        $intTotal = $objGallery->count();

        $offset = 0;

        // Split the results
        if ($this->perPage > 0)
        {
            // Get the current page
            $id = 'page_r' . $this->id;
            $page = \Input::get($id) ?: 1;

            // Set limit and offset
            $limit = $this->perPage;
            $offset += (max($page, 1) - 1) * $this->perPage;

            $this->offset = $offset;

            // Add the pagination menu
            $objPagination = new \Pagination($intTotal, $this->perPage, \Config::get('maxPaginationLinks'), $id);
            $this->pagination = $objPagination->generate("\n  ");
        }

        // Offset, Limit
        if (isset($limit))
        {
            $objThumbs = \Database::getInstance()->prepare("SELECT * FROM tl_referenzen LIMIT ?,?")->execute($offset, (int)$limit);
        }
        else
        {
            $objThumbs = \Database::getInstance()->prepare("SELECT * FROM tl_referenzen")->execute();
        }

        $this->objThumbs = $objThumbs;
    }


    /**
     * Get Slider Images
     * @return array
     */
    public function getSliderImages()
    {
        // alle Galeriebilder erzeugen
        // und Pfad für die Thumbs hinterlegen
        for($i=0; $i<(count($this->arrReferenzen)); $i++)
        {
            $this->arrReferenzen[$i]["sliderimage"] = \Image::get($this->arrReferenzen[$i]["path"], $this->gallerysize[0], $this->gallerysize[1],$this->gallerysize[2]);
        }

        return $this->arrReferenzen;

    }

    /**
     * Hole Thumbnails gem. Pagination
     * idx = für die Swipe Ansteuerung per jQuery
     * @return array
     */
    public function getThumbs()
    {
        // Thumbs nur Seitenbezogen
        $j=0;
        for($i=$this->offset; $i<($this->offset+$this->perPage); $i++)
        {
            $arrThumbs[$j] = $this->arrReferenzen[$i];
            $arrThumbs[$j]['thumbimage'] = \Image::get($this->arrReferenzen[$i]["path"], $this->thumbsize[0], $this->thumbsize[1],$this->thumbsize[2]);
            $arrThumbs[$j]['idx'] = $i;
            $j++;
        }

        return $arrThumbs;
    }

    /**
     *
     * @return string
     */
    public function getPagination()
    {
        return $this->pagination;
    }

    public function getAjaxThumbs()
    {
        if(\Input::get("type") == "a")
        {
            $objTemplate = new \FrontendTemplate("ce_referenzen_ajax");
            $objTemplate->thumbs = $this->getThumbs();
            $objTemplate->pagination = $this->getPagination();

            header('Content-Type: text/html');
            echo $objTemplate->parse();
            exit;
        }
    }


}
