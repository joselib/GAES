<?php
    namespace app\models;
    use \PDO;
    
    if(file_exists(__DIR__."/../../config/server.php")){
		require_once __DIR__."/../../config/server.php";
	}


    class mainModel{

		private $server=DB_SERVER;
		private $db=DB_NAME;
		private $user=DB_USER;
		private $pass=DB_PASS;


        		/*----------Function  conect to  BBDD ----------*/
		protected function conect(){
			$conection = new PDO("mysql:host=".$this->server.";dbname=".$this->db,$this->user,$this->pass);
			$conection->exec("SET CHARACTER SET utf8");
			return $conection;
		}

        		/*---------- Function  exec consultation  ----------*/
		protected function executeConsultation($consultation, $params = []) {
    		$sql = $this->conect()->prepare($consultation);
    		$sql->execute($params);
    		return $sql;
		}
        		/*----------  Function clear chain  ----------*/
		public function cleanChain($chain){

			$words=["<script>","</script>","<script src","<script type=","SELECT * FROM","SELECT "," SELECT ","DELETE FROM","INSERT INTO","DROP TABLE","DROP DATABASE","TRUNCATE TABLE","SHOW TABLES","SHOW DATABASES","<?php","?>","--","^","<",">","==","=",";","::"];

			$chain=trim($chain);
			$chain=stripslashes($chain);

			foreach($words as $word){
				$chain=str_ireplace($word, "", $chain);
			}

			$chain=trim($chain);
			$chain=stripslashes($chain);

			return $chain;
		}

        		/*---------- Verify Data Function (Regular Expression) ----------*/
		protected function verifyData($filtro,$chain){
			if(preg_match("/^".$filtro."$/", $chain)){
				return false;
            }else{
                return true;
            }
		}


		/*----------  Function to execute a prepared INSERT query  ----------*/
		protected function saveData($table, $data) {
    		try {
       			$query = "INSERT INTO $table (" . implode(',', array_column($data, 'name_field')) . ") VALUES (" . implode(',', array_column($data, 'marker_field')) . ")";
        		$sql = $this->conect()->prepare($query);
        		foreach ($data as $key) {
            		$sql->bindParam($key["marker_field"], $key["value_field"]);
        		}
        		$sql->execute();
        		return $sql;
    		} catch (PDOException $e) {
        // Log the error
        		error_log("Error en saveData: " . $e->getMessage());
        		return false;
    		}
		}

        		/*---------- Select data function ----------*/
public function selectData($type, $table, $field, $id){
    $type = $this->cleanChain($type);
    $table = $this->cleanChain($table);
    $field = $this->cleanChain($field);
    $id = $this->cleanChain($id);

    if($type == "Only"){
        $sql = $this->conect()->prepare("SELECT * FROM $table WHERE $field = :ID");
        $sql->bindParam(":ID", $id);
    } elseif($type == "Normal"){
        $sql = $this->conect()->prepare("SELECT $field FROM $table");
    }
    $sql->execute();

    return $sql;
}
        		/*----------  Function to execute a prepared UPDATE query   ----------*/
protected function updateData($table, $data, $condition) {
        $query = "UPDATE $table SET ";

        $C = 0;
        foreach ($data as $key) {
            if ($C >= 1) { $query .= ","; }
            $query .= $key["name_field"] . "=:" . $key["name_field"];
            $C++;
        }

        $query .= " WHERE " . $condition["field_condition"] . "=:condition_value";

        $sql = $this->conect()->prepare($query);

        foreach ($data as $key) {
        $sql->bindValue(":" . $key["name_field"], $key["value_field"]);
    }

    $sql->bindValue(":condition_value", $condition["condition_value"]);

    $sql->execute();

    return $sql;
		}
        		/*---------- Delete record function ----------*/
        protected function deleteRegister($table,$field,$id){
            $sql=$this->conectar()->prepare("DELETE FROM $tabla WHERE = ?", [$id]);
            $sql->bindParam(":id",$id);
            $sql->execute();
            
            return $sql;
        }

/*---------- Table pager ----------*/
        protected function pagerTables($page, $totalPages, $url, $buttons) {
             $table = '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">';

             if ($page <= 1) {
                 $table .= '
              <li class="page-item disabled">
                   <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
               </li>';
             } else {
                    $table .= '
                    <li class="page-item">
                     <a class="page-link" href="' . $url . ($page - 1) . '/">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="' . $url . '1/">1</a></li>
                    <li class="page-item disabled"><span class="page-link">...</span></li>';
                 }

                 $ci = 0;
                for ($i = $page; $i <= $totalPages; $i++) {
                    
                    if ($ci >= $buttons) {

                    break;

                    }

                    if ($page == $i) {
                        $table .= '<li class="page-item active" aria-current="page"><a class="page-link" href="' . $url . $i . '/">' . $i . '</a></li>';
                     } else {
                        $table .= '<li class="page-item"><a class="page-link" href="' . $url . $i . '/">' . $i . '</a></li>';
                    }

                    $ci++;
                 }

                 if ($page == $totalPages) {
                    $table .= '
                    <li class="page-item disabled">
                         <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Next</a>
                    </li>';
                 } else {
                    $table .= '
                    <li class="page-item disabled"><span class="page-link">...</span></li>
                    <li class="page-item"><a class="page-link" href="' . $url . $totalPages . '/">' . $totalPages . '</a></li>
                    <li class="page-item">
                    <a class="page-link" href="' . $url . ($page + 1) . '/">Next</a>
                    </li>';
                 }

            $table .= '</ul></nav>';
             return $table;
        }
    }