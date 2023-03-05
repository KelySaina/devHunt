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

function post(){
  if(isEmpty(document.getElementById("title").value) || isEmpty(myCodeMirror.getValue()) || isEmpty(document.getElementById("content").value) || isEmpty(document.getElementById("tags").value)){
    alert('Invalid input');
  }else{
        // Retrieve blog data from form
      var blogData = {
        matricule : m,
        title: document.getElementById("title").value,
        code: myCodeMirror.getValue(),
        content: document.getElementById("content").value,
        tags: document.getElementById("tags").value
      };
      var f = toFormData(blogData);

      // Make a POST request to the API to post the blog data
      axios.post("http://localhost:1060/PHP_API/post_q.php", f)
        .then(function(response) {
          // Handle successful response
          if(response.data.status == 'success'){
            window.location.href='../index.php'
          }
        })
        .catch(function(error) {
          // Handle error
          console.log(error);
        });
      } 
}

  