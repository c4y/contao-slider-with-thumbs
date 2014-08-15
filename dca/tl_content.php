<?php

$GLOBALS['TL_DCA']['tl_content']['palettes']['referenzen'] = '{type_legend},type,referenzenthumbsize,referenzengallerysize,perRow,perPage';

$GLOBALS['TL_DCA']['tl_content']['fields']['referenzenthumbsize'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_referenzen']['referenzenthumbsize'],
    'exclude'                 => true,
    'inputType'               => 'imageSize',
    'options'                 => $GLOBALS['TL_CROP'],
    'reference'               => &$GLOBALS['TL_LANG']['MSC'],
    'eval'                    => array('rgxp'=>'digit', 'nospace'=>true, 'helpwizard'=>true, 'tl_class'=>'w50'),
    'sql'                     => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['referenzengallerysize'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_referenzen']['referenzengallerysize'],
    'exclude'                 => true,
    'inputType'               => 'imageSize',
    'options'                 => $GLOBALS['TL_CROP'],
    'reference'               => &$GLOBALS['TL_LANG']['MSC'],
    'eval'                    => array('rgxp'=>'digit', 'nospace'=>true, 'helpwizard'=>true, 'tl_class'=>'w50'),
    'sql'                     => "varchar(64) NOT NULL default ''"
);