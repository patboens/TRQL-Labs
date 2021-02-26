<?php
/****************************************************************************** */
/** {{{*fheader
    {*file                  website.test.php *}
    {*purpose               Script that tests the website and websitegenerator
                            classes *}
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

    {*chist
        {*mdate 26-02-2021 09:32 *}
        {*v 2.0.0001 *}
        {*desc              1)  Adding the WebsiteGenerator class that is used
                                when the [c]generate()[/c] method of the website
                                class is used
        *}
    *}

    *}}} */

    /** {{*website()=

        Basic test of the website class

        {*params
        *}

        {*return
            [c]void[/c]
        *}

        {*author {PYB} *}
        {*cdate 25-02-2021 22:18 *}
        {*mdate auto *}

        {*example
            http://trql.io/tests/website.test.php
        *}

        *}}
     */
/****************************************************************************** */
use \trql\vaesoli\Vaesoli   as v;
use \trql\website\Website   as website;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'd:/websites/snippet-center/trql.vaesoli.class.php' );

if ( ! defined( 'WEBSITE_CLASS_VERSION' ) )
    require_once( 'd:/websites/snippet-center/trql.website.class.php' );

$o = new website();
$o->url = 'http://www.trql.io';
$o->destinationDir = 'd:/websites/%host%';

if ( false )
{
    try 
    {
        $o->generate();
    }
    catch (exception $e)
    {
        var_dump( $e );
    }
}

//var_dump( $o );
end:
var_dump( $o->lastInfo );

//if ( $o->isDocumentationOutdated() )
{
    var_dump('Documentation of "website" outdated');
    $o->document();
}

echo __LINE__," ... end of the script\n";
?>
