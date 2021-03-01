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
    {*file                  trql.placeofworship.class.php *}
    {*purpose               Place of worship, such as a church, synagogue, or mosque. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 14:12 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 28-08-2020 14:12 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\placeofworship;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\civicstructure\CivicStructure    as CivicStructure;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CIVICSTRUCTURE_CLASS_VERSION' ) )
    require_once( 'trql.civicstructure.class.php' );



defined( 'PLACEOFWORSHIP_CLASS_VERSION' ) or define( 'PLACEOFWORSHIP_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class PlaceOfWorship=

    {*desc

        Place of worship, such as a church, synagogue, or mosque.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/PlaceOfWorship[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 14:12. IT HAS NOT BEEN TESTED YET!
    *}

 */
/* ==================================================================================== */
class PlaceOfWorship extends CivicStructure
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

    public      $additionalProperty             = null;             /* {*property   $additionalProperty             (PropertyValue)                 A property-value pair representing an additional characteristics of
                                                                                                                                                    the entitity, e.g. a product feature or another characteristic for
                                                                                                                                                    which there is no matching property in schema.org.Note: Publishers
                                                                                                                                                    should be aware that applications designed to use specific schema.org
                                                                                                                                                    properties (e.g. http://schema.org/width, http://schema.org/color,
                                                                                                                                                    http://schema.org/gtin13, ...) will typically expect such data to be
                                                                                                                                                    provided using those properties, rather than using the generic
                                                                                                                                                    property/value mechanism. *} */
    public      $additionalType                 = null;             /* {*property   $additionalType                 (URL)                           An additional type for the item, typically used for adding more
                                                                                                                                                    specific types from external vocabularies in microdata syntax. This is
                                                                                                                                                    a relationship between something and a class that the thing is in. In
                                                                                                                                                    RDFa syntax, it is better to use the native RDFa syntax - the 'typeof'
                                                                                                                                                    attribute - for multiple types. Schema.org tools may have only weaker
                                                                                                                                                    understanding of extra types, in particular those defined externally. *} */
    public      $address                        = null;             /* {*property   $address                        (PostalAddress|string)          Physical address of the item. *} */
    public      $aggregateRating                = null;             /* {*property   $aggregateRating                (AggregateRating)               The overall rating, based on a collection of reviews or ratings, of
                                                                                                                                                    the item. *} */
    public      $alternateName                  = null;             /* {*property   $alternateName                  (string)                        An alias for the item. *} */
    public      $amenityFeature                 = null;             /* {*property   $amenityFeature                 (LocationFeatureSpecification)  An amenity feature (e.g. a characteristic or service) of the
                                                                                                                                                    Accommodation. This generic property does not make a statement about
                                                                                                                                                    whether the feature is included in an offer for the main accommodation
                                                                                                                                                    or available at extra costs. *} */
    public      $branchCode                     = null;             /* {*property   $branchCode                     (string)                        A short textual code (also called "store code") that uniquely
                                                                                                                                                    identifies a place of business. The code is typically assigned by the
                                                                                                                                                    parentOrganization and used in structured URLs.For example, in the URL
                                                                                                                                                    http://www.starbucks.co.uk/store-locator/etc/detail/3047 the code
                                                                                                                                                    "3047" is a branchCode for a particular branch. *} */
    public      $containedIn                    = null;             /* {*property   $containedIn                    (Place)                         The basic containment relation between a place and one that contains
                                                                                                                                                    it. *} */
    public      $containedInPlace               = null;             /* {*property   $containedInPlace               (Place)                         The basic containment relation between a place and one that contains
                                                                                                                                                    it. *} */
    public      $containsPlace                  = null;             /* {*property   $containsPlace                  (Place)                         The basic containment relation between a place and another that it
                                                                                                                                                    contains. *} */
    public      $description                    = null;             /* {*property   $description                    (string)                        A description of the item. *} */
    public      $disambiguatingDescription      = null;             /* {*property   $disambiguatingDescription      (string)                        A sub property of description. A short description of the item used to
                                                                                                                                                    disambiguate from other, similar items. Information from other
                                                                                                                                                    properties (in particular, name) may be necessary for the description
                                                                                                                                                    to be useful for disambiguation. *} */
    public      $event                          = null;             /* {*property   $event                          (Event)                         Upcoming or past event associated with this place, organization, or
                                                                                                                                                    action. *} */
    public      $events                         = null;             /* {*property   $events                         (Event)                         Upcoming or past events associated with this place or organization. *} */
    public      $faxNumber                      = null;             /* {*property   $faxNumber                      (string)                        The fax number. *} */
    public      $geo                            = null;             /* {*property   $geo                            (GeoCoordinates|GeoShape)       The geo coordinates of the place. *} */
    public      $geoContains                    = null;             /* {*property   $geoContains                    (GeospatialGeometry|Place)      Represents a relationship between two geometries (or the places they
                                                                                                                                                    represent), relating a containing geometry to a contained geometry. "a
                                                                                                                                                    contains b iff no points of b lie in the exterior of a, and at least
                                                                                                                                                    one point of the interior of b lies in the interior of a". As defined
                                                                                                                                                    in DE-9IM. *} */
    public      $geoCoveredBy                   = null;             /* {*property   $geoCoveredBy                   (GeospatialGeometry|Place)      Represents a relationship between two geometries (or the places they
                                                                                                                                                    represent), relating a geometry to another that covers it. As defined
                                                                                                                                                    in DE-9IM. *} */
    public      $geoCovers                      = null;             /* {*property   $geoCovers                      (Place|GeospatialGeometry)      Represents a relationship between two geometries (or the places they
                                                                                                                                                    represent), relating a covering geometry to a covered geometry. "Every
                                                                                                                                                    point of b is a point of (the interior or boundary of) a". As defined
                                                                                                                                                    in DE-9IM. *} */
    public      $geoCrosses                     = null;             /* {*property   $geoCrosses                     (GeospatialGeometry|Place)      Represents a relationship between two geometries (or the places they
                                                                                                                                                    represent), relating a geometry to another that crosses it: "a crosses
                                                                                                                                                    b: they have some but not all interior points in common, and the
                                                                                                                                                    dimension of the intersection is less than that of at least one of
                                                                                                                                                    them". As defined in DE-9IM. *} */
    public      $geoDisjoint                    = null;             /* {*property   $geoDisjoint                    (GeospatialGeometry|Place)      Represents spatial relations in which two geometries (or the places
                                                                                                                                                    they represent) are topologically disjoint: they have no point in
                                                                                                                                                    common. They form a set of disconnected geometries." (a symmetric
                                                                                                                                                    relationship, as defined in DE-9IM) *} */
    public      $geoEquals                      = null;             /* {*property   $geoEquals                      (GeospatialGeometry|Place)      Represents spatial relations in which two geometries (or the places
                                                                                                                                                    they represent) are topologically equal, as defined in DE-9IM. "Two
                                                                                                                                                    geometries are topologically equal if their interiors intersect and no
                                                                                                                                                    part of the interior or boundary of one geometry intersects the
                                                                                                                                                    exterior of the other" (a symmetric relationship) *} */
    public      $geoIntersects                  = null;             /* {*property   $geoIntersects                  (Place|GeospatialGeometry)      Represents spatial relations in which two geometries (or the places
                                                                                                                                                    they represent) have at least one point in common. As defined in
                                                                                                                                                    DE-9IM. *} */
    public      $geoOverlaps                    = null;             /* {*property   $geoOverlaps                    (GeospatialGeometry|Place)      Represents a relationship between two geometries (or the places they
                                                                                                                                                    represent), relating a geometry to another that geospatially overlaps
                                                                                                                                                    it, i.e. they have some but not all points in common. As defined in
                                                                                                                                                    DE-9IM. *} */
    public      $geoTouches                     = null;             /* {*property   $geoTouches                     (Place|GeospatialGeometry)      Represents spatial relations in which two geometries (or the places
                                                                                                                                                    they represent) touch: they have at least one boundary point in
                                                                                                                                                    common, but no interior points." (a symmetric relationship, as defined
                                                                                                                                                    in DE-9IM ) *} */
    public      $geoWithin                      = null;             /* {*property   $geoWithin                      (Place|GeospatialGeometry)      Represents a relationship between two geometries (or the places they
                                                                                                                                                    represent), relating a geometry to one that contains it, i.e. it is
                                                                                                                                                    inside (i.e. within) its interior. As defined in DE-9IM. *} */
    public      $globalLocationNumber           = null;             /* {*property   $globalLocationNumber           (string)                        The Global Location Number (GLN, sometimes also referred to as
                                                                                                                                                    International Location Number or ILN) of the respective organization,
                                                                                                                                                    person, or place. The GLN is a 13-digit number used to identify
                                                                                                                                                    parties and physical locations. *} */
    public      $hasDriveThroughService         = null;             /* {*property   $hasDriveThroughService         (boolean)                       Indicates whether some facility (e.g. FoodEstablishment,
                                                                                                                                                    CovidTestingFacility) offers a service that can be used by driving
                                                                                                                                                    through in a car. In the case of CovidTestingFacility such facilities
                                                                                                                                                    could potentially help with social distancing from other
                                                                                                                                                    potentially-infected users. *} */
    public      $hasMap                         = null;             /* {*property   $hasMap                         (URL|Map)                       A URL to a map of the place. *} */
    public      $identifier                     = null;             /* {*property   $identifier                     (URL|string|PropertyValue)      The identifier property represents any kind of identifier for any kind
                                                                                                                                                    of Thing, such as ISBNs, GTIN codes, UUIDs etc. Schema.org provides
                                                                                                                                                    dedicated properties for representing many of these, either as textual
                                                                                                                                                    strings or as URL (URI) links. See background notes for more details. *} */
    public      $image                          = null;             /* {*property   $image                          (ImageObject|URL)               An image of the item. This can be a URL or a fully described
                                                                                                                                                    ImageObject. *} */
    public      $isAccessibleForFree            = null;             /* {*property   $isAccessibleForFree            (boolean)                       A flag to signal that the item, event, or place is accessible for
                                                                                                                                                    free. *} */
    public      $isicV4                         = null;             /* {*property   $isicV4                         (string)                        The International Standard of Industrial Classification of All
                                                                                                                                                    Economic Activities (ISIC), Revision 4 code for a particular
                                                                                                                                                    organization, business person, or place. *} */
    public      $latitude                       = null;             /* {*property   $latitude                       (float|string)                  The latitude of a location. For example 37.42242 (WGS 84). *} */
    public      $logo                           = null;             /* {*property   $logo                           (ImageObject|URL)               An associated logo. *} */
    public      $longitude                      = null;             /* {*property   $longitude                      (string|float)                  The longitude of a location. For example -122.08585 (WGS 84). *} */
    public      $mainEntityOfPage               = null;             /* {*property   $mainEntityOfPage               (CreativeWork|URL)              Indicates a page (or other CreativeWork) for which this thing is the
                                                                                                                                                    main entity being described. See background notes for details. *} */
    public      $map                            = null;             /* {*property   $map                            (URL)                           A URL to a map of the place. *} */
    public      $maps                           = null;             /* {*property   $maps                           (URL)                           A URL to a map of the place. *} */
    public      $maximumAttendeeCapacity        = null;             /* {*property   $maximumAttendeeCapacity        (int)                           The total number of individuals that may attend an event or venue. *} */
    public      $name                           = null;             /* {*property   $name                           (string)                        The name of the item. *} */
    public      $openingHours                   = null;             /* {*property   $openingHours                   (string)                        The general opening hours for a business. Opening hours can be
                                                                                                                                                    specified as a weekly time range, starting with days, then times per
                                                                                                                                                    day. Multiple days can be listed with commas ',' separating each day.
                                                                                                                                                    Day or time ranges are specified using a hyphen '-'.Days are specified
                                                                                                                                                    using the following two-letter combinations: Mo, Tu, We, Th, Fr, Sa,
                                                                                                                                                    Su.Times are specified using 24:00 time. For example, 3pm is specified
                                                                                                                                                    as 15:00. Here is an example: &lt;time itemprop="openingHours"
                                                                                                                                                    datetime=&quot;Tu,Th 16:00-20:00&quot;&gt;Tuesdays and Thursdays
                                                                                                                                                    4-8pm&lt;/time&gt;.If a business is open 7 days a week, then it can be
                                                                                                                                                    specified as &lt;time itemprop=&quot;openingHours&quot;
                                                                                                                                                    datetime=&quot;Mo-Su&quot;&gt;Monday through Sunday, all
                                                                                                                                                    day&lt;/time&gt;. *} */
    public      $openingHoursSpecification      = null;             /* {*property   $openingHoursSpecification      (OpeningHoursSpecification)     The opening hours of a certain place. *} */
    public      $photo                          = null;             /* {*property   $photo                          (Photograph|ImageObject)        A photograph of this place. *} */
    public      $photos                         = null;             /* {*property   $photos                         (Photograph|ImageObject)        Photographs of this place. *} */
    public      $potentialAction                = null;             /* {*property   $potentialAction                (Action)                        Indicates a potential Action, which describes an idealized action in
                                                                                                                                                    which this thing would play an 'object' role. *} */
    public      $publicAccess                   = null;             /* {*property   $publicAccess                   (boolean)                       A flag to signal that the Place is open to public visitors. If this
                                                                                                                                                    property is omitted there is no assumed default boolean value *} */
    public      $review                         = null;             /* {*property   $review                         (Review)                        A review of the item. *} */
    public      $reviews                        = null;             /* {*property   $reviews                        (Review)                        Review of the item. *} */
    public      $sameAs                         = null;             /* {*property   $sameAs                         (URL)                           URL of a reference Web page that unambiguously indicates the item's
                                                                                                                                                    identity. E.g. the URL of the item's Wikipedia page, Wikidata entry,
                                                                                                                                                    or official website. *} */
    public      $slogan                         = null;             /* {*property   $slogan                         (string)                        A slogan or motto associated with the item. *} */
    public      $smokingAllowed                 = null;             /* {*property   $smokingAllowed                 (boolean)                       Indicates whether it is allowed to smoke in the place, e.g. in the
                                                                                                                                                    restaurant, hotel or hotel room. *} */
    public      $specialOpeningHoursSpecification = null;             /* {*property   $specialOpeningHoursSpecification(OpeningHoursSpecification)     The special opening hours of a certain place.Use this to explicitly
                                                                                                                                                    override general opening hours brought in scope by
                                                                                                                                                    openingHoursSpecification or openingHours. *} */
    public      $subjectOf                      = null;             /* {*property   $subjectOf                      (Event|CreativeWork)            A CreativeWork or Event about this Thing. *} */
    public      $telephone                      = null;             /* {*property   $telephone                      (string)                        The telephone number. *} */
    public      $tourBookingPage                = null;             /* {*property   $tourBookingPage                (URL)                           A page providing information on how to book a tour of some Place, such
                                                                                                                                                    as an Accommodation or ApartmentComplex in a real estate setting, as
                                                                                                                                                    well as other kinds of tours as appropriate. *} */
    public      $url                            = null;             /* {*property   $url                            (URL)                           URL of the item. *} */


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
    }   /* End of PlaceOfWorship.__construct() ========================================== */
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
    }   /* End of PlaceOfWorship.__destruct() =========================================== */
    /* ================================================================================ */

}   /* End of class PlaceOfWorship ====================================================== */
/* ==================================================================================== */

?>