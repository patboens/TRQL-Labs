<?php
/****************************************************************************************/
/** {{{*fheader
    {*file                  trql.polylogos.class.php *}
    {*purpose               Entities that have a somewhat fixed, physical extension. *}
    {*author                {PYB} *}
    {*company               Lato Sensu Management[br]
                            Rue Bois des Mazuis, 47[br]
                            5070 Vitrival[br]
                            Belgium[br]
                            [url]http://www.latosensu.be[/url][br]
                            Vae Soli! : [url]http://www.vaesoli.org[/url] *}
    {*cdate                 29-07-20 11:47 *}
    {*mdate                 auto *}
    {*license               All rights reserved to Lato Sensu Management
                            for all countries. All Intellectual Property
                            belongs to Patrick Boens. *}

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

    public  $szSrcLang      = 'FR';                                 /* {*property   $szSrcLang                  (string)                Source language *} */
    public  $szTargetLang   = 'EN';                                 /* {*property   $szTargetLang               (string)                Target language *} */
    public  $szText         = null;                                 /* {*property   $szText                     (string)                Text to be translated *} */
    public  $aLastResults   = null;                                 /* {*property   $aLastResults               (string)                Last results obtained when translation service called *} */
    public  $szHome         = __DIR__;                              /* {*property   $szHome                     (string)                Home directory of the class *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                 (string)                *} */


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


    public function home()
    /*------------------*/
    {
        return ( $this->szHome );
    }   /* End of PolyLogos.home() ==================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*translate( $szText[,$szSrcLang[,$szTargetLang]] )=

        Translate text

        {*params
            $szText         (string)        Text to be translated
            $szSrcLang      (string)        Source language. Optional. 
                                            [c]$this->szSrcLang[/c] by default
            $szTargetLang   (string)        Target language. Optional. 
                                            [c]$this->szTargetLang[/c] by default
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
            $szURL = "https://api.deepl.com/v2/translate?text=" . urlencode( $szText ) . "&source_lang={$szSrcLang}&target_lang={$szTargetLang}&auth_key=91c40dae-ed30-6656-63c4-94a835dcc7be";
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


    public function __toString()
    /*------------------------*/
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
}   /* End of PolyLogos.__destruct() ================================================== */
    /* ================================================================================ */

}   /* End of class PolyLogos ========================================================= */
/* ==================================================================================== */
?>