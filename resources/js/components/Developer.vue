<template>
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 p-3">
            <h3>Manage Developer</h3>
        </div>
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Developer List</h3>
            <div style="text-align:right">
                <router-link to="/add-developer">
                <button class="btn btn-success">
                    Add New Developer
                </button>
                </router-link>
            </div>
          </div>

          <div class="card-body p-0">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Address</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(developer,index) in developers" :key="developer.id">
                  <td>{{index+1}}</td>
                  <td><img :src="'/images/'+developer.photo" height="50" width="50"></td>
                  <td>{{developer.first_name}} {{developer.last_name}}</td>
                  <td>
                   {{developer.email}}
                  </td>
                  <td>
                   {{developer.phone_number}}
                  </td>
                  <td>{{developer.address}}</td>
                  <td><a style="color:blue" @click="editDeveloper(developer)">Edit</a>| <a style="color:red" @click="deleteDeveloper(developer.id)">Delete</a></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    data(){
        return{
            developers:{}
        }
    },
    methods:{
        loadDeveloper(){
            axios
            .get("developers")
            .then(({data})=>{
                this.developers = data;
            }).catch((error)=>{});
        },
        deleteDeveloper(id){
           Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Deleted it!",
      }).then((result) => {
        if (result.value) {
          axios
            .delete("developers/"+id)
            .then(() => {
              this.loadDeveloper();
              alert("successfully Deleted");
            })
            .catch((error) => {
              Swal.fire(
                "Failed!",
                "Can not be Deleted.",
                "warning"
              );
            });
        }
      });
        },
        editDeveloper(developer)
        {
          this.$router.push({
            name:"add-developer",
            params:{developerDetails:developer}
          });
        }
    },

  created() {
    this.loadDeveloper();
  },
};
</script>
