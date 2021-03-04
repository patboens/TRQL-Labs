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
    {*file                  trql.whatwasdone.class.php *}
    {*purpose               A form that synthetizes what has been done about a given
                            topic *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 09-02-21 08:58 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 09-02-21 08:58 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\whatwasdone;

use \trql\vaesoli\Vaesoli       as v;
use \trql\form\Form             as Form;
use \trql\fieldset\Fieldset     as Fieldset;
use \trql\input\Input           as Input;
use \trql\tag\Tag               as Tag;
use \trql\XML\XML               as XML;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'FORM_CLASS_VERSION' ) )
    require_once( 'trql.form.class.php' );

if ( ! defined( 'INPUT_CLASS_VERSION' ) )
    require_once( 'trql.input.class.php' );

if ( ! defined( 'TAG_CLASS_VERSION' ) )
    require_once( 'trql.tag.class.php' );

if ( ! defined( 'XML_CLASS_VERSION' ) )
    require_once( 'trql.xml.class.php' );

defined( 'WHATWASDONE_CLASS_VERSION' ) or define( 'WHATWASDONE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Form=

    {*desc

        A form that synthetizes what has been done about a given topic

    *}

    {*warning

        Early stage of development. The feeling is that it will deeply evolve once
        the class will be used in the real life because of needs that will emerge
        from the field.

    *}

 */
/* ==================================================================================== */
class WhatWasDone extends Form
/*--------------------------*/
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
    public      $wikidataId                     = null;             /* {*property   $wikidataId         (string)        Wikidata ID. No equivalent *} */

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
    }   /* End of WhatWasDone.__construct() =========================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toForm()=

        Provides a standardized form for capturing the the main properties of a
        WhatWasDone object (sort of task)

        {*params
        *}

        {*return
            (string)        The HTML Code corresponding to the WhatWasDone object
        *}

        *}}
    */
    /* ================================================================================ */
    public function __toForm(): string
    /*------------------------------*/
    {
        static $oForm = null;

        if ( is_null( $oForm ) )
        {
            $oForm                      = new Form();
            $oForm->szClass             = $this->szClass;
            $oForm->szOnSubmit          = $this->szOnSubmit;

            $oForm->settings['withBR']  = false;
            {   /* Create a fieldset and add the field set to the form */
                $oFieldset              = new Fieldset();
                $oFieldset->szCaption   = 'Job Done';

                {   /* Adding zones to the fieldset */
                    $oFieldset->add( new Input( array( 'name'           =>  'Name'                                          ,
                                                       'type'           =>  'txt'                                           ,
                                                       'label'          =>  'Name'                                          ,
                                                       'lang'           =>  'en'                                            ,
                                                       'tooltip'        =>  'Enter a name for the task considered done'     ,
                                                       'required'       =>  true                                            ,
                                                       'delete'         =>  true                                            ,
                                                       'help'           =>  false                                           ,
                                                       'value'          =>  ''                                              ,
                                                     ) ) );

                    $oFieldset->add( new Input( array( 'name'           =>  'Agent'                                         ,
                                                       'type'           =>  'txt'                                           ,
                                                       'label'          =>  'Assignee'                                      ,
                                                       'lang'           =>  'en'                                            ,
                                                       'tooltip'        =>  'Who this task was assigned to'                 ,
                                                       'required'       =>  false                                           ,
                                                       'delete'         =>  true                                            ,
                                                       'help'           =>  false                                           ,
                                                       'value'          =>  ''                                              ,
                                                     ) ) );

                    $oFieldset->add( new Input( array( 'name'           =>  'Source'                                        ,
                                                       'type'           =>  'txt'                                           ,
                                                       'label'          =>  'Source file'                                   ,
                                                       'lang'           =>  'en'                                            ,
                                                       'tooltip'        =>  'Enter the source file(s) this task refers to'  ,
                                                       'required'       =>  false                                           ,
                                                       'delete'         =>  true                                            ,
                                                       'help'           =>  false                                           ,
                                                       'step'           =>  1                                               ,
                                                       'value'          =>  ''                                              ,
                                                     ) ) );

                    $oFieldset->add( new Input( array( 'name'           =>  'Priority'                                      ,
                                                       'type'           =>  'txt'                                           ,
                                                       'label'          =>  'Priority'                                      ,
                                                       'lang'           =>  'en'                                            ,
                                                       'tooltip'        =>  'Enter the priority assigned to this task'      ,
                                                       'maxlength'      =>  3                                               ,
                                                       'required'       =>  false                                           ,
                                                       'delete'         =>  true                                            ,
                                                       'help'           =>  false                                           ,
                                                       'step'           =>  1                                               ,
                                                       'value'          =>  ''                                              ,
                                                     ) ) );

                    // Créé : commentaire JUSTE pour le UTF-8
                    $oFieldset->add( new Input( array( 'name'           =>  'Credits'                                       ,
                                                       'type'           =>  'num'                                           ,
                                                       'label'          =>  'Credits'                                       ,
                                                       'lang'           =>  'en'                                            ,
                                                       'tooltip'        =>  'Credits this task was given'                   ,
                                                       'required'       =>  false                                           ,
                                                       'delete'         =>  true                                            ,
                                                       'help'           =>  false                                           ,
                                                       'step'           =>  1                                               ,
                                                       'style'          =>  'max-width:5em;width:5em;min-width:5em;'        ,
                                                       'value'          =>  1                                               ,
                                                     ) ) );

                    $oFieldset->add( new Input( array( 'name'           =>  'Due'                                           ,
                                                       'type'           =>  'dat'                                           ,
                                                       'label'          =>  'Due date'                                      ,
                                                       'lang'           =>  'en'                                            ,
                                                       'tooltip'        =>  'Date the task was due'                         ,
                                                       'required'       =>  false                                           ,
                                                       'help'           =>  false                                           ,
                                                       'style'          =>  'max-width:11em;width:11em;min-width:11em;'     ,
                                                       'value'          =>  ''                                              ,
                                                     ) ) );

                    $oFieldset->add( new Input( array( 'name'           =>  'Description'                                   ,
                                                       'type'           =>  'edt'                                           ,
                                                       'label'          =>  'Description'                                   ,
                                                       'lang'           =>  'en'                                            ,
                                                       'tooltip'        =>  'Enter the description of what was done'        ,
                                                       'required'       =>  true                                            ,
                                                       'delete'         =>  true                                            ,
                                                       'help'           =>  false                                           ,
                                                       'rows'           =>  8                                               ,
                                                       'style'          =>  'resize:vertical;'                              ,
                                                       'value'          =>  ''                                              ,
                                                     ) ) );

                    $oFieldset->add( new Input( array( 'name'           =>  'frmFormName'                                   ,
                                                       'type'           =>  'hid'                                           ,
                                                       'value'          =>  'frmWhatWasDone'                                ,
                                                     ) ) );

                    $oFieldset->add( new Input( array( 'name'           =>  'Submit'                                        ,
                                                       'type'           =>  'cmd'                                           ,
                                                       'class'          =>  'shadow'                                        ,
                                                       'lang'           =>  'en'                                            ,
                                                       'tooltip'        =>  'Click to save the WhatWasDone data'            ,
                                                       'value'          =>  'Save'                                          ,
                                                     ) ) );
                }   /* Adding zones to the fieldset */

                $oForm->add( $oFieldset );
            }   /* Create a fieldset and add the field set to the form */
        }   /* if ( is_null( $oForm ) ) */

        return ( (string) $oForm );
    }   /* End of WhatWasDone.__toForm() ============================================== */
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

    }   /* End of WhatWasDone.__destruct() ============================================ */
    /* ================================================================================ */

}   /* End of class WhatWasDone ======================================================= */
/* ==================================================================================== */
?>