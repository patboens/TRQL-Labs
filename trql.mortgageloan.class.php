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
    {*file                  trql.mortgageloan.class.php *}
    {*purpose               A loan in which property or real estate is used as
                            collateral. (A loan securitized against some real estate.) *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:50 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:50 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 14-02-21 09:28 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\mortgageloan;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\loanorcredit\LoanOrCredit    as LoanOrCredit;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'LOANORCREDIT_CLASS_VERSION' ) )
    require_once( 'trql.loanorcredit.class.php' );



defined( 'MORTGAGELOAN_CLASS_VERSION' ) or define( 'MORTGAGELOAN_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class MortgageLoan=

    {*desc

        A loan in which property or real estate is used as collateral. (A loan
        securitized against some real estate.)

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/MortgageLoan[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:50.
    *}

 */
/* ==================================================================================== */
class MortgageLoan extends LoanOrCredit
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
    public      $aggregateRating                = null;             /* {*property   $aggregateRating                (AggregateRating)               The overall rating, based on a collection of reviews or ratings, of
                                                                                                                                                    the item. *} */
    public      $alternateName                  = null;             /* {*property   $alternateName                  (string)                        An alias for the item. *} */
    public      $amount                         = null;             /* {*property   $amount                         (MonetaryAmount|float)          The amount of money. *} */
    public      $annualPercentageRate           = null;             /* {*property   $annualPercentageRate           (QuantitativeValue|float)       The annual rate that is charged for borrowing (or made by investing),
                                                                                                                                                    expressed as a single percentage number that represents the actual
                                                                                                                                                    yearly cost of funds over the term of a loan. This includes any fees
                                                                                                                                                    or additional costs associated with the transaction. *} */
    public      $areaServed                     = null;             /* {*property   $areaServed                     (Place|GeoShape|string|AdministrativeArea)The geographic area where a service or offered item is provided. *} */
    public      $audience                       = null;             /* {*property   $audience                       (Audience)                      An intended audience, i.e. a group for whom something was created. *} */
    public      $availableChannel               = null;             /* {*property   $availableChannel               (ServiceChannel)                A means of accessing the service (e.g. a phone bank, a web site, a
                                                                                                                                                    location, etc.). *} */
    public      $award                          = null;             /* {*property   $award                          (string)                        An award won by or for this item. *} */
    public      $brand                          = null;             /* {*property   $brand                          (Brand|Organization)            The brand(s) associated with a product or service, or the brand(s)
                                                                                                                                                    maintained by an organization or business person. *} */
    public      $broker                         = null;             /* {*property   $broker                         (Person|Organization)           An entity that arranges for an exchange between a buyer and a seller.
                                                                                                                                                    In most cases a broker never acquires or releases ownership of a
                                                                                                                                                    product or service involved in an exchange. If it is not clear whether
                                                                                                                                                    an entity is a broker, seller, or buyer, the latter two terms are
                                                                                                                                                    preferred. *} */
    public      $category                       = null;             /* {*property   $category                       (Thing|PhysicalActivityCategory|URL|string)A category for the item. Greater signs or slashes can be used to
                                                                                                                                                    informally indicate a category hierarchy. *} */
    public      $currency                       = null;             /* {*property   $currency                       (string)                        The currency in which the monetary amount is expressed.Use standard
                                                                                                                                                    formats: ISO 4217 currency format e.g. "USD"; Ticker symbol for
                                                                                                                                                    cryptocurrencies e.g. "BTC"; well known names for Local Exchange
                                                                                                                                                    Tradings Systems (LETS) and other currency types e.g. "Ithaca HOUR". *} */
    public      $description                    = null;             /* {*property   $description                    (string)                        A description of the item. *} */
    public      $disambiguatingDescription      = null;             /* {*property   $disambiguatingDescription      (string)                        A sub property of description. A short description of the item used to
                                                                                                                                                    disambiguate from other, similar items. Information from other
                                                                                                                                                    properties (in particular, name) may be necessary for the description
                                                                                                                                                    to be useful for disambiguation. *} */
    public      $domiciledMortgage              = null;             /* {*property   $domiciledMortgage              (boolean)                       Whether borrower is a resident of the jurisdiction where the property
                                                                                                                                                    is located. *} */
    public      $feesAndCommissionsSpecification = null;             /* {*property   $feesAndCommissionsSpecification(URL|string)                    Description of fees, commissions, and other terms applied either to a
                                                                                                                                                    class of financial product, or by a financial service organization. *} */
    public      $gracePeriod                    = null;             /* {*property   $gracePeriod                    (Duration)                      The period of time after any due date that the borrower has to fulfil
                                                                                                                                                    its obligations before a default (failure to pay) is deemed to have
                                                                                                                                                    occurred. *} */
    public      $hasOfferCatalog                = null;             /* {*property   $hasOfferCatalog                (OfferCatalog)                  Indicates an OfferCatalog listing for this Organization, Person, or
                                                                                                                                                    Service. *} */
    public      $hoursAvailable                 = null;             /* {*property   $hoursAvailable                 (OpeningHoursSpecification)     The hours during which this service or contact is available. *} */
    public      $identifier                     = null;             /* {*property   $identifier                     (URL|string|PropertyValue)      The identifier property represents any kind of identifier for any kind
                                                                                                                                                    of Thing, such as ISBNs, GTIN codes, UUIDs etc. Schema.org provides
                                                                                                                                                    dedicated properties for representing many of these, either as textual
                                                                                                                                                    strings or as URL (URI) links. See background notes for more details. *} */
    public      $image                          = null;             /* {*property   $image                          (ImageObject|URL)               An image of the item. This can be a URL or a fully described
                                                                                                                                                    ImageObject. *} */
    public      $interestRate                   = null;             /* {*property   $interestRate                   (float|QuantitativeValue)       The interest rate, charged or paid, applicable to the financial
                                                                                                                                                    product. Note: This is different from the calculated
                                                                                                                                                    annualPercentageRate. *} */
    public      $isRelatedTo                    = null;             /* {*property   $isRelatedTo                    (Product|Service)               A pointer to another, somehow related product (or multiple products). *} */
    public      $isSimilarTo                    = null;             /* {*property   $isSimilarTo                    (Product|Service)               A pointer to another, functionally similar product (or multiple
                                                                                                                                                    products). *} */
    public      $loanMortgageMandateAmount      = null;             /* {*property   $loanMortgageMandateAmount      (MonetaryAmount)                Amount of mortgage mandate that can be converted into a proper
                                                                                                                                                    mortgage at a later stage. *} */
    public      $loanRepaymentForm              = null;             /* {*property   $loanRepaymentForm              (RepaymentSpecification)        A form of paying back money previously borrowed from a lender.
                                                                                                                                                    Repayment usually takes the form of periodic payments that normally
                                                                                                                                                    include part principal plus interest in each payment. *} */
    public      $loanTerm                       = null;             /* {*property   $loanTerm                       (QuantitativeValue)             The duration of the loan or credit agreement. *} */
    public      $loanType                       = null;             /* {*property   $loanType                       (string|URL)                    The type of a loan or credit. *} */
    public      $logo                           = null;             /* {*property   $logo                           (ImageObject|URL)               An associated logo. *} */
    public      $mainEntityOfPage               = null;             /* {*property   $mainEntityOfPage               (CreativeWork|URL)              Indicates a page (or other CreativeWork) for which this thing is the
                                                                                                                                                    main entity being described. See background notes for details. *} */
    public      $name                           = null;             /* {*property   $name                           (string)                        The name of the item. *} */
    public      $offers                         = null;             /* {*property   $offers                         (Offer|Demand)                  An offer to provide this item&#x2014;for example, an offer to sell a
                                                                                                                                                    product, rent the DVD of a movie, perform a service, or give away
                                                                                                                                                    tickets to an event. Use businessFunction to indicate the kind of
                                                                                                                                                    transaction offered, i.e. sell, lease, etc. This property can also be
                                                                                                                                                    used to describe a Demand. While this property is listed as expected
                                                                                                                                                    on a number of common types, it can be used in others. In that case,
                                                                                                                                                    using a second type, such as Product or a subtype of Product, can
                                                                                                                                                    clarify the nature of the offer. *} */
    public      $potentialAction                = null;             /* {*property   $potentialAction                (Action)                        Indicates a potential Action, which describes an idealized action in
                                                                                                                                                    which this thing would play an 'object' role. *} */
    public      $produces                       = null;             /* {*property   $produces                       (Thing)                         The tangible thing generated by the service, e.g. a passport, permit,
                                                                                                                                                    etc. *} */
    public      $provider                       = null;             /* {*property   $provider                       (Person|Organization)           The service provider, service operator, or service performer; the
                                                                                                                                                    goods producer. Another party (a seller) may offer those services or
                                                                                                                                                    goods on behalf of the provider. A provider may also serve as the
                                                                                                                                                    seller. *} */
    public      $providerMobility               = null;             /* {*property   $providerMobility               (string)                        Indicates the mobility of a provided service (e.g. 'static',
                                                                                                                                                    'dynamic'). *} */
    public      $recourseLoan                   = null;             /* {*property   $recourseLoan                   (boolean)                       The only way you get the money back in the event of default is the
                                                                                                                                                    security. Recourse is where you still have the opportunity to go back
                                                                                                                                                    to the borrower for the rest of the money. *} */
    public      $renegotiableLoan               = null;             /* {*property   $renegotiableLoan               (boolean)                       Whether the terms for payment of interest can be renegotiated during
                                                                                                                                                    the life of the loan. *} */
    public      $requiredCollateral             = null;             /* {*property   $requiredCollateral             (string|Thing)                  Assets required to secure loan or credit repayments. It may take form
                                                                                                                                                    of third party pledge, goods, financial instruments (cash, securities,
                                                                                                                                                    etc.) *} */
    public      $review                         = null;             /* {*property   $review                         (Review)                        A review of the item. *} */
    public      $sameAs                         = null;             /* {*property   $sameAs                         (URL)                           URL of a reference Web page that unambiguously indicates the item's
                                                                                                                                                    identity. E.g. the URL of the item's Wikipedia page, Wikidata entry,
                                                                                                                                                    or official website. *} */
    public      $serviceArea                    = null;             /* {*property   $serviceArea                    (AdministrativeArea|Place|GeoShape)The geographic area where the service is provided. *} */
    public      $serviceAudience                = null;             /* {*property   $serviceAudience                (Audience)                      The audience eligible for this service. *} */
    public      $serviceOutput                  = null;             /* {*property   $serviceOutput                  (Thing)                         The tangible thing generated by the service, e.g. a passport, permit,
                                                                                                                                                    etc. *} */
    public      $serviceType                    = null;             /* {*property   $serviceType                    (string|GovernmentBenefitsType) The type of service being offered, e.g. veterans' benefits, emergency
                                                                                                                                                    relief, etc. *} */
    public      $slogan                         = null;             /* {*property   $slogan                         (string)                        A slogan or motto associated with the item. *} */
    public      $subjectOf                      = null;             /* {*property   $subjectOf                      (Event|CreativeWork)            A CreativeWork or Event about this Thing. *} */
    public      $termsOfService                 = null;             /* {*property   $termsOfService                 (URL|string)                    Human-readable terms of service documentation. *} */
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
    }   /* End of MortgageLoan.__construct() ========================================== */
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
    }   /* End of MortgageLoan.__destruct() =========================================== */
    /* ================================================================================ */

}   /* End of class MortgageLoan ====================================================== */
/* ==================================================================================== */

?>