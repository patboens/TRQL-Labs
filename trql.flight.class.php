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
    {*file                  trql.flight.class.php *}
    {*purpose               An airline flight. *}
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

    {*chist
        {*mdate 14-02-21 10:44 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */

/****************************************************************************************/
namespace trql\flight;

use \trql\vaesoli\Vaesoli   as Vaesoli;
use \trql\trip\Trip         as Trip;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'TRIP_CLASS_VERSION' ) )
    require_once( 'trql.trip.class.php' );

defined( 'FLIGHT_CLASS_VERSION' ) or define( 'FLIGHT_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Flight=

    {*desc

        An airline flight.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Flight[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:48.
    *}

    *}}
 */
/* ==================================================================================== */
class Flight extends Trip
/*---------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $aircraft                       = null;             /* {*property   $aircraft                       (string|Vehicle)                The kind of aircraft (e.g., "Boeing 747"). *} */
    public      $arrivalAirport                 = null;             /* {*property   $arrivalAirport                 (Airport)                       The airport where the flight terminates. *} */
    public      $arrivalGate                    = null;             /* {*property   $arrivalGate                    (string)                        Identifier of the flight's arrival gate. *} */
    public      $arrivalTerminal                = null;             /* {*property   $arrivalTerminal                (string)                        Identifier of the flight's arrival terminal. *} */
    public      $boardingPolicy                 = null;             /* {*property   $boardingPolicy                 (BoardingPolicyType)            The type of boarding policy used by the airline (e.g. zone-based or
                                                                                                                                                    group-based). *} */
    public      $departureAirport               = null;             /* {*property   $departureAirport               (Airport)                       The airport where the flight originates. *} */
    public      $departureGate                  = null;             /* {*property   $departureGate                  (string)                        Identifier of the flight's departure gate. *} */
    public      $departureTerminal              = null;             /* {*property   $departureTerminal              (string)                        Identifier of the flight's departure terminal. *} */
    public      $estimatedFlightDuration        = null;             /* {*property   $estimatedFlightDuration        (Duration|string)               The estimated time the flight will take. *} */
    public      $flightDistance                 = null;             /* {*property   $flightDistance                 (string|Distance)               The distance of the flight. *} */
    public      $flightNumber                   = null;             /* {*property   $flightNumber                   (string)                        The unique identifier for a flight including the airline IATA code.
                                                                                                                                                    For example, if describing United flight 110, where the IATA code for
                                                                                                                                                    United is 'UA', the flightNumber is 'UA110'. *} */
    public      $mealService                    = null;             /* {*property   $mealService                    (string)                        Description of the meals that will be provided or available for
                                                                                                                                                    purchase. *} */
    public      $seller                         = null;             /* {*property   $seller                         (Person|Organization)           An entity which offers (sells / leases / lends / loans) the services /
                                                                                                                                                    goods. A seller may also be a provider. *} */
    public      $webCheckinTime                 = null;             /* {*property   $webCheckinTime                 (DateTime)                      The time when a passenger can check into the flight online. *} */


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
    }   /* End of Flight.__construct() ================================================ */
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
    }   /* End of Flight.__destruct() ================================================= */
    /* ================================================================================ */
}   /* End of class Flight ============================================================ */
/* ==================================================================================== */
