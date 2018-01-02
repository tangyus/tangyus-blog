<template>
    <div class="content">
        <div class="content-title">
            <router-link to="/admin/categories" class="btn btn-primary pull-right">返回</router-link>
            <h3>创建分类</h3>
        </div>
        <el-row>
            <el-col :span="12" :offset="6">
                <el-form ref="category" :model="category" label-width="80px">
                    <el-form-item label="分类名称">
                        <el-input v-model="category.name" placeholder="请输入分类名称" clearable></el-input>
                    </el-form-item>
                    <el-form-item label="分类描述">
                        <el-input v-model="category.desc" placeholder="请输入一句话描述" clearable></el-input>
                    </el-form-item>
                    <el-form-item label="文章数量" width="200">
                        <el-input v-model="category.article_count" placeholder="文章数量" disabled></el-input>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="saveCategory">创建保存</el-button>
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
                category: {
                    article_count: 0
                }
            }
        },
        methods: {
            saveCategory () {
                var self = this;
                this.$http.post('/category', self.category)
                        .then(function (response) {
                            self.$message({
                                message: response.data.message,
                                type: response.data.success ? 'success' : 'error',
                                showClose: true
                            });
                        })
            },
            resetForm() {
                this.$refs['category'].resetFields();
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