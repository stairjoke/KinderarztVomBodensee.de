<?php
	// Videos page-type Controller — Der Kinderarzt vom Bodensee
	
	// Der Controller erstellt ein Array von Listen ('Collection') für die Buchstaben A-Z,
	// jede liste enthält die Videos des Buchstabens in alphabetischer Reihenfolge.
	
	// Der Haken: Videos sollten unter mehreren Buchstaben auftauchen und enthalten deshalb
	// mehrere Schlagworte im Feld "Buchstaben".
	
	return function($page){
		
// —1— Generate an array for all videos including duplicates based on title and field "Buchstabe"

		// Empty arrays for alphabetically sorted videos and columns to establish scope
		$alphabetical = [];
		$numberOfVideos = 0;
		
		// Liste aller Unterseiten vom Typ Video alphabetisch sortiert
		$videos = $page->children()->filterBy(function ($child) {
			return $child->intendedTemplate()->name() == "video";
		});
		
		// Helper function to add pages to a colleciton and sort special chars into their counterpart normal ones
		function addToAlphabeticalCollection($alphabeticalCollection, $field_buchstabe, $page_video, $isBuchstabe = false){
			// Only use the first letter of the string given in $letter and always use upper case
			$letter = mb_strtoupper(mb_substr($field_buchstabe, 0, 1, 'UTF-8'), 'UTF-8');

			switch($letter) {
				case "Ä":
					$letter = "A";
				break;
				case "Ö":
					$letter = "O";
				break;
				case "Ü":
					$letter = "U";
				break;
				case mb_ereg_match('/[^A-Z]/', $letter):
					$letter = "#";
				break;
			}
			
			// Test if this letter is already in use, otherwise create a new empty array for this letter
			$alphabeticalCollection[$letter] = (isset($alphabeticalCollection[$letter])) ? $alphabeticalCollection[$letter] : [];
			
			// Find a unique ID for the video — use the array length to always add to the end of the array
			$videoID = count($alphabeticalCollection[$letter]);
			
			// Save the video-page to the array at the ID position
			$alphabeticalCollection[$letter][$videoID]['video'] = $page_video;
			
			// If the Letter the video is sorted into comes from a key-word in the field Buchstabe,
			// add an altTitle field to the video-array
			if($isBuchstabe == true) {
				$alphabeticalCollection[$letter][$videoID]['altTitle'] = '<span class=glossary-letter>'. $field_buchstabe .':</span>&nbsp;' . $page_video->title();
			}
			
			return $alphabeticalCollection;
		}
		
		// Sort the videos into alphabetical order and duplicate them if necessary
		foreach($videos as $video){
			
			if($video->Buchstaben()->isNotEmpty()){ //Buchstaben = name of the field, German for 'letters'
				
				// If the current video uses the 'Buchstaben' field, iterate through that field
				$letters = mb_split('(\, )', $video->Buchstaben());
				foreach($letters as $letter) {
					$alphabetical = addToAlphabeticalCollection($alphabetical, $letter, $video, true);
					$numberOfVideos++;
				}
			}

			if(!$video->glossarHide()->toBool()){
				// Use the video title in addition to the "Buchstaben" field
				// If the video title starts with der, die, or das, remove it
				$replace = '^(Der \b)|^(Die \b)|^(Das \b)|^(Wie den \b)|^(Was ist \b)|^(Was sind \b)|^(\")|^(^\„)|^(^\“)';
				$letter = mb_ereg_replace($replace, '', $video->title());
				
				$alphabetical = addToAlphabeticalCollection($alphabetical, $letter, $video);
				$numberOfVideos++;
			}
		}
		
// —2— Sort the array of pages alphabetically

		// Sort the array of letters containing arrays of videos naturally like a human would
		ksort($alphabetical, SORT_NATURAL);
		
		function sortLetterArrayOfVideoPages($a, $b){
			
			// Helper-Function for sorting.
			// Uses title or if available altTitle to return -1, 0, or +1
			if(isset($a['altTitle'])) {
				$a = mb_strtoupper($a['altTitle'], 'UTF-8');
			}else{
				$a = mb_strtoupper($a['video']->title(), 'UTF-8');
			}
			
			if(isset($b['altTitle'])) {
				$b = mb_strtoupper($b['altTitle'], 'UTF-8');
			}else{
				$b = mb_strtoupper($b['video']->title(), 'UTF-8');
			}
			// Filter sort to remove quotation marks and spans
			$replace = '(^<SPAN[A-Z0-9 =_"\-]*>)|(["„“\ ])';
			$a = mb_ereg_replace($replace, '', $a);
			$b = mb_ereg_replace($replace, '', $b);
			
			$replace = '(\:<\/SPAN>&NBSP;)';
			$a = mb_ereg_replace($replace, '', $a);
			$b = mb_ereg_replace($replace, '', $b);
			
			$a = mb_substr($a, 0, 10, 'UTF-8');
			$b = mb_substr($b, 0, 10, 'UTF-8');
			
			//echo '<pre>' . $a . '</pre> ' . strcmp($a, $b) . ' <pre>' . $b . '</pre><br>';
			return strcmp($a, $b);
		}
		
		foreach($alphabetical as $key => $letterArrayOfVideoPages) {
			// Sort
			usort($letterArrayOfVideoPages, "sortLetterArrayOfVideoPages");
			
			// Save
			$alphabetical[$key] = $letterArrayOfVideoPages;
		}
		

		
		return [
			'alphabetical' => $alphabetical,
			'numberOfVideos' => $numberOfVideos
		];
	}
?>