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
    {*file                  trql.infectiousdisease.class.php *}
    {*purpose               An infectious disease is a clinically evident human disease
                            resulting from the presence of pathogenic microbial agents,
                            like pathogenic viruses, pathogenic bacteria, fungi,
                            protozoa, multicellular parasites, and prions. To be
                            considered an infectious disease, such pathogens are known
                            to be able to cause this disease. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:49 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:49 *}
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
namespace trql\infectiousdisease;

use \trql\vaesoli\Vaesoli                       as Vaesoli;
use \trql\medicalcondition\MedicalCondition     as MedicalCondition;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'MEDICALCONDITION_CLASS_VERSION' ) )
    require_once( 'trql.medicalcondition.class.php' );

defined( 'INFECTIOUSDISEASE_CLASS_VERSION' ) or define( 'INFECTIOUSDISEASE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class InfectiousDisease=

    {*desc

        An infectious disease is a clinically evident human disease resulting from
        the presence of pathogenic microbial agents, like pathogenic viruses,
        pathogenic bacteria, fungi, protozoa, multicellular parasites, and prions.
        To be considered an infectious disease, such pathogens are known to be able
        to cause this disease.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/InfectiousDisease[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:49.
    *}

    *}}
 */
/* ==================================================================================== */
class InfectiousDisease extends MedicalCondition
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

    public      $infectiousAgent                = null;             /* {*property   $infectiousAgent                (string)                        The actual infectious agent, such as a specific bacterium. *} */
    public      $infectiousAgentClass           = null;             /* {*property   $infectiousAgentClass           (InfectiousAgentClass)          The class of infectious agent (bacteria, prion, etc.) that causes the
                                                                                                                                                    disease. *} */
    public      $transmissionMethod             = null;             /* {*property   $transmissionMethod             (string)                        How the disease spreads, either as a route or vector, for example
                                                                                                                                                    'direct contact', 'Aedes aegypti', etc. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId     (string)                                        Wikidata ID. NOT CHECKED SO FAR *} */

    /* ================================================================================ */
    /** {{*__construct( [$szHome] )=

        Class constructor

        {*params
            $szHome     (string)        Home of the class. Optional.
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*keywords constructors, destructors *}

        {*seealso @fnc.__destruct *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szHome = null )
    /*-----------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        return ( $this );
    }   /* End of InfectiousDisease.__construct() ===================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return
        *}

        {*keywords constructors, destructors *}

        {*seealso @fnc.__construct *}

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
    }   /* End of InfectiousDisease.__destruct() ====================================== */
    /* ================================================================================ */
}   /* End of class InfectiousDisease ================================================= */
/* ==================================================================================== */
