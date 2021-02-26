<?php
/****************************************************************************** */
/** {{{*fheader
    {*file                  vaesoli.test.php *}
    {*purpose               Script that tests the vaesoli class *}
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

    /** {{*vaesoli()=

        Basic test of the vaesoli class

        {*params
        *}

        {*return
            [c]void[/c]
        *}

        {*author {PYB} *}
        {*cdate 25-02-2021 22:18 *}

        {*example
            http://trql.io/tests/vaesoli.test.php
        *}

        *}}
     */
/****************************************************************************** */
use \trql\vaesoli\Vaesoli   as v;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'd:/websites/snippet-center/trql.vaesoli.class.php' );

$szXML = <<<XML
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Config xmlns:xi="http://www.w3.org/2001/XInclude"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">

    <Routes>
        <Route>
            <Pattern><![CDATA[%/api/v1/playlist/(?P<selection>.*?)/%si]]></Pattern>
            <URL><![CDATA[https://www.trql.fm/api/playlist/?selection=%selection%]]></URL>
        </Route>
        <Route>
            <Pattern><![CDATA[%/NOMATCH/%si]]></Pattern>
            <URL><![CDATA[0.0.0.0]]></URL>
        </Route>
    </Routes>

    <Address>
        <Street>Rue des fleurs</Street>
        <Number>17B</Number>
        <PostalCode>5070</PostalCode>
        <City>Vitrival</City>
        <Country>Belgium</Country>
    </Address>
</Config>
XML;

{   /* -----------*/
    /* XML to Object, to Array, to JSON */
    $x = v::XMLToObject( $szXML );
    var_dump( $x );

    $x = v::XMLToArray( $szXML );
    var_dump( $x );

    $x = v::XMLToJSON( $szXML );
    var_dump( $x );
}   /* -----------*/

{   /* -----------*/
    /* Array to Object, to XML, to JSON */
    $a['First'] = array( 'me'   => array( 1,2,3 )                   ,
                         'you'  => array( 'Key1'    => 'whatever'   ,
                                          'Key2'    => 'Okk'        ,
                                        )                           ,
                       );

    $x = v::ArrayToObject( $a );
    var_dump( $x );

    $x = v::ArrayToXML( $a );
    var_dump( $x );

    $x = v::ArrayToJSON( $a );
    var_dump( $x );
}   /* -----------*/


{   /* -----------*/
    /* JSON To array, JSON to Object, JSON to XML */
    $szJSON = $x;

    $x = v::JSONToArray( $szJSON );
    var_dump( "JSONToArray();",$x );

    $x = v::JSONToXML( $szJSON );
    var_dump( "JSONToXML();",$x );

    $x = v::JSONToObject( $szJSON );
    var_dump( "JSONToObject();",$x );

}   /* -----------*/


{   /* -----------*/
    /* Object to Array, to JSON, to XML */
    $o = $x;

    $x = v::ObjectToArray( $o );
    var_dump( "ObjectToArray();",$x );

    $x = v::ObjectToJSON( $o );
    var_dump( "ObjectToJSON();",$x );

    $x = v::ObjectToXML( $o );
    var_dump( "ObjectToXML();",$x );


    /* Object to Array, to JSON, to XML */
}   /* -----------*/




end:
echo __LINE__," ... end of the script\n";
?>
