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
    },
    mounted: function(){
        this.getInfo(m)
        this.getNotifs(m)
        //this.getPosts()
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
            axios.post('http://localhost:1060/PHP_API/userAction.php?action=getNotifs')
            .then(function(response){
                //console.log(response);
            })
        },
        getPosts(){
            axios.get('http://localhost:1060/PHP_API/get_posts.php')
            .then(response => {
                console.log(response.data);
                // Use the response data to display the posts on your web page
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