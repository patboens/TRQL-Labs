<?php
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

/****************************************************************************************/
/** {{{*fheader
    {*file                  trql.personororganization.class.php *}
    {*purpose               A combination of Person and Organization *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 14:09 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 31-07-20 16:21 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\organization;

use \trql\mother\iContext           as iContext;
use \trql\vaesoli\Vaesoli           as Vaesoli;
use \trql\organization\Organization as Organization;
use \trql\thing\Thing               as Thing;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'ORGANIZATION_CLASS_VERSION' ) )
    require_once( 'trql.organization.class.php' );

defined( 'PERSONORORGANIZATION_CLASS_VERSION' ) or define( 'PERSONORORGANIZATION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class PersonOrOrganization=

    {*desc

        Abstract class to mention a Person or an Organization

    *}

    {*todo
        Weird error : Organization seems to be unknown!!!
    *}

    *}}
 */
/* ==================================================================================== */
class PersonOrOrganization extends Thing
/*------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                                     Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    /* These properties are extracted from Organization ============================================================================================================================================================ */
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


    /* These properties are extracted from Person ================================================================================================================================================================== */
    public  $additionalName             = null;                     /* {*property   $additionalName             (string)                                    An additional name for a Person, can be used for
                                                                                                                                                            a middle name. *} */
    public  $affiliation                = null;                     /* {*property   $affiliation                (Organization)                              An organization that this person is affiliated
                                                                                                                                                            with. For example, a school/university, a club,
                                                                                                                                                            or a team. *} */
    public  $alumniOf                   = null;                     /* {*property   $alumniOf                   (EducationalOrganization|Organization)      An organization that the person is an alumni of.
                                                                                                                                                            Inverse property: alumni. *} */
    public  $birthDate                  = null;                     /* {*property   $birthDate                  (Date)                                      Date of birth. *} */
    public  $birthPlace                 = null;                     /* {*property   $birthPlace                 (Place)                                     The place where the person was born. *} */
    public  $children                   = null;                     /* {*property   $children                   (Person)                                    A child of the person. *} */
    public  $colleague                  = null;                     /* {*property   $colleague                  (Person|URL)                                A colleague of the person. Supersedes colleagues. *} */
    public  $deathDate                  = null;                     /* {*property   $deathDate                  (Date)                                      Date of death. *} */
    public  $deathPlace                 = null;                     /* {*property   $deathPlace                 (Place)                                     The place where the person died. *} */
    public  $familyName                 = null;                     /* {*property   $familyName                 (string)                                    Family name. In the U.S., the last name of an Person. This can
                                                                                                                                                            be used along with givenName instead of the name property. *} */
    public  $follows                    = null;                     /* {*property   $follows                    (Person                                     The most generic uni-directional social relation. *} */
    public  $gender                     = null;                     /* {*property   $gender                     (GenderType|string)                         Gender of the person. While http://schema.org/Male and
                                                                                                                                                            http://schema.org/Female may be used, text strings are
                                                                                                                                                            also acceptable for people who do not identify as a
                                                                                                                                                            binary gender. *} */
    public  $givenName                  = null;                     /* {*property   $givenName                  (string)                                    Given name. In the U.S., the first name of a Person. This can
                                                                                                                                                            be used along with familyName instead of the name property. *} */
    public  $hasOccupation              = null;                     /* {*property   $hasOccupation              (Occupation)                                The Person's occupation. For past professions, use Role for expressing dates. *} */
    public  $height                     = null;                     /* {*property   $height                     (Distance|QuantitativeValue)                The height of the item. *} */
    public  $homeLocation               = null;                     /* {*property   $homeLocation               (ContactPoint|Place)                        A contact location for a person's residence. *} */
    public  $honorificPrefix            = null;                     /* {*property   $honorificPrefix            (string)                                    An honorific prefix preceding a Person's name such as Dr/Mrs/Mr. *} */
    public  $honorificSuffix            = null;                     /* {*property   $honorificSuffix            (string)                                    An honorific suffix preceding a Person's name such as M.D. /PhD/MSCSW. *} */
    public  $jobTitle                   = null;                     /* {*property   $jobTitle                   (DefinedTerm|string)                        The job title of the person (for example, Financial Manager). *} */
    public  $knows                      = null;                     /* {*property   $knows                      (Person)                                    The most generic bi-directional social/work relation. *} */
    public  $nationality                = null;                     /* {*property   $nationality                (Country)                                   Nationality of the person. *} */
    public  $netWorth                   = null;                     /* {*property   $netWorth                   (MonetaryAmount|PriceSpecification)         The total financial value of the person as calculated by subtracting
                                                                                                                                                            assets from liabilities. *} */
    public  $parent                     = null;                     /* {*property   $parent                     (Person)                                    A parent of this person. Supersedes parents. *} */
    public  $performerIn                = null;                     /* {*property   $performerIn                (Event)                                     Event that this person is a performer or participant in. *} */
    public  $relatedTo                  = null;                     /* {*property   $relatedTo                  (Person)                                    The most generic familial relation. *} */
    public  $sibling                    = null;                     /* {*property   $sibling                    (Person)                                    A sibling of the person. Supersedes siblings. *} */
    public  $spouse                     = null;                     /* {*property   $spouse                     (Person)                                    The person's spouse. *} */
    public  $weight                     = null;                     /* {*property   $weight                     (QuantitativeValue)                         The weight of the product or person. *} */
    public  $workLocation               = null;                     /* {*property   $workLocation               (ContactPoint|Place)                        A contact location for a person's place of work. *} */
    public  $worksFor                   = null;                     /* {*property   $worksFor                   (Organization)                              Organizations that the person works for. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;

}   /* End of class PersonOrOrganization ============================================== */
/* ==================================================================================== */
