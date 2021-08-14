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
    {*file                  trql.shippingratesettings.class.php *}
    {*purpose               A ShippingRateSettings represents re-usable pieces of
                            shipping information. It is designed for publication on an
                            URL that may be referenced via the shippingSettingsLink
                            property of an OfferShippingDetails. Several occurrences can
                            be published, distinguished and matched (i.e.
                            identified/referenced) by their different values for
                            shippingLabel. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:30 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 28-08-2020 16:30 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\shippingratesettings;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\schema\StructuredValue    as StructuredValue;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'STRUCTUREDVALUE_CLASS_VERSION' ) )
    require_once( 'trql.structuredvalue.class.php' );



defined( 'SHIPPINGRATESETTINGS_CLASS_VERSION' ) or define( 'SHIPPINGRATESETTINGS_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class ShippingRateSettings=

    {*desc

        A ShippingRateSettings represents re-usable pieces of shipping information.
        It is designed for publication on an URL that may be referenced via the
        shippingSettingsLink property of an OfferShippingDetails. Several
        occurrences can be published, distinguished and matched (i.e.
        identified/referenced) by their different values for shippingLabel.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/ShippingRateSettings[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:30.
    *}

 */
/* ==================================================================================== */
class ShippingRateSettings extends StructuredValue
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
    public      $doesNotShip                    = null;             /* {*property   $doesNotShip                    (boolean)                       Indicates when shipping to a particular shippingDestination is not
                                                                                                                                                    available. *} */
    public      $freeShippingThreshold          = null;             /* {*property   $freeShippingThreshold          (DeliveryChargeSpecification|MonetaryAmount)A monetary value above which (or equal to) the shipping rate becomes
                                                                                                                                                    free. Intended to be used via an OfferShippingDetails with
                                                                                                                                                    shippingSettingsLink matching this ShippingRateSettings. *} */
    public      $identifier                     = null;             /* {*property   $identifier                     (URL|string|PropertyValue)      The identifier property represents any kind of identifier for any kind
                                                                                                                                                    of Thing, such as ISBNs, GTIN codes, UUIDs etc. Schema.org provides
                                                                                                                                                    dedicated properties for representing many of these, either as textual
                                                                                                                                                    strings or as URL (URI) links. See background notes for more details. *} */
    public      $image                          = null;             /* {*property   $image                          (ImageObject|URL)               An image of the item. This can be a URL or a fully described
                                                                                                                                                    ImageObject. *} */
    public      $isUnlabelledFallback           = null;             /* {*property   $isUnlabelledFallback           (boolean)                       This can be marked 'true' to indicate that some published
                                                                                                                                                    DeliveryTimeSettings or ShippingRateSettings are intended to apply to
                                                                                                                                                    all OfferShippingDetails published by the same merchant, when
                                                                                                                                                    referenced by a shippingSettingsLink in those settings. It is not
                                                                                                                                                    meaningful to use a 'true' value for this property alongside a
                                                                                                                                                    transitTimeLabel (for DeliveryTimeSettings) or shippingLabel (for
                                                                                                                                                    ShippingRateSettings), since this property is for use with unlabelled
                                                                                                                                                    settings. *} */
    public      $mainEntityOfPage               = null;             /* {*property   $mainEntityOfPage               (CreativeWork|URL)              Indicates a page (or other CreativeWork) for which this thing is the
                                                                                                                                                    main entity being described. See background notes for details. *} */
    public      $name                           = null;             /* {*property   $name                           (string)                        The name of the item. *} */
    public      $potentialAction                = null;             /* {*property   $potentialAction                (Action)                        Indicates a potential Action, which describes an idealized action in
                                                                                                                                                    which this thing would play an 'object' role. *} */
    public      $sameAs                         = null;             /* {*property   $sameAs                         (URL)                           URL of a reference Web page that unambiguously indicates the item's
                                                                                                                                                    identity. E.g. the URL of the item's Wikipedia page, Wikidata entry,
                                                                                                                                                    or official website. *} */
    public      $shippingDestination            = null;             /* {*property   $shippingDestination            (DefinedRegion)                 indicates (possibly multiple) shipping destinations. These can be
                                                                                                                                                    defined in several ways e.g. postalCode ranges. *} */
    public      $shippingLabel                  = null;             /* {*property   $shippingLabel                  (string)                        Label to match an OfferShippingDetails with a ShippingRateSettings
                                                                                                                                                    (within the context of a shippingSettingsLink cross-reference). *} */
    public      $shippingRate                   = null;             /* {*property   $shippingRate                   (MonetaryAmount)                The shipping rate is the cost of shipping to the specified
                                                                                                                                                    destination. Typically, the maxValue and currency values (of the
                                                                                                                                                    MonetaryAmount) are most appropriate. *} */
    public      $subjectOf                      = null;             /* {*property   $subjectOf                      (Event|CreativeWork)            A CreativeWork or Event about this Thing. *} */
    public      $url                            = null;             /* {*property   $url                            (URL)                           URL of the item. *} */


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
    }   /* End of ShippingRateSettings.__construct() ========================================== */
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
    }   /* End of ShippingRateSettings.__destruct() =========================================== */
    /* ================================================================================ */

}   /* End of class ShippingRateSettings ====================================================== */
/* ==================================================================================== */

?>