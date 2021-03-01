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
    {*file                  trql.apireference.class.php *}
    {*purpose               Reference documentation for application programming 
                            interfaces (APIs). *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 24-08-2020 12:29 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 24-08-2020 12:29 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 14-02-21 10:54 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\apireference;

use \trql\vaesoli\Vaesoli           as Vaesoli;
use \trql\techarticle\TechArticle   as TechArticle;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'TECHARTICLE_CLASS_VERSION' ) )
    require_once( 'trql.techarticle.class.php' );

defined( 'APIREFERENCE_CLASS_VERSION' ) or define( 'APIREFERENCE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class APIReference=

    {*desc

        Reference documentation for application programming interfaces (APIs).

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/APIReference[/url] *}

 */
/* ==================================================================================== */
class APIReference extends TechArticle
/*-----------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public $assemblyVersion         = null;                         /* {*property   $assemblyVersion            (string)                Associated product/technology version. e.g., .NET Framework 4.5. *} */
    public $executableLibraryName   = null;                         /* {*property   $executableLibraryName      (string)                Library file name e.g., mscorlib.dll, system.web.dll. *} */
    public $programmingModel        = null;                         /* {*property   $programmingModel           (string)                Indicates whether API is managed or unmanaged. *} */
    public $targetPlatform          = null;                         /* {*property   $targetPlatform             (string)                Type of app development: phone, Metro style, desktop, XBox, etc. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId         = null;                         /* {*property   $wikidataId                 (string)                 Wikidata ID: No equivalent *} */

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
    }   /* End of APIReference.__construct() ========================================== */
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
    }   /* End of APIReference.__destruct() =========================================== */
    /* ================================================================================ */
}   /* End of class APIReference ====================================================== */
/* ==================================================================================== */
?>