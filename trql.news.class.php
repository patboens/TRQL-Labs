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
    {*file                  trql.news.class.php *}
    {*purpose               (Good) News services (based on outputs generated by the RSS 
                            class) *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 30-07-20 13:11 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 30-07-20 13:11 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 23-01-21 11:27 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  First adaptations based on Form, NewsArticle, and NewsML
                                ([doc]https://www.afp.com/communication/iris/Guide_to_AFP_NewsML-G2.html[/doc])
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\news;

//use \trql\quitus\Mother           as Mother;
use \trql\quitus\iContext           as iContext;
use \trql\vaesoli\Vaesoli           as Vaesoli;
use \trql\rss\RSS                   as RSS;
use \trql\rss\RSSItem               as RSSItem;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'RSS_CLASS_VERSION' ) )
    require_once( 'trql.rss.class.php' );

defined( 'NEWS_CLASS_VERSION' ) or define( 'NEWS_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class News=

    {*desc

        (Good) News services (based on outputs generated by the RSS class)

    *}

    {*doc

    *}

    *}}
 */
/* ==================================================================================== */
class News extends RSS implements iContext
/*--------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId     (string)                                        Wikidata ID. NOT CHECKED SO FAR *} */

    /* ================================================================================ */
    /** {{*__construct( [$szHome] )=

        Class constructor

        {*params
            $szHome     (string)        Home of the class. Optional.
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*keywords constructors, destructors *}

        {*seealso @fnc.__destruct *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szHome = null )
    /*-----------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        return ( $this );
    }   /* End of News.__construct() ================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*cacheNameEx( $szMethod,$szURL,$xParams[,$xAdditional] )=

        Forms the name of a deterministic name of a file cache (built from parameters)

        {*params
            $szMethod       (string)        The name of the method for which we need
                                            to have a cache file.
            $szURL          (string)        The URL to take into consideratyion for the
                                            cache file.
            $xParams        (mixed)         The main configuration parameters  to take 
                                            into account.
            $xAdditional    (mixed)         Addktional parameters if any. Optional.
                                            [c]null[/c] by default.
        *}

        {*return
            (string)        The name of a cache file
        *}

        *}}
    */
    /* ================================================================================ */
    protected function cacheNameEx( $szMethod,$szURL,$xParams,$xAdditional = null )
    /*---------------------------------------------------------------------------*/
    {
        $szMethod = str_replace( array( '\\',':','::','..' ),
                                 array( '.' ,'.','.' ,'.'  ),
                                 $szMethod );

        if ( is_null( $xAdditional ) )
            $szCacheFile = vaesoli::FIL_RealPath( $this->szHome . '/' . $szMethod . '.' . md5( serialize( $szURL ) ) . '.' . md5( serialize( $xParams ) ) . '.cache' );
        else
            $szCacheFile = vaesoli::FIL_RealPath( $this->szHome . '/' . $szMethod . '.' . md5( serialize( $szURL ) ) . '.' . md5( serialize( $xParams ) . serialize( $xAdditional ) ) . '.cache' );

        return ( $szCacheFile );
    }   /* End of News.cacheNameEx() ================================================== */
    /* ================================================================================ */


    public function parseEx( $oJSON,$szService,$szAPISource,$szURL,$aParams )
    /*---------------------------------------------------------------------*/
    {
        $aRetVal = null;

        //var_dump( $szAPISource );
        //var_dump( $oJSON );
        //die();

        if ( isset( $oJSON->errors ) )
        {
            //$this->__Echo( "errors found in JSON\n" );
            $this->addInfo( __METHOD__ . "(): errors found in JSON" );
            goto end;
        }

        $iResultsCount  = $oJSON->totalResults  ?? $oJSON->articleCount;
        $iTimestamp     = $oJSON->timestamp     ?? time();
        $szStatus       = $oJSON->status        ?? 'ok';


        if ( $szService === 'terms' )
            $aCategories = $aParams['terms'];
        elseif ( $szService === 'topics' )
            $aCategories = $aParams['terms'] + $aParams['topics'];
        else
            $aCategories = null;

        if ( is_array( $aCategories ) && count( $aCategories ) < 1 )
            $aCategories = null;

        // Il faudra encore tester intensivement avec $aParams['topics']

        //var_dump( $aCategories );
        //die();


        /*
            {
                NEWSAPI
                =======

                ["status"]=>
                  string(2) "ok"
                ["totalResults"]=>
                  int(1771)
                ["articles"]=>
                    array(20) {
                      [0]=>
                      object(stdClass)#5 (8) {
                        ["source"]=>
                        object(stdClass)#4 (2) {
                          ["id"]=>
                          string(12) "ars-technica"
                          ["name"]=>
                          string(12) "Ars Technica"
                        }
                        ["author"]=>
                        string(9) "Ars Staff"
                        ["title"]=>
                        string(60) "The real science behind SETIΓÇÖs hunt for intelligent aliens"
                        ["description"]=>
                        string(62) "Inside the current hunt for "technosignatures" in radio waves."
                        ["url"]=>
                        string(98) "https://arstechnica.com/science/2020/07/the-real-science-behind-setis-hunt-for-intelligent-aliens/"
                        ["urlToImage"]=>
                        string(79) "https://cdn.arstechnica.net/wp-content/uploads/2020/07/seti-feature-760x380.jpg"
                        ["publishedAt"]=>
                        string(20) "2020-07-25T13:00:10Z"
                        ["content"]=>
                        string(216) "1 with 1 posters participating
                  In 1993, a team of scientists published a paper in the scientific journal Nature that announced the detection of a planet harboring life. Using instruments on the spacΓÇª [+9590 chars]"
                    }
            }

            GNEWS.IO
            ========

            ["timestamp"]=>
                int(1596008667)
            ["articleCount"]=>
                int(10)
            ["articles"]=>
                array(10) {
                  [0]=>
                  object(stdClass)#4 (6) {
                    ["title"]=>
                    string(70) "Max Planck researchers feed Proteome AI with PharmaFluidics technology"
                    ["description"]=>
                    string(213) "The study was published as ΓÇ£The Proteome Landscape of the Kingdoms of LifeΓÇ¥ in the June edition of NATURE, a leading, high impact science journal. ΓÇ£The microstructured and extremely reproducible ┬╡PACΓäó ..."
                    ["url"]=>
                    string(121) "https://www.pharmiweb.com/press-release/2020-06-19/max-planck-researchers-feed-proteome-ai-with-pharmafluidics-technology"
                    ["image"]=>
                    NULL
                    ["publishedAt"]=>
                    string(23) "2020-06-19 07:02:00 UTC"
                    ["source"]=>
                    object(stdClass)#5 (2) {
                      ["name"]=>
                      string(9) "PharmiWeb"
                      ["url"]=>
                      string(25) "https://www.pharmiweb.com"
                    }
                  }

        */

        foreach( $oJSON->articles as $oArticle )
        {
            $oItem                  = new RSSItem();                /* Create a RSS item */

            $oItem->name            =               $oArticle->title;
            $oItem->identifier      =               $oArticle->source->id ?? strtolower( str_replace( array('{','}'),'',$this->guid() ) );
            $oItem->datePublication = strtotime(    $oArticle->publishedAt );
            $oItem->summary         =               $oArticle->description;
            $oItem->description     =               $oArticle->content ?? $oArticle->description;
            $oItem->source          =               $oArticle->source->name;
            $oItem->url             =               $oArticle->url ?? $oArticle->source->url;
            $oItem->image           =               $oArticle->urlToImage ?? ( $oArticle->image ?? null );
            $oItem->aCategories     =               $aCategories;

            if ( ! empty( $szAuthor = $oArticle->author ?? null ) )
            {
                $aNameParts                 = $oItem->chopAuthor( $szAuthor );

                $oItem->author->givenName    = $aNameParts['firstname'];
                $oItem->author->familyName   = $aNameParts['lastname'];
                $oItem->author->name         = $aNameParts['fullname'];
            }   /* if ( ! empty( $szAuthor = $oArticle->author ?? null ) ) */

            $aRetVal['results'][] = array( 'title'      => $oItem->name                                 ,
                                           'id'         => $oItem->identifier                           ,
                                           'pubDate'    => $oItem->datePublication                      ,
                                           'date'       => date( 'd-m-Y H:i:s',$oItem->datePublication ),
                                           'summary'    => $oItem->summary                              ,
                                           'body'       => $oItem->description                          ,
                                           'source'     => $oItem->source                               ,
                                           'url'        => $oItem->url                                  ,
                                           'image'      => $oItem->image                                ,
                                           'categories' => $oItem->aCategories                          ,
                                           'author'     => $szAuthor                                    ,
                                           'cargo'      => $oItem                                       ,
                                         );
            //var_dump( $oItem );
            //$this->die( "DEAD AFTER JSON + RSSItem" );
        }   /* foreach( $oJSON->articles as $oArticle ) */

        end:
        return ( $aRetVal );
    }   /* End of News.parseEx() ====================================================== */
    /* ================================================================================ */


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

        $szFile = vaesoli::FIL_RealPath( $this->szHome . $szCave );

        //var_dump( $szCave,$szFile );

        if ( is_file( $szFile ) )
            return ( vaesoli::FIL_FileToStr( $szFile ) );
        else
            return ( null );
    }   /* End of News.getAPIKey() ==================================================== */
    /* ================================================================================ */


    public function get( $szService,$szAPISource,$szURL,$aParams )
    /*----------------------------------------------------------*/
    {
        $aRetVal        = null;
        $szCacheFile    = $this->cacheNameEx( $szService,$szURL,$aParams );
        $szService      = strtolower( trim( $szService ) );

        switch ( $szService )
        {
            case    'terms' :
                {
                    $iTTL = max( 3600,(int) $this->ttl );
                }
                break;
            default     :
                {
                    $iTTL = max( 7200,(int) $this->ttl );
                }
                break;
        }   /* switch( strtolower( trim( $szService ) ) ) */

        // Je dois aussi voir si je ne peux pas avoir getNewsInStock avec la classe RSS !!! */
        if ( true && $this->remembering && $this->fileExistsAndNoOlderThan( $szCacheFile,$iTTL ) )
        {
            //var_dump( "NEWS SERVED FROM CACHE" );
            //$this->die( "DATA FROM CACHE" );
            $aRetVal = $this->getHashFile( $szCacheFile );
            $this->addInfo( __METHOD__ . "(): News obtained from {$szCacheFile}" );
            goto end;
        }   /* if ( true && $this->remembering && $this->fileExistsAndNoOlderThan( $szCacheFile,$iTTL ) ) */
        else    /* Else of ... if ( true && $this->remembering && $this->fileExistsAndNoOlderThan( $szCacheFile,$iTTL ) ) */
        {
            if ( empty( $szJSON = $this->GetURL( $szURL ) ) )
                $szJSON = @file_get_contents( $szURL );

            if ( ! empty( $szJSON  ) )
            {
                $aRetVal = $this->parseEx( $oJSON = json_decode( $szJSON ),$szService,$szAPISource,$szURL,$aParams );

                if ( is_array( $aRetVal ) && $this->storing )
                {
                    //var_dump( "SAVING DATA IN CACHE" );
                    //var_dump( $aRetVal );
                    //$this->die( "BEFORE SAVING" );
                    // IL FAUT ENCORE SAUVER LE TOUT DANS LES CATEGORIES POUR getNewsInSTock()
                    // Ici, cela se fait au niveau de l'item et donc ... on peut avoir 
                    // des catégories différentes sur chaque item. Cela impliquerait qu'il faille
                    // faire le nécessaire au niveau du parsing !
                    //foreach( $oItem->aCategories as $szCategory )
                    //{
                    //    $szCategory = strtolower( trim( $szCategory ) );
                    //    $aAllCategories[$szCategory] = $this->categoryShelter( $szCategory,$szURL );
                    //}   /* foreach( $oItem->aCategories as $szCategory ) */
                    //
                    //$this->saveCategories( $aAllCategories,$aRetVal );      /* Saves the results so that we can serve them with getNewsInStock() */

                    $this->saveHashFile( $szCacheFile,$aRetVal );
                    $this->addInfo( __METHOD__ . "(): News cached in {$szCacheFile}" );
                }   /* if ( $this->storing ) */
            }   /* if ! empty($szJSON  ) ) */
            else
            {
                $this->__Echo( __METHOD__ . "(): EMPTY JSON returned" );
                $this->addInfo( __METHOD__ . "(): EMPTY JSON returned" );
                //var_dump( $aRetVal );
                //die();
                goto end;
            }
        }   /* End of ... Else of ... if ( true && $this->remembering && $this->fileExistsAndNoOlderThan( $szCacheFile,$iTTL ) ) */

        end:

        return ( $aRetVal );
    }   /* End of News.get() ========================================================== */
    /* ================================================================================ */


    public function search( $xParams )
    /*------------------------------*/
    {
        $aRetVal = null;

        if     ( is_string( $xParams ) )
        {
            if ( is_array( $aTmp = explode( ',',str_replace( ';',',',$xParams ) ) ) )
            {
                $aTerms = null;

                foreach( $aTmp as $szTerm )
                {
                    $aTerms[] = strtolower( trim( $szTerm ) );
                }   /* foreach( $aTmp as $szTerm ) */
            }   /* if ( is_array( $aTmp = explode( ',',str_replace( ';',',',$xParams ) ) ) ) */

            $aParams = array( 'terms' => $aTerms );
        }
        elseif ( is_array( $xParams ) )
        {
            $aParams = $xParams;
        }

        //var_dump( $aParams );

        if ( ! isset( $aParams['topics'] ) )
        {
            $szTerms = urlencode( implode( ' ',$aParams['terms'] ) );

            $szGNEWSKey     = $this->getAPIKey( 'GNEWS'  );
            $szNEWSAPIKey   = $this->getAPIKey( 'NEWSAP' );

            // Les clefs DOIVENT être cachées
            $aGNEWS     = $this->get( 'terms','gnews.io'      ,"https://gnews.io/api/v3/search?q={$szTerms}&token={$szGNEWSKey}"        ,$aParams );
            $aNEWSAPI   = $this->get( 'terms','newsapi.org'   ,"https://newsapi.org/v2/everything?q={$szTerms}&apiKey={$szNEWSAPIKey}"  ,$aParams );

            if ( is_array( $aGNEWS ) && is_array( $aNEWSAPI ) )
                $aRetVal    = array_merge( $aGNEWS,$aNEWSAPI );
            else
            {
                $aRetVal    = array();

                if ( is_array( $aGNEWS ) )
                    $aRetVal    = array_merge( $aRetVal,$aGNEWS );
                    
                if ( is_array( $aNEWSAPI ) )
                    $aRetVal    = array_merge( $aRetVal,$aNEWSAPI );
            }

            if ( is_array( $aRetVal ) && count( $aRetVal ) < 1 )
                $aRetVal = null;

            //var_dump( $aRetVal );

            if ( is_array( $aRetVal['results'] ) && count( $aRetVal['results'] ) > 0 )
            {
                usort( $aRetVal['results'],function( $a,$b )
                                {
                                    if     ( $a['pubDate'] === $b['pubDate'] )
                                        return 0;
                                    elseif ( $a['pubDate'] > $b['pubDate'] )
                                        return -1;
                                    else
                                        return 1;
                                }
                     );
            }
        }   /* if ( ! isset( $aParams['topics'] ) ) */
        else
        {
            // Alors ... c'est les topics  ET les termes s'il y en a */
        }

        // https://gnews.io/api/v3/search?q=example&token=ffa4303e361bd2fb77bbce1b415188d4
        // https://newsapi.org/v2/everything?q=bitcoin&apiKey=d7e2f1e3d68c432fbc03496f2cd41a4b

        // https://gnews.io/api/v3/top-news?token=ffa4303e361bd2fb77bbce1b415188d4
        // https://newsapi.org/v2/top-headlines?country=us&apiKey=d7e2f1e3d68c432fbc03496f2cd41a4b

        // https://gnews.io/api/v3/topics/world?token=ffa4303e361bd2fb77bbce1b415188d4
        // Pas d'équivalent newsapi

        return ( $aRetVal );
    }   /* End of News.search() ======================================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return
        *}

        {*keywords constructors, destructors *}

        {*seealso @fnc.__construct *}

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
    }   /* End of News.__destruct() =================================================== */
    /* ================================================================================ */
}   /* End of class News ============================================================== */
/* ==================================================================================== */
