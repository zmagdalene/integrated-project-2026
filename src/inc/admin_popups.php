<?php
return [
    "common" => [
        "logo" => "TFJ",
        "exit" => "X",
    ],

    "popups" => [
        "default" => [
            "text" => "Please Select One...",
            "cards" => [
                "login" => [
                    "icon" => "fa-solid fa-lock",
                    "text" => "I have admin permissions."
                ],
                "noAdmin" => [
                    "icon" => "fa-solid fa-lock-open",
                    "text" => "I would like to request admin permissions."
                ]
            ]
        ],
        "login" => [
            "text" => "Please Enter Admin Password.",
            "icon" => "fa-solid fa-lock",
            "adminConfirm" => "Confirm"
        ],
        "noAdmin" => [
            "text" => "Please Contact TFJ@gmail.com for more info.",
            "icon" => "fa-solid fa-paper-plane"
        ]
    ],

    "admin" => [
        "text" => "Please Select One...",
        "cards" => [
            "createStory" => [
                "icon" => "fa-solid fa-lock",
                "text" => "Create Story",
                "href" => "story_create.php"
            ],
            "manageAuthors" => [
                "icon" => "fa-solid fa-lock-open",
                "text" => "Create Author",
                "href" => "author_create.php"
            ],
            "createCategory" => [
                "icon" => "fa-solid fa-lock",
                "text" => "Create Category",
                "href" => "category_create.php"
            ],
            "createLocation" => [
                "icon" => "fa-solid fa-lock-open",
                "text" => "Create Location",
                "href" => "location_create.php"
            ]
        ]
    ]
];
