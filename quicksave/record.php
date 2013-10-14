

<?php
class Record {
	private $id;
	private $user_info_id;
	private $category_circle;
	private $category_1;
	private $category_2;
	private $category_3;
	private $category_4;
	private $category_5;
	private $category_6;
	private $user_thoughts;
	private $user_date;
	

	public function __construct($user_info_id, $category_circle, $category_1, $category_2, $category_3, $category_4, $category_5, $category_6){
		$this->user_info_id = $user_info_id;
		$this->category_circle = $category_circle;
		$this->category_1 = $category_1;
		$this->category_2 = $category_2;
		$this->category_3 = $category_3;
		$this->category_4 = $category_4;
		$this->category_5 = $category_5;
		$this->category_6 = $category_6;
	}
	
	public function __get($property){
		$method = "get$property";
		if (method_exists($this, $method))
		return $this->$method();
		return $this->$property;
	}
	
	public function __set($property, $value){
		$method = "set$property";
		if (method_exists($this, $method))
		$this->$method($value);
		$this->$property = $value;
	}
	
	public function getRecordArray(){
		return array('user_info_id' => $this->user_info_id ,
				      'category_circle' =>$this->category_circle ,
				      'category_1' => $this->category_1 ,
				      'category_2' => $this->category_2 ,
				      'category_3' => $this->category_3 ,
				      'category_4' => $this->category_4 ,
				      'category_5' => $this->category_5 ,
				      'category_6' => $this->category_6 );
	}

}




class xmlUtil{

	
	 static function saveAsXml($recordArray, $filename){
		$xmlWriter = new XMLWriter();
  		$xmlWriter->openUri('php://output');
 		$xmlWriter->setIndent(true);
		if($xmlWriter){
			$xmlWriter->openMemory();
			$xmlWriter->setIndent(true);
	        //$xmlWriter->startDocument('1.0','UTF-8');
		        $xmlWriter->startElement('records');  
		      		foreach($recordArray['solution'] as $key => $value){
		      			
			      		$xmlWriter->startElement('solution');
				        	$xmlWriter->startElement('user_info_id');
				        	$xmlWriter->text($value['user_info_id']);
				        	$xmlWriter->endElement();
				        	
				        	$xmlWriter->startElement('category_circle');
				        	$xmlWriter->text($value['category_circle']);
				        	$xmlWriter->endElement();
				        	
				        	$xmlWriter->startElement('category_1');
				        	$xmlWriter->text($value['category_1']);
				        	$xmlWriter->endElement();
				        	
				        	$xmlWriter->startElement('category_2');
				        	$xmlWriter->text($value['category_2']);
				        	$xmlWriter->endElement();
				        	
				        	$xmlWriter->startElement('category_3');
				        	$xmlWriter->text($value['category_3']);
				        	$xmlWriter->endElement();
				        	
				        	$xmlWriter->startElement('category_4');
				        	$xmlWriter->text($value['category_4']);
				        	$xmlWriter->endElement();
				        	
				        	$xmlWriter->startElement('category_5');
				        	$xmlWriter->text($value['category_5']);
				        	$xmlWriter->endElement();
				        	
				        	$xmlWriter->startElement('category_6');
				        	$xmlWriter->text($value['category_6']);
				        	$xmlWriter->endElement();
					$xmlWriter->endElement();
		    
		      	}

			   
		        $xmlWriter->endElement();
	        //$xmlWriter->endDocument();  
	        $xmlToWrite = $xmlWriter->outputMemory(true);
	        file_put_contents($filename,$xmlToWrite);
	        
	    }
	}



	static function objectsIntoArray($arrObjData, $arrSkipIndices = array())
	{
	    $arrData = array();
	    
	    // if input is object, convert into array
	    if (is_object($arrObjData)) {
	        $arrObjData = get_object_vars($arrObjData);
	    }
	    
	    if (is_array($arrObjData)) {
	        foreach ($arrObjData as $index => $value) {
	            if (is_object($value) || is_array($value)) {
	                $value = self::objectsIntoArray($value, $arrSkipIndices); // recursive call
	            }
	            if (in_array($index, $arrSkipIndices)) {
	                continue;
	            }
	            $arrData[$index] = $value;
	        }
	    }
	    return $arrData;
	}
	
	static function readXml($filename){
		if (!file_exists($filename)) return false; 
		$xmlStr = file_get_contents($filename);
		if (strlen($xmlStr)<100) return false; 
		$xmlObj = simplexml_load_string($xmlStr);
		$arrXml = self::objectsIntoArray($xmlObj);
		return $arrXml;
	}
	static function save($filename, $record, $where){
		$xmlContents = self::readXml($filename);
		if($xmlContents==false && count($xmlContents)!=3){
			//没有文件 开始创建文件,并写入数据 要用到RecordToArray?!
				$solution = array('user_info_id' => 0 ,
				      'category_circle' =>0 ,
				      'category_1' => 0 ,
				      'category_2' => 0 ,
				      'category_3' => 0 ,
				      'category_4' => 0 ,
				      'category_5' => 0 ,
				      'category_6' => 0 );
				$records['solution'] = array($solution,$solution,$solution);
				$xmlContents=$records;
			
		}else{
			//存在,看要存在第几个
			switch ($where) {
			    case 0:
			        $xmlContents['solution'][$where]=$record;
			        break;
			    case 1:
			        $xmlContents['solution'][$where]=$record;
			        break;
			    case 2:
			        $xmlContents['solution'][$where]=$record;
			        break;
			}
		
		}
		
		self::saveAsXml($xmlContents, $filename);

	}


}
?>