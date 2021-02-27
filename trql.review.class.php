<?php
/****************************************************************************************/
/*
    {PYB} is a shortcut for Patrick Boens

    {COMPANY} is a shortcut to "Lato Sensu Management"

    {RIGHTS} is a shortcut used by trql.documentor.class.php for
    All rights reserved to Lato Sensu Management for all countries.
    All Intellectual Property belongs to Patrick Boens.

    Other shortcuts exist. They exist to make it simple to change the formulation
    of parts that can vary over time.

    It does not change the undisputed truth that ALL code has been created by
    Patrick Boens, the author, who owns ALL the intellectual property of what
    he created.

*/

/** {{{*fheader
    {*file                  trql.review.class.php *}
    {*purpose               A review of an item - for example, of a restaurant, movie, or store. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 24-08-2020 09:36 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 24-08-2020 09:36 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 14-02-21 10:03 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\review;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\creativework\CreativeWork         as CreativeWork;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );

defined( 'REVIEW_CLASS_VERSION' ) or define( 'REVIEW_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Review=

    {*desc

        A review of an item - for example, of a restaurant, movie, or store.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Review[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        and as such HAS NOT BEEN TESTED YET!
    *}

 */
/* ==================================================================================== */
class Review extends CreativeWork
/*-----------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $itemReviewed                   = null;            /* {*property    $itemReviewed               (Thing)         The item that is being reviewed/rated. *} */
    public      $reviewAspect                   = null;            /* {*property    $reviewAspect               (string)        This Review or Rating is relevant to this part or facet
                                                                                                                                of the itemReviewed. *} */
    public      $reviewBody                     = null;            /* {*property    $reviewBody                 (string)        The actual body of the review. *} */
    public      $reviewRating                   = null;            /* {*property    $reviewRating               (Rating)        The rating given in this review. Note that reviews can
                                                                                                                                themselves be rated. The reviewRating applies to rating
                                                                                                                                given by the review. The aggregateRating property applies
                                                                                                                                to the review itself, as a creative work. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q265158';       /* {*property   $wikidataId                 (string)        Wikidata ID. Evaluation *} */


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
    }   /* End of Review.__construct() ================================================ */
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
    }   /* End of Review.__destruct() ================================================= */
    /* ================================================================================ */
}   /* End of class Review ============================================================ */
/* ==================================================================================== */
?>