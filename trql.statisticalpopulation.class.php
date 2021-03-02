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
    {*file                  trql.statisticalpopulation.class.php *}
    {*purpose               A StatisticalPopulation is a set of instances of a certain
                            given type that satisfy some set of constraints. The
                            property populationType is used to specify the type. Any
                            property that can be used on instances of that type can
                            appear on the statistical population. For example, a
                            StatisticalPopulation representing all Persons with a
                            homeLocation of East Podunk California, would be described
                            by applying the appropriate homeLocation and populationType
                            properties to a StatisticalPopulation item that stands for
                            that set of people.The properties numConstraints and
                            constrainingProperties are used to specify which of the
                            populations properties are used to specify the population.
                            Note that the sense of "population" used here is the general
                            sense of a statisticalpopulation, and does not imply that
                            the population consists of people. For example, a
                            populationType of Event or NewsArticle could be used. See
                            also Observation, and the data and datasets overview for
                            more details. *}
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
namespace trql\statisticalpopulation;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\intangible\Intangible    as Intangible;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'INTANGIBLE_CLASS_VERSION' ) )
    require_once( 'trql.intangible.class.php' );



defined( 'STATISTICALPOPULATION_CLASS_VERSION' ) or define( 'STATISTICALPOPULATION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class StatisticalPopulation=

    {*desc

        A StatisticalPopulation is a set of instances of a certain given type that
        satisfy some set of constraints. The property populationType is used to
        specify the type. Any property that can be used on instances of that type
        can appear on the statistical population. For example, a
        StatisticalPopulation representing all Persons with a homeLocation of East
        Podunk California, would be described by applying the appropriate
        homeLocation and populationType properties to a StatisticalPopulation item
        that stands for that set of people.The properties numConstraints and
        constrainingProperties are used to specify which of the populations
        properties are used to specify the population. Note that the sense of
        "population" used here is the general sense of a statisticalpopulation, and
        does not imply that the population consists of people. For example, a
        populationType of Event or NewsArticle could be used. See also Observation,
        and the data and datasets overview for more details.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/StatisticalPopulation[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:41.
    *}

 */
/* ==================================================================================== */
class StatisticalPopulation extends Intangible
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
    public      $constrainingProperty           = null;             /* {*property   $constrainingProperty           (int)                           Indicates a property used as a constraint to define a
                                                                                                                                                    StatisticalPopulation with respect to the set of entities
                                                                                                                                                    corresponding to an indicated type (via populationType). *} */
    public      $description                    = null;             /* {*property   $description                    (string)                        A description of the item. *} */
    public      $disambiguatingDescription      = null;             /* {*property   $disambiguatingDescription      (string)                        A sub property of description. A short description of the item used to
                                                                                                                                                    disambiguate from other, similar items. Information from other
                                                                                                                                                    properties (in particular, name) may be necessary for the description
                                                                                                                                                    to be useful for disambiguation. *} */
    public      $identifier                     = null;             /* {*property   $identifier                     (URL|string|PropertyValue)      The identifier property represents any kind of identifier for any kind
                                                                                                                                                    of Thing, such as ISBNs, GTIN codes, UUIDs etc. Schema.org provides
                                                                                                                                                    dedicated properties for representing many of these, either as textual
                                                                                                                                                    strings or as URL (URI) links. See background notes for more details. *} */
    public      $image                          = null;             /* {*property   $image                          (ImageObject|URL)               An image of the item. This can be a URL or a fully described
                                                                                                                                                    ImageObject. *} */
    public      $mainEntityOfPage               = null;             /* {*property   $mainEntityOfPage               (CreativeWork|URL)              Indicates a page (or other CreativeWork) for which this thing is the
                                                                                                                                                    main entity being described. See background notes for details. *} */
    public      $name                           = null;             /* {*property   $name                           (string)                        The name of the item. *} */
    public      $numConstraints                 = null;             /* {*property   $numConstraints                 (int)                           Indicates the number of constraints (not counting populationType)
                                                                                                                                                    defined for a particular StatisticalPopulation. This helps
                                                                                                                                                    applications understand if they have access to a sufficiently complete
                                                                                                                                                    description of a StatisticalPopulation. *} */
    public      $populationType                 = null;             /* {*property   $populationType                 (Class)                         Indicates the populationType common to all members of a
                                                                                                                                                    StatisticalPopulation. *} */
    public      $potentialAction                = null;             /* {*property   $potentialAction                (Action)                        Indicates a potential Action, which describes an idealized action in
                                                                                                                                                    which this thing would play an 'object' role. *} */
    public      $sameAs                         = null;             /* {*property   $sameAs                         (URL)                           URL of a reference Web page that unambiguously indicates the item's
                                                                                                                                                    identity. E.g. the URL of the item's Wikipedia page, Wikidata entry,
                                                                                                                                                    or official website. *} */
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
    }   /* End of StatisticalPopulation.__construct() ========================================== */
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
    }   /* End of StatisticalPopulation.__destruct() =========================================== */
    /* ================================================================================ */

}   /* End of class StatisticalPopulation ====================================================== */
/* ==================================================================================== */

?>