<template>
    <div class="content">
        <div class="content-title">
            <router-link to="/admin/categories" class="btn btn-primary pull-right">返回</router-link>
            <h3>创建文章</h3>
        </div>
        <el-row>
            <el-col :span="16" :offset="4">
                <el-form ref="article" :model="article" label-width="80px">
                    <el-form-item label="文章标题">
                        <el-input v-model="article.title" placeholder="请输入文章标题" clearable></el-input>
                    </el-form-item>
                    <el-form-item label="文章分类">
                        <el-select v-model="category_id" clearable placeholder="请选择文章分类">
                            <el-option
                                    v-for="item in categoryList"
                                    :key="item.id"
                                    :label="item.name"
                                    :value="item.id">
                            </el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item label="文章标签">
                        <el-select v-model="articleTags" multiple placeholder="请选择文章标签">
                            <el-option
                                    v-for="item in tagList"
                                    :key="item.id"
                                    :label="item.name"
                                    :value="item.id">
                            </el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item label="文章内容">
                        <el-input type="textarea" :rows="10" placeholder="请输入文章内容" v-model="article.content"
                                  clearable></el-input>
                    </el-form-item>
                    <el-form-item label="文章图片">
                        <el-upload
                                class="upload-demo"
                                action="https://jsonplaceholder.typicode.com/posts/"
                                :on-preview="handlePreview"
                                :on-remove="handleRemove"
                                :before-remove="beforeRemove"
                                multiple
                                :limit="3"
                                :on-exceed="handleExceed"
                                :file-list="fileList">
                            <el-button size="small" type="primary">点击上传</el-button>
                            <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
                        </el-upload>
                    </el-form-item>
                    <el-form-item label="是否原创">
                        <el-switch
                                v-model="article.is_original"
                                active-value="1"
                                active-color="#13ce66"
                                inactive-color="#ff4949">
                        </el-switch>
                    </el-form-item>
                    <el-form-item label="是否草稿">
                        <el-switch
                                v-model="article.status"
                                active-value="10"
                                active-color="#13ce66"
                                inactive-color="#ff4949">
                        </el-switch>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="saveArticle()">保存</el-button>
                        <el-button type="default" @click="resetArticleForm">重置</el-button>
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
                article: {
                    status: '10',
                    is_original: '1'
                },
                categoryList: [],
                tagList: [],
                articleTags: [],
                category_id: undefined,
                fileList: [
                        {
                        name: 'food.jpeg',
                        url: 'https://fuss10.elemecdn.com/3/63/4e7f3a15429bfda99bce42a18cdd1jpeg.jpeg?imageMogr2/thumbnail/360x360/format/webp/quality/100'
                    },
                    {
                        name: 'food2.jpeg',
                        url: 'https://fuss10.elemecdn.com/3/63/4e7f3a15429bfda99bce42a18cdd1jpeg.jpeg?imageMogr2/thumbnail/360x360/format/webp/quality/100'}
                ]
            }
        },
        created () {
            this.loadCategory();
        },
        watch: {
            category_id: function (newVal) {
                var self = this;
                if (newVal) {
                    self.loadTag();
                }
            }
        },
        methods: {
            /**
             * 加载分类列表
             */
            loadCategory: function () {
                var self = this;
                this.$http.post('/category/all')
                        .then(function (response) {
                            if (response.data.success) {
                                self.categoryList = response.data.data;
                            }
                        })
            },
            /**
             * 加载分类下的标签列表
             */
            loadTag: function () {
                var self = this;
                this.$http.post('/tag/all', {category_id: self.category_id})
                        .then(function (response) {
                            if (response.data.success) {
                                self.tagList = response.data.data;
                                console.log(self.tagList);
                            }
                        })
            },
            /**
             * 保存文章
             */
            saveArticle: function () {
                var self = this;
                this.article.category_id = this.category_id;
                this.$http.post('/article', this.article)
                        .then(function (response) {
                            self.$message({
                                message: response.data.message,
                                type: response.data.success ? 'success' : 'error',
                                showClose: true
                            });
                        })
            },
            /**
             * 重置文章创建表单
             */
            resetArticleForm() {
                this.$refs['article'].resetFields();
            },
            handleRemove(file, fileList) {
                console.log(file, fileList);
            },
            handlePreview(file) {
                console.log(file);
            },
            handleExceed(files, fileList) {
                this.$message.warning(`当前限制选择 3 个文件，本次选择了 ${files.length} 个文件，共选择了 ${files.length + fileList.length} 个文件`);
            },
            beforeRemove(file, fileList) {
                return this.$confirm(`确定移除 ${ file.name }？`);
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

        .el-col {
            .el-form {
                .el-form-item {
                    .el-form-item__label {
                        text-align: center;
                    }

                    .el-form-item__content {

                        .el-upload {
                            .input[type="file"] {
                                display: none!important;
                            }
                        }
                        .el-select {
                            width: 100%;
                        }
                    }
                }
            }
        }
    }
</style>