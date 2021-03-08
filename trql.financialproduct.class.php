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
    {*file                  trql.financialproduct.class.php *}
    {*purpose               A product provided to consumers and businesses by financial
                            institutions such as banks, insurance companies, brokerage
                            firms, consumer finance companies, and investment companies
                            which comprise the financial services industry. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:46 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

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

    {*chist
        {*mdate 18-02-21 09:09 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Normalizing the class so that it can be used as-is or
                                extended in the Small API Gateway class (SmallAPIGW)
        *}
    *}

    *}}} */

/****************************************************************************************/
namespace trql\financialproduct;

use \trql\vaesoli\Vaesoli           as v;
use \trql\service\Service           as Service;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'SERVICE_CLASS_VERSION' ) )
    require_once( 'trql.service.class.php' );


defined( 'FINANCIALPRODUCT_CLASS_VERSION' ) or define( 'FINANCIALPRODUCT_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class FinancialProduct=

    {*desc

        A product provided to consumers and businesses by financial institutions
        such as banks, insurance companies, brokerage firms, consumer finance
        companies, and investment companies which comprise the financial services
        industry.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/FinancialProduct[/url] *}

    {*warning
        This class has been generated automatically by [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:46.
    *}

 */
/* ==================================================================================== */
class FinancialProduct extends Service
/*-----------------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                               (array)                     Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $annualPercentageRate               = null;         /* {*property   $annualPercentageRate               (QuantitativeValue|float)   The annual rate that is charged for borrowing (or made by investing),
                                                                                                                                                    expressed as a single percentage number that represents the actual
                                                                                                                                                    yearly cost of funds over the term of a loan. This includes any fees
                                                                                                                                                    or additional costs associated with the transaction. *} */
    public      $feesAndCommissionsSpecification    = null;         /* {*property   $feesAndCommissionsSpecification    (URL|string)                Description of fees, commissions, and other terms applied either to a
                                                                                                                                                    class of financial product, or by a financial service organization. *} */
    public      $interestRate                       = null;         /* {*property   $interestRate                       (float|QuantitativeValue)   The interest rate, charged or paid, applicable to the financial
                                                                                                                                                    product. Note: This is different from the calculated
                                                                                                                                                    @var.annualPercentageRate. *} */

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                         = 'Q15809678';  /* {*property   $wikidataId                         (string)                    Wikidata ID. Financial service marketed and sold as a packaged 
                                                                                                                                                    commodity *} */


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
    }   /* End of FinancialProduct.__construct() ====================================== */
    /* ================================================================================ */


    public function __toString():string
    /*-------------------------------*/
    {
        return ( __CLASS__ );
    }   /* End of FinancialProduct.__toString() ======================================= */
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
    }   /* End of FinancialProduct.__destruct() ======================================= */
    /* ================================================================================ */

}   /* End of class FinancialProduct ================================================== */
/* ==================================================================================== */
?>