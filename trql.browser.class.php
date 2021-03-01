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
    {*file                  trql.browser.class.php *}
    {*purpose               Browser class (Internet navigator) *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 24/06/2012 - 11:25 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 05-09-20 18:31 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              0)  This code is based on Vae Soli LSBrowser.class.php
                            1)  Original creation
        *}
    *}

    {*doc                   [url]http://fr.wikipedia.org/wiki/User-Agent[/url][br]
                            [url]http://www.handsetdetection.com/properties/vendormodel/Nokia/[/url][br]
                            [url]http://www.useragentstring.com[/url][br]
                            [url]http://www.tera-wurfl.com/explore/[/url][br]
                            [url]http://www.zytrax.com/tech/web/mobile_ids.html[/url][br]
                            [url]http://www.developer.nokia.com/Community/Wiki/User-Agent_headers_for_Nokia_devices[/url][br]
                            [url]http://detectmobilebrowsers.com/[/url]
    *}

    *}}} */
/****************************************************************************************/
namespace trql\browser;

use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\thing\Thing           as Thing;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'THING_CLASS_VERSION' ) )
{
    /* {*require (trql.thing.class.php)   Thing class  *} */
    require_once( 'trql.thing.class.php' );
}


defined( 'BROWSER_CLASS_VERSION' ) or define( 'BROWSER_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Browser=

    {*desc

        Navigator/Browser class. Comes with an extensive set of parsing routines
        based on more than 15000 User Agents.

    *}

 */
/* ==================================================================================== */
class Browser extends Thing
/*-----------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public  $szUA               = null;                             /* {*property $szUA                 (string)    The original user agent string *} */
    public  $szName             = null;                             /* {*property $szName               (string)    user agent name (e.g. opera, firefox, chrome, ...) *} */
    public  $szType             = null;                             /* {*property $szType               (string)    user agent type (e.g. 'browser','bot','hacker','spammer') *} */
    public  $szPlatform         = null;                             /* {*property $szPlatform           (string)    user agent platform (e.g. windows, ...) *} */
    public  $szPlatformVersion  = null;                             /* {*property $szPlatformVersion    (string)    user agent platform version (e.g. 98, 7, ...) *} */
    public  $iMajor             = null;                             /* {*property $iMajor               (int)       user agent major version number *} */
    public  $iMinor             = null;                             /* {*property $iMinor               (int)       user agent minor version number *} */
    public  $iRevision          = null;                             /* {*property $iRevision            (int)       user agent revision number *} */
    public  $szBuild            = null;                             /* {*property $szBuild              (string)    user agent build number *} */
    public  $szMobility         = null;                             /* {*property $szMobility           (string)    user agent mobility (e.g. 'desktop','tablet','phone', 'mobile', ...) *} */
    public  $szDevice           = null;                             /* {*property $szDevice             (string)    device (e.g. 'iphone','ipad','blackberry', ...) *} */
    public  $szModel            = null;                             /* {*property $szModel              (string)    model (e.g. '8520','8530','9100i', ...) *} */
    public  $fStart             = 0.0;                              /* {*property $fStart               (float)     Parsing start time *} */
    public  $fStop              = 0.0;                              /* {*property $fStop                (float)     Parsing stop time *} */
    public  $aProperties        = array();                          /* {*property $aProperties          (array)     an array of device capabilities *} */
    public  $szToolVersion      = null;                             /* {*property $szToolVersion        (string)    a datetime version *} */
    public  $iDanger            = -1;                               /* {*property $iDanger              (int)       Indicates if we have detected a possible danger with this User Agent (-1 = not set; 0 = No danger; 10 = High danger) *} */
    public  $iLineMatch         = 0;                                /* {*property $iLineMatch           (int)       Line of our source code where the match was found *} */
    public  $szLanguage         = null;                             /* {*property $szLanguage           (string)    Language extraction from UA (if mentioned) *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q6368';  // Web Browser

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

        if ( ! isset( $_SERVER['HTTP_USER_AGENT'] ) )
            $this->szUA = 'illegal';
        else
            $this->szUA = $_SERVER['HTTP_USER_AGENT'];

        $this->szToolVersion = vaesoli::FIL_MDate( __FILE__,'YmdHis' );

        return ( $this );
    }   /* End of Browser.__construct() =============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*setUA( $szUA )=

        Sets the internal $szUA property

        {*params
            $szUA       (string)        User Agent
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*example
            $oBrowser = new LSBrowser();
            $oBrowset->setUA(  trim( $_SERVER['HTTP_USER_AGENT'] ) );
            $oBrowser->ParseUA();

            $szXML  = '';
            $szXML .= "<Request><![CDATA[{$szUA}]]></Request>\n";
            $szXML .= "<Response>\n";
            $szXML .=    "<ToolVersion><![CDATA[{$oBrowser->szToolVersion}]]></ToolVersion>\n";
            $szXML .=    "<FullAgent><![CDATA[{$szUA}]]></FullAgent>\n";
            $szXML .=    "<AgentName><![CDATA[{$oBrowser->szName}]]></AgentName>\n";
            $szXML .=    "<AgentType><![CDATA[{$oBrowser->szType}]]></AgentType>\n";
            $szXML .=    "<Danger><![CDATA[{$oBrowser->iDanger} (-1 = not set; 0 = none; 10 = high)]]></Danger>\n";
            $szXML .=    "<AgentVersion>\n";
            $szXML .=        "<Major><![CDATA[{$oBrowser->iMajor}]]></Major>\n";
            $szXML .=        "<Minor><![CDATA[{$oBrowser->iMinor}]]></Minor>\n";
            $szXML .=        "<Revision><![CDATA[{$oBrowser->iRevision}]]></Revision>\n";
            $szXML .=        "<Build><![CDATA[{$oBrowser->szBuild}]]></Build>\n";
            $szXML .=    "</AgentVersion>\n";
            $szXML .=    "<Device>\n";
            $szXML .=        "<Type><![CDATA[{$oBrowser->szMobility}]]></Type>\n";
            $szXML .=        "<Name><![CDATA[{$oBrowser->szDevice}]]></Name>\n";
            $szXML .=        "<Model><![CDATA[{$oBrowser->szModel}]]></Model>\n";
            $szXML .=    "</Device>\n";
            $szXML .=    "<Platform>\n";
            $szXML .=        "<Name><![CDATA[{$oBrowser->szPlatform}]]></Name>\n";
            $szXML .=        "<Version><![CDATA[{$oBrowser->szPlatformVersion}]]></Version>\n";
            $szXML .=    "</Platform>\n";
            $szXML .=    "<Perf>\n";
            $szXML .=        "<ParseTime>" . ( $oBrowser->fStop - $oBrowser->fStart ) . " sec</ParseTime>\n";
            $szXML .=    "</Perf>\n";
            $szXML .= "</Response>\n";
        *}

        *}}
    */
    /* ================================================================================ */
    public function setUA( $szUA )
    /*---------------------------*/
    {
        return ( $this );
    }   /* End of Browser.setUA() ===================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*ParseUA( [$szUA] )=

        Parses the User Agent string and places all findings in the properties
        of the object.

        {*params
            $szUA       (string)        Optional User Agent. $this->szUA by default.
        *}

        {*cdate 24/06/2012 11:25 *}
        {*mdate 22/10/2013 11:44 *}
        {*version 5.0.0003 *}

        {*return
            (void)
        *}
        *}}
     */
    /* ================================================================================ */
    function ParseUA( $szUA = null )
    /*----------------------------*/
    {
        $this->szName               = null;
        $this->szType               = null;
        $this->szPlatform           = null;
        $this->szPlatformVersion    = null;
        $this->iMajor               = null;
        $this->iMinor               = null;
        $this->iRevision            = null;
        $this->szBuild              = null;
        $this->szMobility           = null;
        $this->szDevice             = null;
        $this->szModel              = null;
        $this->fStart               = 0.0;
        $this->fStop                = 0.0;
        $this->iDanger              = -1;
        $this->iLineMatch           = -1;
        $this->aProperties          = array();

        if ( ! is_null( $szUA ) )
            $this->szUA = $szUA;

        $this->aProperties['technical-specs'        ] = null;           // 'http://wap.samsungmobile.com/uaprof/GT-I9505.xml';
        $this->aProperties['keyboard'               ] = null;           // azerty, qwerty, ...
        $this->aProperties['pointing'               ] = null;           // touchscreen, ...
        $this->aProperties['company'                ] = null;           // nokia, samsung, apple, amazon, ...
        $this->aProperties['camera'                 ] = null;           // 5MP; 8MP; 12MP; ...
        $this->aProperties['storage'                ] = null;           // 22Mb; 32Gb; ...
        $this->aProperties['html-version'           ] = null;           // 4.0, ...
        $this->aProperties['java-enabled'           ] = null;           // true | false
        $this->aProperties['javascript-enabled'     ] = null;           // true | false
        $this->aProperties['tables-capable'         ] = null;           // true | false
        $this->aProperties['frames-capable'         ] = null;           // true | false
        $this->aProperties['pixel-ratio'            ] = null;           // 1x1, ...
        $this->aProperties['screen-size'            ] = null;           // 1024x600
        $this->aProperties['screen-size-char'       ] = null;           // 25x21
        $this->aProperties['color-capable'          ] = null;           // true | false
        $this->aProperties['bits-per-pixel'         ] = null;           // 8, 16, 24, ...
        $this->aProperties['image-capable'          ] = null;           // true | false
        $this->aProperties['sound-output-capable'   ] = null;           // true | false
        $this->aProperties['voice-input-capable'    ] = null;           // true | false

        $this->fStart   = (float) microtime( true );                /* Parsing start time */

        if ( ! is_null( $this->szUA ) && $this->szUA !== 'illegal' )
        {
            //$this->szUA = 'PEAR HTTP_Request class ( http://pear.php.net/ )';

            $this->szMobility = 'desktop';

            //echo "<p>At line " . __LINE__ . " the value of szType is {$this->szType}</p>";

            if ( vaesoli::STR_iPos( $this->szUA,'eval(' ) != -1          ||
                 vaesoli::STR_iPos( $this->szUA,'base64_decode(' ) != -1 ||
                 vaesoli::STR_iPos( $this->szUA,'<?php' ) != -1
               )
            {
                $this->szType   = 'hacker';
                $this->iDanger  = 10;
            }
            elseif ( preg_match( '%<a([^>]*)>(.*?)</a>%si',$this->szUA ) )
            {
                $this->szType   = 'spammer';
                $this->iDanger  = 9;
            }
            elseif ( $this->LooksLike( 'googlebot',__LINE__ ) )
            {
                $this->szType = 'bot';

                if ( vaesoli::STR_iPos( $this->szUA,'googlebot-mobile' ) != -1 )
                {
                    $this->szName = 'googlebot-mobile';
                }
                elseif ( vaesoli::STR_iPos( $this->szUA,'googlebot-image' ) != -1 )
                {
                    $this->szName = 'googlebot-image';
                }
                else
                {
                    $this->szName = 'googlebot';
                }

                if ( preg_match( '/googlebot(-mobile|-image)?\/(?P<major>\d{1,2})\.(?P<minor>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'Google-Site-Verification',__LINE__ ) )
            {
                $this->szName       = 'google-site-verification';
                $this->szType       = 'bot';

                if ( preg_match( '/verification[\/ ](?P<maj>\d{1,2})\.(?P<min>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['maj'] ) )
                    {
                        $this->iMajor = (int) $aMatch['maj'];
                    }
                    if ( isset( $aMatch['min'] ) )
                    {
                        $this->iMinor = (int) $aMatch['min'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'google.com/appengine',__LINE__ ) )
            {
                $this->szName       = 'Google App Engine';
                $this->szType       = 'bot';
            }
            elseif ( $this->LooksLike( 'WordPress.com mShots',__LINE__ ) )
            {
                $this->szName       = 'wordpress mshots';
                $this->szType       = 'bot';
            }
            elseif ( $this->LooksLike( 'cc metadata scaper',__LINE__ ) )
            {
                $this->szName = 'creativecommons scraper';
                $this->szType = 'bot';
            }
            elseif ( $this->LooksLike( 'Microsoft URL Control',__LINE__ ) )
            {
                $this->szName = 'microsoft url control';
                $this->szType = 'bot';

                $this->Version();
            }
            elseif ( $this->LooksLike( 'Internet Explorer',__LINE__ ) )
            {
                $this->szName = 'Internet Explorer';
                $this->szType = 'browser';

                if ( vaesoli::STR_iPos( $this->szUA,'pocket' ) != -1 )
                {
                    $this->szName .= ' (pocket)';
                }

                $this->Version();
            }
            //Sharp SH80F Device Specifications
            //Mozilla/5.0 (Linux; U; Android 2.3.4; en-gb; SH80F Build/A8173S) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1
            //50b323b1a04f4c129c82b43b	Mozilla/5.0 (Linux; U; Android 2.3.3; zh-cn; SH8298U Build/S8041) UC AppleWebKit/534.31 (KHTML, like Gecko) Mobile Safari/534.31
            //Android 2.3.3;AppleWebKit/534.31;Build/S8041;SH8298U Build/S8041
            // 960x540
            // http://www.handsetdetection.com/properties/vendormodel/Sharp/SH80F

            elseif ( $this->LooksLike( 'ME302C',__LINE__ ) )
            {
                $this->szType       = 'browser';
                $this->szDevice     = 'asus';
                $this->szModel      = 'Asus Memo Pad ME302c';
                $this->szMobility   = 'tablet';

                if     ( $this->LooksLike( 'OPR',__LINE__ ) )
                {
                    $this->szName   = 'opera';
                    $this->Version( 'opr[\/]' );   /* Standard way of retrieving version major, minor, revision */
                }
                elseif ( $this->LooksLike( 'chrome',__LINE__ ) )
                {
                    $this->szName   = 'chrome';
                    $this->Version( 'chrome[\/]' );   /* Standard way of retrieving version major, minor, revision */
                }
                elseif ( $this->LooksLike( 'Version',__LINE__ ) )
                {
                    $this->szName   = 'default navigator or dolphin';
                    $this->Version( 'version[\/]' );   /* Standard way of retrieving version major, minor, revision */
                }

                $this->aProperties['pointing'               ] = null;
                $this->aProperties['company'                ] = 'asus';
                $this->aProperties['screen-size'            ] = '1920x1200';
            }
            elseif ( $this->LooksLike( 'ME173X',__LINE__ ) )
            {
                $this->szType       = 'browser';
                $this->szDevice     = 'asus';
                $this->szModel      = 'Asus Memo Pad 173x';
                $this->szMobility   = 'tablet';

                if     ( $this->LooksLike( 'OPR',__LINE__ ) )
                {
                    $this->szName   = 'opera';
                    $this->Version( 'opr[\/]' );   /* Standard way of retrieving version major, minor, revision */
                }
                elseif ( $this->LooksLike( 'chrome',__LINE__ ) )
                {
                    $this->szName   = 'chrome';
                    $this->Version( 'chrome[\/]' );   /* Standard way of retrieving version major, minor, revision */
                }
                elseif ( $this->LooksLike( 'Version',__LINE__ ) )
                {
                    $this->szName   = 'default navigator or dolphin';
                    $this->Version( 'version[\/]' );   /* Standard way of retrieving version major, minor, revision */
                }

                $this->aProperties['pointing'               ] = null;
                $this->aProperties['company'                ] = 'asus';
                $this->aProperties['screen-size'            ] = '1280x800';
            }
            elseif ( $this->LooksLike( 'P01W',__LINE__ ) )
            {
                $this->szType       = 'browser';
                $this->szDevice     = 'asus';
                $this->szModel      = 'Asus ZenPad 7.0 (Z370C or Z370CG or Z370CL)';
                $this->szMobility   = 'tablet';

                if     ( $this->LooksLike( 'OPR',__LINE__ ) )
                {
                    $this->szName   = 'opera';
                    $this->Version( 'opr[\/]' );   /* Standard way of retrieving version major, minor, revision */
                }
                elseif ( $this->LooksLike( 'chrome',__LINE__ ) )
                {
                    $this->szName   = 'chrome';
                    $this->Version( 'chrome[\/]' );   /* Standard way of retrieving version major, minor, revision */
                }
                elseif ( $this->LooksLike( 'Version',__LINE__ ) )
                {
                    $this->szName   = 'default navigator or dolphin';
                    $this->Version( 'version[\/]' );   /* Standard way of retrieving version major, minor, revision */
                }

                $this->aProperties['pointing'               ] = null;
                $this->aProperties['company'                ] = 'asus';
                $this->aProperties['screen-size'            ] = '1280x800';
            }
            /* SAMSUNG */
            elseif ( $this->LooksLike( 'GT-P1010/W16',__LINE__ ) )
            {
                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szDevice     = 'samsung';
                $this->szModel      = 'galaxy tab 7.0 (wi-fi only)';
                $this->szMobility   = 'tablet';

                $this->Version( 'android[\/ ]' );   /* Standard way of retrieving version major, minor, revision */
            }
            elseif ( $this->LooksLike( 'LG-D850'    ,__LINE__ ) ||
                     $this->LooksLike( 'LG-D851'    ,__LINE__ ) ||
                     $this->LooksLike( 'LG-D855'    ,__LINE__ ) ||
                     $this->LooksLike( 'VS985 4G'   ,__LINE__ )
                   )
            {
                $this->szType       = 'browser';
                $this->szDevice     = 'LG';
                $this->szModel      = 'G3';
                $this->szMobility   = 'phone';

                $this->iDanger      = 0;

                $this->iMajor       = null;
                $this->iMinor       = null;
                $this->iRevision    = null;

                $this->Version( 'chrome[\/ ]' );   /* Standard way of retrieving version major, minor, revision */

                if ( ! $this->iMajor )
                {
                    $this->Version( 'android[\/ ]' );   /* Standard way of retrieving version major, minor, revision */
                }
            }
            elseif ( $this->LooksLike( 'GT-P3113',__LINE__ ) )
            {
                // Samsung Galaxy TabÖ 2 7.0 (Wi-Fi) 8GB
                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szDevice     = 'samsung';
                $this->szModel      = 'galaxy tab 2 7.0 (wi-fi)';
                $this->szMobility   = 'tablet';

                $this->aProperties['technical-specs'        ] = 'http://wap.samsungmobile.com/uaprof/GT-P3113.xml';
                $this->aProperties['keyboard'               ] = 'PhoneKeypad';
                $this->aProperties['pointing'               ] = null;
                $this->aProperties['company'                ] = 'samsung';
                $this->aProperties['camera'                 ] = null;
                $this->aProperties['storage'                ] = null;
                $this->aProperties['html-version'           ] = 4.0;
                $this->aProperties['java-enabled'           ] = false;
                $this->aProperties['javascript-enabled'     ] = true;
                $this->aProperties['tables-capable'         ] = true;
                $this->aProperties['frames-capable'         ] = true;
                $this->aProperties['pixel-ratio'            ] = '1x1';
                $this->aProperties['screen-size'            ] = '1024x600';
                $this->aProperties['screen-size-char'       ] = '25x21';
                $this->aProperties['color-capable'          ] = true;
                $this->aProperties['bits-per-pixel'         ] = 16;
                $this->aProperties['image-capable'          ] = true;
                $this->aProperties['sound-output-capable'   ] = true;
                $this->aProperties['voice-input-capable'    ] = true;

                $this->Version( 'android[\/ ]' );   /* Standard way of retrieving version major, minor, revision */
            }
            elseif ( $this->LooksLike( 'GT-P5113',__LINE__ ) )
            {
                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szDevice     = 'samsung';
                $this->szModel      = 'galaxy tab 2 10.1 (wi-fi)';
                $this->szMobility   = 'tablet';

                $this->aProperties['technical-specs'        ] = 'http://wap.samsungmobile.com/uaprof/GT-P5113.xml';
                $this->aProperties['keyboard'               ] = 'PhoneKeypad';
                $this->aProperties['pointing'               ] = null;
                $this->aProperties['company'                ] = 'samsung';
                $this->aProperties['camera'                 ] = null;
                $this->aProperties['storage'                ] = null;
                $this->aProperties['html-version'           ] = 4.0;
                $this->aProperties['java-enabled'           ] = false;
                $this->aProperties['javascript-enabled'     ] = true;
                $this->aProperties['tables-capable'         ] = true;
                $this->aProperties['frames-capable'         ] = true;
                $this->aProperties['pixel-ratio'            ] = '1x1';
                $this->aProperties['screen-size'            ] = '1280x800';
                $this->aProperties['screen-size-char'       ] = '25x21';
                $this->aProperties['color-capable'          ] = true;
                $this->aProperties['bits-per-pixel'         ] = 16;
                $this->aProperties['image-capable'          ] = true;
                $this->aProperties['sound-output-capable'   ] = true;
                $this->aProperties['voice-input-capable'    ] = true;

                $this->Version( 'android[\/ ]' );   /* Standard way of retrieving version major, minor, revision */
            }
            elseif ( $this->LooksLike( 'GT-P7510',__LINE__ ) )
            {
                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szDevice     = 'samsung';
                $this->szModel      = 'samsung galaxy tab 10.1 (wifi)';
                $this->szMobility   = 'tablet';

                $this->aProperties['technical-specs'        ] = 'http://wap.samsungmobile.com/uaprof/GT-P7510.xml';
                $this->aProperties['keyboard'               ] = 'PhoneKeypad';
                $this->aProperties['pointing'               ] = null;
                $this->aProperties['company'                ] = 'samsung';
                $this->aProperties['camera'                 ] = null;
                $this->aProperties['storage'                ] = null;
                $this->aProperties['html-version'           ] = 4.0;
                $this->aProperties['java-enabled'           ] = false;
                $this->aProperties['javascript-enabled'     ] = true;
                $this->aProperties['tables-capable'         ] = true;
                $this->aProperties['frames-capable'         ] = true;
                $this->aProperties['pixel-ratio'            ] = '1x1';
                $this->aProperties['screen-size'            ] = '800x1280';
                $this->aProperties['screen-size-char'       ] = '25x21';
                $this->aProperties['color-capable'          ] = true;
                $this->aProperties['bits-per-pixel'         ] = 16;
                $this->aProperties['image-capable'          ] = true;
                $this->aProperties['sound-output-capable'   ] = true;
                $this->aProperties['voice-input-capable'    ] = true;

                $this->Version( 'android[\/ ]' );   /* Standard way of retrieving version major, minor, revision */
            }
            elseif ( $this->LooksLike( 'SPH-P100',__LINE__ ) )
            {
                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szDevice     = 'samsung';
                $this->szModel      = 'galaxy tab 7.0 (sprint)';
                $this->szMobility   = 'tablet';

                $this->aProperties['screen-size'            ] = '600x1024';

                $this->Version( 'android[\/ ]' );   /* Standard way of retrieving version major, minor, revision */
            }
            elseif ( $this->LooksLike( 'GT-I9000',__LINE__ ) )
            {
                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szDevice     = 'samsung';
                $this->szModel      = 'galaxy s';
                $this->szMobility   = 'phone';

                $this->aProperties['technical-specs'        ] = 'http://wap.samsungmobile.com/uaprof/GT-I9000.xml';
                $this->aProperties['keyboard'               ] = 'PhoneKeypad';
                $this->aProperties['pointing'               ] = null;
                $this->aProperties['company'                ] = 'samsung';
                $this->aProperties['camera'                 ] = null;
                $this->aProperties['storage'                ] = null;
                $this->aProperties['html-version'           ] = 4.0;
                $this->aProperties['java-enabled'           ] = false;
                $this->aProperties['javascript-enabled'     ] = true;
                $this->aProperties['tables-capable'         ] = true;
                $this->aProperties['frames-capable'         ] = true;
                $this->aProperties['pixel-ratio'            ] = '1x1';
                $this->aProperties['screen-size'            ] = '480x800';
                $this->aProperties['screen-size-char'       ] = '25x21';
                $this->aProperties['color-capable'          ] = true;
                $this->aProperties['bits-per-pixel'         ] = 16;
                $this->aProperties['image-capable'          ] = true;
                $this->aProperties['sound-output-capable'   ] = true;
                $this->aProperties['voice-input-capable'    ] = true;

                $this->Version( 'android[\/ ]' );   /* Standard way of retrieving version major, minor, revision */
            }
            elseif ( $this->LooksLike( 'GT-I9100',__LINE__ ) )
            {
                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szDevice     = 'samsung';
                $this->szModel      = 'galaxy s ii';
                $this->szMobility   = 'phone';

                $this->aProperties['technical-specs'        ] = 'http://wap.samsungmobile.com/uaprof/GT-I9100.xml';
                $this->aProperties['keyboard'               ] = 'PhoneKeypad';
                $this->aProperties['pointing'               ] = null;
                $this->aProperties['company'                ] = 'samsung';
                $this->aProperties['camera'                 ] = null;
                $this->aProperties['storage'                ] = null;
                $this->aProperties['html-version'           ] = 4.0;
                $this->aProperties['java-enabled'           ] = false;
                $this->aProperties['javascript-enabled'     ] = true;
                $this->aProperties['tables-capable'         ] = true;
                $this->aProperties['frames-capable'         ] = true;
                $this->aProperties['pixel-ratio'            ] = '1x1';
                $this->aProperties['screen-size'            ] = '480x800';
                $this->aProperties['screen-size-char'       ] = '25x21';
                $this->aProperties['color-capable'          ] = true;
                $this->aProperties['bits-per-pixel'         ] = 16;
                $this->aProperties['image-capable'          ] = true;
                $this->aProperties['sound-output-capable'   ] = true;
                $this->aProperties['voice-input-capable'    ] = true;

                $this->Version( 'android[\/ ]' );   /* Standard way of retrieving version major, minor, revision */
            }
            elseif ( $this->LooksLike( 'GT-I9300',__LINE__ ) )
            {
                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szDevice     = 'samsung';
                $this->szModel      = 'galaxy s iii';
                $this->szMobility   = 'phone';

                $this->aProperties['technical-specs'        ] = 'http://wap.samsungmobile.com/uaprof/GT-I9300.xml';
                $this->aProperties['keyboard'               ] = 'PhoneKeypad';
                $this->aProperties['pointing'               ] = null;
                $this->aProperties['company'                ] = 'samsung';
                $this->aProperties['camera'                 ] = null;
                $this->aProperties['storage'                ] = null;
                $this->aProperties['html-version'           ] = 4.0;
                $this->aProperties['java-enabled'           ] = false;
                $this->aProperties['javascript-enabled'     ] = true;
                $this->aProperties['tables-capable'         ] = true;
                $this->aProperties['frames-capable'         ] = true;
                $this->aProperties['pixel-ratio'            ] = '1x1';
                $this->aProperties['screen-size'            ] = '1028x720';
                $this->aProperties['screen-size-char'       ] = '25x21';
                $this->aProperties['color-capable'          ] = true;
                $this->aProperties['bits-per-pixel'         ] = 16;
                $this->aProperties['image-capable'          ] = true;
                $this->aProperties['sound-output-capable'   ] = true;
                $this->aProperties['voice-input-capable'    ] = true;

                $this->Version( 'android[\/ ]' );   /* Standard way of retrieving version major, minor, revision */
            }
            elseif ( $this->LooksLike( 'GT-I9500',__LINE__ ) )
            {
                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szDevice     = 'samsung';
                $this->szModel      = 'GT-I9500';
                $this->szMobility   = 'phone';

                $this->aProperties['technical-specs'        ] = 'http://wap.samsungmobile.com/uaprof/GT-I9500.xml';
                $this->aProperties['keyboard'               ] = 'PhoneKeypad';
                $this->aProperties['pointing'               ] = null;
                $this->aProperties['company'                ] = 'samsung';
                $this->aProperties['camera'                 ] = null;
                $this->aProperties['storage'                ] = null;
                $this->aProperties['html-version'           ] = 5.0;
                $this->aProperties['java-enabled'           ] = false;
                $this->aProperties['javascript-enabled'     ] = true;
                $this->aProperties['tables-capable'         ] = true;
                $this->aProperties['frames-capable'         ] = true;
                $this->aProperties['pixel-ratio'            ] = '1x1';
                $this->aProperties['screen-size'            ] = '1080x1920';
                $this->aProperties['screen-size-char'       ] = '25x21';
                $this->aProperties['color-capable'          ] = true;
                $this->aProperties['bits-per-pixel'         ] = 16;
                $this->aProperties['image-capable'          ] = true;
                $this->aProperties['sound-output-capable'   ] = true;
                $this->aProperties['voice-input-capable'    ] = true;

                $this->Version( 'android[\/ ]' );   /* Standard way of retrieving version major, minor, revision */
            }
            elseif ( $this->LooksLike( 'GT-I9505',__LINE__ ) )
            {

                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szDevice     = 'samsung';
                $this->szModel      = 'galaxy s 4';
                $this->szMobility   = 'phone';

                $this->aProperties['technical-specs'        ] = 'http://wap.samsungmobile.com/uaprof/GT-I9505.xml';
                $this->aProperties['keyboard'               ] = 'PhoneKeypad';
                $this->aProperties['pointing'               ] = null;
                $this->aProperties['company'                ] = 'samsung';
                $this->aProperties['camera'                 ] = null;
                $this->aProperties['storage'                ] = null;
                $this->aProperties['html-version'           ] = 5.0;
                $this->aProperties['java-enabled'           ] = false;
                $this->aProperties['javascript-enabled'     ] = true;
                $this->aProperties['tables-capable'         ] = true;
                $this->aProperties['frames-capable'         ] = true;
                $this->aProperties['pixel-ratio'            ] = '1x1';
                $this->aProperties['screen-size'            ] = '1080x1920';
                $this->aProperties['screen-size-char'       ] = '25x21';
                $this->aProperties['color-capable'          ] = true;
                $this->aProperties['bits-per-pixel'         ] = 16;
                $this->aProperties['image-capable'          ] = true;
                $this->aProperties['sound-output-capable'   ] = true;
                $this->aProperties['voice-input-capable'    ] = true;

                if     ( $this->LooksLike( 'OPR',__LINE__ ) )
                {
                    $this->szName   = 'opera';
                    $this->Version( 'opr[\/]' );   /* Standard way of retrieving version major, minor, revision */
                }
                elseif ( $this->LooksLike( 'chrome',__LINE__ ) )
                {
                    $this->szName   = 'chrome';
                    $this->Version( 'chrome[\/]' );   /* Standard way of retrieving version major, minor, revision */
                }
                elseif ( $this->LooksLike( 'Version',__LINE__ ) )
                {
                    $this->szName   = 'default navigator or dolphin';
                    $this->Version( 'version[\/]' );   /* Standard way of retrieving version major, minor, revision */
                }
                else
                {
                    $this->Version( 'android[\/ ]' );   /* Standard way of retrieving version major, minor, revision */
                }
            }
            elseif ( $this->LooksLike( 'GT-N7000',__LINE__ ) )
            {
                // Les donnÚes techniques de cet appareil sont dispo Ó
                // http://wap.samsungmobile.com/uaprof/GT-N7000.xml
                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szDevice     = 'samsung';
                $this->szModel      = 'galaxy note';
                $this->szMobility   = 'phone';

                $this->aProperties['keyboard'               ] = 'PhoneKeypad';
                $this->aProperties['pointing'               ] = null;
                $this->aProperties['company'                ] = 'samsung';
                $this->aProperties['camera'                 ] = null;
                $this->aProperties['storage'                ] = null;
                $this->aProperties['html-version'           ] = 4.0;
                $this->aProperties['java-enabled'           ] = false;
                $this->aProperties['javascript-enabled'     ] = true;
                $this->aProperties['tables-capable'         ] = true;
                $this->aProperties['frames-capable'         ] = true;
                $this->aProperties['pixel-ratio'            ] = '1x1';
                $this->aProperties['screen-size'            ] = '480x800';
                $this->aProperties['screen-size-char'       ] = '25x21';
                $this->aProperties['sound-output-capable'   ] = true;
                $this->aProperties['voice-input-capable'    ] = true;

                $this->Version( 'android[\/ ]' );   /* Standard way of retrieving version major, minor, revision */
            }
            elseif ( $this->LooksLike( 'GT-N7100',__LINE__ ) )
            {
                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szDevice     = 'samsung';
                $this->szModel      = 'GT-N7100';
                $this->szMobility   = 'phone';

                $this->aProperties['technical-specs'        ] = 'http://wap.samsungmobile.com/uaprof/GT-N7100.xml';
                $this->aProperties['keyboard'               ] = 'PhoneKeypad';
                $this->aProperties['pointing'               ] = null;
                $this->aProperties['company'                ] = 'samsung';
                $this->aProperties['camera'                 ] = null;
                $this->aProperties['storage'                ] = null;
                $this->aProperties['html-version'           ] = 4.0;
                $this->aProperties['java-enabled'           ] = false;
                $this->aProperties['javascript-enabled'     ] = true;
                $this->aProperties['tables-capable'         ] = true;
                $this->aProperties['frames-capable'         ] = true;
                $this->aProperties['pixel-ratio'            ] = '1x1';
                $this->aProperties['screen-size'            ] = '720x1280';
                $this->aProperties['screen-size-char'       ] = '25x21';
                $this->aProperties['color-capable'          ] = true;
                $this->aProperties['bits-per-pixel'         ] = 16;
                $this->aProperties['image-capable'          ] = true;
                $this->aProperties['sound-output-capable'   ] = true;
                $this->aProperties['voice-input-capable'    ] = true;

                // Encore d'autres propriÚtÚs Ó prendre

                $this->Version( 'android[\/ ]' );   /* Standard way of retrieving version major, minor, revision */
            }
            elseif ( $this->LooksLike( 'GT-P3110',__LINE__ ) )
            {
                // http://wap.samsungmobile.com/uaprof/GT-P3110.xml
                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szDevice     = 'samsung';
                $this->szModel      = 'galaxy tab 2 7inch';
                $this->szMobility   = 'tablet';

                $this->aProperties['keyboard'               ] = 'PhoneKeypad';
                $this->aProperties['pointing'               ] = null;
                $this->aProperties['company'                ] = 'samsung';
                $this->aProperties['camera'                 ] = null;
                $this->aProperties['storage'                ] = null;
                $this->aProperties['html-version'           ] = 4.0;
                $this->aProperties['java-enabled'           ] = false;
                $this->aProperties['javascript-enabled'     ] = true;
                $this->aProperties['tables-capable'         ] = true;
                $this->aProperties['frames-capable'         ] = true;
                $this->aProperties['pixel-ratio'            ] = '1x1';
                $this->aProperties['screen-size'            ] = '1024x600';
                $this->aProperties['screen-size-char'       ] = '25x21';
                $this->aProperties['sound-output-capable'   ] = true;
                $this->aProperties['voice-input-capable'    ] = true;

                $this->Version( 'android[\/ ]' );   /* Standard way of retrieving version major, minor, revision */
            }
            elseif ( $this->LooksLike( 'GT-P5100',__LINE__ ) )
            {
                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szDevice     = 'samsung';
                $this->szModel      = 'galaxy tab 2 10.1';
                $this->szMobility   = 'tablet';

                $this->aProperties['technical-specs'        ] = 'http://wap.samsungmobile.com/uaprof/GT-P5100.xml';
                $this->aProperties['keyboard'               ] = 'PhoneKeypad';
                $this->aProperties['pointing'               ] = null;
                $this->aProperties['company'                ] = 'samsung';
                $this->aProperties['camera'                 ] = null;
                $this->aProperties['storage'                ] = null;
                $this->aProperties['html-version'           ] = 4.0;
                $this->aProperties['java-enabled'           ] = false;
                $this->aProperties['javascript-enabled'     ] = true;
                $this->aProperties['tables-capable'         ] = true;
                $this->aProperties['frames-capable'         ] = true;
                $this->aProperties['pixel-ratio'            ] = '1x1';
                $this->aProperties['screen-size'            ] = '1280x800';
                $this->aProperties['screen-size-char'       ] = '25x21';
                $this->aProperties['sound-output-capable'   ] = true;
                $this->aProperties['voice-input-capable'    ] = true;

                $this->Version( 'android[\/ ]' );   /* Standard way of retrieving version major, minor, revision */
            }
            elseif ( $this->LooksLike( 'GT-P6210',__LINE__ ) )
            {
                // Samsung Galaxy TabÖ 7.0 Plus (Wi-Fi) 16GB
                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szDevice     = 'samsung';
                $this->szModel      = 'galaxy tab 7.0';
                $this->szMobility   = 'tablet';

                $this->Version( 'android[\/ ]' );   /* Standard way of retrieving version major, minor, revision */
            }
            elseif ( $this->LooksLike( 'GT-P7510',__LINE__ ) )
            {
                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szDevice     = 'samsung';
                $this->szModel      = 'galaxy tab 10.1';
                $this->szMobility   = 'tablet';

                $this->Version( 'android[\/ ]' );   /* Standard way of retrieving version major, minor, revision */
            }
            elseif ( $this->LooksLike( 'SCH-I815',__LINE__ ) )
            {
                // Samsung Galaxy Tab 7.7 (Verizon)
                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szDevice     = 'samsung';
                $this->szModel      = 'galaxy tab 7.7 (verizon)';
                $this->szMobility   = 'tablet';

                $this->Version( 'android[\/ ]' );   /* Standard way of retrieving version major, minor, revision */
            }
            elseif ( $this->LooksLike( 'nexus',__LINE__ ) )
            {
                // Mozilla/5.0 (Linux; Android 4.3; Nexus 7 Build/JWR66Y) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.82 Safari/537.36
                // Mozilla/5.0 (Linux; Android 4.4.2; Nexus 7 Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.105 Safari/537.36
                $this->szType       = 'browser';
                $this->szDevice     = 'google';
                $this->szModel      = 'nexus';
                $this->szMobility   = 'tablet';

                if ( vaesoli::STR_iPos( $this->szUA,'chrome' ) != -1 )
                {
                    $this->szName   = 'chrome';
                    $this->Version( 'chrome[\/]' );     /* Standard way of retrieving version major, minor, revision */
                }
                else
                {
                    $this->szName   = 'android';
                    $this->Version( 'android[\/ ]' );   /* Standard way of retrieving version major, minor, revision */
                }

                if ( preg_match( '/nexus (?P<model>(\d{1,2}|One))/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['model'] ) )
                    {
                        $this->szModel .= ' ' . trim( $aMatch['model'] );

                        if ( strtolower( trim( $aMatch['model'] ) ) === 'one' )
                        {
                            $this->szMobility                   = 'phone';
                            $this->aProperties['screen-size']   = '480x800';
                            $this->aProperties['camera'     ]   = '5MP, 2560x1920';
                        }
                        elseif ( trim( $aMatch['model'] ) === '5' || trim( $aMatch['model'] ) === '6' )
                        {
                            $this->szMobility                   = 'phone';
                        }
                        elseif ( trim( $aMatch['model'] ) === '9' )
                        {
                            $this->aProperties['screen-size']   = '2048x1536';
                            $this->aProperties['camera'     ]   = '8MP, 3264x2448 (back)';
                        }
                        else
                        {
                            // This is for 3rd model only ... and nothing guarantees that it is Asus!!!
                            $this->aProperties['screen-size']   = '1280x800';
                            $this->aProperties['camera'     ]   = '1.2MP (front)';
                        }
                    }
                }   /* if ( preg_match( ... ) ) */
                //else
                //{
                //    //Mozilla/5.0 (Linux; Android 5.0.1; Nexus 6 Build/LRX22C) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.93 Mobile Safari/537.36
                //    if ( vaesoli::STR_iPos( $szThis->szUA,'Nexus 6' )
                //    {
                //        $this->szMobility   = 'phone';
                //    }
                //}
            }
            elseif ( $this->LooksLike( 'bingbot',__LINE__ ) )
            {
                $this->szName = 'bingbot';
                $this->szType = 'bot';

                if ( preg_match( '/bingbot\/(?P<major>\d{1,2})\.(?P<minor>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'maxthon',__LINE__ ) )
            {
                $this->szName = 'maxthon';
                $this->szType = 'browser';

                $this->Version( 'maxthon[\/ ]' );   /* Standard way of retrieving version major, minor, revision */

                if ( $this->szBuild == '2000' )
                {
                    // UA example from asus tablet (cannot distinguish between a tablet and a phone ... hence use 'mobile')
                    $this->szMobility = 'mobile';
                }
                // User agent found on Windows (4.2.0.4000)
                // Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Maxthon/4.2.0.4000 Chrome/30.0.1551.0 Safari/537.36
                // This case is NOT handled yet but it should defaut nicely
            }
            elseif ( $this->LooksLike( 'opera',__LINE__ ) )
            {
                if ( vaesoli::STR_iPos( $this->szUA,'opera mini' ) != -1 )
                {
                    $this->szName       = 'opera mini';
                    $this->szMobility   = 'mobile';
                }
                elseif ( vaesoli::STR_iPos( $this->szUA,'opera mobi' ) != -1 )
                {
                    $this->szName       = 'opera mobi';
                    $this->szMobility   = 'mobile';
                }
                else
                {
                    $this->szName       = 'opera';
                }
                $this->szType = 'browser';

                if ( preg_match( '/version\/(?P<major>\d{1,2})\.(?P<minor>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                }
                elseif ( preg_match( '/Opera[\/ ](?P<major>\d)\.(?P<minor>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                }
                //elseif ( preg_match( '/Opera (?P<major>\d)\.(?P<minor>\d{1,2})/si',$this->szUA,$aMatch ) )
                //{
                //    if ( isset( $aMatch['major'] ) )
                //    {
                //        $this->iMajor = (int) $aMatch['major'];
                //    }
                //    if ( isset( $aMatch['minor'] ) )
                //    {
                //        $this->iMinor = (int) $aMatch['minor'];
                //    }
                //}
            }
            elseif ( $this->LooksLike( 'facebookexternalhit',__LINE__ ) )
            {
                $this->szName = 'facebook external hit';
                $this->szType = 'bot';
            }
            elseif ( $this->LooksLike( 'findlinks',__LINE__ ) )
            {
                $this->szName = 'FindLinks';
                $this->szType = 'bot';

                if ( preg_match( '/findlinks\/(?P<maj>\d{1,2})\.(?P<min>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['maj'] ) )
                    {
                        $this->iMajor = (int) $aMatch['maj'];
                    }
                    if ( isset( $aMatch['min'] ) )
                    {
                        $this->iMinor = (int) $aMatch['min'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'seznam screenshot-generator',__LINE__ ) )
            {
                $this->szName = 'seznam';
                $this->szType = 'bot';

                if ( preg_match( '/-generator (?P<major>\d{1,2})\.(?P<minor>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'mobile/5H11a',__LINE__ ) )
            {
                $this->szName = 'safari';
                $this->szType = 'browser';
            }
            elseif ( $this->LooksLike( 'deepnet explorer',__LINE__ ) )
            {
                $this->szName = 'deepnet';
                $this->szType = 'browser';

                if ( preg_match( '/deepnet explorer (?P<major>\d{1,2})\.(?P<minor>\d{1,2})\.(?P<revision>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                    if ( isset( $aMatch['revision'] ) )
                    {
                        $this->iRevision = (int) $aMatch['revision'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'heritrix',__LINE__ ) )
            {
                $this->szName = 'heritrix';
                $this->szType = 'bot';

                if ( preg_match( '/heritrix(?P<maj>\d{1,2})-(?P<min>\d{1,2})-(?P<rev>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['maj'] ) )
                    {
                        $this->iMajor = (int) $aMatch['maj'];
                    }
                    if ( isset( $aMatch['min'] ) )
                    {
                        $this->iMinor = (int) $aMatch['min'];
                    }
                    if ( isset( $aMatch['rev'] ) )
                    {
                        $this->iRevision = (int) $aMatch['rev'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'Hailoobot',__LINE__ ) )
            {
                $this->szName = 'hailoobot';
                $this->szType = 'bot';

                if ( preg_match( '/Hailoobot\/(?P<maj>\d{1,2})\.(?P<min>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['maj'] ) )
                    {
                        $this->iMajor = (int) $aMatch['maj'];
                    }
                    if ( isset( $aMatch['min'] ) )
                    {
                        $this->iMinor = (int) $aMatch['min'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'sitebot',__LINE__ ) )
            {
                $this->szName = 'sitebot';
                $this->szType = 'bot';
                if ( preg_match( '/Sitebot\/(?P<maj>\d{1,2})\.(?P<min>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['maj'] ) )
                    {
                        $this->iMajor = (int) $aMatch['maj'];
                    }
                    if ( isset( $aMatch['min'] ) )
                    {
                        $this->iMinor = (int) $aMatch['min'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'yandex',__LINE__ ) )
            {
                $this->szName = 'yandex';
                $this->szType = 'bot';
                if ( preg_match( '/yandexbot\/(?P<maj>\d{1,2})\.(?P<min>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['maj'] ) )
                    {
                        $this->iMajor = (int) $aMatch['maj'];
                    }
                    if ( isset( $aMatch['min'] ) )
                    {
                        $this->iMinor = (int) $aMatch['min'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'suggy',__LINE__ ) )
            {
                $this->szName = 'suggy';
                $this->szType = 'bot';
                if ( preg_match( '/suggybot v(?P<maj>\d{1,2})\.(?P<min>\d{1,2})(?P<build>[[:lower:]])?/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['maj'] ) )
                    {
                        $this->iMajor = (int) $aMatch['maj'];
                    }
                    if ( isset( $aMatch['min'] ) )
                    {
                        $this->iMinor = (int) $aMatch['min'];
                    }
                    if ( isset( $aMatch['build'] ) )
                    {
                        $this->szBuild = $aMatch['build'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'W3C_Validator',__LINE__ ) )
            {
                $this->szName = 'w3c validator';
                $this->szType = 'bot';
                if ( preg_match( '/(?P<maj>\d{1,5})\.(?P<min>\d{1,5})(\.(?P<rev>\d{1,5})(\.(?P<build>\d{1,5}))?)?/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['maj'] ) )
                    {
                        $this->iMajor = (int) $aMatch['maj'];
                    }
                    if ( isset( $aMatch['min'] ) )
                    {
                        $this->iMinor = (int) $aMatch['min'];
                    }
                    if ( isset( $aMatch['rev'] ) )
                    {
                        $this->iRevision = (int) $aMatch['rev'];
                    }
                    if ( isset( $aMatch['build'] ) )
                    {
                        $this->szBuild = $aMatch['build'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'iTunes',__LINE__ ) )
            {
                $this->szName = 'itunes';
                $this->szType = 'bot';
                if ( preg_match( '/itunes[\/ ](?P<maj>\d{1,5})\.(?P<min>\d{1,5})(\.(?P<rev>\d{1,5})(\.(?P<build>\d{1,5}))?)?/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['maj'] ) )
                    {
                        $this->iMajor = (int) $aMatch['maj'];
                    }
                    if ( isset( $aMatch['min'] ) )
                    {
                        $this->iMinor = (int) $aMatch['min'];
                    }
                    if ( isset( $aMatch['rev'] ) )
                    {
                        $this->iRevision = (int) $aMatch['rev'];
                    }
                    if ( isset( $aMatch['build'] ) )
                    {
                        $this->szBuild = $aMatch['build'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'metajobbot',__LINE__ ) )
            {
                $this->szName = 'metajobbot';
                $this->szType = 'bot';
            }
            elseif ( $this->LooksLike( 'JikeSpider',__LINE__ ) )
            {
                $this->szName = 'jikespider';
                $this->szType = 'bot';
            }
            elseif ( $this->LooksLike( 'BacklinkCrawler',__LINE__ ) )
            {
                $this->szName = 'backlinkcrawler';
                $this->szType = 'bot';
            }
            elseif ( $this->LooksLike( 'MLBot ',__LINE__ ) )
            {
                $this->szName = 'mlbot';
                $this->szType = 'bot';
            }
            elseif ( $this->LooksLike( 'ShopSalad',__LINE__ ) )
            {
                $this->szName = 'shopsalad';
                $this->szType = 'bot';

                if ( preg_match( '/shopsalad[\/ ](?P<maj>\d{1,2})\.(?P<min>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['maj'] ) )
                    {
                        $this->iMajor = (int) $aMatch['maj'];
                    }
                    if ( isset( $aMatch['min'] ) )
                    {
                        $this->iMinor = (int) $aMatch['min'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'BotOnParade',__LINE__ ) )
            {
                $this->szName = 'botonparade';
                $this->szType = 'bot';
            }
            elseif ( $this->LooksLike( 'msnbot-media',__LINE__ ) )
            {
                $this->szName = 'msnbot-media';
                $this->szType = 'bot';
                if ( preg_match( '/msnbot-media[\/ ](?P<maj>\d{1,2})\.(?P<min>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['maj'] ) )
                    {
                        $this->iMajor = (int) $aMatch['maj'];
                    }
                    if ( isset( $aMatch['min'] ) )
                    {
                        $this->iMinor = (int) $aMatch['min'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'Microsoft Data Access Internet Publishing Provider DAV',__LINE__ ) )
            {
                $this->szName = 'microsoft data access';
                $this->szType = 'bot';
                if ( preg_match( '/DAV[\/ ](?P<maj>\d{1,2})\.(?P<min>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['maj'] ) )
                    {
                        $this->iMajor = (int) $aMatch['maj'];
                    }
                    if ( isset( $aMatch['min'] ) )
                    {
                        $this->iMinor = (int) $aMatch['min'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'Sosoimagespider',__LINE__ ) )
            {
                $this->szName = 'soso';
                $this->szType = 'bot';
            }
            elseif ( $this->LooksLike( 'jobs.de-Robot',__LINE__ ) )
            {
                $this->szName = 'jobs.de';
                $this->szType = 'bot';
            }
            elseif ( $this->LooksLike( 'yacybot',__LINE__ ) )
            {
                $this->szName = 'yacybot';
                $this->szType = 'bot';
            }
            elseif ( $this->LooksLike( 'java/',__LINE__ ) )
            {
                $this->szName = 'java';
                $this->szType = 'browser';

                if ( preg_match( '/java\/(?P<maj>\d{1,2})\.(?P<min>\d{1,2})\.(?P<rev>\d{1,2})_(?P<build>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['maj'] ) )
                    {
                        $this->iMajor = (int) $aMatch['maj'];
                    }
                    if ( isset( $aMatch['min'] ) )
                    {
                        $this->iMinor = (int) $aMatch['min'];
                    }
                    if ( isset( $aMatch['rev'] ) )
                    {
                        $this->iRevision = (int) $aMatch['rev'];
                    }
                    if ( isset( $aMatch['build'] ) )
                    {
                        $this->szBuild = $aMatch['build'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'grub-client',__LINE__ ) )
            {
                $this->szName = 'grub';
                $this->szType = 'bot';

                if ( preg_match( '/grub-client-(?P<major>\d{1,2})(\.(?P<build>(\d{1,2}|[[:lower:]])))?/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                    if ( isset( $aMatch['build'] ) )
                    {
                        $this->szBuild = $aMatch['build'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'kindle',__LINE__ ) )
            {
                $this->szName       = 'kindle';
                $this->szType       = 'browser';
                $this->szMobility   = 'tablet';
                if ( preg_match( '/Kindle\/(?P<maj>\d{1,2})\.(?P<min>\d{1,2})/i',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['maj'] ) )
                    {
                        $this->iMajor = (int) $aMatch['maj'];
                    }
                    if ( isset( $aMatch['min'] ) )
                    {
                        $this->iMinor = (int) $aMatch['min'];
                    }
                }
                elseif ( preg_match( '/android (?P<maj>\d{1,2})\.(?P<min>\d{1,2})/i',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['maj'] ) )
                    {
                        $this->iMajor = (int) $aMatch['maj'];
                    }
                    if ( isset( $aMatch['min'] ) )
                    {
                        $this->iMinor = (int) $aMatch['min'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'avantgo ',__LINE__ ) )
            {
                $this->szName       = 'avantgo';
                $this->szType       = 'browser';
                $this->szMobility   = 'phone';

                if ( preg_match( '/avantgo (?P<maj>\d{1,2})\.(?P<min>\d{1,2})/i',$this->szUA,$aMatch ) )
                {
                    if ( vaesoli::STR_iPos( $this->szUA,'hiptop 3.4' ) != -1 )
                    {
                        $this->iMajor = 3;
                        $this->iMinor = 4;
                    }
                    else
                    {
                        if ( isset( $aMatch['maj'] ) )
                        {
                            $this->iMajor = (int) $aMatch['maj'];
                        }
                        if ( isset( $aMatch['min'] ) )
                        {
                            $this->iMinor = (int) $aMatch['min'];
                        }
                    }
                }
            }
            elseif ( $this->LooksLike( 'BOLT/2.800',__LINE__ ) )
            {
                $this->szName       = 'safari';
                $this->szType       = 'browser';
                $this->szMobility   = 'phone';
                $this->szDevice     = 'sony ericsson k800i';

                if ( preg_match( '/Version\/(?P<maj>\d{1,2})\.(?P<min>\d{1,2})/i',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['maj'] ) )
                    {
                        $this->iMajor = (int) $aMatch['maj'];
                    }
                    if ( isset( $aMatch['min'] ) )
                    {
                        $this->iMinor = (int) $aMatch['min'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'SonyEricsson',__LINE__ ) )
            {
                $this->szName       = 'SonyEricsson';
                $this->szType       = 'browser';
                $this->szMobility   = 'phone';
                $this->szDevice     = 'SonyEricsson';

                if ( vaesoli::STR_iPos( $this->szUA,'SEMC-Browser' ) != -1 )
                {
                    $this->szName   = 'SEMC-Browser';
                    $this->Version( 'SEMC-Browser[\/ ]' );
                }

                if ( preg_match( '/SonyEricsson(?P<model>[[:alnum:]]\d{1,3}[[:lower:]])/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['model'] ) )
                    {
                        $this->szModel = $aMatch['model'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'SGP311',__LINE__ ) )
            {
                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szMobility   = 'tablet';
                $this->szDevice     = 'sony';
                $this->szModel      = 'sony xperia tablet z sgp311';

                //$this->aProperties['technical-specs'        ] = 'http://wap.samsungmobile.com/uaprof/GT-P5100.xml';
                //$this->aProperties['keyboard'               ] = 'PhoneKeypad';
                //$this->aProperties['pointing'               ] = null;
                $this->aProperties['company'                ] = 'sony';
                //$this->aProperties['camera'                 ] = null;
                //$this->aProperties['storage'                ] = null;
                //$this->aProperties['html-version'           ] = 4.0;
                //$this->aProperties['java-enabled'           ] = false;
                //$this->aProperties['javascript-enabled'     ] = true;
                //$this->aProperties['tables-capable'         ] = true;
                //$this->aProperties['frames-capable'         ] = true;
                //$this->aProperties['pixel-ratio'            ] = '1x1';
                $this->aProperties['screen-size'            ] = '1200x1920';
                //$this->aProperties['screen-size-char'       ] = '25x21';
                //$this->aProperties['sound-output-capable'   ] = true;
                //$this->aProperties['voice-input-capable'    ] = true;

                // Mozilla/5.0 (Linux; Android 4.1.2; SGP311 Build/10.1.C.0.370) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166  Safari/535.19

                if ( $this->LooksLike( 'Android',__LINE__ ) )
                {
                    $this->Version( 'Android ' );
                }
            }
            elseif ( $this->LooksLike( 'LT22i',__LINE__ ) )
            {
                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szMobility   = 'tablet';
                $this->szDevice     = 'sony';
                $this->szModel      = 'xperia p lt22i';

                $this->aProperties['technical-specs'        ] = 'http://wap.sonyericsson.com/UAprof/LT22iR601.xml';
                $this->aProperties['keyboard'               ] = 'Phonekeypad';
                $this->aProperties['pointing'               ] = null;
                $this->aProperties['company'                ] = 'Sony Ericsson Mobile Communications';
                $this->aProperties['camera'                 ] = null;
                $this->aProperties['storage'                ] = null;
                $this->aProperties['html-version'           ] = 4.0;
                $this->aProperties['java-enabled'           ] = false;
                $this->aProperties['javascript-enabled'     ] = true;
                $this->aProperties['tables-capable'         ] = true;
                $this->aProperties['frames-capable'         ] = true;
                $this->aProperties['pixel-ratio'            ] = '1x1';
                $this->aProperties['screen-size'            ] = '960x540';
                //$this->aProperties['screen-size-char'       ] = '25x21';
                $this->aProperties['sound-output-capable'   ] = true;
                $this->aProperties['voice-input-capable'    ] = true;

                // Mozilla/5.0 (Linux; U; Android 2.3; xx-xx; SonyEricssonLT22i Build/6.0.B.1.564) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1

                if ( $this->LooksLike( 'Android',__LINE__ ) )
                {
                    $this->Version( 'Android ' );
                }
            }
            elseif ( $this->LooksLike( 'sprint:',__LINE__ ) )
            {
                $this->szType       = 'browser';
                $this->szMobility   = 'phone';
                $this->szDevice     = 'sprint';

                if ( vaesoli::STR_iPos( $this->szUA,'msie ' ) != -1 )
                {
                    $this->szName       = 'internet explorer';
                }

                $this->Version( 'msie[\/ ]' );

                if ( preg_match( '/sprint:(?P<model>[[:alnum:]]{1,3}-\d{1,4})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['model'] ) )
                    {
                        $this->szModel = $aMatch['model'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'nokia',__LINE__ ) ||
                     $this->LooksLike( 'n900',__LINE__ ) )
            {
                $this->szName       = 'nokia';
                $this->szType       = 'browser';
                $this->szMobility   = 'phone';
                $this->szDevice     = 'nokia';

                if ( preg_match( '/nokia(;)?(?P<model>([[:alnum:]])?\d{1,4}([[:alnum:]])?)/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['model'] ) )
                    {
                        $this->szModel  = $aMatch['model'];
                    }
                }
                elseif ( preg_match( '/maemo browser.*?n900/si',$this->szUA,$aMatch ) )
                {
                    $this->szModel  = 'n900';
                }
                elseif ( preg_match( '/lumia (?P<model>\d{1,3})/si',$this->szUA,$aMatch ) )
                {
                    $this->szModel = 'lumia ' . $aMatch['model'];
                }

                if ( preg_match( '/nokia(?P<model>\d{1,4})\/(?P<maj>\d{1,2})\.(?P<min>\d{1})(\.(?P<rev>\d{1,3}))?/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['maj'] ) )
                    {
                        $this->iMajor = (int) $aMatch['maj'];
                    }
                    if ( isset( $aMatch['min'] ) )
                    {
                        $this->iMinor = (int) $aMatch['min'];
                    }
                    if ( isset( $aMatch['rev'] ) )
                    {
                        $this->iRevision = (int) $aMatch['rev'];
                    }
                }
                elseif ( STR_iPos( $this->szUA,'IEMobile' ) != -1 )
                {
                    if ( preg_match( '/IEMobile\/(?P<maj>\d{1,2})\.(?P<min>\d{1})(\.(?P<rev>\d{1,3}))?/si',$this->szUA,$aMatch ) )
                    {
                        $this->szName = 'internet explorer mobile';
                        if ( isset( $aMatch['maj'] ) )
                        {
                            $this->iMajor = (int) $aMatch['maj'];
                        }
                        if ( isset( $aMatch['min'] ) )
                        {
                            $this->iMinor = (int) $aMatch['min'];
                        }
                        if ( isset( $aMatch['rev'] ) )
                        {
                            $this->iRevision = (int) $aMatch['rev'];
                        }
                    }
                }

                //if ( preg_match( '/nokia(?P<model>\d{1,4})(XpressMusic)?\/GoBrowser(\/(?P<maj>\d{1,2})\.(?P<min>\d{1,2})\.(?P<rev>\d{1,2})(\.(?P<build>\d{1,2}))?)?/si',$this->szUA,$aMatch ) )
                if ( vaesoli::STR_iPos( $this->szUA,'GoBrowser' ) != -1 )
                {
                    $this->szName = 'gobrowser';
                    if ( preg_match( '/GoBrowser(\/(?P<maj>\d{1,3})\.(?P<min>\d{1,4})\.(?P<rev>\d{1,4})(\.(?P<build>\d{1,4}))?)?/si',$this->szUA,$aMatch ) )
                    {
                        if ( isset( $aMatch['maj'] ) )
                        {
                            $this->iMajor = (int) $aMatch['maj'];
                        }
                        if ( isset( $aMatch['min'] ) )
                        {
                            $this->iMinor = (int) $aMatch['min'];
                        }
                        if ( isset( $aMatch['rev'] ) )
                        {
                            $this->iRevision = (int) $aMatch['rev'];
                        }
                        if ( isset( $aMatch['build'] ) )
                        {
                            $this->szBuild = $aMatch['build'];
                        }
                    }
                }

                /* If model not empty and XpressMusic found
                   the X of XpressMusic must be eliminated
                   from the model */
                if ( ! empty( $this->szModel ) && vaesoli::STR_iPos( $this->szUA,'XpressMusic') != -1 )
                {
                    if ( strtoupper( STR_Right( $this->szModel,1 ) ) == 'X' )
                    {
                        $this->szModel = substr( $this->szModel,0,-1 );
                    }
                }
            }
            elseif ( $this->LooksLike( 'vagabondo',__LINE__ ) )
            {
                $this->szName = 'vagabondo';
                $this->szType = 'bot';

                if ( preg_match( '/vagabondo\/(?P<major>\d{1,2})\.(?P<minor>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'Pandora/',__LINE__ ) )
            {
                $this->szName = 'pandora internet radio';
                $this->szType = 'browser';

                $this->Version( 'Pandora/' );
            }
            elseif ( $this->LooksLike( 'crawler4j',__LINE__ ) )
            {
                $this->szName = 'crawler4j';
                $this->szType = 'bot';

                $this->aProperties['technical-specs'        ] = 'http://code.google.com/p/crawler4j/';
            }
            elseif ( $this->LooksLike( 'AdnormCrawler',__LINE__ ) )
            {
                $this->szName = 'crawler4j';
                $this->szType = 'bot';

                $this->iDanger  = 5;

                $this->aProperties['technical-specs'        ] = 'http://www.adnorm.com/crawler';

            }
            elseif ( $this->LooksLike( 'analyticsseo.com',__LINE__ ) )
            {
                $this->szName = 'analytics seo crawler';
                $this->szType = 'bot';

                $this->aProperties['technical-specs'        ] = 'http://www.analyticsseo.com/crawler';
            }
            elseif ( $this->LooksLike( 'GigablastOpenSource',__LINE__ ) )
            {
                $this->szName = 'gigablast';
                $this->szType = 'bot';

                $this->aProperties['technical-specs'        ] = 'https://www.gigablast.com/';
            }
            elseif ( $this->LooksLike( 'Obigo-Browser',__LINE__ ) )
            {
                $this->szName = 'obigo browser w10';
                $this->szType = 'browser';

                $this->aProperties['technical-specs'        ] = 'http://obigo.com/solution/browser.html';
            }
            elseif ( $this->LooksLike( 'Iceweasel',__LINE__ ) )
            {
                $this->szName = 'iceweasel';
                $this->szType = 'browser';

                /* Careful: case sensitive search becase IceWeasel also exists */
                if ( preg_match( '/Iceweasel\/(?P<major>\d{1,2})\.(?P<minor>\d{1,2})((\.(?P<rev>\d{1,2}))?([\.-](?P<build>\d{1,2}))?|(?P<build2>[[:lower:]]\d))/s',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                    if ( isset( $aMatch['rev'] ) )
                    {
                        $this->iRevision = (int) $aMatch['rev'];
                    }
                    if ( isset( $aMatch['build'] ) )
                    {
                        $this->szBuild = $aMatch['build'];
                    }
                    if ( isset( $aMatch['build2'] ) )
                    {
                        $this->szBuild = $aMatch['build2'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'IceWeasel',__LINE__ ) )
            {
                $this->szName = 'iceWeasel';
                $this->szType = 'browser';

                /* Careful: case sensitive search becase IceWeasel also exists */
                $this->Version( 'IceWeasel\/','s' );
                //if ( preg_match( '/IceWeasel\/(?P<major>\d{1,2})\.(?P<minor>\d{1,2})(\.(?P<rev>\d{1,2}))?(\.(?P<build>\d{1,2}))?/s',$this->szUA,$aMatch ) )
                //{
                //    if ( isset( $aMatch['major'] ) )
                //    {
                //        $this->iMajor = (int) $aMatch['major'];
                //    }
                //    if ( isset( $aMatch['minor'] ) )
                //    {
                //        $this->iMinor = (int) $aMatch['minor'];
                //    }
                //    if ( isset( $aMatch['rev'] ) )
                //    {
                //        $this->iRevision = (int) $aMatch['rev'];
                //    }
                //    if ( isset( $aMatch['build'] ) )
                //    {
                //        $this->szBuild = $aMatch['build'];
                //    }
                //}
            }
            elseif ( $this->LooksLike( 'diffbot',__LINE__ ) ||
                     $this->LooksLike( 'diffbot.com',__LINE__ ) )
            {
                $this->szName = 'diffbot';
                $this->szType = 'bot';

                if ( preg_match( '/diffbot\/(?P<major>\d{1,2})\.(?P<minor>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'Firebird Browser',__LINE__ ) )
            {
                $this->szName = 'firebird';
                $this->szType = 'browser';

                if ( preg_match( '/firebird browser\/(?P<major>\d{1,2})\.(?P<minor>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'geourl',__LINE__ ) )
            {
                $this->szName = 'geourl';
                $this->szType = 'bot';

                if ( preg_match( '/geourl\/(?P<major>\d{1,2})\.(?P<minor>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'PerMan Surfer',__LINE__ ) )
            {
                $this->szName = 'perman';
                $this->szType = 'bot';

                if ( preg_match( '/perman surfer (?P<major>\d{1,2})\.(?P<minor>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'vaesolibot',__LINE__ ) )
            {
                $this->szName = 'vaesoli';
                $this->szType = 'bot';

                if ( preg_match( '/vaesolibot( version){0,1}\/(?P<major>\d{1,2})\.(?P<minor>\d{1,2})(\.(?P<revision>\d{1,2}))?/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                    if ( isset( $aMatch['revision'] ) )
                    {
                        $this->iRevision = (int) $aMatch['revision'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'dillo/',__LINE__ ) )
            {
                $this->szName = 'dillo';
                $this->szType = 'browser';

                if ( preg_match( '/dillo\/(?P<major>\d{1,2})\.(?P<minor>\d{1,2})\.(?P<revision>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                    if ( isset( $aMatch['revision'] ) )
                    {
                        $this->iRevision = (int) $aMatch['revision'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'deskbrowse',__LINE__ ) )
            {
                $this->szName = 'deskbrowse';
                $this->szType = 'browser';

                if ( preg_match( '/deskbrowse\/(?P<major>\d{1,2})\.(?P<minor>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'ZyBorg',__LINE__ ) )
            {
                $this->szName = 'wisenutbot';
                $this->szType = 'bot';

                if ( preg_match( '/ZyBorg\/(?P<major>\d{1,2})\.(?P<minor>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'msrbot',__LINE__ ) )
            {
                $this->szName   = 'microsoft research crawler';
                $this->szType   = 'bot';
                $this->iDanger  = 0;
            }
            elseif ( $this->LooksLike( 'IlTrovatore-Setaccio',__LINE__ ) )
            {
                $this->szName   = 'IlTrovatore';
                $this->szType   = 'bot';
                $this->iDanger  = 0;
            }
            elseif ( $this->LooksLike( 'OpenAcoon',__LINE__ ) )
            {
                $this->szName   = 'OpenAcoon';
                $this->szType   = 'bot';
                $this->iDanger  = 0;

                if ( preg_match( '/OpenAcoon v(?P<major>d{1,2})\.(?P<minor>\d{1,2})\.(?P<revision>\d{1,2})?/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                    if ( isset( $aMatch['revision'] ) )
                    {
                        $this->iRevision= (int) $aMatch['revision'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'www.acoon.de',__LINE__ ) )
            {
                $this->szName   = 'Acoon';
                $this->szType   = 'bot';
                $this->iDanger  = 0;

                if ( preg_match( '/Acoon v(?P<major>d{1,2})\.(?P<minor>\d{1,2})\.(?P<revision>\d{1,2})?/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                    if ( isset( $aMatch['revision'] ) )
                    {
                        $this->iRevision= (int) $aMatch['revision'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'site server ',__LINE__ ) )
            {
                $this->szName = 'site server';
                $this->szType = 'bot';

                if ( preg_match( '/site server (?P<major>\d{1,2})\.(?P<minor>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'libwww-perl',__LINE__ ) )
            {
                $this->szName = 'perl';
                $this->szType = 'bot';

                if ( preg_match( '/libwww-perl\/(?P<major>\d{1,2})\.(?P<minor>\d{1,3})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'SuperBot',__LINE__ ) )
            {
                $this->szName = 'superbot';
                $this->szType = 'bot';

                if ( preg_match( '/(?P<major>\d{1,2})\.(?P<minor>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'yahoo',__LINE__ ) ||
                     $this->LooksLike( 'slurp',__LINE__ ) )
            {
                $this->szName = 'slurp';
                $this->szType = 'bot';
            }
            elseif ( $this->LooksLike( 'YahooMobileMessenger/',__LINE__ ) )
            {
                $this->szName = 'yahoo mobile messenger';
                $this->szType = 'bot';

                $this->Version( 'YahooMobileMessenger\/' );
            }
            elseif ( $this->LooksLike( 'SHARP-TQ-GX10i/',__LINE__ ) )
            {
                $this->szName       = 'openwave mobile browser';
                $this->szType       = 'browser';
                $this->szMobility   = 'phone';
                $this->szDevice     = 'sharp';
                $this->szModel      = 'gx10i';

                // SHARP-TQ-GX10i/1.0 Profile/MIDP-1.0 Configuration/CLDC-1.0  UP.Browser/6.1.0.6.1.d.1 (GUI) MMP/1.0
                //$this->aProperties['technical-specs'        ] = 'http://wap.samsungmobile.com/uaprof/GT-P5100.xml';
                //$this->aProperties['keyboard'               ] = 'PhoneKeypad';
                //$this->aProperties['pointing'               ] = null;
                $this->aProperties['company'                ] = 'sharp';
                //$this->aProperties['camera'                 ] = null;
                //$this->aProperties['storage'                ] = null;
                //$this->aProperties['html-version'           ] = 4.0;
                //$this->aProperties['java-enabled'           ] = false;
                //$this->aProperties['javascript-enabled'     ] = true;
                //$this->aProperties['tables-capable'         ] = true;
                //$this->aProperties['frames-capable'         ] = true;
                //$this->aProperties['pixel-ratio'            ] = '1x1';
                $this->aProperties['screen-size'            ] = '120x160';
                //$this->aProperties['screen-size-char'       ] = '25x21';
                //$this->aProperties['sound-output-capable'   ] = true;
                //$this->aProperties['voice-input-capable'    ] = true;

                $this->Version( 'UP.Browser\/' );
            }
            elseif ( $this->LooksLike( 'MOT-XT320',__LINE__ ) )
            {
                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szMobility   = 'phone';
                $this->szDevice     = 'motorola';
                $this->szModel      = 'motorola defy mini';

                // Mozilla/5.0 (Linux; U; Android 2.3.6; fr-fr; MOT-XT320 Build/0A.1F.37) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1
                if ( $this->LooksLike( 'Android',__LINE__ ) )
                {
                    $this->Version( 'Android ' );
                }

                //$this->aProperties['technical-specs'        ] = 'http://wap.samsungmobile.com/uaprof/GT-P5100.xml';
                //$this->aProperties['keyboard'               ] = 'PhoneKeypad';
                //$this->aProperties['pointing'               ] = null;
                $this->aProperties['company'                ] = 'motorola';
                //$this->aProperties['camera'                 ] = null;
                //$this->aProperties['storage'                ] = null;
                //$this->aProperties['html-version'           ] = 4.0;
                //$this->aProperties['java-enabled'           ] = false;
                //$this->aProperties['javascript-enabled'     ] = true;
                //$this->aProperties['tables-capable'         ] = true;
                //$this->aProperties['frames-capable'         ] = true;
                //$this->aProperties['pixel-ratio'            ] = '1x1';
                $this->aProperties['screen-size'            ] = '320x480';
                //$this->aProperties['screen-size-char'       ] = '25x21';
                //$this->aProperties['sound-output-capable'   ] = true;
                //$this->aProperties['voice-input-capable'    ] = true;
            }
            elseif ( $this->LooksLike( 'RW-T110',__LINE__ ) )
            {
                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szMobility   = 'tablet';
                $this->szDevice     = 'sharp';
                $this->szModel      = 'rw-t110 10"';

                //$this->aProperties['technical-specs'        ] = 'http://wap.samsungmobile.com/uaprof/GT-P5100.xml';
                //$this->aProperties['keyboard'               ] = 'PhoneKeypad';
                //$this->aProperties['pointing'               ] = null;
                $this->aProperties['company'                ] = 'sharp';
                //$this->aProperties['camera'                 ] = null;
                //$this->aProperties['storage'                ] = null;
                //$this->aProperties['html-version'           ] = 4.0;
                //$this->aProperties['java-enabled'           ] = false;
                //$this->aProperties['javascript-enabled'     ] = true;
                //$this->aProperties['tables-capable'         ] = true;
                //$this->aProperties['frames-capable'         ] = true;
                //$this->aProperties['pixel-ratio'            ] = '1x1';
                $this->aProperties['screen-size'            ] = '1280x800';
                //$this->aProperties['screen-size-char'       ] = '25x21';
                //$this->aProperties['sound-output-capable'   ] = true;
                //$this->aProperties['voice-input-capable'    ] = true;

                if ( $this->LooksLike( 'Android',__LINE__ ) )
                {
                    $this->Version( 'Android ' );
                }
            }
            elseif ( $this->LooksLike( 'RW-T107',__LINE__ ) )
            {
                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szMobility   = 'tablet';
                $this->szDevice     = 'sharp';
                $this->szModel      = 'rw-t107 7"';

                //$this->aProperties['technical-specs'        ] = 'http://wap.samsungmobile.com/uaprof/GT-P5100.xml';
                //$this->aProperties['keyboard'               ] = 'PhoneKeypad';
                //$this->aProperties['pointing'               ] = null;
                $this->aProperties['company'                ] = 'sharp';
                //$this->aProperties['camera'                 ] = null;
                //$this->aProperties['storage'                ] = null;
                //$this->aProperties['html-version'           ] = 4.0;
                //$this->aProperties['java-enabled'           ] = false;
                //$this->aProperties['javascript-enabled'     ] = true;
                //$this->aProperties['tables-capable'         ] = true;
                //$this->aProperties['frames-capable'         ] = true;
                //$this->aProperties['pixel-ratio'            ] = '1x1';
                $this->aProperties['screen-size'            ] = '600x1024';
                //$this->aProperties['screen-size-char'       ] = '25x21';
                //$this->aProperties['sound-output-capable'   ] = true;
                //$this->aProperties['voice-input-capable'    ] = true;

                if ( $this->LooksLike( 'Android',__LINE__ ) )
                {
                    $this->Version( 'Android ' );
                }
            }
            elseif ( $this->LooksLike( 'SH-12C',__LINE__ ) )
            {
                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szMobility   = 'phone';
                $this->szDevice     = 'sharp';
                $this->szModel      = 'sh-13c';

                //$this->aProperties['technical-specs'        ] = 'http://wap.samsungmobile.com/uaprof/GT-P5100.xml';
                //$this->aProperties['keyboard'               ] = 'PhoneKeypad';
                //$this->aProperties['pointing'               ] = null;
                $this->aProperties['company'                ] = 'sharp';
                //$this->aProperties['camera'                 ] = null;
                //$this->aProperties['storage'                ] = null;
                //$this->aProperties['html-version'           ] = 4.0;
                //$this->aProperties['java-enabled'           ] = false;
                //$this->aProperties['javascript-enabled'     ] = true;
                //$this->aProperties['tables-capable'         ] = true;
                //$this->aProperties['frames-capable'         ] = true;
                //$this->aProperties['pixel-ratio'            ] = '1x1';
                $this->aProperties['screen-size'            ] = '540x960';
                //$this->aProperties['screen-size-char'       ] = '25x21';
                //$this->aProperties['sound-output-capable'   ] = true;
                //$this->aProperties['voice-input-capable'    ] = true;

                // Mozilla/5.0 (Linux; U; Android 2.3.3; pt-br; SH-12C Build/S9300) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1

                if ( $this->LooksLike( 'Android',__LINE__ ) )
                {
                    $this->Version( 'Android ' );
                }
            }
            elseif ( $this->LooksLike( 'SH-13C',__LINE__ ) )
            {
                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szMobility   = 'phone';
                $this->szDevice     = 'sharp';
                $this->szModel      = 'sh-13c';

                //$this->aProperties['technical-specs'        ] = 'http://wap.samsungmobile.com/uaprof/GT-P5100.xml';
                //$this->aProperties['keyboard'               ] = 'PhoneKeypad';
                //$this->aProperties['pointing'               ] = null;
                $this->aProperties['company'                ] = 'sharp';
                //$this->aProperties['camera'                 ] = null;
                //$this->aProperties['storage'                ] = null;
                //$this->aProperties['html-version'           ] = 4.0;
                //$this->aProperties['java-enabled'           ] = false;
                //$this->aProperties['javascript-enabled'     ] = true;
                //$this->aProperties['tables-capable'         ] = true;
                //$this->aProperties['frames-capable'         ] = true;
                //$this->aProperties['pixel-ratio'            ] = '1x1';
                $this->aProperties['screen-size'            ] = '540x960';
                //$this->aProperties['screen-size-char'       ] = '25x21';
                //$this->aProperties['sound-output-capable'   ] = true;
                //$this->aProperties['voice-input-capable'    ] = true;

                //Mozilla/5.0 (Linux; U; Android 2.3.4; ja-jp; SH-13C Build/S7160) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1

                if ( $this->LooksLike( 'Android',__LINE__ ) )
                {
                    $this->Version( 'Android ' );
                }
            }
            elseif ( $this->LooksLike( 'SH80F',__LINE__ ) )
            {
                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szMobility   = 'phone';
                $this->szDevice     = 'sharp';
                $this->szModel      = 'sh80f';

                //$this->aProperties['technical-specs'        ] = 'http://wap.samsungmobile.com/uaprof/GT-P5100.xml';
                //$this->aProperties['keyboard'               ] = 'PhoneKeypad';
                //$this->aProperties['pointing'               ] = null;
                $this->aProperties['company'                ] = 'sharp';
                //$this->aProperties['camera'                 ] = null;
                //$this->aProperties['storage'                ] = null;
                //$this->aProperties['html-version'           ] = 4.0;
                //$this->aProperties['java-enabled'           ] = false;
                //$this->aProperties['javascript-enabled'     ] = true;
                //$this->aProperties['tables-capable'         ] = true;
                //$this->aProperties['frames-capable'         ] = true;
                //$this->aProperties['pixel-ratio'            ] = '1x1';
                $this->aProperties['screen-size'            ] = '540x960';
                //$this->aProperties['screen-size-char'       ] = '25x21';
                //$this->aProperties['sound-output-capable'   ] = true;
                //$this->aProperties['voice-input-capable'    ] = true;

                //Mozilla/5.0 (Linux; U; Android 2.3.4; ja-jp; SH-13C Build/S7160) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1

                if ( $this->LooksLike( 'Android',__LINE__ ) )
                {
                    $this->Version( 'Android ' );
                }
            }
            elseif ( $this->LooksLike( 'SBM104SH',__LINE__ ) )
            {
                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szMobility   = 'phone';
                $this->szDevice     = 'sharp';
                $this->szModel      = 'sbm104sh';

                //$this->aProperties['technical-specs'        ] = 'http://wap.samsungmobile.com/uaprof/GT-P5100.xml';
                //$this->aProperties['keyboard'               ] = 'PhoneKeypad';
                //$this->aProperties['pointing'               ] = null;
                $this->aProperties['company'                ] = 'sharp';
                //$this->aProperties['camera'                 ] = null;
                //$this->aProperties['storage'                ] = null;
                //$this->aProperties['html-version'           ] = 4.0;
                //$this->aProperties['java-enabled'           ] = false;
                //$this->aProperties['javascript-enabled'     ] = true;
                //$this->aProperties['tables-capable'         ] = true;
                //$this->aProperties['frames-capable'         ] = true;
                //$this->aProperties['pixel-ratio'            ] = '1x1';
                $this->aProperties['screen-size'            ] = '720x1280';
                //$this->aProperties['screen-size-char'       ] = '25x21';
                //$this->aProperties['sound-output-capable'   ] = true;
                //$this->aProperties['voice-input-capable'    ] = true;

                // Mozilla/5.0 (Linux; U; Android 4.0.3; ja-jp; SBM104SH Build/A5100) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30

                if ( $this->LooksLike( 'Android',__LINE__ ) )
                {
                    $this->Version( 'Android ' );
                }
            }
            elseif ( $this->LooksLike( 'SH-09D',__LINE__ ) )
            {
                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szMobility   = 'phone';
                $this->szDevice     = 'sharp';
                $this->szModel      = 'sh-09d';

                //$this->aProperties['technical-specs'        ] = 'http://wap.samsungmobile.com/uaprof/GT-P5100.xml';
                //$this->aProperties['keyboard'               ] = 'PhoneKeypad';
                //$this->aProperties['pointing'               ] = null;
                $this->aProperties['company'                ] = 'sharp';
                //$this->aProperties['camera'                 ] = null;
                //$this->aProperties['storage'                ] = null;
                //$this->aProperties['html-version'           ] = 4.0;
                //$this->aProperties['java-enabled'           ] = false;
                //$this->aProperties['javascript-enabled'     ] = true;
                //$this->aProperties['tables-capable'         ] = true;
                //$this->aProperties['frames-capable'         ] = true;
                //$this->aProperties['pixel-ratio'            ] = '1x1';
                $this->aProperties['screen-size'            ] = '720x1280';
                //$this->aProperties['screen-size-char'       ] = '25x21';
                //$this->aProperties['sound-output-capable'   ] = true;
                //$this->aProperties['voice-input-capable'    ] = true;

                // Mozilla/5.0 (Linux; Android 4.0.4; SH-09D Build/S6130) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19

                if ( $this->LooksLike( 'Android',__LINE__ ) )
                {
                    $this->Version( 'Android ' );
                }
            }
            elseif ( $this->LooksLike( 'SHL21',__LINE__ ) )
            {
                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szMobility   = 'phone';
                $this->szDevice     = 'sharp';
                $this->szModel      = 'shl21';

                //$this->aProperties['technical-specs'        ] = 'http://wap.samsungmobile.com/uaprof/GT-P5100.xml';
                //$this->aProperties['keyboard'               ] = 'PhoneKeypad';
                //$this->aProperties['pointing'               ] = null;
                $this->aProperties['company'                ] = 'sharp';
                //$this->aProperties['camera'                 ] = null;
                //$this->aProperties['storage'                ] = null;
                //$this->aProperties['html-version'           ] = 4.0;
                //$this->aProperties['java-enabled'           ] = false;
                //$this->aProperties['javascript-enabled'     ] = true;
                //$this->aProperties['tables-capable'         ] = true;
                //$this->aProperties['frames-capable'         ] = true;
                //$this->aProperties['pixel-ratio'            ] = '1x1';
                $this->aProperties['screen-size'            ] = '720x1280';
                //$this->aProperties['screen-size-char'       ] = '25x21';
                //$this->aProperties['sound-output-capable'   ] = true;
                //$this->aProperties['voice-input-capable'    ] = true;

                // Mozilla/5.0 (Linux; Android 4.0.4; SHL21 Build/SA132) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19

                if ( $this->LooksLike( 'Android',__LINE__ ) )
                {
                    $this->Version( 'Android ' );
                }
            }
            elseif ( $this->LooksLike( 'SH8188U',__LINE__ ) )
            {
                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szMobility   = 'phone';
                $this->szDevice     = 'sharp';
                $this->szModel      = 'sh8188u';

                //$this->aProperties['technical-specs'        ] = 'http://wap.samsungmobile.com/uaprof/GT-P5100.xml';
                //$this->aProperties['keyboard'               ] = 'PhoneKeypad';
                //$this->aProperties['pointing'               ] = null;
                $this->aProperties['company'                ] = 'sharp';
                //$this->aProperties['camera'                 ] = null;
                //$this->aProperties['storage'                ] = null;
                //$this->aProperties['html-version'           ] = 4.0;
                //$this->aProperties['java-enabled'           ] = false;
                //$this->aProperties['javascript-enabled'     ] = true;
                //$this->aProperties['tables-capable'         ] = true;
                //$this->aProperties['frames-capable'         ] = true;
                //$this->aProperties['pixel-ratio'            ] = '1x1';
                $this->aProperties['screen-size'            ] = '480x800';
                //$this->aProperties['screen-size-char'       ] = '25x21';
                //$this->aProperties['sound-output-capable'   ] = true;
                //$this->aProperties['voice-input-capable'    ] = true;

                // Mozilla/5.0 (Linux; Android 4.0.4; SHL21 Build/SA132) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19

                if ( $this->LooksLike( 'Android',__LINE__ ) )
                {
                    $this->Version( 'Android ' );
                }
            }
            elseif ( $this->LooksLike( 'DM009SH',__LINE__ ) )
            {
                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szMobility   = 'phone';
                $this->szDevice     = 'sharp';
                $this->szModel      = 'dm009sh';

                //$this->aProperties['technical-specs'        ] = 'http://wap.samsungmobile.com/uaprof/GT-P5100.xml';
                //$this->aProperties['keyboard'               ] = 'PhoneKeypad';
                //$this->aProperties['pointing'               ] = null;
                $this->aProperties['company'                ] = 'sharp';
                //$this->aProperties['camera'                 ] = null;
                //$this->aProperties['storage'                ] = null;
                //$this->aProperties['html-version'           ] = 4.0;
                //$this->aProperties['java-enabled'           ] = false;
                //$this->aProperties['javascript-enabled'     ] = true;
                //$this->aProperties['tables-capable'         ] = true;
                //$this->aProperties['frames-capable'         ] = true;
                //$this->aProperties['pixel-ratio'            ] = '1x1';
                $this->aProperties['screen-size'            ] = '480x800';
                //$this->aProperties['screen-size-char'       ] = '25x21';
                //$this->aProperties['sound-output-capable'   ] = true;
                //$this->aProperties['voice-input-capable'    ] = true;

                // Mozilla/5.0 (Linux; U; Android 2.3.4; ja-jp; DM009SH Build/S4080) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1 CaWebApp/1.0(jpameblo;2.1.7;jp;)

                if ( $this->LooksLike( 'Android',__LINE__ ) )
                {
                    $this->Version( 'Android ' );
                }
            }
            elseif ( $this->LooksLike( 'EB-W51GJ',__LINE__ ) )
            {
                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szMobility   = 'phone';
                $this->szDevice     = 'sharp';
                $this->szModel      = 'eb-wx1gj';

                //$this->aProperties['technical-specs'        ] = 'http://wap.samsungmobile.com/uaprof/GT-P5100.xml';
                //$this->aProperties['keyboard'               ] = 'PhoneKeypad';
                //$this->aProperties['pointing'               ] = null;
                $this->aProperties['company'                ] = 'sharp';
                //$this->aProperties['camera'                 ] = null;
                //$this->aProperties['storage'                ] = null;
                //$this->aProperties['html-version'           ] = 4.0;
                //$this->aProperties['java-enabled'           ] = false;
                //$this->aProperties['javascript-enabled'     ] = true;
                //$this->aProperties['tables-capable'         ] = true;
                //$this->aProperties['frames-capable'         ] = true;
                //$this->aProperties['pixel-ratio'            ] = '1x1';
                $this->aProperties['screen-size'            ] = '1024x600';
                //$this->aProperties['screen-size-char'       ] = '25x21';
                //$this->aProperties['sound-output-capable'   ] = true;
                //$this->aProperties['voice-input-capable'    ] = true;

                // Mozilla/5.0 (Linux; U; Android 2.3.3; ja-jp; EB-W51GJ Build/2.01d) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1

                if ( $this->LooksLike( 'Android',__LINE__ ) )
                {
                    $this->Version( 'Android ' );
                }
            }
            elseif ( $this->LooksLike( 'EB-WX1GJ',__LINE__ ) )
            {
                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szMobility   = 'tablet';
                $this->szDevice     = 'sharp';
                $this->szModel      = 'eb-wx1gj 7"';

                //$this->aProperties['technical-specs'        ] = 'http://wap.samsungmobile.com/uaprof/GT-P5100.xml';
                //$this->aProperties['keyboard'               ] = 'PhoneKeypad';
                //$this->aProperties['pointing'               ] = null;
                $this->aProperties['company'                ] = 'sharp';
                //$this->aProperties['camera'                 ] = null;
                //$this->aProperties['storage'                ] = null;
                //$this->aProperties['html-version'           ] = 4.0;
                //$this->aProperties['java-enabled'           ] = false;
                //$this->aProperties['javascript-enabled'     ] = true;
                //$this->aProperties['tables-capable'         ] = true;
                //$this->aProperties['frames-capable'         ] = true;
                //$this->aProperties['pixel-ratio'            ] = '1x1';
                $this->aProperties['screen-size'            ] = '1024x600';
                //$this->aProperties['screen-size-char'       ] = '25x21';
                //$this->aProperties['sound-output-capable'   ] = true;
                //$this->aProperties['voice-input-capable'    ] = true;

                // Mozilla/5.0 (Linux; U; Android 2.3.3; en-us; EB-WX1GJ Build/2.01d) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1

                if ( $this->LooksLike( 'Android',__LINE__ ) )
                {
                    $this->Version( 'Android ' );
                }
            }
            elseif ( $this->LooksLike( 'SH-01D',__LINE__ ) )
            {
                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szMobility   = 'phone';
                $this->szDevice     = 'sharp';
                $this->szModel      = 'sh-01d';

                //$this->aProperties['technical-specs'        ] = 'http://wap.samsungmobile.com/uaprof/GT-P5100.xml';
                //$this->aProperties['keyboard'               ] = 'PhoneKeypad';
                //$this->aProperties['pointing'               ] = null;
                $this->aProperties['company'                ] = 'sharp';
                //$this->aProperties['camera'                 ] = null;
                //$this->aProperties['storage'                ] = null;
                //$this->aProperties['html-version'           ] = 4.0;
                //$this->aProperties['java-enabled'           ] = false;
                //$this->aProperties['javascript-enabled'     ] = true;
                //$this->aProperties['tables-capable'         ] = true;
                //$this->aProperties['frames-capable'         ] = true;
                //$this->aProperties['pixel-ratio'            ] = '1x1';
                $this->aProperties['screen-size'            ] = '720x1280';
                //$this->aProperties['screen-size-char'       ] = '25x21';
                //$this->aProperties['sound-output-capable'   ] = true;
                //$this->aProperties['voice-input-capable'    ] = true;

                // Mozilla/5.0 (Linux; U; Android 2.3.5; ja-jp; SH-01D Build/S1110) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1

                if ( $this->LooksLike( 'Android',__LINE__ ) )
                {
                    $this->Version( 'Android ' );
                }
            }
            elseif ( $this->LooksLike( 'SBM003SH',__LINE__ ) || $this->LooksLike( '003SH',__LINE__ ) )
            {
                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szMobility   = 'phone';
                $this->szDevice     = 'sharp';
                $this->szModel      = '003sh';

                //$this->aProperties['technical-specs'        ] = 'http://wap.samsungmobile.com/uaprof/GT-P5100.xml';
                //$this->aProperties['keyboard'               ] = 'PhoneKeypad';
                //$this->aProperties['pointing'               ] = null;
                $this->aProperties['company'                ] = 'sharp';
                //$this->aProperties['camera'                 ] = null;
                //$this->aProperties['storage'                ] = null;
                //$this->aProperties['html-version'           ] = 4.0;
                //$this->aProperties['java-enabled'           ] = false;
                //$this->aProperties['javascript-enabled'     ] = true;
                //$this->aProperties['tables-capable'         ] = true;
                //$this->aProperties['frames-capable'         ] = true;
                //$this->aProperties['pixel-ratio'            ] = '1x1';
                $this->aProperties['screen-size'            ] = '480x800';
                //$this->aProperties['screen-size-char'       ] = '25x21';
                //$this->aProperties['sound-output-capable'   ] = true;
                //$this->aProperties['voice-input-capable'    ] = true;

                // Mozilla/5.0 (Linux; U; Android 2.2; en-us; SBM003SH Build/S1100) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1

                if ( $this->LooksLike( 'Android',__LINE__ ) )
                {
                    $this->Version( 'Android ' );
                }
            }
            elseif ( $this->LooksLike( 'SH8118U',__LINE__ ) )
            {
                $this->szName       = 'android';
                $this->szType       = 'browser';
                $this->szMobility   = 'phone';
                $this->szDevice     = 'sharp';
                $this->szModel      = 'sh8118u';

                //$this->aProperties['technical-specs'        ] = 'http://wap.samsungmobile.com/uaprof/GT-P5100.xml';
                //$this->aProperties['keyboard'               ] = 'PhoneKeypad';
                //$this->aProperties['pointing'               ] = null;
                $this->aProperties['company'                ] = 'sharp';
                //$this->aProperties['camera'                 ] = null;
                //$this->aProperties['storage'                ] = null;
                //$this->aProperties['html-version'           ] = 4.0;
                //$this->aProperties['java-enabled'           ] = false;
                //$this->aProperties['javascript-enabled'     ] = true;
                //$this->aProperties['tables-capable'         ] = true;
                //$this->aProperties['frames-capable'         ] = true;
                //$this->aProperties['pixel-ratio'            ] = '1x1';
                $this->aProperties['screen-size'            ] = '320x480';
                //$this->aProperties['screen-size-char'       ] = '25x21';
                //$this->aProperties['sound-output-capable'   ] = true;
                //$this->aProperties['voice-input-capable'    ] = true;

                // Mozilla/5.0 (Linux; U; Android 2.2.2; zh-tw; SH8118U Build/FRG83G) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1 UP.Link/5.1.2.6

                if ( $this->LooksLike( 'Android',__LINE__ ) )
                {
                    $this->Version( 'Android ' );
                }
            }
            elseif ( $this->LooksLike( 'I-Opener 1.1',__LINE__ ) )
            {
                $this->szName = 'i-opener';
                $this->szType = 'browser';

                // Mozilla/3.x (I-Opener 1.1; Netpliance)
                $this->Version( 'I-Opener ' );
            }
            elseif ( $this->LooksLike( 'QtWeb Internet Browser',__LINE__ ) )
            {
                $this->szName = 'qt web browser';
                $this->szType = 'browser';

                // Mozilla/5.0 (Windows; U; Windows NT 5.1; fr-FR) AppleWebKit/533.3 (KHTML, like Gecko)  QtWeb Internet Browser/3.7 http://www.QtWeb.net

                $this->Version( 'QtWeb Internet Browser\/' );
            }
            elseif ( $this->LooksLike( 'chrome',__LINE__ ) || $this->LooksLike( 'chromeframe',__LINE__ ) )
            {
                $this->szName = 'chrome';
                $this->szType = 'browser';

                $this->Version( 'chrome[\/]' );   /* Standard way of retrieving version major, minor, revision */
            }
            elseif ( $this->LooksLike( 'chimera',__LINE__ ) )
            {
                $this->szName = 'chimera';
                $this->szType = 'browser';

                if ( preg_match( '/chimera\/(?P<major>\d{1,2})\.(?P<minor>\d{1,2})(?P<build>\+)?/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                    if ( isset( $aMatch['build'] ) )
                    {
                        $this->szBuild = $aMatch['build'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'Babya Discoverer',__LINE__ ) )
            {
                $this->szName = 'babya';
                $this->szType = 'bot';

                if ( preg_match( '/Babya Discoverer *?(?P<major>\d{1,2})\.(?P<minor>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'America Online Browser',__LINE__ ) || $this->LooksLike( 'AOL ',__LINE__ ) )
            {
                $this->szName = 'aol';
                $this->szType = 'browser';

                if ( preg_match( '/(America Online Browser|AOL) *?(?P<major>\d{1,2})\.(?P<minor>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'nutch',__LINE__ ) )
            {
                $this->szName = 'nutch';
                $this->szType = 'bot';

                if ( preg_match( '/nutch.*?\/(?P<major>\d{1,2})\.(?P<minor>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                }
                elseif ( preg_match( '/((nutch|OrangeCrawler)\/)?nutch-(?P<major>\d{1,2})\.(?P<minor>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'coccoc',__LINE__ ) )
            {
                $this->szName = 'Coc Coc';
                $this->szType = 'bot';

                if ( preg_match( '/coccoc\/(?P<major>\d{1,2})\.(?P<minor>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'search.KumKie.com',__LINE__ ) )
            {
                $this->szName = 'KumKie';
                $this->szType = 'bot';
            }
            elseif ( $this->LooksLike( 'eyecatchup/SEOstats',__LINE__ ) )
            {
                $this->szName = 'SEOstats';
                $this->szType = 'bot';
            }
            elseif ( $this->LooksLike( 'Microsoft Office Existence Discovery',__LINE__ ) )
            {
                $this->szName   = 'Microsoft Office';
                $this->szType   = 'bot';
                $this->iDanger  = 0;
            }
            elseif ( $this->LooksLike( 'Microsoft Office Protocol Discovery',__LINE__ ) )
            {
                $this->szName   = 'Microsoft Office';
                $this->szType   = 'bot';
                $this->iDanger  = 0;
            }
            elseif ( $this->LooksLike( 'Microsoft-WebDAV-MiniRedir',__LINE__ ) )
            {
                $this->szName   = 'Microsoft WebDAV (Web Distributed Authoring and Versioning)';
                $this->szType   = 'bot';
                $this->iDanger  = 0;
            }
            elseif ( $this->LooksLike( 'ask jeeves',__LINE__ ) )
            {
                $this->szName = 'ask jeeves';
                $this->szType = 'bot';
            }
            elseif ( $this->LooksLike( 'baiduspider',__LINE__ ) )
            {
                $this->szName = 'baidu';
                $this->szType = 'bot';

                if ( preg_match( '/baiduspider\/(?P<major>\d{1,2})\.(?P<minor>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'YahooCacheSystem',__LINE__ ) )
            {
                $this->szName = 'yahoo';
                $this->szType = 'bot';
            }
            elseif ( $this->LooksLike( 'Mnogosearch',__LINE__ ) )
            {
                $this->szName = 'mnogosearch';
                $this->szType = 'bot';

                if ( preg_match( '/Mnogosearch-(?P<major>\d{1,2})\.(?P<minor>\d{1,2})\.(?P<revision>\d{1,2})?/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                    if ( isset( $aMatch['revision'] ) )
                    {
                        $this->iRevision= (int) $aMatch['revision'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'Snoopy',__LINE__ ) )
            {
                $this->szName = 'snoopy';
                $this->szType = 'bot';

                if ( preg_match( '/Snoopy v(?P<major>d{1,2})\.(?P<minor>\d{1,2})\.(?P<revision>\d{1,2})?/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                    if ( isset( $aMatch['revision'] ) )
                    {
                        $this->iRevision= (int) $aMatch['revision'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'Avant Browser',__LINE__ ) ||
                     $this->LooksLike( 'avantbrowser.com',__LINE__ ) )
            {
                $this->szName = 'avant';
                $this->szType = 'browser';

                if ( preg_match( '/msie (?P<major>\d{1,2})\.(?P<minor>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'Sogou web spider',__LINE__ ) )
            {
                $this->szName = 'sogou';
                $this->szType = 'bot';

                if ( preg_match( '/sogou web spider\/(?P<major>\d{1,2})\.(?P<minor>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'Becomebot',__LINE__ ) )
            {
                $this->szName = 'becomebot';
                $this->szType = 'bot';

                if ( preg_match( '/becomebot\/(?P<major>\d{1,2})\.(?P<minor>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                }
            }
            elseif ( $this->LooksLike( '008/',__LINE__ ) )
            {
                $this->szName = '008';
                $this->szType = 'bot';

                if ( preg_match( '/008\/(?P<major>\d{1,2})\.(?P<minor>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'voilabot',__LINE__ ) )
            {
                $this->szName = 'voilabot';
                $this->szType = 'bot';

                if ( preg_match( '/voilabot (?P<build>[[:alpha:]]*?) (?P<major>\d{1,2})\.(?P<minor>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                    if ( isset( $aMatch['build'] ) )
                    {
                        $this->szBuild = $aMatch['build'];
                    }
                }
                elseif ( preg_match( '/voilabot\/(?P<major>\d{1,2})\.(?P<minor>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'HTC;',__LINE__ ) )
            {
                $this->szName       = 'htc';
                $this->szType       = 'browser';
                $this->szMobility   = 'phone';

                if ( preg_match( '/(?P<model>7 trophy|un autre modele)/i',$this->szUA,$aMatch ) )
                {
                    $this->szDevice = $this->szName . ' ' . $aMatch['model'];
                }

                if ( preg_match( '/IEMobile[\/ ](?P<maj>\d{1,2})\.(?P<min>\d{1,2})/i',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['maj'] ) )
                    {
                        $this->iMajor = (int) $aMatch['maj'];
                    }
                    if ( isset( $aMatch['min'] ) )
                    {
                        $this->iMinor = (int) $aMatch['min'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'HTC_touch',__LINE__ ) )
            {
                $this->szName       = 'htc touch';
                $this->szType       = 'browser';
                $this->szMobility   = 'phone';

                if ( preg_match( '/htc_touch_(?P<model>3g|HD_T8282|Diamond2|pro2)/i',$this->szUA,$aMatch ) )
                {
                    $this->szDevice = $this->szName;
                    $this->szModel = $aMatch['model'];
                }

                if ( preg_match( '/IEMobile (?P<maj>\d{1,2})\.(?P<min>\d{1,2})/i',$this->szUA,$aMatch ) )
                {
                    $this->szName = 'internet explorer mobile';
                    if ( isset( $aMatch['maj'] ) )
                    {
                        $this->iMajor = (int) $aMatch['maj'];
                    }
                    if ( isset( $aMatch['min'] ) )
                    {
                        $this->iMinor = (int) $aMatch['min'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'iemobile',__LINE__ ) )
            {
                $this->szName       = 'internet explorer mobile';
                $this->szType       = 'browser';

                if ( preg_match( '/IEMobile[\/ ](?P<maj>\d{1,2})\.(?P<min>\d{1,2})/i',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['maj'] ) )
                    {
                        $this->iMajor = (int) $aMatch['maj'];
                    }
                    if ( isset( $aMatch['min'] ) )
                    {
                        $this->iMinor = (int) $aMatch['min'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'msie ',__LINE__ ) ||
                     $this->LooksLike( 'internet explorer ',__LINE__ ) )
            {
                if ( vaesoli::STR_iPos( $this->szUA,'msiecrawler' ) != -1 )
                {
                    $this->szName = 'msiecrawler';
                    $this->szType = 'bot';
                }
                else
                {
                    $this->szName = 'internet explorer';
                    $this->szType = 'browser';
                }

                if ( preg_match( '/(msie|internet explorer) (?P<major>\d{1,2})\.(?P<minor>\d{1,2})(?P<build>[[:lower:]])?/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                    if ( isset( $aMatch['build'] ) )
                    {
                        $this->szBuild = $aMatch['build'];
                    }
                }

                if ( vaesoli::STR_iPos( $this->szUA,'tablet PC' ) != -1 )
                {
                    $this->szMobility = 'tablet';
                }
            }
            elseif ( $this->LooksLike( 'msie8.0',__LINE__ ) )
            {
                $this->szName = 'internet explorer';
                $this->szType = 'browser';
                $this->iMajor = 8;
                $this->iMinor = 0;

            }
            elseif ( ( $iPos2 = vaesoli::STR_iPos( $this->szUA,'fennec'  ) ) != -1 ||
                     ( $iPos1 = vaesoli::STR_iPos( $this->szUA,'firefox' ) ) != -1
                   )
            {

                if ( isset( $iPos2 ) && $iPos2 != -1 )
                {
                    $this->iLineMatch   = __LINE__;
                    $this->szName       = 'fennec';
                    $this->szMobility   = 'mobile';
                }
                else
                {
                    $this->iLineMatch   = __LINE__;
                    $this->szName       = 'firefox';
                }

                $this->szType = 'browser';

                if ( preg_match( "/{$this->szName}\/(?P<major>\d{1,2})\.(?P<minor>\d{1,2})(?P<buildA>[[:lower:]]\d)?(\.(?P<revision>\d{1,2}))?(\.(?P<build>(\d{1,2}|[[:lower:]]\d|[[:lower:]]{3})))?/si",$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                    if ( isset( $aMatch['revision'] ) )
                    {
                        $this->iRevision = (int) $aMatch['revision'];
                    }
                    if ( isset( $aMatch['buildA'] ) )
                    {
                        $this->szBuild = $aMatch['buildA'];
                    }
                    elseif ( $this->szName == 'fennec' )
                    {
                        if ( preg_match( "/fennec\/\d\.\d(?P<build>([[:lower:]]\d)?([[:lower:]]{3})?)/si",$this->szUA,$aSpecialMatch ) )
                        {
                            if ( isset( $aSpecialMatch['build'] ) )
                            {
                                $this->szBuild = $aSpecialMatch['build'];
                            }
                        }
                    }
                    if ( isset( $aMatch['build'] ) )
                    {
                        $this->szBuild = $aMatch['build'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'thunderbird',__LINE__ ) )
            {
                $this->szName = 'thunderbird';
                $this->szType = 'browser';

                if ( preg_match( '/thunderbird\/(?P<major>\d{1,2})\.(?P<minor>\d{1,2})(\.(?P<revision>\d{1,2}))?(\.(?P<build>\d{1,2}))?/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                    if ( isset( $aMatch['revision'] ) )
                    {
                        $this->iRevision = (int) $aMatch['revision'];
                    }
                    if ( isset( $aMatch['build'] ) )
                    {
                        $this->szBuild = $aMatch['build'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'konqueror',__LINE__ ) )
            {
                $this->szName = 'konqueror';
                $this->szType = 'browser';

                if ( preg_match( '/konqueror\/(?P<maj>\d{1,2})\.(?P<min>\d{1,2})(\.(?P<rev>\d{1,2}))?/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['maj'] ) )
                    {
                        $this->iMajor = (int) $aMatch['maj'];
                    }
                    if ( isset( $aMatch['min'] ) )
                    {
                        $this->iMinor = (int) $aMatch['min'];
                    }
                    if ( isset( $aMatch['rev'] ) )
                    {
                        $this->iRevision = (int) $aMatch['rev'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'seokicks-robot',__LINE__ ) )
            {
                $this->szName = 'seokicks';
                $this->szType = 'bot';
            }
            elseif ( $this->LooksLike( 'bintellibot',__LINE__ ) )
            {
                $this->szName = 'bintellibot';
                $this->szType = 'bot';
            }
            elseif ( $this->LooksLike( 'feedfetcher-google',__LINE__ ) )
            {
                $this->szName = 'feedfetcher-google';
                $this->szType = 'bot';
            }
            elseif ( $this->LooksLike( 'zend_http_client',__LINE__ ) )
            {
                $this->szName = 'zend_http_client';
                $this->szType = 'bot';
            }
            elseif ( $this->LooksLike( 'android',__LINE__ ) )
            {
                $this->szName = 'android';
                $this->szType = 'browser';

                if ( preg_match( '/Version\/(?P<major>\d{1,2})\.(?P<minor>\d{1,2})(\.(?P<rev>\d{1,2}))?/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                    if ( isset( $aMatch['rev'] ) )
                    {
                        $this->iRevision = (int) $aMatch['rev'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'blackberry',__LINE__ ) )
            {
                $this->szName       = 'blackberry';
                $this->szType       = 'browser';
                $this->szMobility   = 'phone';

                if ( preg_match( '/blackberry(?P<type>\d{1,4}([[:alpha:]])?)?(\/(?P<major>\d{1,2})\.(?P<minor>\d{1,2})\.(?P<revision>\d{1,2})?(\.(?P<build>\d{1,4})?)?)?/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['type'] ) )
                    {
                        $this->szDevice = $this->szName;
                        $this->szModel  = $aMatch['type'];
                    }
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                    if ( isset( $aMatch['revision'] ) )
                    {
                        $this->iRevision = (int) $aMatch['revision'];
                    }
                    if ( isset( $aMatch['build'] ) )
                    {
                        $this->szBuild = $aMatch['build'];
                    }
                }
                elseif ( preg_match( '/Version\/(?P<major>\d{1,2})\.(?P<minor>\d{1,2})\.(?P<revision>\d{1,2})?\.(?P<build>\d{1,4})?/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                    if ( isset( $aMatch['revision'] ) )
                    {
                        $this->iRevision = (int) $aMatch['revision'];
                    }
                    if ( isset( $aMatch['build'] ) )
                    {
                        $this->szBuild = $aMatch['build'];
                    }
                }

                if ( preg_match( '/blackberry (?P<type>\d{1,4})?(.*?Version\/(?P<major>\d{1,2})\.(?P<minor>\d{1,2})(\.(?P<revision>\d{1,4}))?(\.(?P<build>\d{1,4}))?)?/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['type'] ) )
                    {
                        $this->szDevice = $this->szName;
                        $this->szModel  = $aMatch['type'];
                    }
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                    if ( isset( $aMatch['revision'] ) )
                    {
                        $this->iRevision = (int) $aMatch['revision'];
                    }
                    if ( isset( $aMatch['build'] ) )
                    {
                        $this->szBuild = $aMatch['build'];
                    }

                    if ( preg_match( "/{$aMatch['type']}\/(?P<major>\d{1,2})\.(?P<minor>\d{1,2})\.(?P<revision>\d{1,2})?\.(?P<build>\d{1,4})?/si",$this->szUA,$aMatch ) )
                    {
                        if ( isset( $aMatch['major'] ) )
                        {
                            $this->iMajor = (int) $aMatch['major'];
                        }
                        if ( isset( $aMatch['minor'] ) )
                        {
                            $this->iMinor = (int) $aMatch['minor'];
                        }
                        if ( isset( $aMatch['revision'] ) )
                        {
                            $this->iRevision = (int) $aMatch['revision'];
                        }
                        if ( isset( $aMatch['build'] ) )
                        {
                            $this->szBuild = $aMatch['build'];
                        }
                    }
                }
            }
            elseif ( $this->LooksLike( 'applewebkit',__LINE__ ) &&
                     $this->LooksLike( 'safari',__LINE__ ) )
            {
                $this->szName = 'safari';
                $this->szType = 'browser';
                if ( preg_match( '/version\/(?P<major>\d{1,2})\.(?P<minor>\d{1,2})(\.(?P<revision>\d{1,2}))?/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                    if ( isset( $aMatch['revision'] ) )
                    {
                        $this->iRevision = (int) $aMatch['revision'];
                    }
                }
                elseif ( preg_match( '/safari\/[8][5]\.[567]/si',$this->szUA,$aMatch ) )
                {
                    $this->iMajor = 1;
                    $this->iMinor = 0;
                }
                elseif ( preg_match( '/safari\/[8][5](\.[8])?/si',$this->szUA,$aMatch ) )
                {
                    $this->iMajor       = 1;
                    $this->iMinor       = 0;
                    $this->iRevision    = 3;
                }
                elseif (  preg_match( '/safari\/[4][1](?P<rev>[679])/si',$this->szUA,$aMatch ) )
                {
                    $this->iMajor       = 2;
                    $this->iMinor       = 0;

                    $this->iRevision    = $aMatch['rev'] == '6' ? 2 : ( $aMatch['rev'] == '7' ? 3 : 4 );
                }
                elseif (  preg_match( '/safari\/[4][1][2]\.[56]/si',$this->szUA,$aMatch ) )
                {
                    $this->iMajor       = 2;
                    $this->iMinor       = 0;
                    $this->iRevision    = 1;
                }
                elseif (  preg_match( '/safari\/[4][1][2]\.[2]/si',$this->szUA,$aMatch ) ||
                          preg_match( '/safari\/[4][1][2]\z/si'     ,$this->szUA,$aMatch )
                       )
                {
                    $this->iMajor       = 2;
                    $this->iMinor       = 0;
                }
                elseif (  preg_match( '/safari\/[3][1][2]\.[56]/si',$this->szUA,$aMatch ) )
                {
                    $this->iMajor       = 1;
                    $this->iMinor       = 3;
                    $this->iRevision    = 2;
                }
                elseif (  preg_match( '/safari\/[3][1][2]\.[3]/si',$this->szUA,$aMatch ) ||
                          preg_match( '/safari\/[3][1][2]\z/si'     ,$this->szUA,$aMatch )
                       )
                {
                    $this->iMajor       = 1;
                    $this->iMinor       = 3;
                    $this->iRevision    = 1;
                }
                elseif ( ( vaesoli::STR_iPos( $this->szUA,'Safari/125.12'  ) != -1 ) ||
                         ( vaesoli::STR_iPos( $this->szUA,'Safari/125.11'  ) != -1 ) ||
                         ( vaesoli::STR_iPos( $this->szUA,'Safari/125.5.5' ) != -1 )
                       )
                {
                    $this->iMajor       = 1;
                    $this->iMinor       = 2;
                    $this->iRevision    = 4;
                }
                elseif ( preg_match( '/safari\/[1][2][5]\.[^23456789]/si',$this->szUA,$aMatch ) )
                {
                    $this->iMajor       = 1;
                    $this->iMinor       = 2;
                }
                elseif ( preg_match( '/safari\/[1][2][5]\z/si',$this->szUA,$aMatch ) )
                {
                    $this->iMajor       = 1;
                    $this->iMinor       = 2;
                }
                elseif ( preg_match( '/safari\/[1][2][5]\.[78]/si',$this->szUA,$aMatch ) )
                {
                    $this->iMajor       = 1;
                    $this->iMinor       = 2;
                    $this->iRevision    = 2;
                }
                elseif ( preg_match( '/safari\/[1][2][5]\.[9]/si',$this->szUA,$aMatch ) )
                {
                    $this->iMajor       = 1;
                    $this->iMinor       = 2;
                    $this->iRevision    = 3;
                }
            }
            elseif ( $this->LooksLike( 'mj12bot',__LINE__ ) )
            {
                $this->szName = 'mj12bot';
                $this->szType = 'bot';
                $this->Version( 'mj12bot\/v' );
            }
            elseif ( $this->LooksLike( 'ezooms',__LINE__ ) )
            {
                //Mozilla/5.0 (compatible; Ezooms/1.0; ezooms.bot@gmail.com)
                $this->szName = 'ezooms';
                $this->szType = 'bot';

                $this->Version( 'ezooms\/' );
            }
            elseif ( $this->LooksLike( 'Python-urllib',__LINE__ ) ||
                     $this->LooksLike( 'W3C_Validator',__LINE__ ) )
            {
                $this->szName = 'python';
                $this->szType = 'bot';

                if ( preg_match( '/(?P<name>python-urllib|W3C_Validator)\/(?P<major>\d{1,2})\.(?P<minor>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['name'] ) )
                    {
                        $this->szName = $aMatch['name'];
                    }
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'exabot',__LINE__ ) )
            {
                $this->szName = 'exabot';
                $this->szType = 'bot';

                if ( preg_match( '/exabot\/(?P<major>\d{1,2})\.(?P<minor>\d{1,2});/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'ia_archiver',__LINE__ ) )
            {
                $this->szName = 'ia_archiver';
                $this->szType = 'bot';
            }
            elseif ( $this->LooksLike( 'abachobot',__LINE__ ) )
            {
                $this->szName = 'abachobot';
                $this->szType = 'bot';
            }
            elseif ( $this->LooksLike( 'accoona-ai-agent',__LINE__ ) )
            {
                $this->szName = 'accoona-ai-agent';
                $this->szType = 'bot';
            }
            elseif ( $this->LooksLike( 'addsugarspiderbot',__LINE__ ) )
            {
                $this->szName = 'addsugarspiderbot';
                $this->szType = 'bot';
            }
            elseif ( $this->LooksLike( 'AnyApexBot',__LINE__ ) )
            {
                $this->szName = 'anyapexbot';
                $this->szType = 'bot';
            }
            elseif ( $this->LooksLike( 'Arachmo',__LINE__ ) )
            {
                $this->szName = 'arachmo';
                $this->szType = 'bot';
            }
            elseif ( $this->LooksLike( 'b-l-i-t-z-b-o-t',__LINE__ ) )
            {
                $this->szName = 'b-l-i-t-z-b-o-t';
                $this->szType = 'bot';
            }
            elseif ( $this->LooksLike( 'wbsearchbot',__LINE__ ) )
            {
                $this->szName = 'wbsearchbot';
                $this->szType = 'bot';

                if ( preg_match( '/wbsearchbot\/(?P<major>\d{1,2})\.(?P<minor>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'sistrix crawler',__LINE__ ) )
            {
                //Mozilla/5.0 (compatible; SISTRIX Crawler; http://crawler.sistrix.net/)
                $this->szName = 'sistrix';
                $this->szType = 'bot';
                $this->iLineMatch = __LINE__;
            }
            elseif ( $this->LooksLike( 'gslfbot',__LINE__ ) )
            {
                $this->szName = 'gslfbot';
                $this->szType = 'bot';
            }
            elseif ( $this->LooksLike( 'ahrefsbot',__LINE__ ) )
            {
                $this->szName = 'ahrefsbot';
                $this->szType = 'bot';

                if ( preg_match( '/ahrefsbot\/(?P<major>\d{1,2})\.(?P<minor>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'linkdex.com',__LINE__ ) )
            {
                $this->szName = 'linkdex';
                $this->szType = 'bot';

                if ( preg_match( '/v(?P<major>\d{1,2})\.(?P<minor>\d{1,2})/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'wap browser',__LINE__ ) ||
                     $this->LooksLike( 'wap-browser',__LINE__ ) )
            {
                $this->szType = 'browser';

                if ( preg_match( '/(?P<name>[[:alpha:]]+?) wap-browser\/(?P<major>\d{1,2})\.(?P<minor>\d{1,2})(\.(?P<revision>\d{1,4}))?/si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['name'] ) )
                    {
                        $this->szName = $aMatch['name'];
                    }
                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                    if ( isset( $aMatch['revision'] ) )
                    {
                        $this->iRevision = (int) $aMatch['revision'];
                    }
                }
            }
            elseif ( $this->LooksLike( 'Mozilla/5.0',__LINE__ ) &&
                     $this->LooksLike( 'rv:1.3',__LINE__ ) )
            {
                $this->szName = 'mozilla';
                $this->szType = 'browser';
                $this->iMajor = 1;
                $this->iMinor = 3;
                $this->iLineMatch = __LINE__;

                if     ( vaesoli::STR_iPos( $this->szUA,'rv:1.3a' ) != -1 )
                {
                    $this->szBuild = 'a';
                }
                elseif ( vaesoli::STR_iPos( $this->szUA,'rv:1.3b' ) != -1 )
                {
                    $this->szBuild = 'b';
                }
            }
            elseif ( $this->LooksLike( 'Mozilla/5.0',__LINE__ ) &&
                     $this->LooksLike( 'rv:1.',__LINE__ ) )
            {
                if ( vaesoli::STR_iPos( $this->szUA,'Safari' ) == -1 && vaesoli::STR_iPos( $this->szUA,'AppleWebKit' ) == -1 )
                {
                    $this->szName = 'mozilla';
                    $this->szType = 'browser';
                    $this->iMajor = 1;
                    $this->iLineMatch = __LINE__;

                    if ( preg_match( '/rv:1\.(?P<minor>\d{1,2})(\.(?P<revision>\d{1,2}))?(\.{0,1}(?P<build>(\d{1,2}|[[:lower:]])))?/si',$this->szUA,$aMatch ) )
                    {
                        //var_dump( $aMatch );
                        if ( isset( $aMatch['minor'] ) )
                        {
                            $this->iMinor = (int) $aMatch['minor'];
                        }
                        if ( isset( $aMatch['revision'] ) )
                        {
                            if ( ! empty( $aMatch['revision'] ) )
                            {
                                $this->iRevision = (int) $aMatch['revision'];
                            }
                        }
                        if ( isset( $aMatch['build'] ) )
                        {
                            $this->szBuild = $aMatch['build'];
                        }
                    }
                }
                else
                {
                    $this->szName = 'safari';
                    $this->szType = 'browser';
                }
            }
            elseif ( $this->LooksLike( 'iCcrawler',__LINE__ ) ||
                     $this->LooksLike( 'icjobs.de',__LINE__ ) )
            {
                $this->szName = 'iccrawler';
                $this->szType = 'bot';
            }
            elseif ( $this->LooksLike( 'Mozilla/5.0'  ,__LINE__ ) &&
                     ( $this->LooksLike( 'Safari'     ,__LINE__ ) ||
                       $this->LooksLike( 'AppleWebKit',__LINE__ ) )
                   )
            {
                $this->szName = 'safari';
                $this->szType = 'browser';
            }
            else
            {
                //echo "Dernier cas";
                /* Ici, on cherche un nom en dÚbut de string puis un '/x.x' */
                if ( preg_match( '%\A(?P<name>[[:alpha:]]+)/v{0,1}(?P<major>\d{1,2})\.(?P<minor>\d{1,2})(\.(?P<revision>\d{1,2}))?%si',$this->szUA,$aMatch ) )
                {
                    $this->szName = $aMatch['name'];

                    if ( isset( $aMatch['major'] ) )
                    {
                        $this->iMajor = (int) $aMatch['major'];
                    }
                    if ( isset( $aMatch['minor'] ) )
                    {
                        $this->iMinor = (int) $aMatch['minor'];
                    }
                    if ( isset( $aMatch['revision'] ) )
                    {
                        $this->iRevision = (int) $aMatch['revision'];
                    }

                    if ( vaesoli::STR_iPos( $this->szName,'bot' ) != -1 )
                    {
                        $this->szType = 'bot';
                        $this->iLineMatch = __LINE__;
                    }
                    else
                    {
                        $this->szType = 'unknown';
                    }
                }
                elseif ( preg_match('%(?P<name>[[:print:]]+?)[/ -]( )?(?P<maj>\d{1,4})\.(?P<min>\d{1,4})(\.(?P<rev>\d{1,4}))?%si',$this->szUA,$aMatch ) )
                {
                    if ( isset( $aMatch['name'] ) )
                    {
                        $this->szName = trim( $aMatch['name'] );
                    }
                    if ( isset( $aMatch['maj'] ) )
                    {
                        $this->iMajor = (int) $aMatch['maj'];
                    }
                    if ( isset( $aMatch['min'] ) )
                    {
                        $this->iMinor = (int) $aMatch['min'];
                    }
                    if ( isset( $aMatch['rev'] ) )
                    {
                        $this->iRevision = (int) $aMatch['rev'];
                    }
                }
                else
                {
                    $this->szName = 'unknown';
                }
            }

            //echo "<p>At line " . __LINE__ . " the value of szType is {$this->szType} and iLine = {$this->iLineMatch}</p>";

            if ( empty( $this->szType ) )
            {
                $this->szType= 'unknown';
            }

            $this->detectSpider();

            /****************************************************************/
            /* This is the part that takes in charge the mobility scheme    */
            /****************************************************************/
            {   /* Mobility detection */
                if ( $this->szMobility === 'desktop' )              /* Default mobility assigned ? */
                {
                    /* If Mobile keyword detected */
                    if     ( vaesoli::STR_iPos( $this->szUA,'mobile' ) != -1 )
                    {
                        $this->szMobility = 'mobile';
                    }
                    /* If Tablet keyword detected */
                    elseif ( vaesoli::STR_iPos( $this->szUA,'tablet' ) != -1 )
                    {
                        $this->szMobility = 'tablet';
                    }
                    // Script of : http://detectmobilebrowsers.com/download/php (downloaded on 18/05/2013 09:07:56)
                    // Regex updated: 18 October 2012 (that was what was on the site)
                    elseif ( preg_match( '/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|'  .
                                         'elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|'   .
                                         'mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|'       .
                                         'pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|'    .
                                         'windows (ce|phone)|xda|xiino/i',$this->szUA )                             ||
                             preg_match( '/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|'    .
                                         'ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|'       .
                                         'attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|'    .
                                         'bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co'             .
                                         '(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|' .
                                         'el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|'   .
                                         'g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|'   .
                                         'hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|'    .
                                         'i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|' .
                                         'ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|'    .
                                         'le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma'   .
                                         '(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|'   .
                                         'de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|'          .
                                         'n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|'   .
                                         'nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|'   .
                                         'phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc'          .
                                         '(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|'   .
                                         'sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)'  .
                                         '|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp'    .
                                         '(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|'  .
                                         'tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|'     .
                                         'utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|'          .
                                         'vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|'      .
                                         'wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr( $this->szUA,0,4 ) ) )
                    {
                        $this->szMobility = 'mobile';
                    }
                    else
                    {
                        /* Generic : used by Vae Soli! */
                        $aMobileUserAgents[] = "MOBILE";
                        $aMobileUserAgents[] = "HANDHELD";
                        $aMobileUserAgents[] = "ANDROID";
                        $aMobileUserAgents[] = "OPERA MINI";
                        $aMobileUserAgents[] = "OPERA MOBI";

                        /* Apple */
                        $aMobileUserAgents[] = "APPLE-IPHONE/701.341";
                        $aMobileUserAgents[] = "APPLE-IPHONE/703.144";
                        $aMobileUserAgents[] = "APPLE-IPAD/702.367";
                        $aMobileUserAgents[] = "APPLE-IPOD2C1/801.293";
                        $aMobileUserAgents[] = "APPLE-IPOD3C1/801.293";
                        $aMobileUserAgents[] = "APPLE-IPHONE1C2/801.293";
                        $aMobileUserAgents[] = "APPLE-IPHONE2C1/801.293";
                        $aMobileUserAgents[] = "APPLE-IPHONE3C1/801.293";
                        $aMobileUserAgents[] = "APPLE-IPHONE/508.11";
                        $aMobileUserAgents[] = "APPLE-IPHONE/701.400";
                        $aMobileUserAgents[] = "APPLE-IPHONE/704.11";
                        $aMobileUserAgents[] = "APPLE-IPHONE/705.18";
                        $aMobileUserAgents[] = "APPLE-IPOD2C1/801.306";
                        $aMobileUserAgents[] = "APPLE-IPOD3C1/801.306";
                        $aMobileUserAgents[] = "APPLE-IPHONE1C2/801.306";
                        $aMobileUserAgents[] = "APPLE-IPHONE2C1/801.306";
                        $aMobileUserAgents[] = "APPLE-IPHONE3C1/801.306";
                        $aMobileUserAgents[] = "COREMEDIA V1.0.0.4A102";    // Apple iPhone v1.1.4 CoreMedia v1.0.0.4A102
                        $aMobileUserAgents[] = "IPHONE";
                        $aMobileUserAgents[] = "IPAD";
                        $aMobileUserAgents[] = "IPOD";

                        /* Blackberry */
                        $aMobileUserAgents[] = "BLACKBERRY7100I";
                        $aMobileUserAgents[] = "BLACKBERRY7130E";
                        $aMobileUserAgents[] = "BLACKBERRY7250";
                        $aMobileUserAgents[] = "BLACKBERRY7230";
                        $aMobileUserAgents[] = "BLACKBERRY7520";
                        $aMobileUserAgents[] = "BLACKBERRY7730";
                        $aMobileUserAgents[] = "BLACKBERRY8100";
                        $aMobileUserAgents[] = "BLACKBERRY8703E";
                        $aMobileUserAgents[] = "BLACKBERRY8820";
                        $aMobileUserAgents[] = "BLACKBERRY8830";

                        /* Cricket */
                        $aMobileUserAgents[] = "CRICKET-A200/1.0";

                        /* DoCoMo */
                        $aMobileUserAgents[] = "DOCOMO/1.0";
                        $aMobileUserAgents[] = "DOCOMO/2.0";

                        /* Eudora */
                        $aMobileUserAgents[] = "EUDORAWEB 2.1";

                        /* Generic Opera Mini */
                        $aMobileUserAgents[] = "OPERA MINI";

                        /* Google Phone (HTC Dream G1) */
                        $aMobileUserAgents[] = "DREAM";

                        /* HTC */
                        $aMobileUserAgents[] = "HTC-8500";
                        $aMobileUserAgents[] = "HTC_P3650";
                        $aMobileUserAgents[] = "HTC P3450";
                        $aMobileUserAgents[] = "HTC_S710";

                        /* J-Phone */
                        $aMobileUserAgents[] = "J-PHONE";

                        /* LG Electronics */
                        $aMobileUserAgents[] = "G/U880";
                        $aMobileUserAgents[] = "LG-B2050";
                        $aMobileUserAgents[] = "LG-C1100";
                        $aMobileUserAgents[] = "LGE-CU8080";
                        $aMobileUserAgents[] = "LG-G1800";
                        $aMobileUserAgents[] = "LG-G210";
                        $aMobileUserAgents[] = "LG-G220";
                        $aMobileUserAgents[] = "LG-G232";
                        $aMobileUserAgents[] = "LG-G262";
                        $aMobileUserAgents[] = "LG-G5200";
                        $aMobileUserAgents[] = "LG-G5600";
                        $aMobileUserAgents[] = "LG-G610";
                        $aMobileUserAgents[] = "LG-G622";
                        $aMobileUserAgents[] = "LG-G650" ;
                        $aMobileUserAgents[] = "LG-G660";
                        $aMobileUserAgents[] = "LG-G672";
                        $aMobileUserAgents[] = "LG-G682";
                        $aMobileUserAgents[] = "LG-G688";
                        $aMobileUserAgents[] = "LG-G7000";
                        $aMobileUserAgents[] = "LG-G7050";
                        $aMobileUserAgents[] = "LG-G7100";
                        $aMobileUserAgents[] = "LG-G7200";
                        $aMobileUserAgents[] = "LG-G822";
                        $aMobileUserAgents[] = "LG-G850";
                        $aMobileUserAgents[] = "LG-G920";
                        $aMobileUserAgents[] = "LG-G922";
                        $aMobileUserAgents[] = "LG-G932";
                        $aMobileUserAgents[] = "LG-L1100";
                        $aMobileUserAgents[] = "LGE-MX8700";
                        $aMobileUserAgents[] = "LG-T5100";
                        $aMobileUserAgents[] = "LG/U8120";
                        $aMobileUserAgents[] = "LG/U8130";
                        $aMobileUserAgents[] = "LG/U8138";
                        $aMobileUserAgents[] = "LG/U8180";
                        $aMobileUserAgents[] = "LGE-VX9100";
                        $aMobileUserAgents[] = "LG-D850";   /* LG G3 */
                        $aMobileUserAgents[] = "LG-D851";   /* LG G3 */
                        $aMobileUserAgents[] = "LG-D855";   /* LG G3 */
                        $aMobileUserAgents[] = "VS985 4G";  /* LG G3 */


                        /* Miscellaneous */
                        $aMobileUserAgents[] = "AVANTGO 3.2";
                        $aMobileUserAgents[] = "KDDI-KC31 UP.BROWSER/6.2.0.5 (GUI) MMP/2.0";

                        /* Motorola */
                        $aMobileUserAgents[] = "MOT-V3R";
                        $aMobileUserAgents[] = "MOT-K1";
                        $aMobileUserAgents[] = "MOT-L6";

                        /* Mozilla Mini */
                        $aMobileUserAgents[] = "MINIMO/0.020";
                        $aMobileUserAgents[] = "MINIMO/0.016";

                        /* Nokia */
                        $aMobileUserAgents[] = "NOKIAE51";
                        $aMobileUserAgents[] = "NOKIA5300";
                        $aMobileUserAgents[] = "NOKIA6030";
                        $aMobileUserAgents[] = "NOKIA6230I";
                        $aMobileUserAgents[] = "NOKIA6280";
                        $aMobileUserAgents[] = "NOKIAN70";
                        $aMobileUserAgents[] = "NOKIAN80";
                        $aMobileUserAgents[] = "NOKIAN90";
                        $aMobileUserAgents[] = "NOKIAN95";
                        $aMobileUserAgents[] = "NOKIAE5";

                        /* PalmOS */
                        $aMobileUserAgents[] = "XIINO/1.0";

                        /* PocketLink */
                        $aMobileUserAgents[] = "PLINK 2.56B";

                        /* Plucker */
                        $aMobileUserAgents[] = "PLUCKER/PY-1.4";

                        /* Samsung */
                        $aMobileUserAgents[] = "SGH-A737";
                        $aMobileUserAgents[] = "SGH-D600";
                        $aMobileUserAgents[] = "SGH-Z720";
                        $aMobileUserAgents[] = "SEC-SGHU600";
                        $aMobileUserAgents[] = "SGH-U900";
                        $aMobileUserAgents[] = "SGH-I900";

                        /* Siemens */
                        $aMobileUserAgents[] = "BENQ-SIEMENS";
                        $aMobileUserAgents[] = "SIE-S68/36";
                        $aMobileUserAgents[] = "SIE-EF81/58";

                        /* SonyEricsson */
                        $aMobileUserAgents[] = "SONYERICSSONK510I";
                        $aMobileUserAgents[] = "SONYERICSSONK550I";
                        $aMobileUserAgents[] = "SONYERICSSONK610I";
                        $aMobileUserAgents[] = "SONYERICSSONK630I";
                        $aMobileUserAgents[] = "SONYERICSSONK700";
                        $aMobileUserAgents[] = "SONYERICSSONK750I";
                        $aMobileUserAgents[] = "SONYERICSSONK800I";
                        $aMobileUserAgents[] = "SONYERICSSONW800I";
                        $aMobileUserAgents[] = "SONYERICSSONW810I";
                        $aMobileUserAgents[] = "SONYERICSSONW900I";
                        $aMobileUserAgents[] = "SONYERICSSONZ500A";

                        /* Vodaphone */
                        $aMobileUserAgents[] = "VODAFONE";

                        $iCount  = count( $aMobileUserAgents );

                        /**
                         *  @todo   Extraire les strings des pages suivantes :
                         *          http://www.zytrax.com/tech/web/mobile_ids.html
                         *          http://www.user-agents.org/index.shtml
                        */

                        for ( $i=0;$i < $iCount;$i++ )
                        {
                            if ( ( $IsMobile = ( vaesoli::STR_iPos( $this->szUA,$aMobileUserAgents[$i] ) != -1 ) ) )
                            {
                                $this->szMobility = 'mobile';
                                break;
                            }
                        }   /* for ( $i=0;$i < $iCount;$i++ ) */
                    }
                }
            }

            //echo "<p>DÚtection de la plateforme: AVANT = {$this->szPlatform}</p>\n";
            /****************************************************************/
            /* This is the part that takes in charge the platform           */
            /****************************************************************/
            {   /* Platform detection */
                 if     ( vaesoli::STR_iPos( $this->szUA,'windows phone os' ) != -1 )
                {
                    $this->szPlatform = 'windows phone';
                }
                elseif ( vaesoli::STR_iPos( $this->szUA,'windows' ) != -1 || vaesoli::STR_iPos( $this->szUA,'win95' ) != -1 )
                {
                    $this->szPlatform = 'windows';
                }
                elseif ( vaesoli::STR_iPos( $this->szUA,'android' ) != -1 )
                {
                    $this->szPlatform = 'android';
                }
                elseif ( vaesoli::STR_iPos( $this->szUA,'linux' ) != -1 )
                {
                    $this->szPlatform = 'linux';
                }
                elseif ( vaesoli::STR_iPos( $this->szUA,'warp ' ) != -1 )
                {
                    $this->szPlatform = 'warp';
                }
                elseif ( vaesoli::STR_iPos( $this->szUA,'symbianos' ) != -1 )
                {
                    $this->szPlatform = 'symbian';
                }
                elseif ( vaesoli::STR_iPos( $this->szUA,'aix ' ) != -1 )
                {
                    $this->szPlatform = 'aix';
                }
                elseif ( vaesoli::STR_iPos( $this->szUA,'hp-ux ' ) != -1 )
                {
                    $this->szPlatform = 'hp-ux';
                }
                elseif ( vaesoli::STR_iPos( $this->szUA,'qnx ' ) != -1 )
                {
                    $this->szPlatform = 'qnx';
                }
                elseif ( vaesoli::STR_iPos( $this->szUA,'ipod' ) != -1 )
                {
                    $this->szDevice     = 'ipod';
                    $this->szMobility   = 'mobile';
                    $this->szPlatform   = 'ipod';
                }
                elseif ( vaesoli::STR_iPos( $this->szUA,'ipad' ) != -1 )
                {
                    $this->szDevice     = 'ipad';
                    $this->szMobility   = 'tablet';
                    $this->szPlatform   = 'ipad';
                }
                elseif ( vaesoli::STR_iPos( $this->szUA,'iphone' ) != -1 )
                {
                    $this->szDevice     = 'iphone';
                    $this->szMobility   = 'phone';
                    $this->szPlatform   = 'iphone';
                }
                elseif ( ( vaesoli::STR_iPos( $this->szUA,'macintosh'    ) != -1 ) ||
                         ( vaesoli::STR_iPos( $this->szUA,'Mac OS X'     ) != -1 ) ||
                         ( vaesoli::STR_iPos( $this->szUA,'Mac_PowerPC'  ) != -1 )
                       )
                {
                    if ( vaesoli::STR_iPos( $this->szUA,'iPhone OS' ) != -1 )
                    {
                        $this->szPlatform = 'ios';
                    }
                    else
                    {
                        $this->szPlatform = 'macintosh';
                    }
                }
                elseif ( ( vaesoli::STR_iPos( $this->szUA,'darwin/' ) != -1 ) )
                {
                    $this->szPlatform   = 'darwin (posix)';

                    if ( preg_match( '/darwin\/(?P<maj>\d{1,2})\.(?P<min>\d{1,2})(\.(?P<rev>\d{1,3}))?/si',$this->szUA,$aMatch ) )
                    {
                        $this->szPlatformVersion = $aMatch['maj'];

                        if ( isset( $aMatch['min'] ) )
                        {
                            $this->szPlatformVersion .= '.' . $aMatch['min'];
                        }

                        if ( isset( $aMatch['rev'] ) )
                        {
                            $this->szPlatformVersion .= '.' . $aMatch['rev'];
                        }
                    }
                }
                elseif ( vaesoli::STR_iPos( $this->szUA,'AmigaOS' ) != -1 )
                {
                    $this->szPlatform   = 'amigaos';
                }
                elseif ( vaesoli::STR_iPos( $this->szUA,'iphone simulator' ) != -1 )
                {
                    $this->szDevice     = 'iphone';
                    $this->szMobility   = 'phone';
                    $this->szPlatform   = 'iphone simulator';
                }
                elseif ( vaesoli::STR_iPos( $this->szUA,'cros' ) != -1 && vaesoli::STR_iPos( $this->szUA,'microsoft' ) == -1 )
                {
                    //echo "<p>C'est ici que je dis que c'est CHROME</p>\n";
                    $this->szPlatform = 'chrome';
                }
                elseif ( vaesoli::STR_iPos( $this->szUA,'freebsd' ) != -1 )
                {
                    $this->szPlatform = 'freebsd';
                }
                elseif ( vaesoli::STR_iPos( $this->szUA,'openbsd' ) != -1 )
                {
                    $this->szPlatform = 'openbsd';
                }
                elseif ( vaesoli::STR_iPos( $this->szUA,'sunos' ) != -1 )
                {
                    $this->szPlatform = 'sunos';
                }
            }
            //echo "<p>DÚtection de la plateforme: AFTER = {$this->szPlatform}</p>\n";

            /****************************************************************/
            /* If we have detected the platform, see OS number              */
            /****************************************************************/
            if ( ! empty( $this->szPlatform ) )
            {
                // Ici, on pourrait chercher Ó savoir sur quelle version de la plateforme
                // on fonctionne (par exemple, on sait qu'on est en Windows ... mais quelle
                // version de Windows?

                switch ( $this->szPlatform )
                {
                    case 'windows phone':   {
                                                if ( preg_match( '/windows phone os[\/ ](?P<maj>\d{1,2})\.(?P<min>\d{1,2})/si',$this->szUA,$aMatch ) )
                                                {
                                                    $this->szPlatformVersion = $aMatch['maj'] . '.' . $aMatch['min'];
                                                }
                                            }
                                            break;
                    case 'windows'      :   {
                                                if ( vaesoli::STR_iPos( $this->szUA,'windows XP' ) != -1 )
                                                {
                                                    $this->szPlatformVersion = 'windows xp';
                                                }
                                                elseif ( vaesoli::STR_iPos( $this->szUA,'windows 2000' ) != -1 )
                                                {
                                                    $this->szPlatformVersion = 'windows 2000';
                                                }
                                                elseif ( vaesoli::STR_iPos( $this->szUA,'windows nt x.y' ) != -1 )
                                                {
                                                    $this->szPlatformVersion = 'windows 32-bit';
                                                }
                                                elseif ( vaesoli::STR_iPos( $this->szUA,'windows ce x.y' ) != -1 )
                                                {
                                                    $this->szPlatformVersion = 'windows ce';
                                                    if ( $this->szMobility == 'desktop' )
                                                        $this->szMobility = 'embedded';
                                                }
                                                elseif ( vaesoli::STR_iPos( $this->szUA,'windows ce' ) != -1 )
                                                {
                                                    $this->szPlatformVersion = 'windows ce';
                                                    if ( $this->szMobility == 'desktop' )
                                                        $this->szMobility = 'embedded';
                                                }
                                                elseif ( vaesoli::STR_iPos( $this->szUA,'windows me' ) != -1 )
                                                {
                                                    $this->szPlatformVersion = 'windows me';
                                                }
                                                elseif ( vaesoli::STR_iPos( $this->szUA,'win95' ) != -1 || vaesoli::STR_iPos( $this->szUA,'Windows_95' ) != -1 )
                                                {
                                                    $this->szPlatformVersion = 'windows 95';
                                                }
                                                elseif ( vaesoli::STR_iPos( $this->szUA,'win98' ) != -1 || vaesoli::STR_iPos( $this->szUA,'windows 98' ) != -1 )
                                                {
                                                    $this->szPlatformVersion = 'windows 98';
                                                }
                                                elseif ( vaesoli::STR_iPos( $this->szUA,'win9x' ) != -1 || vaesoli::STR_iPos( $this->szUA,'win 9x' ) != -1 )
                                                {
                                                    $this->szPlatformVersion = 'windows 9x';
                                                }
                                                elseif ( vaesoli::STR_iPos( $this->szUA,'windows nt 4.0' ) != -1 || vaesoli::STR_iPos( $this->szUA,'winnt4.0' ) != -1 )
                                                {
                                                    $this->szPlatformVersion = 'windows nt 4.0';
                                                }
                                                elseif ( vaesoli::STR_iPos( $this->szUA,'MSIE 7.0'       ) != -1 &&
                                                         vaesoli::STR_iPos( $this->szUA,'Windows NT 6.0' ) != -1 &&
                                                         vaesoli::STR_iPos( $this->szUA,'Trident/4.0'    ) != -1 )
                                                {
                                                    // According to
                                                    // http://blogs.msdn.com/b/ie/archive/2009/01/09/the-internet-explorer-8-user-agent-string-updated-edition.aspx
                                                    $this->szPlatformVersion = 'windows vista';
                                                    $this->iMajor = 8;
                                                }
                                                elseif ( vaesoli::STR_iPos( $this->szUA,'Windows NT 6.1' ) != -1 &&
                                                         vaesoli::STR_iPos( $this->szUA,'Trident/7.0'    ) != -1 
                                                       )
                                                {
                                                    $this->szPlatformVersion = 'windows 7';
                                                    $this->szType            = 'browser';
                                                }
                                                elseif ( preg_match( '/windows (?P<version>\d{1,2})/si',$this->szUA,$aMatch ) )
                                                {
                                                    if ( isset( $aMatch['version'] ) )
                                                    {
                                                        $this->szPlatformVersion = 'windows ' . $aMatch['version'];
                                                    }
                                                }
                                                elseif ( preg_match( '/windows NT 3\.(?P<minor>\d{1,2})/si',$this->szUA,$aMatch ) )
                                                {
                                                    if ( isset( $aMatch['minor'] ) )
                                                    {
                                                        $iMinor = (int) $aMatch['minor'];
                                                        switch ( $iMinor )
                                                        {
                                                            case   51:  $this->szPlatformVersion = 'windows nt 3.51';
                                                                        break;
                                                        }
                                                    }
                                                }
                                                elseif ( preg_match( '/windows NT 5\.(?P<minor>\d{1,2})/si',$this->szUA,$aMatch ) )
                                                {
                                                    if ( isset( $aMatch['minor'] ) )
                                                    {
                                                        // http://msdn.microsoft.com/en-us/library/ms537503(VS.85).aspx
                                                        $szMinor = $aMatch['minor'];

                                                        if     ( $szMinor === '0' )
                                                            $this->szPlatformVersion = 'windows 2000';
                                                        elseif ( $szMinor === '01' )
                                                            $this->szPlatformVersion = 'windows 2000, service pack 1 (sp1)';
                                                        elseif ( $szMinor === '1' )
                                                            $this->szPlatformVersion = 'windows xp';
                                                        elseif ( $szMinor === '2' )
                                                            $this->szPlatformVersion = 'windows server 2003; windows XP x64 Edition';
                                                    }
                                                }
                                                elseif ( preg_match( '/windows NT 6\.(?P<minor>\d)/si',$this->szUA,$aMatch ) )
                                                {
                                                    if ( isset( $aMatch['minor'] ) )
                                                    {
                                                        $iMinor = (int) $aMatch['minor'];
                                                        switch ( $iMinor )
                                                        {
                                                            case    0   :   $this->szPlatformVersion = 'windows vista';
                                                                            break;
                                                            case    1   :   $this->szPlatformVersion = 'windows 7';
                                                                            break;
                                                            case    2   :   $this->szPlatformVersion = 'windows 8 (release preview)';
                                                                            break;
                                                        }
                                                    }
                                                }
                                                elseif ( vaesoli::STR_iPos( $this->szUA,'windows nt' ) != -1 )
                                                {
                                                    $this->szPlatformVersion = 'windows nt';
                                                }
                                            }
                                            break;
                    case 'android'      :   {
                                                if ( preg_match( '/android (?P<major>\d{1,2})\.(?P<minor>\d{1,2})(\.(?P<revision>\d{1,2}))?/si',$this->szUA,$aMatch ) )
                                                {
                                                    $this->szPlatformVersion = 'android ' . $aMatch['major'] . '.' . $aMatch['minor'];
                                                    if ( isset( $aMatch['revision'] ) )
                                                    {
                                                        $this->szPlatformVersion .= '.' . $aMatch['revision'];
                                                    }
                                                }
                                                elseif ( vaesoli::STR_iPos( $this->szUA,'linux' ) != -1 )
                                                {
                                                    if ( preg_match( '/linux (?P<version>.*?)[;\)]/si',$this->szUA,$aMatch ) )
                                                    {
                                                        $this->szPlatformVersion = 'android linux ' . $aMatch['version'];
                                                    }
                                                    elseif ( preg_match( '/\((?P<version>.*?-redhat)-linux-.*?\)/si',$this->szUA,$aMatch ) )
                                                    {
                                                        $this->szPlatformVersion = 'android linux ' . $aMatch['version'];
                                                    }
                                                }
                                            }
                                            break;
                    case 'warp'         :   {
                                                if ( preg_match( '/warp (?P<version>.*?);/si',$this->szUA,$aMatch ) )
                                                {
                                                    $this->szPlatformVersion = 'warp ' . $aMatch['version'];
                                                }
                                            }
                                            break;
                    case 'qnx'          :
                    case 'aix'          :   {
                                                if ( preg_match( "/{$this->szPlatform} (?P<version>.*?);/si",$this->szUA,$aMatch ) )
                                                {
                                                    $this->szPlatformVersion = $this->szPlatform . ' ' . $aMatch['version'];
                                                }
                                            }
                                            break;
                    case 'hp-ux'         :   {
                                                if ( preg_match( "/{$this->szPlatform} (?P<version>.*?);/si",$this->szUA,$aMatch ) )
                                                {
                                                    $this->szPlatformVersion = $this->szPlatform . ' ' . $aMatch['version'];
                                                }
                                            }
                                            break;
                    case 'sunos'        :   {
                                                if ( preg_match( '/sunos (?P<version>.*?);/si',$this->szUA,$aMatch ) )
                                                {
                                                    $this->szPlatformVersion = 'sunos ' . $aMatch['version'];
                                                }
                                            }
                                            break;
                    case 'symbian'      :   {
                                                if ( preg_match( '/symbianos\/(?P<maj>\d{1,2})\.(?P<min>\d{1,2})/si',$this->szUA,$aMatch ) )
                                                {
                                                    $this->szPlatformVersion = 'symbian ' . $aMatch['maj'] . '.' .$aMatch['min'];
                                                }
                                            }
                                            break;
                    case 'linux'        :   {
                                                if ( preg_match( '/linux (?P<version>.*?)[;\)]/si',$this->szUA,$aMatch ) )
                                                {
                                                    $this->szPlatformVersion = 'linux ' . str_replace( array('(',')'),'',$aMatch['version'] );
                                                }
                                                elseif ( preg_match( '/\((?P<version>.*?-redhat)-linux-.*?\)/si',$this->szUA,$aMatch ) )
                                                {
                                                    $this->szPlatformVersion = 'linux ' . str_replace( array('(',')'),'',$aMatch['version'] );
                                                }
                                            }
                                            break;
                    case 'freebsd'      :   {
                                                if ( preg_match( "/freebsd (?P<version>.*?);/si",$this->szUA,$aMatch ) )
                                                {
                                                    $this->szPlatformVersion = $this->szPlatform . ' ' . $aMatch['version'];
                                                }
                                            }
                                            break;
                    case 'openbsd'      :   {
                                                if ( preg_match( "/{$this->szPlatform} (?P<major>\d)\.(?P<minor>\d)/si",$this->szUA,$aMatch ) )
                                                {
                                                    $this->szPlatformVersion = $this->szPlatform . ' ' . $aMatch['major'] . '.' . $aMatch['minor'];
                                                }
                                                elseif ( preg_match( "/openbsd (?P<version>.*?);/si",$this->szUA,$aMatch ) )
                                                {
                                                    $this->szPlatformVersion = $this->szPlatform . ' ' . $aMatch['version'];
                                                }
                                            }
                                            break;
                    case 'ipad'         :   {
                                                if ( preg_match( '/CPU os (?P<major>\d{1,2})_(?P<minor>\d{1,2})(_(?P<revision>\d{1,2}))?/si',$this->szUA,$aMatch ) )
                                                {
                                                    $this->szPlatformVersion = 'OS ' . $aMatch['major'] . '_' . $aMatch['minor'];
                                                    if ( isset( $aMatch['revision'] ) )
                                                    {
                                                        $this->szPlatformVersion .= '_' . $aMatch['revision'];
                                                    }
                                                }
                                                elseif ( preg_match( '/iphone os (?P<major>\d{1,2})_(?P<minor>\d{1,2})(_(?P<revision>\d{1,2}))?/si',$this->szUA,$aMatch ) )
                                                {
                                                    $this->szPlatformVersion = 'OS ' . $aMatch['major'] . '_' . $aMatch['minor'];
                                                    if ( isset( $aMatch['revision'] ) )
                                                    {
                                                        $this->szPlatformVersion .= '_' . $aMatch['revision'];
                                                    }
                                                }
                                            }
                                            break;
                    case 'ipod'         :
                    case 'iphone simulator':
                    case 'iphone'       :   {
                                                if ( preg_match( '/iphone os (?P<major>\d{1,2})_(?P<minor>\d{1,2})(_(?P<revision>\d{1,2}))?/si',$this->szUA,$aMatch ) )
                                                {
                                                    if ( isset( $aMatch['major'] ) && isset( $aMatch['minor'] )  )
                                                    {
                                                        $this->szPlatformVersion = 'OS ' . $aMatch['major'] . '_' . $aMatch['minor'];
                                                    }
                                                    if ( isset( $aMatch['revision'] ) )
                                                    {
                                                        $this->szPlatformVersion .= '_' . $aMatch['revision'];
                                                    }
                                                }
                                                elseif ( preg_match( '/Mac OS X( (?P<major>\d{1,2})_(?P<minor>\d{1,2})(_(?P<revision>\d{1,2}))?)?/si',$this->szUA,$aMatch ) )
                                                {
                                                    if ( isset( $aMatch['major'] ) && isset( $aMatch['minor'] ) && ! empty( $aMatch['major'] ) && ! empty( $aMatch['minor'] ) )
                                                    {
                                                        $this->szPlatformVersion = 'OS ' . $aMatch['major'] . '_' . $aMatch['minor'];
                                                        if ( isset( $aMatch['revision'] ) )
                                                        {
                                                            $this->szPlatformVersion .= '_' . $aMatch['revision'];
                                                        }
                                                    }
                                                    else
                                                    {
                                                        $this->szPlatformVersion .= 'Mac OS X';
                                                    }
                                                }

                                            }
                                            break;
                    case 'macintosh'    :   {
                                                if ( preg_match( '/Mac OS X( (?P<major>\d{1,2})_(?P<minor>\d{1,2})(_(?P<revision>\d{1,2}))?)?/si',$this->szUA,$aMatch ) )
                                                {
                                                    if ( isset( $aMatch['major'] ) && isset( $aMatch['minor'] ) && ! empty( $aMatch['major'] ) && ! empty( $aMatch['minor'] ) )
                                                    {
                                                        $this->szPlatformVersion = 'OS ' . $aMatch['major'] . '_' . $aMatch['minor'];
                                                        if ( isset( $aMatch['revision'] ) )
                                                        {
                                                            $this->szPlatformVersion .= '_' . $aMatch['revision'];
                                                        }
                                                    }
                                                    else
                                                    {
                                                        $this->szPlatformVersion .= 'Mac OS X';
                                                    }
                                                }
                                                elseif ( vaesoli::STR_iPos( $this->szUA,'powerpc' ) != -1 )
                                                {
                                                    $this->szPlatformVersion .= 'Mac PowerPC';
                                                }
                                            }
                                            break;
                }   /* switch ( $this->szPlatform ) */
            }   /* if ( ! empty( $this->szPlatform ) ) */
        }
        //else
        //{
        //    echo "<p>User agent NULL</p>\n";
        //}

        $this->fStop    = (float) microtime( true );
        return ( $this );
    }   /* == End of Browser.parseUA() ===============================================  */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*detectSpider()=

        Detects spiders (very basic algorithm)

        {*params
        *}

        {*caution
            Use this method after a successful call to [c]ParseUA()[/c]
        *}

        {*remark
            The method detects the presence of 'bot', 'crawler', 'spider' or 'scrape'.
            That's it!
        *}

        {*return
            (self)      Returns self; [c]$szType[/c] is updated
        *}

        {*cdate 02/02/2013 23:17 *}
        {*mdate 19/03/2013 15:57 *}
        {*version 5.1.0001 *}

        *}}
     */
    /* ================================================================================ */
    function detectSpider()
    /*-------------------*/
    {
        if ( vaesoli::STR_iPos( $this->szUA,'bot'     ) != -1 ||
             vaesoli::STR_iPos( $this->szUA,'crawler' ) != -1 ||
             vaesoli::STR_iPos( $this->szUA,'spider'  ) != -1 ||
             vaesoli::STR_iPos( $this->szUA,'scrape'  ) != -1 )
        {
            $this->szType = 'bot';
        }

        /* If an anchor is found ... this is a danger because pornbots
           do it often (they're listed in User Agents sites on which they
           therefore create a link to their site ... DANGER */

        if ( ( vaesoli::STR_iPos( $this->szUA,'http://xxxcams.me'                ) != -1 ) ||
             ( vaesoli::STR_iPos( $this->szUA,'blackfridaycellphonedeals.com'    ) != -1 ) ||
             ( vaesoli::STR_iPos( $this->szUA,'bobbywhatamanjackson.com'         ) != -1 ) ||
             ( vaesoli::STR_iPos( $this->szUA,'boundagesex.net'                  ) != -1 ) ||
             ( vaesoli::STR_iPos( $this->szUA,'cheapestdigitalcameras.co'        ) != -1 ) ||
             ( vaesoli::STR_iPos( $this->szUA,'cimaware.com'                     ) != -1 ) ||
             ( vaesoli::STR_iPos( $this->szUA,'commercialcleaningsantaana.com'   ) != -1 ) ||
             ( vaesoli::STR_iPos( $this->szUA,'decaptcher.org'                   ) != -1 ) ||
             ( vaesoli::STR_iPos( $this->szUA,'FreeForLifeDiscount.org'          ) != -1 ) ||
             ( vaesoli::STR_iPos( $this->szUA,'geiler-porno.biz'                 ) != -1 ) ||
             ( vaesoli::STR_iPos( $this->szUA,'granprixdelatlantico.com'         ) != -1 ) ||
             ( vaesoli::STR_iPos( $this->szUA,'greek-visiting.com'               ) != -1 ) ||
             ( vaesoli::STR_iPos( $this->szUA,'gslfbot'                          ) != -1 ) ||
             ( vaesoli::STR_iPos( $this->szUA,'healthshack.co.uk'                ) != -1 ) ||
             ( vaesoli::STR_iPos( $this->szUA,'margo-cosmetics.ro'               ) != -1 ) ||
             ( vaesoli::STR_iPos( $this->szUA,'mediaplex.com'                    ) != -1 ) ||
             ( vaesoli::STR_iPos( $this->szUA,'minivideocamera.org'              ) != -1 ) ||
             ( vaesoli::STR_iPos( $this->szUA,'metropolitan-selection.ro'        ) != -1 ) ||
             ( vaesoli::STR_iPos( $this->szUA,'nucleustechnologies'              ) != -1 ) ||
             ( vaesoli::STR_iPos( $this->szUA,'osis-uk.co.uk'                    ) != -1 ) ||
             ( vaesoli::STR_iPos( $this->szUA,'optimumpackersmovers.com'         ) != -1 ) ||
             ( vaesoli::STR_iPos( $this->szUA,'ost-to-pst.com'                   ) != -1 ) ||
             ( vaesoli::STR_iPos( $this->szUA,'paydayloanswww.com'               ) != -1 ) ||
             ( vaesoli::STR_iPos( $this->szUA,'propertychoice.com'               ) != -1 ) ||
             ( vaesoli::STR_iPos( $this->szUA,'r-domain.net'                     ) != -1 ) ||
             ( vaesoli::STR_iPos( $this->szUA,'SELL-IPAD.US'                     ) != -1 ) ||
             ( vaesoli::STR_iPos( $this->szUA,'Socialmediajunk.com'              ) != -1 ) ||
             ( vaesoli::STR_iPos( $this->szUA,'swobb-shop.ro'                    ) != -1 ) ||
             ( vaesoli::STR_iPos( $this->szUA,'WATCHESSELECTION.INFO'            ) != -1 ) ||
             ( vaesoli::STR_iPos( $this->szUA,'website-submission-seo'           ) != -1 ) ||
             ( vaesoli::STR_iPos( $this->szUA,'wachtwoordachterhalen.nl'         ) != -1 ) ||
             ( vaesoli::STR_iPos( $this->szUA,'withthisfavor.com'                ) != -1 ) ||
             ( vaesoli::STR_iPos( $this->szUA,'xpornv.com'                       ) != -1 ) ||
             ( vaesoli::STR_iPos( $this->szUA,'Ynpntwincities.org'               ) != -1 )
           )
        {
            $this->iDanger = 10;
        }
        elseif ( ( vaesoli::STR_iPos( $this->szUA,'porno'                        ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'sexy toys'                    ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'film hard'                    ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'vagine'                       ) != -1 )
               )
        {
            $this->iDanger = 10;
        }
        elseif ( ( vaesoli::STR_iPos( $this->szUA,'BoisChauffage77.fr'           ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'071magazine.pl'               ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'Sibert Belize'                ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'Inscriere in peste'           ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'Invisible fence'              ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'Mortare refractare'           ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'black friday plasma'          ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'coaching assessment'          ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'durerile de cap'              ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'egyptian arabic'              ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'great advertising'            ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'dla dziewczyn'                ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'fix it yourself'              ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'escorts in'                   ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'biblical foundations'         ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'car loans'                    ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'bad Credit'                   ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'aby dowiedziec'               ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'Taxi In'                      ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'Tattoo Designs'               ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'Police Auctions'              ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'Plumbers in'                  ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'Play casino'                  ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'Luxury Spa'                   ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'Good Page'                    ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'Boost Your'                   ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'neck pain'                    ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'Black Mold'                   ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'Lose pregnancy'               ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'inmobiliarias zona'           ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'ketone review'                ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'kolding sommerhus'            ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'kredit'                       ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'mortgage'                     ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'nike crossfit'                ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'nintendo dsixl'               ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'work from home'               ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'black friday'                 ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'search engine optimization'   ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'sklep zeglarski'              ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'zennoposter'                  ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'mentalpower'                  ) != -1 ) ||
                 ( vaesoli::STR_iPos( $this->szUA,'fanboosting.com'              ) != -1 )
           )
        {
            $this->iDanger = 7;
        }

        elseif ( preg_match( '%<a[^>]*>(.*?)</a>%si',$this->szUA ) )
        {
            $this->iDanger = 7;
        }

        return ( $this );
    }   /* == End of Browser.detectSpider() =========================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*version( $szPattern )=

        Detects User Agent version (handy in many cases ... but NOT all)

        {*params
            $szPattern      (string)    The pattern to be examined. Optional.
                                        [c]null[/c] by default.
            $szModifiers    (string)    Regex modifiers. Optional.
                                        [c]si[/c] by default.
        *}

        {*return
            (void)  No return; [c]$iMajor[/c], [c]$iMinor[/c] and
                    [c]$iRevision[/c] and [c]$szBuild[/c] updated
        *}

        {*cdate 24/06/2012 11:25 *}
        {*mdate 25/10/2013 09:27 *}
        {*version 5.0.0003 *}

        *}}
     */
    /* ================================================================================ */
    public function version( $szPattern = null,$szModifiers = 'si' )
    /*------------------------------------------------------------*/
    {
        //if ( preg_match( "/{$szPattern}/{$szModifiers}",$this->szUA,$aMatch ) )
        if ( preg_match( "/{$szPattern}(?P<maj>\d{1,2})\.(?P<min>\d{1,2})(\.(?P<rev>\d{1,4}))?(\.(?P<build>\d{1,5}))?/{$szModifiers}",$this->szUA,$aMatch ) )
        {
            if ( isset( $aMatch['maj'] ) )
            {
                $this->iMajor = (int) $aMatch['maj'];
            }
            if ( isset( $aMatch['min'] ) )
            {
                $this->iMinor = (int) $aMatch['min'];
            }
            if ( isset( $aMatch['rev'] ) )
            {
                $this->iRevision = (int) $aMatch['rev'];
            }
            if ( isset( $aMatch['build'] ) )
            {
                $this->szBuild = $aMatch['build'];
            }
        }
    }   /* End of Browser.version() =================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*getHost( [$szIP] )=

        Determines the host name linked to an IP address

        {*params
            $szIP    (string)   IP address
        *}

        {*caution
            Use this method after a successful call to [c]ParseUA()[/c]
        *}

        {*remark
            The GetHost() method only operates on bots
        *}

        {*cdate 02/02/2013 23:17 *}
        {*lupdate 19/03/2013 15:44 *}
        {*version 5.1.0001 *}

        {*return
            (string)    The host name by address
        *}

        {*exec
            // Imagine this being the UA that we need to examine
            $oBrowser = new Browser( 'Mozilla/5.0 (iPhone; U; CPU iPhone ' .
                                     'OS 4_1 like Mac OS X; en-us) ' .
                                     'AppleWebKit/532.9 (KHTML, like Gecko) ' .
                                     'Version/4.0.5 Mobile/8B117 Safari/6531.22.7 ' .
                                     '(compatible; Googlebot-Mobile/2.1; ' .
                                     '+http://www.google.com/bot.html)' );

            // Parse it now
            $oBrowser->ParseUA();

            // Imagine the request to come from '66.249.73.39'
            $szIP = '66.249.73.39';

            $szHost = $oBrowser->GetHost( $szIP );
            echo '<p>Host: ',$szHost,'</p>';

            if ( $oBrowser->IsReally( 'google',$szHost,$szIP ) )
            {
                echo "<p>Sane request from {$szHost} using the '{$szIP}' IP address</p>";
            }
            else
            {
                echo "<p>{$szHost} does not correspond to '{$szIP}': you caught a cheater!</p>";
            }
        *}

        *}}
     */
    /* ================================================================================ */
    function getHost( $szIP = null )
    /*----------------------------*/
    {
        $szRetVal = null;                                           /* Return value of the method */

        if ( empty( $szIP ) )                                       /* If invalid IP address */
        {
            if ( isset( $_SERVER['REMOTE_ADDR'] ) )                 /* If IP address defined */
            {
                $szIP = $_SERVER['REMOTE_ADDR'];                    /* ... use it */
            }   /* if ( isset( $_SERVER['REMOTE_ADDR'] ) ) */
        }   /* if ( empty( $szIP ) */

        if ( ! empty( $szIP ) )                                     /* And now ... do we have it? */
        {
            if ( $this->szType === 'bot' )                          /* If bot detected */
            {
                if ( $szHost = @gethostbyaddr( $szIP ) != $szIP )   /* Determine the host */
                {
                    $szRetVal = $szHost;                            /* Ready to return the value */
                }   /* if ( $szHost = @gethostbyaddr( $szIP ) != $szIP ) */
            }   /* if ( $this->szType === 'bot' ) */
        }   /* if ( ! empty( $szIP ) ) */

        return ( $szRetVal );                                       /* Return result to caller */
    }   /* == End of Browser.getHost() ================================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    protected function LooksLike( $szPattern,$iLine,$bDebug = false )
    /*-------------------------------------------------------------*/
    {
        if ( $bRetVal = ( $iPos = vaesoli::STR_iPos( $this->szUA,$szPattern ) ) != -1 )
            $this->iLineMatch = $iLine;

        if ( $bDebug )
            echo "<p>Looking for '{$szPattern}' in '{$this->szUA}': {$iPos}</p>";

        return ( $bRetVal );
    }   /* End of Browser.LooksLike() ================================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*Render( $szType )=

        Renders the data grabbed by the Browser object

        {*params
            $szType         (string)    Type of desired output. Optional.
                                        [c]null[/c] by default, in which case
                                        the result is HTML markup. Can also be
                                        [c]XML[/c], which obviously returns XML
                                        markup
        *}

        {*return
            (string)
        *}

        {*cdate 17/01/2014 06:35 *}
        {*mdate 17/01/2014 08:07 *}
        {*version 6.0.0002 *}

        *}}
     */
    /* ================================================================================ */
    public function Render( $szType = null )
    /*------------------------------------*/
    {
        $szRetVal = '';

        if ( ! empty( $szType ) && strtolower( trim( $szType ) ) === 'xml' )
        {
            $szRetVal  = '';
            $szRetVal .= "<Request><![CDATA[{$this->szUA}]]></Request>\n";
            $szRetVal .= "<Response>\n";
            $szRetVal .=    "<ToolVersion><![CDATA[{$this->szToolVersion}]]></ToolVersion>\n";
            $szRetVal .=    "<FullAgent><![CDATA[{$this->szUA}]]></FullAgent>\n";
            $szRetVal .=    "<AgentName><![CDATA[{$this->szName}]]></AgentName>\n";
            $szRetVal .=    "<AgentType><![CDATA[{$this->szType}]]></AgentType>\n";
            $szRetVal .=    "<Danger><![CDATA[{$this->iDanger} (-1 = not set; 0 = none; 10 = high)]]></Danger>\n";
            $szRetVal .=    "<AgentVersion>\n";
            $szRetVal .=        "<Major><![CDATA[{$this->iMajor}]]></Major>\n";
            $szRetVal .=        "<Minor><![CDATA[{$this->iMinor}]]></Minor>\n";
            $szRetVal .=        "<Revision><![CDATA[{$this->iRevision}]]></Revision>\n";
            $szRetVal .=        "<Build><![CDATA[{$this->szBuild}]]></Build>\n";
            $szRetVal .=    "</AgentVersion>\n";
            $szRetVal .=    "<Device>\n";
            $szRetVal .=        "<Type><![CDATA[{$this->szMobility}]]></Type>\n";
            $szRetVal .=        "<Name><![CDATA[{$this->szDevice}]]></Name>\n";
            $szRetVal .=        "<Model><![CDATA[{$this->szModel}]]></Model>\n";
            $szRetVal .=    "</Device>\n";
            $szRetVal .=    "<Platform>\n";
            $szRetVal .=        "<Name><![CDATA[{$this->szPlatform}]]></Name>\n";
            $szRetVal .=        "<Version><![CDATA[{$this->szPlatformVersion}]]></Version>\n";
            $szRetVal .=    "</Platform>\n";
            $szRetVal .=    "<Perf>\n";
            $szRetVal .=        "<ParseTime>" . ( $this->fStop - $this->fStart ) . " sec</ParseTime>\n";
            $szRetVal .=        "<Line>{$this->iLineMatch}</Line>\n";
            $szRetVal .=    "</Perf>\n";

            if ( $this->szMobility === 'tablet' ||
                 $this->szMobility === 'phone'  ||
                 $this->szMobility === 'mobile' )
            {
                if ( count( $this->aProperties ) > 0 )
                {
                    $szRetVal .= "<DeviceProperties>\n";

                    if ( isset( $this->aProperties[$szProp = 'technical-specs'] )       && vaesoli::MISC_True( $x = $this->aProperties[$szProp],$szTag = 'TechnicalSpecs' ) )
                        $szRetVal .= "<{$szTag}>{$x}</{$szTag}>";
                    if ( isset( $this->aProperties[$szProp = 'keyboard'] )              && vaesoli::MISC_True( $x = $this->aProperties[$szProp],$szTag = 'Keyboard' ) )
                        $szRetVal .= "<{$szTag}>{$x}</{$szTag}>";
                    if ( isset( $this->aProperties[$szProp = 'screen-size'] )           && vaesoli::MISC_True( $x = $this->aProperties[$szProp],$szTag = 'ScreenSize' ) )
                        $szRetVal .= "<{$szTag}>{$x}</{$szTag}>";
                    if ( isset( $this->aProperties[$szProp = 'pixel-ratio'] )           && vaesoli::MISC_True( $x = $this->aProperties[$szProp],$szTag = 'PixelRatio' ) )
                        $szRetVal .= "<{$szTag}>{$x}</{$szTag}>";
                    if ( isset( $this->aProperties[$szProp = 'html-version'] )          && vaesoli::MISC_True( $x = $this->aProperties[$szProp],$szTag = 'HTMLVersion' ) )
                        $szRetVal .= "<{$szTag}>{$x}</{$szTag}>";
                    if ( isset( $this->aProperties[$szProp = 'sound-output-capable'] )  && vaesoli::MISC_True( $x = ( $this->aProperties[$szProp] ? 'true' : 'false' ),$szTag = 'SoundOutputCapable' ) )
                        $szRetVal .= "<{$szTag}>{$x}</{$szTag}>";
                    if ( isset( $this->aProperties[$szProp = 'voice-input-capable'] )   && vaesoli::MISC_True( $x = ( $this->aProperties[$szProp] ? 'true' : 'false' ),$szTag = 'VoiceInputCapable' ) )
                        $szRetVal .= "<{$szTag}>{$x}</{$szTag}>";

                    $szRetVal .= "</DeviceProperties>\n";
                }
            }

            $szRetVal .= "</Response>\n";
        }
        else
        {
            $szRetVal  = "<div class=\"LS_VAESOLI_USER_AGENT\">\n";

            $szRetVal .= '<p><span class="lbl">Original User Agent:</span>  <span class="data">'    . $this->szUA               . '</span></p>' . "\n";
            $szRetVal .= '<p><span class="lbl">Name:</span>                 <span class="data">'    . $this->szName             . '</span></p>' . "\n";
            $szRetVal .= '<p><span class="lbl">Type:</span>                 <span class="data">'    . $this->szType             . '</span></p>' . "\n";
            $szRetVal .= '<p><span class="lbl">Major version:</span>        <span class="data">'    . $this->iMajor             . '</span></p>' . "\n";
            $szRetVal .= '<p><span class="lbl">Minor version:</span>        <span class="data">'    . $this->iMinor             . '</span></p>' . "\n";
            $szRetVal .= '<p><span class="lbl">Revision:</span>             <span class="data">'    . $this->iRevision          . '</span></p>' . "\n";
            $szRetVal .= '<p><span class="lbl">Build:</span>                <span class="data">'    . $this->szBuild            . '</span></p>' . "\n";
            $szRetVal .= '<p><span class="lbl">Mobility:</span>             <span class="data">'    . $this->szMobility         . '</span></p>' . "\n";
            $szRetVal .= '<p><span class="lbl">Device:</span>               <span class="data">'    . $this->szDevice           . '</span></p>' . "\n";
            $szRetVal .= '<p><span class="lbl">Model:</span>                <span class="data">'    . $this->szModel            . '</span></p>' . "\n";
            $szRetVal .= '<p><span class="lbl">Platform:</span>             <span class="data">'    . $this->szPlatform         . '</span></p>' . "\n";
            $szRetVal .= '<p><span class="lbl">Platform version:</span>     <span class="data">'    . $this->szPlatformVersion  . '</span></p>' . "\n";

            if ( $oBrowser->iDanger >= 0 )
            {
                $szRetVal .= '<p><span class="lbl">Dangerousness:</span> <span class="data">' . $this->iDanger . ' (-1 = unknown; 0 = none;10 = proved)</span></p>' . "\n";
            }
            else
            {
                $szRetVal .= '<p><span class="lbl">Dangerousness:</span> <span class="data">Not studied</span></p>';
            }

            if ( count( $oBrowser->aProperties ) > 0 )
            {
                if ( isset( $oBrowser->aProperties[$szProp = 'technical-specs'] ) && vaesoli::MISC_True( $x = $oBrowser->aProperties[$szProp] ) )
                    $szRetVal .= "<p><span>Technical specs:</span> <strong style=\"color:#800;\">{$x}</strong></p>";
                if ( isset( $oBrowser->aProperties[$szProp = 'company'] ) && vaesoli::MISC_True( $x = $oBrowser->aProperties[$szProp] ) )
                    $szRetVal .= "<p><span>Company:</span> <strong style=\"color:#800;\">{$x}</strong></p>";
                if ( isset( $oBrowser->aProperties[$szProp = 'keyboard'] ) && vaesoli::MISC_True( $x = $oBrowser->aProperties[$szProp] ) )
                    $szRetVal .= "<p><span>Keyboard:</span> <strong style=\"color:#800;\">{$x}</strong></p>";
                if ( isset( $oBrowser->aProperties[$szProp = 'screen-size'] ) && vaesoli::MISC_True( $x = $oBrowser->aProperties[$szProp] ) )
                    $szRetVal .= "<p><span>Screen size:</span> <strong style=\"color:#800;\">{$x}</strong></p>";
                if ( isset( $oBrowser->aProperties[$szProp = 'pixel-ratio'] ) && vaesoli::MISC_True( $x = $oBrowser->aProperties[$szProp] ) )
                    $szRetVal .= "<p><span>Pixel ratio:</span> <strong style=\"color:#800;\">{$x}</strong></p>";
                if ( isset( $oBrowser->aProperties[$szProp = 'html-version'] ) && vaesoli::MISC_True( $x = $oBrowser->aProperties[$szProp] ) )
                    $szRetVal .= "<p><span>HTML version:</span> <strong style=\"color:#800;\">{$x}</strong></p>";
            }

            $szRetVal .= '<p><span class="lbl">Parse time:</span> <span class="data">' . ( $this->fStop - $this->fStart )   . ' sec</span></p>' . "\n";
            $szRetVal .= '<p><span class="lbl">Line match:</span> <span class="data">' . ( $this->iLineMatch            )   . '</span></p>' . "\n";
            $szRetVal .= "</div> <!-- End of div.LS_VAESOLI_USER_AGENT -->\n";
        }

        return ( $szRetVal );

    }   /* End of Browser.Render() ==================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*isReally( $szName,$szHost,$szIP )=

        Determines if $szIP corresponds to $szHost

        {*params
            $szName     (string)    Bot name
            $szHost     (string)    Host name to check
            $szIP       (string)    IP address to check
        *}

        {*cdate 25/10/2013 07:49 *}
        {*mdate 25/10/2013 07:49 *}
        {*version 5.6.0004 *}

        {*return
            (bool)      [c]true[/c] is $szIP cooresponds to $szHost; [c]if
                        not[/c].
        *}

        {*exec
            // Ici, il faudrait que je me mette un exemple rÚel
        *}

        *}}
     */
    /* ================================================================================ */
    public function isReally( $szName,$szHost,$szIP )
    /*---------------------------------------------*/
    {
        $bRetVal = false;                                           /* Return value of the method */

        switch( $szName )                                           /* The name we would like to check */
        {
            case    'google'    :   break;
            case    'yahoo'     :   $bRetVal = preg_match( '/crawl\.yahoo\.net\z/i',$szHost );
                                    break;
            case    'bing'      :   break;
        }   /* switch( $szName ) */

        if ( $bRetVal )                                             /* If everything OK up to now */
        {
            if ( ( $szTheIP = @gethostbyname( $szHost ) ) != $szIP )/* If IP addresses do match */
            {
                $bRetVal = false;
            }   /* if ( ( $szTheIP = @gethostbyname( $szHost ) ... */
        }   /* if ( $bRetVal ) */

        return ( $bRetVal );                                        /* Return result to caller */
    }   /* End of Browser.IsReally() ================================================== */
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
    }   /* End of Browser.__destruct() ================================================ */
    /* ================================================================================ */

}   /* End of class Browser =========================================================== */
/* ==================================================================================== */
?>