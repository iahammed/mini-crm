<style>
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

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form 
    @if(isset($client))
        action = "{{ route('client.update', $client->id) }}"
    @else
        action = "{{ route('client.store') }}"
    @endif
    enctype = "multipart/form-data"
    method = "POST"
    >
    @csrf
    @if(isset($client))
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="first_name">First name:</label>
        <input  class="form-control" 
                type="text" 
                name ="first_name" 
                value = "{{ @$client ? $client->first_name : '' }}"
                class="form-control" 
                placeholder="First name" 
                id="first_name">
    </div>
    <div class="form-group">
        <label for="last_name">Last name:</label>
        <input  class="form-control" 
                type="text" 
                name ="last_name" 
                value = "{{ @$client ? $client->last_name : '' }}"
                placeholder="Last name" 
                id="last_name">
    </div>

    <div class="form-group">
        <label for="email">Email address:</label>
        <input  class="form-control" 
                type="email" 
                name = "email" 
                value = "{{ @$client ? $client->email : '' }}"
                placeholder="Enter email" 
                id="email">
    </div>
    <div>
        <div id="img-preview"></div>
        <input 
            type="file" accept="image/*" id="avatar" name="avatar" />
        <label for="avatar">Choose File</label>
    </div>
     
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<script>

const chooseFile = document.getElementById("avatar");
const imgPreview = document.getElementById("img-preview");

chooseFile.addEventListener("change", function () {
    getImgData();
});

function getImgData() {
    const files = chooseFile.files[0];
    if (files) {
        const fileReader = new FileReader();
        fileReader.readAsDataURL(files);
        fileReader.addEventListener("load", function () {
        imgPreview.style.display = "block";
        imgPreview.innerHTML = '<img src="' + this.result + '" />';
        });    
    }
}

</script>