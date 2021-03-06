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
    {*file                  trql.employerreview.class.php *}
    {*purpose               An EmployerReview is a review of an Organization regarding
                            its role as an employer, written by a current or former
                            employee of that organization. *}
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
namespace trql\employerreview;

use \trql\vaesoli\Vaesoli   as Vaesoli;
use \trql\review\Review     as Review;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'REVIEW_CLASS_VERSION' ) )
    require_once( 'trql.review.class.php' );

defined( 'EMPLOYERREVIEW_CLASS_VERSION' ) or define( 'EMPLOYERREVIEW_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class EmployerReview=

    {*desc

        An EmployerReview is a review of an Organization regarding its role as an
        employer, written by a current or former employee of that organization.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/EmployerReview[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:46.
    *}

 */
/* ==================================================================================== */
class EmployerReview extends Review
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

    public      $itemReviewed                   = null;             /* {*property   $itemReviewed                   (Thing)                         The item that is being reviewed/rated. *} */
    public      $reviewAspect                   = null;             /* {*property   $reviewAspect                   (string)                        This Review or Rating is relevant to this part or facet of the
                                                                                                                                                    itemReviewed. *} */
    public      $reviewBody                     = null;             /* {*property   $reviewBody                     (string)                        The actual body of the review. *} */
    public      $reviewRating                   = null;             /* {*property   $reviewRating                   (Rating)                        The rating given in this review. Note that reviews can themselves be
                                                                                                                                                    rated. The reviewRating applies to rating given by the review. The
                                                                                                                                                    aggregateRating property applies to the review itself, as a creative
                                                                                                                                                    work. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                        Wikidata ID. No equivalent. *} */


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
    }   /* End of EmployerReview.__construct() ======================================== */
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
    }   /* End of EmployerReview.__destruct() ========================================= */
    /* ================================================================================ */
}   /* End of class EmployerReview ==================================================== */
/* ==================================================================================== */
?>