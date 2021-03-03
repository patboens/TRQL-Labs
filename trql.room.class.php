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
    {*file                  trql.room.class.php *}
    {*purpose               A room is a distinguishable space within a structure,
                            usually separated from other spaces by interior walls.
                            (Source: Wikipedia, the free encyclopedia, see
                            http://en.wikipedia.org/wiki/Room).See also the dedicated
                            document on the use of schema.org for marking up hotels and
                            other forms of accommodations. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:30 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 28-08-2020 16:30 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\room;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\accommodation\Accommodation       as Accommodation;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'ACCOMMODATION_CLASS_VERSION' ) )
    require_once( 'trql.accommodation.class.php' );

defined( 'ROOM_CLASS_VERSION' ) or define( 'ROOM_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Room=

    {*desc

        A room is a distinguishable space within a structure, usually separated
        from other spaces by interior walls. (Source: Wikipedia, the free
        encyclopedia, see http://en.wikipedia.org/wiki/Room).See also the dedicated
        document on the use of schema.org for marking up hotels and other forms of
        accommodations.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Room[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:30.
    *}

    {*todo
        Search if there is any WikidataId corresponding to this class
        (use the [c]wikidata[/c] method, which does not do anything at 
        the moment)
    *}

    *}}

 */
/* ==================================================================================== */
class Room extends Accommodation
/*----------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                        Wikidata ID. NO SEARCH. *} */


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
    }   /* End of Room.__construct() ================================================== */
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
    }   /* End of Room.__destruct() =================================================== */
    /* ================================================================================ */
}   /* End of class Room ============================================================== */
/* ==================================================================================== */
?>