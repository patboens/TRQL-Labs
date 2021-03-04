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
    {*file                  trql.vehicle.class.php *}
    {*purpose               A vehicle is a device that is designed or used to transport
                            people or cargo over land, water, air, or through space. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:41 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 28-08-2020 16:41 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\vehicle;

use \trql\vaesoli\Vaesoli   as Vaesoli;
use \trql\product\Product   as Product;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'PRODUCT_CLASS_VERSION' ) )
    require_once( 'trql.product.class.php' );

defined( 'VEHICLE_CLASS_VERSION' ) or define( 'VEHICLE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Vehicle=

    {*desc

        A vehicle is a device that is designed or used to transport people or cargo
        over land, water, air, or through space.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Vehicle[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:41.
    *}

    *}}

 */
/* ==================================================================================== */
class Vehicle extends Product
/*-------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $accelerationTime               = null;             /* {*property   $accelerationTime               (QuantitativeValue)             The time needed to accelerate the vehicle from a given start velocity
                                                                                                                                                    to a given target velocity.Typical unit code(s): SEC for secondsNote:
                                                                                                                                                    There are unfortunately no standard unit codes for seconds/0..100 km/h
                                                                                                                                                    or seconds/0..60 mph. Simply use "SEC" for seconds and indicate the
                                                                                                                                                    velocities in the name of the QuantitativeValue, or use valueReference
                                                                                                                                                    with a QuantitativeValue of 0..60 mph or 0..100 km/h to specify the
                                                                                                                                                    reference speeds. *} */
    public      $bodyType                       = null;             /* {*property   $bodyType                       (string|URL|QualitativeValue)   Indicates the design and body style of the vehicle (e.g. station
                                                                                                                                                    wagon, hatchback, etc.). *} */
    public      $callSign                       = null;             /* {*property   $callSign                       (string)                        A callsign, as used in broadcasting and radio communications to
                                                                                                                                                    identify people, radio and TV stations, or vehicles. *} */
    public      $cargoVolume                    = null;             /* {*property   $cargoVolume                    (QuantitativeValue)             The available volume for cargo or luggage. For automobiles, this is
                                                                                                                                                    usually the trunk volume.Typical unit code(s): LTR for liters, FTQ for
                                                                                                                                                    cubic foot/feetNote: You can use minValue and maxValue to indicate
                                                                                                                                                    ranges. *} */
    public      $dateVehicleFirstRegistered     = null;             /* {*property   $dateVehicleFirstRegistered     (Date)                          The date of the first registration of the vehicle with the respective
                                                                                                                                                    public authorities. *} */
    public      $driveWheelConfiguration        = null;             /* {*property   $driveWheelConfiguration        (string|DriveWheelConfigurationValue)The drive wheel configuration, i.e. which roadwheels will receive
                                                                                                                                                    torque from the vehicle's engine via the drivetrain. *} */
    public      $emissionsCO2                   = null;             /* {*property   $emissionsCO2                   (float)                         The CO2 emissions in g/km. When used in combination with a
                                                                                                                                                    QuantitativeValue, put "g/km" into the unitText property of that
                                                                                                                                                    value, since there is no UN/CEFACT Common Code for "g/km". *} */
    public      $fuelCapacity                   = null;             /* {*property   $fuelCapacity                   (QuantitativeValue)             The capacity of the fuel tank or in the case of electric cars, the
                                                                                                                                                    battery. If there are multiple components for storage, this should
                                                                                                                                                    indicate the total of all storage of the same type.Typical unit
                                                                                                                                                    code(s): LTR for liters, GLL of US gallons, GLI for UK / imperial
                                                                                                                                                    gallons, AMH for ampere-hours (for electrical vehicles). *} */
    public      $fuelConsumption                = null;             /* {*property   $fuelConsumption                (QuantitativeValue)             The amount of fuel consumed for traveling a particular distance or
                                                                                                                                                    temporal duration with the given vehicle (e.g. liters per 100 km).Note
                                                                                                                                                    1: There are unfortunately no standard unit codes for liters per 100
                                                                                                                                                    km. Use unitText to indicate the unit of measurement, e.g. L/100
                                                                                                                                                    km.Note 2: There are two ways of indicating the fuel consumption,
                                                                                                                                                    fuelConsumption (e.g. 8 liters per 100 km) and fuelEfficiency (e.g. 30
                                                                                                                                                    miles per gallon). They are reciprocal.Note 3: Often, the absolute
                                                                                                                                                    value is useful only when related to driving speed ("at 80 km/h") or
                                                                                                                                                    usage pattern ("city traffic"). You can use valueReference to link the
                                                                                                                                                    value for the fuel consumption to another value. *} */
    public      $fuelEfficiency                 = null;             /* {*property   $fuelEfficiency                 (QuantitativeValue)             The distance traveled per unit of fuel used; most commonly miles per
                                                                                                                                                    gallon (mpg) or kilometers per liter (km/L).Note 1: There are
                                                                                                                                                    unfortunately no standard unit codes for miles per gallon or
                                                                                                                                                    kilometers per liter. Use unitText to indicate the unit of
                                                                                                                                                    measurement, e.g. mpg or km/L.Note 2: There are two ways of indicating
                                                                                                                                                    the fuel consumption, fuelConsumption (e.g. 8 liters per 100 km) and
                                                                                                                                                    fuelEfficiency (e.g. 30 miles per gallon). They are reciprocal.Note 3:
                                                                                                                                                    Often, the absolute value is useful only when related to driving speed
                                                                                                                                                    ("at 80 km/h") or usage pattern ("city traffic"). You can use
                                                                                                                                                    valueReference to link the value for the fuel economy to another
                                                                                                                                                    value. *} */
    public      $fuelType                       = null;             /* {*property   $fuelType                       (URL|QualitativeValue|string)   The type of fuel suitable for the engine or engines of the vehicle. If
                                                                                                                                                    the vehicle has only one engine, this property can be attached
                                                                                                                                                    directly to the vehicle. *} */
    public      $knownVehicleDamages            = null;             /* {*property   $knownVehicleDamages            (string)                        A textual description of known damages, both repaired and unrepaired. *} */
    public      $meetsEmissionStandard          = null;             /* {*property   $meetsEmissionStandard          (URL|string|QualitativeValue)   Indicates that the vehicle meets the respective emission standard. *} */
    public      $mileageFromOdometer            = null;             /* {*property   $mileageFromOdometer            (QuantitativeValue)             The total distance travelled by the particular vehicle since its
                                                                                                                                                    initial production, as read from its odometer.Typical unit code(s):
                                                                                                                                                    KMT for kilometers, SMI for statute miles *} */
    public      $modelDate                      = null;             /* {*property   $modelDate                      (Date)                          The release date of a vehicle model (often used to differentiate
                                                                                                                                                    versions of the same make and model). *} */
    public      $numberOfAirbags                = null;             /* {*property   $numberOfAirbags                (float|string)                  The number or type of airbags in the vehicle. *} */
    public      $numberOfAxles                  = null;             /* {*property   $numberOfAxles                  (float|QuantitativeValue)       The number of axles.Typical unit code(s): C62 *} */
    public      $numberOfDoors                  = null;             /* {*property   $numberOfDoors                  (QuantitativeValue|float)       The number of doors.Typical unit code(s): C62 *} */
    public      $numberOfForwardGears           = null;             /* {*property   $numberOfForwardGears           (float|QuantitativeValue)       The total number of forward gears available for the transmission
                                                                                                                                                    system of the vehicle.Typical unit code(s): C62 *} */
    public      $numberOfPreviousOwners         = null;             /* {*property   $numberOfPreviousOwners         (QuantitativeValue|float)       The number of owners of the vehicle, including the current one.Typical
                                                                                                                                                    unit code(s): C62 *} */
    public      $payload                        = null;             /* {*property   $payload                        (QuantitativeValue)             The permitted weight of passengers and cargo, EXCLUDING the weight of
                                                                                                                                                    the empty vehicle.Typical unit code(s): KGM for kilogram, LBR for
                                                                                                                                                    poundNote 1: Many databases specify the permitted TOTAL weight
                                                                                                                                                    instead, which is the sum of weight and payloadNote 2: You can
                                                                                                                                                    indicate additional information in the name of the QuantitativeValue
                                                                                                                                                    node.Note 3: You may also link to a QualitativeValue node that
                                                                                                                                                    provides additional information using valueReference.Note 4: Note that
                                                                                                                                                    you can use minValue and maxValue to indicate ranges. *} */
    public      $productionDate                 = null;             /* {*property   $productionDate                 (Date)                          The date of production of the item, e.g. vehicle. *} */
    public      $purchaseDate                   = null;             /* {*property   $purchaseDate                   (Date)                          The date the item e.g. vehicle was purchased by the current owner. *} */
    public      $seatingCapacity                = null;             /* {*property   $seatingCapacity                (float|QuantitativeValue)       The number of persons that can be seated (e.g. in a vehicle), both in
                                                                                                                                                    terms of the physical space available, and in terms of limitations set
                                                                                                                                                    by law.Typical unit code(s): C62 for persons *} */
    public      $speed                          = null;             /* {*property   $speed                          (QuantitativeValue)             The speed range of the vehicle. If the vehicle is powered by an
                                                                                                                                                    engine, the upper limit of the speed range (indicated by maxValue
                                                                                                                                                    should be the maximum speed achievable under regular
                                                                                                                                                    conditions.Typical unit code(s): KMH for km/h, HM for mile per hour
                                                                                                                                                    (0.447 04 m/s), KNT for knot*Note 1: Use minValue and maxValue to
                                                                                                                                                    indicate the range. Typically, the minimal value is zero.* Note 2:
                                                                                                                                                    There are many different ways of measuring the speed range. You can
                                                                                                                                                    link to information about how the given value has been determined
                                                                                                                                                    using the valueReference property. *} */
    public      $steeringPosition               = null;             /* {*property   $steeringPosition               (SteeringPositionValue)         The position of the steering wheel or similar device (mostly for
                                                                                                                                                    cars). *} */
    public      $tongueWeight                   = null;             /* {*property   $tongueWeight                   (QuantitativeValue)             The permitted vertical load (TWR) of a trailer attached to the
                                                                                                                                                    vehicle. Also referred to as Tongue Load Rating (TLR) or Vertical Load
                                                                                                                                                    Rating (VLR)Typical unit code(s): KGM for kilogram, LBR for poundNote
                                                                                                                                                    1: You can indicate additional information in the name of the
                                                                                                                                                    QuantitativeValue node.Note 2: You may also link to a QualitativeValue
                                                                                                                                                    node that provides additional information using valueReference.Note 3:
                                                                                                                                                    Note that you can use minValue and maxValue to indicate ranges. *} */
    public      $trailerWeight                  = null;             /* {*property   $trailerWeight                  (QuantitativeValue)             The permitted weight of a trailer attached to the vehicle.Typical unit
                                                                                                                                                    code(s): KGM for kilogram, LBR for pound* Note 1: You can indicate
                                                                                                                                                    additional information in the name of the QuantitativeValue node.*
                                                                                                                                                    Note 2: You may also link to a QualitativeValue node that provides
                                                                                                                                                    additional information using valueReference.* Note 3: Note that you
                                                                                                                                                    can use minValue and maxValue to indicate ranges. *} */
    public      $vehicleConfiguration           = null;             /* {*property   $vehicleConfiguration           (string)                        A short text indicating the configuration of the vehicle, e.g. '5dr
                                                                                                                                                    hatchback ST 2.5 MT 225 hp' or 'limited edition'. *} */
    public      $vehicleEngine                  = null;             /* {*property   $vehicleEngine                  (EngineSpecification)           Information about the engine or engines of the vehicle. *} */
    public      $vehicleIdentificationNumber    = null;             /* {*property   $vehicleIdentificationNumber    (string)                        The Vehicle Identification Number (VIN) is a unique serial number used
                                                                                                                                                    by the automotive industry to identify individual motor vehicles. *} */
    public      $vehicleInteriorColor           = null;             /* {*property   $vehicleInteriorColor           (string)                        The color or color combination of the interior of the vehicle. *} */
    public      $vehicleInteriorType            = null;             /* {*property   $vehicleInteriorType            (string)                        The type or material of the interior of the vehicle (e.g. synthetic
                                                                                                                                                    fabric, leather, wood, etc.). While most interior types are
                                                                                                                                                    characterized by the material used, an interior type can also be based
                                                                                                                                                    on vehicle usage or target audience. *} */
    public      $vehicleModelDate               = null;             /* {*property   $vehicleModelDate               (Date)                          The release date of a vehicle model (often used to differentiate
                                                                                                                                                    versions of the same make and model). *} */
    public      $vehicleSeatingCapacity         = null;             /* {*property   $vehicleSeatingCapacity         (QuantitativeValue|float)       The number of passengers that can be seated in the vehicle, both in
                                                                                                                                                    terms of the physical space available, and in terms of limitations set
                                                                                                                                                    by law.Typical unit code(s): C62 for persons. *} */
    public      $vehicleSpecialUsage            = null;             /* {*property   $vehicleSpecialUsage            (string|CarUsageType)           Indicates whether the vehicle has been used for special purposes, like
                                                                                                                                                    commercial rental, driving school, or as a taxi. The legislation in
                                                                                                                                                    many countries requires this information to be revealed when offering
                                                                                                                                                    a car for sale. *} */
    public      $vehicleTransmission            = null;             /* {*property   $vehicleTransmission            (QualitativeValue|URL|string)   The type of component used for transmitting the power from a rotating
                                                                                                                                                    power source to the wheels or other relevant component(s) ("gearbox"
                                                                                                                                                    for cars). *} */
    public      $weightTotal                    = null;             /* {*property   $weightTotal                    (QuantitativeValue)             The permitted total weight of the loaded vehicle, including passengers
                                                                                                                                                    and cargo and the weight of the empty vehicle.Typical unit code(s):
                                                                                                                                                    KGM for kilogram, LBR for poundNote 1: You can indicate additional
                                                                                                                                                    information in the name of the QuantitativeValue node.Note 2: You may
                                                                                                                                                    also link to a QualitativeValue node that provides additional
                                                                                                                                                    information using valueReference.Note 3: Note that you can use
                                                                                                                                                    minValue and maxValue to indicate ranges. *} */
    public      $wheelbase                      = null;             /* {*property   $wheelbase                      (QuantitativeValue)             The distance between the centers of the front and rear wheels.Typical
                                                                                                                                                    unit code(s): CMT for centimeters, MTR for meters, INH for inches, FOT
                                                                                                                                                    for foot/feet *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q42889';         /* {*property   $wikidataId                     (string)                        Wikidata ID. Mobile machine that transports people, animals or cargo *} */


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
    }   /* End of Vehicle.__construct() =============================================== */
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
    }   /* End of Vehicle.__destruct() ================================================ */
    /* ================================================================================ */
}   /* End of class Vehicle =========================================================== */
/* ==================================================================================== */
?>