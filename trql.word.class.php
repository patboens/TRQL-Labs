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
    {*file                  trql.word.class.php *}
    {*purpose               Smallest linguistic element that may be uttered in
                            isolation with semantic or pragmatic content *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 08-11-20 13:43:12 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 08-11-20 13:43:12 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\quitus;

use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\quitus\LexicalItem    as LexicalItem;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'LEXICALITEM_CLASS_VERSION' ) )
    require_once( 'trql.lexicalitem.class.php' );

defined( 'WORD_CLASS_VERSION' ) or define( 'WORD_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Word=

    {*desc

        Smallest linguistic element that may be uttered

    *}

    {*doc [url]https://www.wikidata.org/wiki/Q8171[/url] *}

    *}}

 */
/* ==================================================================================== */
class Word extends LexicalItem
/*--------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property       $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $hasDefinedTerm                 = null;             /* {*property       $hasDefinedTerm                 (DefinedTerm)                   A Defined Term contained in this term set. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q8171';          /* {*property       $wikidataId                     (string)                        Smallest linguistic element that may be uttered
                                                                                                                                                        in isolation with semantic or pragmatic content *} */
    public      $value                          = null;             /* {*property       $value                          (string)                        The value of the word we're currently working with. *} */
    public      $szLang                         = null;             /* {*property   $szLang                             (string)                        Language of the word we're currently working with. *} */

    /*  Notes préliminaires concernant le traitement de la langue française via le
        Morphalou

        //// Ici ... c'est autre chose ... c'est un test Morphalou!!!
        //
        //$szFile = 'd:\\websites\\latosensu.be\\www\\databases\\Morphalou-2.0.xml';
        //
        //if ( vaesoli::FIL_Exists( $szFile ) )
        //{
        //    echo "<p>{$szFile} FOUND!!!</p>";
        //    $oDom = new DOMDocument();
        //
        //    if ( $oDom->load( $szFile ) )
        //    {
        //        //echo "<p>Loaded!!!</p>";
        //        $oXPath = new DOMXPath( $oDom );
        //
        //        $oWordList = $oXPath->query( '//lemmatizedForm/orthography' );
        //        //$oWordList = $oXPath->query( '//orthography' );
        //
        //        if ( $oWordList && $oWordList->length > 0 )
        //        {
        //            var_dump( 'FOUND WORDS: ' . $oWordList->length );
        //            echo "<ol>";
        //            foreach( $oWordList as $oNode )
        //            {
        //                echo "<li>{$oNode->nodeValue}</li>\n";
        //            }
        //            echo "</ol>";
        //        }
        //    }
        //}

        // Il faut absolument consulter D:\websites\trql.fm\www\httpdocs\toolbox\create-key-phrases.php


    */


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
    }   /* End of Word.__construct() ================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*protected cacheName( $szMethod,$xParams[,$xAdditional] )=

        Computes the name of a .cache file based on parameters

        {*params
            $szMethod               (string)    Method associated to the cache
            $xParams                (mixed)     Any set of parameters that determine
                                                the name of the cache
            $xAdditional            (mixed)     Any set of additional parameters that
                                                may determine the name of the cache.
                                                Optional. [c]null[/c] by default
        *}

        {*return
            (string)        Name of a .cache file
        *}

        {*warning           12-11-20 12:14:42 : cannot process any other language
                            than French!
        *}

        *}}
    */
    /* ================================================================================ */
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
    }   /* End of Word.cacheName() ==================================================== */
    /* ================================================================================ */


    // Analyse de sentiments...
    // https://api.cloudmersive.com/docs/nlp.asp
    // Exemple cURL:
    // curl --location --request POST 'https://api.cloudmersive.com/nlp-v2/analytics/sentiment' \
    // --header 'Content-Type: application/x-www-form-urlencoded' \
    // --header 'Apikey: YOUR-API-KEY-HERE' \
    // --data-urlencode 'TextToAnalyze=<string>'


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
            As we are dealing possibly with multiple external API calls, we may have
            several API keys to consider. That's what the @param.system parameter is for.
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

        //var_dump( $szCave );

        if ( is_file( $szFile = vaesoli::FIL_RealPath( $this->szHome . $szCave ) ) )
            return ( vaesoli::FIL_FileToStr( $szFile ) );
        else
            return ( null );
    }   /* End of Word.getAPIKey() ==================================================== */
    /* ================================================================================ */


    // https://www.wordsapi.com/docs/
    protected function callWordAPI( $szWord )
    /*-------------------------------------*/
    {
        $oRetVal    = null;
        $curl       = curl_init();

        $szSecret   = $this->getAPIKey( 'wordapi' );
        //var_dump( $szSecret );

        curl_setopt_array( $curl, [
                                	CURLOPT_URL             => "https://wordsapiv1.p.rapidapi.com/words/{$szWord}"  ,
                                	CURLOPT_RETURNTRANSFER  => true                                                 ,
                                	CURLOPT_FOLLOWLOCATION  => true                                                 ,
                                	CURLOPT_ENCODING        => ""                                                   ,
                                    CURLOPT_SSL_VERIFYHOST  => false                                                ,
                                    CURLOPT_SSL_VERIFYPEER  => false                                                ,
                                	CURLOPT_MAXREDIRS       => 10                                                   ,
                                	CURLOPT_TIMEOUT         => 30                                                   ,
                                	CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1                                ,
                                	CURLOPT_CUSTOMREQUEST   => "GET"                                                ,
                                	CURLOPT_HTTPHEADER      => [ "x-rapidapi-host: wordsapiv1.p.rapidapi.com"       ,
                                	                    	     "x-rapidapi-key: {$szSecret}"
                                	                           ],
                                  ] );

        $response   = curl_exec($curl);
        $err        = curl_error($curl);

        curl_close( $curl );

        if ( $err )
        {
        	echo "cURL Error #:" . $err;
        }
        else
        {
            $oRetVal = json_decode( $response );
        }

        return ( $oRetVal );
    }   /* End of Word.callWordAPI() ================================================== */
    /* ================================================================================ */


    protected function parseCNRTLResults( &$szHTML,$szCategory )
    {
        $aRetVal = null;

        if ( preg_match_all( '%<span(\b| *?)class="tlf_cdefinition"[^>]*>(?P<definition>.*?)</span>%' ,$szHTML,$aMatches,PREG_PATTERN_ORDER ) )
        {
            $aMatches = $aMatches[0];
            //var_dump( "RegEx Matches",$aMatches );

            foreach( $aMatches as $szMatch )
            {
                //if ( preg_match( "%<a.*>(?P<term>.*?)</a>%si",$szMatch,$aParts ) )
                if ( preg_match( '%<span(\b| *?)class="tlf_cdefinition"[^>]*>(?P<definition>.*?)</span>%',$szMatch,$aDefinitions ) )
                {
                    $szDef      = strip_tags( $aDefinitions['definition'] );
                    $aRetVal[]  = $szDef;
                }   /* if ( preg_match( "%<a.*>(?P<term>.*?)</a>%si",$szMatch,$aParts ) ) */
            }   /* foreach( $aMatches as $szMatch ) */
        }   /* if ( preg_match_all('%<td class="syno_format">(.*?)</td>%si', $szHTML,$aMatches,PREG_PATTERN_ORDER ) ) */

        return ( $aRetVal );
    }


    /* ================================================================================ */
    /** {{*searchLinguee( $szTerm )=

        Search a term on Linguee

        {*params
            $szTerm         (string)    Term we look for
        *}

        {*return
            (array)         An array of associative sentences
        *}

        {*warning           12-04-21 13:05 : Linguee blocks the requests
                            after it has detected that the same computer has sent too
                            many requests:

                            You have sent too many requests causing Linguee to
                            block your computer

                            To prevent automatic queries by computer programs,
                            Linguee only allows a certain number of queries per
                            computer.

                            For users with disabled Javascript, this number is
                            much lower than for those with enabled Javascript.
                            The following steps may be helpful to prevent your
                            computer from being blocked again: enable Javascript
                            in your browser settings, wait for a few hours, and
                            then try using Linguee again.

                            If your computer is part of a large network that is
                            protected by an NAT/Firewall with many users within
                            your network using Linguee concurrently, please
                            contact us.
        *}

        *}}
    */
    /* ================================================================================ */
    function searchLinguee( $szTerm )
    /*-----------------------------*/
    {
        $aRetVal    = null;
        $szURL      = "https://www.linguee.com/english-french/search?source=auto&query=" . urlencode( $szTerm );

        // Dans les résultats rendus, French est souvent en colonne 1 (donc #0)
        // Mais ce n'est pas toujours le cas => il faut détecter la langue dans laquelle
        // le tout premier résultat est rendu pour savoir si on a vraiment du français ou
        // pas!
        $iFrenchCol     = 0;
        $iEnglishCol    = 1;

        $szLang         = null;     /* There is NO default language and at this point we don't know the language: we shall determine it later (see $veryFirst) */

        $szService      = 'linguee';
        $szCacheFile    = $this->cacheName( $szService                                  ,
                                            $xParams        = array( 'url'  => $szURL   ,
                                                                   )                    ,
                                            $xAdditional    = null );

        if ( true && $this->remembering && is_file( $szCacheFile ) && $this->fileExistsAndNoOlderThan( $szCacheFile,$iTTL = 86400 * 250 /* 250 days */) )
        {
            $aRetVal = $this->getCache( $szCacheFile );
            $this->addInfo( __METHOD__ . "(): data obtained from {$szCacheFile}" );
            //var_dump( "Pas d'appel à Linguee" );
            goto end;
        }

        if ( ! empty( $szHTML = Vaesoli::HTTP_getURL( $szURL ) ) )
        {
            $oDom = new \DOMDocument();

            if ( @$oDom->loadHTML( $szHTML ) )
            {
                //var_dump( "HTML Loaded" );

                $oXPath = new \DOMXPath( $oDom );
                //var_dump( $oXPath );

                // Bon, cela fonctione comment?
                // 1) On appelle l'URL avec le mot qu'on cherche en paramètre "query"
                // 2) On cherche une table de résultats dans ce qui est retourné (id=result_table)
                // 3) On cherche toutes les lignes de la table
                // 4) Pour chaque ligne, il y a 2 colonne (1 avec le français et l'autre avec l'anglais)
                // 5) Comme chaque colonne a plusieurs tags en interne, on doit les éliminer.
                //    C'est pour cette raison que je m'en remets à une expression régulière
                //    sur le contenu du noeud (utilisation de saveXML)
                // 6) J'extrais tout le texte que je trouve jusqu'à <div class="source_url_spacer">
                //    Ce qui précède m'intéresse, ce qui suit ne m'intéresse pas!
                $oColl = $oXPath->query( "//table[@id='result_table']" );

                if ( $oColl && $oColl->length > 0 )
                {
                    //var_dump( "FOUND RESULTS",$oColl );

                    $oTable = $oColl->item(0);

                    if ( ( $oRows = $oTable->getElementsByTagName('tr') ) && $oRows->length > 0 )
                    {
                        //var_dump( "FOUND ROWS",$oRows );
                        foreach ( $oRows as $oRowNode )
                        {
                            //var_dump( $oRowNode->nodeName );

                            if ( ( $oCols = $oRowNode->getElementsByTagName('td') ) && $oCols->length > 0 )
                            {
                                $i = 0;
                                $aSentence = null;
                                $veryFirst   = true;
                                foreach( $oCols as $oColNode )
                                {
                                    //var_dump( $oColNode->getAttribute( 'class' ),$oColNode->nodeValue );
                                    // Bon, maintenant le texte se trouve dans une division de classe "wrap"
                                    if ( ( $oWrap = $oXPath->query( 'div[contains(@class,"wrap")]',$oColNode ) ) && $oWrap->length > 0 )
                                    {
                                        $oDivNode = $oWrap->item(0);
                                        $szXML = $oDom->saveXML( $oDivNode );

                                        if ( preg_match('/(?P<keep>.*?)<div class="source_url_spacer">(?P<discard>.*)/sim',$szXML,$aMatches ) )
                                        {
                                            $szSentence = Vaesoli::STR_Reduce( trim( str_replace( array( chr(10),chr(13),'&#13;','[...]' ),' ',strip_tags( $aMatches['keep'] ) ) ) );
                                            $aSentence[$i++] = $szSentence;

                                            if ( $veryFirst  )
                                            {
                                                $szLang = Vaesoli::STR_detectLanguage( $szSentence,'fr' );
                                                if ( $szLang !== 'fr' )
                                                {
                                                    $iEnglishCol    = 0;
                                                    $iFrenchCol     = 1;
                                                }
                                                $veryFirst = false;
                                            }   /* if ( $veryFirst  ) */
                                            //var_dump( $szSentence );
                                        }
                                    }
                                }   /* foreach( $oCols as $oColNode ) */
                                $aRetVal[] = array( 'term'      => $szTerm                                      ,
                                                    'lang'      => $szLang                                      ,
                                                    'sentences' => array( 'french'  => $aSentence[$iFrenchCol ] ,
                                                                          'english' => $aSentence[$iEnglishCol] ,
                                                                        )                                       ,
                                                  );
                            }   /* if ( ( $oCols = $oRowNode->getElementsByTagName('td') ... ) */
                        }   /* foreach ( $oRows as $oRowNode ) */

                        if ( $this->storing && is_array( $aRetVal ) && count( $aRetVal ) > 0 )
                        {
                            $this->saveHashFile( $szCacheFile,$aRetVal );
                            $this->addInfo( __METHOD__ . "(): examples of {$szTerm} stored in {$szCacheFile}" );
                        }   /* if ( $this->storing ) */
                    }   /* if ( ( $oRows = $oTable->getElementsByTagName() ... ) */
                }   /* if ( $oColl && $oColl->length > 0 ) */
            }   /* if ( @$oDom->loadHTML( $szHTML ) ) */
        }   /* if ( ! empty( $szHTML = V::HTTP_getURL( $szURL ) ) ) */
        else
        {
            //var_dump( $szHTML );
        }

        end:
        return ( $aRetVal );
    }   /* End of Word.searchLinguee() ================================================ */
    /* ================================================================================ */


    /* Add a sentence as an example of where a word appears */
    public function addWordSentence( $szWord,$szLang,$szSentence )
    /*----------------------------------------------------------*/
    {
        $bRetVal        = false;

        $this->value    = $szWord;
        $this->szLang   = $szLang;

        $aMap   = $this->map( $this->szLang . '-' . $this->value );
        $szHome = Vaesoli::FIL_RealPath( $this->home() . '/' . $this->szLang . '/' . $aMap['level1'] .
                                                                               '/' . $aMap['level2'] .
                                                                               '/' . $aMap['level3'] .
                                                                               '/' . $aMap['level4'] .
                                                                               '/' . $aMap['levelA'] .
                                                                               '/' . $aMap['levelB'] .
                                                                               '/examples');
        //if     ( $szLang === 'fr' )
        //    $szSha256 = 'fr-' . hash( 'sha256',$szExample = $aExample['french' ] );
        //elseif ( $szLang === 'en' )
        //    $szSha256 = 'en-' . hash( 'sha256',$szExample = $aExample['english'] );

        if     ( $szLang === 'fr' )
            $szSha256 = 'fr-' . hash( 'sha256',$szSentence );
        elseif ( $szLang === 'en' )
            $szSha256 = 'en-' . hash( 'sha256',$szSentence );

        //var_dump( $szWord,$szHome,$szSha256,$szSentence,$aMap );

        if ( ! is_dir( $szHome ) )
        {
            if ( vaesoli::FIL_MkDIr( $szHome ) )
                $this->addInfo( __METHOD__ . "(): '{$szHome}' created" );
            else
                $this->addInfo( __METHOD__ . "(): '{$szHome}' CANNOT be created" );
        }

        // C'est ici que sont stockées TOUTES les phrases
        $szExamplesHome = Vaesoli::FIL_RealPath( $this->home() . '/sentences' );

        // Je calcule un map pour la phrase
        $aSentenceMap   = $this->map( $szSentence );
        $szSentenceHome = vaesoli::FIL_RealPath( $szExamplesHome . '/' . $aSentenceMap['level1'] .
                                                                   '/' . $aSentenceMap['level2'] .
                                                                   '/' . $aSentenceMap['level3'] .
                                                                   '/' . $aSentenceMap['level4'] .
                                                                   '/' . $aSentenceMap['levelA'] .
                                                                   '/' . $aSentenceMap['levelB'] );

        $szSentenceFile = vaesoli::FIL_RealPath( $szSentenceHome . '/' . $szSha256 );


        // Ceci est le fichier de la phrase (son sha256) ... c'est CE fichier que je vais sauver
        // dans le map du mot
        if ( ! is_file( $szSha256File = vaesoli::FIL_RealPath( $szHome . '/' . $szSha256 ) ) )
        {
            // À l'intérieur du fichier, il y a le répertoire où la phrase est réellement stockée
            if ( vaesoli::FIL_StrToFile( $szSentenceFile,$szSha256File ) )
                $this->addInfo( __METHOD__ . "(): '{$szSha256File}' created" );
            else
                $this->addInfo( __METHOD__ . "(): '{$szSha256File}' CANNOT be created" );
        }

        //var_dump( $szSentenceHome );

        if ( ! is_dir( $szSentenceHome ) )
        {
            if ( vaesoli::FIL_MkDIr( $szSentenceHome ) )
                $this->addInfo( __METHOD__ . "(): '{$szSentenceHome}' created" );
            else
                $this->addInfo( __METHOD__ . "(): '{$szSentenceHome}' CANNOT be created" );
        }

        // Maintenant ... il faut sauver la phrase ! Ouf!
        if ( ! is_file( $szSentenceFile ) )
            if ( $bRetVal = vaesoli::FIL_StrToFile( $szSentence,$szSentenceFile ) )
                $this->addInfo( __METHOD__ . "(): '{$szSentence}' saved in '{$szSentenceFile}" );
            else
                $this->addInfo( __METHOD__ . "(): '{$szSentenceFile}' CANNOT be saved" );
        else
        {
            $this->addInfo( __METHOD__ . "(): '{$szSentenceFile}' ALREADY exists" );
            $bRetVal = true;
        }

        //var_dump( $szSentenceFile );

        return( $bRetVal );

    }   /* End of Word.addExample() =================================================== */
    /* ================================================================================ */


    public function hasSubDirs( $szDir )
    {
        return ( ! empty( $aTmp = glob( $szDir . '/*',GLOB_ONLYDIR ) ) );
    }

    public function subDirs( $szDir )
    {
        return ( glob( $szDir . '/*',GLOB_ONLYDIR ) );
    }

    /* Returns all the directories in which we can find sample sentences */
    public function getSentenceDirs()
    /*-----------------------------*/
    {
        $aDirs = glob( $this->home() . '/sentences/*',GLOB_ONLYDIR );
    }   /* End of Word.getSentenceDirs() ============================================== */
    /* ================================================================================ */


    /* Returns all the files found in $szDir (each file is supposed to contain a sentence) */
    public function getSentenceFiles( $szDir )
    {
        if ( is_array( $aFiles = glob( $szDir . '/*' ) ) )
            return ( $aFiles );
        else
            return ( null );
    }   /* End of Word.getSentenceFiles() ============================================= */
    /* ================================================================================ */


    public function random( $iMin,$iMax )
    {
        static $aPrimes = null;

        $aPrimes = Vaesoli::NUM_getPrimes( array( 'algo'     => 'max'   ,
                                                  'value'    => 32000   ,
                                                   ) );

         


        $iSeed = vaesoli::STR_Ascii2( vaesoli::guid() );

        



        if ( is_array( $aPrimes ) )
            $tail = end( $aPrimes );
        else
            $tail = count( $aDirs ) - 1;

        if ( $tail === 0 )
            $tail = 1;

        // BON, ICI, JE DOIS ME SERVIR DE aPrimes POUR GENERER
        // UN NOMBRE ALEATOIRE. EXIT TOUT TRUC DE MT_RAND() ... JE
        // NE ME SERS QUE DES NOMBRES PRIME ET DE STR_Ascii2


    }


    /* Returns $iHowMany sentences found in $szDir at random  (1 by default) */
    public function getSentencesAtRandom( $szDir = null,$iHowMany = 1 )
    /*--------------------------------------------------------------*/
    {
        $aRetVal = null;
        $aPrimes = null;

        $this->random( 15,35 );


        for ( $i = 1;$i < $iHowMany; $i++ )
        {
            $aDirs = glob( $szDir ?? $this->home() . '/sentences/*',GLOB_ONLYDIR );

            if ( is_array( $aDirs ) && ( $iMax = count( $aDirs ) ) > 0 )
            {
                $aPrimes = Vaesoli::NUM_getPrimes( array( 'algo'     => 'max'  ,
                                                          'value'    => $iMax    ,
                                                        ) );
                //var_dump( $aPrimes );

                if ( is_array( $aPrimes ) )
                    $tail = end( $aPrimes );
                else
                    $tail = count( $aDirs ) - 1;

                if ( $tail === 0 || is_null( $tail ) )
                    $tail = 1;

                // BON, ICI, JE DOIS ME SERVIR DE aPrimes POUR GENERER
                // UN NOMBRE ALEATOIRE. EXIT TOUT TRUC DE MT_RAND() ... JE
                // NE ME SERS QUE DES NOMBRES PRIME ET DE STR_Ascii2

                $iSlot = vaesoli::STR_Ascii2( vaesoli::guid() ) % $tail;
                //echo "Salut";
                //die();
                //echo end( $aPrimes ) . ' vs ' . $iMax . ' = ' . $iSlot;
                //goto end;

                //$szDir = $aDirs[ mt_rand( 0,count( $aDirs ) - 1 ) ];
                $szDir = $aDirs[ $iSlot ];

                while ( ! empty( $aDirs = glob( $szDir . '/*',GLOB_ONLYDIR ) ) )
                {
                    $aPrimes    = Vaesoli::NUM_getPrimes( array( 'algo'     => 'max'            ,
                                                                 'value'    => count( $aDirs )  ,
                                                               ) );
                    if ( is_array( $aPrimes ) )
                        $tail = end( $aPrimes );
                    else
                        $tail = count( $aDirs ) - 1;

                    if ( $tail === 0 || is_null( $tail ) )
                        $tail = 1;
                    //mt_srand( vaesoli::STR_Ascii2( vaesoli::guid() ) % 2579 );
                    $iSlot = vaesoli::STR_Ascii2( vaesoli::guid() ) % $tail;

                    echo $tail . ' vs ' . $iSlot;

                    //goto end;
                    $szDir = $aDirs[ $iSlot ];
                }

                $szDir = vaesoli::FIL_RealPath( $szDir );

                if ( is_array( $aFiles = $this->getSentenceFiles( $szDir ) ) )
                    $aRetVal[] = file_get_contents( $szFile = $aFiles[ mt_rand( 0,count( $aFiles ) - 1 ) ] );
            }   /* if ( is_array( $aDirs ) && count( $aDirs ) > 0 ) */
        }   /* for ( $i = 1;$i < $iHowMany; $i++ ) */

        end:
        return ( $aRetVal );

    }   /* End of Word.getSentencesAtRandom() ========================================= */
    /* ================================================================================ */


    public function getWordSentences( $szWord,$szLang )
    /*-----------------------------------------------*/
    {
        $aRetVal        = null;

        $this->value    = $szWord;
        $this->szLang   = $szLang;

        $aMap   = $this->map( $this->szLang . '-' . $this->value );
        $szHome = Vaesoli::FIL_RealPath( $this->home() . '/' . $this->szLang . '/' . $aMap['level1'] .
                                                                               '/' . $aMap['level2'] .
                                                                               '/' . $aMap['level3'] .
                                                                               '/' . $aMap['level4'] .
                                                                               '/' . $aMap['levelA'] .
                                                                               '/' . $aMap['levelB'] .
                                                                               '/examples');
        //var_dump( "On me demande des examples de phrases qui contiennent '{$szWord}" );
        //var_dump( $szHome );

        if ( is_array( $aFiles = vaesoli::FIL_aFilesEx( $szHome . '/*' ) ) && count( $aFiles ) > 0 )
        {
            foreach( $aFiles as $szFile )
            {
                $szSentenceFile = vaesoli::FIL_FileToStr( $szFile );
                $aRetVal[] = vaesoli::FIL_FileToStr( $szSentenceFile );
            }
        }

        //var_dump( $aFiles );

        return ( $aRetVal );
    }   /* End of Word.getWordSentences() ============================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*search( $szTerm[,$szLang[,$szGrammaticalCategory]] )=

        Search a synonym for a term

        {*params
            $szTerm                 (string)    Term associated to the cache
            $szLang                 (string)    Optional language. [c]fr[/c] by
                                                default
            $szGrammaticalCategory  (string)    Optional grammatical category. Can
                                                be [c]adjectif[/c], [c]adverbe[/c],
                                                [c]interjection[/c], [c]substantif[/c]
                                                (default) and[c]verbe[/c].
        *}

        {*return
            (array)         An array of associative arrays which are possible returns
        *}

        {*warning           12-11-20 12:14:42 : cannot process any other language
                            than French!
        *}

        {*example
            use \trql\vaesoli\Vaesoli       as Vaesoli;
            use \trql\synonym\Synonym       as Synonym;

            // Create a new object
            $oSynonym = new Synonym();

            // If results found
            if ( ! is_null( $aRetVal = $oSynonym->search( 'susciter','fr','verbe' ) ) )
            {
                // Display each synonym
                foreach( $aRetVal as $szSynonym )
                    var_dump( $szSynonym );
            }
        *}

        For English dictionary we can use https://www.wordsapi.com/

        *}}
    */
    /* ================================================================================ */
    //public function search( $szTerm,$szLang = 'fr',$szGrammaticalCategory = 'substantif' )
    public function search( $szTerm,$szLang = 'fr',$szGrammaticalCategory = null )
    /*----------------------------------------------------------------------------------*/
    {
        $aRetVal = null;

        // Stratégies additionnelles disponible :
        // D:\websites\latosensu.be\www\httpdocs\webservices\synonyms.php

        //var_dump( $szTerm,$szLang,$szGrammaticalCategory );
        //die();

        switch ( strtolower( trim( $szLang ) ) )
        {
            case 'fr'   :
                {
                    $szService              = 'definitions';
                    $szBaseURL              = "https://www.cnrtl.fr/definition/";
                    // La forme grammaticale devrait être déterminée par une analyse du
                    // terme avec le Morphalou
                    if ( is_string( $szGrammaticalCategory ) )
                        $szGrammaticalCategory  = '/' . strtolower( trim( $szGrammaticalCategory ) );

                    //$szURL                  = "{$szBaseURL}" . str_replace( '//','/',$szTerm . "/" . $szGrammaticalCategory );
                    $szURL                  = "{$szBaseURL}" . str_replace( '//','/',$szTerm . $szGrammaticalCategory );

                    $szCacheFile            = $this->cacheName( $szService                                  ,
                                                                $xParams        = array( 'url'  => $szURL   ,
                                                                                         'lang' => $szLang  ,
                                                                                       )                    ,
                                                                $xAdditional    = null );

                    if ( true && $this->remembering && is_file( $szCacheFile ) && $this->fileExistsAndNoOlderThan( $szCacheFile,$iTTL = 86400 * 200 /* 200 days */) )
                    {
                        //var_dump( "GOT AN ANSWER FROM THE CACHE");
                        //die();
                        $aRetVal = $this->getCache( $szCacheFile );
                        $this->addInfo( __METHOD__ . "(): data obtained from {$szCacheFile}" );
                        goto end;
                    }   /* if ( true && $this->remembering && ... ) */
                    else    /* Else of ... if ( true && $this->remembering && ... ) */
                    {
                        /************************************************************************************/
                        /* NOTE DU 10-04-21 11:06:33                                                        */
                        /************************************************************************************/
                        /* Je me demande si on ne devrait pas faire autant de passe qu'on a de possibilités */
                        /* de catégories grammaticales. Par exemple, le mot "matinée":                      */
                        /*                                                                                  */
                        /*  - https://www.cnrtl.fr/definition/matinée/adjectif(qui donne un résultat)       */
                        /*  - https://www.cnrtl.fr/definition/matinée/adverbe (qui ne donne rien)           */
                        /*  - https://www.cnrtl.fr/definition/matinée/substantif (qui donne un résultat     */
                        /*    différent)                                                                    */
                        /*  - https://www.cnrtl.fr/definition/matinée/verbe (qui donne un autre résultat)   */
                        /*  - https://www.cnrtl.fr/definition/matinée/interjection (etc.)                   */
                        /*                                                                                  */
                        /* Et puis, je regrouperais les résultats pour adjectif, pour substantif et pour    */
                        /* verbe. Comme adverbe ne donne rien, il ne serait pas renseigné OU serait         */
                        /* renseigné en disant qu'il n'y a pas de résultat                                  */
                        /************************************************************************************/

                        $aRetVal = array();

                        foreach( $aAttempts = ['substantif','verbe','adjectif','adverbe','interjection'] as $szCategory )
                        {
                            $szURL = $szBaseURL . $szTerm . '/' . $szCategory;
                            //var_dump( "URL = " . $szURL );

                            if ( ! empty( $szHTML = $this->getURL( $szURL ) ) )
                            {
                                if ( ! is_null( $x = $this->parseCNRTLResults( $szHTML,$szCategory ) ) )
                                {
                                    //var_dump( "Adding X",$x );
                                    $aRetVal = array_merge( $aRetVal,$x );
                                    //var_dump( $aRetVal );

                                    if ( ! empty( $szHTML = $this->getURL( $szURL . '/1' ) ) )
                                    {
                                        //var_dump( "2nd pass URL = " . $szURL . '/1' );
                                        $y = $this->parseCNRTLResults( $szHTML,$szCategory );
                                        //var_dump( "Results for " . $szURL . '/1',$y );

                                        if ( $x != $y )
                                        {
                                            //var_dump( "Adding Y" );
                                            $aRetVal = array_merge( $aRetVal,$y );
                                            //var_dump( $aRetVal );
                                        }
                                    }
                                }
                            }
                        }

                        //var_dump( $aRetVal );

                        if ( false )
                        {
                            /************************************************************************************/
                            /* On fait la recherche en deux passes car il se pourrait qu'on trouve plusieurs    */
                            /* définitions (comme avec le verbe tester qui est soit intransitif soit transitif  */
                            /* Dès lors ... il y a 2 URLs au moins à tester et nous on s'arrête à la seconde    */
                            /* même s'il y en a plus !                                                          */
                            /************************************************************************************/

                            /************************************************************************************/
                            /* 1ère PASSE                                                                       */
                            /************************************************************************************/
                            $szHTML = $this->getURL( $szURL );
                            //if ( preg_match_all( '%<td class="syno_format">(.*?)</td>%si'                   ,$szHTML,$aMatches,PREG_PATTERN_ORDER ) )
                            if ( preg_match_all( '%<span(\b| *?)class="tlf_cdefinition"[^>]*>(?P<definition>.*?)</span>%' ,$szHTML,$aMatches,PREG_PATTERN_ORDER ) )
                            {
                                $aMatches = $aMatches[0];
                                //var_dump( $aMatches );
                                //die();
                                foreach( $aMatches as $szMatch )
                                {
                                    //if ( preg_match( "%<a.*>(?P<term>.*?)</a>%si",$szMatch,$aParts ) )
                                    if ( preg_match( '%<span(\b| *?)class="tlf_cdefinition"[^>]*>(?P<definition>.*?)</span>%',$szMatch,$aDefinitions ) )
                                    {
                                        $szDef = strip_tags( $aDefinitions['definition'] );
                                        $aRetVal[] = $szDef;
                                        //var_dump( $aParts );
                                    }   /* if ( preg_match( "%<a.*>(?P<term>.*?)</a>%si",$szMatch,$aParts ) ) */
                                }   /* foreach( $aMatches as $szMatch ) */

                                $this->addInfo( __METHOD__ . "(): chaque définition trouvée devrait être associée à un lemme de la langue française (voir trql.french.class.php)" );
                                //var_dump( $aRetVal );
                                //die();
                            }   /* if ( preg_match_all('%<td class="syno_format">(.*?)</td>%si', $szHTML,$aMatches,PREG_PATTERN_ORDER ) ) */

                            /* Ici ... on regarde si on a une autre définition (plusieurs tabs dans la réponse).

                                Quand il y a plusieurs tabs, voici ce que nous recevons:
                                    <a href="#" onclick="return sendRequest(5,'/definition/matinée//0');"><span>MATINÉE</span>, subst. fém.</a>
                                    <a href="#" onclick="return sendRequest(5,'/definition/matinée//1');"><span>MATINÉE</span>, substantif</a>

                                On remarque les URLS:

                                    - '/definition/matinée//0' et
                                    - '/definition/matinée//1'

                               Nous on va regarder si on a plusieurs définitions et si c'est le cas, on
                               va juste regarder la deuxième et on s'arrête là!)

                            */

                            /************************************************************************************/
                            /* 2ème PASSE                                                                       */
                            /************************************************************************************/
                            $szURL .= '/1';

                            $szHTML = $this->getURL( $szURL );

                            if ( preg_match_all( '%<span(\b| *?)class="tlf_cdefinition"[^>]*>(?P<definition>.*?)</span>%' ,$szHTML,$aMatches,PREG_PATTERN_ORDER ) )
                            {
                                //var_dump( "YES ... WE FOUND A SECOND DEFINITION" );
                                //die();
                                $aMatches = $aMatches[0];
                                //var_dump( $aMatches );
                                //die();
                                foreach( $aMatches as $szMatch )
                                {
                                    //if ( preg_match( "%<a.*>(?P<term>.*?)</a>%si",$szMatch,$aParts ) )
                                    if ( preg_match( '%<span(\b| *?)class="tlf_cdefinition"[^>]*>(?P<definition>.*?)</span>%',$szMatch,$aDefinitions ) )
                                    {
                                        $szDef = strip_tags( $aDefinitions['definition'] );
                                        if ( ! in_array( $szDef,$aRetVal ) )
                                        {
                                            $aRetVal[] = $szDef;
                                        }
                                        //else
                                        //{
                                        //    var_dump( "DEJA DEDANS",$szDef );
                                        //}
                                        //var_dump( $aParts );
                                    }   /* if ( preg_match( "%<a.*>(?P<term>.*?)</a>%si",$szMatch,$aParts ) ) */
                                }   /* foreach( $aMatches as $szMatch ) */

                                //var_dump( $aRetVal );
                                //die();
                                $this->addInfo( __METHOD__ . "(): chaque définition trouvée devrait être associée à un lemme de la langue française (voir trql.french.class.php)" );
                                //var_dump( $aRetVal );
                                //die();
                            }   /* if ( preg_match_all('%<td class="syno_format">(.*?)</td>%si', $szHTML,$aMatches,PREG_PATTERN_ORDER ) ) */
                        }

                        if ( $this->storing && is_array( $aRetVal ) && count( $aRetVal ) > 0 )
                        {
                            $this->saveHashFile( $szCacheFile,$aRetVal );
                            $this->addInfo( __METHOD__ . "(): definitions of {$szTerm} stored in {$szCacheFile}" );
                        }   /* if ( $this->storing ) */

                    }   /* End of ... Else of ... if ( true && $this->remembering && ... ) */
                }
                break;
            case 'en'   ;
                {
                    $szService              = 'definitions';
                    $szURL                  = "https://wordsapiv1.p.rapidapi.com/words/{$szTerm}";

                    $szCacheFile            = $this->cacheName( $szService                                  ,
                                                                $xParams        = array( 'url'  => $szURL   ,
                                                                                         'lang' => $szLang  ,
                                                                                       )                    ,
                                                                $xAdditional    = null );

                    if ( false && $this->remembering && is_file( $szCacheFile ) && $this->fileExistsAndNoOlderThan( $szCacheFile,$iTTL = 86400 * 200 /* 200 days */) )
                    {
                        $oJSON = $this->getCache( $szCacheFile );

                        if ( is_object( $oJSON ) && isset( $oJSON->results ) )
                        {
                            foreach( $oJSON->results as $oResult )
                            {
                                // There is a lot more than simply the definition !
                                $aRetVal[] = $oResult->definition;
                            }
                            $this->addInfo( __METHOD__ . "(): data obtained from {$szCacheFile}" );
                            goto end;
                        }
                    }   /* if ( true && $this->remembering && ... ) */

                    $oJSON = $this->callWordAPI( $szTerm );

                    if ( $this->storing && is_object( $oJSON ) && isset( $oJSON->results ) )
                    {
                        $this->saveHashFile( $szCacheFile,$oJSON );
                        $this->addInfo( __METHOD__ . "(): definitions of {$szTerm} stored in {$szCacheFile}" );

                        foreach( $oJSON->results as $oResult )
                        {
                            // There is a lot more than simply the definition ! Take a look at the JSON !!!
                            $aRetVal[] = $oResult->definition;
                        }
                    }   /* if ( $this->storing ) */

                    // Ce code fonctionne mais c'est quand même TRÈS casse-gueule!
                    //$szHTML = $this->getURL( $szURL = "https://dictionary.cambridge.org/dictionary/english/" . strtolower( $szTerm ) . "?q={$szTerm}" );
                    ////echo $szHTML;
                    //$oDom = new \DOMDocument();
                    //if ( @$oDom->loadHTML( $szHTML ) )
                    //{
                    //    var_dump( "HTML loaded" );
                    //    $oXPath = new \DOMXPath( $oDom );
                    //    var_dump( $oXPath );
                    //    $oColl = $oXPath->query( "//div[@class='entry']" );
                    //
                    //    // Voir les définitions des codes sur page https://dictionary.cambridge.org/help/codes.html
                    //    // Pour commencer, je me base sur [U]
                    //    foreach( $oColl as $oNode )
                    //    {
                    //        // Get rid of all plurals (supposed until the end of the string
                    //        $szText = preg_replace('/\[ plural \].*\z/im','',$oNode->nodeValue);
                    //
                    //        if ( ( $iPos = vaesoli::STR_iPos( $szText,'[ U ]' ) ) !== -1 )
                    //        {
                    //            $szText = substr( $szText,$iPos );
                    //
                    //            $szText = str_iReplace( array('[ U ]','[ C ]','[ S ]'),'|||',$szText );
                    //
                    //            $aProposals = explode( '|||',$szText );
                    //            var_dump( "FOUND " . count( $aProposals ) . " PROPOSALS" );
                    //            foreach( $aProposals as $szProposal )
                    //            {
                    //                if ( ! empty( $szProposal ) )
                    //                {
                    //                    var_dump( Vaesoli::STR_Reduce( trim( $szProposal ) ),"===========================" );
                    //                }
                    //            }
                    //        }
                    //    }
                    //}

                    // Wiktionary : see https://stackoverflow.com/questions/49302975/is-there-a-way-to-extract-wiktionary-data-without-scraping

                    // URL de base : https://en.wiktionary.org/w/api.php
                    // URL de query: https://en.wiktionary.org/w/api.php?action=help&modules=query

                    // Bon alors ... ceci est un excellent début: https://en.wiktionary.org/w/api.php?action=query&list=allpages&apfrom=Politics&aplimit=50
                    // On peut avoir la version XML avec :
                    // https://en.wiktionary.org/w/api.php?action=query&list=allpages&apfrom=Politics&aplimit=50&format=xml
                    // https://en.wiktionary.org/w/api.php?action=query&pageids=3810255&prop=info
                    // Avec extrait: https://en.wiktionary.org/w/api.php?action=query&pageids=3810255&prop=info|extracts
                    // Et pour parser la page : https://en.wiktionary.org/w/api.php?action=parse&pageid=3810255&format=xml
                    // Ceci donne les sections de la page:
                    // https://en.wiktionary.org/w/api.php?action=parse&pageid=3810255&&prop=sections|headhtml&format=xml
                    // Et moi, je suis intéressé par la section "Noun" MAIS je n'arrive pas à parser cette section !!!
                    // J'essaye avec https://en.wiktionary.org/w/api.php?action=parse&pageid=3810255&&section=Noun&format=xml
                    // mais cela me retiurne un <error code="invalidsection" info="The "section" parameter must be a valid section ID or "new"

                    // wordsapi.com
                    // https://rapidapi.com/dpventures/api/wordsapi/endpoints
                }
                break;
            default     :
                {
                    throw new \Exception( __FUNCTION__ . "() at line " . __LINE__ . ": '{$szLang}' language not supported (ErrCode: " . EXCEPTION_CODE_INVALID_PARAMETER . ")",EXCEPTION_CODE_INVALID_PARAMETER );
                }
                break;
        }   /* switch ( $szLang ) */

        end:
        return ( $aRetVal );

    }   /* End of Word.search() ======================================================= */
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
    }   /* End of Word.__destruct() =================================================== */
    /* ================================================================================ */
}   /* End of class Word ============================================================== */
/* ==================================================================================== */
