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
    {*file                  trql.openlabel.class.php *}
    {*purpose               Get a label from OpenLabels. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-12-20 10:44 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 28-12-20 10:44 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\openlabel;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\schema\Thing                       as Thing;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'THING_CLASS_VERSION' ) )
    require_once( 'trql.thing.class.php' );



defined( 'OPENLABEL_CLASS_VERSION' ) or define( 'OPENLABEL_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class OpenLabel=

    {*desc

        Get a label from OpenLabels.

    *}

    {*abstract

        What Are We Up For?

        In all the apps you have created, how many times have you coded the same
        labels over and over again?

        How many times have you coded the same firstname, lastname, address,
        street, zip code, city, country, email address, user name, password,
        invalid password, … labels? And how many times have you translated them
        in 2 or 3 languages (or more)? Tell us! How many times?

        Well, this is exactly what the OpenLabels initiative is for! A database
        of labels, easily queryable, updatable and downloadable (QUD in short),
        for all of us, and free!

    *}

 */
/* ==================================================================================== */
class OpenLabel extends Thing
/*-------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );



    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId             = null;                     /* {*property   $wikidataId                     (string)                        Wikidata ID. No equivalent. *} */


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
    }   /* End of OpenLabel.__construct() ============================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*seek( $szKey[,$szLanguage][,$xDefault] )=

        Seeks a label by its ID ($szKey);

        {*params
            $szKey          (string)        The key to look for
            $szLanguage     (string)        Optional. The language of the key. [c]'fr'[/c]
                                            by default.
            $xDefault       (string)        The default to return if no result can be
                                            determined.
        *}

        {*remark

            [c]$xDefault[/c] is called this way because in earlier implementations of
            OpenLabels it could also be an array.

        *}

        {*return
            (string)        The label corresponding to $szKey or [c]null[/c] if no
                            result can be determined
        *}

        *}}
    */
    /* ================================================================================ */
    public function seek( $szKey,$szLanguage = 'fr',$xDefault = null )
    /*--------------------------------------------------------------*/
    {
        static $oDom,$oXPath = null;
        static $aResults;

        $szRetVal = null;

        if ( is_null( $oDom ) )                                         /* If the static object is null, create a DOMDocument */
        {
            $oDom = new \DOMDocument();

            /* Load the OpenLabels XML file */

            if ( is_file( $szFile = vaesoli::FIL_RealPath( $this->home() . '/labels/openlabels.xml' ) ) )
            {
                if ( $oDom->load( $szFile = vaesoli::FIL_RealPath( $this->home() . '/labels/openlabels.xml' ) ) )
                {
                    $oXPath = new \DOMXPath( $oDom );
                    //var_dump( $szFile . ' loaded and XPath created' );
                }   /* if ( $oDom->load( $szFile ) ) */
            }   /* if ( is_file( $szFile = vaesoli::FIL_RealPath( $this->home() . '/labels/openlabels.xml' ) ) ) */
            else    /* Else of ... if ( is_file( $szFile = vaesoli::FIL_RealPath( $this->home() . '/labels/openlabels.xml' ) ) ) */
            {
                //throw new \Exception( __FUNCTION__ . "() at line " . __LINE__ . ": " . basename( $szFile ) . " FILE NOT FOUND (ErrCode: " . EXCEPTION_CODE_RESOURCE_NOT_FOUND . ")",EXCEPTION_CODE_RESOURCE_NOT_FOUND );
            }
        }   /* if ( is_null( $oDom ) ) */

        if ( ! is_null( $oDom ) && ! is_null( $oXPath ) )               /* If we have a valid DOMDocument and a valid XPath */
        {
            //var_dump( $szFile );

            if ( isset( $aResults[$szKey][$szLanguage] ) )              /* If the result is already cached */
            {
                $szRetVal = $aResults[$szKey][$szLanguage];             /* Prepare result and leave */
            }   /* if ( isset( $aResults[$szKey][$szLanguage] ) ) */
            else    /* Else of ... if ( isset( $aResults[$szKey][$szLanguage] ) ) */
            {
                $szQuery = '//Data[@key="$' . $szKey . '"]';

                if ( ( $o = $oXPath->query( $szQuery ) ) && $o->length > 0 )
                {
                    //var_dump( "FOUND {$szKey}" );

                    if ( empty( $szLanguage ?? '' ) )                   /* If no language provided ... return the first match */
                        $szQuery = "Value";
                    else    /* Else of ... if ( empty( $szLanguage ?? '' ) ) */
                        $szQuery = "Value[contains(@lang,'{$szLanguage}')]";

                    if ( ( $o2 = $oXPath->query( $szQuery,$o->item(0) ) ) && $o2->length > 0 )
                        $aResults[$szKey][$szLanguage] = $szRetVal = $o2->item(0)->nodeValue;
                }   /* if ( ( $o = $oXPath->query( $szQuery ) ) && $o->length > 0 ) */
            }
        }   /* if ( ! is_null( $oDom ) && ! is_null( $oXPath ) ) */

        end:
        return ( $szRetVal );
    }   /* End of OpenLabel.seek() ==================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*add( $szKey,$szLanguage,$szValue] )=

        Adds $szKey in $szLanguage as $szValue in OpenLabels

        {*params
        *}

        {*return
            (void)      No return
        *}

        *}}
    */
    /* ================================================================================ */
    public function add( $szKey,$szLanguage,$szValue )
    /*--------------------------------------------------------------*/
    {
        $this->addInfo( __METHOD__ . "(): the method does NOT do anything for the time being (28-12-20 12:22:57)" );
    }   /* End of OpenLabel.add() ===================================================== */
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
    }   /* End of OpenLabel.__destruct() ============================================== */
    /* ================================================================================ */

}   /* End of class OpenLabel ========================================================= */
/* ==================================================================================== */

?>