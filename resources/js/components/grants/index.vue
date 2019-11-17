<template>
    <v-observer ref="observer" v-slot="{ invalid }" class="from-step-item" tag="form"
                @submit.prevent="onSubmit" @reset="resetForm">
        <div class="from-step-content">
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-5">
                <div class="form-text text-info small d-flex align-items-center mb-2">
                    <em class="fas fa-info-circle mr-3"></em>
                    <div class="d-flex flex-column">
                        <span>Please carefully fill out the form with your personal details.</span>
                        <div class="text-danger align-items-center d-flex text-danger">
                            Indicated with asterisk (<i class="fas fa-asterisk icon-xs"></i>) are required
                        </div>
                    </div>
                </div>
                <button v-if="grantsForm.type" type="button" @click="showGrantTypeModal"
                        class="btn btn-light btn-sm btn-screen-small bordered modal-grant-type">
                    <span class="text-uppercase d-inline mr-2">{{ grantsForm.type }}</span>
                    <em class="fas fa-exchange-alt mr-0"></em>
                </button>
            </div>

            <div class="row">
                <!-- Title -->
                <div class="col-md-2">
                    <b-form-group>
                        <label class="d-flex align-items-center">
                            <i class="fas fa-asterisk text-danger icon-xs mr-2"></i> Salutation
                        </label>
                        <multiselect v-model="grantsForm.title" :options="titleOptions" class="select-normal"
                                     placeholder="Choose">
                        </multiselect>
                    </b-form-group>
                </div>

                <!-- First Name -->
                <v-provider vid="firstname" name="First name" rules="required|min:2|alpha_spaces"
                            v-slot="{ errors, valid }" class="col-md-4">
                    <b-form-group>
                        <label for="firstname" class="d-flex align-items-center">
                            <i class="fas fa-asterisk text-danger icon-xs mr-2"></i> First Name
                        </label>
                        <b-form-input id="firstname" trim v-model="grantsForm.firstname" placeholder="e.g. Mason James"
                                      :state="errors.length ? false : (valid ? true : null)"></b-form-input>
                        <b-form-invalid-feedback id="firstnameFeedback">{{ errors[0] }}</b-form-invalid-feedback>
                        <small class="form-text text-muted">Your first name is really important to us</small>
                    </b-form-group>
                </v-provider>

                <!-- Last Name -->
                <v-provider vid="lastname" name="Last name" rules="required|min:2|alpha_spaces"
                            v-slot="{ errors, valid }" class="col-md-6">
                    <b-form-group>
                        <label for="lastname" class="d-flex align-items-center">
                            <i class="fas fa-asterisk text-danger icon-xs mr-2"></i> Last Name
                        </label>
                        <b-form-input id="lastname" trim v-model="grantsForm.lastname" placeholder="e.g. Murray"
                                      :state="errors.length ? false : (valid ? true : null)"></b-form-input>
                        <b-form-invalid-feedback id="lastnameFeedback">{{ errors[0] }}</b-form-invalid-feedback>
                        <small class="form-text text-muted">Your last name is as important with the others</small>
                    </b-form-group>
                </v-provider>
            </div>

            <div class="row">
                <!-- Address -->
                <v-provider vid="address" name="Address" rules="required|lengthBetween:10,255"
                            v-slot="{ errors, invalid, valid }" class="col-md-12">
                    <b-form-group>
                        <label for="address" class="d-flex align-items-center">
                            <i class="fas fa-asterisk text-danger icon-xs mr-2"></i> Address
                        </label>
                        <b-form-input id="address" v-model="grantsForm.address" placeholder="e.g. 123D Craig Street Fusion Road"
                                      :state="errors.length ? false : (valid ? true : null)"></b-form-input>
                        <b-form-invalid-feedback id="addressFeedback">{{ errors[0] }}</b-form-invalid-feedback>
                        <small class="form-text text-muted">Your Address is always safe with us</small>
                    </b-form-group>
                </v-provider>
            </div>

            <div class="row mb-2">
                <!-- City -->
                <v-provider vid="city" name="City" rules="required|alphanumeric_spaces" v-slot="{ errors, valid }" class="col-md-4">
                    <b-form-group>
                        <label for="city" class="d-flex align-items-center">
                            <i class="fas fa-asterisk text-danger icon-xs mr-2"></i> City
                        </label>
                        <b-form-input id="city" v-model="grantsForm.city" placeholder="Maharlika City"
                                      :state="errors.length ? false : (valid ? true : null)"></b-form-input>
                        <b-form-invalid-feedback id="cityFeedback">{{ errors[0] }}</b-form-invalid-feedback>
                    </b-form-group>
                </v-provider>

                <!-- State or Province -->
                <v-provider vid="province" name="State or Province" rules="alphanumeric_spaces" v-slot="{ errors, valid, dirty }" class="col-md-4">
                    <b-form-group label="State or Province" for="province">
                        <b-form-input id="province" trim v-model="grantsForm.province" :state="errors.length ? false : (valid && dirty? true : null)"></b-form-input>
                        <b-form-invalid-feedback id="provinceFeedback">{{ errors[0] }}</b-form-invalid-feedback>
                    </b-form-group>
                </v-provider>

                <!-- Zip or Postal Code -->
                <v-provider vid="zip" name="Zip or Postal Code" rules="alphanumeric_spaces" v-slot="{ errors, valid, dirty }" class="col-md-4">
                    <b-form-group label="Zip or Postal Code" label-for="zip">
                        <b-form-input id="zip" trim v-model="grantsForm.zip" :state="errors.length ? false : (valid && dirty? true : null)"></b-form-input>
                        <b-form-invalid-feedback id="zipFeedback">{{ errors[0] }}</b-form-invalid-feedback>
                    </b-form-group>
                </v-provider>
            </div>

            <div class="row">
                <!-- Country -->
                <div class="col-md-5">
                    <b-form-group>
                        <label for="country" class="d-flex align-items-center">
                            <i class="fas fa-asterisk text-danger icon-xs mr-2"></i> Country
                        </label>
                        <multiselect v-model="country.selected" id="country" label="Country" track-by="alpha2Code"
                                     placeholder="Type to search your country" open-direction="bottom"
                                     :options="country.list"
                                     :searchable="true" :loading="selectIsLoading" :internal-search="false"
                                     :options-limit="300"
                                     :class="[ country.selected ? 'select-success': 'select-normal']"
                                     @search-change="asyncFindCountry" :limit="3" :max-height="300">
                            <template slot="singleLabel" slot-scope="props">
                                <img class="option__image" style="width:2em" :src="props.option.flag"
                                     :alt="props.option.name">
                                <span class="option__desc">
                                    <span class="option__title">
                                        {{ props.option.name + ' (+' + props.option.callingCodes[0] +')' }}
                                    </span>
                                </span>
                            </template>
                            <template slot="option" slot-scope="props">
                                <img class="option__image" style="width:2em" :src="props.option.flag"
                                     :alt="props.option.name">
                                <span class="option__desc">
                                    <span class="option__title">
                                        {{ props.option.name + ' (+' + props.option.callingCodes[0] +')'}}
                                    </span>
                                </span>
                            </template>
                            <span slot="noResult">Oops! No elements found. Consider changing the search query.</span>
                        </multiselect>
                        <small class="form-text text-muted">Let us know your origination</small>
                    </b-form-group>
                </div>

                <!-- Mobile -->
                <v-provider vid="mobile" name="Mobile" :rules='{required: true, mobile: grantsForm.countryCode }'
                            v-slot="{ errors, valid }" class="col-md-7">
                    <b-form-group>
                        <label for="mobile" class="d-flex align-items-center">
                            <i class="fas fa-asterisk text-danger icon-xs mr-2"></i> Mobile
                        </label>
                        <b-input-group>
                            <b-input-group-prepend v-if="country.selected">
                                <div class="input-group-text">{{ `+${grantsForm.countryCode}` }}</div>
                            </b-input-group-prepend>
                            <b-form-input id="mobile" number v-model="grantsForm.mobile" :disabled="!country.selected"
                                          placeholder="e.g. +1-202-555-XXXX" :state="errors.length ? false : (valid ? true : null)">
                            </b-form-input>
                            <b-form-invalid-feedback id="mobileFeedback" v-if="errors.length">{{ errors[0] }}</b-form-invalid-feedback>
                        </b-input-group>
                        <small class="form-text text-muted">We need your Mobile to be able to contact you.</small>
                    </b-form-group>
                </v-provider>
            </div>
            <div class="row">
                <!-- Email -->
                <v-provider vid="email" name="Email" rules="required|email" v-slot="{ errors, valid }" class="col-md-5">
                    <b-form-group>
                        <label for="email" class="d-flex align-items-center">
                            <i class="fas fa-asterisk text-danger icon-xs mr-2"></i> Email
                        </label>
                        <b-form-input id="email" trim v-model="grantsForm.email" placeholder="e.g. murraymj@domain.com"
                                      :state="errors.length ? false : (valid ? true : null)"></b-form-input>
                        <b-form-invalid-feedback id="emailFeedback">{{ errors[0] }}</b-form-invalid-feedback>
                        <small class="form-text text-muted">We will never share your email with anyone else</small>
                    </b-form-group>
                </v-provider>

                <!-- Organisation -->
                <v-provider vid="organisation" name="Organisation" rules="required|min:5||alpha_spaces"
                            v-slot="{ errors, valid }" class="col-md-4" v-if="isCorporate">
                    <b-form-group>
                        <label for="organisation" class="d-flex align-items-center">
                            <i class="fas fa-asterisk text-danger icon-xs mr-2"></i> Organisation
                        </label>
                        <b-form-input id="organisation" v-model="grantsForm.organisation"
                                      placeholder="e.g. Formula Green Foundation"
                                      :state="errors.length ? false : (valid ? true : null)"></b-form-input>
                        <b-form-invalid-feedback id="organisationFeedback">{{ errors[0] }}</b-form-invalid-feedback>
                        <small class="form-text text-muted">We need to know your Organisation</small>
                    </b-form-group>
                </v-provider>

                <!-- passport -->
                <v-provider vid="passport" name="Passport" rules="required|lengthBetween:6,9|alpha_num"
                            v-slot="{ errors, valid }" :class="[isCorporate ? 'col-md-3': 'col-md-7']">
                    <b-form-group>
                        <label for="passport" class="d-flex align-items-center">
                            <i class="fas fa-asterisk text-danger icon-xs mr-2"></i> Passport
                        </label>
                        <b-form-input id="passport" trim v-model="grantsForm.passport" placeholder="e.g. ALPHANUMX"
                                      :state="errors.length ? false : (valid ? true : null)"></b-form-input>
                        <b-form-invalid-feedback id="passportFeedback">{{ errors[0] }}</b-form-invalid-feedback>
                        <small class="form-text text-muted">Your real identity is very important us</small>
                    </b-form-group>
                </v-provider>
            </div>
            <div class="row">
                <!-- Purpose -->
                <v-provider vid="purpose" name="Purpose" rules="required|lengthBetween:30,255" v-slot="{ errors, invalid, valid }"
                    class="col-md-12">
                    <b-form-group>
                        <label for="purpose" class="d-flex align-items-center">
                            <i class="fas fa-asterisk text-danger icon-xs mr-2"></i> Purpose of Grant
                        </label>
                        <b-form-textarea id="purpose" trim v-model="grantsForm.purpose" row="4"
                                         :state="errors.length ? false : (valid ? true : null)"></b-form-textarea>
                        <b-form-invalid-feedback id="purposeFeedback">{{ errors[0] }}</b-form-invalid-feedback>
                        <small class="form-text text-muted">Your purpose is very valuable to get approved on your application</small>
                    </b-form-group>
                </v-provider>
            </div>
            <div class="row">
                <!-- Apply Button -->
                <div class="col-md-12 d-flex pt-4 justify-content-end">
                    <button class="btn btn-primary btn-screen-small" :disabled="invalid" type="submit" >Apply</button>
                </div>
            </div>
        </div>
    </v-observer>
</template>

<script>
    import {
        BForm, BFormGroup, BInputGroup, BInputGroupPrepend, BInputGroupAppend, BFormInput, BFormValidFeedback,
        BFormInvalidFeedback, BFormTextarea
    } from 'bootstrap-vue'
    import {ValidationObserver, ValidationProvider, setInteractionMode} from 'vee-validate'
    import wallet from 'ethereumjs-wallet'
    import Clipboard from 'clipboard'
    import FormFields from './FormFields'
    import Multiselect from 'vue-multiselect'

    setInteractionMode('lazy');
    Vue.component('VObserver', ValidationObserver);
    Vue.component('VProvider', ValidationProvider);
    export default {
        name: "Grants",
        components: {
            BForm,
            BFormGroup,
            BInputGroup,
            BInputGroupPrepend,
            BInputGroupAppend,
            BFormInput,
            BFormValidFeedback,
            BFormInvalidFeedback,
            BFormTextarea,
            Multiselect
        },
        computed: {
            isCorporate() {
                return this.grantsForm.type === 'corporate'
            }
        },
        data() {
            return FormFields.initialState()
        },
        methods: {
            asyncFindCountry(query) {
                if (query !== '') {
                    this.selectIsLoading = true;
                    this.search(this, query, this.country.queryUri);
                }
            },
            search: _.debounce((vm, query, uri) => {
                delete axios.defaults.headers.common["X-Requested-With"];
                axios.get(`${uri}/${escape(query)}`)
                    .then(response => {
                        let countries = response.data;

                        // either you pick the properties you want
                        let filterKeys = _.iteratee((person) =>
                            _(person).pick('name', 'alpha2Code', 'callingCodes', 'flag'));

                        vm.country.list = _(countries).chain().map(filterKeys).value();
                        vm.selectIsLoading = false;
                    })
                    .catch(error => console.log(error));
            }, 800),
            showGrantTypeModal() {
                let grantTypeButton = this.$swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-primary mx-2',
                        cancelButton: 'btn btn-secondary mx-2'
                    },
                    buttonsStyling: false
                });
                grantTypeButton
                    .fire({
                        title: 'Welcome to&nbsp;<span class="text-gold">Maharlika Coin!</span>',
                        text: "What grant you are applying for?",
                        imageUrl: '/images/maharlika-coin-gold.png',
                        imageWidth: 200,
                        imageAlt: 'Maharlika Coin',
                        showCancelButton: true,
                        confirmButtonText: 'Individual',
                        cancelButtonText: 'Corporate',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                    }) // end fire
                    .then((result) => {
                        if (result.value) {
                            grantTypeButton.fire({
                                title: 'Individual',
                                text: 'Please continue to fill-out your information.',
                                type: 'success',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                allowEnterKey: false,
                            });
                            this.grantsForm.type = 'individual';
                            Vue.delete(this.grantsForm, 'organisation');
                        } else {
                            grantTypeButton.fire({
                                title: 'Corporate',
                                text: 'Please continue to fill-out your information.',
                                type: 'success',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                allowEnterKey: false,
                            });
                            this.grantsForm.type = 'corporate';
                            Vue.set(this.grantsForm, 'organisation', '');
                        }
                    }) // end then
            },
            resetForm() {
                Object.assign(this.$data, FormFields.initialState());
                requestAnimationFrame(() => {
                    this.$refs.observer.reset();
                });
                this.showGrantTypeModal();
            },
            async onSubmit() {
                const isValid = await this.$refs.observer.validate();
                if (!isValid) return;

                // 🐿 ship it

                let myWallet = wallet.generate();
                this.grantsForm.publicKey = myWallet.getAddressString();
                this.privateKey = myWallet.getPrivateKeyString().substring(2);

                this.$swal
                    .fire({
                        title: 'Send your application',
                        confirmButtonText: 'Submit',
                        showCancelButton: true,
                        text: 'Your Keys will be generated shortly',
                        showLoaderOnConfirm: true,
                        reverseButtons: true,
                        preConfirm: () => {
                            return axios.post('/api/apply', this.grantsForm)
                                .catch(error => {
                                    this.$swal.showValidationMessage(`<div>Something went wrong. <br>Please check your information.</div>`)
                                }) // end of catch
                        } // end of queue-preconfirm
                    })
                    .then((result) => {if(result.value) this.successModal()})
            },
            successModal() {
                this.$swal.fire({
                    type: 'success',
                    title: 'Congratulations, your application has been submitted successfully.',
                    html: this.successMessage(),
                    confirmButtonText: 'Apply for another Grant',
                    onClose: () => {
                        this.resetForm();
                    }
                });// end of swal
            },
            successMessage() {
                return ` <div class="field-item">
                                        <div class="field-wrap">
                                            <div class="input-group">
                                                <input id="publicKey" class="input-bordered form-control disabled"
                                                        value="${this.grantsForm.publicKey}" readonly/>
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
                                    </div>`;
            }
        }, //end of methods
        mounted() {
            new Clipboard('.clipboard-button');
            this.showGrantTypeModal();
        },
        watch: {
            'country.selected': function (selectedCountry) {
                if (selectedCountry !== null) {
                    this.grantsForm.countrySymbol = selectedCountry.alpha2Code;
                    this.grantsForm.countryCode = selectedCountry.callingCodes[0];
                    this.grantsForm.countryFlag = selectedCountry.flag;
                    this.grantsForm.countryName = selectedCountry.name
                } else {
                    this.grantsForm.mobile = '';
                }
            }
        }
    }
</script>

<style scoped>
    .select-success {
        border: 1px solid #28a745;
        border-radius: .25em;
    }

    .select-normal {
        border-radius: .25em;
        border: 1px solid #ced4da;
    }
    .icon-xs {
        font-size: 5px;
    }
    .modal-grant-type:focus {
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(216,217,219,.5) !important;
    }
    .form-control:focus {
        border-color: #BF9C34;
        box-shadow: 0 0 0 0.2rem rgba(191,156,52,.25);
    }
    .form-control.is-invalid:focus, .was-validated .form-control:invalid:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220,53,69,.25);
    }
</style>
