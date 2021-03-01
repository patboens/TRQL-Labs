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
    {*file                  trql.accountingregister.class.php *}
    {*purpose               Document used for bookkeeping or accounting *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 18-02-21 11:01 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 18-02-21 11:01 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */

/****************************************************************************************/
namespace trql\accountingregister;

use \trql\vaesoli\Vaesoli           as v;
use \trql\document\document         as Document;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'DOCUMENT_CLASS_VERSION' ) )
    require_once( 'trql.document.class.php' );

defined( 'ACCOUNTINGREGISTER_CLASS_VERSION' ) or define( 'ACCOUNTINGREGISTER_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class AccountingRegister=

    {*desc

        Document used for bookkeeping or accounting

    *}

 */
/* ==================================================================================== */
class AccountingRegister extends Document
/*-------------------------------------*/
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
    public      $wikidataId                     = 'Q3831821';       /* {*property   $wikidataId                     (string)                        Wikidata ID. Document used for bookkeeping or 
                                                                                                                                                    accounting *} */

    /* ================================================================================ */
    /** {{*__construct()=

        Class constructor

        {*params
        *}

        {*return
            (self)      The current instance of the class
        *}

        *}}
    */
    /* ================================================================================ */
    public function __construct()
    /*---------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        return ( $this );
    }   /* End of AccountingRegister.__construct() ==================================== */
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
    }   /* End of AccountingRegister.__destruct() ===================================== */
    /* ================================================================================ */

}   /* End of class AccountingRegister ================================================ */
/* ==================================================================================== */
?>