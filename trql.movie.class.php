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
    {*file                  trql.movie.class.php *}
    {*purpose               A movie. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:50 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:50 *}
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
namespace trql\movie;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\creativework\CreativeWork     as CreativeWork;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );

defined( 'MOVIE_CLASS_VERSION' ) or define( 'MOVIE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Movie=

    {*desc

        A movie.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Movie[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:50. IT HAS NOT BEEN TESTED YET!
    *}

 */
/* ==================================================================================== */
class Movie extends CreativeWork
/*----------------------------*/
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
    public      $countryOfOrigin                = null;             /* {*property   $countryOfOrigin                (Country)                       The country of the principal offices of the production company or
                                                                                                                                                    individual responsible for the movie or program. *} */
    public      $director                       = null;             /* {*property   $director                       (Person)                        A director of e.g. tv, radio, movie, video gaming etc. content, or of
                                                                                                                                                    an event. Directors can be associated with individual items or with a
                                                                                                                                                    series, episode, clip. *} */
    public      $duration                       = null;             /* {*property   $duration                       (Duration)                      The duration of the item (movie, audio recording, event, etc.) in ISO
                                                                                                                                                    8601 date format. *} */
    public      $musicBy                        = null;             /* {*property   $musicBy                        (Person|MusicGroup)             The composer of the soundtrack. *} */
    public      $productionCompany              = null;             /* {*property   $productionCompany              (Organization)                  The production company or studio responsible for the item e.g. series,
                                                                                                                                                    video game, episode etc. *} */
    public      $subtitleLanguage               = null;             /* {*property   $subtitleLanguage               (string|Language)               Languages in which subtitles/captions are available, in IETF BCP 47
                                                                                                                                                    standard format. *} */
    public      $titleEIDR                      = null;             /* {*property   $titleEIDR                      (string|URL)                    An EIDR (Entertainment Identifier Registry) identifier representing at
                                                                                                                                                    the most general/abstract level, a work of film or television.For
                                                                                                                                                    example, the motion picture known as "Ghostbusters" has a titleEIDR of
                                                                                                                                                    "10.5240/7EC7-228A-510A-053E-CBB8-J". This title (or work) may have
                                                                                                                                                    several variants, which EIDR calls "edits". See editEIDR.Since
                                                                                                                                                    schema.org types like Movie and TVEpisode can be used for both works
                                                                                                                                                    and their multiple expressions, it is possible to use titleEIDR alone
                                                                                                                                                    (for a general description), or alongside editEIDR for a more
                                                                                                                                                    edit-specific description. *} */
    public      $trailer                        = null;             /* {*property   $trailer                        (VideoObject)                   The trailer of a movie or tv/radio series, season, episode, etc. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q11424';         /* {*property   $wikidataId                     (string)                        Wikidata ID. Film (aliases: movie, motion picture, cinematic work,
                                                                                                                                                    films, flick, moving picture): audiovisual work *} */


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
    }   /* End of Movie.__construct() ================================================= */
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
    }   /* End of Movie.__destruct() ================================================== */
    /* ================================================================================ */
}   /* End of class Movie ============================================================= */
/* ==================================================================================== */
?>