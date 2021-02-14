<?php
/****************************************************************************************/
/** {{{*fheader
    {*file                  trql.ticket.class.php *}
    {*purpose               Used to describe a ticket to an event, a flight, a bus ride,
                            etc. *}
    {*author                {PYB} *}
    {*company               Lato Sensu Management[br]
                            Rue Bois des Mazuis, 47[br]
                            5070 Vitrival[br]
                            Belgium[br]
                            [url]http://www.latosensu.be[/url][br]
                            Vae Soli! : [url]http://www.vaesoli.org[/url] *}
    {*cdate                 auto *}
    {*mdate                 auto *}
    {*license               All rights reserved to Lato Sensu Management
                            for all countries. All Intellectual Property
                            belongs to Patrick Boens. *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*cdate 31/07/2020 16:08 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 22-08-20 10:35 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Adding Documentor-oriented comments
        *}
    *}

    {*chist
        {*mdate 14-02-21 08:55 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Standardizing the [c]__destruct() method[/c]
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\ticket;

use \trql\mother\Mother                     as Mother;
use \trql\mother\iContext                   as iContext;
use \trql\context\Context                   as Context;
use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\intangible\Intangible             as Intangible;


use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'INTANGIBLE_CLASS_VERSION' ) )
    require_once( 'trql.intangible.class.php' );

defined( 'TICKET_CLASS_VERSION' ) or define( 'TICKET_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Ticket=

    {*desc

        Used to describe a ticket to an event, a flight, a bus ride, etc.

    *}

    {*credits
        The whole concept is derived from the fabulous work of Schema.org
        under the terms of their license:
        [url]http://schema.org/docs/terms.html[/url]
    *}

    {*doc [url]https://schema.org/Ticket[/url] *}

    *}}
 */
/* ==================================================================================== */
class Ticket extends Intangible
/*---------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                             Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    public      $dateIssued             = null;                     /* {*property   $dateIssued                 (Date|DateTime)                     The date the ticket was issued. *} */
    public      $issuedBy               = null;                     /* {*property   $issuedBy                   (Organization)                      The organization issuing the ticket or permit.  *} */
    public      $priceCurrency          = null;                     /* {*property   $priceCurrency              (string)                            The currency of the price, or a price component when attached 
                                                                                                                                                    to PriceSpecification and its subtypes.
                                                                                                                                                    
                                                                                                                                                    Use standard formats: ISO 4217 currency format e.g. "USD"; 
                                                                                                                                                    Ticker symbol for cryptocurrencies e.g. "BTC"; well known 
                                                                                                                                                    names for Local Exchange Tradings Systems (LETS) and other
                                                                                                                                                    currency types e.g. "Ithaca HOUR". *} */
    public      $ticketNumber           = null;                     /* {*property   $ticketNumber               (string)                            The unique identifier for the ticket. *} */
    public      $ticketToken            = null;                     /* {*property   $ticketToken                (string|URL)                        Reference to an asset (e.g., Barcode, QR code image or 
                                                                                                                                                    PDF) usable for entrance. *} */
    public      $ticketedSeat           = null;                     /* {*property   $ticketedSeat               (Seat)                              The seat associated with the ticket. *} */
    public      $totalPrice             = null;                     /* {*property   $totalPrice                 (Number|PriceSpecification|Text)    The total price for the reservation or ticket, including 
                                                                                                                                                    applicable taxes, shipping, etc.
                                                                                                                
                                                                                                                                                    Usage guidelines:
                                                                                                                
                                                                                                                                                    Use values from 0123456789 (Unicode 'DIGIT ZERO' (U+0030) to
                                                                                                                                                    'DIGIT NINE' (U+0039)) rather than superficially similiar 
                                                                                                                                                    Unicode symbols.
                                                                                                                                                    
                                                                                                                                                    Use '.' (Unicode 'FULL STOP' (U+002E)) rather than ',' to 
                                                                                                                                                    indicate a decimal point. Avoid using these symbols as a 
                                                                                                                                                    readability separator. *} */
    public      $underName              = null;                     /* {*property   $underName                  (Organization|Person)               The person or organization the reservation or ticket is for. *} */


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
    }   /* End of Ticket.__construct() ================================================ */
    /* ================================================================================ */


    public function __destruct()
    /*------------------------*/
    {
        $this->backup();
        $this->autodoc();
        $this->UIKey();
        $this->WikiData();
        $this->necroSignaling();

    }   /* End of Ticket.__destruct() ================================================= */
    /* ================================================================================ */

}   /* End of class Ticket ============================================================ */
/* ==================================================================================== */
?>