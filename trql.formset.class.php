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
    {*file                  trql.formset.class.php *}
    {*purpose               A library of forms. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 30-12-20 17:23 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 30-12-20 17:23 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\html;

use \trql\vaesoli\Vaesoli   as Vaesoli;
use \trql\dataset\Dataset   as Dataset;
use \trql\html\Form         as Form;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'DATASET_CLASS_VERSION' ) )
    require_once( 'trql.dataset.class.php' );

if ( ! defined( 'FORM_CLASS_VERSION' ) )
    require_once( 'd:/websites/snippet-center/trql.form.class.php' );

defined( 'FORMSET_CLASS_VERSION' ) or define( 'FORMSET_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Formset=

    {*desc

        A library of forms.

    *}

    *}}
 */
/* ==================================================================================== */
class Formset extends Dataset
/*-------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId             = null;                     /* {*property   $wikidataId                     (string)                        Wikidata ID. No equivalent. *} */ 


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
    }   /* End of Formset.__construct() =============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*enumerate( $szMask )=

        Enumerate forms corresponding to $szMask

        {*params
            $szMask     (string)        A wildcard
        *}

        {*return
            (void)      No return
        *}

        *}}
    */
    /* ================================================================================ */
    public function enumerate( $szMask )
    /*--------------------------------*/
    {
        static $oForm = null;

        if ( is_array( $aFiles = vaesoli::FIL_aFilesEx( $szMask ) ) && count( $aFiles ) > 0 )
        {
            if ( is_null( $oForm ) )
                $oForm = new Form();

            foreach( $aFiles as $szFile )
            {
                if ( ( $x = $oForm->get( $szFile ) ) instanceof Form )
                {
                    //var_dump( "Adding form to FORMSET" );
                    $this->aItems[] = $x;
                }   /* if ( ( $x = $oForm->get( $szFile ) ) instanceof Form ) */
                //var_dump( $oForm );
            }   /* foreach( $aFiles as $szFile ) */
        }   /* if ( is_array( $aFiles = vaesoli::FIL_aFilesEx( $szMask ) ) && count( $aFiles ) > 0 ) */

        return ( $this );
    }   /* End of Formset.enumerate() ================================================= */
    /* ================================================================================ */


    public function seek( $szID )
    /*-------------------------*/
    {
        $oRetVal = null;

        if ( is_array( $this->aItems ) && count( $this->aItems ) > 0 )

        foreach( $this->aItems as $oForm )
        {
            if ( $oForm->identifier === $szID )
            {
                $oRetVal = $oForm;
                goto end;    
            }   /* if ( $oForm->identifier === $szID ) */
        }   /* foreach( $this->aItems as $oForm ) */

        end:
        return ( $oRetVal );
    }   /* End of Formset.seek() ====================================================== */
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
    }   /* End of Formset.__destruct() ================================================ */
    /* ================================================================================ */
}   /* End of class Formset =========================================================== */
/* ==================================================================================== */
