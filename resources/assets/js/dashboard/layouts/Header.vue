<template>
    <div class="header-menu">
        <div class="menu-nav">
            <div class="menu-icon">
                <el-button plain icon="glyphicon glyphicon-menu-hamburger"></el-button>
            </div>
            <div class="menu-breadcrumb">
                <el-breadcrumb separator="/" class="breadcrumb-tag">
                    <el-breadcrumb-item :to="{ path: '/' }">首页</el-breadcrumb-item>
                    <el-breadcrumb-item>活动管理</el-breadcrumb-item>
                    <el-breadcrumb-item>活动列表</el-breadcrumb-item>
                    <el-breadcrumb-item>活动详情</el-breadcrumb-item>
                </el-breadcrumb>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
    .header-menu {
        box-sizing: border-box;
        position: fixed;
        display: block;
        padding-left: 200px;
        width: 100%;
        height: 60px;
        transition: padding .3s;

        .menu-nav {
            height: 60px;
            background: #fff;
            box-shadow: 0 2px 1px 1px hsla(0, 0%, 39%, .1);
            position: relative;
            z-index: 11;

            .menu-icon {
                display: inline-block;
                padding: 7px;

                button {
                    font-size: 20px;
                    border: none
                }
            }

            .menu-breadcrumb {
                position: absolute;
                left: 60px;
                top: 0;
                right: 340px;
                bottom: 0;
                padding: 10px;
                overflow: hidden;

                .breadcrumb-tag {
                    padding-top: 10px;
                    padding-left: 20px;
                }
            }
        }
    }
</style>