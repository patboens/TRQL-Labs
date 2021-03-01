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
    {*file                  trql.brewery.class.php *}
    {*purpose               Brewery. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:37 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:37 *}
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
namespace trql\brewery;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\foodestablishment\FoodEstablishment    as FoodEstablishment;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'FOODESTABLISHMENT_CLASS_VERSION' ) )
    require_once( 'trql.foodestablishment.class.php' );



defined( 'BREWERY_CLASS_VERSION' ) or define( 'BREWERY_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Brewery=

    {*desc

        Brewery.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Brewery[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:37.
    *}

 */
/* ==================================================================================== */
class Brewery extends FoodEstablishment
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

    public      $acceptsReservations            = null;             /* {*property   $acceptsReservations            (boolean|URL|string)            Indicates whether a FoodEstablishment accepts reservations. Values can
                                                                                                                                                    be Boolean, an URL at which reservations can be made or (for backwards
                                                                                                                                                    compatibility) the strings Yes or No. *} */
    public      $actionableFeedbackPolicy       = null;             /* {*property   $actionableFeedbackPolicy       (URL|CreativeWork)              For a NewsMediaOrganization or other news-related Organization, a
                                                                                                                                                    statement about public engagement activities (for news media, the
                                                                                                                                                    newsroom’s), including involving the public - digitally or otherwise
                                                                                                                                                    -- in coverage decisions, reporting and activities after publication. *} */
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
    public      $alumni                         = null;             /* {*property   $alumni                         (Person)                        Alumni of an organization. *} */
    public      $amenityFeature                 = null;             /* {*property   $amenityFeature                 (LocationFeatureSpecification)  An amenity feature (e.g. a characteristic or service) of the
                                                                                                                                                    Accommodation. This generic property does not make a statement about
                                                                                                                                                    whether the feature is included in an offer for the main accommodation
                                                                                                                                                    or available at extra costs. *} */
    public      $areaServed                     = null;             /* {*property   $areaServed                     (Place|GeoShape|string|AdministrativeArea)The geographic area where a service or offered item is provided. *} */
    public      $award                          = null;             /* {*property   $award                          (string)                        An award won by or for this item. *} */
    public      $awards                         = null;             /* {*property   $awards                         (string)                        Awards won by or for this item. *} */
    public      $branchCode                     = null;             /* {*property   $branchCode                     (string)                        A short textual code (also called "store code") that uniquely
                                                                                                                                                    identifies a place of business. The code is typically assigned by the
                                                                                                                                                    parentOrganization and used in structured URLs.For example, in the URL
                                                                                                                                                    http://www.starbucks.co.uk/store-locator/etc/detail/3047 the code
                                                                                                                                                    "3047" is a branchCode for a particular branch. *} */
    public      $branchOf                       = null;             /* {*property   $branchOf                       (Organization)                  The larger organization that this local business is a branch of, if
                                                                                                                                                    any. Not to be confused with (anatomical)branch. *} */
    public      $brand                          = null;             /* {*property   $brand                          (Brand|Organization)            The brand(s) associated with a product or service, or the brand(s)
                                                                                                                                                    maintained by an organization or business person. *} */
    public      $contactPoint                   = null;             /* {*property   $contactPoint                   (ContactPoint)                  A contact point for a person or organization. *} */
    public      $contactPoints                  = null;             /* {*property   $contactPoints                  (ContactPoint)                  A contact point for a person or organization. *} */
    public      $containedIn                    = null;             /* {*property   $containedIn                    (Place)                         The basic containment relation between a place and one that contains
                                                                                                                                                    it. *} */
    public      $containedInPlace               = null;             /* {*property   $containedInPlace               (Place)                         The basic containment relation between a place and one that contains
                                                                                                                                                    it. *} */
    public      $containsPlace                  = null;             /* {*property   $containsPlace                  (Place)                         The basic containment relation between a place and another that it
                                                                                                                                                    contains. *} */
    public      $correctionsPolicy              = null;             /* {*property   $correctionsPolicy              (URL|CreativeWork)              For an Organization (e.g. NewsMediaOrganization), a statement
                                                                                                                                                    describing (in news media, the newsroom’s) disclosure and correction
                                                                                                                                                    policy for errors. *} */
    public      $currenciesAccepted             = null;             /* {*property   $currenciesAccepted             (string)                        The currency accepted.Use standard formats: ISO 4217 currency format
                                                                                                                                                    e.g. "USD"; Ticker symbol for cryptocurrencies e.g. "BTC"; well known
                                                                                                                                                    names for Local Exchange Tradings Systems (LETS) and other currency
                                                                                                                                                    types e.g. "Ithaca HOUR". *} */
    public      $department                     = null;             /* {*property   $department                     (Organization)                  A relationship between an organization and a department of that
                                                                                                                                                    organization, also described as an organization (allowing different
                                                                                                                                                    urls, logos, opening hours). For example: a store with a pharmacy, or
                                                                                                                                                    a bakery with a cafe. *} */
    public      $description                    = null;             /* {*property   $description                    (string)                        A description of the item. *} */
    public      $disambiguatingDescription      = null;             /* {*property   $disambiguatingDescription      (string)                        A sub property of description. A short description of the item used to
                                                                                                                                                    disambiguate from other, similar items. Information from other
                                                                                                                                                    properties (in particular, name) may be necessary for the description
                                                                                                                                                    to be useful for disambiguation. *} */
    public      $dissolutionDate                = null;             /* {*property   $dissolutionDate                (Date)                          The date that this organization was dissolved. *} */
    public      $diversityPolicy                = null;             /* {*property   $diversityPolicy                (CreativeWork|URL)              Statement on diversity policy by an Organization e.g. a
                                                                                                                                                    NewsMediaOrganization. For a NewsMediaOrganization, a statement
                                                                                                                                                    describing the newsroom’s diversity policy on both staffing and
                                                                                                                                                    sources, typically providing staffing data. *} */
    public      $diversityStaffingReport        = null;             /* {*property   $diversityStaffingReport        (Article|URL)                   For an Organization (often but not necessarily a
                                                                                                                                                    NewsMediaOrganization), a report on staffing diversity issues. In a
                                                                                                                                                    news context this might be for example ASNE or RTDNA (US) reports, or
                                                                                                                                                    self-reported. *} */
    public      $duns                           = null;             /* {*property   $duns                           (string)                        The Dun &amp; Bradstreet DUNS number for identifying an organization
                                                                                                                                                    or business person. *} */
    public      $email                          = null;             /* {*property   $email                          (string)                        Email address. *} */
    public      $employee                       = null;             /* {*property   $employee                       (Person)                        Someone working for this organization. *} */
    public      $employees                      = null;             /* {*property   $employees                      (Person)                        People working for this organization. *} */
    public      $ethicsPolicy                   = null;             /* {*property   $ethicsPolicy                   (URL|CreativeWork)              Statement about ethics policy, e.g. of a NewsMediaOrganization
                                                                                                                                                    regarding journalistic and publishing practices, or of a Restaurant, a
                                                                                                                                                    page describing food source policies. In the case of a
                                                                                                                                                    NewsMediaOrganization, an ethicsPolicy is typically a statement
                                                                                                                                                    describing the personal, organizational, and corporate standards of
                                                                                                                                                    behavior expected by the organization. *} */
    public      $event                          = null;             /* {*property   $event                          (Event)                         Upcoming or past event associated with this place, organization, or
                                                                                                                                                    action. *} */
    public      $events                         = null;             /* {*property   $events                         (Event)                         Upcoming or past events associated with this place or organization. *} */
    public      $faxNumber                      = null;             /* {*property   $faxNumber                      (string)                        The fax number. *} */
    public      $founder                        = null;             /* {*property   $founder                        (Person)                        A person who founded this organization. *} */
    public      $founders                       = null;             /* {*property   $founders                       (Person)                        A person who founded this organization. *} */
    public      $foundingDate                   = null;             /* {*property   $foundingDate                   (Date)                          The date that this organization was founded. *} */
    public      $foundingLocation               = null;             /* {*property   $foundingLocation               (Place)                         The place where the Organization was founded. *} */
    public      $funder                         = null;             /* {*property   $funder                         (Person|Organization)           A person or organization that supports (sponsors) something through
                                                                                                                                                    some kind of financial contribution. *} */
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
    public      $hasCredential                  = null;             /* {*property   $hasCredential                  (EducationalOccupationalCredential)A credential awarded to the Person or Organization. *} */
    public      $hasDriveThroughService         = null;             /* {*property   $hasDriveThroughService         (boolean)                       Indicates whether some facility (e.g. FoodEstablishment,
                                                                                                                                                    CovidTestingFacility) offers a service that can be used by driving
                                                                                                                                                    through in a car. In the case of CovidTestingFacility such facilities
                                                                                                                                                    could potentially help with social distancing from other
                                                                                                                                                    potentially-infected users. *} */
    public      $hasMap                         = null;             /* {*property   $hasMap                         (URL|Map)                       A URL to a map of the place. *} */
    public      $hasMenu                        = null;             /* {*property   $hasMenu                        (Menu|URL|string)               Either the actual menu as a structured representation, as text, or a
                                                                                                                                                    URL of the menu. *} */
    public      $hasMerchantReturnPolicy        = null;             /* {*property   $hasMerchantReturnPolicy        (MerchantReturnPolicy)          Indicates a MerchantReturnPolicy that may be applicable. *} */
    public      $hasOfferCatalog                = null;             /* {*property   $hasOfferCatalog                (OfferCatalog)                  Indicates an OfferCatalog listing for this Organization, Person, or
                                                                                                                                                    Service. *} */
    public      $hasPOS                         = null;             /* {*property   $hasPOS                         (Place)                         Points-of-Sales operated by the organization or person. *} */
    public      $identifier                     = null;             /* {*property   $identifier                     (URL|string|PropertyValue)      The identifier property represents any kind of identifier for any kind
                                                                                                                                                    of Thing, such as ISBNs, GTIN codes, UUIDs etc. Schema.org provides
                                                                                                                                                    dedicated properties for representing many of these, either as textual
                                                                                                                                                    strings or as URL (URI) links. See background notes for more details. *} */
    public      $image                          = null;             /* {*property   $image                          (ImageObject|URL)               An image of the item. This can be a URL or a fully described
                                                                                                                                                    ImageObject. *} */
    public      $interactionStatistic           = null;             /* {*property   $interactionStatistic           (InteractionCounter)            The number of interactions for the CreativeWork using the WebSite or
                                                                                                                                                    SoftwareApplication. The most specific child type of
                                                                                                                                                    InteractionCounter should be used. *} */
    public      $isAccessibleForFree            = null;             /* {*property   $isAccessibleForFree            (boolean)                       A flag to signal that the item, event, or place is accessible for
                                                                                                                                                    free. *} */
    public      $isicV4                         = null;             /* {*property   $isicV4                         (string)                        The International Standard of Industrial Classification of All
                                                                                                                                                    Economic Activities (ISIC), Revision 4 code for a particular
                                                                                                                                                    organization, business person, or place. *} */
    public      $knowsAbout                     = null;             /* {*property   $knowsAbout                     (URL|Thing|string)              Of a Person, and less typically of an Organization, to indicate a
                                                                                                                                                    topic that is known about - suggesting possible expertise but not
                                                                                                                                                    implying it. We do not distinguish skill levels here, or relate this
                                                                                                                                                    to educational content, events, objectives or JobPosting descriptions. *} */
    public      $knowsLanguage                  = null;             /* {*property   $knowsLanguage                  (Language|string)               Of a Person, and less typically of an Organization, to indicate a
                                                                                                                                                    known language. We do not distinguish skill levels or
                                                                                                                                                    reading/writing/speaking/signing here. Use language codes from the
                                                                                                                                                    IETF BCP 47 standard. *} */
    public      $latitude                       = null;             /* {*property   $latitude                       (float|string)                  The latitude of a location. For example 37.42242 (WGS 84). *} */
    public      $legalName                      = null;             /* {*property   $legalName                      (string)                        The official name of the organization, e.g. the registered company
                                                                                                                                                    name. *} */
    public      $leiCode                        = null;             /* {*property   $leiCode                        (string)                        An organization identifier that uniquely identifies a legal entity as
                                                                                                                                                    defined in ISO 17442. *} */
    public      $location                       = null;             /* {*property   $location                       (string|PostalAddress|VirtualLocation|Place)The location of for example where the event is happening, an
                                                                                                                                                    organization is located, or where an action takes place. *} */
    public      $logo                           = null;             /* {*property   $logo                           (ImageObject|URL)               An associated logo. *} */
    public      $longitude                      = null;             /* {*property   $longitude                      (string|float)                  The longitude of a location. For example -122.08585 (WGS 84). *} */
    public      $mainEntityOfPage               = null;             /* {*property   $mainEntityOfPage               (CreativeWork|URL)              Indicates a page (or other CreativeWork) for which this thing is the
                                                                                                                                                    main entity being described. See background notes for details. *} */
    public      $makesOffer                     = null;             /* {*property   $makesOffer                     (Offer)                         A pointer to products or services offered by the organization or
                                                                                                                                                    person. *} */
    public      $map                            = null;             /* {*property   $map                            (URL)                           A URL to a map of the place. *} */
    public      $maps                           = null;             /* {*property   $maps                           (URL)                           A URL to a map of the place. *} */
    public      $maximumAttendeeCapacity        = null;             /* {*property   $maximumAttendeeCapacity        (int)                           The total number of individuals that may attend an event or venue. *} */
    public      $member                         = null;             /* {*property   $member                         (Organization|Person)           A member of an Organization or a ProgramMembership. Organizations can
                                                                                                                                                    be members of organizations; ProgramMembership is typically for
                                                                                                                                                    individuals. *} */
    public      $memberOf                       = null;             /* {*property   $memberOf                       (Organization|ProgramMembership)An Organization (or ProgramMembership) to which this Person or
                                                                                                                                                    Organization belongs. *} */
    public      $members                        = null;             /* {*property   $members                        (Person|Organization)           A member of this organization. *} */
    public      $menu                           = null;             /* {*property   $menu                           (string|Menu|URL)               Either the actual menu as a structured representation, as text, or a
                                                                                                                                                    URL of the menu. *} */
    public      $naics                          = null;             /* {*property   $naics                          (string)                        The North American Industry Classification System (NAICS) code for a
                                                                                                                                                    particular organization or business person. *} */
    public      $name                           = null;             /* {*property   $name                           (string)                        The name of the item. *} */
    public      $nonprofitStatus                = null;             /* {*property   $nonprofitStatus                (NonprofitType)                 nonprofit Status indicates the legal status of a non-profit
                                                                                                                                                    organization in its primary place of business. *} */
    public      $numberOfEmployees              = null;             /* {*property   $numberOfEmployees              (QuantitativeValue)             The number of employees in an organization e.g. business. *} */
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
    public      $ownershipFundingInfo           = null;             /* {*property   $ownershipFundingInfo           (CreativeWork|AboutPage|URL|string)For an Organization (often but not necessarily a
                                                                                                                                                    NewsMediaOrganization), a description of organizational ownership
                                                                                                                                                    structure; funding and grants. In a news/media setting, this is with
                                                                                                                                                    particular reference to editorial independence. Note that the funder
                                                                                                                                                    is also available and can be used to make basic funder information
                                                                                                                                                    machine-readable. *} */
    public      $owns                           = null;             /* {*property   $owns                           (OwnershipInfo|Product)         Products owned by the organization or person. *} */
    public      $parentOrganization             = null;             /* {*property   $parentOrganization             (Organization)                  The larger organization that this organization is a subOrganization
                                                                                                                                                    of, if any. *} */
    public      $paymentAccepted                = null;             /* {*property   $paymentAccepted                (string)                        Cash, Credit Card, Cryptocurrency, Local Exchange Tradings System,
                                                                                                                                                    etc. *} */
    public      $photo                          = null;             /* {*property   $photo                          (Photograph|ImageObject)        A photograph of this place. *} */
    public      $photos                         = null;             /* {*property   $photos                         (Photograph|ImageObject)        Photographs of this place. *} */
    public      $potentialAction                = null;             /* {*property   $potentialAction                (Action)                        Indicates a potential Action, which describes an idealized action in
                                                                                                                                                    which this thing would play an 'object' role. *} */
    public      $priceRange                     = null;             /* {*property   $priceRange                     (string)                        The price range of the business, for example $$$. *} */
    public      $publicAccess                   = null;             /* {*property   $publicAccess                   (boolean)                       A flag to signal that the Place is open to public visitors. If this
                                                                                                                                                    property is omitted there is no assumed default boolean value *} */
    public      $publishingPrinciples           = null;             /* {*property   $publishingPrinciples           (URL|CreativeWork)              The publishingPrinciples property indicates (typically via URL) a
                                                                                                                                                    document describing the editorial principles of an Organization (or
                                                                                                                                                    individual e.g. a Person writing a blog) that relate to their
                                                                                                                                                    activities as a publisher, e.g. ethics or diversity policies. When
                                                                                                                                                    applied to a CreativeWork (e.g. NewsArticle) the principles are those
                                                                                                                                                    of the party primarily responsible for the creation of the
                                                                                                                                                    CreativeWork.While such policies are most typically expressed in
                                                                                                                                                    natural language, sometimes related information (e.g. indicating a
                                                                                                                                                    funder) can be expressed using schema.org terminology. *} */
    public      $review                         = null;             /* {*property   $review                         (Review)                        A review of the item. *} */
    public      $reviews                        = null;             /* {*property   $reviews                        (Review)                        Review of the item. *} */
    public      $sameAs                         = null;             /* {*property   $sameAs                         (URL)                           URL of a reference Web page that unambiguously indicates the item's
                                                                                                                                                    identity. E.g. the URL of the item's Wikipedia page, Wikidata entry,
                                                                                                                                                    or official website. *} */
    public      $seeks                          = null;             /* {*property   $seeks                          (Demand)                        A pointer to products or services sought by the organization or person
                                                                                                                                                    (demand). *} */
    public      $servesCuisine                  = null;             /* {*property   $servesCuisine                  (string)                        The cuisine of the restaurant. *} */
    public      $serviceArea                    = null;             /* {*property   $serviceArea                    (AdministrativeArea|Place|GeoShape)The geographic area where the service is provided. *} */
    public      $slogan                         = null;             /* {*property   $slogan                         (string)                        A slogan or motto associated with the item. *} */
    public      $smokingAllowed                 = null;             /* {*property   $smokingAllowed                 (boolean)                       Indicates whether it is allowed to smoke in the place, e.g. in the
                                                                                                                                                    restaurant, hotel or hotel room. *} */
    public      $specialOpeningHoursSpecification = null;             /* {*property   $specialOpeningHoursSpecification(OpeningHoursSpecification)     The special opening hours of a certain place.Use this to explicitly
                                                                                                                                                    override general opening hours brought in scope by
                                                                                                                                                    openingHoursSpecification or openingHours. *} */
    public      $sponsor                        = null;             /* {*property   $sponsor                        (Person|Organization)           A person or organization that supports a thing through a pledge,
                                                                                                                                                    promise, or financial contribution. e.g. a sponsor of a Medical Study
                                                                                                                                                    or a corporate sponsor of an event. *} */
    public      $starRating                     = null;             /* {*property   $starRating                     (Rating)                        An official rating for a lodging business or food establishment, e.g.
                                                                                                                                                    from national associations or standards bodies. Use the author
                                                                                                                                                    property to indicate the rating organization, e.g. as an Organization
                                                                                                                                                    with name such as (e.g. HOTREC, DEHOGA, WHR, or Hotelstars). *} */
    public      $subOrganization                = null;             /* {*property   $subOrganization                (Organization)                  A relationship between two organizations where the first includes the
                                                                                                                                                    second, e.g., as a subsidiary. See also: the more specific
                                                                                                                                                    'department' property. *} */
    public      $subjectOf                      = null;             /* {*property   $subjectOf                      (Event|CreativeWork)            A CreativeWork or Event about this Thing. *} */
    public      $taxID                          = null;             /* {*property   $taxID                          (string)                        The Tax / Fiscal ID of the organization or person, e.g. the TIN in the
                                                                                                                                                    US or the CIF/NIF in Spain. *} */
    public      $telephone                      = null;             /* {*property   $telephone                      (string)                        The telephone number. *} */
    public      $tourBookingPage                = null;             /* {*property   $tourBookingPage                (URL)                           A page providing information on how to book a tour of some Place, such
                                                                                                                                                    as an Accommodation or ApartmentComplex in a real estate setting, as
                                                                                                                                                    well as other kinds of tours as appropriate. *} */
    public      $unnamedSourcesPolicy           = null;             /* {*property   $unnamedSourcesPolicy           (CreativeWork|URL)              For an Organization (typically a NewsMediaOrganization), a statement
                                                                                                                                                    about policy on use of unnamed sources and the decision process
                                                                                                                                                    required. *} */
    public      $url                            = null;             /* {*property   $url                            (URL)                           URL of the item. *} */
    public      $vatID                          = null;             /* {*property   $vatID                          (string)                        The Value-added Tax ID of the organization or person. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */


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
    }   /* End of Brewery.__construct() =============================================== */
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
    }   /* End of Brewery.__destruct() ================================================ */
    /* ================================================================================ */
}   /* End of class Brewery =========================================================== */
/* ==================================================================================== */

?>