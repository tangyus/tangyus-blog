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
                    <router-link to="/admin/users"><i class="fa fa-user-circle"></i>用户管理</router-link>
                </el-menu-item>
                <el-menu-item index="2">
                    <router-link to="/admin/articles"><i class="fa fa-book"></i>文章管理</router-link>
                </el-menu-item>
                <el-menu-item index="3">
                    <router-link to="/admin/categories"><i class="fa fa-bar-chart"></i>分类管理</router-link>
                </el-menu-item>
                <el-menu-item index="4">
                    <router-link to="/admin/tags"><i class="fa fa-tags" aria-hidden="true"></i>标签管理</router-link>
                </el-menu-item>
                <el-menu-item index="5">
                    <router-link to="/admin/links"><i class="fa fa-paper-plane" aria-hidden="true"></i>友链管理</router-link>
                </el-menu-item>
                <el-menu-item index="6">
                    <router-link to="/admin/exchange_links"><i class="fa fa-code-fork" aria-hidden="true"></i>友链互换</router-link>
                </el-menu-item>
            </el-menu>
        </el-col>
    </el-row>
</template>

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
                border-right: none;

                .el-menu-vertical-demo:not(.el-menu--collapse) {
                    width: 200px;
                    min-height: 400px;
                }

                .el-menu-item a {
                    display: block;
                    height: 100%;
                    color: #999999;
                    text-decoration: none;

                    i {
                        color: #999999;
                        margin-bottom: 2px;
                        margin-right: 5px;
                        width: 24px;
                        text-align: center;
                        font-size: 18px;
                        vertical-align: middle;
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