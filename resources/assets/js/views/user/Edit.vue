<template>
    <div class="content">
        <div class="content-title">
            <router-link to="/admin/users" class="btn btn-primary pull-right">返回</router-link>
            <h3>编辑用户</h3>
        </div>
        <el-row>
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
                            <el-radio label="0" disabled>否</el-radio>
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
                        <el-input type="textarea" :rows="3" placeholder="请输入一句话简介" v-model="user.introduce" clearable></el-input>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="updateUser">保存修改</el-button>
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
                user: {},
            }
        },
        created() {
            this.loadUser();
        },
        methods: {
            /**
             * 加载当前ID用户信息
             */
            loadUser: function () {
                var self = this;
                this.$http.get('/user/' + this.$route.params.id + '/edit')
                        .then(function (response) {
                            if (response.data.success) {
                                self.user = response.data.data;
                            }
                        })
            },
            /**
             * 保存更新用户信息
             */
            updateUser() {
                var self = this;
                this.$http.patch('/user/' + this.$route.params.id, self.user)
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
                        })
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