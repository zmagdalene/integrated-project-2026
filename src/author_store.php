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
        'first_name' => $_POST['first_name'] ?? null,
        'last_name' => $_POST['last_name'] ?? null
    ];

    // Define validation rules
    $rules = [
        'first_name' => 'required|notempty|min:3|max:30',
        'last_name' => 'required|notempty|min:3|max:30'
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

    // // All validation passed - now process and save
    // // Verify category exists
    // $category = Category::findById($data['category_id']);
    // if (!$category) {
    //     throw new Exception('Selected category does not exist.');
    // }

    // // Process the uploaded image (validation already completed)
    // $uploader = new ImageUpload();
    // $imageFilename = $uploader->process($_FILES['img_url']);

    // if (!$imageFilename) {
    //     throw new Exception('Failed to process and save the image.');
    // }

    // Create new story instance
    // $story = new Story();
    // $story->headline = $data['headline'];
    // $story->short_headline = $data['short_headline'];
    // $story->subheadline = $data['subheadline'];
    // $story->article = $data['article'];
    // $story->author_id = $data['author_id'];
    // $story->category_id = $data['category_id'];
    // $story->location_id = $data['location_id'];
    // if ($imageFilename) {
    //     $story->img_url = 'images/' . $imageFilename;
    // }
    $author = new Author();
    $author->first_name = $data['first_name'];
    $author->last_name = $data['last_name'];

    // Save to database
    $author->save();
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
    setFlashMessage('success', 'Author stored successfully.');

    // Redirect to story details page
    redirect('author_create.php?id=' . $author->id);
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

    redirect('author_create.php');
}
