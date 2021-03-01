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
    {*file                  trql.patient.class.php *}
    {*purpose               A patient is any person recipient of health care services. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 14:06 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 28-08-2020 14:06 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\patient;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\medicalaudience, person\MedicalAudience, Person    as MedicalAudience, Person;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'MEDICALAUDIENCE, PERSON_CLASS_VERSION' ) )
    require_once( 'trql.medicalaudience, person.class.php' );



defined( 'PATIENT_CLASS_VERSION' ) or define( 'PATIENT_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Patient=

    {*desc

        A patient is any person recipient of health care services.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Patient[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 14:06. IT HAS NOT BEEN TESTED YET!
    *}

 */
/* ==================================================================================== */
class Patient extends MedicalAudience, Person
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

    public      $additionalName                 = null;             /* {*property   $additionalName                 (string)                        An additional name for a Person, can be used for a middle name. *} */
    public      $additionalType                 = null;             /* {*property   $additionalType                 (URL)                           An additional type for the item, typically used for adding more
                                                                                                                                                    specific types from external vocabularies in microdata syntax. This is
                                                                                                                                                    a relationship between something and a class that the thing is in. In
                                                                                                                                                    RDFa syntax, it is better to use the native RDFa syntax - the 'typeof'
                                                                                                                                                    attribute - for multiple types. Schema.org tools may have only weaker
                                                                                                                                                    understanding of extra types, in particular those defined externally. *} */
    public      $address                        = null;             /* {*property   $address                        (PostalAddress|string)          Physical address of the item. *} */
    public      $affiliation                    = null;             /* {*property   $affiliation                    (Organization)                  An organization that this person is affiliated with. For example, a
                                                                                                                                                    school/university, a club, or a team. *} */
    public      $alternateName                  = null;             /* {*property   $alternateName                  (string)                        An alias for the item. *} */
    public      $alumniOf                       = null;             /* {*property   $alumniOf                       (EducationalOrganization|Organization)An organization that the person is an alumni of. *} */
    public      $audienceType                   = null;             /* {*property   $audienceType                   (string)                        The target group associated with a given audience (e.g. veterans, car
                                                                                                                                                    owners, musicians, etc.). *} */
    public      $award                          = null;             /* {*property   $award                          (string)                        An award won by or for this item. *} */
    public      $awards                         = null;             /* {*property   $awards                         (string)                        Awards won by or for this item. *} */
    public      $birthDate                      = null;             /* {*property   $birthDate                      (Date)                          Date of birth. *} */
    public      $birthPlace                     = null;             /* {*property   $birthPlace                     (Place)                         The place where the person was born. *} */
    public      $brand                          = null;             /* {*property   $brand                          (Brand|Organization)            The brand(s) associated with a product or service, or the brand(s)
                                                                                                                                                    maintained by an organization or business person. *} */
    public      $callSign                       = null;             /* {*property   $callSign                       (string)                        A callsign, as used in broadcasting and radio communications to
                                                                                                                                                    identify people, radio and TV stations, or vehicles. *} */
    public      $children                       = null;             /* {*property   $children                       (Person)                        A child of the person. *} */
    public      $colleague                      = null;             /* {*property   $colleague                      (URL|Person)                    A colleague of the person. *} */
    public      $colleagues                     = null;             /* {*property   $colleagues                     (Person)                        A colleague of the person. *} */
    public      $contactPoint                   = null;             /* {*property   $contactPoint                   (ContactPoint)                  A contact point for a person or organization. *} */
    public      $contactPoints                  = null;             /* {*property   $contactPoints                  (ContactPoint)                  A contact point for a person or organization. *} */
    public      $deathDate                      = null;             /* {*property   $deathDate                      (Date)                          Date of death. *} */
    public      $deathPlace                     = null;             /* {*property   $deathPlace                     (Place)                         The place where the person died. *} */
    public      $description                    = null;             /* {*property   $description                    (string)                        A description of the item. *} */
    public      $diagnosis                      = null;             /* {*property   $diagnosis                      (MedicalCondition)              One or more alternative conditions considered in the differential
                                                                                                                                                    diagnosis process as output of a diagnosis process. *} */
    public      $disambiguatingDescription      = null;             /* {*property   $disambiguatingDescription      (string)                        A sub property of description. A short description of the item used to
                                                                                                                                                    disambiguate from other, similar items. Information from other
                                                                                                                                                    properties (in particular, name) may be necessary for the description
                                                                                                                                                    to be useful for disambiguation. *} */
    public      $drug                           = null;             /* {*property   $drug                           (Drug)                          Specifying a drug or medicine used in a medication procedure *} */
    public      $duns                           = null;             /* {*property   $duns                           (string)                        The Dun &amp; Bradstreet DUNS number for identifying an organization
                                                                                                                                                    or business person. *} */
    public      $email                          = null;             /* {*property   $email                          (string)                        Email address. *} */
    public      $familyName                     = null;             /* {*property   $familyName                     (string)                        Family name. In the U.S., the last name of an Person. This can be used
                                                                                                                                                    along with givenName instead of the name property. *} */
    public      $faxNumber                      = null;             /* {*property   $faxNumber                      (string)                        The fax number. *} */
    public      $follows                        = null;             /* {*property   $follows                        (Person)                        The most generic uni-directional social relation. *} */
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
    public      $geographicArea                 = null;             /* {*property   $geographicArea                 (AdministrativeArea)            The geographic area associated with the audience. *} */
    public      $givenName                      = null;             /* {*property   $givenName                      (string)                        Given name. In the U.S., the first name of a Person. This can be used
                                                                                                                                                    along with familyName instead of the name property. *} */
    public      $globalLocationNumber           = null;             /* {*property   $globalLocationNumber           (string)                        The Global Location Number (GLN, sometimes also referred to as
                                                                                                                                                    International Location Number or ILN) of the respective organization,
                                                                                                                                                    person, or place. The GLN is a 13-digit number used to identify
                                                                                                                                                    parties and physical locations. *} */
    public      $hasCredential                  = null;             /* {*property   $hasCredential                  (EducationalOccupationalCredential)A credential awarded to the Person or Organization. *} */
    public      $hasOccupation                  = null;             /* {*property   $hasOccupation                  (Occupation)                    The Person's occupation. For past professions, use Role for expressing
                                                                                                                                                    dates. *} */
    public      $hasOfferCatalog                = null;             /* {*property   $hasOfferCatalog                (OfferCatalog)                  Indicates an OfferCatalog listing for this Organization, Person, or
                                                                                                                                                    Service. *} */
    public      $hasPOS                         = null;             /* {*property   $hasPOS                         (Place)                         Points-of-Sales operated by the organization or person. *} */
    public      $healthCondition                = null;             /* {*property   $healthCondition                (MedicalCondition)              Specifying the health condition(s) of a patient, medical study, or
                                                                                                                                                    other target audience. *} */
    public      $height                         = null;             /* {*property   $height                         (Distance|QuantitativeValue)    The height of the item. *} */
    public      $homeLocation                   = null;             /* {*property   $homeLocation                   (ContactPoint|Place)            A contact location for a person's residence. *} */
    public      $honorificPrefix                = null;             /* {*property   $honorificPrefix                (string)                        An honorific prefix preceding a Person's name such as Dr/Mrs/Mr. *} */
    public      $honorificSuffix                = null;             /* {*property   $honorificSuffix                (string)                        An honorific suffix preceding a Person's name such as M.D. /PhD/MSCSW. *} */
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
    public      $jobTitle                       = null;             /* {*property   $jobTitle                       (DefinedTerm|string)            The job title of the person (for example, Financial Manager). *} */
    public      $knows                          = null;             /* {*property   $knows                          (Person)                        The most generic bi-directional social/work relation. *} */
    public      $knowsAbout                     = null;             /* {*property   $knowsAbout                     (URL|Thing|string)              Of a Person, and less typically of an Organization, to indicate a
                                                                                                                                                    topic that is known about - suggesting possible expertise but not
                                                                                                                                                    implying it. We do not distinguish skill levels here, or relate this
                                                                                                                                                    to educational content, events, objectives or JobPosting descriptions. *} */
    public      $knowsLanguage                  = null;             /* {*property   $knowsLanguage                  (Language|string)               Of a Person, and less typically of an Organization, to indicate a
                                                                                                                                                    known language. We do not distinguish skill levels or
                                                                                                                                                    reading/writing/speaking/signing here. Use language codes from the
                                                                                                                                                    IETF BCP 47 standard. *} */
    public      $mainEntityOfPage               = null;             /* {*property   $mainEntityOfPage               (CreativeWork|URL)              Indicates a page (or other CreativeWork) for which this thing is the
                                                                                                                                                    main entity being described. See background notes for details. *} */
    public      $makesOffer                     = null;             /* {*property   $makesOffer                     (Offer)                         A pointer to products or services offered by the organization or
                                                                                                                                                    person. *} */
    public      $memberOf                       = null;             /* {*property   $memberOf                       (Organization|ProgramMembership)An Organization (or ProgramMembership) to which this Person or
                                                                                                                                                    Organization belongs. *} */
    public      $naics                          = null;             /* {*property   $naics                          (string)                        The North American Industry Classification System (NAICS) code for a
                                                                                                                                                    particular organization or business person. *} */
    public      $name                           = null;             /* {*property   $name                           (string)                        The name of the item. *} */
    public      $nationality                    = null;             /* {*property   $nationality                    (Country)                       Nationality of the person. *} */
    public      $netWorth                       = null;             /* {*property   $netWorth                       (PriceSpecification|MonetaryAmount)The total financial value of the person as calculated by subtracting
                                                                                                                                                    assets from liabilities. *} */
    public      $owns                           = null;             /* {*property   $owns                           (OwnershipInfo|Product)         Products owned by the organization or person. *} */
    public      $parent                         = null;             /* {*property   $parent                         (Person)                        A parent of this person. *} */
    public      $parents                        = null;             /* {*property   $parents                        (Person)                        A parents of the person. *} */
    public      $performerIn                    = null;             /* {*property   $performerIn                    (Event)                         Event that this person is a performer or participant in. *} */
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
    public      $relatedTo                      = null;             /* {*property   $relatedTo                      (Person)                        The most generic familial relation. *} */
    public      $requiredGender                 = null;             /* {*property   $requiredGender                 (string)                        Audiences defined by a person's gender. *} */
    public      $requiredMaxAge                 = null;             /* {*property   $requiredMaxAge                 (int)                           Audiences defined by a person's maximum age. *} */
    public      $requiredMinAge                 = null;             /* {*property   $requiredMinAge                 (int)                           Audiences defined by a person's minimum age. *} */
    public      $sameAs                         = null;             /* {*property   $sameAs                         (URL)                           URL of a reference Web page that unambiguously indicates the item's
                                                                                                                                                    identity. E.g. the URL of the item's Wikipedia page, Wikidata entry,
                                                                                                                                                    or official website. *} */
    public      $seeks                          = null;             /* {*property   $seeks                          (Demand)                        A pointer to products or services sought by the organization or person
                                                                                                                                                    (demand). *} */
    public      $sibling                        = null;             /* {*property   $sibling                        (Person)                        A sibling of the person. *} */
    public      $siblings                       = null;             /* {*property   $siblings                       (Person)                        A sibling of the person. *} */
    public      $sponsor                        = null;             /* {*property   $sponsor                        (Person|Organization)           A person or organization that supports a thing through a pledge,
                                                                                                                                                    promise, or financial contribution. e.g. a sponsor of a Medical Study
                                                                                                                                                    or a corporate sponsor of an event. *} */
    public      $spouse                         = null;             /* {*property   $spouse                         (Person)                        The person's spouse. *} */
    public      $subjectOf                      = null;             /* {*property   $subjectOf                      (Event|CreativeWork)            A CreativeWork or Event about this Thing. *} */
    public      $suggestedGender                = null;             /* {*property   $suggestedGender                (string)                        The gender of the person or audience. *} */
    public      $suggestedMaxAge                = null;             /* {*property   $suggestedMaxAge                (float)                         Maximal age recommended for viewing content. *} */
    public      $suggestedMinAge                = null;             /* {*property   $suggestedMinAge                (float)                         Minimal age recommended for viewing content. *} */
    public      $taxID                          = null;             /* {*property   $taxID                          (string)                        The Tax / Fiscal ID of the organization or person, e.g. the TIN in the
                                                                                                                                                    US or the CIF/NIF in Spain. *} */
    public      $telephone                      = null;             /* {*property   $telephone                      (string)                        The telephone number. *} */
    public      $url                            = null;             /* {*property   $url                            (URL)                           URL of the item. *} */
    public      $vatID                          = null;             /* {*property   $vatID                          (string)                        The Value-added Tax ID of the organization or person. *} */
    public      $weight                         = null;             /* {*property   $weight                         (QuantitativeValue)             The weight of the product or person. *} */
    public      $workLocation                   = null;             /* {*property   $workLocation                   (Place|ContactPoint)            A contact location for a person's place of work. *} */
    public      $worksFor                       = null;             /* {*property   $worksFor                       (Organization)                  Organizations that the person works for. *} */


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
    }   /* End of Patient.__construct() ========================================== */
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
    }   /* End of Patient.__destruct() =========================================== */
    /* ================================================================================ */

}   /* End of class Patient ====================================================== */
/* ==================================================================================== */

?>