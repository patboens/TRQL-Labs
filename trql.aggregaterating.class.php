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
    {*file                  trql.aggregaterating.class.php *}
    {*purpose               The average rating based on multiple ratings or reviews. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 09:50 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 09:50 *}
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
namespace trql\aggregaterating;

use \trql\vaesoli\Vaesoli   as Vaesoli;
use \trql\rating\Rating     as Rating;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'RATING_CLASS_VERSION' ) )
    require_once( 'trql.rating.class.php' );

defined( 'AGGREGATERATING_CLASS_VERSION' ) or define( 'AGGREGATERATING_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class AggregateRating=

    {*desc

        The average rating based on multiple ratings or reviews.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/AggregateRating[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 09:50.
    *}

 */
/* ==================================================================================== */
class AggregateRating extends Rating
/*--------------------------------*/
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
    public      $ratingValue                    = null;             /* {*property   $ratingValue                    (float|string)                  The rating for the content.Usage guidelines:Use values from 0123456789
                                                                                                                                                    (Unicode 'DIGIT ZERO' (U+0030) to 'DIGIT NINE' (U+0039)) rather than
                                                                                                                                                    superficially similiar Unicode symbols.Use '.' (Unicode 'FULL STOP'
                                                                                                                                                    (U+002E)) rather than ',' to indicate a decimal point. Avoid using
                                                                                                                                                    these symbols as a readability separator. *} */
    public      $reviewCount                    = null;             /* {*property   $reviewCount                    (int)                           The count of total number of reviews. *} */


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
    }   /* End of AggregateRating.__construct() ======================================= */
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
    }   /* End of AggregateRating.__destruct() ======================================== */
    /* ================================================================================ */
}   /* End of class AggregateRating =================================================== */
/* ==================================================================================== */
?>