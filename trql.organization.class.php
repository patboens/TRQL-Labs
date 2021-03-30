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
    {*file                  trql.organization.class.php *}
    {*purpose               An organization such as a school, NGO, corporation, club,
                            etc. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 29-07-20 11:51 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 29-07-20 11:51 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation.
        *}
    *}

    {*chist
        {*mdate 14-02-21 08:55 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\organization;

use \trql\quitus\Mother                 as Mother;
use \trql\quitus\iContext               as iContext;
use \trql\context\Context               as Context;
use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\schema\Thing                   as Thing;
use \trql\postaladdress\PostalAddress   as PostalAddress;
use \trql\bankaccount\BankAccount       as BankAccount;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'THING_CLASS_VERSION' ) )
    require_once( 'trql.thing.class.php' );

if ( ! defined( 'POSTALADDRESS_CLASS_VERSION' ) )
    require_once( 'trql.postaladdress.class.php' );

if ( ! defined( 'BANKACCOUNT_CLASS_VERSION' ) )
    require_once( 'trql.bankaccount.class.php' );

defined( 'ORGANIZATION_CLASS_VERSION' ) or define( 'ORGANIZATION_CLASS_VERSION','0.1' );

/* ================================================================================== */
/** {{*class Organization=

    {*desc

        An organization such as a school, NGO, corporation, club, etc.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/Organization[/url] *}

    *}}
 */
/* ================================================================================== */
class Organization extends Thing implements iContext
/*------------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                                     Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    protected   $schemaOrg  = 'http://schema.org/Organization';     /* {*property   $schemaOrg                  (string)                                    Where the official documentation is maintained *} */
    public      $actionableFeedbackPolicy   = null;                 /* {*property   $actionableFeedbackPolicy   (CreativeWork|URL)                          For a NewsMediaOrganization or other news-related Organization, a
                                                                                                                                                            statement about public engagement activities (for news media, the
                                                                                                                                                            newsroom’s), including involving the public - digitally or
                                                                                                                                                            otherwise -- in coverage decisions, reporting and activities
                                                                                                                                                            after publication. *} */
    public      $address                    = null;                 /* {*property   $address                    (PostalAddress)                             Physical address of the item. *} */
    public      $aggregateRating            = null;                 /* {*property   $aggregateRating            (AggregateRating)                           The overall rating, based on a collection of reviews or ratings, of the item. *} */
    public      $alumni                     = null;                 /* {*property   $alumni                     (Person)                                    Alumni of an organization. Inverse property: alumniOf. *} */
    public      $areaServed                 = null;                 /* {*property   $areaServed                 (AdministrativeArea|GeoShape|Place|string)  The geographic area where a service or offered item is provided.
                                                                                                                                                            Supersedes serviceArea. *} */
    public      $award                      = null;                 /* {*property   $award                      (string)                                    An award won by or for this item. Supersedes awards. *} */
    public      $brand                      = null;                 /* {*property   $brand                      (Brand|Organization)                        The brand(s) associated with a product or service, or the brand(s)
                                                                                                                                                            maintained by an organization or business person. *} */
    public      $contactPoint               = null;                 /* {*property   $contactPoint               (ContactPoint)                              A contact point for a person or organization. Supersedes contactPoints. *} */
    public      $correctionsPolicy          = null;                 /* {*property   $correctionsPolicy          (CreativeWork|URL)                          For an [c]Organization[/c] (e.g. @class.NewsMediaOrganization), a statement describing
                                                                                                                                                            (in news media, the newsroom’s) disclosure and correction policy for errors. *} */
    public      $department                 = null;                 /* {*property   $department                 (Organization)                              A relationship between an organization and a department of that
                                                                                                                                                            organization, also described as an organization (allowing different
                                                                                                                                                            urls, logos, opening hours). For example: a store with a pharmacy, or
                                                                                                                                                            a bakery with a cafe. *} */
    public      $dissolutionDate            = null;                 /* {*property   $dissolutionDate            (Date)                                      The date that this organization was dissolved. *} */
    public      $diversityPolicy            = null;                 /* {*property   $diversityPolicy            (CreativeWork|URL)                          Statement on diversity policy by an Organization
                                                                                                                                                            e.g. a NewsMediaOrganization. For a NewsMediaOrganization, a statement
                                                                                                                                                            describing the newsroom’s diversity policy on both staffing and sources,
                                                                                                                                                            typically providing staffing data. *} */
    public      $diversityStaffingReport    = null;                 /* {*property   $diversityStaffingReport    (Article|URL)                               For an [c]Organization[/c] (often but not necessarily a NewsMediaOrganization),
                                                                                                                                                            a report on staffing diversity issues. In a news context this might be
                                                                                                                                                            for example ASNE or RTDNA (US) reports, or self-reported. *} */
    public      $duns                       = null;                 /* {*property   $duns                       (string)                                    The Dun & Bradstreet DUNS number for identifying an organization or
                                                                                                                                                            business person. *} */
    public      $email                      = null;                 /* {*property   $email                      (string)                                    Email address. *} */
    public      $employee                   = null;                 /* {*property   $employee                   (Person)                                    Someone working for this organization. Supersedes employees. *} */
    public      $ethicsPolicy               = null;                 /* {*property   $ethicsPolicy               (CreativeWork|URL)                          Statement about ethics policy, e.g. of a NewsMediaOrganization regarding
                                                                                                                                                            journalistic and publishing practices, or of a Restaurant, a page describing
                                                                                                                                                            food source policies. In the case of a NewsMediaOrganization, an ethicsPolicy
                                                                                                                                                            is typically a statement describing the personal, organizational, and
                                                                                                                                                            corporate standards of behavior expected by the organization. *} */
    public      $event                      = null;                 /* {*property   $event                      (Event)                                     Upcoming or past event associated with this place, organization, or action.
                                                                                                                                                            Supersedes events. *} */
    public      $faxNumber                  = null;                 /* {*property   $faxNumber                  (string)                                    The fax number. *} */
    public      $founder                    = null;                 /* {*property   $founder                    (Person)                                    A person who founded this organization. Supersedes founders. *} */
    public      $foundingDate               = null;                 /* {*property   $foundingDate               (Date)                                      The date that this organization was founded. *} */
    public      $foundingLocation           = null;                 /* {*property   $foundingLocation           (Place)                                     The place where the [c]Organization[/c] was founded. *} */
    public      $funder                     = null;                 /* {*property   $funder                     (Organization|Person)                       A person or organization that supports (sponsors) something through some kind
                                                                                                                                                            of financial contribution. *} */
    public      $globalLocationNumber       = null;                 /* {*property   $globalLocationNumber       (string)                                    The Global Location Number (GLN, sometimes also referred to as
                                                                                                                                                            International Location Number or ILN) of the respective organization,
                                                                                                                                                            person, or place. The GLN is a 13-digit number used to identify
                                                                                                                                                            parties and physical locations. *} */
    public      $hasCredential              = null;                 /* {*property   $hasCredential              (EducationalOccupationalCredential)         A credential awarded to the Person or Organization. *} */
    public      $hasOfferCatalog            = null;                 /* {*property   $hasOfferCatalog            (OfferCatalog)                              Indicates an OfferCatalog listing for this Organization, Person, or Service. *} */
    public      $hasPOS                     = null;                 /* {*property   $hasPOS                     (Place)                                     Points-of-Sales operated by the organization or person. *} */
    public      $hasProductReturnPolicy     = null;                 /* {*property   $hasProductReturnPolicy     (ProductReturnPolicy)                       Indicates a ProductReturnPolicy that may be applicable. *} */
    public      $isicV4                     = null;                 /* {*property   $isicV4                     (string)                                    The International Standard of Industrial Classification of All Economic
                                                                                                                                                            Activities (ISIC), Revision 4 code for a particular organization, business
                                                                                                                                                            person, or place. *} */
    public      $knowsAbout                 = null;                 /* {*property   $knowsAbout                 (string|Thing|URL)                          Of a Person, and less typically of an Organization, to indicate a topic
                                                                                                                                                            that is known about - suggesting possible expertise but not implying it.
                                                                                                                                                            We do not distinguish skill levels here, or relate this to educational
                                                                                                                                                            content, events, objectives or JobPosting descriptions. *} */
    public      $knowsLanguage              = null;                 /* {*property   $knowsLanguage              (Language|string)                           Of a Person, and less typically of an Organization, to indicate a known
                                                                                                                                                            language. We do not distinguish skill levels or
                                                                                                                                                            reading/writing/speaking/signing here. Use language codes from the
                                                                                                                                                            IETF BCP 47 standard. *} */
    public      $legalName                  = null;                 /* {*property   $legalName                  (string)                                    The official name of the organization, e.g. the registered company name. *} */
    public      $leiCode                    = null;                 /* {*property   $leiCode                    (string)                                    An organization identifier that uniquely identifies a legal entity as
                                                                                                                                                            defined in ISO 17442. *} */
    public      $location                   = null;                 /* {*property   $location                   (Place|PostalAddress|string)                The location of for example where the event is happening, an organization
                                                                                                                                                            is located, or where an action takes place. *} */
    public      $logo                       = null;                 /* {*property   $logo                       (ImageObject|URL)                           An associated logo. *} */
    public      $makesOffer                 = null;                 /* {*property   $makesOffer                 (Offer)                                     A pointer to products or services offered by the organization or person.
                                                                                                                                                            Inverse property: offeredBy. *} */
    public      $member                     = null;                 /* {*property   $member                     (Organization|Person)                       A member of an [c]Organization[/c] or a ProgramMembership. Organizations can be
                                                                                                                                                            members of organizations; ProgramMembership is typically for individuals.
                                                                                                                                                            Supersedes members, musicGroupMember. Inverse property: memberOf. *} */
    public      $memberOf                   = null;                 /* {*property   $memberOf                   (Organization|ProgramMembership)            An [c]Organization[/c] (or ProgramMembership) to which this Person or Organization
                                                                                                                                                            belongs. Inverse property: member. *} */
    public      $naics                      = null;                 /* {*property   $naics                      (string)                                    The North American Industry Classification System (NAICS) code for a
                                                                                                                                                            particular organization or business person. *} */
    public      $nonprofitStatus            = null;                 /* {*property   $nonprofitStatus            (NonprofitType)                             nonprofit Status indicates the legal status of a non-profit organization
                                                                                                                                                            in its primary place of business. *} */
    public      $numberOfEmployees          = null;                 /* {*property   $numberOfEmployees          (QuantitativeValue)                         The number of employees in an organization e.g. business. *} */
    public      $ownershipFundingInfo       = null;                 /* {*property   $ownershipFundingInfo       (AboutPage|CreativeWork|string|URL)         For an [c]Organization[/c] (often but not necessarily a NewsMediaOrganization),
                                                                                                                                                            a description of organizational ownership structure; funding and grants.
                                                                                                                                                            In a news/media setting, this is with particular reference to editorial
                                                                                                                                                            independence. Note that the funder is also available and can be used to
                                                                                                                                                            make basic funder information machine-readable. *} */
    public      $owns                       = null;                 /* {*property   $owns                       (OwnershipInfo|Product)                     Products owned by the organization or person. *} */
    public      $parentOrganization         = null;                 /* {*property   $parentOrganization         (Organization)                              The larger organization that this organization is a subOrganization of,
                                                                                                                                                            if any. Supersedes branchOf. Inverse property: subOrganization. *} */
    public      $publishingPrinciples       = null;                 /* {*property   $publishingPrinciples       (CreativeWork|URL)                          The publishingPrinciples property indicates (typically via URL) a
                                                                                                                                                            document describing the editorial principles of an Organization
                                                                                                                                                            (or individual e.g. a Person writing a blog) that relate to their
                                                                                                                                                            activities as a publisher, e.g. ethics or diversity policies. When
                                                                                                                                                            applied to a CreativeWork (e.g. NewsArticle) the principles are those
                                                                                                                                                            of the party primarily responsible for the creation of the CreativeWork.

                                                                                                                                                            While such policies are most typically expressed in natural language,
                                                                                                                                                            sometimes related information (e.g. indicating a funder) can be
                                                                                                                                                            expressed using schema.org terminology. *} */

    public      $review                     = null;                 /* {*propert    $review                     (Review)                                    A review of the item. Supersedes reviews. *} */
    public      $seeks                      = null;                 /* {*propert    $seeks                      (Demand)                                    A pointer to products or services sought by the organization or person (demand). *} */
    public      $slogan                     = null;                 /* {*propert    $slogan                     (string)                                    A slogan or motto associated with the item. *} */
    public      $sponsor                    = null;                 /* {*propert    $sponsor                    (Organization|Person)                       A person or organization that supports a thing through a pledge,
                                                                                                                                                            promise, or financial contribution. e.g. a sponsor of a Medical Study
                                                                                                                                                            or a corporate sponsor of an event. *} */
    public      $subOrganization            = null;                 /* {*propert    $subOrganization            (Organization)                              A relationship between two organizations where the first includes the second,
                                                                                                                                                            e.g., as a subsidiary. See also: the more specific 'department'
                                                                                                                                                            property. Inverse property: parentOrganization. *} */
    public      $taxID                      = null;                 /* {*propert    $taxID                      (string)                                    The Tax / Fiscal ID of the organization or person, e.g. the TIN in the
                                                                                                                                                            US or the CIF/NIF in Spain, or the NISS in Belgium for individuals, or the
                                                                                                                                                            Registre de commerce/Handelregister *} */
    public      $telephone                  = null;                 /* {*propert    $telephone                  (string)                                    The telephone number. *} */
    public      $unnamedSourcesPolicy       = null;                 /* {*propert    $unnamedSourcesPolicy       (CreativeWork|URL)                          For an [c]Organization[/c] (typically a NewsMediaOrganization), a statement
                                                                                                                                                            about policy on use of unnamed sources and the decision process required. *} */
    public      $vatID                      = null;                 /* {*propert    $vatID                      (string)                                    The Value-added Tax ID of the organization or person. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                 = 'Q43229';             /* {*property   $wikidataId                 (string)                                    Wikidata ID. Social entity (not necessarily commercial) uniting people
                                                                                                                                                            into a structured group managing shared means to meet some needs, or to
                                                                                                                                                            pursue collective goals *} */
    public      $bankAccount                = null;                 /* {*property   $bankAccount                (BankAccount)                               The BankAccount of the organization *} */
    public      $legalForm                  = null;                 /* {*property   $legalForm                  (string)                                    The acronym of the legal form of the organization. *} */

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

        $this->address      = new PostalAddress();
        $this->bankAccount  = new BankAccount();

        return ( $this );
    }   /* End of Organization.__construct() ========================================== */
    /* ================================================================================ */


    public function templates( $oContext = null )
    /*-----------------------------------------*/
    {
        $aRetVal = null;

        echo __LINE__," ... " . __METHOD__ . "() : SHOULD RETURN TEMPLATES\n";
        $this->die();

        return ( $aRetVal );
    }   /* End of Organization.templates() ============================================ */
    /* ================================================================================ */


    public function substitutions( $oContext = null )
    /*---------------------------------------------*/
    {
        $aRetVal = null;

        echo __LINE__," ... " . __METHOD__ . "() : SHOULD RETURN SUBSTITUTIONS\n";
        die();

        return ( $aRetVal );
    }   /* End of Organization.substitutions() ======================================== */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of Organization.speak() ================================================ */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of Organization.sing() ================================================= */
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
    }   /* End of Organization.__destruct() =========================================== */
    /* ================================================================================ */
}   /* End of class Organization ====================================================== */
/* ==================================================================================== */
