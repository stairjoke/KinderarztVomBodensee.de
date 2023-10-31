<?php
	// Videos page-type Controller — Der Kinderarzt vom Bodensee
	
	// Der Controller erstellt ein Array von Listen ('Collection') für die Buchstaben A-Z,
	// jede liste enthält die Videos des Buchstabens in alphabetischer Reihenfolge.
	
	// Der Haken: Videos sollten unter mehreren Buchstaben auftauchen und enthalten deshalb
	// mehrere Schlagworte im Feld "Buchstaben".
	
	return function($page){
		// Leeres Array für die Listen
		$alphabetical = [];
		
		// Liste aller Unterseiten vom Typ Video alphabetisch sortiert
		$videos = $page->children()->filterBy(function ($child) {
			return $child->intendedTemplate()->name() == "video";
		});
		
		// Helper function to add pages to a colleciton and sort special chars into their counterpart normal ones
		function addToAlphabeticalCollection($alphabeticalCollection, $field_buchstabe, $page_video){
			// Only use the first letter of the string given in $letter
			$letter = mb_substr($field_buchstabe, 0, 1);
			
			// Convert the letter into a supported ACII character
			$letter = iconv('UTF-8', 'ASCII//IGNORE', $letter); // Converts special characters such as ñ and ä into 'normal' ones
			// iconv is sometimes buggy and adds non alphabetical characters. Example: Ü becomes "U instead of U
			// This Regex fixes that issue by filtering out anything that is not a-z or A-Z:
			$letter = preg_replace("/[^A-Za-z]/", "", $letter);
			
			// Test if the conversion found an ACII character or came up empty
			$letter = ($letter === '') ? '#' : $letter;
			
			// Test if this letter is already in use, otherwise create a new empty collection for this letter
			$alphabeticalCollection[$letter] = (isset($alphabeticalCollection[$letter])) ? $alphabeticalCollection[$letter] : new Collection;
			
			$alphabeticalCollection[$letter]->add($page_video);
			
			return $alphabeticalCollection;
		}
		
		// Sort the videos into alphabetical order and duplicate them if necessary
		foreach($videos as $video){
			
			if($video->Buchstaben()->isNotEmpty()){ //Buchstaben = name of the field, German for 'letters'
				
				// If the current video uses the 'Buchstaben' field, iterate through that field
				$letters = explode(', ', $video->Buchstaben());
				foreach($letters as $letter) {
					$alphabetical = addToAlphabeticalCollection($alphabetical, $letter, $video);
				}
			}else{
				// Does not use 'Buchstaben' -> iterate through 'title'
				$alphabetical = addToAlphabeticalCollection($alphabetical, $letter, $video);
			}
		}
		
		return [
			'alphabetical' => $alphabetical
		];
	}
?>