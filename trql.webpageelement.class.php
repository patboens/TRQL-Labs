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
    {*file                  trql.webpageelement.class.php *}
    {*purpose               A web page element, like a table or an image. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 24-08-2020 12:50 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 24-08-2020 12:50 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\web;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\creativework\CreativeWork     as CreativeWork;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );

defined( 'WEBPAGEELEMENT_CLASS_VERSION' ) or define( 'WEBPAGEELEMENT_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class WebPageElement=

    {*desc

        A web page element, like a table or an image.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/WebPageElement[/url] *}

    {*warning
        This class has been generated automatically by
        [c]trql.schemaclassgenerator.class.php[/c]
    *}

    *}}
 
 */
/* ==================================================================================== */
class WebPageElement extends CreativeWork
/*--------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $cssSelector    = null;                             /* {*property   $cssSelector                (CssSelectorType )              A CSS selector, e.g. of a SpeakableSpecification or WebPageElement.
                                                                                                                                                In the latter case, multiple matches within a page can constitute
                                                                                                                                                a single conceptual "Web page element". *} */
    public      $xpath          = null;                             /* {*property   $xpath                      (XPathType )                    An XPath, e.g. of a SpeakableSpecification or WebPageElement.
                                                                                                                                                In the latter case, multiple matches within a page can constitute
                                                                                                                                                a single conceptual "Web page element". *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public          $wikidataId     = null;                         /* {*property   $wikidataId                 (string)                        Wikidata ID. No equivalent *} */

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
    }   /* End of WebPageElement.__construct() ======================================== */
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
    }   /* End of WebPageElement.__destruct() ========================================= */
    /* ================================================================================ */
}   /* End of class WebPageElement ==================================================== */
/* ==================================================================================== */
