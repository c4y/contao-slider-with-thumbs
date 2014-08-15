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
 * Table tl_referenzen
 */
$GLOBALS['TL_DCA']['tl_referenzen'] = array
(

	// Config
	'config' => array
	(
        'dataContainer'               => 'Table',
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary'
			)
		)
	),

    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode'                    => 0,
            'fields'                  => array('title')
        ),
        'label' => array
        (
            'fields'                  => array('title')
        ),
        'global_operations' => array
        (
            'all' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'                => 'act=select',
                'class'               => 'header_edit_all',
                'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            )
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_referenzen']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.gif'
            ),
            'copy' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_referenzen']['copy'],
                'href'                => 'act=paste&amp;mode=copy',
                'icon'                => 'copy.gif',
                'attributes'          => 'onclick="Backend.getScrollOffset()"'
            ),
            'cut' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_referenzen']['cut'],
                'href'                => 'act=paste&amp;mode=cut',
                'icon'                => 'cut.gif',
                'attributes'          => 'onclick="Backend.getScrollOffset()"'
            ),
            'delete' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_referenzen']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.gif',
                'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
                //'button_callback'     => array('tl_content', 'deleteElement')
            ),
            'show' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_referenzen']['show'],
                'href'                => 'act=show',
                'icon'                => 'show.gif'
            )
        ),
    ),

    // Palette
    'palettes' => array
    (
        'default'   => "{title_legend},title,singleSRC,text"
    ),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
        'sorting' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
		'title' => array
		(
            'inputType'               => 'text',
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
        'singleSRC' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_referenzen']['singleSRC'],
            'exclude'                 => true,
            'inputType'               => 'fileTree',
            'eval'                    => array('filesOnly'=>true, 'fieldType'=>'radio', 'mandatory'=>true, 'tl_class'=>'clr'),
            'sql'                     => "binary(16) NULL",
        ),
        'text' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_referenzen']['text'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'textarea',
            'eval'                    => array('mandatory'=>true, 'rte'=>'tinyMCE', 'helpwizard'=>true),
            'explanation'             => 'insertTags',
            'sql'                     => "mediumtext NULL"
        ),


	)
);
