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
    {*file                  trql.realestatelisting.class.php *}
    {*purpose               A RealEstateListing is a listing that describes one or more
                            real-estate Offers (whose businessFunction is typically to
                            lease out, or to sell). The RealEstateListing type itself
                            represents the overall listing, as manifested in some
                            WebPage. *}
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
namespace trql\realestatelisting;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\webpage\WebPage    as WebPage;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'WEBPAGE_CLASS_VERSION' ) )
    require_once( 'trql.webpage.class.php' );



defined( 'REALESTATELISTING_CLASS_VERSION' ) or define( 'REALESTATELISTING_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class RealEstateListing=

    {*desc

        A RealEstateListing is a listing that describes one or more real-estate
        Offers (whose businessFunction is typically to lease out, or to sell). The
        RealEstateListing type itself represents the overall listing, as manifested
        in some WebPage.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/RealEstateListing[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:28.
    *}

 */
/* ==================================================================================== */
class RealEstateListing extends WebPage
/*-----------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $datePosted                     = null;             /* {*property   $datePosted                     (Date|DateTime)                 Publication date of an online listing. *} */
    public      $leaseLength                    = null;             /* {*property   $leaseLength                    (QuantitativeValue|Duration)    Length of the lease for some Accommodation, either particular to some
                                                                                                                                                    Offer or in some cases intrinsic to the property. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                        Wikidata ID. NOT CHECKED SO FAR (25-02-21 18:17:24). *} */


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
    }   /* End of RealEstateListing.__construct() ===================================== */
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
    }   /* End of RealEstateListing.__destruct() ====================================== */
    /* ================================================================================ */
}   /* End of class RealEstateListing ================================================= */
/* ==================================================================================== */
?>