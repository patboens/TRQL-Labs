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
    {*file                  trql.service.class.php *}
    {*purpose               A service provided by an organization, e.g. delivery
                            service, print services, etc. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 24-08-2020 05:49 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 24-08-2020 05:49 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\service;

use \trql\vaesoli\Vaesoli           as Vaesoli;
use \trql\intangible\Intangible     as Intangible;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'INTANGIBLE_CLASS_VERSION' ) )
    require_once( 'trql.intangible.class.php' );

defined( 'SERVICE_CLASS_VERSION' ) or define( 'SERVICE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Service=

    {*desc

        A service provided by an organization, e.g. delivery service, print services,
        etc.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Service[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]

    *}

 */
/* ==================================================================================== */
class Service extends Intangible
/*----------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $aggregateRating        = null;                     /* {*property   $aggregateRating    (AggregateRating )                              The overall rating, based on a collection of reviews
                                                                                                                                                        or ratings, of the item. *} */
    public      $areaServed             = null;                     /* {*property   $areaServed         (AdministrativeArea|GeoShape|Place|string)      The geographic area where a service or offered item is
                                                                                                                                                        provided. *} */
    public      $audience               = null;                     /* {*property   $audience           (Audience)                                      An intended audience, i.e. a group for whom something
                                                                                                                                                        was created. *} */
    public      $availableChannel       = null;                     /* {*property   $availableChannel   (ServiceChannel)                                A means of accessing the service (e.g. a phone bank,
                                                                                                                                                        a web site, a location, etc.). *} */
    public      $award                  = null;                     /* {*property   $award              (string)                                        An award won by or for this item. *} */
    public      $brand                  = null;                     /* {*property   $brand              (Brand|Organization)                            The brand(s) associated with a product or service, or
                                                                                                                                                        the brand(s) maintained by an organization or
                                                                                                                                                        business person. *} */
    public      $broker                 = null;                     /* {*property   $broker             (Organization|Person)                           An entity that arranges for an exchange between a buyer
                                                                                                                                                        and a seller. In most cases a broker never acquires or
                                                                                                                                                        releases ownership of a product or service involved in
                                                                                                                                                        an exchange. If it is not clear whether an entity is a
                                                                                                                                                        broker, seller, or buyer, the latter two terms are
                                                                                                                                                        preferred. *} */
    public      $category               = null;                     /* {*property   $category           (PhysicalActivityCategory|string|Thing|URL)     A category for the item. Greater signs or slashes can
                                                                                                                                                        be used to informally indicate a category hierarchy. *} */
    public      $hasOfferCatalog        = null;                     /* {*property   $hasOfferCatalog    (OfferCatalog)                                  Indicates an OfferCatalog listing for this Organization,
                                                                                                                                                        Person, or Service. *} */
    public      $hoursAvailable         = null;                     /* {*property   $hoursAvailable     (OpeningHoursSpecification)                     The hours during which this service or contact is available. *} */
    public      $isRelatedTo            = null;                     /* {*property   $isRelatedTo        (Product|Service)                               A pointer to another, somehow related product
                                                                                                                                                        (or multiple products). *} */
    public      $isSimilarTo            = null;                     /* {*property   $isSimilarTo        (Product|Service)                               A pointer to another, functionally similar product
                                                                                                                                                        (or multiple products). *} */
    public      $logo                   = null;                     /* {*property   $logo               (ImageObject|URL)                               An associated logo. *} */
    public      $offers                 = null;                     /* {*property   $offers             (Demand|Offer)                                  An offer to provide this item-for example, an offer to sell
                                                                                                                                                        a product, rent the DVD of a movie, perform a service, or give
                                                                                                                                                        away tickets to an event. Use businessFunction to indicate the
                                                                                                                                                        kind of transaction offered, i.e. sell, lease, etc. This
                                                                                                                                                        property can also be used to describe a Demand. While this
                                                                                                                                                        property is listed as expected on a number of common types,
                                                                                                                                                        it can be used in others. In that case, using a second type,
                                                                                                                                                        such as Product or a subtype of Product, can clarify the
                                                                                                                                                        nature of the offer. *} */
    public      $provider               = null;                     /* {*property   $provider           (Organization|Person)                           The service provider, service operator, or service performer;
                                                                                                                                                        the goods producer. Another party (a seller) may offer those
                                                                                                                                                        services or goods on behalf of the provider. A provider may
                                                                                                                                                        also serve as the seller. *} */
    public      $providerMobility       = null;                     /* {*property   $providerMobility   (string)                                        Indicates the mobility of a provided service (e.g. 'static',
                                                                                                                                                        'dynamic'). *} */
    public      $review                 = null;                     /* {*property   $review             (Review)                                        A review of the item. *} */
    public      $serviceOutput          = null;                     /* {*property   $serviceOutput      (Thing)                                         The tangible thing generated by the service, e.g. a passport,
                                                                                                                                                        permit, etc. *} */
    public      $serviceType            = null;                     /* {*property   $serviceType        (GovernmentBenefitsType|string)                 The type of service being offered, e.g. veterans' benefits,
                                                                                                                                                        emergency relief, etc. *} */
    public      $slogan                 = null;                     /* {*property   $slogan             (string)                                        A slogan or motto associated with the item. *} */
    public      $termsOfService         = null;                     /* {*property   $termsOfService     (string|URL)                                    Human-readable terms of service documentation. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId             = 'Q7406919';               /* {*property   $wikidataId         (string)                                        Wikidata ID. Transaction in which possession of no physical goods 
                                                                                                                                                        are transferred from the seller to the buyer *} */


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
    }   /* End of Service.__construct() =============================================== */
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
    }   /* End of Service.__destruct() ================================================ */
    /* ================================================================================ */
}   /* End of class Service =========================================================== */
/* ==================================================================================== */
?>