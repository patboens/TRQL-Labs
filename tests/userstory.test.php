<?php
/****************************************************************************** */
/** {{{*fheader
    {*file                  userstory.test.php *}
    {*purpose               Script that tests a Simple User Story *}
    {*author                {PYB} *}
    {*company               Lato Sensu Management[br]
                            Rue Bois des Mazuis, 47[br]
                            5070 Vitrival[br]
                            Belgium[br]
                            [url]http://www.trql.fm[/url][br]
                            Vae Soli! : [url]http://www.vaesoli.org[/url] *}
    {*cdate                 11-03-21 22:46:13 *}
    {*mdate                 auto *}
    {*license               All rights reserved to Lato Sensu Management
                            for all countries. All Intellectual Property
                            belongs to Patrick Boens. *}
    {*UTF-8                 Quel bel été *}

    ------------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------------

    {*chist
        {*mdate 11-03-21 22:46:13 *}
        {*v 2.0.0001 *}
        {*desc              1)   Original creation
        *}
    *}

    *}}}
*/
/****************************************************************************** */
use \trql\vaesoli\Vaesoli       as v;
use \trql\userstory\UserStory   as UserStory;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'd:/websites/snippet-center/trql.vaesoli.class.php' );

if ( ! defined( 'USERSTORY_CLASS_VERSION' ) )
    require_once( 'd:/websites/snippet-center/trql.userstory.class.php' );

$o = new UserStory();

echo "<style>\n";
echo "span.ustag { padding: 5px; border-radius:4px; margin-right: 3px;}\n";
echo "span.ustag::before,\n";
echo "span.ustag::after { content : ' '}\n";
echo "span.crimson { background: crimson; color: white;}\n";
echo "span.deeppink { background: deeppink;}\n";
echo "span.chartreuse{ background: chartreuse;}\n";
echo "span.aquamarine{ background: aquamarine;}\n";
echo "span.maroon{ background: maroon; color: white;}\n";
echo "span.Expedite::after,\n";
echo "span.Bug::after { content : '! '}\n";

echo "</style>\n";

$o->addtag( "Expedite"  ,"crimson"      );
$o->addtag( "Danger"    ,"deeppink"     );
$o->addtag( "OK"        ,"chartreuse"   );
$o->addtag( "Retest"    ,"aquamarine"   );
$o->addtag( "Bug"       ,"maroon"       );


echo "<p>",$o->renderTags(),"</p>\n";
echo "<p>",$o->renderTags('Expedite'),"</p>\n";
var_dump( $o->tags );

end:
var_dump( $o->classIcon );

//if ( $o->isDocumentationOutdated() )
{
    $o->document();
    var_dump( "Documentation updated" );
}

echo __LINE__," ... end of the script\n";
?>
