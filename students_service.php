<?php
include('./dbclass.php');
include('./CSM.php');
include('./CSMB.php');

class StudentService {
	
	function getReport($student_id) {
		
		try {

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

		  
		  if ($db_student_result[0]['which'] === 'CSM') {
			  
			  $CSM = new CSM;

			  $grades_result = $CSM->calculatePass($db_grades_result);

			  if ($db_student_result[0]['return_type'] === 'json') {

			  return json_encode($this->generateReport($db_student_result,$db_grades_result,$grades_result));

			  } else {

			  	return $this->generateReport($db_student_result,$db_grades_result,$grades_result);
			  
			  }

		  } else if ($db_student_result[0]['which'] === 'CSMB') {

              $CSMB = new CSMB;

			  $grades_result = $CSMB->calculatePass($db_grades_result);

			  if ($db_student_result[0]['return_type'] === 'xml') {
			  
			  
			  $response_for_xml = $this->generateReport($db_student_result, $db_grades_result, $grades_result);

			  //todo for now return json

			  return json_encode($this->generateReport($db_student_result, $db_grades_result, $grades_result));

			  } else {
			  	return $this->generateReport($db_student_result,$db_grades_result,$grades_result);
			  }
		  }


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
		$grade_name = [];
		
		foreach ($db_student_result as $db_res) {
			$student_id = $db_res['id'];
			$student_name = $db_res['name'];
		}
		foreach ($db_grades_result as $db_res2) {
			$grades[] = $db_res2['grade'];
			$grade_name[] = $db_res2['subject_name'];
		}

		$grades = array_filter($grades);
		if (count($grades) > 0 ) {

			$average = array_sum($grades)/count($grades);
			$display_grades = array_combine($grade_name, $grades);

		} else {

			$display_grades = 'no grades for student';
			$average = 'no grades so no average';
		}

		return [
			'student_id' => $student_id,
			'student_name' => $student_name,
			'grades' => $display_grades,	
			'average' => $average,
			 'grades_result' => $grades_result
			];
		
	}
}