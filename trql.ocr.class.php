<?php
/****************************************************************************************/
/** {{{*fheader
    {*file                  trql.ocr.class.php *}
    {*purpose               OCR-oriented services *}
    {*author                {PYB} *}
    {*company               [br]Lato Sensu Management[br]
                            Rue Bois des Mazuis, 47[br]
                            5070 Vitrival[br]
                            Belgium[br]
                            [url]http://www.latosensu.be[/url][br]
                            Vae Soli! : [url]http://www.vaesoli.org[/url] *}
    {*cdate                 19-08-20 11:45 *}
    {*mdate                 auto *}
    {*license               Submitted to intellectual property rights (see
                            author) *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 19-08-20 11:45 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\ocr;

use \trql\mother\Mother                 as Mother;
use \trql\mother\iContext               as iContext;
use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\utility\Utility               as Utility;


use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CONTEXT_CLASS_VERSION' ) )
    require_once( 'trql.context.class.php' );

if ( ! defined( 'UTILITY_CLASS_VERSION' ) )
    require_once( 'trql.utility.class.php' );


defined( 'OCR_CLASS_VERSION' ) or define( 'OCR_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class OCR=

    {*desc

        OCR-oriented services

    *}

    *}}
 */
/* ==================================================================================== */
class OCR extends Utility implements iContext
/*-----------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

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
    }   /* End of OCR.__construct() =================================================== */
    /* ================================================================================ */


    /* Final */
    protected function cacheName( $szMethod,$xParams,$xAdditional = null )
    /*------------------------------------------------------------------*/
    {
        $szMethod = str_replace( array( '\\',':','::','..' ),
                                 array( '.' ,'.','.' ,'.'  ),
                                 $szMethod );

        if ( is_null( $xAdditional ) )
            $szCacheFile = vaesoli::FIL_RealPath( $this->szHome . '/' . $szMethod . '.' . md5( serialize( $xParams ) ) . '.cache' );
        else
            $szCacheFile = vaesoli::FIL_RealPath( $this->szHome . '/' . $szMethod . '.' . md5( serialize( $xParams ) ) . md5( serialize( $xAdditional ) ) . '.cache' );

        return ( $szCacheFile );
    }   /* End of OCR.cacheName() ===================================================== */
    /* ================================================================================ */


    protected function call( $szURL,$szLang = 'fre' ) : string
    /*------------------------------------------------------*/
    {
        $iErrCode   = 0;
        $szHeader   = '';

        $aPost      = array( 'apikey'                   => '83c46be3d988957',
                             'isOverlayRequired'        => 'true'           ,
                             'detectOrientation'        => 'true'           ,
                             'isCreateSearchablePdf'    => 'true'           ,
                             'scale'                    => 'true'           ,
                             'isTable'                  => 'true'           ,
                             'OCREngine'                => '2'              ,
                             'url'                      => $szURL           ,
                             'language'                 => $szLang );

        $szRetVal = vaesoli::HTTP_GetURL( 'https://api.ocr.space/parse/image',null,null,$iErrCode,null,$szHeader,5,$aPost );

        return ( $szRetVal );
    }   /* End of OCR.call() ========================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*scan( $szURL )=

        Scans an image/PDF pointed to by $szURL

        {*params
            $szURL      (string)        URL of image/PDF
        *}

        {*return
            (string)    Returns the result of the scan
        *}

        *}}
    */
    /* ================================================================================ */
    public function scan( $szURL )
    /*--------------------------*/
    {
        $szRetVal   = null;
        $szLang     = 'fre';

        $szCacheFile = $this->cacheName( $szMethod = 'scan',$szURL,$szLang );

        if ( true && $this->remembering && is_file( $szCacheFile ) )
        {
            $szRetVal = $this->getCache( $szCacheFile );
            $this->addInfo( __METHOD__ . "(): data obtained from {$szCacheFile}" );
        }
        else
        {
            if ( ! empty( $szRetVal = $szJSON = $this->call( $szURL ) ) )
            {
                if ( $this->storing )
                {
                    $this->saveHashFile( $szCacheFile,$szRetVal );
                    $this->addInfo( __METHOD__ . "(): OCR results stored in {$szCacheFile}" );
                }   /* if ( $this->storing ) */
            }
        }

        if ( ! empty( $szRetVal ) )
        {
            if ( ( $iPos = vaesoli::STR_Pos( $szRetVal,"\r\n\r\n" ) ) != -1 )
            {
                $szHeader   = substr( $szRetVal,0,$iPos );
                $szPayload  = substr( $szRetVal,$iPos + 4 ); /* 4 = length of 2 x CRLF */
            }
            else
            {
                $szPayload = $szRetVal;
            }

            //var_dump( $szRetVal );
            $this->parse( json_decode( $szPayload ) );
        }

        end:

        return ( $szRetVal );
    }   /* End of OCR.scan() ========================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*parse( $oJSON )=

        Parses a JSON return provided by ocr.space

        {*params
            $oJSON      (object)        JSON object to parse
        *}

        {*return
            (array)     Returns an associative array related to : DEFINITION TO BE GIVEN!!!
        *}

        *}}
    */
    /* ================================================================================ */
    protected function parse( $oJSON )
    /*------------------------------*/
    {
        $aRetVal = null;

        var_dump( $oJSON );
        //var_dump( $oJSON->ParsedResults[0]->TextOverlay );

        end:

        return ( $aRetVal );
    }   /* End of OCR.parse() ========================================================= */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        $szRetVal = '';

        return ( $szRetVal );

    }   /* End of OCR.speak() ========================================================= */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of OCR.sing() ========================================================== */
    /* ================================================================================ */


    public function __destruct()
    /*------------------------*/
    {
        $this->backup();
    }   /* End of OCR.__destruct() ==================================================== */
    /* ================================================================================ */

}   /* End of class OCR =============================================================== */
/* ==================================================================================== */
?>