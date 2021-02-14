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
    {*file                  trql.videoobject.class.php *}
    {*purpose               A video file. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 24-08-2020 03:31 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 24-08-2020 03:31 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 14-02-21 10:03 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\videoobject;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\mediaobject\MediaObject           as MediaObject;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'MEDIAOBJECT_CLASS_VERSION' ) )
    require_once( 'trql.mediaobject.class.php' );



defined( 'VIDEOOBJECT_CLASS_VERSION' ) or define( 'VIDEOOBJECT_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class VideoObject=

    {*desc

        A video file.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/VideoObject[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        and as such HAS NOT BEEN TESTED YET!
    *}

 */
/* ==================================================================================== */
class VideoObject extends MediaObject
/*---------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $actor              = null;                         /* {*property   $actor                      (Person)                        An actor, e.g. in tv, radio, movie, video games etc., or in an event. 
                                                                                                                                                Actors can be associated with individual items or with a series, 
                                                                                                                                                episode, clip. *} */
    public      $caption            = null;                         /* {*property   $caption                    (MediaObjec|string)             The caption for this object. For downloadable machine formats (closed 
                                                                                                                                                caption, subtitles etc.) use MediaObject and indicate the encodingFormat. *} */
    public      $director           = null;                         /* {*property   $director                   (Person)                        A director of e.g. tv, radio, movie, video gaming etc. content, or of an 
                                                                                                                                                event. Directors can be associated with individual items or with a series, 
                                                                                                                                                episode, clip. *} */
    public      $musicBy            = null;                         /* {*property   $musicBy                    (MusicGroup|Person)             The composer of the soundtrack. *} */
    public      $thumbnail          = null;                         /* {*property   $thumbnail                  (ImageObject)                   Thumbnail image for an image or video. *} */
    public      $transcript         = null;                         /* {*property   $transcript                 (string)                        If this MediaObject is an AudioObject or VideoObject, the transcript of that 
                                                                                                                                                object. *} */
    public      $videoFrameSize     = null;                         /* {*property   $videoFrameSize             (string)                        The frame size of the video. *} */
    public      $videoQuality       = null;                         /* {*property   $videoQuality               (string)                        The quality of the video. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */


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

        $this->die( __CLASS__ . ' has NOT been tested yet!' );

        return ( $this );
    }   /* End of VideoObject.__construct() =========================================== */
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
    }   /* End of VideoObject.__destruct() ============================================ */
    /* ================================================================================ */

}   /* End of class VideoObject ======================================================= */
/* ==================================================================================== */

?>