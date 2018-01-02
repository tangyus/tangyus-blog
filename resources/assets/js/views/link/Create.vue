<template>
    <div class="content">
        <div class="content-title">
            <router-link to="/admin/links" class="btn btn-primary pull-right">返回</router-link>
            <h3>创建友链</h3>
        </div>
        <el-row>
            <el-col :span="12" :offset="8">
                <el-form ref="link" :model="link" label-width="80px">
                    <el-form-item label="友链名称">
                        <el-input v-model="link.name" placeholder="请输入友链名称" clearable></el-input>
                    </el-form-item>
                    <el-form-item label="友链地址">
                        <el-input v-model="link.site" placeholder="请输入友链地址" clearable></el-input>
                    </el-form-item>
                    <el-form-item label="图片">
                        <el-input v-model="link.link_image" placeholder="请输入友链地址" clearable></el-input>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="saveLink">保存修改</el-button>
                        <el-button @click="resetForm">重置</el-button>
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
                link: {}
            }
        },
        methods: {
            saveLink() {
                var self = this;
                this.$http.post('/link', self.tag)
                        .then(function (response) {
                            self.$message({
                                message: response.data.message,
                                type: response.data.success ? 'success' : 'error',
                                showClose: true
                            });
                            if (response.data.success) {
                                self.$router.push({
                                    path: '/admin/links'
                                });
                            }
                        })
            },
            resetForm() {
                this.$refs['tag'].resetFields();
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
        margin: 50px 0;

        .el-form-item__label {
            text-align: center;
        }
    }
</style>