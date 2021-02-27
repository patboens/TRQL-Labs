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
    {*file                  trql.creativeworkseason.class.php *}
    {*purpose               A media season e.g. tv, radio, video game etc. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:46 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:46 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\creativeworkseason;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\creativework\CreativeWork     as CreativeWork;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );

defined( 'CREATIVEWORKSEASON_CLASS_VERSION' ) or define( 'CREATIVEWORKSEASON_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class CreativeWorkSeason=

    {*desc

        A media season e.g. tv, radio, video game etc.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/CreativeWorkSeason[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:46. IT HAS NOT BEEN TESTED YET!
    *}

 */
/* ==================================================================================== */
class CreativeWorkSeason extends CreativeWork
/*-----------------------------------------*/
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
    public      $endDate                        = null;             /* {*property   $endDate                        (Date|DateTime)                 The end date and time of the item (in ISO 8601 date format). *} */
    public      $episode                        = null;             /* {*property   $episode                        (Episode)                       An episode of a tv, radio or game media within a series or season. *} */
    public      $numberOfEpisodes               = null;             /* {*property   $numberOfEpisodes               (int)                           The number of episodes in this season or series. *} */
    public      $partOfSeries                   = null;             /* {*property   $partOfSeries                   (CreativeWorkSeries)            The series to which this episode or season belongs. *} */
    public      $productionCompany              = null;             /* {*property   $productionCompany              (Organization)                  The production company or studio responsible for the item e.g. series,
                                                                                                                                                    video game, episode etc. *} */
    public      $seasonNumber                   = null;             /* {*property   $seasonNumber                   (int|string)                    Position of the season within an ordered group of seasons. *} */
    public      $startDate                      = null;             /* {*property   $startDate                      (DateTime|Date)                 The start date and time of the item (in ISO 8601 date format). *} */
    public      $trailer                        = null;             /* {*property   $trailer                        (VideoObject)                   The trailer of a movie or tv/radio series, season, episode, etc. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q70990126';      /* {*property   $wikidataId                     (string)                        Wikidata ID. Set of creative works. *} */


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
    }   /* End of CreativeWorkSeason.__construct() ==================================== */
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
    }   /* End of CreativeWorkSeason.__destruct() ===================================== */
    /* ================================================================================ */
}   /* End of class CreativeWorkSeason ================================================ */
/* ==================================================================================== */
?>