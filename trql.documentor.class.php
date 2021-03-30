<?php
/****************************************************************************************/

/*
    {PYB} is a shortcut for Patrick Boens

    {COMPANY} is a shortcut to "Lato Sensu Management"

    {RIGHTS} is a shortcut used by trql.documentor.class.php for
    All rights reserved to Lato Sensu Management for all countries.
    All Intellectual Property belongs to Patrick Boens.

    Other shortcuts exist. They exist to make it simple to change the formulation
    of parts that can vary over time.

    It does not change the undisputed truth that ALL code has been created by
    Patrick Boens, the author, who owns ALL the intellectual property of what
    he created.

*/

/** {{{*fheader
    {*file                  trql.documentor.class.php *}
    {*purpose               TRQL Labs Classes Documentor *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 16-08-20 19:19 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    {*abstract              The [c]Documentor[/c] class helps document ALL TRQL Labs classes
                            defined in [file]d:\websites\snippet-center\[/file].[br][br]

                            All TRQL classes share a common naming convention:
                            [c]trql.<classname>.class.php[/c]. Because the
                            [c]Documentor[/c] is itself a TRQL Labs class, it documents
                            itself. Because the [c]Documentor[/c] is based on the most
                            basic class, [c]Thing[/c], itself based on[c]Mother[/c], the
                            [c]mother[/c] of all TRQL classes (the foundation of the
                            foundation), we share a common behavior that is consistent
                            across all the classes defined.[br][br]

                            To document all the classes &#8213; meaning &hellip;
                            generating the documentation of each class &#8213; there is
                            little effort:[br][br]

                            [code][br]
                                $o = new Documentor();[br]
                                $o->documentAll();[br]
                            [/code][br][br]

                            There is no need to tell the [c]Documentor[/c] class what
                            must be documented. It goes without saying as it knows it![br][br]

                            Many of the classes of TRQL Labs have been based on the fabulous
                            work available at [url]https://www.schema.org/[/url]. Therefore,
                            it the present documentation is lacky on some parts, please head
                            to schema.org to benefit from additional information.

    *}

    {*todo                  [ol]
                                [li]Document [c]trql.tazieff.class.php[/c][/li]
                                [li]Implement the [c]trql.uikey.class.php[/c] class[/li]
                                [li]Implement the [c]trql.cursor.class.php[/c] class[/li]
                                [li]De même qu'une classe fait son propre backup, il serait
                                utile qu'une classe s'autodocumente. Le résultat de cette
                                documentation devrait être un fichier XML et on peut même
                                envisager que chaque doc soit sauvée dans un .zip pour disposer
                                d'un historique.[/li]
                                [li]Je devrais utiliser les labels ([c]trql.label.class.php[/c])[/li]
                                [li]Create the [c]trql.radio.class.php[/c] which must be based
                                    on [c]trql.radiostation.class.php[/c] AND on
                                    [c]trql-radio.radio.class.php[/c]. This work will be huge
                                    as it will probably imply many associated classes to be
                                    imported as well :playlist, track, ...[/li]
                                [li]When documenting a class, we must create an instance of
                                    the class in order to get the name of all defined
                                    properties, even the one of the parent class. Use
                                    [c]get_class_vars()[/c][/li]
                                [li]When documenting a class, we must create an instance of
                                    the class in order to get the name of the parent class
                                    OR ... we take what "extends" mentions (can also use
                                    [c]get_parent_class()[/c])[/li]
                                [li]Properties of a class must be sorted alphabetically[/li]
                                [li]Methods of a class must be sorted alphabetically[/li]
                                [li]Extract warning and remark from file header and publish[/li]
                            [/ol]
    *}

    {*remark

        Such declarations should be made available in the php.ini file.

        Unfortunately, I don't know why, PHP overwrites these settings
        each time it gets restarted. That's the reason why I have documented
        them in here.

        [code]
            [Date]
            ; Defines the default timezone used by the date functions
            ; http://php.net/date.timezone
            date.timezone ="Europe/Brussels"

            ; http://php.net/date.default-latitude
            date.default_latitude = 50.3852051

            ; http://php.net/date.default-longitude
            date.default_longitude = 4.6582953
        [/code]

        geonames can be invoked with these values:
            [url]http://api.geonames.org/timezone?lat=50.3852051&lng=4.6582953&username=PatBoens[/url]

        geonameId de Lato Sensu Management:
            [url]http://api.geonames.org/findNearby?lat=50.3852051&lng=4.6582953&username=PatBoens[/url]
            [url]http://api.geonames.org/get?geonameId=8520400&username=demo&style=full[/url]

    *}

    {*image https://www.trql.fm/images/logos/trql.documentor.jpg *}

    Official Coding Standards:
    https://git.php.net/?p=php-src.git;a=blob_plain;f=CODING_STANDARDS.md;hb=HEAD
    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 16-08-20 19:19 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}

    {*chist
        {*mdate 23-08-20 15:40 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Additional classes are now (partially) documented
                            2)  Class description + class credits are documented
                            3)  Adding an accountablePerson (Person)
                            4)  Adding an address (PostalAddress)
                            5)  Adding an audience (Audience)
                            6)  Adding an AdministrativeArea.
        *}
    *}

    {*chist
        {*mdate 05-03-21 06:17 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Adding IDs to properties and methods
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\documentor;

use \trql\quitus\Mother                             as Mother;
use \trql\quitus\iContext                           as iContext;
use \trql\vaesoli\Vaesoli                           as Vaesoli;
use \trql\schema\Thing                               as Thing;
use \trql\schema\creativework\CreativeWork                 as CreativeWork;
use \trql\audience\Audience                         as Audience;
use \trql\administrativearea\AdministrativeArea     as AdministrativeArea;
use \trql\person\Person                             as Person;
use \trql\postaladdress\PostalAddress               as PostalAddress;
use \trql\softwaresourcecode\SoftwareSourceCode     as SoftwareSourceCode;
use \trql\utility\Zip                               as Zip;

use DOMDocument;
use DOMXPath;

if ( ! defined( 'MOTHER_ABSTRACT_CLASS' ) )
    require_once( 'trql.mother.class.php' );

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'THING_CLASS_VERSION' ) )
    require_once( 'trql.thing.class.php' );

if ( ! defined( 'CREATIVEWORK_CLASS_VERSION' ) )
    require_once( 'trql.creativework.class.php' );

if ( ! defined( 'PERSON_CLASS_VERSION' ) )
    require_once( 'trql.person.class.php' );

if ( ! defined( 'ADMINISTRATIVEAREA_CLASS_VERSION' ) )
    require_once( 'trql.administrativearea.class.php' );

if ( ! defined( 'AUDIENCE_CLASS_VERSION' ) )
    require_once( 'trql.audience.class.php' );

if ( ! defined( 'POSTALADDRESS_CLASS_VERSION' ) )
    require_once( 'trql.postaladdress.class.php' );

if ( ! defined( 'SOFTWARESOURCECODE_CLASS_VERSION' ) )
    require_once( 'trql.softwaresourcecode.class.php' );

defined( 'DOCUMENTOR_CLASS_VERSION' ) or define( 'DOCUMENTOR_CLASS_VERSION','0.1' );
define( 'OPENING_CURLY_BRACE','{' );
define( 'CLOSING_CURLY_BRACE','}' );

function say( $szStr )
/*------------------*/
{
    static $aSubsts = null;
    static $aReplas = null;

    // TODO : je devrais sauver le résultat d'un say dans un fichier de cache,
    //        du moins, si cela s'avère PLUS rapide que de simplement faire la
    //        transformation de la chaîne de caractères.

    if ( is_null( $aSubsts ) )
    {
        $aSubsts[]  = '{RIGHTS}'            ; $aReplas[]  = 'Intellectual Property belongs to {PYB}. You are free to:[br][br]'                                          .
                                                            '[b]Share[/b] — copy and redistribute the material in any medium or format[br]'                             .
                                                            '[b]Adapt[/b] — remix, transform, and build upon the material for any purpose, even commercially.[br][br]'  .
                                                            'Under the following terms:[br][br]'                                                                        .
                                                            '[b]Attribution[/b] — You must give appropriate credit, provide a link to the license, '                    .
                                                            'and indicate if changes were made. You may do so in any reasonable manner, but not in any '                .
                                                            'way that suggests the licensor endorses you or your use.[br][br]'                                          .
                                                            '[b]No additional restrictions[/b] — You may not apply legal terms or technological '                       .
                                                            'measures that legally restrict others from doing anything the license permits.[br][br]'                    .
                                                            '[url]https://creativecommons.org/licenses/by/4.0/legalcode[/url]';

        $aSubsts[]  = '{COMPANY}'           ; $aReplas[]  = '{COMPANY_NAME}[br]{COMPANY_STREET}[br]{COMPANY_ZIP} {COMPANY_CITY}[br]{COMPANY_COUNTRY}[br]{COMPANY_WEB} (geonames: {COMPANY_GEONAMES})[br]{VAE}: {VAE_WEB}[br]';
        $aSubsts[]  = '{COMPANY_STREET}'    ; $aReplas[]  = 'Rue du Bois des Mazuis, 47';
        $aSubsts[]  = '{COMPANY_ZIP}'       ; $aReplas[]  = '5070';
        $aSubsts[]  = '{COMPANY_CITY}'      ; $aReplas[]  = 'Vitrival';
        $aSubsts[]  = '{COMPANY_COUNTRY}'   ; $aReplas[]  = 'Belgium';
        $aSubsts[]  = '{COMPANY_WEB}'       ; $aReplas[]  = '[url]https://www.latosensu.be[/url]';
        $aSubsts[]  = '{COMPANY_GEONAMES}'  ; $aReplas[]  = '[url]http://api.geonames.org/get?geonameId=8520400&username=demo&style=full[/url]';

        $aSubsts[]  = '{VAE}'               ; $aReplas[]  = 'Vae Soli!';
        $aSubsts[]  = '{VAE_WEB}'           ; $aReplas[]  = '[url]http://www.vaesoli.com[/url]';

        $aSubsts[]  = '{COMPANY_NAME}'      ; $aReplas[]  = 'Lato Sensu Management';
        $aSubsts[]  = '{COMPANY_SHORTNAME}' ; $aReplas[]  = 'Lato Sensu';

        $aSubsts[]  = '{PYB}'               ; $aReplas[]  = 'Pat Y. Boens';
        $aSubsts[]  = '{MAT}'               ; $aReplas[]  = 'Mathieu Goffin';

        $aSubsts[]  = '|**'                 ; $aReplas[]  = '/*';
        $aSubsts[]  = '**|'                 ; $aReplas[]  = '*/';

    }   /* if ( is_null( $aSubsts ) ) */

    return ( str_replace( $aSubsts,$aReplas,$szStr ) );
}


/* ==================================================================================== */
/** {{*trait Utils=

    {*desc

        Self-documentation methods used in all Documentor* Classes.

    *}

    {*todo
        1) Extraire les todo des headers des classes (trql.documentor.class.php)
        2) Extraire la descriptio  du header de la classe (trql.documentor.class.php)
        3) Quand on documente (documentAll()) il faut sauver un fichier HTML
    *}

    *}}
 */
/* ==================================================================================== */
Trait Utils
/*-------*/
{
    /* Ceci devrait être dans un trait pour en bénéficier dans les autres classes */
    public function property( $szMark,&$szStr )
    /*---------------------------------------*/
    {
        $szRetVal = null;

        $szMark = preg_quote( $szMark );

        if ( preg_match( "/{$szMark}(?P<val>.*?) \*\}/si",$szStr,$aMatches ) )
            $szRetVal = $aMatches['val'];

        return ( $szRetVal );
    }   /* End of Utils.property() ==================================================== */
    /* ================================================================================ */


    public function assembleRegex( $a1,$a2 )
    /*------------------------------------*/
    {
        $aRetVal = null;

        if ( ( $iCount = count( $a1 ) ) === count( $a2 ) )
        {
            for ( $i=0;$i<$iCount;$i++ )
                $aRetVal[$i] = array( $a1[$i],$a2[$i] );
        }   /* if ( ( $iCount = count( $aArgs ) ) === count( $aValues ) ) */

        return ( $aRetVal );
    }   /* End of Utils.assembleArgs() ================================================ */
    /* ================================================================================ */


    public function changeSeealso( $szStr,$szMethodName = '')
    /*-----------------------------------------------------*/
    {
        $szRetVal = $szStr;

        //var_dump( $szStr );

        //if ( preg_match( '/@(?P<type>var|fnc|param|class)\.\$?(?P<term>[[:word:]]*)(\s|\z|[[:space:][:punct:]])/si',$szStr,$aMatches ) )
        if ( preg_match_all( '/@(?P<type>var|fnc|param|class)\.\$?(?P<term>[[:word:]]*)(\s|\z|[[:space:][:punct:]])/si',$szStr,$aMatches ) )
        {
            $aReplacements = $this->assembleRegex( $aMatches['type'],$aMatches['term'] );
            //var_dump( $szStr );
            foreach( $aReplacements as $aReplacement )
            {
                // IL faudra adapter le makeID()
                $szToReplace = '@' . $aReplacement[0] . '.' . ( ! empty( $szMethodName ) ? $szMethodName . '.' : '' ) . $aReplacement[1];
                switch ( $aReplacement[0] )
                {
                    case 'class':
                        {
                            $szSubstitute   = "[c]<a href=\"?src={$aReplacement[1]}\">{$aReplacement[1]}</a>[/c]";
                        }
                        break;
                    default     :
                        {
                            $szSubstitute   = "[c]<a href=\"#{$aReplacement[0]}-" . ( ! empty( $szMethodName ) ? $szMethodName . '.' : '' ) . "{$aReplacement[1]}\">$" . $aReplacement[1] . "</a>[/c]";
                        }
                }
                //var_dump( $aReplacement,$szToReplace,$szSubstitute );
                $szRetVal = STR_replace( $szToReplace,$szSubstitute,$szRetVal );
                //var_dump( $szRetVal );
            }
            //die();
        }

        return ( $szRetVal );
    }

    public function removeStartingBlanks( $szStr )
    /*------------------------------------------*/
    {
        return ( preg_replace( '/^ {1,8}/im','  ',$szStr ) );
    }   /* End of Utils.removeStartingBlanks() ======================================== */
    /* ================================================================================ */


    public function resolveSeealso( $a )
    /*--------------------------------*/
    {
        $szSeeAlsos = '';

        if ( is_array( $a ) && count( $a ) > 0 )
        {
            //var_dump( $a );
            foreach( $a as $szSeeAlso )
            {
                if ( preg_match( '/@(?P<type>var|fnc|param)\.(?P<term>[[:word:]]*)(\s|\z|[[:space:][:punct:]])/si',$szSeeAlso,$aMatches ) )
                {
                    $szType = $aMatches['type'];
                    $szTerm = $aMatches['term'];
                    $szSeeAlsos .= "[c]<a href=\"#{$szType}.{$szTerm}\">{$szTerm}" . ( $szType === 'fnc' ? '()' : '' ) . "</a>[/c], ";
                }
                else
                {
                    $szSeeAlsos .= $szSeeAlso . ', ';
                }
            }   /* foreach( $a as $szSeeAlso ) */

            if ( substr( $szSeeAlsos,-2 ) === ', ' )
                $szSeeAlsos = substr( $szSeeAlsos,0,-2 );
        }   /* if ( is_array( $a ) && count( $a ) > 0 ) */

        return ( $szSeeAlsos );
    }

    /* ================================================================================ */
    /** {{*makeID( $szType,$szStr )=

        Generate a structured ID used to jump easily to properties ('[c]var[/c]'), to
        parameters ('[c]param[/c]') or methods ('[c]fnc[/c]')

        {*params
            $szType     (string)        Type of link. Can be '[c]var[/c]', '[c]fnc[/c]'
                                        or '[c]param[/c]'
            $szStr      (string)        The name of the property or method for which we
                                        want and ID
        *}

        {*return
            (string)        A valid and useful ID to link to properties and methods
        *}

        {*example
            $szID = $this->makeID( 'var','$self' );
        *}

        *}}
    */
    /* ================================================================================ */
    public function makeID( $szType,$szStr )
    /*------------------------------------*/
    {
        $szRetVal = '';

        $szRetVal = $szType . '.' . str_replace( array('$'),'',$szStr );

        return ( $szRetVal );
    }   /* End of Utils.makeID() ====================================================== */
    /* ================================================================================ */


    protected function safeName( $szName )
    /*----------------------------------*/
    {
        return ( trim( vaesoli::STR_Reduce( str_replace( array( '\\','.','/','{','}','[',']','<','>' ),'_',$szName ),'_' ) ) );
    }   /* End of Utils.safeName() ==================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*squareToAngle( $szStr )=

        From square tag markers to angle tag markers

        {*params
            $szStr  (string)    The string whose square brackets must be turned
                                to angke brackets (for a predefined series of
                                tags)
        *}

        {*return
            (string)    All [c]'['[/c] and [c]']'[/c] turned to [c]'<'[/c] and
                        [c]'>'[/c]
        *}

        {*warning
            DO NOT USE IN A PRODUCTION ENVIRONMENT YET.
        *}

        {*exec
            echo ( $x = LSBBCodes::squareToAngle( '[c]myVar = 8;[/c]' ) );
            echo ( $y = LSBBCodes::squareToAngle( '[p][i]This is a text[/i][/p]' ) );
            echo ( $z = LSBBCodes::squareToAngle( '[e]Emphasized[/e]' ) );
            echo ( $a = LSBBCodes::squareToAngle( 'Area of a circle: PI * r[sup]2[/sup]' ) );

            echo LSUnitTesting::assert( strstr( $x,'<code>' )                   ,
                                        'ASSERTION SUCCESS: code tag found'     ,
                                        'ASSERTION FAILURE: code tag NOT found' ,
                                        'GuideAssert' );
            echo LSUnitTesting::assert( strstr( $y,'<p>' ) && strstr( $y,'<i>' )                ,
                                        'ASSERTION SUCCESS: paragraph and italic tags found'    ,
                                        'ASSERTION FAILURE: paragraph and italic tag NOT found' ,
                                        'GuideAssert' );
            echo LSUnitTesting::assert( strstr( $z,'<em>' )                     ,
                                        'ASSERTION SUCCESS: em tag found'       ,
                                        'ASSERTION FAILURE: em tag NOT found'   ,
                                        'GuideAssert' );
        *}

        *}}
     */
    /* ================================================================================ */
    protected function squareToAngle( $szStr )
    /*--------------------------------------*/
    {
        $szStr = preg_replace( '/\[url\](.*?)\[\/url\]/si',"<a href=\"\${1}\" class=\"DocumentorLink\" title=\"Go to \${1}\" itemprop=\"url\">\${1}</a>",$szStr );
        $szStr = preg_replace( '/\[img\](.*?)\[\/img\]/si',"<img class=\"vaesoli-image shadow constrained\" src=\"\${1}\" />",$szStr );
        $szStr = preg_replace( '/\[file\](.*?)\[\/file\]/si',"<a href=\"?file=\${1}\" title=\"View \${1}\">\${1}</a>",$szStr );
        $szStr = preg_replace( '/\[author(.*)href="(.*?)"\](.*?)\[\/author\]/si',"<a href=\"\${2}\" rel=\"author\">\${3}</a>",$szStr );

        if ( preg_match( '%\[doc\](?P<doc>.*)\[/doc\]%si',$szStr,$aMatch ) )
        {
            // Ici ... où est la fonction MakeLinkToDoc()
            //$szLink = MakeLinkToDoc( trim( $aMatch['doc'] ) );
            //$szStr = preg_replace( '/\[doc\](.*?)\[\/doc\]/si','[c]' . $szLink . '[/c]',$szStr );
        }

        if ( preg_match( '%\[note\](?P<note>.*)\[/note\]%si',$szStr,$aMatch ) )
        {
            //$szRefID = MakeRefToNote( $aMatch['note'] );
            $szStr = preg_replace( '%\[note\](.*)\[/note\]%si',"<a href=\"#{$szRefID}\">go to #{$aMatch['note']}</a>",$szStr );
        }   /* if ( preg_match( '%\[note\](?P<note>.*)\[/note\]%si',$szStr,$aMatch  ) ) */

        $szStr = str_ireplace( array( '[br]'  ,'[i]','[/i]','[sup]','[/sup]','[sub]','[/sub]','[table]','[/table]','[th]','[/th]','[tr]','[/tr]','[td]','[/td]','[ol]','[/ol]','[ul]','[/ul]','[li]','[/li]','[c]'   ,'[/c]'   ,'[code]','[/code]'  ,'[p]','[/p]','[e]' ,'[/e]' ,'[sm]'   ,'[/sm]'   ,'[b]'      ,'[/b]'     ,'[pre]','[/pre]' ),
                               array( '<br />','<i>','</i>','<sup>','</sup>','<sub>','</sub>','<table>','</table>','<th>','</th>','<tr>','</tr>','<td>','</td>','<ol>','</ol>','<ul>','</ul>','<li>','</li>','<code>','</code>','<pre>' ,'</pre>'   ,'<p>','</p>','<em>','</em>','<small>','</small>','<strong>' ,'</strong>','<pre>','</pre>' ),
                               $szStr );

        return ( $szStr );
    }   /* End of Utils.squareToAngle() =============================================== */
    /* ================================================================================ */


    public static function angleToSquare( $szStr )
    /*------------------------------------------*/
    {
        return ( $szStr );
    }   /* End of Utils.angleToSquare() =============================================== */
    /* ================================================================================ */
}   /* End of trait Utils ============================================================= */
/* ==================================================================================== */


/* ==================================================================================== */
/** {{*class Documentor=

    {*desc

        Self-documentation class for the entirety of TRQL.

    *}

    *}}
 */
/* ==================================================================================== */
class Documentor extends CreativeWork implements iContext
/*-----------------------------------------------------*/
{
    use Utils;

    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self                       (array)                             Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                             );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId                     (string)                        Wikidata ID. No equivalent. *} */
    public      $szCurrentFile                  = null;             /* The current file we're documenting : TEMPORARY */

    /* ================================================================================ */
    /** {{*__construct( [$szHome] )=

        Class constructor

        {*params
            $szHome     (string)        Home of the class. Optional.
        *}

        {*return
            (self)      The current instance of the class
        *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szHome = null )
    /*-----------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        $this->about                                        = "TRQL Labs classes";
        $this->abstract                                     = "This class helps document the whole set of classes of TRQL Labs";
        $this->acquireLicensePage                           = "https://www.trql.fm/tos/";

        $this->accountablePerson                            = new Person();
        $this->accountablePerson->birthDate                 = "19591118";
        $this->accountablePerson->genderType                = "Male";
        $this->accountablePerson->givenName                 = "Patrick";
        $this->accountablePerson->familyName                = "Boens";
        $this->accountablePerson->address                   = new PostalAddress();
        $this->accountablePerson->address->streetAddress    = '47 Rue du Bois des Mazuis';
        $this->accountablePerson->address->postalCode       = '5070';
        $this->accountablePerson->address->addressLocality  = 'Vitrival';
        $this->accountablePerson->address->addressRegion    = 'WAL';
        $this->accountablePerson->address->addressCountry   = 'BE';
        $this->accountablePerson->nationality               = 'BE';
        $this->accountablePerson->vatID                     = '557.598.659';

        $this->audience                                     = new Audience();
        $this->audience->audienceType                       = 'developers';
        $this->audience->geographicArea                     = new AdministrativeArea();
        $this->audience->geographicArea->publicAccess       = true;

        $this->author                                       = $this->accountablePerson;

        //var_dump( $this->author );

        return ( $this );
    }   /* End of Documentor.__construct() ============================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*documentAll( [$szMask] )=

        Document all files of the TRQL Family

        {*params
            $szMask     (string)    Wildcard of the classes that must be documented.
                                    Optional. [c]*.*[/c] by default.
        *}

        {*return
            (self)      The current instance of the class
        *}

        *}}
    */
    /* ================================================================================ */
    public function documentAll( $szMask = null )
    /*-----------------------------------------*/
    {
        if ( is_null( $szMask ) )
            $szMask = '/.*/i';

        $i = 0;

        if ( is_array( $this->family ) )
        {
            /* For each file found in the family (of files) of this class */
            foreach( $this->family as $szFile )
            {
                if ( preg_match( $szMask,$szFile,$aMatches ) )
                {
                    if ( $this->isCommandLine() )
                        echo ++$i,'...',$szFile,"\n";
                    //echo "should document {$szFile}",$this->nl();
                    $this->document( $szFile );
                }   /* if ( preg_match( $szMask,$szFile,$aMatches ) ) */
            }   /* foreach( $this->family as $szFile ) */
        }   /* if ( is_array( $this->family ) ) */

        return ( $this );
    }   /* End of Documentor.documentAll() ============================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*document( $szFile )=

        Document a single file

        {*params
            $szFile     (string)        File to document. Optional.
        *}

        {*return
            (self)      The current instance of the class
        *}

        *}}
    */
    /* ================================================================================ */
    public function document( $szFile = null )
    /*--------------------------------------*/
    {
        $oSourceFile = new documentorSourceFile(
                            $this->szCurrentFile =
                            $szFile              =
                            ( $szFile ?? $this->self['file'] ) );

        $oSourceFile->save( $oSourceFile->document( $szFile ) );

        //var_dump( __METHOD__ . "(): SHOULD DOCUMENT " . basename( $szFile ) );
        //die();

        return ( $this );
    }   /* End of Documentor.document() =============================================== */
    /* ================================================================================ */


    public function speak() : string
    /*----------------------------*/
    {
        return( '' );
    }   /* End of Documentor.speak() ================================================== */
    /* ================================================================================ */


    public function sing() : string
    /*---------------------------*/
    {
        return( '' );
    }   /* End of Documentor.sing() =================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return.
        *}

        *}}
    */
    /* ================================================================================ */
    public function __destruct()
    /*------------------------*/
    {
        $this->backup();
        $this->autodoc();
        $this->UIKey();
        $this->WikiData();
        $this->necroSignaling();
    }   /* End of Documentor.__destruct() ============================================= */
    /* ================================================================================ */

}   /* End of class Documentor ======================================================== */
/* ==================================================================================== */


/* ==================================================================================== */
/** {{*class DocumentorFile=

    {*desc

        A file

    *}

    {*todo
        Cette classe devrait être basée sur [c]trql.file.class.php[/c]
    *}

    *}}
 */
/* ==================================================================================== */
Class DocumentorFile extends CreativeWork
/*-------------------------------------*/
{
    use Utils;

    public      $szFileName     = null;
    public      $content        = null;     /* Content of the file we're documenting */
    public      $pure           = null;     /* Content of the file with comments removed */

    /* ================================================================================ */
    /** {{*__construct()=

        Class constructor

        {*params
        *}

        {*return
            (self)      The current instance of the class
        *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szFileName )
    /*--------------------------------------*/
    {
        $this->szFileName = $szFileName;
        return ( $this );
    }   /* End of DocumentorFile.__construct() ======================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*readFile()=

        Reads the file and places the content in the $content property

        {*params
        *}

        {*return
            (self)      Returns self.
        *}

        *}}
    */
    /* ================================================================================ */
    public function readFile()
    /*----------------------*/
    {
        //var_dump( "Je vais lire " . $this->szFileName );
        $this->content = vaesoli::FIL_FileToStr( $this->szFileName );
        // Il faut encore résoudre des includes ... comme celui-ci
        // [include]C:\websites\vaesoli.org\www\httpdocs\vaesoli\include\LSClass.class.journal[/include]

        //$this->pure = preg_replace( '%/\*.*?\*/%si','',$this->content );
        $this->pure = php_strip_whitespace( $this->szFileName );

        return ( $this );
    }   /* End of DocumentorFile.readFile() =========================================== */
    /* ================================================================================ */

    /* ================================================================================ */
    /** {{*destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return.
        *}

        *}}
    */
    /* ================================================================================ */
    public function __destruct()
    /*------------------------*/
    {
    }   /* End of DocumentorFile.__destruct() ========================================= */
    /* ================================================================================ */

}   /* End of class DocumentorFile ==================================================== */
/* ==================================================================================== */


/* ==================================================================================== */
/** {{*class DocumentorSourceFile=

    {*desc

        A source file. There is also a class called SoftwareSourceCode. We have decided
        not to use it so far and prefer to use the DocumentorFile class.

    *}

    *}}
 */
/* ==================================================================================== */
Class DocumentorSourceFile extends DocumentorFile
/*---------------------------------------------*/
{
    public      $oHeader            = null;     /* File header object */
    public      $szNamespace        = null;
    public      $aFunctions         = null;
    public      $aConstants         = null;
    public      $aUses              = null;                         /* {*property   $aUses                      (array)                             An array of uses (e.g. "use \trql\quitus\Mother as Mother;"), or
                                                                                                                                                    [c]null[/c] if none. Each "use" (if any) is structured as an
                                                                                                                                                    associative array: array( 'class' => $szClass,'alias' => $szAlias ) *} */
    public      $aDefines           = null;
    public      $aSubstitutions     = null;                         /* {*property   $aSubstitutions             (array)                             An array of substitutions *} */

    protected   $aDocumentedClasses = null;                         /* {*property   $aDocumentedClasses         (array)                             Classes documented. See also $aDefinedClasses *} */
    protected   $aDefinedClasses    = null;                         /* {*property   $aDefinedClasses            (array)                             Classes detected by source code parsing. There may be
                                                                                                                                                    less classes in $aDocumentedClasses because they may
                                                                                                                                                    be not documented *} */
    protected   $aTODOs             = null;
    protected   $aSlots             = null;

    /* ================================================================================ */
    /** {{*__construct()=

        Class constructor

        {*params
        *}

        {*return
            (self)      The current instance of the class
        *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szFileName )
    /*--------------------------------------*/
    {
        $this->szFileName = $szFileName;
        parent::__construct( $szFileName );

        $this->aSubstitutions['%class%'] = 'unknown';

        return ( $this );
    }   /* End of DocumentorSourceFile.__construct() ================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*getHeader()=

        Extracts the header of the file

        {*params
        *}

        {*return
            (self)      Returns self.
        *}

        *}}
    */
    /* ================================================================================ */
    public function getHeader()
    /*-----------------------*/
    {
        $this->oHeader = new DocumentorFileHeader( $this );         /* Create a new file header AND extract the file header */

        return( $this );
    }   /* End of DocumentorSourceFile.getHeader() ==================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*getClassDefinition( $szClassName )=

        Extracts the header of the file

        {*params
            $szClassName        (string)        Name of the class whose definition is to
                                                be extracted from the source code
        *}

        {*return
            (string)    Returns the definition (everything between /** {{*[abstract]
                        class <name>= and *}}

        *}

        *}}
    */
    /* ================================================================================ */
    protected function getClassDefinition( $szClassName ) : string
    /*----------------------------------------------------------*/
    {
        $szRetVal = '';

        //var_dump( $szClassName );

        if ( preg_match('%/\*\* *?\{\{\*(abstract)? *?class *?' . $szClassName . '=(.*?)\*\}\}%si',$this->content,$aMatches ) )
            $szRetVal = $aMatches[0];

        return ( $szRetVal );
    }   /* End of DocumentorSourceFile.getClassDefinition() =========================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*getClassesDefinedInCode()=

        Returns an array of classes defined in a source code. For each class, we have
        the complete source code

        {*params
        *}

        {*remark
            $this->aDefinedClasses upedated upon return
        *}

        {*return
            (self)      Returns self.
        *}

        {*doc
            [url]https://www.php.net/manual/fr/tokens.php[/url]
        *}

        *}}
     */
    /* ================================================================================ */
    public function getClassesDefinedInCode( $szKeyword = 'class' )
    /*-----------------------------------------------------------*/
    {
        $aTmp           = array();                                  /* Return value of the function */
        $iPos           = 0;                                        /* Current position */
        $iLength        = strlen( $this->content );                 /* Length fo string to process */

        $InComment      = false;                                    /* Not in a comment */
        $InString       = false;                                    /* Not in a string */
        $InClass        = false;                                    /* Not in a class */
        $cBef           =                                           /* Character before */
        $cBal           = null;                                     /* String balancer (either ' or ") */
        $szWord         = '';                                       /* Last full word read */
        $OneLineComment = false;                                    /* One-line comment ( // or #) */
        $iLevel         = -1;                                       /* Curly brace level ({ and }) : invalid value for now */

        //var_dump( "Parsing " . $this->szFileName );
        //var_dump( $iLength,$this->content );
        //$this->die();

        //var_dump( "BEFORE PARSING LOOP" );
        //$this->die();
        /****************************************************************/
        /* PARSING LOOP, PARSING LOOP, PARSING LOOP, ...                */
        /****************************************************************/
        {
            while ( $iPos < $iLength )                                  /* While we haven't treated the whole source code */
            {
                //echo $iPos;
                $c = $this->content[$iPos++];                           /* Character we just read */
                //echo $c . ' at ' . $iPos,'<br />';
                //echo $iPos;
                //echo $c;

                /* If we're in a ONE-LINE comment and char is a CR or LF */
                if ( $OneLineComment && ( $c === chr(13) || $c === chr(10) ) )
                {
                    $InComment      = false;                            /* This terminates the comment */
                    $OneLineComment = false;
                }

                if ( ! $InString )                                      /* If we are NOT in the middle of a string */
                {
                    /* If character is a forward slash AND next char is a star */
                    if     ( $c === '/' && $iPos < $iLength && $this->content[$iPos] === '*' )
                    {
                        //echo "<p>Start of a comment with $c</p>";
                        $InComment = true;                                  /* Then ... we start a comment */
                    }
                    /* If character is a star AND next char is a forward slash */
                    elseif ( $c === '*' && $iPos < $iLength && $this->content[$iPos] === '/' )
                    {
                        $InComment = false;                                 /* Then ... the comment just stopped */
                    }
                    elseif ( ( ! $InComment && ( ( $c === '/' && $iPos < $iLength && $this->content[$iPos] === '/' ) || $c === '#' ) ) ) /* If // or # */
                    {
                        //echo "<p>Start of a comment with $c</p>";
                        $InComment = true;                                  /* Then ... the comment just started */
                        $OneLineComment = true;                             /* Remember it is a ONE-LINE comment */
                    }

                    if ( ! $InComment )                                     /* If we're NOT in a comment - and also NOT in a string */
                    {
                        if ( $c === "'" || $c === '"' )                     /* If we just read a ' or a " */
                        {
                            //echo "<p>Start of a string with $c</p>";
                            $InString = true;                               /* Then a string starts */
                            $cBal = $c;                                     /* Remember that this string must be balanced with exactly the same char */
                        }   /* if ( $c === "'" || $c === '"' ) */
                    }   /* if ( ! $InComment ) */
                }   /* if ( ! $InString ) */
                else    /* if ( ! $InString ) ........ MIDDLE OF A STRING ... MIDDLE OF A STRING ... MIDDLE OF A STRING ...  */
                {
                    if ( $c === $cBal && true )                             /* If char == string balancer AND char before not a backslash */
                    {
                        //echo "<p>Potential end of a string with $c</p>";
                        if ( $cBef != '\\' || $this->content[$iPos-3] == '\\' )
                        {
                            //echo "<p>End of a string with $c</p>";
                            $InString = false;                              /* This is the end of the string */
                            $cBal = null;                                   /* Reset the string balancer */
                        }   /* if ( $cBef != '\\' || $this->content[$iPos-3] == '\\' ) */
                    }   /* if ( $c === $cBal && true ) */
                }   /* End of ... Else of ... if ( ! $InString ) ........ MIDDLE OF A STRING ... MIDDLE OF A STRING ... MIDDLE OF A STRING ...  */

                if ( ! $InString && ! $InComment )                          /* NOW ... we're NOT in a string and NOT in a comment ... this must be code!!! */
                {
                    /* If char not a blank, not a tab, not a CR, not a LF,
                       not a minus sign, not a plus sign, not a slash,
                       not a backslash, not a star ...
                    */
                    if ( $c != ' ' && $c != chr(9) && $c != chr(10) && $c != chr(13) && $c != '-' && $c != '+' && $c != '/' && $c != '\\' && $c != '*' )
                    {
                        $szWord .= $c;                                      /* Concatenate full word (no need to use further intelligence) */

                        if ( $InClass )                                     /* If we're in a class */
                        {
                            //echo "In class";
                            if ( $c === '{' )
                            {
                                if ( $iLevel === -1 )
                                {
                                    $iLevel = 1;
                                    //echo "<p>Niveau 1 des {}</p>";
                                }
                                else
                                {
                                    $iLevel++;
                                    //echo "<p>Niveau {$iLevel} des {}</p>";
                                }
                            }   /* if ( $c === '{' ) */
                            elseif ( $c === '}' )
                            {
                                $iLevel--;
                                //echo "<p>Niveau {$iLevel} des {}</p>";
                            }   /* elseif ( $c === '}' ) */

                            if ( $iLevel === 0 )
                            {
                                //die("BOUM");
                                $aTmp[count($aTmp)-1] = array($aTmp[count($aTmp)-1][0],$iPos - 1);
                                $iLevel = -1;
                                $InClass = false;
                            }   /* if ( $iLevel === 0 ) */
                        }   /* if ( $InClass ) */
                    }   /* if ( $c != ' ' && $c != chr(9) && $c != chr(10) && $c != chr(13) && $c != '-' && $c != '+' && $c != '/' && $c != '\\' && $c != '*' ) */
                    else    /* Else of ...  if ( $c != ' ' && $c != chr(9) && ..... We have read a token stopper (a blank, a tab, a ...) */
                    {
                        //echo 'TOKEN STOPPER met; current word is <code>',$szWord,'</code></br>';
                        if ( $szWord === $szKeyword && ! $InClass )         /* If the full word we just read is 'class' or 'interface' or 'trait' AND if not already in a class */
                        {
                            //echo 'KEYWORD MATCH: STORE POSITION!!!<br/>';
                            /* Store where this class starts -- no need to know its name */
                            $aTmp[] = array( $iPos - strlen( $szWord ) - 1,-1 );
                            $InClass = true;                                /* Remember that we're in a class now */
                            $iLevel = -1;                                   /* And set the { and } level to an invalid value */
                        }   /* if ( $szWord === $szKeyword ) */

                        $szWord = '';                                       /* We've read a token stopper ... reset word */
                    }   /* End of Else of ... if ( $c != ' ' && $c != chr(9) && ..... We have read a token stopper (a blank, a tab, a ...) */
                }   /* if ( ! $InString && ! $InComment ) */

                $cBef = $c;                                                 /* Character before is the one we just read ! */
            }   /* while ( $iPos < $iLength ) */
        }
        /****************************************************************/
        /* PARSING LOOP, PARSING LOOP, PARSING LOOP, ...                */
        /****************************************************************/
        //var_dump( "AFTER PARSING LOOP" );
        //$this->die();


        /****************************************************************/
        /* QUALIFY EACH CLASS, QUALIFY EACH CLASS, QUALIFY EACH CLASS   */
        /* OK, we found a number of classes in the code; now, let's     */
        /* qualify each class we found (abstract, class name, parent    */
        /* class, implements)                                           */
        /****************************************************************/
        if ( true )
        {
            if ( isset( $aTmp) && is_array( $aTmp ) && count( $aTmp ) > 0 )
            {
                foreach( $aTmp as $aClassLines )
                {
                    $szCode = substr( $this->content,$aClassLines[0],$aClassLines[1] - $aClassLines[0] ) . '}';
                    $aLines = explode( "\n",str_replace( array("\r","\n"),"\n",$szCode ) );

                    if ( isset( $aLines[0] ) )
                    {
                        $aDef = $this->parseClassDeclaration( $aLines[0] );

                        //var_dump( $aDef );

                        if ( ! empty( $aDef['name'] ) )
                        {
                            $aClasses[$aDef['name']] = array( 'definition'  => $aDef            ,
                                                              'sourcecode'  => $szCode          ,
                                                              'startoffset' => $aClassLines[0]  ,
                                                              'endoffset'   => $aClassLines[1]  ,
                                                            );
                        }
                    }   /* if ( isset( $aLines[0] ) ) */
                }   /* foreach( $aTmp as $aClassLines ) */
            }   /* if ( is_array( $aTmp ) && count( $aTmp ) > 0 ) */
        }
        /****************************************************************/
        /* QUALIFY EACH CLASS, QUALIFY EACH CLASS, QUALIFY EACH CLASS   */
        /****************************************************************/
        //var_dump( "AFTER CLASS QUALIFICATION" );
        //$this->die();

        /****************************************************************/
        /* EXTRACT CLASS DETAILS, EXTRACT CLASS DETAILS, ...            */
        /****************************************************************/
        if ( true )
        {
            if ( isset( $aClasses ) && is_array( $aClasses ) && count( $aClasses ) > 0 )
            {
                $this->aDefinedClasses = null;

                foreach( $aClasses as $szName => $aClass )
                {
                    $szDefinitionComments   = ''; // Like all comments extracted by The Documentor ( "/** {{*__construct( $szName,$szDef,$oSourceFile )=*/ ... ") */
                    //var_dump( "Will create a new DocumentorClass" );
                    $oClass                 = new DocumentorClass( $szName,$szDefinitionComments,$this );
                    $oClass->content        = $oClass->szSourceCode = $aClass['sourcecode'];

                    $oClass->szNamespace    = $this->szNamespace;

                    /* What we have in $aClass
                        'declaration' => string 'class WarrantyScope extends Enumeration' (length=39)
                        'name' => string 'WarrantyScope' (length=13)
                        'abstract' => boolean false
                        'parent' => string '' (length=0)
                        'implements' => null
                    */

                    $oClass->szDeclaration  = $aClass['definition']['declaration'];
                    $oClass->isAbstract     = $aClass['definition']['abstract'];
                    $oClass->szParent       = $aClass['definition']['parent'];
                    $oClass->implements     = is_array( $aClass['definition']['implements'] ) ? $aClass['definition']['implements'] : null;


                    $oClass->szDefinition   = $this->getClassDefinition( $oClass->name );         /* Extracts everything that is betweeen {{* and *}} */

                    //var_dump( "CLASS DEFINITION",$oClass );
                    //$this->die();
                    // getProperties() et getMethods() MAIS il faudra que je distincte
                    // les propriétés et les méthodes qui sont DÉFINIES de celles qui
                    // sont DOCUMENTÉES

                    //var_dump( 'Calling parseDefinition()' );
                    $oClass->parseDefinition();                         /* Parses the meta information contained in the comment block of the class */

                    //var_dump( $oClass->szTODOs );
                    //var_dump( $oClass->implements );
                    //var_dump( $aClass['definition'] );
                    //$this->die();

                    $oClass->getDocumentedProperties();     /* Gets all the documented properties found in the class */
                    $oClass->getDocumentedMethods();        /* Gets all the documented methods found in the class */

                    // JUSQU'ICI ... TOUT VA BIEN!!!
                    //var_dump( $oClass->szDeclaration,"JUSQU'ICI ... TOUT VA BIEN!!!" );
                    //$this->die();

                    $this->aDefinedClasses[] = $oClass;
                    //var_dump( "AJOUT DE LA CLASSE" );

                    //var_dump( $oClass );
                }   /* foreach( $aClasses as $szName => $aClass ) */
            }   /* if ( is_array( $aClasses ) && count( $aClasses ) > 0 ) */
        }
        /****************************************************************/
        /* EXTRACT CLASS DETAILS, EXTRACT CLASS DETAILS, ...            */
        /****************************************************************/
        //var_dump( "AFTER CLASS DETAILS" );
        //$this->die();


        //var_dump( $this->aDefinedClasses[0]->aProperties );
        //var_dump( $this->aDocumentedClasses );
        //var_dump( $this->aDefinedClasses );
        //$this->die();

        //$this->die("Bon ... je m'arrête ici en mode DEBUG pour voir pourquoi les propriétés ne sont plus trouvées" );

        return ( $this );
    }   /* == End of DocumentorSourceFile.getClassesDefinedInCode() =================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*parseClassDeclaration( $szDeclaration )=

        Extracts the class sourcecode, and the start and stop position of each classe
        contained in a file source code

        {*params
            $szDeclaration  (string)    The class declaration
        *}

        {*return
            (array)     An associative array that holds the parts of the class
                        declaration; the 'implements' slot is either null or an array.

                        $aRetVal = array( 'declaration' => null ,
                                          'name'        => null ,
                                          'abstract'    => false,
                                          'parent'      => ''   ,
                                          'implements'  => null ,
                                        );
        *}

        *}}
     */
    /* ================================================================================ */
    protected function parseClassDeclaration( $szDeclaration )
    /*------------------------------------------------------*/
    {
        $aRetVal = array( 'declaration' => trim( $szDeclaration )   ,
                          'name'        => ''                       ,
                          'abstract'    => false                    ,
                          'parent'      => ''                       ,
                          'implements'  => null                     ,
                        );

        if ( preg_match('/abstract *?class/i',$szDeclaration ) )
            $aRetVal['abstract'] = true;

        if ( preg_match('/class *(?<class>[[:ascii:][:word:]]*?)( |\z)/i'       ,$szDeclaration,$aMatches ) )
            $aRetVal['name'] = trim( $aMatches['class'] );

        if ( preg_match( '/extends *(?P<parent>.*?)( |\z)/si'                   ,$szDeclaration,$aMatches ) )
            $aRetVal['parent'] = trim( $aMatches['parent'] );

        //if ( preg_match( '/implements *(?P<implements>[[:ascii:][:word:]]*)/i'  ,$szDeclaration,$aMatches ) )
        if ( preg_match( '/implements *(?P<implements>.*?)( |\z)/si'            ,$szDeclaration,$aMatches ) )
            $aRetVal['implements'] = explode( ',',trim( $aMatches['implements'] ) );

        return ( $aRetVal );
    }   /* End of DocumentorSourceFile.parseClassDeclaration() ======================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*getClassesDocumented()=

        Extracts a list of classes defined/documented in the source file

        {*params
        *}

        {*remark

            There may be MORE classes in a source file. Here we extract the documentation
            of each class. If a class is NOT documented, it may NOT appear in here.

        *}

        {*return
            (self)      Returns self.
        *}

        {*seealso
            [c]getClassesDefinedInCode()[/c]
        *}

        *}}
    */
    /* ================================================================================ */
    // 2021-03-03 ... tmp ... avoid confusion between defined and documented public function getClassesDocumented()
    // 2021-03-03 ... tmp ... avoid confusion between defined and documented /*----------------------------------*/
    // 2021-03-03 ... tmp ... avoid confusion between defined and documented {
    // 2021-03-03 ... tmp ... avoid confusion between defined and documented     //var_dump( __METHOD__ );
    // 2021-03-03 ... tmp ... avoid confusion between defined and documented     $this->aDocumentedClasses = array();                        /* Default return value of the method */
    // 2021-03-03 ... tmp ... avoid confusion between defined and documented
    // 2021-03-03 ... tmp ... avoid confusion between defined and documented     if ( preg_match_all( '/\{\{\*class(.*?)\*\}\}/si',$this->content,$aMatch,PREG_PATTERN_ORDER ) )
    // 2021-03-03 ... tmp ... avoid confusion between defined and documented     {
    // 2021-03-03 ... tmp ... avoid confusion between defined and documented         $aResults = $aMatch[0];
    // 2021-03-03 ... tmp ... avoid confusion between defined and documented
    // 2021-03-03 ... tmp ... avoid confusion between defined and documented         foreach ( $aResults as $szClassDef )
    // 2021-03-03 ... tmp ... avoid confusion between defined and documented         {
    // 2021-03-03 ... tmp ... avoid confusion between defined and documented             if ( preg_match( "/{{\*class (?P<classname>.*?)=/si",$szClassDef,$aMatch ) )
    // 2021-03-03 ... tmp ... avoid confusion between defined and documented             {
    // 2021-03-03 ... tmp ... avoid confusion between defined and documented                 $szClassName = trim( $aMatch['classname'] );
    // 2021-03-03 ... tmp ... avoid confusion between defined and documented                 //var_dump( $szClassName );
    // 2021-03-03 ... tmp ... avoid confusion between defined and documented                 //var_dump( $szClassDef );
    // 2021-03-03 ... tmp ... avoid confusion between defined and documented                 var_dump( "Will create a new DocumentorClass" );
    // 2021-03-03 ... tmp ... avoid confusion between defined and documented                 $this->aDocumentedClasses[] = new DocumentorClass( $szClassName,$szClassDef,$this );
    // 2021-03-03 ... tmp ... avoid confusion between defined and documented             }   /* if ( preg_match( "/{{\*class (?P<classname>.*?)=/si",$szClassDef,$aMatch ) ) */
    // 2021-03-03 ... tmp ... avoid confusion between defined and documented         }   /* foreach ( $aResults as $szClassDef ) */
    // 2021-03-03 ... tmp ... avoid confusion between defined and documented     }   /* if ( preg_match_all( '/\{\{\*class(.*?)\*\}\}/si',$this->content,$aMatch,PREG_PATTERN_ORDER ) ) */
    // 2021-03-03 ... tmp ... avoid confusion between defined and documented
    // 2021-03-03 ... tmp ... avoid confusion between defined and documented
    // 2021-03-03 ... tmp ... avoid confusion between defined and documented     foreach( $this->aDocumentedClasses as $aClass )
    // 2021-03-03 ... tmp ... avoid confusion between defined and documented     {
    // 2021-03-03 ... tmp ... avoid confusion between defined and documented         //var_dump( $this->aDocumentedClasses );
    // 2021-03-03 ... tmp ... avoid confusion between defined and documented     }   /* foreach( $this->aDocumentedClasses as $aClass ) */
    // 2021-03-03 ... tmp ... avoid confusion between defined and documented
    // 2021-03-03 ... tmp ... avoid confusion between defined and documented     //$this->die();
    // 2021-03-03 ... tmp ... avoid confusion between defined and documented     return ( $this );                                           /* Return self to caller : object updated */
    // 2021-03-03 ... tmp ... avoid confusion between defined and documented }   /* End of DocumentorSourceFile.getClassesDocumented() ========================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*getTODOs()=

        Extracts a list of TODOs defined in the source file

        {*params
        *}

        {*return
            (self)      Returns self.
        *}

        *}}
    */
    /* ================================================================================ */
    public function getTODOs()
    /*----------------------*/
    {
        $this->aTODOs = array();                        /* Default return value of the method */

        if ( preg_match_all('/\{\*todo(?P<todo>.*?)\*\}/si',$this->content,$aMatch,PREG_PATTERN_ORDER ) )
        {
            foreach( $aMatch['todo'] as $szTODO )
            {
                $this->aTODOs[] = trim( $szTODO );
            }   /* foreach( $aMatch['todo'] as $szTODO ) */

        }   /* if ( preg_match_all('/\{\*todo(?P<todo>.*?)\*\}/si',$this->oHeader->szHeader,$aMatch,PREG_PATTERN_ORDER ) ) */

        return ( $this );                                           /* Return self to caller : object updated */
    }   /* End of DocumentorSourceFile.getTODOs() ===================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*getMarks( $szMark,$szSlot )=

        Extracts a list of "marks" defined in the source file

        {*params
        *}

        {*return
            (self)      Returns self.
        *}

        {*example
            $oDoc = new DocumentorSourceFile();

        *}

        {*seealso
            getTODOs()
        *}

        *}}
    */
    /* ================================================================================ */
    public function getMarks( $szMark,$szSlot )
    /*---------------------------------------*/
    {
        if ( ! empty( $szMark ) && ! empty( $szSlot ) )
        {
            //if ( preg_match_all('/\{\*quote(?P<mark>.*?)\*\}/si',$this->content,$aMatch,PREG_PATTERN_ORDER ) )
            if ( preg_match_all('/\{\*' . $szMark . '(?P<mark>.*?)\*\}/si',$this->content,$aMatch,PREG_PATTERN_ORDER ) )
            {
                foreach( $aMatch['mark'] as $szStr )
                {
                    $this->aSlots[$szSlot][] = trim( $szStr );
                }   /* foreach( $aMatch['mark'] as $szStr ) */
                //var_dump( $this->aSlots[$szSlot] );

            }   /* if ( preg_match_all( '/\{\*' . $szMark . ' (?P<mark>.*?)\*\}/si',$this->content,$aMatch,PREG_PATTERN_ORDER ) ) */
        }   /* if ( ! empty( $szMark ) && ! empty( $szSlot ) ) */

        return ( $this );                                           /* Return self to caller : object updated */
    }   /* End of DocumentorSourceFile.getMarks() ===================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*analyze()=

        Analyzes the source File

        {*params
        *}

        {*return
            (string)    Returns the HTML of the documentation.
        *}

        *}}
    */
    /* ================================================================================ */
    public function analyze()
    /*---------------------*/
    {
        $this->readFile();                                      /* Reads the file */
        $this->getHeader();                                     /* Get the file header */
        $this->getNamespace();                                  /* Get the namespace of the source file: ONLY 1 namespace (limitation) */
        $this->getUses();                                       /* Get the top-level uses */
        $this->getConstants();                                  /* Get the top-level constants */
        $this->getDefines();                                    /* Get the top-level defines */
        $this->getIncludes('require')->getIncludes('include');  /* Get all includes and requires */
        $this->getTraitsDocumented();                           /* Get the traits documented in the source file */
        $this->getTraitsDefinedInCode();                        /* Get the traits defined in the code of the source file */
        $this->getInterfacesDocumented();                       /* Get the interfaces documented in the source file */
        $this->getInterfacesDefinedInCode();                    /* Get the interfaces defined in the code of the source file */
        //$this->getClassesDocumented();                          /* Get the classes documented in the source file (NOT ALL classes are documented -> different from getClassesDefinedInCode())*/
        //var_dump( "BEFORE getClassesDefinedInCode()" );
        //$this->die();
        $this->getClassesDefinedInCode();                       /* Get the classes defined in the source code (NOT ALL classes are documented -> different from getClassesDocumented()) */
        //var_dump( "CLASSE DEFINED IN CODE OBTAINED" );
        //$this->die();
        $this->getFunctionsDocumented();                        /* Get the functions documented in the source file */
        $this->getFunctionsDefinedInCode();                     /* Get the functions defined in the code of the source file */
        $this->getTODOs();                                      /* Get {*todo ... *} in the entire source code */

    }   /* End of DocumentorSourceFile.analyze() ====================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*s( $szStr )=

        Apply the private substitutions

        {*params
            $szStr      (string)    The string in which we need to apply the private
                                    substitutions (e.g. [c]%class%[/c] is, for example,
                                    transformed into the class name we are currently
                                    documenting)
        *}

        {*return
            (string)    Returns @param.szStr with subsitutions applied
        *}

        *}}
    */
    /* ================================================================================ */
    protected function s( $szStr )
    /*--------------------------*/
    {
        return ( str_replace( array_keys( $this->aSubstitutions ),array_values( $this->aSubstitutions ),$szStr ) );
    }   /* End of DocumentorSourceFile.s() ============================================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*document( [$szFile])=

        Documents the Source File

        {*params
            $szFile         (string)        Optional. Name of the file to document
        *}

        {*return
            (string)    Returns the HTML of the documentation.
        *}

        *}}
    */
    /* ================================================================================ */
    public function document( $szFile = null )
    /*--------------------------------------*/
    {
        //var_dump( "On me demande de générer la doc de " . $szFile );
        //die();
        //$this->die("ICI " . (string) time() );

        $szHTML = '';                                               /* Return value of the method */

        $szFile = $szFile ?? $this->szFileName ?? $this->self['file'];
        //var_dump( $szFile,$this->documentationFile() );

        if ( false && vaesoli::FIL_MDate( $szDocFile = $this->documentationFile(),'int' ) > vaesoli::FIL_MDate( $szFile,'int' ) )
        {
            $this->die("ICI " . (string) time() );
            //var_dump( "La doc EST à jour" );
            $szHTML = vaesoli::FIL_FileToStr( $szDocFile );
            goto end;
        }   /* if ( vaesoli::FIL_MDate( $szDocFile = $this->documentationFile(),'int' ) > vaesoli::FIL_MDate( $szFile,'int' ) ) */
        else    /* Else of ... if ( vaesoli::FIL_MDate( $szDocFile = $this->documentationFile(),'int' ) > vaesoli::FIL_MDate( $szFile,'int' ) ) */
        {
            //var_dump( "La doc n'est PAS à jour" );
            //var_dump( date( 'd-m-Y H:i:s',vaesoli::FIL_MDate( $szFile   ,'int' ) ),
            //          date( 'd-m-Y H:i:s',vaesoli::FIL_MDate( $szDocFile,'int' ) ) );

            //$this->die( "BEFORE ANALYZING" );


            /* ======================================================================== */
            /* ======================================================================== */
            /* ======================================================================== */
            /* ======================================================================== */
            /* MAIN MACHINERY (ANALYZE),  MAIN MACHINERY (ANALYZE), MAIN MACHINERY ...  */
            /* ======================================================================== */
            $this->analyze();                                       /* Reads the file, get its namespace, read all USEs, the constants, etc. */
            /* ======================================================================== */
            /* MAIN MACHINERY (ANALYZE),  MAIN MACHINERY (ANALYZE), MAIN MACHINERY ...  */
            /* ======================================================================== */
            /* ======================================================================== */
            /* ======================================================================== */
            /* ======================================================================== */
            //$this->die( "AFTER ANALYZING" );

            /* GRAND RENDERING ======================================================== */
            {   /* Style */
                $szHTML .= "<style>\n";
                    $szHTML .= ".trql_documentor_DocumentorSourceFile { margin: 1em 1em; padding: 1em; border: 1px solid #000; box-sizing: border-box; }\n";
                    $szHTML .= ".trql_documentor_DocumentorSourceFile * { box-sizing: border-box; }\n";
                    $szHTML .= ".trql_documentor_DocumentorSourceFile hr { border-top: 4px solid #800 !important; margin:2em 0; box-shadow: 0 6px 10px 1px rgba(0,0,0,.2); }\n";
                    $szHTML .= ".trql_documentor_DocumentorSourceFile pre { background: #c001; }\n";
                    $szHTML .= ".trql_documentor_DocumentorSourceFile pre strong { color: #b00; }\n";
                    $szHTML .= ".DocumentorLabel { font-style: italic; display: block; margin-top:1em; }\n";
                    $szHTML .= ".property { font-weight: bold;}\n";

                    $szHTML .= ".shadow { box-shadow: 0 20px 15px -15px rgba(0,0,0,.5); }\n";
                    $szHTML .= ".constrained { max-width: 100%; height: auto; }\n";
                    $szHTML .= ".center { text-align:center; }\n";

                    $szHTML .= "code,samp, .filename {color: #800 !important;\n"    .
                               "   font-family: Consolas,\"courier new\";\n"        .
                               "   background: rgba(240, 240, 240, 0.5);\n"         .
                               "   border: 1px solid silver;\n"                     .
                               "   border-radius: 3px;\n"                           .
                               "   padding: 0px 5px; }\n";

                    $szHTML .= ".seealso code a {text-decoration:none;\n"           .
                               "   color: #800 !important;\n"                       .
                               "   font-weight: bold;\n" .
                               "   font-style: italic;\n" .
                               "   }\n";

                    $szHTML     .= ".property.inheritance code { border: none !important; }\n";
                    $szHTML     .= ".assert.success { border: 2px solid green; padding: 5px; border-radius:3px; }\n";
                    $szHTML     .= ".assert.failure { border: 2px solid red; padding: 5px; border-radius:3px; }\n";
                    $szHTML     .= ".assert.success code, .assert.failure code { border: none !important; }\n";

                    //$szHTML .= ".seealso code a:before {content: \"\\2221 \" ;\n }";
                    //$szHTML .= ".seealso code { background-color: #800 !important;}\n";

                    $szHTML .= ".DocumentorLabel { font-style: italic; display: block;}\n";
                    $szHTML .= "section.class { margin: 1em 1em; padding: 1em; border: 1px solid #000; background: #eee9; }\n";

                    $szHTML .= "img.vaesoli-image { border:1px solid silver; padding: 1em; display: block;}\n";

                    $szHTML .= "table.properties { border:1px solid silver; border-collapse: collapse; width:100%; }\n";
                    $szHTML .= "table.properties thead th { border:1px solid silver;padding: .5em; width:20%; }\n";
                    $szHTML .= "table.properties thead th.description { width:60%; }\n";
                    $szHTML .= "table.properties tr.property td,\n";
                    $szHTML .= "table.properties tr.parameter td { border:1px solid silver;padding: .5em; width:20%; }\n";
                    $szHTML .= "table.properties tr.property td.description,\n";
                    $szHTML .= "table.properties tr.parameter td.description { width: 60%; }\n";

                    $szHTML .= "p.property.func { font: .9em/1em lucida,georgia,\"times new roman\",serif;\n"       .
                               "   letter-spacing: 3px;\n"                                                          .
                               "   width: 100%;\n"                                                                  .
                               "   margin: 0 0 15px 0;\n"                                                           .
                               "   padding: 5px;\n"                                                                 .
                               "   color: rgb(255,128,0);\n"                                                        .
                               "   padding: 1em;\n"                                                                 .
                               "   border: 1px solid #999;\n"                                                       .
                               "   box-shadow: 0 0 5px 5px rgb(200 200 200 / 30%);\n"                               .
                               "   border: 1px solid #888; }\n";
                    //$szHTML .= "p.property.func span.name { border:1px solid red; padding:6px; }\n";

                $szHTML .= "</style>\n\n";
            }   /* Style */
            /* GRAND RENDERING ======================================================== */

            /* GRAND RENDERING ======================================================== */
            {   /* HTML */
                $szHTML    .= "<div class=\"" . $this->safeName( __CLASS__ ) . "\">\n";
                    $szHTML    .= $this->oHeader->render( 'html' );
                    $szHTML    .= "<section class=\"classes\">\n";
                        //foreach( $this->aDefinedClasses as $szName => $aClass )
                        //{
                        //    //$szHTML    .= "<section class=\"class\">\n";
                        //    //    $szHTML     .= "<span class=\"DocumentorLabel\">Class: </span><span class=\"property classname\">" . $this->squareToAngle( '[c]' . $szName . '[/c]') . "</span>\n";
                        //    //$szHTML    .= "</section> <!-- .class -->\n";
                        //}

                        //var_dump( $this->aDocumentedClasses );
                        // Bon ... ici, j'ai un petit problème!

                        // En fait, j'ai une sorte de confusion entre (1) les
                        // classes dites "documentées" et (2) les classes définies
                        //
                        // Normalement, tout devrait être disponible dans les
                        // classes documentées ($this->aDocumentedClasses) mais
                        // en fait tout se trouve dans les classes définies
                        // ($this->aDefinedClasses).
                        //
                        // En soi, cela n'est pas un problème pour la génération
                        // de la documentation. Par contre, c'est un problème
                        // dans la programmation.
                        // {*todo résoudre confusion entre "this->aDefinedClasses" et "this->aDocumentedClasses" *}

                        if ( is_array( $this->aDefinedClasses ) )
                        {
                            //foreach( $this->aDocumentedClasses as $oClass )
                            foreach( $this->aDefinedClasses as $oClass )
                            {
                                //var_dump( $oClass->aParentClasses );
                                //var_dump( $oClass->szDeclaration );
                                //var_dump( $oClass->description );
                                //$this->die();

                                $this->aSubstitutions['%class%'] = $oClass->name;

                                $szHTML    .= "<section class=\"class shadow\">\n";
                                    $szHTML     .= "<span class=\"DocumentorLabel\">Class: </span><span class=\"property classname\">"              . $this->squareToAngle( say( '[c]' .   $oClass->name  . '[/c]' ) ) . "</span>\n";
                                    $szHTML     .= "<span class=\"DocumentorLabel\">Description: </span><span class=\"property description\">"      . $this->squareToAngle( say( $this->s( $oClass->description  ) ) ) . "</span>\n";

                                    if ( is_array( $oClass->aParentClasses ) && count( $oClass->aParentClasses ) > 0 )
                                    {
                                        $szBreadcrumb = '';
                                        foreach( $oClass->aParentClasses as $aClass )
                                        {
                                            $a = explode( '\\',$aClass['name'] );
                                            $szBreadcrumb .= '@class.' . end( $a ) . ' &gt; ';
                                        }

                                        // Finish the breadcrumb with the name of the class we're busy with
                                        $szBreadcrumb = str_replace( array('[c]','[/c]'),'',$this->changeSeealso( $szBreadcrumb ) ). $oClass->name;

                                        $szHTML     .= "<span class=\"DocumentorLabel\">Inheritance: </span><span class=\"property inheritance\">"  . $this->squareToAngle( say( '[c]' .   $szBreadcrumb           . '[/c]'           ) ) . "</span>\n";
                                    }

                                    if ( ! empty( $oClass->szDeclaration ) )
                                        $szHTML     .= "<span class=\"DocumentorLabel\">Declaration: </span><span class=\"property declaration\">"  . $this->squareToAngle( say( '[c]' .   $oClass->szDeclaration  . '[/c]'           ) ) . "</span>\n";

                                    if ( ! empty( $oClass->keywords ) )
                                        $szHTML     .= "<span class=\"DocumentorLabel\">Keywords: </span><span class=\"property keywords\">"        . $this->squareToAngle( say(           $oClass->keywords                          ) ) . "</span>\n";

                                    if ( ! empty( $oClass->szCredits ) )
                                        $szHTML     .= "<span class=\"DocumentorLabel\">Credits: </span><span class=\"property credits\">"          . $this->squareToAngle( say( $this->s( $oClass->szCredits                         ) ) ) . "</span>\n";

                                    if ( ! empty( $oClass->abstract ) )
                                        $szHTML     .= "<span class=\"DocumentorLabel\">Abstract: </span><span class=\"property abstract\">"        . $this->squareToAngle( say( $this->s( $oClass->abstract                          ) ) ) . "</span>\n";

                                    if ( ! empty( $oClass->szDoc ) )
                                        $szHTML     .= "<span class=\"DocumentorLabel\">Doc: </span><span class=\"property doc\">"                  . $this->squareToAngle( say(           $oClass->szDoc . '?utm_source=TRQLLabs'    ) ) . "</span>\n";

                                    if ( ! empty( $oClass->szWarning ) )
                                        $szHTML .= "<span class=\"DocumentorLabel\">Warning: </span><span class=\"property warning\">"              . $this->squareToAngle( say( $this->s( $oClass->szWarning ) ) ) . "</span>\n";

                                    if ( ! empty( $oClass->szRemark ) )
                                        $szHTML .= "<span class=\"DocumentorLabel\">Remarks: </span><span class=\"property remark\">"               . $this->squareToAngle( say( $this->s( $oClass->szRemark ) ) ) . "</span>\n";

                                    if ( ! empty( $oClass->szTODOs ) )
                                        $szHTML .= "<span class=\"DocumentorLabel\">TODOs: </span><span class=\"property todo\">"                   . $this->squareToAngle( say( $this->s( $oClass->szTODOs ) ) ) . "</span>\n";


                                    /* Bon, ici ... ce que je cherchee à faire c'est de créer un objet
                                       de la classe qu'on documente ($oClass->name) afin d'en trouver
                                       toutes les propriétés grâce à get_object_vars() */
                                    if ( ! class_exists( $oClass->name ) )
                                    {
                                        //var_dump( $oClass->name );
                                        /* Ceci est le fichier dans lequel la classe est définie */
                                        //var_dump( $oClass->oSourceFile->szFileName );
                                        /* Ceci est le namespace que j'ai détecté */
                                        //var_dump( $oClass->oSourceFile->szNamespace );
                                        //$this->die();

                                        /* Je fais donc un require du fichier source */
                                        //require_once( $oClass->oSourceFile->szFileName );

                                        /* Et je crée un objet de la classe en question */
                                        /* Exemple:    '\trql\AdministrativeArea\AdministrativeArea' */
                                        $szClassName = "\\{$oClass->oSourceFile->szNamespace}\\{$oClass->name}";
                                        //$o = new \trql\AdministrativeArea\AdministrativeArea();
                                        //$o = new $szClassName();
                                        //$aProps = get_object_vars( $o );
                                        //var_dump( $aProps );
                                    }   /* if ( ! class_exists( $oClass->name ) ) */

                                    //var_dump( $oClass->aProperties );
                                    usort( $oClass->aProperties,function( $a,$b )
                                                                {
                                                                    if     ( strtolower( $a->name ) === strtolower( $b->name ) )
                                                                        return 0;
                                                                    elseif ( strtolower( $a->name )  >  strtolower( $b->name ) )
                                                                        return 1;
                                                                    else
                                                                        return -1;
                                                                } );

                                    /* **************************************************************************** */
                                    /* **************************************************************************** */
                                    /* Display ALL the properties of the class */
                                    if ( is_array( $oClass->aProperties ) && count( $oClass->aProperties ) > 0 )
                                    {
                                        $szHTML     .= "<span class=\"DocumentorLabel\">Properties: </span>\n";
                                        $szHTML     .= "<table class=\"properties\">\n";
                                        $szHTML     .= "<thead>\n";
                                            $szHTML .= "<tr>\n";
                                                $szHTML .= "<th class=\"name\">Name</th>\n";
                                                $szHTML .= "<th class=\"type\">Type</th>\n";
                                                $szHTML .= "<th class=\"description\">Description</th>\n";
                                            $szHTML .= "</tr>\n";
                                        $szHTML     .= "</thead>\n";
                                        foreach( $oClass->aProperties as $oProperty )
                                        {
                                            //var_dump( $oProperty );
                                            //die();
                                            $szHTML .= "<tr class=\"property\">\n";
                                                $szHTML .= "<td class=\"name\" id=\"" . $this->makeID( 'var',$oProperty->name ) . "\">" . trim( $this->squareToAngle(                                     '[c]' . $oProperty->name        . '[/c]' )   ) . "</td>\n";
                                                $szHTML .= "<td class=\"type\">"                                                        . trim( $this->squareToAngle(                                     '[c]' . $oProperty->szTypes     . '[/c]' )   ) . "</td>\n";
                                                $szHTML .= "<td class=\"description\">"                                                 . trim( $this->squareToAngle(  $this->changeSeealso( vaesoli::STR_Reduce( $oProperty->description ),'' ) ) ) . "</td>\n";
                                            $szHTML .= "</tr>\n";
                                            //$szHTML     .= "<span class=\"property prop\">" . $this->squareToAngle( '[c]' . $oProperty->name . '[/c]') . "</span>, \n";
                                        }
                                        $szHTML     .= "</table>\n";

                                        /* Get rid of the last ',' */
                                        //$szHTML = preg_replace( '/, *?[\r\n]\z/si','',$szHTML );
                                    }   /* if ( is_array( $oClass->aProperties ) && count( $oClass->aProperties ) > 0 ) */
                                    /* **************************************************************************** */
                                    /* **************************************************************************** */

                                    if ( ! empty( $szSeeAlsos = $this->resolveSeealso( $oClass->aSeeAlsos ) ) )
                                        $szHTML .= "<span class=\"DocumentorLabel\">See also: </span><span class=\"property seealso\">" . $this->squareToAngle( say( $szSeeAlsos ) ) . "</span>\n";

                                    usort( $oClass->aMethods,function( $a,$b )
                                                                {
                                                                    if     ( strtolower( $a->name ) === strtolower( $b->name ) )
                                                                        return 0;
                                                                    elseif ( strtolower( $a->name )  >  strtolower( $b->name ) )
                                                                        return 1;
                                                                    else
                                                                        return -1;
                                                                } );

                                    /* **************************************************************************** */
                                    /* **************************************************************************** */
                                    /* Display ALL the methods */
                                    if ( is_array( $oClass->aMethods ) && count( $oClass->aMethods ) > 0 )
                                    {
                                        //$oFnc->szCredits      = trim( vaesoli::STR_Reduce( $this->property( '{*credits'   ,$szFncDef ) ) );
                                        //$oFnc->szDoc          = trim( vaesoli::STR_Reduce( $this->property( '{*doc'       ,$szFncDef ) ) );
                                        //$oFnc->szTODOs        = trim( vaesoli::STR_Reduce( $this->property( '{*todo'      ,$szFncDef ) ) );
                                        //$oFnc->szRemark       = trim( vaesoli::STR_Reduce( $this->property( '{*remark'    ,$szFncDef ) ) );
                                        //$oFnc->author         = trim( vaesoli::STR_Reduce( $this->property( '{*author'    ,$szFncDef ) ) );

                                        $szHTML     .= "<h2 class=\"DocumentorLabel\">Methods of <code>{$oClass->name}</code></h2>\n";
                                        //$szHTML     .= "<span class=\"DocumentorLabel\">Methods: </span>\n";
                                        foreach( $oClass->aMethods as $oMethod )
                                        {
                                            $szHTML .= "<p class=\"property func\" id=\"" . $this->makeID( 'fnc',$oMethod->name ) . "\"><span class=\"name\">" . $this->squareToAngle( '[b][c]' . $oMethod->name . '()[/c][/b]</span>: ' ) .
                                                       $this->squareToAngle( $this->s( $oMethod->szDescription ) ) ."</p>\n";

                                            // Here, it would be nice to include the source code of the method
                                            // once it will be extracted!

                                            if ( ! empty( $oMethod->szWarning ) )
                                            {
                                                $szHTML     .= "<p class=\"property\">Warning:</p>\n";
                                                $szHTML  .= "<p>" . $this->squareToAngle( say( $this->s( $oMethod->szWarning ) ) ) . "</p>\n";
                                            }

                                            if ( is_array( $oMethod->aAsserts ) && count( $oMethod->aAsserts ) > 0 )
                                            {
                                                $szHTML .= "<p class=\"property\">Assertions:</p>\n";
                                                foreach( $oMethod->aAsserts as $szAssert => $bSuccess )
                                                {
                                                    $szHTML .= "<p><span class=\"assert " . ( $bSuccess ? 'success' : 'failure' ) . "\">" . $this->squareToAngle( "[c]{$szAssert}[/c]") . "</span></p>\n";
                                                }
                                            }

                                            if ( ! empty( $oMethod->szRemark ) )
                                            {
                                                $szHTML     .= "<p class=\"property\">Remark:</p>\n";
                                                $szHTML  .= "<p>" . $this->squareToAngle( say( $this->s( $oMethod->szRemark ) ) ) . "</p>\n";
                                            }   /* if ( ! empty( $oMethod->szRemark ) ) */

                                            if ( ! empty( $oMethod->keywords ) )
                                            {
                                                $szHTML     .= "<p class=\"property\">Keywords:</p>\n";
                                                $szHTML  .= "<p>" . $this->squareToAngle( say( $oMethod->keywords ) ) . "</p>\n";
                                            }   /* if ( ! empty( $oMethod->keywords ) ) */

                                            if ( ! empty( $oMethod->abstract ) )
                                            {
                                                $szHTML     .= "<p class=\"property\">Abstract:</p>\n";
                                                $szHTML  .= "<p>" . $this->squareToAngle( say( $this->s( $oMethod->abstract ) ) ) . "</p>\n";
                                            }   /* if ( ! empty( $oMethod->abstract ) ) */

                                            $szHTML     .= "<p class=\"property\">Syntax:</p>\n";

                                            {   /* Generate a string of parameters (if any) and displays it */
                                                $szParams = '';

                                                if ( is_array( $oMethod->aParams ) && count( $oMethod->aParams ) > 0 )
                                                {
                                                    foreach( $oMethod->aParams as $oParam )
                                                    {
                                                        $szParams = $oParam->name . ',';
                                                    }
                                                    $szParams = vaesoli::STR_strin( $szParams );
                                                }   /* if ( is_array( $oMethod->aParams ) && count( $oMethod->aParams ) > 0 ) */

                                                if ( is_array( $oMethod->aParams ) && count( $oMethod->aParams ) > 0 )
                                                    $szHTML     .= "<p><code>{$oMethod->name}( {$szParams} )</code></p>\n";
                                                else
                                                    $szHTML     .= "<p><code>" . $oMethod->name . "()</code></p>\n";
                                            }   /* Generate a string of parameters */

                                            if ( is_array( $oMethod->aParams ) && count( $oMethod->aParams ) > 0 )
                                            {
                                                $szHTML     .= "<span class=\"DocumentorLabel\">Parameters: </span>\n";
                                                $szHTML     .= "<table class=\"properties\">\n";
                                                $szHTML     .= "<thead>\n";
                                                    $szHTML .= "<tr>\n";
                                                        $szHTML .= "<th class=\"name\">Name</th>\n";
                                                        $szHTML .= "<th class=\"type\">Type</th>\n";
                                                        $szHTML .= "<th class=\"description\">Description</th>\n";
                                                    $szHTML .= "</tr>\n";
                                                $szHTML     .= "</thead>\n";
                                                foreach( $oMethod->aParams as $oParam )
                                                {
                                                    $szHTML .= "<tr class=\"parameter\">\n";
                                                        $szHTML .= "<td class=\"name\" id=\"" . $this->makeID( 'param',$oMethod->name . '.' . $oParam->name ) . "\">"  . $this->squareToAngle(                    '[c]' . $oParam->name                . '[/c]' )   . "</td>\n";
                                                        $szHTML .= "<td class=\"type\">"                                                                               . $this->squareToAngle(                    '[c]' . $oParam->types               . '[/c]' )   . "</td>\n";
                                                        $szHTML .= "<td class=\"description seealso\">"                                                                . $this->squareToAngle( say( $this->s( $this->changeSeealso( $oParam->description,$oMethod->name ) ) ) ) . "</td>\n";
                                                    $szHTML .= "</tr>\n";
                                                }
                                                $szHTML     .= "</table>\n";
                                            }   /* if ( is_array( $oMethod->aParams ) && count( $oMethod->aParams ) > 0 ) */

                                            if ( ! empty( $oMethod->oReturn ) )
                                            {
                                                $szHTML     .= "<p class=\"property return\">Return:</p>\n";
                                                $szHTML  .= "<p class=\"seealso\">({$oMethod->oReturn->szType}): " . $this->squareToAngle( say( $this->s( $this->changeSeealso( $oMethod->oReturn->description,$oMethod->name ) ) ) ) . "</p>\n";
                                            }

                                            if ( ! empty( $oMethod->szExamples ) )
                                            {
                                                $szHTML     .= "<p class=\"property\">Example(s):</p>\n";
                                                $szHTML     .= "<pre>\n";
                                                    $szHTML .= $this->squareToAngle( say( $this->s( $this->removeStartingBlanks( $oMethod->szExamples ) ) ) );
                                                $szHTML     .= "</pre>\n";
                                            }   /* if ( ! empty( $oMethod->szExamples ) ) */

                                            if ( ! empty( $szSeeAlsos = $this->resolveSeealso( $oMethod->aSeeAlsos ) ) )
                                                $szHTML .= "<span class=\"DocumentorLabel\">See also: </span><span class=\"property seealso\">" . $this->squareToAngle( say( $this->s( $szSeeAlsos ) ) ) . "</span>\n";

                                            $szHTML .= "<hr />";
                                        }   /* foreach( $oClass->aMethods as $oMethod ) */
                                        /* Get rid of the last ',' */
                                        //$szHTML = preg_replace( '/, *?[\r\n]\z/si','',$szHTML );
                                    }   /* if ( is_array( $oClass->aMethods ) && count( $oClass->aMethods ) > 0 ) */
                                    /* **************************************************************************** */
                                    /* **************************************************************************** */
                                $szHTML    .= "</section> <!-- .class -->\n";
                                //var_dump( $oClass );
                                //$this->die();
                            }   /* foreach( $this->aDocumentedClasses as $oClass ) */
                        }   /* if ( is_array( $this->aDefinedClasses ) ) */
                    $szHTML    .= "</section> <!-- .classes -->\n";
                $szHTML .= "</div> <!-- End of " . $this->safeName( __CLASS__ ) . "-->\n";
            }   /* HTML */
            /* GRAND RENDERING ======================================================== */
        }   /* End of ... Else of ... if ( vaesoli::FIL_MDate( ... */

        end:
        return ( $szHTML );
    }   /* End of DocumentorSourceFile.document() ===================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*documentationFile()=

        Returns the name of the HTML file that contains the documentation related to
        a class file (e.g. trql.french.class.php yields trql.french.class.php.html)

        {*params
        *}

        {*return
            (string)        The fully qualified documentation file or [c]null[/c] if
                            it can't be determined.
        *}

        *}}
    */
    /* ================================================================================ */
    public function documentationFile()
    /*-------------------------------*/
    {
        static $szHomeOfDocumentation = null;
        $szFile = null;

        if ( ! empty( $this->szFileName ) )
        {
            if ( is_null( $szHomeOfDocumentation ) )
                $szHomeOfDocumentation = vaesoli::FIL_RealPath( __DIR__ . '/q/common/trql.classes.home/DOCUMENTATION/' );

            $szFile =  $szHomeOfDocumentation . basename( $this->szFileName ) . '.html';
        }   /* if ( ! empty( $this->szFileName ) ) */

        return ( $szFile );
    }   /* End of DocumentorSourceFile.document() ===================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*save()=

        Saves the documentation in the class home directory

        {*params
        *}

        {*return
            (boolean)       [c]true[/c] if the documentation file could be created;
                            [c]false[/c] otherwise.
        *}

        *}}
    */
    /* ================================================================================ */
    public function save( $szHTML )
    /*---------------------------*/
    {
        static $szHomeOfDocumentation = null;
        $bRetVal    = false;

        // Je me demande s'il ne serait pas plus utile de sauver la doc d'une classe dans
        // un fichier XML qui pourrait être transformé en HTML grâce à du XSL

        //var_dump( "On me demande de sauver la doc pour " . $this->szFileName );
        //echo $szHTML;
        //die(  );

        /* If '/documentation/' folder does not exist, create it */
        if ( ! is_dir( $szDir = dirname( $this->szFileName ) ) )
            vaesoli::FIL_MkDir( $szDir );

        /* If '/documentation/' folder exists ... save documentation HTML ! */
        if ( is_dir( $szDir ) )
        {
            if ( is_null( $szHomeOfDocumentation ) )
                $szHomeOfDocumentation = vaesoli::FIL_RealPath( __DIR__ . '/q/common/trql.classes.home/DOCUMENTATION/' );

            //var_dump( $szDir,$szHomeOfDocumentation,__DIR__ );
            $szTargetFile =  $szHomeOfDocumentation . basename( $this->szFileName ) . '.html';

            {   /* Save the target file */
                if ( vaesoli::FIL_StrToFile( $szHTML,$szTargetFile ) )
                    $this->addInfo( __METHOD__ . "(): {$szTargetFile} saved" );
                else
                    $this->addInfo( __METHOD__ . "(): {$szTargetFile} COULD NOT be saved" );
            }   /* Save the target file */


            {   /* Add a file in the ZIP file */
                if ( ! defined( 'ZIP_CLASS_VERSION' ) )
                    require_once( 'trql.zip.class.php' );

                $oZIP       = new Zip();
                $szZIPFile  = $szHomeOfDocumentation . basename( $this->szFileName,'.php' ) . '.zip';

                $iDoW       = (int) date('N');
                $szWeekNo   = date('W');

                $oZIP->open( $szZIPFile,Zip::CREATE );
                $oZIP->addFile( $szTargetFile,$szInZIP = $szTargetFile . ".backup.{$szWeekNo}.{$iDoW}" );
                $oZIP->close();

                $this->addInfo( __METHOD__ . "(): {$szTargetFile} saved in {$szZIPFile} as {$szInZIP}" );
            }   /* Add a file in the ZIP file */
        }   /* if ( is_dir( $szDir ) ) */

        end:
        return ( $bRetVal );
    }   /* End of DocumentorSourceFile.save() ========================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*minify( $szStr,$szKeyword )=

        Extracts the start and stop position of the classes contained
        in a source code

        {*params
            $szStr      (string)    The source code string to process. Passed
                                    by reference but NOT touched.
            $szKeyword  (string)    Keyword to look for. Optional. [c]'class'[/c]
                                    by default.
        *}

        {*warning
            This code has never been tested
        *}

        {*return
            (array)     An array of start and stop position per class
        *}

        *}}
     */
    /* ================================================================================ */
    function minify( $szStr,$szKeyword = 'class' )
    /*------------------------------------------*/
    {
        $iPos           = 0;                                            /* Current position */
        $iLength        = strlen( $szStr );                             /* Length fo string to process */

        $InComment      = false;                                        /* Not in a comment */
        $InString       = false;                                        /* Not in a string */
        $InClass        = false;                                        /* Not in a class */
        $cBef           =                                               /* Character before */
        $cBal           = null;                                         /* String balancer (either ' or ") */
        $szCode         = '';                                           /* Code that is minified and consecutive spaces reduced to 1 */
        $OneLineComment = false;                                        /* One-line comment ( // or #) */

        while ( $iPos < $iLength )                                      /* While we haven't treated the whole source code */
        {
            $cNext = '';
            $c = $szStr[$iPos++];                                       /* Character we just read */

            //if ( $c === "\r" )
            //    $c = "\n";
            ////echo $c,'/';
            //
            //if ( $iPos < $iLength )
            //{
            //    $cNext = $szStr[$iPos];
            //    if ( $c === "\n" && ( $cNext === "\r" || $cNext === "\n" ) )
            //    {
            //        //echo "TWO CR";
            //        continue;
            //    }
            //}

            /* If we're in a ONE-LINE comment and char is a CR or LF */
            if ( $OneLineComment && ( $c === "\n" ) )
            {
                $InComment      = false;                                /* This terminates the comment */
                $OneLineComment = false;
            }



            if ( ! $InString ) /* IF NOT IN A STRING */
            {
                /* If character is a forward slash AND next char is a star */
                if     ( $c === '/' && $iPos < $iLength && $szStr[$iPos] === '*' )
                {
                    //echo "<p>Start of a comment with $c</p>";
                    $InComment = true;                                  /* Then ... we start a comment */
                }
                /* If character is a star AND next char is a forward slash */
                elseif ( $c === '*' && $iPos < $iLength && $szStr[$iPos] === '/' )
                {
                    $c = ''; $iPos++;
                    $InComment = false;                                 /* Then ... the comment just stopped */
                }
                elseif ( ( ! $InComment && ( ( $c === '/' && $iPos < $iLength && $szStr[$iPos] === '/' ) || $c === '#' ) ) ) /* If // or # */
                {
                    //echo "<p>Start of a comment with $c</p>";
                    $InComment = true;                                  /* Then ... the comment just started */
                    $OneLineComment = true;                             /* Remember it is a ONE-LINE comment */
                }

                if ( ! $InComment )                                     /* If we're NOT in a comment - and also NOT in a string */
                {
                    if ( $c === '\'' || $c === '"' )                    /* If we just read a ' or a " */
                    {
                        //echo "<p>Start of a string with $c</p>";
                        $InString = true;                               /* Then a string starts */
                        $cBal = $c;                                     /* Remember that this string must be balanced with exactly the same char */
                    }
                }
            }
            else    /* MIDDLE OF A STRING ... MIDDLE OF A STRING ... MIDDLE OF A STRING ...  */
            {
                if ( $c === $cBal && true )                    /* If char == string balancer AND char before not a backslash */
                {
                    //echo "<p>Potential end of a string with $c</p>";
                    if ( $cBef != '\\' || $szStr[$iPos-3] == '\\' )
                    {
                        //echo "<p>End of a string with $c</p>";
                        $InString = false;                              /* This is the end of the string */
                        $cBal = null;                                   /* Reset the string balancer */
                    }
                }
            }

            if ( ! $InComment )
            //if ( ! $InString && ! $InComment )                          /* NOW ... we're NOT in a string and NOT in a comment ... this must be code */
            {
                if ( $c === "\t" )
                    $c = ' ';
                elseif ( $c === "\r" )
                    $c = "\n";

                $cCharToAdd = $c;                                       /* Char we're adding to the code that we keep */
                //echo "<p>POS: <code>$iPos</code>; C: <code>'$c'</code>",ord($c),"; CBEF: <code>'$cBef'</code>",ord($cBef),"</p>";

                if ( ! $InString )                                      /* If not in a string */
                {
                    /* See if we can reduce the output */
                    if ( $cBef === ' '  && $c === ' '   ||
                         $cBef === "\n" && $c === "\n"  ||
                         $cBef === "\n" && $c === ''    ||
                         $cBef === ''   && $c === ' '   // ||
                         //$cBef === ''   && $c === "\n"
                       )
                    {
                        $cCharToAdd = '';
                    }
                    elseif ( $cBef === "\n" && $c === ' ' )
                    {
                        $cCharToAdd = '';
                    }
                    //elseif ( $cBef === "\n" && $c === ' ' )
                    //{
                    //    $cCharToAdd = '&#171;';
                    //}
                }

                //if ( $cCharToAdd === "\n" )
                //    $cCharToAdd = "&#182\n";

                $szCode .= $cCharToAdd;
            }   /* if ( ! $InString && ! $InComment ) */

            $cBef = $c;                                                 /* Character before is the one we just read ! */
        }   /* while ( $iPos < $iLength ) */

        return ( $szCode );
    }   /* == End of DocumentorSourceFile.minify() ==================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*syntaxColoring( $szLine,$aColors )=

        Syntax coloring of a string

        {*params
            $szLine     (string)    The source code string to process. Passed
                                    by reference but NOT touched.
            $aColors    (array)     Associative array of colors that must be
                                    used:[br]
                                    [c]$aColors['strings'][/c][br]
                                    [c]$aColors['vars'][/c][br]
                                    [c]$aColors['comments'][/c][br]
        *}

        {*return
            (string)        $szLine with styling included
        *}

        {*noassert *}

        {*example
            $aSyntaxColors              = array();
            $aSyntaxColors['vars']      = 'red';
            $aSyntaxColors['strings']   = 'blue';
            $aSyntaxColors['comments']  = 'rgb(197,98,49)';

            echo '<pre>';
            echo syntaxColoring( $szSourceCode,$aSyntaxColors );
            echo '</pre>';
        *}

        *}}
     */
    /* ================================================================================ */
    function syntaxColoring( &$szLine,$aColors )
    /*----------------------------------------*/
    {
        $aPatterns      = array( '/((?P<str1>\'[^"]*\')|(?P<str2>"[^"]*"))/s',  /* String literals  */
                                 '/(\${1}[[:alnum:]_]*\b)/i'                 ,  /* Variables */
                                 '%/\*(.*?)\*/%'                                /* Comments */
                               );
        $aSubstitutes   = array( '<em style="color:' . $aColors['strings']  . ';">\1</em>'    ,
                                 '<em style="color:' . $aColors['vars']     . ';">\1</em>'    ,
                                 '<em style="color:' . $aColors['comments'] . ';">/*\1*/</em>'
                               );
        $szRetVal = preg_replace( $aPatterns,$aSubstitutes,$szLine );

        return ( $szRetVal );
    }   /* == End of DocumentorSourceFile.syntaxColoring() ============================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*getInterfacesDocumented()=

        Extracts all the interfaces defined in the source file

        {*params
        *}

        {*return
            (self)      Returns self. Object updated.
        *}

        *}}
    */
    /* ================================================================================ */
    public function getInterfacesDocumented()
    /*-------------------------------------*/
    {
        return ( $this );
    }   /* End of DocumentorSourceFile.getInterfacesDocumented() ====================== */
    /* ================================================================================ */


    public function getInterfacesDefinedInCode()
    /*----------------------------------------*/
    {
    }   /* End of DocumentorSourceFile.getInterfacesDefinedInCode() =================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*getDefines()=

        Gets a list of all #defines

        {*params
        *}

        {*return
            (self)      Returns self.
        *}

        *}}
    */
    /* ================================================================================ */
    public function getDefines()
    /*------------------------*/
    {
        if ( ! empty( $this->content ) )
        {
            if ( preg_match_all( '/\{\*define *?\((?P<dt>[[:alnum:]_]+)\) +?(?P<dd>.*?) *?\*\}/si',$this->content,$aMatches, PREG_PATTERN_ORDER ) )
            {
                foreach( $aMatches[0] as $szMatch )
                {
                    if ( preg_match( '/\{\*define *?\((?P<dt>[[:alnum:]_]+)\) +?(?P<dd>.*?) *?\*\}/si',$szMatch,$aParts ) )
                    {
                        $this->AddDefine( trim( $aParts['dt'] ),
                                          trim( $aParts['dd'] ) );
                    }   /* if ( preg_match( '/\{\*define *?\((?P<dt>[[:alnum:]_]+)\) +?(?P<dd>.*?) *?\*\}/si',$szMatch,$aParts ) ) */
                }   /* foreach( $aMatches[0] as $szMatch ) */
            }   /* if ( preg_match_all( '/\{\*define *?\((?P<dt>[[:alnum:]_]+)\) +?(?P<dd>.*?) *?\*\}/si',$this->content,$aMatches, PREG_PATTERN_ORDER ) ) */
        }   /* if ( ! empty( $this->content ) ) */

        return ( $this );
    }   /* End of DocumentorSourceFile.getDefines() =================================== */
    /* ================================================================================ */


    public function AddDefine( $szTerm,$szDef )
    /*---------------------------------------*/
    {
        $this->aDefines[$szTerm] = $szDef;
    }   /* End of DocumentorSourceFile.AddDefine() ==================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*getFunctionsDocumented()=

        Extracts the list of functions contained in the source file

        {*params
        *}

        {*return
            (self)      Returns self.
        *}

        *}}
    */
    /* ================================================================================ */
    public function getFunctionsDocumented()
    /*------------------------------------*/
    {
        return ( $this );
    }   /* End of DocumentorSourceFile.getFunctionsDocumented() ======================= */
    /* ================================================================================ */

    public function getFunctionsDefinedInCode()
    /*---------------------------------------*/
    {
        return ( $this );
    }   /* End of DocumentorSourceFile.getFunctionsDefinedInCode() ==================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*getTraitsDocumented()=

        Get a list of traits

        {*params
        *}

        {*return
            (self)      Returns self; object updated
        *}

        {*doc
                [url]https://www.php.net/manual/en/language.oop5.traits.php[/url]
        *}

        *}}
    */
    /* ================================================================================ */
    public function getTraitsDocumented()
    /*---------------------------------*/
    {
        return ( $this );
    }   /* End of DocumentorSourceFile.getTraitsDocumented() ========================== */
    /* ================================================================================ */


    public function getTraitsDefinedInCode()
    /*------------------------------------*/
    {
        return ( $this );
    }   /* End of DocumentorSourceFile.getTraitsDefinedInCode() ======================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*getDeclares()=

        Get a list of declares

        {*params
        *}

        {*return
            (self)      Returns self; object updated
        *}

        {*doc
                [url]https://www.php.net/manual/en/control-structures.declare.php#control-structures.declare.ticks[/url]
        *}

        *}}
    */
    /* ================================================================================ */
    public function getDeclares()
    /*-------------------------*/
    {
        return ( $this );
    }   /* End of DocumentorSourceFile.getDeclares() ================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*getNamespace()=

        Get the source namespace (e.g. "namespace trql\documentor;" )

        {*params
        *}

        {*return
            (self)      Returns self; object updated
        *}

        {*warning
            We do not suppprt several namespaces yet !
        *}

        {*doc
            [url]https://www.php.net/manual/fr/language.namespaces.definitionmultiple.php[/url]
        *}

        *}}
    */
    /* ================================================================================ */
    public function getNamespace()
    /*--------------------------*/
    {
        $szRetVal = null;

        if ( ! empty( $this->content ) )
        {
            // Il faudrait chercher les namespace nsName { } dans le code source débarrassé de ces commentaires !
            if ( preg_match( '/namespace(?P<namespace>.*?);/si',$this->pure,$aMatches ) )
                $this->szNamespace = trim( $aMatches['namespace'] );
        }   /* if ( ! empty( $this->content ) ) */

        //var_dump( $this->szNamespace );
        //$this->die();

        return ( $this );
    }   /* End of DocumentorSourceFile.getNamespace() ================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*getConstants()=

        Get a list of constants (const ...)

        {*params
        *}

        {*return
            (self)      Returns self; object updated
        *}

        *}}
    */
    /* ================================================================================ */
    public function getConstants()
    /*--------------------------*/
    {
        return ( $this );
    }   /* End of DocumentorSourceFile.getConstants() ================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*getUses()=

        Gets a list of namespaces used such as ...

        use \trql\quitus\Mother     as Mother;
        use \trql\quitus\iContext   as iContext;
        use \trql\vaesoli\Vaesoli   as Vaesoli;
        use \trql\schema\Thing       as Thing;

        {*params
        *}

        {*return
            (self)      Returns self; object updated
        *}

        {*warning
            We do not suppprt several namespaces yet !
            PHP can alias constants, functions, classes, interfaces, and namespaces.
            ONLY classes declared at the top of the file are retrieved, and only if
            written 1 use per line.

            NOT SUPPORTED:

            use Mizo\Web\ {
               Php\WebSite,
               Php\KeyWord,
               Php\UnicodePrint,
               JS\JavaScript,
               function JS\printTotal,
               function JS\printList,
               const JS\BUAIKUM,
               const JS\MAUTAM
            };

            use DOMDocument;
            use DOMXPath;


            SUPPORTED:

            use \trql\quitus\Mother     as Mother;
            use \trql\quitus\iContext   as iContext;
            use \trql\vaesoli\Vaesoli   as Vaesoli;
            use \trql\schema\Thing       as Thing;

        *}

        {*doc
            [url]https://www.php.net/manual/fr/language.namespaces.definitionmultiple.php[/url]
            [url]https://www.php.net/manual/en/language.namespaces.importing.php[/url]
        *}

        *}}
    */
    /* ================================================================================ */
    public function getUses()
    /*---------------------*/
    {
        $szRetVal = null;

        if ( ! empty( $this->content ) )
        {
            if ( preg_match_all( '/use *(?P<class>.*?) *(as *(?P<alias>[[:word:]]*))/sm',$this->pure,$aMatches,PREG_PATTERN_ORDER ) )
            {
                // NOT SUPPORTED YET !!! (see also warning in the method header)
                // =============================================================
                // use DOMDocument;
                // use DOMXPath;

                //$aMatches = $aMatches[0];
                $aMatches = Vaesoli::assembleArrays( $aMatches['class'],$aMatches['alias'] );
                foreach( $aMatches as $szClass => $szAlias )
                {
                    $this->aUses[] = array( 'class' => $szClass,'alias' => $szAlias );
                }
            }
        }   /* if ( ! empty( $this->content ) ) */

        //$this->die();

        return ( $this );
    }   /* End of DocumentorSourceFile.getUses() ====================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*getIncludes( [$szType] )=

        Gets a list of all #defines

        {*params
            $szType         (string)        The type of include to return. Can be
                                            [c]'include'[/c] or [c]'require'[/c].
                                            Optional. [c]'include'[/c] by default.
        *}

        {*return
            (self)      Returns self.
        *}

        *}}
    */
    /* ================================================================================ */
    public function getIncludes( $szType = 'include' )
    /*----------------------------------------------*/
    {
        $szType = trim ( strtolower( $szType ) );

        if ( ! empty( $this->content) )
        {
            if ( preg_match_all( "/\{\*({$szType}|{$szType}-once) *?\((?P<dt>[[:alnum:]_\.]+)\) +?(?P<dd>.*?) *?\*\}/si",$this->content,$aMatches, PREG_PATTERN_ORDER ) )
            {
                foreach( $aMatches[0] as $szMatch )
                {
                    if ( preg_match( "/\{\*(?P<verb>{$szType}|{$szType}-once) *?\((?P<dt>[[:alnum:]_\.]+)\) +?(?P<dd>.*?) *?\*\}/si",$szMatch,$aParts ) )
                    {
                        if ( $szType === 'include' )
                        {
                            $this->AddInclude( trim( $aParts['dt'] ),
                                               trim( $aParts['dd'] )
                                             );
                        }
                        else
                        {
                            //$this->AddRequire( trim( $aParts['dt'] ),
                            //                   trim( $aParts['dd'] )
                            //                 );
                        }
                    }   /* if ( preg_match( "/\{\*(?P<verb>{$szType}|{$szType}-once) *?\((?P<dt>[[:alnum:]_\.]+)\) +?(?P<dd>.*?) *?\*\}/si",$szMatch,$aParts ) ) */
                }   /* foreach( $aMatches[0] as $szMatch ) */
            }   /* if ( preg_match_all( "/\{\*({$szType}|{$szType}-once) *?\((?P<dt>[[:alnum:]_\.]+)\) +?(?P<dd>.*?) *?\*\}/si",$this->content,$aMatches, PREG_PATTERN_ORDER ) ) */
        }   /* if ( ! empty( $this->content) ) */

        return ( $this );
    }   /* End of DocumentorSourceFile.getIncludes() ================================== */
    /* ================================================================================ */


    public function __get( $szProperty )
    /*--------------------------------*/
    {
        switch ( $szProperty )
        {
            case 'TODOS'    :
            case 'ToDos'    :   return ( $this->aTODOs );
            default         :   if ( isset( $this->aSlots[ $szProperty ] ) )
                                    return ( $this->aSlots[ $szProperty ] );
                                else
                                    return ( null );
        }
    }

    /* ================================================================================ */
    /** {{*destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return.
        *}

        *}}
    */
    /* ================================================================================ */
    public function __destruct()
    /*------------------------*/
    {
        $this->backup();
        $this->autodoc();
        $this->UIKey();
        $this->WikiData();
        $this->necroSignaling();
    }   /* End of DocumentorSourceFileObject.__destruct() ============================= */
    /* ================================================================================ */
}   /* End of class DocumentorSourceFile ============================================== */
/* ==================================================================================== */


/* ==================================================================================== */
/** {{*class DocumentorSourceFileObject=

    {*desc

        An object that is found in a DocumentorSourceFile: a history block, a class, a
        function, a parameter, a comment, a method, a property, a constant, a variable,
        ...

    *}

    *}}
 */
/* ==================================================================================== */
Class DocumentorSourceFileObject extends Thing
/*------------------------------------------*/
{
    use Utils;

    /* ================================================================================ */
    /** {{*__construct()=

        Class constructor

        {*params
        *}

        {*return
            (self)      The current instance of the class
        *}

        *}}
    */
    /* ================================================================================ */
    public function __construct()
    /*-------------------------*/
    {
        parent::__construct();

        return ( $this );
    }   /* End of DocumentorSourceFileObject.__construct() ============================ */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return.
        *}

        *}}
    */
    /* ================================================================================ */
    public function __destruct()
    /*------------------------*/
    {
        $this->backup();
        $this->autodoc();
        $this->UIKey();
        $this->WikiData();
        $this->necroSignaling();
    }   /* End of DocumentorSourceFileObject.__destruct() ============================= */
    /* ================================================================================ */

}   /* End of class DocumentorSourceFileObject ======================================== */
/* ==================================================================================== */


/* ==================================================================================== */
/** {{*class DocumentorClass=

    {*desc

        A class

    *}

    *}}
 */
/* ==================================================================================== */
Class DocumentorClass extends DocumentorSourceFileObject
/*----------------------------------------------------*/
{
    public      $content        = null;         /* Content of the class : the code */
    public      $szDefinition   = null;         /* The definition of the class (what's
                                                    between the documentor marks class
                                                    <name>= ...) */
    public      $szCredits      = null;         /* Credits of the class (useful when some parts of the code are covered via CC licenses for example) */
    public      $szDoc          = null;         /* Documentation (e.g. URL(s) where documentation can be obtained */
    public      $szSourceCode   = null;         /* Class' source code */
    public      $szDeclaration  = null;                             /* {*property       $szDeclaration          (string)                        Class declaration
                                                                                                                                                (e.g. "[c]class AdministrativeArea extends Place implements iContext[/c]" ) *} */
    public      $aParents       = null;                             /* {*property       $aParents               (array)                         An associative array of parent class(es) (if any) *} */
    public      $isAbstract     = false;                            /* {*property       $isAbstract             (bool)                          [c]true[/c] if the class is an abstract class; [c]false[/c] otherwise *} */
    public      $implements     = null;                             /* {*property       $implements             (array)                         An array of intyerfaces that the class implements (if any); otehrwise, [c]null[/c] *} */
    public      $aProperties    = null;                             /* {*property       $aProperties            (array)                         A set of properties *} */
    public      $aMethods       = null;                             /* {*property       $aMethods               (array)                         A set of methods *} */
    public      $oSourceFile    = null;                             /* {*property       $oSourceFile            (DocumentorSourceFile)          The source file object this class has been declared in *} */
    public      $szNamespace    = null;                             /* {*property       $szNamespace            (string)                        Namespace of the class if any *} */
    public      $szTODOs        = null;                             /* {*property       $szTODOs                (string)                        A list of TODOs *} */
    public      $szWarning      = null;                             /* {*property       $szWarning              (string)                        A warning *} */
    public      $szRemark       = null;                             /* {*property       $szRemark               (string)                        A remark *} */
    public      $author         = null;                             /* {*property       $author                 (Organization|Person|string)    The author of the class *} */
    public      $keywords       = null;                             /* {*property       $keywords               (string)                        A comma-delimited string where each token is a keyword *} */
    public      $aSeeAlsos      = null;                             /* {*property       $aSeeAlsos              (array)                         An array of seealso *} */
    public      $abstract       = null;                             /* {*property       $abstract               (string)                        An abstract is a short high-level introduction that sketches the context of the class *} */


    public      $wikidataId     = 'Q4479242';                       /* {*property       $wikidataId             (string)                        Wikidata ID. In object-oriented programming, a definition that specifies
                                                                                                                                                how an object works. *} */

    /* ================================================================================ */
    /** {{*__construct( $szName,$szDef,$oSourceFile )=

        Class constructor

        {*params
            $szName         (string)                    Name of the class
            $szDef          (string)                    Definition of the class (what's
                                                        between the documentor marks
                                                        class <name>= ...). By reference.
            $oSourceFile    (DocumentorSourceFile)      The origination source file
        *}

        {*return
            (self)      The current instance of the class
        *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( &$szName,&$szDef,$oSourceFile )
    /*--------------------------------------------------------*/
    {
        $this->name         = $szName;
        $this->szDefinition = $szDef;
        $this->oSourceFile  = $oSourceFile;

        return ( $this );
    }   /* End of DocumentorClass.__construct() ======================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*__get( $szVar )=

        Used for reading data from inaccessible (protected or private) or
        non-existing properties.

        {*params
            $szVar      (string)        The name of the properties to access
        *}

        {*return
            (mixed)     The value of [c]$szVar[/c]. When [c]$szVar[/c] is NOT handled
                        in here, the parent method is called.
        *}

        *}}
    */
    /* ================================================================================ */
    public function __get( $szVar )
    /*---------------------------*/
    {
        switch ( strtolower( $szVar ) )
        {
            case 'file':
                {
                    return ( $this->self['file'] );
                }
                break;
            default:
                {
                    parent::__get( $szVar );
                }
        }
    }   /* End of DocumentorClass.__get() ============================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*public parseDefinition()=

        Parses the definition of the class (what's between the documentor marks
        class <name>= ...)

        {*params
            $szName     (string)        Name of the class
            $szDef      (string)        Definition of the class (what's between
                                        {{*class <name> ... *}}
        *}

        {*return
            (self)      The current instance of the class
        *}

        *}}
    */
    /* ================================================================================ */
    public function parseDefinition()
    /*-----------------------------*/
    {
        /* J'ai au moins ces 3 choses que j'ai souvent ... voir dans mon guide.php les
           autres données que j'extrayais !!!

            {*desc

                A geographical region, typically under the jurisdiction of a particular
                government.

            *}

            {*credits

                The whole concept is derived from the fabulous work of Schema.org
                under the terms of their license:

                [url]http://schema.org/docs/terms.html[/url]
            *}

            {*doc [url]https://schema.org/AdministrativeArea[/url] *}

        */

        //var_dump( $this->szDefinition );

        /* TAG EXTRACTION ================================================================================= */
        $this->description  =       trim( vaesoli::STR_Reduce( $this->property( '{*desc'       ,$this->szDefinition ) ) );
        $this->szCredits    =       trim( vaesoli::STR_Reduce( $this->property( '{*credits'    ,$this->szDefinition ) ) );
        $this->szDoc        =       trim( vaesoli::STR_Reduce( $this->property( '{*doc'        ,$this->szDefinition ) ) );
        $this->szTODOs      =       trim( vaesoli::STR_Reduce( $this->property( '{*todo'       ,$this->szDefinition ) ) );
        $this->szWarning    =       trim( vaesoli::STR_Reduce( $this->property( '{*warning'    ,$this->szDefinition ) ) );
        $this->szRemark     =       trim( vaesoli::STR_Reduce( $this->property( '{*remark'     ,$this->szDefinition ) ) );
        $this->author       =       trim( vaesoli::STR_Reduce( $this->property( '{*author'     ,$this->szDefinition ) ) );
        $this->keywords     =       trim( vaesoli::STR_Reduce( $this->property( '{*keywords'   ,$this->szDefinition ) ) );
        $this->abstract     =       trim( vaesoli::STR_Reduce( $this->property( '{*abstract'   ,$this->szDefinition ) ) );
        if ( ! empty( $szSeeAlsos = trim( vaesoli::STR_Reduce( $this->property( '{*seealso'    ,$this->szDefinition ) ) ) ) )
            $this->aSeeAlsos = explode( ',',str_replace( ';',',',$szSeeAlsos ) );     /* All seealso's (array) */

        /* TAG EXTRACTION ================================================================================= */

        if ( empty( $this->author) && isset( $this->oSourceFile ) && $this->oSourceFile instanceof \trql\documentor\DocumentorSourceFile )
            $this->author = $this->oSourceFile->oHeader->author;

        return ( $this );
    }   /* End of DocumentorClass.parseDefinition() =================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*protected getParentClasses( $class )=

        Get ALL parent classes of a given class

        {*params
            $class  (ReflectionClass)       A Reflection class applied on a regular
                                            class
        *}

        {*return
            (array)     An associative array of parent classes:

                        array( 'name'       => $parent->getName()     ,
                               'file'       => $parent->getFilename() ,
                             );
        *}

        *}}
    */
    /* ================================================================================ */
    protected function getParentClasses( $class )
    /*-----------------------------------------*/
    {
        $aParentClasses = array();

        while ( $parent = $class->getParentClass() )
        {
            $aParentClasses[]   = array( 'name'       => $parent->getName()     ,
                                         'file'       => $parent->getFilename() ,
                                       );
            $class              = $parent;
        }   /* while ( $parent = $class->getParentClass() ) */

        return ( $this->aParentClasses = array_reverse( $aParentClasses ) );
    }   /* End of DocumentorClass.getParentClasses() ================================== */
    /* ================================================================================ */


    /* Not used AT THIS MOMENT */
    public function getPropertiesOfParentClasses()
    /*------------------------------------------*/
    {
        //var_dump( $this );
        //$this->die( "NO FURTHER GO" );

        $szNS = trim( str_replace( array( 'namespace',';' ),'',$this->szNamespace ) );
        var_dump( "NAMESPACE: " . $szNS );

        require_once( $this->oSourceFile->oHeader->szFileName );
        $szClass = $szNS . '\\' . $this->name;
        var_dump( "CLASS: " . $szClass );

        $class = new \ReflectionClass( $o = new $szClass() );

        //var_dump( $aParentClasses );

        $szHomeOfDocumentation = vaesoli::FIL_RealPath( __DIR__ . '/q/common/trql.classes.home/DOCUMENTATION/' );

        /* Dealing with something like ...
            array (size=4)
              0 =>
                array (size=2)
                  'name' => string 'trql\mother\Mother' (length=18)
                  'file' => string 'D:\websites\snippet-center\trql.mother.class.php' (length=48)
              1 =>
                array (size=2)
                  'name' => string 'trql\thing\Thing' (length=16)
                  'file' => string 'D:\websites\snippet-center\trql.thing.class.php' (length=47)
              2 =>
                array (size=2)
                  'name' => string 'trql\creativework\CreativeWork' (length=30)
                  'file' => string 'D:\websites\snippet-center\trql.creativework.class.php' (length=54)
              3 =>
                array (size=2)
                  'name' => string 'trql\creativeworkseries\CreativeWorkSeries' (length=42)
                  'file' => string 'D:\websites\snippet-center\trql.creativeworkseries.class.php' (length=60)
        */
        foreach( $aParentClasses as $aClass )
        {
            $szTargetFile = $szHomeOfDocumentation . basename( $aClass['file'] ) . '.properties.cache';
            var_dump( $szTargetFile );
        }
    }   /* End of DocumentorClass.getPropertiesOfParentClasses() ====================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*getDocumentedProperties()=

        Get ALL properties DOCUMENTED in the source file AND all DOCUMENTED properties
        of ALL parent classes IF such classes have already been treated by
        The Documentor !

        {*params
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*remark
            ALL the DOCUMENTED properties of the class are extracted AND stored in a
            cache file. This will cache the properties of a class BUT NOT of its
            parent classes.

            Parent classes are treated the same way: their properties are cached.
            When a second run is performed, the methid will find the cache of the
            parent classes and their properties will be inserted in the documentation.

        *}

        *}}
    */
    /* ================================================================================ */
    public function getDocumentedProperties()
    /*-------------------------------------*/
    {
        /* Reset ALL properties */
        $this->aProperties      = array();

        $szNS                   = trim( str_replace( array( 'namespace',';' ),'',$this->szNamespace ) );
        $szClass                = $szNS . '\\' . $this->name;

        $szHomeOfDocumentation  = vaesoli::FIL_RealPath( __DIR__ . '/q/common/trql.classes.home/DOCUMENTATION/' );
        $szTargetFile           = $szHomeOfDocumentation . basename( $this->oSourceFile->szFileName ) . '.' . md5( str_replace( array( '\\','/' ),'-',$szClass ) ) . '.properties.cache';

        /* ******************************************************************************** */
        {   /* Let's try to load all the properties of the parent classes FIRST */
            if ( is_file( vaesoli::FIL_RealPath( __DIR__ . '/' . $this->oSourceFile->oHeader->szFileName ) ) )
                require_once( $this->oSourceFile->oHeader->szFileName );
            else
            {
                //var_dump( "Ooops ... je ne trouve pas le fichier!!!" );
                goto end;
            }

            $class          = new \ReflectionClass( $o = new $szClass() );
            $aParentClasses = $this->getParentClasses( $class );

            //var_dump( $aParentClasses );

            foreach( $aParentClasses as $aClass )
            {
                $szPropertiesFile = $szHomeOfDocumentation  . basename( $aClass['file'] ) . '.' . md5( str_replace( array( '\\','/' ),'-',$aClass['name'] ) ) . '.properties.cache';

                if ( is_file( $szPropertiesFile ) )
                {
                    //var_dump( "FOUND " . $szPropertiesFile );
                    $this->aProperties = array_merge( $this->aProperties,$this->getHashFile( $szPropertiesFile ) );
                }   /* if ( is_file( $szPropertiesFile ) ) */
                //var_dump( $szPropertiesFile );
            }
        }   /* Let's try to load all the properties of the parent classes FIRST */
        /* ******************************************************************************** */

        /* ******************************************************************************** */
        /* Extract the properties now                                                       */
        /* ******************************************************************************** */
        if ( preg_match_all( '/\{\*property(?P<prop>.*?)\*\}/si',$this->szSourceCode,$aMatches,PREG_PATTERN_ORDER ) )
        {
            $aPropertiesOfThisClass = array();

            foreach( $aMatches['prop'] as $szPropertyDef )
            {
                //if ( preg_match( '/\A(?P<name>\$[[:word:]]*).*?\((?P<types>.*?)\)(?P<comment>.*)\z/si',$szPropertyDef,$aParts ) )
                if ( preg_match( '/\A(?P<name>\$[[:word:]]*).*?\((?P<types>.*?)\)(?P<desc>.*)\z/si',trim( $szPropertyDef ),$aParts ) )
                {
                    $szPropertyName     = trim( $aParts['name'] );
                    $szPropertyTypes    = trim( $aParts['types'] );
                    $szPropertyDesc     = trim( $aParts['desc'] );

                    //var_dump( $szPropertyName  );
                    //var_dump( $szPropertyTypes );
                    //var_dump( $szPropertyDesc  );

                    $aPropertiesOfThisClass[$szPropertyName] = new DocumentorClassProperty( $szPropertyName,$szPropertyTypes,$szPropertyDesc );
                }   /* if ( preg_match( '/\A(?P<name>\$[[:word:]]*).*?\((?P<types>.*?)\)(?P<desc>.*)\z/si',trim( $szPropertyDef ),$aParts ) ) */
            }   /* foreach( $aMatches['prop'] as $szPropertyDef ) */


            /* ******************************************************************************** */
            /* Cache the properties found in THIS CLASS FILE (CAN LEAD TO SOME CONFUSION
               WHEN SEVERAL CLASSES ARE CONTAINED IN THE SAME FILE) */
            /* ******************************************************************************** */
            if ( is_array( $aPropertiesOfThisClass ) && count( $aPropertiesOfThisClass ) > 0 )
            {
                //var_dump( $aPropertiesOfThisClass );
                $this->saveHashFile( $szTargetFile,$aPropertiesOfThisClass );
                $this->aProperties = array_merge( $this->aProperties,$aPropertiesOfThisClass );
                //var_dump( $this->aProperties );
            }   /* if ( is_array( $aPropertiesOfThisClass ) && count( $aPropertiesOfThisClass ) > 0 ) */
        }   /* if ( preg_match_all( '/\{\*property(?P<prop>.*?)\*\}/si',$this->szSourceCode,$aMatches,PREG_PATTERN_ORDER ) ) */
        /* ******************************************************************************** */
        /* ******************************************************************************** */

        //var_dump( $this->aProperties );
        //$this->die();

        end:
        return ( $this );
    }   /* End of DocumentorClass.getDocumentedProperties() =========================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*getDocumentedMethods()=

        Get ALL methods DOCUMENTED in the source file AND all the methods of ALL
        parent classes IF such classes have already been treated by the Documentor !

        {*params
        *}

        {*return
            (self)      The current instance of the class
        *}

        {*remark
            ALL the DOCUMENTED methods of the class are extracted AND stored in a
            cache file. This will cache the properties of a class BUT NOT of its
            parent classes.

            Parent classes are treated the same way: their properties are cached.
            When a second run is performed, the methid will find the cache of the
            parent classes and their properties will be inserted in the documentation.

        *}

        *}}
    */
    /* ================================================================================ */
    public function getDocumentedMethods()
    /*----------------------------------*/
    {
        /* Reset ALL properties */
        $this->aMethods = array();

        $szNS                   = trim( str_replace( array( 'namespace',';' ),'',$this->szNamespace ) );
        $szClass                = $szNS . '\\' . $this->name;

        $szHomeOfDocumentation  = vaesoli::FIL_RealPath( __DIR__ . '/q/common/trql.classes.home/DOCUMENTATION/' );
        $szTargetFile           = $szHomeOfDocumentation . basename( $this->oSourceFile->szFileName ) . '.' . md5( str_replace( array( '\\','/' ),'-',$szClass ) ) . '.methods.cache';

        //var_dump( __METHOD__ . "()" );

        /* ******************************************************************************** */
        {   /* Let's try to load all the methods of the parent classes FIRST */
            if ( is_file( vaesoli::FIL_RealPath( __DIR__ . '/' . $this->oSourceFile->oHeader->szFileName ) ) )
                require_once( $this->oSourceFile->oHeader->szFileName );
            else
            {
                var_dump( "Ooops ... CANNOT FIND " . $this->oSourceFile->oHeader->szFileName );
                goto end;
            }

            $class          = new \ReflectionClass( $o = new $szClass() );
            $aParentClasses = $this->getParentClasses( $class );

            //var_dump( "PARENT CLASSES: ",$aParentClasses );
            //$this->die();

            foreach( $aParentClasses as $aClass )
            {
                $szMethodsFile = $szHomeOfDocumentation  . basename( $aClass['file'] ) . '.' . md5( str_replace( array( '\\','/' ),'-',$aClass['name'] ) ) . '.methods.cache';

                if ( is_file( $szMethodsFile ) )
                {
                    //var_dump( "FOUND " . $szMethodsFile );
                    $this->aMethods = array_merge( $this->aMethods,$this->getHashFile( $szMethodsFile ) );
                }   /* if ( is_file( $szMethodsFile ) ) */
            }
        }   /* Let's try to load all the methods of the parent classes FIRST */
        /* ******************************************************************************** */

        /* ******************************************************************************** */
        /* Extract the methods now                                                          */
        /* ******************************************************************************** */
        if ( preg_match_all('%/\*\* \{\{\* *?(?P<fnc>.*?)\((?P<args>.*?)\)=(.*?)\*\}\}%si',$this->szSourceCode,$aMatches, PREG_PATTERN_ORDER ) )
        {
            $aMethodsOfThisClass = array();

            //var_dump( $aMatches[0] );
            //ob_flush();
            //flush();

            if ( true )
            {
                foreach( $aMatches[0] as $szFncDef )
                {
                    //var_dump( $this->szDeclaration,$szFncDef,"JUSQU'ICI, TOUT VA BIEN" );
                    //$this->die();

                    if ( true && preg_match( '/\{\{\*(public|protected|private)?.*?(static)?(?P<name>.*)\((?P<args>.*?)\)=/si',$szFncDef,$aParts ) )
                    {
                        $szName = trim( $aParts['name'] );
                        $szArgs = trim( $aParts['args'] );
                        //var_dump( $aParts );
                        //var_dump( $szName . '(' . $szArgs . ')' );
                        //ob_flush();
                        //flush();
                        //var_dump( $this->szDeclaration,$szFncDef,"JUSQU'ICI, TOUT VA BIEN" );
                        //$this->die();

                        //var_dump( $szName,$szArgs );
                        // STOP HERE; STOP HERE; STOP HERE; STOP HERE; STOP HERE; STOP HERE; STOP HERE;

                        // IL FAUT PARSER LA DEFINITION DE
                        // CHAQUE METHODE POUR EN TROUVER
                        // - LA VALEUR DE RETOUR
                        // - LES CDATE ET MDATE
                        // - ...

                        $oFnc = new DocumentorClassMethod( $szName,$szFncDef,$szArgs );
                        //var_dump( $this->szDeclaration,$szFncDef,"JUSQU'ICI, TOUT VA BIEN" );
                        //var_dump( $oFnc );
                        //$this->die();

                        if ( true )
                        {
                            if ( preg_match('%/\*\* \{\{\*.*\(.*?\)=(?P<desc>.*?)\{\*%si',$szFncDef,$aParts2 ) )
                            {
                                //var_dump( "DESCRIPTION FOUND" );
                                //var_dump( $aParts2 );
                                $oFnc->szDescription  = trim( vaesoli::STR_Reduce( $aParts2['desc'] ) );
                                //var_dump( $szName . '(' . $szArgs . '): DESCRIPTION = ' . $oFnc->szDescription );
                                //$this->die();
                            }   /* if ( preg_match('%/\*\* \{\{\*.*\(.*?\)=(?P<desc>.*?)\{\*%si',$szFncDef,$aParts2 ) ) */
                            else
                            {
                                //var_dump( "NO DESCRIPTION FOUND!!!" );
                            }

                            /* TAG EXTRACTION ================================================================================= */
                            /* TAG EXTRACTION ================================================================================= */
                            $oFnc->szCredits    =       trim( vaesoli::STR_Reduce( $this->property( '{*credits'   ,$szFncDef ) ) );
                            $oFnc->szDoc        =       trim( vaesoli::STR_Reduce( $this->property( '{*doc'       ,$szFncDef ) ) );
                            $oFnc->szTODOs      =       trim( vaesoli::STR_Reduce( $this->property( '{*todo'      ,$szFncDef ) ) );
                            $oFnc->szWarning    =       trim( vaesoli::STR_Reduce( $this->property( '{*warning'   ,$szFncDef ) ) );
                            $oFnc->szRemark     =       trim( vaesoli::STR_Reduce( $this->property( '{*remark'    ,$szFncDef ) ) );
                            $oFnc->author       =       trim( vaesoli::STR_Reduce( $this->property( '{*author'    ,$szFncDef ) ) );
                            $oFnc->szExamples   =                                  $this->property( '{*example'   ,$szFncDef );
                            $oFnc->keywords     =       trim( vaesoli::STR_Reduce( $this->property( '{*keywords'  ,$szFncDef ) ) );
                            $oFnc->abstract     =       trim( vaesoli::STR_Reduce( $this->property( '{*abstract'  ,$szFncDef ) ) );

                            $oFnc->getAsserts();

                            if ( ! empty( $szSeeAlsos = trim( vaesoli::STR_Reduce( $this->property( '{*seealso'   ,$szFncDef ) ) ) ) )
                                $oFnc->aSeeAlsos = explode( ',',str_replace( ';',',',$szSeeAlsos ) );     /* All seealso's (array) */

                            if ( true && ! empty( $szReturn = trim( vaesoli::STR_Reduce( $this->property( '{*return',$szFncDef ) ) ) ) )
                            {
                                $oReturn = new DocumentorFunctionReturn();
                                //var_dump( $this->szDeclaration,$szReturn,"JUSQU'ICI, TOUT VA BIEN" );
                                //ob_flush();
                                //flush();
                                //$this->die();
                                //if ( true )
                                {
                                    $oReturn->parseDefinition( $szReturn );
                                    $oFnc->oReturn = $oReturn;
                                }   /* if ( true ) */
                            }   /* if ( ! empty( $szReturn = trim( vaesoli::STR_Reduce( $this->property( '{*return',$szFncDef ) ) ) ) ) */

                            // - LES PARAMETRES
                            if ( true && ! empty( $szParams = trim( vaesoli::STR_Reduce( $this->property( '{*params',$szFncDef ) ) ) ) )
                            {
                                //var_dump( "PARAMS: " . $szParams );
                                $oFnc->parseArgs( $szParams );
                                //foreach( $oFnc->aParams as $oParam )
                                //{
                                //    var_dump( "------- A PARAMETER:" . $oParam->name . ' - ' . $oParam->types . ' - ' . $oParam->description );
                                //}
                            }   /* if ( ! empty( $szParams = trim( vaesoli::STR_Reduce( $this->property( '{*params',$szFncDef ) ) ) ) )


                            /* TAG EXTRACTION ================================================================================= */
                            /* TAG EXTRACTION ================================================================================= */
                        }   /* if ( true ) */

                        //var_dump( $this->szDeclaration,"JUSQU'ICI, TOUT VA BIEN" );
                        //$this->die();

                        $aMethodsOfThisClass[$szName] = $oFnc;
                    }   /* if ( preg_match( '/\{\{\*(public|protected)?.*?(static)?(?P<name>.*)\((?P<args>.*?)\)=/si',$szFncDef,$aParts ) ) */
                }   /* foreach( $aMatches[0] as $szFncDef ) */

                /* ******************************************************************************** */
                /* Cache the methods found in THIS CLASS FILE (CAN LEAD TO SOME CONFUSION
                   WHEN SEVERAL CLASSES ARE CONTAINED IN THE SAME FILE!!!) */
                /* ******************************************************************************** */
                if ( is_array( $aMethodsOfThisClass ) && count( $aMethodsOfThisClass ) > 0 )
                {
                    $this->saveHashFile( $szTargetFile,$aMethodsOfThisClass );
                    $this->aMethods = array_merge( $this->aMethods,$aMethodsOfThisClass );
                }   /* if ( is_array( $aMethodsOfThisClass ) && count( $aMethodsOfThisClass ) > 0 ) */
            }   /* if ( true ) */
        }   /* if ( preg_match_all('%/\*\* \{\{\* *?(?P<fnc>.*?)\((?P<args>.*?)\)=(.*?)\*\}\}%si' ..., PREG_PATTERN_ORDER ) ) */
        /* ******************************************************************************** */
        /* ******************************************************************************** */

        //var_dump( __METHOD__ . "()" );

        //var_dump( $this->aMethods );
        //$this->die();

        end:
        return ( $this );
    }   /* End of DocumentorClass.getDocumentedMethods() ============================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return.
        *}

        *}}
    */
    /* ================================================================================ */
    public function __destruct()
    /*------------------------*/
    {
        $this->backup();
        $this->autodoc();
        $this->UIKey();
        $this->WikiData();
        $this->necroSignaling();
    }   /* End of DocumentorClass.__destruct() ======================================== */
    /* ================================================================================ */
}   /* End of class DocumentorClass =================================================== */
/* ==================================================================================== */


/* ==================================================================================== */
/** {{*class DocumentorClassProperty=

    {*desc

        A property of a class

    *}

    *}}
 */
/* ==================================================================================== */
Class DocumentorClassProperty extends DocumentorSourceFileObject
/*------------------------------------------------------------*/
{
    public      $szTypes      = null;           /* {*property       $szTypes    (string)        Types this property can take *} */

    /* ================================================================================ */
    /** {{*__construct( $szName,$szDef )=

        Class constructor

        {*params
            $szName     (string)        Name of the class
            $szDef      (string)        Definition of the class (what's between the
                                        documentor marks class <name>= ...)
        *}

        {*return
            (self)      The current instance of the class
        *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( &$szName,&$szTypes,&$szDesc )
    /*------------------------------------------------------*/
    {
        $this->name         = $szName;
        $this->szTypes      = $szTypes;
        $this->description  = $szDesc;

        return ( $this );
    }   /* End of DocumentorClassProperty.__construct() =============================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return.
        *}

        *}}
    */
    /* ================================================================================ */
    public function __destruct()
    /*------------------------*/
    {
        $this->backup();
        $this->autodoc();
        $this->UIKey();
        $this->WikiData();
        $this->necroSignaling();
    }   /* End of DocumentorClassProperty.__destruct() ================================ */
    /* ================================================================================ */

}   /* End of class DocumentorClassProperty =========================================== */
/* ==================================================================================== */


/* ==================================================================================== */
/** {{*class DocumentorFunction=

    {*desc

        A function or a method

    *}

    *}}
 */
/* ==================================================================================== */
Class DocumentorFunction extends DocumentorSourceFileObject
/*-------------------------------------------------------*/
{
    public      $name           = null;                             /* {*property       $name                   (string)                        Name of the method *} */
    public      $szDefinition   = null;                             /* {*property       $szDefinition           (string)                        Definition of the method (everything that defines the method in the comments) *} */
    public      $szArgs         = null;                             /* {*property       $szArgs                 (string)                        A comma-delimited list of parameters. *} */
    public      $szDescription  = null;                             /* {*property       $szDescription          (string)                        Description of the method *} */
    public      $szCredits      = null;                             /* {*property       $szCredits              (string)                        Credits of the method (useful when some parts of the code are covered via
                                                                                                                                                CC licenses for example) */
    public      $szDoc          = null;                             /* {*property       $szDoc                  (string)                        Documentation (e.g. URL(s) where documentation can be obtained */
    public      $szDeclaration  = null;                             /* {*property       $szDeclaration          (string)                        Function declaration (e.g. "public static function MyFnc()" ) *} */
    public      $szTODOs        = null;                             /* {*property       $szTODOs                (string)                        A list of TODOs *} */
    public      $szWarning      = null;                             /* {*property       $szWarning              (string)                        A warning *} */
    public      $szRemark       = null;                             /* {*property       $szRemark               (string)                        A remark *} */
    public      $author         = null;                             /* {*property       $author                 (Organization|Person|string)    The author of the method *} */
    public      $aParams        = array();                          /* {*property       $aParams                (array)                         Array of parameters *} */
    public      $aAliases       = array();                          /* {*property       $aAliases               (array)                         Array of aliases *} */
    public      $aAsserts       = null;                             /* {*property       $aAsserts               (array)                         Array of assert statements or [c]null[/c] if none *} */
    public      $szExamples     = null;                             /* {*property       $szExamples             (string)                        Set of examples for this function/method *} */
    public      $aExecs         = array();                          /* {*property       $aExecs                 (array)                         Array of code that must be executed *} */
    public      $oReturn        = null;                             /* {*property       $oReturn                (DocumentorReturn)              Return object *} */
    public      $szVersion      = null;                             /* {*property       $szVersion              (string)                        Version of the class/method *} */
    public      $szCDate        = null;                             /* {*property       $szCDate                (string)                        Creation date of the function (if any) *} */
    public      $szMDate        = null;                             /* {*property       $szMDate                (string)                        Modification date of the function (if any) *} */
    public      $keywords       = null;                             /* {*property       $keywords               (string)                        A comma-delimited string where each token is a keyword *} */
    public      $aSeeAlsos      = null;                             /* {*property       $aSeeAlsos              (array)                         An array of seealso *} */
    public      $wikidataId     = 'Q190686';                        /* {*property       $wikidataId             (string)                        Wikidata ID. subroutine ... sequence of instructions that can be called
                                                                                                                                                from other points in a computer program *} */


    /* ================================================================================ */
    /** {{*__construct( $szName,$szDef,szArgs )=

        Class constructor

        {*params
            $szName     (string)        Name of the class
            $szDef      (string)        Definition of the method (what's between the
                                        documentor marks)
            $szArgs     (string)        A comma-delimited list of parameters.
        *}

        {*return
            (self)      The current instance of the class
        *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szName,$szDef,$szArgs )
    /*-------------------------------------------------*/
    {
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        $this->name         = $szName;
        $this->szDefinition = $szDef;
        $this->szArgs       = $szArgs;

        return ( $this );
    }   /* End of DocumentorFunction.__construct() ==================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*getAsserts()=

        Get all asserts defined in the header of a function/method

        {*params
        *}

        {*return
            (self)      The current instance of the class. @var.aAsserts updated
        *}

        *}}
    */
    /* ================================================================================ */
    public function getAsserts()
    /*------------------------*/
    {
        if ( preg_match_all( '/\{\*assert(?P<assert>.*?)\*\}/sim',$this->szDefinition,$aMatches,PREG_PATTERN_ORDER ) )
        {
            foreach( $aMatches['assert'] as $szAssert )
            {
                $szAssert = trim( $szAssert );
                // Pfff ... don't like this AT ALL ... but the assert() function has changed as
                // of PHP 7.2 ... and strings are no longer supported !!!
                $x = @eval( 'return ( ' . trim( $szAssert ) . ');' );
                $this->aAsserts[$szAssert] = is_bool( $x ) ? $x : false;
            }
        }

        return ( $this );
        
    }   /* End of DocumentorFunction.getAsserts() ==================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*parseArgs( [$szArgs] )=

        Parses a set of parameters

        {*params
            $szArgs     (string)        A string of paramaters as defined in
                                        [c]trql.documentor.class.php[/c]. Optional.
                                        If not passed, $this->szArgs is used instead.

                                        <paramName> (<paramtypes>)  <paramDesc>
                                        <paramName> (<paramtypes>)  <paramDesc>
                                        <paramName> (<paramtypes>)  <paramDesc>
        *}

        {*return
            (self)      The current instance of the class
        *}

        *}}
    */
    /* ================================================================================ */
    public function parseArgs( &$szArgs = null )
    /*----------------------------------------*/
    {
        if ( ! is_string( $szArgs ) )
            $szArgs = $this->szArgs;

        $szArgs = trim( vaesoli::STR_Reduce( str_replace( array("\r","\n"),' ',$szArgs ),' ' ) );

        $i = 0; /* Make it possible to stop looping */
        while ( ! empty( $szArgs ) && $szArgs !== '$' && $i < 30 )
        {
            if ( preg_match( '/(?P<name>\$[[:word:]]*) *?\((?P<types>.*?)\)(?P<desc> *.*?)(\$|\z)/si',$szArgs,$aParts ) )
            {
                $oParam                 = new DocumentorFunctionParameter();

                $oParam->name           = trim( $aParts['name'] );
                $oParam->description    = trim( $aParts['desc'] );
                $oParam->types          = trim( $aParts['types'] );

                //var_dump( '--------------PARAMETER: ' . $oParam->name . ' - ' . $oParam->description . ' - ' . $oParam->types );

                $this->aParams[]        = $oParam;

                //var_dump( $aParts['name'],$aParts['types'],$aParts['desc'],$aParts[0] );
                $szArgs = str_replace( $aParts[0],'$',$szArgs );
                //var_dump( $szArgs );
                $i++;
            }
        }

        //var_dump( "FOUND " . count( $this->aParams ) . ' parameters' );

        end:
        return ( $this );
    }   /* End of DocumentorFunction.parseArgs() ====================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return.
        *}

        *}}
    */
    /* ================================================================================ */
    public function __destruct()
    /*------------------------*/
    {
        $this->backup();
        $this->autodoc();
        $this->UIKey();
        $this->WikiData();
        $this->necroSignaling();
    }   /* End of DocumentorFunction.__destruct() ===================================== */
    /* ================================================================================ */
}   /* End of class DocumentorFunction ================================================ */
/* ==================================================================================== */


Class DocumentorClassMethod extends \trql\documentor\DocumentorFunction
/*-------------------------------------------------------------------*/
{
    /* ================================================================================ */
    /** {{*__construct( $szName,$szDef )=

        Class constructor

        {*params
            $szName     (string)        Name of the class
            $szDef      (string)        Definition of the method (what's between the
                                        documentor marks)
            $szArgs     (string)        A comma-delimited list of parameters.
        *}

        {*return
            (self)      The current instance of the class
        *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szName,$szDef,$szArgs )
    /*-------------------------------------------------*/
    {
        parent::__construct( $szName,$szDef,$szArgs );

        return ( $this );
    }   /* End of DocumentorClassMethod.__construct() ================================= */
    /* ================================================================================ */
}   /* End of class DocumentorClassMethod ============================================= */
/* ==================================================================================== */


/* ==================================================================================== */
/** {{*class DocumentorFileHeader=

    {*desc

        File header block

    *}

    *}}
 */
/* ==================================================================================== */
Class DocumentorFileHeader extends DocumentorSourceFileObject
/*---------------------------------------------------------*/
{
    public      $content        = null;     /* Devrait être protected */
    protected   $oSourceFile    = null;                             /* {*property $oSourceFile      (DocumentorSourceFile)                              The source file the header belongs to *} */
    public      $szFileName     = null;                             /* {*property $szFileName       (string)                                            Source filename *} */
    public      $szPurpose      = null;                             /* {*property $szPurpose        (string)                                            Purpose of the code included in the source file *} */
    public      $author         = null;                             /* {*property $author           (Organization|Person)                               Author(s) of the code included in the source file.
                                                                                                                                                        Supersedes [c]$szAuthor[/c] *} */
    public      $szCompany      = null;                             /* {*property $szCompany        (string|Corporation|Organization|LocalBusiness)     Company name *} */
    public      $szCDate        = null;                             /* {*property $szCDate          (string)                                            File creation datetime of [c]$oSourceFile[/c]*} */
    public      $szMDate        = null;                             /* {*property $szMDate          (string)                                            Last modification datetime of [c]$oSourceFile[/c]*} */
    public      $szLicense      = null;                             /* {*property $szLicense        (string)                                            License assigned to the source code included in the source file *} */
    public      $aHistory       = null;                             /* {*property $aHistory         (array)                                             A set of history blocks - changes made to the source file *} */
    public      $szTODOs        = null;                             /* {*property $szTODOs          (string)                                            A list of TODOs *} */

    public      $image          = null;                             /* {*property $image            (ImageObject|string)                                An image of the item. This can be a URL or a fully described
                                                                                                                                                        ImageObject. *} */
    public      $thumbnailUrl   = null;                             /* {*property $thumbnailUrl     (string)                                            A thumbnail image relevant to the oSourceFile property *} */
    public      $abstract       = null;                             /* {*property $abstract         (string)                                            A general explanation/disambiguation about what the class aims
                                                                                                                                                        to solve. Supersedes $szAbstract because we have prefered to use
                                                                                                                                                        a common vocabulary. *} */

    /*  SHOULD USE
copyrightHolder	Organization  or
Person 	The party holding the legal copyright to the CreativeWork.

acquireLicensePage	CreativeWork  or
URL 	Indicates a page documenting how licenses can be purchased or otherwise acquired, for the current item.

    */

    /* ================================================================================ */
    /** {{*__construct( $oSourceFile )=

        Class constructor

        {*params
            $szName     (DocumentorSourceFile)      The source file from which we want
                                                    to extract the header part
        *}

        {*return
            (self)      The current instance of the class
        *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $oSourceFile )
    /*---------------------------------------*/
    {
        if ( $oSourceFile instanceof DocumentorSourceFile )
        {
            $this->oSourceFile = $oSourceFile;

            if ( preg_match('/\{\{\{\*fheader(?P<header>.*)\*\}\}\}/si',$this->oSourceFile->content,$aMatches ) )
            {
                $this->content = $aMatches['header'];
                $this->parse();
            }
            else
            {
                var_dump( "NO header found for " . $this->oSourceFile->szFileName );
            }
        }
        else
            die( "NOT A SOURCE FILE" );

        return ( $this );
    }   /* End of DocumentorFileHeader.__construct() ================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*render( [$szType] )=

        Renders the header in a format that matches $szType

        {*params
            $szType         (string)        The type of rendering needed. Optional. 'HTML'
                                            by default;
        *}

        {*return
            (boolean)       [c]true[/c] if the documentation file could be created;
                            [c]false[/c] otherwise.
        *}

        *}}
    */
    /* ================================================================================ */
    public function render( $szType = 'HTML') : string
    /*----------------------------------------------*/
    {
        $szRetVal = '';

        if ( is_string( $szType ) )
            $szType = strtoupper( trim( $szType ) );
        else
            $szType = 'HTML';

        //$this->die();

        if ( $szType === 'HTML' )
        {
            $szRetVal .= "<section class=\"header\">\n";
                if ( ! empty( $this->image ) )
                    $szRetVal .= "<p><img src=\"{$this->image}\" style=\"display:block;float:left;width:130px; height:auto;margin-right: 20px;\" class=\"shadow constrained\"/></p>\n";

                $szRetVal .= "<span class=\"DocumentorLabel\">Filename: </span><span class=\"property filename\">"              . $this->squareToAngle( say(                      $this->szFileName )   ) . "</span>\n";
                $szRetVal .= "<span class=\"DocumentorLabel\">Namespace: </span><span class=\"property namespace\">"            . $this->squareToAngle( say( '[c]' . $this->oSourceFile->szNamespace . '[/c]' )  ) . "</span>\n";

                $szUses = '';

                if ( is_array( $this->oSourceFile->aUses ) )
                {
                    foreach( $this->oSourceFile->aUses as $aUse )
                        $szUses .= $aUse['class'] . ( ! empty( $aUse['alias'] ) ? ( ' as ' . $aUse['alias'] ) : '' ) . ',';
                    $szUses = Vaesoli::STR_strin( trim( $szUses ) );

                    $szRetVal .= "<span class=\"DocumentorLabel\">Class aliases: </span><span class=\"property aliases\">"      . $this->squareToAngle( say( '[c]' . $szUses . '[/c]' )  ) . "</span>\n";
                }

                $szRetVal .= "<span class=\"DocumentorLabel\">Purpose: </span><span class=\"property purpose\">"                . $this->squareToAngle( say( vaesoli::STR_Reduce( $this->szPurpose  ) ) ) . "</span>\n";
                $szRetVal .= "<span class=\"DocumentorLabel\">Author: </span><span class=\"property author\">"                  . $this->squareToAngle( say(                      $this->author     )   ) . "</span>\n";
                $szRetVal .= "<span class=\"DocumentorLabel\">Company: </span><span class=\"property company\">"                . $this->squareToAngle( say(                      $this->szCompany  )   ) . "</span>\n";
                $szRetVal .= "<span class=\"DocumentorLabel\">Creation date: </span><span class=\"property cdate\">"            . $this->squareToAngle( say(                      $this->szCDate    )   ) . "</span>\n";
                $szRetVal .= "<span class=\"DocumentorLabel\">Last modification date: </span><span class=\"property mdate\">"   . $this->squareToAngle( say(                      $this->szMDate    )   ) . "</span>\n";
                $szRetVal .= "<span class=\"DocumentorLabel\">License/Copyrights: </span><span class=\"property license\">"     . $this->squareToAngle( say(                      $this->szLicense  )   ) . "</span>\n";

                if ( ! empty( $this->abstract ) )
                    $szRetVal .= "<span class=\"DocumentorLabel\">Abstract: </span><span class=\"property abstract\">"          . $this->squareToAngle( say(                      $this->abstract   )   ) . "</span>\n";

                if ( ! empty( $this->szTODOs ) )
                    $szRetVal .= "<span class=\"DocumentorLabel\">TODOs: </span><span class=\"property todo\">"                 . $this->squareToAngle( say(                      $this->szTODOs    )   ) . "</span>\n";

            $szRetVal .= "</section> <!-- .header -->\n";
            /* $oHistory = new DocumentorHistory( $szHistory ); */
        }   /* if ( $szType === 'HTML' ) */

        return ( $szRetVal );
    }   /* End of DocumentorFileHeader.render() ======================================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*parse()=

        Parse the file header

        {*params
        *}

        {*return
            (boolean)       [c]true[/c] if the documentation file could be created;
                            [c]false[/c] otherwise.
        *}

        *}}
    */
    /* ================================================================================ */
    public function parse()
    /*-------------------*/
    {
        if ( ! empty( $this->content ) )
        {
            /* Method property should be in a trait */
            /* Et pour chaque propriété, il faut transformer les [...] en <...> : squarebrackets to angleBrackets ... ce qui doit aussi se trouver dans un trait */
            $this->szFileName   = trim( $this->property( '{*file'       ,$this->content ) );
            $this->szPurpose    = trim( $this->property( '{*purpose'    ,$this->content ) );
            $this->author       = trim( $this->property( '{*author'     ,$this->content ) );
            $this->szCompany    = trim( $this->property( '{*company'    ,$this->content ) );
            $this->szCDate      = trim( $this->property( '{*cdate'      ,$this->content ) );
            $this->szMDate      = trim( $this->property( '{*mdate'      ,$this->content ) );
            $this->szLicense    = trim( $this->property( '{*license'    ,$this->content ) );
            $this->abstract     = trim( $this->property( '{*abstract'   ,$this->content ) );
            $this->szTODOs      = trim( $this->property( '{*todo'       ,$this->content ) );
            $this->image        = trim( $this->property( '{*image'      ,$this->content ) );

            //var_dump( $this-szTODOs );
            //die();

            if ( $this->szCDate === 'auto' )
                $this->szCDate = vaesoli::FIL_CDate( $this->oSourceFile->szFileName );

            if ( $this->szMDate === 'auto' )
                $this->szMDate = vaesoli::FIL_MDate( $this->oSourceFile->szFileName );

            /* Cherchons tous les blocs {*chist ... *} que j'ai dans le header */
            if ( preg_match_all( '/\{\*chist.*(\*\})/si',$this->content,$aMatches,PREG_PATTERN_ORDER ) )
            {
                $szAllHistory = $aMatches[0][0];

                while ( true )
                {
                    if ( ! empty( $szHistory = vaesoli::STR_Balance( $szAllHistory,"{*","*}" ) ) )
                    {
                        // Et donc ici j'ai un {*chist ... *} complet que je dois encore parser pour les valeurs incluses
                        // Faudrait créer un objet de type ChangeHistory et puis parser ses propriétés
                        $oHistory = new DocumentorHistory( $szHistory );
                        $oHistory->parse();
                        $szAllHistory = str_replace( $szHistory,'',$szAllHistory );
                    }
                    else
                    {
                        break;
                    }
                }
            }


            /* Still information to get : we can have many such constructs :

                {*chist
                    {*mdate 16-08-20 19:19 *}
                    {*author {PYB} *}
                    {*v 8.0.0000 *}
                    {*desc              1)  Original creation
                    *}
                *}
            */

        }   /* if ( ! empty( $this->content ) ) */

        return ( $this );
    }   /* End of DocumentorFileHeader.parse() ======================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return.
        *}

        *}}
    */
    /* ================================================================================ */
    public function __destruct()
    /*------------------------*/
    {
        $this->backup();
        $this->autodoc();
        $this->UIKey();
        $this->WikiData();
        $this->necroSignaling();
    }   /* End of DocumentorFileHeader.__destruct() =================================== */
    /* ================================================================================ */
}   /* End of class DocumentorFileHeader ============================================== */
/* ==================================================================================== */


/* ==================================================================================== */
/** {{*class DocumentorHistory=

    {*desc

        Change History block (can be pertaining to header, class, trait, interface,
        function or method)

    *}

    *}}
 */
/* ==================================================================================== */
Class DocumentorHistory extends DocumentorSourceFileObject
/*------------------------------------------------------*/
{
    protected   $content    = null;
    public      $szCDate    = null;
    public      $szMDate    = null;
    public      $szAuthor   = null;
    public      $szVersion  = null;
    public      $szDesc     = null;

    /* ================================================================================ */
    /** {{*__construct( $szContent )=

        Class constructor

        {*params
            $szContent      (string)        The history block string
        *}

        {*return
            (self)      The current instance of the class
        *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szContent )
    /*-------------------------------------*/
    {
        $this->content = $szContent;
    }   /* End of DocumentorHistory.__construct() ===================================== */
    /* ================================================================================ */


    public function parse()
    /*-------------------*/
    {

    }   /* End of DocumentorHistory.parse() =========================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return.
        *}

        *}}
    */
    /* ================================================================================ */
    public function __destruct()
    /*------------------------*/
    {
        $this->backup();
        $this->autodoc();
        $this->UIKey();
        $this->WikiData();
        $this->necroSignaling();
    }   /* End of DocumentorHistory.__destruct() ====================================== */
    /* ================================================================================ */
}   /* End of class DocumentorHistory ================================================= */
/* ==================================================================================== */


/* ==================================================================================== */
/** {{*class DocumentorFunctionParameter=

    {*desc

        A paramater of a function or method (both work the same way)

    *}

    *}}
 */
/* ==================================================================================== */
Class DocumentorFunctionParameter extends DocumentorSourceFileObject
/*----------------------------------------------------------------*/
{
    public  $types          = null;                                 /* {*property   $types      (string)   Comma-delimited list of possible types *} */
    public  $oContext       = null;                                 /* {*property   $oContext   (object)   Context of the function/method. If $oContext instanceof a class, then we're having a method *} */

    /* ================================================================================ */
    /** {{*__construct( [$szHome] )=

        Class constructor

        {*params
            $szHome     (string)        Home of the class. Optional.
        *}

        {*return
            (self)      The current instance of the class
        *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szHome = null )
    /*-----------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        return ( $this );
    }   /* End of DocumentorFunctionParameter.__construct() =========================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return.
        *}

        *}}
    */
    /* ================================================================================ */
    public function __destruct()
    /*------------------------*/
    {
        $this->backup();
        $this->autodoc();
        $this->UIKey();
        $this->WikiData();
        $this->necroSignaling();
    }   /* End of DocumentorFunctionParameter.__destruct() ============================ */
    /* ================================================================================ */
}   /* End of class DocumentorFunctionParameter ======================================= */
/* ==================================================================================== */


/* ==================================================================================== */
/** {{*class DocumentorFunctionReturn=

    {*desc

        Defines a return data structure: return value of a function and or
        method

    *}

    *}}
 */
/* ==================================================================================== */
Class DocumentorFunctionReturn extends DocumentorSourceFileObject
/*-------------------------------------------------------------*/
{
    public  $szType         = null;

    /* ================================================================================ */
    /** {{*__construct( [$szHome] )=

        Class constructor

        {*params
            $szHome     (string)        Home of the class. Optional.
        *}

        {*return
            (self)      The current instance of the class
        *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $szHome = null )
    /*-----------------------------------------*/
    {
        parent::__construct();
        $this->updateSelf( __CLASS__,'/q/common/trql.classes.home/' . basename( __FILE__,'.php' ) );

        return ( $this );
    }   /* End of DocumentorFunctionReturn.__construct() ============================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*parseDefinition( $szDefinition )=

        Parses the definition of a return

        {*params
            $szDefinition       (string)        The string that defines the return
        *}

        {*return
            (self)      Object updated upon return. Returns the current instance of the
                        class.
        *}

        {*example
            new
        *}

        *}}
    */
    /* ================================================================================ */
    public function parseDefinition( $szDefinition )
    /*--------------------------------------------*/
    {
        //var_dump( "Parsing definition",$szDefinition,"JUSQU'ICI, TOUT VA BIEN" );
        //ob_flush();
        //flush();
        //$this->die();

        //var_dump( "DEFINITION OF RETURN OF {$this->name}: " . $szDefinition );

        if ( is_string( $szDefinition ) && preg_match( '/\((?P<type>.*?)\)(?P<desc>.*)/si',$szDefinition,$aMatches ) )
        {
            $this->szType       = $aMatches['type'];
            $this->description  = $aMatches['desc'];

            //var_dump( "RETURN : DESCRIPTION= " . $this->description . ";RETURN TYPE: " . $this->szType );
        }

        return ( $this );
    }   /* End of DocumentorFunctionReturn.parseDefinition() ========================= */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return.
        *}

        *}}
    */
    /* ================================================================================ */
    public function __destruct()
    /*------------------------*/
    {
        $this->backup();
        $this->autodoc();
        $this->UIKey();
        $this->WikiData();
        $this->necroSignaling();
    }   /* End of DocumentorFunctionReturn.__destruct() =============================== */
    /* ================================================================================ */
}   /* End of class DocumentorFunctionReturn ========================================== */
/* ==================================================================================== */
