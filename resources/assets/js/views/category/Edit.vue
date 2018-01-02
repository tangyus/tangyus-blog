<template>
    <div class="content">
        <div class="content-title">
            <router-link to="/admin/categories" class="btn btn-primary pull-right">返回</router-link>
            <h3>编辑分类</h3>
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
                    <el-form-item label="修改时间">
                        <el-input v-model="category.updated_at" placeholder="修改时间" disabled></el-input>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="updateCategory">保存修改</el-button>
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
                category: {}
            }
        },
        created() {
            this.loadCategory();
        },
        methods: {
            loadCategory: function () {
                var self = this;
                this.$http.get('/category/' + this.$route.params.id + '/edit')
                        .then(function (response) {
                            if (response.data.success) {
                                self.category = response.data.data;
                            }
                        })
            },
            updateCategory() {
                var self = this;
                this.$http.patch('/category/' + this.$route.params.id, self.category)
                        .then(function (response) {
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
        margin: 50px 0;

        .el-form-item__label {
            text-align: center;
        }
    }
</style>