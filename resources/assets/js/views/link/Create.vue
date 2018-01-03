<template>
    <div class="content">
        <div class="content-title">
            <router-link to="/admin/links" class="btn btn-primary pull-right">返回</router-link>
            <h3>创建友链</h3>
        </div>
        <el-row>
            <el-col :span="12" :offset="6">
                <el-form ref="link" :model="link" :rules="rules" label-width="80px">
                    <el-form-item label="友链名称" prop="name">
                        <el-input v-model="link.name" placeholder="请输入友链名称" clearable></el-input>
                    </el-form-item>
                    <el-form-item label="友链地址" prop="site">
                        <div>
                            <el-input placeholder="请输入友链地址" v-model="link.site" class="input-with-select">
                                <el-select v-model="site_type" slot="prepend" placeholder="请选择">
                                    <el-option label="Http://" value="1"></el-option>
                                    <el-option label="Https://" value="2"></el-option>
                                </el-select>
                            </el-input>
                        </div>
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
                                list-type="picture"
                                name="image">
                            <el-button slot="trigger" size="small" type="primary">选取文件</el-button>
                            <el-button style="margin-left: 10px;" size="small" type="success" @click="submitUpload">上传</el-button>
                            <div slot="tip" class="el-upload__tip">只能上传jpg/jpeg/png文件，且不超过500KB</div>
                        </el-upload>
                        <el-alert
                                v-if="uploadErrorMessage.length > 0"
                                v-for="item in uploadErrorMessage"
                                title=""
                                type="error">
                            {{item}}
                        </el-alert>
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
                link: {
                    name: '',
                    site: '',
                    link_image: ''
                },
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
                uploadErrorMessage: []
            }
        },
        methods: {
            saveLink() {
                var self = this;
                this.$refs['link'].validate(function (valid) {
                    if (valid) {
                        if (self.site_type == 2) {
                            self.link.site = 'https://' + self.link.site;
                        } else {
                            self.link.site = 'http://' + self.link.site;
                        }
                        self.$http.post('/link', self.link)
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
                    } else {
                        return false;
                    }
                });
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
                console.log(fileList);
                console.log(file);
                if (response.success) {
                    this.link.link_image = response.path;
                } else {
                    this.uploadErrorMessage = response.message.image;
                    file = {},
                    fileList = {};
                }
            },
            errorHandle(err, file, fileList) {
                console.log(err);
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

        .el-input-group__prepend {
            .el-select {
                width: 100px;
            }
        }

        .el-form-item__label {
            text-align: center;
        }
        .el-alert {
            margin: 5px 0;
        }
    }
</style>
<style>
    input[type="file"] {
        display: none;
    }
</style>