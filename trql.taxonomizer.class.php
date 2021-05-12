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
    {*file                  trql.taxonomizer.class.php *}
    {*purpose               Utility that creates ontologies (set of terms
                            used in a domain *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 03-04-21 10:23 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 03-04-21 10:23 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    TO CONSIDER : https://managementmania.com/en/basic-terms

    *}}} */
/****************************************************************************************/
namespace trql\quitus\lang\tool;

use \trql\vaesoli\Vaesoli   as V;
use \trql\tool\Tool         as Tool;
use \trql\html\Form         as Form;
use \trql\html\Fieldset     as Fieldset;
use \trql\html\Input        as Input;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'TOOL_CLASS_VERSION' ) )
    require_once( 'trql.tool.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'XML_CLASS_VERSION' ) )
    require_once( 'trql.xml.class.php' );

if ( ! defined( 'ACTIVITY_CLASS_VERSION' ) )
    require_once( 'trql.activity.class.php' );

if ( ! defined( 'FORM_CLASS_VERSION' ) )
    require_once( 'trql.form.class.php' );

if ( ! defined( 'FIELDSET_CLASS_VERSION' ) )
    require_once( 'trql.fieldset.class.php' );

if ( ! defined( 'INPUT_CLASS_VERSION' ) )
    require_once( 'trql.input.class.php' );

defined( 'TAXONOMIZER_CLASS_VERSION' ) or define( 'TAXONOMIZER_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Taxonomizer=

    {*desc

        Physical item that can be used to achieve a goal

    *}

 */
/* ==================================================================================== */
class Taxonomizer extends Tool
/*--------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self               (array)             Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId             = null;                     /* {*property   $wikidataId         (string)            Wikidata ID. No equivalent *} */
    public      $szClass                = null;                     /* {*property   $szClass            (string)            CSS class of the task when it needs to be rendered *} */


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

        $this->updateSelf( __CLASS__,
                           '/q/common/trql.classes.home/' . basename( __FILE__,'.php' ),
                           $withFamily = false );

        return ( $this );
    }   /* End of Taxonomizer.__construct() =========================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*ontologize( $szText[$iMinLen[,$iMinCount]] )=

        Class constructor

        {*params
            $szText     (string)    The text to "ontologize" in UTF-8
            $iMinLen    (int)       Minimum length of words to be retained in the analysis
            $iMinCount  (int)       Minimum count for words to be retained. If a word does
                                    not appear more than X, it is considered not to be
                                    essential for the analysis
        *}

        {*return
            (array)     Associative array of words (word-count)
        *}

        {*remark
            HTML must be treated prior to [c]taxonomize()[/c].
        *}

        {*warning
            The class is quite experimental for now and does not do much
            for the time being. In the future, "concepts" and "topics" will be
            extracted and the array that will be produced will link terms
            together to form a sort of hierarchy
        *}

        {*example
        use \trql\vaesoli\Vaesoli   as V;
        use \trql\tool\Taxonomizer  as Taxonomizer;

        if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
            require_once( 'd:/websites/snippet-center/trql.vaesoli.class.php' );

        if ( ! defined( 'TAXONOMIZER_CLASS_VERSION' ) )
            require_once( 'd:/websites/snippet-center/trql.taxonomizer.class.php' );

        // Create the object
        $o = new Taxonomizer();

        // Get a text
        $szHTML = V::HTTP_GetURL( "http://www.lvid.org/documents/" );

        // If we got something
        if ( ! empty( $szHTML ) )
        {
            // Extract the body of the HTML
            if ( preg_match('%<body\b[^>]*>(?P<payload>.*?)</body>%si',$szHTML,$aMatches ) )
            {
                // 1) Convert entities to their equivalents
                // 2) Strip HTML tags
                // 3) Get rid of the scripts
                // 4) Get rid of punctuation
                // 5) Reduce consecutive of spaces to a single occurence
                $szBody = V::STR_Reduce( preg_replace( '/[[:punct:]]/si',' ',preg_replace( '%<script\b[^>]*>(.*?)</script>%si',' ',strip_tags( html_entity_decode( $aMatches['payload'] ) ) ) ) );

                // Get a list of words
                if ( is_array( $aWords = $o->ontologize( $szBody,3 |** min length **|,4 |** min count **| ) ) && count( $aWords ) > 0 )
                    var_dump( $aWords );
            }
        }

        *}

        *}}
    */
    /* ================================================================================ */
    public function ontologizeOLD( $szText,$iMinLen = 2,$iMinCount = 3 )
    /*-------------------------------------------------------------*/
    {
        $aRetVal = $aTmp = null;
        $aWords  = explode( ' ',$szText );

        foreach( $aWords as $szWord )
        {
            $szLower = strtolower( trim( $szWord ) );

            if ( strlen( $szLower ) >= $iMinLen )
            {
                if ( isset( $aTmp[$szLower] ) )
                    $aTmp[(string) $szLower] += 1;
                else
                    $aTmp[(string) $szLower] = 1;
            }
        }

        unset( $aWords );

        foreach( $aTmp as $szKey => $iCount )
        {
            if ( $iCount >= $iMinCount )
                $aRetVal[(string) $szKey] = $iCount;
        }

        unset( $aTmp);
        arsort( $aRetVal );

        return ( $aRetVal );
    }   /* End of Taxonomizer.ontologize() ============================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*ontologize( $szText )=

        Class constructor

        {*params
            $szText     (string)    The text to "ontologize" in UTF-8
            $iMinLen    (int)       Minimum length of words to be retained in the analysis
        *}

        {*return
            (array)     Associative array of words (word-count)
        *}

        {*remark
            HTML must be treated prior to [c]taxonomize()[/c].
        *}

        {*warning
            The class is quite experimental for now and does not do much
            for the time being. In the future, "concepts" and "topics" will be
            extracted and the array that will be produced will link terms
            together to form a sort of hierarchy
        *}

        {*example
        *}

        *}}
    */
    /* ================================================================================ */
    public function ontologize( $szText,$iMinScore = 0.015 )
    /*----------------------------------------------------*/
    {
        $aRetVal = null;

        try
        {
            /* Get the text in lower case and transform quotes */
            $szText = str_replace( '’',"'",strtolower( str_replace( array( "\r","\n" ),' ',$szText ) ) );

            /* Count of words of more than 3 characters */
            $iCountOfWords = count( $aWords = V::STR_Words( $szText,3 ) );

            /* Detect the language */
            $szLang         = V::STR_DetectLanguage( $szText,'?' /* No default language */,200 /* use 200 words */ );

            /* Let's look for qualifying words for the ontologies we have (for example: "collapse"
               for the ontology "decadence" or "employee", or 'job" for the ontology "work"). Of
               course this is all depending on the language we have detected before. */
            if ( is_array( $aQualifiers = $this->getQualifiers( $szLang ) ) )
            {
                // var_dump( $szText,$aQualifiers );

                // We have something like this ...
                // $aRetVal[]  = array( 'lang'     => $aMatches['lang'],
                //                      'name'     => $aMatches['name'],
                //                      'words'    => $aWords          ,
                //                    );

                /* If we have "qualifiers", it means we have ontologies to consider
                   for the texte we have to examine. What are these ontologies? */
                $aOntologies = null;

                foreach( $aQualifiers as $aQualifier )
                {
                    foreach( $aQualifier['words'] as $szWord )
                    {
                        if ( V::STR_iPos( $szText,$szWord ) !== -1 )
                        {
                            //echo $szWord,"\n";
                            $aOntologies[] = $aQualifier['name'];
                            break;
                        }   /* if ( V::STR_iPos( $szText,$szWord ) !== -1 ) */
                    }   /* foreach( $aQualifier['words'] as $szWord ) */
                }   /* foreach( $aQualifiers as $aQualifier ) */

                /* OK ... we have a set of ontologies that match the text */
                if ( is_array( $aOntologies ) )
                {
                    /* Get all words (or set of words) for every ontology we must
                       consider -- ACTUALLY, this is too detailed in here. Instead
                       of doing all that, we should apply one ontology and see
                       how well it matches the text. PLACE FOR CLEANING HERE. */
                    foreach( $aOntologies as $szOntology )
                    {
                        //echo "======================Processing " . $szOntology . " ontology\n";
                        /* Get the words here */
                        if ( is_array( $aOntology = $this->getOntology( $szOntology,$szLang ) ) )
                        {
                            $iCountOfMatches    = 0;        /* Match count */
                            $aMatchingPatterns  = null;     /* Patterns that match */

                            // For each word of THIS ontology
                            foreach( $aOntology as $szWord )
                            {
                                if ( @preg_match_all( '/(\A| |[[:punct:]])' . preg_quote( $szWord ) . '( ||[[:punct:]]\z)/smi',$szText,$aMatches,PREG_PATTERN_ORDER ) )
                                {
                                    //echo "On matche " . $szWord . " dans l'ontologie " . $szOntology,"\n";
                                    $aMatches               = $aMatches[0];
                                    $aMatchingPatterns[]    = $szWord;
                                    $iCount                 = count( $aMatches );
                                    $iCountOfMatches       += $iCount;

                                    //var_dump( "Nb de matches: " . $iCountOfMatches );
                                    //var_dump( '>>> "' . $szWord . '" found ' . $iCount . ' times' );
                                }   /* if ( @preg_match_all( ... ) ) */
                            }   /* foreach( $aOntology as $szWord ) */

                            $aRetVal[] = array( 'name'                => $szOntology          ,
                                                'matchingpatterns'    => $aMatchingPatterns   ,
                                                'count'               => $iCountOfMatches     ,
                                                'score'               => $iCountOfMatches / $iCountOfWords,
                                              );
                        }
                    }   /* foreach( $aOntologies as $szOntology ) */

                    if ( isset( $aRetVal ) && is_array( $aRetVal ) )
                    {
                        usort( $aRetVal,function( $a,$b )
                                        {
                                           if     ( $a['score'] === $b['score'] )
                                               return ( 0 );
                                           elseif ( $a['score'] > $b['score'] )
                                               return ( -1 );
                                           else
                                               return ( 1 );
                                        }
                             );

                    }   /* if ( isset( $aResults ) && is_array( $aResults ) ) */
                }   /* if ( is_array( $aOntologies ) ) */
            }   /* if ( is_array( $aQualifiers = ... ) ) */
        }
        catch ( Exception $e )
        {
            echo "ERROR: " . $e->getMessage();
        }

        return ( $aRetVal );
    }   /* End of Taxonomizer.ontologize() ============================================ */
    /* ================================================================================ */


    public function listOntologies( $szLang = null )
    /*--------------------------------------------*/
    {
        $aRetVal    = null;
        $aDirs      = null;

        if ( ! is_null( $szLang ) )
            $aDirs[] = V::FIL_RealPath( $this->home() . '/data/ontologies/' . $szLang );
        else
            $aDirs   = V::FIL_aDirsEx(  $this->home() . '/data/ontologies/*' );

        foreach( $aDirs as $szFolder )
        {
            if ( is_dir( $szFolder ) )
            {
                $szLang = basename( $szFolder );

                if ( is_array( $aFiles = V::FIL_aFilesEx( V::FIL_RealPath( $szFolder . '/*.ontology.txt' ) ) ) && count( $aFiles ) > 0 )
                {
                    foreach ( $aFiles as $szFile )
                    {
                        $aRetVal[] = $szLang . ':' . str_iReplace( '.ontology.txt','',basename( $szFile ) );
                    }
                }
            }   /* if ( is_dir( $szFolder = ... ) ) */
        }
        return ( $aRetVal );
    }   /* End of Taxonomizer.listOntologies() ======================================== */
    /* ================================================================================ */


    /* ontologies.txt holds words that MUST be included in the text to process for
       the pertaining ontology to be considered */
    public function getQualifiers( $szLang = null )
    /*--------------------------------------------*/
    {
        $aRetVal    = null;
        $aDirs      = null;

        if ( is_file( $szFile = V::FIL_RealPath( $this->home() . '/data/ontologies/' . $szLang . '/ontologies.txt' ) ) )
        {
            $aOntologies = file( $szFile,FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );

            foreach( $aOntologies as $szOntology )
            {
                //echo $szOntology,"\n";
                if ( preg_match( "/(?P<lang>en|fr|nl):(?P<name>.*?)=(?P<words>.*?)\z/i",$szOntology,$aMatches ) )
                {
                    //var_dump( $aMatches['words'] );
                    $aWords     = explode( ',',str_replace( array( '; ',', ',';' ),',',$aMatches['words'] ) );
                    $aRetVal[]  = array( 'lang'     => $aMatches['lang'],
                                         'name'     => $aMatches['name'],
                                         'words'    => $aWords          ,
                                       );
                }
            }
        }

        return ( $aRetVal );
    }   /* End of Taxonomizer.getQualifiers() ========================================= */
    /* ================================================================================ */


    public function appendOntology( $szConcept,$aWords,$szLang = 'fr' )
    /*---------------------------------------------------------------*/
    {
        $bRetVal = false;

        if ( ! is_dir( $szFolder = V::FIL_RealPath( $this->home() . '/data/ontologies/' . $szLang ) ) )
        {
            V::FIL_MkDir( $szFolder );
        }

        //var_dump( $szFolder );

        if ( is_dir( $szFolder ) )
        {
            $szFile = V::FIL_RealPath( $szFolder . '/' . V::FIL_KeepValidCharacters( strtolower( V::STR_stripAccents( trim( $szConcept ) ) ) ) . '.ontology.txt' );

            $szWords = implode( "\n",$aWords );
            V::FIL_Append( $szFile,$szWords );

            //foreach( $aWords as $szWord )
            //{
            //    if ( ! V::FIL_Append( $szFile,strtolower( trim( V::STR_Reduce( str_replace( array( "\n","\r","\r\n" ),'',$szWord ), ' ' ) ) ) ) )
            //        goto end;
            //}

            $bRetVal = true;
        }

        end:
        return ( $bRetVal );
    }   /* End of Taxonomizer.saveOntology() ========================================== */
    /* ================================================================================ */


    public function saveOntology( $szConcept,$aLines,$szLang = 'fr' )
    /*-------------------------------------------------------------*/
    {
        $bRetVal = false;

        if ( ! is_dir( $szFolder = V::FIL_RealPath( $this->home() . '/data/ontologies/' . $szLang ) ) )
        {
            V::FIL_MkDir( $szFolder );
        }

        //var_dump( $szFolder );

        if ( is_dir( $szFolder ) )
        {
            $szFile = V::FIL_RealPath( $szFolder . '/' . V::FIL_KeepValidCharacters( strtolower( V::STR_stripAccents( trim( $szConcept ) ) ) ) . '.ontology.txt' );

            if ( $fp = fopen( $szFile,'w+' ) )
            {
                foreach( $aLines as $szLine )
                    if ( ! empty( $szLine ) )
                        fwrite( $fp,$szLine . "\n" );

                fclose( $fp );
                $bRetVal = true;
            }
        }

        end:
        return ( $bRetVal );
    }   /* End of Taxonomizer.saveOntology() ========================================== */
    /* ================================================================================ */


    public function xinclude( $szFile )
    /*-------------------------------*/
    {
        $aRetVal = $aTerms;

        //foreach( $aTerms as $szTerm )
        //{
        //    if ( preg_match( "/%include\((?P<lang>.*?)\):\((?P<file>.*?)\)%/i",$szTerm,$aMatches ) )
        //    {
        //        $szLang = $aMatches['lang'];
        //        $szFile = $aMatches['file'];
        //
        //        echo $szLang,' ',$szFile,"\n";
        //    }
        //}

        return ( $aTerms );
    }   /* End of Taxonomizer.xinclude() ============================================== */
    /* ================================================================================ */


    public function addTermsToOntology( $aTerms,$szConcept,$szLang )
    /*-------------------------------------------------------------*/
    {
        $bRetVal = false;

        if ( is_array( $aTerms ) )
        {
            if ( is_null( $aLines = $this->getOntology( $szConcept,$szLang ) ) )
                $aLines = array();

            $aLines = array_unique( array_merge( $aLines,$aTerms ),SORT_STRING );

            usort( $aLines, function( $a,$b )
                            {
                                $a = mb_strtolower( $a );
                                $b = mb_strtolower( $b );

                                if ( $a === $b )
                                    return ( 0 );
                                if ( $a > $b )
                                    return ( 1 );
                                else
                                    return ( -1 );
                            }
                 );

            $bRetVal = $this->saveOntology( $szConcept,$aLines,$szLang );
        }

        return ( $bRetVal );
    }   /* End of Taxonomizer.addTermsToOntology() ==================================== */
    /* ================================================================================ */


    public function getOntology( $szConcept,$szLang = 'fr' )
    /*----------------------------------------------------*/
    {
        $aRetVal = null;

        if ( is_dir( $szFolder = V::FIL_RealPath( $this->home() . '/data/ontologies/' . $szLang ) ) )
        {
            if ( is_file( $szFile = V::FIL_RealPath( $szFolder . '/' . V::FIL_KeepValidCharacters( strtolower( V::STR_stripAccents( trim( str_replace( array( ' ','_' ),'-',$szConcept ) ) ) ) ) . '.ontology.txt' ) ) )
            {
                $aRetVal = file( $szFile,FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );

                //foreach ( $aRetVal as $szSentence )
                //{
                //    if ( preg_match( "/%include\((?P<lang>.*?)\):\((?P<file>.*?)\)%/i",$szSentence,$aMatches ) )
                //    {
                //        $szLang = $aMatches['lang'];
                //        $szFile = $aMatches['file'];
                //
                //        echo $szLang,' ',$szFile,"\n";
                //    }
                //}
            }
        }

        end:
        return ( $aRetVal );
    }   /* End of Taxonomizer.getOntology() =========================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*MISC_Taxonomize( $szResource[,$szLang][,$szType] )=

        Taxonomize a resource

        {*params
            $szResource (string)    The resource to taxonomize (a URL, a file, ...)
            $szLang     (string)    Language of the taxonomy
            $szType     (string)    Resource type
        *}

        {*return
            (array)     An array of words found in the $szResource resource
        *}

        {*warning
            Experimental function. Do not use ina production environment!
        *}

        {*example
            var_dump( MISC_Taxonomize( 'http://www.vaesoli.org' ) );
        *}

        *}}
     */
    /* ================================================================================ */
    function MISC_Taxonomize( $szResource = null,&$szLang = 'fr',$szType = 'url' )
    /*--------------------------------------------------------------------------*/
    {
        $this->die( __METHOD__ . '() NOT READY YET' );

        if ( empty( $szResource ) && $szType === 'url' )
        {
            $szResource = 'http://'                                     .
                           $_SERVER['SERVER_NAME']                      . /* www.ls.poc */
                           $_SERVER['SCRIPT_NAME']                      . /* /info.php */
                           isset( $_SERVER['QUERY_STRING'] )            ?
                                  ( '?' . $_SERVER['QUERY_STRING'] )    : /* ?hpp=klm */
                                  '';
        }   /* if ( STR_Empty( $szResource ) ) */

        $aWords         = array();                                      /* Return value of the function */
        $szURLPattern   = '/\b(?P<protocol>https?|ftp):\/\/(?P<domain>[-A-Z0-9.]+)(?P<file>\/[-A-Z0-9+&@#\/%=~_|!:,.;]*)?(?P<params>\?[A-Z0-9+&@#\/%=~_|!:,.;]*)?/si';
        $bFile          = false;
        $szCharset      = 'ISO-8859-15';
        $szCharset      = 'UTF-8';
        $szHeader       = '';                                           /* Response header */

        if ( preg_match( $szURLPattern,$szResource,$aParts ) ||
             ( $bFile = ( V::STR_iPos( $szResource,'file://' ) != -1 ) )
           )
        {
            if ( ! $bFile )                                             /* If URL must be considered (NOT a file) */
            {
                if ( $szType === 'string' )
                {
                    $szText = $szResource;
                }
                else
                {
                    if ( isset( $aParts['domain'] ) )
                    {
                        $aURLWords = STR_aUniqueWords( MISC_TopDomain( $aParts['domain'] ) );
                        $aWords = array_merge( $aWords,$aURLWords );
                    }   /* if ( isset( $aParts['domain'] ) ) */

                    if ( isset( $aParts['file'] ) )
                    {
                        $szFullFile = $aParts['file'];
                        $aFileParts = pathinfo( $szFullFile );
                        $szFile = '';

                        if ( isset( $aFileParts['dirname' ] ) )
                        {
                            $szFile .= $aFileParts['dirname' ];
                        }   /* if ( isset( $aFileParts['dirname' ] ) ) */

                        if ( isset( $aFileParts['filename' ] ) )
                        {
                            $szFile .= ' ' . $aFileParts['filename' ];
                        }   /* if ( isset( $aFileParts['filename' ] ) ) */

                        $szFile = trim( str_replace( '/',' ',$szFile ) );

                        $aURLWords = STR_aUniqueWords( $szFile );
                        $aWords = array_merge( $aWords,$aURLWords );
                    }   /* if ( isset( $aParts['file'] ) ) */

                    $iErrCode = 0;

                    if ( HTML_IsUTF8( $szText = HTTP_GetURL( $szResource,null /* user */,null /* pwd */,$iErrCode,null /* options */,$szHeader ) ) )
                    {
                        $szCharset = 'UTF-8';
                        //$szText = utf8_decode( $szText );
                        //echo "C'est de l'UTF 8";
                    }   /* if ( HTML_IsUTF8( $szText = HTTP_GetURL( ... ) ) ) */
                }
            }   /* if ( ! $bFile ) */
            else   /* Else of ... if ( ! $bFile ) */
            {
                if ( preg_match( '/file:\/\/(?P<file>.*)/si',$szResource,$aParts ) )
                {

                    if ( FIL_Exists( $szFile = FIL_Normalize( $aParts['file'] ) ) )
                    {
                        $szText = FIL_FileToStr( $szFile );
                    }   /* if ( FIL_Exists( $szFile = FIL_Normalize( $aParts['file'] ) ) ) */
                }   /* if ( preg_match( '/file:\/\/(?P<file>.*)/si',$szResource,$aParts ) ) */
            }   /* End of ... Else of ... if ( ! $bFile ) */

            //echo $szText;
            //die();

            if ( $szCharset === 'UTF-8' && isset( $szText ) )
            {
                //$szText = @iconv( $szCharset,"ISO-8859-1//TRANSLIT",str_replace( array('«','»'),array('"','"'),$szText ) );
                $szText = @iconv( $szCharset,"ISO-8859-1//TRANSLIT",$szText );
            }   /* if ( $szCharset === 'UTF-8' ) */

            /********************************************************************/
            /* Language detection (http://www.w3.org/TR/i18n-html-tech-lang/    */
            /********************************************************************/
            $szLanguage = null;

            /********************************************************************/
            /* Strategy #1: language extraction from the <html>...</html> tag   */
            /*                                                                  */
            /* Extract <html xmlns="http://www.w3.org/1999/xhtml" lang="en-US"> */
            /********************************************************************/
            {
                if ( isset( $szText ) && preg_match( '/<html.*?>/si',$szText,$aMatch ) )
                    $szHTMLTag = $aMatch[0];
                else
                    $szHTMLTag = '';

                /* If <html ...> tag found */
                if ( ! STR_Empty( $szHTMLTag ) )
                {
                    /* Looking for something like ... <html xmlns="http://www.w3.org/1999/xhtml" lang="en-US"> */
                    if ( preg_match( '/<html.*lang=(["\']{1})(.*?)\1.*?>/si',$szHTMLTag,$aMatch ) )
                    {
                        $szLanguage = $aMatch[2];
                    }   /* if ( preg_match( '/<html.*lang=(["\']{1})(.*?)\... ) */
                }   /* if ( ! STR_Empty( $szHTMLTag ) ) */
            }

            /********************************************************************/
            /* Strategy #2: language extraction from the Content-Language meta  */
            /*                                                                  */
            /* Extract <meta http-equiv="Content-Language" content="en" />      */
            /********************************************************************/
            if ( is_null( $szLanguage ) )                               /* If language NOT found yet */
            {
                /* This is the second best strategy to determine the language */
                if ( preg_match('/<meta *?http-equiv="Content-Language" *?content=(["\']{1})(.*?)\1.*?>/si',$szText,$aMatch ) )
                {
                    $szLanguage = $aMatch[2];
                }   /* if ( preg_match('/<meta *?http-equiv="Content...) ) */
            }   /* if ( is_null( $szLanguage ) ) */

            /********************************************************************/
            /* Strategy #3: Dublin core meta                                    */
            /*                                                                  */
            /* Extract <meta name="dc.language" content="en" />                 */
            /********************************************************************/
            if ( is_null( $szLanguage ) )                               /* If language NOT found yet */
            {
                /* This is the second best strategy to determine the language */
                if ( preg_match('/<meta *?name="dc.language" *?content=(["\']{1})(.*?)\1.*?>/si',$szText,$aMatch ) )
                {
                    $szLanguage = $aMatch[2];
                }   /* if ( preg_match('/<meta *?http-equiv="Content...) ) */
            }   /* if ( is_null( $szLanguage ) ) */

            /********************************************************************/
            /* Strategy #4: HTTP Header                                         */
            /*                                                                  */
            /* HTTP/1.1 200 OK                                                  */
            /* Date: Wed, 05 Nov 2003 10:46:04 GMT                              */
            /* Server: Apache/1.3.28 (Unix) PHP/4.2.3                           */
            /* Content-Location: CSS2-REC.en.html                               */
            /* Vary: negotiate,accept-language,accept-charset                   */
            /* Accept-Ranges: bytes                                             */
            /* Content-Length: 10734                                            */
            /* Connection: close                                                */
            /* Content-Type: text/html; charset=iso-8859-1                      */
            /* Content-Language: en                                             */
            /********************************************************************/
            if ( is_null( $szLanguage ) )                               /* If language NOT found yet */
            {
                if ( ! STR_Empty( $szHeader ) )                         /* If we go the header back */
                {
                    if ( preg_match( '/Content-Language: *?(?P<lang>.*?)$/sim',$szHeader,$aMatch ) )
                    {
                        if ( isset( $aMatch['lang'] ) )                 /* If match found */
                        {
                            $szLanguage = trim( $aMatch['lang'] );
                        }   /* if ( isset( $aMatch['lang'] ) ) */
                    }   /* if ( preg_match( '/Content-Language: *?(?P<lang>.*?)$/sim',$szHeader,$aMatch ) ) */
                }   /* if ( ! STR_Empty( $szHeader ) ) */
            }   /* if ( is_null( $szLanguage ) ) */

            /********************************************************************/
            /* Default handling:                                                */
            /********************************************************************/
            if ( is_null( $szLanguage ) )                               /* If language NOT found yet */
            {
                $szLanguage = 'fr';                                     /* Default language */
            }   /* if ( is_null( $szLanguage ) ) */

            /********************************************************************/
            /* Language assignment                                              */
            /********************************************************************/
            if ( ! is_null( $szLanguage ) )                             /* If language found ... mention it */
            {
                $szLang = $szLanguage;
            }   /* if ( ! is_null( $szLanguage ) ) */
            /********************************************************************/
            /* End of language detection                                        */
            /********************************************************************/

            //echo $szText;
            //die('ICI');

            //echo "<p>",__METHOD__,"() at line ",__LINE__,": appel de STR_UnEntities()</p>\n";
            $szText         = STR_UnEntities( $szText,$szCharset );     /* Entities turned back to their accented fluctions */
            //echo $szText;
            //die('ICI');

            $aUniqueWords   = STR_aUniqueWords( $szText );              /* Get an array of unique words */
            //var_dump( $aUniqueWords );
            $aWords         = array_merge( $aWords,$aUniqueWords );     /* Merge the unique words with the words we already collected */
            //die('ICI');

            $this->removeUnwantedWords( $aWords,$szLanguage );          /* Remove the unwanted words (ONLY French for the time being) */

            arsort( $aWords,SORT_NUMERIC );                             /* Sort the array */
        }   /* if ( preg_match( ... ) || ( $bFile = ( V::STR_iPos( ... ) != -1 ) ) ) */
        elseif ( $szType === 'string' )
        {

            die( "Il faut examiner une string" );
        }


        return ( $aWords );                                             /* Return result to caller */
    }   /* End of function MISC_Taxonomize() ========================================== */
    /* ================================================================================ */


    public function removeUnwantedWords( &$aWords,$szLang = 'fr' )
    /*----------------------------------------------------------*/
    {
        /* Faudrait que je prenne tous les adverbes de la langue française
           car ils ne me servent pas à qualifier les textes :
           http://www.linternaute.com/dictionnaire/fr/type/adverbe/1/ */
        $aUnwantedWords = array( /* Pronoms personnels */
                                 'je','me','moi','tu','te','toi','nous','vous','il','elle','ils','elles','se','en'  ,
                                 'le','la','les','lui','soi','leur','eux','lui',

                                 /* Pronoms démonstratifs */
                                 'celui','celle','ceux','celles','ce','ceci','cela','ça'                                ,

                                 /* Pronoms possessifs */
                                 'mien','tien','sien','mienne','tienne','sienne','miens','tiens','siens'                ,
                                 'miennes','tiennes','siennes','nôtre','vôtre','leur','nôtres','vôtres','leurs'         ,

                                 /* Adjectifs possessifs */
                                 'mon','ton','son','ma','ta','sa','mes','tes','ses','notre','votre','leur','nos','vos'  ,

                                 /* Pronoms relatifs */
                                 'qui','que','quoi','dont','où','lequel','auquel','duquel','laquelle','lesquels'        ,
                                 'auxquels','desquels','lesquelles','auxquelles','desquelles'                           ,

                                 /* chiffre - nombres */
                                 'un','deux','trois','quatre','cinq','six','sept','huit','neuf','dix','cent','mille'    ,

                                 /* adjectifs démonstratifs */
                                 'ce','cet','cette','ces',

                                 /* adverbes - temps */
                                 'quelquefois','parfois','autrefois','sitôt','bientôt','aussitôt','tantôt','alors'  ,
                                 'après','ensuite','enfin','abord','premièrement','soudain','aujourd','demain'      ,
                                 'hier','auparavant','avant','cependant','déjà','demain','depuis','désormais'       ,
                                 'enfin','ensuite','jadis','jamais','maintenant','puis','quand','souvent'           ,
                                 'entrefaites','toujours','tard','tôt'                                              ,

                                 /* adverbes - manière */
                                 'bien','comme','mal','volontiers','aveuglette','nouveau','larigot','admirablement' ,
                                 'ainsi','aussi','bel','bien','comment','guingois','debout','également','ensemble'  ,
                                 'exprès','mieux','importe','comment','pire','pis','plutôt','bon','bonne','presque' ,
                                 'vite',

                                 /* adverbes - affirmation */
                                 'assurément','certainement','certes','oui','précisément','probablement'            ,
                                 'volontiers','vraiment',

                                 /* adverbes - lieu */
                                 'ici','ailleurs','alentour','arrière','autour','dedans','dehors','derrière'        ,
                                 'dessous','devant','là','loin','où','partout','près',

                                 /* adverbes - laison */
                                 'ainsi','aussi','pourtant','néanmoins','toutefois','cependant','effet','puis'      ,
                                 'ensuite','pourquoi','conséquent',

                                 /* adverbes - quantité */
                                 'quasi','davantage','plus','moins','ainsi','assez','aussi','autant','beaucoup'     ,
                                 'combien','encore','environ','fort','guère','presque','peu','si','tant','tellement',
                                 'tout','très','trop','peu',

                                 /* adverbes - négation */
                                 'non','vrai','faux',

                                 /* articles définis et indéfinis */
                                 'un','une','des','le','la','les','au','aux','du','de',

                                 /* Couleurs */
                                 'blanc','noir','rouge','vert','bleu','gris','brun',

                                 /* Fourre-tout ... à nettoyer */
                                 'grand','grande','petit','petite','énorme','minuscule',
                                 'ce','cet','cette','là','ou','et','donc'   ,
                                 'es','est','sont','vont','comme'           ,
                                 'ai','as','a','avons','avez','ont','pas','être','comment',

                                 'du','de','des'            ,
                                 'une','ma','ta','sa','mon' ,
                                 'nos','vos',

                                 'qui','que','quoi','quel','quels','quelles','lequel','laquelle','lesquels','lesquelles',
                                 'dans','dehors','autre','autres'               ,
                                 'par','avec','aussi','pour','sur','car','peut' ,
                                 'beaucoup','aucun','aucune','insuffisamment','assez','insuffisamment',
                                 'tout','toutes','tous',
                                 'bienvenu','bienvenue',
                                 'même','ainsi','selon','puisque','sans'                 ,
                                 'lui','ces','ce','notamment','mal','bien','chez','bon','bonne' ,
                                 'vers','jusqu','parfois','souvent','pendant','cependant','quoique','celui','seul','seule',
                                 'fois','à','aux','tel','tels','ici','là'           ,
                                 'quant','quand','dès','voire','lorsque','plus','moins'     ,
                                 'afin','étant','mais',
                               );

        foreach( $aUnwantedWords as $szWord )
        {
            if ( isset( $aWords[$szWord] ) )
            {
                unset( $aWords[$szWord] );
            }
        }

    }   /* End of Taxonomizer.removeUnwantedWords() =================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toForm( [$szConcept[,$szWords]] )=

        Returns the object as a form

        {*params
            $szConcept      (string)    The concept. Optional. Empty string by default.
            $szWords        (string)    The words (\n separated). Optional. Empty string
                                        by default.
        *}

        {*return
            (string)        HTML Code corresponding to a form of the object
        *}

        *}}
    */
    /* ================================================================================ */
    public function __toForm( $szConcept = '',$szWords= '' ): string
    /*------------------------------------------------------------*/
    {
        $szRetVal = '';

        $oForm                      = new Form();
        $oForm->szClass             = $this->szClass;
        $oForm->szOnSubmit          = '';

        $oForm->settings['withBR']  = false;

        {   /* Create a fieldset and add the field set to the form */
            $oFieldset              = new Fieldset();
            $oFieldset->szCaption   = 'taxonomizer';

            {   /* Adding zones to the fieldset */
                $oFieldset->add( new Input( array( 'name'           =>  'Concept'                                       ,
                                                   'type'           =>  'txt'                                           ,
                                                   'label'          =>  'Concept'                                       ,
                                                   'lang'           =>  'en'                                            ,
                                                   'tooltip'        =>  'Concept to associate words with'               ,
                                                   'required'       =>  true                                            ,
                                                   'delete'         =>  true                                            ,
                                                   'help'           =>  false                                           ,
                                                   'value'          =>  $szConcept                                      ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Words'                                         ,
                                                   'type'           =>  'edt'                                           ,
                                                   'label'          =>  'Words'                                         ,
                                                   'lang'           =>  'en'                                            ,
                                                   'tooltip'        =>  'One set of words per line'                     ,
                                                   'required'       =>  true                                            ,
                                                   'delete'         =>  true                                            ,
                                                   'help'           =>  false                                           ,
                                                   'rows'           =>  8                                               ,
                                                   'value'          =>  $szWords                                        ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Submit'                                        ,
                                                   'type'           =>  'cmd'                                           ,
                                                   'class'          =>  'shadow'                                        ,
                                                   'lang'           =>  'en'                                            ,
                                                   'tooltip'        =>  'Click to submit the values of a new task'      ,
                                                   'value'          =>  'Create'                                        ,
                                                 ) ) );
            }   /* Adding zones to the fieldset */

            $oForm->add( $oFieldset );

        }   /* Create a fieldset and add the field set to the form */

        //var_dump( $oForm );

        return ( (string) $oForm );
    }   /* End of Taxonomizer.__toForm() ============================================== */
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
    }   /* End of Taxonomizer.__destruct() ============================================ */
    /* ================================================================================ */
}   /* End of class Taxonomizer ======================================================= */
/* ==================================================================================== */
