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
    {*file                  trql.version.class.php *}
    {*purpose               Version object *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 30-07-20 15:48 *}
    {*mdate                 auto *}
    {*license               All rights reserved to Lato Sensu Management
                            for all countries. All Intellectual Property
                            belongs to Patrick Boens. *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 30-07-20 15:48 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation. Most of the code has been based on
                                [c]LSVersion.class.php[/c] of Vae Soli!
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
namespace trql\version;

use \trql\vaesoli\vaesoli       as vaesoli;
use \trql\schema\Thing           as Thing;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'THING_CLASS_VERSION' ) )
    require_once( 'trql.thing.class.php' );

defined( 'VERSION_CLASS_VERSION' ) or define( 'VERSION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Version=

    {*desc
        Generic services to handle versions
    *}

    *}}
 */
/* ==================================================================================== */
class Version extends Thing
/*-----------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self           (array)     Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $iMajor                 = 0;                        /* {*property   $iMajor         (int)       Major version number (e.g. [c]5[/c]) *} */
    public      $iMinor                 = 0;                        /* {*property   $iMinor         (int)       Minor version number (e.g. [c]4[/c]) *} */
    public      $Revision               = '';                       /* {*property   $Revision       (string)    Revision (e.g [c]'0015b'[/c]) *} */
    public      $Build                  = '';                       /* {*property   $Build          (string)    Build (e.g [c]'Genome and gene interaction in LSContainers'[/c]) *} */
    public      $ReleaseType            = '';                       /* {*property   $ReleaseType    (string)    Release type (alpha, beta, release candidate, final release, ...) (e.g [c]'beta'[/c]) *} */
    public      $szCodeName             = '';                       /* {*property   $szCodeName     (string)    Codename (e.g [c]Quitus Rebooted[/c]) *} */
    public      $szDateTime             = '';                       /* {*property   $szDateTime     (string)    Version date & time (e.g [c]'20130905082700'[/c]) *} */
    public      $aCredits               = array();                  /* {*property   $aCredits       (array)     An array of possible credits *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId             = 'Q20826013';              /* {*property   $wikidataId     (string)    Wikidata ID. Software version ... defined and 
                                                                                                                identifiable development stage of a software product*} */

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

        /* 5 lines of credit ------------------------------------------------ */
        $aCredits[] = null;                                         /* Add a line of credits */
        $aCredits[] = null;                                         /* Add a line of credits */
        $aCredits[] = null;                                         /* Add a line of credits */
        $aCredits[] = null;                                         /* Add a line of credits */
        $aCredits[] = null;                                         /* Add a line of credits */
        /* 5 lines of credit ------------------------------------------------ */

        $this->die( "THIS CLASS IS NOT FUNCTIONAL AT ALL. MUST BE BASED ON LSVersion.php" );

        return ( $this );
    }   /* End of Version.__construct() =============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*Render( [$iType] )=

        Renders the version as a string

        {*params
            $iType  (int)   Type of version to return:[br]
                            [table]
                                [tr][td][c]1[/c][/td][td]major.minor.revision - datetime[/td][tr]
                                [tr][td][c]2[/c][/td][td]major.minor.revision[/td][tr]
                                [tr][td][c]3[/c][/td][td]major.minor[/td][tr]
                                [tr][td][c]4[/c][/td][td]major[/td][tr]
                                [tr][td][c]5[/c][/td][td]minor[/td][tr]
                                [tr][td][c]6[/c][/td][td]date[/td][tr]
                                [tr][td][c]7[/c][/td][td]build[/td][tr]
                                [tr][td][c]8[/c][/td][td]release type[/td][tr]
                                [tr][td]default[/td][td]major.minor.revision - datetime - build - release type[/td][tr]
                            [/table]
        *}

        {*return
            (string)    The string representation of the version 
        *}

        {*exec
            $oVersion = new LSVersion();
            $oVersion->iMajor = 3;
            $oVersion->iMinor = 12;
            echo '<p>',$oVersion,'</p>';
            echo '<p>',$oVersion->Render( 3 ),'</p>';
        *}

        *}}
     */
    /* ================================================================================ */
    public function render( $iType = 0 )
    /*--------------------------------*/
    {
        $szRetVal = '';

        switch ( $iType )
        {
            /* major.minor.revision - datetime */
            case 1  :   $szRetVal = "{$this->iMajor}.{$this->iMinor}.{$this->Revision} - Date: {$this->szDateTime}";
                        break;
            /* major.minor.revision */
            case 2  :   $szRetVal = "{$this->iMajor}.{$this->iMinor}.{$this->Revision}";
                        break;
            /* major.minor */
            case 3  :   $szRetVal = "{$this->iMajor}.{$this->iMinor}";
                        break;
            /* major */
            case 4  :   $szRetVal = "{$this->iMajor}";
                        break;
            /* minor */
            case 5  :   $szRetVal = "{$this->iMinor}";
                        break;
            /* date */
            case 6  :   $szRetVal = "{$this->szDateTime}";
                        break;
            /* build */
            case 7  :   $szRetVal = "{$this->Build}";
                        break;
            /* release type */
            case 8  :   $szRetVal = "{$this->ReleaseType}";
                        break;
            /* major.minor.revision - datetime - build - release type */
            default :   $szRetVal = "{$this->iMajor}.{$this->iMinor}.{$this->Revision} - Date: {$this->szDateTime} - Build : {$this->Build} - Release type : {$this->ReleaseType}";
                        break;
        }   /* switch ( $iType ) */

        return ( $szRetVal );
    }   /* End of method Version.render() ============================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*Compare( $iMajor,$iMinor,$xRevision )=

        Compares the version

        {*params
            $iMajor     (int)       Major version qualifier
            $iMinor     (int)       Minor version qualifier
            $xRevision  (mixed)     Revision number
        *}

        {*return
            (int)       [c]0[/c] ... if [c]$this[/c] is identical to $iMajor, $iMinor,$xRevision[br]
                        [c]1[/c] ... if [c]$this[/c] is more recent than $iMajor, $iMinor,$xRevision[br]
                        [c]-1[/c] ... if [c]$this[/c] is older than $iMajor, $iMinor,$xRevision[br]
        *}

        {*Example
            if ( $this->oApp->oVersion->Compare( 5,4,'0014' ) >= 0 )
            {
                echo "Current app version more recent than 5.4.0014! You can proceed!";
            }
        *}

        *}}
     */
    /* ================================================================================ */
    public function compare( $iMajor,$iMinor,$xRevision )
    /*-------------------------------------------------*/
    {
        $iRetVal = 0;

        if     ( $this->iMajor > (string) $iMajor )
        {
            $iRetVal = 1;
        }
        elseif ( $this->iMajor === $iMajor )
        {
            if     ( $this->iMinor > $iMinor )
            {
                $iRetVal = 1;
            }
            elseif ( $this->iMinor === $iMinor )
            {
                if ( (string) $this->Revision > (string) $xRevision  )
                {
                    $iRetVal = 1;
                }
                elseif ( (string) $this->Revision == (string) $xRevision )
                {
                    $iRetVal = 0;
                }
                else
                {
                    $iRetVal = -1;
                }
            }
            else
            {
                $iRetVal = -1;
            }
        }
        else
        {
            $iRetVal = -1;
        }

        return ( $iRetVal );
    }   /* End of method Version.compare() ============================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toString()=

        Invoked when the object should be converted into a string

        {*params
        *}

        {*return
            (string)    The HTML that represents the cloud of words: call to
                        Render()
        *}

        *}}
     */
    /* ================================================================================ */
    public function __toString()
    /*------------------------*/
    {
        return ( $this->Render() );
    }   /* End of Version.__toString() ================================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*Assign( $szVersion,$szDefault )=

        Assigns a version number (xx.xx.xxxx)

        {*params
            $szVersion  (string)    The version to set. Optional. [c]''[/c] by default
            $szDefault  (string)    The default version to set. Optional. [c]''[/c] by default
        *}

        {*return
            (void)      The object properties [c]$iMajor[/c],[c]$iMinor[/c] and 
                        [c]$Revision[/c] are updated with the values found in 
                        [c]$szVersion[/c] or in [c]$szDefault[/c]
        *}

        {*exec
            $oVersion = new LSVersion();
            $oVersion->Assign( '3.12' );
            echo '<p>',$oVersion,'</p>';
            echo '<p>',$oVersion->Render( 3 ),'</p>';
        *}

        *}}
     */
    /* ================================================================================ */
    public function assign( $szVersion = '',$szDefault = '' )
    /*-----------------------------------------------------*/
    {
        $aElements = null;                                          /* Array of elements (null by default */

        if      ( ! empty( $szVersion ) )                           /* If new version passed */
        {
            $aElements = explode( '.',$szVersion );                 /* Create an array with major,minor,revision from szVersion */
        }
        else if ( ! empty( $szDefault ) )                           /* If default passed */
        {
            $aElements = explode( '.',$szDefault );                 /* Create an array with major,minor,revision from szDefault */
        }

        /* Let's put default settings */
        $this->iMajor       = 0;                                    /* Major version number */
        $this->iMinor       = 0;                                    /* Minor version number */
        $this->Revision     = '0000';                               /* Revision string */

        if ( ! is_null( $aElements ) )                              /* If array filled */
        {
            $nElements = count( $aElements );                       /* Count elements found */

            switch ( $nElements )                                   /* How many elements did we find */
            {
                case 3:  $this->Revision = (string) $aElements[2];  /* Revision string */
                case 2:  $this->iMinor   = (int)    $aElements[1];  /* Minor version number */
                case 1:  $this->iMajor   = (int)    $aElements[0];  /* Major version number */
                         break;
            }   /* switch ( $nElements ) */
        }   /* if ( ! is_null( $aElements ) ) */
    }   /* End of method Version.assign() ============================================= */
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
    }   /* End of Version.__destruct() ================================================ */
    /* ================================================================================ */
}   /* End of class Version =========================================================== */
/* ==================================================================================== */
?>