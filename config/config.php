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


$GLOBALS['BE_MOD']['content']['referenzen'] = array
(
   'tables'       => array('tl_referenzen'),
   'icon'         => 'system/modules/walters-referenzen/assets/fliese.png'
);


 $GLOBALS['TL_CTE']['media']['referenzen'] = 'ContentReferenzen';


// Hooks
$GLOBALS['TL_HOOKS']['simpleAjaxFrontend'][] = array('Referenzen', 'getAjaxThumbs');