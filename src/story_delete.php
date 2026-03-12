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

    // Check if request is GET
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        throw new Exception('Invalid request method.');
    }

    // Get form data
    $data = [
        'id' => $_GET['id'] ?? null
    ];

    // Define validation rules
    $rules = [
        'id' => 'required|integer'
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

    // Find existing story
    $story = Story::findById($data['id']);
    if (!$story) {
        throw new Exception('Story not found.');
    }

    // Delete the associated image file if it exists
    if ($story->img_url) {
        $uploader = new ImageUpload();
        $uploader->deleteImage($story->img_url);
    }
    // Delete the story
    $story->delete();

    // Clear any old form data
    clearFormData();
    // Clear any old errors
    clearFormErrors();

    // Set success flash message
    setFlashMessage('success', 'Story deleted successfully.');

    // Redirect to story details page
    redirect('index.php');
} catch (Exception $e) {
    // Set error flash message
    setFlashMessage('error', 'Error: ' . $e->getMessage());

    // Store form data and errors in session
    setFormData($data);
    setFormErrors($errors);

    // Redirect back to view page if there is an ID; otherwise, go to index page
    if (isset($data['id']) && $data['id']) {
        redirect('view_story.php?id=' . $data['id']);
    } else {
        redirect('index.php');
    }
}
