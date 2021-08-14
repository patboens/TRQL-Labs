<?php
/****************************************************************************************/
/** {{{*fheader
    {*file                  trql.artgallery.class.php *}
    {*purpose               An art gallery. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 24-08-2020 11:59 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 24-08-2020 11:59 *}
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
namespace trql\artgallery;

use \trql\vaesoli\Vaesoli                               as Vaesoli;
use \trql\schema\business\EntertainmentBusiness   as EntertainmentBusiness;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'ENTERTAINMENTBUSINESS_CLASS_VERSION' ) )
    require_once( 'trql.entertainmentbusiness.class.php' );

defined( 'ARTGALLERY_CLASS_VERSION' ) or define( 'ARTGALLERY_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class ArtGallery=

    {*desc

        An art gallery.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/ArtGallery[/url] *}

 */
/* ==================================================================================== */
class ArtGallery extends EntertainmentBusiness
/*------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q1007870';       /* {*property   $wikidataId                 (string)                        Wikidata ID: Place where art is exhibited and 
                                                                                                                                                sometimes also sold *} */

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
    }   /* End of ArtGallery.__construct() =========================================== */
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
    }   /* End of ArtGallery.__destruct() ============================================= */
    /* ================================================================================ */
}   /* End of class ArtGallery ======================================================== */
/* ==================================================================================== */
?>