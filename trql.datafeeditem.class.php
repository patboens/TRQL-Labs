<?php
/****************************************************************************************/
/** {{{*fheader
    {*file                  trql.datafeeditem.class.php *}
    {*purpose               A single item within a larger data feed. *}
    {*author                {PYB} *}
    {*company               [br]Lato Sensu Management[br]
                            Rue Bois des Mazuis, 47[br]
                            5070 Vitrival[br]
                            Belgium[br]
                            [url]http://www.latosensu.be[/url][br]
                            Vae Soli! : [url]http://www.vaesoli.org[/url] *}
    {*cdate                 27-07-20 10:43 *}
    {*mdate                 auto *}
    {*license               Submitted to intellectual property rights (see
                            author) *}

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
namespace trql\datefeeditem;

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

    public  $dateCreated                = null;                     /* {*property   $dateCreated                (Date|DateTime)                             The date on which the CreativeWork was created or the item was
                                                                                                                                                            added to a DataFeed. *} */
    public  $dateDeleted                = null;                     /* {*property   $dateDeleted                (Date|DateTime)                             The datetime the item was removed from the DataFeed. *} */
    public  $dateModified               = null;                     /* {*property   $dateModified               (Date|DateTime)                             The date on which the CreativeWork was most recently modified or
                                                                                                                                                            when the item's entry was modified within a DataFeed. *} */
    public  $item                       = null;                     /* {*property   $item                       (Thing)                                     An entity represented by an entry in a list or data feed
                                                                                                                                                            (e.g. an 'artist' in a list of 'artists'). *} */

    /* -- [ Properties NOT found in schema.org ] ---------------- */
    public  $datePublication            = null;                     /* {*property   $datePublication            (Date|DateTime)                             The date the feed can be published *} */
    public  $identifier                 = null;                     /* {*property   $identifier                 (PropertyValue|string|URL)                  The identifier property represents any kind of identifier for any
                                                                                                                                                            kind of Thing, such as ISBNs, GTIN codes, UUIDs etc. Schema.org
                                                                                                                                                            provides dedicated properties for representing many of these,
                                                                                                                                                            either as textual strings or as URL (URI) links. See background
                                                                                                                                                            notes for more details. *} */

    public  $comment                    = null;                     /* {*property   $comment                    (Comment)                                   A comment on an item *} */


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
        $this->__die( __CLASS__ . ' SHOULD NOT BE USED. USE DataFeedItem DEFINED IN trql.rss.class.php' );

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
?>