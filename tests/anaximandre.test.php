<?php
/****************************************************************************** */
/** {{{*fheader
    {*file                  anaximandre.test.php *}
    {*purpose               Script that tests the anaximandre class *}
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

    /** {{*anaximandre()=

        Basic test of the anaximandre class

        {*params
        *}

        {*return
            [c]void[/c]
        *}

        {*author {PYB} *}
        {*cdate 25-02-2021 22:18 *}

        {*example
            http://trql.io/tests/anaximandre.test.php
        *}

        *}}
     */
/****************************************************************************** */
use \trql\vaesoli\Vaesoli           as v;
use \trql\anaximandre\Anaximandre   as Anaximandre;
use \trql\mercator\Mercator         as Mercator;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'd:/websites/snippet-center/trql.vaesoli.class.php' );

if ( ! defined( 'ANAXIMANDRE_CLASS_VERSION' ) )
    require_once( 'd:/websites/snippet-center/trql.anaximandre.class.php' );

if ( ! defined( 'MERCATOR_CLASS_VERSION' ) )
    require_once( 'd:/websites/snippet-center/trql.mercator.class.php' );

$oMercator      = new Mercator();
$aGeoData       = $oMercator->lookup('Milan');
var_dump( $aGeoData );

$oAnaximandre   = new Anaximandre();
$oAnaximandre->remembering = false;
$aWeather       = $oAnaximandre->weather( $aGeoData['lat'],$aGeoData['lng'] );
var_dump( $aWeather );
$aForecast  = $oAnaximandre->forecast( $aGeoData['lat'],$aGeoData['lng'] );
var_dump( $aForecast );

end:
//var_dump( $o->lastInfo );

//if ( $o->isDocumentationOutdated() )
{
    var_dump( 'Documentation of "anaximandre" updated' );
    $oAnaximandre->document();
}

echo __LINE__," ... end of the script\n";
?>
