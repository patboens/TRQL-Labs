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
    {*file                  trql.synonym.class.php *}
    {*purpose               Handles synonyms in a language *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 08-11-20 13:39:25 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 08-11-20 13:39:25 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\synonym;

use \trql\vaesoli\Vaesoli   as Vaesoli;
use \trql\quitus\Word       as Word;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'WORD_CLASS_VERSION' ) )
    require_once( 'trql.word.class.php' );


defined( 'SYNONYM_CLASS_VERSION' ) or define( 'SYNONYM_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Synonym=

    {*desc

        Word or phrase that means exactly or nearly the same as another word or
        phrase in the same language

    *}

    {*doc [url]https://www.wikidata.org/wiki/Q42106[/url] *}

    {*warning
        This class has never been tested (08-11-20 13:48:37)
    *}

 */
/* ==================================================================================== */
class Synonym extends Word
/*----------------------*/
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
    public      $wikidataId                     = 'Q42106';         /* {*property   $wikidataId                     (string)                        word or phrase that means exactly or nearly the same as
                                                                                                                                                    another word or phrase in the same language *} */
    public      $szStorage                      = null;             /* {*property   $szStorage                      (string)                        The file in which all synonyms are stored *} */

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

        //$this->die( __CLASS__ . ' has NOT been tested yet! Disable this line when you have tested the class.' );

        return ( $this );
    }   /* End of Synonym.__construct() =============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__get( $szProperty )=

        Called for reading data from inaccessible (protected or private) or
        non-existing properties.

        {*params
            $szProperty     (string)        Name of the property to look for
        *}

        {*return
            (mixed)     The value of [c]$szProperty[/c]
        *}

        *}}
    */
    /* ================================================================================ */
    public function __get( $szProperty )
    /*--------------------------------*/
    {
        switch( $szProperty )
        {
            case 'storage'  :   return ( $this->szStorage );
                                break;
            default         :   return ( parent::__get( $szProperty ) );
                                break;
        }   /* switch( $szProperty ) */
    }   /* End of Synonym.__get() ===================================================== */
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
    }   /* End of Synonym.cacheName() ================================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*search( $szTerm[,$szLang[,$szGrammaticalCategory]] )=

        Search a synonym for a term

        {*params
            $szTerm                 (string)    Term to look for synonyms
            $szLang                 (string)    The language to be considered
            $szGrammaticalCategory  (string)    The grammatical category ("substantif",
                                                "adjectif","verbe")
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

        switch ( $szLang )
        {
            case 'fr'   :
                {
                    $szService              = 'synonyms';
                    $szBaseURL              = "https://www.cnrtl.fr/synonymie/";
                    // La forme grammaticale devrait être déterminée par une analyse du
                    // terme avec le Morphalou
                    $szGrammaticalCategory  = strtolower( trim( $szGrammaticalCategory ) );
                    $szURL                  = "{$szBaseURL}" . str_replace( '//','/',$szTerm . "/" . $szGrammaticalCategory );

                    $szCacheFile            = $this->cacheName( $szService                                  ,
                                                                $xParams        = array( 'url'  => $szURL   ,
                                                                                         'lang' => $szLang  ,
                                                                                       )                    ,
                                                                $xAdditional    = null );

                    if ( true && $this->remembering && is_file( $szCacheFile ) && $this->fileExistsAndNoOlderThan( $szCacheFile,$iTTL = 86400 * 366 * 2 /* > 2 years */) )
                    {
                        $aRetVal = $this->getCache( $szCacheFile );
                        $this->addInfo( __METHOD__ . "(): data obtained from {$szCacheFile}" );
                        goto end;
                    }   /* if ( true && $this->remembering && ... ) */
                    else    /* Else of ... if ( true && $this->remembering && ... ) */
                    {
                        //var_dump( $szURL );
                        $szHTML = $this->getURL( $szURL );

                        if ( preg_match_all('%<td class="syno_format">(.*?)</td>%si',$szHTML,$aMatches,PREG_PATTERN_ORDER ) )
                        {
                            $aMatches = $aMatches[0];
                            //var_dump( $aMatches );

                            foreach( $aMatches as $szMatch )
                            {
                                if ( preg_match( "%<a.*>(?P<term>.*?)</a>%si",$szMatch,$aParts ) )
                                {
                                    $aRetVal[] = $aParts['term'];
                                    //var_dump( $aParts );
                                }   /* if ( preg_match( "%<a.*>(?P<term>.*?)</a>%si",$szMatch,$aParts ) ) */
                            }   /* foreach( $aMatches as $szMatch ) */

                            $this->addInfo( __METHOD__ . "(): chaque synonyme trouvé devrait être associé à un lemme de la langue française (voir trql_french.class.php)" );

                            if ( $this->storing && is_array( $aRetVal ) && count( $aRetVal ) > 0 )
                            {
                                $this->saveHashFile( $szCacheFile,$aRetVal );
                                $this->addInfo( __METHOD__ . "(): synonyms of {$szTerm} stored in {$szCacheFile}" );
                            }   /* if ( $this->storing ) */
                        }   /* if ( preg_match_all('%<td class="syno_format">(.*?)</td>%si', $szHTML,$aMatches,PREG_PATTERN_ORDER ) ) */
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

    }   /* End of Synonym.search() ==================================================== */
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
    }   /* End of Synonym.__destruct() ================================================ */
    /* ================================================================================ */

}   /* End of class Synonym =========================================================== */
/* ==================================================================================== */

?>