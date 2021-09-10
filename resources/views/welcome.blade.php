<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Hello, Edurio!</title>
  </head>
  <body class="bg-light">
    <div class="container">
       <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="https://home.edurio.com/wp-content/uploads/2019/02/logo-2.svg" alt="Logo" width="72" height="72">
    <h2>Edurio Checkout form</h2>
    <p class="lead">Simple test of Edurio.</p>
    <?php echo '<p class="lead text-success"">'.$success.'</p>'; ?>
  </div>
   <form method="post" action class="needs-validation" novalidate>
     @csrf
<?php
$Questions=$questions;
$Answers=$answers_category;
?>
<div class="mb-3">
          <label for="email">Email <span class="text-danger">*</span></label>
          <input type="email" required class="form-control" name="email" id="email" placeholder="you@example.com">
          <div class="invalid-feedback">
            Please enter a valid email address for shipping updates.
          </div>
        </div>

<div class="mb-3">
          <label for="email">Questions & Answeres <span class="text-danger">*</span></label>

        </div>

 <div class="row">
         <div class="col-sm">
         *#
         </div>
         <?php  for($h=0; $h < 6; $h++) { ?>
           <div class="col-sm text-center">
            <?php echo $Answers[$h];?>
           </div>
         <?php } ?>
       </div>
<?php  for($q=1; $q <= 9; $q++) { ?>
      <div class="row">

         <div class="col-sm">
          <?php echo $Questions[$q];?>
         </div>

 <?php  for($a=1; $a <= 6; $a++) { ?>

    <div class="col-sm text-center">
     <div class="form-check form-check-inline">
  <input class="form-check-input" required type="radio" name="answers[<?=$q?>]" id="answers[<?=$q?>][]" value="<?=$a?>">
   <div class="invalid-feedback">
              Any one Required
            </div>
</div>
    </div>
  <?php } ?>

  </div>
<?php } ?>
<br>
<div class="mb-3">
          <label for="email">Mother tongue <span class="text-danger">*</span></label>
         <input required class="form-control" name="desc" id="desc" placeholder="English">
          <div class="invalid-feedback">
            Please enter the descriptions.
          </div>
        </div>
<hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Submit</button>
      </form>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
     <script src="https://getbootstrap.com/docs/4.3/examples/checkout/form-validation.js"></script>
  </body>
</html>