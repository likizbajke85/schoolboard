<?php
include('./dbclass.php');
include('./CSM.php');

class StudentService {
	
	function getReport($student_id) {
		try 
		{
		  $dbclass = new DBClass();
		  $connection = $dbclass->getconnection();
		  $student = ("SELECT * FROM student s LEFT JOIN Board b ON s.board_id = b.id WHERE s.id = ". $student_id);
		  $stmt_student = $connection->prepare($student);
		  $result = $stmt_student->execute();
		  $db_student_result = $stmt_student->fetchAll();
		  $grades = ("SELECT * FROM grades WHERE student_id = " . $student_id);
		  $stmt_grades = $connection->prepare($grades);
		  $result2 = $stmt_grades->execute();
		  $db_grades_result = $stmt_grades->fetchAll();

		  $CSM = new CSM;
		  $grades_result = $CSM->calculatePass($db_grades_result);
		 
		  return $this->generateReport($db_student_result,$db_grades_result,$grades_result);

		}
		catch(PDOException $e)
		{
		    echo $e->getMessage();
		}
	}

	public function generateReport($db_student_result, $db_grades_result, $grades_result) {
		
		$student_id = null;
		$student_name = null;
		$grades = [];
		foreach ($db_student_result as $db_res) {
			$student_id = $db_res['id'];
			$student_name = $db_res['name'];
		}
		foreach ($db_grades_result as $db_res2) {
			$grades[] = $db_res2['grade'];
		}

		$grades = array_filter($grades);
		$average = array_sum($grades)/count($grades);

		return [
			'student_id' => $student_id,
			'student_name' => $student_name,
			'grades' => $grades,
			'average' => $average,
			 'grades_result' => $grades_result
			];
		
	}
}