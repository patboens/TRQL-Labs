<?php
/****************************************************************************************/
/** {{{*fheader
    {*file                  trql.musicrecording.class.php *}
    {*purpose               A music recording (track), usually a single song. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 24-08-20 08:18 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 24-08-20 08:18 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*todo
    
        Merge this high-level definition of a music playlist with trql-radio.playlist.class.php

    *}

    *}}} */
/****************************************************************************************/
namespace trql\musicrecording;

use \trql\quitus\Mother                     as Mother;
use \trql\quitus\iContext                   as iContext;
use \trql\context\Context                   as Context;
use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\schema\creativework\CreativeWork         as CreativeWork;


use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );

defined( 'MUSICRECORDING_CLASS_VERSION' ) or define( 'MUSICRECORDING_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class MusicRecording=

    {*desc

        A music recording (track), usually a single song.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/MusicRecording[/url] *}


    *}}
 */
/* ==================================================================================== */
class MusicRecording extends CreativeWork
/*-------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $byArtist               = null;                     /* {*property   $byArtist                   (MusicGroup|Person)             The artist that performed this album or recording. *} */
    public      $duration               = null;                     /* {*property   $duration                   (Duration)                      The duration of the item (movie, audio recording, event, 
                                                                                                                                                etc.) in ISO 8601 date format. *} */
    public      $inAlbum                = null;                     /* {*property   $inAlbum                    (MusicAlbum)                    The album to which this recording belongs. *} */
    public      $inPlaylist             = null;                     /* {*property   $inPlaylist                 (MusicPlaylist)                 The playlist to which this recording belongs. *} */
    public      $isrcCode               = null;                     /* {*property   $isrcCode                   (string)                        The International Standard Recording Code for the recording. *} */
    public      $recordingOf            = null;                     /* {*property   $recordingOf                (MusicComposition)              The composition this track is a recording of.
                                                                                                                                                Inverse property: [c]recordedAs[/c]. *} */


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
    }   /* End of MusicRecording.__construct() ======================================== */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of MusicRecording.speak() ============================================== */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of MusicRecording.sing() =============================================== */
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
    }   /* End of MusicRecording.__destruct() ========================================== */
    /* ================================================================================= */

}   /* End of class MusicRecording ===================================================== */
/* ===================================================================================== */

?>