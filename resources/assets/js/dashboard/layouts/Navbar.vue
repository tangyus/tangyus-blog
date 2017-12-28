<template>
    <el-row class="tac">
        <el-col :span="24" class="col">
            <el-menu
                    class="el-menu-vertical-demo"
                    default-active="1"
                    background-color="#545c64"
                    text-color="#999999"
                    active-text-color="#ffd04b">
                <el-menu-item index="1">
                    <router-link to="/admin/users"><i class="el-icon-menu"></i>用户管理</router-link>
                </el-menu-item>
                <el-menu-item index="2">
                    <router-link to="/admin/articles"><i class="el-icon-setting"></i>文章管理</router-link>
                </el-menu-item>
                <el-menu-item index="3">
                    <router-link to="/admin/categories"><i class="el-icon-setting"></i>分类管理</router-link>
                </el-menu-item>
                <el-menu-item index="4">
                    <router-link to="/admin/tags"><i class="el-icon-setting"></i>标签管理</router-link>
                </el-menu-item>
                <el-menu-item index="5">
                    <router-link to="/admin/links"><i class="el-icon-setting"></i>友链管理</router-link>
                </el-menu-item>
            </el-menu>
        </el-col>
    </el-row>
</template>

<script>
    export default {
        methods: {
            handleOpen(key, keyPath) {
                console.log(key, keyPath);
            },
            handleClose(key, keyPath) {
                console.log(key, keyPath);
            }
        }
    }
</script>

<style lang="scss" scoped>
    .tac {
        width: 200px;
        position: fixed;
        height: 100%;
        top: 0;
        left: 0;
        background-color: #545c64;

        .col {
            margin-top: 100px;

            .el-menu {
                .el-menu-item a {
                    display: block;
                    height: 100%;
                    color: #999999;
                    text-decoration: none;

                    i {
                        color: #999999;
                        margin-bottom: 2px;
                    }
                }
                .el-menu-item .router-link-exact-active {
                    color: #ffd04b!important;
                    i {
                        color: #ffd04b;
                    }
                }
            }
        }
    }
</style>