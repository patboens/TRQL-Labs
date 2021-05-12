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

    {*chist
        {*mdate 14-02-21 08:55 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\quitus\ocr;

use \trql\quitus\Mother                 as Mother;
use \trql\quitus\iContext               as iContext;
use \trql\vaesoli\Vaesoli               as V;
use \trql\utility\Utility               as Utility;
use \trql\quitus\lang\tool\Taxonomizer  as Taxonomizer;


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

if ( ! defined( 'TAXONOMIZER_CLASS_VERSION' ) )
    require_once( 'trql.taxonomizer.class.php' );


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
            $szCacheFile = V::FIL_RealPath( $this->szHome . '/' . $szMethod . '.' . md5( serialize( $xParams ) ) . '.cache' );
        else
            $szCacheFile = V::FIL_RealPath( $this->szHome . '/' . $szMethod . '.' . md5( serialize( $xParams ) ) . md5( serialize( $xAdditional ) ) . '.cache' );

        return ( $szCacheFile );
    }   /* End of OCR.cacheName() ===================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*getAPIKey()=

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
    private function getAPIKey()
    /*------------------------*/
    {
        $szFile = V::FIL_RealPath( $this->szHome . '/api.key.txt' );
        //var_dump( $szFile );

        if ( is_file( $szFile ) )
            return ( V::FIL_FileToStr( $szFile ) );
        else
            return ( null );
    }   /* End of OCR.getAPIKey() ===================================================== */
    /* ================================================================================ */


    protected function call( $szURL,$szLang = 'fre' ) : string
    /*------------------------------------------------------*/
    {
        $iErrCode       = 0;
        $szHeader       = '';

        $szAccessKey    = $this->getAPIKey( 'ocr' );
        //var_dump( $szAccessKey );

        $aPost          = array( 'apikey'                   => $szAccessKey     ,
                                 'isOverlayRequired'        => 'true'           ,
                                 'detectOrientation'        => 'true'           ,
                                 'isCreateSearchablePdf'    => 'true'           ,
                                 'scale'                    => 'true'           ,
                                 'isTable'                  => 'true'           ,
                                 'OCREngine'                => '2'              ,
                                 'url'                      => $szURL           ,
                                 'language'                 => $szLang );

        $szRetVal       = V::HTTP_GetURL( 'https://api.ocr.space/parse/image',null,null,$iErrCode,null,$szHeader,5,$aPost );

        return ( $szRetVal ?? '' );
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
        $aRetVal    = null;
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
            if ( ( $iPos = V::STR_Pos( $szRetVal,"\r\n\r\n" ) ) != -1 )
            {
                $szHeader   = substr( $szRetVal,0,$iPos );
                $szPayload  = substr( $szRetVal,$iPos + 4 ); /* 4 = length of 2 x CRLF */
            }
            else
            {
                $szPayload = $szRetVal;
            }

            //var_dump( $szRetVal );
            $aRetVal = $this->parse( json_decode( $szPayload ) );
        }

        end:

        return ( $aRetVal );
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

        //var_dump( $oJSON );
        //var_dump( $oJSON->ParsedResults );
        //var_dump( $oJSON->ParsedResults[0]->TextOverlay );

        $aOCRLines = $oJSON->ParsedResults[0]->TextOverlay->Lines;
        $aLines = null;
        //var_dump( $aOCRLines );

        $szLang = V::STR_DetectLanguage( $oJSON->ParsedResults[0]->ParsedText );

        foreach( $aOCRLines as $oLine )
        {
            $aWords = null;
            foreach( $oLine->Words as $oWord )
            {
                $aWords[] = array( 'text'      => $oWord->WordText,
                                   'coords'    => array( 'left'    => $oWord->Left     ,
                                                         'top'     => $oWord->Top      ,
                                                         'height'  => $oWord->Height   ,
                                                         'width'   => $oWord->Width    ,
                                                       ) );
            }
            $aLines[] = array( 'text'   => $oLine->LineText,
                               'words'  => $aWords );
            //var_dump( $aWords );
        }   /* foreach( $aOCRLines as $oLine ) */

        $aRetVal = array( 'orientation'     => $oJSON->ParsedResults[0]->TextOrientation    ,
                          'text'            => $oJSON->ParsedResults[0]->ParsedText         ,
                          'parseexitcode'   => $oJSON->ParsedResults[0]->FileParseExitCode  ,
                          'ocrexitcode'     => $oJSON->OCRExitCode                          ,
                          'error'           => $oJSON->IsErroredOnProcessing                ,
                          'errormsg'        => $oJSON->ParsedResults[0]->ErrorMessage       ,
                          'errordetails'    => $oJSON->ParsedResults[0]->ErrorDetails       ,
                          'perfInMs'        => $oJSON->ProcessingTimeInMilliseconds         ,
                          'pdf'             => $oJSON->SearchablePDFURL                     ,
                          'lines'           => $aLines                                      ,
                          'lang'            => $szLang                                      ,
                        );

        $oTaxonomizer   = new Taxonomizer();
        $aOntologies    = $oTaxonomizer->listOntologies( $szLang );

        var_dump( $aOntologies );

        //$aOntologies    = array( 'facturation' );

        /* Transformons tout le texte en minuscules */
        $szText = strtolower( str_replace( array( "\r","\n" ),' ',$oJSON->ParsedResults[0]->ParsedText ) );

        // Le nb de mots qu'on a dans le texte parsé
        $iCountOfWords = count( $aWords = V::STR_Words( $oJSON->ParsedResults[0]->ParsedText ) );

        // Les ontologies et leur score pour mettre dans le résultat final
        $aRetValOntologies = null;

        foreach( $aOntologies as $szOntology )
        {
            $aMatchingPatterns = null;
            //var_dump( "--------------------Loading " . $szOntology . '...' );
            $aOntology = $oTaxonomizer->getOntology( $szOntology,$szLang );

            //var_dump( $aOntology );
            //var_dump( $aRetVal );

            // Le nb de fois qu'on a un match avec un mot d el'ontologie
            $iCountOfMatches = 0;

            foreach( $aOntology as $szWord )
            {
                /* Don't be confused by terms having alsmot no meaning */
                if ( strlen( $szWord = strtolower( trim( $szWord ) ) ) > 2 )
                {
                    //var_dump( "Looking for '" . $szWord . "'");
                    if ( @preg_match_all( '/(\A| |[[:punct:]])' . preg_quote( $szWord ) . '( ||[[:punct:]]\z)/smi',$szText,$aMatches, PREG_PATTERN_ORDER ) )
                    {
                        $aMatches               = $aMatches[0];
                        $aMatchingPatterns[]    = $szWord;
                        $iCount                 = count( $aMatches );
                        $iCountOfMatches       += $iCount;
                        //var_dump( '>>> "' . $szWord . '" found ' . $iCount . ' times' );
                    }


                    // TOO EASY ... if ( ( $iCount = substr_count( $szText,$szWord ) ) > 0 )
                    // TOO EASY ... {
                    // TOO EASY ...     $iCountOfMatches += $iCount;
                    // TOO EASY ...     var_dump( $szWord . ' found ' . $iCount . ' times' );
                    // TOO EASY ... }
                }
            }   /* foreach( $aOntology as $szWord ) */

            //var_dump( $iCountOfMatches . '/' .$iCountOfWords . ' for ' . $szOntology );
            //var_dump( "SCORE:" . round( ( $iCountOfMatches / $iCountOfWords ) * 100,2 ) . "%" );

            $aRetValOntologies[] = array( 'name'                => $szOntology          ,
                                          'matchingpatterns'    => $aMatchingPatterns   ,
                                          'count'               => $iCountOfMatches     ,
                                          'score'               => $iCountOfMatches / $iCountOfWords,
                                        );
        }   /* foreach( $aOntologies as $szOntology ) */

        $aRetVal['ontologies'] = $aRetValOntologies;

        $iMax = 0;
        $szWinningOntology = null;

        foreach( $aRetValOntologies as $aOntology )
        {
            if ( $aOntology['score'] > $iMax )
            {
                $iMax               = $aOntology['score'];
                $szWinningOntology  = $aOntology['name'];
            }
        }

        $aRetVal['winner'] = array( 'name'      => $szWinningOntology   ,
                                    'score'     => $iMax                ,
                                  );
        //var_dump( $aRetValOntologies );
        //var_dump( $aRetVal );

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
        $this->autodoc();
        $this->UIKey();
        $this->WikiData();
        $this->necroSignaling();

    }   /* End of OCR.__destruct() ==================================================== */
    /* ================================================================================ */

}   /* End of class OCR =============================================================== */
/* ==================================================================================== */
?>