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
    {*file                  trql.thing.class.php *}
    {*purpose               Most generic class *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 08/02/2017 - 12:10 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 16-08-20 19:54 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\thing;

use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\mother\Mother         as Mother;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

defined( 'THING_CLASS_VERSION' ) or define( 'THING_CLASS_VERSION','0.1' );

/* ================================================================================== */
/** {{*class Thing=

    {*desc
        The most generic type of item
    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Thing[/url] *}

    *}}
 */
/* ================================================================================== */
class Thing extends Mother
/*----------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $additionalType             = null;                 /* {*property   $additionalType             (string)                An additional type for the item,
                                                                                                                                        typically used for adding more
                                                                                                                                        specific types from external
                                                                                                                                        vocabularies in microdata syntax.
                                                                                                                                        This is a relationship between
                                                                                                                                        something and a class that the
                                                                                                                                        thing is in. In RDFa syntax, it is
                                                                                                                                        better to use the native RDFa
                                                                                                                                        syntax - the 'typeof' attribute
                                                                                                                                        - for multiple types. *} */
                                                                    
    public      $alternateName              = null;                 /* {*property   $alternateName              (string)                An alias for the item. *} */
                                                                    
    public      $description                = null;                 /* {*property   $description                (string)                A short description of the item. *} */
                                                                    
    public      $disambiguatingDescription  = null;                 /* {*property   $disambiguatingDescription  (string)                A sub property of description. A
                                                                                                                                        short description of the item used
                                                                                                                                        to disambiguate from other, similar
                                                                                                                                        items. Information from other
                                                                                                                                        properties (in particular, name)
                                                                                                                                        may be necessary for the description
                                                                                                                                        to be useful for disambiguation. *} */
                                                                    
    public      $image                      = null;                 /* {*property   $image                      (string)                URL of an image of the item. *} */
                                                                    
    public      $identifier                 = null;                 /* {*property   $identifier                 (string)                The identifier property represents any
                                                                                                                                        kind of identifier for any kind of Thing,
                                                                                                                                        such as ISBNs, GTIN codes, UUIDs etc.
                                                                                                                                        http://schema.org provides dedicated
                                                                                                                                        properties for representing many of these,
                                                                                                                                        either as textual strings or as URL (URI)
                                                                                                                                        links. See <a
                                                                                                                                        href="https://schema.org/docs/datamodel.html#identifierBg">
                                                                                                                                        background notes</a>
                                                                                                                                        for more details. *} */
                                                                    
    public      $mainEntityOfPage           = null;                 /* {*property   $mainEntityOfPage           (string)                Indicates a page (or other @class.CreativeWork, @class.Event)
                                                                                                                                        for which this thing is the main entity
                                                                                                                                        being described. See <a
                                                                                                                                        href="https://schema.org/docs/datamodel.html#mainEntityBackground">
                                                                                                                                        background notes</a> for details.
                                                                                                                                        Inverse property: @var.mainEntity. *} */
    public      $name                       = null;                 /* {*property   $name                       (string)                The name of the item. *} */
                                                                    
    public      $potentialAction            = null;                 /* {*property   $potentialAction            (Action)                Indicates a potential @class.Action, which
                                                                                                                                        describes an idealized action in which
                                                                                                                                        this thing would play an 'object' role. *} */
                                                                    
    public      $sameAs                     = null;                 /* {*property   $sameAs                     (string)                URL of a reference Web page that
                                                                                                                                        unambiguously indicates the item's
                                                                                                                                        identity. E.g. the URL of the
                                                                                                                                        item's Wikipedia page, Freebase
                                                                                                                                        page, or official website. *} */
                
    public      $subjectOf                  = null;                 /* {*property   $subjectOf                  (CreativeWork|Event)    A @class.CreativeWork or @class.Event about this @class.Thing. 
                                                                                                                                        Inverse property: @var.about. *} */
                
    public      $url                        = null;                 /* {*property   $url                        (string)                URL of the item. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                 = 'Q35120';             /* {*property   $wikidataId                 (string)                WikidataId ... entity ... a thing with independent and 
                                                                                                                                        distinct existence *} */



    /* ================================================================================ */
    /** {{*__construct( [$szHome] )=

        Class constructor

        {*params
            $szHome     (string)        Home of the class. Optional.
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*keywords constructors, destructors *}

        {*seealso @fnc.__destruct *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szHome = null )
    /*-----------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

    }   /* End of Thing.__construct() ================================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return
        *}

        {*keywords constructors, destructors *}

        {*seealso @fnc.__construct *}

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
    }   /* End of Thing.__destruct() ================================================== */
    /* ================================================================================ */
}   /* End of class Thing ============================================================= */
/* ==================================================================================== */
