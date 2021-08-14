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
    {*file                  trql.lodgingbusiness.class.php *}
    {*purpose               A lodging business, such as a motel, hotel, or inn. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:49 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

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
namespace trql\lodgingbusiness;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\schema\business\LocalBusiness   as LocalBusiness;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'LOCALBUSINESS_CLASS_VERSION' ) )
    require_once( 'trql.localbusiness.class.php' );

defined( 'LODGINGBUSINESS_CLASS_VERSION' ) or define( 'LODGINGBUSINESS_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class LodgingBusiness=

    {*desc

        A lodging business, such as a motel, hotel, or inn.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/LodgingBusiness[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:49.
    *}

 */
/* ==================================================================================== */
class LodgingBusiness extends LocalBusiness
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

    public      $amenityFeature                 = null;             /* {*property   $amenityFeature                 (LocationFeatureSpecification)  An amenity feature (e.g. a characteristic or service) of the
                                                                                                                                                    Accommodation. This generic property does not make a statement about
                                                                                                                                                    whether the feature is included in an offer for the main accommodation
                                                                                                                                                    or available at extra costs. *} */
    public      $audience                       = null;             /* {*property   $audience                       (Audience)                      An intended audience, i.e. a group for whom something was created. *} */
    public      $availableLanguage              = null;             /* {*property   $availableLanguage              (string|Language)               A language someone may use with or at the item, service or place.
                                                                                                                                                    Please use one of the language codes from the IETF BCP 47 standard.
                                                                                                                                                    See also inLanguage *} */
    public      $checkinTime                    = null;             /* {*property   $checkinTime                    (Time|DateTime)                 The earliest someone may check into a lodging establishment. *} */
    public      $checkoutTime                   = null;             /* {*property   $checkoutTime                   (Time|DateTime)                 The latest someone may check out of a lodging establishment. *} */
    public      $numberOfRooms                  = null;             /* {*property   $numberOfRooms                  (QuantitativeValue|float)       The number of rooms (excluding bathrooms and closets) of the
                                                                                                                                                    accommodation or lodging business.Typical unit code(s): ROM for room
                                                                                                                                                    or C62 for no unit. The type of room can be put in the unitText
                                                                                                                                                    property of the QuantitativeValue. *} */
    public      $petsAllowed                    = null;             /* {*property   $petsAllowed                    (boolean|string)                Indicates whether pets are allowed to enter the accommodation or
                                                                                                                                                    lodging business. More detailed information can be put in a text
                                                                                                                                                    value. *} */
    public      $starRating                     = null;             /* {*property   $starRating                     (Rating)                        An official rating for a lodging business or food establishment, e.g.
                                                                                                                                                    from national associations or standards bodies. Use the author
                                                                                                                                                    property to indicate the rating organization, e.g. as an Organization
                                                                                                                                                    with name such as (e.g. HOTREC, DEHOGA, WHR, or Hotelstars). *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q5056668';       /* {*property   $wikidataId                     (string)                        Wikidata ID. Lodging: industry and type of residential accommodation. *} */


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
    }   /* End of LodgingBusiness.__construct() ======================================= */
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
    }   /* End of LodgingBusiness.__destruct() ======================================== */
    /* ================================================================================ */
}   /* End of class LodgingBusiness =================================================== */
/* ==================================================================================== */
?>