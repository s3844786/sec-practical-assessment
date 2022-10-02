<?php
include('session.php');
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Secure Electronic Commerce</title>
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="../client/styles/main-page.css" />
</head>

<body>
  <div class="container">
    <div class="menu">
      <ul>
        <li>
          <a href="home.php" class="logo"><img src="../resource/icons8-shop-64.png" /></a>
        </li>
        <li><a href="home.php" class="navbar-item">Home</a></li>
        <li><a href="catalog.php" class="navbar-item">Catalog</a></li>
        <li><a href="items.php" class="navbar-item">Items</a></li>
        <li><a href="home.php" class="login-btn">Sign out</a></li>
      </ul>
    </div>

    <div class="content">
      <h1>Item database</h1>
      <table class="item-table">
        <tr>
          <th>Name</th>
          <th>Price</th>
          <th>Image</th>
        </tr>

        <!-- Image part is somehow broken -->
        <?php
        try {
          $conn = mysqli_connect("localhost", "root", "", "test");
          $sql = "SELECT * FROM products";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo '<tr>
                      <td width=10%>' . $row['name'] . '</td>
                      <td>' . $row['price'] . '</td>
                      <td><img src= ' . $row['image'] . '/></td>
                   </tr>';
            }
          } else {
            echo 'No results.';
          }
        } catch (Exception $e) {
          echo 'Caught exception: ', $e->getMessage();
        }
        ?>

      </table>
      <h2>Add Item to database</h2>
      <div class="add-item">
        <form action="itemVerification.php" method="POST" enctype="multipart/form-data">
          <input type="text" name="name" id="name" placeholder="Name" />
          <input type="number" name="price" id="price" placeholder="2.00" min="0" />
          <input type="file" accept="image/*" name="image" id="image" />
          <button type="submit">Add item</button>
        </form>
        <?php
        $error = $_SESSION['errorMessage'];
        if ($error != '' && isset($error)) {
          echo '<p class=error-message>' . $error . '</p>';
          unset($_SESSION['errorMessage']);
        }
        ?>
      </div>

    </div>

    <div class=" footer">
      <p>
        Practical assignment for Secure Electronic Commerce | s3844786 &
        s3845837
      </p>
    </div>
  </div>

  <script src="js/sha256.js"></script>
  <script type="text/javascript" src="js/script.js" async defer></script>
</body>

</html>