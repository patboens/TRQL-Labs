<?php
/****************************************************************************** */
/** {{{*fheader
    {*file                  rss.test.php *}
    {*purpose               Script that tests the rss class *}
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

    /** {{*rss()=

        Basic test of the rss class

        {*params
        *}

        {*return
            [c]void[/c]
        *}

        {*author {PYB} *}
        {*cdate 25-02-2021 22:18 *}

        {*example
            http://trql.io/tests/rss.test.php
        *}

        *}}
     */
/****************************************************************************** */
use \trql\vaesoli\Vaesoli   as v;
use \trql\rss\RSS           as RSS;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'd:/websites/snippet-center/trql.vaesoli.class.php' );

if ( ! defined( 'RSS_CLASS_VERSION' ) )
    require_once( 'd:/websites/snippet-center/trql.rss.class.php' );

$o = new RSS();
$aRetVal = $o->read( 'https://csdl-api.computer.org/api/rss/periodicals/mags/cs/rss.xml' );
var_dump( $aRetVal );

end:
var_dump( $o->lastInfo );

//if ( $o->isDocumentationOutdated() )
{
    var_dump( 'Documentation updated' );
    $o->document();
}

echo __LINE__," ... end of the script\n";
?>
