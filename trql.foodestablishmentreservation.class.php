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
    {*file                  trql.foodestablishmentreservation.class.php *}
    {*purpose               A reservation to dine at a food-related business.Note: This
                            type is for information about actual reservations, e.g. in
                            confirmation emails or HTML pages with individual
                            confirmations of reservations. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:48 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:48 *}
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
namespace trql\foodestablishmentreservation;

use \trql\vaesoli\Vaesoli           as Vaesoli;
use \trql\reservation\Reservation   as Reservation;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'RESERVATION_CLASS_VERSION' ) )
    require_once( 'trql.reservation.class.php' );

defined( 'FOODESTABLISHMENTRESERVATION_CLASS_VERSION' ) or define( 'FOODESTABLISHMENTRESERVATION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class FoodEstablishmentReservation=

    {*desc

        A reservation to dine at a food-related business.Note: This type is for
        information about actual reservations, e.g. in confirmation emails or HTML
        pages with individual confirmations of reservations.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/FoodEstablishmentReservation[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:48.
    *}

    *}}

 */
/* ==================================================================================== */
class FoodEstablishmentReservation extends Reservation
/*--------------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $endTime                        = null;             /* {*property   $endTime                        (DateTime|Time)                 The endTime of something. For a reserved event or service (e.g.
                                                                                                                                                    FoodEstablishmentReservation), the time that it is expected to end.
                                                                                                                                                    For actions that span a period of time, when the action was performed.
                                                                                                                                                    e.g. John wrote a book from January to December. For media, including
                                                                                                                                                    audio and video, it's the time offset of the end of a clip within a
                                                                                                                                                    larger file.Note that Event uses startDate/endDate instead of
                                                                                                                                                    startTime/endTime, even when describing dates with times. This
                                                                                                                                                    situation may be clarified in future revisions. *} */
    public      $partySize                      = null;             /* {*property   $partySize                      (int|QuantitativeValue)         Number of people the reservation should accommodate. *} */
    public      $startTime                      = null;             /* {*property   $startTime                      (DateTime|Time)                 The startTime of something. For a reserved event or service (e.g.
                                                                                                                                                    FoodEstablishmentReservation), the time that it is expected to start.
                                                                                                                                                    For actions that span a period of time, when the action was performed.
                                                                                                                                                    e.g. John wrote a book from January to December. For media, including
                                                                                                                                                    audio and video, it's the time offset of the start of a clip within a
                                                                                                                                                    larger file.Note that Event uses startDate/endDate instead of
                                                                                                                                                    startTime/endTime, even when describing dates with times. This
                                                                                                                                                    situation may be clarified in future revisions. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                        Wikidata ID. NO SEARCH YET *} */


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
    }   /* End of FoodEstablishmentReservation.__construct() ========================== */
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
    }   /* End of FoodEstablishmentReservation.__destruct() =========================== */
    /* ================================================================================ */
}   /* End of class FoodEstablishmentReservation ====================================== */
/* ==================================================================================== */