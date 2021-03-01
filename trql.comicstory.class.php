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
    {*file                  trql.comicstory.class.php *}
    {*purpose               The term "story" is any indivisible, re-printable unit of a
                            comic, including the interior stories, covers, and
                            backmatter. Most comics have at least two stories: a cover
                            (ComicCoverArt) and an interior story. *}
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


    {*chist
        {*mdate 14-02-21 10:44 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */

/****************************************************************************************/
namespace trql\comicstory;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\creativework\CreativeWork         as CreativeWork;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );



defined( 'COMICSTORY_CLASS_VERSION' ) or define( 'COMICSTORY_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class ComicStory=

    {*desc

        The term "story" is any indivisible, re-printable unit of a comic,
        including the interior stories, covers, and backmatter. Most comics have at
        least two stories: a cover (ComicCoverArt) and an interior story.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/ComicStory[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:46. IT HAS NOT BEEN TESTED YET!
    *}

 */
/* ==================================================================================== */
class ComicStory extends CreativeWork
/*---------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );


    public      $colorist                       = null;             /* {*property   $colorist                       (Person)                        The individual who adds color to inked drawings. *} */
    public      $inker                          = null;             /* {*property   $inker                          (Person)                        The individual who traces over the pencil drawings in ink after
                                                                                                                                                    pencils are complete. *} */
    public      $letterer                       = null;             /* {*property   $letterer                       (Person)                        The individual who adds lettering, including speech balloons and sound
                                                                                                                                                    effects, to artwork. *} */
    public      $penciler                       = null;             /* {*property   $penciler                       (Person)                        The individual who draws the primary narrative artwork. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                        Wikidata ID. No equivalent. *} */


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
    }   /* End of ComicStory.__construct() ============================================ */
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
    }   /* End of ComicStory.__destruct() ============================================= */
    /* ================================================================================ */

}   /* End of class ComicStory ======================================================== */
/* ==================================================================================== */

?>