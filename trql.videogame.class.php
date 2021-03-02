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
    {*file                  trql.videogame.class.php *}
    {*purpose               A video game is an electronic game that involves human 
                            interaction with a user interface to generate visual 
                            feedback on a video device. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 24-08-2020 03:31 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 24-08-2020 03:31 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 14-02-21 10:54 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\videogame;

use \trql\vaesoli\Vaesoli           as Vaesoli;
use \trql\game\Game                 as Game;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'GAME_CLASS_VERSION' ) )
    require_once( 'trql.game.class.php' );

defined( 'VIDEOGAME_CLASS_VERSION' ) or define( 'VIDEOGAME_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class VideoGame=

    {*desc

        A video game is an electronic game that involves human interaction with a user 
        interface to generate visual feedback on a video device.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/VideoGame[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]

    *}

 */
/* ==================================================================================== */
class VideoGame extends Game
/*-------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $actor                          = null;             /* {*property   $actor                      (Person)                        An actor, e.g. in tv, radio, movie, video games etc. Actors can 
                                                                                                                                                be associated with individual items or with a series, episode, 
                                                                                                                                                clip. *} */
    public      $cheatCode                      = null;             /* {*property   $cheatCode                  (CreativeWork)                  Cheat codes to the game. *} */
    public      $director                       = null;             /* {*property   $director                   (Person)                        A director of e.g. tv, radio, movie, video gaming etc. content, 
                                                                                                                                                or of an event. Directors can be associated with individual items 
                                                                                                                                                or with a series, episode, clip. *} */
    public      $gamePlatform                   = null;             /* {*property   $gamePlatform               (string|Thing|URL)              The electronic systems used to play video games. *} */
    public      $gameServer                     = null;             /* {*property   $gameServer                 (GameServer)                    The server on which it is possible to play the game. *} */
    public      $gameTip                        = null;             /* {*property   $gameTip                    (CreativeWork)                  Links to tips, tactics, etc. *} */
    public      $musicBy                        = null;             /* {*property   $musicBy                    (MusicGroup|Person)             The composer of the soundtrack. *} */
    public      $playMode                       = null;             /* {*property   $playMode                   (GamePlayMode)                  Indicates whether this game is multi-player, co-op or single-player. 
                                                                                                                                                The game can be marked as multi-player, co-op and single-player 
                                                                                                                                                at the same time. *} */
    public      $trailer                        = null;             /* {*property   $trailer                    (VideoObject)                   The trailer of a movie or tv/radio series, season, episode, etc. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q7889';          /* {*property   $wikidataId                     (string)                    Wikidata ID. Electronic game that involves interaction with a user 
                                                                                                                                                interface to generate visual feedback on a video device such as a
                                                                                                                                                TV screen or computer monitor *} */

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
    }   /* End of VideoGame.__construct() ============================================= */
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
    }   /* End of VideoGame.__destruct() ============================================== */
    /* ================================================================================ */
}   /* End of class VideoGame ========================================================= */
/* ==================================================================================== */
?>