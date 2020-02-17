<template>
    <footer class="nk-footer bg-theme-grad has-ovm">
        <!-- // -->
        <section class="section section-footer section-l tc-light bg-transparent">
            <div class="container">
                <div class="nk-block block-footer">
                    <div class="row">

                        <div class="offset-lg-3 col-lg-4 col-sm-12 mb-4 mb-sm-0 d-flex justify-content-around">
                            <!-- Company -->
                            <company></company>
                            <!-- Legal -->
                            <legal></legal>
                        </div><!-- .col -->

                        <!-- Copyright -->
                        <copyright></copyright>
                    </div><!-- .row -->
                </div><!-- .block @e -->
            </div>

        </section>
        <div class="nk-ovm shape-b"></div>
    </footer>
</template>

<script>
    import Copyright from './partials/footer/copyright';
    import Company from './partials/footer/company';
    import Legal from './partials/footer/legal';
	export default {
		name: "FooterComponent",
        components: {
		    Copyright,
            Company,
            Legal
		}
	}
</script>

<style scoped>

</style>
