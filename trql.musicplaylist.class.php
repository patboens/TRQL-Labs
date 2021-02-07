<?php
/****************************************************************************************/
/** {{{*fheader
    {*file                  trql.musicplaylist.class.php *}
    {*purpose               A collection of music tracks in playlist form. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 24-08-20 08:09 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 24-08-20 08:09 *}
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
namespace trql\musicplaylist;

use \trql\mother\Mother                     as Mother;
use \trql\mother\iContext                   as iContext;
use \trql\context\Context                   as Context;
use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\creativework\CreativeWork         as CreativeWork;


use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );

defined( 'MUSICPLAYLIST_CLASS_VERSION' ) or define( 'MUSICPLAYLIST_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class MusicPlaylist=

    {*desc

        A collection of music tracks in playlist form.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/MusicPlaylist[/url] *}

    {*warning
        The class must be extended/merged with [c]trql-radio.playlist.class.php[/c]

    *}}
 */
/* ==================================================================================== */
class MusicPlaylist extends CreativeWork
/*------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $numTracks              = null;                     /* {*property   $numTracks                  (int)                           The number of tracks in this album or playlist. *} */
    public      $track                  = null;                     /* {*property   $track                      (ItemList|MusicRecording)       A music recording (track)—usually a single song. If an 
                                                                                                                                                ItemList is given, the list should contain items of type
                                                                                                                                                MusicRecording. Supersedes tracks. *} */

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
    }   /* End of MusicPlaylist.__construct() ========================================= */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of MusicPlaylist.speak() =============================================== */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of MusicPlaylist.sing() ================================================ */
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
    }   /* End of MusicPlaylist.__destruct() ========================================== */
    /* ================================================================================ */

}   /* End of class MusicPlaylist ===================================================== */
/* ==================================================================================== */

?>