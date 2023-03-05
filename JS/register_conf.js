function toFormData(obj){
  var fd = new FormData();
  for(var i in obj){
      fd.append(i,obj[i]);
  }
  return fd;
}

var d = {
  idreq: idreq
}

var f = toFormData(d);

function sendIdReq(idreq) {
    axios.post('http://localhost/api/register_conf.php', f )
    .then(function (response) {
      console.log(response.data);
    })
    .catch(function (error) {
      console.log(error);
    });
  }
  