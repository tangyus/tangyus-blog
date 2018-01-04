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
                        <image-upload :image_path="link.link_image" :files="linkFileList" @uploadSuccessPath="getUploadImagePath" @uploadSuccessFiles="getUploadFiles"></image-upload>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="saveLink">保存修改</el-button>
                    </el-form-item>
                </el-form>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    import ImageUpload from '../../dashboard/ImageUpload.vue';

    export default {
        components: {
            ImageUpload
        },
        data() {
            return {
                link: {
                    name: '',
                    site: '',
                    link_image: ''
                },
                linkFileList: [],
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
                }
            }
        },
        methods: {
            /**
             * 创建友链
             */
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
            /**
             * 子组件上传图片成功后返回的图片路径以及图片列表
             * @param imagePath
             */
            getUploadImagePath(imagePath) {
                this.link.link_image = imagePath;
            },
            getUploadFiles(files) {
                this.linkFileList = files;
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
    }
</style>