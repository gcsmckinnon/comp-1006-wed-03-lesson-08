<?php

  require_once('header.php');
  require_once('connect.php');

  // Sanitization
  $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
  $fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
  $lname = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING);
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
  $age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_NUMBER_INT);
  $url = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_STRING);

  // Validation
  $errors = [];

  if (empty($fname)) {
    // pushing error onto the errors array
    array_push($errors, "First name is required");
  }

  if (empty($lname)) {
    // pushing error onto the errors array
    $errors[] = "Last name is required";
  }

  if (empty($email)) {
    $errors[] = "Email is required";
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Email needs to be in the correct format";
  }

  if (!empty($age)) {
    if ($age < 18 || $age > 130) {
      $errors[] = "Age must be in the range of 18 to 130";
    }
  }

  if (!empty($url) && !filter_var($url, FILTER_VALIDATE_URL)) {
    $errors[] = "URL must be in the correct format";
  }

  // Normalization
  $fname = mb_convert_case($fname, MB_CASE_TITLE);
  $lname = mb_convert_case($lname, MB_CASE_TITLE);

  try {
    if (empty($id)) {
      $sql = "INSERT INTO contacts (
        fname,
        lname,
        email,
        age,
        url
      ) VALUES (
        :fname,
        :lname,
        :email,
        :age,
        :url
      )";
    } else {
      $sql = "UPDATE contacts SET
        fname = :fname
        lname = :lname
        email = :email
        age = :age
        url = :url
      WHERE id = :id";
    }

    $stmt = $db->prepare($sql);

    $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
    $stmt->bindParam(':lname', $lname, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':age', $age, PDO::PARAM_INT);
    $stmt->bindParam(':url', $url, PDO::PARAM_STR);

    if (!empty($id)) {
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    }

    $stmt->execute();

    if (!$stmt) {
      throw new Exception($db->errorInfo());
    }

    $stmt->closeCursor();

    header("Location: index.php");
    exit;
  } catch (Exception $e) {
    echo "<p class='text-danger'>{$e->getMessage()}</p>";
  }

  require_once('footer.php');

?>