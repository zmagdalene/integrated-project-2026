<?php
require_once './lib/config.php';
require_once './lib/global.php';
require_once './lib/session.php';

startSession();

try {
    // Initialize form data array
    $data = [];
    // Initialize errors array
    $errors = [];

    // Check if request is POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    // Get form data
    $data = [
        'name' => $_POST['name'] ?? null,
    ];

    // Define validation rules
    $rules = [
        'name' => 'required|notempty|min:3|max:30',
    ];

    // Validate all data (including file)
    $validator = new Validator($data, $rules);

    if ($validator->fails()) {
        // Get first error for each field
        foreach ($validator->errors() as $field => $fieldErrors) {
            $errors[$field] = $fieldErrors[0];
        }

        throw new Exception('Validation failed.');
    }

    $location = new Location();
    $location->name = $data['name'];

    // Save to database
    $location->save();
    // Create location associations
    // if (!empty($data['location_id']) && is_array($data['location_id'])) {
    //     foreach ($data['location_id'] as $locationId) {
    //         // Verify location exists before creating relationship
    //         if (Location::findById($locationId)) {
    //             // StoryLocation::create($story->id, $locationId);
    //         }
    //     }
    // }

    // Clear any old form data
    clearFormData();
    // Clear any old errors
    clearFormErrors();

    // Set success flash message
    setFlashMessage('success', 'Location stored successfully.');

    // Redirect to story details page
    redirect('location_create.php?id=' . $location->id);
} catch (Exception $e) {
    // Error - clean up uploaded image
    // if (isset($imageFilename) && $imageFilename) {
    //     $uploader->deleteImage($imageFilename);
    // }

    // Set error flash message
    setFlashMessage('error', 'Error: ' . $e->getMessage());

    // Store form data and errors in session
    setFormData($data);
    setFormErrors($errors);

    redirect('location_create.php');
}
