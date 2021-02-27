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
    {*file                  trql.broadcastchannel.class.php *}
    {*purpose               A unique instance of a BroadcastService on a CableOrSatelliteService lineup. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 24-08-2020 01:04 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 24-08-2020 01:04 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 14-02-21 10:03 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\broadcastchannel;

use \trql\vaesoli\Vaesoli           as Vaesoli;
use \trql\intangible\Intangible     as Intangible;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'INTANGIBLE_CLASS_VERSION' ) )
    require_once( 'trql.intangible.class.php' );

defined( 'BROADCASTCHANNEL_CLASS_VERSION' ) or define( 'BROADCASTCHANNEL_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class BroadcastChannel=

    {*desc

        A unique instance of a BroadcastService on a CableOrSatelliteService lineup.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/BroadcastChannel[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
    *}

 */
/* ==================================================================================== */
class BroadcastChannel extends Intangible
/*--------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $broadcastChannelId         = null;                 /* {*property   $broadcastChannelId         (string)                                        The unique address by which the BroadcastService can be identified in a 
                                                                                                                                                                provider lineup. In US, this is typically a number. *} */
    public      $broadcastFrequency         = null;                 /* {*property   $broadcastFrequency         (BroadcastFrequencySpecification|string)        The frequency used for over-the-air broadcasts. Numeric values or simple
                                                                                                                                                                ranges e.g. 87-99. In addition a shortcut idiom is supported for 
                                                                                                                                                                frequences of AM and FM radio channels, e.g. "87 FM". *} */
    public      $broadcastServiceTier       = null;                 /* {*property   $broadcastServiceTier       (string)                                        The type of service required to have access to the channel 
                                                                                                                                                                (e.g. Standard or Premium). *} */
    public      $genre                      = null;                 /* {*property   $genre                      (string|URL)                                    Genre of the creative work, broadcast channel or group. *} */
    public      $inBroadcastLineup          = null;                 /* {*property   $inBroadcastLineup          (CableOrSatelliteService)                       The CableOrSatelliteService offering the channel. *} */
    public      $providesBroadcastService   = null;                 /* {*property   $providesBroadcastService   (BroadcastService)                              The BroadcastService offered on this channel. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                 = null;                 /* {*property   $wikidataId                 (string)                                        Wikidata ID. No equivalent. *} */


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
    }   /* End of BroadcastChannel.__construct() ====================================== */
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
    }   /* End of BroadcastChannel.__destruct() ======================================= */
    /* ================================================================================ */
}   /* End of class BroadcastChannel ================================================== */
/* ==================================================================================== */
?>