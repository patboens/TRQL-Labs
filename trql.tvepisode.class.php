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
    {*file                  trql.tvepisode.class.php *}
    {*purpose               A TV episode which can be part of a series or season. *}
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
namespace trql\tvepisode;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\episode\Episode    as Episode;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'EPISODE_CLASS_VERSION' ) )
    require_once( 'trql.episode.class.php' );



defined( 'TVEPISODE_CLASS_VERSION' ) or define( 'TVEPISODE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class TVEpisode=

    {*desc

        A TV episode which can be part of a series or season.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/TVEpisode[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:41.
    *}

 */
/* ==================================================================================== */
class TVEpisode extends Episode
/*---------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $countryOfOrigin                = null;             /* {*property   $countryOfOrigin                (Country)                       The country of the principal offices of the production company or
                                                                                                                                                    individual responsible for the movie or program. *} */
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



        return ( $this );
    }   /* End of TVEpisode.__construct() ============================================= */
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
    }   /* End of TVEpisode.__destruct() ============================================== */
    /* ================================================================================ */
}   /* End of class TVEpisode ========================================================= */
/* ==================================================================================== */
?>