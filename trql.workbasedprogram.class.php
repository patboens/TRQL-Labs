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
    {*file                  trql.workbasedprogram.class.php *}
    {*purpose               A program with both an educational and employment component.
                            Typically based at a workplace and structured around
                            work-based learning, with the aim of instilling competencies
                            related to an occupation. WorkBasedProgram is used to
                            distinguish programs such as apprenticeships from school,
                            college or other classroom based educational programs. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 28-08-2020 16:43 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 28-08-2020 16:43 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\workbasedprogram;

use \trql\vaesoli\Vaesoli                                                   as Vaesoli;
use \trql\educationaloccupationalprogram\EducationalOccupationalProgram     as EducationalOccupationalProgram;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'EDUCATIONALOCCUPATIONALPROGRAM_CLASS_VERSION' ) )
    require_once( 'trql.educationaloccupationalprogram.class.php' );

defined( 'WORKBASEDPROGRAM_CLASS_VERSION' ) or define( 'WORKBASEDPROGRAM_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class WorkBasedProgram=

    {*desc

        A program with both an educational and employment component. Typically
        based at a workplace and structured around work-based learning, with the
        aim of instilling competencies related to an occupation. WorkBasedProgram
        is used to distinguish programs such as apprenticeships from school,
        college or other classroom based educational programs.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/WorkBasedProgram[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 28-08-2020 16:43.
    *}

    *}}
 */
/* ==================================================================================== */
class WorkBasedProgram extends EducationalOccupationalProgram
/*---------------------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $occupationalCategory           = null;             /* {*property   $occupationalCategory           (CategoryCode|string)           A category describing the job, preferably using a term from a taxonomy
                                                                                                                                                    such as BLS O*NET-SOC, ISCO-08 or similar, with the property repeated
                                                                                                                                                    for each applicable value. Ideally the taxonomy should be identified,
                                                                                                                                                    and both the textual label and formal code for the category should be
                                                                                                                                                    provided.Note: for historical reasons, any textual label and formal
                                                                                                                                                    code provided as a literal may be assumed to be from O*NET-SOC. *} */
    public      $trainingSalary                 = null;             /* {*property   $trainingSalary                 (MonetaryAmountDistribution)    The estimated salary earned while in the program. *} */


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
    }   /* End of WorkBasedProgram.__construct() ====================================== */
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
    }   /* End of WorkBasedProgram.__destruct() ======================================= */
    /* ================================================================================ */
}   /* End of class WorkBasedProgram ================================================== */
/* ==================================================================================== */
