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
    {*file                  trql.member.class.php *}
    {*purpose               Individual or organization with membership in a group; 
                            constitutive components of a corporate body *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 14:09 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

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
namespace trql\personororganization;

use \trql\mother\iContext           as iContext;
use \trql\vaesoli\Vaesoli           as Vaesoli;
use \trql\organization\Organization as Organization;

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

        Abstract class to mention a Person or Organization

    *}

    *}}
 */
/* =======Member============================================================================= */
abstract class PersonOrOrganization extends Organization
/*----------------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                                     Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

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
    public  $brand                      = null;                     /* {*property   $brand                      (Brand|Organization)                        The brand(s) associated with a product or service,
                                                                                                                                                            or the brand(s) maintained by an organization
                                                                                                                                                            or business person. *} */
    public  $children                   = null;                     /* {*property   $children                   (Person)                                    A child of the person. *} */
    public  $colleague                  = null;                     /* {*property   $colleague                  (Person|URL)                                A colleague of the person. Supersedes colleagues. *} */
    public  $deathDate                  = null;                     /* {*property   $deathDate                  (Date)                                      Date of death. *} */
    public  $deathPlace                 = null;                     /* {*property   $deathPlace                 (Place)                                     The place where the person died. *} */
    public  $familyName                 = null;                     /* {*property   $familyName                 (string)                                    Family name. In the U.S., the last name of an Person. This can
                                                                                                                                                            be used along with givenName instead of the name property. *} */
    public  $follows                    = null;                     /* {*property   $follows                    (Person                                     The most generic uni-directional social relation. *} */
    public  $funder                     = null;                     /* {*property   $funder                     (Organization|Person)                       A person or organization that supports (sponsors) something
                                                                                                                                                            through some kind of financial contribution. *} */
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
    public  $knowsAbout                 = null;                     /* {*property   $knowsAbout                 (string|Thing|URL)                          Of a Person, and less typically of an Organization, to indicate a topic
                                                                                                                                                            that is known about - suggesting possible expertise but not implying it.
                                                                                                                                                            We do not distinguish skill levels here, or relate this to educational
                                                                                                                                                            content, events, objectives or JobPosting descriptions. *} */
    public  $knowsLanguage              = null;                     /* {*property   $knowsLanguage              (Language|string)                           Of a Person, and less typically of an Organization, to indicate a known
                                                                                                                                                            language. We do not distinguish skill levels or
                                                                                                                                                            reading/writing/speaking/signing here. Use language codes from the
                                                                                                                                                            IETF BCP 47 standard. *} */
    public  $memberOf                   = null;                     /* {*property   $memberOf                   (Organization|ProgramMembership)            An Organization (or ProgramMembership) to which this Person or
                                                                                                                                                            Organization belongs. Inverse property: @var.member. *} */
    public  $nationality                = null;                     /* {*property   $nationality                (Country)                                   Nationality of the person. *} */
    public  $netWorth                   = null;                     /* {*property   $netWorth                   (MonetaryAmount|PriceSpecification)         The total financial value of the person as calculated by subtracting
                                                                                                                                                            assets from liabilities. *} */
    public  $owns                       = null;                     /* {*property   $owns                       (OwnershipInfo|Product)                     Products owned by the organization or person. *} */
    public  $parent                     = null;                     /* {*property   $parent                     (Person)                                    A parent of this person. Supersedes parents. *} */
    public  $performerIn                = null;                     /* {*property   $performerIn                (Event)                                     Event that this person is a performer or participant in. *} */
    public  $relatedTo                  = null;                     /* {*property   $relatedTo                  (Person)                                    The most generic familial relation. *} */
    public  $seeks                      = null;                     /* {*property   $seeks                      (Demand)                                    A pointer to products or services sought by the organization or person (demand). *} */
    public  $sibling                    = null;                     /* {*property   $sibling                    (Person)                                    A sibling of the person. Supersedes siblings. *} */
    public  $spouse                     = null;                     /* {*property   $spouse                     (Person)                                    The person's spouse. *} */
    public  $weight                     = null;                     /* {*property   $weight                     (QuantitativeValue)                         The weight of the product or person. *} */
    public  $workLocation               = null;                     /* {*property   $workLocation               (ContactPoint|Place)                        A contact location for a person's place of work. *} */
    public  $worksFor                   = null;                     /* {*property   $worksFor                   (Organization)                              Organizations that the person works for. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;

}   /* End of class PersonOrOrganisation ============================================== */
/* ==================================================================================== */
?>