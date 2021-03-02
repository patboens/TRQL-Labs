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
    {*file                  trql.exerciseplan.class.php *}
    {*purpose               Fitness-related activity designed for a specific
                            health-related purpose, including defined exercise routines
                            as well as activity prescribed by a clinician. *}
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
namespace trql\exerciseplan;

use \trql\vaesoli\Vaesoli                       as Vaesoli;
use \trql\physicalactivity\PhysicalActivity     as PhysicalActivity;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'PHYSICALACTIVITY_CLASS_VERSION' ) )
    require_once( 'trql.physicalactivity.class.php' );

defined( 'EXERCISEPLAN_CLASS_VERSION' ) or define( 'EXERCISEPLAN_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class ExercisePlan=

    {*desc

        Fitness-related activity designed for a specific health-related purpose,
        including defined exercise routines as well as activity prescribed by a
        clinician.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/ExercisePlan[/url] *}

    {*warning
        This class has been generated automatically by 
        [c]trql.schemaclassgenerator.class.php[/c] on 26-08-2020 18:46.
    *}

 */
/* ==================================================================================== */
class ExercisePlan extends PhysicalActivity
/*---------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $activityDuration               = null;             /* {*property   $activityDuration               (Duration|QuantitativeValue)    Length of time to engage in the activity. *} */
    public      $activityFrequency              = null;             /* {*property   $activityFrequency              (string|QuantitativeValue)      How often one should engage in the activity. *} */
    public      $additionalVariable             = null;             /* {*property   $additionalVariable             (string)                        Any additional component of the exercise prescription that may need to
                                                                                                                                                    be articulated to the patient. This may include the order of
                                                                                                                                                    exercises, the number of repetitions of movement, quantitative
                                                                                                                                                    distance, progressions over time, etc. *} */
    public      $exerciseType                   = null;             /* {*property   $exerciseType                   (string)                        Type(s) of exercise or activity, such as strength training,
                                                                                                                                                    flexibility training, aerobics, cardiac rehabilitation, etc. *} */
    public      $intensity                      = null;             /* {*property   $intensity                      (QuantitativeValue|string)      Quantitative measure gauging the degree of force involved in the
                                                                                                                                                    exercise, for example, heartbeats per minute. May include the velocity
                                                                                                                                                    of the movement. *} */
    public      $repetitions                    = null;             /* {*property   $repetitions                    (QuantitativeValue|float)       Number of times one should repeat the activity. *} */
    public      $restPeriods                    = null;             /* {*property   $restPeriods                    (string|QuantitativeValue)      How often one should break from the activity. *} */
    public      $workload                       = null;             /* {*property   $workload                       (Energy|QuantitativeValue)      Quantitative measure of the physiologic output of the exercise; also
                                                                                                                                                    referred to as energy expenditure. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                        Wikidata ID. Wikidata ID. No equivalent. *} */


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
    }   /* End of ExercisePlan.__construct() ========================================== */
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
    }   /* End of ExercisePlan.__destruct() =========================================== */
    /* ================================================================================ */
}   /* End of class ExercisePlan ====================================================== */
/* ==================================================================================== */
?>