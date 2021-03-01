<?php
/****************************************************************************** */
/** {{{*fheader
    {*file                  userguide.test.php *}
    {*purpose               Script that tests a Simple User Guide *}
    {*author                {PYB} *}
    {*company               Lato Sensu Management[br]
                            Rue Bois des Mazuis, 47[br]
                            5070 Vitrival[br]
                            Belgium[br]
                            [url]http://www.trql.fm[/url][br]
                            Vae Soli! : [url]http://www.vaesoli.org[/url] *}
    {*cdate                 27-02-21 10:50:43 *}
    {*mdate                 auto *}
    {*license               All rights reserved to Lato Sensu Management
                            for all countries. All Intellectual Property
                            belongs to Patrick Boens. *}
    {*UTF-8                 Quel bel été *}

    ------------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------------

    {*chist
        {*mdate 27-02-21 10:50:43 *}
        {*v 2.0.0001 *}
        {*desc              1)   Original creation
        *}
    *}

    *}}} */

    /** {{*userguide()=

        Test of a simple User Guide data structure

        {*params
        *}

        {*return
            [c]void[/c]
        *}

        {*author {PYB} *}
        {*cdate 27-02-21 10:50:43 *}

        {*example
            /tests/userguide.test.php
        *}

        *}}
     */
/****************************************************************************** */
use \trql\vaesoli\Vaesoli       as v;
use \trql\userguide\UserGuide   as UserGuide;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'd:/websites/snippet-center/trql.vaesoli.class.php' );

if ( ! defined( 'USERGUIDE_CLASS_VERSION' ) )
    require_once( 'd:/websites/snippet-center/trql.UserGuide.class.php' );

$o = new UserGuide();

end:
var_dump( $o->lastInfo );

if ( $o->isDocumentationOutdated() )
{
    $o->document();
    var_dump( "Documentation updated" );
}

echo __LINE__," ... end of the script\n";
?>
