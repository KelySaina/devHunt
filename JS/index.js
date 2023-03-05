var app = new Vue({
    el: '#userProfile',
    data:{
        mat : '',
        fullname:'',
        classe:'',
        skills:'',
        interests:'',
        mentor:'',
        cp: false,
        nf: false,
        notifs: [],
        posts: [],
        coms: [],
        iP:'',
        comment:'',
        like:'' ,
        dislike: '',
    },
    mounted: function(){
        this.getInfo(m)
        this.getNotifs(m)
        this.getPosts(m)
    },

    methods:{
        getInfo(matricule){
            var d = {ml : matricule};
            var f = this.toFormData(d);
            axios.post('http://localhost:1060/PHP_API/userAction.php?action=getInfo', f)
            .then(function(response){
                if(response.data.status == 'success'){
                    app.fullname = (response.data[0])['nom']+" "+(response.data[0])['prenom'];
                    app.mat = (response.data[0])['matricule'];
                    app.classe = " | "+(response.data[0])['classe'];
                    if((response.data[0])['skills'] != '-'){
                        app.skills = (response.data[0])['skills'];
                    }
                    if((response.data[0])['interests'] != '-'){
                        app.interests = (response.data[0])['interests'];
                    }
                    if((response.data[0])['IsMentor'] != 'n'){
                        app.mentor = (response.data[0])['IsMentor'];
                    }
                    
                    
                }
                else{
                    console.log(response.data);
                }
            })
        },
        getNotifs(matricule){
            var d = {ml : matricule};
            var f = this.toFormData(d);
            axios.post('http://localhost:1060/PHP_API/userAction.php?action=getNotifs',f)
            .then(function(response){
                //console.log(response);
            })
        },
        getPosts(matricule){
            var d ={m : matricule}
            var f = this.toFormData(d)
            axios.post('http://localhost:1060/PHP_API/userAction.php?action=getPosts',f)
            .then(function(response){
                //console.log(response.data);
                // Use the response data to display the posts on your web page
                app.posts =  response.data;
                app.getComs(response.data['idpost']);
            })
            .catch(error => {
                console.error(error);
                // Handle the error if the request fails
            });
            
        },
        likeP(idPost){
            var d ={
                idP : idPost,
            }
            var f = this.toFormData(d)
            axios.post('http://localhost:1060/PHP_API/userAction.php?action=like',f)
            .then(function(response){
                app.like = response.data['like']

                // Use the response data to display the posts on your web page
                //app.coms =  response.data;
            })
            .catch(error => {
                console.error(error);
                // Handle the error if the request fails
            });
        },
        dislikeP(idPost){
            
            var d ={
                idP : idPost,
            }
            var f = this.toFormData(d)
            axios.post('http://localhost:1060/PHP_API/userAction.php?action=dislike',f)
            .then(function(response){
                app.dislike = response.data['dislike']
                // Use the response data to display the posts on your web page
                //app.coms =  response.data;
            })
            .catch(error => {
                console.error(error);
                // Handle the error if the request fails
            });
        },
        getComs(idPost){
            var d ={idP : idPost}
            var f = this.toFormData(d)
            axios.post('http://localhost:1060/PHP_API/userAction.php?action=getComs',f)
            .then(function(response){
                //console.log(response.data);
                // Use the response data to display the posts on your web page
                app.coms =  response.data;
            })
            .catch(error => {
                console.error(error);
                // Handle the error if the request fails
            });
        },
        postCom(idpost){
            var d ={
                idP : idpost,
                content : app.comment,
                matricule : m,
            }
            var f = this.toFormData(d)
            axios.post('http://localhost:1060/PHP_API/userAction.php?action=postCom',f)
            .then(function(response){
                //console.log(response.data);
                // Use the response data to display the posts on your web page
                //app.coms =  response.data;
            })
            .catch(error => {
                console.error(error);
                // Handle the error if the request fails
            });
        },
        toFormData(obj){
            var fd = new FormData();
            for(var i in obj){
                fd.append(i,obj[i]);
            }
            return fd;
        }
    },
});