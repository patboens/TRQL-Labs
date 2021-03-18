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
    {*file                  trql.form.class.php *}
    {*purpose               Document with blank spaces/fields for insertion of required
                            or requested information. A device for collecting data. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 25-12-20 12:51 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 25-12-20 12:51 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\html;

use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\html\Input            as Input;
use \trql\html\Tag              as Tag;
use \trql\XML\XML               as XML;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'INPUT_CLASS_VERSION' ) )
    require_once( 'trql.input.class.php' );

if ( ! defined( 'TAG_CLASS_VERSION' ) )
    require_once( 'trql.tag.class.php' );

if ( ! defined( 'XML_CLASS_VERSION' ) )
    require_once( 'trql.xml.class.php' );

defined( 'FORM_CLASS_VERSION' ) or define( 'FORM_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Form=

    {*desc

        Document with blank spaces/fields for insertion of required or requested
        information. A device for collecting data.

    *}

    {*remark

        29-12-20 12:52:45: most of the implementation comes from
        D:\websites\vaesoli.org\www\httpdocs\vaesoli\include\LSForm.class.php

    *}

    *}}
 */
/* ==================================================================================== */
class Form extends Tag
/*------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self               (array)         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q1335296';       /* {*property   $wikidataId         (string)        Wikidata ID. Document with blank spaces/fields
                                                                                                                        for insertion of required or requested information.
                                                                                                                        A device for collecting data.*} */
    public      $aItems                         = null;             /* {*property   $aItems             (array)         Array of elements composing the form *} */
    protected   $aAccepted                      = null;             /* {*property   $aAccepted          (array)         Array of inner tags that are accepted in a form *} */
    public      $szLang                         = 'fr';             /* {*property   $szLang             (string)        Language of the form *} */

    public      $settings                       = array( 'method'               => 'post'           ,
                                                         'action'               => ''               ,
                                                         'tabindex'             => 1                ,
                                                         'withTabindex'         => true             ,
                                                         'mode'                 => 'add'            ,
                                                         'type'                 => 'form'           ,
                                                         'version'              => 'Web form 1.0'   ,
                                                         'foreword'             => null             ,
                                                         'afterword'            => null             ,
                                                         'dataEnvironment'      => null             ,
                                                         'noECMA'               => false            ,
                                                         'aECMA'                => array()          ,
                                                         'withPreviousValues'   => false            ,
                                                         'preRenderFnc'         => null             ,
                                                         'postRenderFnc'        => null             ,
                                                         'noValidate'           => false            ,
                                                         'target'               => null             ,
                                                         'autocomplete'         => null             ,
                                                         'page'                 => null             ,
                                                         'hasFile'              => false            ,
                                                         'withBR'               => true             ,
                                                       );
                                                                    /* {*property   $settings           (array)         Associative array with ALL settings used in the form:[br]

                                                                                                                        - [c]method[/c]             (string)            : HTTP method to be invoked to submit the form[br]
                                                                                                                        - [c]action[/c]             (string)            : Action fo the form (usually a URL or [c]self[/c] to
                                                                                                                                                                          submit the form to the current script)[br]
                                                                                                                        - [c]tabindex[/c]           (int)               : [c]tabindex[/c] in the form (use the [c]$iTabIndex[/c]
                                                                                                                                                                          property of the current page ([doc]LSPage[/doc]) to hold
                                                                                                                                                                          a precise count between forms)[br]
                                                                                                                        - [c]withTabindex[/c]       (bool)              : Determines whether tabindex must be used or not.
                                                                                                                                                                          [c]true[/c] by default[br]
                                                                                                                        - [c]mode[/c]               (string)            : Mode the form is entered. Can be [c]'edit'[/c]
                                                                                                                                                                          (modification of an existing record) or [c]'add'[/c]
                                                                                                                                                                          (add a new record). [c]'add'[/c] by default[br]
                                                                                                                        - [c]type[/c]               (string)            : Container type. [c]'form'[/c] by default[br]
                                                                                                                        - [c]version[/c]            (string)            : Form version. [c]'Web form 1.0'[/c] by default.
                                                                                                                                                                          Set to [c]'Web form 2.0'[/c] to benefit from
                                                                                                                                                                          HTML5 controls[br]
                                                                                                                        - [c]foreword[/c]           (string)            : Text that must precede the rendering of the form[br]
                                                                                                                        - [c]afterword[/c]          (string)            : Text that must follow the rendering of the form[br]
                                                                                                                        - [c]dataEnvironment[/c]    (DataEnvironment)   : A [doc]DataEnvironment[/doc] object. Warning: not
                                                                                                                                                                          really used at this stage (04-09-13 07:46)[br]
                                                                                                                        - [c]noECMA[/c]             (bool)              : Indicates whether we need to have the ECMA scripts
                                                                                                                                                                          be generated.[c]false[/c] by default
                                                                                                                                                                          (= ECMA scripts generated)[br]
                                                                                                                        - [c]aECMA[/c]              (array)             : Internal array of scripts to be generated by Vae Soli!
                                                                                                                                                                          for entry checks and form validation[br]
                                                                                                                        - [c]withPreviousValues[/c] (bool)              : Indicates if previous control values must be saved
                                                                                                                                                                          in the form [br]
                                                                                                                        - [c]preRenderFnc[/c]       (string)            : Callback to play before rendering of the form[br]
                                                                                                                        - [c]postRenderFnc[/c]      (string)            : Callback to play after rendering of the form[br]
                                                                                                                        - [c]noValidate[/c]         (bool)              : novalidate attribute of the form (HTML5)[br]
                                                                                                                        - [c]target[/c]             (string)            : Enumerated type (_blank, _self, _parent, _top).
                                                                                                                                                                          Specifies where to display the response that is
                                                                                                                                                                          received after submitting the form[br]
                                                                                                                        - [c]autocomplete[/c]       (string)            : Enumerated type (on, off). The off state indicates
                                                                                                                                                                          that by default, form controls in the form will have
                                                                                                                                                                          their resulting autocompletion state set to off; the
                                                                                                                                                                          on state indicates that by default, form controls in
                                                                                                                                                                          the form will have their resulting autocompletion
                                                                                                                                                                          state set to automatic.[br]
                                                                                                                        - [c]page[/c]               (WebPage)           : The page in which this form must be rendered.
                                                                                                                                                                          [c]null[/c] by default[br]
                                                                                                                        - [c]hasFile[/c]            (boolean)           : Indicates whether the form is supposed to handle
                                                                                                                                                                          files (can be set manually; otherwise, it is treated
                                                                                                                                                                          automatically by examining all controls) [br]
                                                                                                                        *} */

    public      $szOnSubmit                     = null;             /* {*property   $szOnSubmit         (string)        Submit clause of the form *} */

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

        {*example
        |** The example shows how to create a form made of 1 fieldset
           that contains a number of input zones **|

        use \trql\vaesoli\Vaesoli       as V;
        use \trql\html\Form             as Form;
        use \trql\html\Fieldset         as Fieldset;
        use \trql\html\Input            as Input;

        if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
            require_once( 'trql.vaesoli.class.php' );

        if ( ! defined( 'FORM_CLASS_VERSION' ) )
            require_once( 'trql.form.class.php' );

        if ( ! defined( 'FIELDSET_CLASS_VERSION' ) )
            require_once( 'trql.fieldset.class.php' );

        if ( ! defined( 'INPUT_CLASS_VERSION' ) )
            require_once( 'trql.input.class.php' );

        [b]$oForm                      = new Form();
        $oForm->szClass             = 'quitus shadow;   |** CSS class **|

        $oForm->settings['withBR']  = false;            |** No line break after each zone **|
        $oForm->settings['action']  = '/tasks/';        |** Action of the form **|
        $oForm->settings['method']  = 'GET';            |** Method of the form **|


        {   |** Create a fieldset and add the fieldset to the form **|
            $oFieldset              = new Fieldset();
            $oFieldset->szCaption   = 'Task';

            {   |** Adding input zones to the fieldset **|
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
                                                   'options'        =>  '&lt;option value=&quot;change&quot;&gt;Change&lt;/option&gt;&lt;option value=&quot;defect&quot;&gt;Defect&lt;/option&gt;',
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

                $oFieldset->add( new Input( array( 'name'           =>  'Description'                                   ,
                                                   'type'           =>  'edt'                                           ,
                                                   'label'          =>  'Description'                                   ,
                                                   'lang'           =>  'en'                                            ,
                                                   'tooltip'        =>  'Enter a name for this task'                    ,
                                                   'required'       =>  true                                            ,
                                                   'delete'         =>  true                                            ,
                                                   'help'           =>  false                                           ,
                                                   'rows'           =>  8                                               ,
                                                   'style'          =>  'resize:vertical;'                              ,
                                                   'value'          =>  trim( $this->description )                      ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Late'                                          ,
                                                   'type'           =>  'chk'                                           ,
                                                   'label'          =>  'Late'                                          ,
                                                   'lang'           =>  'en'                                            ,
                                                   'tooltip'        =>  'Is this task late?'                            ,
                                                   'required'       =>  false                                           ,
                                                   'style'          =>  'max-width:3em;width:3em;min-width:3em;'        ,
                                                   'value'          =>  false                                           ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Attention'                                     ,
                                                   'type'           =>  'chk'                                           ,
                                                   'label'          =>  'Attention'                                     ,
                                                   'lang'           =>  'en'                                            ,
                                                   'tooltip'        =>  'Requires attention?'                           ,
                                                   'required'       =>  false                                           ,
                                                   'style'          =>  'max-width:3em;width:3em;min-width:3em;'        ,
                                                   'value'          =>  false                                           ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Submit'                                        ,
                                                   'type'           =>  'cmd'                                           ,
                                                   'class'          =>  'shadow'                                        ,
                                                   'lang'           =>  'en'                                            ,
                                                   'tooltip'        =>  'Click to submit the values of a new task'      ,
                                                   'value'          =>  'Create'                                        ,
                                                 ) ) );
            }   |** Adding zones to the fieldset **|

            $oForm->add( $oFieldset );
        }   |** Create a fieldset and add the fieldset to the form **|

        echo (string) $oForm;[/b]

        *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szHome = null )
    /*-----------------------------------------*/
    {
        parent::__construct();

        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        $this->aAccepted['button'  ] =
        $this->aAccepted['div'     ] =
        $this->aAccepted['fieldset'] =
        $this->aAccepted['input'   ] =
        $this->aAccepted['label'   ] =
        $this->aAccepted['ol'      ] =
        $this->aAccepted['p'       ] =
        $this->aAccepted['select'  ] =
        $this->aAccepted['textarea'] =
        $this->aAccepted['ul'      ] = true;

        return ( $this );
    }   /* End of Form.__construct() ================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*add( $oItem )=

        Adds an item to the form

        {*params
            $oItem          (object)        An instance of a "Tag"
        *}

        {*return
            (boolean)       [c]true[/c] if $oItem successfully added to the form;
                            [c]false[/c] otherwise.
        *}

        *}}
    */
    /* ================================================================================ */
    public function add( $oItem )
    /*-------------------------*/
    {
        $bRetVal = false;

        /* Si c'est un tag comme on les supporte */
        if ( $oItem instanceof Tag )
        {
            /* Et si c'est un tag d'un type qu'on peut accepter */
            if ( isset( $this->aAccepted[ $oItem->szType ] ) )
            {
                /*
                    $this->aItems[] = array( "class" => get_class( $oItem ) ,
                                             "item"  => $oItem              ,
                                           );
                */
                $this->aItems[] = $oItem;

                $bRetVal = true;
            }   /* if ( isset( $this->aAccepted[ $oItem->szType ] ) ) */
            else
            {
                // Throw exception
                var_dump( "Item NOT accepted" );
            }
        }   /* if ( $oItem instanceof Tag ) */
        else
        {
            var_dump( "Item NOT a Tag",$oItem );
        }

        return ( $bRetVal );
    }   /* End of Form.add() ========================================================== */
    /* ================================================================================ */


    // On reçoit une longue chaîne comme ...
    // {"controlAction":"/","controlType":"form","controlName":"frmForm","controlId":"frmForm","controlLang":"fr","controlMethod":"get"}{"controlType":"date","controlLabel":"Date de naissance","controlLang":"fr","controlClass":"quitus","controlId":"Birthdate","controlName":"Birthdate"}{"controlType":"editbox","controlLang":"fr","controlLabel":"Adresse","controlId":"Address","controlName":"Address","controlClass":"quitus"}
    // et on parse cela en:
    // array (size=6)
    //   'controlAction' => string '/' (length=1)
    //   'controlType' => string 'form' (length=4)
    //   'controlName' => string 'frmForm' (length=7)
    //   'controlId' => string 'frmForm' (length=7)
    //   'controlLang' => string 'fr' (length=2)
    //   'controlMethod' => string 'get' (length=3)
    //
    // array (size=6)
    //   'controlType' => string 'date' (length=4)
    //   'controlLabel' => string 'Date de naissance' (length=17)
    //   'controlLang' => string 'fr' (length=2)
    //   'controlClass' => string 'quitus' (length=6)
    //   'controlId' => string 'Birthdate' (length=9)
    //   'controlName' => string 'Birthdate' (length=9)
    //
    // array (size=6)
    //   'controlType' => string 'editbox' (length=7)
    //   'controlLang' => string 'fr' (length=2)
    //   'controlLabel' => string 'Adresse' (length=7)
    //   'controlId' => string 'Address' (length=7)
    //   'controlName' => string 'Address' (length=7)
    //   'controlClass' => string 'quitus' (length=6)

    public function parse( $szPseudoJSON,$bAppend = false )
    /*---------------------------------------------------*/
    {
        $bRetVal = false;

        if (  preg_match_all('/\{(.*?)\}/si',$szPseudoJSON,$aMatches,PREG_PATTERN_ORDER ) )
        {
            $bRetVal    = true;
            $aMatches   = $aMatches[0];

            foreach( $aMatches as $szDef )
            {
                //echo "<p>",$szDef,"</p>\n";

                if ( preg_match_all( '/"(.*?)":"(.*?)",?/si',$szDef,$aParts,PREG_PATTERN_ORDER ) )
                {
                    $aProperties = $this->mix( $aParts[1],$aParts[2]);

                    // $aProperties look like this ...
                    // array (size=6)
                    //   'controlType' => string 'editbox' (length=7)
                    //   'controlLang' => string 'fr' (length=2)
                    //   'controlLabel' => string 'Adresse' (length=7)
                    //   'controlId' => string 'Address' (length=7)
                    //   'controlName' => string 'Address' (length=7)
                    //   'controlClass' => string 'quitus' (length=6)

                    if ( $aProperties['controlType'] === 'form' )
                    {
                        // 'controlAction' => string '/' (length=1)
                        // 'controlType' => string 'form' (length=4)
                        // 'controlName' => string 'frmForm' (length=7)
                        // 'controlId' => string 'frmForm' (length=7)
                        // 'controlLang' => string 'fr' (length=2)
                        // 'controlMethod' => string 'get' (length=3)
                        // Do something for the form

                        $this->description                  = $aProperties['controlDescription'     ] ?? '';
                        $this->comment                      = $aProperties['controlComment'         ] ?? '';
                        $this->identifier                   = $aProperties['controlId'              ] ?? '';
                        $this->szClass                      = $aProperties['controlClass'           ] ?? '';
                        $this->settings['target']           = $aProperties['controlTarget'          ] ?? '';
                        $this->settings['action']           = $aProperties['controlAction'          ] ?? '';
                        $this->settings['method']           = $aProperties['controlMethod'          ] ?? '';
                        $this->szLang                       = $aProperties['controlLang'            ] ?? '';
                        $this->settings['dataEnvironment']  = $aProperties['controlDataenvironment' ] ?? '';
                    }
                    else
                    {
                        if ( $oInput = $this->makeInput( $aProperties ) )
                        {
                            $this->add( $oInput );
                            // Alors, si j'ai un Input valable, je dois l'ajouter à CE formulaire!!!
                            //var_dump( $oInput->aParams );
                        }
                        else
                        {
                            //var_dump( $aProperties );
                        }
                    }
                }   /* if ( preg_match_all( '/"(.*?)":"(.*?)",?/si',$szDef,$aParts,PREG_PATTERN_ORDER ) ) */
            }   /* foreach( $aMatches as $szDef ) */
        }   /* if (  preg_match_all('/\{(.*?)\}/si',$szPseudoJSON,$aMatches,PREG_PATTERN_ORDER ) ) */

        //var_dump( $this->aItems );
        //die();

        return ( $bRetVal );
    }   /* End of Form.parse() ======================================================== */
    /* ================================================================================ */


    protected function mix( $aKeys,$aValues )
    /*-------------------------------------*/
    {
        for ( $i=0; $i < count( $aKeys );$i++ )
            $aRetVal[ $aKeys[$i] ] = $aValues[$i];

        return ( $aRetVal );
    }   /* End of Form.mix() ========================================================== */
    /* ================================================================================ */


    // Depuis des propriétés telles que passées par le formbuilder
    // faire un Input
    protected function makeInput( $aProperties )
    /*----------------------------------------*/
    {
        $oInput = null;

        //   'controlType' => string 'editbox' (length=7)
        //   'controlId' => string 'Address' (length=7)
        //   'controlClass' => string 'quitus' (length=6)

        switch ( $aProperties['controlType'] ?? null )
        {
            case 'textbox'  :
                    $szType = 'txt';
                    break;
            case 'editbox'  :
                    $szType = 'edt';
                    break;
            case 'date'     :
                    $szType = 'dat';
                    break;
            case 'file'     :
                    $szType = 'fil';
                    break;
            default         :
                var_dump( $aProperties['controlType'] . ' NOT handled yet' );
                $szType = null;
        }

        if ( $szType )
        {
            $oInput = new Input( array( 'name'          =>  $aProperties['controlName'      ] ?? 'Name' ,
                                        'type'          =>  $szType                                     ,
                                        'label'         =>  $aProperties['controlLabel'     ] ?? 'Label',
                                        'lang'          =>  $aProperties['controlLang'      ] ?? 'en'   ,
                                        'tooltip'       =>  $aProperties['controlTooltip'   ] ?? null   ,
                                        'required'      =>  false                                       ,
                                        'maxlength'     =>  150                                         ,
                                        'delete'        =>  true                                        ,
                                        'help'          =>  true                                        ,
                                        'value'         =>  $aProperties['controlValue'     ] ?? ''     ,
                                      ) );
        }

        return ( $oInput );
    }   /* End of Form.makeInput() ==================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*render( [$szType] )=

        Renders the form

        {*params
            $szType         (string)        Output type. Optional. 'HTML' by default.
        *}

        {*return
            (string)        HTML Code
        *}

        {*warning

        *}

        *}}
    */
    /* ================================================================================ */
    public function render( $szType = 'html' ): string
    /*----------------------------------------------*/
    {
        $szRetVal = '';

        switch( strtolower( trim( $szType ) ) )
        {
            case 'xml'  :   $szRetVal = $this->__toXML();
                            break;
            case 'html' :
            default     :   $szRetVal = $this->__toHTML();
        }   /* switch( strtolower( trim( $szType ) ) ) */

        end:
        return ( $szRetVal );
    }   /* End of Form.render() ======================================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*save( $szFile )=

        Saves the form to $szFile

        {*params
            $szFile         (string)        The file the form must be saved to.
        *}

        {*return
            (boolean)       [c]true[/c] if the form was successfully saved; [c]false[/c]
                            if not.
        *}

        {*warning

            Totalement expérimental ! Bien que la modification manuelle soit possible
            directement dans le fichier sauvé, je trouve qu'il y a trop de propriétés
            qui sont dépendantes de mes classes. Le format de sortie n'est donc pas
            suffisamment neutre. Il ne faudrait sauver que quelques propriétés du
            formulaire dont aItems. Par la suite, nous récupérons juste les données
            dont nous avons besoin et on reconstitue le formulaire.

        *}

        *}}
    */
    /* ================================================================================ */
    function save( $szFile )
    /*--------------------*/
    {
        $bRetVal = false;

        $szXML  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $szXML .= "<Form id=\"{$this->identifier}\" version=\"1.0\">\n\n";
        $szXML .= "    <Description><![CDATA[{$this->description}]]></Description>\n";
        $szXML .= "    <Comment><![CDATA[{$this->comment}]]></Comment>\n";
        $szXML .= "    <Keywords><![CDATA[{$this->keywords}]]></Keywords>\n";
        $szXML .= "    <Settings><![CDATA[" . json_encode( $this->settings ) . "]]></Settings>\n\n";

        $szXML .= "    <Items>\n";

        foreach( $this->aItems as $oItem )
        {
            $szXML .= "        <Item><![CDATA[" . json_encode( $oItem ) . "]]></Item>\n\n";
        }

        $szXML .= "    </Items>\n";

        $szXML .= "</Form>\n";


        if ( $fp = fopen( $szFile,"w+" ) )
        {
            $bRetVal = is_int( fwrite( $fp,$szXML ) );
            fclose( $fp );
        }   /* if ( $fp = fopen( $szFile,"w+" ) ) */

        return ( $bRetVal );
    }   /* End of Form.save() ========================================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*get( $szFile )=

        Gets a form as saved in $szFile

        {*params
            $szFile         (string)        The file that contains the definition of the
                                            form .
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*warning

            Totalement expérimental ! Bien que la modification manuelle soit possible
            directement dans le fichier sauvé, je trouve qu'il y a trop de propriétés
            qui sont dépendantes de mes classes. Le format de sortie n'est donc pas
            suffisamment neutre. Il ne faudrait sauver que quelques propriétés du
            formulaire dont aItems. Par la suite, nous récupérons juste les données
            dont nous avons besoin et on reconstitue le formulaire.

        *}

        *}}
    */
    /* ================================================================================ */
    public function get( $szFile )
    /*--------------------------*/
    {
        $oDom       = new \DOMDocument();
        $xRetVal    = null;

        if ( is_file( $szFile ) )
        {
            if ( @$oDom->load( $szFile ) )
            {
                /************************************************************************/
                /* Partie DISCUTABLE                                                    */
                /************************************************************************/
                {
                    /* Get rid of all the internal items that have been added so far */
                    /* It may be discussed: maybe we want to add items coming from
                       several forms to build one BIG one ?!? */
                    $this->aItems = null;

                    //var_dump( $this->settings );

                    /* Ceci aussi se discute !!! */
                    $this->settings = null;

                    $this->description  =
                    $this->comment      = null;
                }
                /************************************************************************/
                /* Partie DISCUTABLE                                                    */
                /************************************************************************/



                $oXPath = new \DOMXPath( $oDom );

                $oRootNode = $oDom->documentElement;
                //var_dump( $oRootNode );

                if ( ! empty( $szID = $oRootNode->getAttribute('id') ) )
                    $this->identifier = $szID;


                /************************************************************************/
                /* Settings                                                             */
                /************************************************************************/
                if ( ( $o = $oXPath->query( '//Settings' ) ) && ( $o->length > 0 ) )
                {
                    //var_dump( "FOUND SETTINGS" );
                    if ( ! empty( $szJSON = $o->item(0)->nodeValue ) )
                    {
                        $this->settings = (array) json_decode( $szJSON );
                        //var_dump( $this->settings );
                    }
                }
                else
                    goto end;

                /************************************************************************/
                /* Description                                                          */
                /************************************************************************/
                if ( ( $o = $oXPath->query( '//Description' ) ) && ( $o->length > 0 ) )
                {
                    $this->description = $o->item(0)->nodeValue;
                }
                else
                    goto end;

                /************************************************************************/
                /* Comment                                                              */
                /************************************************************************/
                if ( ( $o = $oXPath->query( '//Comment' ) ) && ( $o->length > 0 ) )
                {
                    $this->comment = $o->item(0)->nodeValue;
                }
                else
                    goto end;

                /************************************************************************/
                /* Keywords                                                             */
                /************************************************************************/
                if ( ( $o = $oXPath->query( '//Keywords' ) ) && ( $o->length > 0 ) )
                {
                    $this->keywords = $o->item(0)->nodeValue;
                }


                /************************************************************************/
                /* Items                                                                */
                /************************************************************************/
                if ( ( $o = $oXPath->query( '//Item' ) ) && ( $o->length > 0 ) )
                {
                    foreach ( $o as $oItemNode )
                    {
                        if ( ! empty( $szJSON = $oItemNode->nodeValue ) )
                        {
                            $oItemDef = json_decode( $szJSON );

                            if ( isset( $oItemDef->__class ) )
                                $this->aItems[] = new $oItemDef->__class( (array) $oItemDef->aParams );
                        }   /* if ( ! empty( $szJSON = $oItemNode->nodeValue ) ) */
                    }   /* foreach ( $o as $oItemNode ) */
                }   /* if ( ( $o = $oXPath->query( '//Item' ) ) && ( $o->length > 0 ) ) */
                else
                    goto end;

                $xRetVal = $this;
            }   /* if ( $oDom->load( $szFile ) ) */
        }   /* if ( is_file( $szFile ) ) */

        end:
        return ( $xRetVal );
    }   /* End of Form.get() ========================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*protected buildTarget()=

        Builds the target attribute of a form

        {*params
        *}

        {*return
            (string)   The target attribute of the form
        *}
        *}}
     */
    /* ================================================================================ */
    protected function buildTarget()
    /*----------------------------*/
    {
        $szRetVal = '';                                             /* Default return value of the method */

        if ( ! empty( $this->settings['target'] ) )
        {
            if ( vaesoli::STR_iInList( array( '_self','_blank','_parent','_top' ),$this->settings['target'] = strtolower( trim( $this->settings['target'] ) ) ) )
                $szRetVal = " target=\"{$this->settings['target']}\"";
        }   /* if ( ! empty( $this->settings['target'] ) ) */

        return ( $szRetVal );                                       /* Return result to caller */

    }   /* End of Form.buildTarget() ================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*protected buildEnctype()=

        Builds the encoding-type part of the form (needed if 'file' input)

        {*params
        *}

        {*return
            (string)   The encoding-type attribute of the form
        *}
        *}}
     */
    /* ================================================================================ */
    protected function buildEnctype()
    /*-----------------------------*/
    {
        $szRetVal = '';                                             /* Return value of the method */
        $HasFile  = false;

        if ( ! $this->settings['hasFile'] )                         /* If not set manually */
        {
            if ( is_array( $this->aItems ) && count( $this->aItems ) > 0 )
            {
                foreach ( $this->aItems as $oItem )                 /* For each control found in the form */
                {
                    if ( $oItem instanceof Fieldset )               /* If Fieldset ... it contains sub-controls */
                    {
                        foreach ( $oItem->aObjects as $oSubControl )/* For each control of the fieldset */
                        {
                            if ( $oSubControl instanceof Input )    /* If input */
                            {
                                if ( $oSubControl->szType === 'file' )  /* If file input */
                                {
                                    $HasFile = true;                /* It has files ... go no further */
                                    break 2;                        /* Stop processing */
                                }
                            }
                        }
                    }   /* if     ( $oItem instanceof Fieldset ) */
                    elseif ( $oItem instanceof Input )              /* If input */
                    {
                        if ( $oItem->szType === 'file' )            /* If file input */
                        {
                            $HasFile = true;                        /* It has files ... go no further */
                            break;                                  /* Stop processing */
                        }
                    }   /* elseif ( $oControl instanceof LSInput ) */
                }   /* foreach ( $this->aObjects as $oControl ) */
            }   /* if ( is_array( $this->aItems ) && count( $this->aItems ) > 0 ) */
        }
        else
        {
            $HasFile = true;                                        /* Handle as if we have files (even if not totally true) */
        }

        if ( $HasFile )                                             /* If a file has been found */
        {
            $szRetVal .= ' enctype="multipart/form-data"';          /* Clause to add to the form */
        }   /* if ( $HasFile ) */

        return ( $szRetVal );                                       /* Return result to caller */
    }   /* End of Form.buildEnctype() ================================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toHTML()=

        Renders the form in HTML

        {*params
        *}

        {*return
            (string)        HTML Code
        *}

        {*warning
            So far (25-12-20 13:29:10), the form is NOT rendered
        *}

        *}}
    */
    /* ================================================================================ */
    public function __toHTML(): string
    /*------------------------------*/
    {
        $szRetVal  = '';

        /* **************************************************************************** */
        /* Play the pre block if any                                                    */
        /* **************************************************************************** */
        if ( ! is_null(         $this->settings['preRenderFnc'] )     &&
               is_string(       $this->settings['preRenderFnc'] )     &&
               strlen(          $this->settings['preRenderFnc'] ) > 0 &&
               function_exists( $this->settings['preRenderFnc'] )
           )
        {
            $szRetVal .= (string) $this->settings['preRenderFnc']( $this );
        }   /* if ( ! is_null( $this->PreRenderFnc   )  && ... */
        /* **************************************************************************** */
        /* End of Play the pre block if any                                             */
        /* **************************************************************************** */




        /* **************************************************************************** */
        /* Adding description and comment                                               */
        /* **************************************************************************** */
        if ( ! empty( $this->description ) )
            $szRetVal .= "<!-- Description: " . wordwrap( $this->description,80 ) . " -->\n";

        if ( ! empty( $this->comment ) )
            $szRetVal .= "<!-- Comment: " . wordwrap( $this->comment,80 ) . " -->\n";

        $szRetVal .= "<!-- Generation: " . __CLASS__ . " on " . date( "d/m/Y H:i:s" ) . " -->\n";

        /* **************************************************************************** */
        /* End of Adding description and comment                                        */
        /* **************************************************************************** */



        $szID           = $this->buildID();                         /* 'id' attribute (identifier) */
        $szClass        = $this->buildClass();                      /* 'class' attribute */
        $szTarget       = $this->buildTarget();                     /* 'target' attribute */
        $szEncType      = $this->BuildEnctype();                    /* 'enctype' attribute */

        if ( ! empty( $this->szOnSubmit ) )
            $szOnSubmit = " onsubmit=\"" . str_replace( '"',"'",$this->szOnSubmit ) . "\"";
        else
            $szOnSubmit = '';

        $szRetVal .= "<form action=\"{$this->settings['action']}\" method=\"{$this->settings['method']}\"{$szID}{$szClass}{$szTarget}{$szEncType}{$szOnSubmit}>\n";

        if ( is_array( $this->aItems ) && count( $this->aItems ) > 0 )
        {
            foreach( $this->aItems as $oItem )
            {
                if ( $oItem instanceof Tag )
                {
                    $szRetVal .= $oItem->__toHTML();
                }   /* if ( $oItem instanceof Tag ) */
            }   /* foreach( $this->aItems as $oItem ) */

            if ( ! $this->settings['withBR'] )
                $szRetVal = str_iReplace( '%BR%','',$szRetVal );
        }   /* if ( is_array( $this->aItems ) && count( $this->aItems ) > 0 ) */

        end:
        $szRetVal .= "</form>\n";







        /* **************************************************************************** */
        /* Play the post block if any                                                   */
        /* **************************************************************************** */
        if ( ! is_null(         $this->settings['postRenderFnc'] )     &&
               is_string(       $this->settings['postRenderFnc'] )     &&
               strlen(          $this->settings['postRenderFnc'] ) > 0 &&
               function_exists( $this->settings['postRenderFnc'] )
           )
        {
            $szRetVal .= (string) $this->settings['postRenderFnc']( $this );
        }   /* if ( ! is_null( $this->settings['postRenderFnc'] ) && ... */
        /* **************************************************************************** */
        /* End of Play the post block if any                                            */
        /* **************************************************************************** */

        return ( $szRetVal );
    }   /* End of Form.__toHTML() ===================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toXML()=

        Renders the form in XML

        {*params
        *}

        {*return
            (string)        XML Code
        *}

        {*warning
            So far (25-12-20 13:29:10), the form is NOT rendered
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
    }   /* End of Form.__toXML() ====================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toArray()=

        Turns the object into an array

        {*params
        *}

        {*return
            (array)     The array corresponding to the object
        *}

        {*remark
            Protected properties are formatted as: [c]'&#0;*&#0;<property>'[/c] (e.g. [c]'&#0;*&#0;self'[/c])[br]
            Private   properties are formatted as: [c]'&#0;trql\form\Form&#0;<property>'[/c] (e.g. [c]'&#0;trql\form\Form&#0;test'[/c])[br]
        *}

        *}}
    */
    /* ================================================================================ */
    public function __toArray(): array
    /*------------------------------*/
    {
        return ( (array) $this );
    }   /* End of Form.__toArray() ==================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toString()=

        Renders the form in HTML

        {*params
        *}

        {*return
            (string)        XML Code
        *}

        *}}
    */
    /* ================================================================================ */
    public function __toString(): string
    /*--------------------------------*/
    {
        try
        {
            $szRetVal = $this->__toHTML();
        }
        catch ( Exception $e )
        {
            //echo 'Exception reçue : ',  $e->getMessage(), "\n";
            $szRetVal = "Impossible to render the form : " . $e->getMessage();
        }

        return ( $szRetVal );
    }   /* End of Form.__toString() =================================================== */
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

        {*seealso @fnc.__destruct *}

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

    }   /* End of Form.__destruct() =================================================== */
    /* ================================================================================ */
}   /* End of class Form ============================================================== */
/* ==================================================================================== */
