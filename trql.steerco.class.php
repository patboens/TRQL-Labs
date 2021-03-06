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
    {*file                  trql.steerco.class.php *}
    {*purpose               A special meeting aimed at providing a program or project
                            overview to a selected audience (Steering Committee). *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 10-02-21 07:48 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 10-02-21 07:48 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\steerco;

use \trql\vaesoli\Vaesoli               as v;
use \trql\mother\iContext               as iContext;
use \trql\meeting\Meeting               as Meeting;
use \trql\form\Form                     as Form;
use \trql\fieldset\Fieldset             as Fieldset;
use \trql\input\Input                   as Input;
use \trql\tag\Tag                       as Tag;
use \trql\audience\Audience             as Audience;
use \trql\person\Person                 as Person;
use \trql\organization\Organization     as Organization;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'MOTHER_CLASS_VERSION' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'MEETING_ABSTRACT_CLASS' ) )
    require_once( 'trql.meeting.class.php' );

if ( ! defined( 'FORM_CLASS_VERSION' ) )
    require_once( 'trql.form.class.php' );

if ( ! defined( 'FIELDSET_CLASS_VERSION' ) )
    require_once( 'trql.fieldset.class.php' );

if ( ! defined( 'INPUT_CLASS_VERSION' ) )
    require_once( 'trql.input.class.php' );

if ( ! defined( 'TAG_CLASS_VERSION' ) )
    require_once( 'trql.tag.class.php' );

if ( ! defined( 'AUDIENCE_CLASS_VERSION' ) )
    require_once( 'trql.audience.class.php' );

if ( ! defined( 'PERSON_CLASS_VERSION' ) )
    require_once( 'trql.person.class.php' );

if ( ! defined( 'ORGANIZATION_CLASS_VERSION' ) )
    require_once( 'trql.organization.class.php' );

defined( 'STEERCO_CLASS_VERSION' ) or define( 'STEERCO_CLASS_VERSION','0.1' );

/* ================================================================================== */
/** {{*class Steerco=

    {*desc

        A special meeting aimed at providing a program or project overview to a
        selected audience (Steering Committee)

    *}

    *}}
 */
/* ================================================================================== */
class Steerco extends Meeting implements iContext
/*---------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self               (array)         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId = 'Q2761147';                           /* {*property   $wikidataId         (string)        Wikidata ID. Meeting (Q2761147), which is closest
                                                                                                                        we can get. Event in which two or more people assemble,
                                                                                                                        planned in advance to facilitate discussion. *} */

    public      $szClass    = null;                                 /* {*property   $szClass            (string)        CSS class that should be assigned to the form ([c]__toForm()[/c]) *} */
    public      $szOnSubmit = null;                                 /* {*property   $szOnSubmit         (string)        Submit clause of the form *} */
    public      $lvidUrl    = 'http://www.lvid.org/help/steerco/';  /* {*property   $lvidUrl            (string)        URL of help provided by LVID.ORG *} */

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

        $this->audience = new Audience();

        // We may need to create a set of Persons/Organizations as well
        // for the Sponsor, Attendees, Organizer, ...

        return ( $this );
    }   /* End of Steerco.__construct() =============================================== */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of Steerco.speak() ===================================================== */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of Steerco.sing() ====================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*help()=

        Redirects page to a help page maintained on LVID.ORG (if help provided)

        {*params
        *}

        {*return
            (void)  No return provided. Possibly, leaving the site.
        *}

        {*warning

            [b]EXPERIMENTAL METHOD[/b]. May be standardized later on if we think the 
            concept is worth it.

        *}

        {*remark

            There is a heavy dependency on LVID, which is definitely NOT a good thing!

        *}

        *}}
    */
    /* ================================================================================ */
    public function help()
    /*------------------*/
    {
        if ( ! empty( $this->lvidUrl ) )
        {
            ob_clean();
            header( "Location: {$this->lvidUrl}" );
            die();
        }
    }   /* End of Steerco.help() ====================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*render( [$szMode] )=

        Renders the Steerco in one of two modes:
            - edit (a forms is displayed)
            - view

        {*params
            $szMode     (string)        Mode in which the steerco is rendered. Either in
                                        view mode (display of the main properties of the
                                        steerco meeting) or in edit mode (form gets
                                        displayed to fill the main properties)
        *}

        {*return
            (string)        The rendering of the Steerco Meeting
        *}

        *}}
    */
    /* ================================================================================ */
    public function render( $szMode = 'view' ): string
    /*----------------------------------------------*/
    {
        switch ( $szMode )
        {
            case 'edit' :   return ( $this->__toForm() );
            default     :   return ( __CLASS__ . ' is not yet rendered properly' );
        }   /* switch ( $szMode ) */
    }   /* End of Steerco.render() ==================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toForm()=

        Provides a standardized form for capturing the the main properties of a steerco
        meeting.

        {*params
        *}

        {*return
            (string)        The stringified version of the Steerco Meeting
        *}

        *}}
    */
    /* ================================================================================ */
    public function __toForm() : string
    /*-------------------------------*/
    {
        static $oForm = null;

        if ( is_null( $oForm ) )
        {
            $oForm = new Form();
        }   /* if ( is_null( $oForm ) ) */

        $oForm->szClass             = $this->szClass;
        $oForm->szOnSubmit          = $this->szOnSubmit;
        $oForm->settings['withBR']  = false;

        {   /* Create a fieldset and add the field set to the form */
            $oFieldset              = new Fieldset();
            $oFieldset->szCaption   = 'Steerco Meeting';

            {   /* Adding zones to the fieldset */
                $oFieldset->add( new Input( array( 'name'           =>  'ID'                                                                                ,
                                                   'type'           =>  'txt'                                                                               ,
                                                   'label'          =>  'ID'                                                                                ,
                                                   'lang'           =>  'en'                                                                                ,
                                                   'tooltip'        =>  'Unique ID of the Steerco Meeting'                                                  ,
                                                   'readonly'       =>  true                                                                                ,
                                                   'required'       =>  true                                                                                ,
                                                   'delete'         =>  true                                                                                ,
                                                   'help'           =>  false                                                                               ,
                                                   'value'          =>  ''                                                                                  ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Name'                                                                              ,
                                                   'type'           =>  'txt'                                                                               ,
                                                   'label'          =>  'Name'                                                                              ,
                                                   'lang'           =>  'en'                                                                                ,
                                                   'tooltip'        =>  'Enter the name of the Steerco Meeting'                                             ,
                                                   'required'       =>  true                                                                                ,
                                                   'delete'         =>  true                                                                                ,
                                                   'help'           =>  false                                                                               ,
                                                   'value'          =>  ''                                                                                  ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Date'                                                                              ,
                                                   'type'           =>  'datlocal'                                                                          ,
                                                   'label'          =>  'Date/Time'                                                                         ,
                                                   'lang'           =>  'en'                                                                                ,
                                                   'tooltip'        =>  'Enter the date and time of the Steerco Meeting'                                    ,
                                                   'required'       =>  true                                                                                ,
                                                   'help'           =>  false                                                                               ,
                                                   'value'          =>  date('YmdHis')                                                                      ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Duration'                                                                          ,
                                                   'type'           =>  'num'                                                                               ,
                                                   'label'          =>  'Duration'                                                                          ,
                                                   'lang'           =>  'en'                                                                                ,
                                                   'tooltip'        =>  'Duration in min of the Steerco Meeting'                                            ,
                                                   'required'       =>  true                                                                                ,
                                                   'help'           =>  false                                                                               ,
                                                   'step'           =>  5                                                                                   ,
                                                   'value'          =>  30                                                                                  ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'About'                                                                             ,
                                                   'type'           =>  'edt'                                                                               ,
                                                   'label'          =>  'About'                                                                             ,
                                                   'lang'           =>  'en'                                                                                ,
                                                   'tooltip'        =>  'Enter what this Steerco Meeting is about (e.g. main objective, key messages, ...)' ,
                                                   'required'       =>  false                                                                               ,
                                                   'delete'         =>  true                                                                                ,
                                                   'help'           =>  false                                                                               ,
                                                   'rows'           =>  8                                                                                   ,
                                                   'style'          =>  'resize: vertical;'                                                                 ,
                                                   'value'          =>  ''                                                                                  ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Description'                                                                       ,
                                                   'type'           =>  'edt'                                                                               ,
                                                   'label'          =>  'Description'                                                                       ,
                                                   'lang'           =>  'en'                                                                                ,
                                                   'tooltip'        =>  'Enter what this Steerco Meeting is about (e.g. main objective, key messages, ...)' ,
                                                   'required'       =>  false                                                                               ,
                                                   'delete'         =>  true                                                                                ,
                                                   'help'           =>  false                                                                               ,
                                                   'rows'           =>  8                                                                                   ,
                                                   'style'          =>  'resize: vertical;'                                                                 ,
                                                   'value'          =>  ''                                                                                  ,
                                                 ) ) );

                // Créé : commentaire JUSTE pour le UTF-8
                $oFieldset->add( new Input( array( 'name'           =>  'frmFormName'                                                                       ,
                                                   'type'           =>  'hid'                                                                               ,
                                                   'value'          =>  'frmSteercoMeeting'                                                                 ,
                                                 ) ) );

                $oFieldset->add( new Input( array( 'name'           =>  'Submit'                                                                            ,
                                                   'type'           =>  'cmd'                                                                               ,
                                                   'class'          =>  'shadow'                                                                            ,
                                                   'lang'           =>  'en'                                                                                ,
                                                   'tooltip'        =>  'Click to save the Steerco Meeting data'                                            ,
                                                   'value'          =>  'Save'                                                                              ,
                                                 ) ) );
            }   /* Adding zones to the fieldset */

            $oForm->add( $oFieldset );
        }   /* Create a fieldset and add the field set to the form */

        return ( (string) $oForm );

    }   /* End of Steerco.__toForm() ================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toString()=

        Allows the steerco class to decide how it will react when it is treated like a
        string.

        {*params
        *}

        {*return
            (string)        The stringified version of the Steerco Meeting
        *}

        *}}
    */
    /* ================================================================================ */
    public function __toString() : string
    /*----------------------------------*/
    {
        return ( $this->render( 'view' ) );
    }   /* End of Steerco.__toString() ================================================ */
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
    }   /* End of Steerco.__destruct() ================================================ */
    /* ================================================================================ */
}   /* End of class Steerco =========================================================== */
/* ==================================================================================== */
