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
    {*file                  trql.task.class.php *}
    {*purpose               Activity that needs to be accomplished within a defined
                            period of time. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 10-01-21 12:27 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 10-01-21 12:27 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\task;

use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\XML\XML               as XML;
use \trql\activity\Activity     as Activity;
use \trql\html\Form             as Form;
use \trql\html\Fieldset         as Fieldset;
use \trql\html\Formset          as Formset;
use \trql\html\Input            as Input;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'XML_CLASS_VERSION' ) )
    require_once( 'trql.xml.class.php' );

if ( ! defined( 'ACTIVITY_CLASS_VERSION' ) )
    require_once( 'trql.activity.class.php' );

if ( ! defined( 'FORM_CLASS_VERSION' ) )
    require_once( 'trql.form.class.php' );

if ( ! defined( 'FIELDSET_CLASS_VERSION' ) )
    require_once( 'trql.fieldset.class.php' );

if ( ! defined( 'FORMSET_CLASS_VERSION' ) )
    require_once( 'trql.formset.class.php' );

if ( ! defined( 'INPUT_CLASS_VERSION' ) )
    require_once( 'trql.input.class.php' );

defined( 'TASK_CLASS_VERSION' ) or define( 'TASK_CLASS_VERSION' ,'0.1' );

/* ==================================================================================== */
/** {{*class Task=

    {*desc

        Activity that needs to be accomplished within a defined period of time.

    *}

    *}}
 */
/* ==================================================================================== */
class Task extends Activity
/*-----------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)             Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId             = 'Q759676';                /* {*property   $wikidataId                     (string)            Activity that needs to be accomplished within a
                                                                                                                                        defined period of time *} */

    public      $szProgress             = null;                     /* {*property   $szProgress                     (string)            Free enumeration type (e.g. 'bubble', 'to-start', 'started', 'done', ...) *} */
    public      $szStorage              = null;
    public      $credits                = 0.0;                      /* {*property   $credits                        (float)             Number of credits required by this task (1 credit = 1 hour of undisturbed work) *} */
    public      $szClass                = null;                     /* {*property   $szClass                        (string)            CSS class of the task when it needs to be rendered *} */
    public      $dateCreated            = null;                     /* {*property   $dateCreated                    (Date|DateTime)     The date on which the task was created *} */
    public      $active                 = null;                     /* {*property   $active                         (bool)              Is the task active or not? *} */
    public      $attention              = false;                    /* {*property   $attention                      (bool)              Requires attention or not? *} */
    public      $late                   = false;                    /* {*property   $late                           (bool)              Late or not? *} */
    public      $szOnSubmit             = null;                     /* {*property   $szOnSubmit                     (string)            Submit clause of the form ([c]__toForm()[/c]) *} */


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

        {*seealso @fnc.__construct *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szHome = null )
    /*-----------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        return ( $this );
    }   /* End of Task.__construct() ================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*whoAmI()=

        Returns the name of the class

        {*params
        *}

        {*return
            (string)        The name of the class (with no namespace)
        *}

        *}}
    */
    /* ================================================================================ */
    public function whoAmI() : string
    /*-----------------------------*/
    {
        return ( $this->self['name'] );
    }   /* End of Task.whoAmI() ======================================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*identity()=

        Returns a brief HTML

        {*params
        *}

        {*return
            (string)        HTML Code corresponding to the current object. Used when 
                            rendering a task/user story in a @class.TaskBoard or 
                            @class.KanbanBoard.
        *}

        *}}
    */
    /* ================================================================================ */
    public function identity() : string
    /*-------------------------------*/
    {
        $szRetVal = '';

        $szRetVal = "<span class=\"identity\"><b class=\"name\">{$this->name}</b>: "                                .
            ( ! empty( $this->priority ) ? ( ' (<span class="priority">' . $this->priority . '</span>)' ) : '' )    .
            ( ! empty( $this->agent    ) ? ( ' (<span class="agent">'    . $this->agent    . '</span>)' ) : '' )    .
            " <span class=\"description\">{$this->description}</span>"                                              .
            ( $this->attention ? '<span class="attention" title="Attention!"></span>' : '' )                        .
            ( $this->late      ? '<span class="late" title="Late!"></span>'           : '' )                        .
            " <span class=\"credits\" title=\"Requires {$this->credits} credits\">{$this->credits}</span></span>";

        return ( $szRetVal );
    }   /* End of Task.identity() ===================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toXML()=

        Returns the Task in XML

        {*params
        *}

        {*return
            (string)        XML Code
        *}

        *}}
    */
    /* ================================================================================ */
    public function __toXML(): string
    /*-----------------------------*/
    {
        static $oXML = null;
        $szRetVal = null;


        if ( is_null( $oXML ) )
            $oXML = new XML();

        $oDom                       = new \DOMDocument( '1.0' );

        $oDom->preserveWhiteSpace   = true;
        $oDom->formatOutput         = true;

        if ( $oDom->loadXML( $oXML->__toXML( $this ) ) )
            $szRetVal = $oDom->saveXML();

        end:
        return ( $szRetVal );
    }   /* End of Task.__toXML() ====================================================== */
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
        $szRetVal = '';

        $oForm                      = new Form();
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
    }   /* End of Task.__toForm() ===================================================== */
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
    }   /* End of Task.__destruct() =================================================== */
    /* ================================================================================ */
}   /* End of class Task ============================================================== */
/* ==================================================================================== */
