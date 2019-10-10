<template>
    <div>
        <div class="card shadow mt-5">
            <div class="card-header py-3">
                <h3 class="m-0">
                    List of all Guest <router-link to="/addGuest" class="btn btn-primary btn-sm float-right">Add Guest</router-link>
                </h3>
            </div>
            <div class="card-body">
                <div class="text-center text-primary" v-show="loading">
                    <i class="fas fa-circle-notch fa-spin fa-2x"></i>
                </div>
                <div class="table-responsive" v-show="content">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="guest in guests" :key="guest.id">
                                <td>{{ guest.id }}</td>
                                <td>{{ guest.firstname }}</td>
                                <td>{{ guest.lastname }}</td>
                                <td>{{ guest.email }}</td>
                                <td>{{ guest.phone_number }}</td>
                                <td>{{ guest.gender }}</td>
                                <td>{{ guest.address }}</td>
                                <td><router-link :to="{name: 'editGuest', params: {id: guest.id}}" class="btn btn-sm btn-info">Edit</router-link>
                                <b-button @click="deleteGuestModal(guest.id, guest.firstname, guest.lastname)" class="btn btn-danger btn-sm" variant="danger">Delete</b-button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Delete Guest Modal -->
        <b-modal id="removeGuestModal" ref="delete-modal" title="Delete Guest" @ok="removeGuest">
            <h3 class="text-center">Are you sure you want to remove {{ firstname }} {{ lastname }} from the guest list?</h3>

        </b-modal>

    </div>
</template>

<script>
export default {
    data() {
        return {
            guests: [],
            loading: false,
            content: true,
            id: '',
            firstname: '',
            lastname: '',
        }
    },
    created() {
        this.loading = true;
        this.content = false;
        this.axios.get("/api/guests").then(response => {
            this.content = true;
            this.loading = false;
            this.guests = response.data;
        });
    },
    methods: {
        deleteGuestModal(id, firstname, lastname) {
            this.id = id;
            this.firstname = firstname;
            this.lastname = lastname;
            this.$refs['delete-modal'].show();
        },
        removeGuest(e) {
            e.preventDefault();
            let data = {id: this.id};
            this.axios.delete(`/api/guests/delete/${this.id}`, data)
                .then(response => {
                    this.success = true;
                    this.id = '';
                    this.firstname = '';
                    this.lastname = '';
                    this.$toast.success({
                        title: 'Success',
                        message: "Guest removed successfully"
                    });
                    this.$refs['delete-modal'].hide();
                    this.reload();
                })
                .catch((error) => {
                    console.log("Error");
                })
        },
        reload() {
            this.loading = true;
            this.content = false;
            this.axios.get("/api/guests").then(response => {
            this.content = true;
            this.loading = false;
            this.guests = response.data;
        });
        }
    }
}
</script>