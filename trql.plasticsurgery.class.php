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


    [c]trql.schemaclassgenerator.class.php[/c]

*/

/** {{{*fheader
    {*file                  trql.plasticsurgery.class.php *}
    {*purpose               A specific branch of medical science that pertains to
                            therapeutic or cosmetic repair or re-formation of missing,
                            injured or malformed tissues or body parts by manual and
                            instrumental means. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 14:12 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 28-08-2020 14:12 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\plasticsurgery;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\medicalbusiness\MedicalBusiness    as MedicalBusiness;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'MEDICALBUSINESS_CLASS_VERSION' ) )
    require_once( 'trql.medicalbusiness.class.php' );

defined( 'PLASTICSURGERY_CLASS_VERSION' ) or define( 'PLASTICSURGERY_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class PlasticSurgery=

    {*desc

        A specific branch of medical science that pertains to therapeutic or
        cosmetic repair or re-formation of missing, injured or malformed tissues or
        body parts by manual and instrumental means.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/PlasticSurgery[/url] *}

    {*warning
        This class has been generated automatically by 
        [c]trql.schemaclassgenerator.class.php[/c] on 28-08-2020 14:12.
    *}

 */
/* ==================================================================================== */
class PlasticSurgery extends MedicalBusiness
/*----------------------------------------*/
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
    public      $wikidataId                     = 'Q182442';        /* {*property   $wikidataId                     (string)                        Wikidata ID. Medical specialty concerned
                                                                                                                                                    with the altering or restoration of form
                                                                                                                                                    and function. *} */

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
    }   /* End of PlasticSurgery.__construct() ======================================== */
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
    }   /* End of PlasticSurgery.__destruct() ========================================= */
    /* ================================================================================ */
}   /* End of class PlasticSurgery ==================================================== */
/* ==================================================================================== */
?>