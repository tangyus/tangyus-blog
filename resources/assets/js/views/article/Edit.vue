<template>
    <div class="content">
        <div class="content-title">
            <router-link to="/admin/categories" class="btn btn-primary pull-right">返回</router-link>
            <h3>编辑文章</h3>
        </div>
        <el-row>
            <el-col :span="16" :offset="4">
                <el-form ref="article" :model="article" label-width="80px">
                    <el-form-item label="文章标题">
                        <el-input v-model="article.title" placeholder="请输入标题" clearable></el-input>
                    </el-form-item>
                    <el-form-item label="文章分类">
                        <!--<el-input v-model="user.date" placeholder="请选择分类" clearable></el-input>-->
                        <el-select v-model="value4" clearable placeholder="请选择分类">
                            <el-option
                                    v-for="item in options"
                                    :key="item.value"
                                    :label="item.label"
                                    :value="item.value">
                            </el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item label="文章标签">
                        <!--<el-input v-model="user.date" placeholder="打标签" clearable></el-input>-->
                        <el-select v-model="value5" multiple placeholder="请选择">
                            <el-option
                                    v-for="item in tags"
                                    :key="item.value"
                                    :label="item.label"
                                    :value="item.value">
                            </el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item label="文章内容">
                        <el-input type="textarea" :rows="10" placeholder="请输入一句话简介" v-model="article.content"
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
                                active-color="#13ce66"
                                inactive-color="#ff4949">
                        </el-switch>
                    </el-form-item>
                    <el-form-item label="是否草稿">
                        <el-switch
                                v-model="value2"
                                active-color="#13ce66"
                                inactive-color="#ff4949">
                        </el-switch>
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
                article: [],
                fileList2: [
                    {
                        name: 'food.jpeg',
                        url: 'https://fuss10.elemecdn.com/3/63/4e7f3a15429bfda99bce42a18cdd1jpeg.jpeg?imageMogr2/thumbnail/360x360/format/webp/quality/100'
                    },
                    {
                        name: 'food2.jpeg',
                        url: 'https://fuss10.elemecdn.com/3/63/4e7f3a15429bfda99bce42a18cdd1jpeg.jpeg?imageMogr2/thumbnail/360x360/format/webp/quality/100'}
                ],
                options: [{
                    value: '选项1',
                    label: '黄金糕'
                }, {
                    value: '选项2',
                    label: '双皮奶'
                }, {
                    value: '选项3',
                    label: '蚵仔煎'
                }],
                value4: '',
                tags: [{
                    value: '选项1',
                    label: '黄金糕'
                }, {
                    value: '选项2',
                    label: '双皮奶'
                }, {
                    value: '选项3',
                    label: '蚵仔煎'
                }, {
                    value: '选项4',
                    label: '龙须面'
                }, {
                    value: '选项5',
                    label: '北京烤鸭'
                }],
                value5: [],
            }
        },
        created () {
            this.loadArticle();
        },
        methods: {
            loadArticle: function () {
                var self = this;
                this.$http.get('/article/' + this.$route.params.id + '/edit')
                        .then(function (response) {
                            if (response.data.success) {
                                self.article = response.data.data;
                            }
                        })
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