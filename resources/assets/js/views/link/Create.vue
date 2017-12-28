<template>
    <div class="content">
        <div class="content-title">
            <router-link to="/admin/categories" class="btn btn-primary pull-right">返回</router-link>
            <h3>创建分类</h3>
        </div>
        <el-row>
            <el-col :span="8" :offset="8">
                <el-form ref="user" :model="user" label-width="80px">
                    <el-form-item label="分类名称">
                        <el-input v-model="user.name" placeholder="请输入用户名" clearable></el-input>
                    </el-form-item>
                    <el-form-item label="邮箱">
                        <el-input v-model="user.date" placeholder="请输入邮箱" clearable></el-input>
                    </el-form-item>
                    <el-form-item label="简介">
                        <el-input type="textarea" :rows="3" placeholder="请输入一句话简介" v-model="user.address"
                                  clearable></el-input>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="updateUser">保存修改</el-button>
                        <router-link to="/admin/categories" class="el-button el-button--default">取消</router-link>
                    </el-form-item>
                </el-form>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                user: [{
                    date: '2016-05-02',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1518 弄'
                }]
            }
        }
    }
</script>

<style lang="scss" scoped>
    .content-title {
        .btn-primary {
            color: #fff;
            background-color: #409eff;
            border-color: #409eff;
            margin-top: 17px;
            margin-right: 50px;
        }
    }

    .el-row {
        margin: 10px 0;

        .el-form-item__label {
            text-align: center;
        }
    }
</style>