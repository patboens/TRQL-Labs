<?php
/****************************************************************************** */
/** {{{*fheader
    {*file                  book.test.php *}
    {*purpose               Script that tests the book class *}
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

    /** {{*book()=

        Basic test of the book class

        {*params
        *}

        {*return
            [c]void[/c]
        *}

        {*author {PYB} *}
        {*cdate 25-02-2021 22:18 *}

        {*example
            http://trql.io/tests/book.test.php
        *}

        *}}
     */
/****************************************************************************** */
use \trql\vaesoli\Vaesoli                   as v;
use \trql\book\Book as book;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'd:/websites/snippet-center/trql.vaesoli.class.php' );

if ( ! defined( 'BOOK_CLASS_VERSION' ) )
    require_once( 'd:/websites/snippet-center/trql.book.class.php' );

$o = new book();

end:
var_dump( $o->lastInfo );

//if ( $o->isDocumentationOutdated() )
{
    var_dump('Documentation of "book" outdated');
    $o->document();
}

echo __LINE__," ... end of the script\n";
?>
