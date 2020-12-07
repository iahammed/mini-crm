<template>
    <div class = "card">
        <div class="card-body">
            <div class = "row">
                <div class="col-11">
                    <h5 class="card-title">List of Client</h5>
                </div>
                <div class="col-1">
                    <a class="btn btn-success" 
                           @click.prevent="showModalOne = !showModalOne"
                            title="Create a project"> 
                        <i class="fas fa-plus-circle"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="justify-content-center">
            <table class="table table-bordered mb-5">
                <thead>
                    <tr class="table-success">
                        <th></th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="client in clients"> 
                        <td>
                            <img :src = "'/' + client.avatar" alt = "" width = "60" height = "60" >
                        </td>
                        <td>{{ client.first_name }} {{ client.last_name }}</td>
                        <td>{{ client.email }}</td>
                        <td>
                            <form action="" method="POST">
                                <a href="" title="show">
                                    <i class="fas fa-eye text-success  fa-lg"></i>
                                </a>
                                <a href="">
                                    <i class="fas fa-edit  fa-lg"></i>
                                </a>
                                
                                <button type="submit" title="delete" style="border: none; background-color:transparent;">
                                    <i class="fas fa-trash fa-lg text-danger"></i>

                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="customModal" v-if="showModalOne">
            <div class="customModalTitle">
                <button class="close" @click.prevent="showModalOne = !showModalOne">&times;</button>
                Create new client
            </div>
            <div class="customModalBody">
                <form class="form-client" 
                    @submit.prevent="this.create_client" 
                    enctype = "multipart/form-data">
                    <div class="form-row">
                        <label for="first_name" class="sr-only">First name</label>
                        <input class="form-control"
                            type="email" 
                            v-model = "formData.first_name"
                            placeholder="First name" 
                            required
                            id="first_name">
                    </div>
                    <div class="form-row">
                        <label for="last_name" class="sr-only">Last name</label>
                        <input class="form-control"
                            type="email" 
                            v-model = "formData.last_name"
                            placeholder="Last name" 
                            required
                            id="last_name">
                    </div>
                    <div class="form-row">
                        <label for="inputEmail" class="sr-only">Email address</label>
                        <input class="form-control"
                            type="email" 
                            v-model = "formData.email"
                            placeholder="Email" 
                            required
                            id="email">
                    </div>
                    <div>
                        <div id="img-preview">
                            <img v-if="formData.avatar" :src="formData.avatar" />
                        </div>
                        <input 
                            n-model="formData.avatar"
                            type="file" 
                            accept="image/*" 
                            id="avatar" 
                            name="avatar" 
                            @change="onFileChange">
                        <label for="avatar">Choose File</label>
                    </div>
                </form>
            </div>
            <div class="customModalFooter">
                <button class="btn btn-primary" 
                    @click.prevent="showModalOne = !showModalOne">Cancel</button>
                <button class="btn btn-primary" 
                    type="submit">Create</button>

            </div>
        </div>    
    </div>
</template>

<script>
export default {
    data(){
        return{
            clients: '',
            url: null,
            showModalOne: false,
            formData: {
                first_name: '',
                lastname: '',
                email: '',
                avatar: null
            }
        }
    },
    mounted() {
        axios.get('/api/client',  {
            headers: {
                'Authorization': `Bearer ${this.$store.state.token}`
            }
        }).then ( response => {
            this.clients = response.data
        });
    },
    methods:{
        create_client(){
            console.log('sent')
        },
        onFileChange(e){
            const file = e.target.files[0];
            this.formData.avatar = URL.createObjectURL(file);
        }
    }


}
</script>

<style scoped>
.form-group {
	 margin-bottom: 25px;
}
.customModal {
	 box-shadow: 0px 1px 12px rgba(0, 0, 0, 0.4);
	 left: calc(50vw - 300px);
	 position: absolute;
	 z-index: 999;
	 width: 600px;
	 top: 20vh;
	 border-radius: 5px;
	 overflow: hidden;
}
 .customModal .customModalTitle {
	 background-color: #eee;
	 text-align: left;
	 padding: 8px 12px;
	 font-size: 1.5em;
}
 .customModal .customModalTitle .close {
	 line-height: 32px;
	 color: #5c4084;
}
 .customModal .customModalBody {
	 background-color: #fff;
	 padding: 8px 12px;
	 text-align: left;
	 padding: 12px;
}
 .customModal .customModalFooter {
	 background-color: #eee;
	 padding: 4px 12px;
	 text-align: left;
}


#img-preview {
    display: none; 
    width: 155px;   
    border: 2px dashed #333;  
    margin-bottom: 20px;
}
#img-preview img {  
    width: 100%;
    height: auto; 
    display: block;   
}

[type="file"] {
    height: 0;  
    width: 0;
    overflow: hidden;
}
[type="file"] + label {
    font-family: sans-serif;
    background: #f44336;
    padding: 10px 30px;
    border: 2px solid #f44336;
    border-radius: 3px;
    color: #fff;
    cursor: pointer;
    transition: all 0.2s;
}
[type="file"] + label:hover {
    background-color: #fff;
    color: #f44336;
}
</style>