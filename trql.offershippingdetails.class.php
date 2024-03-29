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
    {*file                  trql.offershippingdetails.class.php *}
    {*purpose               OfferShippingDetails represents information about shipping
                            destinations.Multiple of these entities can be used to
                            represent different shipping rates for different
                            destinations:One entity for Alaska/Hawaii. A different one
                            for continental US.A different one for all France.Multiple
                            of these entities can be used to represent different
                            shipping costs and delivery times.Two entities that are
                            identical but differ in rate and time:e.g. Cheaper and
                            slower: $5 in 5-7daysor Fast and expensive: $15 in 1-2 days *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 21:42 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 21:42 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 14-02-21 09:16 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\offershippingdetails;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\schema\StructuredValue    as StructuredValue;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'STRUCTUREDVALUE_CLASS_VERSION' ) )
    require_once( 'trql.structuredvalue.class.php' );



defined( 'OFFERSHIPPINGDETAILS_CLASS_VERSION' ) or define( 'OFFERSHIPPINGDETAILS_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class OfferShippingDetails=

    {*desc

        OfferShippingDetails represents information about shipping
        destinations.Multiple of these entities can be used to represent different
        shipping rates for different destinations:One entity for Alaska/Hawaii. A
        different one for continental US.A different one for all France.Multiple of
        these entities can be used to represent different shipping costs and
        delivery times.Two entities that are identical but differ in rate and
        time:e.g. Cheaper and slower: $5 in 5-7daysor Fast and expensive: $15 in
        1-2 days

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/OfferShippingDetails[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 21:42.
    *}

 */
/* ==================================================================================== */
class OfferShippingDetails extends StructuredValue
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
    public      $deliveryTime                   = null;             /* {*property   $deliveryTime                   (ShippingDeliveryTime)          The total delay between the receipt of the order and the goods
                                                                                                                                                    reaching the final customer. *} */
    public      $description                    = null;             /* {*property   $description                    (string)                        A description of the item. *} */
    public      $disambiguatingDescription      = null;             /* {*property   $disambiguatingDescription      (string)                        A sub property of description. A short description of the item used to
                                                                                                                                                    disambiguate from other, similar items. Information from other
                                                                                                                                                    properties (in particular, name) may be necessary for the description
                                                                                                                                                    to be useful for disambiguation. *} */
    public      $doesNotShip                    = null;             /* {*property   $doesNotShip                    (boolean)                       Indicates when shipping to a particular shippingDestination is not
                                                                                                                                                    available. *} */
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
    public      $shippingDestination            = null;             /* {*property   $shippingDestination            (DefinedRegion)                 indicates (possibly multiple) shipping destinations. These can be
                                                                                                                                                    defined in several ways e.g. postalCode ranges. *} */
    public      $shippingLabel                  = null;             /* {*property   $shippingLabel                  (string)                        Label to match an OfferShippingDetails with a ShippingRateSettings
                                                                                                                                                    (within the context of a shippingSettingsLink cross-reference). *} */
    public      $shippingRate                   = null;             /* {*property   $shippingRate                   (MonetaryAmount)                The shipping rate is the cost of shipping to the specified
                                                                                                                                                    destination. Typically, the maxValue and currency values (of the
                                                                                                                                                    MonetaryAmount) are most appropriate. *} */
    public      $shippingSettingsLink           = null;             /* {*property   $shippingSettingsLink           (URL)                           Link to a page containing ShippingRateSettings and
                                                                                                                                                    DeliveryTimeSettings details. *} */
    public      $subjectOf                      = null;             /* {*property   $subjectOf                      (Event|CreativeWork)            A CreativeWork or Event about this Thing. *} */
    public      $transitTimeLabel               = null;             /* {*property   $transitTimeLabel               (string)                        Label to match an OfferShippingDetails with a DeliveryTimeSettings
                                                                                                                                                    (within the context of a shippingSettingsLink cross-reference). *} */
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
    }   /* End of OfferShippingDetails.__construct() ================================== */
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
    }   /* End of OfferShippingDetails.__destruct() =================================== */
    /* ================================================================================ */

}   /* End of class OfferShippingDetails ============================================== */
/* ==================================================================================== */

?>