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
    {*file                  trql.lodgingreservation.class.php *}
    {*purpose               A reservation for lodging at a hotel, motel, inn, etc.Note:
                            This type is for information about actual reservations, e.g.
                            in confirmation emails or HTML pages with individual
                            confirmations of reservations. *}
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

    {*chist
        {*mdate 14-02-21 10:44 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */

/****************************************************************************************/
namespace trql\lodgingreservation;

use \trql\vaesoli\Vaesoli           as Vaesoli;
use \trql\reservation\Reservation   as Reservation;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'RESERVATION_CLASS_VERSION' ) )
    require_once( 'trql.reservation.class.php' );

defined( 'LODGINGRESERVATION_CLASS_VERSION' ) or define( 'LODGINGRESERVATION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class LodgingReservation=

    {*desc

        A reservation for lodging at a hotel, motel, inn, etc.Note: This type is
        for information about actual reservations, e.g. in confirmation emails or
        HTML pages with individual confirmations of reservations.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/LodgingReservation[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:49.
    *}

    *}}
 */
/* ==================================================================================== */
class LodgingReservation extends Reservation
/*----------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $checkinTime                    = null;             /* {*property   $checkinTime                    (Time|DateTime)                 The earliest someone may check into a lodging establishment. *} */
    public      $checkoutTime                   = null;             /* {*property   $checkoutTime                   (Time|DateTime)                 The latest someone may check out of a lodging establishment. *} */
    public      $lodgingUnitDescription         = null;             /* {*property   $lodgingUnitDescription         (string)                        A full description of the lodging unit. *} */
    public      $lodgingUnitType                = null;             /* {*property   $lodgingUnitType                (string|QualitativeValue)       Textual description of the unit type (including suite vs. room, size
                                                                                                                                                    of bed, etc.). *} */
    public      $numAdults                      = null;             /* {*property   $numAdults                      (QuantitativeValue|int)         The number of adults staying in the unit. *} */
    public      $numChildren                    = null;             /* {*property   $numChildren                    (int|QuantitativeValue)         The number of children staying in the unit. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                        Wikidata ID. NO SEARCH YET. *} */


    /* ================================================================================ */
    /** {{*__construct( [$szHome] )=

        Class constructor

        {*params
            $szHome     (string)        Home of the class. Optional.
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*keywords constructors, destructors *}

        {*seealso @fnc.__destruct *}
        *}}
    */
    /* ================================================================================ */
    public function __construct( $szHome = null )
    /*-----------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        return ( $this );
    }   /* End of LodgingReservation.__construct() ==================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return
        *}

        {*keywords constructors, destructors *}

        {*seealso @fnc.__construct *}

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
    }   /* End of LodgingReservation.__destruct() ===================================== */
    /* ================================================================================ */
}   /* End of class LodgingReservation ================================================ */
/* ==================================================================================== */