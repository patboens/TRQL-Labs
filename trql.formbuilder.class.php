<?php
/****************************************************************************************/
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
    {*file                  trql.formbuilder.class.php *}
    {*purpose               A tool that can be used to create forms. *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 31-12-20 14:12 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    -------------------------------------------------------------------------------------
    Changes History:
    -------------------------------------------------------------------------------------

    {*chist
        {*mdate 31-12-20 14:12 *}
        {*author {PYB} *}
        {*v 8.0.0000 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/****************************************************************************************/
namespace trql\formbuilder;

use \trql\vaesoli\Vaesoli                   as Vaesoli;
use \trql\builder\Builder                   as Builder;


if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'BUILDER_CLASS_VERSION' ) )
    require_once( 'trql.builder.class.php' );

defined( 'FORMBUILDER_CLASS_VERSION' ) or define( 'FORMBUILDER_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class FormBuilder=

    {*desc

        A person or thing that creates or develops a particular thing

    *}

 */
/* ==================================================================================== */
class FormBuilder extends Builder
/*-----------------------------*/
{
    protected   $self = array( 'file'   => __FILE__     ,           /* {*property   $self               (array)         Fixed 'class' information. *} */
                               'class'  => __CLASS__    ,
                               'name'   => null         ,
                               'birth'  => null         ,
                               'home'   => null         ,
                               'family' => null         ,
                               'UIKey'  => null         ,
                             );

    protected   $aControls                      = array( 'anchor'       ,
                                                         'checkbox'     ,
                                                         'date'         ,
                                                         'editbox'      ,
                                                         'file'         ,
                                                         'image'        ,
                                                         'mail'         ,
                                                         'number'       ,
                                                         'ordered'      ,
                                                         'password'     ,
                                                         'textbox'      ,
                                                         'unordered'    ,
                                                         'video'        ,
                                                       );

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId                     = null;             /* {*property   $wikidataId         (string)        Wikidata ID. No equivalent. *} */
    public      $szHost                         = null;             /* {*property   $szHost             (string)        Host address for saving and retrieving forms *} */


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
    }   /* End of FormBuilder.__construct() =========================================== */
    /* ================================================================================ */

//31/12/2020 17:25:16.592 ... ==========Error # 10007 - message : Invalid length on table1 for track 'JINGLE-XMAS-Enjoy Our Special Christmas Mix-TRQL Radio, During the Holiday Season (F)' of 'TRQL Radio' (iTurntableDuration vs. iTrackDuration: 13377 vs. 15602)

    public function __toString(): string
    /*--------------------------------*/
    {
        $szRetVal   = '';
        $szIconsDir = '/snippet-center/q/common/resources/icons';
        $szIconsDir = '/';

        //var_dump( $_SERVER );


        $szRetVal   .= "<style>";
        $szRetVal .= <<< STYLE

.shadow { box-shadow: 0 20px 15px -15px rgba(0,0,0,.5); }

div.{$this->self['name']} { padding: 1em 1em 3em 1em; background: #eee; }

section.{$this->self['name']}_target { background: rgba( 0,255,0,0.3 );
    //position: absolute;
    border: 3px solid #080;
    left: 10px; top: 2em;
    padding: 1em;
    width: 50em; min-height: 40em; }


section.{$this->self['name']}_contextmenu { position: absolute;
    top: 33em;
    right: 3em;
    width: 8em;
    border: 1px solid silver; }


section.{$this->self['name']}_controls,
section.{$this->self['name']}_properties { position: absolute;
    border:1px solid silver;
    width: 20em;
    min-height: 8em;
    box-shadow: 0 20px 15px -15px rgba(0,0,0,.5); }

section.{$this->self['name']}_controls      { top: 2em; right: 24em; }
section.{$this->self['name']}_properties    { top: 2em;
    right: 3em;
    max-height: 30em;
    overflow-y: auto;
    }

section.{$this->self['name']}_properties table { width: 100%; border-collapse: collapse; }
section.{$this->self['name']}_properties td,
section.{$this->self['name']}_properties th { border: 1px solid silver; width:50%; }

table.properties input.property { border: none; display:inline-block; width: 100%; }




section.popup { cursor: move; }
section.popup p.title { font-weight: bold; background: silver; margin: 0; text-align:center; }


span.control { display: block; width: 8em; height: 2em; line-height: 2em; text-align: right;
    background-color: rgb(255,255,255);
    background-repeat: no-repeat;
    background-size: 24px;
    background-position: 5px center;
    padding-right:0.5em; border : 1px solid silver; margin-top: 1em; }

span.control.target.selected,
span.control.target:hover { box-shadow: 0 0 10px #f80; }

span.control.anchor     { background-image: url( "/snippet-center/icons/eb-a2.png"          ); }
span.control.checkbox   { background-image: url( "/checkbox.svg"                            ); }
span.control.date       { background-image: url( "/calendar.svg"                            ); }
span.control.editbox    { background-image: url( "/snippet-center/icons/eb-text.png"        ); }
span.control.file       { background-image: url( "/snippet-center/icons/dat-file.svg"       ); }
span.control.image      { background-image: url( "/snippet-center/icons/eb-img.png"         ); }
span.control.mail       { background-image: url( "/envelope.svg"                            ); }
span.control.number     { background-image: url( "/snippet-center/icons/number.svg"         ); }
span.control.ordered    { background-image: url( "/snippet-center/icons/eb-ol.png"          ); }
span.control.password   { background-image: url( "/snippet-center/icons/key.svg"            ); }
span.control.textbox    { background-image: url( "/snippet-center/icons/eb-capitalize.png"  ); }
span.control.unordered  { background-image: url( "/snippet-center/icons/eb-ul.png"          ); }
span.control.video      { background-image: url( "/snippet-center/icons/eb-video.png"       ); }

.newspaper {  -webkit-column-count: 2; /* Chrome, Safari, Opera */
  -moz-column-count: 2; /* Firefox */
  column-count: 2;
  -webkit-column-gap: 20px; /* Chrome, Safari, Opera */
  -moz-column-gap: 20px; /* Firefox */
  column-gap: 20px;
  -webkit-column-rule: 1px solid #a00; /* Chrome, Safari, Opera */
  -moz-column-rule: 1px solid #a00; /* Firefox */
  column-rule: 1px solid #a00;
}


STYLE;
        $szRetVal   .= "</style>\n";

        $szRetVal   .= "<script>\n";
        $szRetVal .= <<< SCRIPT
var aCoords = [0,0,0,0];

var Q = {}      /* Q namespace */

Q.DD =          /* Q Drag & Drop */
{
    o: null,    /* Object */
    t: null,    /* Target ? */
    w: null     /* Whazap ? */
}

Q.M =           /* Q Mouse */
{
    pos:    function ( e )
            /*----------*/
            {
                //console.log( 'in pos()' );

                var posx    = 0;
                var posy    = 0;

                if (!e) var e = window.event;

                if ( e )
                {
                    //var e = window.event;

                    if ( e.pageX || e.pageY )
                    {
                        posx = e.pageX;
                        posy = e.pageY;
                    }
                    else if ( e.clientX || e.clientY )
                    {
                        posx = e.clientX + document.body.scrollLeft
                                         + document.documentElement.scrollLeft;
                        posy = e.clientY + document.body.scrollTop
                                         + document.documentElement.scrollTop;
                    }

                    return new Array( posx,posy );
                }
                else
                {
                    return ( null );
                }
            } /* End of Q.M.pos() */
}

function formBuilder( szHost = "/ajax.php" )
/*----------------------------------------*/
{
    this.version                            =   '0.0.0999';
    this.szHost                             =   szHost;

    this.oXHR                               =   null;   /* XML Request */
    this.requestAction                      =   function( szModule,szDomain,szAction,szLang,szID1,szID2,szID3 )
                                                {
                                                    var szURL;
                                                    var bAsync = true;

                                                    if ( undefined === szModule )
                                                        szModule = 'formBuilder';
                                                    if ( undefined === szDomain )
                                                        szDomain = 'domain';
                                                    if ( undefined === szLang   )
                                                        szLang = 'en';
                                                    if ( undefined === szID1    )
                                                        szID1 = '';
                                                    if ( undefined === szID2    )
                                                        szID2 = '';
                                                    if ( undefined === szID3    )
                                                        szID3 = '';

                                                    if ( this.szHost && this.szHost.length > 0 )
                                                    {
                                                        szURL = this.szHost + "?domain="    + szDomain   +
                                                                         "&module="    + szModule   +
                                                                         "&action="    + szAction   +
                                                                         "&lang="      + szLang     +
                                                                         "&csrf="      + ''         +   /* No CSRF for the time being */
                                                                         "&id1="       + szID1      +
                                                                         "&id2="       + szID2      +
                                                                         "&id3="       + szID3;

                                                        //console.log( "requestAction with URL: " + szURL );

                                                        fnFnc = null;

                                                        this.oXHR = new XMLHttpRequest();

                                                        this.oXHR.open( 'GET',szURL,bAsync );


                                                        // Cela ... c'est du code "EXEMPLE" avec un POST en Ajax
                                                        // Doc: https://developer.mozilla.org/fr/docs/Web/API/XMLHttpRequest
                                                        // this.oXHR.open( 'post','URL',false );
                                                        // 
                                                        // // Here, usually the parameters of the email form should be built
                                                        // // as a string (this is still work to be done Tom, I only show the
                                                        // // principle
                                                        // szParams = "toAddress="     + escape( oForm.txtEmailTo.value                    )   + "&" +
                                                        //            "fromName="      + escape( oForm.txtFromName.value                   )   + "&" +
                                                        //            "fromAddress="   + escape( oForm.txtFromAddress.value                )   + "&" +
                                                        //            "copy="          + escape( oForm.chkCopy.checked ? 'true' : 'false'  )   + "&" +
                                                        //            "body="          + escape( oForm.txtBody.value                       )   + "&" +
                                                        //            "URL="           + escape( oForm.txtURL.value                        )   + "&" +
                                                        //            "ajax="          + escape( oForm.ajax.value                          );
                                                        // 
                                                        // this.oXHR.setRequestHeader( "Content-Type"  ,"application/x-www-form-urlencoded" );
                                                        // this.oXHR.setRequestHeader( "Content-length",szParams.length );
                                                        // this.oXHR.setRequestHeader( "Connection"    ,"close" );
                                                        // this.oXHR.setRequestHeader( "User-Agent"    ,"VAESOLI_AJAX" );
                                                        // this.oXHR.send( szParams );




                                                        //console.log( "TRQLStreamingPlayer.requestAction(" + szURL + ")" );
                                                        this.oXHR.setRequestHeader( "Cache-Control","no-cache" );

                                                        console.log( this.oXHR );

                                                        /* ************************************************ */
                                                        /* ************************************************ */
                                                        /* Start of onreadystatechange() */
                                                        this.oXHR.onreadystatechange =
                                                            (   function( oRequest,szAction,fnFnc,player )
                                                                {
                                                                    return function()
                                                                    {
                                                                        if ( oRequest.readyState === 4 && oRequest.status === 200 )
                                                                        {
                                                                            console.log( 'readyState === 4 && oRequest.status === 200' );

                                                                            var MustGoAhead = true;

                                                                            if ( typeof fnFnc === 'function' )
                                                                            {
                                                                                MustGoAhead = ! fnFnc( oRequest,szAction );
                                                                            }   /* if ( typeof fnFnc === 'function' ) */

                                                                            if ( MustGoAhead )
                                                                            {
                                                                                var oDoc = oRequest.responseXML;

                                                                                if ( oDoc && XMLDocument && oDoc instanceof XMLDocument )
                                                                                {
                                                                                    console.log( "Got a document" );
                                                                                    try
                                                                                    {
                                                                                        var szReturnCode    = oDoc.getElementsByTagName( 'ReturnCode' )[0].firstChild.nodeValue;
                                                                                        var szMsg           = oDoc.getElementsByTagName( 'Message'    )[0].firstChild.nodeValue;
                                                                                        var oResponse       = oDoc.getElementsByTagName( 'Response' );

                                                                                        if ( szReturnCode === '200' )
                                                                                        {
                                                                                            console.log( "Return code = " + szReturnCode );

                                                                                            if ( oResponse && undefined !== oResponse && oResponse[0] && oResponse[0].firstChild )
                                                                                            {
                                                                                                console.log( "Got a payload" );

                                                                                                var szPayload   = oResponse[0].firstChild.nodeValue;
                                                                                                var szCargo     = oDoc.getElementsByTagName( "Cargo"        )[0].firstChild.nodeValue;
                                                                                                var szCargo2    = oDoc.getElementsByTagName( "Cargo2"       )[0].firstChild.nodeValue;
                                                                                                var szCargo3    = oDoc.getElementsByTagName( "Cargo3"       )[0].firstChild.nodeValue;
                                                                                                var szDomain    = oRequest.getResponseHeader( "X-domain"    );
                                                                                                var szModule    = oRequest.getResponseHeader( "X-module"    );
                                                                                                var szLang      = oRequest.getResponseHeader( "X-lang"      );
                                                                                                var szAction    = oRequest.getResponseHeader( "X-action"    );

                                                                                                var szID1       = oRequest.getResponseHeader( "X-id1"       );
                                                                                                var szID2       = oRequest.getResponseHeader( "X-id2"       );
                                                                                                var szID3       = oRequest.getResponseHeader( "X-id3"       );

                                                                                                switch ( szAction )
                                                                                                {
                                                                                                    case 'save':
                                                                                                        {
                                                                                                            alert( szPayload );
                                                                                                            console.log( szPayload );
                                                                                                        }
                                                                                                        break;
                                                                                                    case 'ACTION 1':
                                                                                                        {
                                                                                                        }
                                                                                                        break;
                                                                                                    case 'ACTION 2':
                                                                                                        {
                                                                                                        }
                                                                                                        break;
                                                                                                    default:
                                                                                                        {
                                                                                                            console.log( szAction + " not handled in this.oXHR.onreadystatechange()" );
                                                                                                        }
                                                                                                }   /* switch ( szAction ) */
                                                                                            }   /* if ( undefined !== oDoc.getElementsByTagName( 'Response' ) ) */
                                                                                            else
                                                                                            {
                                                                                                console.log( "No valid response found (line 1046) for action '" + szAction + "': " + szReturnCode );
                                                                                            }
                                                                                        }   /* if ( szReturnCode === '200' ) */
                                                                                        else    /* Else of ... if ( szReturnCode === '200' ) */
                                                                                        {
                                                                                            console.log( "Invalid return code: "    + szReturnCode  );
                                                                                            console.log( "Message: "                + szMsg         );
                                                                                            console.log( "Response: "               + oResponse     );
                                                                                        }    /* End of ... Else of ... if ( szReturnCode === '200' ) */
                                                                                    }   /* End of try construct */
                                                                                    catch( err )
                                                                                    {
                                                                                        // console.log( err );
                                                                                        // alert( "Error reading response properties!" );
                                                                                    }   /* End of catch */
                                                                                }   /* if ( oDoc && XMLDocument && oDoc instanceof XMLDocument ) */
                                                                            }   /* if ( MustGoAhead ) */
                                                                        }   /* if ( oRequest.readyState === 4 && oRequest.status === 200 ) */
                                                                    };  /* End of ... return function() */
                                                                }   /* End of function( oRequest,szAction,fnFnc,player ) */
                                                            )( this.oXHR,szAction,fnFnc,this );
                                                        /* End of onreadystatechange() */
                                                        /* ************************************************ */
                                                        /* ************************************************ */

                                                        if ( true )
                                                        {
                                                            try
                                                            {
                                                                this.oXHR.send( null );
                                                            }
                                                            catch( err )
                                                            {
                                                                console.log( "Error while sending Ajax request!" );
                                                            }
                                                        }
                                                    }   /* if ( this.szHost && this.length > 0 ) */
                                                    else
                                                    {
                                                        console.log( "Invalid URL: " + this.szHost );
                                                    }
                                                };
}


// URL to use to save or retrieve forms
oFormBuilder = new formBuilder( '{$this->szHost}' );
//console.log( "HOST: " + oFormBuilder.szHost );


function allowDrop( ev )
/*--------------------*/
{
    ev.preventDefault();
    //ev.cancelBubble = true;
    //ev.stopPropagation();
}

function dropHandler( ev )
/*----------------------*/
{
    ev.stopPropagation();
    console.log( szControlType = ev.dataTransfer.getData('text') );

    // Ajoutons un texte qui dit quel élément a été droppé dans le formulaire
    ev.target.innerHTML += '<span data-control-type="' + szControlType + '" style="cursor:help;" class="control target shadow ' + szControlType + '" onclick="selectControl(event,this);">' + szControlType + '</span>';
}

function drag( ev,szID )
/*--------------------*/
{
    ev.dataTransfer.setData( "text",szID );
    //ev.cancelBubble = true;
    //ev.stopPropagation();
}

function selectControl( ev,o )
/*--------------------------*/
{
    console.log( o );
    updateProperties(o);
    ev.stopPropagation();

    // Je veux mettre une classe CSS sur le contrôle sélectionné
    // pour le mettre en évidence. Du coup, il faut que tous les
    // contrôles qui seraient mis déjà en évidence soient
    // "déselectionnés" avant de pouvoir sélectionner LE
    // nouveau contrôle

    if ( oControls = document.getElementById( 'form' ).getElementsByClassName( 'control' ) )
        for ( i = 0; i < oControls.length;i++ )
            oControls[i].classList.remove( 'selected' );

    o.classList.add( "selected" );
}

/* Mettre à jour le contrôle sur base de la valeur de la propriété modifiée dans la popup des propriétés */
function updateControl( szValue,szProperty )
/*----------------------------------------*/
{
    var oPopup = document.getElementById( "{$this->self['name']}_properties" );

    if ( oPopup )
    {
        if ( "undefined" != oPopup.currentControl && oPopup.currentControl )
        {
            console.log( "Updating control (" + szProperty + ")" );
            oPopup.currentControl.setAttribute( 'data-control-' + szProperty,szValue );
        }
        else
        {
            console.log( "No control to update" );
        }
    }
}

function mouseDown( oPopup )
{
    console.log("down");

    oPopup.engaged          = true;

    aPos                    = Q.M.pos();

    console.log( aPos );
    oPopup.XWhenMouseDown   = aPos[0];
    oPopup.YWhenMouseDown   = aPos[1];

    console.log( "Mouse position when popup clicked " + oPopup.XWhenMouseDown + ',' + oPopup.YWhenMouseDown );
}

function mouseMove( oPopup )
{
    if ( "undefined" != oPopup.engaged && oPopup.engaged )
    {
        aPos    = Q.M.pos();

        newX    = aPos[0] - oPopup.XWhenMouseDown;
        newY    = aPos[1] - oPopup.YWhenMouseDown;

        if ( newX > 0 && newY > 0 )
        {
            oPopup.style.left = newX + 'px';
            oPopup.style.top  = newY + 'px';

            console.log( "Popup moved to " + newX + ',' + newY );
        }
    }
}

function mouseUp( oPopup )
{
    console.log("up");
    oPopup.engaged = false;
}

function mouseOut( oPopup )
{
    console.log("out");
    //oPopup.engaged = false;
}

function onlyLettersSpaceAndDigits()
/*--------------------------------*/
{
    var c = event.charCode;

    console.log( c );

    return ( ( c > 47 && c <  58 ) ||   /* digits */
             ( c > 64 && c <  91 ) ||   /* lower letters */
             ( c > 96 && c < 123 ) ||   /* upper letters */
             ( c == 32 )           ||   /* space */
             ( c == 45 )           ||   /* hyphen */
             ( c == 95 )                /* underscore */
           );
}

function saveForm( szID )
/*---------------------*/
{
    var oForm,i,szAttributes;

    oForm = document.getElementById( szID );

    if ( oControls = oForm.getElementsByClassName( 'control' ) )
    {
        // Voilà ... j'ai une array de contrôles et je dois l'envoyer au serveur !
        console.log( oControls );
        szAttributes = JSON.stringify( oForm.dataset );

        //oFormBuilder.requestAction( 'formBuilder','no domain','save','en','form',JSON.stringify( oControls ) );
        for ( i=0;i<oControls.length;i++ )
        {
            szAttributes += JSON.stringify( oControls[i].dataset );
            //console.log( aAttributes );
            //console.log( szAttributes );
        }

        //szJSON = JSON.stringify( aAttributes );
        console.log( szAttributes );

        oFormBuilder.requestAction( 'formBuilder','no domain','save','en','form',szAttributes );
    }
}

function updateForm( szValue,szProperty )
/*-------------------------------------*/
{
    var oPopup = document.getElementById( "{$this->self['name']}_properties" );

    if ( oPopup )
    {
        if ( "undefined" != oPopup.currentControl && oPopup.currentControl )
        {
            console.log( "Updating control" );
            oPopup.currentControl.setAttribute( 'data-control-' + szProperty,szValue );
        }
        else
        {
            console.log( "No control to update" );
        }
    }
}

function updateFormTitle( szValue )
/*-------------------------------*/
{
    document.getElementById( 'form-title' ).innerHTML = szValue;
}

function updateFormProperties()
/*---------------------------*/
{
    console.log( "Update form properties" );
    updateProperties( document.getElementById( 'form' ) );
}

/* Mettre les propriétés de "o" dans la popup des propriétés */
/* Attention: en fonction du contrôle, on peut avoir de
   nouvelles propriétés. CE CAS N'EST PAS PROGRAMMÉ POUR L'INSTANT
*/
function updateProperties( o )
/*--------------------------*/
{
    var oPopup = document.getElementById( "{$this->self['name']}_properties" );
    var oTableBody,szInnerHTML;

    if ( oPopup )
    {
        oPopup.currentControl = o;
        var oProp,aProperties,i,szProperty;

        updateListOfProperties( o );

        aProperties = new Array();

        aProperties.push( 'action'          );
        aProperties.push( 'class'           );
        aProperties.push( 'comment'         );
        aProperties.push( 'dataenvironment' );
        aProperties.push( 'datasource'      );
        aProperties.push( 'description'     );
        aProperties.push( 'delete'          );
        aProperties.push( 'help'            );
        aProperties.push( 'id'              );
        aProperties.push( 'keywords'        );
        aProperties.push( 'label'           );
        aProperties.push( 'lang'            );
        aProperties.push( 'maxlength'       );
        aProperties.push( 'method'          );
        aProperties.push( 'name'            );
        aProperties.push( 'onchange'        );
        aProperties.push( 'onmousedown'     );
        aProperties.push( 'onmousemove'     );
        aProperties.push( 'onmouseout'      );
        aProperties.push( 'onmouseup'       );
        aProperties.push( 'pattern'         );
        aProperties.push( 'placeholder'     );
        aProperties.push( 'readonly'        );
        aProperties.push( 'required'        );
        aProperties.push( 'target'          );
        aProperties.push( 'tooltip'         );
        aProperties.push( 'title'           );
        aProperties.push( 'type'            );
        aProperties.push( 'value'           );


        for( i = 0;i < aProperties.length;i++ )
        {
            szProperty = aProperties[i];
            if ( oProp = document.getElementById( 'property_' + szProperty ) )
                oProp.value = o.getAttribute( 'data-control-' + szProperty );
            else
                console.log( szProperty + " NOT FOUND in the properties popup" );
        }
    }
}

function updateListOfProperties( o )
/*--------------------------------*/
{
    var oTableBody;

    oTableBody = document.getElementById('property-list');
    oTableBody.innerHTML = szInnerHTML = '';

    if ( o.getAttribute( 'id' ) === 'form' )
    {
        szInnerHTML += "<tr>";
            szInnerHTML += "<td title=\"Action triggered when a submit button is hit\">action</td>";
            szInnerHTML += "<td class=\"property_action\"><input id=\"property_action\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateForm( this.value,'action' );\"></td>";
        szInnerHTML += "</tr>";

        szInnerHTML += "<tr>";
            szInnerHTML += "<td title=\"CSS class of the form\">class</td>";
            szInnerHTML += "<td class=\"property_class\"><input onkeypress=\"return onlyLettersSpaceAndDigits();\" id=\"property_class\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateForm( this.value,'class' );\"></td>";
        szInnerHTML += "</tr>";

        szInnerHTML += "<tr>";
            szInnerHTML += "<td title=\"Comment\">comment</td>";
            szInnerHTML += "<td class=\"property_comment\"><input id=\"property_comment\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateForm( this.value,'comment' );\"></td>";
        szInnerHTML += "</tr>";

        szInnerHTML += "<tr>";
            szInnerHTML += "<td title=\"Data environment of all controls\">dataenvironment</td>";
            szInnerHTML += "<td class=\"property_dataenvironment\"><input onkeypress=\"return onlyLettersSpaceAndDigits();\" id=\"property_dataenvironment\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateForm( this.value,'dataenvironment' );\"></td>";
        szInnerHTML += "</tr>";

        szInnerHTML += "<tr>";
            szInnerHTML += "<td title=\"Description of the form\">description</td>";
            szInnerHTML += "<td class=\"property_description\"><input id=\"property_description\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateForm( this.value,'description' );\"></td>";
        szInnerHTML += "</tr>";

        szInnerHTML += "<tr>";
            szInnerHTML += "<td title=\"Form ID\">id</td>";
            szInnerHTML += "<td class=\"property_id\"><input onkeypress=\"return onlyLettersSpaceAndDigits();\" id=\"property_id\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateForm( this.value,'id' );\"></td>";
        szInnerHTML += "</tr>";

        szInnerHTML += "<tr>";
            szInnerHTML += "<td title=\"Keywords attached to the form\">keywords</td>";
            szInnerHTML += "<td class=\"property_keywords\"><input id=\"property_keywords\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateForm( this.value,'keywords' );\"></td>";
        szInnerHTML += "</tr>";

        szInnerHTML += "<tr>";
            szInnerHTML += "<td title=\"Language\">lang</td>";
            szInnerHTML += "<td class=\"property_lang\"><input id=\"property_lang\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateForm( this.value,'lang' );\"></td>";
        szInnerHTML += "</tr>";

        szInnerHTML += "<tr>";
            szInnerHTML += "<td title=\"method\">method</td>";
            szInnerHTML += "<td class=\"property_method\"><input id=\"property_method\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateForm( this.value,'method' );\"></td>";
        szInnerHTML += "</tr>";

        szInnerHTML += "<tr>";
            szInnerHTML += "<td>name</td>";
            szInnerHTML += "<td class=\"property_name\"><input onkeypress=\"return onlyLettersSpaceAndDigits();\" id=\"property_name\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateForm( this.value,'name' );\"></td>";
        szInnerHTML += "</tr>";

        szInnerHTML += "<tr>";
            szInnerHTML += "<td>onblur</td>";
            szInnerHTML += "<td class=\"property_onblur\"><input id=\"property_onblur\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateForm( this.value,'onblur' );\"></td>";
        szInnerHTML += "</tr>";

        szInnerHTML += "<tr>";
            szInnerHTML += "<td>onchange</td>";
            szInnerHTML += "<td class=\"property_onchange\"><input id=\"property_onchange\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateForm( this.value,'onchange' );\"></td>";
        szInnerHTML += "</tr>";

        szInnerHTML += "<tr>";
            szInnerHTML += "<td>onclick</td>";
            szInnerHTML += "<td class=\"property_onclick\"><input id=\"property_onclick\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateForm( this.value,'onclick' );\"></td>";
        szInnerHTML += "</tr>";

        szInnerHTML += "<tr>";
            szInnerHTML += "<td>oncontextmenu</td>";
            szInnerHTML += "<td class=\"property_oncontextmenu\"><input id=\"property_oncontextmenu\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateForm( this.value,'oncontextmenu' );\"></td>";
        szInnerHTML += "</tr>";

        szInnerHTML += "<tr>";
            szInnerHTML += "<td>oninput</td>";
            szInnerHTML += "<td class=\"property_oninput\"><input id=\"property_oninput\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateForm( this.value,'oninput' );\"></td>";
        szInnerHTML += "</tr>";

        szInnerHTML += "<tr>";
            szInnerHTML += "<td>oninvalid</td>";
            szInnerHTML += "<td class=\"property_oninvalid\"><input id=\"property_oninvalid\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateForm( this.value,'oninvalid' );\"></td>";
        szInnerHTML += "</tr>";

        szInnerHTML += "<tr>";
            szInnerHTML += "<td>onsubmit</td>";
            szInnerHTML += "<td class=\"property_onsubmit\"><input id=\"property_onsubmit\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateForm( this.value,'onsubmit' );\"></td>";
        szInnerHTML += "</tr>";

        // Ah ... ici ... c'est une select box!!!
        szInnerHTML += "<tr>";
            szInnerHTML += "<td>target</td>";
            szInnerHTML += "<td class=\"property_target\"><input id=\"property_target\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateForm( this.value,'target' );\"></td>";
        szInnerHTML += "</tr>";

        szInnerHTML += "<tr>";
            szInnerHTML += "<td>title</td>";
            szInnerHTML += "<td class=\"property_title\"><input id=\"property_title\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateForm( this.value,'title' ); updateFormTitle( this.value );\"></td>";
        szInnerHTML += "</tr>";

        szInnerHTML += "<tr>";
            szInnerHTML += "<td>tooltip</td>";
            szInnerHTML += "<td class=\"property_tooltip\"><input id=\"property_tooltip\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateForm( this.value,'tooltip' );\"></td>";
        szInnerHTML += "</tr>";

        szInnerHTML += "<tr>";
            szInnerHTML += "<td>type</td>";
            szInnerHTML += "<td class=\"property_type\"><input id=\"property_type\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateForm( this.value,'type' );\"></td>";
        szInnerHTML += "</tr>";

    }
    else
    {
        szProperty = 'class';
        szInnerHTML += "<tr>";
            szInnerHTML += "<td>" + szProperty + "</td>";
            szInnerHTML += "<td class=\"property_" + szProperty + "\"><input onkeypress=\"return onlyLettersSpaceAndDigits();\" id=\"property_" + szProperty + "\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateControl( this.value,'" + szProperty + "' );\"></td>";
        szInnerHTML += "</tr>";

        szProperty = 'datasource';
        szInnerHTML += "<tr>";
            szInnerHTML += "<td>" + szProperty + "</td>";
            szInnerHTML += "<td class=\"property_" + szProperty + "\"><input onkeypress=\"return onlyLettersSpaceAndDigits();\" id=\"property_" + szProperty + "\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateControl( this.value,'" + szProperty + "' );\"></td>";
        szInnerHTML += "</tr>";

        szProperty = 'delete';
        szInnerHTML += "<tr>";
            szInnerHTML += "<td>" + szProperty + "</td>";
            szInnerHTML += "<td class=\"property_" + szProperty + "\"><input id=\"property_" + szProperty + "\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateControl( this.value,'" + szProperty + "' );\"></td>";
        szInnerHTML += "</tr>";

        szProperty = 'id';
        szInnerHTML += "<tr>";
            szInnerHTML += "<td>" + szProperty + "</td>";
            szInnerHTML += "<td class=\"property_" + szProperty + "\"><input onkeypress=\"return onlyLettersSpaceAndDigits();\" id=\"property_" + szProperty + "\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateControl( this.value,'" + szProperty + "' );\"></td>";
        szInnerHTML += "</tr>";

        szProperty = 'help';
        szInnerHTML += "<tr>";
            szInnerHTML += "<td>" + szProperty + "</td>";
            szInnerHTML += "<td class=\"property_" + szProperty + "\"><input id=\"property_" + szProperty + "\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateControl( this.value,'" + szProperty + "' );\"></td>";
        szInnerHTML += "</tr>";

        szProperty = 'label';
        szInnerHTML += "<tr>";
            szInnerHTML += "<td>" + szProperty + "</td>";
            szInnerHTML += "<td class=\"property_" + szProperty + "\"><input id=\"property_" + szProperty + "\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateControl( this.value,'" + szProperty + "' );\"></td>";
        szInnerHTML += "</tr>";

        szProperty = 'lang';
        szInnerHTML += "<tr>";
            szInnerHTML += "<td>" + szProperty + "</td>";
            szInnerHTML += "<td class=\"property_" + szProperty + "\"><input id=\"property_" + szProperty + "\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateControl( this.value,'" + szProperty + "' );\"></td>";
        szInnerHTML += "</tr>";

        szProperty = 'maxlength';
        szInnerHTML += "<tr>";
            szInnerHTML += "<td>" + szProperty + "</td>";
            szInnerHTML += "<td class=\"property_" + szProperty + "\"><input id=\"property_" + szProperty + "\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateControl( this.value,'" + szProperty + "' );\"></td>";
        szInnerHTML += "</tr>";

        szProperty = 'name';
        szInnerHTML += "<tr>";
            szInnerHTML += "<td>" + szProperty + "</td>";
            szInnerHTML += "<td class=\"property_" + szProperty + "\"><input onkeypress=\"return onlyLettersSpaceAndDigits();\" id=\"property_" + szProperty + "\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateControl( this.value,'" + szProperty + "' );\"></td>";
        szInnerHTML += "</tr>";

        szProperty = 'onchange';
        szInnerHTML += "<tr>";
            szInnerHTML += "<td>" + szProperty + "</td>";
            szInnerHTML += "<td class=\"property_" + szProperty + "\"><input id=\"property_" + szProperty + "\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateControl( this.value,'" + szProperty + "' );\"></td>";
        szInnerHTML += "</tr>";

        szProperty = 'onmousedown';
        szInnerHTML += "<tr>";
            szInnerHTML += "<td>" + szProperty + "</td>";
            szInnerHTML += "<td class=\"property_" + szProperty + "\"><input id=\"property_" + szProperty + "\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateControl( this.value,'" + szProperty + "' );\"></td>";
        szInnerHTML += "</tr>";

        szProperty = 'onmousemove';
        szInnerHTML += "<tr>";
            szInnerHTML += "<td>" + szProperty + "</td>";
            szInnerHTML += "<td class=\"property_" + szProperty + "\"><input id=\"property_" + szProperty + "\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateControl( this.value,'" + szProperty + "' );\"></td>";
        szInnerHTML += "</tr>";

        szProperty = 'onmouseout';
        szInnerHTML += "<tr>";
            szInnerHTML += "<td>" + szProperty + "</td>";
            szInnerHTML += "<td class=\"property_" + szProperty + "\"><input id=\"property_" + szProperty + "\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateControl( this.value,'" + szProperty + "' );\"></td>";
        szInnerHTML += "</tr>";

        szProperty = 'onmouseup';
        szInnerHTML += "<tr>";
            szInnerHTML += "<td>" + szProperty + "</td>";
            szInnerHTML += "<td class=\"property_" + szProperty + "\"><input id=\"property_" + szProperty + "\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateControl( this.value,'" + szProperty + "' );\"></td>";
        szInnerHTML += "</tr>";

        szProperty = 'pattern';
        szInnerHTML += "<tr>";
            szInnerHTML += "<td>" + szProperty + "</td>";
            szInnerHTML += "<td class=\"property_" + szProperty + "\"><input id=\"property_" + szProperty + "\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateControl( this.value,'" + szProperty + "' );\"></td>";
        szInnerHTML += "</tr>";

        szProperty = 'placeholder';
        szInnerHTML += "<tr>";
            szInnerHTML += "<td>" + szProperty + "</td>";
            szInnerHTML += "<td class=\"property_" + szProperty + "\"><input id=\"property_" + szProperty + "\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateControl( this.value,'" + szProperty + "' );\"></td>";
        szInnerHTML += "</tr>";

        szProperty = 'readonly';
        szInnerHTML += "<tr>";
            szInnerHTML += "<td>" + szProperty + "</td>";
            szInnerHTML += "<td class=\"property_" + szProperty + "\"><input id=\"property_" + szProperty + "\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateControl( this.value,'" + szProperty + "' );\"></td>";
        szInnerHTML += "</tr>";

        szProperty = 'required';
        szInnerHTML += "<tr>";
            szInnerHTML += "<td>" + szProperty + "</td>";
            szInnerHTML += "<td class=\"property_" + szProperty + "\"><input id=\"property_" + szProperty + "\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateControl( this.value,'" + szProperty + "' );\"></td>";
        szInnerHTML += "</tr>";

        szProperty = 'tooltip';
        szInnerHTML += "<tr>";
            szInnerHTML += "<td>" + szProperty + "</td>";
            szInnerHTML += "<td class=\"property_" + szProperty + "\"><input id=\"property_" + szProperty + "\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateControl( this.value,'" + szProperty + "' );\"></td>";
        szInnerHTML += "</tr>";

        szProperty = 'type';
        szInnerHTML += "<tr>";
            szInnerHTML += "<td>" + szProperty + "</td>";
            szInnerHTML += "<td class=\"property_" + szProperty + "\"><input id=\"property_" + szProperty + "\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateControl( this.value,'" + szProperty + "' );\"></td>";
        szInnerHTML += "</tr>";

        szProperty = 'value';
        szInnerHTML += "<tr>";
            szInnerHTML += "<td>" + szProperty + "</td>";
            szInnerHTML += "<td class=\"property_" + szProperty + "\"><input id=\"property_" + szProperty + "\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateControl( this.value,'" + szProperty + "' );\"></td>";
        szInnerHTML += "</tr>";
    }

    oTableBody.innerHTML = szInnerHTML;

    console.log( "EXIT" );
}

SCRIPT;
        $szRetVal   .= "\n</script>\n";



        $szRetVal   .= "<div class=\"{$this->self['name']}\">\n";

            /****************************************************/
            /* The form (raw preview)                           */
            /****************************************************/
            $szRetVal   .= "<section class=\"{$this->self['name']}_target\" id=\"form\" ondrop=\"dropHandler(event);\" ondragover=\"allowDrop(event);\" onclick=\"updateFormProperties();\" data-control-type=\"form\" data-control-method=\"post\" data-control-action=\"/\" data-control-name=\"frmForm\" data-control-id=\"frmForm\">\n";
                $szRetVal .= "<h1 id=\"form-title\">Form</h1>";
            $szRetVal   .= "</section>\n";

            /****************************************************/
            /* The Save Form button                             */
            /****************************************************/
            {
                $szRetVal .= "<input onclick=\"saveForm('form'); return false;\" class=\"shadow\" type=\"submit\" value=\" SAVE FORM\" style=\"margin-top: 3em;min-width:15em;min-height:3em;\" />\n";
            }


            /****************************************************/
            /* The possible controls                            */
            /****************************************************/
            {
                $szRetVal   .= "<section class=\"{$this->self['name']}_controls popup \" " .
                                         "onmousedown=\"mouseDown(this);\" "                        .
                                         "onmouseup=\"mouseUp(this);\" "                            .
                                         "onmousemove=\"mouseMove(this);\" "                        .
                                         "onmouseout=\"mouseOut(this)\";>\n";

                    $szRetVal .= "<p class=\"title\">Controls</p>";
                    $szRetVal .= "<div class=\"newspaper\">\n";
                        foreach( $this->aControls as $szControlType )
                        {
                            $szRetVal .= $this->renderControl( $szControlType );
                        }
                    $szRetVal .= "</div>\n";
                $szRetVal   .= "</section>\n";
            }

            /****************************************************/
            /* The properties                                   */
            /****************************************************/
            {
                $szRetVal   .= "<section id=\"{$this->self['name']}_properties\" "              .
                                         "class=\"{$this->self['name']}_properties popup\" "    .
                                         "onmousedown=\"mouseDown(this);\" "                    .
                                         "onmouseup=\"mouseUp(this);\" "                        .
                                         "onmousemove=\"mouseMove(this);\" "                    .
                                         "onmouseout=\"mouseOut(this)\";>\n";
                    $szRetVal .= "<p class=\"title\">Properties</p>";
                    $szRetVal .= "<table class=\"properties\">\n";
                        $szRetVal .= "<thead>\n";
                            $szRetVal .= "<tr>\n";
                                $szRetVal .= "<th>Name</th>\n";
                                $szRetVal .= "<th>Value</th>\n";
                            $szRetVal .= "</tr>\n";
                        $szRetVal .= "</thead>\n";

                        $szRetVal .= "<tbody id=\"property-list\">\n";
                            $szRetVal .= "<tr>\n";
                                $szRetVal .= "<td>class</td>\n";
                                $szRetVal .= "<td class=\"property_class\"><input onkeypress=\"return onlyLettersSpaceAndDigits();\" id=\"property_class\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateControl( this.value,'class' );\" /></td>\n";
                            $szRetVal .= "</tr>\n";
                            $szRetVal .= "<tr>\n";
                                $szRetVal .= "<td>ID</td>\n";
                                $szRetVal .= "<td class=\"property_id\"><input id=\"property_id\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateControl( this.value,'id' );\" /></td>\n";
                            $szRetVal .= "</tr>\n";
                            $szRetVal .= "<tr>\n";
                                $szRetVal .= "<td>name</td>\n";
                                $szRetVal .= "<td class=\"property_name\"><input id=\"property_name\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateControl( this.value,'name' );\" /></td>\n";
                            $szRetVal .= "</tr>\n";
                            $szRetVal .= "<tr>\n";
                                $szRetVal .= "<td>onmousedown</td>\n";
                                $szRetVal .= "<td class=\"property_onmousedown\"><input id=\"property_onmousedown\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateControl( this.value,'onmousedown' );\" /></td>\n";
                            $szRetVal .= "</tr>\n";
                            $szRetVal .= "<tr>\n";
                                $szRetVal .= "<td>onmousemove</td>\n";
                                $szRetVal .= "<td class=\"property_onmousemove\"><input id=\"property_onmousemove\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateControl( this.value,'onmousemove' );\" /></td>\n";
                            $szRetVal .= "</tr>\n";
                            $szRetVal .= "<tr>\n";
                                $szRetVal .= "<td>onmouseout</td>\n";
                                $szRetVal .= "<td class=\"property_onmouseout\"><input id=\"property_onmouseout\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateControl( this.value,'onmouseout' );\" /></td>\n";
                            $szRetVal .= "</tr>\n";
                            $szRetVal .= "<tr>\n";
                                $szRetVal .= "<td>onmouseup</td>\n";
                                $szRetVal .= "<td class=\"property_onmouseup\"><input id=\"property_onmouseup\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateControl( this.value,'onmouseup' );\" /></td>\n";
                            $szRetVal .= "</tr>\n";
                            $szRetVal .= "<tr>\n";
                                $szRetVal .= "<td>type</td>\n";
                                $szRetVal .= "<td class=\"property_type\"><input id=\"property_type\" class=\"property\" type=\"text\" value=\"\" onblur=\"updateControl( this.value,'type' );\" /></td>\n";
                            $szRetVal .= "</tr>\n";
                        $szRetVal .= "</tbody>\n";
                    $szRetVal .= "</table>\n";
                $szRetVal   .= "</section>\n";
            }

            /****************************************************/
            /* A context menu section                           */
            /****************************************************/
            $szRetVal   .= "<section class=\"{$this->self['name']}_contextMenu\">\n";
                $szRetVal .= "<p class=\"title\">Context Menu</p>";
            $szRetVal   .= "</section>\n";
        $szRetVal   .= "</div>   <!-- {$this->self['name']} -->\n";


        return ( $szRetVal );
    }   /* End of FormBuilder.__toString() ============================================ */
    /* ================================================================================ */


    protected function renderControl( $szControlType )
    /*----------------------------------------------*/
    {
        return "<span class=\"control {$szControlType}\" "          .
                     "id=\"{$szControlType}\" "                     .
                     "data-control-type=\"{$szControlType}\" "      .
                     "draggable=\"true\" "                          .
                     "onmousedown=\"event.stopPropagation();\" "    .
                     "ondragstart=\"drag(event,'{$szControlType}' );\">{$szControlType}</span>\n";
    }


    /* ================================================================================ */
    /** {{*__destruct()=

        Class destructor

        {*params
        *}

        {*return
            (void)      No return
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

    }   /* End of FormBuilder.__destruct() ============================================ */
    /* ================================================================================ */

}   /* End of class FormBuilder ======================================================= */
/* ==================================================================================== */

?>