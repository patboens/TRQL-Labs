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
    {*file                  trql.zip.class.php *}
    {*purpose               This class enables you to transparently read or 
                            write ZIP compressed archives and the files inside
                            them. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 27-07-20 10:03 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 27-07-20 10:03 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 23-08-20 13:04 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Adapting the Documentor comments
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\utility;

use \trql\quitus\Mother                             as Mother;
use \trql\quitus\iContext                           as iContext;
use \trql\vaesoli\Vaesoli                           as Vaesoli;
use \trql\utility\Utility                           as Utility;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'UTILITY_CLASS_VERSION' ) )
    require_once( 'trql.utility.class.php' );

defined( 'ZIP_CLASS_VERSION' ) or define( 'ZIP_CLASS_VERSION','0.1' );


/* ==================================================================================== */
/** {{*class Zip=

    {*desc

        This class enables you to transparently read or write ZIP compressed
        archives and the files inside them.

    *}

    {*credits
        The whole concept is derived from the ZipArchive found in PHP
    *}

    {*doc [url]https://www.php.net/manual/en/intro.zip.php[/url] *}

    *}}
 */
/* ==================================================================================== */

class Zip extends Utility
/*----------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    const       CREATE          = \ZipArchive::CREATE;
    const       EXCL            = \ZipArchive::EXCL;
    const       CHECKCONS       = \ZipArchive::CHECKCONS;
    const       OVERWRITE       = \ZipArchive::OVERWRITE;
    //const       RDONLY          = \ZipArchive::RDONLY;

    public      $sameAs         = 'https://www.php.net/manual/fr/class.ziparchive.php';
                                                                    /* {*property   $sameAs                     (string)                URL of a reference Web page that
                                                                                                                                        unambiguously indicates the item's
                                                                                                                                        identity. E.g. the URL of the
                                                                                                                                        item's Wikipedia page, Freebase
                                                                                                                                        page, or official website. *} */

    protected   $oZip           = null;                             /* {*property   $oZip                       (ZipArchive)            Internal object (see $sameAs) *} */


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

        $this->oZip = new \ZipArchive();

        return ( $this );
    }   /* End of Zip.__construct() =================================================== */
    /* ================================================================================ */


    public function __call( $szName,$aParams )
    /*--------------------------------------*/
    {
        if ( is_null( $this->oZip ) )
            $this->oZip = new \ZipArchive();

        switch( strtolower( trim( $szName ) ) )
        {
            case 'addfile' :
                {
                    $szFile = str_replace( '\\','/',$aParams[0] );
                    if ( ! is_null( $szNewFile = $aParams[1] ?? null ) )
                        $szNewFile = str_replace( '\\','/',$szNewFile );
                    return ( @$this->oZip->addFile( $szFile,$szNewFile ) );
                }
                break;
            case 'open' :
                {
                    $szFile = str_replace( '\\','/',$aParams[0] );
                    $iFlags = $aParams[1] ?? CREATE;
                    return ( @$this->oZip->open( $szFile,$iFlags ) );
                }
                break;
            case 'close' :
                {
                    @$this->oZip->close();
                }
                break;
            default     :
                {
                    var_dump( $szName );
                    var_dump( $aParams );
                    throw new \Exception( __FUNCTION__ . "() at line " . __LINE__ . ": {$szName}() UNKNOWN (ErrCode: " . EXCEPTION_CODE_METHOD_UNDEFINED . ")",EXCEPTION_CODE_METHOD_UNDEFINED );
                }
                break;
        }

    }   /* End of Zip.__call() ======================================================== */
    /* ================================================================================ */


    public function __destruct()
    /*------------------------*/
    {
        //parent::__destruct();
        //$this->backup();
    }   /* End of Zip.__destruct() ==================================================== */
    /* ================================================================================ */

}   /* End of class Zip =============================================================== */
/* ==================================================================================== */
?>