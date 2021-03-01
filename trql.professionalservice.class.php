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
    {*file                  trql.professionalservice.class.php *}
    {*purpose               Original definition: "provider of professional services."The
                            general ProfessionalService type for local businesses was
                            deprecated due to confusion with Service. For reference, the
                            types that it included were: Dentist, AccountingService,
                            Attorney, Notary, as well as types for several kinds of
                            HomeAndConstructionBusiness: Electrician, GeneralContractor,
                            HousePainter, Locksmith, Plumber, RoofingContractor.
                            LegalService was introduced as a more inclusive supertype of
                            Attorney. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:28 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 28-08-2020 16:28 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\professionalservice;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\localbusiness\LocalBusiness    as LocalBusiness;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'LOCALBUSINESS_CLASS_VERSION' ) )
    require_once( 'trql.localbusiness.class.php' );



defined( 'PROFESSIONALSERVICE_CLASS_VERSION' ) or define( 'PROFESSIONALSERVICE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class ProfessionalService=

    {*desc

        Original definition: "provider of professional services."The general
        ProfessionalService type for local businesses was deprecated due to
        confusion with Service. For reference, the types that it included were:
        Dentist, AccountingService, Attorney, Notary, as well as types for several
        kinds of HomeAndConstructionBusiness: Electrician, GeneralContractor,
        HousePainter, Locksmith, Plumber, RoofingContractor. LegalService was
        introduced as a more inclusive supertype of Attorney.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/ProfessionalService[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:28.
    *}

 */
/* ==================================================================================== */
class ProfessionalService extends LocalBusiness
/*-------------------------------------------*/
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
    public      $wikidataId                     = 'Q2029911';       /* {*property   $wikidataId                     (string)                        Wikidata ID. Services created by applying specialized 
                                                                                                                                                    abilities attained through experience and tertiary 
                                                                                                                                                    education. *} */


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
    }   /* End of ProfessionalService.__construct() =================================== */
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
    }   /* End of ProfessionalService.__destruct() ==================================== */
    /* ================================================================================ */
}   /* End of class ProfessionalService =============================================== */
/* ==================================================================================== */
?>