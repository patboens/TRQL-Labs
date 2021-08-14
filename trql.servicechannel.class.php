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
    {*file                  trql.servicechannel.class.php *}
    {*purpose               A means for accessing a service, e.g. a government office
                            location, web site, or phone number. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:30 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}
    {*keywords              service *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 28-08-2020 16:30 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\schemachannel;

use \trql\vaesoli\Vaesoli           as Vaesoli;
use \trql\schema\Intangible     as Intangible;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'INTANGIBLE_CLASS_VERSION' ) )
    require_once( 'trql.intangible.class.php' );

defined( 'SERVICECHANNEL_CLASS_VERSION' ) or define( 'SERVICECHANNEL_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class ServiceChannel=

    {*desc

        A means for accessing a service, e.g. a government office location, web
        site, or phone number.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/ServiceChannel[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:30.
    *}

    *}}

 */
/* ==================================================================================== */
class ServiceChannel extends Intangible
/*-----------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $availableLanguage              = null;             /* {*property   $availableLanguage              (string|Language)               A language someone may use with or at the item, service or place.
                                                                                                                                                    Please use one of the language codes from the IETF BCP 47 standard.
                                                                                                                                                    See also inLanguage *} */
    public      $processingTime                 = null;             /* {*property   $processingTime                 (Duration)                      Estimated processing time for the service using this channel. *} */
    public      $providesService                = null;             /* {*property   $providesService                (Service)                       The service provided by this channel. *} */
    public      $serviceLocation                = null;             /* {*property   $serviceLocation                (Place)                         The location (e.g. civic structure, local business, etc.) where a
                                                                                                                                                    person can go to access the service. *} */
    public      $servicePhone                   = null;             /* {*property   $servicePhone                   (ContactPoint)                  The phone number to use to access the service. *} */
    public      $servicePostalAddress           = null;             /* {*property   $servicePostalAddress           (PostalAddress)                 The address for accessing the service by mail. *} */
    public      $serviceSmsNumber               = null;             /* {*property   $serviceSmsNumber               (ContactPoint)                  The number to access the service by text message. *} */
    public      $serviceUrl                     = null;             /* {*property   $serviceUrl                     (URL)                           The website to access the service. *} */

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
    }   /* End of ServiceChannel.__construct() ======================================== */
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
    }   /* End of ServiceChannel.__destruct() ========================================= */
    /* ================================================================================ */
}   /* End of class ServiceChannel ==================================================== */
/* ==================================================================================== */
