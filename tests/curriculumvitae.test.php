<?php
/****************************************************************************** */
/** {{{*fheader
    {*file                  curriculumvitae.test.php *}
    {*purpose               Script that tests the CurriculumVitae class *}
    {*author                {PYB} *}
    {*company               Lato Sensu Management[br]
                            Rue Bois des Mazuis, 47[br]
                            5070 Vitrival[br]
                            Belgium[br]
                            [url]http://www.trql.fm[/url][br]
                            Vae Soli! : [url]http://www.vaesoli.org[/url] *}
    {*cdate                 06-03-21 12:51 *}
    {*mdate                 auto *}
    {*license               All rights reserved to Lato Sensu Management
                            for all countries. All Intellectual Property
                            belongs to Patrick Boens. *}
    {*UTF-8                 Quel bel été *}

    ------------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------------

    {*chist
        {*mdate 06-03-21 12:51 *}
        {*v 2.0.0001 *}
        {*desc              1)   Original creation
        *}
    *}

    *}}}

*/
/****************************************************************************** */
use \trql\vaesoli\Vaesoli                   as v;
use \trql\curriculumvitae\CurriculumVitae   as TheObj;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'd:/websites/snippet-center/trql.vaesoli.class.php' );

if ( ! defined( 'CURRICULUMVITAE_CLASS_VERSION' ) )
    require_once( 'd:/websites/snippet-center/trql.curriculumvitae.class.php' );

$o = new TheObj();

end:
var_dump( $o->lastInfo );

//if ( $o->isDocumentationOutdated() )
{
    var_dump('Documentation updated');
    $o->document();
}

echo __LINE__," ... end of the script\n";
?>
