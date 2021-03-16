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
    {*file                  trql.invoice.class.php *}
    {*purpose               A statement of the money due for goods or services; a bill. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 26-08-2020 18:49 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 26-08-2020 18:49 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\quitus;

use \trql\vaesoli\Vaesoli           as V;
use \trql\intangible\Intangible     as Intangible;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'INTANGIBLE_CLASS_VERSION' ) )
    require_once( 'trql.intangible.class.php' );

defined( 'INVOICE_CLASS_VERSION' ) or define( 'INVOICE_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Invoice=

    {*desc

        A statement of the money due for goods or services; a bill.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]http://schema.org/Invoice[/url] *}

    {*warning
        This class has been generated automatically by 
        [c]trql.schemaclassgenerator.class.php[/c]
        on 26-08-2020 18:49. It must still be completed by a number of properties 
        such as the ones we use in Quitus|TRQL (lines of detail, ...)
    *}

    *}}
 */
/* ==================================================================================== */
class Invoice extends Intangible
/*----------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                           (array)                                         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    public      $accountId                      = null;             /* {*property   $accountId                      (string)                                        The identifier for the account the payment will be applied to. *} */
    public      $billingPeriod                  = null;             /* {*property   $billingPeriod                  (Duration)                                      The time interval used to compute the invoice. *} */
    public      $broker                         = null;             /* {*property   $broker                         (Person|Organization)                           An entity that arranges for an exchange between a buyer and a seller.
                                                                                                                                                                    In most cases a broker never acquires or releases ownership of a
                                                                                                                                                                    product or service involved in an exchange. If it is not clear whether
                                                                                                                                                                    an entity is a broker, seller, or buyer, the latter two terms are
                                                                                                                                                                    preferred. *} */
    public      $category                       = null;             /* {*property   $category                       (Thing|PhysicalActivityCategory|URL|string)     A category for the item. Greater signs or slashes can be used to
                                                                                                                                                                    informally indicate a category hierarchy. *} */
    public      $confirmationNumber             = null;             /* {*property   $confirmationNumber             (string)                                        A number that confirms the given order or payment has been received. *} */
    public      $customer                       = null;             /* {*property   $customer                       (Person|Organization)                           Party placing the order or paying the invoice. *} */
    public      $minimumPaymentDue              = null;             /* {*property   $minimumPaymentDue              (PriceSpecification|MonetaryAmount)             The minimum payment required at this time. *} */
    public      $paymentDueDate                 = null;             /* {*property   $paymentDueDate                 (Date|DateTime)                                 The date that payment is due. *} */
    public      $paymentMethod                  = null;             /* {*property   $paymentMethod                  (PaymentMethod)                                 The name of the credit card or other method of payment for the order. *} */
    public      $paymentMethodId                = null;             /* {*property   $paymentMethodId                (string)                                        An identifier for the method of payment used (e.g. the last 4 digits
                                                                                                                                                                    of the credit card). *} */
    public      $paymentStatus                  = null;             /* {*property   $paymentStatus                  (PaymentStatusType|string)                      The status of payment; whether the invoice has been paid or not. *} */
    public      $provider                       = null;             /* {*property   $provider                       (Person|Organization)                           The service provider, service operator, or service performer; the
                                                                                                                                                                    goods producer. Another party (a seller) may offer those services or
                                                                                                                                                                    goods on behalf of the provider. A provider may also serve as the
                                                                                                                                                                    seller. *} */
    public      $referencesOrder                = null;             /* {*property   $referencesOrder                (Order)                                         The Order(s) related to this Invoice. One or more Orders may be
                                                                                                                                                                    combined into a single Invoice. *} */
    public      $scheduledPaymentDate           = null;             /* {*property   $scheduledPaymentDate           (Date)                                          The date the invoice is scheduled to be paid. *} */
    public      $totalPaymentDue                = null;             /* {*property   $totalPaymentDue                (PriceSpecification|MonetaryAmount)             The total amount due. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q190581';        /* {*property   $wikidataId                     (string)                                        Wikidata ID. Commercial document issued by a seller to a buyer, 
                                                                                                                                                                    relating to a sale transaction and indicating the products, 
                                                                                                                                                                    quantities, and agreed prices for products or services the seller 
                                                                                                                                                                    has provided the buyer. *} */

    /* ================================================================================ */
    /** {{*__construct( [$szHome] )=

        Class constructor

        {*params
            $szHome     (string)        Home of the class. Optional.
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*keywords
            constructors, destructors
        *}

        {*seealso
            @fnc.__destruct
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
    }   /* End of Invoice.__construct() =============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toForm()=

        Returns a form representing an invoice

        {*params
        *}

        {*return
            (string)      No return
        *}

        {*warning
            This method is EXPERIMENTAL.
        *}

        {*remark
            If the properties are filled, their values will be reflected in the XML
        *}

        *}}
    */
    /* ================================================================================ */
    public function __toForm()
    /*----------------------*/
    {
        $aProperties = get_object_vars( $this );
        //var_dump( $aProperties );

        return ( $this );
    }   /* End of Invoice.__toForm() ================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toJSON()=

        Turns the class into a JSON structure

        {*params
        *}

        {*return
            (string)    JSON representation of the invoice object
        *}

        *}}
    */
    /* ================================================================================ */
    public function __toJSON() : string
    /*-------------------------------*/
    {
        return ( v::ObjectToJSON( $this ) );
    }   /* End of Invoice.__toJSON() ================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toXML()=

        Turns the class into an XML structure

        {*params
        *}

        {*return
            (string)    XML representation of an invoice
        *}

        {*remark
            If the properties are filled, their values will be reflected in the XML
        *}

        *}}
    */
    /* ================================================================================ */
    public function __toXML() : string
    /*------------------------------*/
    {
        return ( v::ObjectToXML( $this ) );
    }   /* End of Invoice.__toXML() =================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return
        *}

        {*keywords
            constructors, destructors
        *}

        {*seealso
            @fnc.__construct
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
    }   /* End of Invoice.__destruct() ================================================ */
    /* ================================================================================ */
}   /* End of class Invoice =========================================================== */
/* ==================================================================================== */
