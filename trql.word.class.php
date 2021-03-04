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
    {*UTF-8                 Quel bel été *}

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
namespace trql\word;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\lexicalitem\LexicalItem       as LexicalItem;


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
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $hasDefinedTerm                 = null;             /* {*property   $hasDefinedTerm                 (DefinedTerm)                   A Defined Term contained in this term set. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q8171';         /* {*property    $wikidataId                     (string)                        Smallest linguistic element that may be uttered 
                                                                                                                                                    in isolation with semantic or pragmatic content *} */

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
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

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


    /* ================================================================================ */
    /** {{*search( $szTerm[,$szLang[,$szGrammaticalCategory]] )=

        Search a synonym for a term

        {*params
            $szTerm                 (string)    Term associated to the cache
            $szLang                 (string)    Optional language. [c]fr[/c] by
                                                default
            $szGrammaticalCategory  (string)    Optional grammatical category
                                                ([c]substantif[/c] by default; can be 
                                                [c]verbe[/c], [c]substantif[/c],
                                                [c]adjectif[/c], [c]adverbe[/c] ...)
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

        *}}
    */
    /* ================================================================================ */
    public function search( $szTerm,$szLang = 'fr',$szGrammaticalCategory = 'substantif' )
    /*----------------------------------------------------------------------------------*/
    {
        $aRetVal = null;

        // Stratégies additionnelles disponible : 
        // D:\websites\latosensu.be\www\httpdocs\webservices\synonyms.php

        //var_dump( $szTerm,$szLang,$szGrammaticalCategory );
        //die();

        switch ( $szLang )
        {
            case 'fr'   :
                {
                    $szService              = 'definitions';
                    $szBaseURL              = "https://www.cnrtl.fr/definition/";
                    // La forme grammaticale devrait être déterminée par une analyse du
                    // terme avec le Morphalou
                    $szGrammaticalCategory  = strtolower( trim( $szGrammaticalCategory ) );
                    $szURL                  = "{$szBaseURL}" . str_replace( '//','/',$szTerm . "/" . $szGrammaticalCategory );

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

                            $this->addInfo( __METHOD__ . "(): chaque définition trouvée devrait être associée à un lemme de la langue française (voir trql_french.class.php)" );
                            //var_dump( $aRetVal );
                            //die();
                        }   /* if ( preg_match_all('%<td class="syno_format">(.*?)</td>%si', $szHTML,$aMatches,PREG_PATTERN_ORDER ) ) */

                        /* Ici ... on regarde si on a une autre définition !!!!!!!!!!!!!!!!!!!!!!!!! */
                        /* Ici, on va voir si on a d'autres définitions (//1 ... c'est la deuxième et ... on s'arrête là!) */

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
                            $this->addInfo( __METHOD__ . "(): chaque définition trouvée devrait être associée à un lemme de la langue française (voir trql_french.class.php)" );
                            //var_dump( $aRetVal );
                            //die();
                        }   /* if ( preg_match_all('%<td class="syno_format">(.*?)</td>%si', $szHTML,$aMatches,PREG_PATTERN_ORDER ) ) */

                        if ( $this->storing && is_array( $aRetVal ) && count( $aRetVal ) > 0 )
                        {
                            $this->saveHashFile( $szCacheFile,$aRetVal );
                            $this->addInfo( __METHOD__ . "(): definitions of {$szTerm} stored in {$szCacheFile}" );
                        }   /* if ( $this->storing ) */

                    }   /* End of ... Else of ... if ( true && $this->remembering && ... ) */
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
?>