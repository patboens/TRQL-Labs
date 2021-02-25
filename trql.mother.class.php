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
    {*file                  trql.mother.class.php *}
    {*purpose               Mother of all TRQL Classes *}
    {*author                {PYB} *}
    {*company               Lato Sensu Management[br]
                            Rue Bois des Mazuis, 47[br]
                            5070 Vitrival[br]
                            Belgium[br]
                            [url]http://www.latosensu.be[/url][br]
                            Vae Soli! : [url]http://www.vaesoli.org[/url] *}
    {*cdate                 08/02/2017 - 12:10 *}
    {*mdate                 auto *}
    {*license               All rights reserved to Lato Sensu Management
                            for all countries. All Intellectual Property
                            belongs to Patrick Boens. *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 16-08-20 16:51:46 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\mother;

defined( 'MOTHER_ABSTRACT_CLASS' ) or define( 'MOTHER_ABSTRACT_CLASS','0.1' );

/* Ici, je devrais définir toutes les erreurs standards : la plupart dont définies dans trql-radio.defines.inc MAIS ... ce xdevrait être celles-ci qui devraient primer */
defined( "EXCEPTION_HASH_FILE_BASIS" )                          or define( "EXCEPTION_HASH_FILE_BASIS"                              ,1000 );
defined( "EXCEPTION_HASH_FILE_EMPTY" )                          or define( "EXCEPTION_HASH_FILE_EMPTY"                              ,EXCEPTION_HASH_FILE_BASIS + 0 );
defined( "EXCEPTION_HASH_FILE_CANNOT_BE_UNSERIALIZED" )         or define( "EXCEPTION_HASH_FILE_CANNOT_BE_UNSERIALIZED"             ,EXCEPTION_HASH_FILE_BASIS + 1 );
defined( "EXCEPTION_HASH_FILE_OUT_OF_MEMORY" )                  or define( "EXCEPTION_HASH_FILE_OUT_OF_MEMORY"                      ,EXCEPTION_HASH_FILE_BASIS + 2 );

defined( "EXCEPTION_CODE_BASIS" )                               or define( "EXCEPTION_CODE_BASIS"                                   ,EXCEPTION_HASH_FILE_BASIS + 1000 );
defined( "EXCEPTION_CODE_FUNCTIONS_NOT_FOUND" )                 or define( "EXCEPTION_CODE_FUNCTIONS_NOT_FOUND"                     ,EXCEPTION_CODE_BASIS + 0 );
defined( "EXCEPTION_CODE_FUNCTION_UNDEFINED"  )                 or define( "EXCEPTION_CODE_FUNCTION_UNDEFINED"                      ,EXCEPTION_CODE_BASIS + 1 );
defined( "EXCEPTION_CODE_INVALID_PROPERTY" )                    or define( "EXCEPTION_CODE_INVALID_PROPERTY"                        ,EXCEPTION_CODE_BASIS + 2 );
defined( "EXCEPTION_CODE_INVALID_PARAMETER" )                   or define( "EXCEPTION_CODE_INVALID_PARAMETER"                       ,EXCEPTION_CODE_BASIS + 3 );
defined( "EXCEPTION_CODE_INVALID_HOME" )                        or define( "EXCEPTION_CODE_INVALID_HOME"                            ,EXCEPTION_CODE_BASIS + 4 );
defined( "EXCEPTION_CODE_FILE_NOT_FOUND" )                      or define( "EXCEPTION_CODE_FILE_NOT_FOUND"                          ,EXCEPTION_CODE_BASIS + 5 );
defined( "EXCEPTION_CODE_PROPERTY_UNDEFINED" )                  or define( "EXCEPTION_CODE_PROPERTY_UNDEFINED"                      ,EXCEPTION_CODE_BASIS + 6 );
defined( "EXCEPTION_CODE_METHOD_UNDEFINED" )                    or define( "EXCEPTION_CODE_METHOD_UNDEFINED"                        ,EXCEPTION_CODE_BASIS + 7 );
defined( "EXCEPTION_CODE_INVALID_PARAMETERS_COUNT" )            or define( "EXCEPTION_CODE_INVALID_PARAMETERS_COUNT"                ,EXCEPTION_CODE_BASIS + 8 );
defined( "EXCEPTION_CODE_NO_RESULTS_FOUND" )                    or define( "EXCEPTION_CODE_NO_RESULTS_FOUND"                        ,EXCEPTION_CODE_BASIS + 9 );
defined( "EXCEPTION_CODE_MISSING_PARAMETER" )                   or define( "EXCEPTION_CODE_MISSING_PARAMETER"                       ,EXCEPTION_CODE_BASIS + 10 );
defined( "EXCEPTION_CODE_RESOURCE_NOT_FOUND" )                  or define( "EXCEPTION_CODE_RESOURCE_NOT_FOUND"                      ,EXCEPTION_CODE_BASIS + 11 );

defined( "EXCEPTION_CODE_RSS_BASIS" )                           or define( "EXCEPTION_CODE_RSS_BASIS"                               ,EXCEPTION_CODE_BASIS + 1000 );
defined( "EXCEPTION_CODE_RSS_NO_CHANNEL_FOUND" )                or define( "EXCEPTION_CODE_RSS_NO_CHANNEL_FOUND"                    ,EXCEPTION_CODE_RSS_BASIS + 0 );

defined( "EXCEPTION_CODE_XML_BASIS" )                           or define( "EXCEPTION_CODE_XML_BASIS"                               ,EXCEPTION_CODE_RSS_BASIS + 1000 );
defined( "EXCEPTION_CODE_XML_INVALID" )                         or define( "EXCEPTION_CODE_XML_INVALID"                             ,EXCEPTION_CODE_XML_BASIS + 0 );

defined( 'ROW_SOURCE_TYPE_VALUES' )                             or define( "ROW_SOURCE_TYPE_VALUES"                                 ,10 );
defined( 'DATA_SOURCE_TYPE_VALUES' )                            or define( "DATA_SOURCE_TYPE_VALUES"                                ,ROW_SOURCE_TYPE_VALUES);

if ( ! defined( 'ROW_SOURCE_TYPE_XML' ) )                           /* If ROW_SOURCE_TYPE_XML not defined */
{
    define( 'ROW_SOURCE_TYPE_XML'       ,11                         );
    define( 'DATA_SOURCE_TYPE_XML'      ,ROW_SOURCE_TYPE_XML        );
}   /* if ( ! defined( 'ROW_SOURCE_TYPE_XML' ) ) */

if ( ! defined( 'ROW_SOURCE_TYPE_ARRAY' ) )                         /* If ROW_SOURCE_TYPE_ARRAY not defined */
{
    define( 'ROW_SOURCE_TYPE_ARRAY'     ,12                         );
    define( 'DATA_SOURCE_TYPE_ARRAY'    ,ROW_SOURCE_TYPE_ARRAY      );
}   /* if ( ! defined( 'ROW_SOURCE_TYPE_ARRAY' ) ) */

if ( ! defined( 'ROW_SOURCE_TYPE_SQLITE3' ) )                      /* If ROW_SOURCE_TYPE_SQLLITE3 not defined */
{
    define( 'ROW_SOURCE_TYPE_SQLITE3'   ,13                         );
    define( 'DATA_SOURCE_TYPE_SQLITE3'  ,ROW_SOURCE_TYPE_SQLITE3    );
}   /* if ( ! defined( 'ROW_SOURCE_TYPE_SQLITE3' ) ) */

if ( ! defined( 'ROW_SOURCE_TYPE_DBASE' ) )                         /* If ROW_SOURCE_TYPE_DBASE not defined */
{
    define( 'ROW_SOURCE_TYPE_DBASE'     ,14                         );
    define( 'DATA_SOURCE_TYPE_DBASE'    ,ROW_SOURCE_TYPE_DBASE      );
}   /* if ( ! defined( 'ROW_SOURCE_TYPE_DBASE' ) ) */




use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\utility\Zip           as Zip;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'STORAGE_TRAIT_VERSION' ) )
    require_once( 'trql.storage.trait.php' );

require_once( "trql.utils.trait.php" );


/* ==================================================================================== */
/** {{*interface iContext=

    {*desc

        La notion de contexte est assez floue pour l'instant (12-07-20
        09:47:19).

        Le seul objectif que je poursuis pour l'instant est celui de resoudre
        des substitutions de manière différente en fonction du contexte donné,
        ou DES contextes donnés.

        Avec 1! contexte, une substitution donne toujours lieu à la même
        transformation. Avec plusieurs contextes, une substitution peut donner
        lieu à des transformations différentes pour chaque contexte. La question
        surgit alors de savoir quelle transformation appliquer : il y a donc des
        contextes "gagnants" et d'autres "perdants". Pour être complet, il me
        semble que les "gagnants" ne seraient pas toujours les mêmes : cela
        dépendra des autres contextes en présence. Pas seulement une question de
        présence mais également une question d'acuité, de portée, d'étendue,
        d'influence ... toutes notions assez difficiles à capturer. Par exemple,
        imaginons 2 contextes, A et B. Imaginons que %a% telle que définie dans
        A l'emporte. Cela veut-il dire que %a% de A l'emportera toujours entre A
        et B ? Non ! À certains moments A l'emporte et à d'autres B l'emporte et
        cela dependra de l'acuité, de la portée, de l'étendue, de l'influence de
        A par rapport à B dans des conditions précises.

        CECI EST DONC UNE IMPLEMENTATION PRELIMINAIRE !!!

    *}

    *}}
 */
/* ==================================================================================== */
interface iContext
/*--------------*/
{
    public function templates();
    public function substitutions();
    public function speak();
    public function sing();

}   /* End of interface iContext ====================================================== */
/* ==================================================================================== */


/* ==================================================================================== */
/** {{*interface iAPI=

    {*desc

        Implements the getAPIKey() method

    *}

    *}}
 */
/* ==================================================================================== */
interface iAPI
/*-----------*/
{
    public function getAPIKey();

}   /* End of interface iAPI ========================================================== */
/* ==================================================================================== */


/** {{*class Mother=

    {*desc
        Mother of all TRQL classes
    *}

    {*todo
        1) Permettre la prise de backup sur des stockages alternatifs comme
           disques durs externes
        2) Extraire les todo des headers des classes (trql.documentor.class.php)
        3) Extraire la description du header de la classe (trql.documentor.class.php)
        4) Creér un trait "file" utilisé
        5) Creér une classe générique trql.file.class.php
        6) Utiliser le trait "file" dans trql.file.class.php
        7) Utiliser le trait "file" dans DocumentorFile
        8) Créer une classe trql.configurationfile.class.php avec multiples stratégies de noms (on charge du plus spécifique au moins spécifique)
        9)
    *}

    *}}
 */
/* ==================================================================================== */
abstract class Mother
/*-----------------*/
{
    use \trql\Utils\Utils;                                          /* Defined in trql.utils.trait.php */
    use \trql\storage\Storage;                                      /* Defined in trql.storage.trait.php */


    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $lastInfo               = null;
    public      $learning               = true;                     /* {*property   $learning                   (boolean)               [c]true[/c] (default) if the class learns from past experience.  [c]false[/c] if not.*} */
    public      $remembering            = true;                     /* {*property   $remembering                (boolean)               [c]true[/c] (default) if the class uses previous results stored in a deterministic cache file. [c]false[/c] if not. *} */
    public      $storing                = true;                     /* {*property   $storing                    (boolean)               [c]true[/c] (default) if the class saves previous results in a deterministic cache file. [c]false[/c] if not. *} */
    protected   $szHome                 = null;                     /* {*property   $szHome                     (string)                Class' home, where data can be found *} */
    protected   $memory                 = null;                     /* {*property   $memory                     (mixed)                 $memory is NOT used as of 25-08-20 15:55:15 *} */
    protected   $pain                   = 0;                        /* {*property   $pain                       (int)                   Pain index - between 0 and 10 *} */
    protected   $feelPain               = true;                     /* {*property   $feelPain                   (bool)                  Does the object feel pain or not; [c]true[/c] by default. *} */
    protected   $family                 = null;                     /* {*property   $family                     (array)                 An array with all classes similar to this one (the TRQL family) *} */
    public      $backupRequired         = true;                     /* {*property   $backupRequired             (boolean)               Should the class backup itself? *} */
    public      $autodocRequired        = true;                     /* {*property   $autodocRequired            (boolean)               Should the class auto-document itself? *} */
    public      $classIcon              = null;                     /* {*property   $classIcon                  (string)                Icon representing the class *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;

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
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );
        $this->classIcon = $this->self['icon'];

        return ( $this );
    }   /* End of Mother.__construct() ================================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*updateSelf( $szClass,$szHome )=

        Updates the information the class maintains on itself

        {*params
        *}

        {*return
            (self)      Current instance
        *}

        *}}
    */
    /* ================================================================================ */
    protected function updateSelf( $szClass = __CLASS__,$szHome = null )
    /*----------------------------------------------------------------*/
    {
        if ( is_array( $this->self ) )
        {
            $aParts                     = explode( '\\',$szClass );

            $this->self['name'      ]   = strtolower( trim( end( $aParts ) ) );
            $this->self['birth'     ]   = microtime( true );
            $this->self['common'    ]   = vaesoli::FIL_RealPath( __DIR__ . '/q/common' );
            $this->self['resources' ]   = vaesoli::FIL_RealPath( $this->self['common'] . '/resources' );
            $this->self['UIKey'     ]   = $szClass;
            $this->self['icon'      ]   = vaesoli::FIL_RealPath( $this->self['resources'] . '/icons/' . $this->self['name'] . '.png' );

            if ( is_null( $szHome ) )
                $szHome = __DIR__;
            else
                $szHome = __DIR__ . '/' . $szHome;

            $this->self['home'] = $this->szHome = vaesoli::FIL_RealPath( $szHome );

            if ( is_null( $this->family ) )
                $this->self['family'] = $this->family = vaesoli::FIL_aFilesEx( __DIR__ . '\\trql.*.class.php' );

            if ( ! is_dir( $this->szHome ) )
            {
                $this->addInfo( __METHOD__ . "(): '{$this->szHome}' NOT found" );

                if ( vaesoli::FIL_MkDir( $this->szHome ) )
                    $this->addInfo( __METHOD__ . "(): '{$this->szHome}' created" );
            }   /* if ( ! is_dir( $this->szHome ) ) */
            else   /* Else of ... if ( ! is_dir( $this->szHome ) ) */
            {
                $this->addInfo( __METHOD__ . "(): '{$this->szHome}' FOUND" );
            }   /* End of ... Else of ... if ( ! is_dir( $this->szHome ) ) */

        }   /* if ( is_array( $this->myself ) ) */

        return ( $this );
    }   /* End of Mother.updateSelf() ================================================= */
    /* ================================================================================ */


    public function languages( $szQuery = null )
    /*----------------------------------------*/
    {
        $aRetVal = null;

        //var_dump( $szQuery );

        // Cette méthode devrait retourner TOUTES les langues si le $szQuery était null
        // à l'instar de ce que fait la méthode countries()
        // Au début la méthode s'appelait d'ailleurs "language()" et non "languages()".
        // Elle est utilisée sous cette forme dans trql.voltaire.class.php dans la
        // méthode "analyze()"

        $this->addInfo( __METHOD__ . "() at line " . __LINE__ . " : je ne comprends pas bien ce que cette méthode fait dans la classe Mother!" );

        if ( $this->self['resources'] )
        {
            if ( is_file( $szFile = $this->self['resources'] . '/XML/languages.xml' ) )
            {
                $oDom = new \DOMDocument();

                if ( $oDom->load( $szFile ) )
                {
                    //var_dump( "XML LOADED" );

                    $oXPath = new \DOMXPath( $oDom );

                    $oColl = $oXPath->query( "//Language[@id='{$szQuery}']|//Language[@iso-639-2='{$szQuery}']" );

                    if ( $oColl->length > 0 )
                    {
                        $aRetVal['iso-639-1']       = $oColl->item(0)->getAttribute( 'id' );
                        $aRetVal['iso-639-1-doc']   = 'https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes';
                        $aRetVal['iso-639-2']       = $oColl->item(0)->getAttribute( 'iso-639-2' );
                        $aRetVal['iso-639-2-doc']   = 'https://en.wikipedia.org/wiki/List_of_ISO_639-2_codes';
                    }   /* if ( $oColl->length > 0 ) */
                }   /* if ( $oDom->load( $szFile ) ) */
            }   /* if ( is_file( $szFile = $this->self['resources'] . '/XML/languages.xml' ) ) */
        }   /* if ( $this->self['resources'] ) */

        return ( $aRetVal );

    }   /* End of Mother.languages() ================================================== */
    /* ================================================================================ */


    public function countries( $szQuery = null,$szLang = 'en' )
    /*-------------------------------------------------------*/
    {
        $aRetVal = null;
        static $aCountries = null;

        if ( ! is_null( $szQuery ) )
        {
            $szQuery = strtoupper( trim( $szQuery ) );
            $iLength = strlen( $szQuery );
        }
        else
        {
            $iLength = 0;
        }

        $this->addInfo( __METHOD__ . "() at line " . __LINE__ . " : je ne comprends pas bien ce que cette méthode fait dans la classe Mother!" );

        if ( is_null( $aCountries ) )                               /* If data NOT loaded yet */
        {
            if ( $this->self['resources'] )
            {
                if ( is_file( $szFile = $this->self['resources'] . '/XML/countries.xml' ) )
                {
                    $this->addInfo( __METHOD__ . "(): '{$szFile}' should be regularly updated via 'http://api.geonames.org/countryInfo'" );

                    $oDom = new \DOMDocument();

                    if ( $oDom->load( $szFile ) )
                    {
                        //var_dump( "XML LOADED" );

                        $oXPath = new \DOMXPath( $oDom );

                        //$oColl = $oXPath->query( "//Language[@id='{$szQuery}']|//Language[@iso-639-2='{$szQuery}']" );
                        $oColl = $oXPath->query( "//Country" );

                        if ( $oColl->length > 0 )
                        {
                            $aLanguages   = null;

                            $aLanguages[] = 'fr';
                            $aLanguages[] = 'en';
                            $aLanguages[] = 'nl';
                            $aLanguages[] = 'de';
                            $aLanguages[] = 'es';
                            $aLanguages[] = 'it';
                            $aLanguages[] = 'pt';
                            $aLanguages[] = 'da';
                            $aLanguages[] = 'sv';
                            $aLanguages[] = 'no';
                            $aLanguages[] = 'li';
                            $aLanguages[] = 'pl';
                            $aLanguages[] = 'cs';
                            $aLanguages[] = 'sk';
                            $aLanguages[] = 'hu';

                            foreach( $oColl as $oNode )
                            {
                                $szFlag     =
                                $szGroup    =
                                $aNames     =
                                              null;

                                if ( ( $o = $oXPath->query( "Flag",$oNode ) ) && $o->length > 0 )
                                    $szFlag = $o->item(0)->nodeValue;

                                if ( ( $o = $oXPath->query( "Group",$oNode ) ) && $o->length > 0 )
                                    $szGroup = $o->item(0)->nodeValue;

                                foreach( $aLanguages as $szLang )
                                {
                                    $aNames[$szLang] = $szName = $szCleaned = '';

                                    if ( ( $o = $oXPath->query( "Name[@lang='{$szLang}']",$oNode ) ) && $o->length > 0 )
                                        $szName = $o->item(0)->nodeValue;

                                    if ( ( $o = $oXPath->query( "Name[@lang='{$szLang}']/@cleaned",$oNode ) ) && $o->length > 0 )
                                        $szCleaned = $o->item(0)->nodeValue;

                                    $aNames[$szLang] = array( 'value'   => $szName,
                                                              'cleaned' => $szCleaned,
                                                            );
                                    //var_dump( $aNames[$szLang] );
                                }   /* foreach( $aLanguages as $szLang ) */

                                $aCountries[$oNode->getAttribute('id')]  = array( 'id'                  => $oNode->getAttribute( 'id'                   ),
                                                                                  'geonameId'           => $oNode->getAttribute( 'geonameid'            ),
                                                                                  'continent'           => $oNode->getAttribute( 'continent'            ),
                                                                                  'capital'             => $oNode->getAttribute( 'capital'              ),
                                                                                  'currency'            => $oNode->getAttribute( 'currency'             ),
                                                                                  'languages'           => $oNode->getAttribute( 'languages'            ),
                                                                                  'ISO-3166-1-alpha-3'  => $oNode->getAttribute( 'ISO-3166-1-alpha-3'   ),
                                                                                  'ISO-3166-1-num'      => $oNode->getAttribute( 'ISO-3166-1-num'       ),
                                                                                  'areaInSqKm'          => $oNode->getAttribute( 'areaInSqKm'           ),
                                                                                  'population'          => $oNode->getAttribute( 'population'           ),
                                                                                  'box-lat-lng'         => $oNode->getAttribute( 'box-lat-lng'          ),
                                                                                  'postalCodesCount'    => $oNode->getAttribute( 'postalCodesCount'     ),
                                                                                  'postalCodeMin'       => $oNode->getAttribute( 'postalCodeMin'        ),
                                                                                  'postalCodeMax'       => $oNode->getAttribute( 'postalCodeMax'        ),
                                                                                  'postalCodeFormat'    => $oNode->getAttribute( 'postalCodeFormat'     ),
                                                                                  'flag'                => $szFlag                                       ,
                                                                                  'group'               => $szGroup                                      ,
                                                                                  'names'               => $aNames                                       ,
                                                                                );

                            }

                            uasort( $aCountries,function( $a,$b )
                                                {
                                                    $szKeyA = strtoupper( $a['id'] );
                                                    $szKeyB = strtoupper( $b['id'] );

                                                    //var_dump( $szKeyA );
                                                    //var_dump( $szKeyB );

                                                    if ( $szKeyA === $szKeyB )
                                                    {
                                                        return 0;
                                                    }
                                                    elseif( $szKeyA < $szKeyB )
                                                    {
                                                        return -1;
                                                    }
                                                    else
                                                    {
                                                        return 1;
                                                    }
                                                } );
                        }   /* if ( $oColl->length > 0 ) */
                    }   /* if ( $oDom->load( $szFile ) ) */
                }   /* if ( is_file( $szFile = $this->self['resources'] . '/XML/countries.xml' ) ) */
            }   /* if ( $this->self['resources'] ) */
        }   /* if ( is_null( $aCountries ) ) */

        //var_dump( $szQuery );
        //die();

        //var_dump( $aCountries );
        //die();

        if ( is_null( $szQuery ) )
        {
            return ( $aCountries );
        }
        elseif ( $iLength === 2 )
        {
            if ( isset( $aCountries[$szQuery] ) )
            {
                $aRetVal[$szQuery] = $aCountries[$szQuery];
                //var_dump( $aRetVal[$szQuery] );
                //die();
            }
        }
        elseif ( $iLength === 3 )
        {
            foreach( $aCountries as $szKey => $aCountry )
            {
                if ( ( $aCountry['ISO-3166-1-alpha-3'] ?? '---' ) === $szQuery )
                {
                    $aRetVal[$aCountry['id']] = $aCountry;
                    break;
                }
            }
        }

        end:

        return ( $aRetVal );
    }   /* End of Mother.countries() ================================================== */
    /* ================================================================================ */


    public function die( $szMsg = null )
    /*----------------------------------*/
    {
        $x = debug_backtrace();
        //var_dump( $x );
        die( "Dying gently at line " . $x[0]['line']  . " of " . $x[0]['file'] . ( isset( $szMsg ) ? ( ': ' . $szMsg ) : '' ) );
    }   /* End of Mother.__die() ====================================================== */
    /* ================================================================================ */


    /* Cette fonction est obsolète : remplacée par die() */
    public function __die( $szMsg = null )
    /*--------------------------------*/
    {
        $this->die( $szMsg );
    }   /* End of Mother.die() ====================================================== */
    /* ================================================================================ */


    public function echo( $szMsg )
    /*--------------------------*/
    {
        $x = debug_backtrace();
        //var_dump( $x );
        echo $x[0]['line']," of '",$x[0]['file'],"' ... ",$szMsg;
    }   /* End of Mother.echo() ===================================================== */
    /* ================================================================================ */


    /* Cette fonction est obsolète : remplacée par echo() */
    public function __echo( $szMsg )
    /*----------------------------*/
    {
        $this->echo( $szMsg );
    }   /* End of Mother.__echo() ===================================================== */
    /* ================================================================================ */


    /* Chaque fois qu'un cache est utilisé, son ranking s'améliore;
       Quand on demande la méthode forget(), on oublie 5% des caches
       les moins utilisés; quand on demande forgetAll(), tous les
       caches sont éliminés */
    public function rankCache()
    /*-----------------------*/
    {
        // Cette fonction est, pour l'instant, sans intérêt car elle est vide
    }   /* End of Mother.rankCache() ================================================== */
    /* ================================================================================ */


    public function forget()
    /*--------------------*/
    {
        static $fPercent    = 5;                           /* 5% des fichiers seront éliminés */
        static $iOlderThan  = 86400 * ( 365 / 12 ) /* Days per month */ * 3;

        $this->echo( __METHOD__ . '() is experimental' );
        //var_dump( $this->szHome );
        $aTmp = vaesoli::FIL_aFilesEx( $this->szHome . '/trql*.cache.used' );

        foreach ( $aTmp as $szFile )
        {
            $aFiles[] = array( 'file'   => $szFile                                  ,
                               'utc'    => vaesoli::FIL_MDate( $szFile,'int' )   ,
                               'size'   => vaesoli::FIL_Size( $szFile )             ,
                             );
        }

        /* Tri: des fichiers les moins récents au plus récents */
        usort( $aFiles, function( $a,$b )
                        {
                            $szKeyA = vaesoli::STR_padl( $a['utc'],15,'0' ) . '|' . vaesoli::STR_padl( $a['size'],10,'0' );
                            $szKeyB = vaesoli::STR_padl( $b['utc'],15,'0' ) . '|' . vaesoli::STR_padl( $b['size'],10,'0' );

                            //var_dump( $szKeyA );
                            //var_dump( $szKeyB );

                            if ( $szKeyA === $szKeyB )
                            {
                                return 0;
                            }
                            elseif( $szKeyA < $szKeyB )
                            {
                                return -1;
                            }
                            else
                            {
                                return 1;
                            }
                        } );

        var_dump( $aFiles );
        $iFileCount = count( $aFiles );
        var_dump( $iFileCount );
        $iFilesToDelete = floor( $iFileCount * $fPercent / 100 );
        var_dump( $iFilesToDelete );

        //if ( $iFilesToDelete > 0 )
        {
            $iFilesToDelete = 1; /* DEBUG */
            $aFilesToDelete = array_slice( $aFiles,0,$iFilesToDelete );
            var_dump( $aFilesToDelete );
            // Ici, je dois voir si chaque fichier de $aFilesToDelete est plus vieux
            // que $iOlderThan; si oui, alors ... je peux l'éliminer, lui et son fichier
            // de contenu associé.
        }

    }   /* End of Mother.forget() ===================================================== */
    /* ================================================================================ */

    /*
        For #ArtificialInteligence, it is as important to actually "remember
        sth" as it is to remember the repetition of the need to "remember sth"
        as well as the "burying" of this need over time. It is a notion of
        "Last/Least Recently Used" and "How Much Used".

        When it comes to "forgetting", these notions are pivotal! And forgetting
        is also essential.

        For #trqlradio's API services, we use these notions to build/invalidate
        the "caches" that are generated/consulted.
    */
    public function getCache( $szFile )
    /*-------------------------------*/
    {
        // En augmentant la taille du fichier de 1 byte ('.') grâce à FIL_Append(),
        // on sait combien de fois on s'est servi du fichier; en consultant
        // la date du fichier, on sait quand on s'en est servi la dernière
        // fois.
        vaesoli::FIL_AppendNoNL( $szFile . '.used','.' );
        return ( $this->getHashFile( $szFile ) );
    }   /* End of Mother.getCache() =================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*protected isRightTimeForHouseKeeping()=

        Is the current datetime suitable to start a bunch of housekeeping tasks such as
        autobackup, autodocumentation, ...

        {*params
        *}

        {*return
            (boolean)       [c]true[/c] if we consider the current time to be suitable to
                            start some interestings tasks such as autobackup, autodoc, ...
        *}

        *}}
    */
    /* ================================================================================ */
    protected function isRightTimeForHouseKeeping()
    /*-------------------------------------------*/
    {
        $iDoW   = (int) date( 'N' );
        $iHour  = (int) $szHour = date( 'Hi' );

        /* If Monday, Wednesday, Friday or Sunday */
        //if ( $iDoW === 1 || $iDoW === 2 || $iDoW === 5 || $iDoW === 7 )
        //if ( $iDoW === 1 || $iDoW === 4 )
        //if ( $iDoW === 7 && $iHour >= 22 )
        //if ( ( $iDoW === 1 || $iDoW === 3 || $iDoW === 5 || $iDoW === 7 ) && ( $iHour >= 22 ) )
        //if ( ( $iDoW % 2 === 1 ) && ( $iHour > 21 ) )
        //return ( ( $iDoW % 2 === 1 ) && ( $iHour > 21 ) );

        return ( $szHour >= '0000' && $szHour <= '0005' ||
                 $szHour >= '0100' && $szHour <= '0105' ||
                 $szHour >= '0200' && $szHour <= '0210' ||
                 $szHour >= '2300' && $szHour <= '2305' );

    }   /* End of Mother.isRightTimeForHouseKeeping() ================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*backup( [$bForced] )=

        Provides an easy backup facility

        {*params
            $bForced        (bool)      [c]true[/c] force the backup of the class.
                                        [c]false[/c] do not force the backup of the 
                                        class. Optional; [c]false[/c] by default.
        *}

        {*return
            (self)      Current instance
        *}

        *}}
    */
    /* ================================================================================ */
    public function backup( $bForced = false )
    /*--------------------------------------*/
    {
        if ( $bForced || ( $this->backupRequired && $this->isRightTimeForHouseKeeping() ) )
        {
            $iDoW       = (int) date('N');
            $szWeekNo   = date('W');

            //var_dump( $this->self['home'] );
            $szSource = $this->self['file'];
            $szTarget = vaesoli::FIL_RealPath( $this->self['home'] . '/backups/' . basename( $szSource ) );

            if ( ! is_dir( $szDir = dirname( $szTarget ) ) )
                vaesoli::FIL_MkDIr( $szDir );

            if ( is_dir( $szDir ) )
            {
                if ( ! defined( 'ZIP_CLASS_VERSION' ) )
                    require_once( 'trql.zip.class.php' );

                $o          = new Zip();

                $szFile     = $this->self['file'];
                $szZIPFile  = $this->self['home'] . '/backups/' . basename( $szFile,'.php' ) . '.zip';

                //var_dump( $o->self );
                //var_dump( $szFile );
                //var_dump( $szZIPFile );

                $o->open( $szZIPFile,Zip::CREATE );
                $o->addFile( $szFile,$szFile . ".backup.{$szWeekNo}.{$iDoW}" );

                $o->close();
            }   /* if ( is_dir( $szDir ) ) */
        }   /* if ( $this->backupRequired ) */

        return ( $this );
    }   /* End of Mother.backup() ===================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*templates()=

        Returns the templates of the class

        {*params
        *}

        {*return
            (void)      No return value provided
        *}

        {*warning
            This is a temporary method created for testing purposes. DO NOT USE IT
            IN A PRODUCTION ENVIRONMENT!!!
        *}

        *}}
    */
    /* ================================================================================ */
    public function templates()
    /*-----------------------*/
    {
        echo __LINE__," ... " . get_class( $this ) . " - " . __METHOD__ . "\n";
    }   /* End of Mother.templates() ================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*substitutions()=

        Performs some heavy substitutions

        {*params
        *}

        {*return
            (void)      No return value provided
        *}

        {*warning
            This is a temporary method created for testing purposes. DO NOT USE IT
            IN A PRODUCTION ENVIRONMENT!!!
        *}

        *}}
    */
    /* ================================================================================ */
    public function substitutions()
    /*---------------------------*/
    {
        echo __LINE__," ... " . get_class( $this ) . " - " . __METHOD__ . "\n";
    }   /* End of Mother.substitutions() ============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*setHome( $szFolder )=

        Sets the home of the class (e.g. d:\websites\snippet-center\intangible.class\)

        {*params
        *}

        {*return
            (self)      Current instance
        *}

        *}}
    */
    /* ================================================================================ */
    protected function setHome( $szFolder = null )
    /*-----------------------------------*/
    {

        $trace = debug_backtrace();
        $caller = $trace[1];

        echo "Called by {$caller['function']}\n";
        if (isset($caller['class']))
            echo " in {$caller['class']}\n";


        $this->__die( "Dying at line " . __LINE__ . " in " . __METHOD__ . "(): obsolete method; no longer supported" );

        if ( is_null( $szFolder ) )
            $szFolder = __DIR__;
        else
            $szFolder = __DIR__ . '/' . $szFolder;


        //var_dump( "----FOLDER DANS " . __METHOD__ ."(): " . $szFolder );
        $this->szHome = vaesoli::FIL_RealPath( $szFolder );
        //var_dump( "HOME DANS " . __METHOD__ ."(): " . $this->szHome );

        if ( ! is_dir( $this->szHome ) )
        {
            $this->addInfo( __METHOD__ . "(): '{$this->szHome}' NOT found" );

            if ( vaesoli::FIL_MkDir( $this->szHome ) )
                $this->addInfo( __METHOD__ . "(): '{$this->szHome}' created" );
        }   /* if ( ! is_dir( $this->szHome ) ) */
        else
        {
            $this->addInfo( __METHOD__ . "(): '{$this->szHome}' FOUND" );
        }

        return ( $this );
    }   /* End of Mother.setHome() ==================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*home()=

        Returns home folder of the class (where it may stores data)

        {*params
        *}

        {*return
            (string)    The home directory of the class or null if not set
        *}

        *}}
    */
    /* ================================================================================ */
    public function home()
    /*------------------*/
    {
        return ( $this->szHome ?? null );
    }   /* End of Mother.home() ======================================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*method( $szMethod )=

        Returns the name of the method

        {*params
            $szMethod       (string)        Name of the method (__METHOD__)
        *}

        {*return
            (string)    Keeps the pure name of the method (e.g.
                        "trql\anaximandre\Anaximandre::forecast" gives
                        "forecast")
        *}

        *}}
    */
    /* ================================================================================ */
    public function method( $szMethod )
    /*-------------------------------*/
    {
        return ( str_iReplace( $this->myself['class'] . '::','',$szMethod ) );
    }   /* End of Mother.method() ===================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*addInfo( $x )=

        Stores a last info

        {*params
            $x      (mixed)     The information to be stored
        *}

        {*return
            (self)  The current instance of the class
        *}

        *}}
    */
    /* ================================================================================ */
    public function addInfo( $x )
    /*--------------------------*/
    {
        $this->lastInfo[] = array( 'time' => time(),'info' => $x );

        return ( $this );
    }   /* End of Mother.addInfo() ==================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*getURL( $szURL )=

        Returns the resource identified by its URL

        {*params
            $szURL      (string)        URL to get
        *}

        {*return
            (string)    The resource identified by $szURL in a string format
        *}

        *}}
    */
    /* ================================================================================ */
    public function getURL( $szURL,$aParams = null )
    /*--------------------------------------------*/
    {
        return ( vaesoli::HTTP_GetURL( $szURL ) );
    }   /* End of Mother.getURL() ===================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*memorize( $szKey,$xValue )=

        Memorizes a key/value pair

        {*params
            $szKey      (string)        Key associated to $xValue
            $xValue     (mixed)         Value to store in memory
        *}

        {*return
            (self)      Current object
        *}

        *}}
    */
    /* ================================================================================ */
    protected function memorize( $szKey,$szType,$xValue )
    /*-------------------------------------------------*/
    {
        /* Je ne sais pas du tout si c'est intelligent de faire cela comme cela */

        /*
            Mémoire immédiate
            Mémoire de travail
            Mémoire de long terme
                - mémoire épisodique (e.g. "la première fois que ...")
                - mémoire lexicale (e.g. "mémoire des mots" )
                - mémoire sémantique (e.g. les concepts, les idées, les notions; mémoire
                  qui fournit un sens aux choses)

            Il faudrait alors disposer d'une classe "Memory" organisée de la sorte!

            On glane des événements et on stocke dans la mémoire immédiate (mémoire
            limitée - slots limités); si on suscite la mémoire immédiate on fait
            passer ce qu'on y a pris dans la mémoire de travail; on passe de même
            de la mémoire de travail à la mémoire long terme.

            La mémoire immédiate demande la création de classes de type "stack", "list",
            ... et aussi de quoi cycler (circular list, circular stack).

        */

        $this->memory[$szKey] = array( 'type'       => 'unknown'            ,
                                       'datetime'   => time()               ,
                                       'data'       => serialize( $xValue ) ,
                                     );
        return ( $this );
    }   /* End of Mother.__memorize() ================================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__get( $szVar )=

        Used for reading data from inaccessible (protected or private) or
        non-existing properties.

        {*params
            $szVar      (string)        The name of the properties to access
        *}

        {*return
            (mixed)     The value of [c]$szVar[/c] or throwing an exception if
                        [c]$szVar[/c] NOT found.
        *}

        *}}
    */
    /* ================================================================================ */
    public function __get( $szVar )
    /*---------------------------*/
    {
        switch ( strtolower( $szVar ) )
        {
            case 'icon'         :   return ( '/snippet-center/icons/' . basename( $this->classIcon ) );
            case 'remembering'  :   return ( $this->remembering );
            case 'myself'       :
            case 'self'         :   return ( $this->self );
            default             :   throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": {$szVar} UNKNOWN (ErrCode: " . EXCEPTION_CODE_INVALID_PROPERTY . ")",EXCEPTION_CODE_INVALID_PROPERTY );
        }
    }   /* End of Mother.__get() ====================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*isCommandLine()=

        Determines if the class is used in the context of a command line or not

        {*params
        *}

        {*return
            (bool)      [c]true[/c] if the class is used in a command line context;
                        [c]false[/c] otherwise
        *}

        *}}
    */
    /* ================================================================================ */
    public function isCommandLine()
    /*---------------------------*/
    {
        static $bCommandLine = null;

        if ( is_null( $bCommandLine ) )
            if ( empty(   $_SERVER['REMOTE_ADDR'    ] ) &&
                 ! isset( $_SERVER['HTTP_USER_AGENT'] ) &&
                 count(   $_SERVER['argv'] ) > 0 )
                $bCommandLine = true;
            else
                $CommandLine = false;

        $this->addInfo( __METHOD__ . "() at line " . __LINE__ . " : this method is probably obsolete given the same sort of method in utils" );

        return ( $bCommandLine );
    }   /* End of Mother.isCommandLine() ============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*guid()=

        Returns a GUID (unique in time, unique in space)

        {*params
        *}

        {*return
            (string)    GUID
        *}

        {*exec
            $oRadio = new Radio();
            echo "<p>GUID: ",$szGUID = $oRadio->guid(),': length = ',$iLength = strlen( $szGUID ),"</p>";
            $aParts = explode( '-',$szGUID );

            echo LSUnitTesting::assert( $iLength === 38                                   &&
                                        preg_match( '/\{.*?-.*?-.*?-.*?-.*?\}/',$szGUID ) &&
                                        count( $aParts ) === 5                              ,
                                        'ASSERTION SUCCESSFUL: GUID seems to be OK'         ,
                                        'ASSERTION FAILURE: invalid GUID as it seems'       ,
                                        'GuideAssert' );

            var_dump( $aParts );
        *}

        *}}
     */
    /* ================================================================================ */
    public function guid()
    /*------------------*/
    {
        static $hyphen = null;

        if ( is_null( $hyphen ) )
            $hyphen = chr(45);                                          /* "-" */

        if ( function_exists( 'com_create_guid' ) )
        {
            return ( com_create_guid() );
        }   /* if ( function_exists( 'com_create_guid' ) ) */
        else   /* Else of ... if ( function_exists('com_create_guid') ) */
        {
            mt_srand( microtime( true ) * 10000 );                      /* Optional for php 4.2.0 and up. */

            $charid = strtoupper( md5( uniqid( rand(),true ) ) );

            $uuid   = chr(123)                            .             /* "{" */
                      substr( $charid, 0, 8 ) . $hyphen   .
                      substr( $charid, 8, 4 ) . $hyphen   .
                      substr( $charid,12, 4 ) . $hyphen   .
                      substr( $charid,16, 4 ) . $hyphen   .
                      substr( $charid,20,12 )             .
                      chr(125);                                         /* "}" */
            return ( $uuid );
        }   /* End of ... Else of ... if ( function_exists('com_create_guid') ) */
    }   /* End of Mother.guid() ======================================================= */
    /* ================================================================================ */


    public function getMemLimit()
    /*-------------------------*/
    {
        $iLimit = -1;
        $xLimit = ini_get( 'memory_limit' );

        if ( preg_match( '/(?P<num>\d+)(?P<unit>(K|M|G)?)/si',(string) $xLimit,$aMatch ) )
        {
            if ( isset( $aMatch['unit'] ) )
            {
                switch ( $aMatch['unit'] )
                {
                    case 'K'    :   $iLimit = ( (int) $aMatch['num'] ) * 1024;
                                    break;
                    case 'M'    :   $iLimit = ( (int) $aMatch['num'] ) * 1024 * 1024;
                                    break;
                    case 'G'    :   $iLimit = ( (int) $aMatch['num'] ) * 1024 * 1024 * 1024;
                                    break;
                    default     :   $iLimit = ( (int) $aMatch['num'] );
                }
            }
            else
            {
                $iLimit = $iLimit = ( (int) $aMatch['num'] );
            }
        }   /* if ( preg_match( '/(?P<num>\d+)(?P<unit>(K|M|G)?)/si',(string) $xLimit,$aMatch ) ) */

        return ( $iLimit );
    }   /* End of Mother.getMemLimit() ================================================ */
    /* ================================================================================ */


    public function getMemLeft()
    /*------------------------*/
    {
        return ( $this->getMemLimit() - memory_get_usage( true ) );
    }   /* End of Mother.getMemLeft() ================================================= */
    /* ================================================================================ */


    protected function setMinimumMemory( $szMem = '8192M' )
    /*---------------------------------------------------*/
    {
        ini_set( 'memory_limit',$szMem );
    }   /* End of Mother.setMinimumMemory() =========================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*getParam()=

        Returns the value of a parameter

        {*params
        *}

        {*return
            (string)    GUID
        *}

        {*exec
            $oRadio = new Radio();
            echo "<p>GUID: ",$szGUID = $oRadio->guid(),': length = ',$iLength = strlen( $szGUID ),"</p>";
            $aParts = explode( '-',$szGUID );

            echo LSUnitTesting::assert( $iLength === 38                                   &&
                                        preg_match( '/\{.*?-.*?-.*?-.*?-.*?\}/',$szGUID ) &&
                                        count( $aParts ) === 5                              ,
                                        'ASSERTION SUCCESSFUL: GUID seems to be OK'         ,
                                        'ASSERTION FAILURE: invalid GUID as it seems'       ,
                                        'GuideAssert' );

            var_dump( $aParts );
        *}

        *}}
     */
    /* ================================================================================ */
    function getParam( $szParameter,$xDefault,$aParams = null )
    /*-------------------------------------------------------*/
    {
        $szRetVal = $xDefault;

        if ( ! isset( $aParams ) )
        {
            if ( $this->isCommandLine() )
            {
                if ( isset( $_SERVER['argv'] ) )
                {
                    //var_dump( "Looking for {$szParameter}" );

                    $szPattern = '/\A' . $szParameter . '=(?P<value>.*?)\z/';
                    //var_dump( $szPattern );

                    foreach( $_SERVER['argv'] as $szParam )
                    {
                        if ( preg_match( $szPattern,$szParam,$aMatches ) )
                        {
                            $szRetVal = $aMatches['value'];
                            goto end;
                        }   /* if ( preg_match( $szPattern,$szParam,$aMatches ) ) */
                    }   /* foreach( $_SERVER['argv'] as $szParam ) */
                }   /* if ( isset( $_SERVER['argv'] ) ) */
            }   /* if ( $this->isCommandLine() ) */
            else    /* Else of ... if ( $this->isCommandLine() ) */
            {
                // 1) Nous n'avons PAS reçu les paramètres
                // 2) Nous ne sommes PAS en mode ligne de commande

                // Conlusion: les arguments doivent se trouver dans $_GET
                if ( isset( $_GET[ $szParameter ] ) )
                {
                    $szRetVal = trim( $_GET[ $szParameter ] );
                    goto end;
                }   /* if ( isset( $_GET[ $szParam ] ) ) */
            }   /* End of ... Else of ... if ( $this->isCommandLine() ) */
        }   /* if ( ! isset( $aParams ) ) */
        else    /* Else of ... if ( ! isset( $aParams ) ) */
        {
            if ( $this->isCommandLine() )
            {
                foreach( $aParams as $szValue )
                {
                    $szPattern = "/{$szParameter}=(?P<{$szParameter}>.*?)\z/";
                    //var_dump( "Pattern: {$szPattern}" );
                    if ( preg_match( $szPattern,$szValue,$aMatches ) )
                    {
                        //var_dump("FOUND");
                        //var_dump( $aMatches );
                        $szRetVal = $aMatches[$szParameter];
                        break;
                    }
                }   /* foreach( $aParams as $szValue ) */
            }   /* if ( $this->isCommandLine() ) */
            else
            {
                if ( isset( $aParams[ $szParameter ] ) )
                {
                    $szRetVal = trim( $aParams[ $szParameter ] );
                    goto end;
                }   /* if ( isset( $_GET[ $szParam ] ) ) */
            }
        }    /* End of ... Else of ... if ( ! isset( $aParams ) ) */


        //var_dump( "WIll return: " );
        //var_dump( $szRetVal );

        end:
        return ( $szRetVal );
    }   /* End of Mother.getParam() =================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*saveHashFile( $szFile,$xData )=

        Saves $xData in $szFile

        {*params
            $szFile     (string)    The name of the hash/cache file
            $xData      (mixed)     The data that must be saved in $szFile
        *}

        {*return
            (boolean)   [c]true[/c] if $xData saved correctly in $szFile; [c]false[/c]
                        otherwise
        *}

        *}}
    */
    /* ================================================================================ */
    public function saveHashFile( $szFile,$xData )
    /*------------------------------------------*/
    {
        $this->setMinimumMemory();

        $bRetVal = false;

        if ( ! is_null( $xData ) )
        {
            $bRetVal = vaesoli::FIL_StrToFile( @serialize( $xData ),$szFile );

            if ( ! is_null( $xError = error_get_last() ) )
            {
                //var_dump( "Error in " . __FUNCTION__ . "(): " . basename( $szFile ) );
                //var_dump( "Offending file (filename length: " . strlen( $szFile ) . "): " . $szFile );
                //var_dump( $xError );
            }
            //var_dump( $bRetVal );
        }
        else
        {
            //var_dump( "NULL DATA IN " . __FUNCTION__ . "()" );
        }

        return ( $bRetVal );
    }   /* End of Mother.saveHashFile() =============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*getHashFile( $szFile )=

        Gets the content of a hash/cache file. If possible, the content is unserialized

        {*params
            $szFile     (string)    The name of the hash/cache file
        *}

        {*return
            (mixed)     The unserialized content of the file or null if the unserialization
                        was unsuccessful, in which case an exception is thrown
        *}

        {*warning
            A number of exceptions are thrown in a number of cases:[br]

            [c]EXCEPTION_HASH_FILE_CANNOT_BE_UNSERIALIZED[/c]   In case the content
            could not be unserialized[br]

            [c]EXCEPTION_HASH_FILE_OUT_OF_MEMORY[/c]   In case we are running out of
            memory[br]

            [c]EXCEPTION_HASH_FILE_EMPTY[/c]   In case the hash/cache file is empty[br]

        *}

        *}}
    */
    /* ================================================================================ */
    public function getHashFile( $szFile )
    /*----------------------------------*/
    {
        $this->setMinimumMemory();

        $xRetVal = null;

        if ( ( $iMemLeft = $this->getMemLeft() ) > ( $iSize = vaesoli::FIL_Size( $szFile ) ) )
        {
            //FIL_Append( FIL_ResolveRoot( "/loco.log" ),"In trql_radio_getHashFile() ... enough memory" );

            if ( ! empty( $szDef = vaesoli::FIL_FileToStr( $szFile ) ) )
            {
                //FIL_Append( FIL_ResolveRoot( "/loco.log" ),"In trql_radio_getHashFile() ... Def is OK" );

                if ( ( $iMemLeft = $this->getMemLeft() ) > $iSize )
                {
                    //FIL_Append( FIL_ResolveRoot( "/loco.log" ),"In trql_radio_getHashFile() ... Still enough memory" );

                    if ( ! ( $xRetVal = @unserialize( $szDef ) ) )
                    {
                        /* PROBLEM !!! CAR CELA NE VA PAS MARCHER EN MODE COMMAND LINE ET ON DOIT FAIRE APPEL A CLASSE VAESOLI! */
                        // FIL_Append( FIL_ResolveRoot( "/loco.log" ),"In trql_radio_getHashFile() ... unserialize() KO" );
                        $xRetVal = null;
                        // throw new Exception( __FUNCTION__ . "() at line " . __LINE__ . ": '{$szFile}' cannot be unserialized (return value is of " . gettype( $xRetVal ) . " type)",EXCEPTION_HASH_FILE_CANNOT_BE_UNSERIALIZED );
                    }   /* if ( ! ( $xRetVal = @unserialize( $szDef ) ) ) */
                    else    /* Else of ... if ( ! ( $xRetVal = @unserialize( $szDef ) ) ) */
                    {
                        //FIL_Append( FIL_ResolveRoot( "/loco.log" ),"In trql_radio_getHashFile() ... unserialize() OK" );
                    }   /* Else of ... if ( ! ( $xRetVal = @unserialize( $szDef ) ) ) */
                }   /* if ( ( $iMemLeft = $this->getMemLeft() ) > $iSize ) */
                else
                {
                    /* PROBLEM !!! CAR CELA NE VA PAS MARCHER EN MODE COMMAND LINE ET ON DOIT FAIRE APPEL A CLASSE VAESOLI! */
                    // FIL_Append( FIL_ResolveRoot( "/loco.log" ),"In trql_radio_getHashFile() ... memory exhausted" );
                    throw new Exception( __FUNCTION__ . "() at line " . __LINE__ . ": Memory exhausted: {$iMemLeft} bytes left vs. {$iSize} bytes needed",EXCEPTION_HASH_FILE_OUT_OF_MEMORY );
                }
            }
            else
            {
                /* PROBLEM !!! CAR CELA NE VA PAS MARCHER EN MODE COMMAND LINE ET ON DOIT FAIRE APPEL A CLASSE VAESOLI! */
                // FIL_Append( FIL_ResolveRoot( "/loco.log" ),"In trql_radio_getHashFile() ... Def is KO" );
                $xRetVal = null;
                //throw new Exception( __FUNCTION__ . "() at line " . __LINE__ . ": Empty hash file: {$szFile}",EXCEPTION_HASH_FILE_EMPTY );
            }
        }
        else
        {
            /* PROBLEM !!! CAR CELA NE VA PAS MARCHER EN MODE COMMAND LINE ET ON DOIT FAIRE APPEL A CLASSE VAESOLI! */
            // FIL_Append( FIL_ResolveRoot( "/loco.log" ),"In trql_radio_getHashFile() ... NOT enough memory" );
            throw new Exception( __FUNCTION__ . "() at line " . __LINE__ . ": Memory exhausted: {$iMemLeft} bytes left vs. {$iSize} bytes needed",EXCEPTION_HASH_FILE_OUT_OF_MEMORY );
        }

        return ( $xRetVal );
    }   /* End of Mother.getHashFile() ================================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*fileExistsAndOlderThan( $szFile,$iSec )=

        Determines if $szFile exists and is olden than $iSec secs

        {*params
            $szFile     (string)    The name of the file to check
            $iSec       (int)       The number of seconds (as of NOW)
        *}

        {*return
            (boolean)   [c]true[/c] if $szFile exists and is older than $iSec secs;
                        [c]false[/c] otherwise
        *}

        {*seealso
            fileExistsAndNoOlderThan(), fileOlderThan()
        *}

        *}}
    */
    /* ================================================================================ */
    public function fileExistsAndOlderThan( $szFile,$iSec )
    /*---------------------------------------------------*/
    {
        return ( is_file( $szFile ) && $this->fileOlderThan( $szFile,$iSec ) );
    }   /* End of Mother.fileExistsAndOlderThan() ===================================== */
    /* ================================================================================ */


    public function fileExistsAndNoOlderThan( $szFile,$iSec )
    /*-----------------------------------------------------*/
    {
        return ( is_file( $szFile ) && ! $this->fileOlderThan( $szFile,$iSec ) );
    }   /* End of Mother.fileExistsAndNoOlderThan() =================================== */
    /* ================================================================================ */


    public function fileOlderThan( $szFile,$iSec )
    /*------------------------------------------*/
    {
        return ( ( time() - vaesoli::FIL_mTime( $szFile ) ) > $iSec );
    }   /* End of Mother.fileOlderThan() ============================================== */
    /* ================================================================================ */


    public function tao()
    /*-----------------*/
    {
        /* CODE TEMPORAIRE */
        $reflect = new \ReflectionClass( $this );
        $props   = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PROTECTED);
        return ( $props );
    }   /* End of Mother.tao() ======================================================== */
    /* ================================================================================ */


    public function isDocumentationOutdated()
    /*-------------------------------------*/
    {
        static $szHomeOfDocumentation = null;

        if ( is_null( $szHomeOfDocumentation ) )
            $szHomeOfDocumentation = vaesoli::FIL_RealPath( dirname( $this->self['home'] ) . '/DOCUMENTATION/' );

        if ( ! is_dir( $szHomeOfDocumentation ) )
            vaesoli::FIL_MkDir( $szHomeOfDocumentation );

        $szDocumentionFile = $szHomeOfDocumentation . basename( $this->self['file'] . '.html' );

        //var_dump( $szHomeOfDocumentation,$szDocumentionFile );
        //var_dump( vaesoli::FIL_MTime( $this->self['file'],'d-m-Y H:i:s' ) );
        //var_dump( vaesoli::FIL_MTime( $szDocumentionFile ,'d-m-Y H:i:s' ) );

        return ( vaesoli::FIL_MTime( $szDocumentionFile ) < vaesoli::FIL_MTime( $this->self['file'] ) );
    }   /* End of Mother.isDocumentationOutdated() ==================================== */
    /* ================================================================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*document( $szFile )=

        Document a single file (documented the way Vae Soli! is)

        {*params
            $szFile     (string)        File to document. Optional.
        *}

        {*return
            (self)      The current instance of the class
        *}

        *}}
    */
    /* ================================================================================ */
    public function document( $szFile = null )
    /*--------------------------------------*/
    {
        $szFile = $szFile ?? $this->self['file'];

        if ( ! defined( 'DOCUMENTOR_CLASS_VERSION' ) )
            require_once( 'trql.documentor.class.php' );

        $oDocumentor = new \trql\documentor\Documentor();

        /* Just to avoid that using the class yields to 
            1) an auto-backup
            1) an auto-doc
        */
        $oDocumentor->backupRequired  = false;
        $oDocumentor->autodocRequired = false;

        $oDocumentor->document( $szFile );

        return ( $this );
    }   /* End of Mother.document() =================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*autodoc()=

        The class documents itself thanks to [c]trql.documentor.class.php[/c]

        {*params
        *}

        {*return
            (self)      Returns self
        *}

        *}}
    */
    /* ================================================================================ */
    protected function autodoc( $szFile = null )
    /*----------------------------------------*/
    {
        static $iCalls = 0;
        static $aAlreadySeen = null;

        $szFile = $szFile ?? $this->self['file'];

        //var_dump( "On me demande de documenter " . $szFile );
        //var_dump( ++$iCalls,$aAlreadySeen );

        if ( ! is_null( $szFile ) )
        {
            if ( $this->autodocRequired && ! isset( $aAlreadySeen[$szFile] ) && ( $iCalls < 10 ) )
            {
                //var_dump( __METHOD__ );
                if ( $this->isDocumentationOutdated() )
                {
                    //var_dump( __METHOD__ . "(): DOCUMENTATION is OUTDATED" );
                    $aAlreadySeen[$szFile] = true;
                    ++$iCalls;

                    //var_dump( "=================================","Can document #{$iCalls}: " . $szFile );

                    if ( $this->isRightTimeForHouseKeeping() )
                    {
                        $this->document( $szFile );
                    }   /* if ( $this->isRightTimeForHouseKeeping() ) */
                    else
                    {
                        $this->addInfo( __METHOD__ . "(): autodoc NOT started because of date" );
                        //var_dump( __METHOD__ . "(): autodoc NOT started because of date" );
                    }
                }   /* if ( $this->isDocumentationOutdated() ) */
                else    /* Else of ... if ( $this->IsDocumentationOutdated() ) */
                {
                    $this->addInfo( $szMsg = __METHOD__ . "(): documentation of {$szFile} is up-to-date" );
                    //var_dump( $szMsg );
                }    /* End of ... Else of ... if ( $this->IsDocumentationOutdated() ) */
            }   /* if ( $this->autodocRequired && ... ) */
            else    /* Else of ... if ( $this->autodocRequired && ... */
            {
                $this->addInfo( __METHOD__ . "(): autodoc NOT required" );
            }    /* End of ... Else of ... if ( $this->autodocRequired && ... */
        }   /* if ( $this->autodocRequired && ... ) */
        else    /* Else of ... if ( ! is_null( $szFile ) ) */
        {
            $this->addInfo( __METHOD__ . "(): autodoc on NULL file" );
        }    /* End of ... Else of ... if ( ! is_null( $szFile ) ) */

        return ( $this );
    }   /* End of Mother.autodoc() ==================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*UIKey()=

        The method publishes itself in the UIKey repository

        {*params
        *}

        {*return
            (self)      Returns self
        *}

        *}}
    */
    /* ================================================================================ */
    protected function UIKey()
    /*----------------------*/
    {
        $this->addInfo( __METHOD__ . "(): NOT active!" );

        return ( $this );
    }   /* End of Mother.UIKey() ====================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*necroSignaling()=

        Necrosignaling of a class.

        {*params
        *}

        {*return
            (self)      Returns self
        *}

        {*remark

            Nothing done so far.

        *}

        {*doc

            General introductions to necrosignaling:

            [url]https://www.researchgate.net/publication/339576789_Necrosignaling_Cell_death_triggers_antibiotic_survival_pathways_in_bacterial_swarms[/url]
            [url]https://trustmyscience.com/bacteries-emettent-cris-mort-pour-mieux-combattre-antibiotiques/[/url]

        *}

        *}}
    */
    /* ================================================================================ */
    protected function necroSignaling()
    /*-------------------------------*/
    {
        return ( $this );
    }   /* End of Mother.necroSignaling() ============================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*WikiData()=

        Searches WikiData repository for the name of the class (e.g. Invoice, Offer, Hotel,
        Customer, Supplier, ...)

        {*params
        *}

        {*return
            (self)      Returns self
        *}

        *}}
    */
    /* ================================================================================ */
    protected function WikiData()
    /*-------------------------*/
    {

        return ( $this );
    }   /* End of Mother.WikiData() =================================================== */
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
        if ( ! is_null( $this->memory ) )
        {
            echo __LINE__," ... memory NOT null ... need to save it somewhere!\n";
        }

        $this->backup();
        $this->autodoc();
        $this->UIKey();
        $this->WikiData();
        $this->necroSignaling();
    }   /* End of Mother.__destruct() ================================================= */
    /* ================================================================================ */

}   /* End of class Mother ============================================================ */
/* ==================================================================================== */
?>