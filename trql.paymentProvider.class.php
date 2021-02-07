<?php
/**************************************************************************/
/** {{{*fheader
    {*file                  trql.paymentProvider.class.php *}
    {*purpose               TRQL Labs - Payment Provider Abstraction *}
    {*author                {PYB} *}
    {*company               {COMPANY} *}
    {*cdate                 01/04/2017 - 00:00 *}
    {*mdate                 auto *}
    {*license               {RIGHTS} *}

    ------------------------------------------------------------------------
    Changes History:
    ------------------------------------------------------------------------

    {*chist
        {*mdate 11/08/2019 *}
        {*v 2.0.0001 *}
        {*desc              1)  Original creation
        *}
    *}


    *}}} */
/**************************************************************************/
interface iPaymentProvider
/*-----------------------*/
{
    public function init( $aData );
}   /* End of interface ipaymentProvider ============================================ */


class paymentProvider implements iPaymentProvider
/*---------------------------------------------*/
{
    public $aProperties = null;

    public function init( $aData )
    /*--------------------------*/
    {
        var_dump( 'Tu veux initialiser ton paymentProvider mais c\'est pas encore programmé dans ' . __FILE__  . " à la ligne " . __LINE__ );
    }   /* End of paymentProvider.init() ============================================ */
    /* ============================================================================== */

    protected function redirect( $szURL )
    /*---------------------------------*/
    {
        ob_start();
        header('Location: '. $szURL );
        ob_end_flush();
        die();
    }   /* End of paymentProvider.redirect() ======================================== */
    /* ============================================================================== */


    public function guid()
    /*------------------*/
    {
        if ( function_exists( 'com_create_guid' ) === true )
        {
            return ( trim( com_create_guid(),'{}' ) );
        }

        return ( sprintf( '%04X%04X-%04X-%04X-%04X-%04X%04X%04X',
                          mt_rand( 0,65535 )                    ,
                          mt_rand( 0,65535 )                    ,
                          mt_rand( 0,65535 )                    ,
                          mt_rand( 16384,20479 )                ,
                          mt_rand( 32768,49151 )                ,
                          mt_rand( 0,65535 )                    ,
                          mt_rand( 0,65535 )                    ,
                          mt_rand( 0,65535 ) ) );
    }   /* End of paymentProvider.guid() ============================================ */
    /* ============================================================================== */


}   /* End of class paymentProviderFactory ========================================== */


class paymentProviderFactory
/*-------------------------*/
{
    public static function create( $szType )
    /*------------------------------------*/
    {
        switch( $szType )
        {
            case 'mollie'       : return new mollie();
            default             : throw new Exception( 'Invalid paymentProvider: ' . $szType );
        }
    }   /* End of paymentProviderFactory.create() =================================== */
    /* ============================================================================== */
}   /* End of class paymentProviderFactory ========================================== */


class mollie extends paymentProvider
/*--------------------------------*/
{
    public      $szMode                 = 'test';
    protected   $aAPIKeys               = array( 'test' => 'test_4DJEW82S37n7pUtskggfp3v8793Q56'        ,
                                                 'live' => 'live_F2a2Wt9s2FkFrJPFdMPpC9CmxqTdwv'
                                               );
    protected   $aURLs                  = array( 'redirect' => 'https://www.trql.fm/mollie-redirect/'   ,
                                                 'hook'     => 'https://www.trql.fm/mollie-webhook/'
                                               );
    public      $szContactOption        = null;
    public      $szContactDestination   = null;

    /* Champenois
        test => test_UTnHtqeN7P8wyE9SRgdGNWt6R97uMq
        live => live_6UHJ5xmyN6avr7f2Mn78R3P8CtkSTA
    */

    public function __construct()
    /*-------------------------*/
    {
        //var_dump( "Salut ... je suis Mollie" );
    }   /* End of mollie.__construct() ============================================== */
    /* ============================================================================== */


    public function setAPIKeys( $aData = null )
    /*---------------------------------------*/
    {
        $aRetVal = $this->aAPIKeys;

        if ( isset( $aData['test'] ) )
        {
            $this->aAPIKeys['test'] = $aData['test'];
        }   /* if ( isset( $aData['test'] ) ) */

        if ( isset( $aData['live'] ) )
        {
            $this->aAPIKeys['live'] = $aData['live'];
        }   /* if ( isset( $aData['live'] ) ) */

        return ( $aRetVal );
    }   /* End of mollie.setAPIKeys() =============================================== */
    /* ============================================================================== */


    public function setRedirect( $szValue = null )
    /*------------------------------------------*/
    {
        $szRetVal = $this->aURLs['redirect'];

        if ( ! is_null( $szValue ) )
        {
            $this->aURLs['redirect'] = $szValue;
        }   /* if ( ! is_null( $szValue ) ) */

        return ( $szRetVal );
    }   /* End of mollie.setRedirect() ============================================== */
    /* ============================================================================== */


    public function setHook( $szValue = null )
    /*--------------------------------------*/
    {
        $szRetVal = $this->aURLs['hook'];

        if ( ! is_null( $szValue ) )
        {
            $this->aURLs['hook'] = $szValue;
        }   /* if ( ! is_null( $szValue ) ) */

        return ( $szRetVal );
    }   /* End of mollie.setHook() ================================================== */
    /* ============================================================================== */


    public function setContactOption( $szValue = null )
    /*-----------------------------------------------*/
    {
        $szRetVal = $this->szContactOption;

        if ( ! is_null( $szValue ) )
        {
            $this->szContactOption = $szValue;
        }   /* if ( ! is_null( $szValue ) ) */

        return ( $szRetVal );
    }   /* End of mollie.setContactOption() ========================================= */
    /* ============================================================================== */


    public function setContactDestination( $szValue = null )
    /*-----------------------------------------------*/
    {
        $szRetVal = $this->szContactDestination;

        if ( ! is_null( $szValue ) )
        {
            $this->szContactDestination = $szValue;
        }   /* if ( ! is_null( $szValue ) ) */

        return ( $szRetVal );
    }   /* End of mollie.setContactDestination() ==================================== */
    /* ============================================================================== */


    protected function call( $szURL,$o = null )
    /*---------------------------------------*/
    {
        $szAccessToken  = $this->aAPIKeys[$this->szMode];
        $szTokenType    = 'Bearer';

        $oJSON      = null;
        $aHeaders   = array( "User-Agent: TRQL Radio/0.1"       ,
                             "Accept: application/json"         ,
                             "Content-Type: application/json"   ,
                             "Authorization: {$szTokenType} {$szAccessToken}" );

        //var_dump( $aHeaders );

        try
        {
            $ch = curl_init();

            //var_dump( "URL: {$szURL}" );

            curl_setopt( $ch, CURLOPT_URL,$szURL );
            //curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST,false );
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER,false );
            curl_setopt( $ch, CURLOPT_HTTPHEADER,$aHeaders );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER,true );

            // Je devrais encore vérifier si $aFields est null ou non
            // Si pas null, alors, c'est un POST avec des fields
            // qui se trouvent dans aFields

            if ( ! is_null( $o ) )
            {
                curl_setopt( $ch,CURLOPT_POST,true );
                curl_setopt( $ch,CURLOPT_POSTFIELDS,json_encode( $o ) );
            }

            if ( ( $xResult = curl_exec( $ch ) ) === false )
            {
                $szErrMsg = curl_error( $ch );

                if ( error_reporting() != 0 )
                {
                    var_dump( $xResult );
                    var_dump( $szErrMsg );
                }
            }   /* if ( ( $xResult = curl_exec( $ch ) ) === false ) */
            else    /* Else of ... if ( ( $xResult = curl_exec( $ch ) ) === false ) */
            {
                //echo "seems OK";
                //var_dump( $xResult );

                //if ( error_reporting() != 0 )
                //    var_dump( $xResult );

                if ( $oJSON = json_decode( $xResult ) )
                {
                    //var_dump( $oJSON );

                    if ( isset( $oJSON->errorMessage ) )
                    {
                        $szErrMsg   = $oJSON->errorMessage;
                        $oJSON      = null;

                        if ( error_reporting() != 0 )
                        {
                            var_dump( $szErrMsg );
                        }
                    }
                }
                elseif ( error_reporting() != 0 )
                {
                    var_dump( 'URL: ' . $szURL );
                    var_dump( $oJSON );
                }
            }   /* End of ... Else of ... if ( ( $xResult = curl_exec( $ch ) ) === false ) */
        }
        catch ( Exception $e )
        {
            $szErrMsg = $e->getMessage();
        }

        if ( $ch )
            curl_close( $ch );

        return ( $oJSON );
    }   /* End of mollie.call() ===================================================== */
    /* ============================================================================== */


    public function createPayment( $aData = null )
    /*------------------------------------------*/
    {
        $oRetVal = null;

        if ( ! is_null( $aData ) )
        {
            // Transformer l'array en objet
            $o = (object) $aData;

            // Au cas où le montant serait un float ou un int ... transformer en string
            $o->amount->value = (string) $o->amount->value;

            $o->redirectUrl = $this->setRedirect();
            $o->webhookUrl  = $this->setHook();

            // Avant que le code ne soit fait pour transformer l'array
            // en objet, on créait l'obejt de la manière suivante:
            //$oMeta                  = new stdClass();
            //$oMeta->id              = md5( $this->guid() );
            //$oMeta->origin          = 'qrshooting - photo';

            //$o                      = new stdClass();
            //@$o->amount->currency   = 'EUR';
            //$o->amount->value       = '15.00';
            //$o->description         = 'Un premier paiement pour QRShooting';
            //$o->redirectUrl         = 'https://www.trql.fm/mollie-redirect/';
            //$o->webhookUrl          = 'https://www.trql.fm/mollie-webhook/';
            //
            //// J'attache les metadatas au paiement
            //$o->metadata            = json_encode( $oMeta );


            // Il faut demander à Mollie de créer le paiement. Au retour, Mollie nous
            // dit où il faut se brancher pour faire le checkout
            // Doc: https://docs.mollie.com/reference/v2/payments-api/create-payment
            $oRetVal = $this->call( 'https://api.mollie.com/v2/payments',$o );

        }   /* if ( ! is_null( $aData ) ) */

        return ( $oRetVal );
    }   /* End of mollie.createPayment() ============================================ */
    /* ============================================================================== */


    /* Doc: https://docs.mollie.com/reference/v2/payments-api/list-payments */
    public function listPayments( $aFilter = null,$bDebug = false )
    /*-----------------------------------------------------------*/
    {
        $aRetVal        = null;
        $szURL          = 'https://api.mollie.com/v2/payments?limit=250';   // Cela ne marche pas avec l'API de Mollie !!! (il ne retourne pas TOUTES les transactions)
        //$szURL          = 'https://api.mollie.com/v2/payments';
        $szOldURL  = $szURL;
        $iLimit         = 10;
        $iLoop          = 0;

        //$oJSON = $this->call( $szURL );
        //var_dump( $oJSON );
        //return ( null );

        //var_dump( $this );
        //return ( null );

        while ( ! is_null( $szURL ) )
        {
            //var_dump( "Call #" . ( $iLoop + 1 ) );
            //var_dump( "OLD URL: {$szOldURL}" );
            //var_dump( "URL: {$szURL}" );
            $oJSON = $this->call( $szURL );
            //var_dump( $oJSON );

            if ( ! is_null( $aFilter ) )
            {
                $szFilter   = str_replace( '/','->',array_keys( $aFilter )[0] );
                $szValue    = $aFilter[array_keys( $aFilter )[0] ];
                //var_dump( $szFilter,$szValue );
            }
            else
            {
                $szFilter   = null;
                $szValue    = null;
            }

            foreach( $oJSON->_embedded->payments as $oPayment )
            {
                /*
                    public 'metadata' =>
                        object(stdClass)[77]
                          public 'id' => string 'jean.boens.2021.8752cf7682eeeed7694411183f87bb8a' (length=48)
                          public 'product' =>
                            object(stdClass)[71]
                              public 'name' => string 'Stage été ASBL Diabolo' (length=24)
                              public 'category' => string 'Internship' (length=10)
                              public 'date' => string '20210131134757' (length=14)
                */


                $aRetVal[$oPayment->id] = $oPayment;
            }   /* foreach( $oJSON->_embedded->payments as $oPayment ) */

            if     ( ! isset( $oJSON->_links ) )
            {
                //var_dump( 'PAS DE LIEN SUIVANT CAR LIENS PAS POSITIONNÉS  !!! LINE: ' . __LINE__ );
                //var_dump( $oJSON );
                $szURL = null;
            }   /* if ( ! isset( $oJSON->_links ) || ! isset( $oJSON->_links->next ) || is_null( $oJSON->_links->next ) ) */
            elseif ( ! isset( $oJSON->_links->next ) )
            {
                //var_dump( 'PAS DE LIEN SUIVANT CAR NEXT PAS POSITIONNÉ  !!! LINE: ' . __LINE__ );
                //var_dump( $oJSON );
                $szURL = null;
            }
            elseif ( is_null( $oJSON->_links->next ) )
            {
                //var_dump( 'PAS DE LIEN SUIVANT CAR NEXT EST NULL !!! LINE: ' . __LINE__ );
                //var_dump( $oJSON );
                $szURL = null;
            }
            elseif ( $oJSON->_links->next->href === $szOldURL )
            {
                //var_dump( 'PAS DE LIEN SUIVANT CAR LINK DEJA EXERCÉ !!! LINE: ' . __LINE__ );
                //var_dump( $oJSON );
                $szURL = null;
            }
            else
            {
                //var_dump( "OLD NEXT LINK: {$szOldURL}" );
                //var_dump( "NEW NEXT LINK: {$oJSON->_links->next->href}" );
                $szOldURL   = $szURL;
                $szURL      = $oJSON->_links->next->href;
            }

            //if ( $bDebug )
            //{
            //    //break;
            //}

            if ( $iLoop++ >= $iLimit )
            {
                //var_dump( 'NOUS AVONS ATTEINT LA LIMITE DE LOOPS!!!!!!!' );
                break;
            }
        }   /* while ( ! is_null( $szURL ) ) */

        return ( $aRetVal );

    }   /* End of mollie.listPayments() ============================================= */
    /* ============================================================================== */


    public function checkPaymentStatus( $szID )
    /*---------------------------------------*/
    {
        return ( $this->call( "https://api.mollie.com/v2/payments/{$szID}" ) );

        // Il pourrait être intéressant de standardiser les statuts de paiement
        // avec ce qu'en dit schema.org: https://schema.org/PaymentStatusType

    }   /* End of mollie.checkPaymentStatus() ======================================= */
    /* ============================================================================== */


    public function checkout( $oPayment )
    /*---------------------------------*/
    {
        // La doc est dispo à https://docs.mollie.com/guides/checkout
        // Il semble qu'on puisse personnaliser le checkout

        // Ici, si on a bien reçu l'endroit où il faut brancher l'exacution
        // pour effectuer le checkout, rediriger la personne vers le _links.checkout
        // de la réponse

        // ICI, STOCKER LA REPONSE DANS <unique order number>.pre.checkout
        // QUAND LE WEBHOOK EST EFFECTUE, LA REPONSE SE TROUVE DANS <unique order number>.post.checkout
        // DANS LE REDIRECT, IL FAUT COMPARER LE <unique order number>.pre.checkout ET LE
        // <unique order number>.post.checkout

        if ( isset( $oPayment->_links->checkout ) )
        {
            $this->redirect( $oPayment->_links->checkout->href );

            // Puis, c'est Mollie qui a la main et qui va, au final, appeler mon
            // webhook URL dont la réponse doit être un code 200. C'est là que je
            // sais que le paiement est // OK ou pas au final! (voir
            // https://docs.mollie.com/payments/overview ... le point n° 5:
            // Processing the webhook request your website fetches the payment status
            // using the Mollie API (https://docs.mollie.com/reference/v2/payments-api/get-payment)
            // This fetched status serves to mark the payment
            // paid, trigger fulfilment and send out an email confirmation to the
            // customer.
        }   /* if ( isset( $oMolliePayment->_links->checkout ) ) */

        return ( false );                                           /* Si on arrive ici, c'est que c'est pas bon ! */

    }   /* End of mollie.chekcout() ================================================= */
    /* ============================================================================== */
}   /* End of class mollie ========================================================== */
?>