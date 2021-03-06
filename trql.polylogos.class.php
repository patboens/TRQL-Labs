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
    {*file                  trql.polylogos.class.php *}
    {*purpose               Entities that have a somewhat fixed, physical extension. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 29-07-20 11:47 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 29-07-20 11:47 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\polylogos;

use \trql\vaesoli\vaesoli                           as vaesoli;
use \trql\utility\Utility                           as Utility;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'UTILITY_CLASS_VERSION' ) )
    require_once( 'trql.utility.class.php' );

defined( 'POLYLOGOS_CLASS_VERSION' ) or define( 'POLYLOGOS_CLASS_VERSION','0.1' );

/* ================================================================================== */
/** {{*class Polylogos=

    {*desc

        Translation services. Wrapper around DeepL

    *}

    {*credits
        [url]https://www.deepl.com[/url]
    *}

    {*doc [url]https://www.deepl.com/fr/docs-api/[/url] *}

    {*example

    *}

    *}}
 */
/* ================================================================================== */
class PolyLogos extends Utility
/*---------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $szSrcLang                      = 'FR';             /* {*property   $szSrcLang                  (string)                Source language *} */
    public      $szTargetLang                   = 'EN';             /* {*property   $szTargetLang               (string)                Target language *} */
    public      $szText                         = null;             /* {*property   $szText                     (string)                Text to be translated *} */
    public      $aLastResults                   = null;             /* {*property   $aLastResults               (string)                Last results obtained when translation service called *} */
    public      $szHome                         = __DIR__;          /* {*property   $szHome                     (string)                Home directory of the class *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                 (string)                Wikidata ID. No equivalent. *} */

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
    }   /* End of PolyLogos.__construct() ============================================= */
    /* ================================================================================ */


    // OBSOLETE ? public function home()
    // OBSOLETE ? /*------------------*/
    // OBSOLETE ? {
    // OBSOLETE ?     return ( $this->szHome );
    // OBSOLETE ? }   /* End of PolyLogos.home() ==================================================== */
    // OBSOLETE ? /* ================================================================================ */


    /* ================================================================================ */
    /** {{*getAPIKey([$szSystem])=

        Get the API Key related to the system we're dealing with

        {*params
            $szSystem       (string)        Optional. [c]null[/c] by default.
        *}

        {*return
            (string)        The API Key or [c]null[/c] if not found
        *}

        {*abstract
            As we are dealing with possibly multiple external API calls, we may have
            several API keys to consider. That's what the "system" parameter is for.
        *}

        *}}
    */
    /* ================================================================================ */
    private function getAPIKey( $szSystem = null )
    /*------------------------------------------*/
    {
        if ( ! is_null( $szSystem ) )
            $szCave = "/api.{$szSystem}.key.txt";
        else
            $szCave = '/api.key.txt';

        if ( is_file( $szFile = vaesoli::FIL_RealPath( $this->szHome . $szCave ) ) )
            return ( vaesoli::FIL_FileToStr( $szFile ) );
        else
            return ( null );
    }   /* End of PolyLogos.getAPIKey() =============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*translate( $szText[,$szSrcLang[,$szTargetLang]] )=

        Translate text

        {*params
            $szText         (string)        Text to be translated
            $szSrcLang      (string)        Source language. Optional. 
                                            [c]this->szSrcLang[/c] by default
            $szTargetLang   (string)        Target language. Optional. 
                                            [c]this->szTargetLang[/c] by default
        *}

        {*return
            (array)     Associative array with translation results

                        array( 'text'            => Original text to be translated,
                               'source_lang'     => Source language,
                               'detected_lang'   => Detected langiage,
                               'translation'     => Text translated
                             );
        *}

        {*doc [url]https://www.deepl.com/docs-api.html?part=translating_text[/url] *}

        *}}
    */
    /* ================================================================================ */
    public function translate( $szText,$szSrcLang = null,$szTargetLang = null )
    /*-----------------------------------------------------------------------*/
    {
        $aRetVal = null;

        if ( is_null( $szSrcLang ) )
            $szSrcLang = $this->szSrcLang;

        if ( is_null( $szTargetLang ) )
            $szTargetLang = $this->szTargetLang;


        // Ici ... je dois utiliser le système de caching standard
        if ( is_file( $szCacheFile = vaesoli::FIL_RealPath( $this->szHome . '/' . md5( $this->szHome . $szText . $szSrcLang . $szTargetLang ) . '.polylogos.txt' ) ) )
        {
            //var_dump( "La traduction de '{$szText}' en '{$szTargetLang}' a été trouvée dans le fichier {$szCacheFile}" );
            //echo __LINE__," ... \n";
            $this->aLastResults = $aRetVal = unserialize( vaesoli::FIL_FileToStr( $szCacheFile ) );
            goto end;
        }   /* if ( is_file( $szCacheFile = vaesoli::FIL_RealPath( $this->szHome . '/' . md5( $this->szHome . $szSrcLang . $szTargetLang ) . '.polylogos.txt' ) ) ) */
        else
        {
            //var_dump( $szCacheFile );
            //goto end;
            // Ici ... je dois mettre la clef d'API dans un fichier indépendant!!!
            $szAccessKey    = $this->getAPIKey( 'deepl' );

            $szURL = "https://api.deepl.com/v2/translate?text=" . urlencode( $szText ) . "&source_lang={$szSrcLang}&target_lang={$szTargetLang}&auth_key={$szAccessKey}";
            //var_dump( $szURL );

            if ( $szJSON = vaesoli::HTTP_GetURL( $szURL ) )
            {
                // Documentation de la réponse: https://www.deepl.com/docs-api.html?part=translating_text
                // Two fields:
                //  - detected_source_language
                //  - text

                // La réponse nous donne une série de traductions (pas une seule!)
                // Quand il y a plusieurs traductions demandées (je ne sais pas
                // encore comment il faut faire cela) on reçoit plusieurs réponses
                $oJSON = json_decode( $szJSON );
                //var_dump( $oJSON );

                $this->aLastResults = $aRetVal = array( 'text'            => $szText                                              ,
                                                        'source_lang'     => $szSrcLang                                           ,
                                                        'detected_lang'   => $oJSON->translations[0]->detected_source_language    ,
                                                        'translation'     => $oJSON->translations[0]->text
                                                      );
                vaesoli::FIL_StrToFile( serialize( $aRetVal ),$szCacheFile );
            }   /* if ( $szJSON = vaesoli::HTTP_GetURL( $szURL ) ) */
            else    /* Else of ... if ( $szJSON = vaesoli::HTTP_GetURL( $szURL ) ) */
            {
                var_dump( "NOTHING BACK FROM DEEPL" );
                var_dump( $szJSON );
            }   /* End of ... Else of ... if ( $szJSON = vaesoli::HTTP_GetURL( $szURL ) ) */
        }

        end:
        return ( $aRetVal );

    }   /* End of PolyLogos.translate() =============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toString()=

        Allows a class to decide how it will react when it is treated like a
        string. 

        {*params
        *}

        {*return
            (string)        Returns the last translation.
        *}

        *}}
    */
    /* ================================================================================ */
    public function __toString() : string
    /*---------------------------------*/
    {
        return ( $this->aLastResults['translation'] ?? '' );
    }   /* End of PolyLogos.__toString() ============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return.
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
    }   /* End of PolyLogos.__destruct() ============================================== */
    /* ================================================================================ */
}   /* End of class PolyLogos ========================================================= */
/* ==================================================================================== */
?>