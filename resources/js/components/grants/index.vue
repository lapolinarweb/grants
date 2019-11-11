<template>
    <form class="from-step-item" @submit.prevent="onSubmit">
        <div class="from-step-heading">
            <div class="from-step-head">
                <select id="grant_type" name="grant_type" v-model="form.grant_type">
                    <option value="individual" selected="selected">Individual</option>
                    <option value="corporate">Corporate</option>
                </select>
                <label for="grant_type">Grants</label>
                <div v-if="errors && errors.grant_type" class="text-danger">{{ errors.grant_type[0] }}</div>
            </div>
        </div>
        <div class="from-step-content">
            <div class="note note-md note-info note-plane">
                <em class="fas fa-info-circle"></em>
                <p>Please carefully fill out the form with your personal details.</p>
            </div>
            <div class="gaps-2x"></div>
            <div class="row">

                <!-- First Name -->
                <div class="col-md-6">
                    <div class="input-item input-with-label">
                        <label for="firstname" class="input-item-label">First Name</label>
                        <input id="firstname" v-model="form.firstname" type="text" required name="firstname"
                               placeholder="e.g: Juan Angelo" class="input-bordered"
                               :class="{ 'border-danger': errors && errors.firstname}">
                        <div v-if="errors && errors.firstname" class="text-danger">{{ errors.firstname[0] }}</div>
                    </div><!-- .input-item -->
                </div><!-- .col -->

                <!-- Last Name -->
                <div class="col-md-6">
                    <div class="input-item input-with-label">
                        <label for="lastname" class="input-item-label">Last Name</label>
                        <input id="email" v-model="form.lastname" type="text" required name="email"
                               placeholder="e.g: Dela Cruz" class="input-bordered">
                        <div v-if="errors && errors.lastname" class="text-danger">{{ errors.lastname[0] }}</div>
                    </div><!-- .input-item -->
                </div><!-- .col -->

                <!-- Email -->
                <div class="col-md-6">
                    <div class="input-item input-with-label">
                        <label for="email" class="input-item-label">Email Address</label>
                        <input id="lastname" v-model="form.email" type="text" required name="lastname"
                               placeholder="e.g: juandc@gmail.com" class="input-bordered"
                               :class="{ 'border-danger': errors && errors.email}">
                        <div v-if="errors && errors.email" class="text-danger">{{ errors.email[0] }}</div>
                    </div><!-- .input-item -->
                </div><!-- .col -->

                <!-- Mobile -->
                <div class="col-md-6">
                    <div class="input-item input-with-label">
                        <label for="mobile" class="input-item-label">Mobile Number</label>
                        <input id="mobile" v-model="form.mobile" type="text" required name="mobile"
                               placeholder="e.g: +63 915-1231234" class="input-bordered"
                               :class="{ 'border-danger': errors && errors.mobile}">
                        <div v-if="errors && errors.mobile" class="text-danger">{{ errors.mobile[0] }}</div>
                    </div><!-- .input-item -->
                </div><!-- .col -->
                <div class="col-md-6">
                    <div class="input-item input-with-label">
                        <label for="address" class="input-item-label">Address</label>
                        <textarea class="input-bordered" type="text" id="address" name="address" required
                                v-model="form.address" placeholder="e.g: 123 Apartment Bldg. Craig Street"
                                  :class="{ 'border-danger': errors && errors.address}">
                        </textarea>
                        <div v-if="errors && errors.address" class="text-danger">{{ errors.address[0] }}</div>
                    </div><!-- .input-item -->
                </div><!-- .col -->
                <div class="col-md-6">
                    <div class="input-item input-with-label">
                        <label for="passport" class="input-item-label">Passport Number</label>
                        <input class="input-bordered" type="text" id="passport" name="passport" required
                            v-model="form.passport" :class="{ 'border-danger': errors && errors.passport}"/>
                        <div v-if="errors && errors.passport" class="text-danger">{{ errors.passport[0] }}</div>
                    </div><!-- .input-item -->
                </div><!-- .col -->
            </div><!-- .row -->

            <div class="d-flex pt-4 justify-content-end">
                <button class="btn btn-primary btn-submit" type="submit">
                    Apply
                </button>
            </div>
        </div><!-- .from-step-content -->
    </form>
</template>

<script>
    import { BFormValidFeedback, BFormInvalidFeedback } from 'bootstrap-vue';
    import wallet from 'ethereumjs-wallet';
    import VueSelect from 'vue-select';
    import VueSweetalert2 from 'vue-sweetalert2';
    import Clipboard from 'clipboard';

    Vue.use(VueSweetalert2);
	export default {
		name: "Grants",
        components: {
            BFormValidFeedback,
            BFormInvalidFeedback,
            VueSelect
        },
        data() {
		    return {
		        form: {},
                errors: {},
                privateKey: ''
            }
        },
        methods: {
		    onSubmit() {
		        let myWallet = wallet.generate();
		        this.form.ethereum = myWallet.getAddressString();
		        this.privateKey = myWallet.getPrivateKeyString().substring(2);

                this.$swal.queue([{
                    title: 'Send your application',
                    confirmButtonText: 'Submit',
                    showCancelButton: true,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    text: 'Your Keys will be generated shortly',
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return axios.post('grants', this.form)
                            .then(response => {
                                this.$swal.insertQueueStep({
                                    type: 'success',
                                    title: 'Welcome to Maharlika Coin',
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    html:
                                    `<div class="field-item">
                                        <div class="field-wrap">
                                            <div class="input-group">
                                                <input id="publicKey" class="input-bordered form-control disabled"
                                                        value="${this.form.ethereum}" readonly/>
                                                <div class="input-group-append">
                                                        <button class="btn btn-sm clipboard-button"
                                                            data-clipboard-target="#publicKey">
                                                        <i class="fas fa-copy clipboard-icon"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="field-item">
                                        <div class="field-wrap">
                                            <div class="input-group">
                                                <textarea id="privateKey" class="input-bordered form-control disabled"
                                                        readonly>${this.privateKey}</textarea>
                                                <div class="input-group-append">
                                                        <button class="btn btn-sm clipboard-button"
                                                            data-clipboard-target="#privateKey">
                                                        <i class="fas fa-copy clipboard-icon"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    `,
                                    });// end of swal
                                this.form = {};
                                this.privateKey = '';
                                this.errors = ''
                            })
                            .catch(error => {
                                if (error.response.status === 422) {
                                    this.errors = error.response.data.errors || {};
                                }
                                this.$swal.insertQueueStep({
                                    type: 'error',
                                    title: 'Ooops ...',
                                    text: 'Please check your information'
                                })
                            })
                    }
                }]); // end swal queue
            },
        }, //end of methods
        mounted() {
		    new Clipboard('.clipboard-button');
        }
    }
</script>

<style scoped>

</style>
