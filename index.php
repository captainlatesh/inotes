<?php
$insert=false;
$update=false;
$delete=false;

$servername="localhost";
$username="root";
$password="";
$database="notes";

$conn=mysqli_connect($servername,$username,$password,$database);
if(!$conn) {

    die ("server is not connected". mysqli_connect_error() );

}

if(isset($_GET['delete']))
{
  $sno=$_GET['delete'];


  $sql="DELETE FROM `note` WHERE `note`.`sno` = $sno";
  $result=mysqli_query($conn,$sql);

  if($result){$delete=true;}
  else{echo "its some mistake but it does not deleted";}

}
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

  if(isset($_POST['snoEdit']))
  {
    $sno=$_POST['snoEdit'];
    $title = $_POST["titleEdit"];
    $description = $_POST["descriptionEdit"];
    $sql="UPDATE `note` SET `title` = '$title', `description` = '$description' WHERE `note`.`sno` = $sno
    ";
    $result=mysqli_query($conn,$sql);
    if($result)
     {$update=true;}
  }
  else{
    $title = $_POST["title"];
    $description = $_POST["description"];
    
   $sql= "INSERT INTO `note` ( `title`, `description`) VALUES ('$title', '$description ')";
   $result=mysqli_query($conn,$sql);
   if($result)
   {
     $insert=true;
   }
  }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>




    <title>inotes- Notes taking easy</title>

   
  </head>
  <body>
<!-- edit modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  edit modal
</button> -->

<!-- edit modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editLabel">Edit this Note</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <h2>Update Note</h2>
      <form action="index.php" method="post">
        <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="mb-3 my-5">
              <label for="titleEdit" class="form-label">Note title</label>
              <input type="text" class="form-control" id="titleEdit" aria-describedby="emailHelp" name="titleEdit" required>
              
            </div>
            <div class="mb-3 my-4">
              <label for="descriptionEdit" class="form-label">Description</label>
              <br>
              <textarea name="descriptionEdit" id="descriptionEdit"  rows="10" cols="83" class="form-control" name="description" required></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Update Note</button>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php">php CEUD</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">contectus</a>
</li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Dropdown
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled">Disabled</a>
              </li>
            </ul>
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>

<?php
if($insert)
{
    echo '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!!!</strong> your data is saved successfully.
   <button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close"></button>
   </div>
    ';

}
    if($update)
 {
    echo '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
   <strong>Success!!!</strong> your data is updated  successfully.
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>
    ';
 }
 if($delete)
 {
    echo '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
   <strong>Success!!!</strong> your data is deleted  successfully.
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>
    ';
 }

?>
      <div class="container">
       <h2>Add a note</h2>
        <form action="index.php" method="post">
            <div class="mb-3 my-5">
              <label for="title" class="form-label">Note title</label>
              <input type="text" class="form-control" id="title" aria-describedby="emailHelp" name="title" required>
              
            </div>
            <div class="mb-3 my-4">
              <label for="description" class="form-label">Description</label>
              <br>
              <textarea name="description" id="description"  rows="10" cols="83" class="form-control" name="description" required></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Add Note</button>
          </form>
      </div>
     
      <div class="container">
        

<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">S. No</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php
        
        $sql= "SELECT * FROM `note`";
        $result=mysqli_query($conn,$sql);
        
 while($row=mysqli_fetch_assoc($result))
 {

  echo " <tr>
  <th scope='row'>". $row['sno']."</th>
  <td>". $row['title']."</td>
  <td>". $row['description']."</td>
  <td><button type='button' class='btn btn-primary btn-sm edit' id=".$row['sno']." >Edit</button>    <button type='button' class='btn btn-primary btn-sm delete' id=d".$row['sno']." >DELETE</button></td>
</tr>";
    //  echo $row['sno']."<br>".$row['title']."<br>".$row['description']."<br>".$row['time'];


          echo "<br>";
 }
        ?>
   
  </tbody>
</table>

      </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

<script>$(document).ready( function () {
    $('#myTable').DataTable();
} );</script>

<script>
edits=document.getElementsByClassName('edit');
Array.from(edits).forEach((element)=>{
        element.addEventListener("click",(e)=>{
    console.log("edit",);

    tr=e.target.parentNode.parentNode;
    title=tr.getElementsByTagName("td")[0].innerText;
    description=tr.getElementsByTagName("td")[1].innerText;
   
    descriptionEdit.value=description;
    titleEdit.value=title;
    snoEdit.value=e.target.id;
console.log(e.target.id);
    $('#editModal').modal('toggle');
    

  })
})


deletes=document.getElementsByClassName('delete');
Array.from(deletes).forEach((element)=>{
        element.addEventListener("click",(e)=>{
    console.log("delete",);

    sno=e.target.id.substr(1,);
    
    
if(confirm("Press a button!\nEither OK or Cancel."))
{
  console.log("yes");

  window.location=`index.php?delete=${sno}`;
}
else{
  console.log("no");
}

  })
})
</script>

  </body>
</html>