<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Web_services extends MY_Controller {

	var $SoapCliente;
	
        // TempConvert
	//var $ws_url = "http://www.w3schools.com/webservices/tempconvert.asmx?WSDL";
        
        //Global Weather
        var $ws_url = "http://www.webservicex.com/globalweather.asmx?WSDL";
        
	public function __construct()
	{
            parent::__construct();
		                   
            ini_set("soap.wsdl_cache_enabled", "0");	
            
            try {
                    $this->SoapCliente = new SoapClient($this->ws_url);
            } catch (SoapFault $E) {
                    echo $E->faultstring;
            } catch (Exception $E) {
                    echo $E->faultstring;
            }
		
	}
	

        public function FahrenheitToCelsius()
        {
            $parametros = array('Fahrenheit' => 70);
				
            $response = $this->SoapCliente->FahrenheitToCelsius($parametros);	    
        
            //$response = json_decode(json_encode((array) simplexml_load_string($response->FahrenheitToCelsiusResult->any)), 1); 
       
            $select = array( 0 => ' Selecione ');
        
            foreach ($response as $r)
            {          
                $itemSelect = preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $r));               
                $itemSelect = strtoupper($r);                
                $select[$r] = $r;     
            } 
            
            var_dump($response->FahrenheitToCelsiusResult);
            var_dump($response);
            var_dump($select);
        }
        
        public function GetCitiesByCountry()
        {
            $parametros = array(
                'CountryName' => 'Brazil'
            );
				
            $response = $this->SoapCliente->GetCitiesByCountry($parametros);	    
            //$response = json_decode(json_encode((array) simplexml_load_string($response->GetCitiesByCountryResult->any)), 1); 
            //var_dump($response->GetCitiesByCountryResult);
            //var_dump($response);
            

//$client = SoapCliente($this->ws_url, $parametros);
$result = $this->SoapCliente->GetCitiesByCountry($parametros);
$result = json_decode(json_encode($result), true);
var_dump($result);
            
//            $city = preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $response));
//               //$city = preg_replace("[^a-zA-Z0-9_]", "", strtr($city, "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ", "aaaaeeiooouucAAAAEEIOOOUUC"));
//               $city = strtoupper($city);    
//               var_dump($city);
               
            $result = array();
            foreach ($response as $value) {
                $result[] = $value;
                
                
            }
//            <NewDataSet>
//  <Table>
//    <Country>
            
            echo "<pre>\n";
            //var_dump(__getLastResponse());
            echo "</pre>\n";
            
        }
}
/* End of file web_service.php */
/* Location: ./application/modules/web_service/controllers/web_service.php */