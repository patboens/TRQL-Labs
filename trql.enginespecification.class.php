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
    {*file                  trql.enginespecification.class.php *}
    {*purpose               Information about the engine of the vehicle. A vehicle can
                            have multiple engines represented by multiple engine
                            specification entities. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:46 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:46 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    {*chist
        {*mdate 14-02-21 10:44 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */

/****************************************************************************************/
namespace trql\enginespecification;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\schema\StructuredValue    as StructuredValue;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'STRUCTUREDVALUE_CLASS_VERSION' ) )
    require_once( 'trql.structuredvalue.class.php' );



defined( 'ENGINESPECIFICATION_CLASS_VERSION' ) or define( 'ENGINESPECIFICATION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class EngineSpecification=

    {*desc

        Information about the engine of the vehicle. A vehicle can have multiple
        engines represented by multiple engine specification entities.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/EngineSpecification[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:46.
    *}

 */
/* ==================================================================================== */
class EngineSpecification extends StructuredValue
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
    public      $engineDisplacement             = null;             /* {*property   $engineDisplacement             (QuantitativeValue)             The volume swept by all of the pistons inside the cylinders of an
                                                                                                                                                    internal combustion engine in a single movement. Typical unit code(s):
                                                                                                                                                    CMQ for cubic centimeter, LTR for liters, INQ for cubic inches* Note
                                                                                                                                                    1: You can link to information about how the given value has been
                                                                                                                                                    determined using the valueReference property.* Note 2: You can use
                                                                                                                                                    minValue and maxValue to indicate ranges. *} */
    public      $enginePower                    = null;             /* {*property   $enginePower                    (QuantitativeValue)             The power of the vehicle's engine. Typical unit code(s): KWT for
                                                                                                                                                    kilowatt, BHP for brake horsepower, N12 for metric horsepower (PS,
                                                                                                                                                    with 1 PS = 735,49875 W)Note 1: There are many different ways of
                                                                                                                                                    measuring an engine's power. For an overview, see
                                                                                                                                                    http://en.wikipedia.org/wiki/Horsepower#Enginepowertest_codes.Note 2:
                                                                                                                                                    You can link to information about how the given value has been
                                                                                                                                                    determined using the valueReference property.Note 3: You can use
                                                                                                                                                    minValue and maxValue to indicate ranges. *} */
    public      $engineType                     = null;             /* {*property   $engineType                     (QualitativeValue|string|URL)   The type of engine or engines powering the vehicle. *} */
    public      $fuelType                       = null;             /* {*property   $fuelType                       (URL|QualitativeValue|string)   The type of fuel suitable for the engine or engines of the vehicle. If
                                                                                                                                                    the vehicle has only one engine, this property can be attached
                                                                                                                                                    directly to the vehicle. *} */
    public      $identifier                     = null;             /* {*property   $identifier                     (URL|string|PropertyValue)      The identifier property represents any kind of identifier for any kind
                                                                                                                                                    of Thing, such as ISBNs, GTIN codes, UUIDs etc. Schema.org provides
                                                                                                                                                    dedicated properties for representing many of these, either as textual
                                                                                                                                                    strings or as URL (URI) links. See background notes for more details. *} */
    public      $image                          = null;             /* {*property   $image                          (ImageObject|URL)               An image of the item. This can be a URL or a fully described
                                                                                                                                                    ImageObject. *} */
    public      $mainEntityOfPage               = null;             /* {*property   $mainEntityOfPage               (CreativeWork|URL)              Indicates a page (or other CreativeWork) for which this thing is the
                                                                                                                                                    main entity being described. See background notes for details. *} */
    public      $name                           = null;             /* {*property   $name                           (string)                        The name of the item. *} */
    public      $potentialAction                = null;             /* {*property   $potentialAction                (Action)                        Indicates a potential Action, which describes an idealized action in
                                                                                                                                                    which this thing would play an 'object' role. *} */
    public      $sameAs                         = null;             /* {*property   $sameAs                         (URL)                           URL of a reference Web page that unambiguously indicates the item's
                                                                                                                                                    identity. E.g. the URL of the item's Wikipedia page, Wikidata entry,
                                                                                                                                                    or official website. *} */
    public      $subjectOf                      = null;             /* {*property   $subjectOf                      (Event|CreativeWork)            A CreativeWork or Event about this Thing. *} */
    public      $torque                         = null;             /* {*property   $torque                         (QuantitativeValue)             The torque (turning force) of the vehicle's engine.Typical unit
                                                                                                                                                    code(s): NU for newton metre (N m), F17 for pound-force per foot, or
                                                                                                                                                    F48 for pound-force per inchNote 1: You can link to information about
                                                                                                                                                    how the given value has been determined (e.g. reference RPM) using the
                                                                                                                                                    valueReference property.Note 2: You can use minValue and maxValue to
                                                                                                                                                    indicate ranges. *} */
    public      $url                            = null;             /* {*property   $url                            (URL)                           URL of the item. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */


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
    }   /* End of EngineSpecification.__construct() ========================================== */
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
    }   /* End of EngineSpecification.__destruct() =========================================== */
    /* ================================================================================ */

}   /* End of class EngineSpecification ====================================================== */
/* ==================================================================================== */

?>