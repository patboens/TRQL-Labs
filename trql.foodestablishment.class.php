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
    {*file                  trql.foodestablishment.class.php *}
    {*purpose               A food-related business. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:48 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:48 *}
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
namespace trql\foodestablishment;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\schema\business\LocalBusiness       as LocalBusiness;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'LOCALBUSINESS_CLASS_VERSION' ) )
    require_once( 'trql.localbusiness.class.php' );

defined( 'FOODESTABLISHMENT_CLASS_VERSION' ) or define( 'FOODESTABLISHMENT_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class FoodEstablishment=

    {*desc

        A food-related business.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/FoodEstablishment[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:48.
    *}

 */
/* ==================================================================================== */
class FoodEstablishment extends LocalBusiness
/*-----------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $acceptsReservations            = null;             /* {*property   $acceptsReservations            (boolean|URL|string)            Indicates whether a FoodEstablishment accepts reservations. Values can
                                                                                                                                                    be Boolean, an URL at which reservations can be made or (for backwards
                                                                                                                                                    compatibility) the strings Yes or No. *} */
    public      $hasMenu                        = null;             /* {*property   $hasMenu                        (Menu|URL|string)               Either the actual menu as a structured representation, as text, or a
                                                                                                                                                    URL of the menu. *} */
    public      $servesCuisine                  = null;             /* {*property   $servesCuisine                  (string)                        The cuisine of the restaurant. *} */
    public      $starRating                     = null;             /* {*property   $starRating                     (Rating)                        An official rating for a lodging business or food establishment, e.g.
                                                                                                                                                    from national associations or standards bodies. Use the author
                                                                                                                                                    property to indicate the rating organization, e.g. as an Organization
                                                                                                                                                    with name such as (e.g. HOTREC, DEHOGA, WHR, or Hotelstars). *} */
    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q27038993';      /* {*property   $wikidataId                     (string)                        Wikidata ID. Food-related business that offers food *} */


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
    }   /* End of FoodEstablishment.__construct() ===================================== */
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
    }   /* End of FoodEstablishment.__destruct() ====================================== */
    /* ================================================================================ */
}   /* End of class FoodEstablishment ================================================= */
/* ==================================================================================== */
?>