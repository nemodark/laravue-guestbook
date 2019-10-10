<template>
    <div class="card shadow mt-5">
        <div class="card-header py-3">
                <h3 class="m-0">
                    Add Guest <router-link to="/" class="btn btn-warning btn-sm float-right">Go Back</router-link>
                </h3>
            </div>
            <div class="card-body">
                <form @submit.prevent="addGuest">
                    <div class="form-group">
                        <label for="firstname">Firstname</label>
                        <input type="text" id="firstname" :class="['form-control', allerrors.firstname ? 'is-invalid' : '']" value="" v-model="guest.firstname">
                        <span v-if="allerrors.firstname" :class="['invalid-feedback']">{{ allerrors.firstname[0] }}</span>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Lastname</label>
                        <input type="text" id="lastname" :class="['form-control', allerrors.lastname ? 'is-invalid' : '']" value="" v-model="guest.lastname">
                        <span v-if="allerrors.lastname" :class="['invalid-feedback']">{{ allerrors.lastname[0] }}</span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" :class="['form-control', allerrors.email ? 'is-invalid' : '']" value="" v-model="guest.email">
                        <span v-if="allerrors.email" :class="['invalid-feedback']">{{ allerrors.email[0] }}</span>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <VuePhoneNumberInput v-model="guest.phone_number" @update="onPhoneUpdate" />
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control" id="gender" name="gender" value="" :class="['form-control', allerrors.gender ? 'is-invalid' : '']" v-model="guest.gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <span v-if="allerrors.gender" :class="['invalid-feedback']">{{ allerrors.gender[0] }}</span>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" :class="['form-control', allerrors.address ? 'is-invalid' : '']" value="" v-model="guest.address">
                        <span v-if="allerrors.address" :class="['invalid-feedback']">{{ allerrors.address[0] }}</span>
                    </div>
                    <div class="my-3">
                        <button class="btn btn-primary float-right" type="submit">Add</button>
                    </div>
                </form>
            </div>
    </div>
</template>

<script>
import VuePhoneNumberInput from 'vue-phone-number-input';
import 'vue-phone-number-input/dist/vue-phone-number-input.css';
export default {
    components: { VuePhoneNumberInput },
    data(){
        return {
            guest: {},
            loading: false,
            allerrors: {},
            success: false,
        }
    },
    methods: {
        addGuest() {
            this.axios.post("http://guest-book.test/api/guests/add", this.guest)
                .then(response => {
                    this.allerrors = [];
                    this.guest.firstname = '';
                    this.guest.lastname = '';
                    this.guest.email = '';
                    this.guest.phone_number = '';
                    this.guest.gender = '';
                    this.guest.address = '';
                    this.success = true;
                    this.$toast.success({
                        title: 'Success',
                        message: 'Guest added successfully'
                    });
                    this.$router.push({name: 'guests'})
                })
                .catch((error) => {
                    console.log(error.response.data.errors);
                    this.allerrors = error.response.data.errors;
                    this.success = false;
                }) 
        },
        onPhoneUpdate(payload) {
        let phoneData = payload
        this.guest.country_code = phoneData.countryCode
        }
    }
}
</script>