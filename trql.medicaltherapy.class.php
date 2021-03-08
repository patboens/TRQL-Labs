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
    {*file                  trql.medicaltherapy.class.php *}
    {*purpose               Any medical intervention designed to prevent, treat, and
                            cure human diseases and medical conditions, including both
                            curative and palliative therapies. Medical therapies are
                            typically processes of care relying upon pharmacotherapy,
                            behavioral therapy, supportive therapy (with fluid or
                            nutrition for example), or detoxification (e.g.
                            hemodialysis) aimed at improving or preventing a health
                            condition. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:49 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel �t� *}

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
        {*mdate 14-02-21 09:52 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\medicaltherapy;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\therapeuticprocedure\TherapeuticProcedure    as TherapeuticProcedure;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'THERAPEUTICPROCEDURE_CLASS_VERSION' ) )
    require_once( 'trql.therapeuticprocedure.class.php' );



defined( 'MEDICALTHERAPY_CLASS_VERSION' ) or define( 'MEDICALTHERAPY_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class MedicalTherapy=

    {*desc

        Any medical intervention designed to prevent, treat, and cure human
        diseases and medical conditions, including both curative and palliative
        therapies. Medical therapies are typically processes of care relying upon
        pharmacotherapy, behavioral therapy, supportive therapy (with fluid or
        nutrition for example), or detoxification (e.g. hemodialysis) aimed at
        improving or preventing a health condition.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/MedicalTherapy[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:49.
    *}

    *}}

 */
/* ==================================================================================== */
class MedicalTherapy extends TherapeuticProcedure
/*---------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $contraindication               = null;             /* {*property   $contraindication               (MedicalContraindication|string)A contraindication for this therapy. *} */
    public      $duplicateTherapy               = null;             /* {*property   $duplicateTherapy               (MedicalTherapy)                A therapy that duplicates or overlaps this one. *} */
    public      $seriousAdverseOutcome          = null;             /* {*property   $seriousAdverseOutcome          (MedicalEntity)                 A possible serious complication and/or serious side effect of this
                                                                                                                                                    therapy. Serious adverse outcomes include those that are
                                                                                                                                                    life-threatening; result in death, disability, or permanent damage;
                                                                                                                                                    require hospitalization or prolong existing hospitalization; cause
                                                                                                                                                    congenital anomalies or birth defects; or jeopardize the patient and
                                                                                                                                                    may require medical or surgical intervention to prevent one of the
                                                                                                                                                    outcomes in this definition. *} */

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
    }   /* End of MedicalTherapy.__construct() ======================================== */
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
    }   /* End of MedicalTherapy.__destruct() ========================================= */
    /* ================================================================================ */
}   /* End of class MedicalTherapy ==================================================== */
/* ==================================================================================== */
