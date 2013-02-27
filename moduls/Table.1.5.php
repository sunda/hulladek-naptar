<?
//Name:Table
//Version:1.5
//Dependencies:;
class Table{
	private $handler="";
	private $table="";
	private $query="";
	private $error="";
	
	public function __construct($table="",$template=""){
		if($this->handler=mysql_connect(SQL_SERVER,SQL_LOGIN,SQL_PASS,TRUE)){
			if(mysql_select_db(SQL_DBNAME,$this->handler)){
				mysql_set_charset("UTF8",$this->handler);
			}else{
				$this->error(mysql_error());
			}
			if($template!="") $this->installTemplate($template);
			if($table!="")	$this->table=$table;
		}else{
			$this->error(mysql_error());	
		}
	}
	public function fetch($query=""){
		$r=Array();
		$this->query=($query!=""?$query:$this->query);
		$this->query=str_replace("&table",$this->table,$this->query);
		if(1==mysql_query($this->query,$this->handler)){
			return true;
		}
		$this->error(mysql_error());
		return false;	
	}
	
	public function get($fields,$filter="",$order=""){
		$r=Array();
		if($fields!='*') $fields=$this->getParams($fields,'`');
		$this->query="SELECT ".preg_replace('/\s+/',"",$fields)." FROM `".$this->table."`";
		if($filter!="") $this->query.=" WHERE ".$filter;
		$this->query.=" ".$order;
		if($q=mysql_query($this->query,$this->handler)){
			while($rr=mysql_fetch_assoc($q)){
				$r[]=$rr;	
			}
			return $r;
		}
		$this->error(mysql_error());
		return false;	
	}
	
	public function put($fields,$values,$sub=""){
		$this->query="INSERT INTO `".$this->table."` (".$this->getParams($fields,"`").") VALUES(".$this->getParams($values).") ".$sub;
		if(mysql_query($this->query,$this->handler)) return true;
		$this->error(mysql_error());
		return false;
	}
	public function get_auto_increment(){
		$this->query="SHOW TABLE STATUS LIKE '".$this->table."'";
		$tmp=mysql_query($this->query,$this->handler) or
		$this->error(mysql_error());
		$row=mysql_fetch_assoc($tmp);
		return $row["Auto_increment"];
	}
	//todo
	public function update($query,$filter){
		$this->query="UPDATE `".$this->table."` SET ".$query." WHERE ".$filter;
		return mysql_query($this->query,$this->handler) or
		$this->error(mysql_error());
	}
	
	public function delete($filter){
		$this->query="DELETE FROM `".$this->table."`";
		if($filter!="all") $this->query.=" WHERE ".$filter;
		return mysql_query($this->query,$this->handler) or
		$this->error(mysql_error());
	}
	//endtodo
	public function lastQuery(){
		return $this->query;
	}
	public function lastError(){
		return $this->error;
	}
	private function installTemplate($template){
		return mysql_query($template,$this->handler) or
		$this->error(mysql_error());
	}
	private function error($txt){
		$this->error=$txt;
		print $this->error;
		return false;
	}
	private function getParams($str,$qoute="'"){
	$str=explode(",",$str);
	$p="";
	foreach($str as $attr){
		if($attr!=""){
			if($p!="") $p.=',';
			$p.=$qoute.$attr.$qoute;
		}
	}
	return $p;
	}
}
?>
