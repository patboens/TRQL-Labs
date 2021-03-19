<?php
/****************************************************************************** */
/** {{{*fheader
    {*file                  invoice.test.php *}
    {*purpose               Script that tests the invoice class *}
    {*author                {PYB} *}
    {*company               Lato Sensu Management[br]
                            Rue Bois des Mazuis, 47[br]
                            5070 Vitrival[br]
                            Belgium[br]
                            [url]http://www.trql.fm[/url][br]
                            Vae Soli! : [url]http://www.vaesoli.org[/url] *}
    {*cdate                 25-02-2021 22:18 *}
    {*mdate                 auto *}
    {*license               All rights reserved to Lato Sensu Management
                            for all countries. All Intellectual Property
                            belongs to Patrick Boens. *}
    {*UTF-8                 Quel bel été *}

    ------------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------------

    {*chist
        {*mdate 25-02-2021 22:18 *}
        {*v 2.0.0001 *}
        {*desc              1)   Original creation
        *}
    *}

    *}}} */

    /** {{*invoice()=

        Basic test of the invoice class

        {*params
        *}

        {*return
            [c]void[/c]
        *}

        {*author {PYB} *}
        {*cdate 25-02-2021 22:18 *}

        {*example
            http://trql.io/tests/invoice.test.php
        *}

        *}}
     */
/****************************************************************************** */
use \trql\vaesoli\Vaesoli   as v;
use \trql\quitus\Invoice    as Invoice;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'd:/websites/snippet-center/trql.vaesoli.class.php' );

if ( ! defined( 'INVOICE_CLASS_VERSION' ) )
    require_once( 'd:/websites/snippet-center/trql.invoice.class.php' );

$o = new Invoice();

if ( $o->load( $szFile = str_replace( '.php','.xml',__FILE__ ) ) )
{
    var_dump( $o->__toArray() );
    //echo $o->__toHTML();
    goto end;
    //$szID = v::guid( true );
    //
    //$szFile = str_replace( '.php','.' . date( 'YmdHis' ) . '.xml',__FILE__ );
    //
    //// Make just a few changes to see
    //// if they can be saved ...
    //$o->identifier  = $szID;
    //$o->description = strrev( $o->description );
    //$o->name        = strrev( $o->name );
    //
    //// Let's get the last line of detail
    //$aLine = end( $o->aLines );
    //
    //// Modify few values
    //$aLine['qty' ] = $aLine['qty' ] * 2;
    //$aLine['htva'] = $aLine['htva'] * 2;
    //$aLine['tva' ] = $aLine['tva' ] * 2;
    //$aLine['tvac'] = $aLine['tvac'] * 2;
    //
    //// Check how it looks
    //var_dump( $aLine );
    //
    //// Adding this line to the list of lines we already have
    //$o->addDetail( $aLine );
    //
    ////Save this invoice to a new file now
    //if ( $o->save( $szFile ) )
    //    var_dump( "Invoice successfully saved to {$szFile}" );

    $o->reset();

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

    {   /* Fill all infos about the iissuer of the invoice */
        $o->issuer->identifier                      = v::guid( true );
        $o->issuer->name                            = "My Beautiful Company";
        $o->issuer->legalName                       = "UA-PARSE";
        $o->issuer->vatID                           = "BE0111.222.333";
        $o->issuer->email                           = "info@ua-parse.com";
        $o->issuer->url                             = "https://www.ua-parse.com";
        $o->issuer->faxNumber                       = '';
        $o->issuer->telephone                       = '+32 2 111.22.33';

        {   /* Fill issuer address */
            $o->issuer->address->streetAddress      = 'Rue des pierres, 43';
            $o->issuer->address->postalCode         = '1000';
            $o->issuer->address->addressLocality    = 'Bruxelles';
            $o->issuer->address->addressRegion      = '';
            $o->issuer->address->addressCountry     = 'BE';
        }   /* Fill issuer address */
    }   /* Fill all infos about the iissuer of the invoice */

    {   /* Fill the necessary info about the customer*/
        $o->customer->identifier                    = '';
        $o->customer->name                          = 'My beautiful customer';
        $o->customer->vatID                         = 'BE0463.478.965';    // No check made

        {   /* Fill the billing address */
            $o->billingAddress->streetAddress       = 'Rue des fleurs, 1';
            $o->billingAddress->postalCode          = '1000';
            $o->billingAddress->addressLocality     = 'Brussels';
            $o->billingAddress->addressCountry      = 'BE';
        }   /* Fill the billing address */
    }   /* Fill the necessary info about the customer*/

    $o->sent                                        = true;
    $o->paid                                        = false;
    $o->footer                                      = 'Please be aware that we will be closed next week';
    $o->memo                                        = 'To be sent to accounting bureau';

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

    //var_dump( $o->aLines );
    $o->deleteDetail( 0 );
    //var_dump( $o->aLines );

    //var_dump( $o->__toXML() );
    //var_dump( $o->__toJSON() );
    var_dump( $o->__toArray() );
}

end:
//var_dump( $o->lastInfo );

//if ( $o->isDocumentationOutdated() )
{
    var_dump( 'Documentation of "invoice" updated' );
    $o->document();
}

echo __LINE__," ... end of the script\n";
?>
