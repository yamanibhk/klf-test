<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="<?=$data["vat"]?>/klf-test/03/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=$data["vat"]?>/klf-test/03/css/flaticon.css">
    <script src="<?=$data["vat"]?>/klf-test/03/js/jquery.slim.min.js"></script>
    <script src="<?=$data["vat"]?>/klf-test/03/js/tether.min.js"></script>
    <script src="<?=$data["vat"]?>/klf-test/03/js/bootstrap.min.js"></script>
    <script src="<?=$data["vat"]?>/klf-test/03/js/scripts.js"></script>
    <title>Assessment 03</title>
</head>
<body class="pl-0 pr-0">
    <h1 class="text-center mt-4 mb-3">LIST OF USERS</h1>
    <button  type='submit' class="btn btn-primary pl-3 pr-3 pt-1 pb-1 ml-4" data-toggle="modal" data-target="#userModalInsertion">
      <i class="flaticon-add text-center pl-0 pr-0"></i>
    </button>
    <!-- this is a modal for user form in case of insert-->
            <div class="modal fade" id="userModalInsertion">
                <div class="modal-dialog">
                    <div class="modal-content">
                        
                        <div class="modal-title">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form  method="POST">
                          <div class="modal-body ">
                            
                            <input type="hidden" name="userId" class="form-control" id="userId" value=""/>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="ts" class="col-form-label col-4">time Inserted:</label>
                                <div class="col-8">
                                  <input type="time" name="ts" class="form-control" id="ts" value=""/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="userIns" class="col-form-label col-4">User Inserted:</label>
                                <div class="col-8">
                                  <input type="number" name="userIns" class="form-control" id="userIns" value=""/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="dt" class="col-form-label col-4">Time Insertion:</label>
                                <div class="col-8">
                                  <input type="time" name="dt" class="form-control" id="dt" value=""/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="userMod" class="col-form-label col-4">User Modified:</label>
                                <div class="col-8">
                                  <input type="number" name="userMod" class="form-control" id="userMod" value=""/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="firstName" class="col-form-label col-4">First Name:</label>
                                <div class="col-8">
                                  <input type="text" name="firstName" class="form-control" id="firstName" value=""/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="lastName" class="col-form-label col-4">Last Name:</label>
                                <div class="col-8">
                                  <input type="text" name="lastName" class="form-control" id="lastName" value=""/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="jobTitle" class="col-form-label col-4">Job Title:</label>
                                <div class="col-8">
                                  <input type="text" name="jobTitle" class="form-control" id="jobTitle" value=""/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="email" class="col-form-label col-4">Email:</label>
                                <div class="col-8">
                                  <input type="email" name="email" class="form-control" id="email" value=""/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="add1" class="col-form-label col-4">Address 1:</label>
                                <div class="col-8">
                                  <input type="text" name="add1" class="form-control" id="add1" value=""/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="add2" class="col-form-label col-4">Address 2:</label>
                                <div class="col-8">
                                  <input type="text" name="add2" class="form-control" id="add2" value=""/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="city" class="col-form-label col-4">City:</label>
                                <div class="col-8">
                                  <input type="text" name="city" class="form-control" id="city" value=""/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="postCod" class="col-form-label col-4">Postal Code:</label>
                                <div class="col-8">
                                  <input type="text" name="postCod" class="form-control" id="postCod" value=""/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="prov" class="col-form-label col-4">Province:</label>
                                <div class="col-8">
                                  <input type="text" name="prov" class="form-control" id="prov" value=""/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="countr" class="col-form-label col-4">Country:</label>
                                <div class="col-8">
                                  <input type="text" name="countr" class="form-control" id="countr" value=""/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="phone" class="col-form-label col-4">Phone Number:</label>
                                <div class="col-8">
                                  <input type="number" name="phone" class="form-control" id="phone" value=""/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="pass" class="col-form-label col-4">Password:</label>
                                <div class="col-8">
                                  <input type="password" name="pass" class="form-control" id="pass" value=""/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="salt" class="col-form-label col-4">Salt:</label>
                                <div class="col-8">
                                  <input type="text" name="salt" class="form-control" id="salt" value=""/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="db" class="col-form-label col-4">Date of Birth:</label>
                                <div class="col-8">
                                  <input type="date" name="db" class="form-control" id="db" value=""/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="dis" class="col-form-label col-4">Disabled:</label>
                                <div class="col-8">
                                  <input type="number" name="dis" class="form-control" id="dis" value=""/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="resPass" class="col-form-label col-4">Reset Password:</label>
                                <div class="col-8">
                                  <input type="number" name="resPass" class="form-control" id="resPass" value=""/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="roleId" class="col-form-label col-4">Role Id:</label>
                                <div class="col-8">
                                  <input type="number" name="roleId" class="form-control" id="roleId" value=""/>
                                </div>
                            </div>
                            <input type="hidden" name="action" class="form-control" value="insertUser"/>          
                          </div> <!-- modal-body -->

                        <div class="modal-footer">
                            <button  type='submit' class="btn btn-outline-success pl-2 pr-2 pt-2 pb-2" ><i class="flaticon-ok text-center pl-0 pr-0"></i></button>
                        </div>
                        </form>

                    </div> <!-- modal-content -->
                </div> <!-- modal-dialog -->
            </div> <!-- modal fade -->
 
<div class="container-fluid pl-0 pr-0">
  <div class="row pl-0 pr-0">
    <table class="table-hover table-bordered" style="transform: scale(.80,1);margin-left:-50px;">
      <thead class="thead-inverse">
        <tr>
          <th class="text-center align-middle">N°</th>
          <th class="text-center align-middle">Insertion date</th>
          <th class="text-center align-middle">inserted user</th>
          <th class="text-center align-middle">Modification date</th>
          <th class="text-center align-middle">User modified</th>
          <th class="text-center align-middle">First name</th>
          <th class="text-center align-middle">Last name</th>
          <th class="text-center align-middle">Job title</th>
          <th class="text-center align-middle">Email</th>
          <th class="text-center align-middle">Address</th>
          <th class="text-center align-middle">City</th>
          <th class="text-center align-middle">Postal code</th>
          <th class="text-center align-middle">Province</th>
          <th class="text-center align-middle">Country</th>
          <th class="text-center align-middle">Phone number</th>
          <th class="text-center align-middle">Password</th>
          <th class="text-center align-middle">Salt</th>
          <th class="text-center align-middle">Date of birth</th>
          <th class="text-center align-middle">Disabled</th>
          <th class="text-center align-middle">Reset password</th>
          <th class="text-center align-middle">Role id</th>
        </tr>
      </thead>
      <tbody>
      <?php
	     $i=1;
          foreach($data["users"] as $user)
          {
      ?>
        <tr>
          <th><?= $i++ ?></th>
          <td><?= $user->ts_inserted ?></td>
          <td><?= $user->user_inserted ?></td>
          <td><?= $user->dt_modified ?></td>
          <td><?= $user->user_modified ?></td>
          <td><?= $user->first_name ?></td>
          <td><?= $user->last_name ?></td>
          <td><?= $user->job_title ?></td>
          <td><?= $user->email ?></td>
          <td><?= $user->address_1.", ". $user->address_2 ?></td>
          <td><?= $user->city ?></td>
          <td><?= $user->postal_code ?></td>
          <td><?= $user->province ?></td>
          <td><?= $user->country ?></td>
          <td><?= $user->phone ?></td>
          <td><?= $user->password ?></td>
          <td><?= $user->salt ?></td>
          <td><?= $user->date_of_birth ?></td>
          <td><?= $user->disable ?></td>
          <td><?= $user->reset_password ?></td>
          <td><?= $user->role_id ?></td>
          <td>
            <button  type='submit' class="btn btn-outline-warning pl-0 pr-0 pt-0 pb-0" data-toggle="modal" data-target="<?='#userModal'.$i ?>"><i class="flaticon-edit text-center pl-0 pr-0"></i></button>
            
            

            <form  method="post">
              <input type="hidden" name="userId" value="<?= $user->user_id ?>"/>          
              <input type="hidden" name="action" value="deleteUser"/>          
              <button  type='submit' class="btn btn-outline-danger pl-0 pr-0 pt-0 pb-0"><i class="flaticon-dustbin text-center pl-0 pr-0 "></i></button>
            </form>
          </td>
          <!-- this is a modal for user form in case of update or insert-->
            <div class="modal fade" id="<?='userModal'.$i ?>"> <!-- id meme que data-target -->
                <div class="modal-dialog">
                    <div class="modal-content">
                        
                        <div class="modal-title">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form  method="POST">
                          <div class="modal-body ">
                            
                            <input type="hidden" name="userId" class="form-control" id="userId" value="<?= $user->user_id ?>"/>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="ts" class="col-form-label col-4">time Inserted:</label>
                                <div class="col-8">
                                  <input type="time" name="ts" class="form-control" id="ts" value="<?= $user->ts_inserted ?>"/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="userIns" class="col-form-label col-4">User Inserted:</label>
                                <div class="col-8">
                                  <input type="number" name="userIns" class="form-control" id="userIns" value="<?= $user->user_inserted ?>"/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="dt" class="col-form-label col-4">Time Insertion:</label>
                                <div class="col-8">
                                  <input type="time" name="dt" class="form-control" id="dt" value="<?= $user->dt_modified ?>"/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="userMod" class="col-form-label col-4">User Modified:</label>
                                <div class="col-8">
                                  <input type="number" name="userMod" class="form-control" id="userMod" value="<?= $user->user_modified ?>"/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="firstName" class="col-form-label col-4">First Name:</label>
                                <div class="col-8">
                                  <input type="text" name="firstName" class="form-control" id="firstName" value="<?= $user->first_name ?>"/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="lastName" class="col-form-label col-4">Last Name:</label>
                                <div class="col-8">
                                  <input type="text" name="lastName" class="form-control" id="lastName" value="<?= $user->last_name ?>"/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="jobTitle" class="col-form-label col-4">Job Title:</label>
                                <div class="col-8">
                                  <input type="text" name="jobTitle" class="form-control" id="jobTitle" value="<?= $user->job_title ?>"/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="email" class="col-form-label col-4">Email:</label>
                                <div class="col-8">
                                  <input type="email" name="email" class="form-control" id="email" value="<?= $user->email ?>"/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="add1" class="col-form-label col-4">Address 1:</label>
                                <div class="col-8">
                                  <input type="text" name="add1" class="form-control" id="add1" value="<?= $user->address_1 ?>"/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="add2" class="col-form-label col-4">Address 2:</label>
                                <div class="col-8">
                                  <input type="text" name="add2" class="form-control" id="add2" value="<?= $user->address_2 ?>"/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="city" class="col-form-label col-4">City:</label>
                                <div class="col-8">
                                  <input type="text" name="city" class="form-control" id="city" value="<?= $user->city ?>"/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="postCod" class="col-form-label col-4">Postal Code:</label>
                                <div class="col-8">
                                  <input type="text" name="postCod" class="form-control" id="postCod" value="<?= $user->postal_code ?>"/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="prov" class="col-form-label col-4">Province:</label>
                                <div class="col-8">
                                  <input type="text" name="prov" class="form-control" id="prov" value="<?= $user->province ?>"/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="countr" class="col-form-label col-4">Country:</label>
                                <div class="col-8">
                                  <input type="text" name="countr" class="form-control" id="countr" value="<?= $user->country ?>"/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="phone" class="col-form-label col-4">Phone Number:</label>
                                <div class="col-8">
                                  <input type="number" name="phone" class="form-control" id="phone" value="<?= $user->phone ?>"/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="pass" class="col-form-label col-4">Password:</label>
                                <div class="col-8">
                                  <input type="password" name="pass" class="form-control" id="pass" value="<?= $user->password ?>"/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="salt" class="col-form-label col-4">Salt:</label>
                                <div class="col-8">
                                  <input type="text" name="salt" class="form-control" id="salt" value="<?= $user->salt ?>"/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="db" class="col-form-label col-4">Date of Birth:</label>
                                <div class="col-8">
                                  <input type="date" name="db" class="form-control" id="db" value="<?= $user->date_of_birth ?>"/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="dis" class="col-form-label col-4">Disabled:</label>
                                <div class="col-8">
                                  <input type="number" name="dis" class="form-control" id="dis" value="<?= $user->disable ?>"/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="resPass" class="col-form-label col-4">Reset Password:</label>
                                <div class="col-8">
                                  <input type="number" name="resPass" class="form-control" id="resPass" value="<?= $user->reset_password ?>"/>
                                </div>
                            </div>
                            <div class="form-group row col-12 ml-auto mr-auto">
                                <label for="roleId" class="col-form-label col-4">Role Id:</label>
                                <div class="col-8">
                                  <input type="number" name="roleId" class="form-control" id="roleId" value="<?= $user->role_id ?>"/>
                                </div>
                            </div>
                            <input type="hidden" name="action" class="form-control" value="insertUser"/>          
                          </div> <!-- modal-body -->

                        <div class="modal-footer">
                            <button  type='submit' class="btn btn-outline-success pl-2 pr-2 pt-2 pb-2" ><i class="flaticon-ok text-center pl-0 pr-0"></i></button>
                        </div>
                        </form>

                    </div> <!-- modal-content -->
                </div> <!-- modal-dialog -->
            </div> <!-- modal fade -->
  
        </tr>
        
   <?php } ?>
      </tbody>
    </table>
  </div>
  </div>
</body>
</html>