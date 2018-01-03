<template>
    <div class="content">
        <div class="content-title">
            <router-link to="/admin/tags" class="btn btn-primary pull-right">返回</router-link>
            <h3>创建标签</h3>
        </div>
        <el-row>
            <el-col :span="12" :offset="8">
                <el-form ref="tag" :model="tag" :rules="rules" label-width="80px">
                    <el-form-item label="标签名称" prop="name">
                        <el-input v-model="tag.name" placeholder="请输入标签名称" clearable></el-input>
                    </el-form-item>
                    <el-form-item label="所属分类" prop="category_id">
                        <template>
                            <el-select v-model="tag.category_id" clearable placeholder="请选择标签分类">
                                <el-option
                                        v-for="item in categoryList"
                                        :key="item.id"
                                        :label="item.name"
                                        :value="item.id">
                                </el-option>
                            </el-select>
                        </template>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="saveTag">创建保存</el-button>
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
                tag: {},
                categoryList: [],
                rules: {
                    name: [
                        { required: true, message: '请输入标签名称', trigger: 'blur' },
                        { min: 3, max: 10, message: '标签名称长度为3-10个字符', trigger: 'blur' }
                    ],
                    category_id: [
                        { required: true, message: '请选择标签分类', trigger: 'blur'}
                    ]
                }
            }
        },
        created() {
            this.loadCategory();
        },
        methods: {
            loadCategory: function () {
                var self = this;
                this.$http.post('/category/all')
                        .then(function (response) {
                            if (response.data.success) {
                                self.categoryList = response.data.data;
                            }
                        })
            },
            saveTag() {
                var self = this;
                this.$refs['tag'].validate(function (valid) {
                    if (valid) {
                        self.$http.post('/tag', self.tag)
                                .then(function (response) {
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
                                    if (response.data.success) {
                                        self.$router.push({
                                            path: '/admin/tags'
                                        });
                                    }
                                })
                    }
                });
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