<?php
require_once 'php/lib/config.php';
require_once 'php/lib/global.php';
require_once 'php/lib/session.php';

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
        'headline' => $_POST['headline'] ?? null,
        'short_headline' => $_POST['short_headline'] ?? null,
        'subheadline' => $_POST['subheadline'] ?? null,
        'article' => $_POST['article'] ?? null,
        'author_id' => $_POST['author_id'] ?? null,
        'category_id' => $_POST['category_id'] ?? null,
        'location_id' => $_POST['location_id'] ?? null,
        'img_url' => $_FILES['img_url'] ?? null
    ];

    // Define validation rules
    $rules = [
        'headline' => 'required|notempty|min:3|max:255',
        'short_headline' => 'required|notempty|min:3|max:255',
        'subheadline' => 'required|notempty|min:3|max:255',
        'article' => 'required|notempty|min:15',
        'author_id' => 'required|integer',
        'category_id' => 'required|integer',
        'location_id' => 'required|integer',
        'img_url' => 'required|file|image|mimes:jpg,jpeg,png|max_file_size:5242880',
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

    // Verify category exists
    $category = Category::findById($data['category_id']);
    if (!$category) {
        throw new Exception('Selected category does not exist.');
    }

    // Process the uploaded image (validation already completed)
    $imageFilename = null;
    $uploader = new ImageUpload();
    if ($uploader->hasFile('img_url')) {
        // Delete old image
        $uploader->deleteImage($story->img_url);
        // Process new image
        $imageFilename = $uploader->process($_FILES['img_url']);
        // Check for processing errors
        if (!$imageFilename) {
            throw new Exception('Failed to process and save the image.');
        }
    }

    // Update the story instance
    $story = new Story();
    $story->headline = $data['headline'];
    $story->short_headline = $data['short_headline'];
    $story->subheadline = $data['subheadline'];
    $story->article = $data['article'];
    $story->author_id = $data['author_id'];
    $story->category_id = $data['category_id'];
    $story->location_id = $data['location_id'];
    if ($imageFilename) {
        $story->img_url = 'images/' . $imageFilename;
    }

    // Save to database
    $story->save();

    // Clear any old form data
    clearFormData();
    // Clear any old errors
    clearFormErrors();

    // Set success flash message
    setFlashMessage('success', 'Story updated successfully.');

    // Redirect to story details page
    redirect('view_story.php?id=' . $story->id);
} catch (Exception $e) {
    // Error - clean up uploaded image
    if ($imageFilename) {
        $uploader->deleteImage($imageFilename);
    }

    // Set error flash message
    setFlashMessage('error', 'Error: ' . $e->getMessage());

    // Store form data and errors in session
    setFormData($data);
    setFormErrors($errors);

    // Redirect back to edit page if there is an ID; otherwise, go to index page
    if (isset($data['id']) && $data['id']) {
        redirect('story_edit.php?id=' . $data['id']);
    } else {
        redirect('index.php');
    }
}
