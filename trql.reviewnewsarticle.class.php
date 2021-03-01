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
    {*file                  trql.reviewnewsarticle.class.php *}
    {*purpose               A NewsArticle and CriticReview providing a professional
                            critic's assessment of a service, product, performance, or
                            artistic or literary work. *}
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
namespace trql\reviewnewsarticle;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\criticreview, newsarticle\CriticReview, NewsArticle    as CriticReview, NewsArticle;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CRITICREVIEW, NEWSARTICLE_CLASS_VERSION' ) )
    require_once( 'trql.criticreview, newsarticle.class.php' );



defined( 'REVIEWNEWSARTICLE_CLASS_VERSION' ) or define( 'REVIEWNEWSARTICLE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class ReviewNewsArticle=

    {*desc

        A NewsArticle and CriticReview providing a professional critic's assessment
        of a service, product, performance, or artistic or literary work.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/ReviewNewsArticle[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:28. IT HAS NOT BEEN TESTED YET!
    *}

 */
/* ==================================================================================== */
class ReviewNewsArticle extends CriticReview, NewsArticle
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
    public      $wikidataId             = null;                     /* {*property   $wikidataId                 (string)                Wikidata ID. No equivalent. *} */


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
    }   /* End of ReviewNewsArticle.__construct() ===================================== */
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
    }   /* End of ReviewNewsArticle.__destruct() ====================================== */
    /* ================================================================================ */
}   /* End of class ReviewNewsArticle ================================================= */
/* ==================================================================================== */

?>