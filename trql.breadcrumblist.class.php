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
    {*file                  trql.breadcrumblist.class.php *}
    {*purpose               A BreadcrumbList is an ItemList consisting of a chain of 
                            linked Web pages, typically described using at least their 
                            URL and their name, and typically ending with the current 
                            page.The position property is used to reconstruct the order 
                            of the items in a BreadcrumbList The convention is that a 
                            breadcrumb list has an itemListOrder of ItemListOrderAscending 
                            (lower values listed first), and that the first items in this 
                            list correspond to the "top" or beginning of the breadcrumb
                            trail, e.g. with a site or section homepage. The specific
                            values of 'position' are not assigned meaning for a 
                            BreadcrumbList, but they should be integers, e.g. beginning
                            with '1' for the first item in the list. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 24-08-2020 12:35 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 24-08-2020 12:35 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\breadcrumblist;

use \trql\thing\Thing                       as Thing;
use \trql\vaesoli\Vaesoli                   as Vaesoli;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'ITEMLIST_CLASS_VERSION' ) )
    require_once( 'trql.itemlist.class.php' );



defined( 'BREADCRUMBLIST_CLASS_VERSION' ) or define( 'BREADCRUMBLIST_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class BreadcrumbList=

    {*desc

        A BreadcrumbList is an ItemList consisting of a chain of linked Web pages, 
        typically described using at least their URL and their name, and typically 
        ending with the current page.The position property is used to reconstruct 
        the order of the items in a BreadcrumbList The convention is that a 
        breadcrumb list has an itemListOrder of ItemListOrderAscending (lower values 
        listed first), and that the first items in this list correspond to the "top" 
        or beginning of the breadcrumb trail, e.g. with a site or section homepage. 
        The specific values of 'position' are not assigned meaning for a BreadcrumbList, 
        but they should be integers, e.g. beginning with '1' for the first item in the list.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/BreadcrumbList[/url] *}

 */
/* ==================================================================================== */
class BreadcrumbList extends ItemList
/*---------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );


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
    }   /* End of BreadcrumbList.__construct() ======================================== */
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
    }   /* End of BreadcrumbList.__destruct() ========================================= */
    /* ================================================================================ */

}   /* End of class BreadcrumbList ==================================================== */
/* ==================================================================================== */

?>