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
    {*file                  trql.broadcastservice.class.php *}
    {*purpose               A delivery service through which content is provided via
                            broadcast over the air or online. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:40 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}
    {*keywords              service *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:40 *}
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
namespace trql\broadcastservice;

use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\schema\Service       as Service;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'SERVICE_CLASS_VERSION' ) )
    require_once( 'trql.service.class.php' );

defined( 'BROADCASTSERVICE_CLASS_VERSION' ) or define( 'BROADCASTSERVICE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class BroadcastService=

    {*desc

        A delivery service through which content is provided via broadcast over the
        air or online.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/BroadcastService[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:40.
    *}

    *}}

 */
/* ==================================================================================== */
class BroadcastService extends Service
/*----------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $broadcastAffiliateOf           = null;             /* {*property   $broadcastAffiliateOf           (Organization)                  The media network(s) whose content is broadcast on this station. *} */
    public      $broadcastDisplayName           = null;             /* {*property   $broadcastDisplayName           (string)                        The name displayed in the channel guide. For many US affiliates, it is
                                                                                                                                                    the network name. *} */
    public      $broadcastFrequency             = null;             /* {*property   $broadcastFrequency             (string|BroadcastFrequencySpecification)The frequency used for over-the-air broadcasts. Numeric values or
                                                                                                                                                    simple ranges e.g. 87-99. In addition a shortcut idiom is supported
                                                                                                                                                    for frequences of AM and FM radio channels, e.g. "87 FM". *} */
    public      $broadcastTimezone              = null;             /* {*property   $broadcastTimezone              (string)                        The timezone in ISO 8601 format for which the service bases its
                                                                                                                                                    broadcasts *} */
    public      $broadcaster                    = null;             /* {*property   $broadcaster                    (Organization)                  The organization owning or operating the broadcast service. *} */
    public      $callSign                       = null;             /* {*property   $callSign                       (string)                        A callsign, as used in broadcasting and radio communications to
                                                                                                                                                    identify people, radio and TV stations, or vehicles. *} */
    public      $hasBroadcastChannel            = null;             /* {*property   $hasBroadcastChannel            (BroadcastChannel)              A broadcast channel of a broadcast service. *} */
    public      $inLanguage                     = null;             /* {*property   $inLanguage                     (string|Language)               The language of the content or performance or used in an action.
                                                                                                                                                    Please use one of the language codes from the IETF BCP 47 standard.
                                                                                                                                                    See also availableLanguage. *} */
    public      $parentService                  = null;             /* {*property   $parentService                  (BroadcastService)              A broadcast service to which the broadcast service may belong to such
                                                                                                                                                    as regional variations of a national channel. *} */
    public      $videoFormat                    = null;             /* {*property   $videoFormat                    (string)                        The type of screening or video broadcast used (e.g. IMAX, 3D, SD, HD,
                                                                                                                                                    etc.). *} */

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
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ),$withFamily = false );

        return ( $this );
    }   /* End of BroadcastService.__construct() ====================================== */
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
    }   /* End of BroadcastService.__destruct() ======================================= */
    /* ================================================================================ */
}   /* End of class BroadcastService ================================================== */
/* ==================================================================================== */
