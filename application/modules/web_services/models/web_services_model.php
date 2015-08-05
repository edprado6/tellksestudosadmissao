<?php

class Web_service_model extends CI_Model {
    
	function __construct() {
		parent::__construct();
        
        ini_set("soap.wsdl_cache_enabled", "0");		
		// URL do webservice.
		$this->SoapCliente = new SoapClient("http://www.sistemawebexlog.com.br/ligmoto/wsmonitoramento.asmx?wsdl");
	}
    
    /**
     * Acessa o WS da LigMoto, recebendo as cidades atendidas e montando-as em um dropdown.
     * 
     * @param array $parametros
     * @return type
     */
    function select_cities($parametros)
    {
        $response = $this->SoapCliente->ListaCidade($parametros);	    
        
        $response = json_decode(json_encode((array) simplexml_load_string($response->ListaCidadeResult->any)), 1); 
       
        $select = array(
				0 => ' Selecione '
		);
        
        foreach ($response as $resp)
        {          
            foreach ($resp['Tabela'] as $campo)
            {
               $city = preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $campo['cidade']));
               //$city = preg_replace("[^a-zA-Z0-9_]", "", strtr($city, "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ", "aaaaeeiooouucAAAAEEIOOOUUC"));
               $city = strtoupper($city);                
               $select[$campo['idcidade']] = $city;               
            }            
        } 
        
        return $select;
    }
    
    /**
     * Acessa o WS da LigMoto, recebendo as modalidades de serviço.
     * 
     * @param array $parametros
     */
    function select_modalities($parametros)
    {
        $response = $this->SoapCliente->ListaTabelaPreco($parametros);	    
        
        $response = json_decode(json_encode((array) simplexml_load_string($response->ListaTabelaPrecoResult->any)), 1); 
        
        $select = array(
				0 => ' Selecione '
		);
        
        foreach ($response as $resp)
        {    
            foreach ($resp['Tabela'] as $campo)
            {
                $select[$campo['idmodalidade_preco']] = $campo['nome'];  
            }    
        } 
        
        return $select;
    }
    
    /**
     * Acessa o WS da LigMoto, recebendo lista de clientes e montando um select.
     * 
     * @param array $parametros
     * @return type
     */
    function select_clients($parametros)
    {
       $response = $this->SoapCliente->ListaCliente($parametros);	    
        
        $response = json_decode(json_encode((array) simplexml_load_string($response->ListaClienteResult->any)), 1); 
        
       $select = array(
				0 => ' Selecione '
		);
        
        foreach ($response as $resp)
        {              
            $select[$resp['Tabela']['idCliente']] = $resp['Tabela']['NomeCliente'];  
        } 
        
        return $select;
    }
    

}