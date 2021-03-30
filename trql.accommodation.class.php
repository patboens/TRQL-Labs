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
    {*file                  trql.accommodation.class.php *}
    {*purpose               An accommodation is a place that can accommodate human 
                            beings, e.g. a hotel room, a camping pitch, or a meeting 
                            room. Many accommodations are for overnight stays, but 
                            this is not a mandatory requirement.For more specific 
                            types of accommodations not defined in schema.org, one 
                            can use additionalType with external vocabularies. See 
                            also the dedicated document on the use of schema.org 
                            for marking up hotels and other forms of accommodations. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 08:24 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 08:24 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\accommodation;

use \trql\schema\Thing           as Thing;
use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\place\Place           as Place;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'PLACE_CLASS_VERSION' ) )
    require_once( 'trql.place.class.php' );

defined( 'ACCOMMODATION_CLASS_VERSION' ) or define( 'ACCOMMODATION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Accommodation=

    {*desc

        An accommodation is a place that can accommodate human beings, e.g. a hotel 
        room, a camping pitch, or a meeting room. Many accommodations are for overnight 
        stays, but this is not a mandatory requirement.For more specific types of 
        accommodations not defined in schema.org, one can use additionalType with 
        external vocabularies.See also the dedicated document on the use of schema.org 
        for marking up hotels and other forms of accommodations.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Accommodation[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 08:24.
    *}

 */
/* ==================================================================================== */
class Accommodation extends Place
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

    public      $accommodationCategory          = null;             /* {*property   $accommodationCategory          (string)                        Category of an Accommodation, following real estate conventions e.g.
                                                                                                                                                    RESO (see PropertySubType, and PropertyType fields for suggested
                                                                                                                                                    values). *} */
    public      $accommodationFloorPlan         = null;             /* {*property   $accommodationFloorPlan         (FloorPlan)                     A floorplan of some Accommodation. *} */
    public      $amenityFeature                 = null;             /* {*property   $amenityFeature                 (LocationFeatureSpecification)  An amenity feature (e.g. a characteristic or service) of the
                                                                                                                                                    Accommodation. This generic property does not make a statement about
                                                                                                                                                    whether the feature is included in an offer for the main accommodation
                                                                                                                                                    or available at extra costs. *} */
    public      $floorLevel                     = null;             /* {*property   $floorLevel                     (string)                        The floor level for an Accommodation in a multi-storey building. Since
                                                                                                                                                    counting systems vary internationally, the local system should be used
                                                                                                                                                    where possible. *} */
    public      $floorSize                      = null;             /* {*property   $floorSize                      (QuantitativeValue)             The size of the accommodation, e.g. in square meter or
                                                                                                                                                    squarefoot.Typical unit code(s): MTK for square meter, FTK for square
                                                                                                                                                    foot, or YDK for square yard *} */
    public      $leaseLength                    = null;             /* {*property   $leaseLength                    (QuantitativeValue|Duration)    Length of the lease for some Accommodation, either particular to some
                                                                                                                                                    Offer or in some cases intrinsic to the property. *} */
    public      $numberOfBathroomsTotal         = null;             /* {*property   $numberOfBathroomsTotal         (int)                           The total integer number of bathrooms in a some Accommodation,
                                                                                                                                                    following real estate conventions as documented in RESO: "The simple
                                                                                                                                                    sum of the number of bathrooms. For example for a property with two
                                                                                                                                                    Full Bathrooms and one Half Bathroom, the Bathrooms Total Integer will
                                                                                                                                                    be 3.". See also numberOfRooms. *} */
    public      $numberOfBedrooms               = null;             /* {*property   $numberOfBedrooms               (float|QuantitativeValue)       The total integer number of bedrooms in a some Accommodation,
                                                                                                                                                    ApartmentComplex or FloorPlan. *} */
    public      $numberOfFullBathrooms          = null;             /* {*property   $numberOfFullBathrooms          (float)                         Number of full bathrooms - The total number of full and ¾ bathrooms
                                                                                                                                                    in an Accommodation. This corresponds to the BathroomsFull field in
                                                                                                                                                    RESO. *} */
    public      $numberOfPartialBathrooms       = null;             /* {*property   $numberOfPartialBathrooms       (float)                         Number of partial bathrooms - The total number of half and ¼
                                                                                                                                                    bathrooms in an Accommodation. This corresponds to the
                                                                                                                                                    BathroomsPartial field in RESO. *} */
    public      $numberOfRooms                  = null;             /* {*property   $numberOfRooms                  (QuantitativeValue|float)       The number of rooms (excluding bathrooms and closets) of the
                                                                                                                                                    accommodation or lodging business.Typical unit code(s): ROM for room
                                                                                                                                                    or C62 for no unit. The type of room can be put in the unitText
                                                                                                                                                    property of the QuantitativeValue. *} */
    public      $permittedUsage                 = null;             /* {*property   $permittedUsage                 (string)                        Indications regarding the permitted usage of the accommodation. *} */
    public      $petsAllowed                    = null;             /* {*property   $petsAllowed                    (boolean|string)                Indicates whether pets are allowed to enter the accommodation or
                                                                                                                                                    lodging business. More detailed information can be put in a text
                                                                                                                                                    value. *} */
    public      $tourBookingPage                = null;             /* {*property   $tourBookingPage                (URL)                           A page providing information on how to book a tour of some Place, such
                                                                                                                                                    as an Accommodation or ApartmentComplex in a real estate setting, as
                                                                                                                                                    well as other kinds of tours as appropriate. *} */
    public      $yearBuilt                      = null;             /* {*property   $yearBuilt                      (float)                         The year an Accommodation was constructed. This corresponds to the
                                                                                                                                                    YearBuilt field in RESO. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q64576680';      /* {*property   $wikidataId                     (string)                        Wikidata ID. Place where someone can stay *} */


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
    }   /* End of Accommodation.__construct() ========================================= */
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
    }   /* End of Accommodation.__destruct() ========================================== */
    /* ================================================================================ */
}   /* End of class Accommodation ===================================================== */
/* ==================================================================================== */
?>