<?php require APPROOT . '/views/inc/header.php'; ?>




<section>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-8 col-xl-5 ml-auto">
          <div class="row">
            <div class="col text-center">
              <h1>SIGN UP</h1>
              <p class="text-h3">Far far away, far from the countries Vokalia and Consonantia. </p>
            </div>
          </div>
          <form action="<?php echo URLROOT; ?>/users/register" method="post">
          <div class="row align-items-center">
            <div class="col mt-2">
            <input type="text" name="firstname" class="form-control" value="<?php echo $data['firstname']; ?>" placeholder="First Name" >
            </div>
          </div>
          <span class="text-danger"><?php echo $data['firstname_err'] ?></span>
          <div class="row align-items-center mt-2">
            <div class="col">
            <input type="text" name="lastname" class="form-control" value="<?php echo $data['lastname']; ?>" placeholder="Last Name" >
            </div>
          </div>
          <span class="text-danger"><?php echo $data['lastname_err'] ?></span>
          <div class="row align-items-center mt-2">
            <div class="col">
            <input type="email" name="email" class="form-control" value="<?php echo $data['email']; ?>" placeholder="E-mail" >
            </div>
          </div>
          <span class="text-danger"><?php echo $data['email_err'] ?></span>
          <div class="row align-items-center mt-2">
            <div class="col">
            <input type="text" name="dob" id="datepicker" class="form-control" value="<?php echo $data['dob']; ?>" placeholder="Please enter your date of birth">
            </div>
          </div>
          <span class="text-danger"><?php echo $data['dob_err'] ?></span>
          <div class="row align-items-center mt-2">
            <div class="col">
            <select class="form-control" name="gender">
                <option selected disabled>Please select your gender</option>
                <option value="Female">Female</option>
                <option value="Male">Male</option>
                <option value="Agender">Agender</option>
                <option value="Androgyne">Androgyne</option>
                <option value="Androgynous">Androgynous</option>
                <option value="Bigender">Bigender</option>
                <option value="Cis">Cis</option>
                <option value="Cisgender">Cisgender</option>
                <option value="Cis Female">Cis Female</option>
                <option value="Cis Male">Cis Male</option>
                <option value="Cis Man">Cis Man</option>
                <option value="Cis Woman">Cis Woman</option>
                <option value="Cisgender Female">Cisgender Female</option>
                <option value="Cisgender Male">Cisgender Male</option>
                <option value="Cisgender Man">Cisgender Man</option>
                <option value="Cisgender Woman">Cisgender Woman</option>
                <option value="Female to Male">Female to Male</option>
                <option value="FTM">FTM</option>
                <option value="Gender Fluid">Gender Fluid</option>
                <option value="Gender Nonconforming">Gender Nonconforming</option>
                <option value="Gender Questioning">Gender Questioning</option>
                <option value="Gender Variant">Gender Variant</option>
                <option value="Genderqueer">Genderqueer</option>
                <option value="Intersex">Intersex</option>
                <option value="Male to Female">Male to Female</option>
                <option value="MTF">MTF</option>
                <option value="Neither">Neither</option>
                <option value="Neutrois">Neutrois</option>
                <option value="Non-binary">Non-binary</option>
                <option value="Pangender">Pangender</option>
                <option value="Trans">Trans</option>
                <option value="Trans*">Trans*</option>
                <option value="Trans Female">Trans Female</option>
                <option value="Trans* Female">Trans* Female</option>
                <option value="Trans Male">Trans Male</option>
                <option value="Trans* Male">Trans* Male</option>
                <option value="Trans Man">Trans Man</option>
                <option value="Trans* Man">Trans* Man</option>
                <option value="Trans Person">Trans Person</option>
                <option value="Trans* Person">Trans* Person</option>
                <option value="Trans Woman">Trans Woman</option>
                <option value="Trans* Woman">Trans* Woman</option>
                <option value="Transfeminine">Transfeminine</option>
                <option value="Transgender">Transgender</option>
                <option value="Transgender Female">Transgender Female</option>
                <option value="Transgender Male">Transgender Male</option>
                <option value="Transgender Man">Transgender Man</option>
                <option value="Transgender Person">Transgender Person</option>
                <option value="Transgender Woman">Transgender Woman</option>
                <option value="Transmasculine">Transmasculine</option>
                <option value="Transsexual">Transsexual</option>
                <option value="Transsexual Female">Transsexual Female</option>
                <option value="Transsexual Male">Transsexual Male</option>
                <option value="Transsexual Man">Transsexual Man</option>
                <option value="Transsexual Person">Transsexual Person</option>
                <option value="Transsexual Woman">Transsexual Woman</option>
                <option value="Two-Spirit">Two-Spirit</option>
            </select>
            </div>
          </div>
          <span class="text-danger"><?php echo $data['gender_err'] ?></span>
          <div class="row align-items-center mt-2">
            <div class="col">
            <input type="text" id="autocomplete" name="address" class="form-control" value="<?php echo $data['address']; ?>" placeholder="Address" onFocus="geolocate()">
            </div>
          </div>
          <span class="text-danger"><?php echo $data['address_err'] ?></span>
          <div class="row align-items-center mt-2">
            <div class="col">
            <input type="password" name="password" class="form-control" value="" placeholder="Password" >
            </div>
            <div class="col">
            <input type="password" name="confirm_password" class="form-control" value="" placeholder="Confirm password" >
            </div>
          </div>
          <div class="invalid-feedback">
                <?php echo $data['confirm_password_err'] ?>
             </div>
          <span class="text-danger"><?php echo $data['password_err'] ?></span>
          <span class="text-danger pull-right"><?php echo $data['confirm_password_err'] ?></span>
          <div class="row justify-content-start mt-4">
            <div class="col">
              <div class="form-check">
                <label class="form-check-label pull-left mb-3">
                  <input type="checkbox" id="chkAgree" onclick="goFurther()" class="form-check-input">
                  I have read and Accept <a href="https://www.froala.com">Terms and Conditions</a>
                </label>
              </div>
              <button type="submit" id="btnSubmit" class="btn btn-primary btn-block mt-4" disabled>SIGNUP</button>
            </div>
          </div>
          <p class="text-center mt-2">Already have an Account? <a href="<?php echo URLROOT; ?>/users/login">SIGN IN</a></p>
         </form>
        </div>
      </div>
    </div>
  </section>

   <script>
var placeSearch, autocomplete;

var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};

function initAutocomplete() {
  // Create the autocomplete object, restricting the search predictions to
  // geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      document.getElementById('autocomplete'), {types: ['geocode']});

  // Avoid paying for data that you don't need by restricting the set of
  // place fields that are returned to just the address components.
  autocomplete.setFields(['address_component']);

  // When the user selects an address from the drop-down, populate the
  // address fields in the form.
  autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details,
  // and then fill-in the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle(
          {center: geolocation, radius: position.coords.accuracy});
      autocomplete.setBounds(circle.getBounds());
    });
  }
}

  $('#datepicker').datepicker({
      uiLibrary: 'bootstrap4',
      maxDate: '01/01/2002'
  });

  function goFurther(){
if (document.getElementById("chkAgree").checked == true)
    document.getElementById("btnSubmit").disabled = false;
    else
    document.getElementById("btnSubmit").disabled = true;
}

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRMLF9pK8EoY-wOnp1_N1uZ7pH6fOnlLQ&libraries=places&callback=initAutocomplete"
        async defer></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>