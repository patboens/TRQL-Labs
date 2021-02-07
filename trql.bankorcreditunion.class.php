<?php
/****************************************************************************************/
/** {{{*fheader
    {*file                  trql.bankorcreditunion.class.php *}
    {*purpose               Bank or credit union. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 24-08-2020 11:49 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 24-08-2020 11:49 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\bankorcreditunion;

use \trql\thing\Thing                       as Thing;
use \trql\vaesoli\Vaesoli                   as Vaesoli;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'FINANCIALSERVICE_CLASS_VERSION' ) )
    require_once( 'trql.financialservice.class.php' );



defined( 'BANKORCREDITUNION_CLASS_VERSION' ) or define( 'BANKORCREDITUNION_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class BankOrCreditUnion=

    {*desc

        Bank or credit union.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/BankOrCreditUnion[/url] *}

 */
/* ==================================================================================== */
class BankOrCreditUnion extends FinancialService
/*--------------------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );
s
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
    }   /* End of BankOrCreditUnion.__construct() ===================================== */
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
    }   /* End of BankOrCreditUnion.__destruct() ====================================== */
    /* ================================================================================ */

}   /* End of class BankOrCreditUnion ================================================= */
/* ==================================================================================== */
?>