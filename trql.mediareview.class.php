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
    {*file                  trql.mediareview.class.php *}
    {*purpose               (editorial work in progress, this definition is incomplete
                            and unreviewed) A MediaReview is a more specialized form of
                            Review dedicated to the evaluation of media content online,
                            typically in the context of fact-checking and
                            misinformation. For more general reviews of media in the
                            broader sense, use UserReview, CriticReview or other Review
                            types. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:49 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:49 *}
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
namespace trql\mediareview;

use \trql\vaesoli\Vaesoli   as Vaesoli;
use \trql\review\Review     as Review;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'REVIEW_CLASS_VERSION' ) )
    require_once( 'trql.review.class.php' );

defined( 'MEDIAREVIEW_CLASS_VERSION' ) or define( 'MEDIAREVIEW_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class MediaReview=

    {*desc

        (editorial work in progress, this definition is incomplete and unreviewed)
        A MediaReview is a more specialized form of Review dedicated to the
        evaluation of media content online, typically in the context of
        fact-checking and misinformation. For more general reviews of media in the
        broader sense, use UserReview, CriticReview or other Review types.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/MediaReview[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:49.
    *}

 */
/* ==================================================================================== */
class MediaReview extends Review
/*-----------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $mediaAuthenticityCategory      = null;             /* {*property   $mediaAuthenticityCategory      (MediaManipulationRatingEnumeration)    Indicates a MediaManipulationRatingEnumeration 
                                                                                                                                                            classification of a  media object (in the context
                                                                                                                                                            of how it was published or shared). *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q34093460';      /* {*property   $wikidataId                     (string)                                Wikidata ID. Scientific article *} */


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
    }   /* End of MediaReview.__construct() =========================================== */
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
    }   /* End of MediaReview.__destruct() ============================================ */
    /* ================================================================================ */
}   /* End of class MediaReview ======================================================= */
/* ==================================================================================== */
?>