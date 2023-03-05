function toFormData(obj){
  var fd = new FormData();
  for(var i in obj){
      fd.append(i,obj[i]);
  }
  return fd;
}

function isEmpty(v){
  if(v.trim()==""){
    return true;
  }
  return false;
}

function register(){
    // Retrieve registration data from form inputs
    var matricule = document.getElementById('matricule').value;
    var nom = document.getElementById('nom').value;
    var prenom = document.getElementById('prenom').value;
    var classe = document.getElementById('classe').value;
    var password = document.getElementById('password').value;
    var confpassword = document.getElementById('confpassword').value;
    var type = 'registration';
    
    if(isNaN(matricule)  || isEmpty(matricule) || isEmpty(nom)|| isEmpty(prenom) || isEmpty(classe) || isEmpty(password) || isEmpty(confpassword) || password != confpassword){
      alert("Invalid input/Password not matching");
    }else{
      var data={
        matricule: matricule,
        nom: nom,
        prenom: prenom,
        classe: classe,
        password: password,
        req_type: type,
      }
  
      var f = toFormData(data);
  
      // Send registration data to PHP script using Axios
      axios.post('http://localhost:1060/PHP_API/register.php', f)
      .then(function(response) {
        // Registration successful, display success message
        alert(response.data.message);
  
        // Redirect to login page
        window.location.href = 'http://localhost:1060/HTML/login.html';
      })
      .catch(function(error) {
        // Registration failed, display error message
        alert(error.response.data.message);
      });
      
    }
    
}

    