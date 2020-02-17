<template>
    <section class="section no-pdy section-contact bg-transparent has-ovm" id="contact">

        <div class="container">
            <div class="nk-block block-contact">
                <div class="row justify-content-center no-gutters">
                    <div class="col-lg-6">
                        <div class="contact-wrap split split-left split-lg-left bg-white">
                            <h5 class="title title-md">Contact Us</h5>

                            <div class="col-lg-6">
                                <div class="contact-wrap split split-left split-lg-left bg-white">
                                    <h5 class="title title-md">Contact Us</h5>
                                    <v-observer ref="observer" v-slot="{ invalid }"  tag="form" @submit.prevent="send" @reset="resetForm">

                                        <!-- name -->
                                        <v-provider vid="name" name="Name" rules="required|min:2|alpha_spaces" tag="div"
                                                    v-slot="{ errors, valid }" class="field-item">
                                            <input v-model="form.name" id="name" name="name" type="text" class="input-line required"
                                                   :class="{ 'border-danger' : errors.length }"/>
                                            <label for="name" class="field-label field-label-line">Your Name</label>
                                            <div class="small text-danger" v-if="errors.length">{{ errors[0] }}</div>
                                        </v-provider>

                                        <!-- email -->
                                        <v-provider vid="email" name="Email" rules="required|email" tag="div"
                                                    v-slot="{ errors, valid }" class="field-item">
                                            <input v-model="form.email" id="email" name="email" type="email" class="input-line required email"
                                                   :class="{ 'border-danger' : errors.length }"/>
                                            <label for="email" class="field-label field-label-line">Your Email</label>
                                            <div class="small text-danger" v-if="errors.length">{{ errors[0] }}</div>
                                        </v-provider>

                                        <!-- message -->
                                        <v-provider vid="message" name="Message" rules="required|min:150" tag="div" mode="aggressive"
                                                    v-slot="{ errors, valid }" class="field-item">
                    <textarea v-model="form.message" id="message" name="message" class="input-line input-textarea required"
                              :class="{ 'border-danger' : errors.length }"></textarea>
                                            <label for="message" class="field-label field-label-line">Your Message</label>
                                            <div class="small text-danger" v-if="errors.length">{{ errors[0] }}</div>
                                        </v-provider>

                                        <!-- recaptcha -->
                                        <div class="pb-4">
                                            <vue-recaptcha sitekey="6LehC8sUAAAAAPClZLOLeTz43VGiK6014b0KpmmQ" @verify="verifyRecaptcha"
                                                           ref="recaptcha" :loadRecaptchaScript="true"></vue-recaptcha>
                                            <div class="small text-danger" v-if="!form.recaptcha.verified">{{ form.recaptcha.message }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <button class="btn btn-lg btn-grad" :class="{ 'disabled':  invalid && !form.recaptcha.verified}"
                                                        :disabled="invalid || !form.recaptcha.verified" type="submit" >Submit</button>
                                            </div>
                                        </div>
                                    </v-observer>
                                </div>
                            </div><!-- .col -->


                        </div>
                    </div><!-- .col -->
                    <div class="col-lg-4">
                        <div class="contact-wrap split split-right split-lg-right bg-genitian bg-theme tc-light">
                            <div class="d-flex flex-column justify-content-between h-100">
                                <ul class="contact-list">
                                    <li>
                                        <a href="#">
                                            <i class="fas fa-building"></i>
                                        </a>
                                        <div class="contact-text">
                                            <h6>Formula Green Foundation</h6>
                                            <span>Zug, Switzerland</span>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="mailto:support@maharlikacoin.com">
                                            <i class="fas fa-envelope-square"></i>
                                        </a>

                                        <div class="contact-text">
                                            <span>support@maharlikacoin.com</span>
                                        </div>
                                    </li>
                                </ul>
                                <div class="contact-social d-flex flex-column w-100 align-items-center">
                                    <h6>Be a part of our community</h6>
                                    <ul class="social-links">
                                        <li>
                                            <a href="https://www.facebook.com/maharlikacoin" target="_blank">
                                                <i class="fab fa-facebook-square"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://medium.com/maharlika-coin" target="_blank">
                                                <i class="fab fa-medium"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://twitter.com/maharlikacoin" target="_blank">
                                                <i class="fab fa-twitter-square"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://t.me/maharlikacoin" target="_blank">
                                                <i class="fab fa-telegram-plane"></i>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="social-links">
                                        <li>
                                            <a href="https://www.youtube.com/channel/UCS3wH4WzTQ1_cdFcdK6NphQ" target="_blank">
                                                <i class="fab fa-youtube"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.reddit.com/user/maharlikacoin" target="_blank">
                                                <i class="fab fa-reddit-square"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://github.com/maharlikacoin" target="_blank">
                                                <i class="fab fa-github-square"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://linkedin.com/company/maharlika-coin" target="_blank">
                                                <i class="fab fa-linkedin"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!-- .col -->
                </div><!-- .row -->
            </div><!-- .block @e -->
        </div>

        <div class="nk-ovm ovm-top ovm-h-60 bg-light"></div><!-- .nk-ovm -->
    </section>

</template>

<script>
    import VueRecaptcha from 'vue-recaptcha'
    import {ValidationObserver, ValidationProvider, setInteractionMode} from 'vee-validate'

    setInteractionMode('lazy');
    Vue.component('VObserver', ValidationObserver);
    Vue.component('VProvider', ValidationProvider);

    function initialState() {
        return {
            form: {
                name: '',
                email: '',
                message: '',
                recaptcha: {
                    verified: false,
                    message: ''
                }
            }
        }
    }
	export default {
		name: "ContactUs",
        components: { VueRecaptcha },
        data() {
		    return initialState()
        },
        methods: {
            async send() {
                const isValid = await this.$refs.observer.validate();

                if(!this.form.recaptcha.verified) {
                    this.form.recaptcha.message = 'Please let us know that you are not a Robot.';
                    return;
                }
                if (!isValid ) return;

                let submitButton = this.$swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-md btn-grad text-white ml-2',
                        cancelButton: 'btn btn-secondary mx-2'
                    },
                    buttonsStyling: false
                });
                submitButton
                    .fire({
                        title: 'Send your Message',
                        confirmButtonText: 'Send',
                        showCancelButton: true,
                        text: 'Your message will be sent in a while',
                        showLoaderOnConfirm: true,
                        reverseButtons: true,
                        allowOutsideClick: false,
                        preConfirm: () => {
                            return axios.post('/contact-us', this.form)
                                .catch(error => this.$swal.showValidationMessage(`<div>Something went wrong. <br>Please try again.</div>`))
                        } // end of queue-pre confirm
                    })
                    .then((result) => {
                        if(result.value) this.successModal()
                    })
            },
            successModal() {
                let successButton = this.$swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-md btn-grad text-white ml-2',
                    },
                    buttonsStyling: false
                });
                successButton.fire({
                    type: 'success',
                    title: 'Thank you',
                    html: 'We receive your message!',
                    allowOutsideClick: false,
                    onClose: () => {
                        this.resetForm();
                    }
                });// end of swal
            },
            resetForm() {
                Object.assign(this.$data, initialState());
                requestAnimationFrame(() => {
                    this.$refs.observer.reset();
                    this.$refs.recaptcha.reset();
                });
            },
            verifyRecaptcha() {
                this.form.recaptcha.message = '';
                this.form.recaptcha.verified = true;
            }
        }
	}
</script>

<style scoped>

</style>
