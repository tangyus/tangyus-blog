<template>
    <div class="content">
        <div class="content-title">
            <router-link to="/admin/links" class="btn btn-primary pull-right">返回</router-link>
            <h3>编辑友链</h3>
        </div>
        <el-row>
            <el-col :span="12" :offset="8">
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
                        <image-upload :link="link" :fileList="link_images"></image-upload>
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
    import ImageUpload from '../../dashboard/ImageUpload.vue';

    export default {
        components: {
            ImageUpload
        },
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
            // 加载当前ID的友链信息
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
            // 更新当前ID的友链信息
            updateLink() {
                var self = this;
                this.$refs['link'].validate(function (valid) {
                    if (valid) {
                        self.$http.patch('/link/' + self.$route.params.id, self.link)
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
                                })
                    } else {
                        return false;
                    }
                });
            },
            resetForm() {
                this.$refs['link'].resetFields();
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