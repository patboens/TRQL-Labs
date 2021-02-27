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
    {*file                  trql.musiccomposition.class.php *}
    {*purpose               A musical composition. *}
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
namespace trql\musiccomposition;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\creativework\CreativeWork     as CreativeWork;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );

defined( 'MUSICCOMPOSITION_CLASS_VERSION' ) or define( 'MUSICCOMPOSITION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class MusicComposition=

    {*desc

        A musical composition.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/MusicComposition[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 21:39.
    *}

 */
/* ==================================================================================== */
class MusicComposition extends CreativeWork
/*---------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $composer                       = null;             /* {*property   $composer                       (Person|Organization)           The person or organization who wrote a composition, or who is the
                                                                                                                                                    composer of a work performed at some event. *} */
    public      $firstPerformance               = null;             /* {*property   $firstPerformance               (Event)                         The date and place the work was first performed. *} */
    public      $includedComposition            = null;             /* {*property   $includedComposition            (MusicComposition)              Smaller compositions included in this work (e.g. a movement in a
                                                                                                                                                    symphony). *} */
    public      $iswcCode                       = null;             /* {*property   $iswcCode                       (string)                        The International Standard Musical Work Code for the composition. *} */
    public      $lyricist                       = null;             /* {*property   $lyricist                       (Person)                        The person who wrote the words. *} */
    public      $lyrics                         = null;             /* {*property   $lyrics                         (CreativeWork)                  The words in the song. *} */
    public      $musicArrangement               = null;             /* {*property   $musicArrangement               (MusicComposition)              An arrangement derived from the composition. *} */
    public      $musicCompositionForm           = null;             /* {*property   $musicCompositionForm           (string)                        The type of composition (e.g. overture, sonata, symphony, etc.). *} */
    public      $musicalKey                     = null;             /* {*property   $musicalKey                     (string)                        The key, mode, or scale this composition uses. *} */
    public      $recordedAs                     = null;             /* {*property   $recordedAs                     (MusicRecording)                An audio recording of the work. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q207628';        /* {*property   $wikidataId                     (string)                        Wikidata ID. Original piece or work of music, either vocal or 
                                                                                                                                                    instrumental, the structure of a musical piece *} */


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
    }   /* End of MusicComposition.__construct() ====================================== */
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
    }   /* End of MusicComposition.__destruct() ======================================= */
    /* ================================================================================ */
}   /* End of class MusicComposition ================================================== */
/* ==================================================================================== */
?>