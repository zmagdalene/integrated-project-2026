<?php

require_once 'DB.php';

class Story
{

    public $id;
    public $headline;
    public $short_headline;
    public $subheadline;
    public $article;
    public $img_url;
    public $author_id;
    public $category_id;
    public $location_id;
    public $created_at;
    public $updated_at;

    public function __construct($data = null)
    {
        if ($data != null) {
            if (array_key_exists("id", $data)) {
                $this->id = $data["id"];
            }
            $this->headline       = $data["headline"] ?? null;
            $this->short_headline = $data["short_headline"] ?? null;
            $this->subheadline    = $data["subheadline"] ?? null;
            $this->article     = $data["article"] ?? null;
            $this->img_url     = $data["img_url"] ?? null;
            $this->author_id   = $data["author_id"] ?? null;
            $this->category_id = $data["category_id"] ?? null;
            $this->location_id = $data["location_id"] ?? null;

            if (array_key_exists("created_at", $data)) {
                $this->created_at = $data["created_at"];
            }
            if (array_key_exists("updated_at", $data)) {
                $this->updated_at = $data["updated_at"];
            }
        }
    }

    public function save()
    {
        $db = null;
        try {
            $db = DB::getInstance()->getConnection();

            $params = [
                ":headline"       => $this->headline,
                ":short_headline" => $this->short_headline,
                ":subheadline"    => $this->subheadline,
                ":article"     => $this->article,
                ":img_url"     => $this->img_url,
                ":author_id"   => $this->author_id,
                ":category_id" => $this->category_id,
                ":location_id" => $this->location_id,
            ];

            if ($this->id === null) {
                $sql = "INSERT INTO stories (" .
                    "headline, short_headline, subheadline, article, img_url, " .
                    "author_id, category_id, location_id" .
                    ") VALUES (" .
                    ":headline, :short_headline, :subheadline, :article, :img_url, " .
                    ":author_id, :category_id, :location_id" .
                    ")";
            } else {
                $sql = "UPDATE stories SET " .
                    "headline       = :headline, " .
                    "short_headline = :short_headline, " .
                    "subheadline    = :subheadline, " .
                    "article     = :article, " .
                    "img_url     = :img_url, " .
                    "author_id   = :author_id, " .
                    "category_id = :category_id, " .
                    "location_id = :location_id, " .
                    "updated_at  = :updated_at " .
                    "WHERE id = :id";

                $params[":id"] = $this->id;
            }
            $stmt = $db->prepare($sql);
            $status = $stmt->execute($params);

            if (!$status) {
                $error_info = $stmt->errorInfo();
                $message = "SQLSTATE error code = " . $error_info[0] . "; error message = " . $error_info[2];
                throw new Exception("Database error executing database query: " . $message);
            }

            if ($stmt->rowCount() !== 1) {
                throw new Exception("Failed to save story.");
            }

            if ($this->id === null) {
                $this->id = $db->lastInsertId();
            }
        } finally {
            if ($db !== null) {
                $db = null;
            }
        }
    }

    public function delete()
    {
        $db = null;
        try {
            if ($this->id !== null) {
                $db = DB::getInstance()->getConnection();

                $sql = "DELETE FROM stories WHERE id = :id";
                $params = [
                    ":id" => $this->id
                ];
                $stmt = $db->prepare($sql);
                $status = $stmt->execute($params);

                if (!$status) {
                    $error_info = $stmt->errorInfo();
                    $message = "SQLSTATE error code = " . $error_info[0] . "; error message = " . $error_info[2];
                    throw new Exception("Database error executing database query: " . $message);
                }

                if ($stmt->rowCount() !== 1) {
                    throw new Exception("Failed to delete story.");
                }
            }
        } finally {
            if ($db !== null) {
                $db = null;
            }
        }
    }

    private static function find($sql, $params, $options = NULL)
    {
        $stories = array();
        $db = null;

        try {
            $db = DB::getInstance()->getConnection();

            if ($options != NULL && is_array($options)) {
                if (array_key_exists("order_by", $options)) {
                    $allowed_columns = array_keys(get_class_vars(self::class));
                    if (in_array($options["order_by"], $allowed_columns)) {
                        $direction = (array_key_exists("order", $options) && strtoupper($options["order"]) === "DESC") ? "DESC" : "ASC";
                        $sql .= " ORDER BY " . $options["order_by"] . " " . $direction;
                    }
                }
                if (array_key_exists("limit", $options)) {
                    $sql .= " LIMIT :limit";
                    $params["limit"] = $options["limit"];

                    if (array_key_exists("offset", $options)) {
                        $sql .= " OFFSET :offset";
                        $params["offset"] = $options["offset"];
                    }
                }
            }

            $stmt = $db->prepare($sql);
            $status = $stmt->execute($params);

            if (!$status) {
                $error_info = $stmt->errorInfo();
                $message = "SQLSTATE error code = " . $error_info[0] . "; error message = " . $error_info[2];
                throw new Exception("Database error executing database query: " . $message);
            }

            if ($stmt->rowCount() !== 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                while ($row !== FALSE) {
                    $story = new Story($row);
                    $stories[] = $story;

                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                }
            }
        } finally {
            if ($db !== null) {
                $db = null;
            }
        }

        return $stories;
    }

    public static function findAll($options = NULL)
    {
        $sql = "SELECT * FROM stories";
        $params = [];

        $stories = Story::find($sql, $params, $options);

        return $stories;
    }

    public static function findByAuthor($id, $options = NULL)
    {
        $sql = "SELECT * FROM stories WHERE author_id = :author_id";
        $params = [
            ":author_id" => $id
        ];

        $stories = Story::find($sql, $params, $options);

        return $stories;
    }

    public static function findByCategory($id, $options = NULL)
    {
        $sql = "SELECT * FROM stories WHERE category_id = :category_id";
        $params = [
            ":category_id" => $id
        ];

        $stories = Story::find($sql, $params, $options);

        return $stories;
    }

    public static function findByLocation($id, $options = NULL)
    {
        $sql = "SELECT * FROM stories WHERE location_id = :location_id";
        $params = [
            ":location_id" => $id
        ];

        $stories = Story::find($sql, $params, $options);

        return $stories;
    }

    public static function findById($id)
    {
        $story = null;
        $db = null;

        try {
            $db = DB::getInstance()->getConnection();

            $sql = "SELECT * FROM stories WHERE id = :id";
            $params = [
                ":id" => $id
            ];
            $stmt = $db->prepare($sql);
            $status = $stmt->execute($params);

            if (!$status) {
                $error_info = $stmt->errorInfo();
                $message = "SQLSTATE error code = " . $error_info[0] . "; error message = " . $error_info[2];
                throw new Exception("Database error executing database query: " . $message);
            }

            if ($stmt->rowCount() !== 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $story = new Story($row);
            }
        } finally {
            if ($db !== null) {
                $db = null;
            }
        }

        return $story;
    }
}
