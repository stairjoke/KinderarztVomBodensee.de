<?php
	// Videos page-type Controller — Der Kinderarzt vom Bodensee
	
	// Der Controller erstellt ein Array von Listen ('Collection') für die Buchstaben A-Z,
	// jede liste enthält die Videos des Buchstabens in alphabetischer Reihenfolge.
	
	// Der Haken: Videos sollten unter mehreren Buchstaben auftauchen und enthalten deshalb
	// mehrere Schlagworte im Feld "Buchstaben".
	
	return function($page){
		
// —1— Generate an array for all videos including duplicates based on title and field "Buchstabe"

		// Leeres Array für die Listen
		$alphabetical = [];
		
		// Liste aller Unterseiten vom Typ Video alphabetisch sortiert
		$videos = $page->children()->filterBy(function ($child) {
			return $child->intendedTemplate()->name() == "video";
		});
		
		// Helper function to add pages to a colleciton and sort special chars into their counterpart normal ones
		function addToAlphabeticalCollection($alphabeticalCollection, $field_buchstabe, $page_video, $isBuchstabe = false){
			// Only use the first letter of the string given in $letter and always use upper case
			$letter = strtoupper(mb_substr($field_buchstabe, 0, 1));
			
			// Test if the letter is valid ASCII
			if(mb_detect_encoding($letter, 'ASCII', true) != 'ASCII') {
				
				// If the letter is not a valid ASCII character manually sort it.
				// `iconv` does not work reliably.
				if (preg_match('/^\Ä/', $letter)) {
					$letter = 'A';
				}else if (preg_match('/^\Ö/', $letter)) {
					$letter = 'O';
				}
				else if (preg_match('/^\Ü/', $letter)) {
					$letter = 'U';
				}else{
					$letter = '#';
				}
			}
			
			echo($letter . '<br>');
			
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
				}
			}
			
			// Use the video title in addition to the "Buchstaben" field
			// If the video title starts with der, die, or das, remove it
			$letter = str_replace(['der ', 'die ', 'das '], '', strtolower($video->title()));
			$alphabetical = addToAlphabeticalCollection($alphabetical, $letter, $video);
		}
		
// —2— Sort the array of pages alphabetically

		// Sort the array of letters containing arrays of videos naturally like a human would
		ksort($alphabetical, SORT_NATURAL);
		
		function sortLetter($a, $b){
			// Helper-Function for sorting.
			// Uses title or if available altTitle to return -1, 0, or +1
			if(isset($a['altTitle'])) {
				$a = $a['altTitle'];
			}else{
				$a = $a['video']->title();
			}
			
			if(isset($b['altTitle'])) {
				$b = $b['altTitle'];
			}else{
				$b = $b['video']->title();
			}
			
			return strcmp($a, $b);
		}
		
		foreach($alphabetical as $letter) {
			usort($letter, "sortLetter");
		}
		
		return [
			'alphabetical' => $alphabetical
		];
	}
?>