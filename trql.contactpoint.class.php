<?php
/****************************************************************************************/
/*
    {PYB} is a shortcut for Patrick Boens

    {COMPANY} is a shortcut to "Lato Sensu Management"

    {RIGHTS} is a shortcut used by trql.documentor.class.php for
    All rights reserved to Lato Sensu Management for all countries.
    All Intellectual Property belongs to Patrick Boens.

    Other shortcuts exist. They exist to make it simple to change the formulation
    of parts that can vary over time.

    It does not change the undisputed truth that ALL code has been created by
    Patrick Boens, the author, who owns ALL the intellectual property of what
    he created.

*/

/** {{{*fheader
    {*file                  trql.contactpoint.class.php *}
    {*purpose               A contact point—for example, a Customer Complaints department. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 23-08-20 14:04 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 23-08-20 14:04 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 11-11-20 11:16 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Completing the [c]__destruct()[/c] method
                            2)  Adding a wikidata ID
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\contactpoint;

use \trql\quitus\Mother                             as Mother;
use \trql\quitus\iContext                           as iContext;
use \trql\vaesoli\Vaesoli                           as Vaesoli;
use \trql\place\Place                               as Place;
use \trql\structuredvalue\StructuredValue           as StructuredValue;
use \trql\schema\Thing                               as Thing;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'PLACE_CLASS_VERSION' ) )
    require_once( 'trql.place.class.php' );

if ( ! defined( 'PLACE_CLASS_VERSION' ) )
    require_once( 'trql.place.class.php' );

if ( ! defined( 'STRUCTUREDVALUE_CLASS_VERSION' ) )
    require_once( 'trql.structuredvalue.class.php' );

if ( ! defined( 'THING_CLASS_VERSION' ) )
    require_once( 'trql.thing.class.php' );

defined( 'CONTACTPOINT_CLASS_VERSION' ) or define( 'CONTACTPOINT_CLASS_VERSION','0.1' );

/* Note (16-07-20 23:27:50):

    Le code doit se sauver lui-même dans une sorte de DB. Il doit se compresser
    lui-même et sauver au moins une dizaine de versions de lui-même.

*/

/* ==================================================================================== */
/** {{*class ContactPoint=

    {*desc

        A contact point—for example, a Customer Complaints department.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/ContactPoint[/url] *}

    *}}
 */
/* ==================================================================================== */
class ContactPoint extends Thing implements iContext
/*------------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $areaServed             = null;                     /* {*property   $areaServed                 (AdministrativeArea|GeoShape|Place|string)      The geograpic area where a service or offered item is
                                                                                                                                                                provided. Supersedes serviceArea. *} */
    public      $availableLanguage      = null;                     /* {*property   $availableLanguage          (Language|string)                               A language someone may use with or at the item, service
                                                                                                                                                                or place. Please use one of the language codes from the
                                                                                                                                                                IETF BCP 47 standard. See also inLanguage *} */
    public      $contactOption          = null;                     /* {*property   $contactOption              (ContactPointOption)                            An option available on this contact point (e.g. a
                                                                                                                                                                toll-free number or support for hearing-impaired callers). *} */
    public      $contactType            = null;                     /* {*property   $contactType                (string)                                        A person or organization can have different contact
                                                                                                                                                                points, for different purposes. For example, a sales
                                                                                                                                                                contact point, a PR contact point and so on. This property
                                                                                                                                                                is used to specify the kind of contact point. *} */
    public      $email                  = null;                     /* {*property   $email                      (string)                                        Email address. *} */
    public      $faxNumber              = null;                     /* {*property   $faxNumber                  (string)                                        The fax number. *} */
    public      $hoursAvailable         = null;                     /* {*property   $hoursAvailable             (OpeningHoursSpecification)                     The hours during which this service or contact is available. *} */
    public      $productSupported       = null;                     /* {*property   $productSupported           (Product|string)                                The product or service this support contact point is
                                                                                                                                                                related to (such as product support for a particular
                                                                                                                                                                product line). This can be a specific product or
                                                                                                                                                                product line (e.g. "iPhone") or a general category of
                                                                                                                                                                products or services (e.g. "smartphones"). *} */
    public      $telephone              = null;                     /* {*property   $telephone                  (string)                                        The telephone number. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId             = 'Q30322502';              /* {*property   $wikidataId                 (string)                                        WikidataId ... entity serving as focal point of information *} */



    /* ================================================================================ */
    /** {{*__construct( [$szHome] )=

        Class constructor

        {*params
            $szHome     (string)        Home of the class. Optional.
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*example
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
    }   /* End of ContactPoint.__construct() ========================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*speak()=

        Generate a text in line with the Administrative Area

        {*params
        *}

        {*return
            (string)    A text representing the object
        *}

        *}}
    */
    /* ================================================================================ */
    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of ContactPoint.speak() ================================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*sing()=

        Generate a text-to-speech file corresponding to a string

        {*params
        *}

        {*return
            (string)    A URL where the text-to-speech file (.mp3) is available
        *}

        *}}
    */
    /* ================================================================================ */
    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of ContactPoint.sing() ================================================= */
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
    }   /* End of ContactPoint.__destruct() =========================================== */
    /* ================================================================================ */

}   /* End of class ContactPoint ====================================================== */
/* ==================================================================================== */
?>