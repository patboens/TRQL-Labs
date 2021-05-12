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
    {*file                  trql.sitemap.class.php *}
    {*purpose               List of pages (WebPages) of a web site A web page. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 03-04-21 07:58 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 03-04-21 07:58 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\web;

use \trql\quitus\iContext       as iContext;
use \trql\vaesoli\Vaesoli       as V;
use \trql\web\WebPage           as WebPage;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'WEBPAGE_CLASS_VERSION' ) )
    require_once( 'trql.webpage.class.php' );

defined( 'SITEMAP_CLASS_VERSION' ) or define( 'SITEMAP_CLASS_VERSION','0.1' );

/* ================================================================================== */
/** {{*class Sitemap=

    {*desc

        List of pages (WebPages) of a web site A web page.

    *}

    *}}
 */
/* ================================================================================== */
class Sitemap extends WebPage
/*--------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                             Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                 = 'Q1503327';           /* {*property   $wikidataId                 (string)                            Wikidata ID: list of pages of a web site *} */
    public      $groups                     = null;                 /* {*property   $groups                     (array)                             Groups of pages (e.g. 'miscellaneous','services','tools',
                                                                                                                                                    'api', etc.) *} */
    public      $shelter                    = null;                 /* {*property   $shelter                    (string)                            Folder in which all meta files are maintained *} */
    public      $mask                       = '*.meta.xml';         /* {*property   $mask                       (string)                            File mask applied to meta files. Files corresponding to
                                                                                                                                                    that mask are taken into account for the sitemap *} */

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
        $this->updateSelf( __CLASS__,
                           '/q/common/trql.classes.home/' . basename( __FILE__,'.php' ),
                           $withFamily = false );

        if ( is_null( $this->shelter ) )
            if ( $this->isCommandLine() )
                $this->shelter = getcwd();
            else
                $this->shelter = V::FIL_RealPath( V::FIL_ResolveRoot( '/content' ) );

        return ( $this );
    }   /* End of Sitemap.__construct() =============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*listFiles( [$szMask] )=

        Class destructor

        {*params
            $szMask     (string)        Mask applied when searching for Sitemap files.
                                        Optional. [c]null[/c] by default.
        *}

        {*return
            (array)     Array of files that define how the sitemap is populated
        *}

        *}}
    */
    /* ================================================================================ */
    public function listFiles( $szMask = null )
    /*---------------------------------------*/
    {
        if ( ! is_string( $szMask ) )
            $szMask = V::FIL_RealPath( $this->shelter . '/' . $this->mask );

        return ( V::FIL_aFilesEx( $szMask ) );
    }   /* End of Sitemap.listFiles() ================================================= */
    /* ================================================================================ */


    /* Add a page in one of the groups of the sitemap */
    public function add( $szGroup,$szTitle,$szURL )
    /*-------------------------------------------*/
    {
        return ( $this );
    }   /* End of Sitemap.add() ======================================================= */
    /* ================================================================================ */


    /* Je dois m'inspirer de ce que j'ai fait dans une classe, càd appeler des services
       internes en fonction du type de rendering dont on a besoin: __toXML(), __toString(),
       __toHTML(), __toForm(), ... */
    public function render() : string
    /*-----------------------------*/
    {
        return( '' );
    }   /* End of Sitemap.render() ==================================================== */
    /* ================================================================================ */


    /* Génère un sitemap.xml - doc : https://www.sitemaps.org/protocol.html */
    public function generate()
    /*----------------------*/
    {
        return( '' );
    }   /* End of Sitemap.generate() ================================================== */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of Sitemap.speak() ===================================================== */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of Sitemap.sing() ====================================================== */
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
    }   /* End of Sitemap.__destruct() ================================================ */
    /* ================================================================================ */
}   /* End of class Sitemap =========================================================== */
/* ==================================================================================== */
