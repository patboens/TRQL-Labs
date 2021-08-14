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
    {*file                  trql.listitem.class.php *}
    {*purpose               An list item, e.g. a step in a checklist or how-to
                            description. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:49 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:49 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\listitem;

use \trql\vaesoli\Vaesoli           as Vaesoli;
use \trql\schema\Intangible     as Intangible;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'INTANGIBLE_CLASS_VERSION' ) )
    require_once( 'trql.intangible.class.php' );



defined( 'LISTITEM_CLASS_VERSION' ) or define( 'LISTITEM_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class ListItem=

    {*desc

        An list item, e.g. a step in a checklist or how-to description.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/ListItem[/url] *}

    {*warning
        
        This class has been generated automatically by
        [c]trql.schemaclassgenerator.class.php[/c] on 26-08-2020 18:49.

    *}

 */
/* ==================================================================================== */
class ListItem extends Intangible
/*------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $item                           = null;             /* {*property   $item                           (Thing)                         An entity represented by an entry in a list or data feed (e.g. an
                                                                                                                                                    'artist' in a list of 'artists')’. *} */
    public      $nextItem                       = null;             /* {*property   $nextItem                       (ListItem)                      A link to the ListItem that follows the current one. *} */
    public      $position                       = null;             /* {*property   $position                       (string|int)                    The position of an item in a series or sequence of items. *} */
    public      $previousItem                   = null;             /* {*property   $previousItem                   (ListItem)                      A link to the ListItem that preceeds the current one. *} */


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
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );


        return ( $this );
    }   /* End of ListItem.__construct() ============================================== */
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
    }   /* End of ListItem.__destruct() =============================================== */
    /* ================================================================================ */

}   /* End of class ListItem ========================================================== */
/* ==================================================================================== */

?>