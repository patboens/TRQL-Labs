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
    {*file                  trql.floorplan.class.php *}
    {*purpose               A FloorPlan is an explicit representation of a collection of
                            similar accommodations, allowing the provision of common
                            information (room counts, sizes, layout diagrams) and offers
                            for rental or sale. In typical use, some ApartmentComplex
                            has an accommodationFloorPlan which is a FloorPlan. A
                            FloorPlan is always in the context of a particular place,
                            either a larger ApartmentComplex or a single Apartment. The
                            visual/spatial aspects of a floor plan (i.e. room layout,
                            see wikipedia) can be indicated using image. *}
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
namespace trql\floorplan;

use \trql\vaesoli\Vaesoli           as Vaesoli;
use \trql\schema\Intangible     as Intangible;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'INTANGIBLE_CLASS_VERSION' ) )
    require_once( 'trql.intangible.class.php' );

defined( 'FLOORPLAN_CLASS_VERSION' ) or define( 'FLOORPLAN_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class FloorPlan=

    {*desc

        A FloorPlan is an explicit representation of a collection of similar
        accommodations, allowing the provision of common information (room counts,
        sizes, layout diagrams) and offers for rental or sale. In typical use, some
        ApartmentComplex has an accommodationFloorPlan which is a FloorPlan. A
        FloorPlan is always in the context of a particular place, either a larger
        ApartmentComplex or a single Apartment. The visual/spatial aspects of a
        floor plan (i.e. room layout, see wikipedia) can be indicated using image.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/FloorPlan[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:48.
    *}

    *}}

 */
/* ==================================================================================== */
class FloorPlan extends Intangible
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

    public      $amenityFeature                 = null;             /* {*property   $amenityFeature                 (LocationFeatureSpecification)  An amenity feature (e.g. a characteristic or service) of the
                                                                                                                                                    Accommodation. This generic property does not make a statement about
                                                                                                                                                    whether the feature is included in an offer for the main accommodation
                                                                                                                                                    or available at extra costs. *} */
    public      $floorSize                      = null;             /* {*property   $floorSize                      (QuantitativeValue)             The size of the accommodation, e.g. in square meter or
                                                                                                                                                    squarefoot.Typical unit code(s): MTK for square meter, FTK for square
                                                                                                                                                    foot, or YDK for square yard *} */
    public      $isPlanForApartment             = null;             /* {*property   $isPlanForApartment             (Accommodation)                 Indicates some accommodation that this floor plan describes. *} */
    public      $layoutImage                    = null;             /* {*property   $layoutImage                    (ImageObject|URL)               A schematic image showing the floorplan layout. *} */
    public      $numberOfAccommodationUnits     = null;             /* {*property   $numberOfAccommodationUnits     (QuantitativeValue)             Indicates the total (available plus unavailable) number of
                                                                                                                                                    accommodation units in an ApartmentComplex, or the number of
                                                                                                                                                    accommodation units for a specific FloorPlan (within its specific
                                                                                                                                                    ApartmentComplex). See also numberOfAvailableAccommodationUnits. *} */
    public      $numberOfAvailableAccommodationUnits = null;        /* {*property   $numberOfAvailableAccommodationUnits    (QuantitativeValue)     Indicates the number of available accommodation units in an
                                                                                                                                                    ApartmentComplex, or the number of accommodation units for a specific
                                                                                                                                                    FloorPlan (within its specific ApartmentComplex). See also
                                                                                                                                                    numberOfAccommodationUnits. *} */
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
    public      $petsAllowed                    = null;             /* {*property   $petsAllowed                    (boolean|string)                Indicates whether pets are allowed to enter the accommodation or
                                                                                                                                                    lodging business. More detailed information can be put in a text
                                                                                                                                                    value. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId     (string)                                        Wikidata ID. NOT CHECKED SO FAR *} */


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
    }   /* End of FloorPlan.__construct() ============================================= */
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
    }   /* End of FloorPlan.__destruct() ============================================== */
    /* ================================================================================ */
}   /* End of class FloorPlan ========================================================= */
/* ==================================================================================== */
