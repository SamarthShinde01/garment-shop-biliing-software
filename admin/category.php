<?php


session_start();
if(!isset($_SESSION['id'])){
    header('location:../index.php');
}
?>
    <?php include('include/sidebar.php');?>
    <?php include('include/header.php');?>
      <div class="content-body mb-5 p-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-4 d-flex align-items-center justify-content-between">
                        <h3 class="mb-0">Category Details </h3>
                        <p class="m-0"><a href="dashboard.php" class="text-primary">Dashoboard </a> <span class="disable">/ Manage Category </span></p>
                    </div>
                </div>
            </div>
             <div class="card-header">
                               <!--   <a href="Order.php"><button class="btn btn-primary" type="submit" name=""> Add Order </button></a> -->
                                               </div>

            <section>

                 <div class="container">
                 <button type="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal12">Add</button>
                 <!-- Modal start -->
                <div class="modal fade" id="exampleModal12" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <!--Add category name-->
                      <form class="row" method="POST" action="app/category-crud.php" id="category_form" onsubmit="return validation()" name="myform" enctype="multipart/form-data">
                      <div class="mb-3">
                      <label for="exampleInputname1" class="form-label">Category Name<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="catename">
                      </div>
                     
                      <div class="col-md-12">
                                  <button type="submit" name="submit" class="btn btn-primary btn-sm" onclick="submitcat()">Submit</button>
                                  <input class="btn btn-primary btn-sm" type="reset" value="Reset">
                                  </div>
                      </form>
                      </div>
                   </div>

                   <!-- Scrpt for image upload only jpeg,png,jpg formate -->
                    <script type="text/javascript">
                            var img = document.forms['myform']['photo'];
                            var validExt=["jpeg","png","jpg"];
                            function validation() {
                            var img_ext=img.value.substring(img.value.lastIndexOf('.')+1);
                            var result=validExt.includes(img_ext);
                            if(result==false){
                            alert("Sorry, only JPEG,JPG & PNG   files are allowed.");
                            return false;
                                 }
                            }

                    </script>
                            </div>
                           </div>
                            </div>
                            </section>
            <!-- Manage menu details -->
            <div class="row">
               <div class="col-md-12">
                   <div class="card border-0 shadow">
                        <div class="card-body">
                            <div class="table-responsive">
                            <table id="example" class="display table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Category Id</th>
                                        <th>Category Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                            <!-- accesing category name -->
                                    <?php
                                        
                                  
                                                         $cnt=1;

                                    $stmt = $db->prepare("select * from category  Where delete_status=0 ");
                                                                       $stmt->execute();
                                                                       $record = $stmt->fetchAll();
                                                                       $i=1;
                                                                       foreach ($record as $row) 
                                                                         { ?>

                                    <!--Fetch the Records -->
                                                        <tr>
                                                            <td><?php echo $cnt;?></td>                       
                                                     <td><?php  echo $row['cate_name'];?></td>
                                                            <td>

                                     <a href="edit-category.php?cateid=<?php echo $row['cate_id'];?>" class="btn btn-primary btn-sm "><i class="icon-line-awesome-edit fs-5"></i></a> 
                                     <a href="app/category-crud.php?delid=<?php echo $row['cate_id'];?>" class="btn btn-danger btn-sm "onclick="return confirm('Do you really want to Delete ?');"><i class="icon-line-awesome-trash-o fs-5"></i></a>  
                                    </td>
                                     </tr>
                                    <?php 
                                    $cnt=$cnt+1;
                                    }  ?>              
                                </tbody>
                            </table>
                        </div>
                        </div>
                   </div>
               </div>
            </div>
      </div>
<?php include('include/footer.php');?>