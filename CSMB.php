<?php
class CSMB {

	public function calculatePass(array $grades) {

		
		$just_grades = [];
		if (count($grades) > 0){

			foreach ($grades as $grade) {
				$just_grades[]  = $grade['grade'];
			}
			
			$lowest_grade = min($just_grades);
			
			if(($lowest_grade = array_search($lowest_grade,$just_grades)) !== false && count($just_grades) > 2) {
	       		unset($just_grades[$lowest_grade]);
	  		}

			if ( max($just_grades) > 8 ) {

				return 'pass';
			} else {
				return 'fail';
			}
		}
	} 

}