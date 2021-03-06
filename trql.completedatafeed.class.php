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
    {*file                  trql.completedatafeed.class.php *}
    {*purpose               A CompleteDataFeed is a DataFeed whose standard
                            representation includes content for every item currently in
                            the feed.This is the equivalent of Atom's element as defined
                            in Feed Paging and Archiving RFC 5005, For example (and as
                            defined for Atom), when using data from a feed that
                            represents a collection of items that varies over time (e.g.
                            "Top Twenty Records") there is no need to have newer entries
                            mixed in alongside older, obsolete entries. By marking this
                            feed as a CompleteDataFeed, old entries can be safely
                            discarded when the feed is refreshed, since we can assume
                            the feed has provided descriptions for all current items. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:46 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:46 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    {*chist
        {*mdate 14-02-21 10:44 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */

/****************************************************************************************/
namespace trql\completedatafeed;

use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\datafeed\DataFeed     as DataFeed;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'DATAFEED_CLASS_VERSION' ) )
    require_once( 'trql.datafeed.class.php' );

defined( 'COMPLETEDATAFEED_CLASS_VERSION' ) or define( 'COMPLETEDATAFEED_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class CompleteDataFeed=

    {*desc

        A CompleteDataFeed is a DataFeed whose standard representation includes
        content for every item currently in the feed.This is the equivalent of
        Atom's element as defined in Feed Paging and Archiving RFC 5005, For
        example (and as defined for Atom), when using data from a feed that
        represents a collection of items that varies over time (e.g. "Top Twenty
        Records") there is no need to have newer entries mixed in alongside older,
        obsolete entries. By marking this feed as a CompleteDataFeed, old entries
        can be safely discarded when the feed is refreshed, since we can assume the
        feed has provided descriptions for all current items.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/CompleteDataFeed[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:46.
    *}

 */
/* ==================================================================================== */
class CompleteDataFeed extends DataFeed
/*-----------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $dataFeedElement                = null;             /* {*property   $dataFeedElement                (string|DataFeedItem|Thing)     An item within in a data feed. Data feeds may 
                                                                                                                                                    have many elements. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                        Wikidata ID. NOT CHECKED SO FAR (25-02-21 18:17:24). *} */


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
    }   /* End of CompleteDataFeed.__construct() ====================================== */
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
    }   /* End of CompleteDataFeed.__destruct() ======================================= */
    /* ================================================================================ */
}   /* End of class CompleteDataFeed ================================================== */
/* ==================================================================================== */
?>