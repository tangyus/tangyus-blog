<template>
    <div id="page">
        <page-navbar></page-navbar>
        <div id="page-header">
            <page-header></page-header>
            <div id="page-content">
                <page-content></page-content>
            </div>
        </div>
    </div>
</template>

<script>
    import PageNavbar from '../dashboard/layouts/Navbar.vue';
    import PageHeader from '../dashboard/layouts/Header.vue';
    import PageContent from '../dashboard/layouts/Content.vue';

    export default {
        components: {
            PageNavbar,
            PageHeader,
            PageContent
        }
    }
</script>