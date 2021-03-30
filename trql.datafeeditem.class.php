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
    {*file                  trql.datafeeditem.class.php *}
    {*purpose               A single item within a larger data feed. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 27-07-20 10:43 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 27-07-20 10:43 *}
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
namespace trql\datafeeditem;

use \trql\quitus\iContext               as iContext;
use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\intangible\Intangible         as Intangible;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'INTANGIBLE_CLASS_VERSION' ) )
    require_once( 'trql.intangible.class.php' );

defined( 'DATAFEEDITEM_CLASS_VERSION' ) or define( 'DATAFEEDITEM_CLASS_VERSION','0.1' );

/* ================================================================================== */
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

    *}}
 */
/* ================================================================================== */
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

    public      $dateCreated                = null;                 /* {*property   $dateCreated                (Date|DateTime)                             The date on which the CreativeWork was created or the item was
                                                                                                                                                            added to a DataFeed. *} */
    public      $dateDeleted                = null;                 /* {*property   $dateDeleted                (Date|DateTime)                             The datetime the item was removed from the DataFeed. *} */
    public      $dateModified               = null;                 /* {*property   $dateModified               (Date|DateTime)                             The date on which the CreativeWork was most recently modified or
                                                                                                                                                            when the item's entry was modified within a DataFeed. *} */
    public      $item                       = null;                 /* {*property   $item                       (Thing)                                     An entity represented by an entry in a list or data feed
                                                                                                                                                            (e.g. an 'artist' in a list of 'artists'). *} */

    /* -- [ Properties NOT found in schema.org ] ---------------- */
    public      $wikidataId                 = null;                 /* {*property   $wikidataId                 (string)                                    Wikidata ID. No equivalent. *} */

    public      $datePublication            = null;                 /* {*property   $datePublication            (Date|DateTime)                             The date the feed can be published *} */
    public      $identifier                 = null;                 /* {*property   $identifier                 (PropertyValue|string|URL)                  The identifier property represents any kind of identifier for any
                                                                                                                                                            kind of Thing, such as ISBNs, GTIN codes, UUIDs etc. Schema.org
                                                                                                                                                            provides dedicated properties for representing many of these,
                                                                                                                                                            either as textual strings or as URL (URI) links. See background
                                                                                                                                                            notes for more details. *} */
                
    public      $comment                    = null;                 /* {*property   $comment                    (Comment)                                   A comment on an item *} */


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
    }   /* End of DataFeedItem.__destruct() =========================================== */
    /* ================================================================================ */
}   /* End of class DataFeedItem ====================================================== */
/* ==================================================================================== */
?>