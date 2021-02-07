<?php
/****************************************************************************************/
/** {{{*fheader
    {*file                  trql.place.class.php *}
    {*purpose               Entities that have a somewhat fixed, physical extension. *}
    {*author                {PYB} *}
    {*company               [br]Lato Sensu Management[br]
                            Rue Bois des Mazuis, 47[br]
                            5070 Vitrival[br]
                            Belgium[br]
                            [url]http://www.latosensu.be[/url][br]
                            Vae Soli! : [url]http://www.vaesoli.org[/url] *}
    {*cdate                 29-07-20 11:47 *}
    {*mdate                 auto *}
    {*license               All rights reserved to Lato Sensu Management
                            for all countries. All Intellectual Property
                            belongs to Patrick Boens. *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 29-07-20 11:47 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\place;

use \trql\mother\Mother                 as Mother;
use \trql\mother\iContext               as iContext;
use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\thing\Thing                   as Thing;
use \trql\geocoordinates\GeoCoordinates as GeoCoordinates;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'THING_CLASS_VERSION' ) )
    require_once( 'trql.thing.class.php' );

if ( ! defined( 'GEOCOORDINATES_CLASS_VERSION' ) )
    require_once( 'trql.geocoordinates.class.php' );

defined( 'PLACE_CLASS_VERSION' ) or define( 'PLACE_CLASS_VERSION','0.1' );

/* Note (16-07-20 23:27:50):

    Le code doit se sauver lui-même dans une sorte de DB. Il doit se compresser
    lui-même et sauver au moins une dizaine de versions de lui-même.

*/

/* ================================================================================== */
/** {{*class Place=

    {*desc

        Entities that have a somewhat fixed, physical extension.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/Place[/url] *}

    *}}
 */
/* ================================================================================== */
class Place extends Thing implements iContext
/*-----------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $additionalProperty                  = null;        /* {*property   $additionalProperty                 (PropertyValue)                             A property-value pair representing an additional characteristics of the entitity,
                                                                                                                                                                    e.g. a product feature or another characteristic for which there is no matching 
                                                                                                                                                                    property in schema.org.
                                                                                                                        
                                                                                                                                                                    Note: Publishers should be aware that applications designed to use specific 
                                                                                                                                                                    schema.org properties (e.g. http://schema.org/width, http://schema.org/color,
                                                                                                                                                                    http://schema.org/gtin13, ...) will typically expect such data to be provided
                                                                                                                                                                    using those properties, rather than using the generic property/value mechanism.  *} */
                                                                                                                        
    public      $address                             = null;        /* {*property   $address                            (PostalAddress|string)                      Physical address of the item. *} */
    public      $aggregateRating                     = null;        /* {*property   $aggregateRating                    (AggregateRating)                           The overall rating, based on a collection of reviews or ratings, of the item. *} */
    public      $amenityFeature                      = null;        /* {*property   $amenityFeature                     (LocationFeatureSpecification)              An amenity feature (e.g. a characteristic or service) of the Accommodation. 
                                                                                                                                                                    This generic property does not make a statement about whether the feature is 
                                                                                                                                                                    included in an offer for the main accommodation or available at extra costs.  *} */
    public      $branchCode                          = null;        /* {*property   $branchCode                         (string)                                    A short textual code (also called "store code") that uniquely identifies a place of 
                                                                                                                                                                    business. The code is typically assigned by the parentOrganization and used in 
                                                                                                                                                                    structured URLs.
                                                                                                                        
                                                                                                                                                                    For example, in the URL http://www.starbucks.co.uk/store-locator/etc/detail/3047 
                                                                                                                                                                    the code "3047" is a branchCode for a particular branch. *} */
                
    public      $containedInPlace                    = null;        /* {*property   $containedInPlace                   (Place)                                     The basic containment relation between a place and one that contains it. 
                                                                                                                                                                    Supersedes containedIn. Inverse property: containsPlace. *} */
    public      $containsPlace                       = null;        /* {*property   $containsPlace                      (Place)                                     The basic containment relation between a place and another that it contains. 
                                                                                                                                                                    Inverse property: containedInPlace. *} */
    public      $event                               = null;        /* {*property   $event                              (Event)                                     Upcoming or past event associated with this place, organization, or action.
                                                                                                                                                                    Supersedes events. *} */
    public      $faxNumber                           = null;        /* {*property   $faxNumber                          (string)                                    The fax number. *} */
    public      $geo                                 = null;        /* {*property   $geo                                (GeoCoordinates|GeoShape)                   The geo coordinates of the place. *} */
    public      $geoContains                         = null;        /* {*property   $geoContains                        (GeospatialGeometry|Place)                  Represents a relationship between two geometries (or the places they represent), 
                                                                                                                                                                    relating a containing geometry to a contained geometry. "a contains b iff no points of b 
                                                                                                                                                                    lie in the exterior of a, and at least one point of the interior of b lies in the 
                                                                                                                                                                    interior of a". As defined in DE-9IM. *} */
    public      $geoCoveredBy                        = null;        /* {*property   $geoCoveredBy                       (GeospatialGeometry|Place)                  Represents a relationship between two geometries (or the places they represent), 
                                                                                                                                                                    relating a geometry to another that covers it. As defined in DE-9IM. *} */
    public      $geoCovers                           = null;        /* {*property   $geoCovers                          (GeospatialGeometry|Place)                  Represents a relationship between two geometries (or the places they represent), 
                                                                                                                                                                    relating a covering geometry to a covered geometry. "Every point of b is a point of 
                                                                                                                                                                    (the interior or boundary of) a". As defined in DE-9IM. *} */
    public      $geoCrosses                          = null;        /* {*property   $geoCrosses                         (GeospatialGeometry|Place)                  Represents a relationship between two geometries (or the places they represent), 
                                                                                                                                                                    relating a geometry to another that crosses it: "a crosses b: they have some but not 
                                                                                                                                                                    all interior points in common, and the dimension of the intersection is less than that
                                                                                                                                                                    of at least one of them". As defined in DE-9IM. *} */
    public      $geoDisjoint                         = null;        /* {*property   $geoDisjoint                        (GeospatialGeometry|Place)                  Represents spatial relations in which two geometries (or the places they represent) 
                                                                                                                                                                    are topologically disjoint: they have no point in common. They form a set of disconnected 
                                                                                                                                                                    geometries." (a symmetric relationship, as defined in DE-9IM) *} */
    public      $geoEquals                           = null;        /* {*property   $geoEquals                          (GeospatialGeometry|Place)                  Represents spatial relations in which two geometries (or the places they represent) 
                                                                                                                                                                    are topologically equal, as defined in DE-9IM. "Two geometries are topologically equal 
                                                                                                                                                                    if their interiors intersect and no part of the interior or boundary of one geometry 
                                                                                                                                                                    intersects the exterior of the other" (a symmetric relationship) *} */
    public      $geoIntersects                       = null;        /* {*property   $geoIntersects                      (GeospatialGeometry|Place)                  Represents spatial relations in which two geometries (or the places they represent) have 
                                                                                                                                                                    at least one point in common. As defined in DE-9IM. *} */
    public      $geoOverlaps                         = null;        /* {*property   $geoOverlaps                        (GeospatialGeometry|Place)                  Represents a relationship between two geometries (or the places they represent), relating 
                                                                                                                                                                    a geometry to another that geospatially overlaps it, i.e. they have some but not all points
                                                                                                                                                                    in common. As defined in DE-9IM. *} */
    public      $geoTouches                          = null;        /* {*property   $geoTouches                         (GeospatialGeometry|Place)                  Represents spatial relations in which two geometries (or the places they represent) touch: 
                                                                                                                                                                    they have at least one boundary point in common, but no interior points." (a symmetric 
                                                                                                                                                                    relationship, as defined in DE-9IM ) *} */
    public      $geoWithin                           = null;        /* {*property   $geoWithin                          (GeospatialGeometry|Place)                  Represents a relationship between two geometries (or the places they represent), relating a 
                                                                                                                                                                    geometry to one that contains it, i.e. it is inside (i.e. within) its interior. 
                                                                                                                                                                    As defined in DE-9IM. *} */
    public      $globalLocationNumber                = null;        /* {*property   $globalLocationNumber               (string)                                    The Global Location Number (GLN, sometimes also referred to as International Location Number or 
                                                                                                                                                                    ILN) of the respective organization, person, or place. The GLN is a 13-digit number used to identify 
                                                                                                                                                                    parties and physical locations. *} */
    public      $hasDriveThroughService              = null;        /* {*property   $hasDriveThroughService             (Boolean)                                   Indicates whether some facility (e.g. FoodEstablishment, CovidTestingFacility) offers a service that 
                                                                                                                                                                    can be used by driving through in a car. In the case of CovidTestingFacility such facilities could 
                                                                                                                                                                    potentially help with social distancing from other potentially-infected users. *} */
    public      $hasMap                              = null;        /* {*property   $hasMap                             (Map|URL)                                   A URL to a map of the place. Supersedes map, maps. *} */
    public      $isAccessibleForFree                 = null;        /* {*property   $isAccessibleForFree                (Boolean)                                   A flag to signal that the item, event, or place is accessible for free. Supersedes free. *} */
    public      $isicV4                              = null;        /* {*property   $isicV4                             (string)                                    The International Standard of Industrial Classification of All Economic Activities (ISIC), Revision 
                                                                                                                                                                    4 code for a particular organization, business person, or place. *} */
    public      $latitude                            = null;        /* {*property   $latitude                           (Number|string)                             The latitude of a location. For example 37.42242 (WGS 84). *} */
    public      $logo                                = null;        /* {*property   $logo                               (ImageObject|URL)                           An associated logo. *} */
    public      $longitude                           = null;        /* {*property   $longitude                          (Number|string)                             The longitude of a location. For example -122.08585 (WGS 84). *} */
    public      $maximumAttendeeCapacity             = null;        /* {*property   $maximumAttendeeCapacity            (Integer)                                   The total number of individuals that may attend an event or venue. *} */
    public      $openingHoursSpecification           = null;        /* {*property   $openingHoursSpecification          (OpeningHoursSpecification)                 The opening hours of a certain place. *} */
    public      $photo                               = null;        /* {*property   $photo                              (ImageObject|Photograph)                    A photograph of this place. Supersedes photos. *} */
    public      $publicAccess                        = null;        /* {*property   $publicAccess                       (Boolean)                                   A flag to signal that the Place is open to public visitors. If this property is omitted there is no 
                                                                                                                                                                    assumed default boolean value *} */
    public      $review                              = null;        /* {*property   $review                             (Review)                                    A review of the item. Supersedes reviews. *} */
    public      $slogan                              = null;        /* {*property   $slogan                             (string)                                    A slogan or motto associated with the item. *} */
    public      $smokingAllowed                      = null;        /* {*property   $smokingAllowed                     (Boolean)                                   Indicates whether it is allowed to smoke in the place, e.g. in the restaurant, hotel or hotel room. *} */
    public      $specialOpeningHoursSpecification    = null;        /* {*property   $specialOpeningHoursSpecification   (OpeningHoursSpecification)                 The special opening hours of a certain place.
                                                                                                                        
                                                                                                                                                                    Use this to explicitly override general opening hours brought in scope by openingHoursSpecification 
                                                                                                                                                                    or openingHours. *} */
    public      $telephone                           = null;        /* {*property   $telephone                          (string)                                    The telephone number. *} */
    public      $tourBookingPage                     = null;        /* {*property   $tourBookingPage                    (URL)                                       A page providing information on how to book a tour of some Place, such as an Accommodation or 


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

        $this->geo = new GeoCoordinates();

        return ( $this );
    }   /* End of Place.__construct() ================================================= */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of Place.speak() ======================================================= */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of Place.sing() ======================================================== */
    /* ================================================================================ */


    public function __destruct()
    /*------------------------*/
    {
        //parent::__destruct();
        $this->backup();
    }   /* End of Place.__destruct() ================================================== */
    /* ================================================================================ */

}   /* End of class Place ============================================================= */
/* ==================================================================================== */
?>