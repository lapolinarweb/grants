const FormFields = {
    initialState: () => {
        return {
            grantsForm: {
                type: '',
                title: 'Mr',
                firstname: '',
                lastname: '',
                address: '',
                city: '',
                state: '',
                zip: '',
                mobile: '',
                email: '',
                passport: '',
                purpose: '',
                publicKey: '',
                countrySymbol: '',
                countryCode: '',
                countryFlag: '',
                countryName: '',
            },
            privateKey: '',
            country: {
                list: [],
                selected: null,
                queryUri: 'https://restcountries.eu/rest/v2/name'
            },
            titleOptions: ['', 'Mr', 'Ms'],
            selectIsLoading: false,
        }
    }
};
export default FormFields
