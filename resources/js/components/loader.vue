<template>
    <div ref="vLoader" class="vld-parent"></div>
</template>

<script>
    import VueLoading from 'vue-loading-overlay';

    Vue.use(VueLoading);

    export default {
		name: "loader",
        components: {
		    MyLoader
        },
        data() {
		    return {
		        loader: null
            }
        },
        beforeCreate() {
            this.loader = this.$loading.show({
                // Pass props by their camelCased names
                container: this.$refs.vLoader,
                loader: 'spinner',
                opacity: 0.5,
                zIndex: 999,
            }, {
                default: this.$createElement('my-loader')
            });
        },
        mounted() {
		    // this.loader.hide();
        }
    }
</script>

<style scoped>

</style>
