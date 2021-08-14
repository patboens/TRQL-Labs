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
    {*file                  trql.flashreport.class.php *}
    {*purpose               Project Flash Report. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 29-07-21 09:05 *
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 29-07-21 09:05 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 04-08-21 07:25:12 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Modifications required for the Documentor
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\quitus;

use \trql\vaesoli\Vaesoli               as Vaesoli;
use \trql\schema\creativework\Report    as Report;
use \trql\quitus\RAG                    as RAG;
use \trql\html\Form                     as Form;
use \trql\html\Fieldset                 as Fieldset;
use \trql\html\Formset                  as Formset;
use \trql\html\Input                    as Input;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'REPORT_CLASS_VERSION' ) )
    require_once( 'trql.report.class.php' );

if ( ! defined( 'RAG_CLASS_VERSION' ) )
    require_once( 'trql.rag.class.php' );

if ( ! defined( 'FORM_CLASS_VERSION' ) )
    require_once( 'trql.form.class.php' );

if ( ! defined( 'FIELDSET_CLASS_VERSION' ) )
    require_once( 'trql.fieldset.class.php' );

if ( ! defined( 'FORMSET_CLASS_VERSION' ) )
    require_once( 'trql.formset.class.php' );

if ( ! defined( 'INPUT_CLASS_VERSION' ) )
    require_once( 'trql.input.class.php' );


defined( 'FLASHREPORT_CLASS_VERSION' ) or define( 'FLASHREPORT_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class FlashReport=

    {*desc

        A project Flash Report

    *}

    *}}
 */
/* ==================================================================================== */
class FlashReport extends Report
/*----------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)     Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $reportNumber                   = null;             /* {*property   $reportNumber           (string)            The number or other unique designator assigned to a Report by the
                                                                                                                                publishing organization. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q10870555';      /* {*property   $wikidataId             (string)            Wikidata ID. Informational, formal, and detailed text. *} */
    public      $RAG                            = null;             /* {*property   $RAG                    (RAG)               A Red-Amber-Green object made of sub-statuses (WikidataID - Q813912 - known as "condition") *} */
    public      $pastActions                    = null;
    public      $nextActions                    = null;
    public      $previousMilestone              = null;             /* {*property   $previousMilestone      (Milestone)         The previous attained milestone *} */
    public      $nextMilestone                  = null;             /* {*property   $nextMilestone          (Milestone)         The next milestone to attain *} */

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
        $this->classIcon = $this->self['icon'];

        $this->RAG = new RAG();

        return ( $this );
    }   /* End of FlashReport.__construct() =========================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toForm()=

        Returns the object as a form

        {*params
        *}

        {*return
            (string)        HTML Code corresponding to a form of the object
        *}

        *}}
    */
    /* ================================================================================ */
    public function __toForm(): string
    /*------------------------------*/
    {
        $oForm                      = new Form();

        $this->die( "The " . __METHOD__ . "() method is not ready yet. Head to line " . __LINE__ . " to start implementing it!" );

        $oForm->szClass             = $this->szClass;
        $oForm->szOnSubmit          = $this->szOnSubmit;


        //var_dump( $oForm );

        $oForm->settings['withBR']  = false;

        {   /* Create a fieldset and add the field set to the form */
            $oFieldset              = new Fieldset();
            $oFieldset->szCaption   = 'Task';

            {   /* Adding zones to the fieldset */
                $oFieldset->add( new Input( array( 'name'           =>  'ID'                                            ,
                                                   'type'           =>  'txt'                                           ,
                                                   'label'          =>  'ID'                                            ,
                                                   'lang'           =>  'en'                                            ,
                                                   'tooltip'        =>  'ID of the task. Leave it empty for a new task.',
                                                   'required'       =>  false                                           ,
                                                   'delete'         =>  true                                            ,
                                                   'help'           =>  false                                           ,
                                                   'value'          =>  $this->identifier                               ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Name'                                          ,
                                                   'type'           =>  'txt'                                           ,
                                                   'label'          =>  'Name'                                          ,
                                                   'lang'           =>  'en'                                            ,
                                                   'tooltip'        =>  'Enter a name for this task'                    ,
                                                   'required'       =>  true                                            ,
                                                   'delete'         =>  true                                            ,
                                                   'help'           =>  false                                           ,
                                                   'value'          =>  $this->name                                     ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Agent'                                         ,
                                                   'type'           =>  'txt'                                           ,
                                                   'label'          =>  'Assignee'                                      ,
                                                   'lang'           =>  'en'                                            ,
                                                   'tooltip'        =>  'Who this task is assigned to'                  ,
                                                   'required'       =>  false                                           ,
                                                   'delete'         =>  true                                            ,
                                                   'help'           =>  false                                           ,
                                                   'value'          =>  $this->agent                                    ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Type'                                          ,
                                                   'type'           =>  'cbo'                                           ,
                                                   'label'          =>  'Task type'                                     ,
                                                   'options'        =>  '<option value="change">Change</option><option value="defect">Defect</option>',
                                                   'lang'           =>  'en'                                            ,
                                                   'tooltip'        =>  'Enter the type of task'                        ,
                                                   'maxlength'      =>  3                                               ,
                                                   'required'       =>  false                                           ,
                                                   'delete'         =>  true                                            ,
                                                   'help'           =>  false                                           ,
                                                   'step'           =>  1                                               ,
                                                   'style'          =>  'max-width:11em;width:11em;min-width:11em;'     ,
                                                   'value'          =>  'change'                                        ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Priority'                                      ,
                                                   'type'           =>  'txt'                                           ,
                                                   'label'          =>  'Priority'                                      ,
                                                   'lang'           =>  'en'                                            ,
                                                   'tooltip'        =>  'Enter the priority of this task'               ,
                                                   'maxlength'      =>  3                                               ,
                                                   'required'       =>  true                                            ,
                                                   'delete'         =>  true                                            ,
                                                   'help'           =>  false                                           ,
                                                   'step'           =>  1                                               ,
                                                   'style'          =>  'max-width:5em;width:5em;min-width:5em;'        ,
                                                   'value'          =>  $this->priority                                 ,
                                                 ) ) );

                // Créé : commentaire JUSTE pour le UTF-8
                $oFieldset->add( new Input( array( 'name'           =>  'Credits'                                       ,
                                                   'type'           =>  'num'                                           ,
                                                   'label'          =>  'Credits'                                       ,
                                                   'lang'           =>  'en'                                            ,
                                                   'tooltip'        =>  'Credits of the task'                           ,
                                                   'required'       =>  false                                           ,
                                                   'delete'         =>  true                                            ,
                                                   'help'           =>  false                                           ,
                                                   'step'           =>  1                                               ,
                                                   'style'          =>  'max-width:5em;width:5em;min-width:5em;'        ,
                                                   'value'          =>  $this->credits                                  ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Due'                                           ,
                                                   'type'           =>  'dat'                                           ,
                                                   'label'          =>  'Due date'                                      ,
                                                   'lang'           =>  'en'                                            ,
                                                   'tooltip'        =>  'Date the task is due'                          ,
                                                   'required'       =>  false                                           ,
                                                   'help'           =>  false                                           ,
                                                   'style'          =>  'max-width:11em;width:11em;min-width:11em;'     ,
                                                   'value'          =>  ''                                              ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Description'                               ,
                                                   'type'           =>  'edt'                                       ,
                                                   'label'          =>  'Description'                               ,
                                                   'lang'           =>  'en'                                        ,
                                                   'tooltip'        =>  'Enter a name for this task'                ,
                                                   'required'       =>  true                                        ,
                                                   'delete'         =>  true                                        ,
                                                   'help'           =>  false                                       ,
                                                   'rows'           =>  8                                           ,
                                                   'style'          =>  'resize:vertical;'                          ,
                                                   'value'          =>  trim( $this->description )                  ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Late'                                      ,
                                                   'type'           =>  'chk'                                       ,
                                                   'label'          =>  'Late'                                      ,
                                                   'lang'           =>  'en'                                        ,
                                                   'tooltip'        =>  'Is this task late?'                        ,
                                                   'required'       =>  false                                       ,
                                                   'style'          =>  'max-width:3em;width:3em;min-width:3em;'    ,
                                                   'value'          =>  false                                       ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Attention'                                 ,
                                                   'type'           =>  'chk'                                       ,
                                                   'label'          =>  'Attention'                                 ,
                                                   'lang'           =>  'en'                                        ,
                                                   'tooltip'        =>  'Requires attention?'                       ,
                                                   'required'       =>  false                                       ,
                                                   'style'          =>  'max-width:3em;width:3em;min-width:3em;'    ,
                                                   'value'          =>  false                                       ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Submit'                                    ,
                                                   'type'           =>  'cmd'                                       ,
                                                   'class'          =>  'shadow'                                    ,
                                                   'lang'           =>  'en'                                        ,
                                                   'tooltip'        =>  'Click to submit the values of a new task'  ,
                                                   'value'          =>  'Create'                                    ,
                                                 ) ) );
            }   /* Adding zones to the fieldset */

            $oForm->add( $oFieldset );

        }   /* Create a fieldset and add the field set to the form */

        //var_dump( $oForm );

        return ( (string) $oForm );
    }   /* End of FlashReport.__toForm() ============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return.
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
    }   /* End of FlashReport.__destruct() ============================================ */
    /* ================================================================================ */
}   /* End of class FlashReport ======================================================= */
/* ==================================================================================== */
