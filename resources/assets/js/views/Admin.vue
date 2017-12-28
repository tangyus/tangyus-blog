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

<style lang="scss">
    #page-content {
        border: 1px solid #F2F6FC;
        border-bottom: none;
        position: absolute;
        left: 210px;
        top: 70px;
        bottom: 0;
        right: 0;

        .content-title {
            min-height: 50px;
            padding-left: 15px;
            padding-top: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #DCDFE6;
        }

        .operate {
            line-height: 60px;
            padding-left: 15px;
            margin: 10px auto;

            .btn-primary {
                color: #fff;
                background-color: #409eff;
                border-color: #409eff;
            }
        }

        .block {
            text-align: center;
            font-size: 16px;
            margin-bottom: 75px;
        }
    }

    .el-table__body-wrapper {
        overflow: hidden;
    }
</style>