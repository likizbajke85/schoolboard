<?php
class CSM {

	public function calculatePass(array $grades) {

		$sum = 0;
		foreach ($grades as $grade) {
			 $sum+= $grade['grade'];
		}

		if ( $sum/count($grades) >= 7 ) {

			return 'pass';
		} else {
			return 'fail';
		}
	} 

}