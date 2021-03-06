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
    {*file                  trql.musicalbum.class.php *}
    {*purpose               A collection of music tracks. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 21:39 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 21:39 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 14-02-21 09:28 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\musicalbum;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\musicplaylist\MusicPlaylist       as MusicPlaylist;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'MUSICPLAYLIST_CLASS_VERSION' ) )
    require_once( 'trql.musicplaylist.class.php' );

defined( 'MUSICALBUM_CLASS_VERSION' ) or define( 'MUSICALBUM_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class MusicAlbum=

    {*desc

        A collection of music tracks.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/MusicAlbum[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 21:39.
    *}

 */
/* ==================================================================================== */
class MusicAlbum extends MusicPlaylist
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

    public      $albumProductionType            = null;             /* {*property   $albumProductionType            (MusicAlbumProductionType)      Classification of the album by it's type of content: soundtrack, live
                                                                                                                                                    album, studio album, etc. *} */
    public      $albumRelease                   = null;             /* {*property   $albumRelease                   (MusicRelease)                  A release of this album. *} */
    public      $albumReleaseType               = null;             /* {*property   $albumReleaseType               (MusicAlbumReleaseType)         The kind of release which this album is: single, EP or album. *} */
    public      $byArtist                       = null;             /* {*property   $byArtist                       (Person|MusicGroup)             The artist that performed this album or recording. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q482994';        /* {*property   $wikidataId                     (string)                        Wikidata ID. Album: collection of recorded music, words, sounds *} */


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
    }   /* End of MusicAlbum.__construct() ============================================ */
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
    }   /* End of MusicAlbum.__destruct() ============================================= */
    /* ================================================================================ */
}   /* End of class MusicAlbum ======================================================== */
/* ==================================================================================== */
?>