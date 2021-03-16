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

/**************************************************************************/
/** {{{*fheader
    {*file                  trql.input.class.php *}
    {*purpose               Input class (and more) to use with forms
                            of TRQL Labs (trql.form.class.php) *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 25-12-20 13:11 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}
    {*UTF-8                 Quel bel été sous le hêtre *}

    {*remark                This class has been created based on
                            QUICKInput.class.php

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 25-12-20 13:11 *}
        {*v 8.1.0002 *}
        {*desc              1)  Original creation
        *}
    *}

    *}}} */
/****************************************************************************************/
namespace trql\input;

use \trql\vaesoli\Vaesoli   as Vaesoli;
use \trql\html\Tag          as Tag;

if ( ! defined( 'VAESOLI_CLASS_VERSION' ) )
    require_once( 'trql.vaesoli.class.php' );

if ( ! defined( 'TAG_CLASS_VERSION' ) )
    require_once( 'trql.tag.class.php' );

defined( 'INPUT_CLASS_VERSION' ) or define( 'INPUT_CLASS_VERSION','0.1' );

/* ==================================================================================== */
/** {{*class Input=

    {*desc

        <input> element

    *}

    {*remark

        31-12-20 09:47:33: most of the implementation comes from
        D:\websites\vaesoli.org\www\httpdocs\vaesoli\include\LSFieldset.class.php

    *}

    *}}
 */
/* ==================================================================================== */
class Input extends Tag
/*-------------------*/
{
    public      $__class    = __CLASS__;

    protected   $self       = array( 'file'   => __FILE__     ,     /* {*property   $self                       (array)                 Fixed 'class' information. *} */
                                     'class'  => __CLASS__    ,
                                     'name'   => null         ,
                                     'birth'  => null         ,
                                     'home'   => null         ,
                                     'family' => null         ,
                                     'UIKey'  => null         ,
                                   );

    public      $szModule   = null;
    public      $szForm     = null;
    public      $aParams    = null;

    /* === [Properties NOT defined in schema.org] ===================================== */
    public      $wikidataId             = 'Q94100405';              /* {*property   $wikidataId                 (string)                Wikidata ID. <input>, input element. *} */


    /* ================================================================================ */
    /** {{*__construct( [$aParams] )=

        EVERYTHING MUST BE DOCUMENTED!!!!!!!!!!!!!!!

        {*params
            $szModule   (string)    The module we're in
            $szID       (string)    The zone we need help on
            $szID2      (string)    ?
            $szLang     (string)    The language to consider
        *}

        {*return
            (string)    The HTML code that corresponds to the help attached to an
                        input zone
        *}


        {*abstract
            Contextual help is related to a unique ID in a given module. For example
            if there is a zone called "edtMemo" in the form of the "invoices" module
            then the combination of the module and the name of the input zone forms
            a unique ID that corresponds to a help file stored in the Quitus - TRQL
            Snippet Center:

            d:\websites\snippet-center\q\common\resources\help\invoices.edtMemo.html

            Help is provided in function of the language that is used in TRQL when
            help is requested. In the former example, if the current language was
            set to French ('fr'), then we would look for a file called invoices.edtMemo.fr.html.
            If this file is not found, we fallback on other strategies:

            invoices.edtMemo.fr.html
            invoices.edtMemo.html
            edtMemo.fr.html
            edtMemo.html

            If none of these strategies yield a positive result, then we abandon : no
            help found !
        *}

        {*exec
        *}

        *}}
    */
    /* ================================================================================ */
    public function __construct( $aParams = null,$bRender = false )
    /*-----------------------------------------------------------*/
    {
        $this->aParams = $aParams;

        /********************************************************************************/
        /* This part supersedes \trql\mother\updateSelf() method                        */
        /********************************************************************************/
        $szClass                    = __CLASS__;
        $aParts                     = explode( '\\',$szClass );

        $this->self['name']         = strtolower( trim( end( $aParts ) ) );
        $this->self['birth']        = microtime( true );
        $this->self['common']       = vaesoli::FIL_RealPath( __DIR__ . '/q/common' );
        $this->self['resources']    = vaesoli::FIL_RealPath( $this->self['common'] . '/resources' );
        $this->self['UIKey']        = $szClass;
        $this->self['home']         = $this->szHome = vaesoli::FIL_RealPath( __DIR__ );

        if ( ! is_dir( $this->szHome ) )
        {
            $this->addInfo( __METHOD__ . "(): '{$this->szHome}' NOT found" );

            if ( vaesoli::FIL_MkDir( $this->szHome ) )
                $this->addInfo( __METHOD__ . "(): '{$this->szHome}' created" );
        }   /* if ( ! is_dir( $this->szHome ) ) */
        else   /* Else of ... if ( ! is_dir( $this->szHome ) ) */
        {
            $this->addInfo( __METHOD__ . "(): '{$this->szHome}' FOUND" );
        }   /* End of ... Else of ... if ( ! is_dir( $this->szHome ) ) */
        /********************************************************************************/
        /* This part supersedes \trql\mother\updateSelf() method                        */
        /********************************************************************************/

        if ( ! is_null( $aParams ) && $bRender )
            $this->render( $aParams );

        return ( $this );
    }   /* End of Input.__construct() ================================================= */
    /* ================================================================================ */


    public function render( $aParams = null ): string
    /*---------------------------------------------*/
    {
        return ( $this->__toHTML( $aParams ) );
    }   /* End of Input.render() ====================================================== */
    /* ================================================================================ */


    public function __toHTML( $aParams = null ): string
    /*-----------------------------------------------*/
    {
        static $szMobility = null;
        $szRetVal = '';

        if ( is_null( $szMobility ) )
        {
            if ( isset( $GLOBALS['goApp'] ) )
            {
                $szMobility = $GLOBALS['goApp']->getMobility();
            }
            else
            {
                $szMobility = 'desktop';
            }
        }

        $aParams = $aParams ?? $this->aParams;

        if ( isset( $aParams['html'] ) )
        {
            $szRetVal .= $aParams['html'];
            return;
        }

        if ( isset( $aParams['script'] ) )
        {
            $szRetVal .= "<script>{$aParams['script']}</script>";
            return;
        }

        if ( isset( $aParams['hr'] ) )
        {
            $szRetVal .= "<hr class=\"quitus\" />";
            return;
        }

        $szValue                = isset( $aParams['value'       ]   ) ? $aParams['value'        ]   : '';
        $szName                 = isset( $aParams['name'        ]   ) ? $aParams['name'         ]   : 'NO_NAME';
        $szType                 = isset( $aParams['type'        ]   ) ? $aParams['type'         ]   : 'txt';
        $szLabel                = isset( $aParams['label'       ]   ) ? $aParams['label'        ]   : '';
        $szLang                 = isset( $aParams['lang'        ]   ) ? $aParams['lang'         ]   : 'fr';
        $szClass                = isset( $aParams['class'       ]   ) ? $aParams['class'        ]   : '';
        $szStyle                = isset( $aParams['style'       ]   ) ? $aParams['style'        ]   : '';
        $szPlaceHolder          = isset( $aParams['placeholder' ]   ) ? $aParams['placeholder'  ]   : '';
        $szPattern              = isset( $aParams['pattern'     ]   ) ? $aParams['pattern'      ]   : '';
        $szMaxLength            = isset( $aParams['maxlength'   ]   ) ? $aParams['maxlength'    ]   : '';
        $WithHelp               = isset( $aParams['help'        ]   ) ? $aParams['help'         ]   : false;
        $WithDelete             = isset( $aParams['delete'      ]   ) ? $aParams['delete'       ]   : false;
        $Required               = isset( $aParams['required'    ]   ) ? $aParams['required'     ]   : false;
        $ReadOnly               = isset( $aParams['readonly'    ]   ) ? $aParams['readonly'     ]   : false;
        $bNoQuestionMark        = isset( $aParams['no-?'        ]   ) ? $aParams['no-?'         ]   : false;
        $szTooltip              = isset( $aParams['tooltip'     ]   ) ? $aParams['tooltip'      ]   : null;
        $szOnChange             = isset( $aParams['onchange'    ]   ) ? $aParams['onchange'     ]   : null;


        $szOptions              = null;

        $szTag                  = 'input';
        $szInputType            = 'text';
        $szSpecificClauses      = '';
        $szSpecificLabelClasses = '';
        $IsZip                  = false;
        $szQuestionMark         = $bNoQuestionMark ? '' : '?';

        if ( empty( $szLabel ) )
        {
            $szColon            = '';
        }
        else
        {
            $szColon            = ':';
        }

        if ( $Required )
        {
            $szSpecificClauses      .= ' required="required"';
            $szSpecificLabelClasses .= ' q-required';
        }

        if ( ! empty( $szTooltip ) )
        {
            $szSpecificClauses  .= ' title="' . $szTooltip . '"';
        }

        if ( $ReadOnly )
        {
            $szSpecificClauses  .= ' readonly="readonly"';
        }

        if ( ! empty( $szPlaceHolder ) )
        {
            $szSpecificClauses  .= " placeholder=\"{$szPlaceHolder}\"";
        }

        if ( ! empty( $szMaxLength ) )
        {
            $szSpecificClauses  .= " maxlength=\"{$szMaxLength}\"";
        }

        if ( ! empty( $szOnChange ) )
        {
            $szSpecificClauses  .= " onchange=\"{$szOnChange}\"";
        }

        if ( ! empty( $szStyle ) )
        {
            $szSpecificClauses  .= " style=\"{$szStyle}\"";
        }

        switch ( $szType )
        {
            case 'cbo'  :
                {
                    $szTag              = 'select';
                    $szOptions          = $aParams['options'] ?? null;
                }
                break;
            case 'cmd'  :
            case 'sub'  :
                {
                    $szInputType        = 'submit';
                }
                break;
            case 'editbox'  :
            case 'edit'     :
            case 'edt'      :
                {
                    $szTag              = 'textarea';

                    if ( isset( $aParams['rows'] ) )
                    {
                        $szSpecificClauses  .= " rows=\"{$aParams['rows']}\"";
                    }

                    if ( isset( $aParams['cols'] ) )
                    {
                        $szSpecificClauses  .= " cols=\"{$aParams['cols']}\"";
                    }

                    $szSpecificLabelClasses .= ' q-edt';
                }
                break;
            case 'dat'  :
                {
                    $szInputType        = 'date';
                }
                break;
            case 'datlocal'  :
                {
                    $szInputType        = 'datetime-local';
                    if ( ! empty( $szValue ) )
                        $szValue = date( 'Y-m-d\TH:i',strtotime( $szValue ) );
                }
                break;
            case 'chk'  :
                {
                    $szInputType        = 'checkbox';

                    if ( $this->makeBool( $szValue ) )
                    {
                        $szSpecificClauses .= ' checked="checked"';
                    }
                }
                break;
            case 'ema'  :
            case 'mai'  :
                {
                    $szInputType        = 'email';
                    $szSpecificClauses .= ' multiple';
                }
                break;
            case 'fil'  :
                {
                    $szType             = 'txt';
                    $szInputType        = 'file';
                }
                break;
            case 'num'  :
                {
                    $szInputType        = 'number';

                    if ( ! isset( $aParams['step'] ) )
                    {
                        $szSpecificClauses  .= ' step="any"';
                    }
                    else
                    {
                        $szSpecificClauses  .= " step=\"{$aParams['step']}\"";
                    }
                }
                break;
            case 'pho'  :
            case 'phone':
            case 'mobile':
            case 'tel' :
            case 'telephone' :
                {
                    $szInputType        = 'tel';
                }
                break;
            case 'tim'  :
                {
                    $szType             = 'txt';
                    $szInputType        = 'time';
                }
                break;
            case 'vat'  :
                {
                    $szInputType        = 'text';
                    $szType             = 'txt';
                    $szPattern          = "^[Nn]/[Aa]|^(BE)? ?0?[0-9]{9}$|^(BE)? ?0?[0-9]{3}[ \.]?[0-9]{3}[ \.]?[0-9]{3}$|^(FR)? ?[0-9A-Z]{2}[0-9]{9}|^(FR)? ?[0-9A-Z]{2}[0-9]{3}[ \.]?[0-9]{3}[ \.]?[0-9]{3}$|^(NL)?[0-9]{9}B[0-9]{2}$|^(LU)? ?[0-9]{8}$|^(DE)? ?[0-9]{9}|^(DE)? ?[0-9]{3}[ \.]?[0-9]{3}[ \.]?[0-9]{3}$|^(GB)? ?([0-9]{9}([0-9]{3})?|[A-Z]{2}[0-9]{3})$|^(ES)? ?[0-9A-Z][0-9]{7}[0-9A-Z]$|^(IT)? ?[0-9]{11}$|^(AT)? ?U[0-9]{8}$|^(FI)? ?[0-9]{8}$|^(EL|GR)? ?[0-9]{9}$|^(IE)? ?[0-9]S[0-9]{5}L$|^(PT)? ?[0-9]{9}|^(PT)? ?[0-9]{3}[ \.]?[0-9]{3}[ \.]?[0-9]{3}?$|^(SE)? ?[0-9]{12}$";
                }
                break;
            case 'zip'  :
                {
                    $szType             = 'txt';
                    $IsZip              = true;
                }
                break;
            case 'pwd'  :
            case 'pas'  :
                {
                    $szInputType        = 'password';
                }
                break;
            default     :
                {
                }
        }   /* switch ( $szType ) */

        if ( ! empty( $szSpecificLabelClasses ) )
        {
            $szSpecificLabelClasses = " class=\"{$szSpecificLabelClasses}\"";
        }

        /* Editbox */
        if ( $szType === 'edt' )
        {
            //var_dump( $szSpecificClauses );
            $szRetVal .= "<li><label for=\"{$szType}{$szName}\" style=\"vertical-align:top;\" {$szSpecificLabelClasses}>"                                                                                         .
                            $this->__( "{$szType}{$szName}",$szLang,$szLabel )                                                                                                      .
                            "{$szColon}&#160;</label>%BR%"                                                                                                                          .
                               "<textarea name=\"{$szType}{$szName}\" id=\"{$szType}{$szName}\"$szSpecificClauses >{$szValue}</textarea>"                                           .
                               ( $WithDelete ? " <span class=\"q-button-delete\" onclick=\"document.getElementById('{$szType}{$szName}').value = '';\">"                            .
                                                    "<img src=\"/snippet-center/images/delete.png\" />"                                                                             .
                                                "</span>" : '' )                                                                                                                    .
                               ( $WithHelp   ? " <span class=\"q-button-help\" onclick=\"q_help(this,'{$this->szModule}','{$this->szForm}','{$szType}{$szName}','{$szLang}');\">"   .
                                                    "<img src=\"/snippet-center/icons/q-help.png\" />"                                                                              .
                                                "</span>" : '' )                                                                                                                    .
                         "</li>\n";
        }
        /* Hidden field */
        elseif ( $szType === 'hid')
        {
            $szRetVal .= "<li><input type=\"hidden\" id=\"{$szName}\" name=\"{$szName}\" value=\"{$szValue}\" /></li>";
        }
        /* Select box */
        elseif ( $szType === 'cbo')
        {
            if ( preg_match_all( '%<option\b(?P<attr>[^>]*)>(?P<label>.*?)</option>%si',$szOptions,$aMatches,PREG_PATTERN_ORDER ) )
            {
                $iCount = count( $aMatches['attr'] );

                $szOptions = '';                                        /* Reset all options */

                for ( $i = 0; $i < $iCount; $i++ )                      /* For each option we found */
                {
                    $szOptionValue = $szSelected = '';                  /* Reset for each option */

                    if ( preg_match( '/value="(?P<val>.*?)"/si',$aMatches['attr'][$i],$aParts ) )
                    {
                        /* If this option is the one we need to set (because it corresponds to the value that's set) */
                        if ( ( $szOptionValue = $aParts['val'] ) === $szValue )
                        {
                            $szSelected = ' selected="selected"';
                        }

                        $szOptions .= "<option value=\"{$szOptionValue}\"{$szSelected}>{$aMatches['label'][$i]}</option>";
                    }
                }   /* for ( $i = 0; $i < $iCount; $i++ ) */
            }

            $szRetVal .= "<li><label for=\"{$szType}{$szName}\">{$szLabel}{$szColon}&#160;</label>%BR%"                                                                                         .
                              "<select name=\"{$szType}{$szName}\" id=\"{$szType}{$szName}\" {$szSpecificClauses} value=\"{$szValue}\" class=\"q-{$szType} {$szClass}\">{$szOptions}</select>"  .
                              (  $WithHelp   ? " <span class=\"q-button-help\" onclick=\"q_help(this,'{$this->szModule}','{$this->szForm}','{$szType}{$szName}','{$szLang}');\">"               .
                                                    "<img src=\"/snippet-center/icons/q-help.png\" />"                                                                                          .
                                               "</span>" : '' ) .
                         "</li>\n";
        }
        /* Checkbox */
        elseif ( $szType === 'chk')
        {
            $szFakeLabel = '';

            //if ( $szMobility === 'desktop' )
            //{
            //    $szFakeLabel = '<label></label>';
            //}
            $szRetVal .= "<li>{$szFakeLabel}<input type=\"checkbox\" class=\"q-{$szType} {$szClass}\" id=\"{$szType}{$szName}\" name=\"{$szType}{$szName}\"{$szSpecificClauses} /><label for=\"{$szType}{$szName}\">{$szLabel}&#160;{$szQuestionMark}</label></li>";
        }
        /* Input type text */
        else
        {
            $szDataListRef = $szDataList = '';

            if ( isset( $aParams['datalist'] ) && is_array( $aParams['datalist'] ) )
            {
                $szDataListRef  = " list=\"datalist_{$szName}\"";
                $szDataList     = "<datalist id=\"datalist_{$szName}\">";

                foreach( $aParams['datalist'] as $x )
                {
                    $szDataList .= "<option value=\"{$x}\">";
                }

                $szDataList .= "</datalist> <!-- #datalist_{$szName} -->";
            }

            if ( ! $IsZip )
            {
                //if ( $szType === 'dat' )
                //{
                //    var_dump( $szSpecificClauses );
                //    die();
                //}

                //die( "JE MEURS ICI" );
                //var_dump( $szType,$szLabel );

                // ICI "PUNAISE" DOIT ETRE REMPLACER PAR QQCH QUI FAIT DU SENS POUR OPENLABELS
                $szRetVal .= "<li>";

                if ( ! empty( $szLabel ) )
                {
                    $szRetVal .= "<label for=\"{$szType}{$szName}\"{$szSpecificLabelClasses}>"  .
                                     $this->__( "{$szType}{$szName}",$szLang,$szLabel )         .
                                     "{$szColon}&#160;</label>%BR%";
                }

                $szRetVal .= "<input type=\"{$szInputType}\" class=\"q-{$szType} {$szClass}\" "                                                                                                 .
                                          "id=\"{$szType}{$szName}\" name=\"{$szType}{$szName}\"{$szDataListRef} "                                                                              .
                                          "{$szSpecificClauses} value=\"{$szValue}\""                                                                                                           .
                                          ( ! empty( $szPattern ) ? " pattern=\"{$szPattern}\"" : '' ) . "/>"                                                                                   .
                                          ( $WithDelete ? " <span class=\"q-button-delete\" onclick=\"document.getElementById('{$szType}{$szName}').value = '';\">"                             .
                                                                "<img src=\"/snippet-center/images/delete.png\" />"                                                                             .
                                                           "</span>" : '' )                                                                                                                     .
                                          ( $WithHelp   ? " <span class=\"q-button-help\" onclick=\"q_help(this,'{$this->szModule}','{$this->szForm}','{$szType}{$szName}','{$szLang}');\">"    .
                                                                "<img src=\"/snippet-center/icons/q-help.png\" />"                                                                              .
                                                           "</span>" : '' )                                                                                                                     .
                             "</li>{$szDataList}";
            }
            else
            {
                // ICI "PUNAISE" DOIT ETRE REMPLACER PAR QQCH QUI FAIT DU SENS POUR OPENLABELS
                $szRetVal .= "<li><label for=\"{$szType}{$szName}\"{$szSpecificLabelClasses}>"                                                                                                  .
                                 $this->__( "{$szType}{$szName}",$szLang,$szLabel )                                                                                                             .
                                 "{$szColon}&#160;</label>%BR%"                                                                                                                                 .
                                 "<input type=\"{$szInputType}\" class=\"q-zip {$szClass}\" "                                                                                                   .
                              "id=\"{$szType}{$szName}\" name=\"{$szType}{$szName}\" "                                                                                                          .
                              "value=\"{$szValue[0]}\" /> "                                                                                                                                     .
                     "<input type=\"text\" class=\"q-city {$szClass}\" "                                                                                                                        .
                              "id=\"{$szType}{$szName}City\" name=\"{$szType}{$szName}City\"{$szDataListRef} "                                                                                  .
                              "value=\"{$szValue[1]}\" /> "                                                                                                                                     .
                     ( $WithDelete  ? " <span class=\"q-button-delete\" onclick=\"document.getElementById('{$szType}{$szName}').value = '';\">"                                                 .
                                           "<img src=\"/snippet-center/images/delete.png\" />"                                                                                                  .
                                       "</span>" : '' )                                                                                                                                         .
                     ( $WithHelp    ? " <span class=\"q-button-help\" onclick=\"q_help(this,'{$this->szModule}','{$this->szForm}','{$szType}{$szName}','{$szLang}');\">"                        .
                                            "<img src=\"/snippet-center/icons/q-help.png\" />"                                                                                                  .
                                      "</span>" : '' )                                                                                                                                          .
                     "</li>{$szDataList}";
            }
        }

        return ( $szRetVal );
    }   /* End of Input.__toHTML() ==================================================== */
    /* ================================================================================ */


    /* ================================================================================ */
    /** {{*q_getInputZoneHelp( $szModule,$szID,$szID2,$szLang )=

        Get the contextual help attched to a zone

        {*params
            $szModule   (string)    The module we're in
            $szID       (string)    The zone we need help on
            $szID2      (string)    ?
            $szLang     (string)    The language to consider
        *}

        {*return
            (string)    The HTML code that corresponds to the help attached to an
                        input zone
        *}


        {*abstract
            Contextual help is related to a unique ID in a given module. For example
            if there is a zone called "edtMemo" in the form of the "invoices" module
            then the combination of the module and the name of the input zone forms
            a unique ID that corresponds to a help file stored in the Quitus - TRQL
            Snippet Center:

            d:\websites\snippet-center\q\common\resources\help\invoices.edtMemo.html

            Help is provided in function of the language that is used in TRQL when
            help is requested. In the former example, if the current language was
            set to French ('fr'), then we would look for a file called invoices.edtMemo.fr.html.
            If this file is not found, we fallback on other strategies:

            invoices.edtMemo.fr.html
            invoices.edtMemo.html
            edtMemo.fr.html
            edtMemo.html

            If none of these strategies yield a positive result, then we abandon : no
            help found !
        *}

        {*exec
        *}

        *}}
    */
    /* ================================================================================ */
    function q_getInputZoneHelp( $szModule,$szID,$szID2,$szLang )
    /*---------------------------------------------------------*/
    {
        $szRetVal = '';                                                 /* The return value of the function */

        // Tout le code qui suit a até mis en commentaire parce qu'il doit encore être
        // affiné pour correspondre à ce qui est nécessaire dans Quitus Rebooted -
        // TRQL
        // commented out on 20170310 //$szFile   = str_replace( '\\','/',FIL_ResolveRoot( dirname( __FILE__ ) . '/../islands/' . $szModule . '.help.' . $szLang . '.php' ) );
        // commented out on 20170310 $szRetVal       = '';
        // commented out on 20170310 //$szShiftF1File  = FIL_Normalize( str_replace( '\\','/',FIL_ResolveRoot( '/../help/' . $szModule . '.' . $szID . '.' . $szLang . '.php' ) ) );
        // commented out on 20170310 //$szRetVal      .= LSQIncludeFile( $szShiftF1File,$szModule,$szID,$szID2,$szLang );
        // commented out on 20170310
        // commented out on 20170310 $szFile         = FIL_ResolveRoot( dirname( __FILE__ ) . '/../help/zones/' . $szModule . '.' . $szID . '.' . $szLang . '.php' ) ;
        // commented out on 20170310 $szRetVal      .= LSQIncludeFile( $szFile,$szModule,$szID,$szID2,$szLang );
        // commented out on 20170310
        // commented out on 20170310 if ( ! empty( $szRetVal ) ) /* If help found */
        // commented out on 20170310 {
        // commented out on 20170310     $szMsg    = "{help-found}";
        // commented out on 20170310 }
        // commented out on 20170310 else   /* if ( ! empty( $szRetVal ) ) */
        // commented out on 20170310 {
        // commented out on 20170310     $szFile     = FIL_ResolveRoot( dirname( __FILE__ ) . '/../help/zones/' . $szID . '.' . $szLang . '.php' ) ;
        // commented out on 20170310     $szRetVal   .= LSQIncludeFile( $szFile,$szModule,$szID,$szID2,$szLang );
        // commented out on 20170310
        // commented out on 20170310     if ( ! empty( $szRetVal ) ) /* If help found */
        // commented out on 20170310     {
        // commented out on 20170310         $szMsg    = "{help-found}";
        // commented out on 20170310     }
        // commented out on 20170310     else
        // commented out on 20170310     {
        // commented out on 20170310         $szRetVal   = "No contextual help found on {$szModule}.{$szID}.{$szLang}";
        // commented out on 20170310     }
        // commented out on 20170310 }   /* End of ... Else of ... if ( ! empty( $szRetVal ) ) */

        return ( "<![CDATA[{$szRetVal}]]>" );                           /* Return result to caller */
    }   /* End of q_getInputZoneHelp() ================================================ */
    /* ================================================================================ */


    // commented out on 20170310 function LSQCreateDynamicHelpProlog( $szModule,$szFieldName,$szDivID,$szLang )
    // commented out on 20170310 /*--------------------------------------------------------------------------*/
    // commented out on 20170310 {
    // commented out on 20170310     $szRetVal = "<p style=\"float:right;clear:both;margin:0;\" "                                            .
    // commented out on 20170310                    "onclick=\"document.getElementById('{$szDivID}').style.display='none';\">"    .
    // commented out on 20170310                 "<img src=\"/q/images/close.png\" title=\"{q-close-contextual-help}\" "                                                         .
    // commented out on 20170310                 "style=\"border:1px solid #000;width:12px;height:12px\" /></p>"                             .
    // commented out on 20170310                 "<div style=\"clear:both;height:1px;overflow:hidden;\">&#160;</div>"                        .
    // commented out on 20170310                 "<h2>Module " . strtoupper( $szModule ) . " &#8211; Zone <code>'{$szFieldName}'</code></h2>";
    // commented out on 20170310
    // commented out on 20170310     return ( $szRetVal );
    // commented out on 20170310 }   /* End of function LSQCreateDynamicHelpProlog() */
    // commented out on 20170310 /* ====================================================================== */
    // commented out on 20170310
    /* ====================================================================== */


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

    }   /* End of Input.__destruct() ================================================== */
    /* ================================================================================ */
}   /* End of class Input */
