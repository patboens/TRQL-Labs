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
    {*file                  trql.table.class.php *}
    {*purpose               A table on a Web page. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:41 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 28-08-2020 16:41 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\table;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\webpageelement\WebPageElement    as WebPageElement;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'WEBPAGEELEMENT_CLASS_VERSION' ) )
    require_once( 'trql.webpageelement.class.php' );

defined( 'TABLE_CLASS_VERSION' ) or define( 'TABLE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Table=

    {*desc

        A table on a Web page.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Table[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:41.
    *}

 */
/* ==================================================================================== */
class Table extends WebPageElement
/*------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $cssSelector                    = null;             /* {*property   $cssSelector                    (CssSelectorType)               A CSS selector, e.g. of a SpeakableSpecification or WebPageElement. In
                                                                                                                                                    the latter case, multiple matches within a page can constitute a
                                                                                                                                                    single conceptual "Web page element". *} */
    public      $xpath                          = null;             /* {*property   $xpath                          (XPathType)                     An XPath, e.g. of a SpeakableSpecification or WebPageElement. In the
                                                                                                                                                    latter case, multiple matches within a page can constitute a single
                                                                                                                                                    conceptual "Web page element". *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q496946';        /* {*property   $wikidataId                     (string)                        Wikidata ID. arrangement of data in rows and columns *} */



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
    }   /* End of Table.__construct() ================================================= */
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
    }   /* End of Table.__destruct() ================================================== */
    /* ================================================================================ */
}   /* End of class Table ============================================================= */
/* ==================================================================================== */
?>