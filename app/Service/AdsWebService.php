<?php

namespace App\Service;

use SoapClient;
use Illuminate\Support\Facades\Log;

class AdsWebService
{
    private $client;

    public function __construct()
    {
        // $this->_client(null);
        $this->client = null;
    }

    private function _client()
    {
        $opts = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ),
            'http' => array(
                'user_agent' => 'PHPSoapClient'
            )
        );

        $context = stream_context_create($opts);
        $wsdl = "http://193.219.96.244:8100/wsa/wsa1/wsdl?targetURI=urn:registros";



        try {
            // $this->client = new SoapClient(
            //     $wsdl,
            //     array(
            //         'stream_context' => $context,
            //         'cache_wsdl' => WSDL_CACHE_MEMORY,
            //         // 'connection_timeout'  => 5,
            //         'encoding' => 'UTF-8'
            //     )
            // );

            libxml_disable_entity_loader(false);
            $client = new soapclient(
                'http://193.219.96.244:8100/wsa/wsa1/wsdl?targetURI=urn:registros',
                //"http://www.holidaywebservice.com//HolidayService_v2/HolidayService2.asmx?wsdl",
                $options
            );
            //$this->client = $client;
            return $client;
        } catch (SoapFault $fault) {
            //trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})");
            echo $fault->faultstring;
            exit();
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit();
            //Log::info('Caught Exception in client' . $e->getMessage());
        }
    }
    public function getRecordCount($parameter)
    {
        $options = array(
            'cache_wsdl' => 0,
            'trace' => 1,
            'soapVersion' => SOAP_1_2,
            'encoding' => 'UTF-8',
            'verifypeer' => false,
            'verifyhost' => false,
            'cache_wsdl' => WSDL_CACHE_MEMORY,
            'connection_timeout'  => 1,
            'stream_context' => stream_context_create(array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ),

            ))
        );
        try {
            //libxml_disable_entity_loader(false);
            $client = new soapclient(
                'http://193.219.96.244:8100/wsa/wsa1/wsdl?targetURI=urn:registros',
                //"http://www.holidaywebservice.com//HolidayService_v2/HolidayService2.asmx?wsdl",
                $options
            );

            $result = $client->ContarRegistros();

            //    $xy = $client->__getFunctions();
            //echo 'REQUEST-->';
            //var_dump($client->__getLastRequestHeaders());
            // foreach ($xy as $indice => $valor) {
            //     $nomFunction = substr($valor, strpos($valor, "(") + 1, (strpos($valor, "$") - strpos($valor, "(")) - 1);
            //     $nomFunction = trim($nomFunction);
            //     echo "<option>$nomFunction</option>";
            // }
            //  print_r($client->sdl);
            //  $client->ContarRegistros();
            //var_dump($client->__getLastRequest());
            //print_r($parameter);
            //echo "<pre>";
            //print_r($result);
            //echo "</pre>";

            //exit();
            return $result;
        } catch (SoapFault $fault) {

            echo "soap error------------" . $client->__getLastRequest();
            echo "-----------" . $fault->faultstring;
            exit();
        } catch (\Exception $e) {
            echo "Error ----------" . $e->getMessage();
            exit();
            //Log::info('Caught Exception in client' . $e->getMessage());
        }

        //$this->cleantmp();
        // $client = $this->_client(null);
        // $functions = $this->client->__getFunctions();
        // $str = '';
        // foreach ($functions as $indice => $valor) {
        //     $nomFunction = substr($valor, strpos($valor, "(") + 1, (strpos($valor, "$") - strpos($valor, "(")) - 1);
        //     $nomFunction = trim($nomFunction);
        //     //echo "<option>$nomFunction</option>";
        //     $str .= $nomFunction;
        //     $this->showParameters($valor);
        // }
        // return $str;
    }

    public function showParameters($function)
    {
        $xy = $this->client->__getTypes();
        var_dump($xy);
        exit();
        $result = '';
        foreach ($xy as $indice => $valor) {
            if (strstr($valor, " " . $function . " ")) {
                $subtxt = strstr($valor, $function);
                $x = 1;
                foreach (explode(" ", $subtxt) as $index => $value) {
                    if (strstr($value, ";")) {
                        $texto = substr($value, 0, strpos($value, ";"));
                        $valor = "parameterValue" . $x;
                        $x++;
                        $result .= $texto;
                    }
                }
            }
        }
        echo $result;
        exit();
    }

    function cleantmp()
    {
        $directory = "/tmp";
        if (!$dirhandle = opendir($directory)) {
            return false;
        }
        while (false !== ($filename = readdir($dirhandle))) {
            if ($filename != "." && $filename != "..") {
                $filename = $directory . "/" . $filename;
                if (eregi("wsdl-", $filename)) {
                    unlink($filename);
                }
            }
        }
        return true;
    }

    // public function getCurrency($params)
    // {
    //     $this->client = $this->_client($params['config']);

    //     try {
    //         $result = $this->client->Currency($params);
    //         return $result;
    //     } catch (\Exception $e) {
    //         Log::info('Caught Exception :' . $e->getMessage());
    //         return $e;       // just re-throw it
    //     }
    // }
}