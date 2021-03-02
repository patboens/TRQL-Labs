<?php
/****************************************************************************************/
/*
    {PYB} is a shortcut for Patrick Boens

    {COMPANY} is a shortcut to "Lato Sensu Management"

    {RIGHTS} is a shortcut used by trql.documentor.class.php for
    All rights reserved to Lato Sensu Management for all countries.
    All Intellectual Property belongs to Patrick Boens.

    Other shortcuts exist. They exist to make it simple to change the formulation
    of parts that can vary over time.

    It does not change the undisputed truth that ALL code has been created by
    Patrick Boens, the author, who owns ALL the intellectual property of what
    he created.

*/

/** {{{*fheader
    {*file                  trql.visualartwork.class.php *}
    {*purpose               A work of art that is primarily visual in character. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 24-08-2020 03:31 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 24-08-2020 03:31 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 14-02-21 10:03 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\visualartwork;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\creativework\CreativeWork         as CreativeWork;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );

defined( 'VISUALARTWORK_CLASS_VERSION' ) or define( 'VISUALARTWORK_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class VisualArtwork=

    {*desc

        A work of art that is primarily visual in character.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/VisualArtwork[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]

    *}

 */
/* ==================================================================================== */
class VisualArtwork extends CreativeWork
/*------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $artEdition                     = null;             /* {*property   $artEdition                     (int|string)                    The number of copies when multiple copies of a piece of artwork are
                                                                                                                                                    produced - e.g. for a limited edition of 20 prints, 'artEdition'
                                                                                                                                                    refers to the total number of copies (in this example "20"). *} */
    public      $artMedium                      = null;             /* {*property   $artMedium                      (string|URL)                    The material used. (e.g. Oil, Watercolour, Acrylic, Linoprint, Marble,
                                                                                                                                                    Cyanotype, Digital, Lithograph, DryPoint, Intaglio, Pastel, Woodcut,
                                                                                                                                                    Pencil, Mixed Media, etc.) *} */
    public      $artform                        = null;             /* {*property   $artform                        (URL|string)                    e.g. Painting, Drawing, Sculpture, Print, Photograph, Assemblage,
                                                                                                                                                    Collage, etc. *} */
    public      $artist                         = null;             /* {*property   $artist                         (Person)                        The primary artist for a work in a medium other than pencils or
                                                                                                                                                    digital line art--for example, if the primary artwork is done in
                                                                                                                                                    watercolors or digital paints. *} */
    public      $artworkSurface                 = null;             /* {*property   $artworkSurface                 (URL|string)                    The supporting materials for the artwork, e.g. Canvas, Paper, Wood,
                                                                                                                                                    Board, etc. *} */
    public      $colorist                       = null;             /* {*property   $colorist                       (Person)                        The individual who adds color to inked drawings. *} */
    public      $depth                          = null;             /* {*property   $depth                          (QuantitativeValue|Distance)    The depth of the item. *} */
    public      $height                         = null;             /* {*property   $height                         (Distance|QuantitativeValue)    The height of the item. *} */
    public      $inker                          = null;             /* {*property   $inker                          (Person)                        The individual who traces over the pencil drawings in ink after
                                                                                                                                                    pencils are complete. *} */
    public      $letterer                       = null;             /* {*property   $letterer                       (Person)                        The individual who adds lettering, including speech balloons and sound
                                                                                                                                                    effects, to artwork. *} */
    public      $penciler                       = null;             /* {*property   $penciler                       (Person)                        The individual who draws the primary narrative artwork. *} */
    public      $width                          = null;             /* {*property   $width                          (QuantitativeValue|Distance)    The width of the item. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q4502142';       /* {*property   $wikidataId                     (string)                        Wikidata ID. Work of art that is primarily visual *} */


    /* ================================================================================ */
    /** {{*__construct( [$szHome] )=

        Class constructor

        {*params
            $szHome     (string)        Home of the class. Optional.
        *}

        {*return
            (self)      The current instance of the class
        *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szHome = null )
    /*-----------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        return ( $this );
    }   /* End of VisualArtwork.__construct() ========================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return
        *}

        *}}
    */
    /* ================================================================================ */
    public function __destruct()
    /*------------------------*/
    {
        $this->backup();
        $this->autodoc();
        $this->UIKey();
        $this->WikiData();
        $this->necroSignaling();
    }   /* End of VisualArtwork.__destruct() ========================================== */
    /* ================================================================================ */
}   /* End of class VisualArtwork ===================================================== */
/* ==================================================================================== */
?>