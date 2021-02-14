<?php
/****************************************************************************************/
/** {{{*fheader
    {*file                  trql.musicgroup.class.php *}
    {*purpose               A musical group, such as a band, an orchestra, or a choir. 
                            Can also be a solo musician. *}
    {*author                {PYB} *}
    {*company               [br]Lato Sensu Management[br]
                            Rue Bois des Mazuis, 47[br]
                            5070 Vitrival[br]
                            Belgium[br]
                            [url]http://www.latosensu.be[/url][br]
                            Vae Soli! : [url]http://www.vaesoli.org[/url] *}
    {*cdate                 31-07-20 16:08 *}
    {*mdate                 auto *}
    {*license               Submitted to intellectual property rights (see
                            author) *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 31-07-20 16:08 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 14-02-21 08:55 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\musicgroup;

use \trql\mother\Mother                     as Mother;
use \trql\mother\iContext                   as iContext;
use \trql\context\Context                   as Context;
use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\performinggroup\PerformingGroup   as PerformingGroup;


use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'PERFORMINGGROUP_CLASS_VERSION' ) )
    require_once( 'trql.performinggroup.class.php' );

defined( 'MUSICGROUP_CLASS_VERSION' ) or define( 'MUSICGROUP_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class MusicGroup=

    {*desc

        A musical group, such as a band, an orchestra, or a choir. Can also be a solo 
        musician.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/MusicGroup[/url] *}


    *}}
 */
/* ==================================================================================== */
class MusicGroup extends PerformingGroup
/*------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $album                  = null;                     /* {*property   $album                      (MusicAlbum)                    A music album. Supersedes albums. *} */
    public      $genre                  = null;                     /* {*property   $genre                      (Text|URL)                      Genre of the creative work, broadcast channel or group. *} */
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
    }   /* End of MusicGroup.__construct() ============================================ */
    /* ================================================================================ */


    public function templates( $oContext = null )
    /*-----------------------------------------*/
    {
        $aRetVal = null;

        $this->die( __METHOD__ . "() : SHOULD RETURN TEMPLATES\n" );

        return ( $aRetVal );
    }   /* End of MusicGroup.templates() ============================================== */
    /* ================================================================================ */


    public function substitutions( $oContext = null )
    /*---------------------------------------------*/
    {
        $aRetVal = null;

        $this->die( __METHOD__ . "() : SHOULD RETURN SUBSTITUTIONS\n" );

        return ( $aRetVal );
    }   /* End of MusicGroup.substitutions() ========================================== */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of MusicGroup.speak() ================================================== */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of MusicGroup.sing() =================================================== */
    /* ================================================================================ */


    public function __destruct()
    /*------------------------*/
    {
        $this->backup();
        $this->autodoc();
        $this->UIKey();
        $this->WikiData();
        $this->necroSignaling();
    }   /* End of MusicGroup.__destruct() ============================================= */
    /* ================================================================================ */

}   /* End of class MusicGroup ======================================================== */
/* ==================================================================================== */

class Musician extends MusicGroup
/*-------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

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
    }   /* End of Musician.__construct() ============================================== */
    /* ================================================================================ */


    public function templates( $oContext = null )
    /*-----------------------------------------*/
    {
        $aRetVal = null;

        $this->die( __METHOD__ . "() : SHOULD RETURN TEMPLATES\n" );

        return ( $aRetVal );
    }   /* End of Musician.templates() ================================================ */
    /* ================================================================================ */


    public function substitutions( $oContext = null )
    /*---------------------------------------------*/
    {
        $aRetVal = null;

        $this->die( __METHOD__ . "() : SHOULD RETURN SUBSTITUTIONS\n" );

        return ( $aRetVal );
    }   /* End of Musician.substitutions() ============================================ */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of Musician.speak() ==================================================== */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of Musician.sing() ===================================================== */
    /* ================================================================================ */


    public function __destruct()
    /*------------------------*/
    {
        $this->backup();
        $this->autodoc();
        $this->UIKey();
        $this->WikiData();
        $this->necroSignaling();
    }   /* End of Musician.__destruct() =============================================== */
    /* ================================================================================ */

}   /* End of class Musician ========================================================== */
/* ==================================================================================== */
?>