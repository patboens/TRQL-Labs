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
    {*file                  trql.offercatalog.class.php *}
    {*purpose               An OfferCatalog is an ItemList that contains related Offers
                            and/or further OfferCatalogs that are offeredBy the same
                            provider. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 21:42 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 21:42 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\offercatalog;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\itemlist\ItemList                 as ItemList;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'ITEMLIST_CLASS_VERSION' ) )
    require_once( 'trql.itemlist.class.php' );



defined( 'OFFERCATALOG_CLASS_VERSION' ) or define( 'OFFERCATALOG_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class OfferCatalog=

    {*desc

        An OfferCatalog is an ItemList that contains related Offers and/or further
        OfferCatalogs that are offeredBy the same provider.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/OfferCatalog[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 21:42.
    *}

 */
/* ==================================================================================== */
class OfferCatalog extends ItemList
/*-------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $itemListElement                = null;             /* {*property   $itemListElement                (Thing|string|ListItem)         For itemListElement values, you can use simple strings (e.g. "Peter",
                                                                                                                                                    "Paul", "Mary"), existing entities, or use ListItem. Text values are
                                                                                                                                                    best if the elements in the list are plain strings. Existing entities
                                                                                                                                                    are best for a simple, unordered list of existing things in your data.
                                                                                                                                                    ListItem is used with ordered lists when you want to provide
                                                                                                                                                    additional context about the element in that list or when the same
                                                                                                                                                    item might be in different places in different lists. Note: The order
                                                                                                                                                    of elements in your mark-up is not sufficient for indicating the order
                                                                                                                                                    or elements. Use ListItem with a 'position' property in such cases. *} */
    public      $itemListOrder                  = null;             /* {*property   $itemListOrder                  (ItemListOrderType|string)      Type of ordering (e.g. Ascending, Descending, Unordered). *} */
    public      $numberOfItems                  = null;             /* {*property   $numberOfItems                  (int)                           The number of items in an ItemList. Note that some descriptions might
                                                                                                                                                    not fully describe all items in a list (e.g., multi-page pagination);
                                                                                                                                                    in such cases, the numberOfItems would be for the entire list. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                        wikidataId. No equivalent (05-01-21 10:00:43) *} */


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
    }   /* End of OfferCatalog.__construct() ========================================== */
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
    }   /* End of OfferCatalog.__destruct() =========================================== */
    /* ================================================================================ */

}   /* End of class OfferCatalog ====================================================== */
/* ==================================================================================== */

?>