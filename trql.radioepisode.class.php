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
    {*file                  trql.radioepisode.class.php *}
    {*purpose               A radio episode which can be part of a series or season. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:28 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 28-08-2020 16:28 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\radioepisode;

use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\episode\Episode       as Episode;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'EPISODE_CLASS_VERSION' ) )
    require_once( 'trql.episode.class.php' );

defined( 'RADIOEPISODE_CLASS_VERSION' ) or define( 'RADIOEPISODE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class RadioEpisode=

    {*desc

        A radio episode which can be part of a series or season.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/RadioEpisode[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:28.
    *}

 */
/* ==================================================================================== */
class RadioEpisode extends Episode
/*------------------------------*/
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
    public      $director                       = null;             /* {*property   $director                       (Person)                        A director of e.g. tv, radio, movie, video gaming etc. content, or of
                                                                                                                                                    an event. Directors can be associated with individual items or with a
                                                                                                                                                    series, episode, clip. *} */
    public      $episodeNumber                  = null;             /* {*property   $episodeNumber                  (string|int)                    Position of the episode within an ordered group of episodes. *} */
    public      $musicBy                        = null;             /* {*property   $musicBy                        (Person|MusicGroup)             The composer of the soundtrack. *} */
    public      $partOfSeason                   = null;             /* {*property   $partOfSeason                   (CreativeWorkSeason)            The season to which this episode belongs. *} */
    public      $partOfSeries                   = null;             /* {*property   $partOfSeries                   (CreativeWorkSeries)            The series to which this episode or season belongs. *} */
    public      $productionCompany              = null;             /* {*property   $productionCompany              (Organization)                  The production company or studio responsible for the item e.g. series,
                                                                                                                                                    video game, episode etc. *} */
    public      $trailer                        = null;             /* {*property   $trailer                        (VideoObject)                   The trailer of a movie or tv/radio series, season, episode, etc. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q57608327';      /* {*property   $wikidataId                     (string)                        Wikidata ID. single installment of a radio series *} */


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
    }   /* End of RadioEpisode.__construct() ========================================== */
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
    }   /* End of RadioEpisode.__destruct() =========================================== */
    /* ================================================================================ */
}   /* End of class RadioEpisode ====================================================== */
/* ==================================================================================== */
?>