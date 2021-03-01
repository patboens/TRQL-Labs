<?php
/****************************************************************************** */
/** {{{*fheader
    {*file                  documentor.test.php *}
    {*purpose               Script that tests the documentor class *}
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

    /** {{*documentor()=

        Basic test of the documentor class

        {*params
        *}

        {*return
            [c]void[/c]
        *}

        {*author {PYB} *}
        {*cdate 25-02-2021 22:18 *}

        {*example
            http://trql.io/tests/documentor.test.php
        *}

        *}}
     */
/****************************************************************************** */
use \trql\vaesoli\Vaesoli           as v;
use \trql\documentor\Documentor     as Documentor;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'd:/websites/snippet-center/trql.vaesoli.class.php' );

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

if ( false )
{
    $o = new Documentor();

    $o->document();
    $o->addInfo( 'Documentation updated' );

    $o->backup( $forced = false );
    //$o->addInfo( 'Backup performed' );

    var_dump( $o->lastInfo );
}

if ( true )
{
    $oDoc = new Documentor();
    //var_dump( $oDoc->self['family'] );

    $noTest[] = 'backgroundprocess';
    $noTest[] = '3dmodel';
    $noTest[] = 'bankaccount';

    $i = 0;
    foreach( $oDoc->self['family'] as $szFile )
    {
        if ( preg_match('/trql\.(?P<class>.*?)\.class\.php/i',$szFile,$aMatches ) )
        {
            $szClass = strtolower( $aMatches['class'] );

            if ( ! in_array( $szClass,$noTest ) )
            {
                $szClass = '\\trql\\' . strtolower( $aMatches['class'] ) . '\\' . $aMatches['class'];

                if ( strtolower( $szClass ) > '\trql\backgroundnewsarticle\backgroundnewsarticle' )
                {
                    var_dump( ++$i . ': ' . $szClass );
                    $o = new $szClass();
                    $o->document();
                    //var_dump( $o->lastInfo );
                }
            }
        }
    }
}

end:
echo __LINE__," ... end of the script\n";
?>
