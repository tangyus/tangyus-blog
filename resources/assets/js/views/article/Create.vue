<template>
    <div class="content">
        <div class="content-title">
            <router-link to="/admin/articles" class="btn btn-primary pull-right">返回</router-link>
            <h3>创建文章</h3>
        </div>
        <el-row>
            <el-col :span="16" :offset="4">
                <el-form ref="article" :model="article" :rules="rules" label-width="80px">
                    <el-form-item label="文章标题" prop="title">
                        <el-input v-model="article.title" placeholder="请输入标题" clearable></el-input>
                    </el-form-item>
                    <el-form-item label="文章分类" prop="category_id">
                        <el-select v-model="category_id" clearable placeholder="请选择分类">
                            <el-option
                                    v-for="item in categoryList"
                                    :key="item.id"
                                    :label="item.name"
                                    :value="item.id">
                            </el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item label="文章标签" prop="articleTags">
                        <el-select v-model="articleTags" multiple placeholder="请选择文章标签">
                            <el-option
                                    v-for="item in tagList"
                                    :key="item.id"
                                    :label="item.name"
                                    :value="item.id">
                            </el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item label="文章内容" prop="content">
                        <markdown-editor v-model="article.content" ref="markdownEditor" :configs="configs"></markdown-editor>
                    </el-form-item>
                    <el-form-item label="文章图片" prop="article_image">
                        <image-upload :image_path="article.article_image" :files="articleFileList" @uploadSuccessPath="getUploadImagePath" @uploadSuccessFiles="getUploadFiles"></image-upload>
                    </el-form-item>
                    <el-form-item label="是否原创">
                        <template>
                            <el-radio v-model="article.is_original" label="1">原创</el-radio>
                            <el-radio v-model="article.is_original" label="0">转载</el-radio>
                        </template>
                    </el-form-item>
                    <el-form-item label="是否草稿">
                        <template>
                            <el-radio v-model="article.status" label="10">草稿</el-radio>
                            <el-radio v-model="article.status" label="20">发表</el-radio>
                        </template>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="saveArticle()">创建保存</el-button>
                    </el-form-item>
                </el-form>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    import markdownEditor from 'vue-simplemde/src/markdown-editor'
    import ImageUpload from '../../dashboard/ImageUpload.vue';

    export default {
        components: {
            ImageUpload,
            markdownEditor
        },
        data() {
            return {
                article: {
                    status: '10',
                    is_original: '1'
                },
                categoryList: [],
                tagList: [],
                articleTags: [],
                articleFileList: [],
                category_id: undefined,
                rules: {
                    title: [
                        { required: true, message: '请输入文章标题', trigger: 'blur' },
                        { min: 10, max: 30, message: '长度在 10 到 30 个字符', trigger: 'blur' }
                    ],
                    category_id: [
                        { required: true, message: '请选择文章分类', trigger: 'blur' }
                    ],
                    articleTags: [
                        { required: true, message: '请至少选择一个文章标签', trigger: 'blur' }
                    ],
                    content: [
                        { required: true, message: '请输入文章内容', trigger: 'blur' }
                    ]
                },
                configs: {
                    spellChecker: false // 禁用拼写检查
                }
            }
        },
        created () {
            this.loadCategory();
        },
        /**
         * 监听分类变化，取出相应分类下的标签信息
         */
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
                            }
                        })
            },
            /**
             * 保存更新文章
             */
            saveArticle: function () {
                var self = this;
                this.article.category_id = this.category_id;
                this.article.articleTags = this.articleTags;
                this.$refs['article'].validate(function (valid) {
                    if (valid) {
                        self.$http.post('/article', self.article)
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

                                    if (response.data.success) {
                                        self.$router.push({
                                            path: '/admin/articles'
                                        })
                                    }
                                })
                    }
                });
            },
            /**
             * 子组件上传图片成功后返回的图片路径以及图片列表
             * @param imagePath
             */
            getUploadImagePath(imagePath) {
                this.article.article_image = imagePath;
            },
            getUploadFiles(files) {
                this.articleFileList = files;
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

        .el-col {
            .el-form {
                .el-form-item {
                    .el-form-item__label {
                        text-align: center;
                    }

                    .el-form-item__content {
                        .el-select {
                            width: 100%;
                        }
                    }
                }
            }
        }
    }
</style>
<style>
    input[type="file"] {
        display: none;
    }

    .markdown-editor .CodeMirror {
        height: 700px;
    }
</style>