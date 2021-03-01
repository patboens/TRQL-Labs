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
    {*file                  trql.covidtestingfacility.class.php *}
    {*purpose               A CovidTestingFacility is a MedicalClinic where testing for
                            the COVID-19 Coronavirus disease is available. If the
                            facility is being made available from an established
                            Pharmacy, Hotel, or other non-medical organization, multiple
                            types can be listed. This makes it easier to re-use existing
                            schema.org information about that place e.g. contact info,
                            address, opening hours. Note that in an emergency, such
                            information may not always be reliable. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:46 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

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


    {*chist
        {*mdate 14-02-21 10:44 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */

/****************************************************************************************/
namespace trql\covidtestingfacility;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\medicalclinic\MedicalClinic   as MedicalClinic;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'MEDICALCLINIC_CLASS_VERSION' ) )
    require_once( 'trql.medicalclinic.class.php' );

defined( 'COVIDTESTINGFACILITY_CLASS_VERSION' ) or define( 'COVIDTESTINGFACILITY_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class CovidTestingFacility=

    {*desc

        A CovidTestingFacility is a MedicalClinic where testing for the COVID-19
        Coronavirus disease is available. If the facility is being made available
        from an established Pharmacy, Hotel, or other non-medical organization,
        multiple types can be listed. This makes it easier to re-use existing
        schema.org information about that place e.g. contact info, address, opening
        hours. Note that in an emergency, such information may not always be
        reliable.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/CovidTestingFacility[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:46.
    *}

 */
/* ==================================================================================== */
class CovidTestingFacility extends MedicalClinic
/*--------------------------------------*/
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
    public      $wikidataId                     = null;             /* {*property   $wikidataId                 (string)                            Wikidata ID: No equivalent *} */


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
    }   /* End of CovidTestingFacility.__construct() ================================== */
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
    }   /* End of CovidTestingFacility.__destruct() =================================== */
    /* ================================================================================ */
}   /* End of class CovidTestingFacility ============================================== */
/* ==================================================================================== */
?>