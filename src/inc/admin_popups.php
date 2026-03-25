<?php
return [
    "common" => [
        "logo" => "TFJ",
        "exit" => "X",
    ],

    "popups" => [
        "defaultDisplay" => [
            "text" => "Please Select One...",
            "cards" => [
                "admin" => [
                    "icon" => "fa-solid fa-lock",
                    "text" => "I have admin permissions."
                ],
                "noAdmin" => [
                    "icon" => "fa-solid fa-lock-open",
                    "text" => "I would like to request admin permissions."
                ]
            ]
        ],
        "adminDisplay" => [
            "text" => "Please Enter Admin Password.",
            "icon" => "fa-solid fa-lock",
            "adminConfirm" => "Confirm"
        ],
        "noAdminDisplay" => [
            "text" => "Please Contact TFJ@gmail.com for more info.",
            "icon" => "fa-solid fa-paper-plane"
        ]
    ]
];
