<?php
/****************************************************************************** */
/*
    {PYB} is a shortcut for Patrick Boens

    {COMPANY} is a shortcut to "Lato Sensu Management"

    {RIGHTS} is a shortcut used by trql.documentor.class.php. In general the material
    presented here is available under the conditions of
    https://creativecommons.org/licenses/by-sa/4.0/

    Other shortcuts exist. They exist to make it simple to change the formulation
    of parts that can vary over time.

    It does not change the undisputed truth that ALL code has been created by
    Patrick Boens, the author, who owns ALL the intellectual property of what
    he created.

*/

/** {{{*fheader
    {*file                  TRQL-Labs-portmanteau.php *}
    {*purpose               Script that gathers ALL TRQL-Labs documentation *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 05-03-21 13:09 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été *}

    ------------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------------

    {*chist
        {*mdate 05-03-21 13:09 *}
        {*v 2.0.0001 *}
        {*desc              1)   Original creation
        *}
    *}

    *}}} */

/****************************************************************************** */
use \trql\vaesoli\Vaesoli                   as v;
use \trql\documentor\Documentor             as Documentor;
use \trql\documentor\DocumentorSourceFile   as DocumentorSourceFile;

set_time_limit( 0 );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'd:/websites/snippet-center/trql.vaesoli.class.php' );

if ( ! defined( 'DOCUMENTOR_CLASS_VERSION' ) )
    require_once( 'd:/websites/snippet-center/trql.documentor.class.php' );

spl_autoload_register(
    function ( $szClass )
    {
        $aParts = explode('\\',$szClass );
        $szFile = 'd:/websites/snippet-center/trql.' . end( $aParts ) . '.class.php';
        if ( is_file( $szFile ) )
            require_once( $szFile );
        //else
            //var_dump( $szFile );
    } );

$o          = new Documentor();
$x          = new DocumentorSourceFile( __FILE__ );
$i          = 0;
$szDocDir   = dirname( $x->documentationFile() );
var_dump( "PLACE WHERE THE DOCUMENTATION IS STORED:",$szDocDir );
$aClasses   = null;

foreach( $o->self['family'] as $szFile )
{
    if ( preg_match('/trql\.(?P<class>.*?)\.class\.php/i',$szFile,$aMatches ) )
    {
        $aClasses[$szClass = strtolower( $aMatches['class'] )] = $szFile;
        //var_dump( ++$i . ': ' . $szClass . ' in ' . $szFile );
    }
}


if ( is_array( $aClasses ) && count( $aClasses ) > 0 )
{
    ksort( $aClasses );

    echo "<h1>Classes</h1>\n";
    echo "<ul>\n";
    foreach( $aClasses as $szClass => $szFile )
    {
        echo "<li><code>{$szClass}</code>: {$szFile}</li>\n";
        flushIt();
    }
    echo "</ul>\n";
}


end:
echo "\n\n",__LINE__," ... end of the script\n";

function flushIt()
/*--------------*/
{
    if ( ! v::isCommandLine() )
        ob_flush();

    flush();
}
?>
