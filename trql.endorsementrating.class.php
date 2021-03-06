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
    {*file                  trql.endorsementrating.class.php *}
    {*purpose               An EndorsementRating is a rating that expresses some level
                            of endorsement, for example inclusion in a "critic's pick"
                            blog, a"Like" or "+1" on a social network. It can be
                            considered the result of an EndorseAction in which the
                            object of the action is rated positively bysome agent. As is
                            common elsewhere in schema.org, it is sometimes more useful
                            to describe the results of such an action without explicitly
                            describing the Action.An EndorsementRating may be part of a
                            numeric scale or organized system, but this is not required:
                            having an explicit type for indicating a
                            positive,endorsement rating is particularly useful in the
                            absence of numeric scales as it helps consumers understand
                            that the rating is broadly positive. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:46 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:46 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    {*chist
        {*mdate 14-02-21 10:44 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */

/****************************************************************************************/
namespace trql\endorsementrating;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\rating\Rating    as Rating;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'RATING_CLASS_VERSION' ) )
    require_once( 'trql.rating.class.php' );



defined( 'ENDORSEMENTRATING_CLASS_VERSION' ) or define( 'ENDORSEMENTRATING_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class EndorsementRating=

    {*desc

        An EndorsementRating is a rating that expresses some level of endorsement,
        for example inclusion in a "critic's pick" blog, a"Like" or "+1" on a
        social network. It can be considered the result of an EndorseAction in
        which the object of the action is rated positively bysome agent. As is
        common elsewhere in schema.org, it is sometimes more useful to describe the
        results of such an action without explicitly describing the Action.An
        EndorsementRating may be part of a numeric scale or organized system, but
        this is not required: having an explicit type for indicating a
        positive,endorsement rating is particularly useful in the absence of
        numeric scales as it helps consumers understand that the rating is broadly
        positive.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/EndorsementRating[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:46.
    *}

 */
/* ==================================================================================== */
class EndorsementRating extends Rating
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
    public      $author                         = null;             /* {*property   $author                         (Organization|Person)           The author of this content or rating. Please note that author is
                                                                                                                                                    special in that HTML 5 provides a special mechanism for indicating
                                                                                                                                                    authorship via the rel tag. That is equivalent to this and may be used
                                                                                                                                                    interchangeably. *} */
    public      $bestRating                     = null;             /* {*property   $bestRating                     (float|string)                  The highest value allowed in this rating system. If bestRating is
                                                                                                                                                    omitted, 5 is assumed. *} */
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
    public      $potentialAction                = null;             /* {*property   $potentialAction                (Action)                        Indicates a potential Action, which describes an idealized action in
                                                                                                                                                    which this thing would play an 'object' role. *} */
    public      $ratingExplanation              = null;             /* {*property   $ratingExplanation              (string)                        A short explanation (e.g. one to two sentences) providing background
                                                                                                                                                    context and other information that led to the conclusion expressed in
                                                                                                                                                    the rating. This is particularly applicable to ratings associated with
                                                                                                                                                    "fact check" markup using ClaimReview. *} */
    public      $ratingValue                    = null;             /* {*property   $ratingValue                    (float|string)                  The rating for the content.Usage guidelines:Use values from 0123456789
                                                                                                                                                    (Unicode 'DIGIT ZERO' (U+0030) to 'DIGIT NINE' (U+0039)) rather than
                                                                                                                                                    superficially similiar Unicode symbols.Use '.' (Unicode 'FULL STOP'
                                                                                                                                                    (U+002E)) rather than ',' to indicate a decimal point. Avoid using
                                                                                                                                                    these symbols as a readability separator. *} */
    public      $reviewAspect                   = null;             /* {*property   $reviewAspect                   (string)                        This Review or Rating is relevant to this part or facet of the
                                                                                                                                                    itemReviewed. *} */
    public      $sameAs                         = null;             /* {*property   $sameAs                         (URL)                           URL of a reference Web page that unambiguously indicates the item's
                                                                                                                                                    identity. E.g. the URL of the item's Wikipedia page, Wikidata entry,
                                                                                                                                                    or official website. *} */
    public      $subjectOf                      = null;             /* {*property   $subjectOf                      (Event|CreativeWork)            A CreativeWork or Event about this Thing. *} */
    public      $url                            = null;             /* {*property   $url                            (URL)                           URL of the item. *} */
    public      $worstRating                    = null;             /* {*property   $worstRating                    (float|string)                  The lowest value allowed in this rating system. If worstRating is
                                                                                                                                                    omitted, 1 is assumed. *} */


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
    }   /* End of EndorsementRating.__construct() ========================================== */
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
    }   /* End of EndorsementRating.__destruct() =========================================== */
    /* ================================================================================ */

}   /* End of class EndorsementRating ====================================================== */
/* ==================================================================================== */

?>