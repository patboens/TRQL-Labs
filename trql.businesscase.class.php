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
    {*file                  trql.businesscase.class.php *}
    {*purpose               Reasoning for initiating a project or task, presented in
                            a well-structured written document, but may also come in
                            the form of a short verbal agreement or presentation. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 10-01-21 11:19 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 10-01-21 11:19 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\businesscase;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\XML\XML                       as XML;
use \trql\document\Document             as Document;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'XML_CLASS_VERSION' ) )
    require_once( 'trql.xml.class.php' );

if ( ! defined( 'DOCUMENT_CLASS_VERSION' ) )
    require_once( 'trql.document.class.php' );

defined( 'BUSINESSCASE_CLASS_VERSION' ) or define( 'BUSINESSCASE_CLASS_VERSION' ,'0.1' );

/* ==================================================================================== */
/** {{*class BusinessCase=

    {*desc

        Reasoning for initiating a project or task, presented in a well-structured
        written document, but may also come in the form of a short verbal agreement or
        presentation.

    *}

 */
/* ==================================================================================== */
class BusinessCase extends Document
/*-------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)             Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q1896170';      /* {*property   $wikidataId                     (string)             Reasoning for initiating a project or task, presented in
                                                                                                                                        a well-structured written document, but may also come in
                                                                                                                                        the form of a short verbal agreement or presentation.*} */

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

        //$this->die( __CLASS__ . ' has NOT been tested yet! Disable this line when you have tested the class.' );

        return ( $this );
    }   /* End of BusinessCase.__construct() ========================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toXML()=

        Renders the BusinessCase in XML

        {*params
        *}

        {*return
            (string)        XML Code
        *}

        *}}
    */
    /* ================================================================================ */
    public function __toXML(): string
    /*-----------------------------*/
    {
        static $oXML = null;
        $szRetVal = null;


        if ( is_null( $oXML ) )
            $oXML = new XML();

        $oDom                       = new \DOMDocument( '1.0' );

        $oDom->preserveWhiteSpace   = true;
        $oDom->formatOutput         = true;

        if ( $oDom->loadXML( $oXML->__toXML( $this ) ) )
            $szRetVal = $oDom->saveXML();

        end:
        return ( $szRetVal );
    }   /* End of BusinessCase.__toXML() ============================================== */
    /* ================================================================================ */


    public function __toString(): string
    /*--------------------------------*/
    {
        return ( __CLASS__ );
    }

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
    }   /* End of BusinessCase.__destruct() =========================================== */
    /* ================================================================================ */
}   /* End of class BusinessCase ====================================================== */
/* ==================================================================================== */
?>