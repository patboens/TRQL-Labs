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
    {*file                  trql.french.class.php *}
    {*purpose               Romance language of the Indo-European family *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 15-11-20 17:42:08 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 15-11-20 17:42:17 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\language;

use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\language\Language     as Language;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'LANGUAGE_CLASS_VERSION' ) )
    require_once( 'trql.language.class.php' );

defined( 'FRENCH_CLASS_VERSION' ) or define( 'FRENCH_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class French=

    {*desc

        Romance language of the Indo-European family

    *}

    *}}

 */
/* ==================================================================================== */
class French extends Language
/*-------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId             = 'Q150';                   /* {*property   $wikidataId                     (string)                        WikidataID. Romance language of the Indo-European family *} */
    public      $aLemmas                = null;                     /* {*property   $aLemmas                        (array)                         French lemmas including all inflected forms. [c]null[/c] by default.
                                                                                                                                                    Lemmas are filled when the lemmas() method is called. *} */
    public      $aGrammaticalCategories = [ 'commonnoun'    ,       /* {*property   $aGrammaticalCategories         (array)                         All grammatical categories as used in Morphalou 2.0 *} */
                                            'adjective'     ,
                                            'functionword'  ,
                                            'verb'          ,
                                            'adverb'        ,
                                            'interjection'  ,
                                            'onomatopoeia' ];

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

        $this->addInfo( "La classe Language devrait implémenter la méthode compile() que j'avais réalisée pour la compréhension OCR" );

        return ( $this );
    }   /* End of French.__construct() ================================================ */
    /* ================================================================================ */


    // 20201117 ... public function grammaticalCategories()
    // 20201117 ... /*-----------------------------------*/
    // 20201117 ... {
    // 20201117 ...     if ( is_file( $szFile = vaesoli::FIL_RealPath( $this->home() . '/data/Morphalou-2.0.xml' ) ) )
    // 20201117 ...     {
    // 20201117 ...         $oDom = new \DOMDocument();
    // 20201117 ...
    // 20201117 ...         /* Cela prend biens 5 sec pour charger tout le Morphalou */
    // 20201117 ...         if ( $oDom->load( $szFile ) )
    // 20201117 ...         {
    // 20201117 ...             $this->addInfo( __METHOD__ . "() at line " . __LINE__ . " : " . basename( $szFile ) . " loaded" );
    // 20201117 ...
    // 20201117 ...             $oXPath = new \DOMXPath( $oDom );
    // 20201117 ...
    // 20201117 ...             $oColl = $oXPath->query( '//grammaticalCategory' );
    // 20201117 ...
    // 20201117 ...             $aCategories = null;
    // 20201117 ...
    // 20201117 ...             foreach( $oColl as $oNode )
    // 20201117 ...             {
    // 20201117 ...                 $aCategories[strtolower( trim( $oNode->nodeValue ) )] = true;
    // 20201117 ...             }   /* foreach( $oColl as $oNode ) */
    // 20201117 ...
    // 20201117 ...             //var_dump( $oColl->length );
    // 20201117 ...             var_dump( $aCategories );
    // 20201117 ...             //var_dump( $this->aGrammaticalCategories );
    // 20201117 ...         }   /* if ( $oDom->load( $szFile ) ) */
    // 20201117 ...     }   /* if ( is_file( $szFile = vaesoli::FIL_RealPath( $this->home() . '/data/Morphalou-2.0.xml' ) ) ) */
    // 20201117 ... }   /* End of French.grammaticalCategories() ====================================== */
    // 20201117 ... /* ================================================================================ */


    /* ================================================================================ */
    /** {{*lemmas()=

        Determines all lemmas of the French language

        {*params
        *}

        {*return
            (self)      The current instance of the class
        *}

        *}}
    */
    /* ================================================================================ */
    public function lemmas()
    /*--------------------*/
    {
        $szLemmasFile = vaesoli::FIL_RealPath( $this->home() . '/data/morphalou.lemmas.txt' );

        //var_dump( $szLemmasFile,is_file( $szLemmasFile ) );

        if ( true && $this->remembering && $this->fileExistsAndNoOlderThan( $szLemmasFile,$iTTL = 86400 * 366 * 30 /* > 30 years */ ) )
        {
            /* French lemmas are maintained in a simple text file */
            $tStart = microtime( true );
            $this->aLemmas = file( $szLemmasFile,FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );
            $tEnd = microtime( true );
            $this->addInfo( __METHOD__ . "() at line " . __LINE__ . " : lemmas obtained from {$szLemmasFile} in " . round( $tEnd - $tStart,5 ) . " secs" );
            goto end;
        }   /* if ( true && $this->remembering && is_file( $szLemmasFile ) ... */
        else   /* Else of ... if ( true && $this->remembering && is_file( $szLemmasFile ) ... */
        {
            /* Load the morphalou 2.0 file */
            if ( is_file( $szFile = vaesoli::FIL_RealPath( $this->home() . '/data/Morphalou-2.0.xml' ) ) )
            {
                $oDom = new \DOMDocument();

                /* Cela prend biens 5 sec pour charger tout le Morphalou */
                if ( $oDom->load( $szFile ) )
                {
                    $this->addInfo( __METHOD__ . "() at line " . __LINE__ . " : " . basename( $szFile ) . " loaded" );

                    $oXPath = new \DOMXPath( $oDom );
                    //var_dump( $szFile );

                    //$aWords = $oXPath->query( '/lexicon/lexicalEntry/formSet/lemmatizedForm' );
                    $aWords = $oXPath->query( '/lexicon/lexicalEntry/formSet' );

                    $i = 0;

                    $tStart = microtime( true );
                    if ( $fp = fopen( $szLemmasFile,'w+' ) )        /* Open/create a text file, set it to 0 byte */
                    {
                        foreach( $aWords as $oNode )                /* For each lemmatizedForm */
                        {
                            // Mot principal
                            $szWord = $oXPath->query( 'lemmatizedForm/orthography',$oNode )->item(0)->nodeValue;
                            fwrite( $fp,$szWord . "\n" );

                            // Voyons si nous avons des formes fléchies ...
                            if ( ( $oInflectedColl = $oXPath->query( 'inflectedForm',$oNode ) ) && $oInflectedColl->length > 0 )
                            {
                                foreach( $oInflectedColl as $oInflectedNode )
                                {
                                    $szWord = $oXPath->query( 'orthography',$oInflectedNode )->item(0)->nodeValue;
                                    fwrite( $fp,$szWord . "\n" );
                                }   /* foreach( $oInflectedColl as $oInflectedNode ) */
                            }   /* if ( ( $oInflectedColl = $oXPath->query( 'inflectedForm',$oNode ) ) && $oinflectedColl->length > 0 ) */

                            //if ( ++$i > 100 )
                            //    break;
                        }   /* foreach( $aWords as $oNode ) */
                        fclose( $fp );
                    }   /* if ( $fp = fopen( dirname( $szFile ) . '/morphalou','w+' ) ) */
                    $tEnd = microtime( true );
                    $this->addInfo( __METHOD__ . "(): " . $aWords->length . " lemmas found in " . round( $tEnd - $tStart,5 ) . ' secs');

                    // En fait, il peut y avoir plein de doublons à ce stade
                    // il faudrait faire du code pour éliminer les doublons !

                    /* Now that all lemmas were saved ... let's read them ... */
                    if ( is_file( $szLemmasFile ) )
                    {
                        /* French lemmas are maintained in a simple text file */
                        $this->aLemmas = file( $szLemmasFile,FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );
                    }   /* if ( is_file( $szLemmasFile ) ) */
                }   /* if ( $oDom->load( $szFile ) ) */
            }   /* if ( is_file( $szFile ) ) */
        }   /* End of ... Else of ... if ( true && $this->remembering && is_file( $szLemmasFile ) ... */

        end:
        return ( $this );
    }   /* End of French.lemmas() ===================================================== */
    /* ================================================================================ */


    public function hashWord( $szWord )
    /*-------------------------------*/
    {
        // On trie les lettres du mot
        $szSorted   = vaesoli::STR_Sort( strtolower( trim( $szWord ) ) );


        // On fait un md5 du mot
        $szMD5      = md5( $szSorted );

        // On calcule un code de hashing du mot
        $iCode      = vaesoli::STR_Ascii2( $szMD5 );

        // On calcule un modulo 463 (nombre premier)
        $iRetVal    = $iCode % 463;

        if ( $szWord === 'héritier' )
            var_dump( 'héritier ... ' . $iRetVal );

        return ( $iRetVal );
    }   /* End of French.hashWord() =================================================== */
    /* ================================================================================ */


    public function getLowHigh( $szWord )
    /*---------------------------------*/
    {
        $iHash = $this->hashWord( $szWord );

        $iHigh = (int) vaesoli::NUM_RoundMultiple( $iHash,25 );
        $iLow  = ( $iHigh - 24 );

        $aRetVal = array( 'low' => (int) $iLow,'high' => (int) $iHigh );
        var_dump( $iHash,$aRetVal );

        return ( $aRetVal );
    }   /* End of French.getLowHigh() ================================================= */
    /* ================================================================================ */


    public function search( $szWord )
    /*-----------------------------*/
    {
        $aRetVal = null;

        $aLimits = $this->getLowHigh( $szWord = strtolower( trim( $szWord ) ) );
        //var_dump( $aLimits );
        //die();

        if ( is_file( $szShelter = vaesoli::FIL_RealPath( $this->home() . '/data/morphalou.words.detail.' . sprintf('%04d-%04d',$aLimits['low'],$aLimits['high'] ) . '.hash' ) ) )
        {
            //var_dump( "Shelter found" );
            $aCandidates = $this->getHashFile( $szShelter );

            foreach( $aCandidates as $aWord )
            {
                if ( $aWord['word'] === $szWord )
                    $aRetVal[] = $aWord;
            }   /* foreach( $aCandidates as $aWord ) */
            //var_dump( $aWords );
            //unset( $aWords );
        }   /* if ( is_file( $szShelter ... ) ) */

        return ( $aRetVal );
    }   /* End of French.search() ===================================================== */
    /* ================================================================================ */


    /*  Quand on a un verbe, les forme fléchies montrent les valeurs suivantes:
    	<orthography>abaissa</orthography>
    	<grammaticalNumber>singular</grammaticalNumber>
    	<grammaticalMood>indicative</grammaticalMood>
    	<grammaticalTense>simplePast</grammaticalTense>
    	<grammaticalPerson>thirdPerson</grammaticalPerson>
    */

    /* ================================================================================ */
    /** {{*lemmas3()=

        Determines all lemmas of the French language

        {*params
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*abstract
            Je vais sauver tous les mots dans 463 fichiers maximum
        *}

        *}}
    */
    /* ================================================================================ */
    public function lemmas3()
    /*--------------------*/
    {
        /* Load the morphalou 2.0 file */
        if ( is_file( $szFile = vaesoli::FIL_RealPath( $this->home() . '/data/Morphalou-2.0.xml' ) ) )
        {
            $oDom = new \DOMDocument();

            /* Cela prend biens 5 sec pour charger tout le Morphalou */
            if ( $oDom->load( $szFile ) )
            {
                $this->addInfo( __METHOD__ . "() at line " . __LINE__ . " : " . basename( $szFile ) . " loaded" );

                $oXPath = new \DOMXPath( $oDom );
                //var_dump( $szFile );

                $oColl = $oXPath->query( '/lexicon/lexicalEntry/formSet' );

                //var_dump( $oColl->length );

                $i = 0;

                $tStart = microtime( true );

                for ( $j = 25;$j <= 50;$j += 25 )
                {
                    $aWords = null;
                    $iMin   = $j - 24;
                    $iMax   = $j;

                    foreach( $oColl as $oNode )                /* For each lemmatizedForm */
                    {
                        $szMainWord =
                        $szCat      =
                        $szGender   =
                        $aInflected = null;

                        $szMainWord = strtolower( trim( $oXPath->query( 'lemmatizedForm/orthography',$oNode )->item(0)->nodeValue ) );

                        if ( ! empty( $szMainWord ) )
                        {
                            //var_dump( $szMainWord );

                            if ( ( $oForms = $oXPath->query( 'grammaticalCategory',$oNode ) ) && $oForms->length > 0 )
                                $szCat      = $oForms->item(0)->nodeValue;

                            if ( ( $oForms = $oXPath->query( 'grammaticalGender',$oNode ) ) && $oForms->length > 0 )
                                $szGender   = $oForms->item(0)->nodeValue;

                            if ( ( $oInflectedColl = $oXPath->query( 'inflectedForm',$oNode ) ) && $oInflectedColl->length > 0 )
                            {
                                //var_dump( $oInflectedColl->length . ' inflected forms' );

                                foreach ( $oInflectedColl as $oInflectedNode )
                                {
                                	$szInFlectedWord        =
                                	$szGrammaticalNumber    =
                                	$szGrammaticalMood      =
                                	$szGrammaticalTense     =
                                	$szGrammaticalPerson    = null;

                                    $szInFlectedWord        = strtolower( trim( $oXPath->query( 'orthography'      ,$oInflectedNode )->item(0)->nodeValue ) );

                                    if ( ( $oForms = $oXPath->query( 'grammaticalNumber',$oInflectedNode ) ) && $oForms->length > 0 )
                                        $szGrammaticalNumber    = strtolower( trim( $oForms->item(0)->nodeValue ) );

                                    if ( ( $oForms = $oXPath->query( 'grammaticalMood'  ,$oInflectedNode ) ) && $oForms->length > 0 )
                                        $szGrammaticalMood      = strtolower( trim( $oForms->item(0)->nodeValue ) );

                                    if ( ( $oForms = $oXPath->query( 'grammaticalTense' ,$oInflectedNode ) ) && $oForms->length > 0 )
                                        $szGrammaticalTense     = strtolower( trim( $oForms->item(0)->nodeValue ) );

                                    if ( ( $oForms = $oXPath->query( 'grammaticalPerson' ,$oInflectedNode ) ) && $oForms->length > 0 )
                                        $szGrammaticalPerson    = strtolower( trim( $oForms->item(0)->nodeValue ) );

                                    $aInflected[] = array( 'word'   => $szInFlectedWord     ,
                                                           'number' => $szGrammaticalNumber ,
                                                           'mood'   => $szGrammaticalMood   ,
                                                           'tense'  => $szGrammaticalTense  ,
                                                           'pers'   => $szGrammaticalPerson ,
                                                         );

                                }   /* foreach( $oInflectedColl as $oInflectedNode ) */
                            }   /* if ( ( $oInflectedColl = $oXPath->query( 'inflectedForm',$oNode ) ) && $oInflectedColl->length > 0 ) */

                            //if ( ! is_null( $aInflected ) )
                            //{
                            //    //var_dump( $szMainWord,$aInflected );
                            //    //die();
                            //}

                            $aWords[] = array( 'word'       => $szMainWord  ,
                                               'cat'        => $szCat       ,
                                               'gender'     => $szGender    ,
                                               'inflected'  => $aInflected  ,
                                             );
                            unset( $aInflected );
                            //if ( ++$i > 99 )
                            //{
                            //    $i = 0;
                            //    break;
                            //}   /* if ( ++$i > 99 ) */
                        }   /* if ( ! empty( $szMainWord ) ) */
                    }   /* foreach( $aWords as $oNode ) */

                    // ET MAINTENANT ... SAUVER TOUS LES MOTS DANS LE BON FICHIER 
                    vaesoli::FIL_StrToFile( serialize( $aWords ),$szOutputFile = vaesoli::FIL_RealPath( $this->home() . '/data/morphalou.words.detail.' . sprintf( "%04d-%04d",$iMin,$iMax ) . '.hash' ) );
                    var_dump( '-------------- ' . $szOutputFile );
                }   /* for ( $j = 25;$j <= 475;$j += 25 ) */
                $tEnd = microtime( true );
            }   /* if ( $oDom->load( $szFile ) ) */
        }   /* if ( is_file( $szFile ) ) */

        end:
        return ( $this );
    }   /* End of French.lemmas3() ==================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*lemmas2()=

        Determines all lemmas of the French language

        {*params
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*abstract
            Je vais sauver tous les mots dans 463 fichiers maximum
        *}

        *}}
    */
    /* ================================================================================ */
    public function lemmas2()
    /*--------------------*/
    {
        /* Load the morphalou 2.0 file */
        if ( is_file( $szFile = vaesoli::FIL_RealPath( $this->home() . '/data/Morphalou-2.0.xml' ) ) )
        {
            $oDom = new \DOMDocument();

            /* Cela prend biens 5 sec pour charger tout le Morphalou */
            if ( $oDom->load( $szFile ) )
            {
                $this->addInfo( __METHOD__ . "() at line " . __LINE__ . " : " . basename( $szFile ) . " loaded" );

                $oXPath = new \DOMXPath( $oDom );
                //var_dump( $szFile );

                //$aWords = $oXPath->query( '/lexicon/lexicalEntry/formSet/lemmatizedForm' );
                //$oColl = $oXPath->query( '/lexicon/lexicalEntry/formSet/lemmatizedForm|' .
                //                         '/lexicon/lexicalEntry/formSet/inflectedForm'
                //                       );
                $oColl = $oXPath->query( '/lexicon/lexicalEntry/formSet' );

                //var_dump( $oColl->length );

                $i = 0;

                $tStart = microtime( true );

                for ( $j = 25;$j <= 475;$j += 25 )
                {
                    $aWords = null;
                    $iMin   = $j - 24;
                    $iMax   = $j;

                    foreach( $oColl as $oNode )                /* For each lemmatizedForm */
                    {
                        $szWord     =
                        $szCat      =
                        $szGender   =
                        $szNumber   = null;

                        if ( ( $oForms = $oXPath->query( 'orthography',$oNode ) ) && $oForms->length > 0 )
                            $szWord = strtolower( trim( $oForms->item(0)->nodeValue ) );

                        // Punaise, j'ai des mots qui ont une lemmatizedForm mais pas de inflectedForm !
                        // Exemple: "aaronide"

                        if ( ! empty( $szWord ) )
                        {
                            $iModulo = $this->hashWord( $szWord );

                            //if ( $szWord === 'héritier' )
                            //{
                            //    var_dump( $szWord,$iModulo,$this->hashWord( $szWord ) );
                            //    die();
                            //}

                            if ( ( $oForms = $oXPath->query( 'grammaticalCategory',$oNode ) ) && $oForms->length > 0 )
                                $szCat = $oForms->item(0)->nodeValue;

                            if ( ( $oForms = $oXPath->query( 'grammaticalGender',$oNode ) ) && $oForms->length > 0 )
                                $szGender = $oForms->item(0)->nodeValue;

                            if ( ( $oForms = $oXPath->query( 'grammaticalNumber',$oNode ) ) && $oForms->length > 0 )
                                $szNumber = $oForms->item(0)->nodeValue;


                            if ( $iModulo === 0 || ( $iModulo >= $iMin && $iModulo <= $iMax ) )
                            {
                                $aWords[] = array( 'word'   => $szWord  ,
                                                   'cat'    => $szCat   ,
                                                   'gender' => $szGender,
                                                   'number' => $szNumber,
                                                 );
                            }   /* if ( $iModulo >= $iMin && $iModulo <= $iMax ) */

                            //var_dump( $szWord,$szSorted,$szMD5,$iCode,$iModulo );
                            //var_dump( '---------------' );
                            //if ( ++$i > 99 )
                            //    break;
                        }   /* if ( ! empty( $szWord ) ) */
                    }   /* foreach( $aWords as $oNode ) */

                    vaesoli::FIL_StrToFile( serialize( $aWords ),$szOutputFile = vaesoli::FIL_RealPath( $this->home() . '/data/morphalou.words.detail.' . sprintf( "%04d-%04d",$iMin,$iMax ) . '.hash' ) );
                    var_dump( $szOutputFile );

                }   /* for ( $j = 25;$j <= 475;$j += 25 ) */
                $tEnd = microtime( true );
                //var_dump( $aWords );
                //vaesoli::FIL_StrToFile( serialize( $aWords ),$szOutputFile = __DIR__ . '/morphalou.words.detail.' . sprintf( "%04d-%04d",$iMin,$iMax ) . '.hash' );
                //$this->addInfo( __METHOD__ . "(): " . $aWords->length . " lemmas found in " . round( $tEnd - $tStart,5 ) . ' secs');
            }   /* if ( $oDom->load( $szFile ) ) */
        }   /* if ( is_file( $szFile ) ) */

        end:
        return ( $this );
    }   /* End of French.lemmas2() ==================================================== */
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
    }   /* End of French.__destruct() ================================================= */
    /* ================================================================================ */
}   /* End of class French ============================================================ */
/* ==================================================================================== */

?>