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
    {*file                  trql.hotelroom.class.php *}
    {*purpose               A hotel room is a single room in a hotel.See also the
                            dedicated document on the use of schema.org for marking up
                            hotels and other forms of accommodations. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:49 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

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

    {*chist
        {*mdate 14-02-21 10:44 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */

/****************************************************************************************/
namespace trql\hotelroom;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\room\Room    as Room;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'ROOM_CLASS_VERSION' ) )
    require_once( 'trql.room.class.php' );

defined( 'HOTELROOM_CLASS_VERSION' ) or define( 'HOTELROOM_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class HotelRoom=

    {*desc

        A hotel room is a single room in a hotel.See also the dedicated document on
        the use of schema.org for marking up hotels and other forms of
        accommodations.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/HotelRoom[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:49.
    *}

    {*todo
        Search if there is any WikidataId corresponding to this class
        (use the [c]wikidata[/c] method, which does not do anything at 
        the moment)
    *}

    *}}

 */
/* ==================================================================================== */
class HotelRoom extends Room
/*--------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $bed                            = null;             /* {*property   $bed                            (string|BedDetails|BedType)     The type of bed or beds included in the accommodation. For the single
                                                                                                                                                    case of just one bed of a certain type, you use bed directly with a
                                                                                                                                                    text. If you want to indicate the quantity of a certain kind of bed,
                                                                                                                                                    use an instance of BedDetails. For more detailed information, use the
                                                                                                                                                    amenityFeature property. *} */
    public      $occupancy                      = null;             /* {*property   $occupancy                      (QuantitativeValue)             The allowed total occupancy for the accommodation in persons
                                                                                                                                                    (including infants etc). For individual accommodations, this is not
                                                                                                                                                    necessarily the legal maximum but defines the permitted usage as per
                                                                                                                                                    the contractual agreement (e.g. a double room used by a single
                                                                                                                                                    person).Typical unit code(s): C62 for person *} */

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
    }   /* End of HotelRoom.__construct() ============================================= */
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
    }   /* End of HotelRoom.__destruct() ============================================== */
    /* ================================================================================ */
}   /* End of class HotelRoom ========================================================= */
/* ==================================================================================== */
?>