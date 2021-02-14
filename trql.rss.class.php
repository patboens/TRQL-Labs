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
    {*file                  trql.rss.class.php *}
    {*purpose               RSS services; Reads an RSS feed, RSS 2.0 or Atom *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 29-07-20 14:22 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 29-07-20 14:22 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 14-02-21 08:55 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\rss;

use \trql\mother\Mother                     as Mother;
use \trql\mother\iContext                   as iContext;
use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\utility\Utility                   as Utility;
use \trql\intangible\Intangible             as Intangible;
use \trql\thing\Thing                       as Thing;
use \trql\person\Person                     as Person;
use \trql\form\Form                         as Form;
use \trql\fieldset\Fieldset                 as Fieldset;
use \trql\formset\Formset                   as Formset;
use \trql\input\Input                       as Input;
use \trql\comment\Comment                   as Comment;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'UTILITY_CLASS_VERSION' ) )
    require_once( 'trql.utility.class.php' );

if ( ! defined( 'INTANGIBLE_CLASS_VERSION' ) )
    require_once( 'trql.intangible.class.php' );

if ( ! defined( 'THING_CLASS_VERSION' ) )
    require_once( 'trql.thing.class.php' );

if ( ! defined( 'PERSON_CLASS_VERSION' ) )
    require_once( 'trql.person.class.php' );

if ( ! defined( 'FORM_CLASS_VERSION' ) )
    require_once( 'trql.form.class.php' );

if ( ! defined( 'FIELDSET_CLASS_VERSION' ) )
    require_once( 'trql.fieldset.class.php' );

if ( ! defined( 'FORMSET_CLASS_VERSION' ) )
    require_once( 'trql.formset.class.php' );

if ( ! defined( 'INPUT_CLASS_VERSION' ) )
    require_once( 'trql.input.class.php' );

if ( ! defined( 'COMMENT_CLASS_VERSION' ) )
    require_once( 'trql.comment.class.php' );


defined( 'RSS_CLASS_VERSION'            ) or define( 'RSS_CLASS_VERSION'            ,'0.1' );
defined( 'DATAFEEDITEM_CLASS_VERSION'   ) or define( 'DATAFEEDITEM_CLASS_VERSION'   ,'0.1' );
defined( 'RSSCHANNEL_CLASS_VERSION'     ) or define( 'RSSCHANNEL_CLASS_VERSION'     ,'0.1' );
defined( 'RSSITEM_CLASS_VERSION'        ) or define( 'RSSITEM_CLASS_VERSION'        ,'0.1' );


/* ==================================================================================== */
/** {{*class RSS=

    {*desc

        Reads an RSS feed

    *}

    *}}
 */
/* ==================================================================================== */
class RSS extends Utility implements iContext
/*-----------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $szContent      = null;                             /* {*property   $szContent                  (string)                The content read from an URL *} */
    protected   $oDom           = null;                             /* {*property   $oDom                       (DOMDocument)           Internal DOMDocument *} */
    protected   $aChannels      = null;                             /* {*property   $aChannels                  (array)                 Array of channels found in the RSS feed *} */
    public      $ttl            = 7200;                             /* {*property   $ttl                        (int)                   Time-to-Live in sec of an RSS cache; 2 hours by default *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId     = 'Q45432';                         /* {*property   $wikidataId                 (string)                Family of web feed formats *} */

    public      $oForm          = null;                             /* {*property   $oForm                      (Form)                  Form that is generated via [c]__toForm()[/c] *} */
    public      $szClass        = null;                             /* {*property   $szClass                    (string)                CSS class of the RSS form ([c]__toForm()[/c]) *} */


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

        $this->oDom     = new DOMDocument();
        $this->oForm    = new Form();

        return ( $this );
    }   /* End of RSS.__construct() =================================================== */
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
    }   /* End of RSS.cacheName() ===================================================== */
    /* ================================================================================ */


    protected function call( $szURL )
    /*-----------------------------*/
    {
        $szCacheFile = $this->cacheName( 'read',$szURL );           /* RSS feed is cached in that file */

        if ( true && $this->remembering && $this->fileExistsAndNoOlderThan( $szCacheFile,$this->ttl ) )
        {
            //$this->die( "ON A LE CACHE: {$szCacheFile}" );
            $this->szContent = $this->getHashFile( $szCacheFile );
            $this->addInfo( __METHOD__ . "(): RSS feed obtained from {$szCacheFile}" );
            goto end;
        }   /* if ( is_file( $szCacheFile ) ) */
        else    /* Else of ... if ( is_file( $szCacheFile ) ) */
        {
            //$this->die( "ON N'A PAS LE CACHE" );
            if ( empty( $this->szContent = $this->GetURL( $szURL ) ) )
                $this->szContent = @file_get_contents( $szURL );

            $this->normalizeXML();                                  /* Normalizes $this->szContent */

            if ( ! empty( $this->szContent ) && $this->storing )
            {
                $this->saveHashFile( $szCacheFile,$this->szContent );
                $this->addInfo( __METHOD__ . "(): RSS cached in {$szCacheFile}" );
            }   /* if ( $this->storing ) */
        }    /* End of ... Else of ... if ( is_file( $szCacheFile ) ) */

        end:

        return ( $this );
    }   /* End of RSS.call() ========================================================== */
    /* ================================================================================ */


    /* Doc :

        https://stackoverflow.com/questions/51537063/url-format-for-google-news-rss-feed
        https://www.lifewire.com/google-news-custom-rss-feed-3486648

    */
    public function read( $szURL,$aCategories = null )
    /*----------------------------------------------*/
    {
        $aRetVal = null;

        $this->aChannels = null;                    /* Reset the channels */
        $this->szContent = null;                    /* Reset the RSS XML */

        //$szCacheFile    = $this->cacheName( md5( $szURL ) );
        //var_dump( $szCacheFile );

        /* ======================================================== */
        /* When the read() method uses a cache, it responds very    */
        /* rapidly (perf: CALL RSS EN 0.00028 sec)                  */
        /*                                                          */
        /* What takes time is the parsing !                         */
        /* (perf: PARSE RSS EN 0.92847 sec)                         */
        /* ======================================================== */
        $tStart = microtime( true );
        $this->call( $szURL );                      /* Upon return, $this->szContent is updated (perf: CALL RSS EN 0.00028 sec) */
        $tEnd = microtime( true );
        //var_dump( 'CALL RSS EN ' . round( $tEnd - $tStart,5 ) . ' sec');

        $tStart = microtime( true );
        $this->parse();                             /* Parse $this->szContent ... and get the channels that were detected + all items (perf: PARSE RSS EN 0.92847 sec) */
        $tEnd = microtime( true );
        //var_dump( 'PARSE RSS EN ' . round( $tEnd - $tStart,5 ) . ' sec');

        if ( is_array( $this->aChannels ) && count( $this->aChannels ) > 0 )
        {
            $aAllCategories = array();

            /* Normaly, there is a SINGLE channel */
            foreach ( $this->aChannels[0]->aItems as $oItem )
            {
                if ( is_array( $aCategories ) )
                    $oItem->aCategories = array_merge( $aCategories,$oItem->aCategories );

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
                                               'author'     => null                                         ,   /* Il faut récupérer la zone $oItem->author */
                                               'cargo'      => $oItem                                       ,
                                             );

                foreach( $oItem->aCategories as $szCategory )
                {
                    $szCategory = strtolower( trim( $szCategory ) );
                    $aAllCategories[$szCategory] = $this->categoryShelter( $szCategory,$szURL );
                }   /* foreach( $oItem->aCategories as $szCategory ) */
            }   /* foreach ( $this->aChannels[0]->aItems as $oItem ) */

            $this->saveCategories( $aAllCategories,$aRetVal );      /* Saves the results so that we can serve them with getNewsInStock() */

        }   /* if ( is_array( $this->aChannels ) && count( $this->aChannels ) > 0 ) */

        //$this->__die(" CETTE CLASSE RSS N'EST PAS FINIE" );
        end:

        return ( $aRetVal );
    }   /* End of RSS.read() ========================================================== */
    /* ================================================================================ */


    protected function saveCategories( $aAllCategories,$aRetVal )
    /*---------------------------------------------------------*/
    {
        $bRetVal = false;

        if ( is_array( $aAllCategories ) && is_array( $aRetVal ) )
        {
            $bRetVal = true;

            foreach ( $aAllCategories as $szFile )
            {
                //var_dump( $szFile );

                //if ( ! is_dir( $szDir = dirname( $szFile ) ) )
                //    vaesoli::FIL_MkDir( $szDir );
                //
                //vaesoli::FIL_StrToFile( gzencode( serialize( $aRetVal ),$level = 9,$encoding_mode = FORCE_GZIP ),$szFile );

            }   /* foreach ( $aAllCategories as $szFile ) */
        }   /* if ( is_array( $aAllCategories ) && is_array( $aRetVal ) ) */

        return ( $bRetVal );
    }   /* End of RSS.saveCategories() ================================================ */
    /* ================================================================================ */


    protected function categoryShelter( &$szCategory,&$szURL )
    /*------------------------------------------------------*/
    {
        return ( vaesoli::FIL_RealPath( $this->home() . '/categories/' . $this->categoryShelterDir( $szCategory ) . $this->categoryShelterFile( $szURL ) ) );
    }   /* End of RSS.categoryShelter() =============================================== */
    /* ================================================================================ */


    protected function categoryShelterDir( $szCategory )
    /*------------------------------------------------*/
    {
        return ( vaesoli::FIL_KeepValidCharacters( str_replace( array(' '),'_',$szCategory ) ) . '/' );

    }   /* End of RSS.categoryShelterDir() ============================================ */
    /* ================================================================================ */


    protected function categoryShelterFile( $szURL )
    /*--------------------------------------------*/
    {
        return ( date( 'YmdHis' ) . '.' . md5( $szURL ) . '.cache.zip' );

    }   /* End of RSS.categoryShelterFile() =========================================== */
    /* ================================================================================ */


    public function getNewsInStock( $xCategories )
    /*------------------------------------------*/
    {
        if     ( is_string( $xCategories ) )
            $aCategories = array( $xCategories );
        elseif ( is_array( $xCategories ) )
            $aCategories = $xCategories;

        $this->die( __METHOD__ . '(): METHOD IS NOT READY YET' );
    }   /* End of RSS.getNewsInStock() ================================================ */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of RSS.speak() ========================================================= */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of RSS.sing() ========================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*parse()=

        Parses what has been returned by [c]call()[/c] ($this->szContent)

        {*params
        *}

        {*return
            (array)     An array of results
        *}

        *}}
    */
    /* ================================================================================ */
    protected function parse( $szXML = null )
    /*-------------------------------------*/
    {
        $szCacheFile = $this->cacheName( __METHOD__,$this->szContent );

        //var_dump( $szCacheFile );

        if ( $this->remembering && is_file( $szCacheFile ) )
        {
            //var_dump( "REMEMBERING AND FILE FOUND" );
            $this->aChannels = vaesoli::FIL_getHashFile( $szCacheFile );
        }   /* if ( $this->remembering && is_file( $szCacheFile ) ) */
        else    /* Else of ... if ( $this->remembering && is_file( $szCacheFile ) ) */
        {
            if ( @$this->oDom->loadXML( $this->szContent ) )
                $this->channels();     /* Get all channels found in $this->szContent */

            //$this->die("Dying here");

            if ( is_array( $this->aChannels ) && count( $this->aChannels ) > 0 )
            {
                //var_dump( "ALL CHANNELS PARSED",$this->aChannels );
                vaesoli::FIL_saveHashFile( $szCacheFile,$this->aChannels );
                //$this->die("Dying NOW");

                //foreach ( $this->aChannels[0]->aItems as $oItem )
                //{
                //}   /* foreach ( $this->aChannels[0]->aItems as $oItem ) */
                //
                //$this->__Echo( "On a " . count($this->aChannels[0]->aItems ) . " items MAIS ...\n" );
                //$this->die( "LES ITEMS NE SONT PAS VRAIMENT BIEN REMPLIS!!!" );
            }   /* if ( is_array( $this->aChannels ) && count( $this->aChannels ) > 0 ) */
        }   /* End of ... Else of ... if ( $this->remembering && is_file( $szCacheFile ) ) */

        end:
        return ( $this );
    }   /* End of RSS.parse() ========================================================= */
    /* ================================================================================ */


    protected function channels()
    /*-------------------------*/
    {
        //var_dump( __METHOD__ . ": ON EST DANS channels()" );

        if ( $oXPath = new DOMXPath( $this->oDom ) )                /* Create a new XPath object */
        {
            $oXPath->registerNamespace( 'dc','http://purl.org/dc/elements/1.1/' );

            $channels = $oXPath->query( $szQuery = '//channel' );

            if ( $channels && $channels->length > 0 ) /* If channels found */
            {
                //var_dump( __METHOD__ . ": CASE 1" );
                foreach( $channels as $oChannelNode )
                {
                    $oChannel = new RSSChannel();
                    $oChannel->populate( $oXPath,$oChannelNode );
                    $this->aChannels[] = $oChannel;
                }   /* foreach( $channels as $oChannelNode ) */
            }
            elseif ( is_null( $channels ) || $channels->length === 0 )  /* If channels NOT found ... let's try Atom */
            {
                //var_dump( __METHOD__ . ": CASE 2" );

                // Bon ... il se pourrait bien que ce truc soit un bazar Atom
                // Alors ... on va essayer Atom
                // Doc: https://stackoverflow.com/questions/8068997/how-to-query-the-entry-nodes-from-an-atom-feed

                $oXPath->registerNamespace( 'a','http://www.w3.org/2005/Atom' );

                $channels = $oXPath->query( $szQuery = '/a:feed' );

                if ( $channels && $channels->length > 0 )
                {
                    //var_dump( __METHOD__ . ": FOUND {$channels->length} FEEDS WHICH ARE LIKE CHANNELS" );
                    foreach( $channels as $oChannelNode )
                    {
                        $oChannel = new RSSChannel();
                        $oChannel->populate( $oXPath,$oChannelNode = null,'atom' );
                        $this->aChannels[] = $oChannel;
                    }   /* foreach( $aEntries as $oChannelNode ) */
                }   /* if ( $aEntries = $oXPath->query( $szQuery = '/a:feed/a:entry' ) && $aEntries->length > 0 ) */

                $oXPath->registerNamespace( 'a',null );  /* Unregister prefix a ! */
            }
            else
            {
                throw new \Exception( __METHOD__ . "() at line " . __LINE__ . ": No channel found (ErrCode: " . EXCEPTION_CODE_RSS_NO_CHANNEL_FOUND . ")",EXCEPTION_CODE_RSS_NO_CHANNEL_FOUND );
            }
        }   /* if ( $oXPath = new DOMXPath( $this->oDom ) ) */

        end:

        return ( $this );
    }   /* End of RSS.channels() ====================================================== */
    /* ================================================================================ */


    protected function normalizeXML()
    /*-----------------------------*/
    {
        if ( ! empty( $this->szContent ) )
            if ( ( $iPos = vaesoli::STR_iPos( $this->szContent,'<?xml version' ) ) !== -1 )
                $this->szContent = substr( $this->szContent,$iPos );

        return ( $this );
    }   /* End of RSS.normalizeXML() ================================================== */
    /* ================================================================================ */


    public function __get( $szProperty )
    /*-------------------------------*/
    {
        switch ( $szProperty )
        {
            case 'aChannels'    :
            case 'Channels'     :
            case 'channels'     :
                {
                    return ( $this->aChannels );
                }
                break;
            case 'home'         :
            case 'szHome'         :
                {
                    return ( $this->self['home'] );
                }
                break;
            default             :   return ( parent::__get( $szProperty ) );
        }   /* switch ( $szProperty ) */
    }   /* End of RSS.__get() ========================================================= */
    /* ================================================================================ */


    public function __toForm():string
    /*-----------------------------*/
    {
        {   /* Create a fieldset and add the field set to the form */
            $oFieldset              = new Fieldset();
            $oFieldset->szCaption   = 'RSS Feed';

            {   /* Adding zones to the fieldset */
                $oFieldset->add( new Input( array( 'name'           =>  'Title'                                                 ,
                                                   'type'           =>  'txt'                                                   ,
                                                   'label'          =>  'Title'                                                 ,
                                                   'lang'           =>  'en'                                                    ,
                                                   'tooltip'        =>  'RSS feed - Item Title'                                 ,
                                                   'required'       =>  true                                                    ,
                                                   'delete'         =>  true                                                    ,
                                                   'help'           =>  false                                                   ,
                                                   'value'          =>  ''                                                      ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Link'                                                  ,
                                                   'type'           =>  'url'                                                   ,
                                                   'label'          =>  'Link'                                                  ,
                                                   'lang'           =>  'en'                                                    ,
                                                   'tooltip'        =>  'Enter the URL corresponding to the RSS Item'           ,
                                                   'required'       =>  false                                                   ,
                                                   'delete'         =>  true                                                    ,
                                                   'help'           =>  false                                                   ,
                                                   'value'          =>  ''                                                      ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'PubDate'                                               ,
                                                   'type'           =>  'dat'                                                   ,
                                                   'label'          =>  'Publication date'                                      ,
                                                   'lang'           =>  'en'                                                    ,
                                                   'tooltip'        =>  'RSS feed - Date of publication'                        ,
                                                   'required'       =>  true                                                    ,
                                                   'delete'         =>  true                                                    ,
                                                   'help'           =>  false                                                   ,
                                                   'value'          =>  ''                                                      ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Description'                                           ,
                                                   'type'           =>  'edt'                                                   ,
                                                   'label'          =>  'Description'                                           ,
                                                   'lang'           =>  'en'                                                    ,
                                                   'tooltip'        =>  'RSS feed - Description - Main text'                    ,
                                                   'rows'           =>  8                                                       ,
                                                   'required'       =>  true                                                    ,
                                                   'delete'         =>  true                                                    ,
                                                   'help'           =>  false                                                   ,
                                                   'value'          =>  ''                                                      ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Submit'                                                ,
                                                   'type'           =>  'cmd'                                                   ,
                                                   'class'          =>  'shadow'                                                ,
                                                   'lang'           =>  'en'                                                    ,
                                                   'value'          =>  'Submit'                                                ,
                                                 ) ) );
            }   /* Adding zones to the fieldset */

            $this->oForm->add( $oFieldset );

        }   /* Create a fieldset and add the field set to the form */

        return ( $this->oForm->render() );
    }   /* End of RSS.__toForm() ====================================================== */
    /* ================================================================================ */


    public function __toString():string
    /*-------------------------------*/
    {
        return ( $this->__toForm() );
    }   /* End of RSS.__toString() ==================================================== */
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

    }   /* End of RSS.__destruct() ==================================================== */
    /* ================================================================================ */

}   /* End of class RSS =============================================================== */
/* ==================================================================================== */


/* ==================================================================================== */
/** {{*class DataFeedItem=

    {*desc

        A single item within a larger data feed.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/DataFeedItem[/url] *}

    {*warning

        The DataFeedItem class found in here may be a sort of duplicate

    *}

    *}}
 */
/* ==================================================================================== */
class DataFeedItem extends Intangible
/*---------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                                     Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $dateCreated            = null;                     /* {*property   $dateCreated                (Date|DateTime)                             The date on which the CreativeWork was created or the item was
                                                                                                                                                            added to a DataFeed. *} */
    public      $dateDeleted            = null;                     /* {*property   $dateDeleted                (Date|DateTime)                             The datetime the item was removed from the DataFeed. *} */
    public      $dateModified           = null;                     /* {*property   $dateModified               (Date|DateTime)                             The date on which the CreativeWork was most recently modified or
                                                                                                                                                            when the item's entry was modified within a DataFeed. *} */
    public      $item                   = null;                     /* {*property   $item                       (Thing)                                     An entity represented by an entry in a list or data feed
                                                                                                                                                            (e.g. an 'artist' in a list of 'artists'). *} */

    /* -- [ Properties NOT found in schema.org ] ---------------- */
    public      $datePublication        = null;                     /* {*property   $datePublication            (Date|DateTime)                             The date the feed can be published *} */
    public      $identifier             = null;                     /* {*property   $identifier                 (PropertyValue|string|URL)                  The identifier property represents any kind of identifier for any
                                                                                                                                                            kind of Thing, such as ISBNs, GTIN codes, UUIDs etc. Schema.org
                                                                                                                                                            provides dedicated properties for representing many of these,
                                                                                                                                                            either as textual strings or as URL (URI) links. See background
                                                                                                                                                            notes for more details. *} */

    public      $comment                = null;                     /* {*property   $comment                    (Comment)                                   A comment on an item *} */


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
    }   /* End of DataFeedItem.__construct() ========================================== */
    /* ================================================================================ */


    public function __destruct()
    /*------------------------*/
    {
        $this->backup();
        $this->autodoc();
        $this->UIKey();
        $this->WikiData();
        $this->necroSignaling();
    }   /* End of DataFeedItem.__destruct() =========================================== */
    /* ================================================================================ */

}   /* End of class DataFeedItem ====================================================== */
/* ==================================================================================== */


class RSSChannel extends Thing
/*--------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                                     Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    //use     Feed;

    public  $szTitle                    = '';
    public  $szDesc                     = '';
    public  $szPubDate                  = '';
    public  $szLastBuild                = '';
    public  $szLink                     = '';
    public  $szLanguage                 = '';
    public  $szCopyright                = '';
    public  $szManagingEditor           = '';
    public  $szRating                   = '';
    public  $szWebMaster                = '';
    public  $szSkipDays                 = '';
    public  $szSkipHours                = '';
    public  $szCategory                 = '';
    public  $szGenerator                = '';
    public  $szTTL                      = '';
    public  $szCloud                    = '';
    public  $szDocs                     = '';
    public  $szImageTitle               = '';
    public  $szImageURL                 = '';
    public  $szImageLink                = '';
    public  $iImageWidth                = -1;
    public  $iImageHeight               = -1;

    public  $bMustPublish               = true;
    public  $bMustDisplayChannelImage   = true;
    public  $szHeading                  = 'h2';

    public  $aItems                     = null;

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
    }   /* End of RSSChannel.__construct() ============================================ */
    /* ================================================================================ */


    public function populate( $oXPath,$oNode,$szType = 'rss2' )
    /*--------------------------------------------------------*/
    {
        // subTag() is defined as a method of the "feed" trait (use feed)

        switch( $szType )
        {
            case 'atom' :
                {
                    // In the case of an Atom feed, there is NO channel node and therefore
                    // $oNode is null
                    //echo __LINE__," of ",__FILE__," ... CANNOT POPULATE ATOM FEED YET\n";

                    $itemList = $oXPath->query( $szQuery = '/a:feed/a:entry' );

                    if ( ! is_null( $itemList ) && $itemList->length > 0 )
                    {
                        //var_dump( __METHOD__ . " CAS ATOM ... FOUND " . $itemList->length . " ITEMS" );
                        //echo __LINE__," of ",__FILE__," ... {$itemList->length} items found\n";

                        foreach ( $itemList as $oItemNode )                     /* For each item found in this channel */
                        {
                            $oItem = new RSSItem();                             /* Create an item */
                            $oItem->populate( $oXPath,$oItemNode,$szType );
                            $this->aItems[] = $oItem;
                            //var_dump( $oItem->aCategories );
                        }   /* foreach ( $itemList as $oItemNode ) */
                    }   /* if ( ! is_null( $itemList ) && $itemList->length > 0 ) */
                }
                break;
            case 'rss2' :
                {

                    $this->szTitle          =       $this->subTag( $oXPath,$oNode,'title'           );
                    $this->szDesc           =       $this->subTag( $oXPath,$oNode,'description'     );
                    $this->szLastBuild      =       $this->subTag( $oXPath,$oNode,'lastBuildDate'   );
                    $this->szLink           =       $this->subTag( $oXPath,$oNode,'link'            );
                    $this->szLanguage       =       $this->subTag( $oXPath,$oNode,'language'        );
                    $this->szCopyright      =       $this->subTag( $oXPath,$oNode,'copyright'       );
                    $this->szPubDate        =       $this->subTag( $oXPath,$oNode,'pubDate'         );
                    $this->szLink           =       $this->subTag( $oXPath,$oNode,'link'            );
                    $this->szManagingEditor =       $this->subTag( $oXPath,$oNode,'managingEditor'  );
                    $this->szRating         =       $this->subTag( $oXPath,$oNode,'rating'          );
                    $this->szWebMaster      =       $this->subTag( $oXPath,$oNode,'webMaster'       );
                    $this->szSkipDays       =       $this->subTag( $oXPath,$oNode,'skipDays'        );
                    $this->szSkipHours      =       $this->subTag( $oXPath,$oNode,'skipHours'       );
                    $this->szCategory       =       $this->subTag( $oXPath,$oNode,'category'        );
                    // Ici ... je devrais aussi extraire l'attribut 'domain' de category
                    $this->szGenerator      =       $this->subTag( $oXPath,$oNode,'generator'       );
                    $this->szTTL            =       $this->subTag( $oXPath,$oNode,'ttl'             );
                    $this->szCloud          =       $this->subTag( $oXPath,$oNode,'cloud'           );
                    // Ici ... je devrais aussi extraire d'autres attributs de cloud
                    $this->szDocs           =       $this->subTag( $oXPath,$oNode,'docs'            );
                    $this->szImageTitle     =       $this->subTag( $oXPath,$oNode,'image/title'     );
                    $this->szImageURL       =       $this->subTag( $oXPath,$oNode,'image/url'       );
                    $this->szImageLink      =       $this->subTag( $oXPath,$oNode,'image/link'      );
                    $this->iImageWidth      = (int) $this->subTag( $oXPath,$oNode,'image/width'     );
                    $this->iImageHeight     = (int) $this->subTag( $oXPath,$oNode,'image/height'    );

                    // Voir à quoi ceci correspond dans LSContentsRSS.class.php
                    //$oChannel->szHeading                =                $this->GetParameter( 'channel-heading'      ,$oChannel->szHeading,true );
                    //$oChannel->bMustDisplayChannelImage = MISC_CastBool( $this->GetParameter( 'display-channel-image',false               ,true ) );

                    if ( ! is_null( $itemList =  $this->subTags( $oXPath,$oNode,'item' ) ) )
                    {
                        foreach ( $itemList as $oItemNode )                     /* For each item found in this channel */
                        {
                            $oItem = new RSSItem();                             /* Create an item */
                            $oItem->populate( $oXPath,$oItemNode );
                            $this->aItems[] = $oItem;
                            //var_dump( $oItem->aCategories );
                        }   /* foreach ( $itemList as $oItemNode ) */
                    }   /* if ( ! is_null( $itemList =  $this->subTags( $oXPath,$oNode,'item' ) ) ) */

                }

                break;
        }   /* switch( $szType ) */

    }   /* End of RSSChannel.populate() =============================================== */

}   /* End of class RSSChannel ======================================================== */
/* ==================================================================================== */


class RSSItem extends DataFeedItem
/*-------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                                     Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $aCategories            = null;
    public      $item                   = null;
    public      $source                 = null;                     /* {*property   $source                     (string)                                    The RSS channel that the item came from
                                                                                                                                                            (e.g. <source url="http://www.quotationspage.com/data/qotd.rss">Quotes
                                                                                                                                                            of the Day</source>) *} */
    public      $author                 = null;

    public      $tDate                  = null;
    public      $summary                = null;                     /* {*property   $summary                    (string)                                    Summary of the item *} */

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

        $this->author = new Person();

        return ( $this );
    }   /* End of RSSItem.__construct() =============================================== */
    /* ================================================================================ */


    public function chopName( $szStr )
    /*------------------------------*/
    {
        $szFirstName    =
        $szLastName     =
        $szFullName     = null;


        // Attention, avec des prénoms/noms qui contiennent des caractères accentués on a un problème
        // 'firstname' => string 'St' (length=2)
        // 'lastname' => string 'phanie Schmidt' (length=14)
        // 'fullname' => string 'St phanie Schmidt' (length=17)

        if ( preg_match_all( '/(?:[[:word:]])+/i',$szStr,$aMatches,PREG_PATTERN_ORDER ) )
        {
            //$aMatches = $aMatches[0];
            //var_dump( $aMatches[0] );
            // 0 ... Ben
            // 1 ... Hammersley
            if ( is_array( $aMatches[0] ) && count( $aMatches[0] ) >= 2 )
            {
                $szFirstName    = trim( (string) $aMatches[0][0] );
                $szLastName     = trim( str_replace( $szFirstName . ' ','',(string) implode( ' ',$aMatches[0] ) ) );
                $szFullName     = $szFirstName . ' ' . $szLastName;
                //var_dump( $this->author->givenName );
                //var_dump( $this->author->familyName );
            }   /* if ( is_array( $aMatches[0] ) && count( $aMatches[0] ) >= 2 ) */
        }   /* if ( preg_match_all( '/(?:[[:word:]])+/i',$szName,$aMatches,PREG_PATTERN_ORDER ) ) */

        return ( array( 'firstname' => $szFirstName ,
                        'lastname'  => $szLastName  ,
                        'fullname'  => $szFullName
                      )
               );
    }   /* End of RSSItem.chopName() ================================================== */
    /* ================================================================================ */


    public function chopAuthor( $szStr )
    /*--------------------------------*/
    {
        $szFirstName    =
        $szLastName     =
        $szFullName     =
        $szEmail        = null;

        $szEmailPattern = '/(?:[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/i';

        // For testing purposes
        //$szStr = 'ben@benhammersley.com (Ben Hammersley)';

        if ( preg_match( $szEmailPattern,$szStr,$aMatch ) )
        {
            //var_dump('dc:creator WITH mail ... ' . $szCreator );
            //var_dump( $aMatch );
            $szEmail = $aMatch[0];

            /* Let's look for '(Ben Hammersley)' in 'ben@benhammersley.com (Ben Hammersley)' */
            if ( preg_match('/\((?P<name>.+)\)/i',$szStr,$aPart ) )
            {
                $aNameParts  = $this->chopName( $aPart['name'] );
                $szFirstName = $aNameParts['firstname'];
                $szLastName  = $aNameParts['lastname'];
                $szFullName  = $aNameParts['fullname'];
            }   /* if ( preg_match('/\((?P<name>.+)\)/i',$szCreator,$aPart ) ) */
        }
        else
        {
            // Quelques exemples de noms mentionnés dans des RSS réels
            // Mathilde Sallé de Chou
            // Chris Steffen
            // AllMusic Staff
            //
            // Ces quelques cas prouvent que la routine n'est pas encore au point

            $aNameParts  = $this->chopName( $szStr );
            $szFirstName = $aNameParts['firstname'];
            $szLastName  = $aNameParts['lastname'];
            $szFullName  = $aNameParts['fullname'];
        }

        return ( array( 'firstname' => $szFirstName ,
                        'lastname'  => $szLastName  ,
                        'fullname'  => $szFullName  ,
                        'email'     => $szEmail
                      )
               );
    }   /* End of RSSItem.chopAuthor() ================================================ */
    /* ================================================================================ */


    public function populate( $oXPath,$oNode,$szType = 'rss2' )
    /*-------------------------------------------------------*/
    {
        //$this->__die("IN POPULATE " . $szType );
        //var_dump( __METHOD__ . "(): DANS RSSITEM.POPULATE()" );
        switch ( strtolower( trim( $szType ) ) )
        {
            case 'atom' :
                {
                    //var_dump( __METHOD__ . "(): DANS RSSITEM.POPULATE() : CAS ATOM" );
                    //die();

                    // If we are using Atom, then there is a registered namespace called "a"
                    // We use this namespace in all subsequent calls
                    $this->name             =            $this->subTag( $oXPath,$oNode,'a:title'          );
                    $this->url              =            $this->subTag( $oXPath,$oNode,'a:link'           );
                    $this->description      =            $this->subTag( $oXPath,$oNode,'a:content'        );
                    $this->summary          =            $this->subTag( $oXPath,$oNode,'a:summary'        );
                    $this->identifier       =            $this->subTag( $oXPath,$oNode,'a:id'             );
                    $this->datePublication  = strtotime( $this->subTag( $oXPath,$oNode,'a:published'      ) );
                    $this->dateModified     = strtotime( $this->subTag( $oXPath,$oNode,'a:updated'        ) );

                    //var_dump( "TITLE: {$this->name}","URL: {$this->url}" );

                    /* If we haven't found any link ... let's try anothyer strategy */
                    if ( empty( $this->url ) )
                        if ( ( $oLnks = $oXPath->query( 'a:link',$oNode ) ) && $oLnks->length > 0 )
                        {
                            $o = $oLnks->item(0);
                            if ( ! empty( $szLink = $o->getAttribute( 'href' ) ) )
                                $this->url = $szLink;
                            //var_dump( $o,$szLink );
                        }

                    // Lire specification ... https://tools.ietf.org/html/rfc4287
                    if ( ! empty( $szCategory = $this->subTag( $oXPath,$oNode,'a:category' ) ) )
                        $this->aCategories[] = $szCategory;
                    else
                    {
                        //var_dump( "CATEGORIE VIDE",$oNode->nodeName );

                        if ( ( $aCategoriesColl = $oXPath->query( 'a:category',$oNode ) ) && $aCategoriesColl->length > 0 )
                        {
                            foreach( $aCategoriesColl as $aCatNode )
                            {
                                if ( ! empty( $aCatNode->nodeValue ) )
                                    $this->aCategories[] = $aCatNode->nodeValue;
                                else
                                {
                                    if ( ! empty( $szCat = $aCatNode->getAttribute( 'term' ) ) )
                                        $this->aCategories[] = $szCat;
                                }
                            }
                            //var_dump( "FOUND {$aCategoriesColl->length} subnodes for category" );
                        }

                        if ( count( $this->aCategories ) < 1 )
                            $this->aCategories[] = 'unknown';
                    }

                    if ( ! empty( $szCreator = $this->subTag( $oXPath,$oNode,'a:author/a:name' ) ) )
                    {
                        // Dans le cas de Atom, on peut avoir qqch comme:
                        // <author>
                        //     <name>Dr. Sougueh Cheik, PhD, Docteur en sciences de l’environnement (écologie des sols), iEES-Sorbonne Université UPMC PARIS VI, Institut de recherche pour le développement (IRD)</name>
                        //     <foaf:homepage rdf:resource="https://theconversation.com/profiles/dr-sougueh-cheik-phd-1005537"/>
                        // </author>

                        //var_dump( "AUTHOR: {$szCreator}" );
                    }
                    //var_dump( $this );
                    //echo __LINE__," of ",__METHOD__," ... on va mourir : {$szType}\n";
                    //die();
                }   /* Case atom */
                break;
            case 'rss2' :
                {
                    $this->name             =            $this->subTag(         $oXPath,$oNode,'title'                  );
                    $this->url              =            $this->subTag(         $oXPath,$oNode,'link'                   );
                    if ( empty( $this->url ) )
                        $this->url          =            $this->tagAttribute(   $oXPath,$oNode,'source'         ,'url'  );
                    $this->description      =            $this->subTag(         $oXPath,$oNode,'description'            );
                    $this->summary          =            $this->subTag(         $oXPath,$oNode,'summary'                );
                    $this->source           =            $this->subTag(         $oXPath,$oNode,'source'                 );
                    $this->identifier       =            $this->subTag(         $oXPath,$oNode,'guid'                   );
                    $this->datePublication  = strtotime( $this->subTag(         $oXPath,$oNode,'pubDate'                ) );

                    if ( ! is_null( $szBody = $this->subTag( $oXPath,$oNode,'body' ) ) )
                    {
                        //var_dump( $szBody );
                        $this->description  = $szBody . $this->description;
                        //var_dump( $this->description );
                        //die( "DIE in " . __METHOD__ . "() at line " . __LINE__ );
                    }

                    // Je ne suis pas parvenu à obtenir la date de publication. Je vais essayer avec Dublin Core
                    if ( is_bool( $this->datePublication ) && ! $this->datePublication )
                    {
                        $this->datePublication  = strtotime( $this->subTag( $oXPath,$oNode,'dc:date' ) );
                    }

                    if ( ! empty( $szComments = $this->subTag( $oXPath,$oNode,'comments' ) ) )
                    {
                        // ATTENTION: JE N'AI PAS CETTE CLASSE !!!!
                        $this->comment          = new Comment();                /* Create a comment */
                        $this->comment->text    = $szComments;                  /* Comment's content expressed in the $text property */

                        //var_dump( $this );
                        //die();

                    }   /* if ( ! empty( $szComments = $this->subTag( $oXPath,$oNode,'coments' ) ) ) */

                    /* Voilà un ensemble de valeurs que je ne lis pas encore (voir aussi https://validator.w3.org/feed/docs/rss2.html)
                       ===============================================================================================================

                        <content:encoded><![CDATA[<p>You’ve probably played a 15 puzzle. ... et blablabla ]]></content:encoded>
                        <wfw:commentRss>https://www.quantamagazine.org/mathematicians-calculate-how-randomness-creeps-in-20191112/feed/</wfw:commentRss>
                        <slash:comments>0</slash:comments>
                        <media:content url="https://d2r55xnwy6nx47.cloudfront.net/uploads/2019/11/15PuzzleProblem_520x292.jpg" type="image/jpg"></media:content>
                        <media:content url="https://positivr.fr/wp-content/uploads/2019/11/haute-savoie-achat-foret-pour-interdire-chasse-une-560x293.jpg" type="image/jpeg" />
                        <image> ....... SUR LE CHANNEL (Specifies a GIF, JPEG or PNG image that can be displayed with the channel)
                            <url>
                                http://cdn-s3.allmusic.com/cms/14554/blog_federale__large.jpg
                            </url>
                            <width>640</width>
                            <height>360</height>
                        </image>
                        <dc:date>2019-11-05T16:25+00:00</dc:date>
                        <dc:creator>Chris Steffen</dc:creator>
                        <dc:subject>Stream & Download, AllMusic Streams</dc:subject>          POURRAIT ETRE UNE FORME DE CATEGORIE ?
                        <enclosure url="https://www.sciencesetavenir.fr/assets/img/2019/11/12/cover-r4x3w1000-5dca97a4516d5-5g.jpg" type="image/jpeg" length="132352"/> (Describes a media object that is attached to the item -- It has three required attributes. url says where the enclosure is located, length says how big it is in bytes, and type says what its type is, a standard MIME type.)
                        <copyright>  ......... SUR LE CHANNEL!!!
                            <![CDATA[ Copyright 2019, Sciences et Avenir ]]>
                        </copyright>
                        <lastBuildDate>Wed, 13 Nov 2019 10:24:00 +0100</lastBuildDate> ........ SUR LE CHANNEL
                        managingEditor    Email address for person responsible for editorial content.    geo@herald.com (George Matesky) ........ SUR LE CHANNEL
                        webMaster    Email address for person responsible for technical issues relating to channel.                  ........ SUR LE CHANNEL
                    */


                    if ( ! is_null( $categoriesList = $this->subTags( $oXPath,$oNode,'category' ) ) )
                    {
                        foreach ( $categoriesList as $oCatNode )
                        {
                            $this->aCategories[] = $oCatNode->nodeValue;
                        }
                    }   /* if ( ! is_null( $categoriesList = $this->subTags( $oXPath,$oNode,'category' ) ) ) */
                    elseif ( ! is_null( $categoriesList = $this->subTags( $oXPath,$oNode,'dc:subject' ) ) )
                    {
                        foreach ( $categoriesList as $oCatNode )
                        {
                            $this->aCategories[] = $oCatNode->nodeValue;
                        }
                    }   /* if ( ! is_null( $categoriesList = $this->subTags( $oXPath,$oNode,'category' ) ) ) */
                    else
                    {
                        //var_dump( "Pas de catégorie");
                        $this->aCategories[] = 'unknown';
                    }

                    //var_dump( $this->aCategories );
                    //die();

                    if ( ! empty( $szCreator = $this->subTag( $oXPath,$oNode,'dc:creator' ) ) )
                    {
                        /*  Spec of RSS say that the author should be mentioned as an email address!
                            (e.g. <author>ben@benhammersley.com (Ben Hammersley)</author>)

                            Spec of Dublin Core for creator are available @
                            https://www.dublincore.org/specifications/dublin-core/usageguide/elements/#4-8-creator
                        */

                    }   /* if ( ! empty( $szCreator = $this->subTag( $oXPath,$oNode,'dc:creator' ) ) ) */
                    elseif ( ! empty( $szCreator = $this->subTag( $oXPath,$oNode,'author' ) ) )
                    {

                    }

                    $aNameParts                 = $this->chopAuthor( $szCreator );

                    $this->author->givenName    = $aNameParts['firstname'];
                    $this->author->familyName   = $aNameParts['lastname'];
                    $this->author->name         = $aNameParts['fullname'];
                }   /* Case rss2 */
        }   /* switch( $szType ) */

    }   /* End of RSSItem.populate() ================================================== */


    public function categories()
    /*------------------------*/
    {
        $szRetVal = '';

        if ( $this->STR_iPos( "salut",'musicgroup' ) != -1 )
        {

        }


        if ( is_array( $this->aCategories ) && count( $this->aCategories ) > 0 )
        {
            foreach( $this->aCategories as $szCategory )
            {
                $szRetVal .= mb_strtolower ( trim( $szCategory ) ) . ',';
            }   /* foreach( $this->aCategories as $szCategory ) */
        }   /* if ( is_array( $this->aCategories ) && count( $this->aCategories ) > 0 ) */

        return ( substr( $szRetVal,0,-1 ) );                        /* Return all categories of the item but the terminating ',' */
    }   /* End of RSSItem.categories() ================================================ */

}   /* End of class RSSItem =========================================================== */
/* ==================================================================================== */
?>