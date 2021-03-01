<?php
/****************************************************************************************/
/*
    {PYB} is a shortcut for Patrick Boens

    {COMPANY} is a shortcut to "Lato Sensu Management"

    {RIGHTS} is a shortcut used by trql.documentor.class.php. In general the material
    presented here is available under the conditions of 
    https://creativecommons.org/licenses/by-sa/4.0/

    Other shortcuts exist. They exist to make it simple to change the formulation
    of parts that can vary over time.

    It does not change the undisputed truth that ALL code has been created by
    Patrick Boens, the author, who owns ALL the intellectual property of what
    he created.



*/

/** {{{*fheader
    {*file                  trql.steeringpositionvalue.class.php *}
    {*purpose               A value indicating a steering position. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:41 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 28-08-2020 16:41 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\steeringpositionvalue;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\qualitativevalue\QualitativeValue    as QualitativeValue;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'QUALITATIVEVALUE_CLASS_VERSION' ) )
    require_once( 'trql.qualitativevalue.class.php' );



defined( 'STEERINGPOSITIONVALUE_CLASS_VERSION' ) or define( 'STEERINGPOSITIONVALUE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class SteeringPositionValue=

    {*desc

        A value indicating a steering position.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/SteeringPositionValue[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:41. IT HAS NOT BEEN TESTED YET!
    *}

 */
/* ==================================================================================== */
class SteeringPositionValue extends QualitativeValue
/*--------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $additionalProperty             = null;             /* {*property   $additionalProperty             (PropertyValue)                 A property-value pair representing an additional characteristics of
                                                                                                                                                    the entitity, e.g. a product feature or another characteristic for
                                                                                                                                                    which there is no matching property in schema.org.Note: Publishers
                                                                                                                                                    should be aware that applications designed to use specific schema.org
                                                                                                                                                    properties (e.g. http://schema.org/width, http://schema.org/color,
                                                                                                                                                    http://schema.org/gtin13, ...) will typically expect such data to be
                                                                                                                                                    provided using those properties, rather than using the generic
                                                                                                                                                    property/value mechanism. *} */
    public      $additionalType                 = null;             /* {*property   $additionalType                 (URL)                           An additional type for the item, typically used for adding more
                                                                                                                                                    specific types from external vocabularies in microdata syntax. This is
                                                                                                                                                    a relationship between something and a class that the thing is in. In
                                                                                                                                                    RDFa syntax, it is better to use the native RDFa syntax - the 'typeof'
                                                                                                                                                    attribute - for multiple types. Schema.org tools may have only weaker
                                                                                                                                                    understanding of extra types, in particular those defined externally. *} */
    public      $alternateName                  = null;             /* {*property   $alternateName                  (string)                        An alias for the item. *} */
    public      $description                    = null;             /* {*property   $description                    (string)                        A description of the item. *} */
    public      $disambiguatingDescription      = null;             /* {*property   $disambiguatingDescription      (string)                        A sub property of description. A short description of the item used to
                                                                                                                                                    disambiguate from other, similar items. Information from other
                                                                                                                                                    properties (in particular, name) may be necessary for the description
                                                                                                                                                    to be useful for disambiguation. *} */
    public      $equal                          = null;             /* {*property   $equal                          (QualitativeValue)              This ordering relation for qualitative values indicates that the
                                                                                                                                                    subject is equal to the object. *} */
    public      $greater                        = null;             /* {*property   $greater                        (QualitativeValue)              This ordering relation for qualitative values indicates that the
                                                                                                                                                    subject is greater than the object. *} */
    public      $greaterOrEqual                 = null;             /* {*property   $greaterOrEqual                 (QualitativeValue)              This ordering relation for qualitative values indicates that the
                                                                                                                                                    subject is greater than or equal to the object. *} */
    public      $identifier                     = null;             /* {*property   $identifier                     (URL|string|PropertyValue)      The identifier property represents any kind of identifier for any kind
                                                                                                                                                    of Thing, such as ISBNs, GTIN codes, UUIDs etc. Schema.org provides
                                                                                                                                                    dedicated properties for representing many of these, either as textual
                                                                                                                                                    strings or as URL (URI) links. See background notes for more details. *} */
    public      $image                          = null;             /* {*property   $image                          (ImageObject|URL)               An image of the item. This can be a URL or a fully described
                                                                                                                                                    ImageObject. *} */
    public      $lesser                         = null;             /* {*property   $lesser                         (QualitativeValue)              This ordering relation for qualitative values indicates that the
                                                                                                                                                    subject is lesser than the object. *} */
    public      $lesserOrEqual                  = null;             /* {*property   $lesserOrEqual                  (QualitativeValue)              This ordering relation for qualitative values indicates that the
                                                                                                                                                    subject is lesser than or equal to the object. *} */
    public      $mainEntityOfPage               = null;             /* {*property   $mainEntityOfPage               (CreativeWork|URL)              Indicates a page (or other CreativeWork) for which this thing is the
                                                                                                                                                    main entity being described. See background notes for details. *} */
    public      $name                           = null;             /* {*property   $name                           (string)                        The name of the item. *} */
    public      $nonEqual                       = null;             /* {*property   $nonEqual                       (QualitativeValue)              This ordering relation for qualitative values indicates that the
                                                                                                                                                    subject is not equal to the object. *} */
    public      $potentialAction                = null;             /* {*property   $potentialAction                (Action)                        Indicates a potential Action, which describes an idealized action in
                                                                                                                                                    which this thing would play an 'object' role. *} */
    public      $sameAs                         = null;             /* {*property   $sameAs                         (URL)                           URL of a reference Web page that unambiguously indicates the item's
                                                                                                                                                    identity. E.g. the URL of the item's Wikipedia page, Wikidata entry,
                                                                                                                                                    or official website. *} */
    public      $subjectOf                      = null;             /* {*property   $subjectOf                      (Event|CreativeWork)            A CreativeWork or Event about this Thing. *} */
    public      $supersededBy                   = null;             /* {*property   $supersededBy                   (Property|Class|Enumeration)    Relates a term (i.e. a property, class or enumeration) to one that
                                                                                                                                                    supersedes it. *} */
    public      $url                            = null;             /* {*property   $url                            (URL)                           URL of the item. *} */
    public      $valueReference                 = null;             /* {*property   $valueReference                 (Enumeration|StructuredValue|QuantitativeValue|QualitativeValue|PropertyValue)A pointer to a secondary value that provides additional information on
                                                                                                                                                    the original value, e.g. a reference temperature. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;


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
    }   /* End of SteeringPositionValue.__construct() ========================================== */
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
    }   /* End of SteeringPositionValue.__destruct() =========================================== */
    /* ================================================================================ */

}   /* End of class SteeringPositionValue ====================================================== */
/* ==================================================================================== */

?>