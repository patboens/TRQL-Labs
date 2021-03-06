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
    {*file                  trql.aboutpage.class.php *}
    {*purpose               Web page type: About page. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 25-08-2020 13:14 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*remark                Excellent article about Wikidata and RDFa : 
                            [url]https://lists.w3.org/Archives/Public/public-vocabs/2014Feb/0139.html[/url]
    {*UTF-8                 Quel bel été sous le hêtre *}
    {*keyword               web *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 25-08-2020 13:14 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 11-11-20 10:53 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Completing the [c]__destruct()[/c] method
                            2)  Adding a wikidata ID
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\web;

use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\web\WebPage           as WebPage;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'WEBPAGE_CLASS_VERSION' ) )
    require_once( 'trql.webpage.class.php' );

defined( 'ABOUTPAGE_CLASS_VERSION' ) or define( 'ABOUTPAGE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class AboutPage=

    {*desc

        Web page type: About page.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/AboutPage[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 25-08-2020 13:14.
    *}

    *}}
 */
/* ==================================================================================== */
class AboutPage extends WebPage
/*----------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                        Wikidata ID. no equivalent *} */


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
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ),$withFamily = false );

        return ( $this );
    }   /* End of AboutPage.__construct() ============================================= */
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
    }   /* End of AboutPage.__destruct() ============================================== */
    /* ================================================================================ */
}   /* End of class AboutPage ========================================================= */
/* ==================================================================================== */
