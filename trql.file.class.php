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
    {*file                  trql.file.class.php *}
    {*purpose               Computer file *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 27/06/2012 - 18:12 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 27/06/2012 *}
        {*v 5.0.0003 *}
        {*desc              Original creation of [c]LSFile.class.php[/c]. Not much of
                            intelligence so far.
    *}

    {*chist
        {*mdate 13/09/2013 *}
        {*v 5.5.0000 *}
        {*desc              1)  Comments à la "guide" (guide.php)
                            2)  Code leveling to cope with coding rules
    *}

    {*chist
        {*mdate 15-08-20 14:10 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original work is [c]LSFile.class.php[/c] of Vae Soli!
                                Porting the work to be compatible with TRQL Labs classes
        *}
    *}

    {*chist
        {*mdate 11-11-20 10:53 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Completing the [c]__destruct()[/c] method
                            2)  Adding a wikidata ID
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\file;

use \trql\mother\Mother         as Mother;
use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\utility\Utility       as Utility;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'UTILITY_CLASS_VERSION' ) )
    require_once( 'trql.utility.class.php' );

defined( 'FILE_CLASS_VERSION' ) or define( 'FILE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class File=

    {*desc
        High level file class which handles all details of a file:
        file size, modification date & time, creation date & time,
        last access date & time, ...
    *}

    {*warning
        This class must still be tested extensively in the context of TRQL Labs
    *}

    *}}
 */
/* ==================================================================================== */
class File extends Utility
/*----------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q82753';         /* {*property   $wikidataId                 (string)                WikidataId ... block of arbitrary information, or 
                                                                                                                                        resource for storing information, which is 
                                                                                                                                        available to a computer program *} */

    public      $szFile         = null;                             /* {*property   $szFile                     (string)                Physical filename *} */
    public      $szStorage      = null;                             /* {*property   $szStorage                  (string)                Logical filename *} */
    public      $iSize          = -1;                               /* {*property   $iSize                      (int)                   File size in bytes *} */
    protected   $rHandle        = null;                             /* {*property   $rHandle                    (res)                   Handle of the file *} */
    public      $szMIMEType         = null;                         /* {*property   $szMIMEType                 (string)                File MIME type *} */
    public      $iATime         = -1;                               /* {*property   $iATime                     (int)                   Last access date & time *} */
    public      $iCTime         = -1;                               /* {*property   $CTime                      (int)                   Creation date & time *} */
    public      $iMTime         = -1;                               /* {*property   $iMTime                     (int)                   Last modification date & time *} */


    /* ================================================================================ */
    /** {{*__construct( $szFile[,$MustOpen] )=

        Class constructor

        {*params
            $szFile     (string)    Logical or physical filename. Optional.
                                    [c]null[/c] by default.
            $MustOpen   (bool)      Must the file be opened on object creation?
                                    [c]false[/c] by default.
        *}

        {*return
            (void)
        *}

        {*author
            {PYB}
        *}

        {*cdate     16/05/2013 09:13 *}
        {*mdate     23/08/2020 09:53 *}
        {*version   8.0.0000 *}

        {*todo

            As such the class cannot be used in a command line context

        *}

        {*keywords constructors, destructors *}

        {*seealso @fnc.__construct *}

        *}}
     */
    /* ================================================================================ */
    public function __construct( $szFile = null,$MustOpen = false )
    /*-----------------------------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        if ( ! is_null( $szFile ) )                                 /* If parameter passed */
        {
            $this->szStorage = $szFile;                             /* Logical filename */
            $this->szFile    = vaesoli::FIL_RealPath( vaesoli::FIL_ResolveRoot( $szFile ) ); /* Physical filename */
        }   /* if ( ! is_null( $szFile ) ) */

        if ( $MustOpen && ! empty( $this->szStorage ) )             /* If must open and if storage not empty or null */
        {
            if ( $this->open() )                                    /* If the file has been successfully opened */
            {
                $this->size();                                      /* Determine file size */
                $this->time( 'ACM' );                               /* Determine Access, Creation and Modification date & time */
                $this->mimeType();                                  /* Determine file type (MIME) */
            }   /* if ( $this->Open() ) */
        }   /* if ( $MustOpen && ! STR_Empty( $this->szStorage ) ) */

        return ( $this );
    }   /* End of File.__construct() ================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*open( [$szMode] )=

        Open a file in a given mode

        {*params
            $szMode     (string)    Optional type of access. [c]r[/c] by default (read-only)
                                    [table]
                                        [tr][td][c]r [/c][/td][td]Open for reading only; place the file pointer at the beginning of the file. [/td][/tr]
                                        [tr][td][c]r+[/c][/td][td]Open for reading and writing; place the file pointer at the beginning of the file. [/td][/tr]
                                        [tr][td][c]w [/c][/td][td]Open for writing only; place the file pointer at the beginning of the file and truncate the file to zero length. If the file does not exist, attempt to create it.  [/td][/tr]
                                        [tr][td][c]w+[/c][/td][td]Open for reading and writing; place the file pointer at the beginning of the file and truncate the file to zero length. If the file does not exist, attempt to create it.  [/td][/tr]
                                        [tr][td][c]a [/c][/td][td]Open for writing only; place the file pointer at the end of the file. If the file does not exist, attempt to create it.  [/td][/tr]
                                        [tr][td][c]a+[/c][/td][td]Open for reading and writing; place the file pointer at the end of the file. If the file does not exist, attempt to create it.  [/td][/tr]
                                        [tr][td][c]x [/c][/td][td]Create and open for writing only; place the file pointer at the beginning of the file. If the file already exists, the fopen() call will fail by returning FALSE and generating an error of level E_WARNING. If the file does not exist, attempt to create it. This is equivalent to specifying O_EXCL|O_CREAT flags for the underlying open(2) system call.  [/td][/tr]
                                        [tr][td][c]x+[/c][/td][td]Create and open for reading and writing; otherwise it has the same behavior as 'x'.  [/td][/tr]
                                        [tr][td][c]c [/c][/td][td]Open the file for writing only. If the file does not exist, it is created. If it exists, it is neither truncated (as opposed to 'w'), nor the call to this function fails (as is the case with 'x'). The file pointer is positioned on the beginning of the file. This may be useful if it's desired to get an advisory lock (see flock()) before attempting to modify the file, as using 'w' could truncate the file before the lock was obtained (if truncation is desired, ftruncate() can be used after the lock is requested).  [/td][/tr]
                                        [tr][td][c]c+[/c][/td][td]Open the file for reading and writing; otherwise it has the same behavior as 'c'. [/td][/tr]
                                    [/table]
        *}

        {*return
            (bool)  [c]true[/c] if the file is successfully open; [c]false[/c] if not
        *}

        {*author
            {PYB}
        *}

        {*cdate     16/05/2013 09:13 *}
        {*mdate     23/08/2020 09:59 *}
        {*version   8.0.0000 *}

        *}}
     */
    /* ================================================================================ */
    public function open( $szMode = 'r' )
    /*---------------------------------*/
    {
        return ( ( $this->rHandle = vaesoli::FIL_Open( $this->szFile,$szMode ) ) != null );
    }   /* End of File.open() ========================================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*close()=

        Close the file

        {*params
        *}

        {*return
            (bool)  [c]true[/c] if file successfully closed; [c]false[/c] if not
        *}

        {*author
            {PYB}
        *}

        {*cdate     16/05/2013 09:36 *}
        {*mdate     23/08/2020 10:01 *}
        {*version   8.0.0000 *}

        *}}
     */
    /* ================================================================================ */
    public function close()
    /*-------------------*/
    {
        $bRetVal = true;                                            /* Return value of the method (true by default) */

        if ( ! is_null( $this->rHandle ) )                          /* If we have a handle */
        {
            if ( $bRetVal = vaesoli::FIL_Close( $this->rHandle ) )  /* If file successfully closed */
            {
                $this->rHandle = null;                              /* Reset internal handle */
            }   /* if ( $bRetVal = FIL_Close( $this->rHandle ) ) */
        }   /* if ( ! is_null( $this->rHandle ) ) */

        return ( $bRetVal );                                        /* Return result to caller */
    }   /* End of File.close() ======================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*time( $szTimes )=

        Determines the date & time of a file

        {*params
            $szTimes    (string)    A = access date & time[br]
                                    C = creation date & time[br]
                                    M = modification date & time[br]

                                    Times can be added to each other (e.g.: 'ACM')
        *}

        {*return
            (array)     Associative array:[br]
                        [c]'access'[/c] Access date & time[br]
                        [c]'creation'[/c] Creation date & time[br]
                        [c]'modification'[/c] Modification date & time[br]
        *}

        {*author
            {PYB}
        *}

        {*cdate     16/05/2013 09:49 *}
        {*mdate     23/08/2020 10:03 *}
        {*version   8.0.0000 *}

        *}}
     */
    /* ================================================================================ */
    public function time( $szTimes = null )
    /*-----------------------------------*/
    {
        $aRetVal = array( 'access'          => -1,                  /* Return value of the method */
                          'creation'        => -1,
                          'modification'    => -1 );

        if ( STR_iPos( $szTimes,'c' ) !== -1 )                      /* If creation time requested */
            $aRetVal['creation']        = $this->iCTime = vaesoli::FIL_Time( $this->szFile,'c' );
        if ( STR_iPos( $szTimes,'m' ) !== -1 )                      /* If modification time requested */
            $aRetVal['modification']    = $this->iMTime = vaesoli::FIL_Time( $this->szFile,'m' );
        if ( STR_iPos( $szTimes,'a' ) !== -1 )                      /* If last access time requested */
            $aRetVal['access']          = $this->iATime = vaesoli::FIL_Time( $this->szFile,'a' );

        return ( $aRetVal );                                        /* Return result to caller */
    }   /* End of File.time() ========================================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*size()=

        Determines the length of a file in bytes

        {*params
        *}

        {*return
            (int)       Size in bytes or [c]-1[/c] in case of problem.
                        The internal [c]$iSize[/c] property is updated.
        *}

        {*author
            {PYB}
        *}

        {*cdate     16/05/2013 09:13 *}
        {*mdate     23/08/2020 09:56 *}
        {*version   8.0.0000 *}

        *}}
     */
    /* ================================================================================ */
    public function size()
    /*------------------*/
    {
        return ( $this->iSize = vaesoli::FIL_size( $this->szFile ) );
    }   /* End of File.size() ========================================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*mimeType()=

        Returns the MIME type corresponding to the file extension of the file
        object

        {*params
        *}

        {*doc
            [url]http://fr.wikipedia.org/wiki/Type_MIME[/url][br]
            [url]http://en.wikipedia.org/wiki/MIME_type[/url]
        *}

        {*return
            (string)    The MIME type
            [table]
                [tr][td]    .aif     [/td][td]  audio/x-aiff                   [/td][/tr]
                [tr][td]    .aiff    [/td][td]  audio/x-aiff                   [/td][/tr]
                [tr][td]    .arc     [/td][td]  application/octet-stream       [/td][/tr]
                [tr][td]    .arj     [/td][td]  application/octet-stream       [/td][/tr]
                [tr][td]    .art     [/td][td]  image/x-jg                     [/td][/tr]
                [tr][td]    .asf     [/td][td]  video/x-ms-asf                 [/td][/tr]
                [tr][td]    .asx     [/td][td]  video/x-ms-asf                 [/td][/tr]
                [tr][td]    .avi     [/td][td]  video/avi                      [/td][/tr]
                [tr][td]    .bin     [/td][td]  application/octet-stream       [/td][/tr]
                [tr][td]    .bm      [/td][td]  image/bmp                      [/td][/tr]
                [tr][td]    .bmp     [/td][td]  image/bmp                      [/td][/tr]
                [tr][td]    .bz2     [/td][td]  application/x-bzip2            [/td][/tr]
                [tr][td]    .css     [/td][td]  text/css                       [/td][/tr]
                [tr][td]    .csv     [/td][td]  text/csv                       [/td][/tr]
                [tr][td]    .doc     [/td][td]  application/msword             [/td][/tr]
                [tr][td]    .dot     [/td][td]  application/msword             [/td][/tr]
                [tr][td]    .docx    [/td][td]  application/msword             [/td][/tr]
                [tr][td]    .dv      [/td][td]  video/x-dv                     [/td][/tr]
                [tr][td]    .exe     [/td][td]  application/octetstream        [/td][/tr]
                [tr][td]    .gif     [/td][td]  image/gif                      [/td][/tr]
                [tr][td]    .gz      [/td][td]  application/x-gzip             [/td][/tr]
                [tr][td]    .gzip    [/td][td]  application/x-gzip             [/td][/tr]
                [tr][td]    .htm     [/td][td]  text/html                      [/td][/tr]
                [tr][td]    .html    [/td][td]  text/html                      [/td][/tr]
                [tr][td]    .ico     [/td][td]  image/x-icon                   [/td][/tr]
                [tr][td]    .jpe     [/td][td]  image/jpeg                     [/td][/tr]
                [tr][td]    .jpeg    [/td][td]  image/jpeg                     [/td][/tr]
                [tr][td]    .jpg     [/td][td]  image/jpeg                     [/td][/tr]
                [tr][td]    .js      [/td][td]  application/x-javascript       [/td][/tr]
                [tr][td]    .json    [/td][td]  application/json               [/td][/tr]
                [tr][td]    .log     [/td][td]  text/plain                     [/td][/tr]
                [tr][td]    .txt     [/td][td]  text/plain                     [/td][/tr]
                [tr][td]    .mid     [/td][td]  audio/x-midi                   [/td][/tr]
                [tr][td]    .mov     [/td][td]  video/quicktime                [/td][/tr]
                [tr][td]    .mp2     [/td][td]  audio/mpeg                     [/td][/tr]
                [tr][td]    .mpg     [/td][td]  audio/mpeg                     [/td][/tr]
                [tr][td]    .mp3     [/td][td]  audio/mpeg3                    [/td][/tr]
                [tr][td]    .mp4     [/td][td]  video/mp4                      [/td][/tr]
                [tr][td]    .ogg     [/td][td]  application/ogg                [/td][/tr]
                [tr][td]    .pdf     [/td][td]  application/pdf                [/td][/tr]
                [tr][td]    .png     [/td][td]  image/png                      [/td][/tr]
                [tr][td]    .ppt     [/td][td]  application/vnd.ms-powerpoint  [/td][/tr]
                [tr][td]    .ra      [/td][td]  audio/vnd.rn-realaudioreal     [/td][/tr]
                [tr][td]    .rtf     [/td][td]  application/rtf                [/td][/tr]
                [tr][td]    .tif     [/td][td]  image/tiff                     [/td][/tr]
                [tr][td]    .tiff    [/td][td]  image/tiff                     [/td][/tr]
                [tr][td]    .vcard   [/td][td]  text/x-vCard                   [/td][/tr]
                [tr][td]    .wav     [/td][td]  audio/x-wav                    [/td][/tr]
                [tr][td]    .wma     [/td][td]  audio/x-ms-wma                 [/td][/tr]
                [tr][td]    .xls     [/td][td]  application/vnd.ms-excel       [/td][/tr]
                [tr][td]    .xml     [/td][td]  text/xml                       [/td][/tr]
                [tr][td]    .zip     [/td][td]  application/zip );             [/td][/tr]
                [tr][td]    default  [/td][td]  application/force-download     [/td][/tr]
            [/table]
        *}

        {*remark
            Only a small subset of MIME types is considered
        *}

        {*author
            {PYB}
        *}

        {*cdate     16/05/2013 09:13 *}
        {*mdate     23/08/2020 10:08 *}
        {*version   8.0.0000 *}

        *}}
     */
    /* ================================================================================ */
    public function mimeType()
    /*----------------------*/
    {
        return ( $this->szType = FIL_GetFileType( $this->szFile ) );/* Determine and return file type */
    }   /* End of File.mimeType() ===================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*gets( $iLength )=

        Get next line of file

        {*params
            $iLength    (int)       Maximum line length. Optional. 
                                    [c]1024[/c] by default
        *}

        {*return
            (string)      Next line from file. [c]false[/c] if end of file encountered.
        *}

        {*author
            {PYB}
        *}

        {*cdate     16/05/2013 09:36 *}
        {*mdate     23/08/2020 10:05 *}
        {*version   8.0.0000 *}

        *}}
     */
    /* ================================================================================ */
    public function gets( $iLength = 1024 )
    /*-----------------------------------*/
    {
        return ( vaesoli::FIL_Gets( $this->rHandle,$iLength ) );
    }   /* End of File.Gets() ========================================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return.
        *}

        *}}
    */
    /* ================================================================================ */
    public function __destruct()
    /*------------------------*/
    {
        $this->close();
        $this->backup();
        $this->autodoc();
        $this->UIKey();
        $this->WikiData();
        $this->necroSignaling();

    }   /* End of File.__destruct() =================================================== */
    /* ================================================================================ */
}   /* End of class File ============================================================== */
/* ==================================================================================== */
