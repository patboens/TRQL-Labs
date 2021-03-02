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
    {*file                  trql.propertyvalue.class.php *}
    {*purpose               A property-value pair, e.g. representing a feature of a
                            product or place. Use the 'name' property for the name of
                            the property. If there is an additional human-readable
                            version of the value, put that into the 'description'
                            property.Always use specific schema.org properties when a)
                            they exist and b) you can populate them. Using PropertyValue
                            as a substitute will typically not trigger the same effect
                            as using the original, specific property. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:28 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 28-08-2020 16:28 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\propertyvalue;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\structuredvalue\StructuredValue    as StructuredValue;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'STRUCTUREDVALUE_CLASS_VERSION' ) )
    require_once( 'trql.structuredvalue.class.php' );



defined( 'PROPERTYVALUE_CLASS_VERSION' ) or define( 'PROPERTYVALUE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class PropertyValue=

    {*desc

        A property-value pair, e.g. representing a feature of a product or place.
        Use the 'name' property for the name of the property. If there is an
        additional human-readable version of the value, put that into the
        'description' property.Always use specific schema.org properties when a)
        they exist and b) you can populate them. Using PropertyValue as a
        substitute will typically not trigger the same effect as using the
        original, specific property.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/PropertyValue[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:28.
    *}

 */
/* ==================================================================================== */
class PropertyValue extends StructuredValue
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
    public      $identifier                     = null;             /* {*property   $identifier                     (URL|string|PropertyValue)      The identifier property represents any kind of identifier for any kind
                                                                                                                                                    of Thing, such as ISBNs, GTIN codes, UUIDs etc. Schema.org provides
                                                                                                                                                    dedicated properties for representing many of these, either as textual
                                                                                                                                                    strings or as URL (URI) links. See background notes for more details. *} */
    public      $image                          = null;             /* {*property   $image                          (ImageObject|URL)               An image of the item. This can be a URL or a fully described
                                                                                                                                                    ImageObject. *} */
    public      $mainEntityOfPage               = null;             /* {*property   $mainEntityOfPage               (CreativeWork|URL)              Indicates a page (or other CreativeWork) for which this thing is the
                                                                                                                                                    main entity being described. See background notes for details. *} */
    public      $maxValue                       = null;             /* {*property   $maxValue                       (float)                         The upper value of some characteristic or property. *} */
    public      $measurementTechnique           = null;             /* {*property   $measurementTechnique           (URL|string)                    A technique or technology used in a Dataset (or DataDownload,
                                                                                                                                                    DataCatalog),corresponding to the method used for measuring the
                                                                                                                                                    corresponding variable(s) (described using variableMeasured). This is
                                                                                                                                                    oriented towards scientific and scholarly dataset publication but may
                                                                                                                                                    have broader applicability; it is not intended as a full
                                                                                                                                                    representation of measurement, but rather as a high level summary for
                                                                                                                                                    dataset discovery.For example, if variableMeasured is: molecule
                                                                                                                                                    concentration, measurementTechnique could be: "mass spectrometry" or
                                                                                                                                                    "nmr spectroscopy" or "colorimetry" or "immunofluorescence".If the
                                                                                                                                                    variableMeasured is "depression rating", the measurementTechnique
                                                                                                                                                    could be "Zung Scale" or "HAM-D" or "Beck Depression Inventory".If
                                                                                                                                                    there are several variableMeasured properties recorded for some given
                                                                                                                                                    data object, use a PropertyValue for each variableMeasured and attach
                                                                                                                                                    the corresponding measurementTechnique. *} */
    public      $minValue                       = null;             /* {*property   $minValue                       (float)                         The lower value of some characteristic or property. *} */
    public      $name                           = null;             /* {*property   $name                           (string)                        The name of the item. *} */
    public      $potentialAction                = null;             /* {*property   $potentialAction                (Action)                        Indicates a potential Action, which describes an idealized action in
                                                                                                                                                    which this thing would play an 'object' role. *} */
    public      $propertyID                     = null;             /* {*property   $propertyID                     (string|URL)                    A commonly used identifier for the characteristic represented by the
                                                                                                                                                    property, e.g. a manufacturer or a standard code for a property.
                                                                                                                                                    propertyID can be(1) a prefixed string, mainly meant to be used with
                                                                                                                                                    standards for product properties; (2) a site-specific, non-prefixed
                                                                                                                                                    string (e.g. the primary key of the property or the vendor-specific id
                                                                                                                                                    of the property), or (3)a URL indicating the type of the property,
                                                                                                                                                    either pointing to an external vocabulary, or a Web resource that
                                                                                                                                                    describes the property (e.g. a glossary entry).Standards bodies should
                                                                                                                                                    promote a standard prefix for the identifiers of properties from their
                                                                                                                                                    standards. *} */
    public      $sameAs                         = null;             /* {*property   $sameAs                         (URL)                           URL of a reference Web page that unambiguously indicates the item's
                                                                                                                                                    identity. E.g. the URL of the item's Wikipedia page, Wikidata entry,
                                                                                                                                                    or official website. *} */
    public      $subjectOf                      = null;             /* {*property   $subjectOf                      (Event|CreativeWork)            A CreativeWork or Event about this Thing. *} */
    public      $unitCode                       = null;             /* {*property   $unitCode                       (string|URL)                    The unit of measurement given using the UN/CEFACT Common Code (3
                                                                                                                                                    characters) or a URL. Other codes than the UN/CEFACT Common Code may
                                                                                                                                                    be used with a prefix followed by a colon. *} */
    public      $unitText                       = null;             /* {*property   $unitText                       (string)                        A string or text indicating the unit of measurement. Useful if you
                                                                                                                                                    cannot provide a standard unit code forunitCode. *} */
    public      $url                            = null;             /* {*property   $url                            (URL)                           URL of the item. *} */
    public      $value                          = null;             /* {*property   $value                          (float|string|boolean|StructuredValue)The value of the quantitative value or property value node.For
                                                                                                                                                    QuantitativeValue and MonetaryAmount, the recommended type for values
                                                                                                                                                    is 'Number'.For PropertyValue, it can be 'Text;', 'Number', 'Boolean',
                                                                                                                                                    or 'StructuredValue'.Use values from 0123456789 (Unicode 'DIGIT ZERO'
                                                                                                                                                    (U+0030) to 'DIGIT NINE' (U+0039)) rather than superficially similiar
                                                                                                                                                    Unicode symbols.Use '.' (Unicode 'FULL STOP' (U+002E)) rather than ','
                                                                                                                                                    to indicate a decimal point. Avoid using these symbols as a
                                                                                                                                                    readability separator. *} */
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
    }   /* End of PropertyValue.__construct() ========================================== */
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
    }   /* End of PropertyValue.__destruct() =========================================== */
    /* ================================================================================ */

}   /* End of class PropertyValue ====================================================== */
/* ==================================================================================== */

?>