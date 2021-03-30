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
    {*file                  trql.person.class.php *}
    {*purpose               A person (alive, dead, undead, or fictional). *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 31-07-20 16:21 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

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

    *}}}
*/
/****************************************************************************************/
namespace trql\person;

use \trql\quitus\Mother         as Mother;
use \trql\quitus\iContext       as iContext;
use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\utility\Utility       as Utility;
use \trql\schema\Thing           as Thing;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'THING_CLASS_VERSION' ) )
    require_once( 'trql.thing.class.php' );

defined( 'PERSON_CLASS_VERSION' ) or define( 'PERSON_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Person=

    {*desc

        A person (alive, dead, undead, or fictional).

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Person[/url] *}

    *}}
 
 */
/* ==================================================================================== */
class Person extends Thing implements iContext
/*------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                                     Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );
    protected   $schemaOrg              = 'http://schema.org/Person'; /* {*property $schemaOrg                  (string)                                    Where the official documentation is maintained *} */
    public      $additionalName         = null;                     /* {*property   $additionalName             (string)                                    An additional name for a Person, can be used for
                                                                                                                                                            a middle name. *} */
    public      $address                = null;                     /* {*property   $address                    (PostalAddress|string)                      Physical address of the item. *} */
    public      $affiliation            = null;                     /* {*property   $affiliation                (Organization)                              An organization that this person is affiliated
                                                                                                                                                            with. For example, a school/university, a club,
                                                                                                                                                            or a team. *} */
    public      $alumniOf               = null;                     /* {*property   $alumniOf                   (EducationalOrganization|Organization)      An organization that the person is an alumni of.
                                                                                                                                                            Inverse property: alumni. *} */
    public      $award                  = null;                     /* {*property   $award                      (string)                                    An award won by or for this item. Supersedes awards. *} */
    public      $birthDate              = null;                     /* {*property   $birthDate                  (Date)                                      Date of birth. *} */
    public      $birthPlace             = null;                     /* {*property   $birthPlace                 (Place)                                     The place where the person was born. *} */
    public      $brand                  = null;                     /* {*property   $brand                      (Brand|Organization)                        The brand(s) associated with a product or service,
                                                                                                                                                            or the brand(s) maintained by an organization
                                                                                                                                                            or business person. *} */
    public      $children               = null;                     /* {*property   $children                   (Person)                                    A child of the person. *} */
    public      $colleague              = null;                     /* {*property   $colleague                  (Person|URL)                                A colleague of the person. Supersedes colleagues. *} */
    public      $contactPoint           = null;                     /* {*property   $contactPoint               (ContactPoint)                              A contact point for a person or organization.
                                                                                                                                                            Supersedes contactPoints. *} */
    public      $deathDate              = null;                     /* {*property   $deathDate                  (Date)                                      Date of death. *} */
    public      $deathPlace             = null;                     /* {*property   $deathPlace                 (Place)                                     The place where the person died. *} */
    public      $duns                   = null;                     /* {*property   $duns                       (string)                                    The Dun & Bradstreet DUNS number for identifying an
                                                                                                                                                            organization or business person. *} */
    public      $email                  = null;                     /* {*property   $email                      (string)                                    Email address. *} */
    public      $familyName             = null;                     /* {*property   $familyName                 (string)                                    Family name. In the U.S., the last name of an Person. This can
                                                                                                                                                            be used along with givenName instead of the name property. *} */
    public      $faxNumber              = null;                     /* {*property   $faxNumber                  (string)                                    The fax number. *} */
    public      $follows                = null;                     /* {*property   $follows                    (Person                                     The most generic uni-directional social relation. *} */
    public      $funder                 = null;                     /* {*property   $funder                     (Organization|Person)                       A person or organization that supports (sponsors) something
                                                                                                                                                            through some kind of financial contribution. *} */
    public      $gender                 = null;                     /* {*property   $gender                     (GenderType|string)                         Gender of the person. While http://schema.org/Male and
                                                                                                                                                            http://schema.org/Female may be used, text strings are
                                                                                                                                                            also acceptable for people who do not identify as a
                                                                                                                                                            binary gender. *} */
    public      $givenName              = null;                     /* {*property   $givenName                  (string)                                    Given name. In the U.S., the first name of a Person. This can
                                                                                                                                                            be used along with familyName instead of the name property. *} */
    public      $globalLocationNumber   = null;                     /* {*property   $globalLocationNumber       (string)                                    The Global Location Number (GLN, sometimes also referred to as
                                                                                                                                                            International Location Number or ILN) of the respective
                                                                                                                                                            organization, person, or place. The GLN is a 13-digit number
                                                                                                                                                            used to identify parties and physical locations. *} */
    public      $hasCredential          = null;                     /* {*property   $hasCredential              (EducationalOccupationalCredential)         A credential awarded to the Person or Organization. *} */
    public      $hasOccupation          = null;                     /* {*property   $hasOccupation              (Occupation)                                The Person's occupation. For past professions, use Role for expressing dates. *} */
    public      $hasOfferCatalog        = null;                     /* {*property   $hasOfferCatalog            (OfferCatalog)                              Indicates an OfferCatalog listing for this Organization, Person, or Service. *} */
    public      $hasPOS                 = null;                     /* {*property   $hasPOS                     (Place)                                     Points-of-Sales operated by the organization or person. *} */
    public      $height                 = null;                     /* {*property   $height                     (Distance|QuantitativeValue)                The height of the item. *} */
    public      $homeLocation           = null;                     /* {*property   $homeLocation               (ContactPoint|Place)                        A contact location for a person's residence. *} */
    public      $honorificPrefix        = null;                     /* {*property   $honorificPrefix            (string)                                    An honorific prefix preceding a Person's name such as Dr/Mrs/Mr. *} */
    public      $honorificSuffix        = null;                     /* {*property   $honorificSuffix            (string)                                    An honorific suffix preceding a Person's name such as M.D. /PhD/MSCSW. *} */
    public      $isicV4                 = null;                     /* {*property   $isicV4                     (string)                                    The International Standard of Industrial Classification of All Economic
                                                                                                                                                            Activities (ISIC), Revision 4 code for a particular organization,
                                                                                                                                                            business person, or place. *} */
    public      $jobTitle               = null;                     /* {*property   $jobTitle                   (DefinedTerm|string)                        The job title of the person (for example, Financial Manager). *} */
    public      $knows                  = null;                     /* {*property   $knows                      (Person)                                    The most generic bi-directional social/work relation. *} */
    public      $knowsAbout             = null;                     /* {*property   $knowsAbout                 (string|Thing|URL)                          Of a Person, and less typically of an Organization, to indicate a topic
                                                                                                                                                            that is known about - suggesting possible expertise but not implying it.
                                                                                                                                                            We do not distinguish skill levels here, or relate this to educational
                                                                                                                                                            content, events, objectives or JobPosting descriptions. *} */
    public      $knowsLanguage          = null;                     /* {*property   $knowsLanguage              (Language|string)                           Of a Person, and less typically of an Organization, to indicate a known
                                                                                                                                                            language. We do not distinguish skill levels or
                                                                                                                                                            reading/writing/speaking/signing here. Use language codes from the
                                                                                                                                                            IETF BCP 47 standard. *} */
    public      $makesOffer             = null;                     /* {*property   $makesOffer                 (Offer)                                     A pointer to products or services offered by the organization or person.
                                                                                                                                                            Inverse property: offeredBy *} */
    public      $memberOf               = null;                     /* {*property   $memberOf                   (Organization|ProgramMembership)            An Organization (or ProgramMembership) to which this Person or
                                                                                                                                                            Organization belongs. Inverse property: member. *} */
    public      $naics                  = null;                     /* {*property   $naics                      (string)                                    The North American Industry Classification System (NAICS) code for a
                                                                                                                                                            particular organization or business person. *} */
    public      $nationality            = null;                     /* {*property   $nationality                (Country)                                   Nationality of the person. *} */
    public      $netWorth               = null;                     /* {*property   $netWorth                   (MonetaryAmount|PriceSpecification)         The total financial value of the person as calculated by subtracting
                                                                                                                                                            assets from liabilities. *} */
    public      $owns                   = null;                     /* {*property   $owns                       (OwnershipInfo|Product)                     Products owned by the organization or person. *} */
    public      $parent                 = null;                     /* {*property   $parent                     (Person)                                    A parent of this person. Supersedes parents. *} */
    public      $performerIn            = null;                     /* {*property   $performerIn                (Event)                                     Event that this person is a performer or participant in. *} */
    public      $publishingPrinciples   = null;                     /* {*property   $publishingPrinciples       (CreativeWork|URL)                          The publishingPrinciples property indicates (typically via URL) a
                                                                                                                                                            document describing the editorial principles of an Organization
                                                                                                                                                            (or individual e.g. a Person writing a blog) that relate to their
                                                                                                                                                            activities as a publisher, e.g. ethics or diversity policies. When
                                                                                                                                                            applied to a CreativeWork (e.g. NewsArticle) the principles are those
                                                                                                                                                            of the party primarily responsible for the creation of the CreativeWork.
                
                                                                                                                                                            While such policies are most typically expressed in natural
                                                                                                                                                            language, sometimes related information (e.g. indicating a
                                                                                                                                                            funder) can be expressed using schema.org terminology. *} */
                
    public      $relatedTo              = null;                     /* {*property   $relatedTo                  (Person)                                    The most generic familial relation. *} */
    public      $seeks                  = null;                     /* {*property   $seeks                      (Demand)                                    A pointer to products or services sought by the organization or person (demand). *} */
    public      $sibling                = null;                     /* {*property   $sibling                    (Person)                                    A sibling of the person. Supersedes siblings. *} */
    public      $sponsor                = null;                     /* {*property   $sponsor                    (Organization|Person)                       A person or organization that supports a thing through a pledge, promise,
                                                                                                                                                            or financial contribution. e.g. a sponsor of a Medical Study or a
                                                                                                                                                            corporate sponsor of an event. *} */
    public      $spouse                 = null;                     /* {*property   $spouse                     (Person)                                    The person's spouse. *} */
    public      $taxID                  = null;                     /* {*property   $taxID                      (string)                                    The Tax / Fiscal ID of the organization or person, e.g. the TIN
                                                                                                                                                            in the US or the CIF/NIF in Spain. *} */
    public      $telephone              = null;                     /* {*property   $telephone                  (string)                                    The telephone number. *} */
    public      $vatID                  = null;                     /* {*property   $vatID                      (string)                                    The Value-added Tax ID of the organization or person. *} */
    public      $weight                 = null;                     /* {*property   $weight                     (QuantitativeValue)                         The weight of the product or person. *} */
    public      $workLocation           = null;                     /* {*property   $workLocation               (ContactPoint|Place)                        A contact location for a person's place of work. *} */
    public      $worksFor               = null;                     /* {*property   $worksFor                   (Organization)                              Organizations that the person works for. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId             = 'Q5';                     /* {*property   $wikidataId                 (string)                                    Wikidata ID. Human. Common name of Homo sapiens, unique extant species 
                                                                                                                                                            of the genus Homo. *} */

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

        return ( $this );
    }   /* End of Person.__construct() ================================================ */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of Person.speak() ====================================================== */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of Person.sing() ======================================================= */
    /* ================================================================================ */


    public function splitName( $szName ):array
    /*--------------------------------------*/
    {
        $aParts = explode( ' ',trim( $szName ) );
        $iParts = count( $aParts );

        $aRetVal = array( 'firstname'    => null,
                          'lastname'     => null,
                          'other'        => null,
                        );

        if      ( $iParts >= 3 )
        {
            $aRetVal['firstname'] = trim( $aParts[0] );
            $aRetVal['lastname' ] = trim( $aParts[1] );
            $aRetVal['other'    ] = trim( $aParts[2] );
        }
        elseif  ( $iParts >= 2 )
        {
            $aRetVal['firstname'] = trim( $aParts[0] );
            $aRetVal['lastname' ] = trim( $aParts[1] );
        }
        elseif  ( $iParts >= 1 )
        {
            $aRetVal['firstname'] = trim( $aParts[0] );
        }

        return ( $aRetVal );
    }   /* End of Person.splitName() ================================================== */
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

        {*keywords constructors, destructors *}

        {*seealso @fnc.__construct *}

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
    }   /* End of Person.__destruct() ================================================= */
    /* ================================================================================ */
}   /* End of class Person ============================================================ */
/* ==================================================================================== */
