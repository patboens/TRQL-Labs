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
    {*file                  trql.voltaire.class.php *}
    {*purpose               Text analysis services : this class is, amongst other things,
                            used for address parsing *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 01-08-20 11:48 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    {*warning
    
    *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 01-08-20 11:48 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\voltaire;

use \trql\quitus\Mother         as Mother;
use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\utility\Utility       as Utility;
use \trql\mercator\Mercator     as Mercator;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'UTILITY_CLASS_VERSION' ) )
    require_once( 'trql.utility.class.php' );

if ( ! defined( 'MERCATOR_CLASS_VERSION' ) )
    require_once( 'trql.mercator.class.php' );

require_once( "q/common/addons/textrazor/TextRazor.php" );

defined( 'VOLTAIRE_CLASS_VERSION' ) or define( 'VOLTAIRE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Voltaire=

    {*desc

        Text analysis services : this class is, amongst other things, used for parsing
        addresses

    *}

    {*todo

        Very few methods of the class are documented. Please document them little by little

    *}

    *}}
 */
/* ==================================================================================== */
class Voltaire extends Utility
/*--------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    protected   $oTR                            = null;             /* {*property   $oTR                        (TextRazor)             Text Razor class *} */

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
    public function __construct()
    /*-------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        $szAPIKey = $this->getAPIKey();
        \TextRazorSettings::setApiKey( $szAPIKey );

        $this->oTR = new \TextRazor();

        $this->oTR->addExtractor( 'topics' );
        $this->oTR->addExtractor( 'entities' );
        $this->oTR->addExtractor( 'categories' );
        $this->oTR->addExtractor( 'words' );
        $this->oTR->addExtractor( 'senses' );

        $this->oTR->setCleanupReturnCleaned( true );    /* Je veux le texte nettoyé dans la réponse */

        return ( $this );
    }   /* End of Voltaire.__construct() ============================================== */
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
        if ( is_file( $szFile = vaesoli::FIL_RealPath( $this->szHome . '/api.key.txt' ) ) )
            return ( vaesoli::FIL_FileToStr( $szFile ) );
        else
            return ( null );
    }   /* End of SMS.getAPIKey() ===================================================== */
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
    }   /* End of Voltaire.cacheName() ================================================ */
    /* ================================================================================ */


    /* Cherche les occurrences de nom de pays dans une chaîne */
    public function countriesIn( $szStr )
    /*---------------------------------*/
    {
        $aRetVal        = null;

        $aAllCountries  = $this->countries();

        //var_dump( $aAllCountries );

        foreach( $aAllCountries as $aCountry )
        {
            if     ( vaesoli::STR_iPos( $szStr,$aCountry['en'] ) !== -1 )
                $aRetVal['en'] = array( 'match' => $aCountry['en'],'country' => $aCountry );
            elseif ( vaesoli::STR_iPos( $szStr,$aCountry['fr'] ) !== -1 )
                $aRetVal['fr'] = array( 'match' => $aCountry['fr'],'country' => $aCountry );
            elseif ( vaesoli::STR_iPos( $szStr,$aCountry['nl'] ) !== -1 )
                $aRetVal['nl'] = array( 'match' => $aCountry['nl'],'country' => $aCountry );
            elseif ( vaesoli::STR_iPos( $szStr,$aCountry['es'] ) !== -1 )
                $aRetVal['es'] = array( 'match' => $aCountry['es'],'country' => $aCountry );
            elseif ( vaesoli::STR_iPos( $szStr,$aCountry['de'] ) !== -1 )
                $aRetVal['de'] = array( 'match' => $aCountry['de'],'country' => $aCountry );
            elseif ( vaesoli::STR_iPos( $szStr,$aCountry['pt'] ) !== -1 )
                $aRetVal['pt'] = array( 'match' => $aCountry['pt'],'country' => $aCountry );
            elseif ( vaesoli::STR_iPos( $szStr,$aCountry['it'] ) !== -1 )
                $aRetVal['it'] = array( 'match' => $aCountry['it'],'country' => $aCountry );
        }   /* foreach( $aAllCountries as $aCountry ) */

        return ( $aRetVal );
    }   /* End of Voltaire.countriesIn() ============================================== */
    /* ================================================================================ */


    protected function isAddressNumber( $szStr )
    /*----------------------------------------*/
    {
        return ( preg_match( '%(?:\d)+(A|B|C)?(/|-)?(\d+(A|B|C)?)?%si',$szStr ) );
    }   /* End of Voltaire.isAddressNumber() ========================================== */
    /* ================================================================================ */


    protected function isCity( $szWord )
    /*--------------------------------*/
    {
        $bRetVal = false;

        $oMercator = new Mercator();

        $aCities = $oMercator->BELCities();
        //var_dump( $aCities );
        //die();

        $bRetVal = isset( $aCities[trim( strtolower( $szWord ) )] );

        return ( $bRetVal );
    }   /* End of Voltaire.isCity() =================================================== */
    /* ================================================================================ */


    protected function isCountry( $szWord )
    /*-----------------------------------*/
    {
        $bRetVal = false;

        static $staticData = null;

        if ( is_null( $staticData ) )
        {
            $oMercator = new Mercator();
            $aCountries = $oMercator->countries();

            //var_dump( $aCountries );
            //$this->die();


            // avant que <Name> ne soit plus dans <Names> ... foreach( $aCountries as $aCountry )
            // avant que <Name> ne soit plus dans <Names> ... {
            // avant que <Name> ne soit plus dans <Names> ...     foreach ( $aCountry['names'])
            // avant que <Name> ne soit plus dans <Names> ...     $staticData[trim( strtolower( $aCountry['fr'] ?? '??' ) )] =
            // avant que <Name> ne soit plus dans <Names> ...     $staticData[trim( strtolower( $aCountry['en'] ?? '??' ) )] =
            // avant que <Name> ne soit plus dans <Names> ...     $staticData[trim( strtolower( $aCountry['nl'] ?? '??' ) )] =
            // avant que <Name> ne soit plus dans <Names> ...     $staticData[trim( strtolower( $aCountry['de'] ?? '??' ) )] =
            // avant que <Name> ne soit plus dans <Names> ...     $staticData[trim( strtolower( $aCountry['es'] ?? '??' ) )] =
            // avant que <Name> ne soit plus dans <Names> ...     $staticData[trim( strtolower( $aCountry['it'] ?? '??' ) )] =
            // avant que <Name> ne soit plus dans <Names> ...     $staticData[trim( strtolower( $aCountry['pt'] ?? '??' ) )] = $aCountry['id'];
            // avant que <Name> ne soit plus dans <Names> ... }   /* foreach( $aCountries as $aCountry ) */

            foreach( $aCountries as $aCountry )
            {
                foreach ( $aCountry['names'] as $aName )
                {
                    //var_dump( $aName );

                    $staticData[trim( strtolower( $aName['value']   ?? '??' ) ) ] = $aCountry['id'];
                    $staticData[trim( strtolower( $aName['cleaned'] ?? '??' ) ) ] = $aCountry['id'];

                    //$this->die();
                }
            }   /* foreach( $aCountries as $aCountry ) */
        }   /* if ( is_null( $staticData ) ) */

        //var_dump( $staticData );
        //var_dump( isset( $staticData[trim( strtolower( "België" ) )] ) );
        //$this->die();

        $bRetVal = isset( $staticData[trim( strtolower( $szWord ) )] );

        return ( $bRetVal );
    }   /* End of Voltaire.isCountry() ================================================ */
    /* ================================================================================ */


    protected function isSeparator( $szWord )
    /*-------------------------------------*/
    {
        $bRetVal = false;

        switch ( $szWord )
        {
            case ''     :
            case '-'    :
            case '--'   :
            case '/'    :
            case '\\'   :
                $bRetVal = true;
        }   /* switch ( $szWord ) */

        return ( $bRetVal );
    }   /* End of Voltaire.isSeparator() ============================================== */
    /* ================================================================================ */


    protected function isCityGroup( $aGroup )
    /*--------------------------------------*/
    {
        $bRetVal = false;

        //var_dump( __METHOD__ . '():',$aGroup );

        if ( count( $aGroup ) === 2 )
        {
            $szTypes = trim( strtolower( $aGroup[0]['type'] . $aGroup[1]['type'] ) );

            $bRetVal = ( $szTypes === 'numberlocality' || $szTypes === 'localitynumber' );
        }   /* if ( count( $aGroup ) === 2 ) */

        return ( $bRetVal );

    }   /* End of Voltaire.isCityGroup() ============================================== */
    /* ================================================================================ */


    protected function isCountryGroup( $aGroup )
    /*----------------------------------------*/
    {
        $bRetVal = false;

        //var_dump( __METHOD__ . '():',$aGroup );

        if ( count( $aGroup ) === 1 )
        {
            $szTypes = trim( strtolower( $aGroup[0]['type'] ) );
            //var_dump( $szTypes );

            $bRetVal = ( $szTypes === 'country' );
        }   /* if ( count( $aGroup ) === 1 ) */

        return ( $bRetVal );

    }   /* End of Voltaire.isCountryGroup() =========================================== */
    /* ================================================================================ */


    protected function isBoxGroup( $aGroup )
    /*----------------------------------------*/
    {
        $bRetVal = false;

        return ( $bRetVal );

    }   /* End of Voltaire.isBoxGroup() =============================================== */
    /* ================================================================================ */


    protected function qualifyGroup( &$aGroup )
    /*---------------------------------------*/
    {
        $szType = 'not set';

        if     ( $this->isCityGroup( $aGroup ) )
            $szType = 'city';
        elseif ( $this->isCountryGroup( $aGroup ) )
            $szType = 'country';
        elseif ( $this->isBoxGroup( $aGroup ) )
            $szType = 'box';
        else
            $szType = 'street';

        if ( $szType === 'street' )
        {
            // On pourrait même avoir un groupe "street" qui contienne TOUT
            // la ville, le pays, la box !!!
            // var_dump( $aGroup );

            $oMercator = new Mercator();

            foreach ( $aGroup as $xKey => $aWord )
            {
                //var_dump( $aWord );

                /* If this word has NOT been qualified yet */
                if ( $aWord['type'] === 'string' )
                {
                    $aNature = $oMercator->pathNatures( $aWord['value'] );

                    if ( ! is_null( $aNature ) )
                    {
                        /* We have an array that looks like ...

                            array (size=4)
                              'code' => string 'RUE' (length=3)
                              'cleaned' => string 'rue' (length=3)
                              'lang' => string 'fr' (length=2)
                              'name' => string 'Rue' (length=3)

                        */
                        //var_dump( $aNature );
                        //$this->die("AFTER NATURE");
                        $aGroup[$xKey]['type'] = "path-{$aNature['cleaned']}";
                    }   /* if ( ! is_null( $aNature ) ) */
                }
            }

            //var_dump( $aGroup );

            //$this->die( "SHOULD QUALIFY EACH WORD OF A STREET GROUP!" );

            // SHould use pathNatures !!! Mais attention, car dans certaines
            // langues comme le flamand ou l'Allemand, on a des natures de
            // voie dans le nom de la rue : Nieuwstraat, De Nayerlaan,
            // Colmardstrasse, ...
            $oMercator->pathNatures();
        }

        return ( array( 'values'    => $aGroup      ,
                        'type'      => $szType      ,
                      ) );
    }   /* End of Voltaire.qualifyGroup() ============================================= */
    /* ================================================================================ */


    protected function hasCountryGroup( $aGroups )
    /*------------------------------------------*/
    {
        $bWithCountryGroup = false;

        // Should use $this->getAddressGroup()

        foreach( $aGroups as $aGroup )
        {
            if ( $aGroup['type'] === 'country' )
            {
                $bWithCountryGroup = true;
                break;
            }   /* if ( $aGroup['type'] === 'country' ) */
        }   /* foreach( $aGroups as $aGroup ) */

        return ( $bWithCountryGroup );
    }   /* End of Voltaire.hasCountryGroup() ========================================== */
    /* ================================================================================ */


    protected function getAddressGroup( $aGroups,$szType )
    /*-------------------------------------------*/
    {
        $aRetVal = null;

        foreach( $aGroups as $aGroup )
        {
            if ( $aGroup['type'] === $szType )
            {
                $aRetVal = $aGroup;
                break;
            }   /* if ( $aGroup['type'] === $szType ) */
        }   /* foreach( $aGroups as $aGroup ) */

        return ( $aRetVal );
    }   /* End of Voltaire.getAddressGroup() ========================================== */
    /* ================================================================================ */


    protected function qualifyAddressToken( $szWord )
    /*---------------------------------------------*/
    {
        $szRetVal = 'string';

        if ( $this->isAddressNumber( $szWord ) )
            $szRetVal = 'number';
        elseif ( $this->isCity( $szWord ) )
            $szRetVal = 'locality';
        elseif ( $this->isCountry( $szWord ) )
            $szRetVal = 'country';

        return ( $szRetVal );
    }   /* End of Voltaire.qualifyAddressToken() ====================================== */
    /* ================================================================================ */


    public function parseAddress( $szText )
    /*-----------------------------------*/
    {
        $aRetVal = null;

        // Avant l'utilisation de preg_split() (06-08-20 08:15:12)
        //if ( preg_match_all( '/[[:word:]]+/si',$szText,$aMatches,PREG_PATTERN_ORDER ) )
        //{
        //    $iCount = count( $aWords = $aMatches[0] );
        //    //var_dump( "Parsing de " . $szText . ':',$aWords );
        //}

        //if ( is_array( $aWords = preg_split( '~[^\p{L}\p{N}\'-/]+~u',$szText ) ) )
        //if ( is_array( $aWords = preg_split( '/[[:space:][:punct:][:cntrl:]]/si',$szText ) ) )
        if ( is_array( $aWords = preg_split( '/( +|,+)/si',$szText ) ) )
        {
            //var_dump( "'" . $szText . "' :",$aWords );

            $aGroups = null;
            $thisGroup = null;

            /* Group words together and qualify each word */
            foreach( $aWords as $szWord )
            {
                if ( ! $this->isSeparator( $szWord ) )
                    $thisGroup[] = array( 'value' => $szWord,'type' => $this->qualifyAddressToken( $szWord ) );
                else
                {
                    /* If separator found, we need to store this
                       group in the list of groups, and we need to
                       qualify the group (is it a country group,
                       a city group, a postalCode group, etc. */
                    //var_dump( $this->qualifyGroup( $thisGroup ) );
                    $aGroups[] = $this->qualifyGroup( $thisGroup );
                    $thisGroup = null;
                }
            }   /* foreach( $aWords as $szWord ) */

            if ( ! is_null( $thisGroup ) )
                $aGroups[] = $this->qualifyGroup( $thisGroup );

            /*  If we didn't find any country in the groups we've parsed
                add a default country group made of Belgium */
            if ( ! $bWithCountryGroup = $this->hasCountryGroup( $aGroups ) )
            {
                $aGroups[] = array( 'values' => array( array( 'value' => 'Belgique','type' => 'country' ) ) ,
                                    'type'   => 'country'                                                   ,
                                  );
            }   /* if ( ! $bWithCountryGroup = $this->hasCountryGroup( $aGroups ) ) */

            //var_dump( "'" . $szText . "' :",$aGroups );

            //var_dump( $szText );
            //var_dump( $aGroups[2] );
            //var_dump( $aGroups );

            $aRetVal['street'   ] = $this->getAddressGroup( $aGroups,'street'   );
            //var_dump( "Street:",$aRetVal['street'] );
            $aRetVal['box'      ] = $this->getAddressGroup( $aGroups,'box'      );
            //var_dump( "Box:",$aRetVal['box'] );
            $aRetVal['city'     ] = $this->getAddressGroup( $aGroups,'city'     );
            //var_dump( "City:",$aRetVal['city'] );
            $aRetVal['country'  ] = $this->getAddressGroup( $aGroups,'country'  );
            //var_dump( "Country:",$aRetVal['country'] );

            //var_dump( $aRetVal );
        }

        // 20200804 ... if ( preg_match_all( '/[[:word:]]+/si',$szText,$aMatches,PREG_PATTERN_ORDER ) )
        // 20200804 ... {
        // 20200804 ...     $iCount = count( $aMatches[0] );
        // 20200804 ...
        // 20200804 ...     var_dump( $aMatches[0] );
        // 20200804 ...
        // 20200804 ...     for ( $i=0;$i < $iCount;$i++ )
        // 20200804 ...     {
        // 20200804 ...         $szWord     = $aMatches[0][$i];
        // 20200804 ...         $szPrevious = ( $i > 0          ? $aMatches[0][$i-1] : null );
        // 20200804 ...         $szNext     = ( $i < $iCount -1 ? $aMatches[0][$i+1] : null );
        // 20200804 ...
        // 20200804 ...         // En fait, il faut faire des push des previous et next
        // 20200804 ...
        // 20200804 ...         if ( ! isset( $aWords[$szWord] ) )
        // 20200804 ...         {
        // 20200804 ...             $aWords[$szWord] = array ( 'previous'   => array( $szPrevious ),
        // 20200804 ...                                        'word'       => $szWord,
        // 20200804 ...                                        'next'       => array( $szNext ) );
        // 20200804 ...         }
        // 20200804 ...         else
        // 20200804 ...         {
        // 20200804 ...             array_push( $aWords[$szWord]['previous'],$szPrevious );
        // 20200804 ...             array_push( $aWords[$szWord]['next']    ,$szNext     );
        // 20200804 ...         }
        // 20200804 ...     }
        // 20200804 ...     // Il faut encore traiter le dernier mot
        // 20200804 ...
        // 20200804 ...     //var_dump( $aWords['process'] );
        // 20200804 ...     //var_dump( $aWords );
        // 20200804 ...     //var_dump( nextOccurrences( 'translation',$aWords ) );
        // 20200804 ...     //var_dump( nextProbableWords( 'translation',$aWords ) );
        // 20200804 ...
        // 20200804 ...     //var_dump( nextOccurrences( 'The',$aWords ) );
        // 20200804 ...     //var_dump( nextProbableWords( 'The',$aWords ) );
        // 20200804 ...
        // 20200804 ...     $szWord     = "The";
        // 20200804 ...     $szWord     = "La";
        // 20200804 ...     $i          = 0;
        // 20200804 ...     $szSentence = $szWord . ' ';
        // 20200804 ...
        // 20200804 ...     do
        // 20200804 ...     {
        // 20200804 ...         //var_dump( "NEXT OF :" . $szWord );
        // 20200804 ...         $aNext = nextOccurrences( $szWord,$aWords );
        // 20200804 ...
        // 20200804 ...         if ( is_array( $aNext ) && count( $aNext ) > 0 )
        // 20200804 ...         {
        // 20200804 ...             //var_dump( $aNext );
        // 20200804 ...
        // 20200804 ...             $key = array_rand( $aNext );
        // 20200804 ...
        // 20200804 ...             //$szWord = key( $aNext );
        // 20200804 ...
        // 20200804 ...             //var_dump( array_rand( $aNext ) );
        // 20200804 ...             //die();
        // 20200804 ...             //$key = key( array_rand( $aNext ) );
        // 20200804 ...
        // 20200804 ...             $szWord = array_rand( $aNext );
        // 20200804 ...
        // 20200804 ...             //var_dump( 'NEXT WORD: ' . $szWord );
        // 20200804 ...             //die();
        // 20200804 ...
        // 20200804 ...             $szSentence .= $szWord . ' ';
        // 20200804 ...         }
        // 20200804 ...     } while ( ! is_null( $szWord ) && ++$i < 70 );
        // 20200804 ...
        // 20200804 ...     echo $szSentence;
        // 20200804 ... }   /* if ( preg_match_all( '/[[:word:]]+/si',$szText,$aMatches,PREG_PATTERN_ORDER ) ) */

        return ( $aRetVal );
    }   /* End of Voltaire.parseAddress() ============================================= */
    /* ================================================================================ */


    public function analyzeAddress( $szStr )
    /*------------------------------------*/
    {
    // replaced by parseAddress ...     $aRetVal    = null;
    // replaced by parseAddress ...     $szFnc      = 'analyze';
    // replaced by parseAddress ...
    // replaced by parseAddress ...     // Le Cache File devrait aussi tenir compte des "concept" positionnés dans le Classifier
    // replaced by parseAddress ...     $szCacheFile = $this->cacheName( $szFnc,$szStr,null );
    // replaced by parseAddress ...
    // replaced by parseAddress ...     if ( true && $this->remembering && $this->fileExistsAndNoOlderThan( $szCacheFile,$iTTL = 86400 * 30 ) )
    // replaced by parseAddress ...     {
    // replaced by parseAddress ...         //var_dump( "NEWS SERVED FROM CACHE" );
    // replaced by parseAddress ...         //$this->die( "DATA FROM CACHE" );
    // replaced by parseAddress ...         $aRetVal = $this->getHashFile( $szCacheFile );
    // replaced by parseAddress ...         $this->addInfo( __METHOD__ . "(): Text Analysis data obtained from {$szCacheFile}" );
    // replaced by parseAddress ...         goto end;
    // replaced by parseAddress ...     }   /* if ( true && $this->remembering && $this->fileExistsAndNoOlderThan( $szCacheFile,$iTTL ) ) */
    // replaced by parseAddress ...     else    /* Else of ... if ( true && $this->remembering && $this->fileExistsAndNoOlderThan( $szCacheFile,$iTTL ) ) */
    // replaced by parseAddress ...     {
    // replaced by parseAddress ...
    // replaced by parseAddress ...         var_dump( "Analysis of ... " . $szStr );
    // replaced by parseAddress ...
    // replaced by parseAddress ...         $aNumbers               =
    // replaced by parseAddress ...         $aPlaces                =
    // replaced by parseAddress ...         $aCountries             =
    // replaced by parseAddress ...         $aPostal                =
    // replaced by parseAddress ...         $szTheLanguageForPat    =
    // replaced by parseAddress ...         $szMatchingCountry      = null;
    // replaced by parseAddress ...
    // replaced by parseAddress ...         if ( preg_match_all( '%(?:\d)+(A|B|C)?(/|-)?(\d+(A|B|C)?)?%si',$szStr,$aMatches ) )
    // replaced by parseAddress ...             $aNumbers = $aMatches[0];
    // replaced by parseAddress ...
    // replaced by parseAddress ...         /* Si on a trouvé un pays dans l'adresse transmise : liste des pays qui matchent */
    // replaced by parseAddress ...         if ( is_array( $aCountries = $this->countriesIn( $szStr ) ) )
    // replaced by parseAddress ...         {
    // replaced by parseAddress ...             // En fait, s'il y a plusieurs pays dans l'adresse (par exemple "Rue d'Angleterre - 1000 Bruxelles - Belgique")
    // replaced by parseAddress ...             // Alors, le pays est le dernier dans la chaîne
    // replaced by parseAddress ...
    // replaced by parseAddress ...             //var_dump( $aCountries );
    // replaced by parseAddress ...
    // replaced by parseAddress ...             /* Keep the keys */
    // replaced by parseAddress ...             $aKeys = array_keys( $aCountries );
    // replaced by parseAddress ...             /* The key we want (the language in which the matching happened) is the LAST key */
    // replaced by parseAddress ...             $szTheLanguageForPat = end( $aKeys );
    // replaced by parseAddress ...
    // replaced by parseAddress ...             //$aCountries = end( $aCountries );
    // replaced by parseAddress ...             //var_dump( $aCountries );
    // replaced by parseAddress ...
    // replaced by parseAddress ...             // Le nom du pays qui a matché (e.g. "Belgique");
    // replaced by parseAddress ...             $szMatchingCountry = end( $aCountries )['match'];
    // replaced by parseAddress ...
    // replaced by parseAddress ...             // Le country qui a matché
    // replaced by parseAddress ...             $aMatchingCountry  = current( $aCountries )['country'];
    // replaced by parseAddress ...
    // replaced by parseAddress ...             $oMercator = new Mercator();
    // replaced by parseAddress ...             $oMercator->remembering = false;
    // replaced by parseAddress ...
    // replaced by parseAddress ...             $x = $oMercator->country( $aMatchingCountry['id'] );
    // replaced by parseAddress ...
    // replaced by parseAddress ...             $aMatchingCountry['postalCodeFormat'] = $x['results'][0]['postalCodeFormat'] ?? '';
    // replaced by parseAddress ...             //var_dump( "Matching country = " . $szMatchingCountry . " :",$aMatchingCountry );
    // replaced by parseAddress ...
    // replaced by parseAddress ...             /* Le pays est le dernier de la liste des pays détectés */
    // replaced by parseAddress ...             $szPattern = str_replace( '#','\d',$aMatchingCountry['postalCodeFormat'] );
    // replaced by parseAddress ...
    // replaced by parseAddress ...             /* Cherchons le code postal: à l'arrivée, il se pourrait que j'ai plusieurs candidats */
    // replaced by parseAddress ...             foreach( $aNumbers as $szNumber )
    // replaced by parseAddress ...             {
    // replaced by parseAddress ...                 /*  Si le numéro de rue était 1000 à 1020 Bruxelles, ... les deux
    // replaced by parseAddress ...                     numéros matcheraient un code postal. Dans ce cas, il faudrait
    // replaced by parseAddress ...                     choisir le numéro qui se trouve le plus proche d'une entity
    // replaced by parseAddress ...                     Place (distance entre 2 parties de la chaîne) */
    // replaced by parseAddress ...
    // replaced by parseAddress ...                 if ( preg_match( "/{$szPattern}/si",$szNumber,$aMatches ) )
    // replaced by parseAddress ...                     $aPostal[] = $szNumber;
    // replaced by parseAddress ...             }
    // replaced by parseAddress ...
    // replaced by parseAddress ...             //var_dump( $aPostal );
    // replaced by parseAddress ...             //die();
    // replaced by parseAddress ...         }
    // replaced by parseAddress ...         else
    // replaced by parseAddress ...         {
    // replaced by parseAddress ...             var_dump( 'Pas de pays dans l\'adresse translise; cela complique les choses car je n\'ai pas non plus de candidats pour code postal' );
    // replaced by parseAddress ...         }
    // replaced by parseAddress ...
    // replaced by parseAddress ...
    // replaced by parseAddress ...         if ( true )
    // replaced by parseAddress ...         {   /* Setup of Classifier */
    // replaced by parseAddress ...
    // replaced by parseAddress ...             $oClassifier = new \ClassifierManager();
    // replaced by parseAddress ...
    // replaced by parseAddress ...             $szClassifierID = 'trql-address';
    // replaced by parseAddress ...
    // replaced by parseAddress ...             try
    // replaced by parseAddress ...             {
    // replaced by parseAddress ...                 $oClassifier->deleteClassifier( $szClassifierID );
    // replaced by parseAddress ...             }
    // replaced by parseAddress ...             catch ( \Exception $e )
    // replaced by parseAddress ...             {
    // replaced by parseAddress ...                 // Silently ignore missing classifier for now.
    // replaced by parseAddress ...             }
    // replaced by parseAddress ...
    // replaced by parseAddress ...             $aCategories = array();
    // replaced by parseAddress ...
    // replaced by parseAddress ...             array_push( $aCategories,array( 'categoryId'    => '1'                  ,
    // replaced by parseAddress ...                                             'query'         => "concept('address')"     ,
    // replaced by parseAddress ...                                           ) );
    // replaced by parseAddress ...             array_push( $aCategories,array( 'categoryId'    => '2'                  ,
    // replaced by parseAddress ...                                             'query'         => "concept('city')"     ,
    // replaced by parseAddress ...                                           ) );
    // replaced by parseAddress ...             array_push( $aCategories,array( 'categoryId'    => '3'                  ,
    // replaced by parseAddress ...                                             'query'         => "concept('country')"     ,
    // replaced by parseAddress ...                                           ) );
    // replaced by parseAddress ...             array_push( $aCategories,array( 'categoryId'    => '4'                  ,
    // replaced by parseAddress ...                                             'query'         => "concept('street')"     ,
    // replaced by parseAddress ...                                           ) );
    // replaced by parseAddress ...
    // replaced by parseAddress ...             $oClassifier->createClassifier( $szClassifierID,$aCategories );
    // replaced by parseAddress ...         }   /* Setup of Classifier */
    // replaced by parseAddress ...
    // replaced by parseAddress ...         try
    // replaced by parseAddress ...         {
    // replaced by parseAddress ...             $aResponse = $this->oTR->$szFnc( $szStr );
    // replaced by parseAddress ...             //var_dump( $aResponse );
    // replaced by parseAddress ...             //var_dump( "Address parsing for " . $szStr );
    // replaced by parseAddress ...
    // replaced by parseAddress ...             /* If defined and set */
    // replaced by parseAddress ...             if ( isset( $aResponse['ok'] ) && $aResponse['ok'] )
    // replaced by parseAddress ...             {
    // replaced by parseAddress ...                 if ( isset( $aResponse['response']['entities'] ) )
    // replaced by parseAddress ...                 {
    // replaced by parseAddress ...                     //var_dump( "Entities",$aResponse['response']['entities'] );
    // replaced by parseAddress ...                     foreach( $aResponse['response']['entities'] as $aEntity )
    // replaced by parseAddress ...                     {
    // replaced by parseAddress ...                         //var_dump( "Entity: ({$aEntity['matchedText']})",$aEntity );
    // replaced by parseAddress ...                         //die();
    // replaced by parseAddress ...                         //var_dump( "Types for {$aEntity['matchedText']}",$aEntity['type'] ?? null );
    // replaced by parseAddress ...
    // replaced by parseAddress ...                         //if ( in_array( 'Number',$aEntity['type'] ) )
    // replaced by parseAddress ...                         //    $aNumbers[] = $aEntity['matchedText'];
    // replaced by parseAddress ...
    // replaced by parseAddress ...                         //if ( in_array( 'Country',$aEntity['type'] ) && in_array( '/location/country',$aEntity['freebaseTypes'] ) )
    // replaced by parseAddress ...                         //    $aCountries[] = $aEntity['matchedText'];
    // replaced by parseAddress ...
    // replaced by parseAddress ...                         //if ( in_array( 'Place',$aEntity['type'] ) && in_array( '/location/location',$aEntity['freebaseTypes'] ) && ! in_array( $aEntity['matchedText'],$aCountries ) )
    // replaced by parseAddress ...                         //    $aPlaces[] = $aEntity['matchedText'];
    // replaced by parseAddress ...
    // replaced by parseAddress ...                         if ( in_array( 'Place',$aEntity['type'] ) && in_array( '/location/location',$aEntity['freebaseTypes'] ) )
    // replaced by parseAddress ...                         {
    // replaced by parseAddress ...                             /* Si on a détécté que c'est aussi un pays ... on ne le met pas dans la liste des places */
    // replaced by parseAddress ...                             if ( ! in_array( 'Country',$aEntity['type'] ) )
    // replaced by parseAddress ...                                 $aPlaces[] = $aEntity['matchedText'];
    // replaced by parseAddress ...                         }
    // replaced by parseAddress ...
    // replaced by parseAddress ...                         //var_dump( "freebaseTypes for {$aEntity['matchedText']}",$aEntity['freebaseTypes'] ?? null );
    // replaced by parseAddress ...
    // replaced by parseAddress ...                         //$aRetVal['results']['entities'][]           = array( 'id'               =>         $aEntity['id'                ],
    // replaced by parseAddress ...                         //                                                     'types'            =>         $aEntity['type'              ] ?? null,
    // replaced by parseAddress ...                         //                                                     'name'             =>         $aEntity['entityId'          ],
    // replaced by parseAddress ...                         //                                                     'link'             =>         $aEntity['wikiLink'          ],
    // replaced by parseAddress ...                         //                                                     'wikidataId'       =>         $aEntity['wikidataId'        ] ?? null,
    // replaced by parseAddress ...                         //                                                     'confidence'       => (float) $aEntity['confidenceScore'   ],
    // replaced by parseAddress ...                         //                                                     'text'             =>         $aEntity['matchedText'       ],
    // replaced by parseAddress ...                         //                                                     'freebaseId'       =>         $aEntity['freebaseId'        ] ?? null,
    // replaced by parseAddress ...                         //                                                     'freebaseTypes'    =>         $aEntity['freebaseTypes'     ] ?? null,
    // replaced by parseAddress ...                         //                                                     'relevance'        => (float) $aEntity['relevanceScore'    ],
    // replaced by parseAddress ...                         //                                                     'startingPos'      =>         $aEntity['startingPos'       ],
    // replaced by parseAddress ...                         //                                                     'endingPos'        =>         $aEntity['endingPos'         ],
    // replaced by parseAddress ...                         //                                                  );
    // replaced by parseAddress ...                     }   /* foreach( $aResponse['response']['entities'] as $aEntity ) */
    // replaced by parseAddress ...                 }   /* if ( isset( $aResponse['response']['coarseTopics'] ) ) */
    // replaced by parseAddress ...
    // replaced by parseAddress ...                 $szAddress = trim( str_ireplace( $szMatchingCountry ,'',$szStr      ) );
    // replaced by parseAddress ...                 $szAddress = trim( str_ireplace( $aPostal[0]        ,'',$szAddress  ) );
    // replaced by parseAddress ...                 $szAddress = trim( str_ireplace( $aPlaces[0]        ,'',$szAddress  ) );
    // replaced by parseAddress ...                 $szStreet  = trim( preg_replace('/(,|-|_)\z/si'     ,'',$szAddress  ) );
    // replaced by parseAddress ...
    // replaced by parseAddress ...                 //var_dump( "Numbers:",$aNumbers );
    // replaced by parseAddress ...                 //var_dump( "Countries:",$aCountries );
    // replaced by parseAddress ...                 //var_dump( "Matching country = " . $szMatchingCountry . " :",$aMatchingCountry );
    // replaced by parseAddress ...                 //var_dump( "Postal codes:",$aPostal );
    // replaced by parseAddress ...                 //var_dump( "Places:",$aPlaces );
    // replaced by parseAddress ...                 //var_dump( "Language:",$aResponse['response']['language'] );
    // replaced by parseAddress ...                 //var_dump( "Lang reliability:",$aResponse['response']['languageIsReliable'] );
    // replaced by parseAddress ...
    // replaced by parseAddress ...                 //var_dump( "Street: "        . $szStreet );
    // replaced by parseAddress ...                 //var_dump( "Postal Code: "   . $aPostal[0] );
    // replaced by parseAddress ...                 //var_dump( "Locality: "      . $aPlaces[0] );
    // replaced by parseAddress ...                 //var_dump( "Country: "       . $szMatchingCountry );
    // replaced by parseAddress ...                 //var_dump( "Language: "      . $szTheLanguageForPat );
    // replaced by parseAddress ...
    // replaced by parseAddress ...                 $aRetVal['results']['street']       = $szStreet;
    // replaced by parseAddress ...                 $aRetVal['results']['postalCode']   = $aPostal[0];
    // replaced by parseAddress ...                 $aRetVal['results']['city']         = $aPlaces[0];
    // replaced by parseAddress ...                 $aRetVal['results']['country']      = $szMatchingCountry;
    // replaced by parseAddress ...                 $aRetVal['results']['language']     = $szTheLanguageForPat;
    // replaced by parseAddress ...
    // replaced by parseAddress ...                 // Je peux me servir de ce service pour savoir si un numéro est dans la fourchette des codes postaux de CE pays
    // replaced by parseAddress ...                 //http://api.geonames.org/postalCodeCountryInfo?&username=PatBoens&style=full
    // replaced by parseAddress ...
    // replaced by parseAddress ...                 /*
    // replaced by parseAddress ...                     uasort( $aPlaces,function( $a,$b )
    // replaced by parseAddress ...                                    {
    // replaced by parseAddress ...                                        $xKeyA = strlen( $a );
    // replaced by parseAddress ...                                        $xKeyB = strlen( $b );
    // replaced by parseAddress ...
    // replaced by parseAddress ...                                        //var_dump( $szKeyA );
    // replaced by parseAddress ...                                        //var_dump( $szKeyB );
    // replaced by parseAddress ...
    // replaced by parseAddress ...                                        if ( $xKeyA === $xKeyB )
    // replaced by parseAddress ...                                        {
    // replaced by parseAddress ...                                            return 0;
    // replaced by parseAddress ...                                        }
    // replaced by parseAddress ...                                        elseif( $xKeyA < $xKeyB )
    // replaced by parseAddress ...                                        {
    // replaced by parseAddress ...                                            return -1;
    // replaced by parseAddress ...                                        }
    // replaced by parseAddress ...                                        else
    // replaced by parseAddress ...                                        {
    // replaced by parseAddress ...                                            return 1;
    // replaced by parseAddress ...                                        }
    // replaced by parseAddress ...                                    } );
    // replaced by parseAddress ...                 */
    // replaced by parseAddress ...
    // replaced by parseAddress ...                 //$aRetVal['results']['numbers']              = $aNumbers;
    // replaced by parseAddress ...                 //$aRetVal['results']['places']               = $aPlaces;
    // replaced by parseAddress ...                 //$aRetVal['results']['countries']            = $aCountries;
    // replaced by parseAddress ...                 //$aRetVal['results']['parsed']               = array( 'street'       => end( $aPlaces )      ,   /* Stupid: je considère que la rue est plus longue que la ville => dernier élément */
    // replaced by parseAddress ...                 //                                                     'number'       => $aNumbers[0]         ,   /* Il faut choisir un des numéros */
    // replaced by parseAddress ...                 //                                                     'postalCode'   => $aNumbers[1]         ,   /* Il faut choisir un des numéros */
    // replaced by parseAddress ...                 //                                                     'city'         => reset( $aPlaces )    ,   /* Stupid: je considère que la ville est plus courte que la rue => premier élément */
    // replaced by parseAddress ...                 //                                                     'country'      => $aCountries[0]       ,
    // replaced by parseAddress ...                 //                                                     'language'     => $aResponse['response']['languageIsReliable'] ? $this->languages( $aResponse['response']['language'] ) : null,
    // replaced by parseAddress ...                 //                                                   );
    // replaced by parseAddress ...
    // replaced by parseAddress ...                 if ( is_array( $aRetVal ) && $this->storing )
    // replaced by parseAddress ...                 {
    // replaced by parseAddress ...                     $this->saveHashFile( $szCacheFile,$aRetVal );
    // replaced by parseAddress ...                     $this->addInfo( __METHOD__ . "(): Text analysis cached in {$szCacheFile}" );
    // replaced by parseAddress ...                 }
    // replaced by parseAddress ...             }   /* if ( isset( $aResponse['ok'] ) && $aResponse['ok'] ) */
    // replaced by parseAddress ...         }
    // replaced by parseAddress ...         catch ( \Exception $e )
    // replaced by parseAddress ...         {
    // replaced by parseAddress ...         }
    // replaced by parseAddress ...     }    /* End of ... Else of ... if ( true && $this->remembering && $this->fileExistsAndNoOlderThan( $szCacheFile,$iTTL ) ) */
    // replaced by parseAddress ...
        end:
        return ( $aRetVal );

    }   /* End of Voltaire.analyzeAddress() =========================================== */
    /* ================================================================================ */


    // Il faudrait demander une analyse en fonction de points d'intérêt
    // Cela donne donc lieu à établir de nombreux "Classifiers" auquel
    // je donnerais un ID (exemples: "trql-music", "trql-politics",
    // "trql_technology", ...) et à permettre d'en choisir un (ou même
    // plusieurs)

    // Ensuite, je dois me poser la questiond e savoir si une analyse
    // m'aide à savoir de quoi on parle :
    // amour, amour heureux, amour décu, travail, politique, media, ...
    // et aussi de savoir si le texte est positif ou non, quel est le
    // mood correspondant

    // DOC: https://www.textrazor.com/tutorials
    // DOC: https://www.textrazor.com/docs/php
    public function analyze( $szStr )
    /*-----------------------------*/
    {
        $aRetVal = null;

        if ( $this->isURL( $szStr ) )
            $szFnc = 'analyzeUrl';
        else
            $szFnc = 'analyze';

        // Le Cache File devrait aussi tenir compte des "concept" positionnés dans le Classifier
        $szCacheFile = $this->cacheName( $szFnc,$szStr,null );

        //var_dump( $szFnc );
        //var_dump( $szCacheFile );
        //var_dump( $this->self );

        //var_dump( $szFnc );
        //die();

        if ( false && $this->remembering && $this->fileExistsAndNoOlderThan( $szCacheFile,$iTTL = 7200 ) )
        {
            //var_dump( "NEWS SERVED FROM CACHE" );
            //$this->die( "DATA FROM CACHE" );
            $aRetVal = $this->getHashFile( $szCacheFile );
            $this->addInfo( __METHOD__ . "(): Text Analysis data obtained from {$szCacheFile}" );
            goto end;
        }   /* if ( true && $this->remembering && $this->fileExistsAndNoOlderThan( $szCacheFile,$iTTL ) ) */
        else    /* Else of ... if ( true && $this->remembering && $this->fileExistsAndNoOlderThan( $szCacheFile,$iTTL ) ) */
        {
            $oClassifier = new \ClassifierManager();
            // $this->die( "AFTER new ClassifierManager()" );

            $szClassifierID = 'trql-music';

            try
            {
                $oClassifier->deleteClassifier( $szClassifierID );
            }
            catch ( \Exception $e )
            {
                // Silently ignore missing classifier for now.
            }

            //$this->die( "AFTER deleteClassifier()" );

            $aCategories = array();

            //array_push( $aCategories,array( 'categoryId'    => '1'                  ,
            //                                'query'         => "concept('art')"     ,
            //                              ) );
            array_push( $aCategories,array( 'categoryId'    => '1'                  ,
                                            'query'         => "concept('address')"     ,
                                          ) );
            array_push( $aCategories,array( 'categoryId'    => '2'                  ,
                                            'query'         => "concept('city')"     ,
                                          ) );
            array_push( $aCategories,array( 'categoryId'    => '3'                  ,
                                            'query'         => "concept('country')"     ,
                                          ) );
            array_push( $aCategories,array( 'categoryId'    => '4'                  ,
                                            'query'         => "concept('street')"     ,
                                          ) );
            //array_push( $aCategories,array( 'categoryId'    => '2'                  ,
            //                                'query'         => "concept('music')"   ,
            //                              ) );
            //array_push( $aCategories,array( 'categoryId'    => '3'                  ,
            //                                'query'         => "concept('album')"   ,
            //                              ) );
            //array_push( $aCategories,array( 'categoryId'    => '4'                  ,
            //                                'query'         => "concept('concert')" ,
            //                              ) );
            // Define some new categories and upload them as a new classifier.
            $oClassifier->createClassifier( $szClassifierID,$aCategories );

            //$this->die( "AFTER createClassifier()" );

            // commented out on 2020-07-30 ... not always applicable : $this->oTR->addClassifier( $szClassifierID );
            //$this->die( "AFTER addClassifier()" );

            try
            {
                $aResponse = $this->oTR->$szFnc( $szStr );

                /* If defined and set */
                if ( isset( $aResponse['ok'] ) && $aResponse['ok'] )
                {
                    //var_dump( $aResponse );
                    //var_dump( $aResponse['response'] );
                    //die();

                    if ( isset( $aResponse['response']['coarseTopics'] ) )
                    {
                        var_dump( $aResponse['response']['coarseTopics'] );
                        foreach( $aResponse['response']['coarseTopics'] as $aTopic )
                        {
                            /* Une erreur dans TextRazor sur le lien : correction simple */
                            $szLink = str_ireplace( 'http://en.wikipedia.org/','http://en.wikipedia.org/wiki/',$aTopic['wikiLink'] );

                            $aRetVal['results']['overarchingThemes'][]  = array( 'id'           =>         $aTopic['id'                 ],
                                                                                 'name'         =>         $aTopic['label'              ],
                                                                                 'link'         =>         $szLink                       ,
                                                                                 'score'        => (float) $aTopic['score'              ],
                                                                               );
                        }   /* foreach( $aResponse['response']['coarseTopics'] as $aTopic ) */
                    }   /* if ( isset( $aResponse['response']['coarseTopics'] ) ) */

                    if ( isset( $aResponse['response']['topics'] ) )
                    {
                        var_dump( $aResponse['response']['topics'] );
                        foreach( $aResponse['response']['topics'] as $aTopic )
                        {
                            /* Une erreur dans TextRazor sur le lien : correction simple */
                            $szLink = str_ireplace( 'http://en.wikipedia.org/','http://en.wikipedia.org/wiki/',$aTopic['wikiLink'] );

                            $aRetVal['results']['topics'][]             = array( 'id'           =>         $aTopic['id'                 ],
                                                                                 'name'         =>         $aTopic['label'              ],
                                                                                 'link'         =>         $szLink                       ,
                                                                                 'score'        => (float) $aTopic['score'              ],
                                                                              );
                        }   /* foreach( $aResponse['response']['topics'] as $aTopic ) */
                    }   /* if ( isset( $aResponse['response']['topics'] ) ) */

                    //var_dump( $aResponse['response']['entities'] );

                    if ( isset( $aResponse['response']['entities'] ) )
                    {
                        //var_dump( "Entities",$aResponse['response']['entities'] );
                        foreach( $aResponse['response']['entities'] as $aEntity )
                        {
                            //var_dump( $aEntity );
                            //die();
                            var_dump( "Types for {$aEntity['matchedText']}",$aEntity['type'] ?? null );
                            var_dump( "freebaseTypes for {$aEntity['matchedText']}",$aEntity['freebaseTypes'] ?? null );
                            //die();
                            //Notice: Undefined index: wikidataId in D:\websites\snippet-center\trql.voltaire.class.php on line 212
                            //Notice: Undefined index: freebaseId in D:\websites\snippet-center\trql.voltaire.class.php on line 215

                            $aRetVal['results']['entities'][]           = array( 'id'               =>         $aEntity['id'                ],
                                                                                 'types'            =>         $aEntity['type'              ] ?? null,
                                                                                 'name'             =>         $aEntity['entityId'          ],
                                                                                 'link'             =>         $aEntity['wikiLink'          ],
                                                                                 'wikidataId'       =>         $aEntity['wikidataId'        ] ?? null,
                                                                                 'confidence'       => (float) $aEntity['confidenceScore'   ],
                                                                                 'text'             =>         $aEntity['matchedText'       ],
                                                                                 'freebaseId'       =>         $aEntity['freebaseId'        ] ?? null,
                                                                                 'freebaseTypes'    =>         $aEntity['freebaseTypes'     ] ?? null,
                                                                                 'relevance'        => (float) $aEntity['relevanceScore'    ],
                                                                                 'startingPos'      =>         $aEntity['startingPos'       ],
                                                                                 'endingPos'        =>         $aEntity['endingPos'         ],
                                                                              );
                        }   /* foreach( $aResponse['response']['entities'] as $aEntity ) */
                    }   /* if ( isset( $aResponse['response']['coarseTopics'] ) ) */

                    $aRetVal['results']['text'] = $aResponse['response']['cleanedText'] ?? null;

                    if ( isset( $aResponse['response']['sentences'] ) )
                    {
                        foreach( $aResponse['response']['sentences'] as $aSentence )
                        {
                            $aRetVal['results']['sentences'][] = array( 'words' => $aSentence['words'] );
                            //var_dump( $aSentence['words'] );
                            //var_dump( $aSentence['words'][0]['senses'] );
                            //die();
                        }   /* foreach( $aResponse['response']['sentences'] as $aSentence ) */
                    }   /* if ( isset( $aResponse['response']['sentences'] ) ) */

                    $aRetVal['results']['language']             = $this->languages( $aResponse['response']['language'] );
                    $aRetVal['results']['languageIsReliable']   =                   $aResponse['response']['languageIsReliable'];

                    //var_dump( $aRetVal['results']['language'] );
                    //var_dump( $aRetVal['results']['languageIsReliable'] );
                    //die();
                    //$aRetVal = $aResponse;

                    {   /* Ancien code mis en commentaire */
                        //var_dump( $aResponse['response']['coarseTopics'] );
                        //var_dump( $aResponse['response']['entities'] );
                        // 2020-07-29 ... commented out ...
                        // 2020-07-29 ... commented out ...     /* If we got the topics covered by this text */
                        // 2020-07-29 ... commented out ...     if ( isset( $aResponse['response']['topics'] ) )
                        // 2020-07-29 ... commented out ...     {
                        // 2020-07-29 ... commented out ...         foreach ( $aResponse['response']['topics'] as $aTopic )
                        // 2020-07-29 ... commented out ...         {
                        // 2020-07-29 ... commented out ...             if ( isset( $aTopic['score'] ) && $aTopic['score'] > 0.25 )
                        // 2020-07-29 ... commented out ...             {
                        // 2020-07-29 ... commented out ...                 $aTopics[] = $aTopic['label'];
                        // 2020-07-29 ... commented out ...             }
                        // 2020-07-29 ... commented out ...             //var_dump( $x );
                        // 2020-07-29 ... commented out ...         }
                        // 2020-07-29 ... commented out ...     }   /* if ( isset( $aResponse['response']['topics'] ) ) */
                        // 2020-07-29 ... commented out ...
                        // 2020-07-29 ... commented out ...     /* If we got the coarse topics covered by this text */
                        // 2020-07-29 ... commented out ...     if ( isset( $aResponse['response']['coarseTopics'] ) )
                        // 2020-07-29 ... commented out ...         $aCoarseTopics = $aResponse['response']['coarseTopics'];
                        // 2020-07-29 ... commented out ...     else
                        // 2020-07-29 ... commented out ...         $aCoarseTopics = null;
                        // 2020-07-29 ... commented out ...
                        // 2020-07-29 ... commented out ...     /* If we got the entities covered by this text */
                        // 2020-07-29 ... commented out ...     if ( isset( $aResponse['response']['entities'] ) )
                        // 2020-07-29 ... commented out ...         $aEntities = $aResponse['response']['entities'];
                        // 2020-07-29 ... commented out ...     else
                        // 2020-07-29 ... commented out ...         $aEntities = null;
                    }   /* Ancien code mis en commentaire */

                    if ( is_array( $aRetVal ) && $this->storing )
                    {
                        $this->saveHashFile( $szCacheFile,$aRetVal );
                        $this->addInfo( __METHOD__ . "(): Text analysis cached in {$szCacheFile}" );
                    }

                }   /* if ( isset( $aResponse['ok'] ) && $aResponse['ok'] ) */

                // commented out on 2020-07-30 ... not always applicable : var_dump( $oClassifier->allCategories(    $szClassifierID ) );

                    /*

                        Le allCategories va me renvoyer qqch comme:

                        array(3) {
                          ["response"]=>
                          array(6) {
                            ["id"]=>
                            string(17) "myfirstClassifier"
                            ["offset"]=>
                            int(0)
                            ["limit"]=>
                            int(0)
                            ["total"]=>
                            int(2)
                            ["lastUpdated"]=>
                            int(1596107184)
                            ["categories"]=>
                            array(2) {
                              [0]=>
                              array(2) {
                                ["categoryId"]=>
                                string(1) "1"
                                ["query"]=>
                                string(14) "concept('art')"
                              }
                              [1]=>
                              array(2) {
                                ["categoryId"]=>
                                string(1) "2"
                                ["query"]=>
                                string(16) "concept('music')"
                              }
                            }
                          }
                          ["time"]=>
                          float(0.2459)
                          ["ok"]=>
                          bool(true)
                        }
                    */

                // commented out on 2020-07-30 ... not always applicable : $oClassifier->deleteClassifier( $szClassifierID );

            }
            catch ( \Exception $e )
            {
            }
        }    /* End of ... Else of ... if ( true && $this->remembering && $this->fileExistsAndNoOlderThan( $szCacheFile,$iTTL ) ) */

        end:
        return ( $aRetVal );

    }   /* End of Voltaire.analyze() ================================================== */
    /* ================================================================================ */


    public function speak()
    /*-------------------*/
    {
        $szRetVal = null;


        end:
        return ( $szRetVal );

    }   /* End of Voltaire.speak() ==================================================== */
    /* ================================================================================ */


    /* Documentation: https://inferkit.com/docs/generation-api */
    public function generate( $szText,$iLength = 250 )
    /*---------------------------------------------*/
    {
        // 2020-07-29 commented out ... // TOUS LES DETAILS DE L'APPEL DEVRAIENT ETRE CACHES !!!
        // 2020-07-29 commented out ...
        // 2020-07-29 commented out ... $aHeaders   = array( "Accept: application/json"         ,
        // 2020-07-29 commented out ...                      "Content-Type: application/json"   ,
        // 2020-07-29 commented out ...                      "Authorization: Bearer 4ec4d19e-fb87-4c5f-99a4-64da032df1ab" );
        // 2020-07-29 commented out ...
        // 2020-07-29 commented out ... $szURL      = "https://api.inferkit.com/v1/models/standard/";
        // 2020-07-29 commented out ...
        // 2020-07-29 commented out ... $aFields = array( 'prompt'  => array( 'text' => $szText ),
        // 2020-07-29 commented out ...                   'length'  => $iLength );
        // 2020-07-29 commented out ...
        // 2020-07-29 commented out ... var_dump( json_encode( $aFields ) );
        // 2020-07-29 commented out ... $this->die();
        // 2020-07-29 commented out ...
        // 2020-07-29 commented out ... try
        // 2020-07-29 commented out ... {
        // 2020-07-29 commented out ...     $ch = curl_init();
        // 2020-07-29 commented out ...
        // 2020-07-29 commented out ...     curl_setopt( $ch, CURLOPT_URL,$szURL );
        // 2020-07-29 commented out ...     //curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST,false );
        // 2020-07-29 commented out ...     curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER,false );
        // 2020-07-29 commented out ...     curl_setopt( $ch, CURLOPT_HTTPHEADER,$aHeaders );
        // 2020-07-29 commented out ...     curl_setopt( $ch, CURLOPT_RETURNTRANSFER,true );
        // 2020-07-29 commented out ...
        // 2020-07-29 commented out ...     // Je devrais encore vérifier si $aFields est null ou non
        // 2020-07-29 commented out ...     // Si pas null, alors, c'est un POST avec des fields
        // 2020-07-29 commented out ...     // qui se trouvent dans aFields
        // 2020-07-29 commented out ...
        // 2020-07-29 commented out ...     if ( ! is_null( $aFields ) )
        // 2020-07-29 commented out ...     {
        // 2020-07-29 commented out ...         /* Example of aFields
        // 2020-07-29 commented out ...         $aFields = array( 'foo'     =>'bar'     ,
        // 2020-07-29 commented out ...                           'baz'     =>'boom'    ,
        // 2020-07-29 commented out ...                           'cow'     =>'milk'    ,
        // 2020-07-29 commented out ...                           'php'     =>'hypertext processor');
        // 2020-07-29 commented out ...         */
        // 2020-07-29 commented out ...
        // 2020-07-29 commented out ...         curl_setopt( $ch,CURLOPT_POST,true );
        // 2020-07-29 commented out ...         curl_setopt( $ch,CURLOPT_POSTFIELDS,json_encode( $aFields ) );
        // 2020-07-29 commented out ...     }
        // 2020-07-29 commented out ...
        // 2020-07-29 commented out ...     if ( ( $xResult = curl_exec( $ch ) ) === false )
        // 2020-07-29 commented out ...     {
        // 2020-07-29 commented out ...         $szErrMsg = curl_error( $ch );
        // 2020-07-29 commented out ...
        // 2020-07-29 commented out ...         //var_dump( 'PROBLEM' );
        // 2020-07-29 commented out ...
        // 2020-07-29 commented out ...         if ( error_reporting() != 0 )
        // 2020-07-29 commented out ...         {
        // 2020-07-29 commented out ...             var_dump( $xResult );
        // 2020-07-29 commented out ...             var_dump( $szErrMsg );
        // 2020-07-29 commented out ...         }
        // 2020-07-29 commented out ...     }   /* if ( ( $xResult = curl_exec( $ch ) ) === false ) */
        // 2020-07-29 commented out ...     else    /* Else of ... if ( ( $xResult = curl_exec( $ch ) ) === false ) */
        // 2020-07-29 commented out ...     {
        // 2020-07-29 commented out ...         echo "\nseems OK\n";
        // 2020-07-29 commented out ...         var_dump( $xResult );
        // 2020-07-29 commented out ...
        // 2020-07-29 commented out ...         //if ( error_reporting() != 0 )
        // 2020-07-29 commented out ...         //    var_dump( $xResult );
        // 2020-07-29 commented out ...
        // 2020-07-29 commented out ...         if ( $oJSON = json_decode( $xResult ) )
        // 2020-07-29 commented out ...         {
        // 2020-07-29 commented out ...             //var_dump( $oJSON );
        // 2020-07-29 commented out ...
        // 2020-07-29 commented out ...             if ( isset( $oJSON->errorMessage ) )
        // 2020-07-29 commented out ...             {
        // 2020-07-29 commented out ...                 $szErrMsg   = $oJSON->errorMessage;
        // 2020-07-29 commented out ...                 $oJSON      = null;
        // 2020-07-29 commented out ...
        // 2020-07-29 commented out ...                 if ( error_reporting() != 0 )
        // 2020-07-29 commented out ...                     var_dump( $szErrMsg );
        // 2020-07-29 commented out ...             }   /* if ( isset( $oJSON->errorMessage ) ) */
        // 2020-07-29 commented out ...         }   /* if ( $oJSON = json_decode( $xResult ) ) */
        // 2020-07-29 commented out ...         elseif ( error_reporting() != 0 )
        // 2020-07-29 commented out ...         {
        // 2020-07-29 commented out ...             var_dump( 'Cannot create the JSON object' );
        // 2020-07-29 commented out ...             var_dump( 'URL: ' . $szURL );
        // 2020-07-29 commented out ...             var_dump( $oJSON );
        // 2020-07-29 commented out ...         }
        // 2020-07-29 commented out ...     }   /* End of ... Else of ... if ( ( $xResult = curl_exec( $ch ) ) === false ) */
        // 2020-07-29 commented out ... }
        // 2020-07-29 commented out ... catch ( Exception $e )
        // 2020-07-29 commented out ... {
        // 2020-07-29 commented out ...     $szErrMsg = $e->getMessage();
        // 2020-07-29 commented out ...     var_dump( $szErrMsg );
        // 2020-07-29 commented out ... }
        // 2020-07-29 commented out ...
        // 2020-07-29 commented out ... if ( $ch )
        // 2020-07-29 commented out ...     curl_close( $ch );
        // 2020-07-29 commented out ...
        // 2020-07-29 commented out ... return ( $oJSON );
    }   /* End of Voltaire.speak() ==================================================== */
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
    }   /* End of Voltaire.__destruct() =============================================== */
    /* ================================================================================ */
}   /* End of class Voltaire ========================================================== */
/* ==================================================================================== */
?>