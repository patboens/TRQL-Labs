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
    {*file                  trql.rating.class.php *}
    {*purpose               A rating is an evaluation on a numeric scale, such as 1 to 5
                            stars. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:28 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 28-08-2020 16:28 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\rating;

use \trql\vaesoli\Vaesoli           as Vaesoli;
use \trql\intangible\Intangible     as Intangible;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'INTANGIBLE_CLASS_VERSION' ) )
    require_once( 'trql.intangible.class.php' );

defined( 'RATING_CLASS_VERSION' ) or define( 'RATING_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Rating=

    {*desc

        A rating is an evaluation on a numeric scale, such as 1 to 5 stars.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Rating[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:28.
    *}

 */
/* ==================================================================================== */
class Rating extends Intangible
/*---------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $author                         = null;             /* {*property   $author                         (Organization|Person)           The author of this content or rating. Please note that author is
                                                                                                                                                    special in that HTML 5 provides a special mechanism for indicating
                                                                                                                                                    authorship via the rel tag. That is equivalent to this and may be used
                                                                                                                                                    interchangeably. *} */
    public      $bestRating                     = null;             /* {*property   $bestRating                     (float|string)                  The highest value allowed in this rating system. If bestRating is
                                                                                                                                                    omitted, 5 is assumed. *} */
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
    public      $worstRating                    = null;             /* {*property   $worstRating                    (float|string)                  The lowest value allowed in this rating system. If worstRating is
                                                                                                                                                    omitted, 1 is assumed. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'P4271';          /* {*property   $wikidataId                     (string)                        Wikidata ID. (https://www.wikidata.org/wiki/Property:P4271)
                                                                                                                                                    qualifier to indicate a score given by the referenced source 
                                                                                                                                                    indicating the quality or completeness of the statement *} */

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
    }   /* End of Rating.__construct() ================================================ */
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
    }   /* End of Rating.__destruct() ================================================= */
    /* ================================================================================ */
}   /* End of class Rating ============================================================ */
/* ==================================================================================== */
?>