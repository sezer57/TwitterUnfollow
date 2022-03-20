<?php
if(isset($_COOKIE["auth"]) && isset($_COOKIE["quest"]) && isset($_COOKIE["csrf"])){
    require_once __DIR__."/../config.php";
    include SITE_ROOT."/test.php";

    ?>
<!doctype html>
<html lang="en">
  <head>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">

    <title>Dashboard Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
      <style>

          .flw {
              background: orangered;
              border: none;
              padding: 5px 10px;
              color: whitesmoke;
              width: 120px;
              border-radius: 5px;
              transition: all .3s ease-in;
          }

          .flw:active {
              outline: none;
          }

          .flw:visited {
              outline: none;
          }

          .unfollow {
              background: cornflowerblue;
              color: white;
          }
          .avatar {
              vertical-align: middle;
              width: 50px;
              height: 50px;
              border-radius: 50%;
          }
      </style>
  </head>
  <body>

    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Twitter Unfollow</a>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="/dashboard/signout.php">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="#">
                  <span data-feather="home"></span>
                  Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <button  id="as" class="btn btn-sm btn-outline-secondary">REFRESH</button>
              </div>
            </div>
          </div>

            <div id="station_data"></div>

          <h4>Not Following List</h4>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
                <?php
                echo"<thead>";


                    echo           "<tr>";
             echo     "<th></th>";
             echo    "<th>Username</th>";
             echo       "<th>Name</th>";
             echo   "</tr>";
             echo "</thead>";
            echo "<tbody>";

                $t=-2;
                while(true){

                    if($get_flow->data->user->result->timeline->timeline->instructions[$t]->type=='TimelineAddEntries'){
                        break;}
                    else {$t++;}
                }
                $i=1;
                $unf=1;
                  while($i<100){
                      $unf_list=$get_flow->data->user->result->timeline->timeline->instructions[$t]->entries[$i]->content->itemContent->user_results->result->legacy->followed_by;
                      $username = $get_flow->data->user->result->timeline->timeline->instructions[$t]->entries[$i]->content->itemContent->user_results->result->legacy->screen_name;
                      $name = $get_flow->data->user->result->timeline->timeline->instructions[$t]->entries[$i]->content->itemContent->user_results->result->legacy->name;
                      $pimg=$get_flow->data->user->result->timeline->timeline->instructions[$t]->entries[$i]->content->itemContent->user_results->result->legacy->profile_image_url_https;
                        if($unf_list==0){
                            echo  "<tr>";
                            echo "<td>$unf</td>";
                            echo "<td><a class='aclass' target='_blank' href='https://twitter.com/$username'>@$username</a></td>";
                            echo "<td>$name</td>";
                            echo  "<td><img src='$pimg' alt='Avatar' class='avatar'></td>";

                            echo "<td>  <button class='flw' type='button' value='$username' onclick='f1(this)' >Unfollow</button>";
                            echo "</tr>";
                            $unf++;
                        }
                        else{
                        }

                      $i++;

                }
                $nextusers=$get_flow->data->user->result->timeline->timeline->instructions[$t]->entries[$i]->content->value;

                        if($nextusers[0]==0){

                        }else{
                            $nextusers=str_replace("|","%7c",$nextusers);
                            $a->nextuser($nextusers,$i,$unf);
                        }


              echo "</tbody>";
              ?>
            </table>
          </div>
        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->

    <script src=
            "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
    </script>


    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>


    <script>function f1(objButton){
        var ss =objButton.value
            $.ajax({
                url: "/dashboard/action.php",
                type: "post",
                data: {ss}
            });
        }

    </script>
    <script>

        $(document).ready(function(){
            $("#station_data").load("/dashboard/save.php");
            $(".flw").click(function(){
                $("#station_data").load("/dashboard/save.php");
            });
            $("#as").click(function(){
                $("#station_data").load("/dashboard/save.php");
            });
        });

    </script>
    <script>
        $('.flw').click(function() {
            $(this).text(function(_, text) {
                return text === "Follow" ? "Unfollow" : "Follow";
            });
            if($(this).text() == "Unfollow") {
                $(this).removeClass('unfollow');
            } else if($(this).text() == "Follow") {
                $(this).addClass('unfollow');
            }
        });
    </script>
  </body>
</html>
<?php }
else{

    echo "Giris yapmadınız 7 saniye sonra yönlendirilceksiniz";

header("Refresh: 7 ; url=/");

}
?>