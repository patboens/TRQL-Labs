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

    The code of this class has been generated by 

*/

/** {{{*fheader
    {*file                  trql.videogameseries.class.php *}
    {*purpose               A video game series. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:41 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 28-08-2020 16:41 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\videogameseries;

use \trql\vaesoli\Vaesoli                           as Vaesoli;
use \trql\creativeworkseries\CreativeWorkSeries     as CreativeWorkSeries;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORKSERIES_CLASS_VERSION' ) )
    require_once( 'trql.creativeworkseries.class.php' );

defined( 'VIDEOGAMESERIES_CLASS_VERSION' ) or define( 'VIDEOGAMESERIES_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class VideoGameSeries=

    {*desc

        A video game series.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/VideoGameSeries[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:41. IT HAS NOT BEEN TESTED YET!
    *}

 */
/* ==================================================================================== */
class VideoGameSeries extends CreativeWorkSeries
/*--------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $actor                          = null;             /* {*property   $actor                          (Person)                        An actor, e.g. in tv, radio, movie, video games etc., or in an event.
                                                                                                                                                    Actors can be associated with individual items or with a series,
                                                                                                                                                    episode, clip. *} */
    public      $characterAttribute             = null;             /* {*property   $characterAttribute             (Thing)                         A piece of data that represents a particular aspect of a fictional
                                                                                                                                                    character (skill, power, character points, advantage, disadvantage). *} */
    public      $cheatCode                      = null;             /* {*property   $cheatCode                      (CreativeWork)                  Cheat codes to the game. *} */
    public      $containsSeason                 = null;             /* {*property   $containsSeason                 (CreativeWorkSeason)            A season that is part of the media series. *} */
    public      $director                       = null;             /* {*property   $director                       (Person)                        A director of e.g. tv, radio, movie, video gaming etc. content, or of
                                                                                                                                                    an event. Directors can be associated with individual items or with a
                                                                                                                                                    series, episode, clip. *} */
    public      $episode                        = null;             /* {*property   $episode                        (Episode)                       An episode of a tv, radio or game media within a series or season. *} */
    public      $gameItem                       = null;             /* {*property   $gameItem                       (Thing)                         An item is an object within the game world that can be collected by a
                                                                                                                                                    player or, occasionally, a non-player character. *} */
    public      $gameLocation                   = null;             /* {*property   $gameLocation                   (URL|PostalAddress|Place)       Real or fictional location of the game (or part of game). *} */
    public      $gamePlatform                   = null;             /* {*property   $gamePlatform                   (Thing|URL|string)              The electronic systems used to play video games. *} */
    public      $musicBy                        = null;             /* {*property   $musicBy                        (Person|MusicGroup)             The composer of the soundtrack. *} */
    public      $numberOfEpisodes               = null;             /* {*property   $numberOfEpisodes               (int)                           The number of episodes in this season or series. *} */
    public      $numberOfPlayers                = null;             /* {*property   $numberOfPlayers                (QuantitativeValue)             Indicate how many people can play this game (minimum, maximum, or
                                                                                                                                                    range). *} */
    public      $numberOfSeasons                = null;             /* {*property   $numberOfSeasons                (int)                           The number of seasons in this series. *} */
    public      $playMode                       = null;             /* {*property   $playMode                       (GamePlayMode)                  Indicates whether this game is multi-player, co-op or single-player.
                                                                                                                                                    The game can be marked as multi-player, co-op and single-player at the
                                                                                                                                                    same time. *} */
    public      $productionCompany              = null;             /* {*property   $productionCompany              (Organization)                  The production company or studio responsible for the item e.g. series,
                                                                                                                                                    video game, episode etc. *} */
    public      $quest                          = null;             /* {*property   $quest                          (Thing)                         The task that a player-controlled character, or group of characters
                                                                                                                                                    may complete in order to gain a reward. *} */
    public      $trailer                        = null;             /* {*property   $trailer                        (VideoObject)                   The trailer of a movie or tv/radio series, season, episode, etc. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                        Wikidata ID. NOT CHECKED SO FAR (25-02-21 18:17:24). *} */


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

        $this->die( __CLASS__ . ' has NOT been tested yet! Disable this line when you have tested the class.' );

        return ( $this );
    }   /* End of VideoGameSeries.__construct() ======================================= */
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
    }   /* End of VideoGameSeries.__destruct() ======================================== */
    /* ================================================================================ */
}   /* End of class VideoGameSeries =================================================== */
/* ==================================================================================== */
?>