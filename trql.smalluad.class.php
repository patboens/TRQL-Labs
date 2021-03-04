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
    {*file                  trql.smalluad.class.php *}
    {*purpose               Small User Account Database. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 14-01-21 16:33 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 14-01-21 16:33 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\smalluad;

use \trql\vaesoli\Vaesoli               as v;
use \trql\dataset\Dataset               as Dataset;
use \trql\user\User                     as User;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'DATASET_CLASS_VERSION' ) )
    require_once( 'trql.dataset.class.php' );

if ( ! defined( 'USER_CLASS_VERSION' ) )
    require_once( 'trql.user.class.php' );

defined( 'SMALLUAD_CLASS_VERSION' ) or define( 'SMALLUAD_CLASS_VERSION' ,'0.1' );

/* ==================================================================================== */
/** {{*class SmallUAD=

    {*desc

        Small User Account Database.

    *}

 */
/* ==================================================================================== */
class SmallUAD extends Dataset
/*--------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)             Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q2033488';       /* {*property   $wikidataId                     (string)            In Wikidata, this entity depicts what a Security Accounts
                                                                                                                                        Manager is: Windows database that stores users' passwords.
                                                                                                                                        Both notions are not identical but considered similar
                                                                                                                                        enough *} */
    protected   $oDom                           = null;
    public      $isLoaded                       = false;
    protected   $aUsers                         = null;
    public      $szStorage                      = null;


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
    }   /* End of SmallUAD.__construct() ============================================== */
    /* ================================================================================ */


    public function load( $szFile ): bool
    /*---------------------------------*/
    {
        $bRetVal = false;

        if ( is_null( $this->oDom ) )
            $this->oDom = new \DOMDocument();

        if ( is_file( $this->szStorage = $szFile ) )
        {
            //var_dump( $szFile . " FOUND" );

            if ( $this->oDom->load( $szFile ) )
            {
                $oXPath = new \DOMXPath( $this->oDom );

                if ( ( $oColl = $oXPath->query( '//User' ) ) && ( $oColl->length > 0 ) )
                {
                    foreach( $oColl as $oNode )
                    {
                        $oUser = new User();

                        $oUser->identifier = $oNode->getAttribute( 'id' );

                        if ( ( $o = $oXPath->query( 'Name/FirstName',$oNode ) ) && ( $o->length > 0 ) )
                            $oUser->givenName = trim( $o->item(0)->nodeValue );

                        if ( ( $o = $oXPath->query( 'Name/LastName',$oNode ) ) && ( $o->length > 0 ) )
                            $oUser->familyName = trim( $o->item(0)->nodeValue );

                        if ( ( $o = $oXPath->query( 'Gender',$oNode ) ) && ( $o->length > 0 ) )
                            $oUser->gender = trim( $o->item(0)->nodeValue );

                        if ( ( $o = $oXPath->query( 'Email',$oNode ) ) && ( $o->length > 0 ) )
                            $oUser->email = trim( $o->item(0)->nodeValue );

                        if ( ( $o = $oXPath->query( 'JobTitle',$oNode ) ) && ( $o->length > 0 ) )
                            $oUser->jobTitle = trim( $o->item(0)->nodeValue );

                        if ( ( $o = $oXPath->query( 'MemberOf',$oNode ) ) && ( $o->length > 0 ) )
                            $oUser->memberOf = trim( $o->item(0)->nodeValue );

                        if ( ( $o = $oXPath->query( 'Phone',$oNode ) ) && ( $o->length > 0 ) )
                            $oUser->telephone = trim( $o->item(0)->nodeValue );

                        if ( ( $o = $oXPath->query( 'Pwd',$oNode ) ) && ( $o->length > 0 ) )
                            $oUser->accessCode = md5( trim( $o->item(0)->nodeValue ) );

                        $this->aUsers[$oUser->identifier] = $oUser;
                    }

                    //var_dump( $this->aUsers );
                    $bRetVal = $this->isLoaded = true;

                }   /* if ( $oColl = $oXPath->query( '//User' ) && ( $oColl->length > 0 ) ) */

            }   /* if ( $this->oDom->load( $szFile ) ) */
        }   /* if ( is_file( $szFile ) ) */

        end:
        return ( $bRetVal );
    }   /* End of SmallUAD.load() ===================================================== */
    /* ================================================================================ */


    public function seek( $szID )
    /*-------------------------*/
    {
        if ( $this->isLoaded && is_array( $this->aUsers ) && count( $this->aUsers ) > 0 )
            return ( $this->aUsers[$szID] ?? null );

        return ( null );
    }   /* End of SmallUAD.seek() ===================================================== */
    /* ================================================================================ */


    public function update( $szID,$szField,$szValue )
    /*---------------------------------------------*/
    {
        $bRetVal = false;

        //var_dump( __METHOD__ . '(): does not do anything yet. Should look in ' . $this->szStorage );

        $oXPath = new \DOMXPath( $this->oDom );

        if ( ( $oColl = $oXPath->query( "//User[@id='{$szID}']/{$szField}" ) ) && ( $oColl->length > 0 ) )
        {
            $oColl->item(0)->nodeValue = $szValue;

            v::FIL_Copy( $this->szStorage,$this->szStorage . '.' . date('YmdHis') . '.backup' );
            $iBytes = $this->oDom->save( $this->szStorage );        /* Let's try to save the file */

            if ( is_integer( $iBytes ) )                            /* If integer returned */
            {
                if ( $iBytes > 0 )                                  /* If number of bytes OK */
                {
                    $bRetVal = true;                                /* Ready to return a logical true */
                    //$this->DebugMsg( "Le fichier est sauvé dans " . realpath( $szFile ),__METHOD__,__LINE__ );
                    $this->IsDirty = false;                         /* Not dirty anymore */
                }   /* if ( $iBytes > 0 ) */
            }
        }

        return ( $bRetVal );
    }   /* End of SmallUAD.update() =================================================== */
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
    }   /* End of SmallUAD.__destruct() =============================================== */
    /* ================================================================================ */

}   /* End of class SmallUAD ========================================================== */
/* ==================================================================================== */
?>