<?php
/****************************************************************************************/
/** {{{*fheader
    {*file                  trql.geocoordinates.class.php *}
    {*purpose               Geocoordinates (latitute/longitude) *}
    {*author                {PYB} *}
    {*company               [br]Lato Sensu Management[br]
                            Rue Bois des Mazuis, 47[br]
                            5070 Vitrival[br]
                            Belgium[br]
                            [url]http://www.latosensu.be[/url][br]
                            Vae Soli! : [url]http://www.vaesoli.org[/url] *}
    {*cdate                 29/07/2020 - 11:45 *}
    {*mdate                 auto *}
    {*license               Submitted to intellectual property rights (see
                            author) *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 29/07/2020 - 11:45 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 10-02-21 06:54 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct()[/c] method
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\geocoordinates;

use \trql\quitus\Mother                             as Mother;
use \trql\quitus\iContext                           as iContext;
use \trql\vaesoli\Vaesoli                           as Vaesoli;
use \trql\structuredvalue\StructuredValue           as StructuredValue;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'STRUCTUREDVALUE_CLASS_VERSION' ) )
    require_once( 'trql.structuredvalue.class.php' );

defined( 'GEOCOORDINATES_CLASS_VERSION' ) or define( 'GEOCOORDINATES_CLASS_VERSION','0.1' );

/* Note (16-07-20 23:27:50):

    Le code doit se sauver lui-même dans une sorte de DB. Il doit se compresser
    lui-même et sauver au moins une dizaine de versions de lui-même.

*/

/* ================================================================================== */
/** {{*class GeoCoordinates=

    {*desc

        The geographic coordinates of a place or event.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/GeoCoordinates[/url] *}

    *}}
 */
/* ================================================================================== */
class GeoCoordinates extends StructuredValue implements iContext
/*------------------------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $address                = null;                     /* {*property   $address                    (PostalAddress|string)      Physical address of the item. *} */
    public      $addressCountry         = null;                     /* {*property   $addressCountry             (Country|string)            The country. For example, USA. You can also
                                                                                                                                            provide the two-letter ISO 3166-1 alpha-2
                                                                                                                                            country code. *} */
    public      $elevation              = null;                     /* {*property   $elevation                  (Number|string)             The elevation of a location (WGS 84). Values
                                                                                                                                            may be of the form 'NUMBER UNITOFMEASUREMENT'
                                                                                                                                            (e.g., '1,000 m', '3,200 ft') while numbers
                                                                                                                                            alone should be assumed to be a value in meters. *} */
    public      $latitude               = null;                     /* {*property   $latitude                   (Number|string)             The latitude of a location. For example
                                                                                                                                            37.42242 (WGS 84). *} */
    public      $longitude              = null;                     /* {*property   $longitude                  (Number|string)             The longitude of a location. For example
                                                                                                                                            -122.08585 (WGS 84). *} */
    public      $postalCode             = null;                     /* {*property   $postalCode                 (string)                    The postal code. For example, 94043. *} */


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
    }   /* End of Geocoordinates.__construct() ======================================== */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of Geocoordinates.speak() ============================================== */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of Geocoordinates.sing() =============================================== */
    /* ================================================================================ */


    public function __destruct()
    /*------------------------*/
    {
        //parent::__destruct();
        $this->backup();
        $this->autodoc();
        $this->UIKey();
        $this->WikiData();
        $this->necroSignaling();

    }   /* End of Geocoordinates.__destruct() ========================================= */
    /* ================================================================================ */

}   /* End of class Geocoordinates ==================================================== */
/* ==================================================================================== */
?>