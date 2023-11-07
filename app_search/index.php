<!DOCTYPE html>
<html>

<head>
  <title>Live Search</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://kit.fontawesome.com/355acdeb36.js" crossorigin="anonymous"></script>
</head>

<body>
  <nav class="navbar bg-body-tertiary mb-5">
    <div class="container-fluid">
      <a class="navbar-brand">Live Search Tok Pisin</a>
      <form class="d-flex" role="search">
        <a href="login.php" class="btn btn-outline-success">Login</a>
      </form>
    </div>
  </nav>
  <div class="container-sm">
    <div class="row justify-content-center text-center">
      <div class="col-lg-6">
        <label for="#" class="form-label">masukan kosa kata</label>
        <input type="text" class="form-control me-2" type="search" name="query" id="search" placeholder="Indonesia.." />
      </div>
    </div>
    <div class="row my-2 justify-content-center">
      <div class="col-6">
        <div class="card mb-3" style="max-width: 970px">
          <div class="row g-0">
            <div class="col-md-8">
              <div class="card-body">
                <p class="text-secondary mb-3">Tok pisin :</p>
                <p class="card-title fs-5" id="search-results"></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row my-2 justify-content-center">
      <div class="col-6">
        <div id="txtHint"></div>

        <?php
        // $q = intval($_POST['cari']);

        $con = mysqli_connect('localhost', 'root', '', 'search_data');
        if (!$con) {
          die('Could not connect: ');
        }

        mysqli_select_db($con, "search_data");
        $sql = "SELECT * FROM png";
        $result = mysqli_query($con, $sql);
        ?>
        <table class="table">
          <tr>
            <th>No</th>
            <th>Indonesia</th>
            <th>Tok Pisin</th>

          </tr>
          <?php
          while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['id_png'] . "</td>";
            echo "<td>" . $row['indo'] . "</td>";
            echo "<td>" . $row['png'] . "</td>";
            echo "</tr>";
          }
          echo "</table>";
          mysqli_close($con);
          ?>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script>
    function showUser(str) {
      if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
      } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("txtHint").innerHTML = this.responseText;
          }
        };
        xmlhttp.open("GET", "getuser.php?q=" + str, true);
        xmlhttp.send();
      }
    }

    $(document).ready(function() {
      $("#search").on("input", function() {
        var query = $(this).val();
        if (query === "") {
          $("#search-results").empty();
        } else {
          $.ajax({
            method: "POST",
            url: "search.php", // Ganti dengan alamat skrip pencarian Anda
            data: {
              query: query,
            },
            success: function(data) {
              $("#search-results").html(data);
            },
          });
        }
      });
    });
  </script>
</body>

</html>