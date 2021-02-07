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
    {*file                  trql.wikipedia.class.php *}
    {*purpose               Wikipedia Search services *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 29-07-20 11:44 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 29-07-20 11:44 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 23-08-20 00:08 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Addition Documentor comments
                            2)  Turned to UTF-8
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\wikipedia;

use \trql\mother\Mother                             as Mother;
use \trql\mother\iContext                           as iContext;
use \trql\vaesoli\Vaesoli                           as Vaesoli;
use \trql\utility\Utility                           as Utility;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'UTILITY_CLASS_VERSION' ) )
    require_once( 'trql.utility.class.php' );

defined( 'WIKIPEDIA_CLASS_VERSION' ) or define( 'WIKIPEDIA_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Wikipedia=

    {*desc

        Access to wikipedia

    *}

    {*doc

        [url]https://www.mediawiki.org/wiki/API:Opensearch[/url]
        [url]https://en.wikipedia.org/w/api.php[/url]

    *}

    *}}
 */
/* ==================================================================================== */
class Wikipedia extends Utility implements iContext
/*-----------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q52';


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
    }   /* End of Wikipedia.__construct() ============================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*call( $aParams )=

        Calls Wikipedia via its dedicated URL

        {*params
            $aParams    (array)     Associative array to pass parameters in the URL that
                                    must be called ("opensearch" is the main verb)
        *}

        {*return
            (string)        Result returned by the call to [c]getURL(...)[/c]
        *}

        *}}
    */
    /* ================================================================================ */
    public function call( $aParams )
    /*----------------------------*/
    {
        $szParams = '';

        foreach ( $aParams as $szKey => $xValue )
        {
            $szParams .= "&{$szKey}={$xValue}";
        }

        $szURL = "https://en.wikipedia.org/w/api.php?action=opensearch{$szParams}";

        return ( $this->getURL( $szURL ) );
    }   /* End of Wikipedia.call() ==================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__parse1( $szXML )=

        Parses the first set of results from Wikipedia (a list of URLs that correspond
        to the term that is looked for

        {*params
            $szXML      (string)        The XML to parse
        *}

        {*return
            (array)     An array of results
        *}

        {*abstract

            Retrieving information from Wikipedia is performed in 2 steps :

                1) Get potential results (list of potential URLs - max 500)
                2) Get access to the real content ([c]parse2()[/c])
        *}

        *}}
    */
    /* ================================================================================ */
    public function parse1( &$szXML )
    /*----------------------------*/
    {
        $aRetVal = null;

        static $oDom = null;

        if ( is_null( $oDom ) )
            $oDom = new DOMDocument();

        if ( ! empty( $szXML ) && $oDom->LoadXML( $szXML ) )
        {
            if ( $oXPath = new DOMXPath( $oDom ) )
            {
                $oXPath->registerNamespace( 'ss','http://opensearch.org/searchsuggest2' );

                if ( ( $oColl = $oXPath->query( "//ss:Item" ) ) && $oColl->length > 0 )
                {
                    //$this->__die( "ITEMS FOUND" );
                    $aRetVal['resultsCount'] = $oColl->length;
                    $aResults               = array();

                    foreach( $oColl as $oNode )
                    {
                        $szTerm     =
                        $szURL      =
                        $szImage    = null;

                        if ( ( $o = $oXPath->query( "ss:Text",$oNode ) ) && $o->length > 0 )
                            $szTerm = $o->item(0)->nodeValue;

                        if ( ( $o = $oXPath->query( "ss:Url",$oNode ) ) && $o->length > 0 )
                            $szURL = $o->item(0)->nodeValue;

                        if ( ( $o = $oXPath->query( "ss:Image",$oNode ) ) && $o->length > 0 )
                            $szImage = $o->item(0)->getAttribute('source');

                        $aResults[] = array( 'term'     => $szTerm  ,
                                             'url'      => $szURL   ,
                                             'image'    => $szImage ,
                                           );
                    }   /* foreach( $o as $oNode ) */

                    $aRetVal['results'] = $aResults;
                }   /* if ( ( $o = $oXPath->query( "//item" ) ) && $o->length > 0 ) */
                else
                {
                    //var_dump( $szXML );
                }

                //var_dump( $aRetVal );
                //$this->__die( "STOP FOR NOW" );

            }   /* if ( $oXPath = new DOMXPath( $oDom ) ) */
        }   /* if ( $oDom->LoadXML( $szXML ) ) */

        end:

        return ( $aRetVal );
    }   /* End of Wikipedia.parse1() ================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__parse2( $szXML )=

        Parses the second set of results from Wikipedia (the real content of a page)

        {*params
            $szXML      (string)        The XML to parse
        *}

        {*return
            (array)     An array of results
        *}

        {*abstract

            Retrieving information from Wikipedia is performed in 2 steps :

                1) Get potential results (list of potential URLs - max 500) ([c]parse1()[/c])
                2) Get access to the real content ([c]parse2()[/c])
        *}

        *}}
    */
    /* ================================================================================ */
    public function parse2( &$szXML )
    /*-----------------------------*/
    {
        $aRetVal = null;

        static $oDom = null;

        if ( is_null( $oDom ) )
            $oDom = new DOMDocument();

        if ( ! empty( $szXML ) && $oDom->LoadXML( $szXML ) )
        {
            if ( $oXPath = new DOMXPath( $oDom ) )
            {
                $szText      =
                $aCats       =
                $aLinks      =
                $aELinks     =
                $aIWLinks    =
                $aTemplates  =
                $aImages     =
                $aSections   =
                $aProperties =
                $aLang       = null;

                if ( ( $o = $oXPath->query( "//text" ) ) && $o->length > 0 )
                    $szText = $o->item(0)->nodeValue;

                if ( ( $o = $oXPath->query( "//ll" ) ) && $o->length > 0 )
                {
                    foreach ( $o as $oNode )
                    {
                        $aLang[]        = array( 'lang'         => $oNode->getAttribute('lang' )        ,
                                                 'url'          => $oNode->getAttribute('url'  )        ,
                                                 'title'        => $oNode->nodeValue                    ,
                                               );
                    }   /* foreach ( $o as $oNode ) */
                }   /* if ( ( $o = $oXPath->query( "//ll" ) ) && $o->length > 0 ) */

                if ( ( $o = $oXPath->query( "//cl" ) ) && $o->length > 0 )
                {
                    foreach ( $o as $oNode )
                    {
                        $aCats[]        = array( 'sortkey'      => $oNode->getAttribute('sortkey'   ),
                                                 'hidden'       => $oNode->getAttribute('hidden'    ),
                                                 'title'        => $oNode->nodeValue                 ,
                                               );
                    }   /* foreach ( $o as $oNode ) */
                }   /* if ( ( $o = $oXPath->query( "//cl" ) ) && $o->length > 0 ) */

                if ( ( $o = $oXPath->query( "//pl" ) ) && $o->length > 0 )
                {
                    foreach ( $o as $oNode )
                    {
                        $aLinks[]       = array( 'ns'           => $oNode->getAttribute('ns'    )       ,
                                                 'exists'       => $oNode->getAttribute('exists')       ,
                                                 'title'        => $oNode->nodeValue                    ,
                                               );
                    }   /* foreach ( $o as $oNode ) */
                }   /* if ( ( $o = $oXPath->query( "//pl" ) ) && $o->length > 0 ) */

                if ( ( $o = $oXPath->query( "//tl" ) ) && $o->length > 0 )
                {
                    foreach ( $o as $oNode )
                    {
                        $aTemplates[]   = array( 'ns'           => $oNode->getAttribute('ns'    )       ,
                                                 'exists'       => $oNode->getAttribute('exists')       ,
                                                 'title'        => $oNode->nodeValue                    ,
                                               );
                    }   /* foreach ( $o as $oNode ) */
                }   /* if ( ( $o = $oXPath->query( "//tl" ) ) && $o->length > 0 ) */

                if ( ( $o = $oXPath->query( "//img" ) ) && $o->length > 0 )
                {
                    foreach ( $o as $oNode )
                    {
                        $aImages[]      = array( 'file'         => $oNode->nodeValue                    ,
                                               );
                    }   /* foreach ( $o as $oNode ) */
                }   /* if ( ( $o = $oXPath->query( "//img" ) ) && $o->length > 0 ) */

                if ( ( $o = $oXPath->query( "//el" ) ) && $o->length > 0 )
                {
                    foreach ( $o as $oNode )
                    {
                        $aELinks[]      = array( 'url'          => $oNode->nodeValue                    ,
                                               );
                    }   /* foreach ( $o as $oNode ) */
                }   /* if ( ( $o = $oXPath->query( "//el" ) ) && $o->length > 0 ) */

                if ( ( $o = $oXPath->query( "//s" ) ) && $o->length > 0 )
                {
                    foreach ( $o as $oNode )
                    {
                        $aSections[]    = array( 'toclevel'     => $oNode->getAttribute('toclevel'  )   ,
                                                 'level'        => $oNode->getAttribute('level'     )   ,
                                                 'line'         => $oNode->getAttribute('line'      )   ,
                                                 'number'       => $oNode->getAttribute('number'    )   ,
                                                 'index'        => $oNode->getAttribute('index'     )   ,
                                                 'title'        => $oNode->getAttribute('fromtitle' )   ,
                                                 'offset'       => $oNode->getAttribute('byteoffset')   ,
                                                 'anchor'       => $oNode->getAttribute('anchor'    )   ,
                                               );
                    }   /* foreach ( $o as $oNode ) */
                }   /* if ( ( $o = $oXPath->query( "//s" ) ) && $o->length > 0 ) */

                if ( ( $o = $oXPath->query( "//iw" ) ) && $o->length > 0 )
                {
                    foreach ( $o as $oNode )
                    {
                        $aIWLinks[]     = array( 'prefix'       => $oNode->getAttribute('prefix'    )   ,
                                                 'url'          => $oNode->getAttribute('url'       )   ,
                                                 'title'        => $oNode->nodeValue                    ,
                                               );
                    }   /* foreach ( $o as $oNode ) */
                }   /* if ( ( $o = $oXPath->query( "//iw" ) ) && $o->length > 0 ) */

                if ( ( $o = $oXPath->query( "//pp" ) ) && $o->length > 0 )
                {
                    foreach ( $o as $oNode )
                    {
                        $aProperties[]  = array( 'name'         => $oNode->getAttribute('name'    )     ,
                                                 'title'        => $oNode->nodeValue                    ,
                                               );
                    }   /* foreach ( $o as $oNode ) */
                }   /* if ( ( $o = $oXPath->query( "//pp" ) ) && $o->length > 0 ) */

                $aRetVal['results'] = array( 'text'             => $szText      ,
                                             'langlinks'        => $aLang       ,
                                             'categories'       => $aCats       ,
                                             'links'            => $aLinks      ,
                                             'templates'        => $aTemplates  ,
                                             'images'           => $aImages     ,
                                             'externallinks'    => $aELinks     ,
                                             'sections'         => $aSections   ,
                                             'iwlinks'          => $aIWLinks    ,
                                             'properties'       => $aProperties ,
                                           );
                //var_dump( $aIWLinks );
                //var_dump( $aProperties );
                //var_dump( strlen( $szText ) );
                //$this->__die( "STOP FOR NOW" );
            }   /* if ( $oXPath = new DOMXPath( $oDom ) ) */
        }   /* if ( $oDom->LoadXML( $szXML ) ) */

        end:

        return ( $aRetVal );
    }   /* End of Wikipedia.parse2() ================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__parse3( $szTerm,$szXML )=

        Parses the resulting XML of a call to searchEntities()

        {*params
            $szTerm     (string)        The term that we looked for
            $szXML      (string)        The XML to parse
        *}

        {*return
            (array)     An array of results
        *}

        *}}
    */
    /* ================================================================================ */
    public function parse3( &$szTerm,&$szXML )
    /*--------------------------------------*/
    {
        $aRetVal = null;

        static $oDom = null;

        if ( is_null( $oDom ) )
            $oDom = new DOMDocument();

        if ( ! empty( $szXML ) && $oDom->LoadXML( $szXML ) )
        {
            if ( $oXPath = new DOMXPath( $oDom ) )
            {
                /* Get root node */
                if ( ( $o = $oXPath->query( "/*" ) ) && $o->length > 0 )
                {
                    if ( $o->item(0)->getAttribute( 'success' ) === '1' )
                    {
                        if ( ( $o = $oXPath->query( "//entity" ) ) && $o->length > 0 )
                        {
                            //$o              = $o->item(0);
                            //var_dump( $o );
                            foreach( $o as $oNode )
                            {
                                $aRetVal['results'][] = array( 'term'         => $szTerm                          ,
                                                               'id'           => $oNode->getAttribute( 'id'          ),
                                                               'conceptURI'   => $oNode->getAttribute( 'concepturi'  ),
                                                               'label'        => $oNode->getAttribute( 'label'       ),
                                                               'description'  => $oNode->getAttribute( 'description' ),
                                                       );
                            }   /* foreach( $o as $oNode ) */
                        }   /* if ( ( $o = $oXPath->query( "//entity" ) ) && $o->length > 0 ) */
                    }   /* if ( $o->item(0)->getAttribute( 'success' ) === '1' ) */
                }   /* if ( ( $o = $oXPath->query( "/*" ) ) && $o->length > 0 ) */
            }   /* if ( $oXPath = new DOMXPath( $oDom ) ) */
        }   /* if ( ! empty( $szXML ) && $oDom->LoadXML( $szXML ) ) */

        end:

        return ( $aRetVal );
    }   /* End of Wikipedia.parse3() ================================================== */
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
    }   /* End of Wikipedia.cacheName() =============================================== */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of Wikipedia.speak() =================================================== */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of Wikipedia.sing() ==================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*search( $szTerm[,$iLimit] )=

        Performs an open search on [c]$szTerm[/c]

        {*params
            $szTerm         (string)        The terms to look for
            $iLimit         (int)           Number of results. Optional.
                                            [c]All[/c] by default.
        *}

        {*return
            (array)     An array of results
        *}

        {*warning

            Will onky work on the basis of English terms

        *}

        // Call to https://en.wikipedia.org/w/api.php?action=opensearch&...

        *}}
    */
    /* ================================================================================ */
    public function search( $szTerm,$iLimit = null )
    /*--------------------------------------------*/
    {
        $aRetVal                = null;

        $szTerm                 = str_replace( ' ','_',$szTerm );

        $aParams['search']      = $szTerm;                          /* Term to look for */
        $aParams['limit']       = $iLimit ?? 500;                   /* Default number of results returned */
        $aParams['namespace']   = 0;                                /* Namespace as in https://www.mediawiki.org/wiki/API:Opensearch */
        $aParams['format']      = 'xml';                            /* XML format please */

        $szCacheFile = $this->cacheName( __METHOD__,$aParams );

        if ( true && $this->remembering && is_file( $szCacheFile ) )
        {
            //$this->__die( "ON A LE CACHE" );
            $aRetVal = $this->getHashFile( $szCacheFile );
            $this->addInfo( __METHOD__ . "(): data obtained from {$szCacheFile}" );
            goto end;
        }   /* if ( is_file( $szCacheFile ) ) */
        else    /* Else of ... if ( is_file( $szCacheFile ) ) */
        {
            /*
            // Example:
            // =======

            // https://en.wikipedia.org/w/api.php?action=opensearch&search=Gerardus_Mercator&limit=1&namespace=0&format=xml

            // Ceci devrait me renvoyer le XML suivant:
            //
            // <?xml version="1.0"?>
            // <SearchSuggestion version="2.0" xmlns="http://opensearch.org/searchsuggest2">
            //    <Query xml:space="preserve">Gerardus_Mercator</Query>
            //      <Section>
            //         <Item>
            //             <Text xml:space="preserve">Gerardus Mercator</Text>
            //             <Url xml:space="preserve">https://en.wikipedia.org/wiki/Gerardus_Mercator</Url>
            //             <Image source="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f7/Mercator.jpg/36px-Mercator.jpg" width="36" height="50" />
            //         </Item>
            //     </Section>
            // </SearchSuggestion>
            //
            // Puis, on demande le parsing de la page avec:
            // https://en.wikipedia.org/w/api.php?action=parse&page=Gerardus_Mercator&format=xml
            */

            if ( ! empty( $szXML = $this->call( $aParams ) ) )
            {
                if ( is_array( $aTmp = $this->parse1( $szXML ) ) )
                {
                    //var_dump( $szXML );
                    //var_dump( $aTmp );
                    //$this->__die("AFTER parse1()");
                    if ( isset( $aTmp['results'] ) && is_array( $aTmp['results'] ) )
                    {
                        $aURLParts = parse_url( $szMainURL = $aTmp['results'][0]['url'] );
                        //var_dump( $aURLParts );
                        // La page est le dernier mot du path dans l'URL
                        $szPage = basename( $aURLParts['path'] );
                        //var_dump( $szPage );
                        $szURL = "https://en.wikipedia.org/w/api.php?action=parse&page={$szPage}&format=xml";

                        if ( ! empty( $szXML = $this->getURL( $szURL ) ) )
                        {
                            if ( is_array( $aTmp = $this->parse2( $szXML ) ) )
                                $aRetVal = array_merge( array( 'service'    => 'wikipedia'  ,
                                                               'term'       => $szTerm      ,
                                                               'page'       => $szMainURL   ,
                                                               'lupdate'    => time()       ,
                                                             ),$aTmp );
                            else
                                goto end;
                        }   /* if ( $szXML = $this->getURL( $szURL ) ) */
                        else
                        {
                            goto end;
                        }
                    }   /* if ( isset( $aTmp['results'] ) && is_array( $aTmp['results'] ) ) */
                    else
                    {
                        goto end;
                    }
                }
                else
                {
                    goto end;
                }

                if ( $this->storing )
                {
                    $this->saveHashFile( $szCacheFile,$aRetVal );
                    $this->addInfo( __METHOD__ . "(): data stored in {$szCacheFile}" );
                }   /* if ( $this->storing ) */
            }   /* if ( ! empty( $szXML = $this->call( $szService = 'search',$aParams ) ) ) */

        }    /* End of ... Else of ... if ( is_file( $szCacheFile ) ) */

        end:

        return ( $aRetVal );
    }   /* End of Wikipedia.search() ================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*searchEntities( $szTerm[,$iResults] )=

        Returns the entities corresponding to [c]$szTerm[/c]

        {*params
            $szTerm         (string)        The terms to look for
            $iResults       (int)           Number of entities to return. Optional.
                                            [c]1[/c] by default. [b]No longer used![/b]
        *}

        {*return
            (array)     An array of results
        *}

        {*doc
            [url]https://www.wikidata.org/w/api.php?action=help&modules=wbgetentities[/url]
        *}

        {*abstract

            Entities are like "concepts". Stevie Nicks is known as an entity on Wikidata:
            [url]https://www.wikidata.org/wiki/Q234691[/url]. Getting all info pertaining
            to entity [c]Q234691[/c] corresponds to [c]$oWiki->getEntity( 'Q234691' )[/c] or
            [url]https://www.wikidata.org/w/api.php?action=wbgetentities&ids=Q234691&format=xml[/url][br]

            For Fleetwood Mac (Q106648):[br[
            [url]https://www.wikidata.org/w/api.php?action=wbgetentities&ids=Q106648&format=xml[/ulr][br]

            Before we know which entity ID we must use in [c]getEntity()[/c] we must get
            the entity ID : example ... what is the entity ID of "[c]Fleetwood Mac[/c]"?
            This is what [c]searchEntities(à[/c] is for! : [br]
            [c]$oWiki->searchEntities("Fleetwood Mac")[/c][br]

            There may be several entities to return. For example,
            [c]$aRetVal = $oWiki->searchEntities( 'Proximus',50 );[/c] returns 39 results.
            Which is the one that makes most sense? It's up to you to decide. For example,
            when we update the birthdate, date of death, etc. in the Wikipedia structure
            of an Artist file, we loo, for all the entities pertaining to an artist:
            [c]$aRetVal = $oWiki->searchEntities( $szArtist,50 );[/c] after which, we check
            whether each result seems to be pertaining to an artist; we use a function of
            our own that scans all the results:
            [c]if ( ! is_null( $aResult = isSinger( $aRetVal ) ) )[/c] that contains all the
            intelligence of an artist detection.
        *}

        //  Invoice (on va chercher son ID):
        //  https://www.wikidata.org/w/api.php?action=wbsearchentities&language=en&limit=1&format=xml&search=invoice
        //
        // Utiliser dans API de TRQL Radio comme dans l'exemple suivant:
        // http://www.trql.fm/api/wikidata-entity/Q193920?xml

        *}}
    */
    /* ================================================================================ */
    public function searchEntities( $szTerm,$iResults = 1 )
    /*---------------------------------------------------*/
    {
        $aRetVal = null;

        $szTerm = str_replace( " ","_",$szTerm );

        $aParams['search']      = $szTerm;                          /* Term to look for */
        $aParams['namespace']   = 0;                                /* Namespace as in https://www.mediawiki.org/wiki/API:Opensearch */
        $aParams['results']     = $iResults;                        /* Namespace as in https://www.mediawiki.org/wiki/API:Opensearch */
        $aParams['format']      = 'xml';                            /* XML format please */
        $aParams['service']     = __METHOD__;                       /* This method */

        $szCacheFile = $this->cacheName( __METHOD__,$aParams );     /* Get the name of the cache file */

        /* {*todo: Résultat valide pour 1 ou 2 mois *} */
        if ( true && $this->remembering && is_file( $szCacheFile ) )
        {
            //$this->__die( "ON A LE CACHE" );
            $aRetVal = $this->getHashFile( $szCacheFile );
            $this->addInfo( __METHOD__ . "(): data obtained from {$szCacheFile}" );
            goto end;
        }   /* if ( is_file( $szCacheFile ) ) */
        else    /* Else of ... if ( true && $this->remembering && is_file( $szCacheFile ) ) */
        {
            $szURL = "https://www.wikidata.org/w/api.php?action=wbsearchentities&language=en&limit={$iResults}&format=xml&search={$szTerm}";

            if ( ! empty( $szXML = $this->getURL( $szURL ) ) )
            {
                if ( is_array( $aRetVal = $this->parse3( $szTerm,$szXML ) ) )
                {
                    if ( $this->storing )
                    {
                        $this->saveHashFile( $szCacheFile,$aRetVal );
                        $this->addInfo( __METHOD__ . "(): data stored in {$szCacheFile}" );
                    }   /* if ( $this->storing ) */
                }   /* if ( is_array( $aRetVal = $this->parse3( $szTerm,$szXML ) ) ) */
            }   /* if ( ! empty( $szXML = $this->getURL( $szURL ) ) ) */
        }    /* End of ... Else of ... if ( true && $this->remembering && is_file( $szCacheFile ) ) */

        end:
        return ( $aRetVal );
    }   /* End of Wikipedia.searchEntities() ========================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*getEntity( $szID )=

        Parses the return of an entity (get entity based on its ID) from WikiData

        {*params
            $szID       (string)        Entity ID (e.g. "[c]Q234691[/c]")
        *}

        {*return
            (array)     An array of results
        *}

        {*doc
            [url]https://www.wikidata.org/w/api.php?action=help&modules=wbgetentities[/url]
        *}

        {*abstract

            Entities are like "concepts". Stevie Nicks is known as an entity on Wikidata:
            [url]https://www.wikidata.org/wiki/Q234691[/url]. Getting all info pertaining
            to entity [c]Q234691[/c] corresponds to [c]$oWiki->getEntity( 'Q234691' )[/c] or
            [url]https://www.wikidata.org/w/api.php?action=wbgetentities&ids=Q234691&format=xml[/url][br]

            For Fleetwood Mac (Q106648):[br[
            [url]https://www.wikidata.org/w/api.php?action=wbgetentities&ids=Q106648&format=xml[/ulr]

        *}

        *}}
    */
    /* ================================================================================ */
    public function getEntity( $szID )
    /*------------------------------*/
    {
        $aRetVal                = null;

        $aParams['search']      = $szID;                            /* Term to look for */
        $aParams['namespace']   = 0;                                /* Namespace as in https://www.mediawiki.org/wiki/API:Opensearch */
        $aParams['format']      = 'xml';                            /* XML format please */
        $aParams['service']     = __METHOD__;                       /* This method */

        $szCacheFile = $this->cacheName( __METHOD__,$aParams );

        /* {*todo: Résultat valide pour 1 ou 2 mois *} */
        if ( true && $this->remembering && is_file( $szCacheFile ) )
        {
            //$this->__die( "ON A LE CACHE" );
            $aRetVal = $this->getHashFile( $szCacheFile );
            $this->addInfo( __METHOD__ . "(): data obtained from {$szCacheFile}" );
            goto end;
        }   /* if ( is_file( $szCacheFile ) ) */
        else    /* Else of ... if ( true && $this->remembering && is_file( $szCacheFile ) ) */
        {
            /*
               {*todo résoudre les appels et vérifier qu'on ne passe pas une array ! *}

               Ceci se passe dans certains cas : c'est une erreur ... je ne devrais pas la
               corriger ici (je devrais corriger l'appel) mais comme cela ne coûte pas
               grand chose de mettre cela en place ici, ... je l'ai fait (même si c'est
               vraiment pas bien !) */
            if ( is_array( $szID ) )
            {
                if ( isset( $szID['value'] ) )
                    $szID = $szID['value'];
            }

            $szURL = "https://www.wikidata.org/w/api.php?action=wbgetentities&ids={$szID}&format=xml";

            if ( ! empty( $szXML = $this->getURL( $szURL ) ) )
            {
                if ( is_array( $aRetVal = $this->parse4( $szID,$szXML ) ) )
                {
                    if ( $this->storing )
                    {
                        $this->saveHashFile( $szCacheFile,$aRetVal );
                        $this->addInfo( __METHOD__ . "(): data stored in {$szCacheFile}" );
                    }   /* if ( $this->storing ) */
                }   /* if ( is_array( $aResult = $this->parse4( $szID,$szXML ) ) ) */
            }   /* if ( ! empty( $szXML = $this->getURL( $szURL ) ) ) */
        }    /* End of ... Else of ... if ( true && $this->remembering && is_file( $szCacheFile ) ) */

        end:
        return ( $aRetVal );
    }   /* End of Wikipedia.getEntity() =============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__parse4( $szTerm,$szXML )=

        Parses the return of an entity (get entity based on its ID) from WikiData

        {*params
            $szTerm     (string)        The term that we looked for
            $szXML      (string)        The XML to parse
        *}

        {*return
            (array)     An array of results
        *}

        *}}
    */
    /* ================================================================================ */
    public function parse4( &$szTerm,&$szXML )
    /*--------------------------------------*/
    {
        $aRetVal = null;

        static $oDom = null;

        if ( is_null( $oDom ) )
            $oDom = new DOMDocument();

        if ( ! empty( $szXML ) && $oDom->LoadXML( $szXML ) )
        {
            if ( $oXPath = new DOMXPath( $oDom ) )
            {
                /* Get root node */
                if ( ( $o = $oXPath->query( "/*" ) ) && $o->length > 0 )
                {
                    if ( $o->item(0)->getAttribute( 'success' ) === '1' )
                    {
                        //var_dump( "RESULT OK" );

                        $szLabel        =
                        $szDescription  =
                        $aAliases       =
                        $aProperties    =
                        $aIntancesOf    =
                                           null;

                        if ( ( $o = $oXPath->query( "entities/entity" ) ) && $o->length > 0 )
                        {
                            if ( ( $o2 = $oXPath->query( "labels/label[@language='en']",$o->item(0) ) ) && $o2->length > 0 )
                                $szLabel = $o2->item(0)->getAttribute( 'value' );

                            if ( ( $o2 = $oXPath->query( "descriptions/description[@language='en']",$o->item(0) ) ) && $o2->length > 0 )
                                $szDescription = $o2->item(0)->getAttribute( 'value' );

                            if ( ( $o2 = $oXPath->query( "aliases/language[@id='en']/alias",$o->item(0) ) ) && $o2->length > 0 )
                            {
                                foreach( $o2 as $oAliasNode )
                                {
                                    $aAliases[] = $oAliasNode->getAttribute( 'value' );
                                }
                            }

                            if ( ( $o2 = $oXPath->query( "claims/property",$o->item(0) ) ) && $o2->length > 0 )
                            {
                                //var_dump( $o2 );
                                foreach( $o2 as $oPropertyNode )
                                {
                                    $szPropertyID = $oPropertyNode->getAttribute( 'id' );
                                    //var_dump( $szPropertyID );

                                    $aValues = null;

                                    // Query pour ne retenir QUE les entités !!!
                                    //if ( ( $o3 = $oXPath->query( "claim/mainsnak/datavalue[@type='wikibase-entityid']",$oPropertyNode ) ) && $o3->length > 0 )
                                    // Query pour ne retenir avoir toutes les datavalue ... mais alors, il faut raffiner l'obtention de la datavalue parce qu'elle peut prendre plusieurs formes!!!
                                    if ( ( $o3 = $oXPath->query( "claim/mainsnak/datavalue",$oPropertyNode ) ) && $o3->length > 0 )
                                    {
                                        //var_dump( $o3 );
                                        //var_dump( $szPropertyID );
                                        foreach( $o3 as $oDataValueNode )
                                        {
                                            switch( $szNodeType = strtolower( $szType = $oDataValueNode->getAttribute('type') ) )
                                            {
                                                case 'wikibase-entityid'    :
                                                    {
                                                        //var_dump( "{$szPropertyID}: WITH FIRSTCHILD",$oDataValueNode->firstChild->getAttribute('id') );
                                                        $aValues[] = array( 'type' =>  $szType                                                  ,
                                                                            'value' => $oDataValueNode->firstChild->getAttribute('id')          ,
                                                                          );
                                                    }
                                                    break;
                                                case 'time'                 :
                                                    {
                                                        $aValues[] = array( 'type'  => $szType                                                  ,
                                                                            'value' => $oDataValueNode->firstChild->getAttribute('time')        ,
                                                                          );
                                                    }
                                                    break;
                                                case 'string'               :
                                                    {
                                                        $aValues[] = array( 'type'  => $szType                                                  ,
                                                                            'value' => $oDataValueNode->getAttribute('value')                   ,
                                                                          );
                                                    }
                                                    break;
                                                case 'quantity'             :
                                                    {
                                                        $aValues[] = array( 'type'  => $szType                                                  ,
                                                                            'value' => $oDataValueNode->firstChild->getAttribute('amount')      ,
                                                                          );
                                                    }
                                                    break;
                                                case 'monolingualtext'      :
                                                    {
                                                        $aValues[] = array( 'type'  => $szType                                                  ,
                                                                            'value' => $oDataValueNode->firstChild->getAttribute('text')        ,
                                                                          );
                                                    }
                                                    break;
                                                case 'globecoordinate'      :
                                                    {
                                                        $aValues[] = array( 'type'      => $szType                                               ,
                                                                            'latitude'  => $oDataValueNode->firstChild->getAttribute('latitude' ),
                                                                            'longitude' => $oDataValueNode->firstChild->getAttribute('longitude'),
                                                                            'precision' => $oDataValueNode->firstChild->getAttribute('precision'),
                                                                          );
                                                    }
                                                    break;
                                                default                     :
                                                    {
                                                        $this->die( "Hey ... cannot handle the '{$szNodeType}' type of property. Report this unanticipated situation to Pat Boens (pb@trl.fm)" );
                                                    }
                                                    break;
                                            }   /* switch( $szNodeType = $oDataValueNode->getAttribute('type') ) */
                                        }   /* foreach( $o3 as $oDataValueNode ) */
                                    }   /* if ( ( $o3 = $oXPath->query( "claim/mainsnak/datavalue",$oPropertyNode ) ) && $o3->length > 0 ) */
                                    $aProperties[$szPropertyID] = array( 'values' => $aValues );
                                }   /* foreach( $o2 as $oPropertyNode ) */
                            }   /* if ( ( $o2 = $oXPath->query( "claims/property",$o->item(0) ) ) && $o2->length > 0 ) */
                        }   /* if ( ( $o = $oXPath->query( "entities/entity" ) ) && $o->length > 0 ) */

                        $aRetVal = array( 'id'              => $szTerm                                  ,
                                          'label'           => $szLabel                                 ,
                                          'description'     => $szDescription                           ,
                                          'url'             => 'https://wikidata.org/wiki/' . $szTerm   ,
                                          'aliases'         => $aAliases                                ,
                                          'properties'      => $aProperties                             ,
                                          'xml'             => $szXML                                   ,
                                        );
                    }   /* if ( $o->item(0)->getAttribute( 'success' ) === '1' ) */
                }   /* if ( ( $o = $oXPath->query( "/*" ) ) && $o->length > 0 ) */
            }   /* if ( $oXPath = new DOMXPath( $oDom ) ) */
        }   /* if ( ! empty( $szXML ) && $oDom->LoadXML( $szXML ) ) */

        end:

        return ( $aRetVal );
    }   /* End of Wikipedia.parse4() ================================================== */
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
    }   /* End of Wikipedia.__destruct() ============================================== */
    /* ================================================================================ */

}   /* End of class Wikipedia ========================================================= */
/* ==================================================================================== */
?>