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
    {*file                  trql.digitaldocumentpermission.class.php *}
    {*purpose               A permission for a particular person or group to access a
                            particular file. *}
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


    *}}} */
/****************************************************************************************/
namespace trql\digitaldocumentpermission;

use \trql\vaesoli\Vaesoli           as Vaesoli;
use \trql\schema\Intangible     as Intangible;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'INTANGIBLE_CLASS_VERSION' ) )
    require_once( 'trql.intangible.class.php' );


defined( 'DIGITALDOCUMENTPERMISSION_CLASS_VERSION' ) or define( 'DIGITALDOCUMENTPERMISSION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class DigitalDocumentPermission=

    {*desc

        A permission for a particular person or group to access a particular file.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/DigitalDocumentPermission[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:46.
    *}

 */
/* ==================================================================================== */
class DigitalDocumentPermission extends Intangible
/*----------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self               (array)                                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $grantee                        = null;             /* {*property   $grantee            (Organization|Audience|Person|ContactPoint)     The person, organization, contact point, or audience that has been
                                                                                                                                                        granted this permission. *} */
    public      $permissionType                 = null;             /* {*property   $permissionType     (DigitalDocumentPermissionType)                 The type of permission granted the person, organization, or audience. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q231043';        /* {*property   $wikidataId         (string)                                        "Consent" in Wikidata (the closest we can get):
                                                                                                                                                        Expression granting permission; indication of agreement with a 
                                                                                                                                                        proposal; acknowledgement that an item meets requirements *} */



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
    }   /* End of DigitalDocumentPermission.__construct() ============================= */
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
    }   /* End of DigitalDocumentPermission.__destruct() ============================== */
    /* ================================================================================ */

}   /* End of class DigitalDocumentPermission ========================================= */
/* ==================================================================================== */

?>