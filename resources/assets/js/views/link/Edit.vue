<template>
    <div class="content">
        <div class="content-title">
            <router-link to="/admin/links" class="btn btn-primary pull-right">返回</router-link>
            <h3>编辑友链</h3>
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
                    <el-form-item label="友链图片" prop="link_image">
                        <el-upload
                                class="upload-demo"
                                ref="upload"
                                action="/upload"
                                :before-upload="uploadFile"
                                :on-success="successHandle"
                                :on-error="errorHandle"
                                :limit="1"
                                :on-exceed="handleExceed"
                                :auto-upload="false"
                                :file-list="link_images"
                                list-type="picture">
                            <el-button slot="trigger" size="small" type="primary">选取文件</el-button>
                            <el-button style="margin-left: 10px;" size="small" type="success" @click="submitUpload">上传</el-button>
                            <div slot="tip" class="el-upload__tip">只能上传jpg/jpeg/png文件，且不超过500KB</div>
                        </el-upload>
                    </el-form-item>
                    <el-form-item label="更新时间">
                        <el-input v-model="link.updated_at" placeholder="更新时间" disabled clearable></el-input>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="updateLink">保存修改</el-button>
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
                link: {},
                link_images: [],
                site_type: '',
                rules: {
                    name: [
                        { required: true, message: '请输入友链名称', trigger: 'blur' },
                        { min: 3, max: 8, message: '长度在 3 到 8 个字符', trigger: 'blur' }
                    ],
                    site: [
                        { required: true, message: '请输入友链地址', trigger: 'blur' }
                    ],
                    link_image: [
                        { required: true, message: '请上传友链图片', trigger: 'blur' }
                    ]
                },
            }
        },
        created() {
            this.loadTLink();
        },
        methods: {
            loadTLink: function () {
                var self = this;
                this.$http.get('/link/' + this.$route.params.id + '/edit')
                        .then(function (response) {
                            if (response.data.success) {
                                self.link = response.data.data;
                                var imageArr = response.data.data.link_image.split('/');
                                self.link_images.push({
                                    name: imageArr[imageArr.length - 1],
                                    url: response.data.data.link_image
                                });
                            }
                        })
            },
            updateLink() {
                var self = this;
                this.$http.patch('/link/' + this.$route.params.id, self.link)
                        .then(function (response) {
                            self.$message({
                                message: response.data.message,
                                type: response.data.success ? 'success' : 'error',
                                showClose: true
                            });
                        })
            },
            resetForm() {
                this.$refs['link'].resetFields();
            },
            submitUpload() {
                this.$refs.upload.submit();
            },
            uploadFile(file) {
                if (file.size > 500 * 1024) {
                    this.$message({
                        message: '请上传小于500KB的图片',
                        type: 'error',
                        showClose: true
                    });
                    return false;
                }
            },
            handleExceed() {
                this.$message({
                    message: '最多只能上传一张图片',
                    type: 'error',
                    showClose: true
                });
            },
            successHandle(response, file, fileList) {
                this.link.link_image = response.path;
            },
            errorHandle(err, file, fileList) {
                this.$message({
                    message: err,
                    type: 'error',
                    showClose: true
                });
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
<style>
    input[type="file"] {
        display: none;
    }
</style>