import {  required, min, max, email, alpha, alpha_num, alpha_spaces } from 'vee-validate/dist/rules';
import { extend } from 'vee-validate'
import PhoneNumber from 'awesome-phonenumber'

extend('mobile', {
    validate: function mobile(value, {countryCode}) {
        value = `+${countryCode} ${value}`;
        let phone = new PhoneNumber(value);
        return phone.isMobile()
    }, // validate
    params: ['countryCode'],
    message: `+{countryCode} {_value_} is an invalid mobile number`,
});

extend('lengthBetween', {
    validate: (value, { min, max }) => {
        return value.length >= min && value.length <= max;
    },
    params: ['min', 'max'],
    message: 'The {_field_} length must be between {min} and {max} alphanumeric characters'
});

extend("required", {
    ...required,
    message: '{_field_} is required'
});

extend("email", {
    ...email,
    message: '{_value_} is an invalid email'
});

extend("min", {
    ...min,
    message: 'The {_field_} field must be at least {length} characters'
});

extend("max", {
    ...max,
    message: 'The {_field_} field must be at least {length} characters'
});

extend("alpha", {
    ...alpha,
    message: '{_field_} should only contain alphabet characters'
});

extend("alpha_num", {
    ...alpha_num,
    message: '{_field_} should only contain alphabet and numeric characters'
});

extend("alpha_spaces", {
    ...alpha_spaces,
    message: 'Your {_field_} should only contain alphabets and space characters'
});

extend('alphanumeric_spaces', {
    validate: function alphanumeric_spaces(value) {
        let pattern = /^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$/;
        return value.match(pattern);
    },
    message: 'Only alphabets, numbers and spaces are allowed'
})
