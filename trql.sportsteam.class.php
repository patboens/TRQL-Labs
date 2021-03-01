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
    {*file                  trql.sportsteam.class.php *}
    {*purpose               Organization: Sports team. *}
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
namespace trql\sportsteam;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\sportsorganization\SportsOrganization    as SportsOrganization;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'SPORTSORGANIZATION_CLASS_VERSION' ) )
    require_once( 'trql.sportsorganization.class.php' );



defined( 'SPORTSTEAM_CLASS_VERSION' ) or define( 'SPORTSTEAM_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class SportsTeam=

    {*desc

        Organization: Sports team.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/SportsTeam[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:41. IT HAS NOT BEEN TESTED YET!
    *}

 */
/* ==================================================================================== */
class SportsTeam extends SportsOrganization
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

    public      $actionableFeedbackPolicy       = null;             /* {*property   $actionableFeedbackPolicy       (URL|CreativeWork)              For a NewsMediaOrganization or other news-related Organization, a
                                                                                                                                                    statement about public engagement activities (for news media, the
                                                                                                                                                    newsroom’s), including involving the public - digitally or otherwise
                                                                                                                                                    -- in coverage decisions, reporting and activities after publication. *} */
    public      $additionalType                 = null;             /* {*property   $additionalType                 (URL)                           An additional type for the item, typically used for adding more
                                                                                                                                                    specific types from external vocabularies in microdata syntax. This is
                                                                                                                                                    a relationship between something and a class that the thing is in. In
                                                                                                                                                    RDFa syntax, it is better to use the native RDFa syntax - the 'typeof'
                                                                                                                                                    attribute - for multiple types. Schema.org tools may have only weaker
                                                                                                                                                    understanding of extra types, in particular those defined externally. *} */
    public      $address                        = null;             /* {*property   $address                        (PostalAddress|string)          Physical address of the item. *} */
    public      $aggregateRating                = null;             /* {*property   $aggregateRating                (AggregateRating)               The overall rating, based on a collection of reviews or ratings, of
                                                                                                                                                    the item. *} */
    public      $alternateName                  = null;             /* {*property   $alternateName                  (string)                        An alias for the item. *} */
    public      $alumni                         = null;             /* {*property   $alumni                         (Person)                        Alumni of an organization. *} */
    public      $areaServed                     = null;             /* {*property   $areaServed                     (Place|GeoShape|string|AdministrativeArea)The geographic area where a service or offered item is provided. *} */
    public      $athlete                        = null;             /* {*property   $athlete                        (Person)                        A person that acts as performing member of a sports team; a player as
                                                                                                                                                    opposed to a coach. *} */
    public      $award                          = null;             /* {*property   $award                          (string)                        An award won by or for this item. *} */
    public      $awards                         = null;             /* {*property   $awards                         (string)                        Awards won by or for this item. *} */
    public      $brand                          = null;             /* {*property   $brand                          (Brand|Organization)            The brand(s) associated with a product or service, or the brand(s)
                                                                                                                                                    maintained by an organization or business person. *} */
    public      $coach                          = null;             /* {*property   $coach                          (Person)                        A person that acts in a coaching role for a sports team. *} */
    public      $contactPoint                   = null;             /* {*property   $contactPoint                   (ContactPoint)                  A contact point for a person or organization. *} */
    public      $contactPoints                  = null;             /* {*property   $contactPoints                  (ContactPoint)                  A contact point for a person or organization. *} */
    public      $correctionsPolicy              = null;             /* {*property   $correctionsPolicy              (URL|CreativeWork)              For an Organization (e.g. NewsMediaOrganization), a statement
                                                                                                                                                    describing (in news media, the newsroom’s) disclosure and correction
                                                                                                                                                    policy for errors. *} */
    public      $department                     = null;             /* {*property   $department                     (Organization)                  A relationship between an organization and a department of that
                                                                                                                                                    organization, also described as an organization (allowing different
                                                                                                                                                    urls, logos, opening hours). For example: a store with a pharmacy, or
                                                                                                                                                    a bakery with a cafe. *} */
    public      $description                    = null;             /* {*property   $description                    (string)                        A description of the item. *} */
    public      $disambiguatingDescription      = null;             /* {*property   $disambiguatingDescription      (string)                        A sub property of description. A short description of the item used to
                                                                                                                                                    disambiguate from other, similar items. Information from other
                                                                                                                                                    properties (in particular, name) may be necessary for the description
                                                                                                                                                    to be useful for disambiguation. *} */
    public      $dissolutionDate                = null;             /* {*property   $dissolutionDate                (Date)                          The date that this organization was dissolved. *} */
    public      $diversityPolicy                = null;             /* {*property   $diversityPolicy                (CreativeWork|URL)              Statement on diversity policy by an Organization e.g. a
                                                                                                                                                    NewsMediaOrganization. For a NewsMediaOrganization, a statement
                                                                                                                                                    describing the newsroom’s diversity policy on both staffing and
                                                                                                                                                    sources, typically providing staffing data. *} */
    public      $diversityStaffingReport        = null;             /* {*property   $diversityStaffingReport        (Article|URL)                   For an Organization (often but not necessarily a
                                                                                                                                                    NewsMediaOrganization), a report on staffing diversity issues. In a
                                                                                                                                                    news context this might be for example ASNE or RTDNA (US) reports, or
                                                                                                                                                    self-reported. *} */
    public      $duns                           = null;             /* {*property   $duns                           (string)                        The Dun &amp; Bradstreet DUNS number for identifying an organization
                                                                                                                                                    or business person. *} */
    public      $email                          = null;             /* {*property   $email                          (string)                        Email address. *} */
    public      $employee                       = null;             /* {*property   $employee                       (Person)                        Someone working for this organization. *} */
    public      $employees                      = null;             /* {*property   $employees                      (Person)                        People working for this organization. *} */
    public      $ethicsPolicy                   = null;             /* {*property   $ethicsPolicy                   (URL|CreativeWork)              Statement about ethics policy, e.g. of a NewsMediaOrganization
                                                                                                                                                    regarding journalistic and publishing practices, or of a Restaurant, a
                                                                                                                                                    page describing food source policies. In the case of a
                                                                                                                                                    NewsMediaOrganization, an ethicsPolicy is typically a statement
                                                                                                                                                    describing the personal, organizational, and corporate standards of
                                                                                                                                                    behavior expected by the organization. *} */
    public      $event                          = null;             /* {*property   $event                          (Event)                         Upcoming or past event associated with this place, organization, or
                                                                                                                                                    action. *} */
    public      $events                         = null;             /* {*property   $events                         (Event)                         Upcoming or past events associated with this place or organization. *} */
    public      $faxNumber                      = null;             /* {*property   $faxNumber                      (string)                        The fax number. *} */
    public      $founder                        = null;             /* {*property   $founder                        (Person)                        A person who founded this organization. *} */
    public      $founders                       = null;             /* {*property   $founders                       (Person)                        A person who founded this organization. *} */
    public      $foundingDate                   = null;             /* {*property   $foundingDate                   (Date)                          The date that this organization was founded. *} */
    public      $foundingLocation               = null;             /* {*property   $foundingLocation               (Place)                         The place where the Organization was founded. *} */
    public      $funder                         = null;             /* {*property   $funder                         (Person|Organization)           A person or organization that supports (sponsors) something through
                                                                                                                                                    some kind of financial contribution. *} */
    public      $gender                         = null;             /* {*property   $gender                         (string|GenderType)             Gender of something, typically a Person, but possibly also fictional
                                                                                                                                                    characters, animals, etc. While http://schema.org/Male and
                                                                                                                                                    http://schema.org/Female may be used, text strings are also acceptable
                                                                                                                                                    for people who do not identify as a binary gender. The gender property
                                                                                                                                                    can also be used in an extended sense to cover e.g. the gender of
                                                                                                                                                    sports teams. As with the gender of individuals, we do not try to
                                                                                                                                                    enumerate all possibilities. A mixed-gender SportsTeam can be
                                                                                                                                                    indicated with a text value of "Mixed". *} */
    public      $globalLocationNumber           = null;             /* {*property   $globalLocationNumber           (string)                        The Global Location Number (GLN, sometimes also referred to as
                                                                                                                                                    International Location Number or ILN) of the respective organization,
                                                                                                                                                    person, or place. The GLN is a 13-digit number used to identify
                                                                                                                                                    parties and physical locations. *} */
    public      $hasCredential                  = null;             /* {*property   $hasCredential                  (EducationalOccupationalCredential)A credential awarded to the Person or Organization. *} */
    public      $hasMerchantReturnPolicy        = null;             /* {*property   $hasMerchantReturnPolicy        (MerchantReturnPolicy)          Indicates a MerchantReturnPolicy that may be applicable. *} */
    public      $hasOfferCatalog                = null;             /* {*property   $hasOfferCatalog                (OfferCatalog)                  Indicates an OfferCatalog listing for this Organization, Person, or
                                                                                                                                                    Service. *} */
    public      $hasPOS                         = null;             /* {*property   $hasPOS                         (Place)                         Points-of-Sales operated by the organization or person. *} */
    public      $identifier                     = null;             /* {*property   $identifier                     (URL|string|PropertyValue)      The identifier property represents any kind of identifier for any kind
                                                                                                                                                    of Thing, such as ISBNs, GTIN codes, UUIDs etc. Schema.org provides
                                                                                                                                                    dedicated properties for representing many of these, either as textual
                                                                                                                                                    strings or as URL (URI) links. See background notes for more details. *} */
    public      $image                          = null;             /* {*property   $image                          (ImageObject|URL)               An image of the item. This can be a URL or a fully described
                                                                                                                                                    ImageObject. *} */
    public      $interactionStatistic           = null;             /* {*property   $interactionStatistic           (InteractionCounter)            The number of interactions for the CreativeWork using the WebSite or
                                                                                                                                                    SoftwareApplication. The most specific child type of
                                                                                                                                                    InteractionCounter should be used. *} */
    public      $isicV4                         = null;             /* {*property   $isicV4                         (string)                        The International Standard of Industrial Classification of All
                                                                                                                                                    Economic Activities (ISIC), Revision 4 code for a particular
                                                                                                                                                    organization, business person, or place. *} */
    public      $knowsAbout                     = null;             /* {*property   $knowsAbout                     (URL|Thing|string)              Of a Person, and less typically of an Organization, to indicate a
                                                                                                                                                    topic that is known about - suggesting possible expertise but not
                                                                                                                                                    implying it. We do not distinguish skill levels here, or relate this
                                                                                                                                                    to educational content, events, objectives or JobPosting descriptions. *} */
    public      $knowsLanguage                  = null;             /* {*property   $knowsLanguage                  (Language|string)               Of a Person, and less typically of an Organization, to indicate a
                                                                                                                                                    known language. We do not distinguish skill levels or
                                                                                                                                                    reading/writing/speaking/signing here. Use language codes from the
                                                                                                                                                    IETF BCP 47 standard. *} */
    public      $legalName                      = null;             /* {*property   $legalName                      (string)                        The official name of the organization, e.g. the registered company
                                                                                                                                                    name. *} */
    public      $leiCode                        = null;             /* {*property   $leiCode                        (string)                        An organization identifier that uniquely identifies a legal entity as
                                                                                                                                                    defined in ISO 17442. *} */
    public      $location                       = null;             /* {*property   $location                       (string|PostalAddress|VirtualLocation|Place)The location of for example where the event is happening, an
                                                                                                                                                    organization is located, or where an action takes place. *} */
    public      $logo                           = null;             /* {*property   $logo                           (ImageObject|URL)               An associated logo. *} */
    public      $mainEntityOfPage               = null;             /* {*property   $mainEntityOfPage               (CreativeWork|URL)              Indicates a page (or other CreativeWork) for which this thing is the
                                                                                                                                                    main entity being described. See background notes for details. *} */
    public      $makesOffer                     = null;             /* {*property   $makesOffer                     (Offer)                         A pointer to products or services offered by the organization or
                                                                                                                                                    person. *} */
    public      $member                         = null;             /* {*property   $member                         (Organization|Person)           A member of an Organization or a ProgramMembership. Organizations can
                                                                                                                                                    be members of organizations; ProgramMembership is typically for
                                                                                                                                                    individuals. *} */
    public      $memberOf                       = null;             /* {*property   $memberOf                       (Organization|ProgramMembership)An Organization (or ProgramMembership) to which this Person or
                                                                                                                                                    Organization belongs. *} */
    public      $members                        = null;             /* {*property   $members                        (Person|Organization)           A member of this organization. *} */
    public      $naics                          = null;             /* {*property   $naics                          (string)                        The North American Industry Classification System (NAICS) code for a
                                                                                                                                                    particular organization or business person. *} */
    public      $name                           = null;             /* {*property   $name                           (string)                        The name of the item. *} */
    public      $nonprofitStatus                = null;             /* {*property   $nonprofitStatus                (NonprofitType)                 nonprofit Status indicates the legal status of a non-profit
                                                                                                                                                    organization in its primary place of business. *} */
    public      $numberOfEmployees              = null;             /* {*property   $numberOfEmployees              (QuantitativeValue)             The number of employees in an organization e.g. business. *} */
    public      $ownershipFundingInfo           = null;             /* {*property   $ownershipFundingInfo           (CreativeWork|AboutPage|URL|string)For an Organization (often but not necessarily a
                                                                                                                                                    NewsMediaOrganization), a description of organizational ownership
                                                                                                                                                    structure; funding and grants. In a news/media setting, this is with
                                                                                                                                                    particular reference to editorial independence. Note that the funder
                                                                                                                                                    is also available and can be used to make basic funder information
                                                                                                                                                    machine-readable. *} */
    public      $owns                           = null;             /* {*property   $owns                           (OwnershipInfo|Product)         Products owned by the organization or person. *} */
    public      $parentOrganization             = null;             /* {*property   $parentOrganization             (Organization)                  The larger organization that this organization is a subOrganization
                                                                                                                                                    of, if any. *} */
    public      $potentialAction                = null;             /* {*property   $potentialAction                (Action)                        Indicates a potential Action, which describes an idealized action in
                                                                                                                                                    which this thing would play an 'object' role. *} */
    public      $publishingPrinciples           = null;             /* {*property   $publishingPrinciples           (URL|CreativeWork)              The publishingPrinciples property indicates (typically via URL) a
                                                                                                                                                    document describing the editorial principles of an Organization (or
                                                                                                                                                    individual e.g. a Person writing a blog) that relate to their
                                                                                                                                                    activities as a publisher, e.g. ethics or diversity policies. When
                                                                                                                                                    applied to a CreativeWork (e.g. NewsArticle) the principles are those
                                                                                                                                                    of the party primarily responsible for the creation of the
                                                                                                                                                    CreativeWork.While such policies are most typically expressed in
                                                                                                                                                    natural language, sometimes related information (e.g. indicating a
                                                                                                                                                    funder) can be expressed using schema.org terminology. *} */
    public      $review                         = null;             /* {*property   $review                         (Review)                        A review of the item. *} */
    public      $reviews                        = null;             /* {*property   $reviews                        (Review)                        Review of the item. *} */
    public      $sameAs                         = null;             /* {*property   $sameAs                         (URL)                           URL of a reference Web page that unambiguously indicates the item's
                                                                                                                                                    identity. E.g. the URL of the item's Wikipedia page, Wikidata entry,
                                                                                                                                                    or official website. *} */
    public      $seeks                          = null;             /* {*property   $seeks                          (Demand)                        A pointer to products or services sought by the organization or person
                                                                                                                                                    (demand). *} */
    public      $serviceArea                    = null;             /* {*property   $serviceArea                    (AdministrativeArea|Place|GeoShape)The geographic area where the service is provided. *} */
    public      $slogan                         = null;             /* {*property   $slogan                         (string)                        A slogan or motto associated with the item. *} */
    public      $sponsor                        = null;             /* {*property   $sponsor                        (Person|Organization)           A person or organization that supports a thing through a pledge,
                                                                                                                                                    promise, or financial contribution. e.g. a sponsor of a Medical Study
                                                                                                                                                    or a corporate sponsor of an event. *} */
    public      $sport                          = null;             /* {*property   $sport                          (URL|string)                    A type of sport (e.g. Baseball). *} */
    public      $subOrganization                = null;             /* {*property   $subOrganization                (Organization)                  A relationship between two organizations where the first includes the
                                                                                                                                                    second, e.g., as a subsidiary. See also: the more specific
                                                                                                                                                    'department' property. *} */
    public      $subjectOf                      = null;             /* {*property   $subjectOf                      (Event|CreativeWork)            A CreativeWork or Event about this Thing. *} */
    public      $taxID                          = null;             /* {*property   $taxID                          (string)                        The Tax / Fiscal ID of the organization or person, e.g. the TIN in the
                                                                                                                                                    US or the CIF/NIF in Spain. *} */
    public      $telephone                      = null;             /* {*property   $telephone                      (string)                        The telephone number. *} */
    public      $unnamedSourcesPolicy           = null;             /* {*property   $unnamedSourcesPolicy           (CreativeWork|URL)              For an Organization (typically a NewsMediaOrganization), a statement
                                                                                                                                                    about policy on use of unnamed sources and the decision process
                                                                                                                                                    required. *} */
    public      $url                            = null;             /* {*property   $url                            (URL)                           URL of the item. *} */
    public      $vatID                          = null;             /* {*property   $vatID                          (string)                        The Value-added Tax ID of the organization or person. *} */


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
    }   /* End of SportsTeam.__construct() ========================================== */
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
    }   /* End of SportsTeam.__destruct() =========================================== */
    /* ================================================================================ */

}   /* End of class SportsTeam ====================================================== */
/* ==================================================================================== */

?>