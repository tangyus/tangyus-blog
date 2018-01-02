<template>
    <div class="content">
        <div class="content-title">
            <router-link to="/admin/links" class="btn btn-primary pull-right">返回</router-link>
            <h3>创建友链</h3>
        </div>
        <el-row>
            <el-col :span="12" :offset="6">
                <el-form ref="link" :model="link" label-width="80px">
                    <el-form-item label="友链名称">
                        <el-input v-model="link.name" placeholder="请输入友链名称" clearable></el-input>
                    </el-form-item>
                    <el-form-item label="友链地址">
                        <el-input v-model="link.site" placeholder="请输入友链地址" clearable></el-input>
                    </el-form-item>
                    <el-form-item label="图片">
                        <el-upload
                                class="upload-demo"
                                action="/upload"

                                :before-upload="uploadFile"
                                :on-preview="handlePreview"
                                :on-remove="handleRemove"
                                :file-list="fileList2"
                                list-type="picture">
                            <el-button size="small" type="primary">点击上传</el-button>
                            <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
                        </el-upload>
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
//                csrfToken: '',
//                csrfToken: this.Laravel.csrfToken,
                link: {},
                rules: {
                    name: [
                        { required: true, message: '请输入友链名称', trigger: 'blur' },
                        { min: 3, max: 5, message: '长度在 3 到 8 个字符', trigger: 'blur' }
                    ],
                    site: [
                        { required: true, message: '请输入友链地址', trigger: 'blur' }
                    ],
                    link_image: [
                        { type: 'date', required: true, message: '请选择日期', trigger: 'change' }
                    ]
                },
                fileList2: []
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
            },
            uploadFile(file) {
                console.log(self.Laravel.csrfToken);
                console.log(self.csrfToken);
                console.log(file);
//                {
//                    headers: {
//                        'X-CSRF-TOKEN': self.Laravel.csrfToken,
//                                'accept-charset': "UTF-8",
//                                'enctype': "multipart/form-data"
//                    }
//                }
                var fileData = new Object();
//                fileData.image = file.name;
//                fileData.type = file.type;
//                fileData = file;
                console.log(fileData);
//                this.$http.post('/upload', fileData, {
//                    headers: {
//                        'X-CSRF-TOKEN': self.Laravel.csrfToken,
//                        'Content-Type': 'application/json'
//                    }
//                })
//                        .then(function (response) {
//                            if (response.data.success) {
//                                self.fileList2.push({
//                                    'name': fileData.image,
//                                    'url': response.data.path
//                                });
//                            }
//                        })
//                return false;
            },
            handleRemove(file, fileList) {
                console.log(file, fileList);
            },
            handlePreview(file) {
                console.log(file);
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