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
    {*file                  trql.logoutform.class.php *}
    {*purpose               Document with blank spaces/fields for insertion of required
                            or requested information. A device for collecting data. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 08-01-21 11:50 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 08-01-21 11:50 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\logoutform;

use \trql\vaesoli\Vaesoli       as Vaesoli;
use \trql\html\Form             as Form;
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

if ( ! defined( 'FORM_CLASS_VERSION' ) )
    require_once( 'trql.form.class.php' );

defined( 'LOGOUTFORM_CLASS_VERSION' ) or define( 'LOGOUTFORM_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class LogoutForm=

    {*desc

        Document with blank spaces/fields for insertion of required or requested
        information. A device for collecting data.

    *}

    *}}

 */
/* ==================================================================================== */
class LogoutForm extends Form
/*-------------------------*/
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
    public      $wikidataId                     = 'Q3836471';       /* {*property   $wikidataId         (string)        Wikidata ID. NOT EXACTLY what this class is about.
                                                                                                                        Wikidata speaks about "logout": action of terminating
                                                                                                                        a connection, opposite of "login". *} */


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
    public function __construct( $szAction = null )
    /*-----------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );
        $this->classIcon = $this->self['icon'];

        $this->settings['action'] = $szAction ?? '/signin/';
        $this->settings['method'] = 'post';
        $this->settings['withBR'] = false;

        $this->add( new Input( array( 'name'          =>  'Submit'                              ,
                                      'type'          =>  'cmd'                                 ,
                                      'lang'          =>  'en'                                  ,
                                      'delete'        =>  false                                 ,
                                      'help'          =>  false                                 ,
                                      'value'         =>  'Logoff'                              ,
                                    ) ) );

        return ( $this );
    }   /* End of LogoutForm.__construct() ============================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__get( $szVar )=

        Used for reading data from inaccessible (protected or private) or
        non-existing properties.

        {*params
            $szVar      (string)        The name of the properties to access
        *}

        {*return
            (mixed)     The value of [c]$szVar[/c] or throwing an exception if
                        [c]$szVar[/c] NOT found.
        *}

        *}}
    */
    /* ================================================================================ */
    public function __get( $szVar )
    /*---------------------------*/
    {
        switch ( strtolower( $szVar ) )
        {
            case 'icon'         :   return ( '/snippet-center/icons/' . basename( $this->classIcon ) );
            default             :   throw new \Exception( __FUNCTION__ . "() at line " . __LINE__ . ": {$szVar} UNKNOWN (ErrCode: " . EXCEPTION_CODE_INVALID_PROPERTY . ")",EXCEPTION_CODE_INVALID_PROPERTY );
        }
    }   /* End of Logout.__get() ====================================================== */
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

    }   /* End of LogoutForm.__destruct() ============================================= */
    /* ================================================================================ */

}   /* End of class LogoutForm ======================================================== */
/* ==================================================================================== */

?>