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
    {*file                  trql.exerciseaction.class.php *}
    {*purpose               The act of participating in exertive activity for the
                            purposes of improving health and fitness. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:46 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}
    {*keywords              action *}

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
namespace trql\exerciseaction;

use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\playaction\PlayAction as PlayAction;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'PLAYACTION_CLASS_VERSION' ) )
    require_once( 'trql.playaction.class.php' );

defined( 'EXERCISEACTION_CLASS_VERSION' ) or define( 'EXERCISEACTION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class ExerciseAction=

    {*desc

        The act of participating in exertive activity for the purposes of improving
        health and fitness.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/ExerciseAction[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:46.
    *}

 */
/* ==================================================================================== */
class ExerciseAction extends PlayAction
/*-----------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $diet                           = null;             /* {*property   $diet                           (Diet)                          A sub property of instrument. The diet used in this action. *} */
    public      $distance                       = null;             /* {*property   $distance                       (Distance)                      The distance travelled, e.g. exercising or travelling. *} */
    public      $endTime                        = null;             /* {*property   $endTime                        (DateTime|Time)                 The endTime of something. For a reserved event or service (e.g.
                                                                                                                                                    FoodEstablishmentReservation), the time that it is expected to end.
                                                                                                                                                    For actions that span a period of time, when the action was performed.
                                                                                                                                                    e.g. John wrote a book from January to December. For media, including
                                                                                                                                                    audio and video, it's the time offset of the end of a clip within a
                                                                                                                                                    larger file.Note that Event uses startDate/endDate instead of
                                                                                                                                                    startTime/endTime, even when describing dates with times. This
                                                                                                                                                    situation may be clarified in future revisions. *} */
    public      $exerciseCourse                 = null;             /* {*property   $exerciseCourse                 (Place)                         A sub property of location. The course where this action was taken. *} */
    public      $exercisePlan                   = null;             /* {*property   $exercisePlan                   (ExercisePlan)                  A sub property of instrument. The exercise plan used on this action. *} */
    public      $exerciseRelatedDiet            = null;             /* {*property   $exerciseRelatedDiet            (Diet)                          A sub property of instrument. The diet used in this action. *} */
    public      $exerciseType                   = null;             /* {*property   $exerciseType                   (string)                        Type(s) of exercise or activity, such as strength training,
                                                                                                                                                    flexibility training, aerobics, cardiac rehabilitation, etc. *} */
    public      $fromLocation                   = null;             /* {*property   $fromLocation                   (Place)                         A sub property of location. The original location of the object or the
                                                                                                                                                    agent before the action. *} */
    public      $opponent                       = null;             /* {*property   $opponent                       (Person)                        A sub property of participant. The opponent on this action. *} */
    public      $participant                    = null;             /* {*property   $participant                    (Organization|Person)           Other co-agents that participated in the action indirectly. e.g. John
                                                                                                                                                    wrote a book with Steve. *} */
    public      $sportsActivityLocation         = null;             /* {*property   $sportsActivityLocation         (SportsActivityLocation)        A sub property of location. The sports activity location where this
                                                                                                                                                    action occurred. *} */
    public      $sportsEvent                    = null;             /* {*property   $sportsEvent                    (SportsEvent)                   A sub property of location. The sports event where this action
                                                                                                                                                    occurred. *} */
    public      $sportsTeam                     = null;             /* {*property   $sportsTeam                     (SportsTeam)                    A sub property of participant. The sports team that participated on
                                                                                                                                                    this action. *} */
    public      $toLocation                     = null;             /* {*property   $toLocation                     (Place)                         A sub property of location. The final location of the object or the
                                                                                                                                                    agent after the action. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                        Wikidata ID. NOT CHECKED SO FAR *} */


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
    }   /* End of ExerciseAction.__construct() ======================================== */
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
    }   /* End of ExerciseAction.__destruct() ========================================= */
    /* ================================================================================ */
}   /* End of class ExerciseAction ==================================================== */
/* ==================================================================================== */
?>