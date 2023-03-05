function toFormData(obj){
  var fd = new FormData();
  for(var i in obj){
      fd.append(i,obj[i]);
  }
  return fd;
}

function login(){
    // Retrieve the Matricule and password from the login form
    var matricule = document.getElementById("matricule").value;
    var password = document.getElementById("password").value;

    // Set the request data as an object
    var requestData = { matricule: matricule, password: password };
    var f = toFormData(requestData);

    // Send a POST request to the login API using axios
    axios.post('http://localhost:1060/PHP_API/login.php', f)
      .then(function (response) {
        // Handle the response
        if (response.data.status === "success") {
          // Login successful, create a session and redirect to the home page
          sessionStorage.setItem("loggedIn", true);
          sessionStorage.setItem("matricule", matricule);
          //alert("Login successful!");
          window.location.href = "../index.php";
        } else {
          // Login failed, display an error message
          alert(response.data.message);
          console.log(response.data.message);
        }
      })
      .catch(function (error) {
        // Handle errors
        console.log(error);
        alert("An error occurred while processing the request.");
      });

}
