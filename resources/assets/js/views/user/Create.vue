<template>
    <div class="content">
        <div class="content-title">
            <router-link to="/admin/users" class="btn btn-primary pull-right">返回</router-link>
            <h3>创建用户</h3>
        </div>
        <el-row>
            <el-col :span="8" :offset="8">
                <div class="user-default-img">
                    <img src="/image/avatar.jpg" alt="小兔子，可爱吧@!!!" width="100" height="100">
                </div>
                <el-form ref="user" :model="user" :rules="rules" label-width="80px" label-position="right">
                    <el-form-item label="用户名" prop="name">
                        <el-input v-model="user.name" placeholder="请输入用户名" clearable></el-input>
                    </el-form-item>
                    <el-form-item label="邮箱" prop="email">
                        <el-input v-model="user.email" placeholder="请输入邮箱" clearable></el-input>
                    </el-form-item>
                    <el-form-item label="密码" prop="password">
                        <el-input type="password" v-model="user.password" placeholder="请输入密码" clearable></el-input>
                    </el-form-item>
                    <el-form-item label="确认密码" prop="password_confirmation">
                        <el-input type="password" v-model="user.password_confirmation" placeholder="请确认密码" clearable></el-input>
                    </el-form-item>
                    <el-form-item label="管理员">
                        <el-radio-group v-model="user.is_admin">
                            <el-radio label="1">是</el-radio>
                            <el-radio label="0">否</el-radio>
                        </el-radio-group>
                    </el-form-item>
                    <el-form-item label="状态">
                        <el-switch
                                v-model="user.status"
                                active-value="1"
                                inactive-value="0">
                        </el-switch>
                    </el-form-item>
                    <el-form-item label="简介">
                        <el-input type="textarea" :rows="3" placeholder="请输入一句话简介" v-model="user.intro" clearable></el-input>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="createUser">立即创建</el-button>
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
                user: {
                    status: '1',
                    is_admin: '0',
                    password: '',
                    name: '',
                    email: '',
                    password_confirmation: ''
                },
                rules: {
                    name: [
                        {required: true, message: '请输入用户名', trigger: 'blur'},
                        {min: 3, max: 25, message: '用户名长度在3 到 5个字符', trigger: 'blur'}
                    ],
                    email: [
                        {required: true, message: '请输入用户邮箱', trigger: 'blur'},
                        // {pattern: "/^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+\.){1,63}[a-z0-9]+$/", message: '邮箱格式不正确', trigger: 'blur'}
                    ],
                    password: [
                        {required: true, message: '请输入密码', trigger: 'blur'},
                        {min: 6, max: 12, message: '密码长度在6 到 12个字符', trigger: 'blur'}
                    ],
                    password_confirmation: [
                        {required: true, message: '请输入确认密码', trigger: 'blur'}
                    ]
                }
            }
        },
        methods: {
            /**
             * 创建用户
             * @returns {boolean}
             */
            createUser() {
                var self = this;
                this.$refs['user'].validate((valid) => {
                    if (valid) {
                        this.$http.post('/user', self.user)
                                .then(function (response) {
                                    // 未通过后台表单验证时，显示表单验证错误信息
                                    if (response.data.errors) {
                                        for (var i in response.data.errors) {
                                            self.$message({
                                                message: response.data.errors[i][0],
                                                type: 'error',
                                                showClose: true
                                            });
                                        }
                                        return false;
                                    }

                                    self.$message({
                                        message: response.data.message,
                                        type: response.data.success ? 'success' : 'error',
                                        showClose: true
                                    });
                                    self.$router.push({
                                        path: 'users'
                                    });
                                })
                    } else {
                        return false;
                    }
                });
            },
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