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
    {*file                  trql.mediaobject.class.php *}
    {*purpose               A media object, such as an image, video, or audio
                            object embedded in a web page or a downloadable
                            dataset i.e. DataDownload. Note that a creative
                            work may have many media objects associated with
                            it on the same web page. For example, a page about
                            a single song (MusicRecording) may have a music
                            video (VideoObject), and a high and low bandwidth
                            audio stream (2 AudioObject's). *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 24-08-2020 01:21 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 24-08-2020 01:21 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\mediaobject;

use \trql\thing\Thing                       as Thing;
use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\creativework\CreativeWork         as CreativeWork;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );



defined( 'MEDIAOBJECT_CLASS_VERSION' ) or define( 'MEDIAOBJECT_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class MediaObject=

    {*desc

        A media object, such as an image, video, or audio object embedded in a web
        page or a downloadable dataset i.e. DataDownload. Note that a creative work
        may have many media objects associated with it on the same web page. For
        example, a page about a single song (MusicRecording) may have a music video
        (VideoObject), and a high and low bandwidth audio stream (2 AudioObject's).

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/MediaObject[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        and as such HAS NOT BEEN TESTED YET!
    *}

 */
/* ==================================================================================== */
class MediaObject extends CreativeWork
/*----------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $associatedArticle      = null;                     /* {*property   $associatedArticle      (NewsArticle)                   A NewsArticle associated with the Media Object. *} */
    public      $bitrate                = null;                     /* {*property   $bitrate                (string)                        The bitrate of the media object. *} */
    public      $contentSize            = null;                     /* {*property   $contentSize            (string)                        File size in (mega/kilo) bytes. *} */
    public      $contentUrl             = null;                     /* {*property   $contentUrl             (URL)                           Actual bytes of the media object, for example the image
                                                                                                                                            file or video file. *} */
    public      $duration               = null;                     /* {*property   $duration               (Duration)                      The duration of the item (movie, audio recording, event,
                                                                                                                                            etc.) in ISO 8601 date format. *} */
    public      $embedUrl               = null;                     /* {*property   $embedUrl               (URL)                           A URL pointing to a player for a specific video. In general,
                                                                                                                                            this is the information in the src element of an embed tag
                                                                                                                                            and should not be the same as the content of the loc tag. *} */
    public      $encodesCreativeWork    = null;                     /* {*property   $encodesCreativeWork    (CreativeWork)                  The CreativeWork encoded by this media object. *} */
    public      $encodingFormat         = null;                     /* {*property   $encodingFormat         (string|URL)                    Media type typically expressed using a MIME format (see IANA
                                                                                                                                            site and MDN reference) e.g. application/zip for a
                                                                                                                                            SoftwareApplication binary, audio/mpeg for .mp3 etc.). In
                                                                                                                                            cases where a CreativeWork has several media type representations,
                                                                                                                                            encoding can be used to indicate each MediaObject alongside
                                                                                                                                            particular encodingFormat information.Unregistered or niche
                                                                                                                                            encoding and file formats can be indicated instead via the most
                                                                                                                                            appropriate URL, e.g. defining Web page or a Wikipedia/Wikidata entry. *} */
    public      $endTime                = null;                     /* {*property   $endTime                (DateTime|Time)                 The endTime of something. For a reserved event or service
                                                                                                                                            (e.g. FoodEstablishmentReservation), the time that it is expected
                                                                                                                                            to end. For actions that span a period of time, when the action
                                                                                                                                            was performed. e.g. John wrote a book from January to December.
                                                                                                                                            For media, including audio and video, it's the time offset of the
                                                                                                                                            end of a clip within a larger file.Note that Event uses startDate/endDate
                                                                                                                                            instead of startTime/endTime, even when describing dates with times.
                                                                                                                                            This situation may be clarified in future revisions. *} */
    public      $height                 = null;                     /* {*property   $height                 (Distance|QuantitativeValue)    The height of the item. *} */
    public      $playerType             = null;                     /* {*property   $playerType             (string)                        Player type required-for example, Flash or Silverlight. *} */
    public      $productionCompany      = null;                     /* {*property   $productionCompany      (Organization)                  The production company or studio responsible for the item e.g. series,
                                                                                                                                            video game, episode etc. *} */
    public      $regionsAllowed         = null;                     /* {*property   $regionsAllowed         (Place)                         The regions where the media is allowed. If not specified, then it's
                                                                                                                                            assumed to be allowed everywhere. Specify the countries in
                                                                                                                                            ISO 3166 format. *} */
    public      $requiresSubscription   = null;                     /* {*property   $requiresSubscription   (boolean|MediaSubscription)     Indicates if use of the media require a subscription (either paid
                                                                                                                                            or free). Allowed values are true or false (note that an earlier
                                                                                                                                            version had 'yes', 'no'). *} */
    public      $startTime              = null;                     /* {*property   $startTime              (DateTime|Time)                 The startTime of something. For a reserved event or service
                                                                                                                                            (e.g. FoodEstablishmentReservation), the time that it is expected
                                                                                                                                            to start. For actions that span a period of time, when the action
                                                                                                                                            was performed. e.g. John wrote a book from January to December.
                                                                                                                                            For media, including audio and video, it's the time offset of the
                                                                                                                                            start of a clip within a larger file.Note that Event uses
                                                                                                                                            startDate/endDate instead of startTime/endTime, even when describing
                                                                                                                                            dates with times. This situation may be clarified in future revisions. *} */
    public      $uploadDate             = null;                     /* {*property   $uploadDate             (Date)                          Date when this media object was uploaded to this site. *} */
    public      $width                  = null;                     /* {*property   $width                  (Distance|QuantitativeValue)    The width of the item. *} */


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
    }   /* End of MediaObject.__construct() =========================================== */
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
    }   /* End of MediaObject.__destruct() ============================================ */
    /* ================================================================================ */

}   /* End of class MediaObject ======================================================= */
/* ==================================================================================== */

?>