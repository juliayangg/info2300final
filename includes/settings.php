<?php
	$fields = array(
        array( 
			'term' => 'File_Path',
			'heading' => 'Images',
			'filter' => FILTER_SANITIZE_STRING
		),
        array( 
			'term' => 'Title',
			'heading' => 'Title',
			'filter' => FILTER_SANITIZE_STRING,
		),

		array( 
			'term' => 'Year',
			'heading' => 'Year',
			'filter' => FILTER_SANITIZE_NUMBER_INT,
		),
        array( 
			'term' => 'Photographer',
			'heading' => 'Photographer',
			'filter' => FILTER_SANITIZE_STRING,
		),
        array( 
			'term' => 'Credit',
			'heading' => 'Credit',
			'filter' => FILTER_SANITIZE_STRING,
		),
        array( 
			'term' => 'Description',
			'heading' => 'Description',
			'filter' => FILTER_SANITIZE_STRING,
		),
	);

?>