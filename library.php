<?php 
    //session_start();
    class login_register{
    	private $host, $database, $root, $password;
    	public function __construct($host, $root, $password){
    		$this->host = $host;
    		$this->root = $root;
    		$this->password = $password;
    	}
    	private function create_connection($database){
    		$conn = mysqli_connect($this->host, $this->root, $this->password, $database);
    		return $conn;
    	}
    	private function delete_connection($conn){
    		unset($conn);
    	}
    	public function verify_name($name){
    		if(empty($name)) return false;
    		$arr = str_split($name);
    		foreach($arr as $char){
    			$ascii = ord($char);
    			if(($ascii >= 65 && $ascii <= 90) || ($ascii >= 97 && $ascii <= 122) || $ascii === 32) continue;
    			else return false;
    		}
    		return true;
    	}
    	public function verify_roll($roll){
    		if(empty($roll)) return false;
    		else if(strlen($roll) != 7) return false;
    		$arr = str_split($roll);
    		foreach($arr as $char){
    			if(!is_numeric($char)) return false;
    		}
    		return true;
    	}
    	public function verify_pass($pass, $rpass){
    		if(empty($pass) || empty($rpass)) return false;
    		if(strcmp($pass, $rpass) === 0) return true;
    		else return false;
    	}
    	public function verify_email($email){
    		if(filter_var($email, FILTER_VALIDATE_EMAIL)) return true;
    		else return false;
    	}
    	public function verify_branch($roll){
    		$roll = (string)$roll;
    		$i = (int)$roll[2].$roll[3];
    		if($i >= 0 && $i <= 11) return true;
    		else return false;
    	}
    	public function get_batch($roll){
    		$str = (string)$roll;
    		$batch = (int)$str[0].$str[1];
    		return $batch;
    	}
    	public function roll_exists($roll){
    		$conn = $this->create_connection("project");
    		$query = "select * from student where sroll=$roll;";
    		$result = mysqli_query($conn, $query);
    		if(mysqli_num_rows($result) > 0) return true;
    		else return false;
    	}
    	public function check_batches($roll){
    		$conn = $this->create_connection("project");
    		$query = "select min(sroll) as mini from student;";
    		$res = mysqli_fetch_assoc(mysqli_query($conn, $query))['mini'];
    		$res = (string)$res;
    		$mini = (int)$res[0].$res[1];
    		$batch = $this->get_batch($roll);
    		if($batch-$mini > 3){
    			$d = date('d-m-y');
    			$month = $d[3].$d[4];
    			$year = $d[6].$d[7];
    			if($year >= $batch && $month >= 8){
    				$mini = (int)((string)$mini."99999");
    				$query = "delete from student where sroll<=$mini;";
    				$res = mysqli_query($conn, $query);
    				if($res) return 1;
    				else return 0;
    			}
    			else if($year < $batch) return -1;
    			else return 1;
    		}
    		else return 1;
    	}
    	public function register($name, $roll, $email, $pass, $rpass){
    		if(!$this->verify_name($name)) return 0;
    		if(!$this->verify_roll($roll)) return -1;
    		if(!$this->verify_pass($pass, $rpass)) return -2;
    		if(!$this->verify_email($email)) return -3;
    		if(!$this->verify_branch($roll)) return -4;
    		if($this->roll_exists($roll)) return -5;
    		if($this->check_batches($roll) === -1) return -6;
    		$conn = $this->create_connection("project");
    		$roll = (string)$roll;
    		$did = (int)$roll[2].$roll[3];
    		$hashpass = password_hash($pass, PASSWORD_DEFAULT);
    		$query = "insert into student values('$name', '$email', '$hashpass', $did, $roll);";
    		$res = mysqli_query($conn, $query);
    		$this->delete_connection($conn);
    		if($res) return 1;
    		else return -6;
    	}
    	public function studentLogin($roll, $pass){
    		$conn = $this->create_connection("project");
    		$query = "select * from student where sroll='$roll';";
    		$res = mysqli_query($conn, $query);
    		$row = mysqli_fetch_assoc($res);
    		$this->delete_connection($conn);
    		if(password_verify($pass, $row['spassword'])){
    			return 1;
    		}
    		else return 0;
       	}
    }

    class dashboard{
    	private $host, $database, $root, $password;
    	public function __construct($host, $root, $password){
    		$this->host = $host;
    		$this->root = $root;
    		$this->password = $password;
    	}
    	private function create_connection($database){
    		$conn = mysqli_connect($this->host, $this->root, $this->password, $database);
    		return $conn;
    	}
    	private function delete_connection($conn){
    		unset($conn);
    	}
    	public function get_departments(){
    		$conn = $this->create_connection("project");
    		$query = "select * from department;";
    		$res = mysqli_query($conn, $query);
    		$arr = array();
    		while($row = mysqli_fetch_assoc($res)){
    			array_push($arr, $row);
    		}
    		return $arr;
    	}
    	public function get_batches($did){
            $conn = $this->create_connection("project");
            $query = "select * from student where did=$did;";
            $res = mysqli_query($conn, $query);
            $arr = array();
            while($row = mysqli_fetch_assoc($res)){
                $roll = (string)$row['sroll'];
                $sroll = (int)($roll[0].$roll[1]);
                if(!in_array($sroll, $arr)){
                    array_push($arr, $sroll);
                }
            }
            return $arr;
    	}
    	public function get_students($branch, $batch){
            $conn = $this->create_connection("project");
            $query = "select * from student where did=$branch order by sroll;";
            $res = mysqli_query($conn, $query);
            $arr = array();
            while($row = mysqli_fetch_assoc($res)){
                $roll = (string)$row['sroll'];
                $sroll = (int)($roll[0].$roll[1]);
                if($sroll === $batch){
                    array_push($arr, $row);
                }
            }
            return $arr;
    	}
    	public function get_student_details($roll){
    		$conn = $this->create_connection("project");
    		$query = "select * from student where sroll=$roll;";
    		$res = mysqli_query($conn, $query);
    		$row = mysqli_fetch_assoc($res);
    		return $row;
    	}
    	public function update_student_details($roll, $old_roll, $name, $email, $pass, $rpass){
    		$object = new login_register("localhost", "root", "toor");
    		if($roll !== $old_roll){
    			if($object->roll_exists($roll)) return -1;
    			if(!$object->verify_branch($roll)) return -5;
    			if($object->check_batches($roll) === -1) return 0;
    		}
    		if(!$object->verify_email($email)) return -2;
    		// if(!$object->verify_pass($pass, $rpass)) return -3;
    		if(!$object->verify_name($name)) return -4;
    		if(!$object->studentLogin($old_roll, $pass)) return -6;
    		$str = (string)$roll;
    		$did = (int)$roll[2].$roll[3];
    		$conn = $this->create_connection("project");
    		$query = "update student set sroll=$roll, sname='$name', semail='$email', did=$did where sroll=$old_roll;";
    		$res = mysqli_query($conn, $query);
    		if($res) return 1;
    		else return 0;
    	}
    	public function update_password($roll, $npass, $opass){
    		// if(strcmp($npass, $opass) === 0) return 1;
    		$object = new login_register("localhost", "root", "toor");
    		if($object->studentLogin($roll, $opass) === 0) return -1;
    		$conn = $this->create_connection("project");
    		$hashpass = password_hash($npass, PASSWORD_DEFAULT);
    		$query = "update student set spassword='$hashpass' where sroll=$roll;";
    		$res = mysqli_query($conn, $query);
    		if($res) return 1;
    		else return 0;
		}
		
		public function get_department_using_did($did){
			$conn = $this->create_connection("project");
			$query = "select * from department where did=$did;";
			$res = mysqli_query($conn, $query);
			$row = mysqli_fetch_assoc($res);
			$this->delete_connection($conn);
			return $row['dname'];
		}
	}
    
 ?>