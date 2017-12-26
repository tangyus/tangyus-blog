<template>
    <div class="content">
        <div class="content-title">
            <router-link to="/admin/users" class="btn btn-primary pull-right">返回</router-link>
            <h3>编辑用户</h3>
        </div>
        <el-row :gutter="20">
            <el-col :span="8" :offset="8">
                <div class="user-default-img">
                    <img src="/image/avatar.jpg" alt="小兔子，可爱吧@!!!" width="100" height="100">
                </div>
                <el-form ref="user" :model="user" label-width="80px">
                    <el-form-item label="用户名">
                        <el-input v-model="user.name" placeholder="请输入用户名" clearable></el-input>
                    </el-form-item>
                    <el-form-item label="邮箱">
                        <el-input v-model="user.email" placeholder="请输入邮箱" clearable></el-input>
                    </el-form-item>
                    <el-form-item label="管理员">
                        <el-radio-group v-model="user.is_admin">
                            <el-radio label="1" disabled>是</el-radio>
                            <el-radio label="0">否</el-radio>
                        </el-radio-group>
                    </el-form-item>
                    <el-form-item label="简介">
                        <el-input type="textarea" :rows="3" placeholder="请输入一句话简介" v-model="user.introduce" clearable></el-input>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="onSubmit">保存修改</el-button>
                        <router-link to="/admin/users" class="el-button el-button--default">取消</router-link>
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
                user: {}
            }
        },
        created() {
            this.loadUser();
        },
        methods: {
            loadUser: function () {
                var self = this;
                this.$http.get('/user/' + this.$route.params.id + '/edit')
                        .then(function (response) {
                            if (response.data.success) {
                                self.user = response.data.data;
                            }
                        })
            },
            onSubmit() {
                console.log('submit!');
            }
        }
    }
</script>

<style lang="scss" scoped>
    .content-title {
        min-height: 50px;
        padding-left: 15px;
        padding-top: 10px;
        padding-bottom: 10px;
        border-bottom: 1px solid #DCDFE6;

        .btn-primary {
            color: #fff;
            background-color: #409eff;
            border-color: #409eff;
            margin-top: 17px;
            margin-right: 50px;
        }
    }

    .el-row {
        margin-top: 10px;

        .user-default-img {
            margin: 30px auto;
            text-align: center;

            .img {
                border-radius: 50%;
            }
        }

        .el-form-item__label {
            text-align: center;
        }
    }
</style>