<?php
class CSM {

	public function calculatePass($grades) {

		$sum = 0;

		if (count($grades) > 0) {
			
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

}