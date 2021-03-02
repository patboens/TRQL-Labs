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
    {*file                  trql.musicrelease.class.php *}
    {*purpose               A MusicRelease is a specific release of a music album. *}
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
namespace trql\musicrelease;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\musicplaylist\MusicPlaylist    as MusicPlaylist;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'MUSICPLAYLIST_CLASS_VERSION' ) )
    require_once( 'trql.musicplaylist.class.php' );



defined( 'MUSICRELEASE_CLASS_VERSION' ) or define( 'MUSICRELEASE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class MusicRelease=

    {*desc

        A MusicRelease is a specific release of a music album.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/MusicRelease[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 21:39.
    *}

 */
/* ==================================================================================== */
class MusicRelease extends MusicPlaylist
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

    public      $catalogNumber                  = null;             /* {*property   $catalogNumber                  (string)                        The catalog number for the release. *} */
    public      $creditedTo                     = null;             /* {*property   $creditedTo                     (Person|Organization)           The group the release is credited to if different than the byArtist.
                                                                                                                                                    For example, Red and Blue is credited to "Stefani Germanotta Band",
                                                                                                                                                    but by Lady Gaga. *} */
    public      $duration                       = null;             /* {*property   $duration                       (Duration)                      The duration of the item (movie, audio recording, event, etc.) in ISO
                                                                                                                                                    8601 date format. *} */
    public      $musicReleaseFormat             = null;             /* {*property   $musicReleaseFormat             (MusicReleaseFormatType)        Format of this release (the type of recording media used, ie. compact
                                                                                                                                                    disc, digital media, LP, etc.). *} */
    public      $recordLabel                    = null;             /* {*property   $recordLabel                    (Organization)                  The label that issued the release. *} */
    public      $releaseOf                      = null;             /* {*property   $releaseOf                      (MusicAlbum)                    The album this is a release of. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q2031291';       /* {*property   $wikidataId                     (string)                        Wikidata ID. Release: publication of a musical artist's 
                                                                                                                                                    creative output *} */


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
    }   /* End of MusicRelease.__construct() ========================================== */
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
    }   /* End of MusicRelease.__destruct() =========================================== */
    /* ================================================================================ */
}   /* End of class MusicRelease ====================================================== */
/* ==================================================================================== */
?>