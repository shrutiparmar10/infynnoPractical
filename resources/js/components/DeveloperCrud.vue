<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 p-3">
        <h3>Manage Developer</h3>
      </div>
     
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 v-if="!editMode" class="card-title">Add Developer</h3>
            <h3 v-if="editMode" class="card-title">Edit Developer</h3>
          </div>

          <form @submit.prevent= "editMode?updateDeveloper():createDeveloper()">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 form-group">
                  <label for="fname">First Name</label>
                  <input
                  v-model="form.first_name"
                    type="text"
                    class="form-control"
                    id="fname"
                    placeholder="Enter First Name"
                  />
                  <div v-if="feedback.first_name">
                    <span style="color:red" v-text="feedback.first_name[0]" />
                    </div>
                </div>
                <div class="col-md-6 form-group">
                  <label for="lname">Last Name</label>
                  <input
                  v-model="form.last_name"
                    type="text"
                    class="form-control"
                    id="lname"
                    placeholder="Enter Last Name"
                  />
                  <div v-if="feedback.last_name">
                    <span style="color:red" v-text="feedback.last_name[0]" />
                    </div>
                </div>
                <div class="col-md-6 form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input
                  v-model="form.email"
                    type="email"
                    class="form-control"
                    id="exampleInputEmail1"
                    placeholder="Enter email"
                  />
                  <div v-if="feedback.email">
                    <span style="color:red" v-text="feedback.email[0]" />
                    </div>
                </div>
                <div class="col-md-6 form-group">
                  <label for="phone">Phone Number</label>
                  <input
                  v-model="form.phone_number"
                    type="text"
                    class="form-control"
                    id="phone"
                    placeholder="Enter Phone"
                  />
                  <div v-if="feedback.phone_number">
                    <span style="color:red" v-text="feedback.phone_number[0]" />
                    </div>
                </div>
                <div class="col-md-12 form-group">
                  <label for="address">Address</label>
                  <textarea
                  v-model="form.address"
                    type="text"
                    class="form-control"
                    id="address"
                    placeholder="Enter Address"
                  />
                   <div v-if="feedback.address">
                    <span style="color:red" v-text="feedback.address[0]" />
                    </div>
                </div>
                <div class="form-group">
                  <div class="media">
                    <label class="form-label" for="vertical-designation"
                      >Photo</label
                    ><span style="color: red">*</span><br />
                    <img
                      v-if="form.photo != '' && form.photo != null"
                      id="account-upload-img"
                      class="rounded mr-50"
                      alt="cover-image"
                      :src="getPhoto()"
                      height="120"
                      width="120"
                      ref="logo"
                    />

                    <img
                      v-else
                      id="account-upload-img"
                      class="rounded mr-50 p-2"
                      alt="cover-image"
                      src="/images/avatar-icon.jpg"
                      height="120"
                      width="120"
                      ref="logo"
                    />
                  </div>

                  <!-- upload and reset button -->
                  <div class="media-body mt-75 ml-1">
                    <label
                      for="account-upload"
                      class="btn btn-sm btn-primary mb-75 mr-75"
                      >Upload</label
                    >
                    <input
                      type="file"
                      accept=".jpg, .jpeg, .png,"
                      id="account-upload"
                      name="logo"
                      @change="uploadImage"
                      hidden
                    />
                    <button
                      type="reset"
                      class="btn btn-sm btn-outline-secondary mb-75"
                      @click="form.photo = ''"
                    >
                      Reset
                    </button>
                    <p>Allowed JPG, JPEG or PNG.</p>
                    <div v-if="feedback.photo">
                    <span style="color:red" v-text="feedback.photo[0]" />
                    </div>
                  </div>
                  <!--/ upload and reset button -->
                </div>
              </div>
            </div>

            <div class="card-footer">
              <button type="submit" v-if="!editMode" class="btn btn-primary">
                Submit
              </button>
              <button type="submit" v-if="editMode" class="btn btn-primary">
                Edit
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
     developers:this.$route.params.developerDetails,
      editMode: false,
      form: new Form({
          first_name:"",
          last_name:"",
          email:"",
          phone_number:"",
          address:"",
        photo: "",
      }),
      image_extension_list: ["image/png", "image/jpeg", "image/jpg"],
      feedback:"",
    };
  },
  methods: {
    uploadImage(e) {
      let file = e.target.files[0];
      if (this.image_extension_list.includes(file["type"])) {
        let reader = new FileReader();
        reader.onloadend = (file) => {
          this.form.photo = reader.result;
        };
        reader.readAsDataURL(file);
      } else {
          alert('only images are allowed');
        //  this.toast.$emit("ToastError", "only images are allowed");
      }
    },
    getPhoto() {
      let photo =
        this.form.photo.length > 200
          ? this.form.photo
          : "images/" + this.form.photo;
      return photo;
    },
    updateDeveloper(){
      axios
        .put("developers/" + this.developers.id, {
          first_name:this.form.first_name,
          last_name:this.form.last_name,
          email:this.form.email,
          phone_number:this.form.phone_number,
          address:this.form.address,
         photo: this.form.photo,
        })
         .then((response) => {
           
            alert("Developer Updated successfully");
              this.$router.push({
                name:'developer'
              });
          })
          .catch((error) => {
            this.feedback = error.response.data.errors;
            alert("your Request Failed.");
          });
    },
    createDeveloper(){
        axios
        .post("developers",{
          first_name:this.form.first_name,
          last_name:this.form.last_name,
          email:this.form.email,
          phone_number:this.form.phone_number,
          address:this.form.address,
         photo: this.form.photo,
        })
         .then((response) => {
            
            alert("Developer Added successfully");
              this.$router.push({
                name:'developer'
              });
              
            
          })
          .catch((error) => {
            this.feedback = error.response.data.errors;
            alert("your Request Failed.");
          });
    },
    loadDeveloper() {
      this.editMode = true;
      this.form.fill(this.developers);
    },
  },

  created() {
    if (this.developers != null) {
      this.loadDeveloper();
    }
    // else{
    //   this.$router.push({
    //             name: "add-developer"
    //   });
    // }
  },
};
</script>
