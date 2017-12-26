<template>
    <div id="page">
        <page-navbar></page-navbar>
        <div id="page-header">
            <page-header></page-header>
            <div id="page-content">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
    import PageNavbar from '../dashboard/layouts/Navbar.vue';
    import PageHeader from '../dashboard/layouts/Header.vue';

    export default {
        components: {
            PageNavbar,
            PageHeader
        }
    }
</script>

<style lang="scss" scoped>
    #page-content {
        border: 1px solid #F2F6FC;
        border-bottom: none;
        position: absolute;
        left: 210px;
        top: 70px;
        bottom: 0;
        right: 0;
    }
</style>