<?php
/****************************************************************************** */
/** {{{*fheader
    {*file                  mercator.test.php *}
    {*purpose               Script that tests the mercator class *}
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

    /** {{*mercator()=

        Basic test of the mercator class

        {*params
        *}

        {*return
            [c]void[/c]
        *}

        {*author {PYB} *}
        {*cdate 25-02-2021 22:18 *}

        {*example
            http://trql.io/tests/mercator.test.php
        *}

        *}}
     */
/****************************************************************************** */
use \trql\vaesoli\Vaesoli       as v;
use \trql\mercator\Mercator     as mercator;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'd:/websites/snippet-center/trql.vaesoli.class.php' );

if ( ! defined( 'MERCATOR_CLASS_VERSION' ) )
    require_once( 'd:/websites/snippet-center/trql.mercator.class.php' );

$o = new Mercator();
$o->remembering = true;     // This will use cache if any
$o->remembering = false;    // This will disregard cache

// The geonameId "8520400" is the one of Lato Sensu Management
// Let's get all geonames details about this ID
$a = $o->get( array( "geonameId" => "8520400" ) );
var_dump( $a );

// Then, let's try to find what's nearby this location:
$fLatitude  = $a['results'][0]['latitude'];
$fLongitude = $a['results'][0]['longitude'];
var_dump( $o->nearby( $fLatitude,$fLongitude ) );

//var_dump( $o->wikipedia( 'namur' ) );

$szIP = null;

if ( ! empty( $szJSON = v::HTTP_GetURL( 'https://api.ipify.org/?format=json' ) ) )
{
    $oJSON = json_decode( $szJSON );
    $szIP = $oJSON->ip ?? null;
}

var_dump( $x = $o->geoIP( $szIP ) );
var_dump( $x['results'] );


end:
var_dump( $o->lastInfo );

//if ( $o->isDocumentationOutdated() )
{
    var_dump('Documentation of "Mercator" updated');
    $o->document();
}

echo __LINE__," ... end of the script\n";
?>
