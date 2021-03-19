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
    {*UTF-8                 Quel bel été sous le hêtre *}

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

use \trql\vaesoli\Vaesoli               as V;
use \trql\intangible\Intangible         as Intangible;
use \trql\quitus\Customer               as Customer;
use \trql\postaladdress\PostalAddress   as PostalAddress;
use \trql\quitus\Order                  as Order;
use \trql\organization\Organization     as Organization;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'INTANGIBLE_CLASS_VERSION' ) )
    require_once( 'trql.intangible.class.php' );

if ( ! defined( 'CUSTOMER_CLASS_VERSION' ) )
    require_once( 'trql.customer.class.php' );

if ( ! defined( 'POSTALADDRESS_CLASS_VERSION' ) )
    require_once( 'trql.postaladdress.class.php' );

if ( ! defined( 'ORDER_CLASS_VERSION' ) )
    require_once( 'trql.order.class.php' );

if ( ! defined( 'ORGANIZATION_CLASS_VERSION' ) )
    require_once( 'trql.organization.class.php' );

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
    public      $customer                       = null;             /* {*property   $customer                       (Customer)                                      Party placing the order or paying the invoice. *} */
    public      $minimumPaymentDue              = null;             /* {*property   $minimumPaymentDue              (PriceSpecification|MonetaryAmount)             The minimum payment required at this time. *} */
    public      $paymentDueDate                 = null;             /* {*property   $paymentDueDate                 (Date|DateTime)                                 The date that payment is due ([c]YYYYMMDD[/c] format). *} */
    public      $paymentMethod                  = null;             /* {*property   $paymentMethod                  (PaymentMethod)                                 The name of the credit card or other method of payment for the order. *} */
    public      $paymentMethodId                = null;             /* {*property   $paymentMethodId                (string)                                        An identifier for the method of payment used (e.g. the last 4 digits
                                                                                                                                                                    of the credit card). *} */
    public      $paymentStatus                  = null;             /* {*property   $paymentStatus                  (PaymentStatusType|string)                      The status of payment; whether the invoice has been paid or not. *} */
    public      $provider                       = null;             /* {*property   $provider                       (Person|Organization)                           The service provider, service operator, or service performer; the
                                                                                                                                                                    goods producer. Another party (a seller) may offer those services or
                                                                                                                                                                    goods on behalf of the provider. A provider may also serve as the
                                                                                                                                                                    seller. *} */
    public      $referencesOrder                = null;             /* {*property   $referencesOrder                (Order)                                         The Order(s) related to this invoice. One or more Orders may be
                                                                                                                                                                    combined into a single Invoice. SINGLE ORDER SUPPORTED FOR NOW.
                                                                                                                                                                    Confirmation of the transaction, which can contain multiple
                                                                                                                                                                    line items, each represented by an @class.Offer that has been accepted
                                                                                                                                                                    by the @class.Customer.*} */
    public      $scheduledPaymentDate           = null;             /* {*property   $scheduledPaymentDate           (Date)                                          The date the invoice is scheduled to be paid. *} */
    public      $totalPaymentDue                = null;             /* {*property   $totalPaymentDue                (PriceSpecification|MonetaryAmount)             The total amount due. *} */


    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = 'Q190581';        /* {*property   $wikidataId                     (string)                                        Wikidata ID. Commercial document issued by a seller to a buyer,
                                                                                                                                                                    relating to a sale transaction and indicating the products,
                                                                                                                                                                    quantities, and agreed prices for products or services the seller
                                                                                                                                                                    has provided the buyer. *} */
    public      $issuer                         = null;             /* {*property   $issuer                         (Organization)                                  Disambiguation of @var.provider. The issuer is the organization that
                                                                                                                                                                    issues the invoice. It is considered as an @class.Organization because
                                                                                                                                                                    it operates as an entity that is authorized to issue invoices. *} */
    public      $active                         = false;            /* {*property   $active                         (bool)                                          Is the invoice active or not. *} */
    public      $lang                           = 'fr';             /* {*property   $lang                           (string)                                        A 2-character string indicating the language (SO 639-1 Code) *} */
    public      $type                           = 'I';              /* {*property   $type                           (string)                                        Invoice type: [c]I[/c] for invoice; [c]P[/c] for proforma *} */
    public      $version                        = '3.0';            /* {*property   $version                        (string)                                        Invoice version. [c]2.0[/c] by default. Most recent version
                                                                                                                                                                    is [c]3.0[/c], which is fully compatible with [c]2.0[/c]. *} */
    public      $deliveryAddress                = null;             /* {*property   $deliveryAddress                (PostalAddress)                                 Delivery address *} */
    public      $billingAddress                 = null;             /* {*property   $billingAddress                 (PostalAddress)                                 Invoicing/Billing address *} */
    public      $footer                         = null;             /* {*property   $footer                         (string)                                        A message that will be printed in the invoice footer *} */
    public      $memo                           = null;             /* {*property   $memo                           (string)                                        A message that will be saved with the invoice (internal info) *} */
    public      $prepayment                      = '0.0';           /* {*property   $prepayment                     (float)                                         Prepayment is an accounting term for the settlement of a
                                                                                                                                                                    debt or installment loan in advance of its official due date. *} */
    public      $totalHTVA                      = '0.0';            /* {*property   $totalHTVA                      (float)                                         The total amount due, tax excluded. *} */
    public      $totalTVA                       = '0.0';            /* {*property   $totalTVA                       (float)                                         The total amount due, taxes only. *} */
    public      $totalTVAC                      = '0.0';            /* {*property   $totalTVAC                      (float)                                         The total amount due, tax included. *} */
    public      $discountHTVA                   = '0.0';            /* {*property   $discountHTVA                   (float)                                         The discounted amount, tax excluded. *} */
    public      $discountTVA                    = '0.0';            /* {*property   $discountTVA                    (float)                                         The discounted amount, taxes only. *} */
    public      $discountTVAC                   = '0.0';            /* {*property   $discountTVAC                   (float)                                         The discounted amountdue, tax included. *} */
    public      $iRounding                      = 4;                /* {*property   $iRounding                      (integer)                                       The rounding that is applied for calculation on amounts *} */
    public      $issueDate                      = null;             /* {*property   $issueDate                      (Date|DateTime|string)                          The date the invoice was issued ([c]YYYYMMDD[/c] format. *} */
    public      $refNumber                      = null;             /* {*property   $refNumber                      (string)                                        Annually unique and sequential code that is systematically
                                                                                                                                                                    assigned to invoices. Invoice numbers are one of the most
                                                                                                                                                                    important aspects of invoicing as they ensure that income
                                                                                                                                                                    is properly documented for tax and accounting purposes;
                                                                                                                                                                    they also make it easier to track payments. See also
                                                                                                                                                                    @var.identifier, a property that is UNIVOQUELY unique
                                                                                                                                                                    between ALL invoices of a system. *} */
    public      $currency                       = null;             /* {*property   $currency                       (string)                                        3-character code (ISO 4217)
                                                                                                                                                                    ([url]https://docs.1010data.com/1010dataReferenceManual/DataTypesAndFormats/currencyUnitCodes.html[/url]) *} */
    public      $finalPaymentDate               = null;             /* {*property   $finalPaymentDate               (Date|DateTime|string)                          The date the invoice was FULLY paid ([c]YYYYMMDD[/c] format). *} */
    public      $lupdate                        = null;             /* {*property   $lupdate                        (Date|DateTime|string)                          The date the invoice was last modified ([c]YYYYMMDDHHmmSS[/c] format). *} */
    public      $paid                           = false;            /* {*property   $paid                           (bool)                                          [c]true[/c] if the invoice is FULLY paid (see also @var.finalPaymentDate);
                                                                                                                                                                    [c]false[/c] if not. A partially paid invoice is considered NOT paid. *} */
    public      $cancelled                      = false;            /* {*property   $cancelled                      (bool)                                          [c]true[/c] if the invoice is considered cancelled; [c]false[/c] if not. *} */
    public      $proforma                       = false;            /* {*property   $proforma                       (bool)                                          [c]true[/c] if the invoice is a proforma; [c]false[/c] if not. *} */
    public      $draft                          = false;            /* {*property   $draft                          (bool)                                          [c]true[/c] if the invoice is in draft mode; [c]false[/c] if not. *} */
    public      $structCommunication            = false;            /* {*property   $structCommunication            (bool)                                          [c]true[/c] if the invoice uses a Structured Communication; [c]false[/c]
                                                                                                                                                                    if not. There are two types of transfers: the ones with a free communication
                                                                                                                                                                    (VCL - "Virement à Communication Libre", and VCS - "Virement à Communication
                                                                                                                                                                    Structurée). When VCS is required, it needs to be printed on the invoice
                                                                                                                                                                    (however ... this is NOT implemented yet). *} */
    public      $sent                           = false;            /* {*property   $sent                           (bool)                                          [c]true[/c] if the invoice was sent to the customer; [c]false[/c] if not. *} */
    public      $aLines                         = null;             /* {*property   $aLines                         (array)                                         Lines of detail or [c]null[/c] if none found *} */
    public      $projectID                      = null;             /* {*property   $projectID                      (string)                                        Project identifier the invoice is FULLY linked to *} */
    public      $dateFormat                     = 'd-m-Y';          /* {*property   $dateFormat                     (string)                                        The format that must be used to display dates *} */

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

        {*example
        use \trql\vaesoli\Vaesoli   as v;
        use \trql\quitus\Invoice    as Invoice;

        if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
            require_once( 'trql.vaesoli.class.php' );

        if ( ! defined( 'INVOICE_CLASS_VERSION' ) )
            require_once( 'trql.invoice.class.php' );

        [b]$o = new Invoice();[/b]

        // Load an invoice to have it all filled
        $o->load( $szFile = 'invoice.xml' )

        // Now, let's reset everything
        [b]$o->reset();[/b]

        // Check how it looks now (should be all empty)
        var_dump( $o->__toXML() );

        [b][i]// Let's create the invoice from scratch all manually
        $o->identifier                          = v::guid( true );
        $o->name                                = 'This is an invoice that wa have created from scratch';
        $o->description                         = 'Est plane, Piso, ut dicis, inquit. Nam me ipsum huc modo venientem convertebat '     .
                                                  'ad sese Coloneus ille locus, cuius incola Sophocles ob oculos versabatur, quem '     .
                                                  'scis quam admirer quemque eo delecter. Me quidem ad altiorem memoriam Oedipodis '    .
                                                  'huc venientis et illo mollissimo carmine quaenam essent ipsa haec loca '             .
                                                  'requirentis species quaedam commovit, inaniter scilicet, sed commovit tamen.';
        $o->issueDate                           = date( 'Ymd' );
        $o->paymentDueDate                      = date( 'Ymd',strtotime( $o->issueDate ) + ( 86400 * 30 ) );  // ± 1 month later
        $o->refNumber                           = date('Y') . '/000001';

        $o->customer->identifier                = '';
        $o->customer->name                      = 'My beautiful customer';
        $o->customer->vatID                     = 'BE0463.478.965';    // No check made

        $o->billingAddress->streetAddress       = 'Rue des fleurs, 1';
        $o->billingAddress->postalCode          = '1000';
        $o->billingAddress->addressLocality     = 'Brussels';
        $o->billingAddress->addressCountry      = 'BE';

        $o->sent                                = true;
        $o->footer                              = 'Please be aware that we will be closed next week';
        $o->memo                                = 'To be sent to accounting bureau';

        $o->addDetail( array( 'utc'         => time()   ,
                              'id'          => ''       ,
                              'desc'        => 'a desc' ,
                              'qty'         => 1        ,
                              'unitprice'   => 15       ,
                              'vatpercent'  => 21.00    ,
                            ) );

        if ( $o->save( 'newinvoice.xml' ) )
            var_dump( 'Invoice saved' );[/i][/b]

        // Check how it looks now (should be filled with all data we've given)
        var_dump( $o->__toXML() );

        *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szHome = null )
    /*-----------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        $this->deliveryAddress  = new PostalAddress();
        $this->billingAddress   = new PostalAddress();
        $this->customer         = new Customer();
        $this->referencesOrder  = new Order();
        $this->provider         = new Organization();
        $this->issuer           = new Organization();

        return ( $this );
    }   /* End of Invoice.__construct() =============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*load( $szFile )=

        Loads an invoice from its persistent layer (an XML file)

        {*params
            $szFile         (string)        The file to load
        *}

        {*return
            (bool)      [c]true[/c] if @param.szFile was successfully loaded; [c]false[/c]
                        if not.
        *}

        {*seealso
            @fnc.save
        *}

        {*warning
            Invoices stored in files may have or not have any idea of who the @var.issuer
            of the invoice is.
        *}

        {*example
        use \trql\vaesoli\Vaesoli   as v;
        use \trql\quitus\Invoice    as Invoice;

        if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
            require_once( 'trql.vaesoli.class.php' );

        if ( ! defined( 'INVOICE_CLASS_VERSION' ) )
            require_once( 'trql.invoice.class.php' );

        $o = new Invoice();

        // Load an invoice that has the same name as the source code file
        if ( [b]$o->load( $szFile = str_replace( '.php','.xml',__FILE__ ) )[/b] )
        {
            // Let's see what it looks like in JSON
            echo $o->__toJSON();

            // Make a new file with the current date and time in it
            $szFile = str_replace( '.php','.' . date( 'YmdHis' ) . '.xml',__FILE__ );

            // Make just a few changes to see
            // if they can be saved ...
            $o->identifier  = v::guid( true );
            $o->description = strrev( $o->description );
            $o->name        = strrev( $o->name );

            // Let's get the last line of detail
            $aLine = end( $o->aLines );

            // Modify few values (multiply by 2)
            $aLine['qty' ] = $aLine['qty' ] * 2;
            $aLine['htva'] = $aLine['htva'] * 2;
            $aLine['tva' ] = $aLine['tva' ] * 2;
            $aLine['tvac'] = $aLine['tvac'] * 2;

            // Check how what the line looks like
            var_dump( $aLine );

            // Adding this line to the list of lines we already have
            $o->addDetail( $aLine );

            // Save this invoice to a new file now
            if ( $o->save( $szFile ) )
                var_dump( "Invoice successfully saved to {$szFile}" );
        }
        *}

        *}}
    */
    /* ================================================================================ */
    public function load( $szFile )
    /*---------------------------*/
    {
        $bRetVal = false;

        if ( is_file( $szFile ) )
        {
            //var_dump( $szFile . ' FOUND' );

            $oDom = new \DOMDocument();

            if ( $oDom->load( $szFile ) )
            {
                //var_dump( $szFile . " LOADED" );
                $oXPath     = new \DOMXPath( $oDom );
                $oRootNode  = $oDom->documentElement;

                $this->identifier           =                   $oRootNode->getAttribute('id');
                $this->active               = v::MISC_CastBool( $oRootNode->getAttribute('active') );
                $this->lang                 =                   $oRootNode->getAttribute('lang');
                $this->type                 =                   $oRootNode->getAttribute('type');
                $this->version              =                   $oRootNode->getAttribute('version');
                $this->issueDate            =                   $oRootNode->getAttribute('date');
                $this->finalPaymentDate     =                   $oRootNode->getAttribute('paiddate');
                $this->paymentDueDate       =                   $oRootNode->getAttribute('duedate');
                $this->lupdate              =                   $oRootNode->getAttribute('lupdate');
                $this->refNumber            =                   $oRootNode->getAttribute('ref');
                $this->currency             =                   $oRootNode->getAttribute('currency');
                $this->prepayment           =           (float) $oRootNode->getAttribute('prepayment');
                $this->totalPaymentDue      =           (float) $oRootNode->getAttribute('totaldue');
                $this->totalHTVA            =           (float) $oRootNode->getAttribute('htva');
                $this->totalTVA             =           (float) $oRootNode->getAttribute('tva');
                $this->totalTVAC            =           (float) $oRootNode->getAttribute('tvac');
                $this->discountHTVA         =           (float) $oRootNode->getAttribute('discounthtva');
                $this->discountTVA          =           (float) $oRootNode->getAttribute('discounttva');
                $this->discountTVAC         =           (float) $oRootNode->getAttribute('discounttvac');
                $this->cancelled            = v::MISC_CastBool( $oRootNode->getAttribute('cancelled') );
                $this->proforma             = v::MISC_CastBool( $oRootNode->getAttribute('proforma') );
                $this->draft                = v::MISC_CastBool( $oRootNode->getAttribute('draft') );
                $this->structCommunication  = v::MISC_CastBool( $oRootNode->getAttribute('vcs') );

                if ( ( $o = $oXPath->query( 'InvoiceName',$oRootNode ) ) && $o->length > 0 )
                    $this->name = $o->item(0)->nodeValue;

                if ( ( $o = $oXPath->query( 'Description',$oRootNode ) ) && $o->length > 0 )
                    $this->description = $o->item(0)->nodeValue;


                /************************************************/
                /* ISSUER                                       */
                /************************************************/
                if ( ( $o = $oXPath->query( 'Issuer',$oRootNode ) ) && $o->length > 0 )
                {
                    $oIssuerNode = $o->item(0);

                    $this->issuer->identifier = $oIssuerNode->getAttribute( 'id' );

                    if ( ( $o = $oXPath->query( 'Name',$oIssuerNode      ) ) && $o->length > 0 )
                        $this->issuer->name = $o->item(0)->nodeValue;

                    if ( ( $o = $oXPath->query( 'LegalName',$oIssuerNode ) ) && $o->length > 0 )
                        $this->issuer->legalName = $o->item(0)->nodeValue;

                    if ( ( $o = $oXPath->query( 'LegalForm',$oIssuerNode ) ) && $o->length > 0 )
                        $this->issuer->legalForm  = $o->item(0)->nodeValue;

                    if ( ( $o = $oXPath->query( 'TaxID',$oIssuerNode     ) ) && $o->length > 0 )
                        $this->issuer->taxID = $o->item(0)->nodeValue;

                    if ( ( $o = $oXPath->query( 'Email',$oIssuerNode     ) ) && $o->length > 0 )
                        $this->issuer->email = $o->item(0)->nodeValue;

                    if ( ( $o = $oXPath->query( 'Url',$oIssuerNode       ) ) && $o->length > 0 )
                        $this->issuer->url = $o->item(0)->nodeValue;

                    if ( ( $o = $oXPath->query( 'FaxNumber',$oIssuerNode ) ) && $o->length > 0 )
                        $this->issuer->faxNumber = $o->item(0)->nodeValue;

                    if ( ( $o = $oXPath->query( 'Phone',$oIssuerNode     ) ) && $o->length > 0 )
                        $this->issuer->telephone = $o->item(0)->nodeValue;

                    if ( ( $o = $oXPath->query( 'VATNumber',$oIssuerNode ) ) && $o->length > 0 )
                        $this->issuer->vatID = $o->item(0)->nodeValue;

                    if ( ( $o = $oXPath->query( 'Image',$oIssuerNode     ) ) && $o->length > 0 )
                        $this->issuer->image = $o->item(0)->nodeValue;

                    if ( ( $o = $oXPath->query( 'BankAccount/Bank',$oIssuerNode ) ) && $o->length > 0 )
                        $this->issuer->bankAccount->bank = $o->item(0)->nodeValue;

                    if ( ( $o = $oXPath->query( 'BankAccount/ID',$oIssuerNode   ) ) && $o->length > 0 )
                        $this->issuer->bankAccount->identifier = $o->item(0)->nodeValue;

                    if ( ( $o = $oXPath->query( 'BankAccount/BIC',$oIssuerNode  ) ) && $o->length > 0 )
                        $this->issuer->bankAccount->BICCode = $o->item(0)->nodeValue;

                    /************************************************/
                    /* ADDRESS                                      */
                    /************************************************/
                    {
                        if ( ( $o = $oXPath->query( 'Address',$oIssuerNode ) ) && $o->length > 0 )
                        {
                            $oAddressNode = $o->item(0);

                            if ( ( $o = $oXPath->query( 'Street',$oAddressNode ) ) && $o->length > 0 )
                                $this->issuer->address->streetAddress = $o->item(0)->nodeValue;

                            if ( ( $o = $oXPath->query( 'Zip',$oAddressNode ) ) && $o->length > 0 )
                                $this->issuer->address->postalCode = $o->item(0)->nodeValue;

                            if ( ( $o = $oXPath->query( 'City',$oAddressNode ) ) && $o->length > 0 )
                                $this->issuer->address->addressLocality = $o->item(0)->nodeValue;

                            if ( ( $o = $oXPath->query( 'State',$oAddressNode ) ) && $o->length > 0 )
                                $this->issuer->address->addressRegion = $o->item(0)->nodeValue;

                            if ( ( $o = $oXPath->query( 'Country',$oAddressNode ) ) && $o->length > 0 )
                                $this->issuer->address->addressCountry = $o->item(0)->nodeValue;
                        }   /* if ( ( $o = $oXPath->query( 'Adresses/Billing',$oRootNode ) ) && $o->length > 0 )*/
                    }
                    /************************************************/
                    /* ADDRESS                                      */
                    /************************************************/
                }
                /************************************************/
                /* ISSUER                                       */
                /************************************************/



                /************************************************/
                /* CUSTOMER                                     */
                /************************************************/
                if ( ( $o = $oXPath->query( 'Customer',$oRootNode ) ) && $o->length > 0 )
                {
                    $oCustomerNode = $o->item(0);

                    $this->customer->identifier = $oCustomerNode->getAttribute( 'id' );

                    if ( ( $o = $oXPath->query( 'Name',$oCustomerNode      ) ) && $o->length > 0 )
                        $this->customer->name = $o->item(0)->nodeValue;

                    if ( ( $o = $oXPath->query( 'VATNumber',$oCustomerNode ) ) && $o->length > 0 )
                        $this->customer->vatID = $o->item(0)->nodeValue;

                    /************************************************/
                    /* ADRESSES                                     */
                    /************************************************/
                    {
                        /* BILLING -------------------------------- */
                        if ( ( $o = $oXPath->query( 'Addresses/Billing',$oCustomerNode ) ) && $o->length > 0 )
                        {
                            $oAddressNode = $o->item(0);

                            if ( ( $o = $oXPath->query( 'Street',$oAddressNode ) ) && $o->length > 0 )
                                $this->billingAddress->streetAddress = $o->item(0)->nodeValue;

                            if ( ( $o = $oXPath->query( 'Zip',$oAddressNode ) ) && $o->length > 0 )
                                $this->billingAddress->postalCode = $o->item(0)->nodeValue;

                            if ( ( $o = $oXPath->query( 'City',$oAddressNode ) ) && $o->length > 0 )
                                $this->billingAddress->addressLocality = $o->item(0)->nodeValue;

                            if ( ( $o = $oXPath->query( 'State',$oAddressNode ) ) && $o->length > 0 )
                                $this->billingAddress->addressRegion = $o->item(0)->nodeValue;

                            if ( ( $o = $oXPath->query( 'Country',$oAddressNode ) ) && $o->length > 0 )
                                $this->billingAddress->addressCountry = $o->item(0)->nodeValue;
                        }   /* if ( ( $o = $oXPath->query( 'Adresses/Billing',$oRootNode ) ) && $o->length > 0 )*/
                        /* BILLING -------------------------------- */

                        /* DELIVERY ------------------------------- */
                        if ( ( $o = $oXPath->query( 'Addresses/Delivery',$oCustomerNode ) ) && $o->length > 0 )
                        {
                            $oAddressNode = $o->item(0);

                            if ( ( $o = $oXPath->query( 'Street',$oAddressNode ) ) && $o->length > 0 )
                                $this->deliveryAddress->streetAddress = $o->item(0)->nodeValue;

                            if ( ( $o = $oXPath->query( 'Zip',$oAddressNode ) ) && $o->length > 0 )
                                $this->deliveryAddress->postalCode = $o->item(0)->nodeValue;

                            if ( ( $o = $oXPath->query( 'City',$oAddressNode ) ) && $o->length > 0 )
                                $this->deliveryAddress->addressLocality = $o->item(0)->nodeValue;

                            if ( ( $o = $oXPath->query( 'State',$oAddressNode ) ) && $o->length > 0 )
                                $this->deliveryAddress->addressRegion = $o->item(0)->nodeValue;

                            if ( ( $o = $oXPath->query( 'Country',$oAddressNode ) ) && $o->length > 0 )
                                $this->deliveryAddress->addressCountry = $o->item(0)->nodeValue;
                        }   /* if ( ( $o = $oXPath->query( 'Adresses/Delivery',$oRootNode ) ) && $o->length > 0 )*/
                        /* DELIVERY ------------------------------- */
                    }
                    /************************************************/
                    /* ADDRESSES                                    */
                    /************************************************/
                }
                /************************************************/
                /* CUSTOMER                                     */
                /************************************************/

                if ( ( $o = $oXPath->query( 'Project',$oRootNode ) ) && $o->length > 0 )
                    $this->projectID = $o->item(0)->getAttribute('id');

                /************************************************/
                /* ORDER                                        */
                /************************************************/
                if ( ( $o = $oXPath->query( 'Order',$oRootNode ) ) && $o->length > 0 )
                {
                    $oOrderNode = $o->item(0);

                    $this->referencesOrder->orderDate = $oOrderNode->getAttribute( 'date' );

                    if ( ( $o = $oXPath->query( 'ID',$oOrderNode ) ) && $o->length > 0 )
                        $this->referencesOrder->identifier = $o->item(0)->nodeValue;

                    if ( ( $o = $oXPath->query( 'Ref',$oCustomerNode ) ) && $o->length > 0 )
                        $this->referencesOrder->orderNumber = $o->item(0)->nodeValue;
                }
                /************************************************/
                /* ORDER                                        */
                /************************************************/


                /************************************************/
                /* ADDRESSES                                    */
                /************************************************/
                /* If we haven't extracted the addresses yet from
                   the "Customer" structure, let's try to extract
                   these values from another place in the XML */
                if ( empty( $this->billingAddress->streetAddress ) )
                {
                    /* BILLING -------------------------------- */
                    if ( ( $o = $oXPath->query( 'Addresses/Billing',$oRootNode ) ) && $o->length > 0 )
                    {
                        $oAddressNode = $o->item(0);

                        if ( ( $o = $oXPath->query( 'Street',$oAddressNode ) ) && $o->length > 0 )
                            $this->billingAddress->streetAddress = $o->item(0)->nodeValue;

                        if ( ( $o = $oXPath->query( 'Zip',$oAddressNode ) ) && $o->length > 0 )
                            $this->billingAddress->postalCode = $o->item(0)->nodeValue;

                        if ( ( $o = $oXPath->query( 'City',$oAddressNode ) ) && $o->length > 0 )
                            $this->billingAddress->addressLocality = $o->item(0)->nodeValue;

                        if ( ( $o = $oXPath->query( 'State',$oAddressNode ) ) && $o->length > 0 )
                            $this->billingAddress->addressRegion = $o->item(0)->nodeValue;

                        if ( ( $o = $oXPath->query( 'Country',$oAddressNode ) ) && $o->length > 0 )
                            $this->billingAddress->addressCountry = $o->item(0)->nodeValue;
                    }   /* if ( ( $o = $oXPath->query( 'Adresses/Billing',$oRootNode ) ) && $o->length > 0 )*/
                    /* BILLING -------------------------------- */

                    /* DELIVERY ------------------------------- */
                    if ( ( $o = $oXPath->query( 'Addresses/Delivery',$oRootNode ) ) && $o->length > 0 )
                    {
                        $oAddressNode = $o->item(0);

                        if ( ( $o = $oXPath->query( 'Street',$oAddressNode ) ) && $o->length > 0 )
                            $this->deliveryAddress->streetAddress = $o->item(0)->nodeValue;

                        if ( ( $o = $oXPath->query( 'Zip',$oAddressNode ) ) && $o->length > 0 )
                            $this->deliveryAddress->postalCode = $o->item(0)->nodeValue;

                        if ( ( $o = $oXPath->query( 'City',$oAddressNode ) ) && $o->length > 0 )
                            $this->deliveryAddress->addressLocality = $o->item(0)->nodeValue;

                        if ( ( $o = $oXPath->query( 'State',$oAddressNode ) ) && $o->length > 0 )
                            $this->deliveryAddress->addressRegion = $o->item(0)->nodeValue;

                        if ( ( $o = $oXPath->query( 'Country',$oAddressNode ) ) && $o->length > 0 )
                            $this->deliveryAddress->addressCountry = $o->item(0)->nodeValue;
                    }   /* if ( ( $o = $oXPath->query( 'Adresses/Delivery',$oRootNode ) ) && $o->length > 0 )*/
                    /* DELIVERY ------------------------------- */
                }
                /************************************************/
                /* ADDRESSES                                    */
                /************************************************/

                if ( ( $o = $oXPath->query( 'Management/Paid',$oRootNode ) ) && $o->length > 0 )
                    $this->paid = v::MISC_CastBool( $o->item(0)->nodeValue );

                if ( ( $o = $oXPath->query( 'Management/Sent',$oRootNode ) ) && $o->length > 0 )
                    $this->sent = v::MISC_CastBool( $o->item(0)->nodeValue );

                if ( ( $o = $oXPath->query( 'Footer',$oRootNode ) ) && $o->length > 0 )
                    $this->footer = $o->item(0)->nodeValue;

                if ( ( $o = $oXPath->query( 'Memo',$oRootNode ) ) && $o->length > 0 )
                    $this->memo = $o->item(0)->nodeValue;

                /************************************************/
                /* INVOICE BODY                                 */
                /************************************************/
                if ( ( $o = $oXPath->query( 'Body',$oRootNode ) ) && $o->length > 0 )
                {
                    $this->aLines   = null;     // Reset the lines of detail
                    $oBodyNode      = $o->item(0);

                    if ( ( $aLines = $oXPath->query( 'Line',$oBodyNode ) ) && $o->length > 0 )
                    {
                        foreach ( $aLines as $oLineNode )
                        {
                            $iUTC           = 0;
                            $szDesc         = null;
                            $szID           = null;
                            $quantity       = 0.0;
                            $fUnitPrice     = 0.0;
                            $fHTVA          = 0.0;
                            $fVATPercent    = 0.0;
                            $fTVA           = 0.0;
                            $fTVAC          = 0.0;

                            $iUTC           = (int) $oLineNode->getAttribute('lupdate' );
                            // ICI ON SEMBLE AVOIR UN PROBLEME

                            if ( ( $o = $oXPath->query( 'Desc',$oLineNode ) ) && $o->length > 0 )
                                $szDesc = $o->item(0)->nodeValue;

                            if ( ( $o = $oXPath->query( 'ID',$oLineNode ) ) && $o->length > 0 )
                                $szID = $o->item(0)->nodeValue;

                            if ( ( $o = $oXPath->query( 'Qty',$oLineNode ) ) && $o->length > 0 )
                                $quantity = (float) $o->item(0)->nodeValue;

                            if ( ( $o = $oXPath->query( 'UnitPrice',$oLineNode ) ) && $o->length > 0 )
                                $fUnitPrice = (float) $o->item(0)->nodeValue;

                            if ( ( $o = $oXPath->query( 'htva',$oLineNode ) ) && $o->length > 0 )
                                $fHTVA = (float) $o->item(0)->nodeValue;

                            if ( ( $o = $oXPath->query( 'VATPercent',$oLineNode ) ) && $o->length > 0 )
                                $fVATPercent = (float) $o->item(0)->nodeValue;

                            if ( ( $o = $oXPath->query( 'tva',$oLineNode ) ) && $o->length > 0 )
                                $fTVA = (float) $o->item(0)->nodeValue;

                            if ( ( $o = $oXPath->query( 'tvac',$oLineNode ) ) && $o->length > 0 )
                                $fTVAC = (float) $o->item(0)->nodeValue;

                            $this->aLines[] = array( 'utc'          => $iUTC        ,
                                                     'id'           => $szID        ,
                                                     'desc'         => $szDesc      ,
                                                     'qty'          => $quantity    ,
                                                     'unitprice'    => $fUnitPrice  ,
                                                     'htva'         => $fHTVA       ,
                                                     'vatpercent'   => $fVATPercent ,
                                                     'tva'          => $fTVA        ,
                                                     'tvac'         => $fTVAC       ,
                                                   );
                        }
                    }


                }   /* if ( ( $o = $oXPath->query( 'Body',$oRootNode ) ) && $o->length > 0 ) */
                /************************************************/
                /* INVOICE BODY                                 */
                /************************************************/

                //var_dump( $this->name,$this->description,$this->footer,$this->memo,$this->paid,$this->totalTVAC,$this->currency );

                $bRetVal = true;
            }
        }   /* if ( is_file( $szFile ) ) */

        return ( $bRetVal );
    }   /* End of Invoice.load() ====================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*save( $szFile )=

        Saves an invoice to its persistent layer (an XML file)

        {*params
            $szFile         (string)        The file to save the invoice to
        *}

        {*return
            (bool)      [c]true[/c] if @param.szFile successfully saved; [c]false[/c]
                        if not.
        *}

        {*seealso
            @fnc.load
        *}

        {*example
        use \trql\vaesoli\Vaesoli   as v;
        use \trql\quitus\Invoice    as Invoice;

        if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
            require_once( 'trql.vaesoli.class.php' );

        if ( ! defined( 'INVOICE_CLASS_VERSION' ) )
            require_once( 'trql.invoice.class.php' );

        $o = new Invoice();

        // Load an invoice that has the same name as the source code file
        if ( $o->load( $szFile = str_replace( '.php','.xml',__FILE__ ) ) )
        {
            // Let's see what it looks like in JSON
            echo $o->__toJSON();

            // Make a new file with the current date and time in it
            $szFile = str_replace( '.php','.' . date( 'YmdHis' ) . '.xml',__FILE__ );

            // Make just a few changes to see
            // if they can be saved ...
            $o->identifier  = v::guid( true );
            $o->description = strrev( $o->description );
            $o->name        = strrev( $o->name );

            // Let's get the last line of detail
            $aLine = end( $o->aLines );

            // Modify few values (multiply by 2)
            $aLine['qty' ] = $aLine['qty' ] * 2;
            $aLine['htva'] = $aLine['htva'] * 2;
            $aLine['tva' ] = $aLine['tva' ] * 2;
            $aLine['tvac'] = $aLine['tvac'] * 2;

            // Check how what the line looks like
            var_dump( $aLine );

            // Adding this line to the list of lines we already have
            $o->addDetail( $aLine );

            [b]// Save this invoice to a new file now
            if ( $o->save( $szFile ) )
                var_dump( "Invoice successfully saved to {$szFile}" );[/b]
        }
        *}

        *}}
    */
    /* ================================================================================ */
    public function save( $szFile )
    /*---------------------------*/
    {
        return ( v::FIL_StrToFile( $this->__toXML(),$szFile ) );
    }   /* End of Invoice.save() ====================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*computeAll()=

        Computes all internam amounts

        {*params
        *}

        {*return
            (self)      Current instance of the class
        *}

        {*remark
            All internal amounts are refreshed
        *}

        {*seealso
            @fnc.__deleteDetail, @fnc.addDetail
        *}

        *}}
    */
    /* ================================================================================ */
    public function computeAll()
    /*------------------------*/
    {
        $fTotalHTVA = 0.0;
        $fTotalTVA  = 0.0;
        $fTotalTVAC = 0.0;

        foreach ( $this->aLines as $aLine )
        {
            $fLineHTVA = $aLine['qty'] * $aLine['unitprice'];
            $fLineTVA  = $fLineHTVA * ( $aLine['vatpercent'] / 100 );
            $fLineTVAC = $fLineHTVA + $fLineTVA;

            $fTotalHTVA += $fLineHTVA;
            $fTotalTVA  += $fLineTVA;
            $fTotalTVAC += $fLineTVAC;
        }   /* foreach ( $this->aLines as $aLine ) */

        $this->totalHTVA        = $fTotalHTVA  - $this->discountHTVA;
        $this->totalTVA         = $fTotalTVA   - $this->discountTVA;
        $this->totalTVAC        = $fTotalTVAC  - $this->discountTVAC;

        $this->totalPaymentDue  = $this->totalTVAC - $this->prepayment;

        return ( $this );
    }   /* End of Invoice.computeAll() ================================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*deleteDetail( $iOffset )=

        Deletes a line of detail

        {*params
            $iOffset    (int)       Offset in @var.aLines to delete.
        *}

        {*return
            (self)      Current instance of the class
        *}

        {*remark
            All internal amounts are refreshed
        *}

        {*seealso
            @fnc.__addDetail, @fnc.computeAll
        *}

        {*example
        use \trql\vaesoli\Vaesoli   as v;
        use \trql\quitus\Invoice    as Invoice;

        if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
            require_once( 'trql.vaesoli.class.php' );

        if ( ! defined( 'INVOICE_CLASS_VERSION' ) )
            require_once( 'trql.invoice.class.php' );

        $o = new Invoice();

        // Let's create the invoice from scratch all manually
        $o->identifier                          = v::guid( true );
        $o->name                                = 'This is an invoice that wa have created from scratch';
        $o->description                         = 'Est plane, Piso, ut dicis, inquit. Nam me ipsum huc modo venientem convertebat '     .
                                                  'ad sese Coloneus ille locus, cuius incola Sophocles ob oculos versabatur, quem '     .
                                                  'scis quam admirer quemque eo delecter. Me quidem ad altiorem memoriam Oedipodis '    .
                                                  'huc venientis et illo mollissimo carmine quaenam essent ipsa haec loca '             .
                                                  'requirentis species quaedam commovit, inaniter scilicet, sed commovit tamen.';
        $o->issueDate                           = date( 'Ymd' );
        $o->paymentDueDate                      = date( 'Ymd',strtotime( $o->issueDate ) + ( 86400 * 30 ) );  // ± 1 month later
        $o->refNumber                           = date('Y') . '/000001';

        $o->customer->identifier                = '';
        $o->customer->name                      = 'My beautiful customer';
        $o->customer->vatID                     = 'BE0463.478.965';    // No check made

        $o->billingAddress->streetAddress       = 'Rue des fleurs, 1';
        $o->billingAddress->postalCode          = '1000';
        $o->billingAddress->addressLocality     = 'Brussels';
        $o->billingAddress->addressCountry      = 'BE';

        $o->sent                                = true;
        $o->footer                              = 'Please be aware that we will be closed next week';
        $o->memo                                = 'To be sent to accounting bureau';

        $o->addDetail( array( 'utc'         => time()   ,
                              'id'          => ''       ,
                              'desc'        => 'a desc' ,
                              'qty'         => 1        ,
                              'unitprice'   => 15       ,
                              'vatpercent'  => 21.00    ,
                            ) );

        $o->addDetail( array( 'utc'         => time()   ,
                              'id'          => ''       ,
                              'desc'        => 'something else',
                              'qty'         => 2        ,
                              'unitprice'   => 15       ,
                              'vatpercent'  => 21.00    ,
                            ) );

        // Check the lines of detail
        var_dump( $o->aLines );

        // Delete the 1st line of detail
        [b]$o->deleteDetail( 0 );[/b]

        // Check the lines of detail (there should be 1 left)
        var_dump( $o->aLines );

        // Check the XML to see if it's what we expect
        var_dump( $o->__toXML() );
        *}

        *}}
    */
    /* ================================================================================ */
    public function deleteDetail( $iOffset )
    /*------------------------------------*/
    {
        $iOffset = abs( $iOffset );
        if (  is_null( $this->aLines  ) ||
            ! is_array( $this->aLines ) ||
            $iOffset >= count( $this->aLines )
           )
        {
            goto end;
        }

        if ( isset( $this->aLines[$iOffset] ) )
        {
            unset( $this->aLines[$iOffset] );
            $this->aLines = array_values( $this->aLines );
        }   /* if ( isset( $this->aLines[$iOffset] ) ) */

        $this->computeAll();

        end:
        return ( $this );
    }   /* End of Invoice.deleteDetail() ============================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*addDetail( $a )=

        Adds a line of detail

        {*params
            $a      (array)     Associative array with at least these members:[br][br]

                                    @param.a['qty'       ] ... the quantity[br]
                                    @param.a['unitprice' ] ... the unit price[br]
                                    @param.a['vatpercent'] ... the VAT percentage[br][br]

                                    Additional slots:[br][br]

                                    @param.a['utc'       ] ... UTC[br]
                                    @param.a['id'        ] ... line ID[br]
                                    @param.a['desc'      ] ... line description[br]
        *}

        {*return
            (self)      Current instance of the class
        *}

        {*remark
            All internal amounts are refreshed
        *}

        {*seealso
            @fnc.__deleteDetail, @fnc.computeAll
        *}

        {*example
        use \trql\vaesoli\Vaesoli   as v;
        use \trql\quitus\Invoice    as Invoice;

        if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
            require_once( 'trql.vaesoli.class.php' );

        if ( ! defined( 'INVOICE_CLASS_VERSION' ) )
            require_once( 'trql.invoice.class.php' );

        $o = new Invoice();

        // Let's create the invoice from scratch all manually
        $o->identifier                          = v::guid( true );
        $o->name                                = 'This is an invoice that wa have created from scratch';
        $o->description                         = 'Est plane, Piso, ut dicis, inquit. Nam me ipsum huc modo venientem convertebat '     .
                                                  'ad sese Coloneus ille locus, cuius incola Sophocles ob oculos versabatur, quem '     .
                                                  'scis quam admirer quemque eo delecter. Me quidem ad altiorem memoriam Oedipodis '    .
                                                  'huc venientis et illo mollissimo carmine quaenam essent ipsa haec loca '             .
                                                  'requirentis species quaedam commovit, inaniter scilicet, sed commovit tamen.';
        $o->issueDate                           = date( 'Ymd' );
        $o->paymentDueDate                      = date( 'Ymd',strtotime( $o->issueDate ) + ( 86400 * 30 ) );  // ± 1 month later
        $o->refNumber                           = date('Y') . '/000001';

        $o->customer->identifier                = '';
        $o->customer->name                      = 'My beautiful customer';
        $o->customer->vatID                     = 'BE0463.478.965';    // No check made

        $o->billingAddress->streetAddress       = 'Rue des fleurs, 1';
        $o->billingAddress->postalCode          = '1000';
        $o->billingAddress->addressLocality     = 'Brussels';
        $o->billingAddress->addressCountry      = 'BE';

        $o->sent                                = true;
        $o->footer                              = 'Please be aware that we will be closed next week';
        $o->memo                                = 'To be sent to accounting bureau';

        [b]$o->addDetail( array( 'utc'         => time()   ,
                              'id'          => ''       ,
                              'desc'        => 'a desc' ,
                              'qty'         => 1        ,
                              'unitprice'   => 15       ,
                              'vatpercent'  => 21.00    ,
                            ) );

        $o->addDetail( array( 'utc'         => time()   ,
                              'id'          => ''       ,
                              'desc'        => 'something else',
                              'qty'         => 2        ,
                              'unitprice'   => 15       ,
                              'vatpercent'  => 21.00    ,
                            ) );[/b]

        // Check the lines of detail
        var_dump( $o->aLines );

        // Delete the 1st line of detail
        $o->deleteDetail( 0 );

        // Check the lines of detail (there should be 1 left)
        var_dump( $o->aLines );

        // Check the XML to see if it's what we expect
        var_dump( $o->__toXML() );
        *}

        *}}
    */
    /* ================================================================================ */
    public function addDetail( $aLine )
    /*-------------------------------*/
    {
        if ( is_array( $aLine )             &&
             isset( $aLine['qty'       ] )  &&
             isset( $aLine['unitprice' ] )  &&
             isset( $aLine['vatpercent'] ) )
        {
            $a['utc'       ] =         $aLine['utc']  ?? time();
            $a['id'        ] =         $aLine['id']   ?? '';
            $a['desc'      ] =         $aLine['desc'] ?? '';
            $a['qty'       ] = (float) $aLine['qty'];
            $a['unitprice' ] = (float) $aLine['unitprice'];
            $a['vatpercent'] =         $aLine['vatpercent'];
            $a['htva'      ] = $a['qty' ] *   $a['unitprice'];
            $a['tva'       ] = $a['htva'] * ( $a['vatpercent'] / 100 );
            $a['tvac'      ] = $a['htva'] +   $a['tva'];

            $this->aLines[] = $a;
        }   /* if ( is_array( $aLine ) && ... */

        $this->computeAll();

        return ( $this );
    }   /* End of Invoice.addDetail() ================================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*reset()=

        Resets all internal properties

        {*params
        *}

        {*return
            (self)      Current instance of the class
        *}

        *}}
    */
    /* ================================================================================ */
    public function reset()
    /*-------------------*/
    {
        $this->aLines                   = null;
        $this->accountId                = null;
        $this->active                   = false;
        $this->billingAddress           = new PostalAddress();
        $this->billingPeriod            = null;
        $this->broker                   = null;
        $this->cancelled                = false;
        $this->category                 = null;
        $this->confirmationNumber       = null;
        $this->customer                 = new Customer();
        $this->deliveryAddress          = new PostalAddress();
        $this->description              = null;
        $this->discountHTVA             = '0.0';
        $this->discountTVA              = '0.0';
        $this->discountTVAC             = '0.0';
        $this->draft                    = false;
        $this->finalPaymentDate         = null;
        $this->footer                   = null;
        $this->iRounding                = 4;
        $this->identifier               = null;
        $this->issueDate                = null;
        $this->issuer                   = new Organization();
        $this->lang                     = 'fr';
        $this->lupdate                  = null;
        $this->name                     = null;
        $this->memo                     = null;
        $this->minimumPaymentDue        = null;
        $this->paid                     = false;
        $this->paymentDueDate           = null;
        $this->paymentMethod            = null;
        $this->paymentMethodId          = null;
        $this->paymentStatus            = null;
        $this->prepayment                = '0.0';
        $this->proforma                 = false;
        $this->projectID                = null;
        $this->provider                 = new Organization();
        $this->refNumber                = null;
        $this->referencesOrder          = new Order();
        $this->scheduledPaymentDate     = null;
        $this->sent                     = false;
        $this->structCommunication      = false;
        $this->totalHTVA                = '0.0';
        $this->totalPaymentDue          = null;
        $this->totalTVA                 = '0.0';
        $this->totalTVAC                = '0.0';
        $this->type                     = 'I';
        $this->version                  = '3.0';
        $this->wikidataId               = 'Q190581';

    }   /* End of Invoice.reset() ===================================================== */
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
            This method is EXPERIMENTAL. DO NOT USE IT. UNFINISHED WORK!
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
    /** {{*__toXML()=

        Turns the object into an XML structure

        {*params
        *}

        {*return
            (string)    XML representation of an invoice
        *}

        {*remark
            If the properties are filled, their values will be reflected in the XML
        *}

        {*example
        use \trql\vaesoli\Vaesoli   as v;
        use \trql\quitus\Invoice    as Invoice;

        if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
            require_once( 'trql.vaesoli.class.php' );

        if ( ! defined( 'INVOICE_CLASS_VERSION' ) )
            require_once( 'trql.invoice.class.php' );

        [b]$o = new Invoice();[/b]

        // Let's create the invoice from scratch all manually
        $o->identifier                          = v::guid( true );
        $o->name                                = 'This is an invoice that wa have created from scratch';
        $o->description                         = 'Est plane, Piso, ut dicis, inquit. Nam me ipsum huc modo venientem convertebat '     .
                                                  'ad sese Coloneus ille locus, cuius incola Sophocles ob oculos versabatur, quem '     .
                                                  'scis quam admirer quemque eo delecter. Me quidem ad altiorem memoriam Oedipodis '    .
                                                  'huc venientis et illo mollissimo carmine quaenam essent ipsa haec loca '             .
                                                  'requirentis species quaedam commovit, inaniter scilicet, sed commovit tamen.';
        $o->issueDate                           = date( 'Ymd' );
        $o->paymentDueDate                      = date( 'Ymd',strtotime( $o->issueDate ) + ( 86400 * 30 ) );  // ± 1 month later
        $o->refNumber                           = date('Y') . '/000001';

        $o->customer->identifier                = '';
        $o->customer->name                      = 'My beautiful customer';
        $o->customer->vatID                     = 'BE0463.478.965';    // No check made

        $o->billingAddress->streetAddress       = 'Rue des fleurs, 1';
        $o->billingAddress->postalCode          = '1000';
        $o->billingAddress->addressLocality     = 'Brussels';
        $o->billingAddress->addressCountry      = 'BE';

        $o->sent                                = true;
        $o->footer                              = 'Please be aware that we will be closed next week';
        $o->memo                                = 'To be sent to accounting bureau';

        $o->addDetail( array( 'utc'         => time()   ,
                              'id'          => ''       ,
                              'desc'        => 'a desc' ,
                              'qty'         => 1        ,
                              'unitprice'   => 15       ,
                              'vatpercent'  => 21.00    ,
                            ) );

        // Check how it looks now (should be filled with all data we've given)
        var_dump( [b]$o->__toXML()[/b] );

        // Gives something like...
        // <?xml version="1.0" encoding="UTF-8" standalone="yes"?>
        // &lt;Invoice xmlns:xi=&quot;http://www.w3.org/2001/XInclude&quot;
        //          xmlns:xsi=&quot;http://www.w3.org/2001/XMLSchema-instance&quot;
        //          xmlns:vae=&quot;urn:lato-sensu-management/Vaesoli&quot;
        //          xmlns:quitus=&quot;urn:lato-sensu-management/Quitus&quot;
        //          id=&quot;84f4870c-3697-2e8f-6f16-a85d5103d9f8&quot;
        //          active=&quot;yes&quot;
        //          lang=&quot;fr&quot;
        //          type=&quot;I&quot;
        //          version=&quot;2.0&quot;
        //          currency=&quot;EUR&quot;
        //          date=&quot;20210318&quot;
        //          duedate=&quot;20210417&quot;
        //          ref=&quot;2021/000001&quot;
        //          prepayment=&quot;0.0000&quot;
        //          totaldue=&quot;181.5000&quot;
        //          htva=&quot;165.0000&quot;
        //          tva=&quot;34.6500&quot;
        //          tvac=&quot;199.6500&quot;
        //          discounthtva=&quot;0.0000&quot;
        //          discounttva=&quot;0.0000&quot;
        //          discounttvac=&quot;0.0000&quot;
        //          cancelled=&quot;no&quot;
        //          proforma=&quot;no&quot;
        //          draft=&quot;no&quot;
        //          vcs=&quot;no&quot;
        //          paiddate=&quot;20140515&quot;
        //          lupdate=&quot;20150115153825&quot;
        //          qver=&quot;0.9.0001&quot;&gt;
        //    &lt;Description&gt;&lt;![CDATA[Est plane, Piso, ut dicis, inquit. Nam me ipsum huc ... ]]&gt;&lt;/Description&gt;
        //    &lt;InvoiceName&gt;&lt;![CDATA[This is an invoice that wa have created from scratch]]&gt;&lt;/InvoiceName&gt;
        //    &lt;Customer id=&quot;&quot;&gt;
        //        &lt;Name&gt;&lt;![CDATA[My beautiful customer]]&gt;&lt;/Name&gt;
        //        &lt;VATNumber&gt;&lt;![CDATA[BE0463.478.965]]&gt;&lt;/VATNumber&gt;
        //        &lt;Addresses&gt;
        //            &lt;Billing&gt;
        //                &lt;Street&gt;&lt;![CDATA[Rue des fleurs, 1]]&gt;&lt;/Street&gt;
        //                &lt;Zip&gt;&lt;![CDATA[1000]]&gt;&lt;/Zip&gt;
        //                &lt;City&gt;&lt;![CDATA[Brussels]]&gt;&lt;/City&gt;
        //                &lt;State&gt;&lt;![CDATA[]]&gt;&lt;/State&gt;
        //                &lt;Country&gt;&lt;![CDATA[BE]]&gt;&lt;/Country&gt;
        //            &lt;/Billing&gt;
        //            &lt;Delivery&gt;
        //                &lt;Street&gt;&lt;![CDATA[]]&gt;&lt;/Street&gt;
        //                &lt;Zip&gt;&lt;![CDATA[]]&gt;&lt;/Zip&gt;
        //                &lt;City&gt;&lt;![CDATA[]]&gt;&lt;/City&gt;
        //                &lt;State&gt;&lt;![CDATA[]]&gt;&lt;/State&gt;
        //                &lt;Country&gt;&lt;![CDATA[]]&gt;&lt;/Country&gt;
        //            &lt;/Delivery&gt;
        //        &lt;/Addresses&gt;
        //    &lt;/Customer&gt;
        //    &lt;Project id=&quot;&quot;/&gt;
        //    &lt;Order date=&quot;&quot;&gt;
        //        &lt;ID&gt;&lt;![CDATA[]]&gt;&lt;/ID&gt;
        //        &lt;Ref&gt;&lt;![CDATA[]]&gt;&lt;/Ref&gt;
        //    &lt;/Order&gt;
        //    &lt;Management&gt;
        //        &lt;Sent&gt;yes&lt;/Sent&gt;
        //        &lt;Paid&gt;yes&lt;/Paid&gt;
        //    &lt;/Management&gt;
        //    &lt;Footer&gt;&lt;![CDATA[Please be aware that we will be closed next week]]&gt;&lt;/Footer&gt;
        //    &lt;Memo&gt;&lt;![CDATA[To be sent to accounting bureau]]&gt;&lt;/Memo&gt;
        //    &lt;Body&gt;
        //       &lt;Line update=&quot;0&quot;&gt;
        //          &lt;Desc&gt;&lt;![CDATA[Lump-sum amount]]&gt;&lt;/Desc&gt;
        //          &lt;ID&gt;&lt;![CDATA[]]&gt;&lt;/ID&gt;
        //          &lt;Qty&gt;&lt;![CDATA[1.0000]]&gt;&lt;/Qty&gt;
        //          &lt;UnitPrice&gt;&lt;![CDATA[150.0000]]&gt;&lt;/UnitPrice&gt;
        //          &lt;htva&gt;&lt;![CDATA[150.0000]]&gt;&lt;/htva&gt;
        //          &lt;VATPercent&gt;&lt;![CDATA[21.0000]]&gt;&lt;/VATPercent&gt;
        //          &lt;tva&gt;&lt;![CDATA[31.5000]]&gt;&lt;/tva&gt;
        //          &lt;tvac&gt;&lt;![CDATA[181.5000]]&gt;&lt;/tvac&gt;
        //       &lt;/Line&gt;
        //
        //       &lt;Line update=&quot;1616086124&quot;&gt;
        //          &lt;Desc&gt;&lt;![CDATA[a desc]]&gt;&lt;/Desc&gt;
        //          &lt;ID&gt;&lt;![CDATA[]]&gt;&lt;/ID&gt;
        //          &lt;Qty&gt;&lt;![CDATA[1.0000]]&gt;&lt;/Qty&gt;
        //          &lt;UnitPrice&gt;&lt;![CDATA[15.0000]]&gt;&lt;/UnitPrice&gt;
        //          &lt;htva&gt;&lt;![CDATA[15.0000]]&gt;&lt;/htva&gt;
        //          &lt;VATPercent&gt;&lt;![CDATA[21.0000]]&gt;&lt;/VATPercent&gt;
        //          &lt;tva&gt;&lt;![CDATA[3.1500]]&gt;&lt;/tva&gt;
        //          &lt;tvac&gt;&lt;![CDATA[18.1500]]&gt;&lt;/tvac&gt;
        //       &lt;/Line&gt;
        //    &lt;/Body&gt;
        // &lt;/Invoice&gt;

        *}}
    */
    /* ================================================================================ */
    public function __toXML() : string
    /*------------------------------*/
    {
        $szRetVal = "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?>\n"                                               .
                    "<Invoice xmlns:xi=\"http://www.w3.org/2001/XInclude\"\n"                                                       .
                    "         xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"\n"                                            .
                    "         xmlns:vae=\"urn:lato-sensu-management/Vaesoli\"\n"                                                    .
                    "         xmlns:quitus=\"urn:lato-sensu-management/Quitus\"\n"                                                  .
                    "         id=\"{$this->identifier}\"\n"                                                                         .
                    "         active=\"" . ( $this->active ? 'yes' : 'no' ) . "\"\n"                                                .
                    "         lang=\"{$this->lang}\"\n"                                                                             .
                    "         type=\"{$this->type}\"\n"                                                                             .
                    "         version=\"{$this->version}\"\n"                                                                       .
                    "         currency=\"{$this->currency}\"\n"                                                                     .
                    "         date=\"{$this->issueDate}\" \n"                                                                       .
                    "         duedate=\"{$this->paymentDueDate}\"\n"                                                                .
                    "         ref=\"{$this->refNumber}\"\n"                                                                         .
                    "         prepayment=\""        . number_format( $this->prepayment      ,$this->iRounding,'.','' )  . "\"\n"    .
                    "         totaldue=\""          . number_format( $this->totalPaymentDue ,$this->iRounding,'.','' )  . "\"\n"    .
                    "         htva=\""              . number_format( $this->totalHTVA       ,$this->iRounding,'.','' )  . "\"\n"    .
                    "         tva=\""               . number_format( $this->totalTVA        ,$this->iRounding,'.','' )  . "\"\n"    .
                    "         tvac=\""              . number_format( $this->totalTVAC       ,$this->iRounding,'.','' )  . "\"\n"    .
                    "         discounthtva=\""      . number_format( $this->discountHTVA    ,$this->iRounding,'.','' )  . "\"\n"    .
                    "         discounttva=\""       . number_format( $this->discountTVA     ,$this->iRounding,'.','' )  . "\"\n"    .
                    "         discounttvac=\""      . number_format( $this->discountTVAC    ,$this->iRounding,'.','' )  . "\"\n"    .
                    "         cancelled=\""         . ( $this->cancelled            ? 'yes' : 'no' )                    . "\"\n"    .
                    "         proforma=\""          . ( $this->proforma             ? 'yes' : 'no' )                    . "\"\n"    .
                    "         draft=\""             . ( $this->draft                ? 'yes' : 'no' )                    . "\"\n"    .
                    "         vcs=\""               . ( $this->structCommunication  ? 'yes' : 'no' )                    . "\"\n"    .
                    "         paiddate=\"{$this->finalPaymentDate}\"\n"                                                             .
                    "         lupdate=\"{$this->lupdate}\"\n"                                                                       .
                    "         qver=\"0.9.0001\">\n"                                                                                 .
                    "   <Description><![CDATA[{$this->description}]]></Description>\n"                                              .
                    "   <InvoiceName><![CDATA[{$this->name}]]></InvoiceName>\n"                                                     .
                    "   <Issuer id=\""                  . ( $this->issuer->identifier                ?? '' ) . "\">\n"              .
                    "       <Name><![CDATA["            . ( $this->issuer->name                      ?? '' ) . "]]></Name>\n"       .
                    "       <LegalName><![CDATA["       . ( $this->issuer->legalName                 ?? '' ) . "]]></LegalName>\n"  .
                    "       <LegalForm><![CDATA["       . ( $this->issuer->legalForm                 ?? '' ) . "]]></LegalForm>\n"  .
                    "       <TaxID><![CDATA["           . ( $this->issuer->taxID                     ?? '' ) . "]]></TaxID>\n"      .
                    "       <VATNumber><![CDATA["       . ( $this->issuer->vatID                     ?? '' ) . "]]></VATNumber>\n"  .
                    "       <Email><![CDATA["           . ( $this->issuer->email                     ?? '' ) . "]]></Email>\n"      .
                    "       <Url><![CDATA["             . ( $this->issuer->url                       ?? '' ) . "]]></Url>\n"        .
                    "       <FaxNumber><![CDATA["       . ( $this->issuer->faxNumber                 ?? '' ) . "]]></FaxNumber>\n"  .
                    "       <Phone><![CDATA["           . ( $this->issuer->telephone                 ?? '' ) . "]]></Phone>\n"      .
                    "       <Image><![CDATA["           . ( $this->issuer->image                     ?? '' ) . "]]></Image>\n"      .
                    "       <BankAccount>\n"                                                                                        .
                    "           <Bank><![CDATA["       . ( $this->issuer->bankAccount->bank         ?? '' ) ."]]></Street>\n"       .
                    "           <ID><![CDATA["         . ( $this->issuer->bankAccount->identifier   ?? '' ) ."]]></Zip>\n"          .
                    "           <BIC><![CDATA["        . ( $this->issuer->bankAccount->BICCode      ?? '' ) ."]]></City>\n"         .
                    "       </BankAccount>\n"                                                                                       .
                    "       <Address>\n"                                                                                            .
                    "           <Street><![CDATA["      . ( $this->issuer->address->streetAddress    ?? '' ) ."]]></Street>\n"      .
                    "           <Zip><![CDATA["         . ( $this->issuer->address->postalCode       ?? '' ) ."]]></Zip>\n"         .
                    "           <City><![CDATA["        . ( $this->issuer->address->addressLocality  ?? '' ) ."]]></City>\n"        .
                    "           <State><![CDATA["       . ( $this->issuer->address->addressRegion    ?? '' ) ."]]></State>\n"       .
                    "           <Country><![CDATA["     . ( $this->issuer->address->addressCountry   ?? '' ) ."]]></Country>\n"     .
                    "       </Address>\n"                                                                                           .
                    "   </Issuer>\n"                                                                                                .
                    "   <Customer id=\""                . ( $this->customer->identifier ?? '' ) . "\">\n"                           .
                    "       <Name><![CDATA["            . ( $this->customer->name       ?? '' ) . "]]></Name>\n"                    .
                    "       <VATNumber><![CDATA["       . ( $this->customer->vatID      ?? '' ) . "]]></VATNumber>\n"               .
                    "       <Addresses>\n"                                                                                          .
                    "           <Billing>\n"                                                                                        .
                    "               <Street><![CDATA["  . ( $this->billingAddress->streetAddress    ?? '' ) ."]]></Street>\n"       .
                    "               <Zip><![CDATA["     . ( $this->billingAddress->postalCode       ?? '' ) ."]]></Zip>\n"          .
                    "               <City><![CDATA["    . ( $this->billingAddress->addressLocality  ?? '' ) ."]]></City>\n"         .
                    "               <State><![CDATA["   . ( $this->billingAddress->addressRegion    ?? '' ) ."]]></State>\n"        .
                    "               <Country><![CDATA[" . ( $this->billingAddress->addressCountry   ?? '' ) ."]]></Country>\n"      .
                    "           </Billing>\n"                                                                                       .
                    "           <Delivery>\n"                                                                                       .
                    "               <Street><![CDATA["  . ( $this->deliveryAddress->streetAddress   ?? '' ) ."]]></Street>\n"       .
                    "               <Zip><![CDATA["     . ( $this->deliveryAddress->postalCode      ?? '' ) ."]]></Zip>\n"          .
                    "               <City><![CDATA["    . ( $this->deliveryAddress->addressLocality ?? '' ) ."]]></City>\n"         .
                    "               <State><![CDATA["   . ( $this->deliveryAddress->addressRegion   ?? '' ) ."]]></State>\n"        .
                    "               <Country><![CDATA[" . ( $this->deliveryAddress->addressCountry  ?? '' ) ."]]></Country>\n"      .
                    "           </Delivery>\n"                                                                                      .
                    "       </Addresses>\n"                                                                                         .
                    "   </Customer>\n"                                                                                              .
                    "   <Project id=\"{$this->projectID}\"/>\n"                                                                     .
                    "   <Order date=\""                 . ( $this->referencesOrder->orderDate   ?? '' ) . "\">\n"                   .
                    "       <ID><![CDATA["              . ( $this->referencesOrder->identifier  ?? '' ) . "]]></ID>\n"              .
                    "       <Ref><![CDATA["             . ( $this->referencesOrder->orderNumber ?? '' ) . "]]></Ref>\n"             .
                    "   </Order>\n"                                                                                                 .
                    "   <Management>\n"                                                                                             .
                    "       <Sent>" . ( $this->sent ? 'yes' : 'no' ) . "</Sent>\n"                                                  .
                    "       <Paid>" . ( $this->paid ? 'yes' : 'no' ) . "</Paid>\n"                                                  .
                    "   </Management>\n"                                                                                            .
                    "   <Footer><![CDATA[{$this->footer}]]></Footer>\n"                                                             .
                    "   <Memo><![CDATA[$this->memo]]></Memo>\n"                                                                     .
                    "   <Body>\n";

                    if ( is_array( $this->aLines ) && count( $this->aLines ) > 0 )
                    {
                        foreach( $this->aLines as $aLine )
                        {
                            $szRetVal .= "        <Line update=\"{$aLine['utc']}\">\n";
                            $szRetVal .= "           <Desc><![CDATA[{$aLine['desc']}]]></Desc>\n";
                            $szRetVal .= "           <ID><![CDATA[{$aLine['id']}]]></ID>\n";
                            $szRetVal .= "           <Qty><![CDATA["        . number_format( $aLine['qty'       ],$this->iRounding,'.','' ) . "]]></Qty>\n";
                            $szRetVal .= "           <UnitPrice><![CDATA["  . number_format( $aLine['unitprice' ],$this->iRounding,'.','' ) . "]]></UnitPrice>\n";
                            $szRetVal .= "           <htva><![CDATA["       . number_format( $aLine['htva'      ],$this->iRounding,'.','' ) . "]]></htva>\n";
                            $szRetVal .= "           <VATPercent><![CDATA[" . number_format( $aLine['vatpercent'],$this->iRounding,'.','' ) . "]]></VATPercent>\n";
                            $szRetVal .= "           <tva><![CDATA["        . number_format( $aLine['tva'       ],$this->iRounding,'.','' ) . "]]></tva>\n";
                            $szRetVal .= "           <tvac><![CDATA["       . number_format( $aLine['tvac'      ],$this->iRounding,'.','' ) . "]]></tvac>\n";
                            $szRetVal .= "        </Line>\n";
                        }   /* foreach( this->aLines as $aLine ) */
                    }   /* if ( is_array( $this->aLines ) && count( $this->aLines ) > 0 ) */

        $szRetVal .= "   </Body>\n"                                                                                                 .
                    "</Invoice>\n";

        // Je dois vérifier que les valeurs
        // ne comprennent pas des caractères invalides

        end:
        return ( $szRetVal );
    }   /* End of Invoice.__toXML() =================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toJSON()=

        Turns the object into a JSON structure

        {*params
        *}

        {*return
            (string)    JSON representation of the invoice object
        *}

        {*example
        use \trql\vaesoli\Vaesoli   as v;
        use \trql\quitus\Invoice    as Invoice;

        if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
            require_once( 'trql.vaesoli.class.php' );

        if ( ! defined( 'INVOICE_CLASS_VERSION' ) )
            require_once( 'trql.invoice.class.php' );

        [b]$o = new Invoice();[/b]

        // Let's create the invoice from scratch all manually
        $o->identifier                          = v::guid( true );
        $o->name                                = 'This is an invoice that wa have created from scratch';
        $o->description                         = 'Est plane, Piso, ut dicis, inquit. Nam me ipsum huc modo venientem convertebat '     .
                                                  'ad sese Coloneus ille locus, cuius incola Sophocles ob oculos versabatur, quem '     .
                                                  'scis quam admirer quemque eo delecter. Me quidem ad altiorem memoriam Oedipodis '    .
                                                  'huc venientis et illo mollissimo carmine quaenam essent ipsa haec loca '             .
                                                  'requirentis species quaedam commovit, inaniter scilicet, sed commovit tamen.';
        $o->issueDate                           = date( 'Ymd' );
        $o->paymentDueDate                      = date( 'Ymd',strtotime( $o->issueDate ) + ( 86400 * 30 ) );  // ± 1 month later
        $o->refNumber                           = date('Y') . '/000001';

        $o->customer->identifier                = '';
        $o->customer->name                      = 'My beautiful customer';
        $o->customer->vatID                     = 'BE0463.478.965';    // No check made

        $o->billingAddress->streetAddress       = 'Rue des fleurs, 1';
        $o->billingAddress->postalCode          = '1000';
        $o->billingAddress->addressLocality     = 'Brussels';
        $o->billingAddress->addressCountry      = 'BE';

        $o->sent                                = true;
        $o->footer                              = 'Please be aware that we will be closed next week';
        $o->memo                                = 'To be sent to accounting bureau';

        $o->addDetail( array( 'utc'         => time()   ,
                              'id'          => ''       ,
                              'desc'        => 'a desc' ,
                              'qty'         => 1        ,
                              'unitprice'   => 15       ,
                              'vatpercent'  => 21.00    ,
                            ) );

        // Check how it looks now (should be filled with all data we've given)
        var_dump( [b]$o->__toJSON()[/b] );

        // Gives something like...
        {"@attributes":{"id":"549c60f4-04c6-d185-f828-79f4d7e58d5e","active":"yes","lang":"fr","type":"I",&#8617;
        "version":"2.0","currency":"EUR","date":"20210318","duedate":"20210417","ref":"2021\/000001",&#8617;
        "prepayment":"0.0000","totaldue":"181.5000","htva":"165.0000","tva":"34.6500","tvac":"199.6500",&#8617;
        "discounthtva":"0.0000","discounttva":"0.0000","discounttvac":"0.0000","cancelled":"no","proforma":"no",&#8617;
        "draft":"no","vcs":"no","paiddate":"20140515","lupdate":"20150115153825","qver":"0.9.0001"},&#8617;
        "Description":"Est plane, Piso, ut dicis, inquit. Nam me ipsum huc modo venientem convertebat ad sese &#8617;
        Coloneus ille locus, cuius incola Sophocles ob oculos versabatur, quem scis quam admirer quemque eo &#8617;
        delecter. Me quidem ad altiorem memoriam Oedipodis huc venientis et illo mollissimo carmine quaenam &#8617;
        essent ipsa haec loca requirentis species quaedam commovit, inaniter scilicet, sed commovit tamen.",&#8617;
        "InvoiceName":"This is an invoice that wa have created from scratch",&#8617;
        "Customer":{"@attributes":{"id":""},"Name":"My beautiful customer","VATNumber":"BE0463.478.965"},&#8617;
        "Project":{"@attributes":{"id":""}},"Order":{"@attributes":{"date":""},"ID":[],"Ref":[]},&#8617;
        "Addresses":{"Billing":{"Street":"Rue des fleurs, 1","Zip":"1000","City":"Brussels","State":[],"Country":"BE"},&#8617;
        "Delivery":{"Street":[],"Zip":[],"City":[],"State":[],"Country":[]}},&#8617;
        "Management":{"Sent":"yes","Paid":"yes"},&#8617;
        "Footer":"Please be aware that we will be closed next week",&#8617;
        "Memo":"To be sent to accounting bureau",&#8617;
        "Body":{"Line":[{"@attributes":{"update":"0"},"Desc":"Lump-sum amount","ID":[],&#8617;
        "Qty":"1.0000","UnitPrice":"150.0000",&#8617;
        "htva":"150.0000","VATPercent":"21.0000","tva":"31.5000","tvac":"181.5000"},&#8617;
        {"@attributes":{"update":"1616086617"},"Desc":"a desc","ID":[],&#8617;
        "Qty":"1.0000","UnitPrice":"15.0000","htva":"15.0000","VATPercent":"21.0000","tva":"3.1500","tvac":"18.1500"}]}}
        *}}
    */
    /* ================================================================================ */
    public function __toJSON() : string
    /*-------------------------------*/
    {
        return ( v::XMLtoJSON( $this->__toXML() ) );
    }   /* End of Invoice.__toJSON() ================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__toHTML()=

        Turns the object to HTML

        {*params
        *}

        {*return
            (string)    HTML representation of an invoice
        *}


        *}}
    */
    /* ================================================================================ */
    public function __toHTML() : string
    /*-------------------------------*/
    {
        $szHTML = "";

        $szHTML .= "<article class=\"invoice\" vocab=\"https://schema.org/\" typeof=\"Invoice\">\n";
            $szHTML .= "  <section class=\"logo\" vocab=\"https://schema.org/\" typeof=\"Organization\">\n";
            $szHTML .= "      <span class=\image\" property=\"image\">" . ( ! empty( $this->issuer->image ) ? "<img src=\"{$this->issuer->image}\" />" : '' ) . "</span>\n";
            $szHTML .= "  </section> <!-- .logo -->\n\n";

            $szHTML .= "  <section class=\"Addresses\" vocab=\"https://schema.org/\" typeof=\"PostalAddress\">\n\n";
            $szHTML .= "    <section class=\"deliveryAddress\">\n";
            $szHTML .= "      <span class=\street\"     property=\"streetAddress\">"      . ( $this->deliveryAddress->streetAddress    ?? '' ) ."</span>\n";
            $szHTML .= "      <span class=\zip\"        property=\"postalCode\">"         . ( $this->deliveryAddress->postalCode       ?? '' ) ."</span>\n";
            $szHTML .= "      <span class=\city\"       property=\"addressLocality\">"    . ( $this->deliveryAddress->addressLocality  ?? '' ) ."</span>\n";
            $szHTML .= "      <span class=\state\"      property=\"addressRegion\">"      . ( $this->deliveryAddress->addressRegion    ?? '' ) ."</span>\n";
            $szHTML .= "      <span class=\country\"    property=\"addressCountry\">"     . ( $this->deliveryAddress->addressCountry   ?? '' ) ."</span>\n";
            $szHTML .= "    </section> <!-- .deliveryAddress -->\n\n";
            $szHTML .= "    <section class=\"billingAddress\">\n";
            $szHTML .= "      <span class=\street\"     property=\"streetAddress\">"      . ( $this->billingAddress->streetAddress     ?? '' ) ."</span>\n";
            $szHTML .= "      <span class=\zip\"        property=\"postalCode\">"         . ( $this->billingAddress->postalCode        ?? '' ) ."</span>\n";
            $szHTML .= "      <span class=\city\"       property=\"addressLocality\">"    . ( $this->billingAddress->addressLocality   ?? '' ) ."</span>\n";
            $szHTML .= "      <span class=\state\"      property=\"addressRegion\">"      . ( $this->billingAddress->addressRegion     ?? '' ) ."</span>\n";
            $szHTML .= "      <span class=\country\"    property=\"addressCountry\">"     . ( $this->billingAddress->addressCountry    ?? '' ) ."</span>\n";
            $szHTML .= "    </section> <!-- .billingAddress -->\n";
            $szHTML .= "  </section> <!-- .Addresses -->\n\n";


            $szHTML .= "  <section class=\"invoiceHeader\">\n";

            $szHTML .= "    <section class=\"mandatory\">\n";
            $szHTML .= "      <span class=\"refNumber\">{$this->refNumber}</span>\n";
            $szHTML .= "      <span class=\"vatID\">{$this->customer->vatID}</span>\n";
            $szHTML .= "      <span class=\"issueDate\">" . date( $this->dateFormat,strtotime( $this->issueDate ) ) . "</span>\n";
            $szHTML .= "      <span class=\"order\">{$this->referencesOrder->orderNumber}</span>\n";
            $szHTML .= "      <span class=\"deliveryNote\"></span>\n";
            $szHTML .= "      <span class=\"paymentDueDate\">" . date( $this->dateFormat,strtotime( $this->paymentDueDate ) ) . "</span>\n";
            $szHTML .= "    </section> <!-- .mandatory -->\n\n";

            $szHTML .= "    <section class=\"miscellaneous\">\n";
            $szHTML .= "      <span class=\"name\" property=\"name\">{$this->name}</span>\n";
            $szHTML .= "      <span class=\"description\" property=\"description\">{$this->description}</span>\n";
            $szHTML .= "      <span class=\"lang\">{$this->lang}</span>\n";
            $szHTML .= "      <span class=\"type\">{$this->type}</span>\n";
            $szHTML .= "      <span class=\"version\">{$this->version}</span>\n";
            $szHTML .= "      <span class=\"proforma\">" . ( $this->proforma ? 'yes' : 'no' ) . "</span>\n";
            $szHTML .= "      <span class=\"draft\">"    . ( $this->draft ? 'yes' : 'no' ) . "</span>\n";
            $szHTML .= "      <span class=\"refNumber\">{$this->refNumber}</span>\n";
            $szHTML .= "    </section> <!-- .miscellaneous -->\n\n";
            $szHTML .= "  </section> <!-- .invoiceHeader -->\n\n";

            $szHTML .= "  <section class=\"invoiceBody\">\n";

            $iIndent = 6;
            foreach( $this->aLines as $aLine )
            {
                $szHTML .= "    <div class=\"lineOfDetail\">\n";
                    $szHTML .= str_repeat( ' ',$iIndent ) . "<span class=\"quantity\">{$aLine['qty']}</span>\n";
                    $szHTML .= str_repeat( ' ',$iIndent ) . "<span class=\"unitPrice\" property=\"price\">" . number_format( $aLine['unitprice' ],$this->iRounding,'.','' ) . "</span>\n";;
                    $szHTML .= str_repeat( ' ',$iIndent ) . "<span class=\"description\">" . ( ! empty( $aLine['id'] ) ? $aLine['id'] . '&#8211;' : '' ) . $aLine['desc']  .  "</span>\n";
                    $szHTML .= str_repeat( ' ',$iIndent ) . "<span class=\"htva\" property=\"price\">"      . number_format( $aLine['htva'      ],$this->iRounding,'.','' ) . "</span>\n";
                    $szHTML .= str_repeat( ' ',$iIndent ) . "<span class=\"vatpercent\">"                   . number_format( $aLine['vatpercent'],$this->iRounding,'.','' ) . "</span>\n";
                    $szHTML .= str_repeat( ' ',$iIndent ) . "<span class=\"tva\">"                          . number_format( $aLine['tva'       ],$this->iRounding,'.','' ) . "</span>\n";
                    $szHTML .= str_repeat( ' ',$iIndent ) . "<span class=\"tvac\" property=\"price\">"      . number_format( $aLine['tvac'      ],$this->iRounding,'.','' ) . "</span>\n";
                $szHTML .= "    </div> <!-- .lineOfDetail -->\n";
            }

            $szHTML .= "\n    <div class=\"totals\">\n";
            $szHTML .= "       <span class=\"currency\">{$this->currency}</span>\n";
            $szHTML .= "       <span class=\"totalHTVA\">"          . number_format( $this->totalHTVA       ,$this->iRounding,'.','' ) . "</span>\n";
            $szHTML .= "       <span class=\"VATPercent\">&#160;</span>\n";
            $szHTML .= "       <span class=\"totalTVA\">"           . number_format( $this->totalTVA        ,$this->iRounding,'.','' ) . "</span>\n";
            $szHTML .= "       <span class=\"totalTVAC\">"          . number_format( $this->totalTVAC       ,$this->iRounding,'.','' ) . "</span>\n";
            $szHTML .= "    </div> <!-- .totals -->\n\n";

            $szHTML .= "    <section class=\"totalPaymentDue\" property=\"totalPaymentDue\" typeof=\"PriceSpecification\">\n";
            $szHTML .= "       <span class=\"prepayment\">"         . number_format( $this->prepayment      ,$this->iRounding,'.','' ) . "</span>\n";
            $szHTML .= "       <span class=\"prepayment currency\">{$this->currency}</span>\n";
            $szHTML .= "       <span class=\"totalPaymentDue\">"    . number_format( $this->totalPaymentDue ,$this->iRounding,'.','' ) . "</span>\n";
            $szHTML .= "       <span class=\"totalPaymentDue currency\">{$this->currency}</span>\n";
            $szHTML .= "    </section> <!-- .totalPaymentDue -->\n\n";

            $szHTML .= "  </section> <!-- .invoiceBody -->\n\n";

            $szHTML .= "  <section class=\"invoiceFooter\">\n";
            $szHTML .= "      <span class=\invoiceFooter\">{$this->footer}</span>\n";
            $szHTML .= "      <span class=\uniqueRef\">{$this->identifier}</span>\n";
            $szHTML .= "  </section> <!-- .invoiceFooter -->\n\n";

            $szHTML .= "  <section class=\"documentFooter\" vocab=\"https://schema.org/\" typeof=\"Organization\">\n";
            $szHTML .= "    <span class=\"name\" property=\"name\">{$this->issuer->legalName}</span>\n";
            $szHTML .= "    <span class=\"legalForm\">{$this->issuer->legalForm}</span>\n";
            $szHTML .= "    <span class=\"street\">{$this->issuer->address->streetAddress}</span>\n";
            $szHTML .= "    <span class=\"zip\">{$this->issuer->address->postalCode}</span>\n";
            $szHTML .= "    <span class=\"country\">{$this->issuer->address->addressCountry}</span>\n";
            $szHTML .= "    <span class=\"phone\">{$this->issuer->telephone}</span>\n";
            $szHTML .= "    <span class=\"email\">{$this->issuer->email}</span>\n";
            $szHTML .= "    <span class=\"webSite\">{$this->issuer->url}</span>\n";
            $szHTML .= "    <span class=\"vatID\">{$this->issuer->vatID}</span>\n";
            $szHTML .= "    <span class=\"taxID\">{$this->issuer->taxID}</span>\n";
            $szHTML .= "    <span class=\"bankName\">{$this->issuer->bankAccount->bank}</span>\n";
            $szHTML .= "    <span class=\"bankAccountNumber\">{$this->issuer->bankAccount->identifier}</span>\n";
            $szHTML .= "    <span class=\"bankAccountBIC\">{$this->issuer->bankAccount->BICCode}</span>\n";
            $szHTML .= "    <section class=\"address\" vocab=\"https://schema.org/\" typeof=\"PostalAddress\">\n";
            $szHTML .= "      <span class=\street\"     property=\"streetAddress\">"      . ( $this->issuer->address->streetAddress    ?? '' ) ."</span>\n";
            $szHTML .= "      <span class=\zip\"        property=\"postalCode\">"         . ( $this->issuer->address->postalCode       ?? '' ) ."</span>\n";
            $szHTML .= "      <span class=\city\"       property=\"addressLocality\">"    . ( $this->issuer->address->addressLocality  ?? '' ) ."</span>\n";
            $szHTML .= "      <span class=\state\"      property=\"addressRegion\">"      . ( $this->issuer->address->addressRegion    ?? '' ) ."</span>\n";
            $szHTML .= "      <span class=\country\"    property=\"addressCountry\">"     . ( $this->issuer->address->addressCountry   ?? '' ) ."</span>\n";
            $szHTML .= "    </section> <!-- .address -->\n";
            
            $szHTML .= "  </section> <!-- .documentFooter -->\n\n";
        $szHTML .= "</article> <!-- .invoice -->\n";

        end:
        return ( $szHTML);
    }   /* End of Invoice.__toHTML() ================================================== */
    /* ================================================================================ */

    /* ================================================================================ */
    /** {{*__toArray()=

        Turns the object into an associative array

        {*params
        *}

        {*return
            (array)     Array representing the object
        *}

        {*remark
            If the properties are filled, their values will be reflected in the array
        *}

        {*example
        use \trql\vaesoli\Vaesoli   as v;
        use \trql\quitus\Invoice    as Invoice;

        if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
            require_once( 'trql.vaesoli.class.php' );

        if ( ! defined( 'INVOICE_CLASS_VERSION' ) )
            require_once( 'trql.invoice.class.php' );

        [b]$o = new Invoice();[/b]

        // Let's create the invoice from scratch all manually
        $o->identifier                          = v::guid( true );
        $o->name                                = 'This is an invoice that wa have created from scratch';
        $o->description                         = 'Est plane, Piso, ut dicis, inquit. Nam me ipsum huc modo venientem convertebat '     .
                                                  'ad sese Coloneus ille locus, cuius incola Sophocles ob oculos versabatur, quem '     .
                                                  'scis quam admirer quemque eo delecter. Me quidem ad altiorem memoriam Oedipodis '    .
                                                  'huc venientis et illo mollissimo carmine quaenam essent ipsa haec loca '             .
                                                  'requirentis species quaedam commovit, inaniter scilicet, sed commovit tamen.';
        $o->issueDate                           = date( 'Ymd' );
        $o->paymentDueDate                      = date( 'Ymd',strtotime( $o->issueDate ) + ( 86400 * 30 ) );  // ± 1 month later
        $o->refNumber                           = date('Y') . '/000001';

        $o->customer->identifier                = '';
        $o->customer->name                      = 'My beautiful customer';
        $o->customer->vatID                     = 'BE0463.478.965';    // No check made

        $o->billingAddress->streetAddress       = 'Rue des fleurs, 1';
        $o->billingAddress->postalCode          = '1000';
        $o->billingAddress->addressLocality     = 'Brussels';
        $o->billingAddress->addressCountry      = 'BE';

        $o->sent                                = true;
        $o->footer                              = 'Please be aware that we will be closed next week';
        $o->memo                                = 'To be sent to accounting bureau';

        $o->addDetail( array( 'utc'         => time()   ,
                              'id'          => ''       ,
                              'desc'        => 'a desc' ,
                              'qty'         => 1        ,
                              'unitprice'   => 15       ,
                              'vatpercent'  => 21.00    ,
                            ) );

        // Check how it looks now (should be filled with all data we've given)
        var_dump( [b]$o->__toArray()[/b] );

        // Gives something like...
        // array(32) {
        //   ["active"]=>
        //   bool(false)
        //   ["lang"]=>
        //   string(2) "fr"
        //   ["type"]=>
        //   string(1) "I"
        //   ["version"]=>
        //   string(3) "3.0"
        //   ["currency"]=>
        //   string(3) "EUR"
        //   ["date"]=>
        //   string(8) "20210319"
        //   ["duedate"]=>
        //   string(8) "20210418"
        //   ["ref"]=>
        //   string(11) "2021/000001"
        //   ["prepayment"]=>
        //   string(3) "0.0"
        //   ["totaldue"]=>
        //   float(18.15)
        //   ["htva"]=>
        //   float(15)
        //   ["tva"]=>
        //   float(3.15)
        //   ["tvac"]=>
        //   float(18.15)
        //   ["discounthtva"]=>
        //   string(3) "0.0"
        //   ["discounttva"]=>
        //   string(3) "0.0"
        //   ["discounttvac"]=>
        //   string(3) "0.0"
        //   ["cancelled"]=>
        //   bool(false)
        //   ["proforma"]=>
        //   bool(false)
        //   ["draft"]=>
        //   bool(false)
        //   ["vcs"]=>
        //   bool(false)
        //   ["paiddate"]=>
        //   NULL
        //   ["lupdate"]=>
        //   NULL
        //   ["Description"]=>
        //   string(385) "Est plane, Piso, ut dicis, inquit. Nam me ipsum huc modo venientem convertebat ad sese &#8617;
        //   Coloneus ille locus, cuius incola Sophocles ob oculos versabatur, quem scis quam admirer quemque eo &#8617;
        //   delecter. Me quidem ad altiorem memoriam Oedipodis huc venientis et illo mollissimo carmine quaenam &#8617;
        //   essent ipsa haec loca requirentis species quaedam commovit, inaniter scilicet, sed commovit tamen."
        //   ["InvoiceName"]=>
        //   string(52) "This is an invoice that wa have created from scratch"
        //   ["Customer"]=>
        //   array(3) {
        //     ["id"]=>
        //     string(0) ""
        //     ["Name"]=>
        //     string(21) "My beautiful customer"
        //     ["VATNumner"]=>
        //     string(14) "BE0463.478.965"
        //   }
        //   ["Project"]=>
        //   array(1) {
        //     ["id"]=>
        //     NULL
        //   }
        //   ["Order"]=>
        //   array(3) {
        //     ["date"]=>
        //     NULL
        //     ["id"]=>
        //     NULL
        //     ["Ref"]=>
        //     NULL
        //   }
        //   ["Addresses"]=>
        //   array(2) {
        //     ["Billing"]=>
        //     array(5) {
        //       ["Street"]=>
        //       string(17) "Rue des fleurs, 1"
        //       ["Zip"]=>
        //       string(4) "1000"
        //       ["City"]=>
        //       string(8) "Brussels"
        //       ["State"]=>
        //       NULL
        //       ["Country"]=>
        //       string(2) "BE"
        //     }
        //     ["Delivery"]=>
        //     array(5) {
        //       ["Street"]=>
        //       NULL
        //       ["Zip"]=>
        //       NULL
        //       ["City"]=>
        //       NULL
        //       ["State"]=>
        //       NULL
        //       ["Country"]=>
        //       NULL
        //     }
        //   }
        //   ["Management"]=>
        //   array(2) {
        //     ["Sent"]=>
        //     bool(true)
        //     ["Paid"]=>
        //     bool(false)
        //   }
        //   ["aLines"]=>
        //   array(1) {
        //     [0]=>
        //     array(9) {
        //       ["utc"]=>
        //       int(1616127806)
        //       ["id"]=>
        //       string(0) ""
        //       ["desc"]=>
        //       string(6) "a desc"
        //       ["qty"]=>
        //       float(1)
        //       ["unitprice"]=>
        //       float(15)
        //       ["vatpercent"]=>
        //       float(21)
        //       ["htva"]=>
        //       float(15)
        //       ["tva"]=>
        //       float(3.15)
        //       ["tvac"]=>
        //       float(18.15)
        //     }
        //   }
        //   ["Footer"]=>
        //   string(48) "Please be aware that we will be closed next week"
        //   ["Memo"]=>
        //   string(31) "To be sent to accounting bureau"
        // }
        *}}
    */
    /* ================================================================================ */
    public function __toArray() : array
    /*-------------------------------*/
    {
        $aRetVal = array( 'active'          => $this->active                                                                                                ,
                          'lang'            => $this->lang                                                                                                  ,
                          'type'            => $this->type                                                                                                  ,
                          'version'         => $this->version                                                                                               ,
                          'currency'        => $this->currency                                                                                              ,
                          'date'            => $this->issueDate                                                                                             ,
                          'duedate'         => $this->paymentDueDate                                                                                        ,
                          'ref'             => $this->refNumber                                                                                             ,
                          'prepayment'      => $this->prepayment                                                                                            ,
                          'totaldue'        => $this->totalPaymentDue                                                                                       ,
                          'htva'            => $this->totalHTVA                                                                                             ,
                          'tva'             => $this->totalTVA                                                                                              ,
                          'tvac'            => $this->totalTVAC                                                                                             ,
                          'discounthtva'    => $this->discountHTVA                                                                                          ,
                          'discounttva'     => $this->discountTVA                                                                                           ,
                          'discounttvac'    => $this->discountTVAC                                                                                          ,
                          'cancelled'       => $this->cancelled                                                                                             ,
                          'proforma'        => $this->proforma                                                                                              ,
                          'draft'           => $this->draft                                                                                                 ,
                          'vcs'             => $this->structCommunication                                                                                   ,
                          'paiddate'        => $this->finalPaymentDate                                                                                      ,
                          'lupdate'         => $this->lupdate                                                                                               ,
                          'Description'     => $this->description                                                                                           ,
                          'InvoiceName'     => $this->name                                                                                                  ,
                          'Issuer'          => array( 'id'          => $this->issuer->identifier                                                            ,
                                                      'Name'        => $this->issuer->name                                                                  ,
                                                      'LegalName'   => $this->issuer->legalName                                                             ,
                                                      'LegalForm'   => $this->issuer->legalForm                                                             ,
                                                      'TaxID'       => $this->issuer->taxID                                                                 ,
                                                      'VATNumber'   => $this->issuer->vatID                                                                 ,
                                                      'Email'       => $this->issuer->email                                                                 ,
                                                      'Url'         => $this->issuer->url                                                                   ,
                                                      'FaxNumber'   => $this->issuer->faxNumber                                                             ,
                                                      'Phone'       => $this->issuer->telephone                                                             ,
                                                      'Image'       => $this->issuer->image                                                                 ,
                                                      'BankAccount' => array( 'Bank'    => $this->issuer->bankAccount->bank                                 ,
                                                                              'ID'      => $this->issuer->bankAccount->identifier                           ,
                                                                              'BIC'     => $this->issuer->bankAccount->BICCode                              ,
                                                                            )                                                                               ,
                                                      'Address'     => array( 'Street'  => $this->issuer->address->streetAddress                            ,
                                                                              'Zip'     => $this->issuer->address->postalCode                               ,
                                                                              'City'    => $this->issuer->address->addressLocality                          ,
                                                                              'State'   => $this->issuer->address->addressRegion                            ,
                                                                              'Country' => $this->issuer->address->addressCountry                           ,
                                                                            )                                                                               ,
                                                    )                                                                                                       ,
                          'Customer'        => array( 'id'          => $this->customer->identifier                                                          ,
                                                      'Name'        => $this->customer->name                                                                ,
                                                      'VATNumber'   => $this->customer->vatID                                                               ,
                                                      'Addresses'   => array( 'Billing'     => array( 'Street'  => $this->billingAddress->streetAddress     ,
                                                                                                      'Zip'     => $this->billingAddress->postalCode        ,
                                                                                                      'City'    => $this->billingAddress->addressLocality   ,
                                                                                                      'State'   => $this->billingAddress->addressRegion     ,
                                                                                                      'Country' => $this->billingAddress->addressCountry    ,
                                                                                                    )                                                       ,
                                                                              'Delivery'    => array( 'Street'  => $this->deliveryAddress->streetAddress    ,
                                                                                                      'Zip'     => $this->deliveryAddress->postalCode       ,
                                                                                                      'City'    => $this->deliveryAddress->addressLocality  ,
                                                                                                      'State'   => $this->deliveryAddress->addressRegion    ,
                                                                                                      'Country' => $this->deliveryAddress->addressCountry   ,
                                                                                                    )                                                       ,
                                                                            )                                                                               ,
                                                    )                                                                                                       ,
                          'Project'         => array( 'id'          => $this->projectID                                                                     ,
                                                    )                                                                                                       ,
                          'Order'           => array( 'Date'        => $this->referencesOrder->orderDate                                                    ,
                                                      'id'          => $this->referencesOrder->identifier                                                   ,
                                                      'Ref'         => $this->referencesOrder->orderNumber                                                  ,
                                                    )                                                                                                       ,
                          'Management'      => array( 'Sent'        => $this->sent                                                                          ,
                                                      'Paid'        => $this->paid                                                                          ,
                                                    )                                                                                                       ,
                          'aLines'          => $this->aLines                                                                                                ,
                          'Footer'          => $this->footer                                                                                                ,
                          'Memo'            => $this->memo );

        end:
        return ( $aRetVal );
    }   /* End of Invoice.__toArray() ================================================= */
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
