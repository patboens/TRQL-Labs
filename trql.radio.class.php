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
    {*file                  trql.radio.class.php *}
    {*purpose               TRQL Radio code to create and manage radio stations *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 11-05-21 04:46 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}
    {*todo                  1) Implement the [c]RadioSeries[/c] class as we have done
                               it on the TRQL Radio web site and for the California
                               Spirit Radioshow. This class must be modified as to
                               make sure we can, if applicable, assign it a radio
                               station.
    *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 11-05-21 04:46 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation. Most of the code in here comes from
                                previous work (from 2017 to 2020) which has been 
                                created for the handling of TRQL Radio.
                            2)  This code makes the link between the work made in the
                                past and the newly created trql.radiostation.class.php
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\quitus;

use \trql\vaesoli\Vaesoli                   as V;
use \trql\schema\RadioStation               as RadioStation;
use \trql\quitus\Wikipedia                  as Wikipedia;
use \trql\schema\organization\MusicGroup    as MusicGroup;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'RADIOSTATION_CLASS_VERSION' ) )
    require_once( 'trql.radiostation.class.php' );

if ( ! defined( 'WIKIPEDIA_CLASS_VERSION' ) )
    require_once( 'trql.wikipedia.class.php' );

if ( ! defined( 'MUSICGROUP_CLASS_VERSION' ) )
    require_once( 'trql.musicgroup.class.php' );

defined( 'RADIO_CLASS_VERSION' ) or define( 'RADIO_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Radio=

    {*desc

        TRQL Radio code that makes it possible to create radios that are handled either
        has sub-radios of TRQL Radio or as independent radio stations

    *}

    *}}
 */
/* ==================================================================================== */
class Radio extends RadioStation
/*----------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

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
    }   /* End of Radio.__construct() ================================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*getArtistInfo( $szArtist[,$szLang] )=

        Get info about an artist

        {*params
            $szArtist       (string)        Name of the artist (or group)
            $szLang         (string)        Optional language. 'en' by default. The 
                                            language merely serves to perform searches
                                            on WikiData. Not much attention should be
                                            paid to it.
        *}

        {*return
            (array)     Returns an associative array of results pertaining to 
                        @param.szArtist
        *}

        *}}
    */
    /* ================================================================================ */
    public function getArtistInfo( $szArtist,$szLang = 'en' )
    /*-----------------------------------------------------*/
    {
        $aInfo = null;
        static $oWiki = null;
        static $oArtist = null;

        /* An artist, in this case, is a music group : A musical group, such as
           a band, an orchestra, or a choir. Can also be a solo musician. */
        if ( is_null( $oArtist ) )
            $oArtist = new MusicGroup();

        $aInfo = $oArtist->getInfo( $szArtist,$szLang );

        end:
        return ( $aInfo );
    }   /* End of Radio.getArtistInfo() =============================================== */
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
    }   /* End of Radio.__destruct() ================================================== */
    /* ================================================================================ */
}   /* End of class Radio ============================================================= */
/* ==================================================================================== */
