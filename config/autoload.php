<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package Walters-referenzen
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'fliesenwalters',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'fliesenwalters\Referenzen'      => 'system/modules/walters-referenzen/classes/Referenzen.php',

	// Elements
	'fliesenwalters\ContentReferenzen'       => 'system/modules/walters-referenzen/elements/ContentReferenzen.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'ce_referenzen' => 'system/modules/walters-referenzen/templates',
    'ce_referenzen_ajax' => 'system/modules/walters-referenzen/templates'
));
