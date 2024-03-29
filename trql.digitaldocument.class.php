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
    {*file                  trql.digitaldocument.class.php *}
    {*purpose               An electronic file or document. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:46 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel �t� sous le h�tre *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:46 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\schema;

use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\document\Document     as Document;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'DOCUMENT_CLASS_VERSION' ) )
    require_once( 'trql.document.class.php' );

defined( 'DIGITALDOCUMENT_CLASS_VERSION' ) or define( 'DIGITALDOCUMENT_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class DigitalDocument=

    {*desc

        An electronic file or document.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/DigitalDocument[/url] *}

    {*warning
    
        This class has been generated automatically by
        [c]trql.schemaclassgenerator.class.php[/c] on 26-08-2020 18:46.

    *}

 */
/* ==================================================================================== */
class DigitalDocument extends Document
/*----------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $hasDigitalDocumentPermission   = null;             /* {*property   $hasDigitalDocumentPermission   (DigitalDocumentPermission)     A permission related to the access to this document (e.g. permission
                                                                                                                                                    to read or write an electronic document). For a public document,
                                                                                                                                                    specify a grantee with an Audience with audienceType equal to
                                                                                                                                                    "public". *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q28447338';      /* {*property   $wikidataId                     (string)                        Wikidata ID. File format *} */


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
    }   /* End of DigitalDocument.__construct() ======================================= */
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
    }   /* End of DigitalDocument.__destruct() ======================================== */
    /* ================================================================================ */
}   /* End of class DigitalDocument =================================================== */
/* ==================================================================================== */
