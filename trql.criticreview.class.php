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
    {*file                  trql.criticreview.class.php *}
    {*purpose               A CriticReview is a more specialized form of Review written
                            or published by a source that is recognized for its
                            reviewing activities. These can include online columns,
                            travel and food guides, TV and radio shows, blogs and other
                            independent Web sites. CriticReviews are typically more
                            in-depth and professionally written. For simpler, casually
                            written user/visitor/viewer/customer reviews, it is more
                            appropriate to use the UserReview type. Review aggregator
                            sites such as Metacritic already separate out the site's
                            user reviews from selected critic reviews that originate
                            from third-party sources. *}
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
namespace trql\criticreview;

use \trql\vaesoli\Vaesoli   as Vaesoli;
use \trql\review\Review     as Review;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'REVIEW_CLASS_VERSION' ) )
    require_once( 'trql.review.class.php' );

defined( 'CRITICREVIEW_CLASS_VERSION' ) or define( 'CRITICREVIEW_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class CriticReview=

    {*desc

        A CriticReview is a more specialized form of Review written or published by
        a source that is recognized for its reviewing activities. These can include
        online columns, travel and food guides, TV and radio shows, blogs and other
        independent Web sites. CriticReviews are typically more in-depth and
        professionally written. For simpler, casually written
        user/visitor/viewer/customer reviews, it is more appropriate to use the
        UserReview type. Review aggregator sites such as Metacritic already
        separate out the site's user reviews from selected critic reviews that
        originate from third-party sources.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/CriticReview[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:46.
    *}

 */
/* ==================================================================================== */
class CriticReview extends Review
/*------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q80698083';      /* {*property   $wikidataId                     (string)                        Wikidata ID. a review conducted by a professional critic 
                                                                                                                                                    and published to a website following product testing or 
                                                                                                                                                    the evaluation of a product or service *} */

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
    }   /* End of CriticReview.__construct() ========================================== */
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
    }   /* End of CriticReview.__destruct() =========================================== */
    /* ================================================================================ */
}   /* End of class CriticReview ====================================================== */
/* ==================================================================================== */
?>